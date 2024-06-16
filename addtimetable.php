<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "transport_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $busNo = mysqli_real_escape_string($conn, $_POST['busno']);
    $route = mysqli_real_escape_string($conn, $_POST['route']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);

    // Insert data into the database
    $sql = "INSERT INTO timetable (bus_no, route, time) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $busNo, $route, $time);

    if ($stmt->execute()) {
        // Insertion successful
      
        echo "Timetable inserted successfully.";
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
