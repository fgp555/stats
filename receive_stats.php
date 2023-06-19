<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "database00";

$servername = 'localhost';
$username = 'fgpooswu_stats_user';
$password = 'p4s5w0rd_com';
$dbname = 'fgpooswu_stats';

// Read the data sent from the JavaScript code
$requestData = json_decode(file_get_contents('php://input'), true);

// Extract the values from the data
$currentURL = $requestData['currentURL'];
$historyURL = $requestData['historyURL'];
$ipAddress = $requestData['ipAddress'];
$country = $requestData['country'];

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to increment the count column for a given URL
function incrementCount($conn, $table, $column, $value)
{
    $sql = "SELECT * FROM $table WHERE $column = '$value'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'] + 1;
        $sql = "UPDATE $table SET count = $count WHERE $column = '$value'";
        $conn->query($sql);
    } else {
        $sql = "INSERT INTO $table ($column, count) VALUES ('$value', 1)";
        $conn->query($sql);
    }
}

// Increment the count for currentURL
incrementCount($conn, 'table1', 'url', $currentURL);

// Increment the count for historyURL
incrementCount($conn, 'table2', 'history', $historyURL);

// Increment the count for ipAddress
incrementCount($conn, 'table3', 'ip', $ipAddress);

// Increment the count for country
incrementCount($conn, 'table4', 'country', $country);

// Close the database connection
$conn->close();

// Send a response to indicate the success
http_response_code(200);
echo "Data received and processed successfully.";
?>
