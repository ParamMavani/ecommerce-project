<nav>
  <a href="index.php">Home</a>
  <a href="products.php">Shop</a>
  <a href="cart.php">Cart</a>

  <?php if(isset($_SESSION['user'])): ?>
    <span>👤 <?php echo $_SESSION['user']; ?></span>
    <a href="logout.php">Logout</a>
  <?php else: ?>
    <a href="login.php">Sign In</a>
  <?php endif; ?>
</nav>