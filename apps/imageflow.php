<?php

	include("../modules/base/API.php");

	$limit = $_POST['limit'];

	$images = [];
	$result = $db->query("SELECT * FROM images ORDER BY imageDate DESC LIMIT $limit");
	while(($row = $result->fetch()) != false){
		array_push($images, $row);
	}

	for($i = 0; $i < count($images); $i++){

		$imageFile = $images[$i]['imageFile'];
		$title = $images[$i]['imageTitle'];
		$desc = $images[$i]['imageDesc'];
		$userID = $images[$i]['userID'];
		$imageID = $images[$i]['imageID'];
	
		$thumbnail = "apps/resizor.php?url=../uploads/$imageFile&width=128&height=128";

		

		?>
		<a href="image.php?imageID=<?php echo $imageID; ?>">
			<div class="flowimg shadow" style="background-image:url('<?php echo $thumbnail; ?>');">
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