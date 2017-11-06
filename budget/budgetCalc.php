<?php
	$path = "../";
	include $path . "header.php";

  if(isset($_POST['monthIncome'])){
		$monthIncome = $_POST['monthIncome'];
}

  if(isset($_POST['rentCost'])){
  		$rentCost = $_POST['rentCost'];
    }
else{
  $rentCost = 0;
}
  if(isset($_POST['internetCost'])){
    		$internetCost = $_POST['internetCost'];
      }
else{
  $internetCost = 0;
}

if(isset($_POST['groceryCost'])){
      $groceryCost = $_POST['groceryCost'];
    }
else{
$internetCost = 0;
}

if(isset($_POST['otherBills'])){
      $otherBills = $_POST['otherBills'];
    }
else{
$otherBills = 0;
}

if(isset($_POST['monthlySavings'])){
      $monthlySavings = $_POST['monthlySavings'];
    }
else{
$monthlySavings = 0;
}


$totalOnApartment = ($monthIncome - $rentCost - $internetCost - $groceryCost - $otherBills);

echo "you make $", $monthIncome, " per month<br>";
echo "you spend $", $rentCost, " on rent per month<br>";
echo "you spend $", $internetCost, " on internet per month<br>";
echo "you spend $", $groceryCost, " on groceries per month<br>";
echo "you spend $", $otherBills, " on other bills per month<br><br>";

echo "you can spend $", $totalOnApartment, " per month on an apartment";
?>
