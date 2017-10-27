$(document).ready(function() {
    $(".accept").click(function () {
        var new_friend = $(this).attr('name').valueOf();
        $("#buttonarea").load("../friends/acceptfriend.php", {"friend" : new_friend});
    });

    $(".decline").click(function () {
        var denied_friend = $(this).attr('name').valueOf();
        $("#buttonarea").load("../friends/denyfriend.php", {"friend" : denied_friend})
    });
});