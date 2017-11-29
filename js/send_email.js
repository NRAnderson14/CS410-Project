$(document).ready(function(){
	$("#email-button").click(function(){
		if($("#name").val()=="" || $("#email").val()=="" || $("#reason").val()=="" || $("#message").val()==""){
		}else{
			window.open('mailto:test@example.com');
		}
	});
});