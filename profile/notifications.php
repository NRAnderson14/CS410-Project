<?php
    $path = '../';
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
  	if(isset($_POST['user'])){
  	   $user = $_POST['user'];
	   $rows = $db->query("UPDATE notifications SET viewed = '1' WHERE recipient = '$user' AND viewed = '0';");
  	}