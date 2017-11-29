$(document).ready(function(){
	var username = $("#post-user").text();
	$("#post-load").load("getNewsFeed.php", {"username":username});
});