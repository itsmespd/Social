<?php
include('connection.php');
$fname="Sam";
$lname="Ton";
//$age=25;
$gender="Male";
$email="xyz@example.com";
$pswd="sandipsirisg";
//$dob=date("d-m-Y");
$dob="1996-12-17";
$dp="";

//echo $dob;


$result=$db->users->insertOne(['fname'=>$fname,'lname'=>$lname,'age'=>$age,'gender'=>$gender,'email'=>$email,'psw'=>$pswd,'dob'=>Date($dob)]);
//$updateResult = $db->users->updateOne(['fname' => 'Sam'],['$set' => ['age' => 30]]);

//$deleteResult = $db->users->deleteOne(['fname' => 'Sam']);

//printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount())

	if($result->getInsertedCount()>0)
	//if($result->getModifiedCount()>0)
	//if($deleteResult->getDeletedCount())	
	{
		echo "Deleted Successful";
	}
	else
	{
		echo "Error";
	}


/*

// PHP program to add days to $Date 
  
// Declare a date 
$Date = "2019-05-10"; 
  
// Add days to date and display it 
echo date('Y-m-d', strtotime($Date. ' + 10 days')); 

*/
?>