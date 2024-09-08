<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

var_dump($_FILES);
var_dump($_POST);

include 'connect.php';

if(isset($_POST['action']) && $_POST['action'] == 'add') {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $price = $_POST['product-price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
    $category = $_POST['category'];
    // Lấy email từ cookie
    $email = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';

    // Kiểm tra xem email có tồn tại không
    if (!empty($email)) {
        // Tìm id user theo email
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $userId = $result->fetch_assoc()['id'];
            echo "Tìm thấy user với email này";
        } else {
            // Nếu không tìm thấy user, có thể xử lý lỗi ở đây
            echo "Không tìm thấy user với email này";
            return false;
        }
    } else {
        // Nếu không có email trong cookie, có thể xử lý lỗi ở đây
        echo "Không tìm thấy email trong cookie";
        return false;
    }

    // Xử lý và lưu ảnh
    if(isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['image'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // Lấy phần mở rộng của file
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Các loại file được phép upload
        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        if(in_array($fileExt, $allowed)) {
            if($fileError === 0) {
                if($fileSize < 5000000) { // Giới hạn kích thước file (5MB)
                    $fileNameNew = uniqid('', true).".".$fileExt;
                    $fileDestination = '../../img/product/'.$fileNameNew;
                    if(move_uploaded_file($fileTmpName, $fileDestination)) {
                        $image = $fileDestination; // Cập nhật đường dẫn ảnh
                        echo "Upload file thành công";
                    } else {
                        echo "Có lỗi xảy ra khi upload file.";
                        return false;
                    }
                } else {
                    echo "File quá lớn!";
                    return false;
                }
            } else {
                echo "Có lỗi xảy ra khi upload file!";
                return false;
            }
        } else {
            echo "Bạn không thể upload file loại này!";
            return false;
        }
    } else {
        echo "Không có file ảnh được chọn hoặc có lỗi khi upload!";
        return false;
    }

    $sql = "INSERT INTO products (name, code, price, quantity, image, category, userId) VALUES ('$name', '$code', '$price', '$quantity', '$image', '$category', '$userId')";
    if ($conn->query($sql) === TRUE) {
        echo "Thêm sản phẩm thành công";
        return true;
    } else {
        echo "Thêm sản phẩm thất bại: " . $conn->error;
        return false;
    }
}
?>
