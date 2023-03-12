<?php
// Connect to the database
$servername = "localhost";
$username = "abhishek";
$password = "abhishek";
$dbname = "database_emp";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the employee data
$sql = "SELECT * FROM employees";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Employee Information</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <h1>View Employee Information</h1>
        <table>
            <tr>
                <th>Employee Number</th>
                <th>Name</th>
                <th>Hours Worked</th>
            </tr>
            <?php
            // Output each employee record as a table row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["employee_number"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["hours_worked"] . "</td>";
                echo "</tr>";
            }

            // Free the result set and close the connection
            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>