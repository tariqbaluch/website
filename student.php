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
    // Generate a random ID
    $complaintId = uniqid();

    // Retrieve form data
    $complain = $_POST['complain'];

    // Prepare and execute SQL statement to insert the complaint into the database
    $sql = "INSERT INTO complaints (id, complain) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $complaintId, $complain);

    if ($stmt->execute()) {
        // Insertion successful
        echo "Complaint registered successfully with ID: " . $complaintId;
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
