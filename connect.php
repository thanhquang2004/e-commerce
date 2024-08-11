<?php
$host = "localhost";
$user = "root";
$pass = "";
$db="shop-tay-cam";
$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>