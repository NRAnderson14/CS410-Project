$(document).ready(function() {

	/*$("#searchButton").click(function(){
		var search = $("#searchBar").val();
		if(search == ""){
			alert("Search field empty");
		}else{
			$(".load").load("search/query_search.php", {"search" : search});
		}
	});*/

			$("#searchButton").click(function(){
				var priceMin = $("#minSearch").val();
				var priceMax = $("#maxSearch").val();
				var search = $('#searchBar').val();
				var numBeds = $('#numBeds').val();
				var numBedsSecond = 10;
				var numBaths = $('#numBaths').val();
				var numBathsSecond = 10;
				if (search == ""){
					alert("search field empty");
				}
					if(priceMin == ""){
						priceMin = 0;
					if( priceMax == ""){
							priceMax = 10000;
						}

					if(numBeds =="anyBed"){
						numBeds = 0;
					}

					if(numBaths =="anyBath"){
						numBaths = 0;
					}

						$(".load").load("search/query_search.php", {"search" : search, "priceMin" : priceMin, "priceMax" : priceMax,
						"numBeds" : numBeds, "numBedsSecond" : numBedsSecond, "numBaths" : numBaths, "numBathsSecond" : numBathsSecond});
					}else{
						$(".load").load("search/query_search.php", {"search" : search, "priceMin" : priceMin, "priceMax" : priceMax,
						"numBeds" : numBeds, "numBedsSecond" : numBedsSecond, "numBaths" : numBaths, "numBathsSecond" : numBathsSecond});
					}
				});


	$("#searchBar").on('keypress', function(e){
		if(e.which === 13){
			var priceMin = $("#minSearch").val();
			var priceMax = $("#maxSearch").val();
			var search = $('#searchBar').val();
			var numBeds = $('#numBeds').val();
			var numBedsSecond = 10;
			var numBaths = $('#numBaths').val();
			var numBathsSecond = 10;
			if (search == ""){
				alert("search field empty");
			}
				if(priceMin == ""){
					priceMin = 0;
				if( priceMax == ""){
						priceMax = 10000;
					}

				if(numBeds =="anyBed"){
					numBeds = 0;
				}

				if(numBaths =="anyBath"){
					numBaths = 0;
				}

					$(".load").load("search/query_search.php", {"search" : search, "priceMin" : priceMin, "priceMax" : priceMax,
					"numBeds" : numBeds, "numBedsSecond" : numBedsSecond, "numBaths" : numBaths, "numBathsSecond" : numBathsSecond});
				}else{
					$(".load").load("search/query_search.php", {"search" : search, "priceMin" : priceMin, "priceMax" : priceMax,
					"numBeds" : numBeds, "numBedsSecond" : numBedsSecond, "numBaths" : numBaths, "numBathsSecond" : numBathsSecond});
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
		$(".advanced-searchButton").find('i').removeClass('fa fa-angle-double-down')
		$(".advanced-searchButton").find('i').addClass('fa fa-angle-double-up')
		searchCount--;
	}
	else if (searchCount === 0){
		$(".advanced-searchButton").find('i').removeClass('fa fa-angle-double-up')
		$(".advanced-searchButton").find('i').addClass('fa fa-angle-double-down')
		$(".advanced-search").hide();
		searchCount++;
	}
});
});
});
