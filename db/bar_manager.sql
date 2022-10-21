-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 21, 2022 at 02:33 AM
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
(1, 'Mankind', 'Azuma', 'Zukamane', '+233451235255', 'Hey there', '2022-10-15 22:58:59', 'Manuel Tetteh', 'Manuel Tetteh', '2022-10-15 23:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pricing`
--

CREATE TABLE `tbl_pricing` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
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

INSERT INTO `tbl_pricing` (`id`, `service_id`, `vehicle_id`, `price`, `description`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 2, 1, '25', 'First pricing', '2022-10-20 10:55:39', 'Manuel Tetteh', 'Manuel Tetteh', '2022-10-20 11:13:15'),
(2, 1, 1, '15', 'Under service', '2022-10-20 11:16:56', 'Manuel Tetteh', NULL, NULL),
(3, 3, 1, '15', 'Body service', '2022-10-20 11:17:35', 'Manuel Tetteh', NULL, NULL),
(4, 2, 2, '25', 'Urvan engine', '2022-10-20 11:34:38', 'Manuel Tetteh', 'Manuel Tetteh', '2022-10-20 14:13:27'),
(5, 1, 2, '20', 'Urvan under wash', '2022-10-20 11:35:03', 'Manuel Tetteh', 'Manuel Tetteh', '2022-10-20 14:14:14'),
(6, 3, 2, '20', '', '2022-10-20 11:35:29', 'Manuel Tetteh', NULL, NULL);

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
(1, 'Club', NULL, '10', '12', '120', NULL, 3, 'Active', NULL, 1, 'ProductPhoto960-2022-09-28-12-06-01.jpg', 'Manuel Tetteh', '2022-09-17 17:27:53', NULL, '2022-09-28 12:06:01'),
(2, 'Origin', NULL, '9', '12', '108', NULL, 3, 'Active', NULL, 1, 'ProductPhoto958-2022-10-14-00-10-14.jpg', 'Manuel Tetteh', '2022-09-17 17:28:14', NULL, '2022-10-14 00:10:15'),
(6, 'guiness caki', NULL, '8', '12', '96', NULL, 0, 'Active', NULL, NULL, NULL, 'Manuel Tetteh', '2022-09-30 23:57:40', 'Manuel Tetteh', '2022-09-30 23:58:11'),
(7, 'Malt', NULL, '6', '12', '72', NULL, 0, 'Active', NULL, NULL, NULL, 'Manuel Tetteh', '2022-09-30 23:58:51', 'Manuel Tetteh', '2022-09-30 23:59:14');

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
(1, 1, '10', '3', '2', '0', '2', '2', '20', '2022-10-16 00:28:52', '2022-10-17 22:14:34'),
(2, 2, '9', '1', '0', '0', '0', '0', '0', '2022-10-16 00:29:36', '2022-10-17 22:16:33'),
(3, 6, '8', '3', '4', '1', '8', '20', '160', '2022-10-16 21:12:41', '2022-10-17 22:41:33');

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
(1, 1, NULL, '5', '3', '2', '20', NULL, '2022-09-29 17:09:34', NULL, 'Manuel Tetteh', '2022-09-29 17:09:34', 'Manuel Tetteh', '2022-09-29 17:15:56'),
(2, 2, NULL, '5', '6', '1', '9', NULL, '2022-09-29 17:09:53', NULL, 'Manuel Tetteh', '2022-09-29 17:09:53', 'Manuel Tetteh', '2022-09-29 17:16:09'),
(3, 1, NULL, '3', '2', '1', '10', NULL, '2022-10-01 00:22:20', NULL, 'Manuel Tetteh', '2022-10-01 00:22:20', NULL, '2022-10-01 00:22:20'),
(4, 2, NULL, '6', '3', '3', '27', NULL, '2022-10-01 00:22:48', NULL, 'Manuel Tetteh', '2022-10-01 00:22:48', NULL, '2022-10-01 00:22:48'),
(5, 1, NULL, '2', '1', '1', '10', NULL, '2022-10-01 00:37:27', NULL, 'Manuel Tetteh', '2022-10-01 00:37:27', NULL, '2022-10-01 00:37:27'),
(6, 2, NULL, '3', '2', '1', '9', NULL, '2022-10-01 00:37:34', NULL, 'Manuel Tetteh', '2022-10-01 00:37:34', NULL, '2022-10-01 00:37:34'),
(7, 2, NULL, '2', '1', '1', '9', NULL, '2022-10-01 00:41:16', NULL, 'Manuel Tetteh', '2022-10-01 00:41:16', NULL, '2022-10-01 00:41:16'),
(8, 2, NULL, '1', '0', '1', '9', NULL, '2022-10-01 00:45:18', NULL, 'Manuel Tetteh', '2022-10-01 00:45:18', NULL, '2022-10-01 00:45:18'),
(9, 1, NULL, '1', '0', '1', '10', NULL, '2022-10-01 00:45:27', NULL, 'Manuel Tetteh', '2022-10-01 00:45:27', NULL, '2022-10-01 00:45:27'),
(10, 1, NULL, '2', '1', '1', '10', NULL, '2022-10-11 23:23:07', NULL, 'Manuel Tetteh', '2022-10-11 23:23:07', NULL, '2022-10-11 23:23:07'),
(11, 1, NULL, '1', '0', '1', '10', NULL, '2022-10-11 23:23:26', NULL, 'Manuel Tetteh', '2022-10-11 23:23:26', NULL, '2022-10-11 23:23:26'),
(12, 2, NULL, '2', '1', '1', '9', NULL, '2022-10-12 00:25:27', NULL, 'Manuel Tetteh', '2022-10-12 00:25:27', NULL, '2022-10-12 00:25:27'),
(13, 2, NULL, '1', '0', '1', '9', NULL, '2022-10-13 21:51:48', NULL, 'Manuel Tetteh', '2022-10-13 21:51:48', NULL, '2022-10-13 21:51:48'),
(14, 6, NULL, '12', '11', '1', '8', NULL, '2022-10-13 21:52:18', NULL, 'Eve Lartey', '2022-10-13 21:52:18', NULL, '2022-10-13 21:52:18'),
(15, 2, NULL, '2', '1', '1', '9', NULL, '2022-10-14 00:05:37', NULL, 'Manuel Tetteh', '2022-10-14 00:05:37', NULL, '2022-10-14 00:05:37'),
(16, 1, NULL, '7', '6', '1', '10', NULL, '2022-10-14 00:06:03', NULL, 'Manuel Tetteh', '2022-10-14 00:06:03', NULL, '2022-10-14 00:06:03'),
(17, 1, NULL, '6', '3', '3', '-10', NULL, '2022-10-14 00:08:28', NULL, 'Manuel Tetteh', '2022-10-14 00:08:28', 'Manuel Tetteh', '2022-10-14 00:14:58'),
(18, 1, NULL, '3', '2', '1', '10', NULL, '2022-10-14 00:10:22', NULL, 'Manuel Tetteh', '2022-10-14 00:10:22', 'Manuel Tetteh', '2022-10-14 00:15:22'),
(19, 2, NULL, '9', '8', '1', '9', NULL, '2022-10-15 15:27:39', NULL, 'Manuel Tetteh', '2022-10-16 15:27:39', NULL, '2022-10-16 15:27:39'),
(20, 1, NULL, '6', '5', '1', '10', NULL, '2022-10-16 20:12:00', NULL, 'Manuel Tetteh', '2022-10-16 20:12:00', NULL, '2022-10-16 20:12:00'),
(21, 2, NULL, '8', '7', '1', '9', NULL, '2022-10-16 21:15:04', NULL, 'Manuel Tetteh', '2022-10-16 21:15:04', NULL, '2022-10-16 21:15:04'),
(22, 2, NULL, '7', '0', '7', '63', NULL, '2022-10-16 21:39:29', NULL, 'Manuel Tetteh', '2022-10-16 21:39:29', NULL, '2022-10-16 21:39:29'),
(23, 1, NULL, '5', '0', '5', '30', NULL, '2022-10-16 21:42:05', NULL, 'Manuel Tetteh', '2022-10-16 21:42:05', 'Manuel Tetteh', '2022-10-16 21:43:21'),
(24, 1, NULL, '3', '2', '1', '10', NULL, '2022-10-20 16:54:39', NULL, 'tt amenu', '2022-10-20 16:54:39', NULL, '2022-10-20 16:54:39'),
(25, 2, NULL, '2', '1', '1', '9', NULL, '2022-10-20 23:16:18', NULL, 'Manuel Tetteh', '2022-10-20 23:16:18', NULL, '2022-10-20 23:16:18'),
(26, 2, NULL, '1', '0', '1', '9', NULL, '2022-10-20 23:16:29', NULL, 'Manuel Tetteh', '2022-10-20 23:16:29', NULL, '2022-10-20 23:16:29');

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
(1, 1, 1, '3', NULL, NULL, NULL, '0', '2022-09-30', 'Manuel Tetteh', '2022-09-30 23:44:52', NULL, '2022-09-30 23:44:52'),
(2, 1, 2, '6', NULL, NULL, NULL, '0', '2022-09-30', 'Manuel Tetteh', '2022-09-30 23:44:52', NULL, '2022-09-30 23:44:52'),
(3, 1, 1, '2', NULL, NULL, NULL, '0', '2022-10-01', 'Manuel Tetteh', '2022-10-01 00:36:35', NULL, '2022-10-01 00:36:35'),
(4, 1, 2, '3', NULL, NULL, NULL, '0', '2022-10-01', 'Manuel Tetteh', '2022-10-01 00:36:35', NULL, '2022-10-01 00:36:35'),
(5, 1, 1, '1', NULL, '1', NULL, '0', '2022-10-01', 'Manuel Tetteh', '2022-10-01 00:40:36', NULL, '2022-10-01 00:40:36'),
(6, 1, 2, '2', NULL, '1', NULL, '9', '2022-10-01', 'Manuel Tetteh', '2022-10-01 00:40:36', NULL, '2022-10-01 00:40:36'),
(7, 1, 1, '1', NULL, '0', NULL, '10', '2022-10-01', 'Manuel Tetteh', '2022-10-01 00:44:26', NULL, '2022-10-01 00:44:26'),
(8, 1, 2, '1', NULL, '0', NULL, '9', '2022-10-01', 'Manuel Tetteh', '2022-10-01 00:44:26', NULL, '2022-10-01 00:44:26'),
(9, 1, 1, '0', NULL, NULL, NULL, NULL, '2022-10-01', 'Manuel Tetteh', '2022-10-01 00:46:26', NULL, '2022-10-01 00:46:26'),
(10, 1, 2, '0', NULL, NULL, NULL, NULL, '2022-10-01', 'Manuel Tetteh', '2022-10-01 00:46:26', NULL, '2022-10-01 00:46:26'),
(11, 1, 1, '2', NULL, '2', NULL, '0', '2022-10-04', 'Manuel Tetteh', '2022-10-04 21:07:08', NULL, '2022-10-04 21:07:08'),
(12, 1, 2, '2', NULL, '2', NULL, '0', '2022-10-04', 'Manuel Tetteh', '2022-10-04 21:07:08', NULL, '2022-10-04 21:07:08'),
(13, 1, 6, '12', NULL, '12', NULL, '0', '2022-10-04', 'Manuel Tetteh', '2022-10-04 21:07:08', NULL, '2022-10-04 21:07:08'),
(14, 10, 1, '2', NULL, '2', NULL, '0', '2022-10-04', 'tt amenu', '2022-10-04 21:08:21', NULL, '2022-10-04 21:08:21'),
(15, 10, 2, '2', NULL, '2', NULL, '0', '2022-10-04', 'tt amenu', '2022-10-04 21:08:21', NULL, '2022-10-04 21:08:21'),
(16, 10, 6, '12', NULL, '12', NULL, '0', '2022-10-04', 'tt amenu', '2022-10-04 21:08:21', NULL, '2022-10-04 21:08:21'),
(17, 10, 1, '2', NULL, NULL, NULL, NULL, '2022-10-04', 'tt amenu', '2022-10-04 21:09:55', NULL, '2022-10-04 21:09:55'),
(18, 10, 2, '2', NULL, NULL, NULL, NULL, '2022-10-04', 'tt amenu', '2022-10-04 21:09:55', NULL, '2022-10-04 21:09:55'),
(19, 10, 6, '12', NULL, NULL, NULL, NULL, '2022-10-04', 'tt amenu', '2022-10-04 21:09:55', NULL, '2022-10-04 21:09:55'),
(20, 1, 1, '2', NULL, '2', NULL, '0', '2022-10-05', 'Manuel Tetteh', '2022-10-05 22:17:50', NULL, '2022-10-05 22:17:50'),
(21, 1, 2, '2', NULL, '2', NULL, '0', '2022-10-05', 'Manuel Tetteh', '2022-10-05 22:17:50', NULL, '2022-10-05 22:17:50'),
(22, 1, 6, '12', NULL, '12', NULL, '0', '2022-10-05', 'Manuel Tetteh', '2022-10-05 22:17:50', NULL, '2022-10-05 22:17:50'),
(23, 10, 1, '2', NULL, '2', NULL, '0', '2022-10-05', 'tt amenu', '2022-10-05 22:31:24', NULL, '2022-10-05 22:31:24'),
(24, 10, 2, '2', NULL, '2', NULL, '0', '2022-10-05', 'tt amenu', '2022-10-05 22:31:24', NULL, '2022-10-05 22:31:24'),
(25, 10, 6, '12', NULL, '12', NULL, '0', '2022-10-05', 'tt amenu', '2022-10-05 22:31:24', NULL, '2022-10-05 22:31:24'),
(26, 1, 1, '2', NULL, NULL, NULL, NULL, '2022-10-07', 'Manuel Tetteh', '2022-10-07 22:47:45', NULL, '2022-10-07 22:47:45'),
(27, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-07', 'Manuel Tetteh', '2022-10-07 22:47:45', NULL, '2022-10-07 22:47:45'),
(28, 1, 6, '12', NULL, NULL, NULL, NULL, '2022-10-07', 'Manuel Tetteh', '2022-10-07 22:47:45', NULL, '2022-10-07 22:47:45'),
(29, 1, 1, '2', NULL, NULL, NULL, NULL, '2022-10-10', 'Manuel Tetteh', '2022-10-10 23:27:24', NULL, '2022-10-10 23:27:24'),
(30, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-10', 'Manuel Tetteh', '2022-10-10 23:27:24', NULL, '2022-10-10 23:27:24'),
(31, 1, 6, '12', NULL, NULL, NULL, NULL, '2022-10-10', 'Manuel Tetteh', '2022-10-10 23:27:24', NULL, '2022-10-10 23:27:24'),
(32, 1, 1, '2', NULL, NULL, NULL, NULL, '2022-10-11', 'Manuel Tetteh', '2022-10-11 21:17:58', NULL, '2022-10-11 21:17:58'),
(33, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-11', 'Manuel Tetteh', '2022-10-11 21:17:58', NULL, '2022-10-11 21:17:58'),
(34, 1, 6, '12', NULL, NULL, NULL, NULL, '2022-10-11', 'Manuel Tetteh', '2022-10-11 21:17:58', NULL, '2022-10-11 21:17:58'),
(35, 1, 1, '2', NULL, NULL, NULL, NULL, '2022-10-11', 'Manuel Tetteh', '2022-10-11 23:20:09', NULL, '2022-10-11 23:20:09'),
(36, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-11', 'Manuel Tetteh', '2022-10-11 23:20:09', NULL, '2022-10-11 23:20:09'),
(37, 1, 6, '12', NULL, NULL, NULL, NULL, '2022-10-11', 'Manuel Tetteh', '2022-10-11 23:20:09', NULL, '2022-10-11 23:20:09'),
(38, 1, 1, '0', NULL, NULL, NULL, NULL, '2022-10-12', 'Manuel Tetteh', '2022-10-12 21:41:45', NULL, '2022-10-12 21:41:45'),
(39, 1, 2, '1', NULL, NULL, NULL, NULL, '2022-10-12', 'Manuel Tetteh', '2022-10-12 21:41:45', NULL, '2022-10-12 21:41:45'),
(40, 1, 6, '12', NULL, NULL, NULL, NULL, '2022-10-12', 'Manuel Tetteh', '2022-10-12 21:41:45', NULL, '2022-10-12 21:41:45'),
(41, 1, 1, '0', NULL, '0', NULL, '0', '2022-10-13', 'Manuel Tetteh', '2022-10-13 20:47:50', NULL, '2022-10-13 20:47:50'),
(42, 1, 2, '1', NULL, '1', NULL, '0', '2022-10-13', 'Manuel Tetteh', '2022-10-13 20:47:50', NULL, '2022-10-13 20:47:50'),
(43, 1, 6, '12', NULL, '12', NULL, '0', '2022-10-13', 'Manuel Tetteh', '2022-10-13 20:47:50', NULL, '2022-10-13 20:47:50'),
(44, 6, 1, '0', NULL, '0', NULL, '0', '2022-10-13', 'Eve Lartey', '2022-10-13 21:46:48', NULL, '2022-10-13 21:46:48'),
(45, 6, 2, '1', NULL, '1', NULL, '0', '2022-10-13', 'Eve Lartey', '2022-10-13 21:46:48', NULL, '2022-10-13 21:46:48'),
(46, 6, 6, '12', NULL, '12', NULL, '0', '2022-10-13', 'Eve Lartey', '2022-10-13 21:46:48', NULL, '2022-10-13 21:46:48'),
(47, 6, 1, '0', NULL, NULL, NULL, NULL, '2022-10-13', 'Eve Lartey', '2022-10-13 21:47:37', NULL, '2022-10-13 21:47:37'),
(48, 6, 2, '1', NULL, NULL, NULL, NULL, '2022-10-13', 'Eve Lartey', '2022-10-13 21:47:37', NULL, '2022-10-13 21:47:37'),
(49, 6, 6, '12', NULL, NULL, NULL, NULL, '2022-10-13', 'Eve Lartey', '2022-10-13 21:47:37', NULL, '2022-10-13 21:47:37'),
(50, 1, 1, '0', NULL, NULL, NULL, NULL, '2022-10-13', 'Manuel Tetteh', '2022-10-13 21:47:49', NULL, '2022-10-13 21:47:49'),
(51, 1, 2, '1', NULL, NULL, NULL, NULL, '2022-10-13', 'Manuel Tetteh', '2022-10-13 21:47:49', NULL, '2022-10-13 21:47:49'),
(52, 1, 6, '12', NULL, NULL, NULL, NULL, '2022-10-13', 'Manuel Tetteh', '2022-10-13 21:47:49', NULL, '2022-10-13 21:47:49'),
(53, 1, 1, '2', NULL, NULL, NULL, NULL, '2022-10-14', 'Manuel Tetteh', '2022-10-14 21:01:56', NULL, '2022-10-14 21:01:56'),
(54, 1, 2, '1', NULL, NULL, NULL, NULL, '2022-10-14', 'Manuel Tetteh', '2022-10-14 21:01:56', NULL, '2022-10-14 21:01:56'),
(55, 1, 6, '35', NULL, NULL, NULL, NULL, '2022-10-14', 'Manuel Tetteh', '2022-10-14 21:01:56', NULL, '2022-10-14 21:01:56'),
(56, 1, 1, '2', NULL, NULL, NULL, NULL, '2022-10-15', 'Manuel Tetteh', '2022-10-15 21:44:24', NULL, '2022-10-15 21:44:24'),
(57, 1, 2, '1', NULL, NULL, NULL, NULL, '2022-10-15', 'Manuel Tetteh', '2022-10-15 21:44:24', NULL, '2022-10-15 21:44:24'),
(58, 1, 6, '35', NULL, NULL, NULL, NULL, '2022-10-15', 'Manuel Tetteh', '2022-10-15 21:44:24', NULL, '2022-10-15 21:44:24'),
(59, 1, 1, '6', NULL, NULL, NULL, NULL, '2022-10-16', 'Manuel Tetteh', '2022-10-16 15:13:23', NULL, '2022-10-16 15:13:23'),
(60, 1, 2, '9', NULL, NULL, NULL, NULL, '2022-10-16', 'Manuel Tetteh', '2022-10-16 15:13:23', NULL, '2022-10-16 15:13:23'),
(61, 1, 1, '6', NULL, NULL, NULL, NULL, '2022-10-16', 'Manuel Tetteh', '2022-10-16 20:11:09', NULL, '2022-10-16 20:11:09'),
(62, 1, 2, '8', NULL, NULL, NULL, NULL, '2022-10-16', 'Manuel Tetteh', '2022-10-16 20:11:09', NULL, '2022-10-16 20:11:09'),
(63, 1, 1, '0', NULL, NULL, NULL, NULL, '2022-10-17', 'Manuel Tetteh', '2022-10-17 21:48:09', NULL, '2022-10-17 21:48:09'),
(64, 1, 2, '0', NULL, NULL, NULL, NULL, '2022-10-17', 'Manuel Tetteh', '2022-10-17 21:48:09', NULL, '2022-10-17 21:48:09'),
(65, 1, 6, '2', NULL, NULL, NULL, NULL, '2022-10-17', 'Manuel Tetteh', '2022-10-17 21:48:09', NULL, '2022-10-17 21:48:09'),
(66, 1, 1, '3', NULL, NULL, NULL, NULL, '2022-10-18', 'Manuel Tetteh', '2022-10-18 21:08:05', NULL, '2022-10-18 21:08:05'),
(67, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-18', 'Manuel Tetteh', '2022-10-18 21:08:05', NULL, '2022-10-18 21:08:05'),
(68, 1, 6, '6', NULL, NULL, NULL, NULL, '2022-10-18', 'Manuel Tetteh', '2022-10-18 21:08:05', NULL, '2022-10-18 21:08:05'),
(69, 1, 1, '3', NULL, NULL, NULL, NULL, '2022-10-19', 'Manuel Tetteh', '2022-10-19 20:30:10', NULL, '2022-10-19 20:30:10'),
(70, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-19', 'Manuel Tetteh', '2022-10-19 20:30:10', NULL, '2022-10-19 20:30:10'),
(71, 1, 6, '6', NULL, NULL, NULL, NULL, '2022-10-19', 'Manuel Tetteh', '2022-10-19 20:30:10', NULL, '2022-10-19 20:30:10'),
(72, 1, 1, '3', NULL, NULL, NULL, NULL, '2022-10-19', 'Manuel Tetteh', '2022-10-19 21:30:47', NULL, '2022-10-19 21:30:47'),
(73, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-19', 'Manuel Tetteh', '2022-10-19 21:30:47', NULL, '2022-10-19 21:30:47'),
(74, 1, 6, '6', NULL, NULL, NULL, NULL, '2022-10-19', 'Manuel Tetteh', '2022-10-19 21:30:47', NULL, '2022-10-19 21:30:47'),
(75, 1, 1, '3', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 09:42:58', NULL, '2022-10-20 09:42:58'),
(76, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 09:42:58', NULL, '2022-10-20 09:42:58'),
(77, 1, 6, '20', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 09:42:58', NULL, '2022-10-20 09:42:58'),
(78, 1, 1, '3', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 11:38:37', NULL, '2022-10-20 11:38:37'),
(79, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 11:38:37', NULL, '2022-10-20 11:38:37'),
(80, 1, 6, '20', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 11:38:37', NULL, '2022-10-20 11:38:37'),
(81, 1, 1, '3', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 12:27:24', NULL, '2022-10-20 12:27:24'),
(82, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 12:27:24', NULL, '2022-10-20 12:27:24'),
(83, 1, 6, '20', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 12:27:24', NULL, '2022-10-20 12:27:24'),
(84, 1, 1, '3', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 14:13:01', NULL, '2022-10-20 14:13:01'),
(85, 1, 2, '2', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 14:13:01', NULL, '2022-10-20 14:13:01'),
(86, 1, 6, '20', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 14:13:01', NULL, '2022-10-20 14:13:01'),
(87, 1, 1, '3', NULL, '2', NULL, '10', '2022-10-20', 'Manuel Tetteh', '2022-10-20 16:00:52', NULL, '2022-10-20 16:00:52'),
(88, 1, 2, '2', NULL, '2', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 16:00:52', NULL, '2022-10-20 16:00:52'),
(89, 1, 6, '20', NULL, '20', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 16:00:52', NULL, '2022-10-20 16:00:52'),
(90, 10, 1, '3', NULL, '3', NULL, '0', '2022-10-20', 'tt amenu', '2022-10-20 16:33:02', NULL, '2022-10-20 16:33:02'),
(91, 10, 2, '2', NULL, '2', NULL, '0', '2022-10-20', 'tt amenu', '2022-10-20 16:33:02', NULL, '2022-10-20 16:33:02'),
(92, 10, 6, '20', NULL, '20', NULL, '0', '2022-10-20', 'tt amenu', '2022-10-20 16:33:02', NULL, '2022-10-20 16:33:02'),
(93, 10, 1, '3', NULL, NULL, NULL, NULL, '2022-10-20', 'tt amenu', '2022-10-20 16:33:35', NULL, '2022-10-20 16:33:35'),
(94, 10, 2, '2', NULL, NULL, NULL, NULL, '2022-10-20', 'tt amenu', '2022-10-20 16:33:35', NULL, '2022-10-20 16:33:35'),
(95, 10, 6, '20', NULL, NULL, NULL, NULL, '2022-10-20', 'tt amenu', '2022-10-20 16:33:35', NULL, '2022-10-20 16:33:35'),
(96, 1, 1, '2', NULL, '2', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 20:07:16', NULL, '2022-10-20 20:07:16'),
(97, 1, 2, '2', NULL, '2', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 20:07:16', NULL, '2022-10-20 20:07:16'),
(98, 1, 6, '20', NULL, '20', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 20:07:16', NULL, '2022-10-20 20:07:16'),
(99, 1, 1, '2', NULL, '2', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 20:47:23', NULL, '2022-10-20 20:47:23'),
(100, 1, 2, '2', NULL, '2', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 20:47:23', NULL, '2022-10-20 20:47:23'),
(101, 1, 6, '20', NULL, '20', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 20:47:23', NULL, '2022-10-20 20:47:23'),
(102, 1, 1, '2', NULL, '2', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 23:06:49', NULL, '2022-10-20 23:06:49'),
(103, 1, 2, '2', NULL, '2', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 23:06:49', NULL, '2022-10-20 23:06:49'),
(104, 1, 6, '20', NULL, '20', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 23:06:49', NULL, '2022-10-20 23:06:49'),
(105, 1, 1, '2', NULL, '2', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 23:14:55', NULL, '2022-10-20 23:14:55'),
(106, 1, 2, '2', NULL, '0', NULL, '18', '2022-10-20', 'Manuel Tetteh', '2022-10-20 23:14:55', NULL, '2022-10-20 23:14:55'),
(107, 1, 6, '20', NULL, '20', NULL, '0', '2022-10-20', 'Manuel Tetteh', '2022-10-20 23:14:55', NULL, '2022-10-20 23:14:55'),
(108, 1, 1, '2', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 23:24:10', NULL, '2022-10-20 23:24:10'),
(109, 1, 2, '0', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 23:24:10', NULL, '2022-10-20 23:24:10'),
(110, 1, 6, '20', NULL, NULL, NULL, NULL, '2022-10-20', 'Manuel Tetteh', '2022-10-20 23:24:10', NULL, '2022-10-20 23:24:10');

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
(1, 'Under', '25', 'Car under wash', '2022-10-20 02:20:55', 'Manuel Tetteh', 'Manuel Tetteh', '2022-10-20 09:49:27'),
(2, 'Engine', '30', 'Engine wash', '2022-10-20 02:21:06', 'Manuel Tetteh', 'Manuel Tetteh', '2022-10-20 09:49:15'),
(3, 'Body', '20', 'For body wash', '2022-10-20 09:49:01', 'Manuel Tetteh', NULL, NULL);

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
(1, 'Manuel', 'Tetteh', 'man@gmail.com', 'manuel', '$2y$10$hgAOCdQmyltoQdhw0f9F8uxuOq7BOjLVw2xPI/xO5dFgd6jSLxK7S', NULL, 'Super Admin', '08/02/2022', '2022-08-13 12:59:42', 'Manuel Tetteh', NULL, NULL),
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
(1, 'Corolla', 1, 'Describe the toyota', '2022-10-20 01:48:45', 'Manuel Tetteh', 'Manuel Tetteh', '2022-10-20 02:20:41'),
(2, 'Toyota Hace', 2, 'Totoya urvan', '2022-10-20 11:34:07', 'Manuel Tetteh', NULL, NULL);

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
(1, 'Saloon', 'All small saloon cars', '2022-10-20 01:03:24', 'Manuel Tetteh', 'Manuel Tetteh', '2022-10-20 09:48:30'),
(2, 'Urvan', 'Urvan buses', '2022-10-20 01:46:35', 'Manuel Tetteh', 'Manuel Tetteh', '2022-10-20 01:47:10'),
(3, 'Sprinter', 'Sprinter big', '2022-10-20 01:46:48', 'Manuel Tetteh', 'Manuel Tetteh', '2022-10-20 01:47:27');

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
(1, 2, '12', '0', '5', '108', '9', '5', '45', '2022-09-29', NULL, 'Manuel Tetteh', '2022-09-29 15:56:17', NULL, 'Manuel Tetteh', '2022-10-16 00:28:20'),
(2, 1, '12', '0', '6', '120', '10', '6', '60', '2022-09-29', NULL, 'Manuel Tetteh', '2022-09-29 15:56:39', NULL, 'Manuel Tetteh', '2022-10-16 20:50:34'),
(3, 6, '12', '0', '10', '96', '8', '10', '80', '2022-10-01', NULL, 'Manuel Tetteh', '2022-10-01 01:22:49', NULL, 'Manuel Tetteh', '2022-10-16 20:52:44');

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
(1, 1, '10', '14', '0', '6', '6', '9', '8', '60', 'Manuel Tetteh', '2022-10-16', NULL, 'Manuel Tetteh', '2022-10-16 00:28:52', NULL, '2022-10-16 00:30:11'),
(2, 2, '9', '16', '0', '9', '9', '3', '7', '81', 'Alfred Akorli', '2022-10-16', NULL, 'Manuel Tetteh', '2022-10-16 00:29:36', NULL, '2022-10-16 00:31:28'),
(3, 6, '8', '30', '0', '2', '2', '30', '28', '16', 'Ishmael Tetteh', '2022-10-16', NULL, 'Manuel Tetteh', '2022-10-16 21:12:41', NULL, '2022-10-16 21:12:41'),
(4, 6, '8', '28', '0', '1', '1', '28', '27', '8', 'Eric Lartey', '2022-10-17', NULL, 'Manuel Tetteh', '2022-10-17 21:52:35', NULL, '2022-10-17 21:52:35'),
(5, 1, '10', '9', '0', '1', '1', '9', '8', '10', 'Eric Lartey', '2022-10-17', NULL, 'Manuel Tetteh', '2022-10-17 21:52:54', NULL, '2022-10-17 21:52:54'),
(6, 1, '10', '8', '0', '2', '2', '8', '6', '20', 'Frankie Ranky', '2022-10-17', NULL, 'Manuel Tetteh', '2022-10-17 22:14:34', NULL, '2022-10-17 22:14:34'),
(7, 2, '9', '7', '0', '2', '2', '7', '5', '18', 'Alfred Akorli', '2022-10-17', NULL, 'Manuel Tetteh', '2022-10-17 22:16:33', NULL, '2022-10-17 22:16:33'),
(8, 6, '8', '27', '1', '5', '17', '22', '10', '136', 'Ishmael Tetteh', '2022-10-17', NULL, 'Manuel Tetteh', '2022-10-17 22:41:33', NULL, '2022-10-19 23:32:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_washing_transactions`
--

CREATE TABLE `tbl_washing_transactions` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
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

INSERT INTO `tbl_washing_transactions` (`id`, `vehicle_id`, `service_ids`, `washer_id`, `amount`, `washer_commission`, `supervisor`, `description`, `created_at`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, 1, '[\"1\",\"2\",\"3\"]', 1, '55.00', '14.25', 'Manuel Tetteh', 'First transaction', '2022-10-20 11:18:31', 'Manuel Tetteh', NULL, NULL),
(2, 1, '[\"1\",\"2\",\"3\"]', 1, '55.00', '14.25', 'Tetteh Angmler', '', '2022-10-20 14:37:17', 'Manuel Tetteh', NULL, NULL),
(3, 2, '[\"2\",\"3\"]', 1, '45.00', '11.50', 'Tetteh Angmler', '', '2022-10-20 14:37:55', 'Manuel Tetteh', NULL, NULL),
(4, 2, '[\"1\"]', 1, '20.00', '5.00', 'Tetteh Angmler', '', '2022-10-20 20:58:01', 'Manuel Tetteh', NULL, NULL),
(5, 2, '[\"2\"]', 1, '25.00', '7.50', 'Alfred Akorli', 'New transaction', '2022-10-20 21:09:54', 'Manuel Tetteh', NULL, NULL);

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
  ADD KEY `FK_pricing_vehicle` (`vehicle_id`);

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
-- Indexes for table `tbl_sales_old`
--
ALTER TABLE `tbl_sales_old`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ProductSold` (`product_id`);

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
-- Indexes for table `tbl_washing_transactions`
--
ALTER TABLE `tbl_washing_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_washer_transaction` (`washer_id`),
  ADD KEY `FK_vehicle_transaction` (`vehicle_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_retail`
--
ALTER TABLE `tbl_retail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_sales_audit`
--
ALTER TABLE `tbl_sales_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `tbl_sales_old`
--
ALTER TABLE `tbl_sales_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_warehouse_logs`
--
ALTER TABLE `tbl_warehouse_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_washing_transactions`
--
ALTER TABLE `tbl_washing_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pricing`
--
ALTER TABLE `tbl_pricing`
  ADD CONSTRAINT `FK_pricing_service` FOREIGN KEY (`service_id`) REFERENCES `tbl_services` (`id`),
  ADD CONSTRAINT `FK_pricing_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `tbl_vehicles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tbl_washing_transactions`
--
ALTER TABLE `tbl_washing_transactions`
  ADD CONSTRAINT `FK_vehicle_transaction` FOREIGN KEY (`vehicle_id`) REFERENCES `tbl_vehicles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_washer_transaction` FOREIGN KEY (`washer_id`) REFERENCES `tbl_car_washers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
