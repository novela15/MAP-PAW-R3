-- =========================================
-- USERS
-- =========================================
INSERT INTO `users`
(`id`, `username`, `email`, `password_hash`, `registration_date`, `auth_method`)
VALUES
(1, 'Test User', 'a@a.a',
'$2y$10$fpl/C3jwGdiVivY1xYLns.Y0dSEBPUYfrsqTWQCPvQgyNguTuOPfu',
'2026-04-01 12:01:28',
'native');

-- =========================================
-- CATEGORY
-- =========================================
INSERT INTO `budget_category`
(`id`, `user_id`, `name`, `description`)
VALUES
(1, 1, 'Akademik', 'Kebutuhan akademik'),
(2, 1, 'Transportasi', 'Biaya transportasi'),
(3, 1, 'Konsumsi', 'Kebutuhan makan');

-- =========================================
-- BUDGET ACCOUNTS (PERENCANAAN)
-- =========================================
INSERT INTO `budget_accounts`
(`id`, `user_id`, `category_id`, `name`, `volume`, `unit_price`, `description`, `budget`)
VALUES
(1, 1, 1, 'Fotokopi', 100, 100, 'Kebutuhan tugas', 10000),

(2, 1, 2, 'Bensin', 5, 10000, 'Transport harian', 50000),

(3, 1, 3, 'Sarapan', 10, 8000, 'Makan pagi', 80000),

(4, 1, 3, 'Makan Siang', 10, 15000, 'Makan siang', 150000),

(5, 1, 3, 'Makan Malam', 10, 12000, 'Makan malam', 120000);

-- =========================================
-- BUDGET EXPENSES (REALISASI)
-- =========================================
INSERT INTO `budget_expenses`
(`id`, `user_id`, `budget_account_id`, `datetime`,
`volume`, `unit_price`, `description`, `proof`)
VALUES

-- AKADEMIK
(1, 1, 1, NOW(), 50, 100, 'Fotokopi tugas', NULL),
(2, 1, 1, NOW(), 2, 100, 'Kartu ujian', NULL),

-- TRANSPORTASI
(3, 1, 2, NOW(), 2, 10000, 'Isi bensin', NULL),
(4, 1, 2, NOW(), 2, 10000, 'Isi bensin', NULL),

-- SARAPAN
(5, 1, 3, NOW(), 2, 8000, 'Sarapan', NULL),
(6, 1, 3, NOW(), 2, 8000, 'Sarapan', NULL),
(7, 1, 3, NOW(), 2, 8000, 'Sarapan', NULL),

-- MAKAN SIANG
(8, 1, 4, NOW(), 2, 15000, 'Makan siang', NULL),
(9, 1, 4, NOW(), 2, 15000, 'Makan siang', NULL),
(10, 1, 4, NOW(), 2, 15000, 'Makan siang', NULL),

-- MAKAN MALAM
(11, 1, 5, NOW(), 2, 12000, 'Makan malam', NULL),
(12, 1, 5, NOW(), 2, 12000, 'Makan malam', NULL),
(13, 1, 5, NOW(), 2, 12000, 'Makan malam', NULL),
(14, 1, 5, NOW(), 2, 12000, 'Makan malam', NULL);
