<?php

	include("../modules/base/API.php");

	$imageID = $_POST['imageID'];
	$img = new Image($imageID);

	$comments = getComments($imageID);
	$DOMES = "";
	foreach($comments as $c){
		$text = $c['commentText'];
		$u = new User($c['userID']);
		$DOMES .= 
		"<div class='comment shadow'>
			<div class='text'>
				<p>$u->userFirstname:</p>
				<p>$text</p>
			</div>
		</div>";
	}

	$data = array(
			'image' => $img,
			'upvotes' => getVotes($imageID,1),
			'downvotes' => getVotes($imageID,0),
			'comments' => "$DOMES"
		);
	
	echo json_encode($data);

?>