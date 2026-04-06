<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Order Success</title>
<link rel="stylesheet" href="assets/styles.css">

<style>
.success-container {
  text-align: center;
  margin-top: 120px;
  animation: fadeIn 0.8s ease;
}

.success-icon {
  font-size: 70px;
  margin-bottom: 20px;
  color: #00ffa3;
}

.success-container h1 {
  font-size: 36px;
  margin-bottom: 10px;
}

.success-container p {
  color: #aaa;
  margin-bottom: 30px;
}

.success-actions a {
  margin: 10px;
  padding: 12px 24px;
  border-radius: 30px;
  text-decoration: none;
  background: linear-gradient(135deg,#00c8f0,#00ffa3);
  color: black;
  font-weight: 600;
  transition: 0.3s;
}

.success-actions a:hover {
  transform: scale(1.05);
}
</style>
</head>

<body>

<div class="success-container">
  <div class="success-icon">✅</div>
  <h1>Payment Successful!</h1>
  <p>Your order has been placed successfully.</p>

  <div class="success-actions">
    <a href="index.php">🏠 Home</a>
    <a href="products.php">🛍 Shop More</a>
  </div>
</div>

<script>
localStorage.removeItem("cart");
</script>

</body>
</html>