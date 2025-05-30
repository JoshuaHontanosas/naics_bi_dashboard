<!--
# connect.php
# 
# Description: PHP file to connect and disconnect from the database.
# Author: Joshua Hontanosas
-->
<?php
// Connect to database
function OpenCon()
{
    $dbhost = "127.0.0.1";
    $dbuser = "testuser";
    $dbpass = "password123";
    $db = "naics_data";

    //***Error Handling*** - Exits script if cannot connect to SQL database.
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) 
    or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}

 // Close database connection
function CloseCon($conn)
{
    $conn -> close();
}
?>

