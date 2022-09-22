-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2022 at 12:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bar_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_nomination`
--

CREATE TABLE `tbl_event_nomination` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `event_venue` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `social_links` mediumtext DEFAULT NULL,
  `number_attended` varchar(255) DEFAULT NULL,
  `photo_link1` varchar(255) DEFAULT NULL,
  `photo_link2` varchar(255) DEFAULT NULL,
  `event_description` longtext DEFAULT NULL,
  `nomination_reason` longtext DEFAULT NULL,
  `date_of_nomination` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_nomination`
--

INSERT INTO `tbl_event_nomination` (`id`, `first_name`, `last_name`, `event_name`, `category`, `event_venue`, `country`, `social_links`, `number_attended`, `photo_link1`, `photo_link2`, `event_description`, `nomination_reason`, `date_of_nomination`) VALUES
(1, NULL, NULL, 'Ataya End Of Year Party', 'Emerging Event of the year', 'Ashaiman-Lebanon', NULL, 'https://www.facebook.com/lewiskennedyapenteng', '500', NULL, NULL, 'Ataya End of Year Party is a tea festival. This event is celebrated annually. It’s designed to bring people together, connect, build relationships and have feel of as well as make known the cultured tea to the people (provides various health benefits).', 'Ataya End of Year Party should nominated because it is arguably one of kind. The message it carries, values, and vision is humbly worth a nomination. This event hopefully if nominated is an exposure for it sort will dwell on this prestigious grounds in sending its message across to the rest of the world, hence, platforms as such contributes enormously to the event’s growth.', '2022-08-12 01:25:19'),
(2, NULL, NULL, 'Ataya End Of Year Party', 'Emerging Event of the year', 'Ashaiman-Lebanon', NULL, 'https://www.facebook.com/lewiskennedyapenteng', '500', NULL, NULL, 'Ataya End of Year Party is a tea festival. This event is celebrated annually. It’s designed to bring people together, connect, build relationships and have feel of as well as make known the cultured tea to the people (provides various health benefits).', 'Ataya End of Year Party should nominated because it is arguably one of kind. The message it carries, values, and vision is humbly worth a nomination. This event hopefully if nominated is an exposure for it sort will dwell on this prestigious grounds in sending its message across to the rest of the world, hence, platforms as such contributes enormously to the event’s growth.', '2022-08-12 01:30:05'),
(3, NULL, NULL, 'BAY LIVE SESSIONS', 'Emerging Event of the year', 'PORT ELIZABETH, EASTERN CAPE. SOUTH AFRICA', NULL, 'facebook.com/BayLiveSessions', '5000', NULL, NULL, 'The BAY LIVE SESSIONS is a continuing and consistent project that has benefited the Creative Sector of the Disadvantaged Artists of Eastern Cape. This Project had previously been implemented two times creating more than 50 Jobs combined. This project is very beneficial to the creative sector of Eastern Cape as it is a catastrophe of the emerging creatives of the Province to showcase their talents. This project Creates Job Opportunities for the youth, women and people living with disabilities. It has previously benefited more than 50 creatives in the Eastern Cape', 'This Event is the new Revolution. It deserves recognition because it has set a blueprint and attracted larger crowds to an abandoned city with great talents.', '2022-08-19 01:06:00'),
(4, NULL, NULL, 'ST Gambian Dream - Album Launching', 'Best Event Company of the year', 'Bakau Independent Stadium, The Gambia', NULL, 'https://linktr.ee/matkizworldwideentertainment', '1', NULL, NULL, 'The event is an album launching of ST Gambian Dream, which h took place on the 5th of February 2022 at the independence Stadium', 'It was the best event even organized in the country.', '2022-08-23 03:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `price_per_item` varchar(255) DEFAULT NULL,
  `quantity_per_crate` varchar(100) DEFAULT NULL,
  `price_per_crate` varchar(255) DEFAULT NULL,
  `total_items` varchar(255) DEFAULT NULL,
  `stock_threshold` int(6) DEFAULT 0,
  `status` varchar(50) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `is_most_purchased` tinyint(4) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `name`, `description`, `price_per_item`, `quantity_per_crate`, `price_per_crate`, `total_items`, `stock_threshold`, `status`, `remarks`, `is_most_purchased`, `photo`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Club', NULL, '10', '12', '120', NULL, 24, 'Active', NULL, 1, 'ProductPhoto197-2022-09-17-17-38-26.jpg', 'Manuel Tetteh', '2022-09-17 17:27:53', NULL, '2022-09-17 17:38:26'),
(2, 'Origin', NULL, '9', '12', '108', NULL, 24, 'Active', NULL, 1, 'ProductPhoto938-2022-09-17-17-38-41.jpeg', 'Manuel Tetteh', '2022-09-17 17:28:14', NULL, '2022-09-17 17:38:41'),
(3, 'Guiness', NULL, '9', '24', '216', NULL, 24, 'Active', NULL, NULL, NULL, 'Manuel Tetteh', '2022-09-17 17:28:34', NULL, '2022-09-17 17:28:34'),
(4, 'Heineken', NULL, '12', '12', '144', NULL, 24, 'Active', NULL, NULL, NULL, 'Manuel Tetteh', '2022-09-17 17:29:05', NULL, '2022-09-17 17:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `original_stock` varchar(255) DEFAULT NULL,
  `stock_before` varchar(255) DEFAULT NULL,
  `stock_after` varchar(255) DEFAULT NULL,
  `quantity_sold` text DEFAULT NULL,
  `expected_price` varchar(255) DEFAULT NULL,
  `collected_by` varchar(255) DEFAULT NULL,
  `collected_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` longtext DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`id`, `product_id`, `original_stock`, `stock_before`, `stock_after`, `quantity_sold`, `expected_price`, `collected_by`, `collected_at`, `remarks`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 2, '42', '42', '39', '3', '27', NULL, '2022-09-17 17:38:50', NULL, 'Manuel Tetteh', '2022-09-17 17:38:50', NULL, '2022-09-17 17:38:50'),
(2, 3, '62', '62', '58', '4', '36', NULL, '2022-09-17 17:39:19', NULL, 'Manuel Tetteh', '2022-09-17 17:39:19', NULL, '2022-09-17 17:39:19'),
(3, 1, '30', '30', '28', '2', '20', NULL, '2022-09-17 17:39:33', NULL, 'Manuel Tetteh', '2022-09-17 17:39:33', NULL, '2022-09-17 17:39:33'),
(4, 2, '42', '39', '36', '3', '27', NULL, '2022-09-17 18:24:39', NULL, 'Eve Lartey', '2022-09-17 18:24:39', NULL, '2022-09-17 18:24:39'),
(5, 2, '42', '36', '34', '2', '18', NULL, '2022-09-17 18:25:43', NULL, 'Eve Lartey', '2022-09-17 18:25:43', NULL, '2022-09-17 18:25:43'),
(6, 1, '30', '28', '26', '2', '20', NULL, '2022-09-17 18:28:15', NULL, 'Eve Lartey', '2022-09-17 18:28:15', NULL, '2022-09-17 18:28:15'),
(7, 4, '29', '29', '27', '2', '24', NULL, '2022-09-17 18:29:29', NULL, 'Eve Lartey', '2022-09-17 18:29:29', NULL, '2022-09-17 18:29:29'),
(8, 3, '62', '58', '53', '5', '45', NULL, '2022-09-17 18:29:53', NULL, 'Eve Lartey', '2022-09-17 18:29:53', NULL, '2022-09-17 18:29:53'),
(9, 1, '30', '26', '23', '3', '30', NULL, '2022-09-17 18:30:02', NULL, 'Eve Lartey', '2022-09-17 18:30:02', NULL, '2022-09-17 18:30:02'),
(10, 4, '29', '27', '25', '2', '24', NULL, '2022-09-17 19:00:18', NULL, 'Manuel Tetteh', '2022-09-17 19:00:18', NULL, '2022-09-17 19:00:18'),
(11, 3, '62', '53', '50', '3', '27', NULL, '2022-09-17 19:02:40', NULL, 'Manuel Tetteh', '2022-09-17 19:02:40', NULL, '2022-09-17 19:02:40'),
(12, 2, '42', '34', '32', '2', '18', NULL, '2022-09-17 23:31:11', NULL, 'Ishmael Tetteh', '2022-09-17 23:31:11', NULL, '2022-09-17 23:31:11'),
(13, 2, '42', '32', '30', '2', '18', NULL, '2022-09-17 23:32:41', NULL, 'Ishmael Tetteh', '2022-09-17 23:32:41', NULL, '2022-09-17 23:32:41'),
(14, 2, '42', '30', '27', '3', '27', NULL, '2022-09-18 00:50:53', NULL, 'Ishmael Tetteh', '2022-09-18 00:50:53', NULL, '2022-09-18 00:50:53'),
(15, 3, '62', '50', '45', '5', '45', NULL, '2022-09-18 00:51:02', NULL, 'Ishmael Tetteh', '2022-09-18 00:51:02', NULL, '2022-09-18 00:51:02'),
(16, 2, '42', '27', '25', '2', '18', NULL, '2022-09-18 01:38:02', NULL, 'Ishmael Tetteh', '2022-09-18 01:38:02', NULL, '2022-09-18 01:38:02'),
(17, 1, '30', '23', '19', '4', '40', NULL, '2022-09-18 01:38:46', NULL, 'Ishmael Tetteh', '2022-09-18 01:38:46', NULL, '2022-09-18 01:38:46'),
(18, 1, '30', '19', '14', '5', '50', NULL, '2022-09-18 02:00:43', NULL, 'Ishmael Tetteh', '2022-09-18 02:00:43', NULL, '2022-09-18 02:00:43'),
(19, 3, '62', '45', '42', '3', '27', NULL, '2022-09-18 02:01:03', NULL, 'Ishmael Tetteh', '2022-09-18 02:01:03', NULL, '2022-09-18 02:01:03'),
(20, 3, '62', '42', '32', '10', '90', NULL, '2022-09-18 02:14:00', NULL, 'Ishmael Tetteh', '2022-09-18 02:14:00', NULL, '2022-09-18 02:14:00'),
(21, 2, '42', '25', '20', '5', '45', NULL, '2022-09-18 02:14:13', NULL, 'Ishmael Tetteh', '2022-09-18 02:14:13', NULL, '2022-09-18 02:14:13'),
(22, 4, '29', '25', '22', '3', '36', NULL, '2022-09-18 02:14:26', NULL, 'Ishmael Tetteh', '2022-09-18 02:14:26', NULL, '2022-09-18 02:14:26'),
(23, 1, '30', '14', '12', '2', '20', NULL, '2022-09-18 02:20:27', NULL, 'Ishmael Tetteh', '2022-09-18 02:20:27', NULL, '2022-09-18 02:20:27'),
(24, 2, '42', '20', '18', '2', '18', NULL, '2022-09-18 02:20:37', NULL, 'Ishmael Tetteh', '2022-09-18 02:20:37', NULL, '2022-09-18 02:20:37'),
(25, 3, '62', '32', '30', '2', '18', NULL, '2022-09-18 02:20:55', NULL, 'Ishmael Tetteh', '2022-09-18 02:20:55', NULL, '2022-09-18 02:20:55'),
(26, 4, '29', '22', '20', '2', '24', NULL, '2022-09-18 02:21:18', NULL, 'Ishmael Tetteh', '2022-09-18 02:21:18', NULL, '2022-09-18 02:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_audit`
--

CREATE TABLE `tbl_sales_audit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `starting_stock` varchar(20) DEFAULT NULL,
  `starting_stock_price` varchar(20) DEFAULT NULL,
  `ending_stock` varchar(20) DEFAULT NULL,
  `ending_stock_price` varchar(20) DEFAULT NULL,
  `expected_amount` varchar(20) DEFAULT NULL,
  `sales_date` varchar(20) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sales_audit`
--

INSERT INTO `tbl_sales_audit` (`id`, `user_id`, `product_id`, `starting_stock`, `starting_stock_price`, `ending_stock`, `ending_stock_price`, `expected_amount`, `sales_date`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, '12', NULL, '12', NULL, '0', '2022-09-18', NULL, '2022-09-18 01:55:50', NULL, '2022-09-18 01:55:50'),
(2, 1, 2, '18', NULL, '18', NULL, '0', '2022-09-18', NULL, '2022-09-18 01:55:50', NULL, '2022-09-18 01:55:50'),
(3, 1, 3, '30', NULL, '30', NULL, '0', '2022-09-18', NULL, '2022-09-18 01:55:50', NULL, '2022-09-18 01:55:50'),
(4, 1, 4, '20', NULL, '20', NULL, '0', '2022-09-18', NULL, '2022-09-18 01:55:50', NULL, '2022-09-18 01:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_old`
--

CREATE TABLE `tbl_sales_old` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity_before` varchar(255) DEFAULT NULL,
  `quantity_sold` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `sold_date` timestamp NULL DEFAULT current_timestamp(),
  `sold_by` varchar(255) DEFAULT NULL,
  `is_cancelled` tinyint(4) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `updated_reason` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sold_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sales_old`
--

INSERT INTO `tbl_sales_old` (`id`, `product_id`, `quantity_before`, `quantity_sold`, `amount`, `sold_date`, `sold_by`, `is_cancelled`, `remarks`, `updated_reason`, `updated_by`, `updated_at`, `sold_at`) VALUES
(1, 1, NULL, '9', '90', '2022-08-23 22:59:23', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-08-23 22:59:23', '2022-08-23 22:59:23'),
(2, 1, NULL, '3', '30', '2022-08-23 23:00:01', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-08-23 23:00:01', '2022-08-23 23:00:01'),
(3, 1, NULL, '5', '50', '2022-08-23 23:00:20', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-08-23 23:00:20', '2022-08-23 23:00:20'),
(4, 1, NULL, '15', '150', '2022-08-23 23:00:38', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-08-23 23:00:38', '2022-08-23 23:00:38'),
(5, 1, NULL, '28', '280', '2022-08-23 23:01:00', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-08-23 23:01:00', '2022-08-23 23:01:00'),
(6, 1, NULL, '5', '50', '2022-08-23 23:02:26', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-08-23 23:02:26', '2022-08-23 23:02:26'),
(7, 1, NULL, '10', '100', '2022-08-23 23:22:00', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-08-23 23:22:00', '2022-08-23 23:22:00'),
(8, 1, NULL, '5', '50', '2022-08-27 01:33:34', NULL, NULL, NULL, NULL, NULL, '2022-08-27 01:33:34', '2022-08-27 01:33:34'),
(9, 2, NULL, '2', '18', '2022-08-27 01:33:55', NULL, NULL, NULL, NULL, NULL, '2022-08-27 01:33:55', '2022-08-27 01:33:55'),
(10, 4, NULL, '4', '48', '2022-08-27 01:34:17', NULL, NULL, NULL, NULL, NULL, '2022-08-27 01:34:17', '2022-08-27 01:34:17'),
(11, 4, NULL, '4', '48', '2022-08-27 01:35:48', NULL, NULL, NULL, NULL, NULL, '2022-08-27 01:35:48', '2022-08-27 01:35:48'),
(12, 3, NULL, '4', '36', '2022-08-27 01:37:10', NULL, NULL, NULL, NULL, NULL, '2022-08-27 01:37:10', '2022-08-27 01:37:10'),
(13, 4, NULL, '8', '96', '2022-08-27 01:37:21', NULL, NULL, NULL, NULL, NULL, '2022-08-27 01:37:21', '2022-08-27 01:37:21'),
(14, 4, NULL, '5', '60', '2022-08-28 16:15:14', NULL, NULL, NULL, NULL, NULL, '2022-08-28 16:15:14', '2022-08-28 16:15:14'),
(15, 2, NULL, '3', '27', '2022-09-07 00:08:18', NULL, NULL, NULL, NULL, NULL, '2022-09-07 00:08:18', '2022-09-07 00:08:18'),
(16, 2, NULL, '3', '27', '2022-09-13 01:03:14', NULL, NULL, NULL, NULL, NULL, '2022-09-13 01:03:14', '2022-09-13 01:03:14'),
(17, 3, NULL, '2', '18', '2022-09-13 01:05:22', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-09-13 01:05:22', '2022-09-13 01:05:22'),
(18, 4, NULL, '10', '120', '2022-09-13 01:08:28', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-09-13 01:08:28', '2022-09-13 01:08:28'),
(19, 2, NULL, '6', '54', '2022-09-13 21:25:52', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-09-13 21:25:52', '2022-09-13 21:25:52'),
(20, 2, NULL, '6', '54', '2022-09-13 21:26:22', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-09-13 21:26:22', '2022-09-13 21:26:22'),
(21, 4, NULL, '2', '24', '2022-09-13 22:29:27', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-09-13 22:29:27', '2022-09-13 22:29:27'),
(22, 2, NULL, '2', '18', '2022-09-13 23:02:29', NULL, NULL, NULL, NULL, NULL, '2022-09-13 23:02:29', '2022-09-13 23:02:29'),
(23, 3, NULL, '2', '18', '2022-09-13 23:03:27', 'Manuel Tetteh', NULL, NULL, NULL, NULL, '2022-09-13 23:03:27', '2022-09-13 23:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `date_employed` varchar(255) DEFAULT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `role`, `date_employed`, `date_registered`) VALUES
(1, 'Manuel', 'Tetteh', 'man@gmail.com', '$2y$10$tGCTsh9Li2hL190Onj.HDOZwXEkUIlgepfqgSLCKMVCgfaaHpiZSG', NULL, 'Super Admin', '08/02/2022', '2022-08-13 12:59:42'),
(2, 'Alfred', 'Akorli', 'af@gmail.com', '$2y$10$0efR/sQ7FLidqmituGY3VelOHaH5X4L9VdySSq3GJDdjLuc/N4/fS', '024545454', 'Super Admin', '08/02/2022', '2022-08-13 14:45:12'),
(3, 'Tetteh', 'Angmler', 'tangmler@gmail.com', '$2y$10$B/sC7X9vvLGehMXvgRnKL.46KZLZSjrjctUdKs4difrAFY7JHWzF6', '021324541', 'Super  Admin', '08/02/2022', '2022-08-24 15:32:33'),
(4, 'Ishmael', 'Tetteh', 'is@gmail.com', '$2y$10$eZdKRJjCNcIKD.qtuKRUkOtLWbWq1OPPw0R.ugSFkEVD5DTJ8Jyry', '0222145445', 'Retailer', '08/02/2022', '2022-08-24 16:24:32'),
(6, 'Eve', 'Lartey', 'eve@gmail.com', '$2y$10$QCu6T74OTFnsXQgfyDt6duudX/duJoWTjgVKGVZwZxhgxJhPD1GRG', NULL, 'Retailer', NULL, '2022-09-17 18:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity_per_crate` varchar(50) DEFAULT NULL,
  `no_of_crates` varchar(50) DEFAULT NULL,
  `no_of_pieces` varchar(50) DEFAULT NULL,
  `price_per_crate` varchar(50) DEFAULT NULL,
  `price_per_piece` varchar(50) DEFAULT NULL,
  `total_items` varchar(50) DEFAULT NULL,
  `total_price` varchar(50) DEFAULT NULL,
  `stock_date` varchar(50) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_reason` longtext DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`id`, `product_id`, `quantity_per_crate`, `no_of_crates`, `no_of_pieces`, `price_per_crate`, `price_per_piece`, `total_items`, `total_price`, `stock_date`, `description`, `created_by`, `created_at`, `updated_reason`, `updated_by`, `updated_at`) VALUES
(1, 1, '12', '5', '8', '120', '10', '68', '680', '09/15/2022', NULL, 'Manuel Tetteh', '2022-09-17 17:29:40', NULL, NULL, '2022-09-17 17:29:40'),
(2, 2, '12', '4', '9', '108', '9', '57', '513', '09/14/2022', NULL, 'Manuel Tetteh', '2022-09-17 17:29:55', NULL, NULL, '2022-09-17 17:29:55'),
(3, 3, '24', '3', '12', '216', '9', '84', '756', '09/14/2022', NULL, 'Manuel Tetteh', '2022-09-17 17:30:16', NULL, NULL, '2022-09-17 17:30:16'),
(4, 4, '12', '5', '6', '144', '12', '66', '792', '09/14/2022', 'This is the new  Heineken brought', 'Manuel Tetteh', '2022-09-17 17:31:02', NULL, NULL, '2022-09-17 17:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouse_logs`
--

CREATE TABLE `tbl_warehouse_logs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price_per_piece` varchar(20) DEFAULT NULL,
  `original_stock` varchar(20) DEFAULT NULL,
  `quantity_transfered_in_pieces` varchar(20) DEFAULT NULL,
  `stock_before` varchar(20) DEFAULT NULL,
  `stock_after` varchar(20) DEFAULT NULL,
  `expected_price` varchar(20) DEFAULT NULL,
  `collected_by` varchar(100) DEFAULT NULL,
  `collected_at` varchar(100) DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_warehouse_logs`
--

INSERT INTO `tbl_warehouse_logs` (`id`, `product_id`, `price_per_piece`, `original_stock`, `quantity_transfered_in_pieces`, `stock_before`, `stock_after`, `expected_price`, `collected_by`, `collected_at`, `remarks`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, '10', '68', '30', '68', '38', '300', 'Alfred Akorli', '09/17/2022', NULL, 'Manuel Tetteh', '2022-09-17 17:32:07', NULL, '2022-09-17 17:32:07'),
(2, 2, '9', '57', '42', '57', '15', '378', 'Ishmael Tetteh', '09/17/2022', 'Took by Ishmael', 'Manuel Tetteh', '2022-09-17 17:33:18', NULL, '2022-09-17 17:33:18'),
(3, 3, '9', '84', '62', '84', '22', '558', 'Ishmael Tetteh', '09/17/2022', NULL, 'Manuel Tetteh', '2022-09-17 17:36:19', NULL, '2022-09-17 17:36:19'),
(4, 4, '12', '66', '29', '66', '37', '348', 'Tetteh Angmler', '09/17/2022', NULL, 'Manuel Tetteh', '2022-09-17 17:36:40', NULL, '2022-09-17 17:36:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_event_nomination`
--
ALTER TABLE `tbl_event_nomination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ProductWarehouseLog` (`product_id`);

--
-- Indexes for table `tbl_sales_audit`
--
ALTER TABLE `tbl_sales_audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_audit` (`product_id`),
  ADD KEY `FK_user_audit` (`user_id`);

--
-- Indexes for table `tbl_sales_old`
--
ALTER TABLE `tbl_sales_old`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ProductSold` (`product_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ProductWarehouse` (`product_id`);

--
-- Indexes for table `tbl_warehouse_logs`
--
ALTER TABLE `tbl_warehouse_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ProductWarehouseLog` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_event_nomination`
--
ALTER TABLE `tbl_event_nomination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_sales_audit`
--
ALTER TABLE `tbl_sales_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_sales_old`
--
ALTER TABLE `tbl_sales_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_warehouse_logs`
--
ALTER TABLE `tbl_warehouse_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
