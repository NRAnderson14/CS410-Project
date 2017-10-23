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