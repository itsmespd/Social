<?php
include('connection.php');
$myemail=$_COOKIE['user_email'];
$result=$db->users->findOne(['email'=>$myemail],['projection' => ['postIDs' => 1, '_id' => 0]]);
//print_r($result);
?>

<!DOCTYPE html>
<html>
<head>
	<h1>YOUR POSTS</h1>
	<body>
		<table>
	<?php
			$i=0;
			foreach ($result as $document)
			{
				while($i < sizeof($document))
				{
					$postID = $document[$i];
					$postdetail=$db->posts->find(['_id'=>$postID]);
					foreach ($postdetail as $document1)
					{
						if(empty($document1['image']))//$cursor = $db->posts->find(['_id'=>$postID]['image' => ['$exists' => false]]);
						{
							?>
							<tr>
								<td><?php echo $document1['text']; ?></td>
							</tr>
							<?php
						}
						else if(empty($document1['text']))
						{
							$postimgpath="user_uploads/userid_".$myemail."/".$document1['image'];
							?>
							<tr>
								<td><img src=<?php echo $postimgpath ?> height='200' width='200' ></td>
							</tr>
							<?php
						}
						else
						{
							$postimgpath="user_uploads/userid_".$myemail."/".$document1['image'];
							?>
							<tr>
								<td><?php echo $document1['text']; ?></td>
							</tr>
							<br>
							<tr>
								<td><img src=<?php echo $postimgpath ?> height='200' width='200' ></td>
							</tr>
							<?php
						}

						$UTCDateTime=new MongoDB\BSON\UTCDateTime((string)$document1['timestamp']);
						$DateTime=$UTCDateTime->toDateTime();
						$timestamp=$DateTime->format('d/m/Y h:i:s');
						?>
						<tr>
							<td><?php echo $timestamp; ?></td>
						</tr>
					<form action="" method="POST">
					<input type="hidden" name="email" value="<?php echo $email; ?>">
					<tr><td><button type="submit" name="LikeUnlike">Like/Unlike</button></td></tr>
					</form>
					
					</table>
					<br><br>
					<?php
					}
					$i++;
				}
			}
			if($i==0)
				echo "no posts request";
	?>
</body>
</html>
<?php
/*
if(isset($_POST['Confirm']))
{
	$update1 = $db->users->updateOne(['email'=> $myemail],array('$pull' => array("friendRequests" => $_POST['email'])));
	$update2 = $db->users->updateOne(['email'=> $myemail],array('$push' => array("friends" => $_POST['email'])));
	$update3 = $db->users->updateOne(['email'=> $_POST['email']],array('$push' => array("friends" => $myemail)));
	if($update1->getModifiedCount()>0 and $update2->getModifiedCount()>0 and $update3->getModifiedCount()>0)
	{
		echo '<script type="text/javascript">
				alert("Friend Request Accepted!");
			</script>';

		echo '<script type="text/javascript">
				window.location.href = "friend_requests.php";
			</script>';
	}
}
if(isset($_POST['Reject']))
{
	$update = $db->users->updateOne(['email'=> $myemail],array('$pull' => array("friendRequests" => $_POST['email'])));
	if($update->getModifiedCount()>0)
	{
		echo '<script type="text/javascript">
				alert("Friend Request Rejected!");
			</script>';

		echo '<script type="text/javascript">
				window.location.href = "friend_requests.php";
			</script>';
	}
}*/
?>