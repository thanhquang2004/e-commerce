<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['product-price'];
    $quantity = $_POST['quantity'];
    $code = $_POST['code'];
    $category = $_POST['category'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Update product information
        $sql = "UPDATE products SET name = ?, price = ?, quantity = ?, code = ?, category = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdissi", $name, $price, $quantity, $code, $category, $product_id);
        $stmt->execute();

        // Handle image upload if a new image is provided
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = $_FILES['image'];
            $image_name = $image['name'];
            $image_tmp = $image['tmp_name'];
            $image_size = $image['size'];
            $image_error = $image['error'];

            // Validate image
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $file_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

            if (in_array($file_extension, $allowed_extensions) && $image_size <= 5000000) { // 5MB limit
                $new_image_name = uniqid('product_') . '.' . $file_extension;
                $upload_path = '../../img/products/' . $new_image_name;

                if (move_uploaded_file($image_tmp, $upload_path)) {
                    // Update image path in database
                    $sql = "UPDATE products SET image_path = ? WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $new_image_name, $product_id);
                    $stmt->execute();
                } else {
                    throw new Exception("Không thể tải lên ảnh mới.");
                }
            } else {
                throw new Exception("File ảnh không hợp lệ hoặc quá lớn.");
            }
        }

        // Commit transaction
        $conn->commit();
        echo "Sửa sản phẩm thành công!";
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Lỗi: " . $e->getMessage();
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Phương thức không hợp lệ.";
}
?>