
<?php

	include('connection.php');
	$searchinput=$_POST['searchbox'];
	$myemail=$_COOKIE['user_email'];
	echo $myemail;
	?>
		<form action="" method="post">
			<input type="text" placeholder="search friends....." value="<?php echo $searchinput ?>" name="searchbox" required>
			<input type="submit" Value="Search" name="search">
		</form>
	<?php

	$result = $db->users->find(array('$or'=>array(array('fname' => new \MongoDB\BSON\Regex(preg_quote($searchinput),'i')),
											    	array('lname' => new \MongoDB\BSON\Regex(preg_quote($searchinput),'i')))));
	

	if(isset($_POST['search']))
	{
		$count=0;
		foreach ($result as $document)
		{
			?>
			<table>
			<tr>
			<?php
			$fname=$document['fname']; $lname=$document['lname']; $email=$document['email'];
			$result1=$db->users->findOne(['email'=>$email],['projection' => ['friendRequests' => 1, '_id' => 0]]);
			$result2=$db->users->findOne(['email'=>$email],['projection' => ['friends' => 1, '_id' => 0]]);
			$flag=0;
			$i=0;
			foreach ($result1 as $document1)
			{
				//echo "----------- searching friendRequests array ------------";
				while(sizeof($document1) > $i)
				{
					//echo "Request from >> ".$document1[$i];
					if ( $document1[$i] == $myemail )
					{
						$flag=1;
						break;
					}
					$i++;
				}
			}
			$i=0;
			foreach ($result2 as $document2)
			{
				//echo "----------- searching friends array ------------";
				while(sizeof($document2) > $i)
				{
					//echo "Friends with >> ".$document2[$i];
					if ( $document2[$i] == $myemail )
					{
						$flag=2;
						break;
					}
					$i++;
				}
			}
			//echo "flag >> ".$flag;

			if ($flag==0 and $email!=$myemail)
			{
				?>
				<td ><?php echo $fname." ".$lname; ?></td>
				<td ><button onclick="document.location.href='send_request.php?mail=<?php echo $email; ?>&type=request'">Send Friend Request</button></td>
				</tr>
				<br>
				</table>
				<?php
				//echo "Not found";
			}
			elseif ($flag==1 and $email!=$myemail)
			{
				?>
				<td ><?php echo $fname." ".$lname; ?></td>
				<td ><button onclick="document.location.href='send_request.php?mail=<?php echo $email; ?>&type=cancel'">Cancel Friend Request</button></td>
				</tr>
				<br>
				</table>
				<?php
				//echo "Request found";
			}
			elseif ($flag==2 and $email!=$myemail)
			{
				?>
				<td ><?php echo $fname." ".$lname; ?></td>
				<td ><button>You are already friends</button></td>
				</tr>
				<br>
				</table>
				<?php
				//echo "Request found";
			}
			$count++;
		}	
	}
	if($count == 0)
		echo "No result found...!";
?>