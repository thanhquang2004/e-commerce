<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Get the image path before deleting the product
        $sql = "SELECT image FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Lỗi khi chuẩn bị truy vấn: " . $conn->error);
        }
        $stmt->bind_param("i", $product_id);
        if (!$stmt->execute()) {
            throw new Exception("Lỗi khi thực thi truy vấn: " . $stmt->error);
        }
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            throw new Exception("Không tìm thấy sản phẩm với ID: " . $product_id);
        }
        $product = $result->fetch_assoc();
        $image_path = $product['image'];

        // Delete related records in other tables
        $tables = ['cart_items', 'order_items'];
        foreach ($tables as $table) {
            $sql = "DELETE FROM $table WHERE productId = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Lỗi khi chuẩn bị truy vấn xóa từ bảng $table: " . $conn->error);
            }
            $stmt->bind_param("i", $product_id);
            if (!$stmt->execute()) {
                throw new Exception("Lỗi khi thực thi truy vấn xóa từ bảng $table: " . $stmt->error);
            }
        }

        // Delete the product
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Lỗi khi chuẩn bị truy vấn xóa sản phẩm: " . $conn->error);
        }
        $stmt->bind_param("i", $product_id);
        if (!$stmt->execute()) {
            throw new Exception("Lỗi khi thực thi truy vấn xóa sản phẩm: " . $stmt->error);
        }

        if ($stmt->affected_rows > 0) {
            // Delete the product image if it exists
            if ($image_path && file_exists('../../img/products/' . $image_path)) {
                if (!unlink('../../img/products/' . $image_path)) {
                    throw new Exception("Không thể xóa file ảnh: " . $image_path);
                }
            }

            $conn->commit();
            echo "Xóa sản phẩm và các dữ liệu liên quan thành công!";
        } else {
            throw new Exception("Không có sản phẩm nào bị xóa. ID sản phẩm: " . $product_id);
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    } finally {
        if (isset($stmt) && $stmt !== false) {
            $stmt->close();
        }
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}

$conn->close();
?>