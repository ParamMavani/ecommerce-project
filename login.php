<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<header class="nav">
  <h2>EcommerceMart</h2>
  <?php include 'components/navbar.php'; ?>
</header>

<div class="auth-box">
  <h2>Login</h2>

  <form method="POST" action="login.php">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button class="btn-main">Login</button>
  </form>

  <button class="btn-main" style="margin-top:10px;"
          onclick="window.location.href='signup.php'">
    Create New Account
  </button>
</div>

</body>
</html>