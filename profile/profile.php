<?php
	include "session.php";
	$path = "../";
	include $path . "header.php";
	$username = $_SESSION["username"];

    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
    $stmt = $db -> prepare('SELECT img_url FROM users WHERE user_id = :user;');
    $stmt -> execute(['user' => $username]);
    $img_path = $stmt -> fetch();
?>

<div class="upperBackground"></div>
<div class="row" id="profileHeader">
    <div class="large-12 columns">
        
            <img src="<?= $path . $img_path['img_url'] ?>" alt="Profile Picture" id="profilePicture">
            <h1 id="userName"><?= $username ?></h1>
    </div>
</div>

<div class="row">
    <div class="large-12 columns">
        <h4>Your Friends:</h4>
        <ul>
        <?php
            $friends = $db -> prepare('SELECT tenants.fname AS fname, tenants.lname AS lname
              FROM friends INNER JOIN tenants ON friends.user_two = tenants.user_id
              WHERE friends.user_one = :name;');
            $friends -> execute(['name' => $username]);
            foreach($friends as $friend) {
        ?>
             <li><?= $friend['fname'] . " " . $friend['lname'] ?></li>
        <?php
            }
        ?>
        </ul>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <h4>Your Addresses:</h4>
        <ul>
            <?php
                $addresses = $db -> prepare('SELECT properties.address AS address, properties.apartment_number AS apt_num, tenant_addresses.is_current_address AS is_addr
                    FROM properties INNER JOIN tenant_addresses ON properties.address = tenant_addresses.address
                    WHERE tenant_addresses.user_id = :name
                    ORDER BY NOT tenant_addresses.is_current_address;');
                $addresses -> execute(['name' => $username]);
                foreach($addresses as $address) {
            ?>
            <li><?php

            $curr_address = $address['is_addr'] == 1 ? 'Current Address' : 'Previous Address';
            print $address['address'] . " " . $address['apt_num'] . " | " . $curr_address;

            ?></li>
            <?php
                }
            ?>
        </ul>
    </div>
</div>
<br>
<div class="row">
    <div class="large-12 columns">
        <h5>Change profile picture: </h5>
        <form action="add_picture.php" method="post" enctype="multipart/form-data">
            <label>Select Image<input type="file" name="img" accept=".png, .jpg"></label>
            <input type="submit" value="Change picture">
        </form>
    </div>
</div>