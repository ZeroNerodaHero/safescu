<?php
	include_once("../login.php");
	$type = $_POST["requestType"];

	if($type == 0){
		//user submits a request for a walker
		//user submits name, requestinfo,origin,and destination
		//returns a walkeeSessionId
		$name = $_POST["name"];
		$requestInfo= $_POST["requestInfo"];
		$originLoc = $_POST["currentLocation"];
		$destination = $_POST["distination"];
		walkerAddRequest($name,$requestInfo,$originLoc,$destination);
	} else if($type == 1){
		//walkee want to check on if someone is dispatched
		//user submits a walkeeSessionId
		//returns a code(has request), and state is request is 1	
		$walkeeSessionId = $_POST["walkeeSessionId"];
		walkerGetSessionStatus($walkeeSessionId);
	} else if($type == 11){
		//walker logins in 
		//needs username and password
		//returns a code,userId,and sessionId
		$username = $_POST["username"];
		$password = $_POST["password"];
	} else if($type == 12){
		//walker accepts
		//needs userName and sessionId,requestId
		//returns a code
		$username = $_POST["username"];
		$sessionId = $_POST["sessionId"];
		$requestId = $_POST["requestId"];
	} else if($type == 13){
		//walker finishes request
		//needs userName and sessionId,requestId
		//returns a code
		$username = $_POST["username"];
		$sessionId = $_POST["sessionId"];
		$requestId = $_POST["requestId"];
	} 

	function walkerAddRequest($name,$requestInfo,$originLoc,$destination){
		global $conn;
		if(empty($name) || empty($requestInfo) || 
			empty($orignLoc) || empty($destination)){
			return '{"code":0}';
		} 
		$que = "INSERT INTO walkerRequest(name,information,location,destination)
				VALUES('$name','$requestInfo','$originLoc','$destination')";
		echo $que;
		$res = $conn->query($que);
		$last_id = $conn->insert_id;
		return '{"code": 1,"walkeeSessionId":$last_id}';
	}
	function walkerGetSessionStatus($walkeeSessionId);
?>

