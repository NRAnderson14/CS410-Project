<?php
	//session_destroy;
	if(!isset($_SESSION)){
		session_start();
	}
	
	
?>
<div class="nav">
<div class="off-canvas-wrapper">
	<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
		<div class="off-canvas position-left reveal-for-large" style="position: fixed;" id="my-info" data-off-canvas data-position="left">
			<div class="row column">
				<!--
				Sidebar content
				-->
			</div>
		</div>
		<div class="off-canvas-content" data-off-canvas-content>
			<div class="title-bar">
				
				
					<?php
					if(isset($_SESSION["is_auth"])){
						$is_auth = $_SESSION["is_auth"];
						//print "$is_auth";
					}
					if(isset($_SESSION["username"])){
						$username = $_SESSION["username"];
						print "	<div class='title-bar-left' style='height: 40px;'>
									<button id='#menu-icon' class='menu-icon hide-for-large' style='position: fixed; z-index: 2;' type='button' data-open='my-info'></button>
									<a class='main-logo hide-for-large' href='".$path."'>Rent Sm<span class='fa fa-home'></span>rt</a>
									<a class='show-for-large' style='margin-left: 20px;' href='".$path."'>Rent Sm<span class='fa fa-home'></span>rt</a>
								</div>";
						print "<div class='title-bar-right' style='margin-right: 20px;'>";
						print "<a id='findFriends' title='Search Friends' href='".$path."friends/find.php'><i class='fa fa-search logIcon'></i></a>";
						print "<a id='myAccount' style='top: 10px;' title='My Account' href='".$path."profile/profile.php'><i class='fa fa-user logIcon'></i></a>";
					}else{
						print "	<div class='title-bar-left' style='margin-top: 10px; height: 43px;'>
									<button id='#menu-icon' class='menu-icon hide-for-large' style='position: fixed; z-index: 2;' type='button' data-open='my-info'></button>
									<a class='main-logo hide-for-large' href='".$path."'>Rent Sm<span class='fa fa-home'></span>rt</a>
									<a class='show-for-large' style='margin-left: 20px;' href='".$path."'>Rent Sm<span class='fa fa-home'></span>rt</a>
								</div>";
						print "<div class='title-bar-right' style='margin-right: 20px; margin-top: 13px;'>";
						print "<a id='myAccount' style='top: 10px;' title='My Account' href='".$path."profile/profile.php'><i class='fa fa-user logIcon'></i></a>";
					}
					?>				
					<?php
					if(isset($_SESSION["is_auth"])){
						$is_auth = $_SESSION["is_auth"];
						//print "$is_auth";
					}
					if(isset($_SESSION["username"])){
						$username = $_SESSION["username"];
						print "<a title='Notificatioins' href='#' class='button-badge'><i class='fa fa-envelope'></i><span class='badge alert'>1</span></a>";
						print "<a id='logOut' title='Log Out' href='".$path."login/logout.php'><i class='fa fa-user-times logIcon'></i></a>";
					}else{
					}
					?>
				</div>
			</div>
			
				<!--
				main page content
				-->
			