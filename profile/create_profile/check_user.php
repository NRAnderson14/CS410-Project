<?php
	//checks to see if the val passed from check_user.js is in the database.
	//Then echos a value of 0 or > 0. 0 = no username found. ! 0 = username found.
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	$value = $_POST['val'];
	$count = 0;
	$rows = $db->query("SELECT username FROM users WHERE username='$value'");
	foreach($rows as $row){
		$var = $row['username'];
		$count++;
	}
	if($count != 0){
		echo $count;
	}else if($count == 0){
		echo $count;
	}
?>