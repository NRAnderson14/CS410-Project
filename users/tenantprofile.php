<?php
    $path = '../';
    include $path . 'profile/session.php';
    include $path . 'header.php';

    $user = $_GET['user'];
    $user_viewing = $_SESSION['username'];

    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
    $stmt = $db -> prepare('SELECT tenants.username, tenants.fname, tenants.lname, tenants.profile_img_url, tenants.about_tenant
                                      FROM tenants
                                      WHERE tenants.username = :user;');
    $stmt -> execute(['user' => $user]);
    $user_info = $stmt -> fetch();

    $stmt2 = $db -> prepare('(SELECT user_one AS friend FROM friends WHERE user_two = :user_viewing AND user_one = :friend) UNION
                                       (SELECT user_two AS friend FROM friends WHERE user_one = :user_viewing AND user_two = :friend);');
    $stmt2 -> execute(['user_viewing' => $user_viewing, 'friend' => $user]);
    $is_friend = $stmt2->rowCount() > 0 ? true : false;
    if ($user_viewing == $user) {
        $is_friend = true;  //Looking at your own profile
    }
    $rating_stmt = $db -> prepare('SELECT AVG(user_rating) AS rating FROM tenant_ratings WHERE username = :user;');
    $rating_stmt -> execute(['user' => $username]);

    $rating = $rating_stmt -> fetch();
    $ratingval = $rating['rating'];
    $ratingval = $ratingval * 2.0;
    $ratingval = round($ratingval);
    $ratingval = $ratingval / 2.0;
?>
<main>
  <div class="row">
      <div id="profileBox" class="large-12 large-centered text-center columns">
              <div id="imageArea">
              <img src="<?= "../" . $usr_info['profile_img_url'] ?>" alt="" id="profilePicture">
              <form id="imageForm" action="add_picture.php" method="post" enctype="multipart/form-data">
                  <input type="submit" value="Change picture"  class="hide" >
                  <label id="changePic" class="fa fa-camera"><input id="pictureInput" class="hide" type="file" name="img" accept=".png, .jpg, .jpeg"></label>
                  </form>

              </div>

              <div class="informationBox">
                  <h1 id="userName"><?= $user ?></h1>

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
          <div class="row">
              <div class="large-12 columns text-center">
                  <button class="button" id="addbutton" name="<?= $user_info['username'] ?>"<?= $is_friend ? "disabled" : "" ?>>Add Friend</button>
              </div>
          </div>
          </div>
      </div>
<div id="burner"></div>
</main>
<?php
if (!$is_friend) {
    print '<script src="../js/addfriend.js" type="text/javascript"></script>';
}
include $path . 'footer.php';
