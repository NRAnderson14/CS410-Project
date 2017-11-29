$(document).ready(function(){
	var username = $("#post-user").text();
	$("#post-load").load("getNewsFeed.php", {"username":username});
	
	$("#post-button").click(function(){
		var value = $("#post-text").val();
		if(value == ""){
			
		}else{
			$("#post-load").load("newsFeed.php", {"username":username, "value":value});
		}
		location.reload();
	});
});