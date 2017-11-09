<?php
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	if(isset($_POST['users']) && isset($_POST['types'])){
		$users = $_POST['users'];
		$types = $_POST['types'];
		$rows = $db->query("INSERT INTO notifications  (recipient, sender, notification, type, viewed) VALUES ('$users','system','test','$types','0');");
	}
	
	
	$rows = $db->query("SELECT username FROM tenants;");
?>
<form action = "" method="post">
	<select name = "users">
		<?php
			foreach($rows as $row){
				$username = $row['username'];
		?>
			<option name="<?=$username?>" value="<?=$username?>"><?=$username?></option>
		<?php
			}
		?>
			
	</select>
	<select name = "types">
		<option name="friend" value="friend">Friend Request</option>
		<option name="message" value="message">Message</option>
		<option name="system" value="system">system</option>
	</select>
	<input type="submit" name="submit" value="Submit">
</form>