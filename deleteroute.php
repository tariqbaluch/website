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
    $deleteConfirmation = $_POST['deleteConfirmation'];

    if ($deleteConfirmation === "yes") {
        // Prepare and execute SQL statement to delete route from the database
        $sql = "DELETE FROM routes WHERE route = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $route);

        if ($stmt->execute()) {
            // Deletion successful
            echo "Route deleted successfully.";
        } else {
            // Error occurred
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Deletion canceled
        echo "Deletion canceled.";
    }
}

// Close the connection
$conn->close();
?>
