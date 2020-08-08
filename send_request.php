<?php
include('connection.php');
$myemail=$_COOKIE['user_email'];
$type=$_GET['type'];
$friendemail=$_GET['mail'];
if ( $type == 'request' )
{
	$update = $db->users->updateOne(['email'=> $friendemail],array('$push' => array("friendRequests" => $myemail)));
	if($update->getModifiedCount()>0)
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