$(document).ready(function() {
    $('#searchButton').click(function() {
        var term = $('#searchBar').val();
        $('#resarea').load('friendsearch.php', {'search': term});
    });
    $('#searchBar').keypress(function(e) {
        if (e.which === 13) {
            var term = $('#searchBar').val();
            $('#resarea').load('friendsearch.php', {'search': term});
        }
    })
});