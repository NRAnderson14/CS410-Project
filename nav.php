<?php
	//session_destroy;
	if(!isset($_SESSION)){
		session_start();
	}

?>
<div class="nav">

	<div class="off-canvas-wrapper">
		<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>

			<!-- sidebar -->
			<div class="off-canvas position-left" id="my-info" data-off-canvas data-position="left">
				<div id="sideBar" class="row column">

				<?php
					if(isset($_SESSION["is_auth"])){
						$is_auth = $_SESSION["is_auth"];
						//print "$is_auth";
					}

					if(isset($_SESSION["username"])){
						$username = $_SESSION["username"];

						$username = $_SESSION["username"];

						$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
						$stmt = $db -> prepare('SELECT profile_img_url, fname, lname FROM tenants WHERE username = :user;');
						$stmt -> execute(['user' => $username]);
						$usr_info = $stmt -> fetch();

						$rating_stmt = $db -> prepare('SELECT AVG(user_rating) AS rating FROM tenant_ratings WHERE username = :user;');
						$rating_stmt -> execute(['user' => $username]);
						$rating = $rating_stmt -> fetch();
						$ratingval = round($rating['rating'],1);
					?>

						<!-- nav bar content-->
						<p id="welcomeSB">DASHBOARD</p>
						<h1 id="userNameSB"><?= $usr_info['fname'] . ' ' . $usr_info['lname'] ?></h1>

						<hr>


						<h3  class="ratingTextSB"> Your Rating: <span id="ratingSB"> <?=$ratingval?> </span> </h3>


						<a class="linkSB" href="<?=$path?>profile/profile.php"> Your Profile <span class="fa fa-user-o iconSB"></span> </a>

						<a class="linkSB" href="<?=$path?>index.php"> Link 2 <span class="fa fa-mobile iconSB"></span> </a>

						<a class="linkSB" href="<?=$path?>index.php"> Link 3 <span class="fa fa-newspaper-o iconSB"></span> </a>

						<a class="linkSB" href="<?=$path?>index.php"> Link 4 <span class="fa fa-hand-spock-o iconSB"></span> </a>

					<?php } ?>

				</div>
			</div>

		<div class="off-canvas-content" data-sticky-container data-off-canvas-content>
			<div class="title-bar sticky" data-sticky data-options="marginTop:0;" style="width:100%" data-top-anchor="1">

				<div class='title-bar-left' style='height: 40px;'>


					<?php


					if(isset($_SESSION["username"])){
						$username = $_SESSION["username"];

					?>

						<!-- sidebar button-->
						<button id='#menu-icon' class='menu-icon ' style='position: fixed; z-index: 2;' type='button' data-open='my-info'></button>
					<?php } ?>

					<a class='main-logo hide-for-large' href='<?=$path?>'>Rent Sm<span class='fa fa-home'></span>rt</a>
					<a class='show-for-large' style='margin-left: 50px;' href='<?=$path?>'>Rent Sm<span class='fa fa-home'></span>rt</a>
				</div>

				<div class='title-bar-right' style='margin-right: 20px; z-index: 2;'>

					<?php

					if(isset($_SESSION["username"])){
						// $username = $_SESSION["username"];



						include "".$path."profile/notify.php";
						print "<a id='findFriends' title='Search Friends' href='".$path."friends/find.php'><i class='fa fa-search logIcon'></i></a>";
                        //Based on the user type, take them to the right profile page
                        if($_SESSION['user_type'] == "tenant") {
                            print "<a id='myAccount' style='top: 10px;' title='My Account' href='" . $path . "profile/profile.php'><i class='fa fa-user logIcon'></i></a>";
                        } else {
                            print "<a id='myAccount' style='top: 10px;' title='My Account' href='" . $path . "profile/landlordprofile.php'><i class='fa fa-user logIcon'></i></a>";
                        }
					}else{
						print "<a id='myAccount' class='button-badge' style='' title='My Account' href='".$path."profile/profile.php'><i class='fa fa-user logIcon'></i></a>";
					}
					?>

					<?php
					if(isset($_SESSION["is_auth"])){
						$is_auth = $_SESSION["is_auth"];
						//print "$is_auth";
					}
					if(isset($_SESSION["username"])){
						$username = $_SESSION["username"];
					?>
					<button title="Notifications" class="button-badge notification-count" type="button" data-toggle="example-dropdown-bottom-right">
						<i class='fa fa-envelope clear-notification'></i>
					<?php
						if($rowsCount > 0){
					?>
							<span id="notify-count" class='badge alert'>
							<?=$rowsCount?>
							</span>
					<?php
						}else{
					?>
							<span id="notify-count" class=''>

							</span>
					<?php
						}
					?>
					</button>
						<div class="dropdown-pane" style="overflow:scroll; height: 400px;" data-position="bottom" data-alignment="right" id="example-dropdown-bottom-right" data-dropdown data-close-on-click="true" data-auto-focus="true" aria-autoclose="false">
						<div class="dropdown-contents" style="color: black; text-align: left;">
						<!--
						Notification contents go here
						-->
						<?php
						foreach($viewed as $view){
							$sender = $view['sender'];
							$type = $view['type'];
							$message = $view['notification'];
						?>
							<div class="content-style-new"  style="border-bottom: 1px solid #ccc;">
								<a href="#"><p><span style="color: #4266DA;"><?=$sender?></span>: <?=$message?></p></a>
							</div>
						<?php
						}
						foreach($rows as $row){
							$sender = $row['sender'];
							$type = $row['type'];
							$message = $row['notification'];
						?>
							<div class="content-style"  style="border-bottom: 1px solid #ccc;">
								<a href="#"><p><span style="color: #4266DA;"><?=$sender?></span>: <?=$message?></p></a>
							</div>
						<?php
						}
						?>
						</div>
						</div>
					<?php
						print "<a id='logOut' title='Log Out' href='".$path."login/logout.php'><i class='fa fa-user-times logIcon'></i></a>";
					}else{
					}
					?>
				</div>
			</div>
			<script>
				$("body").click(function(){
					$(".dropdown-pane").show();
				});
				$(".button-badge").click(function(){
					$(".dropdown-pane").show();
				});
			</script>
				<!--
				main page content
				-->
			<p style="opacity: 0;" id="path-hidden"><?=$path?></p>
			<p style="opacity: 0;" id="user-hidden"><?=$username?></p>
			<div class="loading"></div>
