<!DOCTYPE html> 

<html> 
	<head> 
		<title> 
			User Login
		</title> 
	</head> 
	
	<body> 
		<h1>User Login</h1>
		<form action = "loginaction.php" method = "post">
			User ID	:	<input type="text" id="userid" name="uid"><br><br>
			Password	:	<input type="password" id="password" name="pwd"><br><br>
			<input type="checkbox" onclick="myFunction()">Show Password<br><br>
			<input type="submit" value="Login" name="login">
			<script>
			function myFunction() {
				var x = document.getElementById("password");
				if (x.type === "password") {
					x.type = "text";
				} 
				else {
					x.type = "password";
				}
			}
			</script>
		</form>
	</body>
</html>