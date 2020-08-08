<?php 	
	//CORS	
	// header("Access-Control-Allow-Origin: *");
	// $rest_json = file_get_contents("php://input");
	// $_POST = json_decode($rest_json, true);

    // header('Access-Control-Allow-Origin: *');
    // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    // header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
    // header("Content-type:application/json");

 //    header('Access-Control-Allow-Origin: *');

	// header('Access-Control-Allow-Methods: GET, POST');

	// header("Access-Control-Allow-Headers: X-Requested-With");
	// header('Access-Control-Max-Age: 86400');

	function cors() {

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    echo "You have CORS!";
}

//     header('Content-Type: application/json; charset=utf-8');
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: PUT, GET, POST");
    $data = json_decode(file_get_contents("php://input"));
    print_r($data);
	//include('connection.php');
	//$imageName = $_FILES["dp"]["name"];
	// $usermail=$_POST['email'];
	// echo $usermail;
	// mkdir('user_uploads/userid_'.$usermail);  //This is the folder which is created for unique users
	// $upload_directory = "user_uploads/userid_".$usermail."/"; 
	// $imagename=time().$imageName;
	// if(move_uploaded_file($_FILES['dp']['tmp_name'], $upload_directory.$imagename))
	// {    
	// 	$result=$db->users->insertOne(['fname'	=>$_POST['fname'],
	// 									'lname'	=>$_POST['lname'],
	// 									'dob'	=>$_POST['dob'],
	// 									'gender'=>$_POST['gender'],
	// 									'email'	=>$usermail,
	// 									'pswd'	=>$_POST['pwd'],
	// 									'dp'	=>$imagename,
	// 								 	'friends' => array(),
	// 									'friendRequests' => array()]);
	// 	if($result->getInsertedCount()>0)
	// 	{
	// 		echo '<script type="text/javascript">
	// 				alert("Registration Successful");
	// 			</script>';
	// 		echo '<script type="text/javascript">
	// 				window.location.href = "user_profile.php?email='.$usermail.'";
	// 			</script>';
	// 	}
	// 	else
	// 	{
	// 		echo '<script type="text/javascript">
	// 				alert("Error");
	// 			</script>';
	// 	}
	// }
	
?> 