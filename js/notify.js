$(document).ready(function() {
	var timer = setTimeout(notify, 2000){
		
	}
	function notify(){
		timer = setTimeout(notify, 2000);
		$(".loading").load(""+path+"profile/notifications.php", {"user" : user});
	}
});