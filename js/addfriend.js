$(document).ready(function() {
    $("#addbutton").click(function() {
        var user_sent_to = $("#addbutton").attr('name');
        $("#burner").load("../friends/addfriend.php", {"sentto" : user_sent_to});
    });
});