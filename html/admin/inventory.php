<?php
// Không có lỗi PHP hiển nhiên trong phần này
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <!-- <link rel="stylesheet" href="../../css/styles.css"> -->
    <link rel="stylesheet" href="../../css/inventory.css">
</head>

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
            <div class="add-prod"><a href="addProduct.php"><button>Thêm sản phẩm</button></a></div>
            <div class="product">
                <div class="product-item">
                    <div class="product-img">
                        <img src="../../img/ps5.jpg" alt="PS5">
                    </div>
                    <div class="product-info">
                        <h3>PS5</h3>
                        <p>Giá: 10.000.000</p>
                        <p>Số lượng: 10</p>
                        <button>Sửa</button>
                        <button>Xóa</button>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-img">
                        <img src="../../img/ps4.jpg" alt="PS4">
                    </div>
                    <div class="product-info">
                        <h3>PS4</h3>
                        <p>Giá: 5.000.000</p>
                        <p>Số lượng: 20</p>
                        <button>Sửa</button>
                        <button>Xóa</button>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-img">
                        <img src="../../img/ps3.jpg" alt="PS3">
                    </div>
                    <div class="product-info">
                        <h3>PS3</h3>
                        <p>Giá: 3.000.000</p>
                        <p>Số lượng: 30</p>
                        <button>Sửa</button>
                        <button>Xóa</button>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-img">
                        <img src="../../img/ps2.jpg" alt="PS2">
                    </div>
                    <div class="product-info">
                        <h3>PS2</h3>
                        <p>Giá: 2.000.000</p>
                        <p>Số lượng: 40</p>
                        <button>Sửa</button>
                        <button>Xóa</button>
                    </div>
                </div>
            </div>
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
        <div class="footer-bottom">
            <p>&copy;</p>
        </div>
    </footer>
</body>

</html>
