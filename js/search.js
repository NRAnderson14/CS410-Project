$(document).ready(function() {

	$("#searchButton").click(function(){
		var search = $("#searchBar").val();
		if(search == ""){
			alert("empty");
		}else{
			$(".load").load("search/query_search.php", {"search" : search});
		}
	});
	$("#searchBar").on('keypress', function(e){
		if(e.which === 13){
			var search = $("#searchBar").val();
			if(search ==""){

			}else{
				$(".load").load("search/query_search.php", {"search" : search});
			}
		}
	});
	$(function(){
		$(document).on( 'scroll', function(){
			if ($(window).scrollTop() > 100){
				$('.scroll-top-wrapper').addClass('show');
			}else{
				$('.scroll-top-wrapper').removeClass('show');
			}
			});
		$('.scroll-top-wrapper').on('click', scrollToTop);
	});
	function scrollToTop() {
		verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
		element = $('body');
		offset = element.offset();
		offsetTop = offset.top;
		$('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
	}


$(".advanced-search").hide();
var searchCount = 1;


$(".advanced-searchButton").click(function(){
	$(".advanced-search").animate({
		opacity:  1,
		left: 0,
		height: "toggle"
	}, 200, function(){
	if (searchCount === 1){
    $(".advanced-search").show();
		$("advanced-searchButton").removeClass("fa fa-angle-double-down").addClass("fa fa-angle-double-up");
		searchCount--;
	}
	else if (searchCount === 0){
		$(".advanced-search").hide();
		searchCount++;
	}
});
});
});
