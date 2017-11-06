<?php
	//form for creating an account
	$path = "../";
	include "$path"."header.php";
  if(isset($_POST['submit'])){
		print "Submit clicked";
	}
?>
<main style="margin-top: 20px;">
<div class="row">
  <div class="small-12 medium-12 large-12 small-centered medium-centered large-centered columns">
    <h1 align="center">Budget</h1>
  </div>
</div>
<form class="signForm" action="budgetCalc.php" method="post" enctype="multipart/form-data">
<div class="row">
  <div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
    <label>Monthly Income
      <input type="text" name="monthIncome" placeholder="Monthly Income" required>
    </label>
  </div>
</div>
<div class="row">
  <div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
    <label>Monthly Rent
      <input type="number" step="5" name="rentCost" placeholder="Monthly Rent (not required)">
    </label>
  </div>
</div>
<div class="row">
  <div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
    <label>Internet Cost
      <input type="number" step="5" name="internetCost" placeholder="Cost of Internet in $/per month (not required)">
    </label>
  </div>
</div>

<div class="row">
  <div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
    <label>Grocery Spending
      <input type="number" step="5" name="groceryCost" placeholder="Cost of Groceries in $/per month (not required)">
    </label>
  </div>
</div>

<div class="row">
  <div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
    <label>Other Bills
      <input type="number" step ="5" name="otherBills" placeholder="Other Bills in $/per month (not required)">
    </label>
  </div>
</div>

<div class="row">
  <div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
    <label>Monthly Savings
      <input type="number" step="5" name="monthlySavings" placeholder="Save per month in $ (not required)">
    </label>
  </div>
</div>
<div class="row">
  <div class="small-10 medium-6 large-4 small-centered medium-centered large-centered columns">
    <p><input type="submit" class="button expanded" name="submit" value="Calculate"></input></p>
  </div>
</div>
<div class="row">
</div>
</form>
</main>
