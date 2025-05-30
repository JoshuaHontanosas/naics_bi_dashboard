<!--
# index.phy
# 
# Description: The main file for the dashboard.
# Author: Joshua Hontanosas
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="NAICS BI Dashboard">
    <meta name="author" content="Joshua Hontanosas">
    <meta name="viewport" content="width=device-witdh, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <!-- Implementing AJAX: https://www.w3schools.com/jquery/jquery_get_started.asp -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>NAICS BI Dashboard</title>

<!--***Consistent Theme*** - Theme maintains a similar look. -->
</head>
<body>
  <h1><u>Business Analysis Dashboard</u></h1>
  <!-- Displays NAICS Information (For 'Specific Identification' on the rubric) -->
  <div class ="naicsDisplay">
  <?php include('naics_menu.php') ?>
  </div>

  
<!--***Year*** - This form ensures the dashboard starts with the current year. (NOTE: Simply refreshing the page does not reset the age back to 2022.) -->
  <!-- Displays year data ('Status Presentation' on rubric) -->
  <h1><u>Yearly Data</u></h1>
  <div class ="yearDisplay">
  <div class="yearSelect">Select Year:</div>
  <form>
    <select class="dropdown" name="year" onclick="showUser(this.value)"> 
      <option value="2012">2012</option>
      <option value="2013">2013</option>
      <option value="2014">2014</option>
      <option value="2015">2015</option>
      <option value="2016">2016</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
      <option value="2021">2021</option>
      <option selected value="2022">2022</option>
      </select>
    </form>
  </div>
  <div id="txtHint"><b>Yearly Data will be displayed here</b></div>
  
  <h1><u>Lookup Industry</u></h1>
  <div class = "compareDisplay">
    <form class = naicsForm action="find-naics.php" method="post">
      <div class = "enterNAICS">Enter NAICS Code of industry you want to see:</div> 
      <input type="text" name="competitorNAICS">
      <input type="submit" name="submit" value="Search">
    </form>
    <p>Created by Joshua Hontanosas</p>
</body>

<!-- Including Javascript file -->
<script src="script.js"></script>

</html>