<?php
	
	include("../modules/base/API.php");

	$data = $_POST['formObject'];
	$object = json_encode($data);
	$object = json_decode($object);

	if(strlen($object->input_comment) < 3){
		echo "Comment is too short!";
		return;
	}
	if(substr_count($object->input_comment, "<") > 0){
		echo "Bad comment!";
		return;
	}
	$db->query("INSERT INTO imagecomments (imageID, commentText, userID) VALUES($object->image_id, '$object->input_comment', $USER->userID)");
	

?>