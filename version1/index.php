<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="https://i0.wp.com/fgp.one/media/icon-128.webp" sizes="256x256" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stats | Web Tracker with PHP</title>
    <style>
        html {
            background-color: indigo;
            color: white;
        }

        h1 {
            text-align: center;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
    </style>
</head>

<body>

    <h1>Web Tracker with PHP</h1>
    <link rel="stylesheet" type="text/css" href="<?php echo 'style_table.css?v=' . date('ymdHi'); ?>">

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

    // Fetch data from the table
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    // Check if any records exist
    if ($result->num_rows > 0) {
        echo "<table id='myTable'>";
        echo "<tr><th>ID</th><th onclick='sortTable(1)'>URL</th><th onclick='sortTable(2)'>Count</th></tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["url"] . "</td>";
            echo "<td>" . $row["count"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }

    // Close the connection
    $conn->close();
    ?>

    <!-- ========== sort_table... ========== -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        function sortTable(columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("myTable");
            switching = true;
            // Set the sorting direction to ascending
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("TD")[columnIndex];
                    if (dir === "asc") {
                        if (columnIndex === 2) {
                            if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                                shouldSwitch = true;
                                break;
                            }
                        } else {
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                shouldSwitch = true;
                                break;
                            }
                        }
                    } else if (dir === "desc") {
                        if (columnIndex === 2) {
                            if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
                                shouldSwitch = true;
                                break;
                            }
                        } else {
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch = true;
                                break;
                            }
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount === 0 && dir === "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
        sortTable(2)
        sortTable(2)
    </script>
    <!-- ========== sort_table. ========== -->
</body>

</html>