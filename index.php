<?php
	$path = "";
?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Rent Smart</title>
		<meta charset='utf-8'>
		<link rel="stylesheet" href=<?php print($path . "css/font-awesome/css/font-awesome.min.css") ?>>
		<link rel="stylesheet" href=<?php print($path . "css/foundation.css") ?> >
		<link rel="stylesheet" href=<?php print($path ."css/app.css") ?> >
		<link href="https://fonts.googleapis.com/css?family=Biryani:300,400,600,700,800,900|Roboto+Slab:400,700" rel="stylesheet">
		<link rel="stylesheet" href=<?php print($path. "css/foundation-icons.css") ?> >
		<link rel="stylesheet" href=<?php print($path ."css/customstyles.css") ?> >
		<script src=<?php print($path . "js/vendor/jquery.js") ?> ></script> 
		<script src=<?php print($path . "js/vendor/what-input.js") ?> ></script>
		<script src=<?php print($path . "js/vendor/foundation.js") ?> ></script>
		<script src=<?php print($path . "js/vendor/foundation.min.js") ?> ></script>
		<script src=<?php print($path . "js/app.js") ?> ></script>
	</head>
<?php
	include "login.php";
?>
	<main class="login">
		<div class="row">
			<div class="small-12 medium-12 large-12 small-centered medium-centered large-centered columns">
				<h1 align="center">Rent Smart</h1>
			</div>
		</div>
		<form action="" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
				<label>Username
					<input type="text" name="username" placeholder="Username" required>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
				<label>Password
					<input type="password" name="password" placeholder="Password" required>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
				<p><input type="submit" class="button expanded" value="Log in"></input></p>
				<p class="text-center"><a href="#">Don't have an account?</a></p>
			</div>
		</div>
		</form>
	</main>
<?php
	include 'footer.php';
?>
