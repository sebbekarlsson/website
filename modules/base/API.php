<?php
	$db = new PDO('mysql:host=localhost;dbname=imageforum', "root", "root", null);

	session_start();

	function isLoggedin(){
		if(isset($_SESSION['userID']) || strlen($_SESSION['userID'] > 0)){
			return 1;
		}else{
			return 0;
		}
	}

	function isRegistered($email){
		global $db;
		$count = 0;
		$result = $db->query("SELECT * FROM users WHERE userEmail='$email'");
		while(($row = $result->fetchAll()) != false){
			$count++;
		}
		return $count;
	}

	function registerUser($email, $password, $password2, $firstname, $lastname){
		global $db;

		if(strlen($email) < 3){
			return "Email is too short!";
		}
		else if(strlen($password) < 3){
			return "Password is too short!";
		}
		else if(strlen($firstname) < 3){
			return "Firstname is too short!";
		}
		else if(strlen($lastname) < 3){
			return "Lastname is too short!";
		}
		else if(substr_count($email, "@") != 1){
			return "Email is not OK!";
		}
		else if($password != $password2){
			return "Passwords does not match!";
		}

		$db->query("INSERT INTO users (userEmail, userPassword, userFirstname, userLastname) VALUES('$email', '$password', '$firstname', '$lastname')");
		return "ok";
	}


?>