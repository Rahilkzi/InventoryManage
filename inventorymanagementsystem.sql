-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2025 at 10:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorymanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `audittrails`
--

CREATE TABLE `audittrails` (
  `id` int(200) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(250) NOT NULL,
  `action` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `audittrails`
--

INSERT INTO `audittrails` (`id`, `datetime`, `username`, `action`) VALUES
(805, '2025-10-08 08:20:38', 'Rihana', 'Logout'),
(804, '2025-10-08 08:19:29', 'Rihana', 'Login'),
(803, '2025-10-08 08:19:25', 'harzixuan', 'Logout'),
(802, '2025-10-08 08:19:01', 'harzixuan', 'Login'),
(801, '2025-10-08 08:18:59', 'harzixuan', 'Logout'),
(800, '2025-10-08 08:16:52', 'harzixuan', 'Login'),
(799, '2025-10-08 08:16:43', 'harzixuan', 'Logout'),
(798, '2025-10-08 08:16:42', 'harzixuan', 'Login'),
(797, '2025-10-08 08:16:27', 'harzixuan', 'Logout'),
(796, '2025-10-08 08:16:26', 'harzixuan', 'Login'),
(795, '2025-10-08 08:16:14', 'harzixuan', 'Logout'),
(794, '2025-10-08 08:16:13', 'harzixuan', 'Login'),
(793, '2025-10-08 08:15:24', 'harzixuan', 'Logout'),
(792, '2025-10-08 08:15:23', 'harzixuan', 'Login'),
(791, '2025-10-08 08:14:42', 'harzixuan', 'Logout'),
(790, '2025-10-08 08:14:41', 'harzixuan', 'Login'),
(789, '2025-10-08 08:13:28', 'harzixuan', 'Logout'),
(788, '2025-10-08 08:13:04', 'harzixuan', 'Login'),
(787, '2025-10-08 08:12:56', 'harzixuan', 'Logout'),
(786, '2025-10-08 07:59:22', 'harzixuan', 'Login'),
(785, '2025-10-08 07:59:01', 'harzixuan', 'Logout'),
(784, '2025-10-08 07:56:01', 'harzixuan', 'Login'),
(783, '2025-10-08 07:55:24', 'harzixuan', 'Login'),
(782, '2025-10-08 07:53:37', 'harzixuan', 'Login'),
(781, '2025-10-08 07:53:12', 'harzixuan', 'Login'),
(780, '2025-10-08 07:53:03', 'harzixuan', 'Login'),
(779, '2025-10-08 07:51:21', 'harzixuan', 'Login'),
(778, '2025-10-08 07:50:57', 'harzixuan', 'Login'),
(777, '2025-10-08 07:50:41', 'harzixuan', 'Login'),
(776, '2025-10-08 07:48:30', 'harzixuan', 'Login'),
(775, '2025-10-08 07:27:00', 'harzixuan', 'Login'),
(774, '2025-10-05 14:13:10', 'harzixuan', 'Login'),
(773, '2025-10-05 14:01:51', 'harzixuan', 'Login'),
(772, '2025-10-05 14:00:40', 'harzixuan', 'Login'),
(771, '2025-10-05 06:03:14', 'harzixuan', 'Login'),
(770, '2025-10-04 14:46:24', 'harzixuan', 'Login'),
(769, '2025-10-04 07:44:46', 'harzixuan', 'Logout'),
(768, '2025-10-04 07:40:18', 'harzixuan', 'Transfer 100 of ToothBrush to new location'),
(767, '2025-10-04 07:38:18', 'harzixuan', 'Add Product: ToothBrush'),
(766, '2025-10-04 07:08:39', 'harzixuan', 'Login'),
(765, '2025-10-04 07:07:38', 'harzixuan', 'Logout'),
(764, '2025-10-04 07:03:46', 'harzixuan', 'Login');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` varchar(250) NOT NULL,
  `categoryname` varchar(250) NOT NULL,
  `categorydescription` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categoryname`, `categorydescription`) VALUES
('C01', 'Shoes', 'More clothes'),
('C02', 'Cooking tools', 'Cooking equipment or tool'),
('C03', 'Toy', 'Many toy, endless creative possibilities.'),
('C04', 'Stationary', 'Stationery product and more'),
('C05', 'Electronics & Gadgets', 'Electronics & Gadgets for home essential'),
('C06', 'Personal Care', 'Essential for daily use , e.g., soap, toothpaste, toothbrush, shampoo, etc. '),
('C07', 'Cleaning Supplies', 'Detergent,  Disinfectant Spray, Toilet Bowl Cleaner, Floor Cleaner (e.g., Lizol, Pine-Sol), etc.'),
('C08', 'spices', 'whole & ground spices');

-- --------------------------------------------------------

--
-- Table structure for table `companyprofile`
--

CREATE TABLE `companyprofile` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `profilepicture` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `companyprofile`
--

INSERT INTO `companyprofile` (`id`, `name`, `profilepicture`) VALUES
(1, 'EasyStock', 'picture/CompanyLogo.png');

-- --------------------------------------------------------

--
-- Table structure for table `deliverorder`
--

CREATE TABLE `deliverorder` (
  `id` int(250) NOT NULL,
  `productid` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `quantity` int(250) NOT NULL,
  `unitprice` int(255) NOT NULL,
  `location` varchar(200) NOT NULL,
  `addeddate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `deliverorder`
--

INSERT INTO `deliverorder` (`id`, `productid`, `name`, `quantity`, `unitprice`, `location`, `addeddate`) VALUES
(52, 'C02', 'Metal Spoon', 2, 3, 'Aeon Bukit Indah', '2024-03-13 16:04:40'),
(51, 'P01', 'M&G pencil', 20, 5, 'Aeon Tebrau', '2023-11-16 07:09:47'),
(50, 'MP01', 'ArtLine MarkerPen', 3, 2, 'Aeon Tebrau', '2023-11-16 06:29:43'),
(49, 'TOY01', 'Gru Toy', 10, 10, 'Aeon Tebrau', '2023-11-16 03:32:35'),
(48, 'C02', 'Metal Spoon', 10, 3, 'Aeon Tebrau', '2023-11-16 02:22:22'),
(47, 'P01', 'M&G pencil', 50, 5, 'Aeon Tebrau', '2023-11-16 00:57:52'),
(46, 'MP02', 'ArtLine MarkerPen', 42, 2, 'Aeon Bukit Indah', '2023-11-16 00:57:35'),
(45, 'MP01', 'ArtLine MarkerPen', 42, 2, 'Aeon Tebrau', '2023-11-16 00:55:01'),
(44, 'MP01', 'ArtLine MarkerPen', 2, 2, 'Aeon Tebrau', '2023-11-16 00:45:10'),
(43, 'TOY01', 'Gru Toy', 10, 10, 'Aeon Tebrau', '2023-11-16 00:36:56'),
(42, 'SB01', 'Cat school bag', 4, 49, 'Aeon Bukit Indah', '2023-11-15 20:00:15'),
(41, 'MP02', 'ArtLine MarkerPen', 7, 2, 'Aeon Bukit Indah', '2023-11-15 19:58:21'),
(40, 'C02', 'Metal Spoon', 10, 3, 'Aeon Tebrau', '2023-11-15 19:45:06'),
(39, 'C02', 'Metal Spoon', 10, 3, 'Aeon Tebrau', '2023-11-15 16:58:11'),
(53, 'p01', 'ToothBrush', 100, 20, 'new location', '2025-10-04 07:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `quantity` int(20) NOT NULL,
  `unitprice` decimal(20,2) NOT NULL,
  `variant` varchar(200) DEFAULT NULL,
  `description` varchar(300) NOT NULL,
  `category` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `addeddate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `quantity`, `unitprice`, `variant`, `description`, `category`, `status`, `image`, `addeddate`) VALUES
('C02', 'Metal Spoon', 8, '3.00', '', 'Cooking tools, stainless steel spoons', 'Cooking tools', 'Active', 'picture/spoonx.jpg', '2023-11-15 07:37:49'),
('MP01', 'ArtLine MarkerPen', 9, '2.00', 'Red', 'Precision, vibrant colors, quick-drying, waterproof, ergonomic design.', 'Stationary', 'Active', 'picture/Artline 100 Permanent Marker Pen - Red.jpeg', '2023-11-15 06:55:44'),
('MP02', 'ArtLine MarkerPen', 7, '2.00', 'Blue', 'Precision, vibrant colors, quick-drying, waterproof, ergonomic design.', 'Stationary', 'Active', 'picture/artline-100-marker-pen-blue.jpg', '2023-11-15 06:56:39'),
('TOY05', 'Gru Toy', 7, '10.00', 'Gru', 'Gru toy despicable me', 'Toy', 'Active', 'picture/gru.jpg', '2025-10-03 11:56:01'),
('TOY02', 'Monkey toy', 96, '50.00', '', 'Squish easily, made of rubber', 'Toy', 'Active', 'picture/monke.jpeg', '2025-10-05 14:16:10'),
('COO2', 'Metal Spatula', 6, '10.00', '', 'Made of stainless steel', 'Cooking tools', 'Active', 'picture/spatula.jpg', '2023-11-15 11:48:49'),
('PC01', 'Pencil Case', 78, '3.00', '', 'Among us theme pencil case, black color', 'Stationary', 'Active', 'picture/Pencil case.jpeg', '2025-10-05 14:12:54'),
('654f', 'hi', 3, '44.00', '', 'd', 'Shoes', 'Active', 'picture/apple juice.jpg', '2024-03-13 07:56:31'),
('TOY03', 'Disney lego', 66, '20.00', '', 'Goofy and donald duck disney lego', 'Toy', 'Active', 'picture/disney lego.jpg', '2025-10-05 14:17:56'),
('S04', 'Faber Castle earser', 50, '2.00', '', 'Faber Casttle Dust Free Earser', 'Stationary', 'Active', 'picture/FABER-CASTELL.jpg', '2023-11-15 17:25:33'),
('BAG01', 'Bag', 20, '50.00', 'blue', 'cat blur bag', 'Stationary', 'Active', 'picture/cat school bag.jpg', '2023-11-15 23:06:14'),
('BAG02', 'Bag', 20, '50.00', 'yellow', 'cat blur bag', 'Stationary', 'Active', 'picture/Emoji school bag.jpg', '2023-11-15 23:07:01'),
('10002', 'khngb', 2, '98.00', '', 'jhv', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '2025-09-26 18:01:30'),
('10004', '567890', 3, '678.00', '', 'hn', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '2025-09-26 18:06:50'),
('p01', 'ToothBrush', 97, '20.00', '', 'Tongue cleaner, Travel cap, Replaceable head (for electric), Battery included', 'Personal Care', 'Active', 'picture/toothbrush.png', '2025-10-05 14:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `address`) VALUES
(3, 'Aeon Tebrau', 'Ã†ON Mall Tebrau City, S15 level 2, Centre Court, Aeon Tebrau City Shopping Centre, Persiaran Desa Tebrau, Taman Desa Tebrau, 81100 Johor Bahru, Johor'),
(6, 'Aeon Bukit Indah', 'Grand Mezzanine, 8, Jalan Indah 15/2, Taman Bukit Indah, 81200 Johor Bahru, Johor'),
(7, 'new location', '109, Jalan Putra Squre, Johor Bahru, Johor');

-- --------------------------------------------------------

--
-- Table structure for table `loginouthistory`
--

CREATE TABLE `loginouthistory` (
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `logout` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loginouthistory`
--

INSERT INTO `loginouthistory` (`id`, `username`, `login`, `logout`) VALUES
(164, 'Rihana', '2025-10-08 08:20:38', '2025-10-08 08:20:38'),
(163, 'harzixuan', '2025-10-08 08:19:25', '2025-10-08 08:19:25'),
(162, 'harzixuan', '2025-10-08 08:18:59', '2025-10-08 08:18:59'),
(161, 'harzixuan', '2025-10-08 08:16:43', '2025-10-08 08:16:43'),
(160, 'harzixuan', '2025-10-08 08:16:27', '2025-10-08 08:16:27'),
(159, 'harzixuan', '2025-10-08 08:16:14', '2025-10-08 08:16:14'),
(158, 'harzixuan', '2025-10-08 08:15:24', '2025-10-08 08:15:24'),
(157, 'harzixuan', '2025-10-08 08:14:42', '2025-10-08 08:14:42'),
(156, 'harzixuan', '2025-10-08 08:13:28', '2025-10-08 08:13:28'),
(155, 'harzixuan', '2025-10-08 08:12:56', '2025-10-08 08:12:56'),
(154, 'harzixuan', '2025-10-08 07:59:01', '2025-10-08 07:59:01'),
(153, 'harzixuan', '2025-10-04 07:44:46', '2025-10-04 07:44:46'),
(152, 'harzixuan', '2025-10-04 07:07:38', '2025-10-04 07:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `mainid` int(250) NOT NULL,
  `id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitprice` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `variant` varchar(255) NOT NULL,
  `Action` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`mainid`, `id`, `name`, `quantity`, `unitprice`, `description`, `category`, `status`, `image`, `variant`, `Action`, `date`) VALUES
(282, 'p01', 'ToothBrush', 100, '20.00', '', 'Transfer product to new location', 'Active', 'Transfer product to new location', 'Transfer product to new location', 'Transfer product to new location', '2025-10-04 07:40:18'),
(281, 'p01', 'ToothBrush', 200, '20.00', '', 'Personal Care', 'Active', 'picture/toothbrush.png', '', 'Added to inventory', '2025-10-04 07:38:18'),
(243, 'P01', 'M&G pencil', 50, '5.00', '', 'Stationary', 'Active', 'picture/M&G 2B Pencil.jpg', '', 'Product edited', '2023-11-16 01:14:38'),
(242, 'MP02', 'ArtLine MarkerPen', 7, '2.00', '', 'Stationary', 'Active', 'picture/artline-100-marker-pen-blue.jpg', 'Blue', 'Product edited', '2023-11-16 01:14:16'),
(241, 'MP01', 'ArtLine MarkerPen', 12, '2.00', '', 'Stationary', 'Active', 'picture/Artline 100 Permanent Marker Pen - Red.jpeg', 'Red', 'Product edited', '2023-11-16 01:13:50'),
(240, 'PC25', 'Amongus Pencil Case', 79, '22.00', '', 'Stationery', 'Active', 'picture/Pencil case.jpeg', '', 'Added to inventory', '2023-11-16 01:13:33'),
(239, 'TOY01', 'Gru Toy', 21, '10.00', '', 'Toy', 'Active', 'picture/gru.jpg', '', 'Quantity changed from 40 to 21', '2023-11-16 01:04:53'),
(238, 'C02', 'Metal Spoon', 12, '3.00', '', 'Toy', 'Active', 'picture/spoonx.jpg', '', 'Quantity changed from 20 to 12', '2023-11-16 01:04:22'),
(237, 'P01', 'M&G pencil', 50, '5.00', '', 'Transfer product to Aeon Tebrau', 'Active', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', '2023-11-16 00:57:52'),
(236, 'MP02', 'ArtLine MarkerPen', 42, '2.00', '', 'Transfer product to Aeon Bukit Indah', 'Active', 'Transfer product to Aeon Bukit Indah', 'Transfer product to Aeon Bukit Indah', 'Transfer product to Aeon Bukit Indah', '2023-11-16 00:57:35'),
(235, 'MP01', 'ArtLine MarkerPen', 42, '2.00', '', 'Transfer product to Aeon Tebrau', 'Active', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', '2023-11-16 00:55:01'),
(234, 'MP01', 'ArtLine MarkerPen', 2, '2.00', '', 'Transfer product to Aeon Tebrau', 'Active', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', '2023-11-16 00:45:10'),
(233, 'C02', 'Metal Spoon', 20, '3.00', '', 'Toy', 'Active', 'picture/spoonx.jpg', '', 'Quantity changed from 10 to 20', '2023-11-16 00:44:01'),
(232, 'TOY01', 'Gru Toy', 10, '10.00', '', 'Transfer product to Aeon Tebrau', 'Active', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', '2023-11-16 00:36:56'),
(231, 'SB01', 'Cat school bag', 4, '49.00', '', 'Transfer product to Aeon Bukit Indah', 'Active', 'Transfer product to Aeon Bukit Indah', 'Transfer product to Aeon Bukit Indah', 'Transfer product to Aeon Bukit Indah', '2023-11-15 20:00:15'),
(230, 'TOY01', 'Gru Toy', 50, '10.00', '', 'Toy', 'Active', 'picture/gru.jpg', '', 'Quantity changed from 242 to 50', '2023-11-15 19:59:23'),
(229, 'MP02', 'ArtLine MarkerPen', 7, '2.00', '', 'Transfer product to Aeon Bukit Indah', 'Active', 'Transfer product to Aeon Bukit Indah', 'Transfer product to Aeon Bukit Indah', 'Transfer product to Aeon Bukit Indah', '2023-11-15 19:58:21'),
(228, 'COO2', 'Metal Spatula', 6, '10.00', '', 'Cooking tools', 'Active', 'picture/spatula.jpg', '', 'Added to inventory', '2023-11-15 19:48:49'),
(227, 'C02', 'Metal Spoon', 10, '3.00', '', 'Transfer product to Aeon Tebrau', 'Active', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', '2023-11-15 19:45:06'),
(226, 'C02', 'Metal Spoon', 10, '3.00', '', 'Transfer product to Aeon Tebrau', 'Active', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', 'Transfer product to Aeon Tebrau', '2023-11-15 16:58:11'),
(225, 'TOY01', 'Gru Toy', 242, '10.00', '', 'Toy', 'Active', 'picture/gru.jpg', '', 'Product edited', '2023-11-15 16:49:34'),
(224, 'C02', 'Metal Spoon', 30, '3.00', '', 'Toy', 'Active', 'picture/spoonx.jpg', '', 'Product edited', '2023-11-15 16:48:47'),
(223, 'C02', 'Metal Spoon', 30, '3.00', '', '', 'Active', 'picture/spoonx.jpg', 'metal', 'Product edited', '2023-11-15 16:48:38'),
(214, 'MP01', 'ArtLine MarkerPen', 56, '2.00', '', 'meow', 'Active', 'picture/Artline 100 Permanent Marker Pen - Red.jpeg', 'Red', 'Added to inventory', '2023-11-15 14:55:44'),
(215, 'MP02', 'ArtLine MarkerPen', 56, '2.00', '', 'meow', 'Active', 'picture/artline-100-marker-pen-blue.jpg', 'Blue', 'Added to inventory', '2023-11-15 14:56:39'),
(216, 'SB01', 'Cat school bag', 9, '49.00', '', 'Stationery', 'Active', 'picture/cat school bag.jpg', '', 'Added to inventory', '2023-11-15 15:27:09'),
(217, 'P01', 'M&amp;G pencil', 100, '5.00', '', 'Stationery', 'Active', 'picture/M&G 2B Pencil.jpg', '', 'Added to inventory', '2023-11-15 15:32:25'),
(218, 'DOLL01', 'Gru Toy', 242, '50.00', '', 'Toys', 'Active', 'picture/gru.jpg', '', 'Added to inventory', '2023-11-15 15:35:37'),
(219, 'TOY01', 'Gru Toy', 242, '10.00', '', 'Toys', 'Active', 'picture/gru.jpg', '', 'Product edited', '2023-11-15 15:36:26'),
(220, 'C02', 'Metal Spoon', 30, '3.00', '', 'Toys', 'Active', 'picture/spoonx.jpg', '', 'Added to inventory', '2023-11-15 15:37:49'),
(221, 'MP01', 'ArtLine MarkerPen', 56, '2.00', '', 'Stationery', 'Active', 'picture/Artline 100 Permanent Marker Pen - Red.jpeg', 'Red', 'Product edited', '2023-11-15 15:38:13'),
(222, 'MP02', 'ArtLine MarkerPen', 56, '2.00', '', 'Stationery', 'Active', 'picture/artline-100-marker-pen-blue.jpg', 'Blue', 'Product edited', '2023-11-15 15:38:18'),
(269, '10002', 'fgyui', 6789, '66.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Added to inventory', '2025-09-22 06:51:41'),
(270, '10004', 'ertyu', 67, '67.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Added to inventory', '2025-09-22 06:52:01'),
(271, '10004', 'rtyjk', 98, '8.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Added to inventory', '2025-09-22 07:11:15'),
(272, '10004', '567890', 2, '678.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Added to inventory', '2025-09-22 07:21:44'),
(273, '10004', '567890', 2, '678.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Quantity changed from 0 to 2', '2025-09-22 07:23:04'),
(274, '10004', '567890', 4, '678.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Quantity changed from 0 to 4', '2025-09-22 07:24:52'),
(275, '10004', '567890', 4, '678.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Quantity changed from 1 to 4', '2025-09-22 07:34:09'),
(276, '10002', 'khngb', 4, '98.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Added to inventory', '2025-09-22 07:34:38'),
(277, '10002', 'khngb', 6, '98.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Quantity changed from 2 to 6', '2025-09-26 17:52:00'),
(278, '10002', 'khngb', 6, '98.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Product edited', '2025-09-26 17:52:08'),
(279, '10002', 'khngb', 6, '98.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Quantity changed from 2 to 6', '2025-09-26 17:59:57'),
(280, '10004', '567890', 6, '678.00', '', 'Shoes', 'Active', 'picture/WhatsApp Image 2024-10-09 at 11.27.10 PM.jpeg', '', 'Quantity changed from 2 to 6', '2025-09-26 18:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `sales_report`
--

CREATE TABLE `sales_report` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `unitprice` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_report`
--

INSERT INTO `sales_report` (`id`, `date`, `product_id`, `productname`, `unitprice`, `quantity`) VALUES
(11, '2025-10-05 16:21:09', 'TOY03', 'Disney lego', '20.00', 2),
(12, '2025-10-05 16:20:09', 'p01', 'ToothBrush', '20.00', 1),
(13, '2025-10-05 16:20:09', 'TOY02', 'Monkey toy', '50.00', 1),
(14, '2025-10-05 16:19:09', 'TOY03', 'Disney lego', '20.00', 1),
(15, '2025-10-05 16:22:10', 'p01', 'ToothBrush', '20.00', 1),
(16, '2025-10-05 16:22:09', 'p01', 'ToothBrush', '20.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passw`, `name`, `role`) VALUES
(26, 'admin1', '$2y$10$QywZo8z/lgMkJDHpVx1nXu40/bAQv4BXB31nm.bvMMtlkPcl9Zafy', 'admin1', 'admin'),
(24, 'harzixuan', '$2y$10$RrOZNJeKFrNN7a80pwc7Jurxd/tT7DgXZXpnz59NcZKx9H9mUbMuK', 'harzixuan', 'admin'),
(28, 'Rihana', '$2y$10$wBa1gH1qSE7miV5.lPIGI.6JlSzp80662NAbLtzUDw8OCNB5zvh4e', 'Rihana', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audittrails`
--
ALTER TABLE `audittrails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `companyprofile`
--
ALTER TABLE `companyprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverorder`
--
ALTER TABLE `deliverorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginouthistory`
--
ALTER TABLE `loginouthistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`mainid`);

--
-- Indexes for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audittrails`
--
ALTER TABLE `audittrails`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=806;

--
-- AUTO_INCREMENT for table `companyprofile`
--
ALTER TABLE `companyprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deliverorder`
--
ALTER TABLE `deliverorder`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `loginouthistory`
--
ALTER TABLE `loginouthistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `mainid` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `sales_report`
--
ALTER TABLE `sales_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
