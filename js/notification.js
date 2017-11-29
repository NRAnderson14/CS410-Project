$(document).ready(function() {
	var user = $("#post-user").text();
	var path = "../";
	$("#user-hidden").hide();
	$(".notification-count").click(function(){
		var view = document.getElementById("notify-count").innerHTML;
		$(".loading").load(""+path+"profile/notifications.php", {"user" : user});
		var badge = document.getElementById("notify-count").innerHTML = "";
		document.getElementById("notify-count").classList.remove("badge");
		document.getElementById("notify-count").classList.remove("alert");
	});	
});