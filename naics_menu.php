<!--
# naics_menu.php
# 
# Description: PHP file to display NAICS information.
# Author: Joshua Hontanosas
-->
<?php
    //Connecting to database
    include 'connect.php';
    $conn = OpenCon();

    //My selected NAICS info in variables
    $naics_id = 443142;
    $sector_id = 44;
    $industry_id = 3;
    $specialty_id = 1;
    $subspecialty_id = 4;
    $extra_id = 2;

    //***Functions*** - Included custom functions for displaying NAICS info.--------------------------------------------------------------------------
    //***SQL Queries*** - Ensured that the SQL queries used variables and not hard-coded values ------------------------------------------------------
    
    function showBusinessTitle(){
        global $conn, $sector_id, $industry_id, $specialty_id, $subspecialty_id, $extra_id;

        $sql = "SELECT NE_Extra_Name FROM NAICS_Extra WHERE NE_Sector_ID = $sector_id and NE_Industry_ID = $industry_id and NE_Specialty_ID = $specialty_id and NE_Subspecialty_ID = $subspecialty_id and NE_Extra_ID = $extra_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["NE_Extra_Name"];
        }
        //Error Handling: Will show if NAICS info does not show
        } else {
            echo "ERROR: NAICS info not found.";
        }
    }

    //***Sector*** - This function gets the sector name based on NAICS info ----------------
    function getSectorName(){
        global $conn, $sector_id;

        $sql = "SELECT NSE_Sector_Name FROM NAICS_Sector WHERE NSE_Sector_ID = $sector_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["NSE_Sector_Name"];
        }
        } else {
            echo "ERROR: NAICS Sector not found.";
        }
    }

    //***Industry*** - This function gets the industry name based on NAICS info ----------------
    function getIndustryName(){
        global $conn, $sector_id, $industry_id;

        $sql = "SELECT NI_Industry_Name FROM NAICS_Industry WHERE NI_Sector_ID = $sector_id AND NI_Industry_ID = $industry_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["NI_Industry_Name"];
            }
            } else {
                echo "ERROR: NAICS Industry not found.";
            }
    }

    //***Specialty*** - This function gets the specialty name based on NAICS info ----------------
    function getSpecialtyName(){
        global $conn, $sector_id, $industry_id, $specialty_id;

        $sql = "SELECT NSP_Specialty_Name FROM NAICS_Specialty WHERE NSP_Sector_ID = $sector_id AND NSP_Industry_ID = $industry_id AND NSP_Specialty_ID = $specialty_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["NSP_Specialty_Name"];
            }
            } else {
                echo "ERROR: NAICS Specialty not found.";
            }
    }

    //***Subspecialty*** - This function gets the subspecialty name based on NAICS info ----------------
    function getSubspecialtyName(){
        global $conn, $sector_id, $industry_id, $specialty_id, $subspecialty_id;

        $sql = "SELECT NSU_Subspecialty_Name FROM NAICS_Subspecialty WHERE NSU_Sector_ID = $sector_id AND NSU_Industry_ID = $industry_id AND NSU_Specialty_ID = $specialty_id AND NSU_Subspecialty_ID = $subspecialty_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["NSU_Subspecialty_Name"];
            }
            } else {
                echo "ERROR: NAICS Subspecialty not found.";
            }
    }

    //***Extra*** - This function gets the extra name based on NAICS info ----------------
    function getExtraName(){
        global $conn, $sector_id, $industry_id, $specialty_id, $subspecialty_id, $extra_id;

        $sql = "SELECT NE_Extra_Name FROM NAICS_Extra WHERE NE_Sector_ID = $sector_id and NE_Industry_ID = $industry_id and NE_Specialty_ID = $specialty_id and NE_Subspecialty_ID = $subspecialty_id and NE_Extra_ID = $extra_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["NE_Extra_Name"];
            }
            } else {
                echo "ERROR: NAICS Extra not found.";
            }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="NAISC BI Dashboard">
    <meta name="author" content="Joshua Hontanosas">
    <meta name="viewport" content="width=device-witdh, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- *Displays Title* -->
    <h1><?php showBusinessTitle(); ?></h1>

    <!-- *Displays NAICS Information* -->
    <div class="naicsTitle">
      NAICS:  
      <?php echo $naics_id ?>
    </div>

    <section class="layout">
      <div class="naicsBox">
        <u>Sector</u> <br>
            <!-- Gets Sector Name -->
            <?php getSectorName(); ?>
      </div>
      <div class="naicsBox">
        <u>Industry</u> <br>
            <!-- Gets Industry Name -->
            <?php getIndustryName(); ?>
      </div>
      <div class="naicsBox">
        <u>Specialty</u> <br>
            <!-- Gets Specialty Name -->
            <?php getSpecialtyName(); ?>
      </div>
      <div class="naicsBox">
        <u>Subspecialty</u> <br>
            <!-- Gets Subpecialty Name -->
            <?php getSubspecialtyName(); ?>
      </div>
      <div class="naicsBox">
        <u>Extra</u> <br>
            <!-- Gets Extra Name -->
            <?php getExtraName(); ?>
      </div>
    </section>
    
</body>
</html>