-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 03:26 PM
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
(112, 'Second@unknown.com', 'First@unknown.com', 'hey', '', '[]', NULL, '[]', '2024-11-08 14:49:17', 1, NULL),
(113, 'Second@unknown.com', 'First@unknown.com', 'TEST1234567', '', '[]', NULL, '[]', '2024-11-10 10:50:09', 1, NULL),
(114, 'Second@unknown.com', 'First@unknown.com', 'TEST1234567', '', '[]', NULL, '[]', '2024-11-10 10:50:50', 1, NULL),
(115, 'Second@unknown.com', 'First@unknown.com', 'TEST12345', 'asdasdasdasds', '[]', NULL, '[]', '2024-11-10 10:51:15', 1, NULL),
(116, 'First@unknown.com', 'Second@unknown.com', 'ANNOUNCEMENT', '', '[]', NULL, '[]', '2024-11-10 11:00:38', 1, NULL),
(117, 'First@unknown.com', 'Second@unknown.com', 'ANNOUNCEMENT', '	It provides real-time updates to user and administrator through a user interface (e.g., mobile app or web dashboard) to monitor the status of the bin, such as when compartments are full or maintenance is required.', '[]', NULL, '[]', '2024-11-11 04:53:17', 1, NULL),
(118, 'First@unknown.com', 'Second@unknown.com', 'ANNOUNCEMENT', '', '[]', NULL, '[]', '2024-11-11 04:54:14', 1, NULL),
(119, 'First@unknown.com', 'Second@unknown.com', 'ANNOUNCEMENT1231323', '', '[]', NULL, '[]', '2024-11-11 04:54:44', 1, NULL),
(120, 'First@unknown.com', 'Second@unknown.com', 'ANNOUNCEMENT4567890', '', '[]', NULL, '[]', '2024-11-11 04:58:12', 1, NULL),
(121, 'First@unknown.com', 'Second@unknown.com', 'ANNOUNCEMENT1231323', '', '[]', NULL, '[]', '2024-11-11 04:59:01', 1, NULL),
(122, 'First@unknown.com', 'Second@unknown.com', 'ANNOUNCEMENT1231323', '', '[]', NULL, '[]', '2024-11-11 05:02:33', 1, NULL),
(123, 'Second@unknown.com', 'First@unknown.com', 'hello!', '', '[]', NULL, '[]', '2024-11-11 09:41:02', 1, NULL),
(124, 'Second@unknown.com', 'First@unknown.com', 'hello!', '', '[]', NULL, '[]', '2024-11-11 09:41:18', 1, NULL),
(125, 'Second@unknown.com', 'First@unknown.com', 'Hi!', '', '[]', NULL, '[]', '2024-11-11 09:42:05', 1, NULL),
(126, 'Second@unknown.com', 'First@unknown.com', 'ANNOUNCEMENT1231323sadasdadas', '', '[]', NULL, '[]', '2024-11-11 10:06:19', 1, NULL),
(127, 'Second@unknown.com', 'First@unknown.com', 'asdfghhfdssadfgdfsas', '', '[]', NULL, '[]', '2024-11-11 10:07:48', 1, NULL),
(128, 'Second@unknown.com', 'First@unknown.com', 'asdfghhfdssadfgdfsas', '', '[]', NULL, '[]', '2024-11-11 10:10:25', 1, NULL),
(129, 'Second@unknown.com', 'First@unknown.com', 'ALIJE hasdnncuq99bc', '', '[]', NULL, '[]', '2024-11-11 10:11:24', 1, NULL),
(130, 'Second@unknown.com', 'First@unknown.com', ';obidvshAJLKOJWFHBDJNK', '', '[]', NULL, '[]', '2024-11-11 10:12:59', 1, NULL),
(131, 'Second@unknown.com', 'First@unknown.com', 'hohoohohho;obidvshAJLKOJWFHBDJNKpjmwnubehbjn', '', '[]', NULL, '[]', '2024-11-11 10:14:25', 1, NULL),
(132, 'First@unknown.com', 'First@unknown.com', 'ALIJE hasdnncuq99bc', '', '[]', NULL, '[]', '2024-11-11 10:37:30', 1, NULL),
(133, 'First@unknown.com', 'Second@unknown.com', 'jkdn qwhuvqukhs skdvyabU', '', '[]', NULL, '[]', '2024-11-11 10:37:54', 1, NULL),
(134, 'First@unknown.com', 'Second@unknown.com', 'ASDFGSQDFGWEFGHJEFFGHJKJHGFDS', '', '[]', NULL, '[]', '2024-11-11 10:38:14', 1, NULL),
(135, 'First@unknown.com', 'Second@unknown.com', 'hohoohohho;obidvshAJLKOJWFHBDJNKpjmwnubehbjn', '', '[]', NULL, '[]', '2024-11-11 10:41:27', 1, NULL),
(136, 'First@unknown.com', 'Second@unknown.com', 'SADFSASFGSAEASDFAFDS', '', '[]', NULL, '[]', '2024-11-11 10:58:55', 1, NULL),
(137, 'First@unknown.com', 'Second@unknown.com', 'PAUL DINO MEETING', '', '[]', NULL, '[]', '2024-11-11 11:00:59', 1, NULL),
(138, 'Second@unknown.com', 'First@unknown.com', 'NOTICE', '', '[]', NULL, '[]', '2024-11-11 13:12:34', 1, NULL),
(139, 'Second@unknown.com', 'First@unknown.com', 'hohoohohho;obidvshAJLKOJWFHBDJNKpjmwnubehbjn', '', '[]', NULL, '[]', '2024-11-11 13:17:12', 1, NULL),
(140, 'Second@unknown.com', 'First@unknown.com', '123425654321;obidvshAJLKOJWFHBDJNK', '', '[]', NULL, '[]', '2024-11-11 13:18:47', 1, NULL),
(141, 'Second@unknown.com', 'First@unknown.com', 'yowwwww', '', '[]', NULL, '[]', '2024-11-11 14:06:37', 1, NULL),
(142, 'Second@unknown.com', 'First@unknown.com', 'Hellooo', '', '[]', NULL, '[]', '2024-11-11 14:07:18', 1, NULL),
(143, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!', '', '[]', NULL, '[]', '2024-11-11 14:59:36', 1, NULL),
(144, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!', '', '[]', NULL, '[]', '2024-11-11 15:00:06', 1, NULL),
(145, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!!!!!!!!!!', '', '[]', NULL, '[]', '2024-11-11 15:03:23', 1, NULL),
(146, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!!!!!!!!!!', 'sdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdadsdasadaasdasdadasdasdadasdad', '[]', NULL, '[]', '2024-11-11 15:08:14', 1, NULL),
(147, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!!!!!!!!!!', 'The created_at column is set with a default CURRENT_TIMESTAMP(), so it should be populated automatically. However, if created_at appears as \"undefined,\" confirm in your database that: Each email row has a created_at timestamp. Any records with a missing or NULL created_at may need to be updated manually.', '[]', NULL, '[]', '2024-11-11 15:15:56', 1, NULL),
(148, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!!!!!!!!!!', 'socket.onmessage = function(event) {\r\n    const newEmail = JSON.parse(event.data);\r\n    console.log(\"New message received:\", newEmail);\r\n\r\n    const noEmailsRow = document.querySelector(\"#inbox-table tbody tr td[colspan=\'6\']\");\r\n    if (noEmailsRow) {\r\n        noEmailsRow.parentElement.remove();\r\n    }\r\n\r\n    const table = document.querySelector(\"#inbox-table tbody\");\r\n    const newRow = document.createElement(\'tr\');\r\n    const emailData = JSON.stringify(newEmail);\r\n\r\n    // Set class and data attribute, add glowing-border if the email is unread\r\n    newRow.classList.add(\'view-emailDetails\');\r\n    if (!newEmail.read_status) {\r\n        newRow.classList.add(\'glowing-border\');  // Add glowing border for unread emails\r\n    }\r\n    newRow.setAttribute(\'data-email\', emailData);\r\n\r\n    newRow.innerHTML = `\r\n        <td>${newEmail.sender}</td>\r\n        <td>${newEmail.subject}</td>\r\n        <td class=\'message-cell\'>${newEmail.message}</td>\r\n        <td>${newEmail.created_at}</td>\r\n        <td>${newEmail.read_status ? \'Read\' : \'Unread\'}</td>\r\n    `;\r\n\r\n    table.prepend(newRow);\r\n\r\n    // Attach event listener to the newly created row to handle click\r\n    newRow.addEventListener(\"click\", function () {\r\n        const dataAttribute = newRow.getAttribute(\"data-email\");\r\n        if (!dataAttribute) {\r\n            console.error(\"Missing data-email attribute\");\r\n            return;\r\n        }\r\n\r\n        const emailData = JSON.parse(dataAttribute);\r\n\r\n        // Populate the modal with email details\r\n        document.getElementById(\"modal-sender\").textContent = emailData.sender_email;\r\n        document.getElementById(\"modal-subject\").textContent = emailData.subject;\r\n        document.getElementById(\"modal-message\").textContent = emailData.message;\r\n        document.getElementById(\"modal-date\").textContent = emailData.created_at;\r\n\r\n        // Show the modal\r\n        emailModal.show();\r\n\r\n        // Mark email as read and remove glowing border if present\r\n        if (newRow.classList.contains(\'glowing-border\')) {\r\n            markEmailAsRead(emailData.id, newRow); // Remove glowing border after marking as read\r\n        }\r\n    });\r\n};\r\n', '[]', NULL, '[]', '2024-11-11 15:19:14', 1, NULL),
(149, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!!!!!!!!!!', '', '[]', NULL, '[]', '2024-11-11 15:21:51', 1, NULL),
(150, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!!!!!!!!!!', '', '[]', NULL, '[]', '2024-11-11 15:25:15', 1, NULL),
(151, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!!!!!!!!!!', '', '[]', NULL, '[]', '2024-11-11 15:26:47', 1, NULL),
(152, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!!!!!!!!!!', '', '[]', NULL, '[]', '2024-11-11 15:29:46', 1, NULL),
(153, 'Second@unknown.com', 'First@unknown.com', 'Hello Test New Update/Features', 'Updated Feature emailing', '[]', NULL, '[]', '2024-11-11 15:31:55', 1, NULL),
(154, 'Second@unknown.com', 'First@unknown.com', 'Hello!', 'Updates / features', '[]', NULL, '[]', '2024-11-11 15:33:45', 1, NULL),
(155, 'Second@unknown.com', 'Third@unknown.com', 'Hello thirdy here!', '', '[]', NULL, '[]', '2024-11-12 12:36:37', 1, NULL),
(156, 'First@unknown.com', 'Second@unknown.com', 'ANNOUNCEMENT1231323', '', '[]', NULL, '[]', '2024-11-12 13:10:56', 1, NULL),
(157, 'First@unknown.com', 'Second@unknown.com', 'ANNOUNCEMENT1231323', '', '[]', NULL, '[]', '2024-11-12 13:13:14', 1, NULL),
(158, 'First@unknown.com', 'Second@unknown.com', 'November', '', '[]', NULL, '[]', '2024-11-12 13:39:08', 1, NULL),
(159, 'First@unknown.com', 'Second@unknown.com', 'NOvANNOUNCEMENT1231323', '', '[]', NULL, '[]', '2024-11-12 13:39:51', 1, NULL),
(160, 'First@unknown.com', 'Second@unknown.com', 'ANNOUNCEMENT', 'asdasdasdasdasdasdcx', '[]', NULL, '[]', '2024-11-12 13:58:18', 1, NULL),
(161, 'First@unknown.com', 'Second@unknown.com', 'OLAH', '', '[]', NULL, '[]', '2024-11-12 14:00:14', 1, NULL),
(162, 'First@unknown.com', 'Second@unknown.com', 'yupaaaa', '', '[]', NULL, '[]', '2024-11-12 14:02:21', 1, NULL),
(163, 'First@unknown.com', 'Second@unknown.com', 'sad', '', '[]', NULL, '[]', '2024-11-12 14:05:06', 1, NULL),
(164, 'First@unknown.com', 'Second@unknown.com', 'sad', '', '[]', NULL, '[]', '2024-11-12 14:09:37', 1, NULL),
(165, 'First@unknown.com', 'Second@unknown.com', 'asdasdasdasdasdds', '', '[]', NULL, '[]', '2024-11-12 14:13:58', 1, NULL),
(166, 'First@unknown.com', 'Second@unknown.com', 'asfdsfsasdf', '', '[]', NULL, '[]', '2024-11-12 14:15:07', 1, NULL),
(167, 'First@unknown.com', 'Second@unknown.com', 'ddasfswedfsdwsdffd', '', '[]', NULL, '[]', '2024-11-12 14:15:33', 1, NULL),
(168, 'Second@unknown.com', 'First@unknown.com', 'Hello Test New Update/Features', '', '[]', NULL, '[]', '2024-11-12 14:16:05', 1, NULL),
(169, 'Second@unknown.com', 'First@unknown.com', 'Hellooo', '', '[]', NULL, '[]', '2024-11-12 14:17:23', 1, NULL),
(170, 'Second@unknown.com', 'First@unknown.com', 'Hello!', '', '[]', NULL, '[]', '2024-11-12 14:17:53', 1, NULL),
(171, 'Second@unknown.com', 'Third@unknown.com', 'Hellooo!!', '', '[]', NULL, '[]', '2024-11-12 14:19:21', 1, NULL),
(172, 'Second@unknown.com', 'First@unknown.com', 'Hello Test New Update/Features', '', '[]', NULL, '[]', '2024-11-12 14:27:04', 1, NULL),
(173, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!', '', '[]', NULL, '[]', '2024-11-12 14:27:45', 1, NULL),
(174, 'Second@unknown.com', 'Third@unknown.com', 'Hello!', '', '[]', NULL, '[]', '2024-11-12 14:49:11', 1, NULL),
(175, 'Second@unknown.com', 'Third@unknown.com', 'Hello Test New Update/Features', '', '[]', NULL, '[]', '2024-11-12 14:49:37', 1, NULL),
(176, 'First@unknown.com', 'Second@unknown.com', 'sad22', '', '[]', NULL, '[]', '2024-11-12 14:57:54', 1, NULL),
(177, 'First@unknown.com', 'Second@unknown.com', 'asdasdasdasdasdds', '', '[]', NULL, '[]', '2024-11-12 15:01:02', 1, NULL),
(178, 'First@unknown.com', 'Second@unknown.com', 'sad', '', '[]', NULL, '[]', '2024-11-12 15:03:21', 1, NULL),
(179, 'First@unknown.com', 'Second@unknown.com', 'asdasdasdasdasdds', '', '[]', NULL, '[]', '2024-11-12 15:20:08', 1, NULL),
(180, 'First@unknown.com', 'Second@unknown.com', 'asdasd', '', '[]', NULL, '[]', '2024-11-12 15:20:35', 1, NULL),
(181, 'First@unknown.com', 'Second@unknown.com', 'sad2256543', '', '[]', NULL, '[]', '2024-11-12 15:26:18', 1, NULL),
(182, 'First@unknown.com', 'Second@unknown.com', 'asdasdasdasdasdds', '', '[]', NULL, '[]', '2024-11-12 15:30:42', 1, NULL),
(183, 'Second@unknown.com', 'Third@unknown.com', 'asdasdadsad', '', '[]', NULL, '[]', '2024-11-12 15:31:06', 1, NULL),
(184, 'Second@unknown.com', 'Third@unknown.comasdasdad', 'asdasdasdadsd', '', '[]', NULL, '[]', '2024-11-12 15:31:30', 0, NULL),
(185, 'Second@unknown.com', 'Third@unknown.com', 'as', '', '[]', NULL, '[]', '2024-11-12 15:31:58', 1, NULL),
(186, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!', '', '[]', NULL, '[]', '2024-11-12 15:32:55', 1, NULL),
(187, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!', '', '[]', NULL, '[]', '2024-11-12 15:33:36', 1, NULL),
(188, 'Second@unknown.com', 'Third@unknown.com', 'Hellooo', '', '[]', NULL, '[]', '2024-11-12 15:34:00', 1, NULL),
(189, 'Second@unknown.com', 'First@unknown.com', 'Hello!', '', '[]', NULL, '[]', '2024-11-12 15:34:33', 1, NULL),
(190, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!!', '', '[]', NULL, '[]', '2024-11-12 15:34:57', 1, NULL),
(191, 'Second@unknown.com', 'First@unknown.com', 'Hello!', '', '[]', NULL, '[]', '2024-11-12 15:35:58', 1, NULL),
(192, 'Third@unknown.com', 'First@unknown.com', 'Meeting', '', '[]', NULL, '[]', '2024-11-12 15:36:33', 1, NULL),
(193, 'Second@unknown.com', 'First@unknown.com', 'Hellooo! FOR FIRST', '', '[]', NULL, '[]', '2024-11-12 15:37:26', 1, NULL),
(194, 'Second@unknown.com', 'First@unknown.com', 'Hellooo!', '', '[]', NULL, '[]', '2024-11-12 15:42:23', 1, NULL),
(195, 'First@unknown.com', 'Second@unknown.com', 'ddasfswedfsdwsdffd', '', '[]', NULL, '[]', '2024-11-13 12:28:47', 1, NULL),
(196, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13', '', '[]', NULL, '[]', '2024-11-13 12:42:14', 1, NULL),
(197, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13', '', '[]', NULL, '[]', '2024-11-13 12:42:45', 1, NULL),
(198, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24', '', '[]', NULL, '[]', '2024-11-13 12:45:27', 1, NULL),
(199, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24', '', '[]', NULL, '[]', '2024-11-13 12:46:39', 1, NULL),
(200, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24ads', '', '[]', NULL, '[]', '2024-11-13 12:54:05', 1, NULL),
(201, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24ads', '', '[]', NULL, '[]', '2024-11-13 12:54:51', 1, NULL),
(202, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24ads', '', '[]', NULL, '[]', '2024-11-13 13:09:04', 1, NULL),
(203, 'First@unknown.com', 'Second@unknown.com', 'asdas3112316813', '', '[]', NULL, '[]', '2024-11-13 13:26:37', 1, NULL),
(204, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24ads', '', '[]', NULL, '[]', '2024-11-13 13:27:52', 1, NULL),
(205, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24ads', '', '[]', NULL, '[]', '2024-11-13 13:35:17', 1, NULL),
(206, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24ads', '', '[]', NULL, '[]', '2024-11-13 13:35:53', 1, NULL),
(207, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24ads', 'bjmdhyusgfhikmlds fbfsijol,ds fbljd', '[]', NULL, '[]', '2024-11-13 13:42:10', 1, NULL),
(208, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24ads', '', '[]', NULL, '[]', '2024-11-13 14:07:01', 1, NULL),
(209, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24ads', 'asdadadasd', '[]', NULL, '[]', '2024-11-13 14:09:11', 1, NULL),
(210, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24ads', '', '[]', NULL, '[]', '2024-11-13 14:21:16', 1, NULL),
(211, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24adsdasd', '', '[]', NULL, '[]', '2024-11-13 14:25:04', 1, NULL),
(212, 'First@unknown.com', 'Second@unknown.com', 'asdasdasdasdasd', '', '[]', NULL, '[]', '2024-11-13 14:38:21', 1, NULL),
(213, 'First@unknown.com', 'Second@unknown.com', 'asdas3112316813', '', '[]', NULL, '[]', '2024-11-13 14:40:20', 1, NULL),
(214, 'First@unknown.com', 'Second@unknown.com', 'asdadasdasd', '', '[]', NULL, '[]', '2024-11-13 14:40:46', 1, NULL),
(215, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24adsdasd', '', '[]', NULL, '[]', '2024-11-13 14:44:00', 1, NULL),
(216, 'First@unknown.com', 'Second@unknown.com', 'rtyuiop', '', '[]', NULL, '[]', '2024-11-13 14:44:26', 1, NULL),
(217, 'First@unknown.com', 'Second@unknown.com', 'asdas3112316813', '', '[]', NULL, '[]', '2024-11-13 14:51:07', 1, NULL),
(218, 'First@unknown.com', 'Second@unknown.com', 'asdasdasdasdasd', '', '[]', NULL, '[]', '2024-11-13 14:51:53', 1, NULL),
(219, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24adsdasd', '', '[]', NULL, '[]', '2024-11-13 14:55:26', 1, NULL),
(220, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24adsdasd', '\r\n\r\n.glowing-border {\r\n  animation: glow 5s ease-in-out infinite alternate;\r\n  border: 2px solid var(--green);\r\n  border-radius: 10px;\r\n}', '[]', NULL, '[]', '2024-11-13 14:55:45', 1, NULL),
(221, 'First@unknown.com', 'Second@unknown.com', 'HELLO 11.13.24', 'text-align: center;\r\n  color: #888;\r\n}\r\n\r\n::-webkit-scrollbar {\r\n  width: 10px;\r\n}\r\n\r\n::-webkit-scrollbar-track {\r\n  background: #f1f1f1; \r\n}\r\n \r\n::-webkit-scrollbar-thumb {\r\n  background: #888; \r\n}\r\n\r\n::-webkit-scrollbar-thumb:hover {\r\n  background: var(--dark-gray); \r\n}\r\n\r\n\r\n.glowing-border {\r\n  animation: glow 5s ease-in-out infinite alternate;\r\n  border: 2px solid var(--green);\r\n  border-radius: 10px;\r\n}\r\n\r\n@keyframes glow {', '[]', NULL, '[]', '2024-11-13 14:56:20', 1, NULL),
(222, 'First@unknown.com', 'Second@unknown.com', 'asdas3112316813', '', '[]', NULL, '[]', '2024-11-13 15:08:16', 1, NULL),
(223, 'First@unknown.com', 'Second@unknown.com', 'asdasdasdasdasd', '', '[]', NULL, '[]', '2024-11-13 15:15:06', 1, NULL),
(224, 'Second@unknown.com', 'First@unknown.com', 'Checking', 'asdsdadasdsa', '[]', NULL, '[]', '2024-11-14 11:06:38', 1, NULL),
(225, 'Second@unknown.com', 'First@unknown.com', 'Meeting', 'JSDASKLDNBASBD', '[]', NULL, '[]', '2024-11-14 11:07:49', 1, NULL),
(226, 'Second@unknown.com', 'First@unknown.com', 'Meeting', 'ASDASDASDASDD', '[]', NULL, '[]', '2024-11-14 11:10:08', 1, NULL),
(227, 'First@unknown.com', 'Second@unknown.com', 'Hello Test New Update/Features', 'asd', '[]', NULL, '[]', '2024-11-14 11:12:12', 1, NULL),
(228, 'First@unknown.com', 'Second@unknown.com', 'asdas', '', '[]', NULL, '[]', '2024-11-14 11:13:41', 1, NULL),
(229, 'First@unknown.com', 'Second@unknown.com', 'Hellooo', '', '[]', NULL, '[]', '2024-11-14 11:14:13', 1, NULL),
(230, 'First@unknown.com', 'Second@unknown.com', 'sdfghjk', '', '[]', NULL, '[]', '2024-11-14 11:17:49', 1, NULL),
(231, 'First@unknown.com', 'Second@unknown.com', 'xdfghjkl;', '', '[]', NULL, '[]', '2024-11-14 11:18:45', 1, NULL),
(232, 'Ryan@unknown.com', 'First@unknown.com', 'Meeting', 'adsfdgdgg', '[]', NULL, '[]', '2024-11-18 10:43:00', 1, NULL),
(233, 'Ryan@unknown.com', 'First@unknown.com', 'Meeting', 'dfgfhgjhk', '[]', NULL, '[]', '2024-11-18 10:43:33', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `update_profile`
--

CREATE TABLE `update_profile` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `update_profile`
--

INSERT INTO `update_profile` (`id`, `user_id`, `username`, `age`, `address`, `birthday`, `phone_number`, `image`) VALUES
(2, 'QM_ACC01', 'FirstUser1', 22, 'Canduman', '2024-11-06', '09639612123', 'mypis.jpg'),
(3, 'QM_ACC02', 'SecondUser', 22, 'Can', '2024-10-18', '124564321345', '419252322_264452809999614_4309791900058431033_n.jpg'),
(4, 'QM_ACC04', 'Rico Bono Pesanon', 22, 'Cubacub, Canduman Mandaue City', '2002-10-22', '09639609461', 'mypis.jpg'),
(5, 'QM_ACC05', 'Paul Dino2', 123, 'liloan', '2024-11-06', '34567898765', 'b4773ab4-c11b-4a0c-a446-6881f3c25209.jpg');

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
('QM_ACC01', 'FirstUser1', 'First@unknown.com', '$2y$10$3PUilrxwZ/kiq4D8PTXi2unDHd9hbacapJvHziobLgLj93hYYnNga', '2024-11-18 10:54:11'),
('QM_ACC02', 'SecondUser', 'Second@unknown.com', '$2y$10$A3rnagHkC0EPBNQ.W.N0E.NGl9X9r0uOgKyP2EyGVehM4r3.fDjPu', '2024-11-17 13:14:03'),
('QM_ACC03', 'Third', 'Third@unknown.com', '$2y$10$Bh6DRwplenXYU8z8HiKMHuW3SWwcgUORgSrFTiC2dKsYtzGRXbzVW', '2024-11-17 13:39:58'),
('QM_ACC04', 'Rico Bono Pesanon', 'Pesanonrico@unknown.com', '$2y$10$LQZPMXWpGyITHY9HkyIevuTU.PVsantboLcyW1D0s4f2EK2F78Y0C', '2024-11-18 09:58:38'),
('QM_ACC05', 'Paul Dino2', 'Paul@unknown.com', '$2y$10$CKgape2lT2eFBzyF3wChYOaQRcVjPjevsN8xN45oVnIKmukBnXZFW', '2024-11-18 10:30:10'),
('QM_ACC06', 'RyanPrudenciado', 'Ryan@unknown.com', '$2y$10$/z7mGV3faqb9cGqhaQf.w.53MKGg5fab7HnWEErCDif4ARkiBaMd.', '2024-11-18 10:41:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

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
