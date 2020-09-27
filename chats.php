<html>
<head>
	<h1>Your Chats</h1>
</head>
<body>
<?php
include('connection.php');
$myemail=$_COOKIE['user_email'];
$friendsfetch=$db->users->findOne(['email'=>$myemail],['projection' => ['friends' => 1, '_id' => 0]]);
$j=0;
foreach ($friendsfetch as $value) 
{
	$totalfriends=sizeof($value);
	while($j < $totalfriends)
	{
		$friendemail=$value[$j];
		$friendname=$db->users->find(['email'=>$friendemail]);
		foreach ($friendname as $document)
		{
			$name=$document['fname']." ".$document['lname'];
		}
		?>
		<table>
			<tr>
				<td><?php echo $name; ?></td>
				<td><button onclick="document.location.href='chat_window.php?friendemail=<?php echo $friendemail; ?>'">Message</button></td>
			</tr>
			<br>
			<br>
		</table>
		<?php
		$j++;
	}
}
?>
</body>
</html>
