<?php
session_start();

// Move products array to the top so it can be used for JSON-LD Schema in the <head>
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shop Premium Footwear, Clothes & Electronics — EcommerceMart</title>
  <meta name="description" content="Shop the best footwear, clothing, accessories, and electronics at EcommerceMart. Get premium quality products with secure checkout and fast delivery.">
  <link rel="canonical" href="https://traitor-catnip-disposal.ngrok-free.dev/products.php">
  <link rel="stylesheet" href="assets/styles.css?v=3">
  
  <!-- Open Graph / Social Media Meta Tags -->
  <meta property="og:title" content="Shop Premium Footwear, Clothes & Electronics — EcommerceMart">
  <meta property="og:description" content="Shop the best footwear, clothing, accessories, and electronics at EcommerceMart. Get premium quality products with secure checkout and fast delivery.">
  <meta property="og:url" content="https://traitor-catnip-disposal.ngrok-free.dev/products.php">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://traitor-catnip-disposal.ngrok-free.dev/images/shoes.jpeg">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:image" content="https://traitor-catnip-disposal.ngrok-free.dev/images/shoes.jpeg">

  <!-- JSON-LD Product Schema Markup -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ItemList",
    "itemListElement": [
      <?php
      $schemaItems = [];
      foreach($products as $index => $p) {
          $schemaItems[] = '{
            "@type": "ListItem",
            "position": ' . ($index + 1) . ',
            "item": {
              "@type": "Product",
              "name": "' . htmlspecialchars($p['name'], ENT_QUOTES) . '",
              "image": "https://traitor-catnip-disposal.ngrok-free.dev/images/' . htmlspecialchars($p['img'], ENT_QUOTES) . '",
              "offers": {
                "@type": "Offer",
                "priceCurrency": "INR",
                "price": "' . $p['price'] . '",
                "availability": "https://schema.org/InStock"
              }
            }
          }';
      }
      echo implode(',', $schemaItems);
      ?>
    ]
  }
  </script>
</head>
<body>

<header class="nav glass">
  <div class="logo">Ecommerce<span>Mart</span></div>
  <?php include 'components/navbar.php'; ?>
</header>

<main>
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
foreach($products as $p) {
?>
<div class="product-card"
     data-category="<?php echo $p['category']; ?>"
     data-price="<?php echo $p['price']; ?>">

    <img src="images/<?php echo $p['img']; ?>" alt="<?php echo htmlspecialchars($p['name']); ?> - Shop Online" loading="lazy">
    <h3><?php echo $p['name']; ?></h3>
    <p>₹<?php echo $p['price']; ?></p>

    <button onclick="addToCart('<?php echo $p['name']; ?>', <?php echo $p['price']; ?>, 'images/<?php echo $p['img']; ?>')">
      Add to Cart
    </button>
</div>
<?php } ?>
  </div>
</div>

<!-- 📧 Mailchimp Signup Form -->
<div class="newsletter-section" style="text-align: center; margin: 40px auto; padding: 40px 20px; max-width: 600px; background: rgba(255,255,255,0.05); border-radius: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(0,200,240,0.2);">
  <h2>🎉 Get 10% Off Your First Order</h2>
  <p style="color: #aaa; margin-top: 10px; margin-bottom: 20px;">Subscribe to our newsletter for exclusive deals and updates.</p>
  <form action="http://eepurl.com/dqNn2NZ1OA" method="post" target="_blank" style="display: flex; justify-content: center; gap: 10px;">
    <input type="email" name="EMAIL" placeholder="Enter your email address" required style="padding: 12px; width: 60%; border-radius: 8px; border: none; background: rgba(255,255,255,0.08); color: #fff;">
    <button type="submit" class="btn-main" style="border-radius: 8px;">Subscribe</button>
  </form>
</div>
</main>

<!-- 🔥 JS -->
<script>
// 🔍 FILTER FUNCTION 
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