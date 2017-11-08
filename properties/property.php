<?php
	$path = "../";
	include $path."header.php";
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	if(isset($_GET['id'])){
		$property_id=$_GET['id'];
	}
	$rows = $db->query("SELECT address, city, state, country, zip, monthly_cost, landlord, is_available, beds, baths, water_included, electricity_included, heat_included, trash_included, features, parking FROM properties WHERE property_id = '$property_id';");
	foreach($rows as $row){
		$address = $row['address'];
		$city = $row['city'];
		$state = $row['state'];
		$country = $row['country'];
		$zip = $row['zip'];
		$price = $row['monthly_cost'];
		$landlord = $row['landlord'];
		$is_available = $row['is_available'];
		$bedNum = $row['beds'];
		$bathNum = $row['baths'];
		$water_included = $row['water_included'];
		$electricity_included = $row['electricity_included'];
		$heat_included = $row['heat_included'];
		$trash_included = $row['trash_included'];
		$features = $row['features'];
		$parking = $row['parking'];
	}
	if($water_included == 1){
		$water_included = "YES";
	}else{
		$water_included = "NO";
	}
	if($electricity_included == 1){
		$electricity_included = "YES";
	}else{
		$electricity_included = "NO";
	}
	if($heat_included == 1){
		$heat_included = "YES";
	}else{
		$heat_included = "NO";
	}
	if($trash_included == 1){
		$trash_included = "YES";
	}else{
		$trash_included = "NO";
	}
	if($bathNum > 1){
		$bath = "Bathrooms";
	}else{
		$bath = "Bathroom";
	}
	if($bedNum > 1){
		$bed = "Bedrooms";
	}else{
		$bed = "Bedroom";
	}

	//Get the landlord's info
	$landlord_stmt = $db -> prepare('SELECT IFNULL(company_name, fname) AS name1, IFNULL(lname, 1) AS name2, public_email, phone, username FROM landlords WHERE username = :landlord;');
    $landlord_stmt -> execute(['landlord' => $landlord]);
    $landlord_info = $landlord_stmt -> fetch(PDO::FETCH_ASSOC);

	$landlord_username= $landlord_info['username'];
    $email = $landlord_info['public_email'];
    $phone = $landlord_info['phone'];

    if ($landlord_info['name2'] == 1) { //They have a company name
        $landlord = $landlord_info['name1'];
    } else {    //First and last name
        $landlord = $landlord_info['name1'] . ' ' . $landlord_info['name2'];
    }

    //Get the property images
    $imgs_stmt = $db -> prepare('SELECT image_url FROM property_images WHERE property_id = :id;');
    $imgs_stmt -> execute(['id' => $property_id]);
    $imgs = $imgs_stmt -> fetchAll();
    //Assuming the first image is the banner for the property
    $img = $imgs[0]['image_url'];
	
	//Get landlord rating
	$rating_stmt = $db->query("SELECT AVG(user_rating) as 'rating' FROM landlord_ratings WHERE username = '$landlord_username';");
	foreach($rating_stmt as $rate){
		$rating = $rate['rating'];
	}
	$rating = round($rating);
	?>
	<div class="upperBackground"></div>
	<div class="row text-center" id="profileHeader">
		<div class="large-12 columns">
			<div class="row column text-center">
			<h1 class="white"><?=$address?></h1>
			
		</div>
			<div style="margin-top: 50px;" class="hide-for-large">
				<a href=""><img src="<?= $path . $img ?>" alt="Profile Picture" id="profilePicture"></a>
				
			</div>
			<div class="show-for-large">
				<a href=""><img src="<?= $path . $img ?>" alt="Profile Picture" id="profilePicture"></a>
			</div>
			<h6 id="userName">Current Landlord:</h6>
			<h4 id="userName"><?= $landlord ?></h4>
				<?php
					if($is_available == 1){
						print "<h5 style='color: green; font-weight: bold;'>AVAILABLE FOR RENT</h5>";
					}elseif($is_available == 0){
						print "<h5 style='color: red; font-weight: bold;'>UNAVAILABLE FOR RENT</h5>";
				?>
				<?php
					}
				?>
		</div>
	</div>
	<div style="background: black; padding-top: 50px; margin-top: 10px;">
	<div class="row column text-center">
	
		<div class="medium-12 large-12 columns">
			<div class="orbit" role="region" aria-label="pictures" data-orbit data-auto-play="false">
				<div class="orbit-controls">
				  <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
				  <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
				</div>
				<ul class="orbit-container">
<?php
	$count = $imgs_stmt -> rowCount();
	$i = 1;

	foreach($imgs as $image){
?>
					<li class="is-active orbit-slide">
						<img class="orbit-image thumbnail propertyImages" src="../<?= $image['image_url'] ?>" alt="picture<?=$i?>">
					</li>
<?php
        $i++;
	}
?>
				</ul>
				<nav class="orbit-bullets">
				<button class="is-active" data-slide="<?=$j?>"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
<?php
	for($j = 1; $j < $count; $j++){
?>		
					<button data-slide="<?=$j?>"><span class="show-for-sr">Second slide details.</span></button>
<?php
	}
?>
				</nav>
				</div>
			</div>
		</div>
	</div>
	<div style="margin-bottom: -60px;">
	<div class="row column" style="text-align: center; margin-top: 20px;">
		<div class="small-6 columns small-centered">
		<p><i class="fa fa-map-marker logIcon"></i> <?=$address?> <?=$city?>, <?=$state?> <?=$zip?>, <?=$country?></p>
		</div>
		<hr>
	</div>
	<div class="row column" style="text-align: center; margin-top: 0px;">
		<div class="small-4 columns">
			<p><i class="fa fa-money logIcon"></i> $<?=$price?></p>
		</div>
		<div class="small-4 columns">
			<p><i class="fa fa-bed logIcon"></i> <?=$bedNum?> <?=$bed?></p>
		</div>
		<div class="small-4 columns">
			<p><i class="fa fa-bath logIcon"></i> <?=$bathNum?> <?=$bath?></p>
		</div>
		<hr>
	</div>
	<div class="row column" style="text-align: ; margin-bottom: 0px;">
	<div class="small-6 columns">
	<div  style="max-width: 400px; min-width: 200px; margin: auto;">
		<div class="rating small-centered" style="padding: 10px; border: 1px solid #ddd; background: #eee; margin: auto; margin-bottom: 40px; border-radius: 7px;">
			<h5 style="text-align: center;"><?=$landlord?>'s Average Rating</h5>
			<div style="text-align: center;">
				<h1><?=$rating?></h1>
			<?php
				for($i = 0; $i < $rating; $i++){	
			?>
					<span class="fa fa-star profileStar" aria-hidden="true"></span>
			<?php
				}
				for($i = 0; $i < 5-$rating; $i++){
			?>
					<span class="fa fa-star-o profileStar" aria-hidden="true"></span>
			<?php
				}
			?>
			</div>
		</div>		
		<br>
			<div  style="margin: auto;">
			<h4 style="font-weight: bold; text-align: center;">Amenities</h4>
			<table>
				<tr>
					<td><i class="fa fa-tint logIcon"></i> Water:</td>
					<td><?=$water_included?></td>
				</tr>
				<tr>
					<td><i class="fa fa-bolt logIcon"></i> Electricity:</td>
					<td><?=$electricity_included?></td>
				</tr>
				<tr>
					<td><i class="fa fa-fire logIcon"></i> Heat:</td>
					<td><?=$heat_included?></td>
				</tr>
				<tr>
					<td><i class="fa fa-trash logIcon"></i> Trash:</td>
					<td><?=$trash_included?></td>
				</tr>
				<tr>
					<td><i class="fa fa-car logIcon"></i> Parking:</td>
					<td><?=$parking?></td>
				</tr>
			</table>
			</div>
		</div>
		</div>
		<div class="small-6 columns" style="border-left: 1px solid black;">
		<div style="padding: 10px; border: 1px solid #ddd; background: #eee; max-width: 400px; min-width: 300px; margin: auto; border-radius: 7px;">
		<form action="#" method="post">
			<p>Contact Landlord</p>
			<label>Name:
			<input type="text" name="name" placeholder="Name">
			</label>
			<label>Email:
			<input type="email" name="email" placeholder="something@something.com" required>
			</label>
			<label>Reason:
			<select name="contact">
			<option value="none"></option>
			<option value="Interested">Interested</option>
			<option value="info">More Info.</option>
			<option value="other">Other</option>
			</select>
			</label>
			<label>Message:
			<textarea name="message" rows="6" placeholder="I would like to know more about..."></textarea>
			</label>
			<div style="text-align: center;">
			<input type="submit" style="width: 100px;" class="button extended landlord-contact-button" value="Send">
			</div>
		</form>
		</div>
		</div>
	</div>
	</div>
	<!--
	<div class="row" style="margin-top: 20px;">
	
	<p>address: <?=$address?></p>
	<p>price: <?=$price?></p>
	<p>landlord: <?=$landlord?></p>
	<p>is_available: <?=$is_available?></p>
	<p>beds: <?=$beds?></p>
	<p>baths: <?=$baths?></p>
	<p>water_included: <?=$water_included?></p>
	<p>electricity_included: <?=$electricity_included?></p>
	<p>heat_included: <?=$heat_included?></p>
	<p>trash_included: <?=$trash_included?></p>
	<p>features: <?=$features?></p>
	<p>parking: <?=$parking?></p>
	</div>
	-->
	<script>
      $(document).foundation();
    </script>
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	
<?php
	include $path."footer.php";
?>