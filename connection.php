<?php
	// This path should point to Composer's autoloader
		require 'vendor/autoload.php';

		// connect to mongodb
		$conn = new MongoDB\Client;
		
		$db = $conn->social;
?>