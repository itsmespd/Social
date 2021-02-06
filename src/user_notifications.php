<!DOCTYPE html>
<html>
<head>
	<title></title>
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

//////////////////////////
// dont mess with the code 
$data = $db->users->aggregate(array(
	array('$match'=>array(
		'email'=>$myemail
	)),

	array('$unwind'=>'$notifications'),

	array('$project'=>array('_id'=>0,'notifications'=>1)),

	array('$sort'=>array(
		'notifications.timestamp'=>-1
	))
));
///////////////////////////

foreach ($data as $document1) 
{
	//echo $document1['link'];
	foreach ($document1 as $document) 
	{
		?>
		<div class="myDiv" onclick="<?php echo $document['link']; ?>"> 
		<table>
		<tr>
			<td><b>
				<?php 
					 echo $document['notification']; 
				?></b>
			</td>
		</tr>
		<tr>
			<td><b>
				<?php 
						$UTCDateTime=new MongoDB\BSON\UTCDateTime((string)$document['timestamp']);
						$DateTime=$UTCDateTime->toDateTime();
						$strdatetime=$DateTime->format('Y-m-d H:i:s');
						$timestamp=date('d/m/Y h:i A', strtotime($strdatetime. ' + 330 minutes')); 
					 	echo $timestamp; 
				?></b>
			</td>
		</tr>
		</table>
		</div>
		<br>
		<?php 
	}					
 }
?>
</body>
</html>