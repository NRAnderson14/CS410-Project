//function to enable/disable the submit button based on the username field
//passes val to check_user.php to be checked in the database. If it exists in 
//the database, then the button stays disabled, otherwise, the button is enabled.
$(document).ready(function() {
	var valid = true;
	var val = "";
	$("input[type=submit]").attr("disabled","disabled");
	$(".username").change(function(){
		$.post("check_user.php","val=" + $(this).val(), function(response){
			val = response;
			//alert(val);
			if(val != 0){
				$("input[type=submit]").attr("disabled","disabled");
			}else{
				$("input[type=submit]").removeAttr("disabled");
			}
		});
		
	});
});