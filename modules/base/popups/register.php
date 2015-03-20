<div class="backdrop" id="pop_register">
	<div class="popup shadow">
		<div class="navbar">
			<div class="navleft">
				<ul>
					<li>Register</li>
				</ul>
			</div>
		</div>
		<div class="text">
			<input class="intext input innershadow" type="email" id="register_email" placeholder="Email"><br>
			<input class="intext input innershadow" type="text" id="register_firstname" placeholder="Firstname"><br>
			<input class="intext input innershadow" type="text" id="register_lastname" placeholder="Lastname"><br>
			<input class="intext input innershadow" type="password" id="register_password1" placeholder="Password"><br>
			<input class="intext input innershadow" type="password" id="register_password2" placeholder="Confirm password"><br>
			<input class="btn blue" type="submit" id="register_register" value="Register">
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#register_register").click(function(){

		var reg_email = $("#register_email").val();
		var reg_pass1 = $("#register_password1").val();
		var reg_pass2 = $("#register_password2").val();
		var reg_firstname = $("#register_firstname").val();
		var reg_lastname = $("#register_lastname").val();

		var request = $.ajax({
			type:"post",
			url:"apps/userhandle.php",
			cache:false,
			data:{mode:"register", email:reg_email, password:reg_pass1, password2:reg_pass2, firstname:reg_firstname, lastname:reg_lastname}
		});

		request.done(function(data){
			alert(data);
			if(data == "ok"){
				window.location.href=".";
			}
		});
	});
</script>