<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "transport_management_system";
    $conn = new mysqli($servername, $username, $password, $database);
    $driverName = $_POST['name'];
    
    $cnic = $_POST['cnic'];
    $address = $_POST['address'];
    $sql = "INSERT INTO drivers (name, cnic, address) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $driverName, $cnic, $address);
    if ($stmt->execute()) {
        echo "Driver details saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();
}
?>
