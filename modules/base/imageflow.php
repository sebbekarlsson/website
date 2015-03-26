<div class="flowarea innershadow">
	<button class="btn blue flowrefresh shadow">Refresh</button>
	<div class="imageflow">
	</div>
</div>
<script type="text/javascript">

	fetchFlow(100);

	$(".flowrefresh").click(function(){
		fetchFlow(100);
	});

	function fetchFlow(LIMIT){
		$(".imageflow").html("<div class='flowimg shadow' style='background-image:url(images/loadinggif.gif);'><div class='imgdrop'><span>Fetching...</span></div></div>");
		setTimeout(function(){
			var request = $.ajax({
				type:"post",
				cache:false,
				url:"apps/imageflow.php",
				data:{limit:LIMIT}
			});

			request.done(function(data){
				$(".imageflow").html(data);
				$(".flowimg").css("width","0px");
				$(".flowimg").css("height","0px");
				showImages();
			});
		},500);
	}

	function showImages() {
	  $images = $('.flowimg');

	  var time = 30;

	  $images.each(function() {
  		var img = $(this);
        setTimeout( function(){ 
        	img.animate({
        		width:"148px",
        		height:"148px"
        	},1000);
        }, time)
      	time += 30;
	  });
	}
</script>