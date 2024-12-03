DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  encrypted_password VARCHAR(255),
  role ENUM('Administrador', 'Mesa') NOT NULL,
  table_number INT,
  link_token VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);