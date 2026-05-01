<nav>
  <a href="index.php">🏠 Home</a>
  <a href="products.php">🛍️ Shop</a>
  <a href="cart.php">🛒 Cart <span class="cart-badge" id="cartCount" style="display: none;">0</span></a>

  <?php if(isset($_SESSION['user'])): ?>
    <span style="margin-left: 20px; color: #00e5ff; font-weight: bold;">👤 <?php echo htmlspecialchars($_SESSION['user']); ?></span>
    <a href="logout.php" style="color: #ff4d4d;">🚪 Logout</a>
  <?php else: ?>
    <a href="login.php">🔑 Sign In</a>
  <?php endif; ?>
</nav>

<script>
// Ensure cart badge updates correctly on all pages using this navbar
document.addEventListener("DOMContentLoaded", () => {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  let count = cart.reduce((sum, item) => sum + item.qty, 0);
  let badge = document.getElementById("cartCount");
  if (badge) {
    badge.textContent = count;
    badge.style.display = count > 0 ? "inline-block" : "none";
  }
});
</script>