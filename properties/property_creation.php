<?php
	//form for creating an account
	$path = "../";
	include "$path"."header.php";
	if(isset($_POST['submit'])){
		print "Submit clicked";
	}
?>
	<script src="../../js/check_user.js"></script>
	<main style="margin-top: 20px;">

		<div class="row">
			<div class="small-12 medium-12 large-12 small-centered medium-centered large-centered columns">
				<h1 align="center">List Property</h1>
			</div>
		</div>
		<form class="signForm" action="create_property.php" method="post" enctype="multipart/form-data">

		<div class="row">
			<div class="small-9 medium-9 large-12 small-centered medium-centered large-centered columns">
        <div class="large-4 column">
				<label>Address
					<input type="text" name="addressname" placeholder="Address" required>
				</label>
      </div>

        <div class="large-4 columns">
        <label>Apartment
          <input type="text" name="apartment" placeholder="apartment #">
        </label>
      </div>

      <div class="large-4 column">
      <label>City
        <input type="text" name="cityname" placeholder="city" required>
      </label>
    </div>
    </div>
		</div>



    <div class="row">
			<div class="small-10 medium-6 large-12 small-centered medium-centered large-centered columns">

        <div class="large-4 columns">
        <label>State
          <select name="statename">
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>
        </label>
      </div>

        <div class="large-4 column">
				<label>Country
					<input type="text" name="countryname" placeholder="country" required>
				</label>
      </div>

        <div class="large-4 columns">
        <label>Zip Code
          <input type="text" name="zipcode" placeholder="zip code">
        </label>
      </div>
    </div>
		</div>

    <div class="row">
      <div class="small-10 medium-6 large-12 small-centered medium-centered large-centered columns">
        <div class="large-4 column">
        <label>Monthly cost
          <input type="text" name="monthly_costProperty" placeholder="monthly cost in $" required>
        </label>
      </div>

        <div class="large-4 columns">
        <label>Currently Available?
          <select name="apartmentAvailability">
            <option value ="1">Yes</option>
            <option value ="0">No</option>
          </select>
        </label>
      </div>

      <div class="large-4 column">
      <label>Number of Beds
        <select name="numberBeds">
          <option value ="1">One Bed</option>
          <option value ="2">Two Beds</option>
          <option value ="3">Three Beds</option>
          <option value ="4">Four Beds</option>
          <option value ="5">Five Beds</option>
        </select
      </label>
    </div>
    </div>
    </div>

		<div class="row">
			<div class="small-10 medium-6 large-12 small-centered medium-centered large-centered columns">
      <div class="large-4 column">
      <label>Number of Baths
        <select name="numberBaths">
          <option value ="1">One Bath</option>
          <option value ="2">Two Bath</option>
          <option value ="3">Three Bath</option>
          <option value ="4">Four Bath</option>
          <option value ="5">Five Bath</option>
        </select
      </label>
    </div>
<!--------- -->
  <div class="large-4 column">
    <label>Water Included
      <select name="waterInclusion">
        <option value ="1">Yes</option>
        <option value ="0">No</option>
      </select>
    </label>
  </div>
  <div class="large-4 column">
    <label>Electric Included
      <select name="electricInclusion">
        <option value ="1">Yes</option>
        <option value ="0">No</option>
      </select>
    </label>
  </div>
			</div>
		</div>

    <div class="row">
			<div class="small-10 medium-6 large-12 small-centered medium-centered large-centered columns">
      <div class="large-4 column">
      <label>Heat Included
        <select name="heatInclusion">
          <option value ="1">Yes</option>
          <option value ="0">No</option>
        </select
      </label>
    </div>

  <div class="large-4 column">
    <label>Trash removal included
      <select name="trashInclusion">
        <option value ="1">Yes</option>
        <option value ="0">No</option>
      </select>
    </label>
  </div>

  <div class="large-4 column">
  <label>Parking
    <select name="parkingType">
      <option value="on-street">On-street parking</option>
      <option value="off-street">Off-street parking</option>
      <option value="Garage parking">Garage parking</option>
      <option value="Private parking lot">Private Lot</option>
      <option value="Public parking lot">Public Lot</option>
    </select>
  </label>
</div>
			</div>
		</div>



		<div class="row">
			<div class="small-10 medium-6 large-12 small-centered medium-centered large-centered columns">
        <div class="large-6 column">
        <label>Exceptional features
          <input type="text" name="exceptionalFeatures" placeholder="extra features">
        </label>
			</div>

    <div class="large-6 column">
    <label>Descriptive keywords
      <input type="text" name="keywords" placeholder="search keywords">
    </label>
  </div>
		</div>
  </div>



		<div class="row">
			<div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
				<p><input type="submit" class="button expanded" name="submit" value="List"></input></p>
			</div>
		</div>



		<div class="row">
		</div>
		</form>
	</main>
<?php
	include "$path"."footer.php";
?>
