<?php
// login.php
require __DIR__ . '/db.php';
require __DIR__ . '/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Method Not Allowed');
}

$identifier = trim($_POST['identifier'] ?? '');
$password   = $_POST['password'] ?? '';

if ($identifier === '' || $password === '') {
  header('Location: signin.html?error=empty');
  exit;
}

$sql = "SELECT id, username, email, password_hash, role
        FROM users
        WHERE username = :id OR email = :id
        LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $identifier]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password_hash'])) {
  header('Location: signin.html?error=invalid');
  exit;
}

// Good login: rotate session ID, store minimal user info
session_regenerate_id(true);
$_SESSION['user'] = [
  'id'       => $user['id'],
  'username' => $user['username'],
  'email'    => $user['email'],
  'role'     => $user['role'],
];

// Redirect based on role (and you can also send to a common "home.php")
if ($user['role'] === 'admin') {
  header('Location: admin-dashboard.php');
} else {
  header('Location: user-dashboard.php');
}
exit;
