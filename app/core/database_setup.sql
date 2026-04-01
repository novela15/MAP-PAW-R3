-- Open phpMyAdmin, go to the SQL tab, copy everything in this file, and run it.

CREATE DATABASE IF NOT EXISTS map_paw_r3;

CREATE TABLE map_paw_r3.users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) DEFAULT NULL, -- Actually this is the password hash
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
