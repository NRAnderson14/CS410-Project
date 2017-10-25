$(document).ready(function() {
	var city = "";
	if(google.loader.ClientLocation){
		city = google.loader.ClientLocation.address.city;
		$("#searchBar").val(city);
		$(".load").load("search/query_search.php", {"search" : city});
	}else{
		city = "Couldn't find your location";
	}
	
});