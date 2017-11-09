$(document).ready(function() {
	var user = document.getElementById("user-hidden").innerHTML;
	var path = document.getElementById("path-hidden").innerHTML;
	$("#user-hidden").hide();
	$(".notification-count").click(function(){
		var view = document.getElementById("notify-count").innerHTML;
		$(".loading").load(""+path+"profile/notifications.php", {"user" : user});
		document.getElementById("notify-count").innerHTML = "0";
	});
});