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