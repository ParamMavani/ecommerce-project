<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $conn->query("INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')");
  header("Location: login.php");
}
?>

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
  <h2>Create New Account</h2>

  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <button class="btn-main">Create Account</button>
  </form>
</div>

</body>
</html>