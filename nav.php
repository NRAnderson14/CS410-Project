<?php
	//session_destroy;
	if(!isset($_SESSION)){
		session_start();
	}
	
	
?>
<div class="nav">
<div class="off-canvas-wrapper">
	<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
		<div class="off-canvas position-left" id="my-info" data-off-canvas data-position="left">
			<div class="row column">
				<!--
				Sidebar content
				-->
			</div>
		</div>
		<div class="off-canvas-content" data-sticky-container data-off-canvas-content>
			<div class="title-bar sticky" data-sticky data-options="marginTop:0;" style="width:100%" data-top-anchor="1">
				<div class='title-bar-left' style='height: 40px;'>
					<button id='#menu-icon' class='menu-icon ' style='position: fixed; z-index: 2;' type='button' data-open='my-info'></button>
					<a class='main-logo hide-for-large' href='<?=$path?>'>Rent Sm<span class='fa fa-home'></span>rt</a>
					<a class='show-for-large' style='margin-left: 50px;' href='<?=$path?>'>Rent Sm<span class='fa fa-home'></span>rt</a>
				</div>
				<div class='title-bar-right' style='margin-right: 20px;'>
				
					<?php
					if(isset($_SESSION["is_auth"])){
						$is_auth = $_SESSION["is_auth"];
						//print "$is_auth";
					}
					if(isset($_SESSION["username"])){
						$username = $_SESSION["username"];
						
				
						
						$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
						$viewed = $db->query("SELECT sender, notification, type, viewed FROM notifications WHERE recipient = '$username' AND viewed = '0'");
						$rowsCount = $db->query("SELECT FOUND_ROWS() as rowsCount") ->fetch()['rowsCount'];
						$rows = $db->query("SELECT sender, notification, type FROM notifications WHERE recipient = '$username' AND viewed = '1'");
						print "<a id='findFriends' title='Search Friends' href='".$path."friends/find.php'><i class='fa fa-search logIcon'></i></a>";
						print "<a id='myAccount' style='top: 10px;' title='My Account' href='".$path."profile/profile.php'><i class='fa fa-user logIcon'></i></a>";
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
						<button title="Notifications" class="button-badge notification-count" type="button" data-toggle="example-dropdown-bottom-right"><i class='fa fa-envelope clear-notification'></i><span id="notify-count" class='badge alert'><?=$rowsCount?></span></button>
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
			