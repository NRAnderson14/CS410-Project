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
    $path = '../';
	$db = new PDO("mysql:dbname=rent_smart;host=localhost","root");
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
								  LIMIT $startPage, $propertiesPerPage;");
  	}
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
		?>
		<div class="column">
			<div class="myCard">
				<a href="properties/property.php?id=<?=$property_id?>">
					<h5 class="propertyTitle" ><?=$address?></h5>
					<img src="<?=$img?>" class="thumbnail propertyImages" alt="">
					<div class="card-section">
						<!-- Star Rating still needs to be generated dinamically-->
						<div class="stars">
							<span class="fa fa-star" aria-hidden="true"></span>
							<span class="fa fa-star" aria-hidden="true"></span>
							<span class="fa fa-star" aria-hidden="true"></span>
							<span class="fa fa-star-half-o" aria-hidden="true"></span>
							<span class="fa fa-star-o" aria-hidden="true"></span>
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
