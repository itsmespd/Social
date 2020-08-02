<!DOCTYPE html> 

<html> 
	<head> 
		<title> 
			Create Post
		</title> 
	</head> 
	
	<body> 
		<h1>Post a status</h1>

		<form name="form1" action="create_post_new.php" method = "post" enctype="multipart/form-data"> 
			
			<table> 
				<tr> 
					<label for="mytext">What's on your mind :</label><br>
					<textarea type="text" id="mytext" name="mytext" ></textarea><br>

					<label for="photo">Add Photo:</label>
					<input type="file" id="photo" name="pic" ><br><br> 
					
					<input type="submit" value="Post" name="Post">
				</tr>
			</table>
		</form>

		<!-- <script>
			function required()
				{
					var empt = document.forms["form1"]["mytext"].value;
					if (empt == "" && document.getElementById("photo").files.length == 0)
						{
							alert("Please say something or select a photo to post");
						}
					else if(empt!="" || document.getElementById("photo").files.length !=0)
						{
							// window.location.href = "create_post_new.php";
							// window.location.replace("create_post_new.php");
							// header("Location: create_post_new.php");

						}
				}
		</script> -->
	</body>
	
</html> 

<!-- if( document.getElementById("videoUploadFile").files.length == 0 ){
    console.log("no files selected");
}
function required()
{
var empt = document.forms["form1"]["text1"].value;
if (empt == "")
{
alert("Please input a Value");
return false;
}
else 
{
alert('Code has accepted : you can try another');
return true; 
}
} -->