<div class="backdrop" id="pop_login">
	<div class="popup shadow">
		<div class="navbar">
			<div class="navleft">
				<ul>
					<li>Login</li>
				</ul>
			</div>
		</div>
		<div class="text">
			<input class="intext input innershadow" type="email" id="login_email" placeholder="Email"><br>
			<input class="intext input innershadow" type="password" id="login_password" placeholder="Password"><br>
			<input class="btn blue" type="submit" id="login_login" value="Login">
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#login_login").click(function(){
		var login_email = $("#login_email").val();
		var login_password = $("#login_password").val();

		var request = $.ajax({
			type:"post",
			cache:false,
			url:"apps/userhandle.php",
			data:{mode:"login", email:login_email, password:login_password}
		});

		request.done(function(data){
			if(data == 1){
				window.location.href=".";
			}else{
				alert("Wrong password!");
			}
		});
	});
</script>