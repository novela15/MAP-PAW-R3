-- WARNING: Set up the database first!
-- Open phpMyAdmin, go to the SQL tab, copy everything in this file, and run it.

-- USERS
INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `registration_date`) VALUES
(1, 'Test User', 'a@a.a', '$2y$10$fpl/C3jwGdiVivY1xYLns.Y0dSEBPUYfrsqTWQCPvQgyNguTuOPfu', '2026-04-01 12:01:28');

-- CATEGORY
INSERT INTO `budget_category` (`id`, `user_id`, `name`, `description`) VALUES
(1, 1, 'Akademik', 'Kebutuhan akademik'),
(2, 1, 'Transportasi', 'Biaya transportasi'),
(3, 1, 'Konsumsi', 'Kebutuhan makan');

-- BUDGET ACCOUNTS (PLANNING)
INSERT INTO `budget_accounts`
(`id`, `user_id`, `name`, `category_id`, `description`, `unit_price`)
VALUES
(1, 1, 'Fotokopi', 1, 'Kebutuhan tugas', 100),
(2, 1, 'Bensin', 2, 'Transport harian', 10000),
(3, 1, 'Sarapan', 3, 'Makan pagi', 8000),
(4, 1, 'Makan Siang', 3, 'Makan siang', 15000),
(5, 1, 'Makan Malam', 3, 'Makan malam', 12000);

-- BUDGET EXPENSES (REALISASI)
INSERT INTO `budget_expenses`
(`id`, `user_id`, `budget_account_id`, `datetime`, `volume`, `description`, `proof`)
VALUES
(1, 1, 1, NOW(), 50, 'Fotokopi tugas', NULL),
(2, 1, 1, NOW(), 2, 'Kartu ujian', NULL),

(3, 1, 2, NOW(), 2, 'Isi bensin', NULL),
(4, 1, 2, NOW(), 2, 'Isi bensin', NULL),

(5, 1, 3, NOW(), 2, 'Sarapan', NULL),
(6, 1, 3, NOW(), 2, 'Sarapan', NULL),
(7, 1, 3, NOW(), 2, 'Sarapan', NULL),

(8, 1, 4, NOW(), 2, 'Makan siang', NULL),
(9, 1, 4, NOW(), 2, 'Makan siang', NULL),
(10, 1, 4, NOW(), 2, 'Makan siang', NULL),

(11, 1, 5, NOW(), 2, 'Makan malam', NULL),
(12, 1, 5, NOW(), 2, 'Makan malam', NULL),
(13, 1, 5, NOW(), 2, 'Makan malam', NULL),
(14, 1, 5, NOW(), 2, 'Makan malam', NULL);
