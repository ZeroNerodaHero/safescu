<!DOCTYPE html>
<html>
<head>
	include_once("../login.php");
</head>
<body>
	<div id=queueLister>
		<?php
			$que = "SELECT * FROM walkerRequest";
			$res = $conn->query($que);
		    if(!empty($res) && $res->num_rows > 0){
        	while($row = $res->fetch_assoc()){
				$
			}
		?>
	<div>
</body>
</html>

