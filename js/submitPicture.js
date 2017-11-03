$(document).ready(function() {
    console.log("js loaded");
    $("#pictureInput").on("change", function(){
        console.log("pic changed");
        $("#imageForm").submit();
    });
    

});