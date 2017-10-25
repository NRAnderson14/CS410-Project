<?php
	$path = "../";
	include $path."header.php";
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	if(isset($_GET['id'])){
		$property_id=$_GET['id'];
	}
	$rows = $db->query("SELECT address, price, name, email, phone, landlord FROM properties WHERE property_id = '$property_id';");
	foreach($rows as $row){
		$address = $row['address'];
		$price = $row['price'];
		$name = $row['name'];
		$email = $row['email'];
		$phone = $row['phone'];
		$landlord = $row['landlord'];
	}
	print $name."<br>";
	print "$".$price."<br>";
	print $address."<br>";
	print $email."<br>";
	print $phone."<br>";
	print $landlord."<br>";
?>
<?php
	include $path."footer.php";
?>