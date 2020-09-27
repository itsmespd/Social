<html>
<head>
	<h1>YOUR POSTS</h1>
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
include('connection.php');
$myemail=$_COOKIE['user_email'];
//echo $myemail;
echo nl2br("\n");
/*
?>
</body>
</html>
*/
$posts=$db->posts->find(['author'=>$myemail],['sort' => ['timestamp' => -1]]);
//print_r($posts);
			$i=0;
			foreach ($posts as $document)
			{	
					$postID = $document['_id'];
					$buttonval="Like";
					$totallikes=0;
					//finding if the like array already contains the email of user
					$findarray=$db->posts->findOne(['_id'=>new MongoDB\BSON\ObjectId($postID)],['projection' => ['likes' => 1, '_id' => 0]]);
					$j=0;
					foreach ($findarray as $document2)
					{
						$totallikes=sizeof($document2);
						//echo $totallikes;
						while($j < $totallikes)
						{
							if($myemail == $document2[$j])
							{
								$buttonval="Unlike";
								break;
							}
							$j++;
						}
						
					}
					//printing details of each post
					?>
						<div class="myDiv"> 
						<table>
						<?php
						if(empty($document['image']))
						{
							?>
							<tr>
								<td>
									<?php 
									echo $document['text']; 
									?>
								</td>
							</tr>
							<?php 
						}
						else if(empty($document['text']))
						{
							$postimgpath="user_uploads/userid_".$myemail."/".$document['image'];
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
							$postimgpath="user_uploads/userid_".$myemail."/".$document['image'];
							?>
							<tr>
								<td>
								<?php
									echo $document['text'];
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
						$UTCDateTime=new MongoDB\BSON\UTCDateTime((string)$document['timestamp']);
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
						</td></tr>
						</form>
						<tr>		
						<td>
							<form action="" method="POST">
								<input type="hidden" name="postid" value="<?php echo $postID; ?>">
								<textarea name="comment" required></textarea>
								<input type="submit" name="Comment" value="Comment">
							</form>
						</td>
						</tr>
						</table>
						</div>
						<br><br>
						<?php
					$i++;
			}
			if($i==0)
				echo "no posts made";
	?>
</body>
</html>

<?php
include('connection.php');
if(isset($_POST['LikeUnlike']))
{
	// echo "Like button Working";
	$btnval=$_POST['btnval'];
	$postID=$_POST['postid'];
	// echo $btnval;
	// echo $postID;

	if($btnval == "Like")
	{
		//echo "inside if Like";
		$liked = $db->posts->updateOne(['_id'=>new MongoDB\BSON\ObjectId($postID)],array('$push' => array('likes' => $myemail)));
		//echo getModifiedCount();
		if($liked->getModifiedCount()>0)
		{
			echo '<script type="text/javascript">
					alert("You Liked This Post !");
				</script>';
			echo '<script type="text/javascript">
					window.location.href = "user_post.php";
				</script>';
		}
	}
	else
	{
		//echo "inside if Unlike";
		$unliked = $db->posts->updateOne(['_id'=>new MongoDB\BSON\ObjectId($postID)],array('$pull' => array('likes' => $myemail)));
		if($unliked->getModifiedCount()>0)
		{
			echo '<script type="text/javascript">
					alert("You Unliked This Post !");
				</script>';
			echo '<script type="text/javascript">
					window.location.href = "user_post.php";
				</script>';
		}
	}	
}

if(isset($_POST['Comment']))
{
	$postID=$_POST['postid'];
	$comment=$_POST['comment'];
	$commentID=time();
	
	$commentUpdate = $db->posts->updateOne(['_id'=>new MongoDB\BSON\ObjectId($postID)],array('$push' => array('comments' => 
													['id'=>$commentID,
													'email'=>$myemail,
													'comment'=>$comment,
													'commenttimestamp'=>new MongoDB\BSON\UTCDateTime
													])));

	if($commentUpdate->getModifiedCount()>0)
	{
		echo '<script type="text/javascript">
				alert("Comment Posted!");
			</script>';

		echo '<script type="text/javascript">
				window.location.href = "user_post.php";
			</script>';
	}
}
?>