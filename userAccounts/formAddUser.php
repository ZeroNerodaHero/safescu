<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form method="post" action="basicBack.php">
	<label for="fname">First name:</label><br>
	<input type="text" id="fname" name="fname"><br>
	<label for="lname">Last name:</label><br>
	<input type="text" id="lname" name="lname"><br><br>
	<label for="lname">Age:</label><br>
	<input type="text" id="age" name="age"><br><br>
	<label for="lname">Phone Number</label><br>
	<input type="text" id="phone" name="phone"><br><br>
	<label for="lname">Time Start</label><br>
	<input type="time" id="timeStart" name="timeStart"><br><br>
	<label for="lname">Time End</label><br>
	<input type="time" id="timeEnd" name="timeEnd"><br><br>

	<label for="lname">photoLnk</label><br>
	<input type="text" id="photo" name="photo"><br><br>
	<label for="lname">username</label><br>
	<input type="text" id="username" name="username"><br><br>
	<label for="lname">Password</label><br>
	<input type="text" id="password" name="password"><br><br>

	<input type="submit" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
</html>
