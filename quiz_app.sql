-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 09, 2025 at 08:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `answer_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`) VALUES
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
(20, 5, 'John Adams', 0),
(450, 132, 'Berlin', 0),
(451, 132, 'Madrid', 0),
(452, 132, 'Paris', 1),
(453, 132, 'Rome', 0),
(454, 133, 'Venus', 0),
(455, 133, 'Mars', 1),
(456, 133, 'Jupiter', 0),
(457, 133, 'Saturn', 0),
(458, 134, 'Tùng Anh', 1),
(459, 134, 'Thắng', 0),
(460, 134, 'Kiệt', 0),
(461, 134, 'Lộc', 0),
(462, 134, 'Dương', 0),
(648, 182, ' 7 người', 0),
(649, 182, ' 14 người', 1),
(650, 182, ' 9 người', 0),
(651, 182, ' 20 người', 0),
(652, 183, 'Hổ', 0),
(653, 183, 'Voi', 0),
(654, 183, 'Sư tử', 1),
(655, 183, 'Khỉ đột', 0),
(656, 184, 'Au', 1),
(657, 184, 'Ag', 0),
(658, 184, 'Fe', 0),
(659, 184, 'Pb', 0),
(660, 185, 'Đức', 0),
(661, 185, 'Pháp', 1),
(662, 185, 'Ý', 0),
(663, 185, 'Tây Ban Nha', 0),
(664, 186, '100°C', 1),
(665, 186, '90°C', 0),
(666, 186, '110°C', 0),
(667, 186, '120°C', 0),
(668, 187, 'Yuri Gagarin', 0),
(669, 187, 'Neil Armstrong', 1),
(670, 187, 'Buzz Aldrin', 0),
(671, 187, 'Michael Collins', 0),
(672, 188, 'Frozen', 0),
(673, 188, 'Moana', 0),
(674, 188, 'The Little Mermaid', 1),
(675, 188, 'Tangled', 0),
(676, 189, 'Cây quyền trượng có rắn quấn', 1),
(677, 189, 'Chữ thập đỏ', 0),
(678, 189, 'Cây đuốc', 0),
(679, 189, 'Cái cân', 0),
(680, 190, 'Trung Quốc', 0),
(681, 190, 'Nhật Bản', 1),
(682, 190, 'Việt Nam', 0),
(683, 190, 'Hàn Quốc', 0),
(684, 191, 'J.K. Rowling', 0),
(685, 191, 'Paulo Coelho', 1),
(686, 191, 'George Orwell', 0),
(687, 191, 'Victor Hugo', 0),
(780, 215, 'Cá mập trắng', 0),
(781, 215, 'Cá voi xanh', 1),
(782, 215, 'Cá heo', 0),
(783, 215, 'Cá ngừ', 0),
(784, 216, 'Đại bàng', 0),
(785, 216, 'Cú mèo', 0),
(786, 216, 'Vẹt xám châu Phi', 1),
(787, 216, 'Chim công', 0),
(788, 217, 'Rùa Galápagos', 0),
(789, 217, 'Cá mập Greenland', 1),
(790, 217, 'Voi châu Phi', 0),
(791, 217, 'Cá voi xanh', 0),
(792, 218, 'Kiến', 0),
(793, 218, 'Bọ hung tê giác', 1),
(794, 218, 'Châu chấu', 0),
(795, 218, 'Bọ cánh cứng', 0),
(796, 219, 'Tắc kè hoa', 1),
(797, 219, 'Rắn hổ mang', 0),
(798, 219, 'Cua dừa', 0),
(799, 219, 'Cá heo', 0),
(800, 220, 'Cá mập voi', 0),
(801, 220, 'Cá voi xanh', 1),
(802, 220, 'Voi châu Phi', 0),
(803, 220, 'Gấu Bắc Cực', 0),
(804, 221, 'Rắn hổ mang chúa', 0),
(805, 221, 'Bạch tuộc đốm xanh', 1),
(806, 221, 'Nhện góa phụ đen', 0),
(807, 221, 'Ếch phi tiêu độc', 0),
(808, 222, 'Cá voi sát thủ', 1),
(809, 222, 'Cá mập hổ', 0),
(810, 222, 'Cá sấu nước mặn', 0),
(811, 222, 'Cá mập trắng lớn', 0),
(812, 223, 'Ngựa vằn', 0),
(813, 223, 'Báo gêpa', 1),
(814, 223, 'Linh dương Gazelle', 0),
(815, 223, 'Chó sói xám', 0),
(816, 224, 'Chim đại bàng', 0),
(817, 224, 'Chim hải âu lang thang', 1),
(818, 224, 'Cò trắng', 0),
(819, 224, 'Chim cánh cụt hoàng đế', 0),
(820, 225, 'Sao Hỏa', 0),
(821, 225, 'Sao Kim', 0),
(822, 225, 'Sao Mộc', 1),
(823, 225, 'Sao Thổ', 0),
(824, 226, 'Sao lùn trắng', 0),
(825, 226, 'Sao khổng lồ đỏ', 0),
(826, 226, 'Sao neutron', 0),
(827, 226, 'Sao lùn vàng', 1),
(828, 227, 'Neil Armstrong', 0),
(829, 227, 'Buzz Aldrin', 0),
(830, 227, 'Yuri Gagarin', 1),
(831, 227, 'Michael Collins', 0),
(832, 228, 'Sao Hỏa', 1),
(833, 228, 'Sao Thủy', 0),
(834, 228, 'Sao Thiên Vương', 0),
(835, 228, 'Sao Hải Vương', 0),
(836, 229, 'Ánh sáng', 1),
(837, 229, 'Nước', 0),
(838, 229, 'Không khí', 0),
(839, 229, 'Thiên thạch', 0),
(840, 230, 'Andromeda', 0),
(841, 230, 'Ngân Hà', 1),
(842, 230, 'Tiên Nữ', 0),
(843, 230, 'Sombrero', 0),
(844, 231, '24 giờ', 0),
(845, 231, '90 phút', 1),
(846, 231, '12 giờ', 0),
(847, 231, '1 tuần', 0),
(848, 232, 'Sao chổi', 0),
(849, 232, 'Sao băng', 1),
(850, 232, 'Tiểu hành tinh', 0),
(851, 232, 'Hố đen', 0),
(852, 233, 'Mặt Trời', 1),
(853, 233, 'Sao Proxima Centauri', 0),
(854, 233, 'Sao Thiên Lang', 0),
(855, 233, 'Sao Vega', 0),
(856, 234, 'Mặt Trăng', 1),
(857, 234, 'Titan', 0),
(858, 234, 'Io', 0),
(859, 234, 'Europa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `question_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`) VALUES
(3, 2, 'What is the chemical symbol for water?'),
(4, 2, 'Who developed the theory of relativity?'),
(5, 3, 'Who was the first President of the United States?'),
(132, 1, 'What is the capital of France?'),
(133, 1, 'Which planet is known as the Red Planet?'),
(134, 1, 'Ai đẹp trai?'),
(182, 10, 'Bố mẹ có 6 người con trai, mỗi người con trai có 1 em gái. Hỏi gia đình có bao nhiêu người?'),
(183, 10, 'Loài động vật nào được mệnh danh là \"Chúa tể rừng xanh\"?'),
(184, 10, 'Ký hiệu hóa học của vàng là gì?'),
(185, 10, 'Quốc gia nào nổi tiếng với tháp Eiffel?'),
(186, 10, 'Nước sôi ở bao nhiêu độ C khi ở mực nước biển?'),
(187, 10, 'Ai là người đầu tiên đặt chân lên Mặt Trăng?'),
(188, 10, 'Bộ phim hoạt hình nào của Disney có nhân vật chính là một nàng tiên cá?'),
(189, 10, 'Biểu tượng của ngành y tế là gì?'),
(190, 10, 'Quốc gia nào nổi tiếng với món sushi?'),
(191, 10, 'Ai là tác giả của cuốn tiểu thuyết Nhà Giả Kim?'),
(215, 13, 'Loài động vật nào được mệnh danh là \"Người khổng lồ hiền lành\" của đại dương?'),
(216, 13, 'Loài chim nào có khả năng bắt chước tiếng người tốt nhất?'),
(217, 13, 'Động vật nào có tuổi thọ trung bình cao nhất?'),
(218, 13, 'Loài côn trùng nào được coi là có sức mạnh lớn nhất so với kích thước cơ thể?'),
(219, 13, 'Loài động vật nào có thể thay đổi màu sắc để ngụy trang?'),
(220, 13, 'Loài động vật nào có tim lớn nhất?'),
(221, 13, 'Loài động vật nào có nọc độc mạnh nhất thế giới?'),
(222, 13, 'Loài động vật nào được mệnh danh là \"Sát thủ đại dương\"?'),
(223, 13, 'Loài động vật nào có tốc độ chạy nhanh nhất trên cạn?'),
(224, 13, 'Loài chim nào có sải cánh lớn nhất thế giới?'),
(225, 14, 'Hành tinh nào lớn nhất trong Hệ Mặt Trời?'),
(226, 14, 'Mặt Trời là loại sao gì?'),
(227, 14, 'Ai là người đầu tiên bay vào vũ trụ?'),
(228, 14, 'Hành tinh nào được gọi là \"Hành tinh Đỏ\"?'),
(229, 14, 'Hố đen có lực hấp dẫn mạnh đến mức gì có thể thoát ra ngoài?'),
(230, 14, 'Thiên hà chứa Hệ Mặt Trời của chúng ta tên là gì?'),
(231, 14, 'Trạm vũ trụ quốc tế (ISS) quay quanh Trái Đất trong bao lâu?'),
(232, 14, 'Thiên thạch khi lao vào khí quyển Trái Đất và bốc cháy được gọi là gì?'),
(233, 14, 'Sao nào gần Trái Đất nhất?'),
(234, 14, 'Vệ tinh tự nhiên lớn nhất của Trái Đất tên là gì?');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `duration` int NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `description`, `created_at`, `duration`) VALUES
(1, 'General Knowledge Quiz', 'Test your general knowledge skills!', '2025-02-08 04:00:37', 1),
(2, 'Science Quiz', 'Challenge yourself with science questions!', '2025-02-08 04:00:37', 10),
(3, 'History Quiz', 'How well do you know history?', '2025-02-08 04:00:37', 10),
(10, 'Đố vui', 'Một quiz game nho nhỏ để test trình độ của bạn về một vài chủ đề', '2025-02-08 09:00:09', 5),
(13, 'Thế Giới Động Vật 🦁🐼🐧', 'Thế giới động vật đa dạng, bạn có tự tin hiểu rõ? Thử ngay bài kiểm tra này!', '2025-02-09 08:16:35', 5),
(14, 'Khám Phá Vũ Trụ 🌌🚀✨', 'Vũ trụ bao la ẩn chứa nhiều bí ẩn, bạn có tự tin hiểu biết? Thử sức ngay! 🚀✨', '2025-02-09 08:28:53', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(9, 2, 1, 100, '2025-02-08 06:54:39'),
(10, 2, 1, 67, '2025-02-09 07:00:24'),
(11, 2, 1, 100, '2025-02-09 07:00:39'),
(12, 8, 1, 67, '2025-02-09 07:02:48'),
(13, 8, 10, 100, '2025-02-09 07:29:50'),
(14, 8, 2, 0, '2025-02-09 07:30:10'),
(15, 8, 2, 100, '2025-02-09 07:47:41'),
(16, 8, 1, 33, '2025-02-09 07:53:06'),
(17, 8, 1, 0, '2025-02-09 07:54:12'),
(18, 8, 1, 33, '2025-02-09 07:55:22'),
(19, 8, 1, 0, '2025-02-09 07:56:26'),
(20, 8, 10, 0, '2025-02-09 07:57:59'),
(21, 8, 1, 67, '2025-02-09 07:58:15'),
(22, 8, 1, 33, '2025-02-09 07:58:33'),
(23, 8, 10, 100, '2025-02-09 08:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_responses`
--

CREATE TABLE `user_responses` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `question_id` int NOT NULL,
  `selected_answer_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_responses`
--

INSERT INTO `user_responses` (`id`, `user_id`, `quiz_id`, `question_id`, `selected_answer_id`, `created_at`) VALUES
(148, 8, 14, 225, NULL, '2025-02-09 08:36:26'),
(149, 8, 14, 226, NULL, '2025-02-09 08:36:27'),
(150, 8, 14, 227, NULL, '2025-02-09 08:36:27'),
(151, 8, 14, 228, NULL, '2025-02-09 08:36:28'),
(152, 8, 14, 229, NULL, '2025-02-09 08:36:28'),
(153, 8, 14, 230, NULL, '2025-02-09 08:36:28'),
(154, 8, 14, 231, NULL, '2025-02-09 08:36:29'),
(155, 8, 14, 232, NULL, '2025-02-09 08:36:29'),
(156, 8, 14, 233, NULL, '2025-02-09 08:36:29');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=860;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_attempts`
--
ALTER TABLE `user_attempts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_responses`
--
ALTER TABLE `user_responses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

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
