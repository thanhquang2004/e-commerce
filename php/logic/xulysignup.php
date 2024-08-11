<?php

include 'connect.php';

if(isset($_POST['email']) && isset($_POST['psw'])) {
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);

    if($result->num_rows > 0) {
        echo "Email đã tồn tại";
    } else {
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if($conn->query($sql) === TRUE) {

            header("Location: ../../login.php");
            echo "Đăng ký thành công";
        } else {
            echo "Đăng ký thất bại";
        }
    }
}  

?>