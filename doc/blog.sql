-- Set SQL mode, transaction, and time zone
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create the articles table
CREATE TABLE `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `des` varchar(40) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL, -- Add soft delete column
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data into articles table
INSERT INTO `articles` (`id`, `title`, `des`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sports', 'des - 1', '1', '2024-05-15 23:18:27', '2024-05-16 23:18:27'),
(2, 'Politics', 'des - 2', '1', '2024-05-15 23:18:27', '2024-05-16 23:18:27'),
(3, 'Fashion', 'des - 3', '1', '2024-05-15 23:18:27', '2024-05-16 23:18:27'),
(4, 'Fashion', 'des - 3', '1', '2024-05-15 23:18:27', '2024-05-16 23:18:27');

-- Create the users table
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(96) NOT NULL,
  `password` varchar(128) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `birthday` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `code` varchar(40) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL, -- Add soft delete column
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data into users table
INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `gender`, `birthday`, `status`, `ip`, `code`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@gmail.com', '$2y$10$JnSQbKd.JyrMSNYZHWkqDOhcd3VTjuELk52IF/t2CONLSoJtjpAi.', 'c4bd7a6e842483b277a22f7175c8b69490876ce5_e8ee24a5858796f7ca979c72267b0658c2bb8be1.jpg', 'male', '1990-01-01 00:00:00', 'enabled', '', '80a315d99d01b28e68e58c0c899bc4ce2197c524', '2024-05-15 23:18:27', '2024-05-16 23:18:27');

-- Set primary keys and auto-increment
ALTER TABLE `articles` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `users` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- Commit transaction
COMMIT;
