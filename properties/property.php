<?php
	$path = "../";
	include $path . "header.php";
	if(!isset($_SESSION)){
		session_start();
	}
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
    $rating_stmt = $db -> prepare('SELECT AVG(rating) AS rating FROM landlord_ratings WHERE landlord = :user;');
    $rating_stmt -> execute(['user' => $landlord_username]);

    $rating = $rating_stmt -> fetch();
    $ratingval = $rating['rating'];
    $ratingval = $ratingval * 2.0;
    $ratingval = round($ratingval);
    $ratingval = $ratingval / 2.0;

	if(isset($_SESSION['username'])){
		if($_SESSION['username'] == $landlord_username){
			print "You are on your property page.";
		}
        if($_SESSION['username'] == $landlord_username) {
            $user_owns_property = true;
        } else {
            $user_owns_property = false;
        }
	}

    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }

    $property_rating_stmt = $db -> prepare('SELECT AVG(rating) AS rating FROM property_ratings WHERE property_id = :pid;');
    $property_rating_stmt -> execute(['pid' => $property_id]);

    $property_rating = $property_rating_stmt -> fetch();
    $property_rating_val = $property_rating['rating'];
    $property_rating_val = $property_rating_val * 2.0;
    $property_rating_val = round($property_rating_val);
    $property_rating_val = $property_rating_val / 2.0;

    if (isset($_SESSION['username'])) {
    $user_has_rated_stmt = $db -> prepare('SELECT rating_tenant, rating FROM property_ratings WHERE property_id = :pid AND rating_tenant = :user;');
    $user_has_rated_stmt -> execute(['pid' => $property_id, 'user' => $username]);

    $user_rated_results = $user_has_rated_stmt -> fetch();

    $user_rated_landlord_stmt = $db -> prepare('SELECT rating_tenant, rating FROM landlord_ratings WHERE landlord = :landlord AND rating_tenant = :user;');
    $user_rated_landlord_stmt -> execute(['landlord' => $landlord_username, 'user' => $username]);

    $user_rated_landlord_results = $user_rated_landlord_stmt -> fetch();
    if ($user_rated_results['rating_tenant'] != null) {
        $user_has_rated = true;
        //If user has rated the property, use that instead of the average
        $property_rating_val = $user_rated_results['rating'];
//        $property_rating_val = $property_rating_val * 2.0;
//        $property_rating_val = round($property_rating_val);
//        $property_rating_val = $property_rating_val / 2.0;
    } else {
        $user_has_rated = false;
    }

    if ($user_rated_landlord_results['rating_tenant'] != null) {
        $user_rated_landlord = true;
        $ratingval = $user_rated_landlord_results['rating'];
    } else {
        $user_rated_landlord = false;
    }

    } else {
        $user_has_rated = false;
        $user_rated_landlord = false;
    }
	?>

<!-- SLIDESHOW -->
<div id="slideshow">

	<!-- <div class="row column text-center"> -->
	
		<!-- <div class="medium-12 large-12 columns"> -->

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
							<img class="orbit-image slideshowImage" src="../<?= $image['image_url'] ?>" alt="picture<?=$i?>">
						</li>
					<?php
							$i++;
						}
					?>
				</ul>

				<nav id="slideshowBullets" class="orbit-bullets">
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
			
		<!-- </div> -->
	<!-- </div> -->
</div>
<!-- END SLIDESHOW -->

<!-- HEADER? -->
	<!-- <div class="upperBackground"></div> -->
<div class="" id="propertyHeader">

		<div class="large-12 columns">
			
				<h1 id="propertyTitle"><span class="fa fa-map-marker"> </span> <?=$address?> <?=$city?>, <?=$state?></h1>
				<?php
                    if ($is_available == 1) {
                        print '<h5 id="propertyAvailable" class="landlord-editable value-outer-avail"><span class="avail">AVAILABLE</span> NOW!</h5>';
                    } elseif ($is_available == 0) {
                        print '<h5  id="propertyNotAvailable" class="landlord-editable value-outer-avail"><span class="avail">UNAVAILABLE</span> FOR RENT</h5>';
                    }
				?>
			

		<!-- <div style="margin-top: 50px;" class="hide-for-large">
			<a href=""><img src="<?= $path . $img ?>" alt="Profile Picture" id="profilePicture"></a>	
		</div> -->

		<!-- <div class="show-for-large">
			<a href=""><img style="margin-top: -40px;" src="<?= $path . $img ?>" alt="Profile Picture" id="profilePicture"></a>
		</div> -->

            <?php
            if ($user_has_rated) {
                print '<div class="row user-has-rated-stars rating-stars property-rating">';
                $star_color = "#f4d940";
            } else {
                print '<div class="row stars rating-stars property-rating">';
                $star_color = "";
            }

            if ($property_rating_val == 0) {
                print '<h4 id="propertyRatingText">This property hasn\'t been rated</h4>';
            } else {
                for ($i = 1.0; $i <= 5.0; $i += 1.0) {
                    if ($property_rating_val > $i || $property_rating_val == $i) {
                        //Whole star
                        print '<span class="fa fa-star profileStar" aria-hidden="true" style="color: ' . $star_color . '"></span>';
                    } else if ($property_rating_val > $i - 1 && $property_rating_val < $i) {
                        //Half star
                        print '<span class="fa fa-star-half-o profileStar" aria-hidden="true" style="color: ' . $star_color . '"></span>';
                    } else {
                        //Empty star
                        print '<span class="fa fa-star-o profileStar" aria-hidden="true" style="color: ' . $star_color . '"></span>';
                    }
                }
            }
            ?>
        </div>

			<h6 id="currentLandlord">Current Landlord: <?= $landlord ?></h6>
			
				
	</div>
</div>
<!-- END HEADER? -->


<!-- PROPERTY INFO/ LANDOLORD CONTACT -->
	<div style="margin-bottom: -60px;">
	<div class="row column" style="text-align: center; margin-top: 20px;">
		<div class="small-6 columns small-centered">
		<a target="_blank" href="https://www.google.com/maps/place/<?=$address?>+<?=$city?>+<?=$state?>+<?=$zip?>+<?=$country?>"><i class="fa fa-map-marker logIcon"></i> <?=$address?> <?=$city?>, <?=$state?> <?=$zip?>, <?=$country?></a>
		</div>
		<hr>
	</div>
	<div class="row column" style="text-align: center; margin-top: 0px;">
		<div class="small-4 columns">
            <p class="landlord-editable value-outer-price"><span class="propertyPrice"><i class="fa fa-usd logIcon"></i> <?=$price?></span></p>
		</div>
		<div class="small-4 columns">
            <p class="landlord-editable value-outer-bed"><i class="fa fa-bed logIcon"></i> <span class="bed"><?=$bedNum?></span> <?=$bed?></p>
		</div>
		<div class="small-4 columns">
            <p class="landlord-editable value-outer-bath"><i class="fa fa-bath logIcon"></i> <span class="bath"><?=$bathNum?></span> <?=$bath?></p>
		</div>
		<hr>
	</div>
	<div class="row column" style="text-align: ; margin-bottom: 0px;">
	<div class="small-6 columns">
	<div  style="max-width: 400px; min-width: 200px; margin: auto;">
		<div class="rating small-centered" style="padding: 10px; border: 1px solid #ddd; background: #eee; margin: auto; margin-bottom: 40px; border-radius: 7px;">
			<h5 style="text-align: center;"><?=$landlord?>'s Average Rating</h5>
			<div style="text-align: center;">
				<h1><?=$ratingval?></h1>
                <?php
                if ($user_has_rated) {
                    print '<div class="row user-has-rated-stars rating-stars landlord-rating">';
                    $star_color = "#f4d940";
                } else {
                    print '<div class="row stars rating-stars landlord-rating">';
                    $star_color = "";
                }

				for($i = 1.0; $i <= 5.0; $i += 1.0) {
				    if($ratingval > $i || $ratingval == $i) {
				        //Whole star
                        print '<span class="fa fa-star profileStar" aria-hidden="true" style="color: ' . $star_color . '"></span>';
                    } else if($ratingval > $i-1 && $ratingval < $i) {
				        //Half star
                        print '<span class="fa fa-star-half-o profileStar" aria-hidden="true" style="color: ' . $star_color . '"></span>';
                    } else {
				        //Empty star
                        print '<span class="fa fa-star-o profileStar" aria-hidden="true" style="color: ' . $star_color . '"></span>';
                    }
                }
			?>
            </div>
			</div>
		</div>		
		<br>
			<div  style="margin: auto;">
			<h4 style="font-weight: bold; text-align: center;">Amenities</h4>
			<table>
				<tr>
					<td><i class="fa fa-tint logIcon"></i> Water:</td>
					<td class="landlord-editable value-outer-water"><span class="water"><?=$water_included?></span></td>
				</tr>
				<tr>
					<td><i class="fa fa-bolt logIcon"></i> Electricity:</td>
					<td class="landlord-editable value-outer-elec"><span class="elec"><?=$electricity_included?></span></td>
				</tr>
				<tr>
					<td><i class="fa fa-fire logIcon"></i> Heat:</td>
                    <td class="landlord-editable value-outer-heat"><span class="heat"><?=$heat_included?></span></td>
				</tr>
				<tr>
					<td><i class="fa fa-trash logIcon"></i> Trash:</td>
                    <td class="landlord-editable value-outer-trash"><span class="trash"><?=$trash_included?></span></td>
				</tr>
				<tr>
					<td><i class="fa fa-car logIcon"></i> Parking:</td>
                    <td class="landlord-editable value-outer-parking"><span class="parking"><?=$parking?></span></td>
				</tr>
			</table>
			</div>
		</div>
		</div>
		<div class="small-6 columns" style="border-left: 1px solid black;">
		<div style="padding: 10px; border: 1px solid #ddd; background: #eee; max-width: 400px; min-width: 300px; margin: auto; border-radius: 7px;">
		<form action="#" method="post">
		
			<p>Contact Landlord: <?=$landlord?></p>
			<p>Email: <?=$email?></p>
			<p>Phone: <a href="tel:123-123-1234"><?=$phone?></a></p>
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
			<input id="email-button" type="submit" style="width: 100px;" class="button extended landlord-contact-button" value="Send">
			</div>
		</form>
		</div>
		</div>
	</div>
	</div>
    <div id="#burner">
        <p class="invisible"></p>
    </div>

	<script>
      $(document).foundation();
    </script>

	
	
<?php
	include $path."footer.php";
?>
