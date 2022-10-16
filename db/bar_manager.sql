-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 14, 2022 at 11:16 PM
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
(6, 'guiness', NULL, '8', '12', '96', NULL, 0, 'Active', NULL, NULL, NULL, 'Manuel Tetteh', '2022-09-30 23:57:40', 'Manuel Tetteh', '2022-09-30 23:58:11'),
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
(1, 1, '10', '3', '2', '0', '2', '2', '20', '2022-09-29 17:09:11', '2022-10-13 23:50:51'),
(2, 2, '9', '0', '1', '0', '1', '1', '9', '2022-09-29 17:09:22', '2022-10-13 23:53:26'),
(3, 6, '8', '11', '35', '2', '11', '35', '280', '2022-10-01 01:23:12', '2022-10-13 23:10:25');

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
(18, 1, NULL, '3', '2', '1', '10', NULL, '2022-10-14 00:10:22', NULL, 'Manuel Tetteh', '2022-10-14 00:10:22', 'Manuel Tetteh', '2022-10-14 00:15:22');

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
(55, 1, 6, '35', NULL, NULL, NULL, NULL, '2022-10-14', 'Manuel Tetteh', '2022-10-14 21:01:56', NULL, '2022-10-14 21:01:56');

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
(10, 'tt', 'amenu', 'tt@gmail.com', 'tt', '$2y$10$AHkB9Y8ZHBWisZHNh/VIuOfBxhoEpWHgZQVHHCmSFbIkBY4DeIRzu', '0245121212', 'Admin', NULL, '2022-10-04 21:07:53', 'Manuel Tetteh', NULL, NULL);

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
(1, 2, '12', '0', '5', '108', '9', '5', '45', '2022-09-29', NULL, 'Manuel Tetteh', '2022-09-29 15:56:17', NULL, 'Manuel Tetteh', '2022-10-13 23:42:50'),
(2, 1, '12', '0', '1', '120', '10', '1', '10', '2022-09-29', NULL, 'Manuel Tetteh', '2022-09-29 15:56:39', NULL, 'Manuel Tetteh', '2022-10-13 23:42:18'),
(3, 6, '12', '0', '0', '96', '8', '0', '0', '2022-10-01', NULL, 'Manuel Tetteh', '2022-10-01 01:22:49', NULL, NULL, NULL);

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
(1, 1, '10', '10', '0', '5', '5', '10', '5', '50', 'Tetteh Angmler', '2022-09-29', NULL, 'Manuel Tetteh', '2022-09-29 17:09:11', NULL, '2022-09-29 17:09:11'),
(2, 2, '9', '10', '0', '5', '5', '10', '5', '45', 'Eve Lartey', '2022-09-29', NULL, 'Manuel Tetteh', '2022-09-29 17:09:22', NULL, '2022-09-29 17:09:22'),
(3, 1, '10', '5', '0', '2', '2', '5', '3', '20', 'Tetteh Angmler', '2022-10-01', NULL, 'Manuel Tetteh', '2022-10-01 00:47:12', NULL, '2022-10-01 00:47:12'),
(4, 2, '9', '5', '0', '2', '2', '5', '3', '18', 'Alfred Akorli', '2022-10-01', NULL, 'Manuel Tetteh', '2022-10-01 00:47:34', NULL, '2022-10-01 00:47:34'),
(5, 6, '8', '36', '1', '0', '12', '36', '24', '96', 'Eric Lartey', '2022-10-01', NULL, 'Manuel Tetteh', '2022-10-01 01:23:12', NULL, '2022-10-01 01:23:12'),
(6, 6, '8', '24', '2', '0', '24', '24', '0', '192', 'Alfred Akorli', '2022-10-13', NULL, 'Manuel Tetteh', '2022-10-13 23:10:25', NULL, '2022-10-13 23:10:25'),
(7, 1, '10', '3', '0', '3', '3', '3', '0', '30', 'Alfred Akorli', '2022-10-13', NULL, 'Manuel Tetteh', '2022-10-13 23:25:41', NULL, '2022-10-13 23:25:41'),
(8, 2, '9', '3', '0', '2', '2', '3', '1', '18', 'Eric Lartey', '2022-10-13', NULL, 'Manuel Tetteh', '2022-10-13 23:40:24', NULL, '2022-10-13 23:40:24'),
(9, 1, '10', '5', '0', '2', '2', '5', '3', '20', 'Eve Lartey', '2022-10-13', NULL, 'Manuel Tetteh', '2022-10-13 23:43:31', NULL, '2022-10-13 23:43:31'),
(10, 1, '10', '3', '0', '1', '1', '3', '2', '10', 'Ishmael Tetteh', '2022-10-13', NULL, 'Manuel Tetteh', '2022-10-13 23:50:27', NULL, '2022-10-13 23:50:27'),
(11, 1, '10', '2', '0', '1', '1', '2', '1', '10', 'Frankie Ranky', '2022-10-13', NULL, 'Manuel Tetteh', '2022-10-13 23:50:51', NULL, '2022-10-13 23:50:51'),
(12, 2, '9', '5', '0', '1', '1', '5', '4', '9', 'Eve Lartey', '2022-10-13', NULL, 'Manuel Tetteh', '2022-10-13 23:53:10', NULL, '2022-10-13 23:53:10'),
(13, 2, '9', '4', '0', '3', '3', '4', '5', '27', 'Frankie Ranky', '2022-10-13', NULL, 'Manuel Tetteh', '2022-10-13 23:53:26', NULL, '2022-10-13 23:59:57');

--
-- Indexes for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_sales_audit`
--
ALTER TABLE `tbl_sales_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_sales_old`
--
ALTER TABLE `tbl_sales_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_warehouse_logs`
--
ALTER TABLE `tbl_warehouse_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_retail`
--
ALTER TABLE `tbl_retail`
  ADD CONSTRAINT `FK_retail_product` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
