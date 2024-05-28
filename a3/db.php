<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'hikes_victoria';

// Set DSN
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
// Create a PDO instance
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
