<?php
	$path = "";
	include "header.php";
?>
	<main>
		<div class="row" style="padding-right: 30px;">
			<div class="search-bar small-10 medium-10 large-10 small-centered medium-centered large-centered columns">
				<input type="text" class="searchTerm" name="search" placeholder="Search properties">
				<button type="submit" class="searchButton"><i class="fa fa-search"></i></button>				
			</div>
		</div>
		<hr>
		<!--
			input property info here using database
		-->
		<hr>
			<a href="login/index.php">Log in here</a>
	</main>
<?php
	include "footer.php";
?>