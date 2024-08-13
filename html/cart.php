<?php

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
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            function renderProducts() {
              const container = document.querySelector(".cart");

              products.forEach((product) => {
                const productHTML = `
        <div id="${product.id}" class="product">
          <div class="product-info">
            <img src="../img/anh1.jpg" alt="Product" />
            <p>${product.name}</p>
          </div>
          <p class="product-item"><span class="price">${product.price}</span>đ</p>
          <div class="product-item">
            <input class="quantity" type="number" value="${product.quantity}" min="0" />
          </div>
          <p class="product-item"><span class="total"></span></p>
        </div>
       `;
                container.innerHTML += productHTML;
              });
            }

            function totalItem(id) {
              const productElement = document.getElementById(id);
              const quantityElement =
                productElement.getElementsByClassName("quantity")[0];
              const priceElement =
                productElement.getElementsByClassName("price")[0];
              const totalElement =
                productElement.getElementsByClassName("total")[0];

              function updateTotal() {
                let quantity = parseInt(quantityElement.value);

                // Nếu số lượng dưới 0, đặt về 0
                if (quantity < 0) {
                  quantity = 0;
                  quantityElement.value = 0;
                }

                const price = parseFloat(
                  priceElement.innerText.replace(/đ/, "").replace(/,/g, "")
                );
                const total = quantity * price;
                totalElement.innerText = total.toLocaleString("vi-VN") + "đ";
              }

              // Initial total calculation
              updateTotal();

              // Add event listener to update total when quantity changes
              quantityElement.addEventListener("input", updateTotal);
            }

            renderProducts();
            products.forEach((product) => totalItem(product.id));
          });
        </script>
      </div>
      <div class="btn">
        <button>Trở lại mua hàng</button>
        <button onclick="updateTotalMoney()">Cập nhập giỏi hàng</button>
      </div>
      <div class="total-table">
        <div></div>
        
      </div>
    </div>
    <script>
      function updateTotalMoney() {

        document.getElementsByClassName("total-table").innerHTML = `
        <div class="cart-total">
          <p>Tổng tiền giỏ hàng</p>
          <hr />
          <p>Tổng tiền: <span class="money-total"></span></p>
          <hr />
          <button>Thanh toán</button>
        </div>`

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
    </script>
  </body>
</html>
