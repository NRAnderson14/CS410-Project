<?php
    $path = '../';
    include $path . "header.php";
?>
<main>
    <div class="row">
        <div class="large-12 columns text-center">
            <h2>Find Friends</h2>
            <div id="searchArea" class="row" style="padding-right: 30px;">
                <div class="search-bar small-10 medium-10 large-10 small-centered medium-centered large-centered columns">
                    <input id="searchBar" type="text" class="searchTerm" name="search" placeholder="Search for a friend">
                    <button id="searchButton" type="submit" class="searchButton"><i class="fa fa-search"></i></button>
                </div>

            </div>
        </div>
    </div>
    <div id="resarea">

    </div>
</main>
<script src="<?php print($path . "js/friendsearch.js") ?>"></script>
<?php
    include $path . "footer.php";
?>