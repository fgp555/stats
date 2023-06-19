<?php
$host = 'localhost';
$user = 'fgpooswu_stats_user';
$password = 'p4s5w0rd_com';
$database = 'fgpooswu_stats';
$table = 'visitors';


// Create a new connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle delete button click
function deleteRow($conn, $table, $id) {
    $sql = "DELETE FROM $table WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch data from the table
$sql = "SELECT * FROM $table";
$result = $conn->query($sql);

// Check if any records exist
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>URL</th><th>Count</th><th>Action</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["url"]."</td>";
        echo "<td>".$row["count"]."</td>";
        echo "<td><form method='POST'><input type='hidden' name='id' value='".$row["id"]."'><input type='submit' name='delete' value='Delete'></form></td>";
        echo "</tr>";
    }

    echo "</table>";

    // Handle delete button click
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        deleteRow($conn, $table, $id);
    }
} else {
    echo "No records found.";
}

// Close the connection
$conn->close();
?>
