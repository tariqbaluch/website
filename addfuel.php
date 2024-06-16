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
    $busNo = $_POST['busno'];
    $fuelConsumed = $_POST['fuel-csme'];
    $fuelStatus = $_POST['fuelstatus'];

    // Insert data into the database
    $sql = "INSERT INTO fuel_data (bus_no, fuel_consumed, fuel_status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $busNo, $fuelConsumed, $fuelStatus);

    if ($stmt->execute()) {
        // Insertion successful
        echo "Fuel data inserted successfully.";
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
