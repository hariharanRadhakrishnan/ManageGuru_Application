-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2017 at 01:43 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manageguru`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `bill_date` date NOT NULL,
  `bill_num` int(11) NOT NULL,
  `table_num` int(11) NOT NULL,
  `bill_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `table_fill_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `amount` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `user_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bill_date`, `bill_num`, `table_num`, `bill_time`, `table_fill_time`, `amount`, `payment_type`, `customer_name`, `user_name`) VALUES
('2017-11-24', 3, 13, '2017-11-24 06:55:59', '2017-11-23 06:44:46', 74, 'Paytm', '', ''),
('2017-11-24', 4, 5, '2017-11-24 06:57:46', '2017-11-23 06:56:15', 35, 'cash', '', ''),
('2017-11-24', 5, 23, '2017-11-24 07:02:13', '2017-11-24 07:01:10', 85, 'credit card', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item_code` int(11) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `item_type` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_code`, `item_name`, `item_type`, `quantity`) VALUES
(4, 'apple', 'fruit', 20),
(5, 'banana', 'fruit', 50),
(2, 'carrot', 'vegetable', 15),
(6, 'milk', 'dairy', 5),
(3, 'orange', 'fruit', 10),
(1, 'potato', 'vegetable', 20);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_orders`
--

CREATE TABLE `inventory_orders` (
  `item_name` varchar(20) NOT NULL,
  `item_type` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_orders`
--

INSERT INTO `inventory_orders` (`item_name`, `item_type`, `quantity`, `user_name`, `status`) VALUES
('chicken', 'meat', 10, '', 0),
('maida', 'flour', 10, '', 1),
('mango', 'fruit', 5, '', 2),
('mutton', 'meat', 10, '', 2),
('onion', 'vegetable', 10, '', 1),
('tomato', 'vegetable', 90, '', 2),
('wheat flour', 'flour', 10, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `dish_name` varchar(20) NOT NULL,
  `dish_type` varchar(20) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`dish_name`, `dish_type`, `price`) VALUES
('gobi manchurian', 'starter', 50),
('masala dosa', 'tiffin', 35),
('panner manchurian', 'starter', 50),
('vada', 'tiffin', 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `table_num` int(11) NOT NULL,
  `dish_type` varchar(20) NOT NULL,
  `dish_name` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_time`, `table_num`, `dish_type`, `dish_name`, `quantity`, `user_name`) VALUES
('2017-10-21 11:54:34', 1, 'tiffin', 'masala dosa', 2, ''),
('2017-10-21 12:07:05', 1, 'tiffin', 'vada', 2, ''),
('2017-10-21 12:12:49', 1, 'STARTER', 'GOBI MANCHURIAN', 1, ''),
('2017-10-21 12:13:32', 1, 'STARTER', 'PANNER MANCHURIAN', 1, ''),
('2017-10-21 13:01:34', 1, 'STARTER', 'GOBI MANCHURIAN', 1, ''),
('2017-10-21 13:06:18', 1, 'tiffin', 'masala dosa', 1, ''),
('2017-10-21 13:07:37', 1, 'starter', 'panner manchurian', 2, ''),
('2017-10-21 13:07:42', 1, 'tiffin', 'vada', 2, ''),
('2017-10-21 13:08:38', 1, 'tiffin', 'vada', 1, ''),
('2017-10-21 13:14:19', 1, 'tiffin', 'vada', 1, ''),
('2017-10-21 14:02:19', 1, 'starter', 'gobi manchurian', 1, ''),
('2017-10-21 14:13:41', 1, 'starter', 'gobi manchurian', -1, ''),
('2017-10-21 14:23:00', 1, 'starter', 'gobi manchurian', 1, ''),
('2017-10-21 14:23:04', 1, 'starter', 'gobi manchurian', -1, ''),
('2017-10-21 14:23:37', 1, 'tiffin', 'masala dosa', 1, ''),
('2017-10-21 14:23:48', 1, 'tiffin', 'masala dosa', -1, ''),
('2017-10-21 14:25:13', 1, 'tiffin', 'masala dosa', 1, ''),
('2017-10-21 14:25:17', 1, 'tiffin', 'masala dosa', -1, ''),
('2017-10-21 14:25:31', 1, 'starter', 'gobi manchurian', 1, ''),
('2017-10-21 14:25:44', 1, 'starter', 'gobi manchurian', -1, ''),
('2017-11-23 06:43:36', 1, 'starter', 'gobi manchurian', 2, ''),
('2017-11-23 06:44:46', 13, 'starter', 'panner manchurian', 1, ''),
('2017-11-23 06:56:15', 5, 'tiffin', 'masala dosa', 1, ''),
('2017-11-23 06:56:34', 13, 'tiffin', 'vada', 2, ''),
('2017-11-24 07:01:10', 23, 'starter', 'gobi manchurian', 1, ''),
('2017-11-24 07:01:46', 23, 'tiffin', 'masala dosa', 1, ''),
('2017-11-24 07:52:21', 13, 'starter', 'gobi manchurian', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_num` int(11) NOT NULL,
  `num_of_people` int(11) NOT NULL,
  `filled` int(11) NOT NULL,
  `filled_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_num`, `num_of_people`, `filled`, `filled_time`) VALUES
(1, 4, 0, '2017-11-23 06:43:36'),
(5, 4, 0, '2017-11-23 06:56:15'),
(13, 4, 1, '2017-11-24 07:52:21'),
(23, 4, 0, '2017-11-24 07:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logout_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `password`, `user_type`, `login_time`, `logout_time`) VALUES
('hariharan', 'a9bcf1e4d7b95a22e2975c812d938889', 'chef', '2017-11-24 07:44:57', '2017-11-24 07:14:48'),
('nirmit', 'b4c0de9803d05ee007366029d2a7cf62', 'setupacc', '2017-11-24 08:05:10', '0000-00-00 00:00:00'),
('ramya', '4641999a7679fcaef2df0e26d11e3c72', 'waiter', '2017-11-24 08:01:40', '2017-11-24 06:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`bill_num`,`bill_date`,`table_num`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_name`,`item_type`),
  ADD UNIQUE KEY `item_code` (`item_code`);

--
-- Indexes for table `inventory_orders`
--
ALTER TABLE `inventory_orders`
  ADD PRIMARY KEY (`item_name`,`item_type`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`dish_name`,`dish_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_time`,`table_num`,`dish_type`,`dish_name`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_num`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `bill_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
