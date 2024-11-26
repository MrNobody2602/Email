-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 12:55 PM
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
  `sender_email` varchar(255) DEFAULT NULL,
  `recipient_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `image_uploads` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`image_uploads`)),
  `video_upload` varchar(255) DEFAULT NULL,
  `document_uploads` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`document_uploads`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_status` tinyint(1) DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `sender_email`, `recipient_email`, `subject`, `message`, `image_uploads`, `video_upload`, `document_uploads`, `created_at`, `read_status`, `read_at`) VALUES
(112, 'Second@unknown.com', 'First@unknown.com', 'hey', '', '[]', NULL, '[]', '2024-11-08 14:49:17', 1, NULL);

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
(2, 'QM_ACC01', 'FirstUser1', 'First12', 'User', 22, 'Canduman', '2024-11-06', '09639612123', 'download.jpg'),
(3, 'QM_ACC02', 'SecondUser', 'Song ', 'Hye-Kyo', 22, 'Canduman Cubacub Mandaue Cebu City Philippines', '2024-10-18', '0912768234', 'mypis.jpg'),
(4, 'QM_ACC04', 'Mr. Nobody', 'Rico', 'Pesanon', 22, 'Cubacub, Canduman Mandaue City', '2002-10-22', '09639609461', 'FF151167-1DD0-43E1-A73F-4F11D0321D6A.jpeg');

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
('QM_ACC01', 'FirstUser1', 'First@unknown.com', '$2y$10$eXe7rhnH/f1Ywnc/U1sHuO3z4g316gGRk2/bDZMXiireUzu8m9emi', '2024-11-26 10:31:31'),
('QM_ACC02', 'SecondUser', 'Second@unknown.com', '$2y$10$oyZhPt1WvUR/8qdeASdn9eWd7TTClYbmVS8J2IRw8NfvFFM7AbU1a', '2024-11-22 14:53:02'),
('QM_ACC03', 'Third', 'Third@unknown.com', '$2y$10$Bh6DRwplenXYU8z8HiKMHuW3SWwcgUORgSrFTiC2dKsYtzGRXbzVW', '2024-11-23 13:40:36'),
('QM_ACC04', 'Mr. Nobody', 'Pesanonrico@unknown.com', '$2y$10$B.sip6kDtaTz5CrBk9AAaeY7jmNNWDpyNooCaETVRjzixJlnMLzT.', '2024-11-26 11:54:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

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
