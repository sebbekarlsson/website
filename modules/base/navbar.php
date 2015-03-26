<div class="navbar">
	<div class="navleft">
		<ul>
			<li><a class="navbtn" href="index.php">Flow</a></li>
			<li><a class="navbtn" href="random.php">Random</a></li>
			<li><a class="navbtn" href="index.php">People</a></li>
		</ul>
	</div>
	<div class="navright">
		<ul>
			<?php
				if(!isLoggedin()){
					?>
					<li><a class="pop navbtn" popid="pop_login" href="#">Login</a></li>
					<li><a class="pop navbtn" popid="pop_register" href="#">Register</a></li>
					<?php
				}else{
					?>
					<li><?php echo $USER->userFirstname; ?></li>
					<li><a class="pop navbtn" popid="pop_upload" href="#">Upload</a></li>
					<li><a class="navbtn" href="#">Messages</a></li>
					<li><a class="navbtn" href="logout.php">Logout</a></li>
					<?php
				}
			?>
			<li><input class="intext innershadow rounded" name="q" placeholder="Search"></li>
		</ul>
	</div>
</div>