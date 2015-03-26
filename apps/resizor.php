<?php

	header('content-type: image/jpg');
	
	$url = $_GET['url'];
	$w = $_GET['width'];
	$h = $_GET['height'];
	$data = base64_encode(file_get_contents($url));
	$imageready = base64_decode($data);

	/*===================================================================================
	Output goes here!
	====================================================================================*/
	resizeImage($url,$w,$h);

	/*===================================================================================
	Resize images to certain scale!
	====================================================================================*/
	function resizeImage($file, $width, $height){
		$newwidth = $width;
		$newheight = $height;
		list($width, $height) = getimagesize($file);

		$thumb = imagecreatetruecolor($newwidth, $newheight);
		$source = imagecreatefromjpeg($file);

		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		imagejpeg($thumb);
	}

?>