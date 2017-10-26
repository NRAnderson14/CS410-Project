<?php
	$path = "../";
	include $path."header.php";
	$img1 = "";
	$img2 = "";
	$img3 = "";
	$img4 = "";
	$img5 = "";
	$img6 = "";
	$img7 = "";
	$img8 = "";
	$img9 = "";
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	if(isset($_GET['id'])){
		$property_id=$_GET['id'];
	}
	$rows = $db->query("SELECT address, price, name, email, phone, landlord, image_url FROM properties WHERE property_id = '$property_id';");
	foreach($rows as $row){
		$address = $row['address'];
		$price = $row['price'];
		$name = $row['name'];
		$email = $row['email'];
		$phone = $row['phone'];
		$landlord = $row['landlord'];
		$img = $row['image_url'];
	}
?>
	<div class="upperBackground"></div>
	<div class="row text-center" id="profileHeader">
		<div class="large-6 columns">
			<div class="row column text-center">
			<h1 class="white"><?=$name?></h1>
			
		</div>
			<a href=""><img src="<?= $path . $img_path['img_url'] ?>" alt="Profile Picture" id="profilePicture"></a>
			<h6 id="userName">Current Landlord:</h6>
			<h4 id="userName"><?= $landlord ?></h4>
		</div>
	</div>
	<div class="row column text-center">
		<div class="medium-6 large-6 columns">
			<div class="orbit" role="region" aria-label="pictures" data-orbit data-auto-play="false">
				<div class="orbit-controls">
				  <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
				  <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
				</div>
				<ul class="orbit-container">
<?php
	$count = 0;
	$num = 0;
	$rows = $db->query("SELECT * FROM property_images WHERE property_id = '$property_id';");
	
		
	foreach($rows as $row){
		if($row['img1'] != null){
			$count++;
		}
		if($row['img2'] != null){
			$count++;
		}
		if($row['img3'] != null){
			$count++;
		}
		if($row['img4'] != null){
			$count++;
		}
		if($row['img5'] != null){
			$count++;
		}
		if($row['img6'] != null){
			$count++;
		}
		if($row['img7'] != null){
			$count++;
		}
		if($row['img8'] != null){
			$count++;
		}
		if($row['img9'] != null){
			$count++;
		}
	}
	//print $count;
	$i = 1;
	$j = 0;
	if($count == 0){
		?>
					<li class="is-active orbit-slide">
						<img class="orbit-image thumbnail propertyImages" src="../images/stock_image.jpg" alt="picture">
					</li>
					</ul>
				<nav class="orbit-bullets">
				<button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
		<?php
	}else{
?>	
					<li class="is-active orbit-slide">
						<img class="orbit-image thumbnail propertyImages" src="../images/<?=$property_id?><?=$i?>.jpg" alt="picture<?=$i?>">
					</li>
<?php
	for($i = 2; $i <= $count; $i++){
?>
					<li class="orbit-slide">
						<img class="orbit-image thumbnail propertyImages" src="../images/<?=$property_id?><?=$i?>.jpg" alt="picture<?=$i?>">
					</li>
<?php
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
	}
?>			
				</nav>
			</div>
		</div>
	</div>
	<script>
      $(document).foundation();
    </script>
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	
<?php
	include $path."footer.php";
?>