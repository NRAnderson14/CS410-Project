<?php
	include "session.php";
	$path = "../";
	include "../header.php";
	$var = $_SESSION["username"];
?>
<h1>Logged in as:</h1><h3>
<?php
	print "<p>$var</p>";
?></h3>