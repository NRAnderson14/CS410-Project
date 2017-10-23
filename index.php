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
		<div class="row small-up-2 medium-up-3 large-up-4">
			<div class="column column-block">
				<img src="https://placehold.it/600x400" class="thumbnail" alt="">
				<div style="padding-left: 10px;">
					<p>content 1</p>
					<p>content 1</p>
					<p>content 1</p>
					<p>content 1</p>
				</div>
			</div>
		</div>
		<hr>
			<a href="login/index.php">Log in here</a>
	</main>
<?php
	include "footer.php";
?>