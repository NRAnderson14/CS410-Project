<?php
	include "session.php";
?>
<h1>Logged in as:</h1><h3>
<?php
	$var = $_SESSION["username"];
	echo $var;
?></h3>
<a href="../login/logout.php">Log out</a>