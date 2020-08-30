<?php
	// This path should point to Composer's autoloader
		require 'vendor/autoload.php';

		// connect to mongodb
		$conn = new MongoDB\Client;
		
		$db = $conn->social;
		// header("Access-Control-Allow-Origin: *");
		// header('Access-Control-Allow-Headers: Content-Type');
		// $rest_json = file_get_contents("php://input");
		// $_POST = json_decode($rest_json, true);
?>