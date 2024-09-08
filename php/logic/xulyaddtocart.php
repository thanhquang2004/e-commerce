<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input data
    if (!isset($_POST['productId']) || !isset($_POST['productName']) || !isset($_POST['productPrice']) || !isset($_POST['productImage'])) {
        $_SESSION['alert'] = "Dữ liệu sản phẩm không hợp lệ.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productImage = $_POST['productImage'];
    $quantity = 1; // Default quantity
    $success = false;

    // Check if user is logged in and get their cartId
    if (isset($_COOKIE['email'])) {
        $email = $_COOKIE['email'];
        $sql = "SELECT cartId FROM users WHERE email = ?";
        // Debug: Print email and SQL query to error log
        error_log("Email: " . $email);
        error_log("SQL Query: " . $sql);
        
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            error_log("Prepare statement error: " . $conn->error);
            $_SESSION['alert'] = "Lỗi khi chuẩn bị truy vấn: " . $conn->error;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cartId = $row['cartId'];

            // Check if the product is already in the cart
            $checkSql = "SELECT * FROM cart_items WHERE cartId = ? AND productId = ?";
            $checkStmt = $conn->prepare($checkSql);
            if ($checkStmt === false) {
                error_log("Prepare statement error (check): " . $conn->error);
                $_SESSION['alert'] = "Lỗi khi chuẩn bị truy vấn kiểm tra: " . $conn->error;
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
            $checkStmt->bind_param("ii", $cartId, $productId);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                // Product exists, update quantity
                $updateSql = "UPDATE cart_items SET quantity = quantity + 1 WHERE cartId = ? AND productId = ?";
                $updateStmt = $conn->prepare($updateSql);
                if ($updateStmt === false) {
                    error_log("Prepare statement error (update): " . $conn->error);
                    $_SESSION['alert'] = "Lỗi khi chuẩn bị truy vấn cập nhật: " . $conn->error;
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit();
                }
                $updateStmt->bind_param("ii", $cartId, $productId);
                $success = $updateStmt->execute();
                if (!$success) {
                    error_log("Update error: " . $updateStmt->error);
                    $_SESSION['alert'] = "Lỗi khi cập nhật số lượng sản phẩm: " . $updateStmt->error;
                }
            } else {
                // Product doesn't exist, insert new item
                $insertSql = "INSERT INTO cart_items (cartId, productId, name, price, image, quantity) VALUES (?, ?, ?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertSql);
                if ($insertStmt === false) {
                    error_log("Prepare statement error (insert): " . $conn->error);
                    $_SESSION['alert'] = "Lỗi khi chuẩn bị truy vấn chèn: " . $conn->error;
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit();
                }
                $insertStmt->bind_param("iisdsi", $cartId, $productId, $productName, $productPrice, $productImage, $quantity);
                $success = $insertStmt->execute();
                if (!$success) {
                    error_log("Insert error: " . $insertStmt->error);
                    $_SESSION['alert'] = "Lỗi khi thêm sản phẩm mới vào giỏ hàng: " . $insertStmt->error;
                }
            }
        } else {
            error_log("No cart found for user: " . $email);
            $_SESSION['alert'] = "Không tìm thấy giỏ hàng cho người dùng này.";
        }
    } else {
        // User not logged in, use session-based cart
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $productExists = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $productId) {
                $item['quantity']++;
                $productExists = true;
                break;
            }
        }

        if (!$productExists) {
            $cartItem = array(
                'id' => $productId,
                'name' => $productName,
                'price' => $productPrice,
                'image' => $productImage,
                'quantity' => $quantity
            );
            array_push($_SESSION['cart'], $cartItem);
        }
        $success = true;
    }

    // Set alert message
    if ($success) {
        $_SESSION['alert'] = "Sản phẩm đã được thêm vào giỏ hàng thành công!";
    } else {
        if (!isset($_SESSION['alert'])) {
            $_SESSION['alert'] = "Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.";
        }
    }

    // Redirect back to the previous page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // If accessed directly without POST data, redirect to the home page
    $_SESSION['alert'] = "Truy cập không hợp lệ.";
    header("Location: ../../index.php");
    exit();
}
?>