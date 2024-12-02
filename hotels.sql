-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 11:46 AM
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
(2, 'najibul', '1234', '2024-09-26 01:01:12', '0000-00-00 00:00:00');

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
(16, 'Wifi', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                            Labore recusandae tempora soluta illum, error sit necessitatibus!', '2251_wifi.svg'),
(17, 'Bus', 'demLorem ipsum dolor sit amet consectetur adipisicing elit.\n                            Labore recusandae tempora soluta illum, error sit necessitatibus!o desc', '9115_IMG_96423.svg'),
(18, 'demo 3', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                            Labore recusandae tempora soluta illum, error sit necessitatibus!', '7704_IMG_49949.svg'),
(19, 'demo 4', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                            Labore recusandae tempora soluta illum, error sit necessitatibus!', '9326_IMG_47816.svg'),
(20, 'demo 5', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                            Labore recusandae tempora soluta illum, error sit necessitatibus!', '8841_IMG_41622.svg'),
(21, 'demo 6', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                            Labore recusandae tempora soluta illum, error sit necessitatibus!', '9177_IMG_27079.svg');

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
  `description` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `create_at`) VALUES
(31, 'Simpel Room Name', 21, 500, 5, 5, 5, 'demo\r\n', 1, '2024-11-23 23:11:51'),
(32, 'Simpel Room', 25, 600, 3, 4, 1, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa natus consequuntur sapiente soluta, ', 0, '2024-11-25 20:06:04'),
(33, 'Test', 32, 500000000, 50, 8, 6, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque eum adipisci est assumenda elige', 0, '2024-11-25 21:40:46'),
(34, 'bnm', 95, 6, 95, 9, 9, 'hk', 1, '2024-11-30 23:11:17'),
(37, 'uy', 8, 8, 98, 87, 8, 'jk', 0, '2024-11-30 23:14:54');

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
(162, 32, 16, '2024-11-25 20:06:04'),
(163, 33, 16, '2024-11-25 21:40:46'),
(164, 33, 17, '2024-11-25 21:40:46'),
(165, 33, 18, '2024-11-25 21:40:46'),
(166, 33, 19, '2024-11-25 21:40:46'),
(167, 33, 20, '2024-11-25 21:40:46'),
(168, 33, 21, '2024-11-25 21:40:46'),
(193, 31, 16, '2024-11-30 22:10:08'),
(194, 31, 17, '2024-11-30 22:10:08'),
(195, 31, 18, '2024-11-30 22:10:08'),
(196, 31, 19, '2024-11-30 22:10:08'),
(197, 31, 20, '2024-11-30 22:10:08'),
(198, 31, 21, '2024-11-30 22:10:08'),
(200, 34, 18, '2024-11-30 23:11:30'),
(201, 34, 20, '2024-11-30 23:11:30'),
(202, 37, 16, '2024-11-30 23:14:54');

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
(117, 32, 57, '2024-11-25 20:06:04'),
(118, 33, 53, '2024-11-25 21:40:46'),
(119, 33, 54, '2024-11-25 21:40:46'),
(120, 33, 57, '2024-11-25 21:40:46'),
(121, 33, 58, '2024-11-25 21:40:46'),
(138, 31, 53, '2024-11-30 22:10:08'),
(139, 31, 54, '2024-11-30 22:10:08'),
(140, 31, 57, '2024-11-30 22:10:08'),
(141, 31, 58, '2024-11-30 22:10:08'),
(143, 34, 53, '2024-11-30 23:11:30'),
(144, 34, 57, '2024-11-30 23:11:30'),
(145, 37, 53, '2024-11-30 23:14:54');

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
(4, 31, '4884_IMG_42663.png', 1, '2024-11-27 22:13:30'),
(6, 31, '8870_IMG_70583.png', 0, '2024-11-27 22:19:07'),
(7, 31, '8005_IMG_67761.png', 0, '2024-11-27 22:22:52'),
(9, 32, '2206_IMG_78809.png', 1, '2024-11-30 19:49:22');

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
(1, 'Hotals', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur cupiditate accusantium, magni quisquam harum reiciendis placeat optio animi aliquid quidem, maiores, nulla fugit officiis voluptate ea similique sint ipsa eveniet.', 0, '2024-09-26 22:55:05', '2024-11-14 22:16:29');

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
(44, 'Sarfraj Alam Middya', 'sarfarajalam1420@gmail.com', 'test', 'd', 0, '2024-11-19 23:30:14', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `teams_details`
--
ALTER TABLE `teams_details`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `rooms_facilities`
--
ALTER TABLE `rooms_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `rooms_features`
--
ALTER TABLE `rooms_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `rooms_images`
--
ALTER TABLE `rooms_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams_details`
--
ALTER TABLE `teams_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users_query`
--
ALTER TABLE `users_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
