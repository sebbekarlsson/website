<?php

	include("../modules/base/API.php");

	$imageID = $_POST['imageID'];
	$img = new Image($imageID);

	$data = (object) array(
			'image' => $img,
			'upvotes' => getVotes($imageID,1),
			'downvotes' => getVotes($imageID,0)
		);
	
	echo json_encode($data, JSON_FORCE_OBJECT);

?>