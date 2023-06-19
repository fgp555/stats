<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database00";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table1 for currentURL
$sql = "CREATE TABLE IF NOT EXISTS table1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    count INT DEFAULT 0
)";
$conn->query($sql);

// Create table2 for historyURL
$sql = "CREATE TABLE IF NOT EXISTS table2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    history VARCHAR(255) NOT NULL,
    count INT DEFAULT 0
)";
$conn->query($sql);

// Create table3 for ipAddress
$sql = "CREATE TABLE IF NOT EXISTS table3 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip VARCHAR(50) NOT NULL,
    count INT DEFAULT 0
)";
$conn->query($sql);

// Create table4 for country
$sql = "CREATE TABLE IF NOT EXISTS table4 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    country VARCHAR(100) NOT NULL,
    count INT DEFAULT 0
)";
$conn->query($sql);

// Close the database connection
$conn->close();

echo "Tables created successfully.";
?>
