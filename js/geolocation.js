$(document).ready(function() {
	var city = "";
	if(google.loader.ClientLocation){
		city = google.loader.ClientLocation.address.city;
		state = google.loader.ClientLocation.address.region;
		$("#searchBar").val(city + ", " + state);
		$(".load").load("search/query_search.php", {"search" : city + ", " + state});
	}else{
		city = "Couldn't find your location";
	}
	
});