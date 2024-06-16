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
    // Generate unique reservation ID
    $reservationId = uniqid();

    // Retrieve form data
    $reservation = $_POST['reservation'];

    // Prepare and execute SQL statement to insert the reservation into the database
    $sql = "INSERT INTO reservations (reservation_id, reservation) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $reservationId, $reservation);

    if ($stmt->execute()) {
        // Insertion successful
        echo "Reservation request submitted successfully. Your reservation ID is: " . $reservationId;
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
