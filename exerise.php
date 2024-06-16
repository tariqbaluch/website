<?php 
$servername="localhost";
$username="root";
$password="";
$database="transport_management_system";

$onn=new mysqli($servername,$username,$password,$database);

if($conn->connect_error)
{
    die("connection failed.".$conn->connect_error);
}
else{
    echo "connection successful";
}

if($_Server["REQUEST_METHOD"]=="POST")
{
    $name=$_POST['name'];
    $email=$_POST['email'];

}

$stmt=$conn->prepare("INSERT INTO contact_form (name, email) VALUES (?,?)");
$stmt->bind("ss",$name,$email);

if($stmt->execute()===TRUE)
{
    
}

$conn->close();


?>