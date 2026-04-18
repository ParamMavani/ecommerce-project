<?php
$envFile = __DIR__ . '/.env';
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "ecommerce";

if (file_exists($envFile)) {
    $env = parse_ini_file($envFile);
    $dbHost = isset($env['DB_HOST']) ? $env['DB_HOST'] : $dbHost;
    $dbUser = isset($env['DB_USER']) ? $env['DB_USER'] : $dbUser;
    $dbPass = isset($env['DB_PASS']) ? $env['DB_PASS'] : $dbPass;
    $dbName = isset($env['DB_NAME']) ? $env['DB_NAME'] : $dbName;
}

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>