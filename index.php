<?php
	$path = "";
	include "header.php";
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	$rows = $db->query("SELECT address, price, name, email, phone, landlord FROM `properties`;");
?>
	<script src=<?php print($path . "js/search.js") ?> ></script>
	<main>
		<div class="row" style="padding-right: 30px;">
		<h1 id="title" class="small-10 medium-10 large-10 small-centered medium-centered large-centered" style="margin-top: 20px; margin-bottom: -60px; font-weight: bold;">Rent Smart</h1>
		<h4 class="small-10 medium-10 large-10 small-centered medium-centered large-centered" style="margin-top: 50px; margin-bottom: -40px; padding-left: 2px; font-style: italic;">Renting made smarter.</h4>
			<div class="search-bar small-10 medium-10 large-10 small-centered medium-centered large-centered columns">
				<input id="searchBar" type="text" class="searchTerm" name="search" placeholder="Search properties">
				<button id="searchButton" type="submit" class="searchButton"><i class="fa fa-search"></i></button>				
			</div>
		</div>
		<hr>
		<!--
			input property info here using database
		-->
		<div class="load">
		<div class="row small-up-2 medium-up-3 large-up-4">
		<?php
			foreach($rows as $row){
				$address=$row['address'];
				$price=$row['price'];
				$name=$row['name'];
				$email=$row['email'];
				$phone=$row['phone'];
				$landlord=$row['landlord'];
		?>
			<div class="column column-block">
				<p><?=$name?></p>
				<img src="https://placehold.it/600x400" class="thumbnail" alt="">
				<div style="padding-left: 10px;">
					<p>$<?=$price?></p>
					<p><?=$address?></p>
					<p><?=$email?></p>
					<p><?=$phone?></p>
				</div>
			</div>
		<?php
			}
		?>
		</div>
		</div>
		<hr>
			<a href="login/index.php">Log in here</a>
	</main>
<?php
	include "footer.php";
?>