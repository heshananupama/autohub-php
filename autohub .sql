-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2017 at 09:37 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autohub`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(10) unsigned NOT NULL,
  `brandName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brandName`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', 2, '2016-10-13 10:12:53', '2016-10-13 10:12:53'),
(2, 'Nissan', 2, '2016-10-13 10:13:02', '2016-10-13 10:13:02'),
(3, 'Mitsubishi', 2, '2016-10-13 10:13:13', '2016-10-13 10:13:13'),
(4, 'Ford ', 2, '2016-11-01 16:11:46', '2016-11-01 16:11:46'),
(5, 'Suzuki', 2, '2016-11-10 08:51:39', '2016-11-10 08:51:39'),
(6, 'Land-Rover ', 2, '2016-11-11 12:50:45', '2016-11-11 12:50:45'),
(8, 'Honda', 2, '2016-11-15 13:21:27', '2016-11-15 13:21:27'),
(9, 'Hyundai', 2, '2016-11-16 00:52:20', '2016-11-16 00:52:20'),
(10, 'bently', 2, '2016-12-03 08:13:05', '2016-12-03 08:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE IF NOT EXISTS `cartitem` (
  `id` int(10) unsigned NOT NULL,
  `spare_id` int(10) unsigned NOT NULL,
  `quantity` int(5) NOT NULL,
  `cart_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`id`, `spare_id`, `quantity`, `cart_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 1, NULL, '2016-12-08 04:15:26', '2016-12-08 04:15:26'),
(2, 11, 1, 1, NULL, '2016-12-08 04:15:30', '2016-12-08 04:15:30'),
(3, 12, 1, 1, NULL, '2016-12-08 04:15:30', '2016-12-08 04:15:30'),
(4, 10, 1, 2, NULL, '2016-12-08 04:20:26', '2016-12-08 04:20:26'),
(5, 17, 1, 3, NULL, '2016-12-08 04:28:54', '2016-12-08 04:28:54'),
(6, 12, 1, 4, NULL, '2016-12-08 04:44:04', '2016-12-08 04:44:04'),
(7, 13, 1, 5, NULL, '2016-12-08 04:50:08', '2016-12-08 04:50:08'),
(8, 18, 1, 6, NULL, '2016-12-08 05:51:42', '2016-12-08 05:51:42'),
(9, 11, 1, 7, NULL, '2016-12-08 05:53:50', '2016-12-08 05:53:50'),
(10, 12, 1, 8, NULL, '2016-12-08 05:56:29', '2016-12-08 05:56:29'),
(11, 14, 1, 9, NULL, '2016-12-08 05:59:59', '2016-12-08 05:59:59'),
(12, 10, 1, 11, NULL, '2016-12-12 02:24:17', '2016-12-12 02:24:17'),
(13, 12, 1, 12, NULL, '2016-12-13 14:26:47', '2016-12-13 14:26:47'),
(14, 14, 1, 13, NULL, '2016-12-14 14:12:36', '2016-12-14 14:12:36'),
(15, 12, 1, 13, NULL, '2016-12-15 23:07:13', '2016-12-15 23:07:13'),
(16, 16, 1, 14, NULL, '2016-12-18 07:25:20', '2016-12-18 07:25:20'),
(17, 18, 1, 15, NULL, '2016-12-18 07:25:56', '2016-12-18 07:25:56'),
(18, 12, 1, 16, NULL, '2016-12-20 12:01:52', '2016-12-20 12:01:52'),
(19, 17, 1, 17, NULL, '2016-12-21 06:01:26', '2016-12-21 06:01:26'),
(20, 13, 2, 18, NULL, '2016-12-27 04:13:22', '2016-12-27 04:13:22'),
(21, 22, 1, 19, NULL, '2016-12-27 12:36:13', '2016-12-27 12:36:13'),
(22, 13, 1, 19, NULL, '2016-12-28 03:47:59', '2016-12-28 03:47:59'),
(23, 10, 1, 20, NULL, '2016-12-28 07:41:53', '2016-12-28 07:41:53'),
(24, 22, 1, 12, NULL, '2017-01-02 20:44:00', '2017-01-02 20:44:00'),
(25, 21, 2, 21, NULL, '2017-01-03 10:21:39', '2017-01-03 10:21:39'),
(26, 18, 1, 22, NULL, '2017-01-04 18:17:59', '2017-01-04 18:17:59'),
(28, 22, 2, 23, NULL, '2017-01-05 10:00:00', '2017-01-05 10:00:00'),
(30, 13, 1, 25, NULL, '2017-01-06 11:19:36', '2017-01-06 11:19:36'),
(31, 12, 1, 25, NULL, '2017-01-06 11:20:20', '2017-01-06 11:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `categoryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `admin_id`, `created_at`, `updated_at`) VALUES
(2, 'Electrical', 2, '2016-11-01 00:15:26', '2016-11-01 00:15:26'),
(3, 'Electronics', 2, '2016-11-01 00:24:04', '2016-11-01 00:24:04'),
(4, 'Lights', 2, '2016-11-01 00:24:17', '2016-11-01 00:24:17'),
(5, 'Body', 2, '2016-11-01 00:24:29', '2016-11-01 00:24:29'),
(6, 'Exhaustions', 2, '2016-11-01 00:24:40', '2016-11-01 00:24:40'),
(7, 'Transmission', 2, '2016-11-01 00:24:57', '2016-11-01 00:24:57'),
(8, 'Suspension', 2, '2016-11-01 00:25:11', '2016-11-01 00:25:11'),
(9, 'Engine', 2, '2016-11-01 05:51:22', '2016-11-01 05:51:22'),
(10, 'Other', 2, '2016-12-27 06:49:07', '2016-12-27 06:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE IF NOT EXISTS `enquiries` (
  `id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `message` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `contactNo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `customer_id`, `message`, `contactNo`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 1, 'Do you have ford ranger cv joints 2005?', '0778600195', NULL, '2016-12-13 08:54:36', '2016-12-13 08:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(10) unsigned NOT NULL,
  `feedbackType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rating` double DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNumber` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feedbackStatus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `orderItem_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `feedbackType`, `rating`, `description`, `phoneNumber`, `feedbackStatus`, `created_at`, `updated_at`, `orderItem_id`, `user_id`) VALUES
(1, 'Review', 4, 'Good Product. Worth Buying!', NULL, NULL, '2016-12-08 04:18:31', '2016-12-08 04:18:31', 1, 1),
(2, 'Review', 3, 'Satisfied', NULL, NULL, '2016-12-08 04:19:04', '2016-12-08 04:19:04', 3, 1),
(3, 'Complain', NULL, 'Quality is not as defined', '0778600195', NULL, '2016-12-09 16:02:51', '2016-12-09 16:02:51', 1, 1),
(4, 'Review', 3, 'Not as Described', NULL, NULL, '2016-12-12 02:44:56', '2016-12-12 02:44:56', 13, 6),
(5, 'Review', 1, 'These Have been used Items.Waste of Money', NULL, NULL, '2017-01-03 05:23:50', '2017-01-03 05:23:50', 25, 6),
(6, 'Complain', NULL, 'I want to exchange this because it has been used for a long time\n', '0702298113', NULL, '2017-01-03 05:24:27', '2017-01-03 05:24:27', 25, 6),
(7, 'Review', 4, 'This is a Good Item', NULL, NULL, '2017-01-05 10:24:52', '2017-01-05 10:24:52', 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL,
  `messageType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `retailer_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `message` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `messageType`, `user_id`, `retailer_id`, `remember_token`, `created_at`, `updated_at`, `message`) VALUES
(1, 'Enquiry', 1, 4, NULL, '2016-12-13 11:45:26', '2016-12-13 11:45:26', 'Yes sir we have it.\n                                    ');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_10_11_192320_create_brands_table', 1),
('2016_10_13_170526_create_models_table', 2),
('2016_10_15_053319_create_retailer_table', 3),
('2016_10_31_145421_create_spares_table', 4),
('2016_11_21_095307_create_enquiry_table', 4),
('2016_11_23_075054_create_shoppingCart_table', 4),
('2016_11_27_144647_create_table_cartItems', 4),
('2016_12_02_191548_create_orders_table', 5),
('2016_12_02_195507_create_orderItem_table', 6),
('2016_11_01_143512_create_categories_table', 7),
('2016_12_05_191448_create_feedback_table', 8),
('2016_12_13_153512_create_message_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE IF NOT EXISTS `models` (
  `id` int(10) unsigned NOT NULL,
  `modelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transmissionType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fuelType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `engineCapacity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `countryMade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `brandName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `yearOfManufacture` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `modelName`, `transmissionType`, `fuelType`, `engineCapacity`, `countryMade`, `admin_id`, `brandName`, `yearOfManufacture`, `created_at`, `updated_at`) VALUES
(1, 'Aqua', 'Automatic', 'Hybrid/Petrol', '1500cc', 'Japan', 2, 'Toyota', 2013, NULL, NULL),
(7, 'Patrol', 'Manual', 'Diesel', '4200cc', 'Japan', 2, 'Nissan', 1992, '2016-10-18 17:15:22', '2016-10-18 17:15:22'),
(8, 'Premio', 'Automatic', 'Petrol', '1500cc', 'Thailand', 2, 'Toyota', 2011, '2016-10-21 10:48:04', '2016-10-21 10:48:04'),
(9, 'Camry', 'Manual', 'Petrol', '2500cc', 'Malaysia', 2, 'Toyota', 2008, '2016-10-21 10:48:58', '2016-10-21 10:48:58'),
(10, 'Carina', 'Manual', 'Diesel', '1500cc', 'Japan', 2, 'Toyota', 1998, '2016-10-21 10:49:39', '2016-10-21 10:49:39'),
(11, 'March', 'Automatic', 'Petrol', '1000cc', 'Japan', 2, 'Nissan', 2000, '2016-10-21 10:54:36', '2016-10-21 10:54:36'),
(12, 'Premio', 'Automatic', 'Petrol', '1500cc', 'Japan', 2, 'Toyota', 2012, '2016-10-23 09:58:00', '2016-10-23 09:58:00'),
(18, 'Premio', 'Automatic', 'Petrol', '1500cc', 'Japan', 2, 'Toyota', 2013, '2016-10-23 10:25:17', '2016-10-23 10:25:17'),
(19, 'Pajero', 'Manual', 'Diesel', '2800cc', 'Japan', 2, 'Mitsubishi', 1992, '2016-10-23 13:31:46', '2016-10-23 13:31:46'),
(20, 'Alto', 'Manual', 'Petrol', '800cc', 'India', 2, 'Suzuki', 2010, '2016-11-10 09:07:08', '2016-11-10 09:07:08'),
(22, 'X-trail', 'Automatic', 'Petrol', '2000cc', 'Japan', 2, 'Nissan', 2010, '2016-11-10 09:29:09', '2016-11-10 09:29:09'),
(24, 'Ranger', 'Manual', 'Diesel', '2900cc', 'Thailand', 2, 'Ford ', 2005, '2016-11-14 06:56:38', '2016-11-14 06:56:38'),
(25, 'Civic', 'Automatic', 'Petrol', '1500cc', 'Japan', 2, 'Honda', 2005, '2016-11-15 13:55:50', '2016-11-15 13:55:50'),
(26, 'Corolla', 'Automatic', 'Petrol', '1600cc', 'Japan', 2, 'Toyota', 2008, '2016-11-15 15:02:24', '2016-11-15 15:02:24'),
(27, 'Prius', 'Automatic', 'Hybrid/Petrol', '1800cc', 'Japan', 2, 'Toyota', 2010, '2016-11-15 15:18:46', '2016-11-15 15:18:46'),
(28, 'Leaf', 'Automatic', 'Electric', '1000cc', 'Japan', 2, 'Nissan', 2013, '2016-11-15 16:08:54', '2016-11-15 16:08:54'),
(29, 'Lancer', 'Automatic', 'Petrol', '1500cc', 'Japan', 2, 'Mitsubishi', 2010, '2016-11-15 16:53:53', '2016-11-15 16:53:53'),
(30, 'Yaris', 'Automatic', 'Petrol', '1300cc', 'Thailand', 2, 'Toyota', 2008, '2016-11-15 17:08:42', '2016-11-15 17:08:42'),
(31, 'Accent', 'Manual', 'Petrol', '1400cc', 'Korea', 2, 'Hyundai', 2008, '2016-11-16 00:52:54', '2016-11-16 00:52:54'),
(32, 'escort', 'Manual', 'Petrol', ' ', 'USA', 2, 'Ford ', 2002, '2017-01-06 10:58:47', '2017-01-06 10:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE IF NOT EXISTS `orderitem` (
  `id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `orderStatus` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Purchased',
  `totalCost` double DEFAULT NULL,
  `subTotal` double NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `spare_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`id`, `quantity`, `orderStatus`, `totalCost`, `subTotal`, `order_id`, `spare_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Delivered', 12500, 15000, 1, 10, NULL, '2016-12-08 04:16:14', '2016-12-08 04:16:14'),
(2, 1, 'Delivered', 10800, 13000, 1, 11, NULL, '2016-12-08 04:16:14', '2016-12-08 04:16:14'),
(3, 1, 'Shipped', 7000, 8000, 1, 12, NULL, '2016-12-08 04:16:15', '2016-12-08 04:16:15'),
(4, 1, 'Delivered', 12500, 15000, 2, 10, NULL, '2016-12-08 04:20:49', '2016-12-08 04:20:49'),
(5, 1, 'Shipped', 1500, 2250, 3, 17, NULL, '2016-12-08 04:29:08', '2016-12-08 04:29:08'),
(6, 1, 'Delivered', 7000, 8000, 4, 12, NULL, '2016-12-08 04:48:20', '2016-12-08 04:48:20'),
(7, 1, 'Shipped', 10000, 13000, 5, 13, NULL, '2016-12-08 04:50:51', '2016-12-08 04:50:51'),
(8, 1, 'Purchased', 7200, 9000, 6, 18, NULL, '2016-12-08 05:52:06', '2016-12-08 05:52:06'),
(9, 1, 'Delivered', 10800, 13000, 8, 11, NULL, '2016-12-08 05:54:39', '2016-12-08 05:54:39'),
(10, 1, 'Delivered', 7000, 8000, 9, 12, NULL, '2016-12-08 05:57:11', '2016-12-08 05:57:11'),
(11, 1, 'Shipped', 16200, 20000, 10, 14, NULL, '2016-12-08 06:00:22', '2016-12-08 06:00:22'),
(13, 1, 'Shipped', 12500, 15000, 12, 10, NULL, '2016-12-12 02:28:02', '2016-12-12 02:28:02'),
(14, 1, 'Shipped', 16200, 20000, 13, 14, NULL, '2016-12-15 23:07:22', '2016-12-15 23:07:22'),
(15, 1, 'Purchased', 7000, 8000, 13, 12, NULL, '2016-12-15 23:07:22', '2016-12-15 23:07:22'),
(16, 1, 'Purchased', 1200, 1500, 14, 16, NULL, '2016-12-18 07:25:26', '2016-12-18 07:25:26'),
(17, 1, 'Purchased', 7200, 9000, 15, 18, NULL, '2016-12-18 07:26:11', '2016-12-18 07:26:11'),
(18, 1, 'Delivered', 7000, 8000, 16, 12, NULL, '2016-12-20 12:02:00', '2016-12-20 12:02:00'),
(19, 1, 'Purchased', 1500, 2250, 18, 17, NULL, '2016-12-21 06:02:29', '2016-12-21 06:02:29'),
(20, 2, 'Purchased', 20000, 26000, 19, 13, NULL, '2016-12-27 04:13:46', '2016-12-27 04:13:46'),
(21, 1, 'Purchased', 3750, 5000, 20, 22, NULL, '2016-12-28 03:48:10', '2016-12-28 03:48:10'),
(22, 1, 'Shipped', 10000, 13000, 20, 13, NULL, '2016-12-28 03:48:10', '2016-12-28 03:48:10'),
(23, 1, 'Shipped', 12500, 15000, 22, 10, NULL, '2016-12-28 07:43:13', '2016-12-28 07:43:13'),
(24, 1, 'Purchased', 7000, 8000, 23, 12, NULL, '2017-01-03 04:53:05', '2017-01-03 04:53:05'),
(25, 1, 'Purchased', 3750, 5000, 23, 22, NULL, '2017-01-03 04:53:06', '2017-01-03 04:53:06'),
(26, 2, 'Purchased', 25600, 35000, 24, 21, NULL, '2017-01-03 10:23:04', '2017-01-03 10:23:04'),
(27, 1, 'Purchased', 7200, 9000, 25, 18, NULL, '2017-01-04 19:26:52', '2017-01-04 19:26:52'),
(28, 2, 'Purchased', 7500, 10000, 26, 22, NULL, '2017-01-05 10:00:31', '2017-01-05 10:00:31'),
(29, 1, 'Purchased', 10000, 13000, 27, 13, NULL, '2017-01-06 11:20:43', '2017-01-06 11:20:43'),
(30, 1, 'Purchased', 7000, 8000, 27, 12, NULL, '2017-01-06 11:20:43', '2017-01-06 11:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL,
  `orderDate` date NOT NULL,
  `orderTotal` double NOT NULL,
  `shippingAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderDate`, `orderTotal`, `shippingAddress`, `user_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '2016-11-30', 36000, '"Anoma", Kolinjadiya, Wennappuwa', 1, NULL, '2016-12-08 04:16:14', '2016-12-08 04:16:14'),
(2, '2016-12-08', 15000, '"Anoma", Kolinjadiya, Wennappuwa', 1, NULL, '2016-12-08 04:20:49', '2016-12-08 04:20:49'),
(3, '2016-12-08', 2250, '"Anoma", Kolinjadiya, Wennappuwa', 1, NULL, '2016-12-08 04:29:08', '2016-12-08 04:29:08'),
(4, '2016-12-08', 8000, '"Anoma", Kolinjadiya, Wennappuwa', 1, NULL, '2016-12-08 04:48:20', '2016-12-08 04:48:20'),
(5, '2016-12-08', 13000, '"No 200",Kolinjadiya,Wennapuuwa.', 1, NULL, '2016-12-08 04:50:51', '2016-12-08 04:50:51'),
(6, '2016-12-09', 9000, '"Anoma", Kolinjadiya, Wennappuwa', 1, NULL, '2016-12-08 05:52:06', '2016-12-08 05:52:06'),
(8, '2016-12-10', 13000, 'Emblipitya', 1, NULL, '2016-12-08 05:54:39', '2016-12-08 05:54:39'),
(9, '2016-12-10', 8000, 'Mathugama', 1, NULL, '2016-12-08 05:57:11', '2016-12-08 05:57:11'),
(10, '2016-12-11', 20000, 'Wennappuwa', 1, NULL, '2016-12-08 06:00:22', '2016-12-08 06:00:22'),
(12, '2016-12-12', 15000, 'No 34, Somawathiya Road, Polonnaruwa', 6, NULL, '2016-12-12 02:28:02', '2016-12-12 02:28:02'),
(13, '2016-12-13', 28000, 'Wennappuwa', 1, NULL, '2016-12-15 23:07:21', '2016-12-15 23:07:21'),
(14, '2016-12-17', 1500, 'Wennappuwa', 1, NULL, '2016-12-18 07:25:26', '2016-12-18 07:25:26'),
(15, '2016-12-17', 9000, 'Wennappuwa', 1, NULL, '2016-12-18 07:26:10', '2016-12-18 07:26:10'),
(16, '2016-12-20', 8000, 'Wennappuwa', 1, NULL, '2016-12-20 12:02:00', '2016-12-20 12:02:00'),
(18, '2016-12-21', 2250, 'Wennappuwa', 1, NULL, '2016-12-21 06:02:29', '2016-12-21 06:02:29'),
(19, '2016-12-27', 26000, 'Kadawatha', 1, NULL, '2016-12-27 04:13:46', '2016-12-27 04:13:46'),
(20, '2016-12-28', 18000, 'Wennappuwa', 1, NULL, '2016-12-28 03:48:10', '2016-12-28 03:48:10'),
(21, '2016-12-28', 18000, 'Wennappuwa', 1, NULL, '2016-12-28 03:48:12', '2016-12-28 03:48:12'),
(22, '2016-12-28', 15000, 'Wennappuwa', 1, NULL, '2016-12-28 07:43:13', '2016-12-28 07:43:13'),
(23, '2017-01-03', 13000, '"Dharmasena Gems",Embilipitya', 6, NULL, '2017-01-03 04:52:53', '2017-01-03 04:52:53'),
(24, '2017-01-03', 35000, '''No20'',New Road,Badulla.', 1, NULL, '2017-01-03 10:23:04', '2017-01-03 10:23:04'),
(25, '2017-01-04', 9000, 'Wennappuwa', 4, NULL, '2017-01-04 19:26:52', '2017-01-04 19:26:52'),
(26, '2017-01-05', 10000, 'No 223, Maradana', 1, NULL, '2017-01-05 10:00:31', '2017-01-05 10:00:31'),
(27, '2017-01-06', 21000, 'Wennappuwa', 1, NULL, '2017-01-06 11:20:43', '2017-01-06 11:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('heshananupama@gmail.com', '3f32977c35c8ac1ffbc8171efb9b4235390f0ec063e865b453c634ac53993a33', '2016-10-13 00:00:10'),
('heshananupama@yahoo.com', '346c03fbd68295fb8f85c86a50c0879b1773ad89654d83087426bf28b312aacd', '2016-10-13 00:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `retailers`
--

CREATE TABLE IF NOT EXISTS `retailers` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `contactNo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shopName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatarImage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `retailers`
--

INSERT INTO `retailers` (`id`, `user_id`, `contactNo`, `address`, `shopName`, `avatarImage`, `created_at`, `updated_at`) VALUES
(1, 4, '0312255234', 'No 40, Chilaw Road,Wennappuwa', 'G.F.V.Spares', 'gfvLogo.png', '2016-10-16 01:17:11', '2016-10-16 01:17:11'),
(2, 5, '0112589589', '"200/D",Kandy road, Dalugama.', 'City Auto Traders', 'cityAuto.png', '2016-11-16 00:46:32', '2016-11-16 00:46:32'),
(4, 8, '0312255225', '''No 22'', Kolinjadiya, Wennappuwa', 'Yathna Motors', 'gfvLogo.png', '2016-12-20 00:38:42', '2016-12-20 00:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `id` int(10) unsigned NOT NULL,
  `temporary` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `isCheckedOut` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`id`, `temporary`, `isCheckedOut`, `user_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'n', 'y', 1, NULL, '2016-12-08 04:15:26', '2016-12-08 04:15:26'),
(2, 'n', 'y', 1, NULL, '2016-12-08 04:20:26', '2016-12-08 04:20:26'),
(3, 'n', 'y', 1, NULL, '2016-12-08 04:28:54', '2016-12-08 04:28:54'),
(4, 'n', 'y', 1, NULL, '2016-12-08 04:44:04', '2016-12-08 04:44:04'),
(5, 'n', 'y', 1, NULL, '2016-12-08 04:50:08', '2016-12-08 04:50:08'),
(6, 'n', 'y', 1, NULL, '2016-12-08 05:51:41', '2016-12-08 05:51:41'),
(7, 'n', 'y', 1, NULL, '2016-12-08 05:53:50', '2016-12-08 05:53:50'),
(8, 'n', 'y', 1, NULL, '2016-12-08 05:56:29', '2016-12-08 05:56:29'),
(9, 'n', 'y', 1, NULL, '2016-12-08 05:59:59', '2016-12-08 05:59:59'),
(10, 'n', 'y', 1, NULL, '2016-12-08 06:12:44', '2016-12-08 06:12:44'),
(11, 'n', 'y', 6, NULL, '2016-12-12 02:24:16', '2016-12-12 02:24:16'),
(12, 'n', 'y', 6, NULL, '2016-12-13 14:26:47', '2016-12-13 14:26:47'),
(13, 'n', 'y', 1, NULL, '2016-12-14 14:12:35', '2016-12-14 14:12:35'),
(14, 'n', 'y', 1, NULL, '2016-12-18 07:25:20', '2016-12-18 07:25:20'),
(15, 'n', 'y', 1, NULL, '2016-12-18 07:25:56', '2016-12-18 07:25:56'),
(16, 'n', 'y', 1, NULL, '2016-12-20 12:01:52', '2016-12-20 12:01:52'),
(17, 'n', 'y', 1, NULL, '2016-12-21 06:01:25', '2016-12-21 06:01:25'),
(18, 'n', 'y', 1, NULL, '2016-12-27 04:13:22', '2016-12-27 04:13:22'),
(19, 'n', 'y', 1, NULL, '2016-12-27 12:36:13', '2016-12-27 12:36:13'),
(20, 'n', 'y', 1, NULL, '2016-12-28 07:41:53', '2016-12-28 07:41:53'),
(21, 'n', 'y', 1, NULL, '2017-01-03 10:21:39', '2017-01-03 10:21:39'),
(22, 'n', 'y', 4, NULL, '2017-01-04 18:17:58', '2017-01-04 18:17:58'),
(23, 'n', 'y', 1, NULL, '2017-01-05 09:58:32', '2017-01-05 09:58:32'),
(24, 'n', 'n', 6, NULL, '2017-01-05 17:13:24', '2017-01-05 17:13:24'),
(25, 'n', 'y', 1, NULL, '2017-01-06 11:19:36', '2017-01-06 11:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `spares`
--

CREATE TABLE IF NOT EXISTS `spares` (
  `id` int(10) unsigned NOT NULL,
  `partNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` double NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  `warranty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retailer_id` int(10) unsigned NOT NULL,
  `brand_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `spares`
--

INSERT INTO `spares` (`id`, `partNumber`, `quantity`, `cost`, `price`, `warranty`, `retailer_id`, `brand_id`, `model_id`, `category_id`, `description`, `imagePath`, `remember_token`, `created_at`, `updated_at`) VALUES
(10, '331011', 1, 12500, 15000, '-', 4, 8, 25, 8, 'Front Shock Assembly', 'FRONT_SHOCK_ABSORBER_HONDA_CIVIC.jpg', NULL, '2016-11-15 08:51:21', '2016-11-15 08:51:21'),
(11, '53384', 0, 10800, 13000, '2-year', 4, 1, 26, 8, 'Front Lower Control Arm Bushes', 'FRONT LOWER CONTROL ARM BUSHINGS - REAR INNER POSITION.png', NULL, '2016-11-15 09:35:12', '2016-11-15 09:35:12'),
(12, 'ES800841', 0, 7000, 8000, '1-year', 4, 1, 27, 8, 'Front Outer Tie Rod', 'FRONT OUTER TIE ROD END.jpg', NULL, '2016-11-15 09:52:53', '2016-11-15 09:52:53'),
(13, 'RK621157', 2, 10000, 13000, '1-year', 4, 2, 28, 7, 'Front Lower Control Arm And Ball Joint', 'FRONT LOWER CONTROL ARM AND BALL JOINT.jpg', NULL, '2016-11-15 10:36:04', '2016-11-15 10:36:04'),
(14, 'K100089', 2, 16200, 20000, '3-months', 4, 3, 29, 8, 'Rear Upper Lateral Arm', 'REAR UPPER LATERAL ARM.jpg', NULL, '2016-11-15 11:26:31', '2016-11-15 11:26:31'),
(15, '512370', 3, 30000, 35000, '-', 4, 1, 30, 8, 'Rear Wheel Bearing', 'REAR WHEEL BEARING AND HUB ASSEMBLY.jpg', NULL, '2016-11-15 11:42:48', '2016-11-15 11:42:48'),
(16, 'K6660-3', 4, 1200, 1500, '-', 5, 9, 31, 8, 'Rear Camber Toe Shim', 'REAR CAMBER TOE SHIM.jpg', NULL, '2016-11-15 19:25:51', '2016-11-15 19:25:51'),
(17, 'PF61E ', 2, 1500, 2250, '-', 5, 1, 8, 2, 'ACDelco Professional Engine Oil Filter', 'toyota premio oil Filter.png', NULL, '2016-11-28 06:08:19', '2016-11-28 06:08:19'),
(18, '1610029155 ', 2, 7200, 9000, '-', 5, 1, 8, 8, ' Water Pump Assembly + Gasket ', 'Toyota Premio waterPump.jpg', NULL, '2016-12-03 09:51:32', '2016-12-03 09:51:32'),
(19, '1610029155 ', 6, 8500, 11000, '3-months', 4, 1, 8, 2, ' Water Pump Assembly + Gasket', 'Toyota Premio waterPump.jpg', NULL, '2016-12-03 09:52:52', '2016-12-03 09:52:52'),
(20, 'MMX3500-E', 5, 80000, 98000, '2-year', 5, 1, 26, 8, 'Coilover Suspension Full adjustable 40 way Suspension Kit', 'Coilover Suspension.png', NULL, '2016-12-27 05:03:11', '2016-12-27 05:03:11'),
(21, '446508030', 2, 12800, 17500, '-', 5, 1, 26, 10, 'Toyota Corolla Front Brake Pads and Brake Rotors', 'toyotaCorollaBrake.jpg', NULL, '2016-12-27 06:52:16', '2016-12-27 06:52:16'),
(22, ' 04004-79128-B0', 6, 3750, 5000, '1-year', 4, 1, 9, 9, 'Toyota 2.4L piston rod and ring set of four ', 'pistonsCamry.jpg', NULL, '2016-12-27 12:16:35', '2016-12-27 12:16:35'),
(23, '101700618', 4, 3200, 4500, '1-year', 5, 2, 28, 10, 'Nissan Leaf Pagid Front Brake Pads Set', 'nissanLeafBrake.png', NULL, '2016-12-27 15:08:52', '2016-12-27 15:08:52'),
(24, '04465-0r010', 5, 2100, 2500, '-', 4, 1, 8, 10, 'Brake pads for Toyota Premio', 'brake.png', NULL, '2017-01-04 16:40:01', '2017-01-04 16:40:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` char(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'c',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `type`, `password`, `remember_token`, `updated_at`) VALUES
(1, 'Heshan', 'heshananupama@gmail.com', 'c', '$2y$10$RhTIliTCm20rutty4CBPUuPqiorYTAQOcY2pJs2YKrAxMV9jktoQS', 'O8qdNJjjFP7OAcXJZzHGnX3m88uYwepVMTwj4wrCtVZ1ndYB1mzabJzi7Gyu', '2017-01-06 11:21:02'),
(2, 'Anupama', 'heshananupama@yahoo.com', 'a', '$2y$10$cjXbvU9.YDi3b/MTq/V9oOwvToALREKRuGaqK/pcm2F2G5oKXW0GG', '6SkmGAYLR5iKfspjI6gYRcKzdeWYsYywGhpwWB2cS1UNlSqpc3Na2QaazZkB', '2017-01-06 11:18:31'),
(4, 'G.F.V Motors', 'gfvspares@gmail.com', 'r', '$2y$10$2CZIbtpaeO2b8meSHcDVweRwiLRBCtuurqXf4o52JIomxZvn5usKy', 'D9CblUtdGRHviMxe98Ugxjv9P8heXM4SEZtUvOtGCm3IdYuhLxvKHfvQGc18', '2017-01-06 11:38:31'),
(5, 'City Auto Traders', 'cityauto@yahoo.com', 'r', '$2y$10$twR7IN3kSnJ/H8qDd0sDEOSwIzJquLHk6VLob7EeGCu00Z010PFaS', '3rkNc8BpjHxA9fREARywSnd0N3VOXFghEmNRa3G2pkCLD03xEjHgT9nZ7oAv', '2017-01-05 09:57:01'),
(6, 'Mahesh Buddhika', 'maheshbnk@gmail.com', 'c', '$2y$10$uq7PGm151xGu/XzAOxSF.eIwLLGp4OgTu3bA28Zi6wKzHVOBHSxK.', 'jkhLuBM0RVUOVDJ83N70jk2RNwzcn990K7O09RisaZ6X1M8ZyWucg5nGdiML', '2017-01-05 17:26:16'),
(8, 'Surein Perera', 'yathnaMotors@gmail.com', 'r', '$2y$10$gWr.SFxY/H.Tap4j6UZ9W.Drv8avPmjQKfMeSU24ljXYmDUb7hVPi', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_brandname_unique` (`brandName`),
  ADD KEY `brands_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartitem_spare_id_foreign` (`spare_id`),
  ADD KEY `cartitem_cart_id_foreign` (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_orderitem_id_foreign` (`orderItem_id`),
  ADD KEY `feedback_user_id_foreign` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_retailer_id_foreign` (`retailer_id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `models_unique` (`modelName`(50),`transmissionType`(50),`fuelType`(50),`countryMade`(50),`brandName`(50),`yearOfManufacture`),
  ADD KEY `models_admin_id_foreign` (`admin_id`),
  ADD KEY `models_brandname_foreign` (`brandName`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderitem_order_id_foreign` (`order_id`),
  ADD KEY `orderitem_spare_id_foreign` (`spare_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `retailers`
--
ALTER TABLE `retailers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retailers_user_id_foreign` (`user_id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shoppingcart_user_id_foreign` (`user_id`);

--
-- Indexes for table `spares`
--
ALTER TABLE `spares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spares_retailer_id_foreign` (`retailer_id`),
  ADD KEY `spares_brand_id_foreign` (`brand_id`),
  ADD KEY `spares_model_id_foreign` (`model_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `retailers`
--
ALTER TABLE `retailers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `spares`
--
ALTER TABLE `spares`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `shoppingcart` (`id`),
  ADD CONSTRAINT `cartitem_spare_id_foreign` FOREIGN KEY (`spare_id`) REFERENCES `spares` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD CONSTRAINT `Customer_Enquiry` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_orderitem_id_foreign` FOREIGN KEY (`orderItem_id`) REFERENCES `orderitem` (`id`),
  ADD CONSTRAINT `feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_retailer_id_foreign` FOREIGN KEY (`retailer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `models_brandname_foreign` FOREIGN KEY (`brandName`) REFERENCES `brands` (`brandName`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderitem_spare_id_foreign` FOREIGN KEY (`spare_id`) REFERENCES `spares` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `retailers`
--
ALTER TABLE `retailers`
  ADD CONSTRAINT `retailers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `shoppingcart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `spares`
--
ALTER TABLE `spares`
  ADD CONSTRAINT `spares_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `spares_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `spares_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`),
  ADD CONSTRAINT `spares_retailer_id_foreign` FOREIGN KEY (`retailer_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
