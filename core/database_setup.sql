-- Open phpMyAdmin, go to the SQL tab, copy everything in this file, and run it.

CREATE DATABASE IF NOT EXISTS map;

CREATE TABLE map.users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) DEFAULT NULL,
    registration_date DATE DEFAULT CURRENT_TIMESTAMP
);
