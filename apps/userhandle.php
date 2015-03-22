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
	else if($mode == "login"){
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(checkPassword($email, $password)){
			$userID = getEmailUserID($email);
			$_SESSION['userID'] = $userID;
			echo "1";
		}else{
			echo "0";
		}
	}


?>