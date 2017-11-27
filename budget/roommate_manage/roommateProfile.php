<div class="profileContainer">
    <h4 class="sideTitle">Your Friends:</h4>
    <div class="collapsable">
        <ul>
        <?php
            $friends = $db -> prepare('(SELECT tenants.fname, tenants.lname, tenants.username
                                                FROM friends INNER JOIN tenants ON friends.user_two = tenants.username
                                                WHERE friends.user_one = :name) UNION
                                                (SELECT tenants.fname, tenants.lname, tenants.username
                                                FROM friends INNER JOIN tenants ON friends.user_one = tenants.username
                                                WHERE friends.user_two = :name);');
            $friends -> execute(['name' => $username]);
            foreach($friends as $friend) {
        ?>
                <li ><a href="../users/tenantprofile.php?user=<?= $friend['username'] ?>"><?= $friend['fname'] . " " . $friend['lname'] ?></a></li>
        <?php
            }
        ?>
        </ul>

        </div>
</div>

<div class="profileContainer">
    <h4 class="sideTitle">Friend Requests</h4>
    <div class="collapsable">

    <ul>
        <?php
            $requests = $db -> prepare('SELECT tenants.fname, tenants.lname, tenants.username
                                                FROM friend_requests INNER JOIN tenants ON friend_requests.sending_user = tenants.username
                                                WHERE friend_requests.receiving_user = :user;');
            $requests -> execute(['user' => $username]);
            foreach($requests as $request) {
        ?>
                <li id="buttonarea" >
                    <p><?= $request['fname'] . ' ' . $request['lname'] ?></p>
                    <button name="<?= $request['username'] ?>" class="accept button">Accept</button>
                    <button name="<?= $request['username'] ?>" class="decline button">Decline</button>
                </li>
        <?php
            }
        ?>
    </ul>

    </div>
</div>

<div class="profileContainer">
<h4 class="sideTitle">Your Addresses:</h4>
    <div class="collapsable">
    <ul>
        <?php
            $addresses = $db -> prepare('SELECT properties.property_id, properties.address, properties.apartment AS apt, tenant_addresses.is_current_address AS is_addr
                                                FROM properties INNER JOIN tenant_addresses ON properties.property_id = tenant_addresses.property_id
                                                WHERE tenant_addresses.username = :name
                                                ORDER BY NOT tenant_addresses.is_current_address;');
            $addresses -> execute(['name' => $username]);
            foreach($addresses as $address) {
        ?>
        <li><a href="../properties/property.php?id=<?= $address['property_id'] ?>"><?php

        $curr_address = $address['is_addr'] == 1 ? 'Current Address' : 'Previous Address';
        print $address['address'] . " " . $address['apt'] . "</a> | " . $curr_address;

            ?></li>
        <?php
            }
        ?>
    </ul>

    </div>
</div>

<div class="profileContainer">
    <h4 class="sideTitle">Friend Requests</h4>
    <div class="collapsable">

    <ul>
        <?php
            $requests = $db -> prepare('SELECT tenants.fname, tenants.lname, tenants.username
                                                FROM friend_requests INNER JOIN tenants ON friend_requests.sending_user = tenants.username
                                                WHERE friend_requests.receiving_user = :user;');
            $requests -> execute(['user' => $username]);
            foreach($requests as $request) {
        ?>
                <li id="buttonarea">
                    <p><?= $request['fname'] . ' ' . $request['lname'] ?></p>
                    <button name="<?= $request['username'] ?>" class="accept button">Accept</button>
                    <button name="<?= $request['username'] ?>" class="decline button">Decline</button>
                </li>
        <?php
            }
        ?>
    </ul>
    </div>
</div>
</div>
