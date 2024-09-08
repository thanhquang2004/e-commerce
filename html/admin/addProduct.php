<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="../../css/inventory.css">

</head>
<?php
// Check if the user is an admin
$email = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';

if (!empty($email)) {
    include '../../php/logic/connect.php';
    
    $sql = "SELECT role FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['role'] !== 'admin') {
            echo "<script>alert('Bạn không có quyền truy cập trang này 123'); window.location.href = '../../index.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Bạn không có quyền truy cập trang này'); window.location.href = '../../index.php';</script>";
        exit();
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../../index.php");
    exit();
}
?>

<body>
    <div id="wrapper">
        <header id="header">
            <div class="logo">
                <img src="../../img/logo.png" alt="Logo">
            </div>
            <nav class="main-nav">
                <a href="../../index.php">Trang chủ</a>
                <a href="../../html/contact.php">Liên Hệ</a>
                <a href="../../html/about.php">About</a>
                <a href="../../login.php">Đăng Ký</a>
            </nav>
            <div id="actions">
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="What are you looking for?">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"><img src="../../img/Search_button.png" alt="Search"></i>
                    </button>
                </div>
                <div class="item">
                    <a href="../../html/yeuthich.php"><img src="../../img/heart_icon.png" alt="User Icon"></a>
                </div>
                <div class="item_cart">
                    <a href="../../html/cart.php"><img src="../../img/cart_icon.png" alt="Cart Icon"></a>
                </div>
            </div>
        </header>
    </div>
    <main>
        <main id="main-content">
            <div class="add-prod-page">
                <h1>Thêm sản phẩm</h1>
                <form action="../../php/logic/xulyproduct.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">
                    <div class="product-form">
                        <label for="name" class="form-label"><b>Tên sản phẩm</b></label>
                        <input type="text" placeholder="Nhập tên sản phẩm" name="name" class="form-field" required>
                    </div>
                    <div class="product-form">
                        <label for="product-price" class="form-label"><b>Giá</b></label>
                        <input type="number" placeholder="Nhập giá sản phẩm" name="product-price" class="form-field" required>
                    </div>
                    <div class="product-form">
                        <label for="quantity" class="form-label"><b>Số lượng</b></label>
                        <input type="number" placeholder="Nhập số lượng sản phẩm" name="quantity" class="form-field" required>
                    </div>
                    <div class="product-form">
                        <label for="code" class="form-label"><b>Mã sản phẩm</b></label>
                        <input type="text" placeholder="Nhập mã sản phẩm" name="code" class="form-field" required>
                    </div>
                    <div class="product-form">
                        <label for="category" class="form-label"><b>Loại sản phẩm</b></label>
                        <input type="text" placeholder="Nhập loại sản phẩm" name="category" class="form-field" required>
                    </div>
                    <div class="product-form">
                        <label for="image" class="form-label"><b>Ảnh sản phẩm</b></label>
                        <input type="file" name="image" class="form-field" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <button type="submit">Thêm sản phẩm</button>
                </form>
            </div>
            <script>
            document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (confirm('Bạn có chắc chắn muốn thêm sản phẩm này?')) {
                    var formData = new FormData(this);
                    
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '../../php/logic/xulyproduct.php', true);
                    xhr.onload = function() {
                        if (this.status == 200) {
                            alert(this.responseText, 'success');
                            console.log(this.responseText);
                            if (this.responseText.includes('thành công')) {
                                document.querySelector('form').reset();
                                window.location.href = '../../html/admin/addProduct.php';
                            }
                        } else {
                            alert('Có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    };
                    xhr.send(formData);
                }
            });
            </script>
        </main>
    </main>
    <footer id="footer">
        <div class="footer-section">
            <div class="support">
                <h3>Thông tin liên hệ</h3>
                <address>
                    Địa Chỉ : <br>
                    Số điện thoại :<br>
                    Email : 
                    <ul class="social-links">
                        <li><a href="#"><img src="../../img/Icon-Facebook.png" alt="Facebook"></a></li>
                        <li><a href="#"><img src="../../img/Icon-Twitter.png" alt="Twitter"></a></li>
                        <li><a href="#"><img src="../../img/icon-instagram.png" alt="Instagram"></a></li>
                    </ul>
                </address>
            </div>
            <div class="account">
                <h3>Thông Tin</h3>
                <ul>
                    <li><a href="../../myaccount">Tài Khoản</a></li>
                    <li><a href="../../login.php">Login / Register</a></li>
                    <li><a href="../../html/cart.php">Giỏ Hàng</a></li>
                    <li><a href="../../index.php">Cửa Hàng</a></li>
                </ul>
            </div>
            <div class="quick-link">
                <h3>Chính sách</h3>
                <ul>
                    <li><a href="../../html/privacy.php">Chính sách bảo mật</a></li>
                    <li><a href="../../html/terms.php">Điều khoản sử dụng</a></li>
                    <li><a href="../../html/faq.php">Câu hỏi thường gặp</a></li>
                    <li><a href="../../html/contact.php">Liên Hệ</a></li>
                </ul>
            </div>
            <div class="exclusive">
                <h4>.... Shop game chuyên kinh doanh PS5, <br/>
                    PS4, PS3, PS2, Xbox 360, Xbox One, Nintendo Wii, Nintendo Switch... 
                    và phụ kiện chính hãng. Chúng tôi tự tin mang đến những sản phẩm, <br/>
                    dịch vụ chất lượng với giá thành phù hợp với mọi game thủ.</h4>
            </div>
        </div>
        
    </div>
    <div class="footer-bottom">
        <p>&copy;</p>
    </div>
</footer>
</body>

</html>
