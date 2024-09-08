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
                <?php
                include '../../php/logic/connect.php';
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="product-item" data-id="'.$row["id"].'">';
                        echo '<div class="product-img">';
                        echo '<img src="../../img/products/'.$row["image"].'" alt="'.$row["name"].'">';
                        echo '</div>';
                        echo '<div class="product-info">';
                        echo '<h3>'.$row["name"].'</h3>';
                        echo '<p>Giá: '.number_format($row["price"]).'</p>';
                        echo '<p>Số lượng: '.$row["quantity"].'</p>';
                        echo '<button class="edit-btn" onclick="editProduct('.$row["id"].')">Sửa</button>';
                        echo '<button class="delete-btn" onclick="deleteProduct('.$row["id"].')">Xóa</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </div>
        </main>
    </main>
    <footer id="footer">
        <!-- Footer content remains unchanged -->
    </footer>
    <script>
    function editProduct(id) {
        // Fetch product details
        fetch('../../php/logic/getproduct.php?id=' + id)
            .then(response => response.json())
            .then(product => {
                // Create form
                let form = document.createElement('form');
                form.innerHTML = `
                    <input type="hidden" name="product_id" value="${product.id}">
                    <input type="text" name="name" value="${product.name}" required>
                    <input type="number" name="product-price" value="${product.price}" required>
                    <input type="number" name="quantity" value="${product.quantity}" required>
                    <input type="text" name="code" value="${product.code}" required>
                    <input type="text" name="category" value="${product.category}" required>
                    <input type="file" name="image" accept=".jpg, .jpeg, .png">
                    <button type="submit">Lưu</button>
                `;
                
                // Add event listener to form
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    let formData = new FormData(this);
                    fetch('../../php/logic/xulysuaproduct.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(result => {
                        alert(result);
                        location.reload(); // Reload page to show updated product
                    })
                    .catch(error => console.error('Error:', error));
                });

                // Show form in a modal or replace product display with form
                let productItem = document.querySelector(`.product-item[data-id="${id}"]`);
                productItem.innerHTML = '';
                productItem.appendChild(form); 
            })
    }

    function deleteProduct(id) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
            fetch('../../php/logic/xulyxoaproduct.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'product_id=' + id
            })
            .then(response => response.text())
            .then(result => {
                if (result === "Xóa sản phẩm thành công!") {
                    alert(result);
                    location.reload(); // Reload page to remove deleted product
                } else {
                    alert("Lỗi: " + result);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Đã xảy ra lỗi khi xóa sản phẩm.");
            });
        }
    }
    </script>
</body>

</html>
