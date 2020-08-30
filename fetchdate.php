<?php
include('connection.php');
$result=$db->users->find();

foreach ($result as $document)
{
	//echo nl2br($document['name']."\r\n");
	$date=$document['dob'];
}
echo time();
echo $date;
echo nl2br("\n");
echo date('Y-m-d', strtotime($date. ' + 1 year + 1 day')); 

/*
$date= new MongoDB\BSON\UTCDateTime((String)$result['dob']);
$newDate= $date->toDateTime();
echo $newDate;
*/
?>