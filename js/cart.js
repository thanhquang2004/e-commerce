function totalItem(id) {
  document.addEventListener("DOMContentLoaded", (event) => {
    const productElement = document.getElementById("1");
    const quantityElement =
      productElement.getElementsByClassName("quantity")[0];
    const priceElement = productElement.getElementsByClassName("price")[0];
    const totalElement = productElement.getElementsByClassName("total")[0];

    function updateTotal() {
      const quantity = parseInt(quantityElement.value);

      if(quantity < 0) {
        quantity = 0;
        quantityElement.value = 0;
      }

      const price = parseFloat(priceElement.innerText);
      const total = quantity * price;
      totalElement.innerText = total.toLocaleString("vi-VN") + "đ";
    }

    // Initial total calculation
    updateTotal();

    // Add event listener to update total when quantity changes
    quantityElement.addEventListener("input", updateTotal);
  });
}

const products = [
  { id: 1, name: "Tay cầm Xbox", price: 1000000, quantity: 1 },
  { id: 2, name: "Tay cầm PS4", price: 1200000, quantity: 2 },
  // Thêm các sản phẩm khác nếu cần
];

function renderProducts() {
  const container = document.querySelector('.cart-item');

  // Clear previous content
  container.innerHTML = '';

  // Render each product
  products.forEach(product => {
    const productHTML = `
      <div id="${product.id}" class="product">
          <div class="product-info">
            <img src="/img/anh1.jpg" alt="Product" />
            <p>${product.name}</p>
          </div>
          <p class="product-item"><span class="price">${product.price}</span>đ</p>
          <div class="product-item">
            <input class="quantity" type="number" value="1" />
          </div>
          <p class="product-item"><span class="total"></span></p>
          <script>
              const productElement = document.getElementById("1");
              const quantityElement =
                productElement.getElementsByClassName("quantity")[0];
              const priceElement =
                productElement.getElementsByClassName("price")[0];
              const totalElement =
                productElement.getElementsByClassName("total")[0];

              function updateTotal() {
                const quantity = parseInt(quantityElement.value);

                if (quantity < 0) {
                  quantity = 0;
                  quantityElement.value = 0;
                }

                const price = parseFloat(priceElement.innerText);
                const total = quantity * price;
                totalElement.innerText = total.toLocaleString("vi-VN") + "đ";
              }

              // Initial total calculation
              updateTotal();

              // Add event listener to update total when quantity changes
              quantityElement.addEventListener("input", updateTotal);
          </script>
        </div>
    `;
    container.innerHTML += productHTML;
  });
}
