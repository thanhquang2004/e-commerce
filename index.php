<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tay Cầm Chơi Game PC</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div id="wrapper">
        <header id="header">
            <div class="logo">
                <img src="./img/logo.png" alt="Logo">
            </div>
            <nav class="main-nav">
                <a href="./index.php">Trang chủ</a>
                <a href="./html/contact.php">Liên Hệ</a>
                <a href="./html/about.php">About</a>
                <a href="./login.php">Đăng Ký</a>
            </nav>
            <div id="actions">
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="What are you looking for?">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"><img src="./img/Search_button.png" alt="Search"></i>
                    </button>
                </div>
                <div class="item">
                    <a href="./html/yeuthich.php"><img src="./img/heart_icon.png" alt="User Icon"></a>
                </div>
                <div class="item_cart">
                    <a href="./html/cart.php"><img src="./img/cart_icon.png" alt="Cart Icon"></a>
                </div>
            </div>
        </header>
    </div>
    <main>
        <aside id="menu_left">
            <ul>
                <li><a href="./html/taycamXbox.php">Tay Cầm Xbox</a></li>
                <li><a href="./html/TaycamA102L.php">Tay Cầm A102L</a></li>
                <li><a href="./html/Taycam8bitdo.php">Tay Cầm 8Bitdo</a></li>
                <li><a href="./html/PS4.php">Tay Cầm PS4</a></li>
                <li><a href="./html/Razer.php">Tay Cầm Razer</a></li>
                <li><a href="./html/phukien.php">Phụ Kiện Tay Cầm</a></li>
            </ul>
        </aside>
        <section class="main-banner">
            <div class="slider">
                <div class="list">
                    <div class="item">
                        <img src="./img/anh1.jpg" alt="Banner 1">
                    </div>
                    <div class="item">
                        <img src="./img/anh2.jpg" alt="Banner 2">
                    </div>
                    <div class="item">
                        <img src="./img/anh3.jpg" alt="Banner 3">
                    </div>
                    <div class="item">
                        <img src="./img/anh4.jpg" alt="Banner 4">
                    </div>
                    <div class="item">
                        <img src="./img/anh5.jpg" alt="Banner 5">
                    </div>
                    <div class="item">
                        <img src="./img/anh6.jpg" alt="Banner 6">
                    </div>
                </div>
                <div class="buttons">
                    <button id="prev">&lt;</button>
                    <button id="next">&gt;</button>
                </div>
                <ul class="dots">
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </section>
        </div>
        </div>
        <script src="./js/app.js"></script>
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
                        <li><a href="#"><img src="../img/Icon-Facebook.png" alt="Facebook"></a></li>
                        <li><a href="#"><img src="../img/Icon-Twitter.png" alt="Twitter"></a></li>
                        <li><a href="#"><img src="../img/icon-instagram.png" alt="Instagram"></a></li>
                    </ul>
                </address>
            </div>
            <div class="account">
                <h3>Thông Tin</h3>
                <ul>
                    <li><a href="../myaccount">Tài Khoản</a></li>
                    <li><a href="../login.php">Login / Register</a></li>
                    <li><a href="../html/cart.php">Giỏ Hàng</a></li>
                    <li><a href="../index.php">Cửa Hàng</a></li>
                </ul>
            </div>
            <div class="quick-link">
                <h3>Chính sách</h3>
                <ul>
                    <li><a href="../html/privacy.php">Chính sách bảo mật</a></li>
                    <li><a href="../html/terms.php">Điều khoản sử dụng</a></li>
                    <li><a href="../html/faq.php">Câu hỏi thường gặp</a></li>
                    <li><a href="../html/contact.php">Liên Hệ</a></li>
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