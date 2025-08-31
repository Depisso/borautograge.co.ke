<?php
require __DIR__ . '/session.php';
require_login();
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"><title>Home - Borauto</title></head>
<body style="background:#111;color:#fff;">
  <nav>
    <!-- your nav without Sign In/Up -->
    <a href="aboutus.html">About Us</a>
    <a href="services.html">Services</a>
    <a href="contact.html">Contact</a>
    <a href="knowledge.html">Knowledge</a>
    <a href="<?= $_SESSION['user']['role']==='admin' ? 'admin-dashboard.php' : 'user-dashboard.php' ?>">Dashboard</a>
    <a href="logout.php">Logout</a>
  </nav>

  <h1 style="color:#ffa500;">Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</h1>
  <p>You’re logged in as <strong><?= htmlspecialchars($_SESSION['user']['role']) ?></strong>.</p>
</body>
</html>
