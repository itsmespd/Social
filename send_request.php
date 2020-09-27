<?php
include('connection.php');
$myemail=$_COOKIE['user_email'];
$type=$_GET['type'];
$friendemail=$_GET['mail'];
if ( $type == 'request' )
{
	$update1 = $db->users->updateOne(['email'=> $friendemail],array('$push' => array("friendRequests" => $myemail)));
	$myname=$db->users->find(['email'=>$myemail]);
			foreach ($myname as $docu)
			{
				$friend_name=$docu['fname']." ".$docu['lname'];
			}
	$update2 = $db->users->updateOne(['email'=> $friendemail],array('$push' => array('notifications' => 
													['notification'=>$friend_name.' has sent you a friend request',
													'link'=>"document.location.href='friend_requests.php'",
													'timestamp'=>new MongoDB\BSON\UTCDateTime
													])));
	if($update1->getModifiedCount()>0 and $update2->getModifiedCount()>0)
	{
		echo '<script type="text/javascript">
				alert("Friend Request Sent!");
			</script>';

		echo '<script type="text/javascript">
				window.location.href = "home_page.php";
			</script>';
	}
}

else if ( $type == 'cancel' )
{
	$update = $db->users->updateOne(['email'=> $friendemail],array('$pull' => array("friendRequests" => $myemail)));
	if($update->getModifiedCount()>0)
	{
		echo '<script type="text/javascript">
				alert("Friend Request Cancelled!");
			</script>';

		echo '<script type="text/javascript">
				window.location.href = "home_page.php";
			</script>';
	}
}

?>