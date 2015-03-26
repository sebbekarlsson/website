<?php
	$db = new PDO('mysql:host=home.dev;dbname=imageforum', "root", "tango255", null);

	session_start();

	if(isLoggedin()){
		$USER = new User($_SESSION['userID']);
	}

	class User{
		var $userID;
		var $userEmail;
		var $userFirstname;
		var $userLastname;

		function __construct($userID){
			$this->userID = $userID;
			global $db;

			$result = $db->query("SELECT * FROM users WHERE userID=$userID");
			while(($row = $result->fetch()) != false){
				$this->userEmail = $row['userEmail'];
				$this->userFirstname = $row['userFirstname'];
				$this->userLastname = $row['userLastname'];
			}
		}
	}

	class Image{
		var $imageID;
		var $userID;
		var $imageFile;
		var $imageTitle;
		var $imageDesc;
		var $imageDate;

		function __construct($imageID){
			$this->imageID = $imageID;
			global $db;

			$result = $db->query("SELECT * FROM images WHERE imageID=$imageID");
			while(($row = $result->fetch()) != false){
				$this->userID = $row['userID'];
				$this->imageFile = $row['imageFile'];
				$this->imageTitle = $row['imageTitle'];
				$this->imageDesc = $row['imageDesc'];
				$this->imageDate = $row['imageDate'];
			}
		}
	}

	function getVotes($imageID, $mode){
		global $db;
		$votes = 0;
		$result = $db->query("SELECT * FROM imageVotes WHERE imageID=$imageID AND voteMode=$mode");
		while(($row = $result->fetch()) != false){
			$votes += 1;
		}
		return $votes;
	}

	function getComments($imageID){
		global $db;
		$comments = [];

		$result = $db->query("SELECT * FROM imageComments WHERE imageID=$imageID ORDER BY commentDate DESC");
		while(($row = $result->fetch()) != false){
			array_push($comments, $row);
		}

		return $comments;
	}

	function checkImage($image){
		return (strlen($image->imageFile) >= 3);
	}

	function getCurrentDate(){
		return Date("Y/m/d/h:i:s");
	}

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

	function checkPassword($email, $password){
		global $db;

		$result = $db->query("SELECT * FROM users");
		while(($row = $result->fetch()) != false){
			$realpassword = $row['userPassword'];
		}

		return ($password == $realpassword);
	}

	function getEmailUserID($email){
		global $db;

		$result = $db->query("SELECT userID FROM users WHERE userEmail='$email'");
		while(($row = $result->fetch()) != false){
			return $row['userID'];
		}
	}

	function randomString($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	function uploadImage($file, $dir, $output){
		$target_dir = $dir;
		if(!file_exists($target_dir)){mkdir($target_dir);}
		$target_file = $target_dir . $output;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($file["tmp_name"]);
		    if($check !== false) {
		        return "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        return "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    return "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($file["size"] > 900000000000) {
		    return "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    return "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($file["tmp_name"], $target_file)) {
		        return 1;
		    } else {
		        return 0;
		    }
		}
	}

	function hasVoted($userID, $imageID){
		global $db;
		$count = 0;
		$result = $db->query("SELECT * FROM imagevotes WHERE userID=$userID AND imageID=$imageID");
		while(($row = $result->fetchAll()) != false){
			$count++;
		}
		return ($count > 0);
	}


?>