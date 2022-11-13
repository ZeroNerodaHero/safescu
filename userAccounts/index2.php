<!DOCTYPE html>
<html>
<head>
<?php
	include_once("../login.php");
?>
</head>
<body>
	<div id=queueLister>
		<?php
			$que = "SELECT * FROM walkerRequest";
			$res = $conn->query($que);
		    if(!empty($res) && $res->num_rows > 0){
				while($row = $res->fetch_assoc()){
					$name = $row["name"];
					$info= $row["information"];
					$location = $row["location"];
					$time = $row["time"];

					echo "$name<br>$info<br>$location<br>$time";
					echo "<br>accept button<br>";
					echo "<br>---<br>";
				}
			}
		?>
	<div>
</body>
</html>

