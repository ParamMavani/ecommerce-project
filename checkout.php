<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout — EcommerceMart</title>
<link rel="stylesheet" href="assets/styles.css">

<!-- ✅ PayPal SDK (FIXED) -->
<script src="https://www.paypal.com/sdk/js?client-id=AQ8bqirFCmcaEk9Uoxe5yoSt68gCv884qorLLVxR3cO_fll2suwNEAWTD9Ho-VapUgEIhhd6S0Wy6LHA&currency=USD&intent=capture"></script>
<style>
/* (Your same CSS — unchanged) */
.checkout-title {
  text-align: center;
  margin-top: 40px;
  font-size: 34px;
  font-weight: 700;
  background: linear-gradient(90deg,#00e5ff,#ff00cc);
  -webkit-background-clip: text;
  color: transparent;
}
.checkout-container {
  display: flex;
  gap: 30px;
  max-width: 1100px;
  margin: 40px auto;
  padding: 20px;
}
.glass-card {
  flex: 1;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(0,200,240,0.2);
  border-radius: 18px;
  padding: 25px;
  backdrop-filter: blur(12px);
}
#orderItems p {
  display: flex;
  justify-content: space-between;
  color: #ccc;
}
.summary-total {
  margin-top: 20px;
  font-size: 22px;
  color: #00e5ff;
}
.payment-tabs {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}
.payment-tabs button {
  flex: 1;
  padding: 12px;
  border-radius: 30px;
  border: none;
  background: rgba(255,255,255,0.08);
  color: #fff;
  cursor: pointer;
}
.payment-box { display: none; }
.payment-box.active { display: block; }
.pay-btn {
  width: 100%;
  padding: 14px;
  border-radius: 30px;
  border: none;
  background: linear-gradient(135deg,#00c8f0,#00ffa3);
  cursor: pointer;
}
.input-group input {
  width: 100%;
  padding: 12px;
  border-radius: 10px;
  border: none;
  background: rgba(255,255,255,0.08);
  color: white;
}
</style>
</head>

<body>

<div class="navbar">

  <div class="logo">🛒 EcommerceMart</div>

  <div class="nav-links">
    <a href="index.php">🏠 Home</a>
    <a href="products.php">🛍️ Products</a>
  </div>

</div>

<h1 class="checkout-title">💳 Secure Checkout</h1>

<div class="checkout-container">

<!-- ORDER -->
<div class="glass-card">
  <h2>🧾 Order Summary</h2>
  <div id="orderItems"></div>
  <h3 class="summary-total">💰 Total: ₹<span id="totalAmount">0</span></h3>
</div>

<!-- PAYMENT -->
<div class="glass-card">
  <h2>💰 Select Payment Method</h2>

  <div class="payment-tabs">
    <button onclick="showPayment('paypal')">💰 PayPal</button>
    <button onclick="showPayment('upi')">📱 UPI</button>
    <button onclick="showPayment('cod')">🚚 COD</button>
  </div>

  <!-- PAYPAL -->
  <div id="paypal" class="payment-box">
    <div id="paypal-button-container"></div>
  </div>

  <!-- UPI -->
<div id="upi" class="payment-box">

  <h3 class="upi-title">📱 Pay using UPI</h3>

  <!-- UPI APPS -->
  <div class="upi-apps">
    <div class="upi-app" onclick="selectUPI(this,'gpay')">🟢 Google Pay</div>
    <div class="upi-app" onclick="selectUPI(this,'phonepe')">🟣 PhonePe</div>
    <div class="upi-app" onclick="selectUPI(this,'paytm')">🔵 Paytm</div>
  </div>

  <!-- INPUT -->
  <div class="input-group">
    <input id="upiId" placeholder="Enter UPI ID (example@upi)">
  </div>

  <!-- BUTTON -->
  <button class="pay-btn" onclick="payWithUPI()">⚡ Pay ₹<span id="upiAmount">0</span></button>

  <!-- QR -->
  <div class="upi-qr">
    <p>OR scan QR code</p>
    <img id="qrImg" width="180">
  </div>

</div>

  <!-- COD -->
  <div id="cod" class="payment-box">
    <button class="pay-btn" onclick="success()">Place Order</button>
  </div>

</div>
</div>

<script>
function goHome() {
  window.location.href = "index.php";
}

function goProducts() {
  window.location.href = "products.php";
}

let totalAmount = 0;

// LOAD CART
function loadOrder() {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  let container = document.getElementById("orderItems");

  container.innerHTML = "";
  totalAmount = 0;

  cart.forEach(item => {
    totalAmount += item.price * item.qty;
    container.innerHTML += `<p>${item.name} x ${item.qty} <span>₹${item.price * item.qty}</span></p>`;
  });

  document.getElementById("totalAmount").innerText = totalAmount;

  // ✅ ADD THIS
  updateUPIAmount();
  generateQR();
}
loadOrder();

// SWITCH
function showPayment(type) {
  document.querySelectorAll(".payment-box").forEach(el => el.classList.remove("active"));
  document.getElementById(type).classList.add("active");
}

// SUCCESS
function success() {
  alert("🎉 Payment successful!");
  localStorage.removeItem("cart");
  window.location.href = "success.php";
}

let selectedUPI = "";

// select UPI app
function selectUPI(el, app) {
  document.querySelectorAll(".upi-app").forEach(e => e.classList.remove("active"));
  el.classList.add("active");
  selectedUPI = app;
}

// update amount in button
function updateUPIAmount() {
  let el = document.getElementById("upiAmount");
  if (el) el.innerText = totalAmount;
}

// QR generator
function generateQR() {
  let qr = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa=test@upi&pn=Shop&am=${totalAmount}&cu=INR`;
  let img = document.getElementById("qrImg");
  if (img) img.src = qr;
}

// update after cart load
setTimeout(() => {
  updateUPIAmount();
  generateQR();
}, 500);

// ✅ PAYPAL FIXED
window.onload = function () {

  if (typeof paypal === "undefined") {
    console.error("PayPal SDK not loaded");
    return;
  }

  paypal.Buttons({

    createOrder: function (data, actions) {

      if (totalAmount <= 0) {
        alert("Cart is empty!");
        return;
      }

      return actions.order.create({
        purchase_units: [{
          amount: {
            value: totalAmount.toString()
          }
        }]
      });
    },

    onApprove: function (data, actions) {
      return actions.order.capture().then(function (details) {
        alert("Payment successful by " + details.payer.name.given_name);
        success();
      });
    },

    onError: function (err) {
      console.log("PayPal Error:", err);
    }

  }).render('#paypal-button-container');

};

// default
showPayment('paypal');

</script>

</body>
</html>