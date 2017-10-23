<?php
	//takes all values entered in the form and inserts the data into the database
	//if the username is unique.
    $path = "../../";
	include $path . "header2.php";
	$count = 0;
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	if(isset($_POST['fname'])){
		$fname = $_POST['fname'];
		$count++;
	}
	if(isset($_POST['lname'])){
		$lname = $_POST['lname'];
		$count++;
	}
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		$count++;
	}
	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$count++;
	}
	if(isset($_POST['password'])){
		$password = $_POST['password'];
		$count++;
	}
	if(isset($_POST['membership_type'])){
		$membership_type = $_POST['membership_type'];
		$count++;
	}
	if($count == 6){
		$count = 0;
		$rows = $db->query("SELECT username FROM users WHERE username='$username'");
		foreach($rows as $row){
			$var = $row['username'];
			$count++;
		}
		if($count != 0){
			print "username already taken";
			print "<a href='../../index.php'>Create Profile</a>";
		}else{
			print "Thank you $fname, your profile has been created. <a href='../../index.php'>Log in here</a>";
			$rows = $db->query("INSERT INTO users(user_id, username, password, membership_type, fname, lname, email) VALUES('$username','$username','$password','$membership_type','$fname','$lname','$email');");
		}
		
	}			
?>