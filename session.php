<?php
// session.php
session_set_cookie_params([
  'lifetime' => 0,
  'path' => '/',
  'domain' => '',
  'secure' => isset($_SERVER['HTTPS']),
  'httponly' => true,
  'samesite' => 'Lax',
]);
session_start();

function require_login() {
  if (empty($_SESSION['user'])) {
    header('Location: signin.html');
    exit;
  }
}

function require_role($role) {
  require_login();
  if (($_SESSION['user']['role'] ?? '') !== $role) {
    http_response_code(403);
    exit('Forbidden');
  }
}
