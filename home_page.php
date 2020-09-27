</!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<style>
.myDiv {
  border: 5px outset red;
  background-color: lightblue;    
  text-align: center;
}
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    $(document).ready(function(){
		 $("#div_refresh").load("load_feed.php");
        setInterval(function() {
            $("#div_refresh").load("load_feed.php");
        }, 1000);
    });
</script>
<body>
<div id="div_refresh"></div>
<?php
$user_email=$_COOKIE['user_email'];
include('connection.php');
$result=$db->users->find(['email'=>$user_email]);
foreach ($result as $document)
{
	$fname=$document['fname'];
	$lname=$document['lname'];
}
echo $fname." ".$lname." is logged in...!";
if(!empty($_COOKIE['user_email']))
{
	?>
	<form action="" method="post">
		<input type="submit" Value="Log Out" name="logout">
	</form>
	<button onclick="document.location.href='user_profile.php?email=<?php echo $user_email; ?>'">My Profile</button>
	<br>

<form action="searchresult.php" method="post">
	<input type="text" placeholder="search friends....." name="searchbox">
	<input type="submit" Value="Search" name="search">
</form>
<br>
	<button onclick="document.location.href='user_post.php'">My Posts</button>
	<button onclick="document.location.href='user_notifications.php'">Notifications</button>
	<button onclick="document.location.href='chats.php'">Chats</button>
	<br>
	<br><br>
	<button onclick="document.location.href='create_post.php'">Post Something</button>
	<?php
}
?>


<?php

if(isset($_POST['logout']))
{
	setcookie("user_email", $uid, time()-(10*365*24*60*60), "/", "", 0);
	echo '<script type="text/javascript">
					window.location.href = "login.php";
				</script>';
}
echo nl2br("\n");
// $filter  = [];
// $options = ['sort' => ['timestamp' => -1]];
// $db->posts->find($filter,$options);

$friends=$db->users->findOne(['email'=>$user_email],['projection' => ['friends' => 1, '_id' => 0]]);
$posts=$db->posts->find([],['author'=>1,'_id'=>0,'sort' => ['timestamp' => -1]]);
//print_r($posts);
foreach ($posts as $document1)
{
	$flag=0;
	//echo "inside foreach";
	//echo nl2br("\n");
	$author=$document1['author'];
	//echo $author;
	$i=0;
	foreach ($friends as $document2)
	{
		while(sizeof($document2) > $i)
		{
			if(($author==$document2[$i]) or ($author==$user_email))
			{
				$flag=1;
				break;
			}
			$i++;
		}
	}
	if($flag==1)
	{
			$friendname=$db->users->find(['email'=>$author]);
			foreach ($friendname as $docu)
			{
				$friend_fname=$docu['fname'];
				$friend_lname=$docu['lname'];
			}
			$friend_name=$friend_fname." ".$friend_lname;
			//print details of the post
			$postID = $document1['_id'];
			$postdetail=$db->posts->find(['_id'=>$postID]);
			$buttonval="Like";
			$totallikes=0;
			//finding if the like array already contains the email of user
			$findarray=$db->posts->findOne(['_id'=>$postID],['projection' => ['likes' => 1, '_id' => 0]]);
			$j=0;
			foreach ($findarray as $doc)
			{
				$totallikes=sizeof($doc);
				//echo $totallikes;
				while($j < $totallikes)
				{
					if($user_email == $doc[$j])
					{
						$buttonval="Unlike";
						break;
					}
					$j++;
				}	
			}
			foreach ($postdetail as $document3)
					{	
						?>
						<div class="myDiv" onclick="document.location.href='post_page.php?postid=<?php echo $postID; ?>'"> 
						<table>
							<tr>
								<td><b>
									<?php 
									echo $friend_name; 
									?></b>
								</td>
							</tr>

						<?php
						if(empty($document3['image']))
						{
							?>
							<tr>
								<td>
									<?php 
									echo $document3['text']; 
									?>
								</td>
							</tr>
							<?php 
						}
						else if(empty($document3['text']))
						{
							$postimgpath="user_uploads/userid_".$author."/".$document3['image'];
							?>
							<tr>
								<td>
									<img src="<?php echo $postimgpath; ?>" height='200' width='200' onclick="document.location.href='home_page.php'">
								</td>
							</tr>
							<?php
						}
						else
						{
							$postimgpath="user_uploads/userid_".$author."/".$document3['image'];
							?>
							<tr>
								<td>
								<?php
									echo $document3['text'];
								?>
								</td>
							</tr>
							<br>
							<tr>
								<td>
									<img src="<?php echo $postimgpath; ?>" height='200' width='200' onclick="document.location.href='home_page.php'">
								</td>
							</tr>
							<?php
						}						
						$UTCDateTime=new MongoDB\BSON\UTCDateTime((string)$document3['timestamp']);
						$DateTime=$UTCDateTime->toDateTime();
						$strdatetime=$DateTime->format('Y-m-d H:i:s');
						$timestamp=date('d/m/Y h:i A', strtotime($strdatetime. ' + 330 minutes')); 
						//echo $timestamp;
						?>
						<tr>
							<td>
								<?php 
									echo $timestamp; 
								?>
							</td>
						</tr>
						<tr>
							<td>
							<?php
								 echo "	Likes >> ".$totallikes; 
							 ?>
							 </td>
						</tr>
						<form action="" method="POST">
						<input type="hidden" name="postid" value="<?php echo $postID; ?>">
						<input type="hidden" name="btnval" value="<?php echo $buttonval; ?>">
						<tr><td>
							<input type="submit" name="LikeUnlike" value="<?php echo $buttonval; ?>">
						</td>
						</form>
					<!-- for printing delete post button for own posts -->
					<?php
					if($author == $user_email)
					{
						?>
						<form action="" method="POST">
						<input type="hidden" name="postid" value="<?php echo $postID; ?>">
						<td>
							<input type="submit" name="Delete" value="Delete Post">
						</td></tr>
						</form>
						<?php
					}
					?>
					</table>
				</div>
				<div class="myDiv">
						<table>
						<tr>		
						<td>
							<form action="" method="POST">
								<input type="hidden" name="postid" value="<?php echo $postID; ?>">
								<textarea name="comment" onselect="document.location.href='home_page.php'" required></textarea>
								<input type="submit" name="Comment" value="Comment">
							</form>
						</td>
						</tr>
						</table>
						</div>
						<?php
							$fetchcomments = $db->posts->aggregate(array(
																array('$match'=>array(
																	'_id'=>$postID
																)),

																array('$unwind'=>'$comments'),

																array('$project'=>array('_id'=>0,'comments'=>1)),

																array('$sort'=>array('comments.commenttimestamp'=>-1)),

																array('$limit' => 2)
														
															));
							
							foreach ($fetchcomments as $documentf) 
							{
								// echo sizeof($documentf);
								// print_r($documentf);
								foreach ($documentf as $documentg) 
								{
		
									?>
									<div class="myDiv">
										<table>
											<tr>
												<td><b>
													<?php 
														 $friendname=$db->users->find(['email'=>$documentg['email']]);
															foreach ($friendname as $docu)
															{
																$friend_fname=$docu['fname'];
																$friend_lname=$docu['lname'];
															}
															$friend_name=$friend_fname." ".$friend_lname;
															echo $friend_name; 
													?>
												</b>
											</td>
											</tr>
											<tr>
												<td>
													<?php echo $documentg['comment']; ?>
												</td>
											</tr>
											<tr>
												<td>
													<?php 
															$UTCDateTime=new MongoDB\BSON\UTCDateTime((string)$documentg['commenttimestamp']);
															$DateTime=$UTCDateTime->toDateTime();
															$strdatetime=$DateTime->format('Y-m-d H:i:s');
															$timestamp=date('d/m/Y h:i A', strtotime($strdatetime. ' + 330 minutes')); 
														 	echo $timestamp; 
													?>
												</td>
											</tr>
											</table>
											</div>
											<?php
										}
									}
									?>
						<br><br>
						<?php
				}

		}
}

?>
</body>
</html>
<?php

if(isset($_POST['LikeUnlike']))
{
	$btnval=$_POST['btnval'];
	$postID=$_POST['postid'];

	if($btnval == "Like")
	{
		//echo "inside if Like";
		$liked = $db->posts->updateOne(['_id'=>new MongoDB\BSON\ObjectId($postID)],array('$push' => array('likes' => $user_email)));
		//echo getModifiedCount();
		if($liked->getModifiedCount()>0)
		{
			// echo '<script type="text/javascript">
			// 		alert("You Liked This Post !");
			// 	</script>';
			echo '<script type="text/javascript">
					window.location.href = "home_page.php";
				</script>';
			
		}
	}
	else
	{
		//echo "inside if Unlike";
		$unliked = $db->posts->updateOne(['_id'=>new MongoDB\BSON\ObjectId($postID)],array('$pull' => array('likes' => $user_email)));
		if($unliked->getModifiedCount()>0)
		 {
		// 	echo '<script type="text/javascript">
		// 			alert("You Unliked This Post !");
		// 		</script>';
			echo '<script type="text/javascript">
					window.location.href = "home_page.php";
				</script>';
		}
	}	
}
if(isset($_POST['Comment']))
{
	$postID=$_POST['postid'];
	$comment=$_POST['comment'];
	$commentID=time(); // append unique id with time
	$commentUpdate = $db->posts->updateOne(['_id'=>new MongoDB\BSON\ObjectId($postID)],array('$push' => array('comments' => 
													['id'=>$commentID,
													'email'=>$user_email,
													'comment'=>$comment,
													'commenttimestamp'=>new MongoDB\BSON\UTCDateTime
													])));

	if($commentUpdate->getModifiedCount()>0)
	{
		
		// echo '<script type="text/javascript">
		// 		alert("Comment Posted!");
		// 	</script>';

		$fetchauthor=$db->posts->find(['_id'=>new MongoDB\BSON\ObjectId($postID)]);
		foreach ($fetchauthor as $document)
		{
			$author=$document['author'];
		}
		$myname=$db->users->find(['email'=>$user_email]);
		foreach ($myname as $document)
		{
			$name=$document['fname']." ".$document['lname'];
		}

		if($author != $user_email)
		{
			$update2 = $db->users->updateOne(['email'=> $author],
											array('$push' => array('notifications' => 
											['notification'=>$name.' has commented on your post',
											'link'=>"document.location.href='post_page.php?postid=$postsID'",
											'timestamp'=>new MongoDB\BSON\UTCDateTime
										])));
		}

		echo '<script type="text/javascript">
				window.location.href = "home_page.php";
			</script>';

	}
}

if(isset($_POST['Delete']))
{
	$postID=$_POST['postid'];
	$getPostImage= $db->posts->findOne(
    ['_id'=> new MongoDB\BSON\ObjectId($postID), 
    'image'=> ['$exists' => true]],['projection'=>['image'=>1,'_id'=>0]]);
    if(!empty($getPostImage['image']))
	{
		$imgpath='user_uploads/userid_'.$user_email.'/'.$getPostImage['image'];
		unlink($imgpath);
	}
	$deletePost=$db->posts->deleteOne(['_id'=> new MongoDB\BSON\ObjectId($postID)]);
	$deletePostId = $db->users->updateOne(['email'=> $user_email],
		array('$pull' => array("postIDs" => new MongoDB\BSON\ObjectId($postID))));

	if($deletePost->getDeletedCount()>0 and $deletePostId->getModifiedCount()>0)
	{
		
		echo '<script type="text/javascript">
				alert("Post Deleted!");
			</script>';

		echo '<script type="text/javascript">
				window.location.href = "home_page.php";
			</script>';

	}
}

?>