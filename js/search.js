$(document).ready(function() {
	$("#searchButton").click(function(){
		$.post("query_search.php","val=" + $(this).val(), function(response){
			
		});
	});
});