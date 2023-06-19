<a href="send_stats.html">send_stats.html</a>
<a href="send_stats222.html">send_stats222.html</a>
<a href="send_stats333.html">send_stats333.html</a>
<div>
    <a href="_resetDatabase.php">_resetDatabase.php</a>
</div>

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

// Retrieve data from the tables
$table1Data = retrieveDataFromTable($conn, 'table1');
$table2Data = retrieveDataFromTable($conn, 'table2');
$table3Data = retrieveDataFromTable($conn, 'table3');
$table4Data = retrieveDataFromTable($conn, 'table4');

// Function to retrieve data from a specific table
function retrieveDataFromTable($conn, $tableName)
{
    $data = [];
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Database Data</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h1>Database Data</h1>

    <h2>Table 1</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($table1Data as $row) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['url']; ?></td>
                    <td><?php echo $row['count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Table 2</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>History</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($table2Data as $row) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['history']; ?></td>
                    <td><?php echo $row['count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Table 3</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>IP</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($table3Data as $row) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['ip']; ?></td>
                    <td><?php echo $row['count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Table 4</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Country</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($table4Data as $row) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['country']; ?></td>
                    <td><?php echo $row['count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>