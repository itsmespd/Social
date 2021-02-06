<?php
/*
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
*/
?>

<!DOCTYPE html> 

<html> 
	<head> 
		<title> 
			User Registration
		</title> 
	</head> 
	
	<body> 
		<h1>	Please enter the following details</h1>
		<form action = "registrationprocess.php" method = "post" enctype="multipart/form-data"> 
			
			<table> 
			<tr> 
				<label for="fname">Enter your first name:</label><br>
				<input type="text" id="fname" name="fname" required><br>
				<label for="lname">Enter your last name:</label><br>
				<input type="text" id="lname" name="lname" required><br>
				<div id="gender">
					<label for="gender">Choose your gender:</label><br>
					<input type="radio" id="male" name="gender" value="male" required>
					<label for="male">Male</label><br>
					<input type="radio" id="female" name="gender" value="female" required>
					<label for="female">Female</label><br>
					<input type="radio" id="other" name="gender" value="other" required>
					<label for="other">Other</label>
				</div>
				<label for="email">Enter your email:</label><br>
				<input type="email" id="email" name="email" required><br><br>
				<label for="dob">Date of Birth:</label><br>
				<input type="date" id="dob" name="dob" required><br><br>
				<label for="profilepic">Set your Password:</label>
				<input type="password" id="pwd" name="pwd" required><br><br>
				<label for="profilepic">Select a Profile Picture:</label>
				<input type="file" id="profilepic" name="dp" required><br><br> 
				<input type="submit" value="Submit" name="submit">
			</tr> 
			</table> 
		</form> 
		
	</body> 
</html>
	
	 
