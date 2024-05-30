<?php
if (strstr($_SERVER['SERVER_NAME'], 'localhost')) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hikes_victoria";
} else {
    $servername = "talsprddb02.int.its.rmit.edu.au";
    $username = "s3962015";
    $password = "Nasser123";
    $dbname = "s3962015";
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
