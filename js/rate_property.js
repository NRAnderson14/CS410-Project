$(document).ready(function() {
    $(".rating-stars").mouseover(function() {
        $(".profileStar").mouseover(function () {
            changeStars($(this));
        });
    });

    $(".rating-stars").click(function () {
        var rating = getNumStarsSelected($(this));
        if ($(this).hasClass('property-rating')) {
            rateProperty(rating);
        } else if ($(this).hasClass('landlord-rating')) {
            rateLandlord(rating);
        }
        $(this).children().each(function (i, e) {
            $(e).css("color", "#f4d930");
        });
    });
});

function setStarEmpty(starToSetEmpty) {
    starToSetEmpty.removeClass();
    starToSetEmpty.addClass('fa fa-star-o profileStar');
}

function setStarFull(starToSetFull) {
    starToSetFull.removeClass();
    starToSetFull.addClass('fa fa-star profileStar');
}

function changeStars(starSelected) {
    setStarFull(starSelected);
    var previous = starSelected.prevAll();
    var next     = starSelected.nextAll();

    previous.each(function(i, e) {
        setStarFull($(e));
    });
    next.each(function (i, e) {
        setStarEmpty($(e));
    });
}

function getNumStarsSelected(allStars) {
    var count = 0;
    allStars.children().each(function (i, e) {
        if ($(e).hasClass("fa-star")) {
            count++;
        }
    });
    return count;
}

function getPropertyID() {
    var params = new URLSearchParams(window.location.search);
    return params.get("id");
}

function rateProperty(rating) {
    $.ajax({url: "rate.php",
            type: "POST",
            data: {itemtype: "property", rating: rating, pid: getPropertyID()}});
}

function rateLandlord(rating) {
    $.ajax({url: "rate.php",
        type: "POST",
        data: {itemtype: "landlord", rating: rating, pid: getPropertyID()}})
        .done(function(html) {
            console.log("done");
            $("#avail").append(html);
        });
}