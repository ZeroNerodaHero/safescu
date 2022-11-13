<?php
	include_once("../login.php");
	$que = "SELECT * FROM INRIXwalkers";

	echo "{";
	$res = $conn->query($que);
    if(!empty($res) && $res->num_rows > 0){
		echo '"returnCode": 1,"size":'.$res->num_rows.',';
		echo '"walkers":[';
		$counter = 1;
        while($row = $res->fetch_assoc()){
			$photoLnk = $row["photoLnk"];
			$fname = $row["fName"];
			$lname = $row["lName"];
			$age = $row["age"];
			$phone = $row["phoneNum"];
			$timeStart = $row["timeStart"];
			$timeEnd = $row["timeEnd"];
			$enRoute= $row["enRoute"];
			if($enRoute == null) $enRoute = false;

			echo '{"fName":"'.$fname.'",'.
				'"lName":"'.$lname.'",'.
				'"photoLnk":"'.$photoLnk.'",'.
				'"age":"'.$age.'",'.
				'"phoneNum":"'.$phone.'",'.
				'"timeStart":"'.$timeStart.'",'.
				'"enRoute":"'.($enRoute==false?"false":"true").'",'.
				'"timeEnd":"'.$timeEnd.'"}';
			if($counter < $res->num_rows) echo ",";
			$counter++;
		}
		echo "]";
	} else{
		echo '"response": 0';
	}
	echo "}";
?>
