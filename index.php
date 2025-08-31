<?php
// db.php
$DB_HOST = 'localhost';
$DB_NAME = 'borauto';
$DB_USER = 'root';      // change if needed
$DB_PASS = '';          // change if needed

try {
  $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  exit('Database connection failed.');
}
