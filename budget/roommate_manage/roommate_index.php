<?php
	$path = "../../";
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
?>
<script src=<?php print($path . "js/search.js") ?> ></script>
<main>

  <div class="row">
      <div id="profileBox" class="column large-3">
              <div id="imageArea">
              <img src="<?= $path . $usr_info['profile_img_url'] ?>" alt="" id="profilePicture">
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

    <div id="profileBox" class="column large-3">
            <div id="imageArea">
            <img src="<?= $path . $usr_info['profile_img_url'] ?>" alt="" id="profilePicture">
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


<?php
$i = 9;
if($i==10){
  include 'roommateProfile.php';
}else{
  alert("yeah not 10");
}
?>

  </div>



</main>

<?php
	include $path . 'footer.php';
?>
