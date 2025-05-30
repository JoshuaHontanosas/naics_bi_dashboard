<!--
# get-data.php
# 
# Description: PHP file to get data for the year from SQL database.
# Author: Joshua Hontanosas
-->
<?php

// Connect to database
include 'connect.php';
$conn = OpenCon();

// Get selection (From script.js)
$q =$_GET['q'];

//My selected NAICS info in global variables
$naics_id = 443142;
$sector_id = 44;
$industry_id = 3;
$specialty_id = 1;
$subspecialty_id = 1;
$extra_id = 2;

//***Functions*** - Included custom functions for displaying year info.--------------------------------------------------------------------------
//***SQL Queries*** - Ensured that the SQL queries used variables and not hard-coded values ------------------------------------------------------

//***Year*** - This function gets the sales data for the selected year ----------------
function getYearSales(){
  global $conn, $q, $sector_id, $industry_id, $specialty_id, $subspecialty_id, $extra_id;

  $sql = "SELECT Sales, Year FROM NAICS_Transactions WHERE Year = $q and Sector = $sector_id and Industry = $industry_id and Specialty = $specialty_id and Sub_Specialty = $subspecialty_id AND Sub_Specialty_Extra = $extra_id GROUP BY Year";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<u>Total Sales</u>";
    while($row = $result->fetch_assoc()) {
      echo "<div id='data-get'>$".number_format($row["Sales"])."</div>";
    }
    //echo "</table>";
  } else {
    echo "<u>Total Sales</u>";
    echo "No sales info found.";
  }
}

//***Purchases*** - This function gets the purchases data for the selected year ----------------
function getYearPurchases(){
  global $conn, $q, $sector_id, $industry_id, $specialty_id, $subspecialty_id, $extra_id;

  $sql = "SELECT Purchases, Year FROM NAICS_Transactions WHERE Year = $q and Sector = $sector_id and Industry = $industry_id and Specialty = $specialty_id and Sub_Specialty = $subspecialty_id AND Sub_Specialty_Extra = $extra_id GROUP BY Year";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<u>Total Purchases</u>";
    while($row = $result->fetch_assoc()) {
      echo "<div id='data-get'>$".number_format($row["Purchases"])."</div>";
    }
  } else {
    echo "<u>Total purchases</u>";
    echo "No purchase info found.";
  }
}

function calculateProfit(){
  global $conn, $q, $sector_id, $industry_id, $specialty_id, $subspecialty_id, $extra_id;

  $sql = "SELECT Sales - Purchases as Profit, Year FROM NAICS_Transactions WHERE Year = $q and Sector = $sector_id and Industry = $industry_id and Specialty = $specialty_id and Sub_Specialty = $subspecialty_id AND Sub_Specialty_Extra = $extra_id GROUP BY Year";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<u>Overall Profit</u>";
      while($row = $result->fetch_assoc()) {
        echo "<div id='data-get'>$".number_format($row["Profit"])."</div>";
      }
      //echo "</table>";
    } else {
      echo "<u>Overall Profit</u>";
      echo "Cannot calucate profit.";
    }
}

  function getGraph(){
    global $conn, $q, $sector_id, $industry_id, $specialty_id, $subspecialty_id, $extra_id;

    $sql = "SELECT Sales, Purchases, Sales - Purchases as Profit, Year FROM NAICS_Transactions WHERE Year = $q and Sector = $sector_id and Industry = $industry_id and Specialty = $specialty_id and Sub_Specialty = $subspecialty_id AND Sub_Specialty_Extra = $extra_id GROUP BY Year";
    $result = $conn->query($sql);

    $dataArray = array();

    while($data=mysqli_fetch_array($result)){
      $year = $data['Year'];
      $sales = $data['Sales'];
      $purchases = $data['Purchases'];
      $profit = $data['Profit'];

      //$tempArray = array("year" => $year, "sales" => $sales, "purchases" => $purchases, "profit" => $profit);
      
      //array_push($dataArray, $tempArray);
      array_push($dataArray, $sales);
    }
    return $dataArray;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Final Project</title>
  <head>
<body>

<!-- *Year Info* -->
<section class="yearInfoLayout"> 
  <div class="yearInfoBox"> 
    <!-- *Get year sales data* -->
    <?php getYearSales(); ?>
  </div>
  <div class="yearInfoBox"> 
    <!-- *Get year purchases data* -->
    <?php getYearPurchases(); ?>
  </div>
  <div class="yearInfoBox">
    <!-- *Get year profit data* -->
    <?php calculateProfit(); ?>
  </div>
</section>
<?php getGraph(); ?>
<script>
  var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      title:{
        text: "Yearly Financial Data"
      },
      axisY:{
        title: "Money (in USD)",
        includeZero: true,
        prefix: "$"
      },
      data: [{
          type: "bar",
          indexLabel:"{year}"
          dataPoints: <?php echo json_encode(getGraph(), JSON_NUMERIC_CHECK); ?>
      }]
  });
  chart.render();
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"> </div>
<script src="https://canvasjs.com/assets/script/canvasjs.mis.js"></script>
</body>
</html>