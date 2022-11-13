<?php
	include_once("../login.php");
	$name = $_POST["name"];
	$requestInfo= $_POST["requestInfo"];

	echo "$name<br>$requestInfo";
	$que = "INSERT INTO walkerRequest(name,information)
			VALUES('$name','$requestInfo')";
	echo "<br>$que<br>";
	$conn->query($que);
?>

