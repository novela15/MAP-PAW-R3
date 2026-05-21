-- open phpMyAdmin, go to SQL tab, copy everything in this file and run it

CREATE DATABASE IF NOT EXISTS map_paw_r3;

CREATE TABLE map_paw_r3.users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) DEFAULT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    auth_method ENUM('native', 'google') NOT NULL DEFAULT 'native',
    oauth_id VARCHAR(255) DEFAULT NULL,
    reset_token VARCHAR(255) DEFAULT NULL,
    reset_token_expire_date TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE map_paw_r3.budget_category (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    CONSTRAINT fk_category_user_id FOREIGN KEY (user_id) REFERENCES map_paw_r3.users(id) ON DELETE CASCADE
);

CREATE TABLE map_paw_r3.budget_accounts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL, 
    name VARCHAR(100) NOT NULL,
    volume DECIMAL(15,2) DEFAULT 0 CHECK (volume >= 0),
    unit_price DECIMAL(15,2) DEFAULT 0 CHECK (unit_price >= 0),
    description TEXT,
    budget DECIMAL(15,2) DEFAULT 0 CHECK (budget >= 0),
    CONSTRAINT fk_account_user_id FOREIGN KEY (user_id) REFERENCES map_paw_r3.users(id) ON DELETE CASCADE,
    CONSTRAINT fk_account_category_id FOREIGN KEY (category_id) REFERENCES map_paw_r3.budget_category(id) ON DELETE CASCADE
);

CREATE TABLE map_paw_r3.budget_expenses (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    datetime DATE NOT NULL,
    budget_account_id INT UNSIGNED NOT NULL,
    volume DECIMAL(15, 2) DEFAULT 0 CHECK (volume >= 0),
    unit_price DECIMAL(15, 2) DEFAULT 0 CHECK (unit_price >= 0),
    description TEXT,
    proof VARCHAR(255),
    CONSTRAINT fk_expense_user_id FOREIGN KEY (user_id) REFERENCES map_paw_r3.users(id) ON DELETE CASCADE,
    CONSTRAINT fk_expense_budget_account_id FOREIGN KEY (budget_account_id) REFERENCES map_paw_r3.budget_accounts(id) ON DELETE CASCADE
);
