<?php
	include('connection.php');
	$usermail=$_COOKIE['user_email'];
	$username=$db->users->find(['email'=>$usermail]);
	foreach ($username as $name)
	{
		$fname=$name['fname'];
		$lname=$name['lname'];
	}
	$myname=$fname." ".$lname;
	if(empty($_POST['mytext']) and filesize($_FILES['pic']['tmp_name'])==0)
		{
			echo '<script type="text/javascript">
								alert("Error ! At least one input is reqd");
							</script>';
			echo '<script type="text/javascript">
								window.location.href = "create_post.php";
							</script>';
		}

	else if (empty($_POST['mytext']))
		{
			if(filesize($_FILES['pic']['tmp_name'])!=0)
			{		
				$imageName = $_FILES["pic"]["name"];
				$upload_directory = "user_uploads/userid_".$usermail."/"; 
				$imagename=time().$imageName;
				if(move_uploaded_file($_FILES['pic']['tmp_name'], $upload_directory.$imagename))
				{
					$result=$db->posts->insertOne([	'image'		=>$imagename,
													'author'	=>$usermail,
													'timestamp'	=>new MongoDB\BSON\UTCDateTime,
													'likes'		=> array()
													//'comments'	=>array(['id'=>"",'email'=>"",'comment'=>"",'commenttimestamp'=>""],['id'=>"",'email'=>"",'comment'=>"",'commenttimestamp'=>""])
												]);
					$postsId= $result->getInsertedId();
					$friendsfetch=$db->users->findOne(['email'=>$usermail],
														['projection' => ['friends' => 1, '_id' => 0]]);
					$j=0;
					foreach ($friendsfetch as $value) 
					{
						$totalfriends=sizeof($value);
						while($j < $totalfriends)
						{
								$friendemail=$value[$j];
								$update2 = $db->users->updateOne(['email'=> $friendemail],
											array('$push' => array('notifications' => 
											['notification'=>$myname.' has posted something new',
											'link'=>"document.location.href='post_page.php?postid=$postsId'",
											'timestamp'=>new MongoDB\BSON\UTCDateTime
													])));
								$j++;
						}
					}

					if($result->getInsertedCount()>0)
					{
						$objectId = $result->getInsertedId();
						echo $objectId;
						$update = $db->users->updateOne(['email'=>$usermail],array('$push' => array("postIDs" => $objectId)));
						if($update->getModifiedCount()>0)
						{
							echo '<script type="text/javascript">
										alert("Post Uploaded");
								</script>';

							echo '<script type="text/javascript">
								window.location.href = "create_post.php";
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
								alert("Error uploading photo");
							</script>';
				}
			}
		}
	else if(!empty($_POST['mytext']))
		{
			if(filesize($_FILES['pic']['tmp_name'])==0)
			{
				//echo "Only text and no file wale mein ghusa hai";
				$result=$db->posts->insertOne([	'text'	=>$_POST['mytext'],
												'author'	=>$usermail,
												'timestamp'	=>new MongoDB\BSON\UTCDateTime,
												'likes'		=> array()
												//'comments'	=>array(['id'=>"",'email'=>"",'comment'=>"",'commenttimestamp'=>""],['id'=>"",'email'=>"",'comment'=>"",'commenttimestamp'=>""])
											]);
				$postsId= $result->getInsertedId();
					$friendsfetch=$db->users->findOne(['email'=>$usermail],
														['projection' => ['friends' => 1, '_id' => 0]]);
					$j=0;
					foreach ($friendsfetch as $value) 
					{
						$totalfriends=sizeof($value);
						while($j < $totalfriends)
						{
								$friendemail=$value[$j];
								$update2 = $db->users->updateOne(['email'=> $friendemail],
											array('$push' => array('notifications' => 
											['notification'=>$myname.' has posted something new',
											'link'=>"document.location.href='post_page.php?postid=$postsId'",
											'timestamp'=>new MongoDB\BSON\UTCDateTime
													])));
								$j++;
						}
					}

				if($result->getInsertedCount()>0)
					{
						$objectId = $result->getInsertedId();
						$update = $db->users->updateOne(['email'=>$usermail],array('$push' => array("postIDs" => $objectId)));

						if($update->getModifiedCount()>0)
						{
							echo '<script type="text/javascript">
										alert("Post Uploaded");
								</script>';

							echo '<script type="text/javascript">
								window.location.href = "create_post.php";
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
				//echo "both text and file wale mein ghusa hai";
				$imageName = $_FILES["pic"]["name"];
				$upload_directory = "user_uploads/userid_".$usermail."/"; 
				$imagename=time().$imageName;
				if(move_uploaded_file($_FILES['pic']['tmp_name'], $upload_directory.$imagename))
				{
					$result=$db->posts->insertOne([	'image'		=>$imagename,
													'text'		=>$_POST['mytext'],
													'author'	=>$usermail,
													'timestamp'	=>new MongoDB\BSON\UTCDateTime,
													'likes'		=> array()
													//'comments'	=>array(['id'=>"",'email'=>"",'comment'=>"",'commenttimestamp'=>""],['id'=>"",'email'=>"",'comment'=>"",'commenttimestamp'=>""])
												]);

					$postsId= $result->getInsertedId();
					$friendsfetch=$db->users->findOne(['email'=>$usermail],
														['projection' => ['friends' => 1, '_id' => 0]]);
					$j=0;
					foreach ($friendsfetch as $value) 
					{
						$totalfriends=sizeof($value);
						while($j < $totalfriends)
						{
								$friendemail=$value[$j];
								$update2 = $db->users->updateOne(['email'=> $friendemail],
											array('$push' => array('notifications' => 
											['notification'=>$myname.' has posted something new',
											'link'=>"document.location.href='post_page.php?postid=$postsId'",
											'timestamp'=>new MongoDB\BSON\UTCDateTime
													])));
								$j++;
						}
					}
					
					if($result->getInsertedCount()>0)
					{
						$objectId = $result->getInsertedId();
						echo $objectId;
						$update = $db->users->updateOne(['email'=>$usermail],array('$push' => array("postIDs" => $objectId)));
						if($update->getModifiedCount()>0)
						{
							echo '<script type="text/javascript">
										alert("Post Uploaded");
								</script>';

							echo '<script type="text/javascript">
								window.location.href = "create_post.php";
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
									alert("Error uploading photo");
								</script>';
					}

			}	
		}
?>