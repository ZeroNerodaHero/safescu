<?php
	include_once("../login.php");
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$age = $_POST["age"];
	$phone = $_POST["phone"];
	$timeStart = $_POST["timeStart"];
	$timeEnd = $_POST["timeEnd"];
	$username= $_POST["username"];
	$password= $_POST["password"];
	$photo = $_POST["photo"];

	echo "$fname<br>$lname<br>$age<br>$phone<br>$timeStart<br>$timeEnd<br>";
	$que = "INSERT INTO INRIXwalkers(
				fname,lname,age,phoneNum,timeStart,timeEnd,userName,password,photoLnk)
			VALUES('$fname','$lname',$age,'$phone','$timeStart','$timeEnd',
					'$username','$password','$photo')";
	echo "<br>$que<br>";
	$conn->query($que);
?>

