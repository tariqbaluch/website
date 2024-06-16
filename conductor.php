<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "transport_management_system";
    $conn = new mysqli($servername, $username, $password, $database);
    // Retrieve form data
    $conductorName = $_POST['conductorname'];
    $cnic = $_POST['cnic'];
    $address = $_POST['address'];

    // SQL query to insert data into the database
    $sql = "INSERT INTO conductors (name, cnic, address) VALUES (?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind parameters with the form values
    $stmt->bind_param("sis", $conductorName, $cnic, $address);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Conductor details saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
