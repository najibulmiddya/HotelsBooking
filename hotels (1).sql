-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 05:06 PM
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
-- Database: `hotels`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`, `update_at`) VALUES
(2, 'najibul', '1234', '2024-09-26 01:01:12', '0000-00-00 00:00:00'),
(3, 'admin', 'admin', '2024-12-02 16:26:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_no` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_pay` decimal(10,2) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(20) NOT NULL,
  `adderss` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `booking_id`, `room_name`, `room_id`, `room_no`, `price`, `total_pay`, `user_name`, `phonenum`, `adderss`) VALUES
(1, 17, 'Demo Room', 38, NULL, '1200.00', '1200.00', 'Najibul Middya', '629525744', 'Dhuliadihi,Kalpathar'),
(2, 18, 'Simpel Room Name', 31, NULL, '500.00', '4400.00', 'Najibul Middya', '629525744', 'Dhuliadihi,Kalpathar');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` varchar(30) NOT NULL,
  `check_out` varchar(30) NOT NULL,
  `arraval` varchar(50) DEFAULT '0',
  `refund` decimal(10,2) DEFAULT NULL,
  `booking_status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `order_id` varchar(100) NOT NULL,
  `trans_id` varchar(100) DEFAULT NULL,
  `trans_amt` decimal(10,2) NOT NULL,
  `trans_status` enum('TXN_SUCCESS','TXN_FAILURE','PENDING') DEFAULT 'PENDING',
  `trans_respmgs` text DEFAULT NULL,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `room_id`, `check_in`, `check_out`, `arraval`, `refund`, `booking_status`, `order_id`, `trans_id`, `trans_amt`, `trans_status`, `trans_respmgs`, `datetime`) VALUES
(17, 14, 38, '30-06-2025', '01-07-2025', '0', NULL, 'pending', 'ORD_1471886293', NULL, '0.00', 'PENDING', NULL, '2025-06-30 15:16:04'),
(18, 14, 31, '30-06-2025', '11-07-2025', '0', NULL, 'pending', 'ORD_147576778', NULL, '0.00', 'PENDING', NULL, '2025-06-30 15:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `carousel_image`
--

CREATE TABLE `carousel_image` (
  `id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel_image`
--

INSERT INTO `carousel_image` (`id`, `image`, `created_at`, `updated_at`) VALUES
(5, '9145_IMG1.png', '2024-10-09 22:48:27', '0000-00-00 00:00:00'),
(6, '3115_IMG2.png', '2024-10-09 22:48:38', '0000-00-00 00:00:00'),
(7, '2685_IMG3.png', '2024-10-09 22:48:48', '0000-00-00 00:00:00'),
(8, '6089_IMG4.png', '2024-10-09 22:49:02', '0000-00-00 00:00:00'),
(9, '5297_IMG5.png', '2024-10-09 22:49:11', '0000-00-00 00:00:00'),
(10, '2827_IMG6.png', '2024-10-09 22:49:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` int(11) NOT NULL,
  `address` varchar(60) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `ph1` varchar(20) NOT NULL,
  `ph2` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `address`, `gmap`, `ph1`, `ph2`, `email`, `tw`, `fb`, `insta`, `iframe`, `create_at`, `update_at`) VALUES
(1, 'Bankura,West Bengal', 'https://www.google.com/maps/place/Bankura,+West+Bengal/@23.267697,87.022209,11z/data=!4m6!3m5!1s0x39', '+917778889990', '+917778889880', 'demo@gamil.com', 'https://x.com/', 'https://www.facebook.com/najibulmiddya11', 'https://www.instagram.com/najibul_middya/?hl=en', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58662.08905837483!2d87.02184589501707!3d23.229234556431216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f7a58c5fc2b411:0xfdbd0b45c0b4aa70!2sBankura, West Bengal!5e0!3m2!1sen!2sin!4v1726938786713!5m2!1sen!2sin', '2024-09-30 11:31:26', '2024-10-07 11:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `facility_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `facility_name`, `description`, `icon`) VALUES
(16, 'Wifi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\r\nLabore recusandae tempora soluta illum, error sit necessitatibus!', '2251_wifi.svg'),
(17, 'Bus', 'demLorem ipsum dolor sit amet consectetur adipisicing elit.\r\n Labore recusandae tempora soluta illum, error sit necessitatibus!o desc', '9115_IMG_96423.svg'),
(18, 'demo 3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\r\nLabore recusandae tempora soluta illum, error sit necessitatibus!', '7704_IMG_49949.svg'),
(19, 'demo 4', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\r\nLabore recusandae tempora soluta illum, error sit necessitatibus!', '9326_IMG_47816.svg'),
(20, 'demo 5', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\r\n Labore recusandae tempora soluta illum, error sit necessitatibus!', '8841_IMG_41622.svg'),
(21, 'demo 6', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\r\nLabore recusandae tempora soluta illum, error sit necessitatibus!', '2611_IMG_27079.svg');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `feature_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature_name`, `created_at`, `update_at`) VALUES
(53, '2 Sofa', '2024-11-19 19:51:41', '0000-00-00 00:00:00'),
(54, 'Kitchen', '2024-11-19 19:52:29', '0000-00-00 00:00:00'),
(57, 'Bathroom', '2024-11-23 20:46:57', '0000-00-00 00:00:00'),
(58, 'Balcony', '2024-11-23 20:47:07', '0000-00-00 00:00:00'),
(59, 'TV', '2024-11-25 21:54:50', '0000-00-00 00:00:00'),
(60, 'Air Conditioning', '2024-11-25 21:55:12', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(60) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(15) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `create_at`) VALUES
(31, 'Simpel Room Name', 21, 500, 5, 5, 5, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, iste rerum et quos quae fugiat ducimus ullam facilis, assumenda totam deleniti. Possimus hic aliquam praesentium itaque. Quae repellat assumenda iusto dignissimos possimus est eos consectetur ex ut. Maxime rem perferendis aspernatur, corporis assumenda, eveniet id doloribus odio quia repudiandae neque!', 1, '2024-11-23 23:11:51'),
(37, 'Demo', 8, 800, 98, 87, 8, 'demo description', 1, '2024-11-30 23:14:54'),
(38, 'Demo Room', 5, 1200, 2, 3, 2, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Libero, dolore, possimus quisquam architecto ducimus ratione corporis asperiores omnis quasi perferendis quis totam veritatis. Ipsa necessitatibus asperiores officiis, tempore, quibusdam quisquam amet, voluptas ducimus quam consequatur quos reiciendis iste a eum recusandae doloremque eligendi placeat eaque voluptatum voluptate debitis eius sed?', 1, '2025-06-01 14:41:06'),
(39, 'Test Room', 5, 500, 1, 1, 2, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Libero, dolore, possimus quisquam architecto ducimus ratione corporis asperiores omnis quasi perferendis quis totam veritatis. Ipsa necessitatibus asperiores officiis, tempore, quibusdam quisquam amet, voluptas ducimus quam consequatur quos reiciendis iste a eum recusandae doloremque eligendi placeat eaque voluptatum voluptate debitis eius sed?', 1, '2025-06-01 14:48:52'),
(40, 'Tset Room 2', 5, 800, 2, 2, 3, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Libero, dolore, possimus quisquam architecto ducimus ratione corporis asperiores omnis quasi perferendis quis totam veritatis. Ipsa necessitatibus asperiores officiis, tempore, quibusdam quisquam amet, voluptas ducimus quam consequatur quos reiciendis iste a eum recusandae doloremque eligendi placeat eaque voluptatum voluptate debitis eius sed?', 1, '2025-06-01 14:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_facilities`
--

CREATE TABLE `rooms_facilities` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms_facilities`
--

INSERT INTO `rooms_facilities` (`id`, `room_id`, `facilities_id`, `created_at`) VALUES
(270, 31, 16, '2025-06-01 14:47:27'),
(271, 31, 17, '2025-06-01 14:47:27'),
(272, 31, 18, '2025-06-01 14:47:27'),
(273, 31, 19, '2025-06-01 14:47:27'),
(274, 31, 20, '2025-06-01 14:47:27'),
(275, 31, 21, '2025-06-01 14:47:27'),
(276, 39, 16, '2025-06-01 14:48:52'),
(277, 39, 18, '2025-06-01 14:48:52'),
(278, 39, 19, '2025-06-01 14:48:52'),
(279, 39, 20, '2025-06-01 14:48:52'),
(280, 39, 21, '2025-06-01 14:48:52'),
(281, 40, 16, '2025-06-01 14:49:56'),
(282, 40, 17, '2025-06-01 14:49:56'),
(315, 37, 16, '2025-06-01 21:31:04'),
(316, 37, 17, '2025-06-01 21:31:04'),
(317, 37, 18, '2025-06-01 21:31:04'),
(318, 37, 19, '2025-06-01 21:31:04'),
(319, 37, 20, '2025-06-01 21:31:04'),
(320, 37, 21, '2025-06-01 21:31:04'),
(321, 38, 16, '2025-06-01 21:31:10'),
(322, 38, 17, '2025-06-01 21:31:10'),
(323, 38, 18, '2025-06-01 21:31:10'),
(324, 38, 19, '2025-06-01 21:31:10'),
(325, 38, 20, '2025-06-01 21:31:10'),
(326, 38, 21, '2025-06-01 21:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_features`
--

CREATE TABLE `rooms_features` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms_features`
--

INSERT INTO `rooms_features` (`id`, `room_id`, `features_id`, `created_at`) VALUES
(201, 31, 53, '2025-06-01 14:47:27'),
(202, 31, 54, '2025-06-01 14:47:27'),
(203, 31, 57, '2025-06-01 14:47:27'),
(204, 31, 58, '2025-06-01 14:47:27'),
(205, 31, 59, '2025-06-01 14:47:27'),
(206, 31, 60, '2025-06-01 14:47:27'),
(207, 39, 53, '2025-06-01 14:48:52'),
(208, 39, 54, '2025-06-01 14:48:52'),
(209, 39, 57, '2025-06-01 14:48:52'),
(210, 39, 58, '2025-06-01 14:48:52'),
(211, 39, 59, '2025-06-01 14:48:52'),
(212, 39, 60, '2025-06-01 14:48:52'),
(213, 40, 53, '2025-06-01 14:49:56'),
(214, 40, 54, '2025-06-01 14:49:56'),
(215, 40, 59, '2025-06-01 14:49:56'),
(216, 40, 60, '2025-06-01 14:49:56'),
(253, 37, 53, '2025-06-01 21:31:04'),
(254, 37, 54, '2025-06-01 21:31:04'),
(255, 37, 57, '2025-06-01 21:31:04'),
(256, 37, 58, '2025-06-01 21:31:04'),
(257, 37, 59, '2025-06-01 21:31:04'),
(258, 37, 60, '2025-06-01 21:31:04'),
(259, 38, 53, '2025-06-01 21:31:10'),
(260, 38, 54, '2025-06-01 21:31:10'),
(261, 38, 57, '2025-06-01 21:31:10'),
(262, 38, 58, '2025-06-01 21:31:10'),
(263, 38, 59, '2025-06-01 21:31:10'),
(264, 38, 60, '2025-06-01 21:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_images`
--

CREATE TABLE `rooms_images` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms_images`
--

INSERT INTO `rooms_images` (`id`, `room_id`, `image`, `thumb`, `created_at`) VALUES
(15, 31, '1441_IMG_67761.png', 0, '2025-06-01 14:21:07'),
(16, 31, '2939_IMG_78809.png', 0, '2025-06-01 14:28:38'),
(17, 38, '4565_3.png', 1, '2025-06-01 14:41:43'),
(18, 38, '8356_IMG_42663.png', 0, '2025-06-01 14:41:53'),
(19, 37, '7599_IMG_65019.png', 1, '2025-06-01 14:42:21'),
(20, 37, '5588_IMG_70583.png', 0, '2025-06-01 14:42:32'),
(21, 31, '8312_Simpel_Room_2.png', 1, '2025-06-01 14:43:03'),
(22, 38, '1647_Simpel_Room_1.jpg', 0, '2025-06-01 14:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(100) NOT NULL,
  `site_about` varchar(300) NOT NULL,
  `shutdown` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `site_about`, `shutdown`, `created_at`, `update_at`) VALUES
(1, 'Hotals', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur cupiditate accusantium, magni quisquam harum reiciendis placeat optio animi aliquid quidem, maiores, nulla fugit officiis voluptate ea similique sint ipsa eveniet.', 0, '2024-09-26 22:55:05', '2025-06-28 22:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_fee` decimal(10,2) NOT NULL,
  `course_start_date` date NOT NULL,
  `course_end_date` date NOT NULL,
  `reference_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `course_id`, `course_fee`, `course_start_date`, `course_end_date`, `reference_code`) VALUES
(3, 'Demo', 3, '452665.50', '2025-02-01', '2025-03-03', ''),
(8, 'Test', 3, '4526.50', '2025-02-11', '2025-03-13', '1235DR'),
(23, 'Test h', 2, '555.50', '2024-12-31', '2025-01-30', '1235DR');

-- --------------------------------------------------------

--
-- Table structure for table `students_course`
--

CREATE TABLE `students_course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_course`
--

INSERT INTO `students_course` (`id`, `course_name`, `created_at`, `updated_at`) VALUES
(2, 'BSc Agriculture', '2024-12-28 10:49:28', '2024-12-28 10:59:50'),
(3, 'BSc Computer Science', '2024-12-28 10:49:28', '2024-12-28 11:00:08'),
(4, 'BBA', '2024-12-28 10:49:28', '2024-12-28 17:59:44'),
(5, 'Interior Designing', '2024-12-28 10:49:28', '2024-12-28 11:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `teams_details`
--

CREATE TABLE `teams_details` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams_details`
--

INSERT INTO `teams_details` (`id`, `name`, `picture`, `created_at`, `update_at`) VALUES
(27, 'Demo', '655333281_about.jpg', '2024-10-07 11:47:35', '0000-00-00 00:00:00'),
(28, 'Demo 2', '879788177_team1.jpg', '2024-10-07 11:47:51', '0000-00-00 00:00:00'),
(29, 'Demo 3', '130771208_teams.jpg', '2024-10-07 11:48:13', '0000-00-00 00:00:00'),
(30, 'Demo 4', '730932396_team3.jpg', '2024-10-07 11:48:40', '0000-00-00 00:00:00'),
(31, 'Demo 5', '985561219_IMG_16569.jpeg', '2024-10-07 11:49:01', '0000-00-00 00:00:00'),
(32, 'Demo 6', '473803716_team1.jpg', '2024-10-07 11:49:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `number` int(14) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` int(8) NOT NULL,
  `dob` varchar(8) NOT NULL,
  `profile` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `verify_token` varchar(100) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_created_at` datetime DEFAULT NULL,
  `email_token_created_at` datetime DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `address`, `pincode`, `dob`, `profile`, `password`, `status`, `is_verified`, `verify_token`, `reset_token`, `reset_token_created_at`, `email_token_created_at`, `create_at`) VALUES
(14, 'Najibul Middya', 'najibulmiddya11@gmail.com', 629525744, 'Dhuliadihi,Kalpathar', 722146, '1999-12-', '5918_NajibulMiddya.jpg', '$2y$10$YAZbD4jFfjFF/Sl2kzO2We5gCZueaSkbgcktIl6ECwE7JGBm9Ok72', 1, 1, NULL, NULL, NULL, NULL, '2025-06-23 11:11:42'),
(18, 'Sarfraj Alam Middya', 'sarfarajalam1420@gmail.com', 850902899, 'Vill-Dhuliadihi,Kalpathar', 722146, '2025-06-', '', '$2y$10$HYoShlFb1kJoBr/vya7l0ugoouxxEIbaA9tOm2DLp2A.XiUt8yIcG', 1, 0, '0e9abd5778535829d38fc63b48d32274', NULL, NULL, '2025-06-28 06:54:13', '2025-06-28 06:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `users_query`
--

CREATE TABLE `users_query` (
  `id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `subjact` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL,
  `seen` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_query`
--

INSERT INTO `users_query` (`id`, `user_name`, `user_email`, `subjact`, `message`, `seen`, `created_at`, `updated_at`) VALUES
(46, 'test', 'test@yopmail.com', 'Test', 'test messgae', 1, '2025-06-20 20:12:59', '2025-06-26 12:11:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `carousel_image`
--
ALTER TABLE `carousel_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms_facilities`
--
ALTER TABLE `rooms_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `rooms_features`
--
ALTER TABLE `rooms_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room id` (`room_id`),
  ADD KEY `features id` (`features_id`);

--
-- Indexes for table `rooms_images`
--
ALTER TABLE `rooms_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `students_course`
--
ALTER TABLE `students_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams_details`
--
ALTER TABLE `teams_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_query`
--
ALTER TABLE `users_query`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `carousel_image`
--
ALTER TABLE `carousel_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `rooms_facilities`
--
ALTER TABLE `rooms_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT for table `rooms_features`
--
ALTER TABLE `rooms_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `rooms_images`
--
ALTER TABLE `rooms_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `students_course`
--
ALTER TABLE `students_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teams_details`
--
ALTER TABLE `teams_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users_query`
--
ALTER TABLE `users_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD CONSTRAINT `booking_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`);

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booking_order_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `rooms_facilities`
--
ALTER TABLE `rooms_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `rooms_features`
--
ALTER TABLE `rooms_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `rooms_images`
--
ALTER TABLE `rooms_images`
  ADD CONSTRAINT `rooms_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `students_course` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
