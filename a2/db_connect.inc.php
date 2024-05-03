<?php
$servername = "localhost";  // This is correct for a local MySQL server
$username = "root";         // Default XAMPP MySQL user, ensure it's the same in phpMyAdmin
$password = "";             // Default XAMPP MySQL password, check if it's the same in phpMyAdmin
$database = "a2";           // The database name you've created in phpMyAdmin

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
