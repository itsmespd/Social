<?php
include('connection.php');
$uid=$_POST['uid'];
$pwd=$_POST['pwd'];

$match=$db->users->count(['email'=>$uid, 'pswd'=>$pwd]);
if($match>0)
{
	setcookie("user_email", $uid, time()+(10*365*24*60*60), "/", "", 0); //cookie lifetime set for 10 years
	echo '<script type="text/javascript">
					alert("Login Successful");
				</script>';
	echo '<script type="text/javascript">
					window.location.href = "home_page.php";
				</script>';
}
else
{
	echo '<script type="text/javascript">
					alert("Invalid Credentials");
				</script>';
	echo '<script type="text/javascript">
					window.location.href = "login.php";
				</script>';
}
?>