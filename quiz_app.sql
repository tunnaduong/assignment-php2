-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 09, 2025 at 06:21 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int NOT NULL,
  `question_id` int NOT NULL,
  `answer_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`) VALUES
(1, 1, 'Berlin', 0),
(2, 1, 'Madrid', 0),
(3, 1, 'Paris', 1),
(4, 1, 'Rome', 0),
(5, 2, 'Venus', 0),
(6, 2, 'Mars', 1),
(7, 2, 'Jupiter', 0),
(8, 2, 'Saturn', 0),
(9, 3, 'H2O', 1),
(10, 3, 'CO2', 0),
(11, 3, 'O2', 0),
(12, 3, 'N2', 0),
(13, 4, 'Isaac Newton', 0),
(14, 4, 'Albert Einstein', 1),
(15, 4, 'Galileo Galilei', 0),
(16, 4, 'Nikola Tesla', 0),
(17, 5, 'Abraham Lincoln', 0),
(18, 5, 'George Washington', 1),
(19, 5, 'Thomas Jefferson', 0),
(20, 5, 'John Adams', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `question_text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`) VALUES
(1, 1, 'What is the capital of France?'),
(2, 1, 'Which planet is known as the Red Planet?'),
(3, 2, 'What is the chemical symbol for water?'),
(4, 2, 'Who developed the theory of relativity?'),
(5, 3, 'Who was the first President of the United States?');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `description`, `created_at`) VALUES
(1, 'General Knowledge Quiz', 'Test your general knowledge skills!', '2025-02-08 04:00:37'),
(2, 'Science Quiz', 'Challenge yourself with science questions!', '2025-02-08 04:00:37'),
(3, 'History Quiz', 'How well do you know history?', '2025-02-08 04:00:37'),
(10, 'Đố vui', 'Một quiz game nho nhỏ để test trình độ của bạn về một vài chủ đề', '2025-02-08 09:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `reset_token`, `reset_token_expiry`, `created_at`) VALUES
(1, 'Dương Tùng Anh', 'tunnaduong@gmail.com', 'tunganh2003', 'admin', NULL, NULL, '2025-02-08 03:01:24'),
(2, 'John Doe', 'johndoe@gmail.com', '123', 'user', NULL, NULL, '2025-02-08 03:59:42'),
(6, 'Jane', 'jane@gmail.com', '123', 'admin', NULL, NULL, '2025-02-08 09:24:29'),
(8, 'Nguyễn Việt Thắng', 'thangnv@gmail.com', '1', 'user', NULL, NULL, '2025-02-08 09:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_attempts`
--

CREATE TABLE `user_attempts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `score` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_attempts`
--

INSERT INTO `user_attempts` (`id`, `user_id`, `quiz_id`, `score`, `created_at`) VALUES
(5, 2, 2, 50, '2025-02-08 05:54:16'),
(6, 2, 1, 100, '2025-02-08 05:55:14'),
(7, 2, 3, 100, '2025-02-08 05:58:25'),
(8, 2, 1, 100, '2025-02-08 06:07:20'),
(9, 2, 1, 100, '2025-02-08 06:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_responses`
--

CREATE TABLE `user_responses` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `question_id` int NOT NULL,
  `selected_answer_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_attempts`
--
ALTER TABLE `user_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `user_responses`
--
ALTER TABLE `user_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_question_id` (`question_id`),
  ADD KEY `fk_quiz_id` (`quiz_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_answer_id` (`selected_answer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_attempts`
--
ALTER TABLE `user_attempts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_responses`
--
ALTER TABLE `user_responses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_attempts`
--
ALTER TABLE `user_attempts`
  ADD CONSTRAINT `user_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_attempts_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_responses`
--
ALTER TABLE `user_responses`
  ADD CONSTRAINT `fk_answer_id` FOREIGN KEY (`selected_answer_id`) REFERENCES `answers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_quiz_id` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
