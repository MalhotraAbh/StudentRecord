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

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $employee_number = $_POST["employee_number"];
    $name = $_POST["name"];
    $hours_worked = $_POST["hours_worked"];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO employees (employee_number, name, hours_worked) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $employee_number, $name, $hours_worked);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the view page
        header("Location: view.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee Information</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <h1>Add Employee Information</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="employee_number">Employee Number:</label>
            <input type="text" name="employee_number" required><br>
            <label for="name">Name:</label>
            <input type="text" name="name" required><br>
            <label for="hours_worked">Hours Worked:</label>
            <input type="number" name="hours_worked" required><br>
            <input type="submit" value="Add Employee">
        </form>
    </div>
</body>
</html>