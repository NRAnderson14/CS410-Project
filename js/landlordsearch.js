$(document).ready(function() {
    $('#searchButton').click(function() {
        var term = $('#searchBar').val();
        console.log("search term is: " + term);
        $('#resarea').load('landlordsearch.php', {'search': term});
    });
    $('#searchButton').on('keypress', function(e) {
        if (e.which === 13) {
            var term = $("#searchBar").val();
            $(".load").load("landlordserach.php", {"search": term});
        }
    })
});