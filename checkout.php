<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout — EcommerceMart</title>
<link rel="stylesheet" href="assets/styles.css">

<!-- PayPal -->
<script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID&currency=USD"></script>

<style>

/* TITLE */
.checkout-title {
  text-align: center;
  margin-top: 40px;
  font-size: 34px;
  font-weight: 700;
  background: linear-gradient(90deg,#00e5ff,#ff00cc);
  -webkit-background-clip: text;
  color: transparent;
}

/* LAYOUT */
.checkout-container {
  display: flex;
  gap: 30px;
  max-width: 1100px;
  margin: 40px auto;
  padding: 20px;
}

/* GLASS */
.glass-card {
  flex: 1;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(0,200,240,0.2);
  border-radius: 18px;
  padding: 25px;
  backdrop-filter: blur(12px);
}

/* ITEMS */
#orderItems p {
  display: flex;
  justify-content: space-between;
  color: #ccc;
}

/* TOTAL */
.summary-total {
  margin-top: 20px;
  font-size: 22px;
  color: #00e5ff;
}

/* TABS */
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
  transition: 0.3s;
}

.payment-tabs button:hover {
  background: linear-gradient(135deg,#00c8f0,#00ffa3);
  color: #000;
}

/* BOX */
.payment-box {
  display: none;
}

.payment-box.active {
  display: block;
}

/* BUTTON */
.pay-btn {
  width: 100%;
  padding: 14px;
  border-radius: 30px;
  border: none;
  background: linear-gradient(135deg,#00c8f0,#00ffa3);
  cursor: pointer;
  margin-top: 10px;
  font-weight: 600;
}

.pay-btn:hover {
  transform: scale(1.05);
}

/* INPUT */
.input-group {
  margin-bottom: 10px;
}

.input-group input {
  width: 100%;
  padding: 12px;
  border-radius: 10px;
  border: none;
  background: rgba(255,255,255,0.08);
  color: white;
}

/* UPI */
.upi-apps {
  display: flex;
  gap: 10px;
  margin-bottom: 10px;
}

.upi-app {
  flex: 1;
  padding: 10px;
  text-align: center;
  border-radius: 10px;
  background: rgba(255,255,255,0.08);
  cursor: pointer;
  transition: 0.3s;
}

.upi-app.active {
  background: linear-gradient(135deg,#00c8f0,#00ffa3);
  color: black;
}

/* QR */
.upi-qr {
  text-align: center;
  margin-top: 15px;
}

</style>
</head>

<body>

<h1 class="checkout-title">
  <span class="emoji">💳</span> Secure Checkout
</h1>
<div class="checkout-container">

<!-- 🧾 ORDER -->
<div class="glass-card">
  <h2>🧾 Order Summary</h2>
  <div id="orderItems"></div>
  <h3 class="summary-total">💰 Total: ₹<span id="totalAmount">0</span></h3>
</div>

<!-- 💳 PAYMENT -->
<div class="glass-card">

  <h2>💰 Select Payment Method</h2>

  <div class="payment-tabs">
    <button onclick="showPayment('paypal')">💰 PayPal</button>
    <button onclick="showPayment('upi')">📱 UPI</button>
    <button onclick="showPayment('cod')">🚚 COD</button>
    <button onclick="showPayment('card')">💳 Card</button>
  </div>

  <!-- 💰 PAYPAL -->
  <div id="paypal" class="payment-box">
    <p>🌍 Pay securely using PayPal</p>
    <div id="paypal-button-container"></div>
  </div>

  <!-- 📱 UPI -->
  <div id="upi" class="payment-box">

    <h3>📱 UPI Payment</h3>

    <div class="upi-apps">
      <div class="upi-app" onclick="selectUPI('gpay')">🟢 GPay</div>
      <div class="upi-app" onclick="selectUPI('phonepe')">🟣 PhonePe</div>
      <div class="upi-app" onclick="selectUPI('paytm')">🔵 Paytm</div>
    </div>

    <div class="input-group">
      <input id="upiId" placeholder="Enter UPI ID (example@upi)">
    </div>

    <button class="pay-btn" onclick="payWithUPI()">⚡ Pay via UPI</button>

    <div class="upi-qr">
      <p>📷 Scan QR to Pay</p>
      <img id="qrImg" width="150">
    </div>

  </div>

  <!-- 🚚 COD -->
  <div id="cod" class="payment-box">
    <p>🚚 Pay after delivery</p>
    <button class="pay-btn" onclick="success()">📦 Place Order</button>
  </div>

  <!-- 💳 CARD -->
  <div id="card" class="payment-box">
    <div class="input-group"><input placeholder="💳 Card Number"></div>
    <div class="input-group"><input placeholder="📅 MM/YY"></div>
    <div class="input-group"><input placeholder="🔒 CVV"></div>
    <button class="pay-btn" onclick="success()">💸 Pay Now</button>
  </div>

</div>

</div>

<script>

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
}

loadOrder();

// SWITCH
function showPayment(type) {
  document.querySelectorAll(".payment-box").forEach(el => el.classList.remove("active"));
  document.getElementById(type).classList.add("active");
}

// SUCCESS
function success() {
  if (totalAmount === 0) return alert("⚠️ Cart is empty!");

  alert("🎉 Payment successful!");
  localStorage.removeItem("cart");
  window.location.href = "success.php";
}

// UPI
function payWithUPI() {
  let upi = document.getElementById("upiId").value;

  if (!upi.includes("@")) return alert("⚠️ Invalid UPI ID");

  let link = `upi://pay?pa=${upi}&pn=Shop&am=${totalAmount}&cu=INR`;
  window.location.href = link;

  setTimeout(success, 2000);
}

// QR
function generateQR() {
  let qr = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa=test@upi&am=${totalAmount}`;
  document.getElementById("qrImg").src = qr;
}
setTimeout(generateQR, 500);

// PAYPAL
paypal.Buttons({
  createOrder: function(data, actions) {
    if (totalAmount === 0) return;
    return actions.order.create({
      purchase_units: [{ amount: { value: totalAmount } }]
    });
  },
  onApprove: function(data, actions) {
    return actions.order.capture().then(success);
  }
}).render('#paypal-button-container');

// default
showPayment('paypal');

</script>

</body>
</html>