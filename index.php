<?php
	$path = "";
	include "header.php";
?>
	<script type="text/javascript" src="http://www.google.com/jsapi?key=AIzaSyAJ2rfLi6pkzdNI3AcpRGvtGPSx9ScHFgc"></script>
	<script src=<?php print($path . "js/search.js") ?> ></script>
	<script src=<?php print($path . "js/geolocation.js") ?> ></script>
	<main>
	<div class="top"></div>
	<div id="searchArea" class="row" style="padding-right: 30px;">
	 <?php
		include "logo.php";
	?>
		<div class="search-bar small-10 medium-10 large-10 small-centered medium-centered large-centered columns">
			<input id="searchBar" type="text" class="searchTerm" name="search" placeholder="Try typing 'Chicago'">
			<button id="searchButton" type="submit" class="searchButton"><i class="fa fa-search"></i></button>
		</div>
	</div>
	<div class="searchDown">
		<div class="row small-12 small-centered  columns small-uncollapse">
			<div class="columns" style="text-align:center">
			<button id="advanced-searchButton" type="submit" class="advanced-searchButton">Advanced Search<i class="fa fa-angle-double-down"></i></button>
			</div>
		</div>
	</div>
<!--
		<div class="searchUp">
		<div class="row small-12 small-centered  columns small-uncollapse">
			<div class="columns" style="text-align:center">
			<button id="advanced-searchButtonClose" type="submit" class="advanced-searchButtonClose">Advanced Search<i class="fa fa-angle-double-up"></i></button>
		</div>
		</div>
	</div>
-->
	<form class="advanced-search">
		<div class="row small-8 medium-8 large-8 small-centered medium-centered large-centered columns small-uncollapse">
			<div class="small-3 columns">
				<label>Min Price
					<input type="text" placeholder="Min Price" />
				</label>
			</div>
			<div class="small-3 columns">
				<label>Max Price
					<input type="text" placeholder="Max Price" />
				</label>
			</div>
			<div class="small-3 columns">
				<label>Number of Beds
					<select>
						<option value="anyBed">Any</option>
						<option value="oneBed">1 Bed</option>
						<option value="twoBed">2 Bed</option>
						<option value="threeBed">3 Bed</option>
						<option value="fourBed">4 Bed</option>
					</select>
				</label>
			</div>
			<div class="small-3 columns">
				<label>Number of Baths
					<select>
						<option value="anyBath">Any</option>
						<option value="oneBath">1 Bath</option>
						<option value="twoBath">2 Bath</option>
						<option value="threeBath">3 Bath</option>
						<option value="fourBath">4 Bath</option>
					</select>
				</label>
			</div>
		</div>
	</form>
	<hr>
	<div class="load">
		<!--
			input property info here using database
		-->
	</div>
	</main>
	<div class="scroll-top-wrapper ">
		<span class="scroll-top-inner">
			<i class="fa fa-2x fa-arrow-circle-up"></i>
		</span>
	</div>
<?php
	include "footer.php";
?>
