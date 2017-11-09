<?php
	//checks to see if the username and password are the same as what the user entered
	//then starts session so other pages can be accessed as that user.
	
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	$username = "";
	$password = "";
	$newUser = "";
	$newPass = "";
	if(isset($_POST['username']) && isset($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if($username != "" && $password != ""){

			$rows = $db -> prepare("SELECT username, password, user_type FROM `users` WHERE username = :username");
			$rows -> execute(['username' => $username]);
			foreach($rows as $row){
				$newUser = $row["username"];
				$newPass = $row["password"];
				$user_type = $row["user_type"];
			}
			if($username == $newUser && $password == $newPass){
				$_SESSION["is_auth"] = true;
				$_SESSION["username"] = $username;
				$_SESSION['user_type'] = $user_type;

				if($user_type == "tenant") {
                    header("location: ../profile/profile.php");
                } else {
				    header("location: ../profile/landlordprofile.php");
                }
			}else{
				print "Username or Password is incorrect";
			}
		}else{
			print "Not queried";
			
		}
	}
?>