<div class="backdrop" id="pop_upload">
	<div class="popup shadow">
		<div class="navbar">
			<div class="navleft">
				<ul>
					<li>Upload image</li>
				</ul>
			</div>
		</div>
		<div class="text">
			<form id="uploadform" method="post" enctype="multipart/form-data">
				<input type="text" class="intext input innershadow" name="upload_title" placeholder="Title"><br>
				<textarea name="upload_desc" rows="8" cols="64" class="innershadow input" placeholder="Description" style="font-size:100%;"></textarea><br>
				Select image to upload:
			    <input type="file" name="fileToUpload" id="file"><br><br>
			    <input type="submit" class="btn blue input" value="Upload Image" name="submit_uploadimage"><br>
		    </form>
		</div>
	</div>
</div>
<?php

	if(isset($_POST['submit_uploadimage'])){
		$title = $_POST['upload_title'];
		$desc = $_POST['upload_desc'];
		$file = $_FILES['fileToUpload'];

		$output = randomString(10).".png";

		$response = uploadImage($file, "uploads/", $output);

		if($response == 1){
			$db->query("INSERT INTO images (imageFile, imageTitle, imageDesc, userID) VALUES('$output', '$title', '$desc', $USER->userID);");
			echo "<script>alert('Upload complete!');</script>";
		}else{
			echo "<script>alert('Something went wrong!'); window.location.href='.';</script>";
		}

	}


?>

