-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 15, 2022 at 06:27 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(16, 'lak', 'lak', 'aa925c658f1fbf1a6dc4caef72687fcbc35f18b9'),
(15, 'moncef', 'moncefmoncef', 'aa925c658f1fbf1a6dc4caef72687fcbc35f18b9');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(51, 'Burger', 'Food_Category_9976.jpg', 'Yes', 'Yes'),
(49, 'Viande', 'Food_Category_8889.jpg', 'Yes', 'Yes'),
(48, 'Pasta', 'Food_Category_891.jpg', 'Yes', 'Yes'),
(42, 'Momo', 'Food_Category_9806.jpg', 'Yes', 'Yes'),
(50, 'Pizza', 'Food_Category_7991.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

DROP TABLE IF EXISTS `tbl_food`;
CREATE TABLE IF NOT EXISTS `tbl_food` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(6, 'Momo', 'Made with Italian Sauce, Chicken, and organice vegetables.', '120.00', 'Food_5680.jpg', 48, 'Yes', 'Yes'),
(13, 'Pizza Viande', 'Made with Italian Sauce, Chicken, and organice vegetables.', '650.00', 'Food_7737.jpg', 50, 'Yes', 'Yes'),
(8, 'AZ', 'Made with Italian Sauce, Chicken, and organice vegetables.', '122.21', 'Food_3393.jpg', 42, 'Yes', 'Yes'),
(10, 'Pizza', 'Made with Italian Sauce, Chicken, and organice vegetables.', '350.00', 'Food_7539.jpg', 50, 'Yes', 'Yes'),
(16, 'Pizza Cheze', 'Made with Italian Sauce, Chicken, and organice vegetables.', '650.00', 'Food_1151.jpg', 50, 'Yes', 'Yes'),
(12, 'Pizza To', 'Made with Italian Sauce, Chicken, and organice vegetables.', '450.00', 'Food_443.jpg', 50, 'Yes', 'Yes'),
(14, 'Mega Burger', 'Made with Italian Sauce, Chicken, and organice vegetables.', '350.00', 'Food_9977.jpg', 51, 'Yes', 'Yes'),
(15, 'Pasta', 'Made with Italian Sauce, Chicken, and organice vegetables.', '700.00', 'Food_8959.jpg', 42, 'Yes', 'Yes'),
(17, 'Soufler', 'Made with Italian Sauce, Chicken, and organice vegetables.', '650.00', 'Food_5961.jpg', 42, 'Yes', 'Yes'),
(19, 'Pizza Italy', 'Made with Italian Sauce, Chicken, and organice vegetables.', '500.00', 'Food_7837.jpg', 50, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `food` varchar(150) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `custome_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_adress` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `custome_contact`, `customer_email`, `customer_adress`) VALUES
(10, 'Pizza', '350.00', 2, '700.00', '2021-04-22 02:06:48', 'ordered', 'Moncef', '0656711226', 'moncifmoncif10@gmail.com', 'Belcort'),
(8, 'Pizza Cheze', '650.00', 3, '1950.00', '2021-04-16 11:35:58', 'delivered', 'Moncef', '0656711226', 'Monceffsf@dvsd.dsf', 'Ain Naaja'),
(11, 'AZ', '122.21', 3, '366.63', '2021-04-22 02:30:54', 'ordered', 'Moncef 2', '055555555555', 'Monceffsf@dvsd.dsf222', 'AIN NAADJA 2'),
(15, 'Pizza', '350.00', 2, '700.00', '2022-06-12 01:05:13', 'delivered', 'hanni', '06695496456', 'hanni@lfk.com', 'city 1610 B22 N04 Gue de Costantine ,Alger'),
(13, 'Pizza Italy', '500.00', 3, '1500.00', '2021-05-08 03:24:31', 'ordered', 'Fatiha', '0662915409', 'Monceffsf@dvsd.dsf', 'Ainnaadja');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
