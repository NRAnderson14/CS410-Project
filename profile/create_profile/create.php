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
		$rows = $db -> prepare("SELECT username FROM users WHERE username = :username");
		$rows -> execute(['username' => $username]);
		foreach($rows as $row){
			$var = $row['username'];
			$count++;
		}
		if($count != 0){
			print "username already taken";
			print "<a href='../../login/index.php'>Create Profile</a>";
		}else{
			print "Thank you $fname, your profile has been created. <a href='../../index.php'>Log in here</a>";
			$users_insertion = $db -> prepare("INSERT INTO users (username, password, user_type, email) 
                                                         VALUES (:username, :password, :user_type, :email);");
			$users_insertion -> execute(['username' => $username, 'password' => $password, 'user_type' => $membership_type, 'email' => $email]);

			if($membership_type == "landlord") {
			    $landlord_insertion = $db -> prepare('INSERT INTO landlords (username, fname, lname)
                                                                VALUES (:username, :fname, :lname);');
			    $landlord_insertion -> execute(['username' => $username, 'fname' => $fname, 'lname' => $lname]);
            } else {
                $tenant_insertion = $db -> prepare('INSERT INTO tenants (username, fname, lname)
                                                                VALUES (:username, :fname, :lname);');
                $tenant_insertion -> execute(['username' => $username, 'fname' => $fname, 'lname' => $lname]);
            }
		}
		
	}			
?>