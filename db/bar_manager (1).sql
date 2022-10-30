-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 30, 2022 at 07:25 PM
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
-- Table structure for table `tbl_car_washers`
--

CREATE TABLE `tbl_car_washers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `bio` mediumtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_car_washers`
--

INSERT INTO `tbl_car_washers` (`id`, `firstname`, `lastname`, `nickname`, `phone_number`, `bio`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 'Naki', 'Tan', 'Nacktan', '0245152323', '', '2022-10-23 12:13:53', 'Manuel Tetteh', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pricing`
--

CREATE TABLE `tbl_pricing` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `vehicle_type_id` int(11) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pricing`
--

INSERT INTO `tbl_pricing` (`id`, `service_id`, `vehicle_type_id`, `price`, `description`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, '2022-10-28 22:54:31', 'manuel', NULL, NULL),
(2, 2, 1, NULL, NULL, '2022-10-28 22:55:00', 'manuel', NULL, NULL),
(3, 3, 1, NULL, NULL, '2022-10-28 22:55:22', 'manuel', NULL, NULL),
(4, 1, 2, NULL, NULL, '2022-10-28 22:58:15', 'manuel', NULL, NULL),
(5, 2, 2, NULL, NULL, '2022-10-28 22:58:15', 'manuel', NULL, NULL),
(6, 3, 2, NULL, NULL, '2022-10-28 22:58:15', 'manuel', NULL, NULL),
(7, 4, 1, NULL, NULL, '2022-10-28 22:59:02', 'manuel', NULL, NULL),
(8, 4, 2, NULL, NULL, '2022-10-28 22:59:02', 'manuel', NULL, NULL),
(9, 1, 3, '30', '', '2022-10-28 22:59:36', 'manuel', 'manuel', '2022-10-29 13:16:10'),
(10, 2, 3, '40', '', '2022-10-28 22:59:36', 'manuel', 'manuel', '2022-10-29 13:16:23'),
(11, 3, 3, '25', '', '2022-10-28 22:59:36', 'manuel', 'manuel', '2022-10-29 13:16:35'),
(12, 4, 3, '35', '', '2022-10-28 22:59:36', 'manuel', 'manuel', '2022-10-29 13:16:46');

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
(1, 'malt', NULL, '6', '12', '72', NULL, 12, 'Active', NULL, NULL, NULL, 'Manuel Tetteh', '2022-10-21 15:21:06', NULL, '2022-10-21 15:21:06'),
(2, 'club', NULL, '10', '12', '120', NULL, 12, 'Active', NULL, 1, 'ProductPhoto373-2022-10-27-12-43-23.jpeg', 'Manuel Tetteh', '2022-10-21 15:21:24', 'Manuel Tetteh', '2022-10-27 12:43:23'),
(3, 'origin', NULL, '9', '12', '108', NULL, 12, 'Active', NULL, 1, 'ProductPhoto838-2022-10-27-12-07-14.jpg', 'Manuel Tetteh', '2022-10-21 15:21:46', 'Manuel Tetteh', '2022-10-27 12:07:14'),
(4, 'guiness', NULL, '9', '24', '216', NULL, 12, 'Active', NULL, NULL, NULL, 'Manuel Tetteh', '2022-10-21 15:23:01', NULL, '2022-10-21 15:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_retail`
--

CREATE TABLE `tbl_retail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price_per_piece` varchar(50) DEFAULT NULL,
  `stock_before` varchar(255) DEFAULT NULL,
  `stock_after` varchar(255) DEFAULT NULL,
  `no_of_crates` varchar(255) DEFAULT NULL,
  `no_of_pieces` varchar(255) DEFAULT NULL,
  `total_quantity` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_retail`
--

INSERT INTO `tbl_retail` (`id`, `product_id`, `price_per_piece`, `stock_before`, `stock_after`, `no_of_crates`, `no_of_pieces`, `total_quantity`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, '6', '17', '16', '1', '4', '16', '96', '2022-10-21 15:28:22', NULL),
(2, 4, '9', '15', '14', '0', '14', '14', '126', '2022-10-21 15:29:49', NULL),
(3, 2, '10', '16', '15', '1', '3', '15', '150', '2022-10-21 15:30:30', NULL),
(4, 3, '9', '16', '18', '1', '6', '18', '162', '2022-10-21 15:31:28', '2022-10-27 09:52:58');

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
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sales`
--

INSERT INTO `tbl_sales` (`id`, `product_id`, `original_stock`, `stock_before`, `stock_after`, `quantity_sold`, `expected_price`, `collected_by`, `collected_at`, `remarks`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, NULL, '17', '16', '1', '6', NULL, '2022-10-21 16:23:48', NULL, 'Manuel Tetteh', '2022-10-21 16:23:48', NULL, '2022-10-21 16:23:48'),
(2, 2, NULL, '20', '19', '1', '10', NULL, '2022-10-21 16:24:03', NULL, 'Manuel Tetteh', '2022-10-21 16:24:03', NULL, '2022-10-21 16:24:03'),
(3, 3, NULL, '16', '15', '1', '9', NULL, '2022-10-21 16:24:10', NULL, 'Manuel Tetteh', '2022-10-21 16:24:10', NULL, '2022-10-21 16:24:10'),
(4, 4, NULL, '15', '14', '1', '9', NULL, '2022-10-21 16:24:16', NULL, 'Manuel Tetteh', '2022-10-21 16:24:16', NULL, '2022-10-21 16:24:16'),
(5, 2, NULL, '19', '16', '3', '30', NULL, '2022-10-26 23:31:01', NULL, 'Manuel Tetteh', '2022-10-26 23:31:01', NULL, '2022-10-26 23:31:01'),
(6, 3, NULL, '15', '13', '2', '18', NULL, '2022-10-26 23:32:59', NULL, 'Manuel Tetteh', '2022-10-26 23:32:59', NULL, '2022-10-26 23:32:59'),
(7, 2, NULL, '16', '15', '1', '10', NULL, '2022-10-27 11:42:19', NULL, 'Manuel Tetteh', '2022-10-27 11:42:19', NULL, '2022-10-27 11:42:19');

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
  `updated_at` varchar(200) DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sales_audit`
--

INSERT INTO `tbl_sales_audit` (`id`, `user_id`, `product_id`, `starting_stock`, `starting_stock_price`, `ending_stock`, `ending_stock_price`, `expected_amount`, `sales_date`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-21', 'Manuel Tetteh', '2022-10-21 16:29:45', NULL, '2022-10-21 16:29:45'),
(2, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-21', 'Manuel Tetteh', '2022-10-21 16:29:45', NULL, '2022-10-21 16:29:45'),
(3, 1, 2, '19', NULL, NULL, NULL, NULL, '2022-10-21', 'Manuel Tetteh', '2022-10-21 16:29:45', NULL, '2022-10-21 16:29:45'),
(4, 1, 3, '15', NULL, NULL, NULL, NULL, '2022-10-21', 'Manuel Tetteh', '2022-10-21 16:29:45', NULL, '2022-10-21 16:29:45'),
(5, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 12:09:26', NULL, '2022-10-23 12:09:26'),
(6, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 12:09:26', NULL, '2022-10-23 12:09:26'),
(7, 1, 2, '19', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 12:09:26', NULL, '2022-10-23 12:09:26'),
(8, 1, 3, '15', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 12:09:26', NULL, '2022-10-23 12:09:26'),
(9, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 15:05:07', NULL, '2022-10-23 15:05:07'),
(10, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 15:05:07', NULL, '2022-10-23 15:05:07'),
(11, 1, 2, '19', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 15:05:07', NULL, '2022-10-23 15:05:07'),
(12, 1, 3, '15', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 15:05:07', NULL, '2022-10-23 15:05:07'),
(13, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 17:24:08', NULL, '2022-10-23 17:24:08'),
(14, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 17:24:08', NULL, '2022-10-23 17:24:08'),
(15, 1, 2, '19', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 17:24:08', NULL, '2022-10-23 17:24:08'),
(16, 1, 3, '15', NULL, NULL, NULL, NULL, '2022-10-23', 'Manuel Tetteh', '2022-10-23 17:24:08', NULL, '2022-10-23 17:24:08'),
(17, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-25', 'Manuel Tetteh', '2022-10-25 20:50:46', NULL, '2022-10-25 20:50:46'),
(18, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-25', 'Manuel Tetteh', '2022-10-25 20:50:46', NULL, '2022-10-25 20:50:46'),
(19, 1, 2, '19', NULL, NULL, NULL, NULL, '2022-10-25', 'Manuel Tetteh', '2022-10-25 20:50:46', NULL, '2022-10-25 20:50:46'),
(20, 1, 3, '15', NULL, NULL, NULL, NULL, '2022-10-25', 'Manuel Tetteh', '2022-10-25 20:50:46', NULL, '2022-10-25 20:50:46'),
(21, 1, 1, '16', NULL, '16', NULL, '0', '2022-10-26', 'Manuel Tetteh', '2022-10-26 21:05:08', NULL, '2022-10-26 21:05:08'),
(22, 1, 4, '14', NULL, '14', NULL, '0', '2022-10-26', 'Manuel Tetteh', '2022-10-26 21:05:08', NULL, '2022-10-26 21:05:08'),
(23, 1, 2, '19', NULL, '16', NULL, '30', '2022-10-26', 'Manuel Tetteh', '2022-10-26 21:05:08', NULL, '2022-10-26 21:05:08'),
(24, 1, 3, '15', NULL, '16', NULL, '-9', '2022-10-26', 'Manuel Tetteh', '2022-10-26 21:05:08', NULL, '2022-10-26 21:05:08'),
(25, 10, 1, '16', NULL, '16', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 21:41:27', NULL, '2022-10-26 21:41:27'),
(26, 10, 4, '14', NULL, '14', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 21:41:27', NULL, '2022-10-26 21:41:27'),
(27, 10, 2, '19', NULL, '19', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 21:41:27', NULL, '2022-10-26 21:41:27'),
(28, 10, 3, '15', NULL, '15', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 21:41:27', NULL, '2022-10-26 21:41:27'),
(29, 10, 1, '16', NULL, '16', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 21:43:13', NULL, '2022-10-26 21:43:13'),
(30, 10, 4, '14', NULL, '14', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 21:43:13', NULL, '2022-10-26 21:43:13'),
(31, 10, 2, '19', NULL, '19', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 21:43:13', NULL, '2022-10-26 21:43:13'),
(32, 10, 3, '15', NULL, '15', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 21:43:13', NULL, '2022-10-26 21:43:13'),
(33, 10, 1, '16', NULL, '16', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 22:58:47', NULL, '2022-10-26 22:58:47'),
(34, 10, 4, '14', NULL, '14', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 22:58:47', NULL, '2022-10-26 22:58:47'),
(35, 10, 2, '19', NULL, '19', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 22:58:47', NULL, '2022-10-26 22:58:47'),
(36, 10, 3, '15', NULL, '15', NULL, '0', '2022-10-26', 'tt amenu', '2022-10-26 22:58:47', NULL, '2022-10-26 22:58:47'),
(37, 10, 1, '16', NULL, NULL, NULL, NULL, '2022-10-26', 'tt amenu', '2022-10-26 23:09:19', NULL, '2022-10-26 23:09:19'),
(38, 10, 4, '14', NULL, NULL, NULL, NULL, '2022-10-26', 'tt amenu', '2022-10-26 23:09:19', NULL, '2022-10-26 23:09:19'),
(39, 10, 2, '19', NULL, NULL, NULL, NULL, '2022-10-26', 'tt amenu', '2022-10-26 23:09:19', NULL, '2022-10-26 23:09:19'),
(40, 10, 3, '15', NULL, NULL, NULL, NULL, '2022-10-26', 'tt amenu', '2022-10-26 23:09:19', NULL, '2022-10-26 23:09:19'),
(41, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 01:08:29', NULL, '2022-10-27 01:08:29'),
(42, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 01:08:29', NULL, '2022-10-27 01:08:29'),
(43, 1, 2, '16', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 01:08:29', NULL, '2022-10-27 01:08:29'),
(44, 1, 3, '16', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 01:08:29', NULL, '2022-10-27 01:08:29'),
(45, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 09:25:16', NULL, '2022-10-27 09:25:16'),
(46, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 09:25:16', NULL, '2022-10-27 09:25:16'),
(47, 1, 2, '16', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 09:25:16', NULL, '2022-10-27 09:25:16'),
(48, 1, 3, '16', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 09:25:16', NULL, '2022-10-27 09:25:16'),
(49, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 23:35:48', NULL, '2022-10-27 23:35:48'),
(50, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 23:35:48', NULL, '2022-10-27 23:35:48'),
(51, 1, 2, '15', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 23:35:48', NULL, '2022-10-27 23:35:48'),
(52, 1, 3, '18', NULL, NULL, NULL, NULL, '2022-10-27', 'Manuel Tetteh', '2022-10-27 23:35:48', NULL, '2022-10-27 23:35:48'),
(53, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-28', 'Manuel Tetteh', '2022-10-28 22:16:49', NULL, '2022-10-28 22:16:49'),
(54, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-28', 'Manuel Tetteh', '2022-10-28 22:16:49', NULL, '2022-10-28 22:16:49'),
(55, 1, 2, '15', NULL, NULL, NULL, NULL, '2022-10-28', 'Manuel Tetteh', '2022-10-28 22:16:49', NULL, '2022-10-28 22:16:49'),
(56, 1, 3, '18', NULL, NULL, NULL, NULL, '2022-10-28', 'Manuel Tetteh', '2022-10-28 22:16:49', NULL, '2022-10-28 22:16:49'),
(57, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 11:47:34', NULL, '2022-10-29 11:47:34'),
(58, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 11:47:34', NULL, '2022-10-29 11:47:34'),
(59, 1, 2, '15', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 11:47:34', NULL, '2022-10-29 11:47:34'),
(60, 1, 3, '18', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 11:47:34', NULL, '2022-10-29 11:47:34'),
(61, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 19:31:06', NULL, '2022-10-29 19:31:06'),
(62, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 19:31:06', NULL, '2022-10-29 19:31:06'),
(63, 1, 2, '15', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 19:31:06', NULL, '2022-10-29 19:31:06'),
(64, 1, 3, '18', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 19:31:06', NULL, '2022-10-29 19:31:06'),
(65, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 23:27:05', NULL, '2022-10-29 23:27:05'),
(66, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 23:27:05', NULL, '2022-10-29 23:27:05'),
(67, 1, 2, '15', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 23:27:05', NULL, '2022-10-29 23:27:05'),
(68, 1, 3, '18', NULL, NULL, NULL, NULL, '2022-10-29', 'Manuel Tetteh', '2022-10-29 23:27:05', NULL, '2022-10-29 23:27:05'),
(69, 1, 1, '16', NULL, NULL, NULL, NULL, '2022-10-30', 'Manuel Tetteh', '2022-10-30 17:34:45', NULL, '2022-10-30 17:34:45'),
(70, 1, 4, '14', NULL, NULL, NULL, NULL, '2022-10-30', 'Manuel Tetteh', '2022-10-30 17:34:45', NULL, '2022-10-30 17:34:45'),
(71, 1, 2, '15', NULL, NULL, NULL, NULL, '2022-10-30', 'Manuel Tetteh', '2022-10-30 17:34:45', NULL, '2022-10-30 17:34:45'),
(72, 1, 3, '18', NULL, NULL, NULL, NULL, '2022-10-30', 'Manuel Tetteh', '2022-10-30 17:34:45', NULL, '2022-10-30 17:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `washer_percentage` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `name`, `washer_percentage`, `description`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 'Body', '20', '', '2022-10-28 22:54:31', 'manuel', NULL, NULL),
(2, 'Engine', '30', '', '2022-10-28 22:55:00', 'manuel', NULL, NULL),
(3, 'Under', '25', '', '2022-10-28 22:55:22', 'manuel', NULL, NULL),
(4, 'Inside', '40', '', '2022-10-28 22:59:02', 'manuel', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `date_employed` varchar(255) DEFAULT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  `registered_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `phone_number`, `role`, `date_employed`, `date_registered`, `registered_by`, `updated_by`, `updated_at`) VALUES
(1, 'Manuel', 'Tetteh', 'man@gmail.com', 'manuel', '$2y$10$hgAOCdQmyltoQdhw0f9F8uxuOq7BOjLVw2xPI/xO5dFgd6jSLxK7S', '0245121212', 'Super Admin', '08/02/2022', '2022-08-13 12:59:42', 'Manuel Tetteh', NULL, NULL),
(2, 'Alfred', 'Akorli', 'af@gmail.com', 'akorli', '$2y$10$0efR/sQ7FLidqmituGY3VelOHaH5X4L9VdySSq3GJDdjLuc/N4/fS', '024545454', 'Retailer', '08/02/2022', '2022-08-13 14:45:12', 'Manuel Tetteh', NULL, NULL),
(3, 'Tetteh', 'Angmler', 'tangmler@gmail.com', 'tetteh', '$2y$10$B/sC7X9vvLGehMXvgRnKL.46KZLZSjrjctUdKs4difrAFY7JHWzF6', '021324541', 'Super Admin', '08/02/2022', '2022-08-24 15:32:33', 'Manuel Tetteh', 'Manuel Tetteh', '2022-09-22 00:29:35'),
(4, 'Ishmael', 'Tetteh', 'is@gmail.com', NULL, '$2y$10$eZdKRJjCNcIKD.qtuKRUkOtLWbWq1OPPw0R.ugSFkEVD5DTJ8Jyry', '0222145445', 'Retailer', '08/02/2022', '2022-08-24 16:24:32', 'Manuel Tetteh', NULL, NULL),
(6, 'Eve', 'Lartey', 'eve@gmail.com', 'lartey', '$2y$10$QCu6T74OTFnsXQgfyDt6duudX/duJoWTjgVKGVZwZxhgxJhPD1GRG', '054212121', 'Retailer', NULL, '2022-09-17 18:23:13', 'Manuel Tetteh', 'Manuel Tetteh', '2022-09-22 00:28:12'),
(7, 'Eric', 'Lartey', 'eric@gmail.com', NULL, '$2y$10$hOQYx6bKrWNwhPogVjVzUOElGWBH0zxtGS1ObGm2fq3kbcW65DIKe', '0245454545', 'Retailer', '09/12/2022', '2022-09-18 18:54:39', 'Manuel Tetteh', NULL, NULL),
(9, 'Frankie', 'Ranky', 'mranky@gmail.com', 'ranky', '$2y$10$2N/9DssiAg3TaV9AGzNne.vFAPgZa3th.x4V5..qpg7jX8EGUYRi6', '0222145445', 'Super Admin', NULL, '2022-09-21 23:43:43', 'Manuel Tetteh', 'Manuel Tetteh', '2022-09-22 00:14:34'),
(10, 'tt', 'amenu', 'tt@gmail.com', 'tt', '$2y$10$AHkB9Y8ZHBWisZHNh/VIuOfBxhoEpWHgZQVHHCmSFbIkBY4DeIRzu', '0245121212', 'Retailer', NULL, '2022-10-04 21:07:53', 'Manuel Tetteh', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicles`
--

CREATE TABLE `tbl_vehicles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `vehicle_type` int(11) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicles`
--

INSERT INTO `tbl_vehicles` (`id`, `name`, `vehicle_type`, `description`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 'Corolla', 1, 'Hey there', '2022-10-23 12:11:06', 'Manuel Tetteh', NULL, NULL),
(2, 'Elantra', 1, '', '2022-10-23 12:11:27', 'Manuel Tetteh', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_type`
--

CREATE TABLE `tbl_vehicle_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicle_type`
--

INSERT INTO `tbl_vehicle_type` (`id`, `name`, `description`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 'Saloon', '', '2022-10-28 22:53:53', 'manuel', NULL, NULL),
(2, '4X4', '', '2022-10-28 22:58:15', 'manuel', NULL, NULL),
(3, 'Sprinter', '', '2022-10-28 22:59:36', 'manuel', NULL, NULL);

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
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`id`, `product_id`, `quantity_per_crate`, `no_of_crates`, `no_of_pieces`, `price_per_crate`, `price_per_piece`, `total_items`, `total_price`, `stock_date`, `description`, `created_by`, `created_at`, `updated_reason`, `updated_by`, `updated_at`) VALUES
(1, 3, '12', '1', '11', '108', '9', '23', '207', '2022-10-21', NULL, 'Manuel Tetteh', '2022-10-21 15:25:14', NULL, NULL, NULL),
(2, 2, '12', '1', '9', '120', '10', '21', '210', '2022-10-21', NULL, 'Manuel Tetteh', '2022-10-21 15:25:25', NULL, 'Manuel Tetteh', '2022-10-27 09:52:13'),
(3, 4, '24', '0', '13', '216', '9', '13', '117', '2022-10-21', NULL, 'Manuel Tetteh', '2022-10-21 15:25:46', NULL, NULL, NULL),
(4, 1, '12', '1', '0', '72', '6', '12', '72', '2022-10-21', NULL, 'Manuel Tetteh', '2022-10-21 15:25:55', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouse_logs`
--

CREATE TABLE `tbl_warehouse_logs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price_per_piece` varchar(20) DEFAULT NULL,
  `original_stock` varchar(20) DEFAULT NULL,
  `quantity_transfered_in_crates` varchar(50) DEFAULT NULL,
  `quantity_transfered_in_pieces` varchar(20) DEFAULT NULL,
  `total_quantity_transfered` varchar(200) DEFAULT NULL,
  `stock_before` varchar(20) DEFAULT NULL,
  `stock_after` varchar(20) DEFAULT NULL,
  `expected_price` varchar(20) DEFAULT NULL,
  `collected_by` varchar(100) DEFAULT NULL,
  `collected_at` varchar(100) DEFAULT NULL,
  `remarks` longtext DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_warehouse_logs`
--

INSERT INTO `tbl_warehouse_logs` (`id`, `product_id`, `price_per_piece`, `original_stock`, `quantity_transfered_in_crates`, `quantity_transfered_in_pieces`, `total_quantity_transfered`, `stock_before`, `stock_after`, `expected_price`, `collected_by`, `collected_at`, `remarks`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, '6', '29', '1', '5', '17', '29', '12', '102', 'Alfred Akorli', '2022-10-21', NULL, 'Manuel Tetteh', '2022-10-21 15:28:22', NULL, '2022-10-21 15:28:22'),
(2, 4, '9', '28', '0', '15', '15', '28', '13', '135', 'Ishmael Tetteh', '2022-10-21', NULL, 'Manuel Tetteh', '2022-10-21 15:29:49', NULL, '2022-10-21 15:29:49'),
(3, 2, '10', '33', '1', '8', '20', '33', '13', '200', 'Manuel Tetteh', '2022-10-21', NULL, 'Manuel Tetteh', '2022-10-21 15:30:30', NULL, '2022-10-21 15:30:30'),
(4, 3, '9', '44', '1', '4', '16', '44', '28', '144', 'Alfred Akorli', '2022-10-21', NULL, 'Manuel Tetteh', '2022-10-21 15:31:28', NULL, '2022-10-21 15:31:28'),
(5, 3, '9', '28', '0', '3', '3', '28', '25', '27', 'Alfred Akorli', '2022-10-26', NULL, 'Manuel Tetteh', '2022-10-26 23:46:38', NULL, '2022-10-26 23:46:38'),
(6, 3, '9', '25', '0', '2', '2', '25', '23', '18', 'Alfred Akorli', '2022-10-06', NULL, 'Manuel Tetteh', '2022-10-27 09:52:58', NULL, '2022-10-27 09:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_washer_debts`
--

CREATE TABLE `tbl_washer_debts` (
  `id` int(11) NOT NULL,
  `washer_id` int(11) DEFAULT NULL,
  `debt_amount` varchar(200) DEFAULT NULL,
  `amount_paid` int(11) DEFAULT NULL,
  `amount_left` varchar(100) DEFAULT NULL,
  `payment_status` varchar(100) DEFAULT NULL,
  `paid_to` varchar(100) DEFAULT NULL,
  `paid_on` varchar(100) DEFAULT NULL,
  `remark` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_washer_debts`
--

INSERT INTO `tbl_washer_debts` (`id`, `washer_id`, `debt_amount`, `amount_paid`, `amount_left`, `payment_status`, `paid_to`, `paid_on`, `remark`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 1, '30', 20, '10', 'Partly Paid', NULL, '2022-10-12', 'Still owing 10', '2022-10-25 23:18:34', NULL, 'manuel', '2022-10-26 00:37:12'),
(2, 1, '50', 20, '30', 'Partly Paid', NULL, '2022-10-14', '', '2022-10-29 00:07:10', NULL, 'manuel', '2022-10-29 00:21:50'),
(3, 1, '20', NULL, '20', 'Not Paid', NULL, NULL, '', '2022-10-29 00:07:54', NULL, NULL, NULL),
(4, 1, '15', 15, '0', 'Fully Paid', NULL, '2022-10-19', '', '2022-10-29 00:11:16', NULL, 'manuel', '2022-10-29 00:20:13'),
(5, 1, '15', 7, '8', 'Partly Paid', 'tetteh', '2022-10-06', '', '2022-10-29 00:22:35', NULL, 'manuel', '2022-10-29 01:24:51'),
(6, 1, '45', 40, '5', 'Partly Paid', 'akorli', '2022-10-07', '', '2022-10-29 01:10:14', NULL, 'manuel', '2022-10-29 01:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_washing_transactions`
--

CREATE TABLE `tbl_washing_transactions` (
  `id` int(11) NOT NULL,
  `vehicle_type_id` int(11) DEFAULT NULL,
  `service_ids` varchar(200) DEFAULT NULL,
  `washer_id` int(11) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `washer_commission` varchar(100) DEFAULT NULL,
  `supervisor` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_washing_transactions`
--

INSERT INTO `tbl_washing_transactions` (`id`, `vehicle_type_id`, `service_ids`, `washer_id`, `amount`, `washer_commission`, `supervisor`, `description`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 3, '[\"1\",\"2\"]', 1, '70.00', '18.00', 'Akorli', '', '2022-10-29 23:47:53', 'Manuel Tetteh', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_car_washers`
--
ALTER TABLE `tbl_car_washers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pricing`
--
ALTER TABLE `tbl_pricing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pricing_service` (`service_id`),
  ADD KEY `FK_pricing_vehicle` (`vehicle_type_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_retail`
--
ALTER TABLE `tbl_retail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_retail_product` (`product_id`);

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
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_vehicle_vehicle_type` (`vehicle_type`);

--
-- Indexes for table `tbl_vehicle_type`
--
ALTER TABLE `tbl_vehicle_type`
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
-- Indexes for table `tbl_washer_debts`
--
ALTER TABLE `tbl_washer_debts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_washer_debt` (`washer_id`);

--
-- Indexes for table `tbl_washing_transactions`
--
ALTER TABLE `tbl_washing_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_washer_transaction` (`washer_id`),
  ADD KEY `FK_vehicle_transaction` (`vehicle_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_car_washers`
--
ALTER TABLE `tbl_car_washers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pricing`
--
ALTER TABLE `tbl_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_retail`
--
ALTER TABLE `tbl_retail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_sales_audit`
--
ALTER TABLE `tbl_sales_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_vehicle_type`
--
ALTER TABLE `tbl_vehicle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_warehouse_logs`
--
ALTER TABLE `tbl_warehouse_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_washer_debts`
--
ALTER TABLE `tbl_washer_debts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_washing_transactions`
--
ALTER TABLE `tbl_washing_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pricing`
--
ALTER TABLE `tbl_pricing`
  ADD CONSTRAINT `FK_pricing_service` FOREIGN KEY (`service_id`) REFERENCES `tbl_services` (`id`),
  ADD CONSTRAINT `FK_pricing_vehicle` FOREIGN KEY (`vehicle_type_id`) REFERENCES `tbl_vehicle_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_retail`
--
ALTER TABLE `tbl_retail`
  ADD CONSTRAINT `FK_retail_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  ADD CONSTRAINT `FK_vehicle_vehicle_type` FOREIGN KEY (`vehicle_type`) REFERENCES `tbl_vehicle_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_washer_debts`
--
ALTER TABLE `tbl_washer_debts`
  ADD CONSTRAINT `FK_washer_debt` FOREIGN KEY (`washer_id`) REFERENCES `tbl_car_washers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_washing_transactions`
--
ALTER TABLE `tbl_washing_transactions`
  ADD CONSTRAINT `FK_vehicle_transaction` FOREIGN KEY (`vehicle_type_id`) REFERENCES `tbl_vehicle_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_washer_transaction` FOREIGN KEY (`washer_id`) REFERENCES `tbl_car_washers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
