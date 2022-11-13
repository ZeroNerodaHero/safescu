<?php
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
	if(0){
		error_reporting(-1);
		ini_set('display_errors',1);
	}

    $servername = "localhost";
    $user = "root";
    $pass = "password";
    $database = "INRIX";

    $conn = mysqli_connect($servername,$user,$pass,$database) 
        or die("can't connect to mySql");
?>
