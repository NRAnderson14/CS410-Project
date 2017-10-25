<?php
    $path = '../';
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	if(isset($_POST['search'])){
		$search = $_POST['search'];
	}
	$rows = $db->query("SELECT property_id, address, price, name, email, phone, landlord, image_url FROM `properties` WHERE address LIKE '%$search%' OR name LIKE '%$search%';");
?>
	<div class="row small-up-1 medium-up-2 large-up-3">
		<?php
			foreach($rows as $row){
				$property_id=$row['property_id'];
				$address=$row['address'];
				$price=$row['price'];
				$name=$row['name'];
				$email=$row['email'];
				$phone=$row['phone'];
				$landlord=$row['landlord'];
				$img = $row['image_url'];
		?>
			<div class="column column-block">
			<div class="name">
				<p><a href="#"><?=$name?></a></p>
			</div>
				<a href="properties/property.php?id=<?=$property_id?>"><img src="<?= $path . $img ?>" class="thumbnail" alt=""></a>
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