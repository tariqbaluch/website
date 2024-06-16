<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "transport_management_system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        switch ($user['role']) {
            case 'admin':

                header("Location: tranpostadmin.html");
                exit();
            case 'teacher':
                $result = $stmt->get_result();
            case 'student':
                header("Location: studentstaff.html");
                exit();
        }
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }

    $stmt->close();
}

$conn->close();
?>