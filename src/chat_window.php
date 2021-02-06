<html>
<head>
</head>
<style>
.myDiv {
  border: 5px outset red;
  background-color: lightgreen;    
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script> 
     window.onload=function () {
     var objDiv = document.getElementById("chatwindow");
     objDiv.scrollTop = objDiv.scrollHeight;
}
</script>
<body>
<button onclick="document.location.href='chats.php'">Back</button>
<?php
include('connection.php');
$myemail=$_COOKIE['user_email'];
echo $myemail;
echo nl2br("\n");
$friendemail=$_GET['friendemail'];
echo $friendemail;
echo nl2br("\n");
//$fetchchat=$db->chats->find([],['projection' => ['participants' => 1, '_id' => 1]]);
//print_r($fetchchat);
$found=0;
$fetchallchat=$db->chats->find();
foreach ($fetchallchat as $value) 
{
	$chatId=$value['_id'];

	$fetchmychat=$db->chats->findOne(['_id' => new MongoDB\BSON\ObjectId($chatId)],
									['projection' => ['participants' => 1, '_id' => 0]]);
	foreach ($fetchmychat as $key) 
	{
		if(($key[0] == $myemail and $key[1]== $friendemail) or ($key[1] == $myemail and $key[0]== $friendemail))
		{
			$found=1;
			break;
		}
	}
	if($found==1)
	{
		break;
	}
}
/*
if($found==0)
{
	echo "Chat Not Started Yet !";
	$result=$db->chats->insertOne([
									'participants'		=> array(),
									'messages'			=> array()
								]);
	$newchatId=$result->getInsertedId();
	$db->chats->updateOne(['_id'=>new MongoDB\BSON\ObjectId($newchatId)],
									array('$push' => array('participants' => $myemail)));
	$db->chats->updateOne(['_id'=>new MongoDB\BSON\ObjectId($newchatId)],
									array('$push' => array('participants' => $friendemail)));
} */

?>
<div id="chatwindow" style="overflow:auto; height:400px;">
<?php
if($found==1)
{
	$fecthmessages=$db->chats->findOne(['_id' => new MongoDB\BSON\ObjectId($chatId)],
											['projection' => ['messages' => 1, '_id' => 0]]);
	foreach ($fecthmessages as $message)
	{	
		foreach ($message as $data)
		{
			if($data['participant'] == $myemail)
			{
				?>
				<div class="myDiv" style="float:right";>
				<?php
			}
			//elseif($data['participant'] == $friendemail)
			else
			{
				?>
				<div class="myDiv" style="float:left";>
				<?php
			}
			?>
				<table>
				<tr>
					<td><?php echo $data['message']; ?></td>
				</tr>
				<tr>
					<td><?php 
						$UTCDateTime=new MongoDB\BSON\UTCDateTime((string)$data['timestamp']);
						$DateTime=$UTCDateTime->toDateTime();
						$strdatetime=$DateTime->format('Y-m-d H:i:s');
						$timestamp=date('d/m/Y h:i A', strtotime($strdatetime. ' + 330 minutes')); 
					 	echo $timestamp;  
					?></td>
				</tr>
				</table>
				</div>
				<br><br><br>
			<?php
		}
	}
}
?>
</div>
<br><br>
<div class="myDiv" style="float:right">
<table>
	<tr>		
		<td>
		<form action="" method="POST">
			<textarea name="message" rowa="4" cols="50" required></textarea>
			<input type="submit" name="send" value="Send">
		</form>
		</td>
	</tr>
	</table>
</div>

</body>
</html>

<?php
if(isset($_POST['send']))
{
	$message=$_POST['message'];
	if($found==0)
	{
		$result=$db->chats->insertOne([
										'participants'		=> array(),
										'messages'			=> array()
									]);
		$chatId=$result->getInsertedId();
		$db->chats->updateOne(['_id'=>new MongoDB\BSON\ObjectId($chatId)],
										array('$push' => array('participants' => $myemail)));
		$db->chats->updateOne(['_id'=>new MongoDB\BSON\ObjectId($chatId)],
										array('$push' => array('participants' => $friendemail)));
	}

	$chatupdate = $db->chats->updateOne(['_id'=>new MongoDB\BSON\ObjectId($chatId)],array('$push' => array('messages' => 
														['participant'=>$myemail,
														'message'=>$message,
														'timestamp'=>new MongoDB\BSON\UTCDateTime
														])));
	?>
	<script type="text/javascript">
			window.location.href="chat_window.php?friendemail=<?php echo $friendemail; ?>";
	</script>
	<?php
}

?>