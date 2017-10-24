$(document).ready(function() {
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