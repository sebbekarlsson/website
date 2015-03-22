<?php include("modules/base/API.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="apps/jquery.js"></script>
		<script type="text/javascript" src="apps/popups.js"></script>
		<meta charset="utf-8">
	</head>

	<body>
		<?php include("modules/base/popups/register.php"); ?>
		<?php include("modules/base/popups/login.php"); ?>
		<?php include("modules/base/popups/upload.php"); ?>
		<?php include("modules/base/navbar.php"); ?>
		<div class="content">
			<?php include("modules/base/imageflow.php"); ?>
		</div>
	</body>

	<footer>
		<?php include("modules/base/footer.php"); ?>
	</footer>
</html>