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
    $confirmation = $_POST['confirmation'];

    if ($confirmation === "yes") {
        // Delete all rows from the timetable table
        $sql = "DELETE FROM timetable";
        
        // Execute the statement
        if ($conn->query($sql) === TRUE) {
            // Deletion successful
            echo "All rows in the timetable table deleted successfully.";
        } else {
            // Error occurred
            echo "Error deleting records: " . $conn->error;
        }
    } else {
        // No confirmation provided
        echo "Timetable deletion canceled.";
    }
}

// Close the connection
$conn->close();
?>
