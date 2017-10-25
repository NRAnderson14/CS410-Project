$(document).ready(function() {
	if(google.loader.ClientLocation){
		contry_code = google.loader.ClientLocation.address.country_code;
		city = google.loader.ClientLocation.address.city;
		region = google.loader.ClientLocation.address.region;
		$("#searchBar").val(city);
		$(".load").load("search/query_search.php", {"search" : city});
	}else{
		city = "Cannot find your location";
	}
	
	$("#searchButton").click(function(){
		//$.post("query_search.php","val=" + $(this).val(), function(response){
			var search = $("#searchBar").val();
			if(search == ""){
				
			}else{
				$(".load").load("search/query_search.php", {"search" : search});
			}
			
		//});
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
});