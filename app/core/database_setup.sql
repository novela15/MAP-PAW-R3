-- Open phpMyAdmin, go to the SQL tab, copy everything in this file, and run it.

CREATE DATABASE IF NOT EXISTS map_paw_r3;

CREATE TABLE map_paw_r3.users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) DEFAULT NULL, -- Actually this is the password hash
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TODO: volume, unit, and amount should be joined from budget_category
CREATE TABLE map_paw_r3.budget_accounts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    category_id INT UNSIGNED NOT NULL, -- Foreign key
    description TEXT,
    volume DECIMAL(15, 2) DEFAULT 0 CHECK (volume >= 0),
    unit VARCHAR(100) NOT NULL DEFAULT 'pcs',
    amount DECIMAL(15, 2) DEFAULT 0 CHECK (amount >= 0),
    CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES map_paw_r3.users(id) ON DELETE CASCADE
);
