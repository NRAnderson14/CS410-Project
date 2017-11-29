<?php
$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	$username = "";
	$value = "";
	if(isset($_POST['username']) && isset($_POST['value'])){
		$username = $_POST['username'];
		$value = $_POST['value'];
		$date = date('Y-m-d H:i:s');
		$db -> query("INSERT INTO news (username, news_text, event_time) VALUES ('$username','$value','$date')");
	};
?>