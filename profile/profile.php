<?php
	include "session.php";
	$path = "../";
	include $path . "header.php";
	$var = $_SESSION["username"];

    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
?>
<div class="row">
    <div class="large-12 columns text-center">
        <h1>Logged in as:</h1>
        <h3>
        <p><?= $var ?></p>
        </h3>
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
            $friends -> execute(['name' => $var]);
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
                $addresses -> execute(['name' => $var]);
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