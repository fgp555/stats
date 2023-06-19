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


// Function to create the table
function createTable() {
    // Create a connection
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['database']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to create a table
    $sql = "CREATE TABLE IF NOT EXISTS " . $GLOBALS['table'] . " (
        " . $GLOBALS['column1'] . " INT(11) AUTO_INCREMENT PRIMARY KEY,
        " . $GLOBALS['column2'] . " VARCHAR(255),
        " . $GLOBALS['column3'] . " INT(11)
    )";

    // Execute the query
    if ($conn->query($sql) === true) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}

// Function to get table names
function getTableNames() {
    // Create a connection
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['database']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to get table names
    $sql = "SHOW TABLES";

    // Execute the query
    $result = $conn->query($sql);

    // Store table names in an array
    $tables = array();
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }

    // Close the connection
    $conn->close();

    return $tables;
}

// Function to get column names for a table
function getColumnNames($tableName) {
    // Create a connection
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['database']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to get column names
    $sql = "SHOW COLUMNS FROM $tableName";

    // Execute the query
    $result = $conn->query($sql);

    // Store column names in an array
    $columns = array();
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
    }

    // Close the connection
    $conn->close();

    return $columns;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createTableBtn'])) {
    createTable();
}

// Get table names
$tables = getTableNames();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Table</title>
</head>
<body>
    <form method="POST" action="">
        <input type="submit" name="createTableBtn" value="Create Table">
    </form>

    <h2>Tables:</h2>
    <ul>
        <?php foreach ($tables as $table): ?>
            <li>
                <?php echo $table; ?>
                <?php $columns = getColumnNames($table); ?>
                <?php if (!empty($columns)): ?>
                    <ul>
                        <?php foreach ($columns as $column): ?>
                            <li><?php echo $column; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
