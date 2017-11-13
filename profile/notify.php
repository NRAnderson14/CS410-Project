<?php
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	$viewed = $db->query("SELECT sender, notification, type, viewed FROM notifications WHERE recipient = '$username' AND viewed = '0'");
	$rowsCount = $db->query("SELECT FOUND_ROWS() as rowsCount") ->fetch()['rowsCount'];
	$rows = $db->query("SELECT sender, notification, type FROM notifications WHERE recipient = '$username' AND viewed = '1'");
?>