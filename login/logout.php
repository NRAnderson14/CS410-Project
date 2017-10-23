<?php
	//logs the user out of the system.
	session_start();
	unset($_SESSION["is_auth"]);
	session_destroy();
	header("location: index.php");
?>