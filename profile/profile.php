<?php

	$path = "../";
	include "session.php";
	include $path . "header.php";
	$username = $_SESSION["username"];

    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
    $stmt = $db -> prepare('SELECT profile_img_url, fname, lname FROM tenants WHERE username = :user;');
    $stmt -> execute(['user' => $username]);
    $usr_info = $stmt -> fetch();
	

    $rating_stmt = $db -> prepare('SELECT AVG(user_rating) AS rating FROM tenant_ratings WHERE username = :user;');
    $rating_stmt -> execute(['user' => $username]);

    $rating = $rating_stmt -> fetch();
    $ratingval = $rating['rating'];
    $ratingval = $ratingval * 2.0;
    $ratingval = round($ratingval);
    $ratingval = $ratingval / 2.0;
        $path = "";

    if($usr_info['profile_img_url'] == "") {
        $usr_info['profile_img_url'] = "images/placeholder.png";
    }
?>
	<script src=<?php print($path . "js/search.js") ?> ></script>
	<script src="../js/news_feed.js"></script>

<main>

    <!-- <div class="topSpace"></div> -->
    <div class="row">

        <div id="profileBox" class="column large-3" style="margin-top: 30px;">

                <div id="imageArea">
                <img src="<?= "../" . $usr_info['profile_img_url'] ?>" alt="" id="profilePicture">
                <form id="imageForm" action="add_picture.php" method="post" enctype="multipart/form-data">
                    <input type="submit" value="Change picture"  class="hide" >
                    <label id="changePic" class="fa fa-camera"><input id="pictureInput" class="hide" type="file" name="img" accept=".png, .jpg, .jpeg"></label>
                    </form>

                </div>


                <div class="informationBox">
                    <h1 id="userName"><?= $usr_info['fname'] . ' ' . $usr_info['lname'] ?></h1>
					
                    <div class="profileRating">
                        <!-- <h2 class="yourRating">Your Rating</h2> -->
                    <?php
					$fname = $usr_info['fname'];
					$lname = $usr_info['lname'];
                    for($i = 1.0; $i <= 5.0; $i += 1.0) {
                        if($ratingval > $i || $ratingval == $i) {
                            //Whole star
                            print '<span class="fa fa-star profileStar" aria-hidden="true"></span>';
                        } else if($ratingval > $i-1 && $ratingval < $i) {
                            //Half star
                            print '<span class="fa fa-star-half-o profileStar" aria-hidden="true"></span>';
                        } else {
                            //Empty star
                            print '<span class="fa fa-star-o profileStar" aria-hidden="true"></span>';
                        }
                    }
                    ?>
                </div>


                    <p class="socialBox">
                        <span class="fa fa-facebook-official" aria-hidden="true"></span>
                        <span class="fa fa-instagram" aria-hidden="true"></span>
                        <span class="fa fa-linkedin-square" aria-hidden="true"></span>
                        <span class="fa fa-twitter-square" aria-hidden="true"></span>
                        <span class="fa fa-youtube-square" aria-hidden="true"></span>
                    </p>
                </div>



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
                <li><a href="../properties/property.php?id=<?= $address['property_id'] ?>"> <a target="_blank" href="https://www.google.com/maps/place/ <?=$address['address'] ?>"><span class="fa fa-map-marker"></span></a> <?php

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
		<div style="background: #FBFBFB; margin-top: 30px; padding-top: 20px;" class="column large-8">
			<h3 style="text-align: center;">Post to Feed</h3>
			<input id="post-text" style="width: 80%; margin: auto;" type="text" placeholder="What's on your mind, <?=$fname?>?">
			<button id="post-button" style="height: 20px; background: #4266DA; color: white; padding: 10px 20px 23px 20px; border-radius: 3px; margin-right: 10%; margin-top: 10px; float: right;">Post</button>
			<h3 style="text-align: center; margin-top: 10px; border-bottom: 1px solid #CACACA; padding-top: 20px;">News Feed</h3>
			<div id="post-load"></div>
        </div>
    </div>

    <div class="row">
        <div class="large-12 columns">
            <!-- <h4>Your Friends:</h4>
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
                    <li><a href="../users/tenantprofile.php?user=<?= $friend['username'] ?>"><?= $friend['fname'] . " " . $friend['lname'] ?></a></li>
            <?php
                }
            ?>
            </ul> -->
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <!-- <h4>Your Addresses:</h4>
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
            </ul> -->
        </div>
    </div>
    <br>
    <div class="row">
        <!-- <div class="large-12 columns">
            <h4>Friend Requests</h4>
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
        </div> -->
    </div>
    <br>
    <div class="row">
        <div class="large-12 columns">
            <!-- <h5>Change profile picture: </h5>
            <form action="add_picture.php" method="post" enctype="multipart/form-data">
                <label class="fa fa-camera"><input class="hide" type="file" name="img" accept=".png, .jpg, jpeg"></label>
                <input type="submit" value="Change picture">
            </form> -->
        </div>
    </div>


    <div class="row">
        <div class="large-12 columns">
            <p><a href="<?= $path ?>../budget/roommate_manage/roommate_index.php">Roommate Manage</a></p>
        </div>
    </div>

		<div class="row">
				<div class="large-12 columns">
					<p><a data-open="settings-modal">What can I pay for rent?</a></p>
					<div class="reveal" id="settings-modal" data-reveal>
						<main>
							<div class="row">
	  					<div class="small-12 medium-12 large-12 small-centered medium-centered large-centered columns">
	    	<h4 align="center">Monthly Rent Estimation</h4>
				<hr>
	  </div>
							</div>

							<form id="modalForm" class="signForm">
								<div class="row">
	  						<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
	    				<label>Monthly Income
	      	<input type="text" name="monthIncome" id="monthIncome" placeholder="Monthly Income" required>
	    	</label>
	  	</div>
		</div>
		<div class="row">
	  	<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
	    	<label>Internet Cost
	      	<input type="number" step="5" name="internetCost" id="internetCost" placeholder="Cost of Internet in $/per month (not required)" value=40>
	    	</label>
	  </div>
	</div>

	<div class="row">
	  <div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
	    <label>Grocery Spending
	      <input type="number" step="5" name="groceryCost" id="groceryCost" placeholder="Cost of Groceries in $/per month (not required)" value=125>
	    </label>
	  </div>
	</div>

	<div class="row">
	  <div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
	    <label>Other Bills
	      <input type="number" step ="5" name="otherBills" id="otherBills" placeholder="Other Bills in $/per month (not required)" value=100>
	    </label>
	  </div>
	</div>

	<div class="row">
	  <div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
	    <input id="monthlyCalculate" type="button" class="button expanded" name="submit" value="Calculate" onclick="myAlert()" onclick="myCalc()">
	  </div>
	</div>
	<div class="row">
	</div>
	</form>

	<div id="calculated">
		<p align="center" id="yuh"></p>
	</div>
	</main>

	<button class="close-button" data-close aria-label="Close modal" type="button">
  <a href="javascript:history.go(0)">&times;</A>
</button>
</div>
</div>
</div>
</main>

<script src="../js/confirmfriend.js" type="text/javascript"></script>

<script>
var formmm = document.getElementById("calculated");
formmm.style.display = "none";
function myAlert(){
	var monthlyIncome = document.getElementById("monthIncome").value;
	var internetCost = document.getElementById("internetCost").value;
	var groceryCost = document.getElementById("groceryCost").value;
	var otherBills= document.getElementById("otherBills").value;

	var total = (monthlyIncome - internetCost - groceryCost - otherBills);

	var formm = document.getElementById("modalForm");
	formm.style.display = "none";
	formmm.style.display ="block";
	document.getElementById("yuh").innerHTML = "You can pay " + total + " per month for an apartment";
}
</script>
<label style="top:50px;" id="post-user" hidden><?=$username?></label>
<script src="../js/notification.js"></script>
<?php
	include '../footer.php';
?>
