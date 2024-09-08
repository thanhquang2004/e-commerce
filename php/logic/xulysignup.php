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
        
        // Tạo mới một mục trong bảng 'cart'
        $sql_cart = "INSERT INTO carts (cartItemId) VALUES (NULL)";
        
        if($conn->query($sql_cart) === TRUE) {
            // Lấy cartId vừa được tạo
            $cartId = $conn->insert_id;

            // Sử dụng cartId để tạo người dùng mới
            $sql_user = "INSERT INTO users (email, password, cartId, role) VALUES ('$email', '$password', '$cartId', 'user')";
            if($conn->query($sql_user) === TRUE) {
                echo "Đăng ký thành công";
                header("Location: ../../login.php");
            } else {
                echo "Đăng ký thất bại khi tạo người dùng";
            }
        } else {
            echo "Đăng ký thất bại khi tạo giỏ hàng". $conn->error;
        }
    }
}  

?>
