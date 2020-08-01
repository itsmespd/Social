<?php
include('connection.php');
$usermail=$_COOKIE['user_email'];
$imageName = $_FILES["pic"]["name"];
echo $imageName;
/*

if (!empty($_POST['mytext']) and empty($_FILES['pic']['tmp_name']))
{ 
	echo "inside no photo +  text";	
		$result=$db->posts->insertOne([	'text'		=>$_POST['mytext'],
										'author'	=>$usermail,
										'timestamp'	=>new MongoDB\BSON\UTCDateTime,
										'likes'		=>0
										//'comments'	=>(array('id'=>"",'email'=>"",'comment'=>"",'commenttimestamp'=>""))
										]);	
										
		if($result->getInsertedCount()>0)
		{
			echo '<script type="text/javascript">
						alert("Post Uploaded");
				</script>';
			/*$objectID=$db->posts->findOne(['author'	=>$usermail, 'text'	=>$_POST['mytext']],['_id']);
			$db->users->updateOne(['email' => $usermail],'$set'=>[(array($objectID))]);
			if($result->getModifiedCount()>0)
			{	
				echo '<script type="text/javascript">
						alert("User Post Array Updated");
					</script>';
					
				echo '<script type="text/javascript">
						window.location.href = "home_page.php";
					</script>';
			//}
		}
		else
		{
			echo '<script type="text/javascript">
					alert("Error");
				</script>';
		}
	//}
}
elseif (!empty($_FILES['pic']['tmp_name']) and empty($_POST['mytext']))
{
	echo "inside photo + no text";
	/*
	$imageName = $_FILES["pic"]["name"];
	$upload_directory = "user_uploads/userid_".$usermail."/"; 
	$imagename=time().$imageName;
	if(move_uploaded_file($_FILES['pic']['tmp_name'], $upload_directory.$imagename))
	{    
		$result=$db->posts->insertOne([	'image'		=>$imagename,
										'author'	=>$usermail,
										'timestamp'	=>new MongoDB\BSON\UTCDateTime,
										'likes'		=>0,
										'comments'	=>['id','email','comment','commenttimestamp']
										]);
		
		if($result->getInsertedCount()>0)
		{
			echo '<script type="text/javascript">
						alert("Post Uploaded");
				</script>';
			$objectID=$db->posts->findOne(['author'=>$usermail, 'image'=>$imagename, ['_id']);
			$db->users->updateOne(['email' => $usermail],['postId'=>[$objectID]]);
			if($result->getModifiedCount()>0)
			{	
				echo '<script type="text/javascript">
						alert("User Post Array Updated");
					</script>';
				echo '<script type="text/javascript">
						window.location.href = "home_page.php";
					</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript">
					alert("Error");
				</script>';
		}
	}
	else
	{
		echo '<script type="text/javascript">
					alert("Error");
			</script>';
	}
	
}
elseif (isset($_POST['mytext']) and isset($_FILES['pic']['tmp_name']) )
{	
	echo "inside photo + text";
	/*
	$imageName = $_FILES["pic"]["name"];
	$upload_directory = "user_uploads/userid_".$usermail."/"; 
	$imagename=time().$imageName;
	if(move_uploaded_file($_FILES['pic']['tmp_name'], $upload_directory.$imagename))
	{    
		$result=$db->users->insertOne([	'text'		=>$_POST['mytext'],
										'image'		=>$imagename,
										'author'	=>$usermail,
										'timestamp'	=>new MongoDB\BSON\UTCDateTime,
										'likes'		=>0,
										'comments'	=>['id','email','comment','commenttimestamp']
		if($result->getInsertedCount()>0)
		{
			echo '<script type="text/javascript">
						alert("Post Uploaded");
				</script>';
			$objectID=$db->posts->findOne(['author'=>$usermail, 'image'=>$imagename, 'text'=>$_POST['mytext']], ['_id']);
			$db->users->updateOne(['email' => $usermail],['postId'=>[$objectID]]);
			if($result->getModifiedCount()>0)
			{	
				echo '<script type="text/javascript">
						alert("User Post Array Updated");
					</script>';
				echo '<script type="text/javascript">
						window.location.href = "home_page.php";
					</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript">
					alert("Error");
				</script>';
		}
	}
	else
	{
		echo '<script type="text/javascript">
					alert("Error");
			</script>';
	}
}
/*
//elseif (isset($_POST['post']) and !isset($_POST['mytext']) and !isset($_POST['pic']))
elseif (empty($_POST['mytext']) and empty($_FILES['pic']['tmp_name']))
{
	//at least one input is reqd
	echo '<script type="text/javascript">
					alert("Error ! at least one input is reqd");
			</script>';
	echo '<script type="text/javascript">
						window.location.href = "create_post.php";
					</script>';
}
*/
//print_r($_POST);
//echo $_POST['pic'];
if(empty($_POST['pic']) and empty($_POST['mytext']))
{
	echo "NO photo + NO text";
	//at least one input is reqd
	
	echo '<script type="text/javascript">
					alert("Error ! at least one input is reqd");
			</script>';
	echo '<script type="text/javascript">
						window.location.href = "create_post.php";
					</script>';
}
else
{
	if(empty($_POST['pic']) and !empty($_POST['mytext']))
	{
		echo "NO photo + ONLY text";
		
		$result=$db->posts->insertOne([	'text'		=>$_POST['mytext'],
										'author'	=>$usermail,
										'timestamp'	=>new MongoDB\BSON\UTCDateTime,
										'likes'		=>0
										//'comments'	=>(array('id'=>"",'email'=>"",'comment'=>"",'commenttimestamp'=>""))
										]);	
										
		if($result->getInsertedCount()>0)
		{
			echo '<script type="text/javascript">
						alert("Post Uploaded");
				</script>';
			/*$objectID=$db->posts->findOne(['author'	=>$usermail, 'text'	=>$_POST['mytext']],['_id']);
			$db->users->updateOne(['email' => $usermail],'$set'=>[(array($objectID))]);
			if($result->getModifiedCount()>0)
			{	
				echo '<script type="text/javascript">
						alert("User Post Array Updated");
					</script>';
					
				echo '<script type="text/javascript">
						window.location.href = "home_page.php";
					</script>';
			//}
			*/
			echo '<script type="text/javascript">
						window.location.href = "home_page.php";
					</script>';
				
		}
		else
		{
			echo '<script type="text/javascript">
					alert("Error");
				</script>';
		}			
	}
	elseif (!empty($_POST['pic']) and empty($_POST['mytext']))
	{
		echo "ONLY photo + NO text";
		$imageName = $_FILES["pic"]["name"];
		echo $imageName;
		/*
		$upload_directory = "user_uploads/userid_".$usermail."/"; 
		$imagename=time().$imageName;
		if(move_uploaded_file($_FILES['pic']['tmp_name'], $upload_directory.$imagename))
		{    
			$result=$db->posts->insertOne([	'image'		=>$imagename,
											'author'	=>$usermail,
											'timestamp'	=>new MongoDB\BSON\UTCDateTime,
											'likes'		=>0
											//'comments'	=>['id','email','comment','commenttimestamp']
											]);
			
			if($result->getInsertedCount()>0)
			{
				echo '<script type="text/javascript">
							alert("Post Uploaded");
					</script>';
				/*
				$objectID=$db->posts->findOne(['author'=>$usermail, 'image'=>$imagename, ['_id']);
				$db->users->updateOne(['email' => $usermail],['postId'=>[$objectID]]);
				if($result->getModifiedCount()>0)
				{	
					echo '<script type="text/javascript">
							alert("User Post Array Updated");
						</script>';
					
				}
				
				echo '<script type="text/javascript">
							window.location.href = "home_page.php";
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
		{
			echo '<script type="text/javascript">
						alert("Photo Upload Error");
				</script>';
		}
		*/
	}
	else
	{
		echo "BOTH photo AND text";		
		
		$imageName = $_FILES["pic"]["name"];
		$upload_directory = "user_uploads/userid_".$usermail."/"; 
		$imagename=time().$imageName;
		if(move_uploaded_file($_FILES['pic']['tmp_name'], $upload_directory.$imagename))
		{    
			$result=$db->users->insertOne([	'text'		=>$_POST['mytext'],
											'image'		=>$imagename,
											'author'	=>$usermail,
											'timestamp'	=>new MongoDB\BSON\UTCDateTime,
											'likes'		=>0
											//'comments'	=>['id','email','comment','commenttimestamp']
											]);
			if($result->getInsertedCount()>0)
			{
				echo '<script type="text/javascript">
							alert("Post Uploaded");
					</script>';
					/*
				$objectID=$db->posts->findOne(['author'=>$usermail, 'image'=>$imagename, 'text'=>$_POST['mytext']], ['_id']);
				$db->users->updateOne(['email' => $usermail],['postId'=>[$objectID]]);
				if($result->getModifiedCount()>0)
				{	
					echo '<script type="text/javascript">
							alert("User Post Array Updated");
						</script>';
					
				}
				*/
				echo '<script type="text/javascript">
							window.location.href = "home_page.php";
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
		{
			echo '<script type="text/javascript">
						alert("Photo Upload Error");
				</script>';
		}
		
	}
}

?>


