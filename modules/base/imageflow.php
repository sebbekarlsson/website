<div class="imageflow innershadow">
<?php

	$images = [];
	$result = $db->query("SELECT * FROM images");
	while(($row = $result->fetch()) != false){
		array_push($images, $row);
	}

	for($i = 0; $i < count($images); $i++){

		$imageFile = $images[$i]['imageFile'];
		$title = $images[$i]['imageTitle'];
		$desc = $images[$i]['imageDesc'];
		$userID = $images[$i]['userID'];

		?>
		<a href="#">
			<div class="flowimg shadow" style="background-image:url('uploads/<?php echo $imageFile; ?>');">
				<div class="imgdrop">
					<span>
						<?php echo $title; ?>
					</span>
				</div>
			</div>
		</a>
		<?php
	}	
?>
<div style="clear:both;"></div>
</div>