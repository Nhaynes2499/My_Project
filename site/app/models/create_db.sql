-- Creating database
CREATE DATABASE user_management_system;
USE user_management_system;

-- Creating roles table
CREATE TABLE roles (
  id INT NOT NULL AUTO_INCREMENT,
  role ENUM('Research Group Manager', 'Research Study Manager', 'Researcher'),

  PRIMARY KEY (id)
);

-- Creating users table
CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(100),
  password VARCHAR(255),
  email VARCHAR(255),
  role INT NOT NULL,

  PRIMARY KEY (id),
  UNIQUE (email),
  FOREIGN KEY (role) REFERENCES roles(id)
);

-- Creating user_access_levels table
CREATE TABLE user_access_levels (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(255),
  accessLevel ENUM('Research Group Manager', 'Research Study Manager', 'Researcher'),

  PRIMARY KEY (id),
  FOREIGN KEY (email) references users(email)
);

-- Creating manager user for initial access (password Qwertyuiop123456)
INSERT INTO roles (role)
  VALUES ('Research Group Manager'), ('Research Study Manager'), ('Researcher');
INSERT INTO users(username, password, email, role)
  VALUES ('rgm', '$2y$10$EtOFA5x4mXUQaKqXJYEHrOdJOTyM5.P68oCfGnsjXkZzqyq1Gi49G', 'rgm@rms.edu', 1);
INSERT INTO user_access_levels(email, accessLevel)
  VALUES ('rgm@rms.edu', 'Research Group Manager');