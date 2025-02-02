<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tay Cầm Chơi Game PC</title>
    <link rel="stylesheet" href="../css/xbox.css">
</head>

<body>
    <div id="wrapper">
        <header id="header">
            <div class="logo">
                <img src="../img/logo.png" alt="Logo">
            </div>
            <nav class="main-nav">
                <a href="../index.php">Trang chủ</a>
                <a href="../html/contact.php">Liên Hệ</a>
                <a href="../html/about.php">About</a>
                <a href="../login.php">Đăng Ký</a>
            </nav>
            <div id="actions">
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="What are you looking for?">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"><img src="../img/Search_button.png" alt="Search"></i>
                    </button>
                </div>
                <div class="item">
                    <a href="../html/yeuthich.php"><img src="../img/heart_icon.png" alt="User Icon"></a>
                </div>
                <div class="item_cart">
                    <a href="../html/cart.php"><img src="../img/cart_icon.png" alt="Cart Icon"></a>
                </div>
            </div>
        </header>
    </div>
    <main>
        <!-- Trang san pham -->
        <div class="product">
            <div class="headline">
                <h2>Tay Cầm Xbox</h2>
            </div>
            
            <ul class="products">
                <?php
                include '../php/logic/connect.php';
                $sql = "SELECT * FROM products WHERE category = 'Tay cầm Xbox'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<li>';
                        echo '<div class="product-item">';
                        echo '<div class="product-top">';
                        echo '<a href="" class="product-thumb">';
                        echo '<img src="../img/Xbox/' . $row["image"] . '" alt="' . $row["name"] . '">';
                        echo '</a>';
                        echo '<form action="../php/logic/xulyaddtocart.php" method="POST">';
                        echo '<input type="hidden" name="productId" value="' . $row["id"] . '">';
                        echo '<input type="hidden" name="productName" value="' . $row["name"] . '">';
                        echo '<input type="hidden" name="productPrice" value="' . $row["price"] . '">';
                        echo '<input type="hidden" name="productImage" value="../img/product/' . $row["image"] . '">';
                        echo '<a class="addtocart"><button style="border: none; color: white; background: none; padding: 0; cursor: pointer;" type="submit" class="addtocart" >Thêm Vào Giỏ Hàng</button></a>';
                        echo '</form>';
                        echo '</div>';
                        echo '<div class="product-info">';
                        echo '<a href="" class="product-name">' . $row["name"] . '</a>';
                        echo '<div class="product-price">' . number_format($row["price"]) . '₫</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</li>';
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </ul>
        </div>
        <?php
        session_start();
        if(isset($_SESSION['alert'])) {
            echo '<script>alert("' . $_SESSION['alert'] . '");</script>';
            unset($_SESSION['alert']);
        }
        ?>
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