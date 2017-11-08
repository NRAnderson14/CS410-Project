<?php
    $path = "../";
    include "session.php";
    include $path . "header.php";
    $username = $_SESSION["username"];

    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
    $stmt = $db -> prepare('SELECT profile_img_url, IFNULL(company_name, fname) AS name1, IFNULL(lname, 1) AS name2 FROM landlords WHERE username = :user;');
    $stmt -> execute(['user' => $username]);
    $usr_info = $stmt -> fetch();

    if ($usr_info['name2'] == 1) { //They have a company name
        $name = $usr_info['name1'];
    } else {    //First and last name
        $name = $usr_info['name1'] . ' ' . $usr_info['name2'];
    }
?>

<main>
    <div class="topSpace"></div>
    <div class="row">
        <div id="profileBox" class="column large-7">
            <div id="imageArea">
                <form id="imageForm" action="add_picture.php" method="post" enctype="multipart/form-data">
                    <label id="changePic" class="fa fa-camera"><input id="pictureInput" class="hide" type="file" name="img" accept=".png, .jpg, .jpeg"></label>
                    <input type="submit" value="Change picture"  class="hide" >
                </form>
                <img src="<?= $path . $usr_info['profile_img_url'] ?>" alt="Profile Picture" id="profilePicture">
            </div>


            <div class="informationBox">
                <h1 id="userName"><?= $name ?></h1>
                <p class="socialBox">
                    <span class="fa fa-facebook-official" aria-hidden="true"></span>
                    <span class="fa fa-instagram" aria-hidden="true"></span>
                    <span class="fa fa-linkedin-square" aria-hidden="true"></span>
                    <span class="fa fa-twitter-square" aria-hidden="true"></span>
                    <span class="fa fa-youtube-square" aria-hidden="true"></span>
                </p>
            </div>
            <?php
                //Get the rating for the landlord
                $rating_stmt = $db -> prepare('SELECT AVG(rating) AS rating FROM landlord_ratings WHERE landlord = :user;');
                $rating_stmt -> execute(['user' => $username]);

                $rating = $rating_stmt -> fetch();
                $ratingval = round($rating['rating']);
            ?>
            <div class="profileRating">
                <h2 class="yourRating">Your Rating</h2>
                <?php
                for($i = 0; $i < $ratingval; $i++){
                    ?>
                    <span class="fa fa-star profileStar" aria-hidden="true"></span>
                    <?php
                }
                for($i = 0; $i < 5-$ratingval; $i++){
                    ?>
                    <span class="fa fa-star-o profileStar" aria-hidden="true"></span>
                    <?php
                }
                ?>
            </div>
        </div>
        <div id="customFeed" class="column large-4">
            <h3 id="customFeedTitle">News Feed</h3>
        </div>
    </div>
    <div>
        <h6>Your properties:</h6>
        <ul>
            <?php
                //Get the landlord's properties
                $properties_stmt = $db -> prepare('SELECT property_id, address, apartment FROM properties WHERE landlord = :user;');
                $properties_stmt -> execute(['user' => $username]);

                foreach($properties_stmt as $property) {
                    ?>
                    <li><a href="../properties/property.php?id=<?= $property['property_id'] ?>"><?= $property['address'] . ' ' . $property['apartment'] ?></a></li>
                    <?php
                }
            ?>
        </ul>
    </div>

</main>
<script src="../js/confirmfriend.js" type="text/javascript"></script>
<?php
include '../footer.php';
?>

