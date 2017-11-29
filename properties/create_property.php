<?php
	$path = "../";
	include $path . "header2.php";
  include "../profile/session.php";
	$count = 0;
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	if(isset($_POST['addressname'])){
		$addressname = $_POST['addressname'];
		$count++;
	}
  if(isset($_POST['apartment'])){
		$apartmentLocation= $_POST['apartment'];
		$count++;
	}
  if(isset($_POST['cityname'])){
		$cityname = $_POST['cityname'];
		$count++;
	}
  if(isset($_POST['statename'])){
		$statename = $_POST['statename'];
		$count++;
	}
  if(isset($_POST['countryname'])){
		$countryname = $_POST['countryname'];
		$count++;
	}
  if(isset($_POST['zipcode'])){
		$zipcode = $_POST['zipcode'];
		$count++;
	}
  if(isset($_POST['monthly_costProperty'])){
		$monthly_costProperty = $_POST['monthly_costProperty'];
		$count++;
	}
  if(isset($_POST['apartmentAvailability'])){
		$apartmentAvailability = $_POST['apartmentAvailability'];
		$count++;
	}
  if(isset($_POST['numberBeds'])){
    $numberBeds = $_POST['numberBeds'];
    $count++;
  }
  if(isset($_POST['numberBaths'])){
		$numberBaths = $_POST['numberBaths'];
		$count++;
	}
  if(isset($_POST['waterInclusion'])){
		$waterInclusion = $_POST['waterInclusion'];
		$count++;
	}
  if(isset($_POST['electricInclusion'])){
		$electricInclusion = $_POST['electricInclusion'];
		$count++;
	}
  if(isset($_POST['heatInclusion'])){
		$heatInclusion = $_POST['heatInclusion'];
		$count++;
	}
  if(isset($_POST['trashInclusion'])){
		$trashInclusion = $_POST['trashInclusion'];
		$count++;
	}
  if(isset($_POST['parkingType'])){
		$parkingType = $_POST['parkingType'];
		$count++;
	}
  if(isset($_POST['exceptionalFeatures'])){
		$exceptionalFeatures = $_POST['exceptionalFeatures'];
		$count++;
	}
  if(isset($_POST['keywords'])){
		$keywords = $_POST['keywords'];
		$count++;
	}
  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

  if($count == 17){
    $propertyID = $db -> query("SELECT MAX(property_id) as id FROM properties");
    $propertyID = $propertyID->fetch(PDO::FETCH_ASSOC);
    $propID = $propertyID['id'];
    $propID++;
    $stockImage = "images/stock_image.jpg";

    print "Thank you $username, your property has been listed. <a href='../index.php'>View now</a>";
    $property_insertion = $db -> prepare("INSERT INTO properties (property_id, landlord, address, apartment, city, state, country, zip, monthly_cost, is_available,
    beds, baths, water_included, electricity_included, heat_included, trash_included, parking, features, keyword)
    VALUES (:property_id, :landlord, :address, :apartment, :city, :state, :country, :zip, :monthly_cost,
    :is_available, :beds, :baths, :water_included, :electricity_included, :heat_included, :trash_included, :parking, :features, :keyword);");

  $property_insertion -> execute(['property_id' => $propID,
                                                      'landlord' => $username,
                                                      'address' => $addressname,
                                                      'apartment' => $apartmentLocation,
                                                      'city' => $cityname,
                                                      'state' => $statename,
                                                      'country' => $countryname,
                                                      'zip' => $zipcode,
                                                      'monthly_cost' => $monthly_costProperty,
                                                      'is_available' => $apartmentAvailability,
                                                      'beds' => $numberBeds,
                                                      'baths' => $numberBaths,
                                                      'water_included' => $waterInclusion,
                                                      'electricity_included' => $electricInclusion,
                                                      'heat_included' => $heatInclusion,
                                                      'trash_included' => $trashInclusion,
                                                      'parking' => $parkingType,
                                                      'features' => $exceptionalFeatures,
                                                      'keyword' => $keywords]);

 $stockImageInsert = $db -> prepare("INSERT INTO property_images (property_id, image_url)
                                                            VALUES (:property_id, :image_url);");

 $stockImageInsert -> execute(['property_id' => $propID,
                                                  'image_url' => $stockImage]);
                                                   }else{
                                                     alert('not all fields entered');
                                                   }
?>
