SET foreign_key_checks = 0;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  encrypted_password VARCHAR(255),
  responsibility VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS client_tables;

CREATE TABLE client_tables (
  id INT AUTO_INCREMENT PRIMARY KEY,
  table_number INT,
  link_token VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS orders;

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  client_table_id INT NOT NULL,
  user_id INT,
  status VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (client_table_id) REFERENCES client_tables(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

SET foreign_key_checks = 1;