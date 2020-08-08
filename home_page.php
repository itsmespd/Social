<html>
<body>
<?php
$user_email=$_COOKIE['user_email'];
include('connection.php');
$result=$db->users->find(['email'=>$user_email]);
foreach ($result as $document)
{
	$fname=$document['fname'];
	$lname=$document['lname'];
	/*$dob=$document['dob'];
	$pwd=$document['pswd'];
	$dp=$document['dp'];*/
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
	
	<br><br>
	<button onclick="document.location.href='create_post.php'">Post Something</button>
	<?php
}

?>
</body>
</html>

<?php

if(isset($_POST['logout']))
{
	setcookie("user_email", $uid, time()-(10*365*24*60*60), "/", "", 0);
	echo '<script type="text/javascript">
					window.location.href = "login.php";
				</script>';
}
?>