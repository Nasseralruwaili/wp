<?php
$servername = "titan.csit.rmit.edu.a";
$username = "s3962015";
$password = "Arteta8268!";
$dbname = "s3962015_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
