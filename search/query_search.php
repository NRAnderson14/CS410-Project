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

  	if(isset($_POST['search'])){
  	   $search = $_POST['search'];
  	}
	$rows = $db->query("SELECT SQL_CALC_FOUND_ROWS
                                      property_id, address, price, name, email, phone, landlord, image_url
                                      FROM `properties`
                                      WHERE address
                                       LIKE '%$search%'
                                       OR name
                                       LIKE '%$search%'
                                       LIMIT $startPage, $propertiesPerPage;");

  $rowsCount = $db->query("SELECT FOUND_ROWS() as rowsCount") ->fetch()['rowsCount'];
  $totalPage = (int)($rowsCount / $propertiesPerPage);
  if ($totalPage > 30){
    $totalPage = 30;
  }

  /////////
?>
	<div class="row small-up-1 medium-up-2 large-up-3">
		<?php
		$count = 0;
			foreach($rows as $row){
				$property_id=$row['property_id'];
				$address=$row['address'];
				$price=$row['price'];
				$name=$row['name'];
				$email=$row['email'];
				$phone=$row['phone'];
				$landlord=$row['landlord'];
				$img = $row['image_url'];
		?>
			<div class="column column-block">
			<div class="name">
				<p><a href="properties/property.php?id=<?=$property_id?>"><?=$name?></a></p>
			</div>
				<a href="properties/property.php?id=<?=$property_id?>"><img src="images/<?=$img?>" class="thumbnail propertyImages" alt=""></a>
				<div style="padding-left: 10px;">
					<p>$<?=$price?></p>
					<p><?=$address?></p>
					<p><?=$email?></p>
					<p><?=$phone?></p>
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
