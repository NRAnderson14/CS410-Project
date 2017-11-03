<?php
	$path = "../";
	include $path."header.php";
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	if(isset($_GET['id'])){
		$property_id=$_GET['id'];
	}
	$rows = $db->query("SELECT address, monthly_cost, landlord FROM properties WHERE property_id = '$property_id';");
	foreach($rows as $row){
		$address = $row['address'];
		$price = $row['monthly_cost'];
		$landlord = $row['landlord'];
	}

	//Get the landlord's info
	$landlord_stmt = $db -> prepare('SELECT public_email, phone FROM landlords WHERE username = :landlord;');
    $landlord_stmt -> execute(['landlord' => $landlord]);
    $landlord_info = $landlord_stmt -> fetch(PDO::FETCH_ASSOC);

    $email = $landlord_info['public_email'];
    $phone = $landlord_info['phone'];

    //Get the property images
    $imgs_stmt = $db -> prepare('SELECT image_url FROM property_images WHERE property_id = :id;');
    $imgs_stmt -> execute(['id' => $property_id]);
    $imgs = $imgs_stmt -> fetchAll();
    //Assuming the first image is the banner for the property
    $img = $imgs[0]['image_url'];
?>
	<div class="upperBackground"></div>
	<div class="row text-center" id="profileHeader">
		<div class="large-12 columns">
			<div class="row column text-center">
			<h1 class="white"><?=$address?></h1>
			
		</div>
			<a href=""><img src="<?= $path . $img ?>" alt="Profile Picture" id="profilePicture"></a>
			<h6 id="userName">Current Landlord:</h6>
			<h4 id="userName"><?= $landlord ?></h4>
		</div>
	</div>
	<div style="background: black; padding-top: 50px; margin-top: 100px;">
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
	<script>
      $(document).foundation();
    </script>
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	
<?php
	include $path."footer.php";
?>