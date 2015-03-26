<?php

	include("modules/base/API.php");

	$IDS = [];

	$result = $db->query("SELECT * FROM images LIMIT 100");
	while(($row = $result->fetch()) != false){
		array_push($IDS, $row['imageID']);
	}

	$id = $IDS[rand(0,count($IDS))];

	echo "<script type='text/javascript'>window.location.href='image.php?imageID='+$id; </script>";

?>

