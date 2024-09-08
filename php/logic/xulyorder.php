<?php
require_once 'connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartData = json_decode($_POST['cartData'], true);
    $totalAmount = $_POST['totalAmount'];

    // Get email from cookie
    $email = isset($_COOKIE['email']) ? $_COOKIE['email'] : null;

    if (!$email) {
        // Handle case where user is not logged in
        echo "Vui lòng đăng nhập để đặt hàng.";
        exit();
    }

    // Get userId from database using email
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Không tìm thấy thông tin người dùng.";
        exit();
    }

    $userId = $result->fetch_assoc()['id'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert into orders table
        $sql = "INSERT INTO orders (userId, totalamount, date) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("id", $userId, $totalAmount);
        $stmt->execute();
        $orderId = $conn->insert_id;

        // Insert into order_items table and update product quantity
        $sql_insert = "INSERT INTO order_items (orderId, productId, name, quantity, price, totalprice) VALUES (?, ?, ?, ?, ?, ?)";
        $sql_update = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_update = $conn->prepare($sql_update);

        foreach ($cartData as $item) {
            $totalprice = $item['price'] * $item['quantity'];
            $stmt_insert->bind_param("iisidi", $orderId, $item['productId'], $item['name'], $item['quantity'], $item['price'], $totalprice);
            $stmt_insert->execute();

            $stmt_update->bind_param("ii", $item['quantity'], $item['productId']);
            $stmt_update->execute();
        }

        // Commit transaction
        $conn->commit();

        // Clear the cart (you may need to implement this function)
        // clearCart($userId);

        // Create a success message with more styling
        $successMessage = "<div style='background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; border-radius: 4px; padding: 15px; margin-bottom: 20px;'>
            <h4 style='margin-top: 0; margin-bottom: 5px;'>Đặt hàng thành công!</h4>
            <p style='margin-bottom: 0;'>Cảm ơn bạn đã đặt hàng. Mã đơn hàng của bạn là: #" . $orderId . "</p>
        </div>";
        echo $successMessage;
        
        // Redirect to a thank you page after a short delay
        echo "<script>
            setTimeout(function() {
                window.location.href = '../../html/thank_you.php?order_id=" . $orderId . "';
            }, 3000);
        </script>";
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Có lỗi xảy ra khi đặt hàng: " . $e->getMessage();
    }

    $conn->close();
} else {
    echo "Phương thức không hợp lệ.";
}
