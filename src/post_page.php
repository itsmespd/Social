</!DOCTYPE html>
<html>
<head>
	<title>Post Page</title>
</head>
<style>
.myDiv {
  border: 5px outset red;
  background-color: lightblue;    
  text-align: center;
}
</style>
<body>
<?php
$user_email=$_COOKIE['user_email'];
include('connection.php');
$postId=$_GET['postid'];
$postdetail=$db->posts->find(['_id'=> new MongoDB\BSON\ObjectId($postId)]);
$findlikes=$db->posts->findOne(['_id'=>new MongoDB\BSON\ObjectId($postId)],['projection' => ['likes' => 1, '_id' => 0]]);
$buttonval="Like";
$j=0;
foreach ($findlikes as $doc)
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
//echo $postId;
foreach ($postdetail as $value)
{
	$author=$value['author'];

	$authorname=$db->users->find(['email'=>$author]);
	foreach ($authorname as $docu)
	{
		$author_fname=$docu['fname'];
		$author_lname=$docu['lname'];
	}
	?>
	<div class="myDiv" onclick="document.location.href='post_page.php?postid=<?php echo $postID; ?>'"> 
	<table>
		<tr><td><b>
		<?php 
			echo $author_fname." ".$author_lname; 
		?>
		</b></td></tr>
		<?php
	if(empty($value['image']))
	{
		?>
		<tr><td>
		<?php 
			echo $value['text']; 
		?>
		</td></tr>
		<?php 
	}
	else if(empty($value['text']))
	{
		$postimgpath="user_uploads/userid_".$author."/".$value['image'];
		?>
		<tr><td>
			<img src="<?php echo $postimgpath; ?>" height='300' width='300' onclick="document.location.href='home_page.php'">
		</td></tr>
		<?php
	}
	else
	{
		$postimgpath="user_uploads/userid_".$author."/".$value['image'];
		?>
		<tr><td>
		<?php
			echo $value['text'];
		?>
		</td></tr>
		<br>
		<tr><td>
			<img src="<?php echo $postimgpath; ?>" height='200' width='200' onclick="document.location.href='home_page.php'">
		</td></tr>
		<?php
	}						
	$UTCDateTime=new MongoDB\BSON\UTCDateTime((string)$value['timestamp']);
	$DateTime=$UTCDateTime->toDateTime();
	$strdatetime=$DateTime->format('Y-m-d H:i:s');
	$timestamp=date('d/m/Y h:i A', strtotime($strdatetime. ' + 330 minutes')); 
	//echo $timestamp;
	?>
	<tr><td>
	<?php 
		echo $timestamp; 
	?>
	</td></tr>
	<tr><td>
	<?php
		 echo "	Likes >> ".$totallikes; 
	 ?>
	</td></tr>
	<form action="" method="POST">
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
	<?php
}
?>
	<div class="myDiv">
	<table>
		<tr><td>
		<form action="" method="POST">
			<textarea name="comment" onselect="document.location.href='home_page.php'" required></textarea>
			<input type="submit" name="Comment" value="Comment">
		</form>
		</td></tr>
	</table>
	</div>
	<?php
	$fetchcomments = $db->posts->aggregate
								(array(
									array('$match'=>array('_id'=>new MongoDB\BSON\ObjectId($postId))),

									array('$unwind'=>'$comments'),

									array('$project'=>array('_id'=>0,'comments'=>1)),

									array('$sort'=>array('comments.commenttimestamp'=>-1))

									// array('$limit' => 2)						
								));

	?>
	<div style="overflow:auto; height:250px;">
	<?php							
	foreach ($fetchcomments as $documentf) 
	{
		foreach ($documentf as $documentg) 
		{
			?>
			<div class="myDiv" >
			<table>
			<tr><td><b>
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
			</b></td></tr>
			<tr><td>
				<?php echo $documentg['comment']; ?>
			</td></tr>
			<tr><td>
			<?php 
				$UTCDateTime=new MongoDB\BSON\UTCDateTime((string)$documentg['commenttimestamp']);
				$DateTime=$UTCDateTime->toDateTime();
				$strdatetime=$DateTime->format('Y-m-d H:i:s');
				$timestamp=date('d/m/Y h:i A', strtotime($strdatetime. ' + 330 minutes')); 
				echo $timestamp; 
			?>
			</td></tr>
			</table>
			</div>
			<?php
		}
	}
?>
</div>
</body>
</html>

<?php

if(isset($_POST['LikeUnlike']))
{
	$btnval=$_POST['btnval'];
	if($btnval == "Like")
	{
		echo "	inside like pressed";
		$liked = $db->posts->updateOne(['_id'=>new MongoDB\BSON\ObjectId($postId)],array('$push' => array('likes' => $user_email)));
		if($liked->getModifiedCount()>0)
		{
			?>
			<script type="text/javascript">
					window.location.href = "post_page.php?postid=<?php echo $postId; ?>";
			</script>
			<?php		
		}
	}
	else
	{
		$unliked = $db->posts->updateOne(['_id'=>new MongoDB\BSON\ObjectId($postId)],array('$pull' => array('likes' => $user_email)));
		if($unliked->getModifiedCount()>0)
		{
			?>
			<script type="text/javascript">
					window.location.href = "post_page.php?postid=<?php echo $postId; ?>";
			</script>
			<?php
		}
	}	
}

if(isset($_POST['Comment']))
{
	$comment=$_POST['comment'];
	$commentID=time(); // append unique id with time
	$commentUpdate = $db->posts->updateOne(['_id'=>new MongoDB\BSON\ObjectId($postId)],array('$push' => array('comments' => 
													['id'=>$commentID,
													'email'=>$user_email,
													'comment'=>$comment,
													'commenttimestamp'=>new MongoDB\BSON\UTCDateTime
													])));

	if($commentUpdate->getModifiedCount()>0)
	{
		$fetchauthor=$db->posts->find(['_id'=>new MongoDB\BSON\ObjectId($postId)]);
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
		?>
		<script type="text/javascript">
			window.location.href = "post_page.php?postid=<?php echo $postId; ?>";
		</script>
		<?php
	}
}

?>