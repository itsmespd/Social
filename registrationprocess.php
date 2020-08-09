<?php 		 
	header("Access-Control-Allow-Origin: *");
	header('Access-Control-Allow-Headers: Content-Type');
	$rest_json = file_get_contents("php://input");
	$_POST = json_decode($rest_json, true);

	include('connection.php');
	//$imageName = $_FILES["dp"]["name"];
	$imagename="default_profile_photo/photo.jpg";
if($_POST)
{
	$usermail=$_POST['email'];
	mkdir('user_uploads/userid_'.$usermail);  //This is the folder which is created for unique users
	$upload_directory = "user_uploads/userid_".$usermail."/"; 
	//$imagename=time().$imageName;
	//if(move_uploaded_file($imagename, $upload_directory."photo.jpg"))
	if(copy($imagename, $upload_directory."photo.jpg"))
	{    
		$result=$db->users->insertOne(['fname'	=>$_POST['firstName'],
										'lname'	=>$_POST['lastName'],
										'dob'	=>$_POST['dob'],
										'gender'=>$_POST['gender'],
										'email'	=>$usermail,
										'pswd'	=>$_POST['password'],
										'dp'	=>'photo.jpg',
									 	'friends' => array(),
										'friendRequests' => array()]);
		if($result->getInsertedCount()>0)
		{
			echo '<script type="text/javascript">
					alert("Registration Successful");
				</script>';
			echo '<script type="text/javascript">
					window.location.href = "user_profile.php?email='.$usermail.'";
				</script>';
		}
		else
		{
			echo '<script type="text/javascript">
					alert("Error");
				</script>';
		}
	}
	else
		echo "photo upload error";
}
?> 