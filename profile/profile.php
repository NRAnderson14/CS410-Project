<?php
	
	$path = "../";
	include "session.php";
	include $path . "header.php";
	$username = $_SESSION["username"];

    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
    $stmt = $db -> prepare('SELECT img_url FROM users WHERE user_id = :user;');
    $stmt -> execute(['user' => $username]);
    $img_path = $stmt -> fetch();
?>

<main>
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
            $friends = $db -> prepare('(SELECT tenants.fname, tenants.lname
                                                 FROM friends INNER JOIN tenants ON friends.user_two = tenants.user_id
                                                 WHERE friends.user_one = :name) UNION
                                                 (SELECT tenants.fname, tenants.lname
                                                 FROM friends INNER JOIN tenants ON friends.user_one = tenants.user_id
                                                 WHERE friends.user_two = :name);');
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
        <h4>Friend Requests</h4>
        <ul>
            <?php
                $requests = $db -> prepare('SELECT users.fname, users.lname, users.user_id
                                                      FROM friend_requests INNER JOIN users ON friend_requests.sending_user = users.user_id
                                                      WHERE friend_requests.receiving_user = :user;');
                $requests -> execute(['user' => $username]);
                foreach($requests as $request) {
            ?>
                    <li id="buttonarea">
                        <p><?= $request['fname'] . ' ' . $request['lname'] ?></p>
                        <button name="<?= $request['user_id'] ?>" class="accept button">Accept</button>
                        <button name="<?= $request['user_id'] ?>" class="decline button">Decline</button>
                    </li>
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
            <label>Select Image<input type="file" name="img" accept=".png, .jpg, jpeg"></label>
            <input type="submit" value="Change picture">
        </form>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <p><a href="<?= $path ?>friends/friendsearch.php">Find Friends</a></p>
    </div>
</div>
</main>
<script src="../js/confirmfriend.js" type="text/javascript"></script>