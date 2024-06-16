<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "transport_management_system";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $route = $_POST['route'];

    // Prepare and execute SQL statement to insert data into the database
    $sql = "INSERT INTO routes (route) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $route);

    if ($stmt->execute()) {
        // Insertion successful
        echo "Route added successfully.";
    } else {
        // Error occurred
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
