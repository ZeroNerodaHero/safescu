<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form method="post" action="basicRequest.php">
	<label for="name">Name:</label><br>
	<input type="text" id="name" name="name"><br><br>
	<label for="request">Request:</label><br>
	<textarea id=requestInfo name=requestInfo></textArea>
	<label for="request">Current Location:</label><br>
	<textarea id=cLoc name=cLoc></textArea>
	<label for="request">Desitation:</label><br>
	<textarea id=destination name=destination></textArea>

	<input type="submit" value="Submit">
</form> 

</body>
</html>
