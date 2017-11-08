<?php
	//session_destroy;
	if(!isset($_SESSION)){
		session_start();
	}
	
	
?>
<div class="top-bar">
	<div class="top-bar-left">
		<ul class="dropdown menu" data-dropdown-menu>

			<li id="logo" class="many-text"><a href="<?= $path ?>">Rent Sm<span class="fa fa-home"></span>rt</a></li>
		
		</ul>
	</div>

	<div class="top-bar-right">

	<ul class="dropdown menu" data-dropdown-menu>
	<?php
	if(isset($_SESSION["is_auth"])){
		$is_auth = $_SESSION["is_auth"];
		//print "$is_auth";
	}
	if(isset($_SESSION["username"])){
		$username = $_SESSION["username"];
		print "<li><a id='findFriends' href='".$path."friends/find.php'>Find Friends <i class='fa fa-search logIcon'></i></a></li>";
	}else{
	}
	?>

		<li><a id="myAccount" href="<?= $path ?>profile/profile.php">My Account <i class="fa fa-user logIcon"></i></a></li>
		
	<?php
	if(isset($_SESSION["is_auth"])){
		$is_auth = $_SESSION["is_auth"];
		//print "$is_auth";
	}
	if(isset($_SESSION["username"])){
		$username = $_SESSION["username"];
		print "<li><a href='#' class='button-badge'><i class='fa fa-envelope'></i><span class='badge alert'>1</span></a></li>";
		print "<li><a id='logOut' href='".$path."login/logout.php'>Log Out <i class='fa fa-user-times logIcon'></i></a></li>";
	}else{
	}
	?>
	</ul>	

	</div>
</div>
