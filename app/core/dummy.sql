-- WARNING: Set up the database first!
-- Open phpMyAdmin, go to the SQL tab, copy everything in this file, and run it.

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `registration_date`) VALUES
(1, 'Test User', 'a@a.a', '$2y$10$fpl/C3jwGdiVivY1xYLns.Y0dSEBPUYfrsqTWQCPvQgyNguTuOPfu', '2026-04-01 12:01:28');

INSERT INTO `budget_category` (`id`, `user_id`, `name`, `description`) VALUES
(1, 1, 'Akademik', 'Description test 1'),
(2, 1, 'Transportasi', 'Description test 2'),
(3, 1, 'Konsumsi', 'Description test 3');

INSERT INTO `budget_accounts` (`id`, `user_id`, `name`, `category_id`, `description`, `unit`) VALUES
(1, 1, 'Fotokopi', 1, 'Description test 1', 'lembar'),
(2, 1, 'Bensin', 2, 'Description test 2', 'liter'),
(3, 1, 'Sarapan', 3, 'Description test 3', 'porsi'),
(4, 1, 'Makan Siang', 3, 'Description test 3', 'porsi'),
(5, 1, 'Makan Malam', 3, 'Description test 3', 'porsi');

INSERT INTO `budget_expenses` (`id`, `user_id`, `budget_account_id`, `volume`, `amount`, `description`) VALUES
(1, 1, 1, 50, 5000, 'Tugas 50 lembar'),
(2, 1, 1, 2, 1000, 'Kartu ujian'),
(3, 1, 2, 2, 10000, ''),
(4, 1, 2, 2, 10000, ''),
(5, 1, 3, 2, 10000, ''),
(6, 1, 3, 2, 10000, ''),
(7, 1, 3, 2, 10000, ''),
(8, 1, 4, 2, 10000, ''),
(9, 1, 4, 2, 10000, ''),
(10, 1, 4, 2, 10000, ''),
(11, 1, 5, 2, 10000, ''),
(12, 1, 5, 2, 10000, ''),
(13, 1, 5, 2, 10000, ''),
(14, 1, 5, 2, 10000, '');
