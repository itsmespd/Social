<?php 	
	
	header("Access-Control-Allow-Origin: *");
	header('Access-Control-Allow-Headers: Content-Type');
	$rest_json = file_get_contents("php://input");
	$_POST = json_decode($rest_json, true);

	// echo "inside index.php";

	if($_POST)
		{
			echo $_POST['dob'];
		}
?> 