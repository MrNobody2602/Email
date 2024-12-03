-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 03:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quantamail`
--

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `message_id` varchar(50) NOT NULL,
  `sender_email` varchar(255) DEFAULT NULL,
  `recipient_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `image_uploads` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`image_uploads`)),
  `video_upload` varchar(255) DEFAULT NULL,
  `document_uploads` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`document_uploads`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `read_status` tinyint(1) DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `message_id`, `sender_email`, `recipient_email`, `subject`, `message`, `image_uploads`, `video_upload`, `document_uploads`, `created_at`, `updated_at`, `read_status`, `read_at`) VALUES
(1, 'QM_MSG6837467962', 'First@unknown.com', 'Second@unknown.com', 'Meeting', '', '[]', NULL, '[]', '2024-11-29 13:32:03', '2024-11-29 13:32:03', 0, NULL),
(2, 'QM_MSG0522517774', 'First@unknown.com', 'Pesanonrico@unknown.com', 'Meeting', '', '[]', NULL, '[]', '2024-11-29 13:33:46', '2024-11-29 13:33:46', 1, NULL),
(3, 'QM_MSG4978005050', 'First@unknown.com', 'Pesanonrico@unknown.com', 'Meeting', '', '[]', NULL, '[]', '2024-11-29 13:34:28', '2024-11-29 13:34:28', 1, NULL),
(4, 'QM_MSG9738273179', 'First@unknown.com', 'Second@unknown.com', 'Hellooo!!!!!!!!!!!', '', '[]', NULL, '[]', '2024-12-02 16:04:48', '2024-12-02 16:04:48', 0, NULL),
(5, 'QM_MSG4832287598', 'First@unknown.com', 'Second@unknown.com', 'Hellooo!!!!!!!!!!!', '', '[]', NULL, '[]', '2024-12-02 16:05:37', '2024-12-02 16:05:37', 0, NULL),
(6, 'QM_MSG7162908616', 'First@unknown.com', 'Second@unknown.com', 'Hellooo!!!!!!!!!!!', '', '[]', NULL, '[]', '2024-12-02 16:05:46', '2024-12-02 16:05:46', 0, NULL),
(7, 'QM_MSG3045171911', 'First@unknown.com', 'Pesanonrico@unknown.com', 'Helloooo', '\r\n', '[]', NULL, '[]', '2024-12-02 16:09:05', '2024-12-02 16:09:05', 1, NULL),
(9, 'QM_MSG0355860148', 'Pesanonrico@unknown.com', 'Second@unknown.com', 'Meeting', 'affasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffas', '[]', NULL, '[]', '2024-12-03 14:03:31', '2024-12-03 14:03:31', 0, NULL),
(10, 'QM_MSG7003139980', 'Pesanonrico@unknown.com', 'First@unknown.com', 'Meeting', 'affasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffasaffas', '[]', NULL, '[]', '2024-12-03 14:06:30', '2024-12-03 14:06:30', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `update_profile`
--

CREATE TABLE `update_profile` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `update_profile`
--

INSERT INTO `update_profile` (`id`, `user_id`, `username`, `firstname`, `lastname`, `age`, `address`, `birthday`, `phone_number`, `image`) VALUES
(2, 'QM_ACC01', 'FirstUser1', 'First12123', 'User', 22, 'Canduman', '2024-11-06', '09639612123', 'GTA4.jpg'),
(3, 'QM_ACC02', 'SecondUser', 'Song ', 'Hye-Kyo', 22, 'Canduman Cubacub Mandaue Cebu City Philippines', '2024-10-18', '0912768234', 'mypis.jpg'),
(4, 'QM_ACC04', 'Mr. Nobody', 'Rico', 'Pesanon', 22, 'Cubacub, Canduman Mandaue City', '2002-10-22', '09639609461', 'ID PICTURE.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `last_login`) VALUES
('QM_ACC01', 'FirstUser1', 'First@unknown.com', '$2y$10$eXe7rhnH/f1Ywnc/U1sHuO3z4g316gGRk2/bDZMXiireUzu8m9emi', '2024-12-03 14:18:12'),
('QM_ACC02', 'SecondUser', 'Second@unknown.com', '$2y$10$oyZhPt1WvUR/8qdeASdn9eWd7TTClYbmVS8J2IRw8NfvFFM7AbU1a', '2024-11-22 14:53:02'),
('QM_ACC03', 'Third', 'Third@unknown.com', '$2y$10$Bh6DRwplenXYU8z8HiKMHuW3SWwcgUORgSrFTiC2dKsYtzGRXbzVW', '2024-11-23 13:40:36'),
('QM_ACC04', 'Mr. Nobody', 'Pesanonrico@unknown.com', '$2y$10$B.sip6kDtaTz5CrBk9AAaeY7jmNNWDpyNooCaETVRjzixJlnMLzT.', '2024-12-03 14:17:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `message_id` (`message_id`);

--
-- Indexes for table `update_profile`
--
ALTER TABLE `update_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `update_profile`
--
ALTER TABLE `update_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `update_profile`
--
ALTER TABLE `update_profile`
  ADD CONSTRAINT `update_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
