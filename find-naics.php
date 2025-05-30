<!--
# find-naics.php
# 
# Description: PHP file to search for NAICS code and display its information.
# Author: Joshua Hontanosas
-->
<?php

// Connect to database
include 'connect.php';
$conn = OpenCon();

//***Functions*** - Included custom functions for displaying NAICS info.--------------------------------------------------------------------------
//***SQL Queries*** - Ensured that the SQL queries used variables and not hard-coded values ------------------------------------------------------

//***Validation Handling*** - Will check the entered NAICS code to ensure it is valid. */
function validateNAICS(){

    //Validation handling
    if(empty($_POST['competitorNAICS'])){
        echo '<div class="errorFont">No NAICS code entered. Return to main page and enter a valid NAICS code.</div>';
    }
    else if(!is_numeric($_POST['competitorNAICS'])){
        echo '<div class="errorFont">Error: You did not enter numbers only. Return to main page and enter a valid NAICS code.</div>';
    }
    else if(strlen($_POST['competitorNAICS']) != 6){
        echo '<div class="errorFont">Invalid amount of digits. Return to main page and enter a valid NAICS code.</div>';
    }
    else{
        //Exception handling through try-catch block
        try {
            searchNAICS();
        }
        catch (Exception $e) {
            echo '<div class="errorFont">'.$e."</div>";
        }
    }   
}

//***Exception Handling*** - Throw exception if NAICS code entered is not in database. */
function searchNAICS(){
    global $conn;
  
    $csector_id = substr($_POST['competitorNAICS'], 0, 2);
    $cindustry_id = substr($_POST['competitorNAICS'], 2, 1);
    $cspecialty_id = substr($_POST['competitorNAICS'], 3, 1);
    $csubspecialty_id = substr($_POST['competitorNAICS'], 4, 1);
    $cextra_id = substr($_POST['competitorNAICS'], 5, 1);
    
    $sql = "SELECT NE_Extra_Name FROM NAICS_Extra WHERE NE_Sector_ID = $csector_id and NE_Industry_ID = $cindustry_id and NE_Specialty_ID = $cspecialty_id and NE_Subspecialty_ID = $csubspecialty_id and NE_Extra_ID = $cextra_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 0) {    
        throw new Exception('NAICS code not found. Return to main page and enter an existing NAICS code.');
    }   
    else {
        showInfo();
    }
}

function getSectorName2(){
    global $conn;
    $csector_id = intval(substr($_POST['competitorNAICS'], 0, 2));

    $sql = "SELECT NSE_Sector_Name FROM NAICS_Sector WHERE NSE_Sector_ID = $csector_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["NSE_Sector_Name"];
    }
    } else {
        echo "ERROR: NAICS Sector not found.";
    }
}

function getIndustryName2(){
    global $conn;
    $csector_id = intval(substr($_POST['competitorNAICS'], 0, 2));
    $cindustry_id = intval(substr($_POST['competitorNAICS'], 2, 1));

    $sql = "SELECT NI_Industry_Name FROM NAICS_Industry WHERE NI_Sector_ID = $csector_id AND NI_Industry_ID = $cindustry_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["NI_Industry_Name"];
        }
        } else {
            echo "ERROR: NAICS Industry not found.";
        }
}

function getSpecialtyName2(){
    global $conn;
    $csector_id = intval(substr($_POST['competitorNAICS'], 0, 2));
    $cindustry_id = intval(substr($_POST['competitorNAICS'], 2, 1));
    $cspecialty_id = intval(substr($_POST['competitorNAICS'], 3, 1));

    $sql = "SELECT NSP_Specialty_Name FROM NAICS_Specialty WHERE NSP_Sector_ID = $csector_id AND NSP_Industry_ID = $cindustry_id AND NSP_Specialty_ID = $cspecialty_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["NSP_Specialty_Name"];
        }
        } else {
            echo "ERROR: NAICS Specialty not found.";
        }
}

function getSubspecialtyName2(){
    global $conn;
    $csector_id = intval(substr($_POST['competitorNAICS'], 0, 2));
    $cindustry_id = intval(substr($_POST['competitorNAICS'], 2, 1));
    $cspecialty_id = intval(substr($_POST['competitorNAICS'], 3, 1));
    $csubspecialty_id = intval(substr($_POST['competitorNAICS'], 4, 1));

    $sql = "SELECT NSU_Subspecialty_Name FROM NAICS_Subspecialty WHERE NSU_Sector_ID = $csector_id AND NSU_Industry_ID = $cindustry_id AND NSU_Specialty_ID = $cspecialty_id AND NSU_Subspecialty_ID = $csubspecialty_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["NSU_Subspecialty_Name"];
        }
        } else {
            echo "ERROR: NAICS Subspecialty not found.";
        }
}

function getExtraName2(){
    global $conn;
    $csector_id = intval(substr($_POST['competitorNAICS'], 0, 2));
    $cindustry_id = intval(substr($_POST['competitorNAICS'], 2, 1));
    $cspecialty_id = intval(substr($_POST['competitorNAICS'], 3, 1));
    $csubspecialty_id = intval(substr($_POST['competitorNAICS'], 4, 1));
    $cextra_id = intval(substr($_POST['competitorNAICS'], 5, 1));

    $sql = "SELECT NE_Extra_Name FROM NAICS_Extra WHERE NE_Sector_ID = $csector_id and NE_Industry_ID = $cindustry_id and NE_Specialty_ID = $cspecialty_id and NE_Subspecialty_ID = $csubspecialty_id and NE_Extra_ID = $cextra_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["NE_Extra_Name"];
        }
        } else {
            echo "ERROR: NAICS Extra not found.";
        }
}

function showInfo() {
    echo '<h1>NAICS Code exists!</h1>';
    echo '<div class="naicsTitle">NAICS:' ;
    echo $_POST['competitorNAICS'];
    echo '</div>';
    echo '<section class="layout"><div class="naicsBox"><u>Sector</u> <br>';
    echo getSectorName2();
    echo '</div><div class="naicsBox"><u>Industry</u><br>';
    echo getIndustryName2();
    echo '</div><div class="naicsBox"><u>Specialty</u><br>';
    echo getSpecialtyName2();
    echo '</div><div class="naicsBox"><u>Subspecialty</u><br>';
    echo getSubspecialtyName2();
    echo '</div><div class="naicsBox"><u>Extra</u><br>';
    echo getExtraName2();
    echo '</div></section>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Search NAICS</title>
  <head>
<body>
    <?php validateNAICS(); ?>
    <button onclick="history.back()">Go Back</button>
</body>
</html>