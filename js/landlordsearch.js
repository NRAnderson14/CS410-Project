$(document).ready(function() {
    $('#searchButton').click(function() {
        var term = $('#searchBar').val();
        $('#resarea').load('landlordsearch.php', {'search': term});
    });
    $('#searchBar').keypress(function(e) {
        if (e.which === 13) {
            var term = $('#searchBar').val();
            $('#resarea').load('landlordsearch.php', {'search': term});
        }
    });
    $('#searchBar').keyup(function() {
        var term = $('#searchBar').val();
        $('#resarea').load('landlordsearch.php', {'search': term});
    });
});