-- WARNING: Set up the database first!
-- Open phpMyAdmin, go to the SQL tab, copy everything in this file, and run it.

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `registration_date`) VALUES
(1, 'Test User', 'a@a.a', '$2y$10$fpl/C3jwGdiVivY1xYLns.Y0dSEBPUYfrsqTWQCPvQgyNguTuOPfu', '2026-04-01 12:01:28');

INSERT INTO `budget_category` (`id`, `user_id`, `name`, `description`) VALUES
(1, 1, 'Makanan', 'Describe me!');

INSERT INTO `budget_accounts` (`id`, `user_id`, `name`, `category_id`, `description`, `unit`) VALUES
(1, 1, 'Nasi', 1, 'Description test 1', 'kg'),
(2, 1, 'Telur', 1, 'Description test 2', 'pcs');

INSERT INTO `budget_expenses` (`id`, `user_id`, `budget_account_id`, `volume`, `amount`, `description`) VALUES
(1, 1, 1, 450, 900, 'Describe me!'),
(2, 1, 2, 1, 1000, 'Describe me!');
