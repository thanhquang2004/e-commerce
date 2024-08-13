<?php 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="stylesheet" href="./css/login.css" />
  </head>

  <body>
    <header id="header">
        <div class="logo">
            <img src="img/logo.png" alt="Logo">
        </div>
        <nav class="main-nav">
          <a href="./index.php">Trang chủ</a>
          <a href="html/contact.php">Liên Hệ</a>
          <a href="html/about.php">About</a>
      </nav>

        <div id="actions">
            <div class="search">
                <input type="text" class="searchTerm" placeholder="What are you looking for?">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"><img src="img/Search_button.png" alt="Search"></i>
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
      <div id="main-content">
        <div class="container">
          <div>
            <img src="img/authscreen.jpg" class="login-image" alt="User Icon" />
          </div>
          <div style="margin-top: 100px; width: 500px">
            <h1>Đăng nhập</h1>
            <p><b>Vui lòng điền thông tin để đăng nhập</b></p>
            <form action="/login" method="POST">
              <div class="login-form">
                <label for="email" class="form-label"><b>Email</b></label>
                <input
                  type="text"
                  placeholder="Nhập email"
                  name="email"
                  class="form-field"
                  required
                />
              </div>
              <div class="login-form">
                <label for="psw" class="form-label"><b>Mật khẩu</b></label>
                <input
                  type="password"
                  placeholder="Nhập mật khẩu"
                  name="psw"
                  class="form-field"
                  required
                />
              </div>
              <br />
              <div>
                <button type="submit" class="registerbtn">Đăng nhập</button>
              </div>
              <div class="container signin">
                <p>Bạn chưa có tài khoản? <a href="./signup.php">Đăng ký</a>.</p>
              </div>
            </form>
          </div>
        </div>
      </div>
      <footer></footer>
    </div>
  </body>
</html>
