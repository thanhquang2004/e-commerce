<?php
require_once '../php/logic/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartData = json_decode($_POST['cartData'], true);
    $totalAmount = $_POST['totalAmount'];
} else {
    // Redirect to cart page if accessed directly
    header('Location: cart.php');
    exit();
}

// Function to get product details
function getProductDetails($conn, $productId) {
    $sql = "SELECT name, image FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tay Cầm Chơi Game PC</title>
    <link rel="stylesheet" href="../css/about.css">
    <link rel="stylesheet" href="../css/checkout.css">
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
    <main id="main-content">
        <h1>Xác nhận đơn hàng</h1>
        <div class="order-summary">
            <br/>
            <h2>Tóm tắt đơn hàng</h2>
            <?php foreach ($cartData as $item): 
                $productDetails = getProductDetails($conn, $item['productId']);
            ?>
                <div class="order-item">
                    <img src="../img/product/<?php echo $productDetails['image']; ?>" alt="<?php echo $productDetails['name']; ?>">
                    <div class="item-details">
                        <h3><?php echo $productDetails['name']; ?></h3>
                        <p>Số lượng: <?php echo $item['quantity']; ?></p>
                        <p>Giá: <?php echo number_format($item['price'], 0, ',', '.'); ?>đ</p>
                        <p>Tổng: <?php echo number_format($item['total'], 0, ',', '.'); ?>đ</p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="total-amount">
                <h3>Tổng cộng: <?php echo number_format($totalAmount, 0, ',', '.'); ?>đ</h3>
            </div>
        </div>
        <form action="../php/logic/xulyorder.php" method="POST">
            <input type="hidden" name="cartData" value='<?php echo json_encode($cartData); ?>'>
            <input type="hidden" name="totalAmount" value="<?php echo $totalAmount; ?>">
            <button type="submit">Xác nhận đặt hàng</button>
        </form>
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
    </footer>
</body>

</html>
