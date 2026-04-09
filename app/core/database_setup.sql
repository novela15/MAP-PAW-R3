-- Open phpMyAdmin, go to the SQL tab, copy everything in this file, and run it.

CREATE DATABASE IF NOT EXISTS map_paw_r3;

CREATE TABLE map_paw_r3.users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) DEFAULT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE map_paw_r3.budget_category (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    CONSTRAINT fk_category_user_id FOREIGN KEY (user_id) REFERENCES map_paw_r3.users(id) ON DELETE CASCADE
);

-- There are volume and amount columns in the frontend,
-- they're aggregated from volume and amount columns in budget_expenses table.
CREATE TABLE map_paw_r3.budget_accounts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    description TEXT,
    volume DECIMAL(15,2) DEFAULT 0 CHECK (volume >=0),
    unit_price DECIMAL(15,2) DEFAULT 0 CHECK (unit_price >=0)
    amount DECIMAL(15,2) GENERATED ALWAYS AS (volume * unit_price) STORED,
    CONSTRAINT fk_account_user_id FOREIGN KEY (user_id) REFERENCES map_paw_r3.users(id) ON DELETE CASCADE,
    CONSTRAINT fk_account_category_id FOREIGN KEY (category_id) REFERENCES map_paw_r3.budget_category(id) ON DELETE CASCADE
);

CREATE TABLE map_paw_r3.budget_expenses (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    budget_account_id INT UNSIGNED NOT NULL,
    volume DECIMAL(15, 2) DEFAULT 0 CHECK (volume >= 0),
    unit_price DECIMAL(15,2) DEFAULT 0 CHECK (unit_price >=0)
    amount DECIMAL(15, 2) DEFAULT 0 CHECK (amount >= 0),
    description TEXT,
    proof VARCHAR(255)
    CONSTRAINT fk_expense_user_id FOREIGN KEY (user_id) REFERENCES map_paw_r3.users(id) ON DELETE CASCADE,
    CONSTRAINT fk_expense_budget_account_id FOREIGN KEY (budget_account_id) REFERENCES map_paw_r3.budget_accounts(id) ON DELETE CASCADE
);
