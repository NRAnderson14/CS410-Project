<?php
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