<?php
	$path = "";
	include "header2.php";
	include "login/login.php";
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
				<p class="text-center"><a href="profile/create_profile/create_profile.php">Don't have an account?</a></p>
			</div>
		</div>
		</form>
	</main>
<?php
	include 'footer.php';
?>
