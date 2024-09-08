<?php
require_once '../php/logic/connect.php';

// Get email from cookie
$email = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';

// Function to get cartId by email
function getCartIdByEmail($conn, $email) {
    $sql = "SELECT cartId FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        error_log("Prepare statement error: " . $conn->error);
        return null;
    }
    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        error_log("Execute error: " . $stmt->error);
        return null;
    }
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['cartId'];
    }
    return null;
}

// Function to get cart items
function getCartItems($conn, $cartId) {
    $cartItems = array();
    if ($cartId) {
        $sql = "SELECT ci.*, p.name, p.price, p.image FROM cart_items ci 
                JOIN products p ON ci.productId = p.id 
                WHERE ci.cartId = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            error_log("Prepare statement error: " . $conn->error);
            return $cartItems;
        }
        $stmt->bind_param("i", $cartId);
        if (!$stmt->execute()) {
            error_log("Execute error: " . $stmt->error);
            return $cartItems;
        }
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
        }
    }
    return $cartItems;
}

// Get cartId for the user
$cartId = getCartIdByEmail($conn, $email);

// Fetch cart items
$cartItems = getCartItems($conn, $cartId);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tay Cầm Chơi Game PC</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/cart.css" />
    <script src="../js/cart.js" defer></script>
  </head>

  <body>
    <div id="wrapper">
      <header id="header">
        <div class="logo">
          <img src="../img/logo.png" alt="Logo" />
        </div>
        <nav class="main-nav">
          <a href="../index.php">Trang chủ</a>
          <a href="../html/contactd.php">Liên Hệ</a>
          <a href="../html/aboutd.php">About</a>
          <a href="../login.php">Đăng Ký</a>
        </nav>
        <div id="actions">
          <div class="search">
            <input
              type="text"
              class="searchTerm"
              placeholder="What are you looking for?"
            />
            <button type="submit" class="searchButton">
              <i class="fa fa-search"
                ><img src="../img/Search_button.png" alt="Search"
              /></i>
            </button>
          </div>
          <div class="item">
            <a href="../html/yeuthichd.php"
              ><img src="../img/heart_icon.png" alt="User Icon"
            /></a>
          </div>
          <div class="item_cart">
            <a href="html/cartd.php"
              ><img src="../img/cart_icon.png" alt="Cart Icon"
            /></a>
          </div>
        </div>
      </header>
    </div>
    <div class="container">
      <div class="page">
        <p><a class="home" href="../index.php">Trang chủ</a></p>
        <p>/</p>
        <p><a>Giỏ hàng</a></p>
      </div>
      <br />
      <br />
      <div class="cart">
        <div class="title">
          <p>Sản phẩm</p>
          <p class="item">Giá tiền</p>
          <p class="item">Số lượng</p>
          <p class="item">Tổng tiền</p>
        </div>
        <?php foreach ($cartItems as $item): ?>
          <div id="<?php echo $item['productId']; ?>" class="product">
            <div class="product-info">
              <img src="../img/product/<?php echo $item['image']; ?>" alt="Product" />
              <p><?php echo $item['name']; ?></p>
            </div>
            <p class="product-item"><span class="price"><?php echo number_format($item['price'], 0, ',', '.'); ?></span>đ</p>
            <div class="product-item">
              <input class="quantity" type="number" value="<?php echo $item['quantity']; ?>" min="1" onchange="updateItemTotal(this)" />
            </div>
            <p class="product-item"><span class="total"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></span>đ</p>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="btn">
        <button onclick="window.location.href='../index.php'">Trở lại mua hàng</button>
        <button onclick="updateCart()">Cập nhật giỏ hàng</button>
      </div>
      <div class="total-table">
        <div class="cart-total">
          <p>Tổng tiền giỏ hàng</p>
          <hr />
          <p>Tổng tiền: <span class="money-total"></span></p>
          <hr />
          <button onclick="checkout()">Thanh toán</button>
        </div>
      </div>
    </div>
    <script>
      function updateItemTotal(input) {
        const productDiv = input.closest('.product');
        const price = parseFloat(productDiv.querySelector('.price').innerText.replace(/\./g, '').replace('đ', ''));
        const quantity = parseInt(input.value);
        const total = price * quantity;
        productDiv.querySelector('.total').innerText = total.toLocaleString('vi-VN');
        updateTotalMoney();
      }

      function updateTotalMoney() {
        const totalElements = document.getElementsByClassName("total");
        let totalMoney = 0;
        for (let i = 0; i < totalElements.length; i++) {
          const totalElement = totalElements[i];
          const total = parseFloat(
            totalElement.innerText.replace(/đ/, "").replace(/\./g, "")
          );
          totalMoney += total;
        }
        const moneyTotalElement = document.querySelector(".money-total");
        moneyTotalElement.innerText = totalMoney.toLocaleString("vi-VN") + "đ";
      }

      function updateCart() {
        // Here you would typically send an AJAX request to update the cart on the server
        // For now, we'll just update the totals on the page
        const products = document.getElementsByClassName('product');
        for (let product of products) {
          const quantity = product.querySelector('.quantity').value;
          const price = parseFloat(product.querySelector('.price').innerText.replace(/\./g, '').replace('đ', ''));
          const total = quantity * price;
          product.querySelector('.total').innerText = total.toLocaleString('vi-VN') + 'đ';
        }
        updateTotalMoney();
        alert('Giỏ hàng đã được cập nhật!');
      }

      function checkout() {
        const products = document.getElementsByClassName('product');
        const cartData = [];
        let totalAmount = 0;

        for (let product of products) {
            const productId = product.id;
            const quantity = parseInt(product.querySelector('.quantity').value);
            const price = parseFloat(product.querySelector('.price').innerText.replace(/\./g, '').replace('đ', ''));
            const total = quantity * price;
            const name = product.querySelector('.product-info p').innerText;
            const image = product.querySelector('.product-info img').src.split('/').pop();
            
            cartData.push({
                productId: productId,
                quantity: quantity,
                price: price,
                total: total,
                name: name,
                image: image
            });

            totalAmount += total;
        }

        // Create a form and add cart data as hidden fields
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'checkout.php';

        // Add cart data
        const cartDataInput = document.createElement('input');
        cartDataInput.type = 'hidden';
        cartDataInput.name = 'cartData';
        cartDataInput.value = JSON.stringify(cartData);
        form.appendChild(cartDataInput);

        // Add total amount
        const totalAmountInput = document.createElement('input');
        totalAmountInput.type = 'hidden';
        totalAmountInput.name = 'totalAmount';
        totalAmountInput.value = totalAmount;
        form.appendChild(totalAmountInput);

        // Append form to body and submit
        document.body.appendChild(form);
        form.submit();
      }

      updateTotalMoney();
    </script>
  </body>
</html>
