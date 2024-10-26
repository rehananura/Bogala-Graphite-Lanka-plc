-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 01:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graphite-management`
--
CREATE DATABASE IF NOT EXISTS `graphite-management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `graphite-management`;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` enum('Present','Absent','Leave') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `status`) VALUES
(1, 1, '2024-10-01', 'Present'),
(2, 1, '2024-10-02', 'Present'),
(3, 2, '2024-10-01', 'Present'),
(4, 2, '2024-10-02', 'Absent'),
(5, 3, '2024-10-01', 'Present'),
(6, 3, '2024-10-02', 'Leave'),
(7, 4, '2024-10-01', 'Present'),
(8, 4, '2024-10-02', 'Present'),
(9, 5, '2024-10-01', 'Present'),
(10, 5, '2024-10-02', 'Leave');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `assigned_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `task_id`, `employee_id`, `document_name`, `document_path`, `uploaded_at`, `status`, `assigned_by`) VALUES
(1, NULL, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-15 16:39:24', 'Pending', NULL),
(2, NULL, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-16 07:32:24', 'Pending', NULL),
(3, 7, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-16 07:36:58', 'Pending', NULL),
(4, 7, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-16 07:56:38', 'Pending', NULL),
(5, NULL, 7, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-16 08:09:20', 'Completed', NULL),
(6, 7, 7, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-16 08:39:36', 'Completed', NULL),
(7, 1, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-20 03:39:36', 'Pending', NULL),
(8, 1, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-20 03:42:53', 'Pending', NULL),
(9, 1, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-20 03:43:45', 'Pending', NULL),
(10, 1, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-23 13:10:53', 'Pending', NULL),
(11, 1, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-23 13:16:26', 'Pending', NULL),
(12, 1, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-23 13:21:26', 'Pending', NULL),
(13, 7, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-23 13:42:04', 'Pending', NULL),
(14, NULL, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-24 06:03:33', 'Pending', NULL),
(15, 7, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-24 06:17:45', 'Pending', NULL),
(16, 7, 1, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-24 06:23:07', 'Pending', NULL),
(17, 4, 4, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-24 06:24:31', 'Completed', NULL),
(18, 7, 4, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-24 07:13:38', 'Completed', NULL),
(19, 1, 4, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-24 08:32:40', 'In Progress', NULL),
(20, 7, 4, 'Bogala Graphite Test document.docx', 'uploads/Bogala Graphite Test document.docx', '2024-10-24 10:12:50', 'Completed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `department`, `role`) VALUES
(1, 'Amila Perera', 'Finance', 'Accountant'),
(2, 'Kamal Fernando', 'IT', 'Software Engineer'),
(3, 'Nuwan Herath', 'Marketing', 'Marketing Manager'),
(4, 'Chathura De Silva', 'HR', 'HR Manager'),
(5, 'Saman Kumara', 'Operations', 'Operations Manager'),
(6, 'Rashmi Wickramasinghe', 'IT', 'System Administrator'),
(7, 'Nadeesha Jayasinghe', 'Customer Service', 'Customer Support Specialist'),
(8, 'Shanika Senanayake', 'Sales', 'Sales Executive'),
(9, 'Suresh Rathnayake', 'Engineering', 'Mechanical Engineer'),
(10, 'Thilini Weerasinghe', 'Safety and Compliance', 'Safety Officer'),
(11, 'Pradeep Wijesinghe', 'Quality Control', 'Quality Assurance Specialist'),
(12, 'Dilini Rajapaksa', 'Operations', 'Logistics Coordinator'),
(13, 'Ashan Wickremasinghe', 'Engineering', 'Process Engineer'),
(14, 'Sanduni Pathirana', 'Customer Service', 'Customer Relations Manager'),
(15, 'Madhura Peris', 'Finance', 'Financial Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `employee_id`, `start_date`, `end_date`, `reason`, `status`) VALUES
(1, 3, '2024-12-01', '2024-12-05', 'Vacation with family', 'Approved'),
(2, 5, '2024-11-10', '2024-11-12', 'Medical leave', 'Pending'),
(3, 2, '2024-10-15', '2024-10-16', 'Personal reasons', 'Rejected'),
(4, 1, '2024-12-20', '2024-12-25', 'Annual leave', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `sent_at`) VALUES
(4, 4, 5, 'The server maintenance has been scheduled for this weekend.', '2024-10-09 16:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('Unread','Read') DEFAULT 'Unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `document_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `status`, `created_at`, `document_id`, `is_read`) VALUES
(1, 1, 'Your leave request has been approved.', 'Unread', '2024-10-09 16:46:48', NULL, 1),
(4, 4, 'Monthly performance review available.', 'Unread', '2024-10-09 16:46:48', NULL, 1),
(5, 5, 'Server maintenance completed successfully.', 'Read', '2024-10-09 16:46:48', NULL, 0),
(6, NULL, 'Document ID 19 has been marked as Completed.', 'Unread', '2024-10-24 08:58:27', 19, 1),
(7, NULL, 'Document has been marked as completed.', 'Unread', '2024-10-24 09:01:03', 19, 1),
(8, NULL, 'Document has been marked as completed.', 'Unread', '2024-10-24 09:01:25', 19, 1),
(9, NULL, 'Document ID 20 has been marked as completed.', 'Unread', '2024-10-24 10:19:58', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `performance_reviews`
--

CREATE TABLE `performance_reviews` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comments` text DEFAULT NULL,
  `review_date` date DEFAULT NULL,
  `reviewer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performance_reviews`
--

INSERT INTO `performance_reviews` (`id`, `employee_id`, `rating`, `comments`, `review_date`, `reviewer_id`) VALUES
(1, 1, 5, 'Excellent performance in managing the finance department.', '2024-09-30', 4),
(2, 2, 4, 'Good progress in the project, but needs to improve punctuality.', '2024-09-28', 4),
(3, 3, 3, 'Average performance with room for improvement in communication skills.', '2024-09-29', 5),
(4, 4, 5, 'Outstanding leadership and management skills.', '2024-09-27', 5);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_description` text NOT NULL,
  `maintenance_mode` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `site_name`, `site_description`, `maintenance_mode`) VALUES
(1, 'Default Site Name', 'This is a default site description.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `status` enum('Pending','Completed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `priority` enum('Low','Medium','High') DEFAULT 'Medium'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `employee_id`, `description`, `status`, `created_at`, `priority`) VALUES
(1, 2, 'Develop the new feature for the company website.', 'Pending', '2024-10-09 16:41:44', 'Medium'),
(2, 3, 'Prepare marketing campaign for the holiday season.', 'Pending', '2024-10-09 16:41:44', 'Medium'),
(3, 4, 'Organize a training session for new employees.', 'Completed', '2024-10-09 16:41:44', 'Medium'),
(4, 6, 'Upgrade company servers to the latest version.', 'Completed', '2024-10-09 16:41:44', 'Medium'),
(5, 1, 'Prepare financial report for the last quarter.', 'Pending', '2024-10-09 16:41:44', 'Medium'),
(6, 5, 'Coordinate logistics for new shipment.', 'Pending', '2024-10-09 16:41:44', 'Medium'),
(7, 1, 'test', 'Pending', '2024-10-09 16:59:12', 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `task_ratings`
--

CREATE TABLE `task_ratings` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_ratings`
--

INSERT INTO `task_ratings` (`id`, `task_id`, `rating`) VALUES
(1, 1, 4),
(2, 2, 5),
(3, 3, 3),
(4, 4, 5),
(5, 5, 4),
(6, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `time_logs`
--

CREATE TABLE `time_logs` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `clock_in` timestamp NOT NULL DEFAULT current_timestamp(),
  `clock_out` timestamp NULL DEFAULT NULL,
  `duration` time GENERATED ALWAYS AS (timediff(`clock_out`,`clock_in`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_logs`
--

INSERT INTO `time_logs` (`id`, `employee_id`, `clock_in`, `clock_out`) VALUES
(1, 1, '2024-10-09 02:30:00', '2024-10-09 11:30:00'),
(2, 2, '2024-10-09 03:00:00', '2024-10-09 11:00:00'),
(3, 3, '2024-10-09 03:30:00', '2024-10-09 11:30:00'),
(4, 4, '2024-10-09 02:30:00', '2024-10-09 10:30:00'),
(5, 5, '2024-10-09 02:45:00', '2024-10-09 11:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Manager','Employee') DEFAULT 'Employee',
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `deleted`) VALUES
(1, 'admin', '$2y$10$QzN8UOzzB0.xxJ9LgNfg5uisspQvgQthKrJTC0K8/0cJRI9ufB/jW', 'Admin', 0),
(4, 'cdsilva', '$2y$10$QzN8UOzzB0.xxJ9LgNfg5uisspQvgQthKrJTC0K8/0cJRI9ufB/jW', 'Manager', 0),
(5, 'rkumar', '$2y$10$CZ6zFQI54yCBJZYyoUPhnOjY6q4h5AOBb9q3zj8AGtS8MI6bcJbZm', 'Manager', 0),
(6, 'rwickramasinghe', '$2y$10$CZ6zFQI54yCBJZYyoUPhnOjY6q4h5AOBb9q3zj8AGtS8MI6bcJbZm', 'Employee', 0),
(7, 'njayasinghe', '$2y$10$QzN8UOzzB0.xxJ9LgNfg5uisspQvgQthKrJTC0K8/0cJRI9ufB/jW', 'Employee', 0),
(8, 'ssenanayake', '$2y$10$CZ6zFQI54yCBJZYyoUPhnOjY6q4h5AOBb9q3zj8AGtS8MI6bcJbZm', 'Employee', 0),
(9, 'srathnayake', '$2y$10$CZ6zFQI54yCBJZYyoUPhnOjY6q4h5AOBb9q3zj8AGtS8MI6bcJbZm', 'Employee', 0),
(10, 'tweerasinghe', '$2y$10$CZ6zFQI54yCBJZYyoUPhnOjY6q4h5AOBb9q3zj8AGtS8MI6bcJbZm', 'Employee', 0),
(11, 'pwijesinghe', '$2y$10$CZ6zFQI54yCBJZYyoUPhnOjY6q4h5AOBb9q3zj8AGtS8MI6bcJbZm', 'Employee', 0),
(12, 'drajapaksa', '$2y$10$CZ6zFQI54yCBJZYyoUPhnOjY6q4h5AOBb9q3zj8AGtS8MI6bcJbZm', 'Employee', 0),
(13, 'awickremasinghe', '$2y$10$CZ6zFQI54yCBJZYyoUPhnOjY6q4h5AOBb9q3zj8AGtS8MI6bcJbZm', 'Employee', 0),
(14, 'spathirana', '$2y$10$CZ6zFQI54yCBJZYyoUPhnOjY6q4h5AOBb9q3zj8AGtS8MI6bcJbZm', 'Employee', 0),
(15, 'mperis', '$2y$10$CZ6zFQI54yCBJZYyoUPhnOjY6q4h5AOBb9q3zj8AGtS8MI6bcJbZm', 'Employee', 0),
(16, 'aperera', '$2y$10$QzN8UOzzB0.xxJ9LgNfg5uisspQvgQthKrJTC0K8/0cJRI9ufB/jW', 'Employee', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_type` varchar(255) NOT NULL,
  `activity_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `user_id`, `activity_type`, `activity_time`) VALUES
(1, 4, 'Login', '2024-10-14 19:09:28'),
(2, 1, 'Login', '2024-10-14 19:09:41'),
(3, 1, 'Login', '2024-10-15 21:04:42'),
(4, 1, 'Login', '2024-10-15 21:05:33'),
(5, 1, 'Login', '2024-10-15 21:44:31'),
(6, 16, 'Login', '2024-10-15 21:50:02'),
(7, 1, 'Login', '2024-10-15 21:51:36'),
(8, 16, 'Login', '2024-10-15 22:14:20'),
(9, 1, 'Login', '2024-10-16 08:55:28'),
(10, 16, 'Login', '2024-10-16 09:03:39'),
(11, 1, 'Login', '2024-10-16 11:51:36'),
(12, 1, 'Login', '2024-10-16 11:52:10'),
(13, 16, 'Login', '2024-10-16 13:22:09'),
(14, 1, 'Login', '2024-10-16 13:26:27'),
(15, 16, 'Login', '2024-10-16 13:26:58'),
(16, 7, 'Login', '2024-10-16 13:32:35'),
(17, 1, 'Login', '2024-10-16 13:39:04'),
(18, 7, 'Login', '2024-10-16 13:39:35'),
(19, 1, 'Login', '2024-10-16 14:09:18'),
(20, 7, 'Login', '2024-10-16 14:09:58'),
(21, 1, 'Login', '2024-10-16 14:12:00'),
(22, 1, 'Login', '2024-10-20 08:48:19'),
(23, 16, 'Login', '2024-10-20 08:50:21'),
(24, 1, 'Login', '2024-10-20 09:08:32'),
(25, 16, 'Login', '2024-10-20 09:09:53'),
(26, 1, 'Login', '2024-10-20 09:12:42'),
(27, 16, 'Login', '2024-10-20 09:13:10'),
(28, 1, 'Login', '2024-10-20 09:13:34'),
(29, 1, 'Login', '2024-10-20 09:23:00'),
(30, 16, 'Login', '2024-10-20 09:23:55'),
(31, 1, 'Login', '2024-10-20 09:25:14'),
(32, 1, 'Login', '2024-10-23 18:26:25'),
(33, 16, 'Login', '2024-10-23 18:26:42'),
(34, 1, 'Login', '2024-10-23 18:33:39'),
(35, 1, 'Login', '2024-10-23 18:36:05'),
(36, 16, 'Login', '2024-10-23 18:41:20'),
(37, 1, 'Login', '2024-10-23 18:46:19'),
(38, 16, 'Login', '2024-10-23 18:46:43'),
(39, 1, 'Login', '2024-10-23 18:51:19'),
(40, 16, 'Login', '2024-10-23 18:51:46'),
(41, 1, 'Login', '2024-10-23 19:00:14'),
(42, 16, 'Login', '2024-10-23 19:00:24'),
(43, 1, 'Login', '2024-10-23 19:06:04'),
(44, 1, 'Login', '2024-10-23 19:08:41'),
(45, 16, 'Login', '2024-10-23 19:09:49'),
(46, 1, 'Login', '2024-10-23 19:11:52'),
(47, 1, 'Login', '2024-10-24 11:21:12'),
(48, 1, 'Login', '2024-10-24 11:23:27'),
(49, 16, 'Login', '2024-10-24 11:24:05'),
(50, 1, 'Login', '2024-10-24 11:33:13'),
(51, 16, 'Login', '2024-10-24 11:33:46'),
(52, 1, 'Login', '2024-10-24 11:47:32'),
(53, 16, 'Login', '2024-10-24 11:47:58'),
(54, 1, 'Login', '2024-10-24 11:52:57'),
(55, 16, 'Login', '2024-10-24 11:53:27'),
(56, 1, 'Login', '2024-10-24 11:54:00'),
(57, 4, 'Login', '2024-10-24 11:54:43'),
(58, 1, 'Login', '2024-10-24 12:22:10'),
(59, 4, 'Login', '2024-10-24 12:43:55'),
(60, 4, 'Login', '2024-10-24 12:46:10'),
(61, 1, 'Login', '2024-10-24 12:50:19'),
(62, 4, 'Login', '2024-10-24 13:44:06'),
(63, 4, 'Login', '2024-10-24 13:49:06'),
(64, 4, 'Login', '2024-10-24 13:52:21'),
(65, 4, 'Login', '2024-10-24 14:02:09'),
(66, 1, 'Login', '2024-10-24 14:02:28'),
(67, 4, 'Login', '2024-10-24 14:02:57'),
(68, 4, 'Login', '2024-10-24 14:09:34'),
(69, 1, 'Login', '2024-10-24 14:28:43'),
(70, 4, 'Login', '2024-10-24 14:31:15'),
(71, 1, 'Login', '2024-10-24 14:31:39'),
(72, 4, 'Login', '2024-10-24 15:16:41'),
(73, 4, 'Login', '2024-10-24 15:20:41'),
(74, 4, 'Login', '2024-10-24 15:22:57'),
(75, 1, 'Login', '2024-10-24 15:23:23'),
(76, 4, 'Login', '2024-10-24 15:43:08'),
(77, 1, 'Login', '2024-10-24 15:50:31'),
(78, 4, 'Login', '2024-10-24 16:12:50'),
(79, 1, 'Login', '2024-10-24 16:13:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `performance_reviews`
--
ALTER TABLE `performance_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `reviewer_id` (`reviewer_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `task_ratings`
--
ALTER TABLE `task_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `performance_reviews`
--
ALTER TABLE `performance_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task_ratings`
--
ALTER TABLE `task_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `time_logs`
--
ALTER TABLE `time_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `performance_reviews`
--
ALTER TABLE `performance_reviews`
  ADD CONSTRAINT `performance_reviews_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `performance_reviews_ibfk_2` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task_ratings`
--
ALTER TABLE `task_ratings`
  ADD CONSTRAINT `task_ratings_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD CONSTRAINT `time_logs_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"graphite-management\",\"table\":\"documents\"},{\"db\":\"graphite-management\",\"table\":\"notifications\"},{\"db\":\"graphite-management\",\"table\":\"users\"},{\"db\":\"graphite-management\",\"table\":\"employees\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-10-24 10:13:44', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
