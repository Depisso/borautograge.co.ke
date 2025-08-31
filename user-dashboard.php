<?php
require __DIR__ . '/session.php';
require_login();
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"><title>User Dashboard</title></head>
<body style="background:#111;color:#fff;">
  <h1 style="color:#ffa500;">User Dashboard</h1>
  <p>Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>.</p>
  <p><a href="home.php" style="color:#ffa500;">Back to Home</a> | <a href="logout.php" style="color:#ffa500;">Logout</a></p>
</body>
</html>
