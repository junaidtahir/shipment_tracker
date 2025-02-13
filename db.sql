-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2025 at 05:38 PM
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
-- Database: `shipment_tracker_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$GGDo.dwUT99xiUE.dKALi.mCY/Vv9OGRr9gi/21UHniURV.mu.y.6');

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` int(11) NOT NULL,
  `tracking_id` varchar(50) NOT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `sender_phone` varchar(20) DEFAULT NULL,
  `sender_country` varchar(255) DEFAULT NULL,
  `sender_address` text DEFAULT NULL,
  `receiver_name` varchar(255) DEFAULT NULL,
  `receiver_phone` varchar(20) DEFAULT NULL,
  `receiver_country` varchar(255) DEFAULT NULL,
  `receiver_address` text DEFAULT NULL,
  `mode_of_transport` varchar(50) DEFAULT NULL,
  `sent_date` date DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `estimated_time` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'In Transit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `tracking_id`, `sender_name`, `sender_phone`, `sender_country`, `sender_address`, `receiver_name`, `receiver_phone`, `receiver_country`, `receiver_address`, `mode_of_transport`, `sent_date`, `arrival_date`, `estimated_time`, `status`) VALUES
(1, 'Vel inventore quia u', 'Mari Underwood', '+1 (835) 809-6961', 'Eligendi esse numqua', 'Voluptatem aliquid ', 'Forrest David', '+1 (334) 804-1982', 'Debitis tenetur omni', 'Est quia dolore quia', 'Sea Freight', '2005-07-27', '1988-06-02', 'Et consequuntur adip', 'In Transit'),
(3, 'Molestiae aut asperi', 'Amber Maynard', '+1 (857) 539-3632', 'Dolor ut necessitati', 'Molestiae sunt recus', 'Christine Salas', '+1 (871) 358-8596', 'Voluptatem Quia in ', 'Natus rerum sed solu', 'Sea Freight', '2001-07-21', '2010-02-09', 'Dolorem voluptas vol', 'Delivered'),
(4, '42345235', 'Lee Santana', '+1 (142) 942-1383', 'Ullamco dolore dolor', 'Enim eum sed laborio', 'Alea Beach', '+1 (719) 312-9842', 'Minim delectus hic ', 'Odit dolor nesciunt', 'Air Freight', '1978-12-12', '2009-09-08', 'Sunt voluptate omnis', 'Pending'),
(5, 'Veniam asperiores o', 'Rhoda Terry', '+1 (911) 709-1765', 'Repudiandae lorem en', 'Eius nostrud sapient', 'Cole Fernandez', '+1 (452) 376-9575', 'Corporis rerum aute ', 'Odio corrupti ea si', 'Air Freight', '1972-12-01', '1986-05-06', 'Aspernatur alias nis', 'In Transit'),
(6, 'Pariatur Ducimus n', 'Samuel Sanford', '+1 (651) 483-5977', 'Magnam in pariatur ', 'Ut rerum dolores dol', 'Keely Hess', '+1 (881) 125-2308', 'Pariatur Id enim di', 'Fugiat do ducimus m', 'Road Freight', '2019-04-28', '1979-01-28', 'Dolores anim aperiam', 'In Transit');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_locations`
--

CREATE TABLE `parcel_locations` (
  `id` int(11) NOT NULL,
  `parcel_id` int(11) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivered` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcel_locations`
--

INSERT INTO `parcel_locations` (`id`, `parcel_id`, `location`, `updated_at`, `delivered`) VALUES
(1, 1, 'Port of Vancouver USA', '2025-02-13 08:04:25', 0),
(2, 1, 'Lahore', '2025-02-13 08:14:14', 0),
(4, 1, 'vxcdvb', '2025-02-13 08:19:13', 0),
(6, 1, 'xcz\\xvc', '2025-02-13 08:19:40', 0),
(7, 3, 'Lahore', '2025-02-13 09:08:51', 0),
(8, 3, 'Karachi', '2025-02-13 09:09:03', 0),
(9, 3, 'Not Available', '2025-02-13 09:09:21', 0),
(10, 3, 'dvs', '2025-02-13 09:11:02', 0),
(11, 3, 'Not Available', '2025-02-13 09:17:37', 0),
(12, 3, '', '2025-02-13 10:43:22', 0),
(13, 4, 'zxcascv', '2025-02-13 11:32:41', 1),
(14, 4, 'asfasf', '2025-02-13 11:49:20', 1),
(15, 4, 'sacdfsa', '2025-02-13 11:50:21', 1),
(16, 4, 'xzvxzv', '2025-02-13 11:51:08', 0),
(17, 4, 'LAhore', '2025-02-13 12:05:10', 0),
(18, 5, 'Karachi', '2025-02-13 16:16:35', 1),
(19, 6, 'Karachi', '2025-02-13 16:17:40', 1),
(20, 6, 'vxcdvb', '2025-02-13 16:19:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_id` (`tracking_id`);

--
-- Indexes for table `parcel_locations`
--
ALTER TABLE `parcel_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcel_id` (`parcel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parcel_locations`
--
ALTER TABLE `parcel_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parcel_locations`
--
ALTER TABLE `parcel_locations`
  ADD CONSTRAINT `parcel_locations_ibfk_1` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
