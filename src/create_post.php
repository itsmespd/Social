<!DOCTYPE html> 
<html>
	<head> 
		<title> 
			Create Post
		</title> 
	</head> 
	
	<body> 
		<h1>Post a status</h1>

		<form name="form1" action="create_post_action.php" method = "post" enctype="multipart/form-data"> 
			
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

	</body>
	
</html> 
