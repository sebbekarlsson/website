$(document).ready(function(){
	$(document).keydown(function(event){
    	if(event.which == 37){
    		nextImage();
    	}
    	else if(event.which == 39){
    		prevImage();
    	}
 	})

 	function nextImage(){
 		var id = window.location.href.split("imageID")[1].replace("=","");
    	var newID = parseInt(id)+1;
    	window.location.href = "image.php?imageID="+newID;
 	}

 	function prevImage(){
		var id = window.location.href.split("imageID")[1].replace("=","");
    	var newID = parseInt(id)-1;
    	window.location.href = "image.php?imageID="+newID;
 	}
});