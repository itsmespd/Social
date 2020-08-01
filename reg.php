<?php
// This path should point to Composer's autoloader
		require 'vendor/autoload.php';

		// connect to mongodb
		$c = new MongoDB\Client;
		
	   echo "\nConnection to database successfull";
echo nl2br("\n");
		$db = $c->rajesh->birthdays;
	   echo "\nDatabase and Collection selected";
	   /*
	   $var="db.find().pretty()"
	   foreach($db->query($sqlid) as $row)
	*/
	echo nl2br("\n");
	$cursor = $db->find();
	foreach ($cursor as $document) {
		echo nl2br($document['name']."\r\n");
	
}
/*
$arr="abc,fdffds,sdfdf fdsfsd,dfsdfds";
$a=explode(',',$arr);
echo $a[0];
*/	
?>
<!--
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
				<label for="name">Enter your full name:</label><br>
				<input type="text" id="name" name="name" required><br>
				<label for="email">Enter your email:</label><br>
				<input type="email" id="email" name="email" required><br><br>
				<label for="pwd">Set Password:</label><br>
				<input type="password" id="pwd" name="pwd" required><br><br>
				<label for="profilepic">Select a Profile Picture:</label>
				<input type="file" id="profilepic" name="dp" required><br><br> 
				<input type="submit" value="Submit" name="submit">
			</tr> 
			</table> 
		</form> 
		
	</body> 
</html>
	-->
	 
