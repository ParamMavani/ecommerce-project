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

<footer style="margin-top: 50px; padding: 40px 20px; background: rgba(255,255,255,0.05); border-top: 1px solid rgba(0,200,240,0.2); backdrop-filter: blur(10px); color: #ccc;">
  <div style="max-width: 1000px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px;">
    <div style="flex: 1; min-width: 200px;">
      <h3 style="color: #fff;">EcommerceMart</h3>
      <p style="margin-top: 10px; font-size: 14px;">Premium experience. Fast. Secure. Your favorite shopping destination.</p>
    </div>
    <div style="flex: 1; min-width: 200px;">
      <h3 style="color: #fff;">Quick Links</h3>
      <ul style="list-style: none; padding: 0; margin-top: 10px; font-size: 14px; line-height: 1.8;">
        <li><a href="index.php" style="color: #00c8f0; text-decoration: none;">🏠 Home</a></li>
        <li><a href="products.php" style="color: #00c8f0; text-decoration: none;">🛍️ Shop</a></li>
        <li><a href="cart.php" style="color: #00c8f0; text-decoration: none;">🛒 Cart</a></li>
      </ul>
    </div>
    <div style="flex: 1; min-width: 200px;">
      <h3 style="color: #fff;">Contact Us</h3>
      <p style="margin-top: 10px; font-size: 14px;">📧 support@ecommercemart.com</p>
      <p style="margin-top: 5px; font-size: 14px;">📞 +1 (800) 123-4567</p>
      <p style="margin-top: 5px; font-size: 14px;">📍 123 Shopping Blvd, Retail City</p>
    </div>
  </div>
  <div style="text-align: center; margin-top: 30px; font-size: 14px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
    &copy; <?php echo date("Y"); ?> EcommerceMart. All rights reserved.
  </div>
</footer>

</body>
</html>