<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user['name'];
      header("Location: index.php");
      exit();
    } else {
      $error = "Invalid password.";
    }
  } else {
    $error = "No user found with that email.";
  }
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
  <h2>Login</h2>

  <?php if($error): ?>
    <p style="color: #ff4d4d; text-align: center; margin-bottom: 10px;"><?php echo $error; ?></p>
  <?php endif; ?>

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