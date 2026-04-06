<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shop — EcommerceMart</title>
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<header class="nav glass">
  <div class="logo">Ecommerce<span>Mart</span></div>
  <nav>
    <a href="index.php">Home</a>
    <a href="products.php">Shop</a>
    <a href="cart.php">
      Cart <span class="cart-badge" id="cartCount">0</span>
    </a>

    <?php if(isset($_SESSION['user'])): ?>
      <span>👤 <?php echo $_SESSION['user']; ?></span>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="login.php">Sign In</a>
    <?php endif; ?>
  </nav>
</header>

<h1 style="text-align:center;margin-top:30px;">🛍 Shop Products</h1>

<div class="products-wrapper">
  <div class="products-container">

    <?php
    $products = [
      ["name"=>"Shoes","price"=>1999,"img"=>"shoes.jpeg"],
      ["name"=>"Sneakers","price"=>2499,"img"=>"sneakers.jpeg"],
      ["name"=>"Boots","price"=>2999,"img"=>"boots.jpeg"],
      ["name"=>"Slippers","price"=>999,"img"=>"slippers.jpeg"],
      ["name"=>"Sandals","price"=>1299,"img"=>"sandals.jpeg"],
      ["name"=>"T-Shirt","price"=>799,"img"=>"tshirt.jpeg"],
      ["name"=>"Shirt","price"=>1499,"img"=>"shirt.jpeg"],
      ["name"=>"Hoodie","price"=>1999,"img"=>"hoodie.jpeg"],
      ["name"=>"Jacket","price"=>2999,"img"=>"jacket.jpeg"],
      ["name"=>"Jeans","price"=>1899,"img"=>"jeans.jpeg"],
      ["name"=>"Watch","price"=>3499,"img"=>"watch.jpeg"],
      ["name"=>"Headphones","price"=>1999,"img"=>"headphones.jpeg"],
      ["name"=>"Tablet","price"=>15999,"img"=>"tablet.jpeg"],
      ["name"=>"Laptop","price"=>59999,"img"=>"laptop.jpeg"],
      ["name"=>"iPhone","price"=>79999,"img"=>"iphone.jpeg"],
    ];

    foreach($products as $p) {
    ?>
    <div class="product-card">
        <img src="images/<?php echo $p['img']; ?>">
        <h3><?php echo $p['name']; ?></h3>
        <p>₹<?php echo $p['price']; ?></p>

        <button onclick="addToCart('<?php echo $p['name']; ?>', <?php echo $p['price']; ?>, 'images/<?php echo $p['img']; ?>')">
          Add to Cart
        </button>
    </div>
    <?php } ?>

  </div>
</div>

<!-- 🔥 JS -->
<script>
function addToCart(name, price, img) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  // ✅ Check if product already exists
  let existing = cart.find(item => item.name === name);

  if (existing) {
    existing.qty += 1;
  } else {
    cart.push({
      name: name,
      price: price,
      img: img,
      qty: 1
    });
  }

  localStorage.setItem("cart", JSON.stringify(cart));

  updateCartBadge();
  showToast(name + " added to cart 🛒");
}

/* 🔢 UPDATE BADGE */
function updateCartBadge() {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  let count = cart.reduce((sum, item) => sum + item.qty, 0);

  let badge = document.getElementById("cartCount");
  badge.textContent = count;
  badge.style.display = count > 0 ? "inline-block" : "none";
}

/* 🔥 TOAST NOTIFICATION */
function showToast(msg) {
  let toast = document.createElement("div");
  toast.className = "toast";
  toast.innerText = msg;

  document.body.appendChild(toast);

  setTimeout(() => {
    toast.classList.add("show");
  }, 100);

  setTimeout(() => {
    toast.remove();
  }, 2500);
}

// Load badge on page load
updateCartBadge();
</script>

</body>
</html>