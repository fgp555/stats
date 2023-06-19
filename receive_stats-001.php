<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database00";

// Read the data sent from the JavaScript code
$requestData = json_decode(file_get_contents('php://input'), true);

// Extract the values from the data
$currentURL = $requestData['currentURL'];
$historyURL = $requestData['historyURL'];
$ipAddress = $requestData['ipAddress'];
$country = $requestData['country'];

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the count in the currentURL table
$sql = "INSERT INTO table1 (url, count)
        VALUES ('$currentURL', 1)
        ON DUPLICATE KEY UPDATE count = count + 1";
$conn->query($sql);

// Update the count in the historyURL table
$sql = "INSERT INTO table2 (history, count)
        VALUES ('$historyURL', 1)
        ON DUPLICATE KEY UPDATE count = count + 1";
$conn->query($sql);

// Update the count in the ipAddress table
$sql = "INSERT INTO table3 (ip, count)
        VALUES ('$ipAddress', 1)
        ON DUPLICATE KEY UPDATE count = count + 1";
$conn->query($sql);

// Update the count in the country table
$sql = "INSERT INTO table4 (country, count)
        VALUES ('$country', 1)
        ON DUPLICATE KEY UPDATE count = count + 1";
$conn->query($sql);

// Close the database connection
$conn->close();

// Send a response to indicate the success
http_response_code(200);
echo "Data received and processed successfully.";
?>
