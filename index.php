<?php
	$path = "";
	include "header.php";
	?>
	<script type="text/javascript" src="http://www.google.com/jsapi?key=AIzaSyAJ2rfLi6pkzdNI3AcpRGvtGPSx9ScHFgc"></script>
	<script src=<?php print($path . "js/search.js") ?> ></script>
	<script src=<?php print($path . "js/geolocation.js") ?> ></script>
	
	<main>
		<div class="top"></div>
		<div id="searchArea" class="row" style="padding-right: 30px;">
		<h1 id="title" class="small-10 medium-10 large-10 small-centered medium-centered large-centered" style="margin-top: 20px; margin-bottom: -60px; font-weight: bold;"> Rent Sm<span><i class="fa fa-home"></i></span>rt</h1>
		<h4 id="subtitle" class="small-10 medium-10 large-10 small-centered medium-centered large-centered" style="margin-top: 50px; margin-bottom: -40px; padding-left: 2px;">Renting made smarter.</h4>
			<div class="search-bar small-10 medium-10 large-10 small-centered medium-centered large-centered columns">
				<input id="searchBar" type="text" class="searchTerm" name="search" placeholder="Try typing 'Chicago'">
				<button id="searchButton" type="submit" class="searchButton"><i class="fa fa-search"></i></button>				
				
			</div>
		</div>
		<hr>
		
		<div class="load">
		<!--
			input property info here using database
		-->
		</div>
	</main>
	<div class="scroll-top-wrapper ">
		<span class="scroll-top-inner">
			<i class="fa fa-2x fa-arrow-circle-up"></i>
		</span>
	</div>
<?php
	include "footer.php";
?>