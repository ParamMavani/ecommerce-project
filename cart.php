<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cart — EcommerceMart</title>
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<header class="nav glass">
  <div class="logo">Ecommerce<span>Mart</span></div>
  <nav>
    <a href="index.php">Home</a>
    <a href="products.php">Shop</a>
  </nav>
</header>

<h1 style="text-align:center;margin-top:30px;">🛒 Your Cart</h1>

<div class="cart-container" id="cartContainer"></div>

<h2 style="text-align:center;">Total: ₹<span id="total">0</span></h2>

<div class="checkout-center">
  <button class="proceed-btn" onclick="handleCheckout()">
    Proceed to Payment →
  </button>
</div>

<script>
// 🛒 LOAD CART
function loadCart() {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  let container = document.getElementById("cartContainer");
  let total = 0;

  container.innerHTML = "";

  if (cart.length === 0) {
    container.innerHTML = "<p style='text-align:center;'>Your cart is empty 😢</p>";
    document.getElementById("total").innerText = 0;
    return;
  }

  cart.forEach((item, index) => {
    total += item.price * item.qty;

    container.innerHTML += `
      <div class="cart-item">
        <img src="${item.img}">
        <h3>${item.name}</h3>
        <p>₹${item.price}</p>

        <div class="qty-box">
          <button onclick="changeQty(${index}, -1)">-</button>
          <span>${item.qty}</span>
          <button onclick="changeQty(${index}, 1)">+</button>
        </div>

        <button class="remove-btn" onclick="removeItem(${index})">
          Remove
        </button>
      </div>
    `;
  });

  document.getElementById("total").innerText = total;
}

// 🔢 CHANGE QTY
function changeQty(index, change) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  cart[index].qty += change;

  if (cart[index].qty <= 0) {
    cart.splice(index, 1);
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  loadCart();
}

// ❌ REMOVE ITEM
function removeItem(index) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  cart.splice(index, 1);

  localStorage.setItem("cart", JSON.stringify(cart));
  loadCart();
}

// 🚀 CHECKOUT VALIDATION
function handleCheckout() {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  if (cart.length === 0) {
    showPopup("⚠️ Your cart is empty!", "Please add items before proceeding.");
    return;
  }

  window.location.href = "checkout.php";
}

// 🔥 POPUP
function showPopup(title, message) {
  let popup = document.createElement("div");
  popup.className = "custom-popup";

  popup.innerHTML = `
    <div class="popup-box">
      <h2>${title}</h2>
      <p>${message}</p>
      <button onclick="this.parentElement.parentElement.remove()">OK</button>
    </div>
  `;

  document.body.appendChild(popup);
}

// LOAD ON START
loadCart();
</script>

</body>
</html>