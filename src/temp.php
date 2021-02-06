<?php
//unlink('user_uploads/userid_xyz@abc.com/photo.jpg');
include('connection.php');
// $getPostImage = $db->posts->findOne(['_id'=>new MongoDB\BSON\ObjectId('5f34204887670000c0001305')],
// 										['projection'=>['$if'=>['$exists'=>['image'],'$then'=>['image']]]]);
// print_r($getPostImage);   5f32cfb88607000022002a57   5f34204887670000c0001305

$collection= $db->posts->findOne(
    ['_id'=> new MongoDB\BSON\ObjectId('5f34204887670000c0001305'), 
    'image'=> ['$exists' => true]],['projection'=>['image'=>1,'_id'=>0]]);
if(!empty($collection['image']))
{
	echo $collection['image'];
}
else
{
	echo "post contains no image";
}

?>