$(document).ready(function(){
	hidePopups();

	$(".pop").click(function(){
		var popid = $(this).attr("popid");
		showPopup(popid);
	});

	$(".popclose").click(function(){
		hidePopups();
	});

	$(".backdrop").click(function(){
		if (!($(this).find(".popup").is(":hover"))) {
			closePopups();
		}
	});

	function showPopup(id){
		var backdrop = $("#"+id);
		backdrop.fadeIn();
		backdrop.find(".popup").slideDown();
	}

	function hidePopups(){
		$(".backdrop").hide();
		$(".popup").hide();
	}

	function closePopups(){
		$(".popup").slideUp();
		$(".backdrop").fadeOut();
	}

});