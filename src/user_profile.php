<?php
/*include('database.php');
$sql = "SELECT * FROM profiles WHERE user_id = ".$_GET['uid'];
foreach($conn->query($sql) as $row)
{
	$uname=$row['user_name'];
	$uemail=$row['user_email'];
	$upwd=$row['user_password'];
	$udp=$row['user_prof_pic'];
}

echo $dppath;
*/
include('connection.php');

$email=$_GET['email'];
//$result=$db->users->findOne(['email'=>$email],['_id'=>ObjectID()]);
//$result=$db->users->find();
$result=$db->users->find(['email'=>$email]);
foreach ($result as $document)
{
	$fname=$document['fname'];
	$lname=$document['lname'];
	$dob=$document['dob'];
	$pwd=$document['pswd'];
	$dp=$document['dp'];
}
$dppath="user_uploads/userid_".$_GET['email']."/".$dp ;
//echo $dppath;
//echo $dob;
$currdate=date('Y-m-d');
$date1=date_create($dob);
$date2=date_create($currdate);
$diff=date_diff($date2,$date1);
$days=$diff->format("%a");
$age=floor($days/365);
echo $age;
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: middle;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }

}

.container {
  position: relative;
  max-width: 100%;
  margin: 0 auto;
}

.container img {vertical-align: middle;}

.container .content {
  position: absolute;
  bottom: 0;
  background: rgb(0, 0, 0); /* Fallback color */
  background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
  z-index: 10;
}
</style>
</head>
<body>

<h2 style="text-align:center" >My Profile</h2>

<form action="" method="post">
  <div class="imgcontainer">
    <img src=<?php echo $dppath ?> height='300' width='300' >
	
  </div>
  

	<center>
  <div class="container">
    <label for="fname"><b>First Name : <?php echo $fname; ?></b></label>
	<br><br>
	<label for="lname"><b>Last Name : <?php echo $lname; ?></b></label>
	<br><br>
	<label for="dob"><b>Date of Birth : <?php echo $dob; ?></b></label>
    <br><br>
	<label for="dob"><b>Email : <?php echo $email; ?></b></label>
	<br><br>
    <label for="pwd"><b>Password : </b></label>
    <input type="password" id="password" value="<?php echo $pwd; ?>" name="pwd" readonly>
	<input type="checkbox" onclick="myFunction()">Show Password

<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
    <br><br>
    
  </div>


  </center>
</form>
<button onclick="document.location.href='friend_requests.php'">My Friend Requests</button>

</body>
</html>
