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
    $driverId = $_POST['driver'];
    $conductorId = $_POST['conductor'];
    $route = $_POST['route'];
    $busNo = $_POST['busno'];
    $time = $_POST['time'];
    $extraTime = isset($_POST['working']) && $_POST['working'] == 'yes' ? 1 : 0;

    // Insert data into the database
    $sql = "INSERT INTO duties (driverId, conductorId, route, bus_no, time, extra_time) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissii", $driverId, $conductorId, $route, $busNo, $time, $extraTime);

    if ($stmt->execute()) {
        // Insertion successful
        echo "Duties assigned successfully.";
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
