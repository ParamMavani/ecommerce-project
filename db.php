<?php
$envFile = __DIR__ . '/.env';
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "ecommerce";
$dbPort = 3307;

if (file_exists($envFile)) {
    $env = parse_ini_file($envFile);
    $dbHost = isset($env['DB_HOST']) ? $env['DB_HOST'] : $dbHost;
    $dbUser = isset($env['DB_USER']) ? $env['DB_USER'] : $dbUser;
    $dbPass = isset($env['DB_PASS']) ? $env['DB_PASS'] : $dbPass;
    $dbName = isset($env['DB_NAME']) ? $env['DB_NAME'] : $dbName;
}

// Connect without specifying the database first, using the new port
$conn = new mysqli($dbHost, $dbUser, $dbPass, "", $dbPort);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create the database and select it
$conn->query("CREATE DATABASE IF NOT EXISTS `$dbName`");
$conn->select_db($dbName);

// Create the users table if it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
?>