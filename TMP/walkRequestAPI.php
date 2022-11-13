<?php
	include_once("../login.php");
	$que = "SELECT * FROM walkerRequest";
	$res = $conn->query($que);
	
	echo "{";
	if(!empty($res) && $res->num_rows > 0){
		$rSize = $res->num_rows;
		echo '"response":1,"size":'.$rSize.',';
		echo '"walkRequest":[';
		$counter = 1;
		while($row = $res->fetch_assoc()){
			$name = $row["name"];
			$info= $row["information"];
			$location = $row["location"];
			$time = $row["time"];

			echo '{"name":"'.$name
				.'","info":"'.$info.'",'.
				'"location":"'.$location
				.'","time":"'.$time.'"}';
			echo ($counter != $rSize)?",":"";
			$counter++;
		}
		echo "]";
		
	} else{
		echo '"response":0';
	}
	echo "}";
?>

