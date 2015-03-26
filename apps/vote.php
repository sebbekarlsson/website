<?php

	include("../modules/base/API.php");

	$imageID = $_POST['imageID'];
	$mode = $_POST['voteMode'];
	$voted = hasVoted($USER->userID, $imageID);

	if(!$voted){
		$db->query("INSERT INTO imagevotes (imageID, userID, voteMode) VALUES($imageID, $USER->userID, $mode)");
	}else{
		echo 0;
	}


?>