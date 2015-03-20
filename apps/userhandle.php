<?php
	include("../modules/base/API.php");

	$mode = $_POST['mode'];

	if($mode == "register"){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];

		echo registerUser($email, $password, $password2, $firstname, $lastname);
	}


?>