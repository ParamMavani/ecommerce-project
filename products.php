<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shop — EcommerceMart</title>
  <link rel="stylesheet" href="assets/styles.css?v=3">
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

<!-- 🔥 CENTERED FILTER BAR -->
<div class="filter-bar">
  <input type="text" id="searchInput" placeholder="🔍 Search products..." onkeyup="filterProducts()">

  <select id="categoryFilter" onchange="filterProducts()">
    <option value="all">All Categories</option>
    <option value="clothes">Clothes</option>
    <option value="electronics">Electronics</option>
    <option value="footwear">Footwear</option>
    <option value="accessories">Accessories</option>
  </select>

  <select id="priceFilter" onchange="filterProducts()">
    <option value="all">All Prices</option>
    <option value="low">Below ₹500</option>
    <option value="mid">₹500 - ₹1000</option>
    <option value="high">Above ₹1000</option>
  </select>
</div>

<div class="products-wrapper">
  <div class="products-container">

<?php
$products = [
  ["name"=>"Sports Shoes","price"=>1999,"img"=>"shoes.jpeg","category"=>"footwear"],
  ["name"=>"Sneakers","price"=>2499,"img"=>"sneakers.jpeg","category"=>"footwear"],
  ["name"=>"Boots","price"=>2999,"img"=>"boots.jpeg","category"=>"footwear"],
  ["name"=>"Slippers","price"=>999,"img"=>"slippers.jpeg","category"=>"footwear"],
  ["name"=>"Sandals","price"=>1299,"img"=>"sandals.jpeg","category"=>"footwear"],

  ["name"=>"T-Shirt","price"=>799,"img"=>"tshirt.jpeg","category"=>"clothes"],
  ["name"=>"Shirt","price"=>1499,"img"=>"shirt.jpeg","category"=>"clothes"],
  ["name"=>"Hoodie","price"=>1999,"img"=>"hoodie.jpeg","category"=>"clothes"],
  ["name"=>"Jacket","price"=>2999,"img"=>"jacket.jpeg","category"=>"clothes"],
  ["name"=>"Jeans","price"=>1899,"img"=>"jeans.jpeg","category"=>"clothes"],

  ["name"=>"Watch","price"=>3499,"img"=>"watch.jpeg","category"=>"accessories"],

  ["name"=>"Headphones","price"=>1999,"img"=>"headphones.jpeg","category"=>"electronics"],
  ["name"=>"Tablet","price"=>15999,"img"=>"tablet.jpeg","category"=>"electronics"],
  ["name"=>"Laptop","price"=>59999,"img"=>"laptop.jpeg","category"=>"electronics"],
  ["name"=>"iPhone","price"=>79999,"img"=>"iphone.jpeg","category"=>"electronics"],
];

foreach($products as $p) {
?>
<div class="product-card"
     data-category="<?php echo $p['category']; ?>"
     data-price="<?php echo $p['price']; ?>">

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
// 🔍 FILTER FUNCTION (FIXED)
function filterProducts() {
  let search = document.getElementById("searchInput").value.toLowerCase();
  let category = document.getElementById("categoryFilter").value;
  let priceFilter = document.getElementById("priceFilter").value;

  let products = document.querySelectorAll(".product-card");

  products.forEach(product => {

    let name = product.querySelector("h3").innerText.toLowerCase();
    let productCategory = product.getAttribute("data-category");
    let price = parseInt(product.getAttribute("data-price"));

    let matchSearch = name.includes(search);
    let matchCategory = (category === "all" || productCategory === category);

    let matchPrice = true;
    if (priceFilter === "low") matchPrice = price < 500;
    else if (priceFilter === "mid") matchPrice = price >= 500 && price <= 1000;
    else if (priceFilter === "high") matchPrice = price > 1000;

    if (matchSearch && matchCategory && matchPrice) {
      product.style.display = "block";
    } else {
      product.style.display = "none";
    }

  });
}

// 🛒 ADD TO CART
function addToCart(name, price, img) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  let existing = cart.find(item => item.name === name);

  if (existing) {
    existing.qty += 1;
  } else {
    cart.push({ name, price, img, qty: 1 });
  }

  localStorage.setItem("cart", JSON.stringify(cart));

  updateCartBadge();
  showToast(name + " added to cart 🛒");
}

// 🔢 BADGE
function updateCartBadge() {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  let count = cart.reduce((sum, item) => sum + item.qty, 0);

  let badge = document.getElementById("cartCount");
  badge.textContent = count;
  badge.style.display = count > 0 ? "inline-block" : "none";
}

// 🔥 TOAST
function showToast(msg) {
  let toast = document.createElement("div");
  toast.className = "toast";
  toast.innerText = msg;

  document.body.appendChild(toast);

  setTimeout(() => toast.classList.add("show"), 100);
  setTimeout(() => toast.remove(), 2500);
}

// INIT
updateCartBadge();
</script>

</body>
</html>