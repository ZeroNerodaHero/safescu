<?php
	include_once("../login.php");
	header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: *");
	$data = json_decode(file_get_contents("php://input"),true);
	$type = $data["requestType"];
	$codeFail = '{"code":0}';

	if($type == 0){
		//user submits a request for a walker
		//user submits name, requestinfo,origin,and destination
		//returns a walkeeSessionId
		$name = $data["name"];
		$requestInfo= $data["requestInfo"];
		$originLoc = $data["currentLocation"];
		echo walkerAddRequest($name,$requestInfo,$originLoc);
	} else if($type == 1){
		//walkee want to check on if someone is dispatched
		//user submits a walkeeSessionId
		//returns a code(has request), and state is request is 1	
		$walkeeSessionId = $data["walkeeSessionId"];
		echo walkerGetSessionStatus($walkeeSessionId);
	} else if($type == 11){
		//walker logins in 
		//needs username and password
		//returns a code,userId,and sessionId
		$username = $data["username"];
		$password = $data["password"];
		echo walkerLogin($username,$password);
	} else if($type == 12){
		//walker accepts
		//needs userName and sessionId,requestId
		//returns a code
		$username = $data["username"];
		$sessionId = $data["sessionId"];
		$requestId = $data["requestId"];
		echo fullfillRequest($username,$sessionId,$requestId);
	} else if($type == 13){
		//walker finishes request
		//needs userName and sessionId,requestId
		//returns a code
		$username = $data["username"];
		$sessionId = $data["sessionId"];
		$requestId = $data["requestId"];
		echo requestDone($username,$sessionId,$requestId);
	} 

	function walkerAddRequest($name,$requestInfo,$originLoc){
		global $conn,$codeFail;
		if(empty($name) || empty($requestInfo) || empty($originLoc) ){
			return $codeFail;
		} 
		$que = "INSERT INTO walkerRequest(name,information,location)
				VALUES('$name','$requestInfo','$originLoc')";
		$res = $conn->query($que);
		$last_id = $conn->insert_id;
		return '{"code": 1,"walkeeSessionId":'.$last_id.'}';
	}
	function walkerGetSessionStatus($walkeeSessionId){
		global $conn,$codeFail;
		if(empty($walkeeSessionId)) return '{"code":0}';
		$que = "SELECT * FROM walkerRequest WHERE id = $walkeeSessionId";
		$returnRequest = '{"code":';
		$res = $conn->query($que);
		if(!empty($res) && $res->num_rows > 0){
			while($row = $res->fetch_assoc()){
				$isFilling = $row["isFilling"];

				$returnRequest .= '1,"status":'.$isFilling."}";
			}
		} else{
			$returnRequest .= "0}";

		}
		return $returnRequest;
	}
	function walkerLogin($username,$password){
		global $conn,$codeFail;
		if(empty($username) || empty($password)){
			return '{"code":0}';
		}
		$que = "SELECT * FROM INRIXwalkers 
				WHERE userName='$username' and password='$password'";
		$res = $conn->query($que);
		if(!empty($res) && $res->num_rows > 0){
			$rndID = rand()%100000;
			$que = "UPDATE INRIXwalkers
					SET sessionId=$rndID
					WHERE userName='$username' and password='$password'";
			$res = $conn->query($que);
			return '{"code":1,"sessionId":'.$rndID.'}';
		}
		return '{"code":0}';
	}
	function fullfillRequest($username,$sessionId,$requestId){
		global $conn,$codeFail;
		if(empty($username) || empty($sessionId) || empty($requestId)){
			return $codeFail;
		}
		
		$que = "SELECT enRoute FROM INRIXwalkers 
				WHERE userName='$username' and sessionId='$sessionId'";
		$res = $conn->query($que);
		if(!empty($res) && $res->num_rows > 0){
			while($row = $res->fetch_assoc()){
				if($row["enRoute"] == true) return $codeFail; 
			}
		} else{
			return $codeFail;
		}
		$que = "SELECT isFilling FROM walkerRequest
				WHERE id='$requestId'";
		$res = $conn->query($que);
		if(!empty($res) && $res->num_rows > 0){
			while($row = $res->fetch_assoc()){
				if($row["isFilling"] == true) return $codeFail; 
			}
		} else{
			return $codeFail;
		}
		$que = "UPDATE INRIXwalkers
				SET enRoute=true
				WHERE userName='$username' and sessionId='$sessionId'";
		$res = $conn->query($que);
		$que = "UPDATE walkerRequest
				SET isFilling=true
				WHERE id='$requestId'";
		$res = $conn->query($que);
		return '{"code":1}';
	}
	function requestDone($username,$sessionId,$requestId){
		global $conn,$codeFail;
		if(empty($username) || empty($sessionId) || empty($requestId)){
			return $codeFail;
		}
		
		$que = "UPDATE INRIXwalkers
				SET enRoute=false
				WHERE userName='$username' and sessionId='$sessionId'";
		$res = $conn->query($que);
		$que = "DELETE FROM walkerRequest
				WHERE id='$requestId'";
		$res = $conn->query($que);
		return '{"code":1}';
	}
?>

