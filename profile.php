<?php
	session_start();
	if(!isset($_SESSION["is_auth"])){
		header("location: index.php");
	}elseif(isset($_REQUEST["logout"]) && $_REQUEST["logout"] == true){
		unset($_SESSION["is_auth"]);
		session_destroy;
		print "logged out";
	}
?>
<h1>Logged in as:</h1><h3>
<?php
	$var = $_SESSION["username"];
	print $var;
?></h3>
<a href="logout.php">Log out</a>