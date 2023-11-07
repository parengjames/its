-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2023 at 02:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `read_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_logs`
--

CREATE TABLE `action_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_name` varchar(255) NOT NULL,
  `log_value` int(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `action_logs`
--

INSERT INTO `action_logs` (`log_id`, `user_id`, `log_name`, `log_value`, `date_time`) VALUES
(105, 31, 'logout', 0, '2023-11-06 13:19:30'),
(106, 31, 'login', 1, '2023-11-06 13:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(100) NOT NULL,
  `activity_name` varchar(1000) NOT NULL,
  `total_questions` int(255) NOT NULL,
  `total_points` int(255) NOT NULL,
  `passing_grade` int(255) NOT NULL,
  `lesson_id` int(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `lesson_id` int(11) NOT NULL,
  `lesson_title` varchar(250) NOT NULL,
  `lesson_description` mediumtext NOT NULL,
  `subject_id` int(11) NOT NULL,
  `lesson_content` longtext NOT NULL,
  `lesson_status` varchar(5000) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`lesson_id`, `lesson_title`, `lesson_description`, `subject_id`, `lesson_content`, `lesson_status`, `date_added`) VALUES
(7, 'Lesson sample 1', 'sample test', 1, '<p><span style=\"font-weight: bold;\">Test <span style=\"font-style: italic;\">test <span style=\"text-decoration-line: underline;\">test</span></span></span></p>', 'Partial', '2023-11-06 14:23:00'),
(8, 'Binary lesson 1', 'learn how to manipulate binary data sample sample', 6, '<p><span style=\"font-family: &quot;Arial Black&quot;;\">learn how to manipulate binary data sample sample</span><br /></p>', 'Partial', '2023-11-06 15:45:25'),
(9, 'data data', 'anything anyhwhere', 7, '<p><span style=\"font-family: Tahoma;\">Naa paman gd ko<span style=\"font-weight: bold;\"> skwelahan ba if wala unta okey ra kaau balag ako ra</span></span><br /></p>', 'Partial', '2023-11-06 15:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_pdf`
--

CREATE TABLE `lesson_pdf` (
  `pdf_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `pdf_content` mediumtext NOT NULL,
  `pdf_location` mediumtext NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson_pdf`
--

INSERT INTO `lesson_pdf` (`pdf_id`, `lesson_id`, `pdf_content`, `pdf_location`, `date_added`) VALUES
(9, 7, 'After Effects Beginners Guide - GD Studio.pdf', 'pdf_uploads/After Effects Beginners Guide - GD Studio.pdf', '2023-11-06 14:24:44'),
(10, 8, 'output.pdf', 'pdf_uploads/output.pdf', '2023-11-06 15:45:44'),
(11, 9, 'asdas.pdf', 'pdf_uploads/asdas.pdf', '2023-11-06 15:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_video`
--

CREATE TABLE `lesson_video` (
  `video_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `playlist` mediumtext NOT NULL,
  `video_location` mediumtext NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson_video`
--

INSERT INTO `lesson_video` (`video_id`, `lesson_id`, `playlist`, `video_location`, `date_added`) VALUES
(6, 7, 'Venice Canal.mp4', 'video_upload/Venice Canal.mp4', '2023-11-06 14:25:00'),
(7, 8, '3.mp4', 'video_upload/3.mp4', '2023-11-06 15:46:07'),
(8, 9, '4.mp4', 'video_upload/4.mp4', '2023-11-06 15:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(100) NOT NULL,
  `quiz_number` int(100) NOT NULL,
  `quiz_question` mediumtext NOT NULL,
  `quiz_ch1` mediumtext NOT NULL,
  `quiz_ch2` mediumtext NOT NULL,
  `quiz_ch3` mediumtext NOT NULL,
  `quiz_ch4` mediumtext NOT NULL,
  `answer_key` mediumtext NOT NULL,
  `hint1` varchar(255) NOT NULL,
  `hint2` varchar(255) NOT NULL,
  `hint3` varchar(255) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_about` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `subject_about`, `date_added`) VALUES
(1, 'Reading Comprehension ', 'The ability to process written text, understand its meaning, and integrate with what the reader already knows.', '2023-10-31 14:47:38'),
(6, 'Introduction to computing', 'computer era is blah blah blah', '2023-11-06 15:43:01'),
(7, 'Data Structure', 'sample na anything anyhow', '2023-11-06 15:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `Birthday` date DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `user_status` varchar(255) NOT NULL,
  `profile_picture` blob DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `role`, `Birthday`, `gender`, `age`, `address`, `user_status`, `profile_picture`, `email_address`, `username`, `password`, `date_added`) VALUES
(13, 'Admin', 'Admin', 3, NULL, 'Rather not say', NULL, NULL, '', NULL, 'admin@admin', 'superadmin', '$2y$10$roxFOISnB2mMuh80FGpfCOJvzj53fPHd23A8f6a9ZqiAI571DePCe', '2023-10-29 07:58:19'),
(31, 'Admin', 'Admin', 1, '2000-09-26', 'Male', 23, NULL, '', NULL, 'admin@yahoo.com', 'admin', '$2y$10$2k2D6oby2vIqjBAA0QBxQOSdH1fVTu3X0Wlm18n5NuCi.ir4JEUGe', '2023-10-29 08:03:18'),
(36, 'Lebron James', 'Delos Baynte', 2, '1983-01-17', 'Male', 40, NULL, 'Approved', NULL, 'user@elearning.com', 'user', '$2y$10$.fYTd.9DI1oKxkLQU/Rwlefz4sbL8J0YyxZM11Cz.cIbMqZoL1fve', '2023-11-06 13:19:09'),
(37, 'George', 'Delos Amega', 2, '2000-09-10', 'Male', 23, NULL, 'Pending', NULL, 'user1@gmail.com', 'user100', '$2y$10$AAGe7c1jdE7lv1nnl326Fu6jNoHKRo2UHuJWsMfk.ljBqhvDJvZlm', '2023-11-06 13:39:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_logs`
--
ALTER TABLE `action_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `lesson_pdf`
--
ALTER TABLE `lesson_pdf`
  ADD PRIMARY KEY (`pdf_id`);

--
-- Indexes for table `lesson_video`
--
ALTER TABLE `lesson_video`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_logs`
--
ALTER TABLE `action_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lesson_pdf`
--
ALTER TABLE `lesson_pdf`
  MODIFY `pdf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lesson_video`
--
ALTER TABLE `lesson_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
