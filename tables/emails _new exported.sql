-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 02:19 PM
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
(1, 'Second@unknown.com', 'First@unknown.com', 'hey', '', '[]', NULL, '[]', '2024-11-08 14:49:17', 1, NULL),
(2, 'Pesanonrico@unknown.com', 'Second@unknown.com', 'Meeting', '', '[]', NULL, '[]', '2024-11-26 12:09:21', 0, NULL),
(3, 'First@unknown.com', 'Third@unknown.com', 'HELLO 11.13.24ads', '', '[]', NULL, '[]', '2024-11-27 10:13:09', 0, NULL),
(4, 'First@unknown.com', 'Pesanonrico@unknown.com', 'HELLO 11.13.24ads', '', '[]', NULL, '[]', '2024-11-27 10:13:26', 0, NULL),
(5, 'First@unknown.com', 'Second@unknown.com', 'Meeting', 'Meeting summary\r\nA summary of the meeting that includes the main topics discussed, decisions made, and action items. For example, \"During the meeting, we discussed the strategy for our upcoming summer marketing campaign\".', '[]', NULL, '[]', '2024-11-27 10:15:23', 0, NULL),
(6, 'First@unknown.com', 'Pesanonrico@unknown.com', 'Meeting', 'margin: 10px 0 0 10px;', '[]', NULL, '[]', '2024-11-27 10:20:11', 0, NULL),
(7, 'First@unknown.com', 'Second@unknown.com', 'Meeting', 'margin: 10px 0 0 10px;', '[]', NULL, '[]', '2024-11-27 10:20:41', 0, NULL),
(8, 'First@unknown.com', 'Second@unknown.com', 'Meeting', '', '[]', NULL, '[]', '2024-11-27 10:20:53', 0, NULL),
(9, 'First@unknown.com', 'Third@unknown.com', 'Meeting', '', '[]', NULL, '[]', '2024-11-27 10:21:05', 0, NULL),
(10, 'First@unknown.com', 'Second@unknown.com', 'Meeting', '', '[]', NULL, '[]', '2024-11-27 10:21:55', 0, NULL);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
