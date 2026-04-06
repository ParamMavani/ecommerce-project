let cart = JSON.parse(localStorage.getItem("cart")) || [];

function addToCart(name, price) {
  cart.push({name, price});
  localStorage.setItem("cart", JSON.stringify(cart));
  alert("Added to cart");
}

function loadCart() {
  let container = document.getElementById("cartItems");
  container.innerHTML = "";

  cart.forEach(item => {
    container.innerHTML += `<p>${item.name} - ₹${item.price}</p>`;
  });
}