<?php
// Database connection details
$host = 'localhost';
$user = 'fgpooswu_stats_user';
$password = 'p4s5w0rd_com';
$database = 'fgpooswu_stats';
$table = 'visitors';
$column1 = 'id'; // INT(11) AUTO_INCREMENT PRIMARY KEY
$column2 = 'url'; // VARCHAR
$column3 = 'count'; // INT(11)

// Retrieve the URL from the AJAX request
if (isset($_POST['url'])) {
  $url = $_POST['url'];

  // Establish a database connection
  $connection = mysqli_connect($host, $user, $password, $database);

  // Check if the connection was successful
  if (!$connection) {
    die('Database connection failed: ' . mysqli_connect_error());
  }

  // Escape the URL to prevent SQL injection
  $escapedUrl = mysqli_real_escape_string($connection, $url);

  // Check if the URL already exists in the table
  $selectQuery = "SELECT * FROM $table WHERE $column2 = '$escapedUrl'";
  $result = mysqli_query($connection, $selectQuery);

  if ($result && mysqli_num_rows($result) > 0) {
    // URL exists, update the count
    $updateQuery = "UPDATE $table SET $column3 = $column3 + 1 WHERE $column2 = '$escapedUrl'";
    mysqli_query($connection, $updateQuery);
  } else {
    // URL doesn't exist, insert a new row
    $insertQuery = "INSERT INTO $table ($column2, $column3) VALUES ('$escapedUrl', 1)";
    mysqli_query($connection, $insertQuery);
  }

  // Close the database connection
  mysqli_close($connection);

  // Send a response back to the AJAX request (optional)
  echo 'URL received successfully.';
}
?>
