<?php 		 
	include('connection.php');
	$imageName = $_FILES["dp"]["name"];
	$usermail=$_POST['email'];
	mkdir('user_uploads/userid_'.$usermail);  //This is the folder which is created for unique users
	$upload_directory = "user_uploads/userid_".$usermail."/"; 
	$imagename=time().$imageName;
	if(move_uploaded_file($_FILES['dp']['tmp_name'], $upload_directory.$imagename))
	{    
		$result=$db->users->insertOne(['fname'	=>$_POST['fname'],
										'lname'	=>$_POST['lname'],
										'dob'	=>$_POST['dob'],
										'gender'=>$_POST['gender'],
										'email'	=>$usermail,
										'pswd'	=>$_POST['pwd'],
										'dp'	=>$imagename,
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
	
	
	
			/*
			include('database.php');
			
			//generating unique user ID
			$sqlid=" SELECT user_id FROM profiles ";
			$i=1;
			foreach($conn->query($sqlid) as $row)
			{
				if($row['user_id'] == $i)
				{
					$i++;
				}
				else
				{
					break;
				}
			}
			$user_id=$i;	
			//end of creating unique user ID
			
			$imageName = $_FILES["dp"]["name"];
			//$imageType = $_FILES["dp"]["type"];
			mkdir('user_uploads/userid_'.$user_id);
			$upload_directory = "user_uploads/userid_".$user_id."/"; //This is the folder which is created for unique users
			$imagename=time().$imageName;
			echo $imagename;
			if(move_uploaded_file($_FILES['dp']['tmp_name'], $upload_directory.$imagename))
			{    
				$sql="INSERT INTO profiles (user_id, user_name, user_email, user_password, user_prof_pic) VALUES ('$user_id', '".$_POST['name']."', '".$_POST['email']."', '".$_POST['pwd']."', '$imagename' )";
				$conn->exec($sql);
			}
			$conn=null;
			echo '<script type="text/javascript">
							alert("Registration Successful");
						</script>';
			echo '<script type="text/javascript">
							window.location.href = "user_profile.php?uid='.$user_id.'";
						</script>';
						
			*/
?> 