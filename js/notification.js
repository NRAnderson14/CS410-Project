$(document).ready(function() {
	var user = document.getElementById("user-hidden").innerHTML;
	var path = document.getElementById("path-hidden").innerHTML;
	$("#user-hidden").hide();
	$(".notification-count").click(function(){
		var view = document.getElementById("notify-count").innerHTML;
		$(".loading").load(""+path+"profile/notifications.php", {"user" : user});
		var badge = document.getElementById("notify-count").innerHTML = "";
		document.getElementById("notify-count").classList.remove("badge");
		document.getElementById("notify-count").classList.remove("alert");
	});	
});