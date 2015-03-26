<?php include("modules/base/API.php"); ?>
<?php
	$imageID = $_GET['imageID'];
	$IMAGE = new Image($imageID);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="apps/jquery.js"></script>
		<script type="text/javascript" src="apps/popups.js"></script>
		<script type="text/javascript" src="apps/imageplay.js"></script>
		<meta charset="utf-8">
	</head>

	<body>
		<?php include("modules/base/popups/register.php"); ?>
		<?php include("modules/base/popups/login.php"); ?>
		<?php include("modules/base/popups/upload.php"); ?>
		<?php include("modules/base/navbar.php"); ?>
		<div class="content">
			<div class="text">
				<div class="imgroup innershadow">
					<?php

						for($i = 0; $i < 25; $i++){
							$ID = $imageID-($i);
							$img = new Image($ID);
							
							?>
								<a href="<?php echo 'image.php?imageID='.$ID; ?>"><div class="groupimg shadow" id="<?php if($imageID == $ID){echo 'selected';} ?>" style="background-image:url(uploads/<?php echo $img->imageFile ?>);">
								</div></a>
							<?php
						}

					?>
				</div>
				<div class="navbar rounded shadow pushed">
					<div class="navleft">
						<ul>
							<span id="image_data"></span>
						</ul>
					</div>
				</div>
				<script type="text/javascript">

						
					fetchImageData();

					setInterval(function(){
						fetchImageData();
					},1000);

					function fetchImageData(){
						var request = $.ajax({
							type:"post",
							cache:false,
							url:"apps/imagedata.php",
							data:{imageID:<?php echo $imageID; ?>}
						});

						request.done(function(data){
							var object = JSON.parse(data);

							var downvotes = object.downvotes;
							var upvotes = object.upvotes;
							var score = upvotes - downvotes;
							var totalvotes = downvotes + upvotes;

							$("#image_data").html("<li>Votes: "+totalvotes+"</li><li>Score: "+score+"</li>");
						});
					}

				</script>
				<div class="text innershadow">
					<div class="leftcontent">
						<div class="text">
							<img width="80%" src="uploads/<?php echo $IMAGE->imageFile; ?>">
						</div>
					</div>
					<div class="rightcontent">
						<div class="text">
							<?php
								echo "<h2>$IMAGE->imageTitle</h2>";
								echo $IMAGE->imageDesc;
							?>
						</div>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div class="navbar rounded shadow">
					<div class="navleft">
						<ul>
							<li><a class="navbtn green image_vote" mode="1" imageID="<?php echo $imageID; ?>" href="#">Upvote</a></li>
							<li><a class="navbtn red image_vote" mode="0" imageID="<?php echo $imageID; ?>" href="#">Downvote</a></li>
						</ul>
					</div>
					<div class="navright">
						<ul>
							<li><a class="navbtn" id="prevImage" href="#">Previous</a></li>
							<li><a class="navbtn" id="nextImage" href="#">Next</a></li>
						</ul>
					</div>
				</div>
				<script type="text/javascript">
					$(".image_vote").click(function(){
						var m = $(this).attr("mode");
						var id = $(this).attr("imageID");

						var request = $.ajax({
							type:"post",
							cache:false,
							url:"apps/vote.php",
							data:{voteMode:m, imageID:id},
							error:function(){alert("Could not perform this action! You might need to sign in first.");}
						});

						request.done(function(data){
							$(".image_vote").fadeOut();
						});
					});
				</script>
			</div>
			<div style="clear:both;"></div>
		</div>
	</body>

	<footer>
		<?php include("modules/base/footer.php"); ?>
	</footer>
</html>