<?php
include('connection.php');
$myemail=$_COOKIE['user_email'];
$result=$db->users->findOne(['email'=>$myemail],['projection' => ['friendRequests' => 1, '_id' => 0]]);
//print_r($result);
?>

<!DOCTYPE html>
<html>
<head>
	<h1>YOUR FRIEND REQUESTS</h1>
	<body>
	<?php
			$i=0;
			foreach ($result as $document)
			{
				while($i < sizeof($document))
				{
					$email = $document[$i];
					$userdetail=$db->users->find(['email'=>$email]);
					foreach ($userdetail as $document1)
					{
						$fname=$document1['fname'];
						$lname=$document1['lname'];
					}
					echo $fname." ".$lname;
					?>
					<form action="" method="POST">
					<input type="hidden" name="email" value="<?php echo $email; ?>">
					<button type="submit" name="Confirm">Confirm</button>
					<button type="submit" name="Reject">Reject</button>
					<br><br>
					</form>
					<?php
					$i++;
				}
			}
			if($i==0)
				echo "no friend request";
	?>
</body>
</html>
<?php
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
}
?>