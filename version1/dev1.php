<!DOCTYPE html>
<html>
<head>
  <title>3x3 Table with Sorting</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
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
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
            }
          } else if (dir === "desc") {
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
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
  </script>
</head>
<body>
  <table id="myTable">
    <tr>
      <th onclick="sortTable(0)">Header 1</th>
      <th onclick="sortTable(1)">Header 2</th>
      <th onclick="sortTable(2)">Header 3</th>
    </tr>
    <tr>
      <td>Row 1, Column 1</td>
      <td>Row 1, Column 2</td>
      <td>Row 1, Column 3</td>
    </tr>
    <tr>
      <td>Row 2, Column 1</td>
      <td>Row 2, Column 2</td>
      <td>Row 2, Column 3</td>
    </tr>
    <tr>
      <td>Row 3, Column 1</td>
      <td>Row 3, Column 2</td>
      <td>Row 3, Column 3</td>
    </tr>
  </table>
</body>
</html>
