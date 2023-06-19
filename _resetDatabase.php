<?php
// Database configuration
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "database00";

$servername = 'localhost';
$username = 'fgpooswu_stats_user';
$password = 'p4s5w0rd_com';
$dbname = 'fgpooswu_stats';

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the reset button click
if (isset($_POST['reset'])) {
    // Drop all tables
    $sql = "DROP TABLE IF EXISTS table1, table2, table3, table4";
    $conn->query($sql);

    // Recreate the tables
    $sql = "CREATE TABLE IF NOT EXISTS table1 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        url VARCHAR(255) NOT NULL,
        count INT DEFAULT 0
    )";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS table2 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        history VARCHAR(255) NOT NULL,
        count INT DEFAULT 0
    )";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS table3 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip VARCHAR(50) NOT NULL,
        count INT DEFAULT 0
    )";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS table4 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        country VARCHAR(100) NOT NULL,
        count INT DEFAULT 0
    )";
    $conn->query($sql);
    
    echo "Tables reset successfully.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Database</title>
</head>
<body>
    <form method="post">
        <input type="submit" name="reset" value="Reset Database">
    </form>
</body>
</html>
