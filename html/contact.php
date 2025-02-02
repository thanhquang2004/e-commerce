<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tay Cầm Chơi Game PC</title>
    <link rel="stylesheet" href="../css/contact.css">
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
        <div id="contact-wrapper">
            <div class="contact-info">
                <div class="info-box">
                    <img src="../img/phone_logo.png" alt="Phone Icon">
                    <div>
                        <h3>Call To Us</h3>
                        <p>Chúng tôi luôn sẵn sàng 24/7.</p>
                        <p class="phone">Phone: +8801611122222</p>
                        <p class="phone">Phone: +8801611122222</p>
                    </div>
                </div>
                <hr>
                <div class="info-box">
                    <img src="../img/email_icon.png" alt="Email Icon">
                    <div>
                        <h3>Write To Us</h3>
                        <p>Fill out our form and we will contact you within 24 hours.</p>
                        <p>Emails: customer@exclusive.com</p>
                        <p>Emails: support@exclusive.com</p>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <form id="contact-form">
                    <input type="text" name="name" placeholder="Your Name *" required>
                    <input type="email" name="email" placeholder="Your Email *" required>
                    <input type="tel" name="phone" placeholder="Your Phone *" required>
                    <textarea name="message" placeholder="Your Message" rows="6" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
                <div class="message" id="form-message"></div>
            </div>
    </main>
    <script src="../js/contact.js"></script>
    <footer></footer>
</body>

</html>