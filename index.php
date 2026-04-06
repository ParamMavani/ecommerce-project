<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Ecommerce</title>
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<header class="nav">
  <h2>EcommerceMart</h2>
  <?php include 'components/navbar.php'; ?>
</header>

<section class="hero">
  <h1>Next-Level Shopping</h1>
  <p>Premium experience. Fast. Secure.</p>
  <a href="products.php"><button class="btn-main">Shop Now</button></a>
</section>

<section class="cards">
  <div class="glass-card">⚡ Fast Delivery</div>
  <div class="glass-card">🔒 Secure Payment</div>
  <div class="glass-card">✨ Premium Quality</div>
  <div class="glass-card">↩️ Easy Returns</div>
</section>

</body>
</html>