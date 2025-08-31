CREATE DATABASE borauto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE borauto;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE,
  email VARCHAR(255) UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','user') NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- OPTIONAL: create an admin user (replace email/username; password hash generated below)
-- INSERT INTO users (username, email, password_hash, role)
-- VALUES ('admin', 'admin@borauto.com', '$2y$10$XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', 'admin');
