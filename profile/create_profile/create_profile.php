<?php
	//form for creating an account
	$path = "../../";
	include "$path"."header.php";
	if(isset($_POST['submit'])){
		print "Submit clicked";
	}
?>
	<script src="../../js/check_user.js"></script> 
	<main style="margin-top: 20px;">
	
		<div class="row">
			<div class="small-12 medium-12 large-12 small-centered medium-centered large-centered columns">
				<h1 align="center">Create Profile</h1>
			</div>
		</div>
		<form class="signForm" action="create.php" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
				<label>First Name
					<input type="text" name="fname" placeholder="First Name" required>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
				<label>Last Name
					<input type="text" name="lname" placeholder="Last Name" required>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
				<label>Email
					<input type="email" name="email" placeholder="email@something.com" required>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
				<label>Username
					<input class="username" type="text" name="username" placeholder="Username" required>
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
				<label>Member Type
					<select name="membership_type">
						<option value="landlord">Landlord</option>
						<option value="tenant">Tenant</option>
					</select>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
				<p><input type="submit" class="button expanded" name="submit" value="Create"></input></p>
			</div>
		</div>
		<div class="row">
		</div>
		</form>
	</main>
<?php
	include "$path"."footer.php";
?>