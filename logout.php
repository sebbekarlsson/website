<?php

	session_start();
	$_SESSION['userID'] = null;
	unset($_SESSION['userID']);

?>

<script>
	window.location.href="index.php";
</script>