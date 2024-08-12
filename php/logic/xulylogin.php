<?php
include 'connect.php';

if(isset($_POST['email']) && isset($_POST['psw'])){
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        setcookie('email', $email, time() + 3600*24*7, '/');

        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header('Location: ../../index.php');
        echo "Login success";
    }else{
        echo "Login failed";
    }
}

?>