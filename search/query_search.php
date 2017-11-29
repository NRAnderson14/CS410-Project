<!-- Style Unsure if it can be anywhere else -->
<style>
.pagination{
  width:  100%;
  height: 75px;
  text-align: center;
  padding-right: 10px;
}

.pagination a:hover{
  background-color: var(--main_blue);
}
</style>
<?php
    $username = "";
    $path = '../';
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
	if (!isset($_SESSION)) {
        session_start();
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }
    } else {
        $username = $_SESSION['username'];
    }
  //Original
  //    if(isset($_POST['search'])){
  //  	   $search = $_POST['search'];
  //	}
  //$rows = $db->query("SELECT SQL_CALC_FOUND_ROWS property_id, address, price, name, email, phone, landlord, image_url FROM `properties` WHERE address LIKE '%$search%' OR name LIKE '%$search%';")
  //What I changed

    $propertiesPerPage = 18;
    $startPage = isset($_GET['startPage']) ? (int)$_GET['page'] : 1;
    $startPage = ($startPage > 1) ? ($startPage * $propertiesPerPage) - $propertiesPerPage : 0;

	if(isset($_POST['city']) || isset($_POST['state'])){
		$city = $_POST['city'];
		$state = $_POST['state'];
		$rows = $db->query("SELECT SQL_CALC_FOUND_ROWS
                                  property_id, address, monthly_cost, landlord, state, country
                                  FROM `properties`
                                  WHERE city LIKE '%$city%'
								  OR state LIKE '%$state%';");
	}


  if(isset($_POST['priceMin'])){
    $priceMin = $_POST['priceMin'];
  }
  if(isset($_POST['priceMax'])){
    $priceMax = $_POST['priceMax'];
  }

  if(isset($_POST['numBeds']) && isset($_POST['numBedsSecond'])){
    if($_POST['numBeds'] > 0){
    $numBeds = $_POST['numBeds'];
    $numBedsSecond = $_POST['numBeds'];
}else{
  $numBeds = 0;
  $numBedsSecond = 10;
}}

if(isset($_POST['numBaths']) && isset($_POST['numBathsSecond'])){
  if($_POST['numBaths'] > 0){
  $numBaths = $_POST['numBaths'];
  $numBathsSecond = $_POST['numBaths'];
}else{
$numBaths = 0;
$numBathsSecond = 10;
}}

  if(isset($_POST['search'])){
    $search = $_POST['search'];
    $rows = $db->query("SELECT SQL_CALC_FOUND_ROWS
                                           property_id, address, monthly_cost, landlord, state, country
                                           FROM `properties`
                                           WHERE (monthly_cost >= $priceMin AND monthly_cost <= $priceMax)
                                           AND (beds >= $numBeds AND beds <= $numBedsSecond)
                                           AND (baths >= $numBaths AND baths <= $numBathsSecond)
                                           AND (city LIKE '%$search%'
                                           OR state LIKE '%$search%'
                                           OR address LIKE '%$search%'
                                           OR country LIKE '%$search%'
                                           OR monthly_cost LIKE '%$search%'
                                           OR landlord LIKE '%$search%'
                                           OR CONCAT(city, ', ', state) LIKE '%$search%'
                                           OR CONCAT(city, ' ', state) LIKE '%$search%')
                                           LIMIT $startPage, $propertiesPerPage;");
  }

/* original serach query ///
  if(isset($_POST['search'])){
  	   $search = $_POST['search'];
	   $rows = $db->query("SELECT SQL_CALC_FOUND_ROWS
                                  property_id, address, monthly_cost, landlord, state, country
                                  FROM `properties`
                                  WHERE city LIKE '%$search%'
								  OR state LIKE '%$search%'
								  OR address LIKE '%$search%'
								  OR country LIKE '%$search%'
								  OR monthly_cost LIKE '%$search%'
								  OR landlord LIKE '%$search%'
								  OR CONCAT(city, ', ', state) LIKE '%$search%'
								  OR CONCAT(city, ' ', state) LIKE '%$search%'
								  LIMIT $startPage, $propertiesPerPage;");
  	}*/

  $rowsCount = $db->query("SELECT FOUND_ROWS() as rowsCount") ->fetch()['rowsCount'];
  $totalPage = (int)($rowsCount / $propertiesPerPage);
  if ($totalPage > 30){
    $totalPage = 30;
  }

?>

	<div class="row small-up-1 medium-up-2 large-up-3 align-center">
		<?php
		$count = 0;
			foreach($rows as $row){
				$property_id=$row['property_id'];
				$address=$row['address'];
				$price=$row['monthly_cost'];
				$landlord=$row['landlord'];

				//TODO: Not have three queries for each result on the page
                $landlord_stmt = $db -> prepare('SELECT public_email, phone FROM landlords WHERE username = :landlord;');
                $landlord_stmt -> execute(['landlord' => $landlord]);
                $landlord_info = $landlord_stmt -> fetch(PDO::FETCH_ASSOC);
                $email = $landlord_info['public_email'];
                $phone = $landlord_info['phone'];

                $imgs_stmt = $db -> prepare('SELECT image_url FROM property_images WHERE property_id = :id;');
                $imgs_stmt -> execute(['id' => $property_id]);
                $imgs = $imgs_stmt -> fetch(PDO::FETCH_ASSOC);
                $img = $imgs['image_url'];

                $property_rating_stmt = $db -> prepare('SELECT AVG(rating) AS rating FROM property_ratings WHERE property_id = :pid;');
                $property_rating_stmt -> execute(['pid' => $property_id]);

                $property_rating = $property_rating_stmt -> fetch();
                $property_rating_val = $property_rating['rating'];
                $property_rating_val = $property_rating_val * 2.0;
                $property_rating_val = round($property_rating_val);
                $property_rating_val = $property_rating_val / 2.0;

                $user_has_rated_stmt = $db -> prepare('SELECT rating_tenant, rating FROM property_ratings WHERE property_id = :pid AND rating_tenant = :user;');
                $user_has_rated_stmt -> execute(['pid' => $property_id, 'user' => $username]);

                $user_rated_results = $user_has_rated_stmt -> fetch();
                if ($user_rated_results['rating_tenant'] != null) {
                    $user_has_rated = true;
                    //Get the user's rating instead of the actual rating
                    $property_rating_val = $user_rated_results['rating'];
                    $property_rating_val = $property_rating_val * 2.0;
                    $property_rating_val = round($property_rating_val);
                    $property_rating_val = $property_rating_val / 2.0;
                } else {
                    $user_has_rated = false;
                }
		?>
		<div class="column">
			<div class="myCard">
				<a href="properties/property.php?id=<?=$property_id?>">
					<h5 class="propertyTitle" ><?=$address?></h5>
					<img src="<?=$img?>" class="thumbnail propertyImages" alt="">
					<div class="card-section">
                        <?php
                        if ($user_has_rated) {
                            print '<div id="rating-stars" class="row user-has-rated-stars">';
                            $star_color = "#f4d940";
                        } else {
                            print '<div id="rating-stars" class="row stars">';
                            $star_color = "";
                        }

                        if ($property_rating_val == 0) {
                            print '<h4>No ratings yet</h4>';
                        } else {
                            for ($i = 1.0; $i <= 5.0; $i += 1.0) {
                                if ($property_rating_val > $i || $property_rating_val == $i) {
                                    //Whole star
                                    print '<span class="fa fa-star profileStar" aria-hidden="true" style="color: ' . $star_color . '"></span>';
                                } else if ($property_rating_val > $i - 1 && $property_rating_val < $i) {
                                    //Half star
                                    print '<span class="fa fa-star-half-o profileStar" aria-hidden="true" style="color: ' . $star_color . '"></span>';
                                } else {
                                    //Empty star
                                    print '<span class="fa fa-star-o profileStar" aria-hidden="true" style="color: ' . $star_color . '"></span>';
                                }
                            }
                        }
                        ?>
						</div>
						<p class="price" >$<?=$price?></p>
						<hr>
						<p class="item"><?=$address?></p>
						<p class="item"><?=$email?></p>
						<p class="item"><?=$phone?></p>
					</div>
				</a>
			</div>
		</div>
		<?php
			}
		?>
	</div>

<!--What I added -->
    <div class ="pagination">
		<ul>
      <?php for($i = 1; $i <= $totalPage; $i++): ?>
			<li><a href="?startPage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
      <?php endfor; ?>
		</ul>
    </div>
