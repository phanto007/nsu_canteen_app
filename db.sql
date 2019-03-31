-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2019 at 08:46 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `table3`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `received_amount` double NOT NULL DEFAULT '0',
  `response` text NOT NULL,
  `txn_status` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `customer_id`, `amount`, `received_amount`, `response`, `txn_status`, `timestamp`) VALUES
(1, 12, 0, 0, '', '', '2019-03-12 13:53:20'),
(2, 12, 10, 0, '', '', '2019-03-12 13:53:51'),
(3, 12, 10, 0, '', '', '2019-03-12 13:55:48'),
(4, 12, 20, 0, '', '', '2019-03-12 13:58:11'),
(5, 12, 20, 0, '', '', '2019-03-12 13:59:50'),
(6, 12, 20, 0, '', '', '2019-03-12 14:02:33'),
(7, 12, 20, 0, '', '', '2019-03-12 14:06:56'),
(8, 12, 10, 0, '', '', '2019-03-12 14:12:09'),
(9, 12, 10, 10, 'asdasd', '1000', '2019-03-12 14:14:39'),
(10, 12, 22, 22, '', '1000', '2019-03-12 14:20:44'),
(11, 12, 20, 0, '', '', '2019-03-12 14:23:07'),
(12, 12, 10, 10, '', '1000', '2019-03-12 14:28:18'),
(13, 11, 4000, 0, '', '', '2019-03-18 13:50:20'),
(14, 11, 123, 0, '', '', '2019-03-19 06:42:42'),
(15, 11, 2000, 0, '', '', '2019-03-19 07:53:25'),
(16, 11, 2000, 0, '', '', '2019-03-19 12:36:10'),
(17, 11, 2000, 0, '', '', '2019-03-19 12:47:16'),
(18, 11, 2000, 0, '', '', '2019-03-19 12:50:16'),
(19, 13, 50, 0, '', '', '2019-03-19 13:01:18'),
(20, 13, 50, 50, '', '1000', '2019-03-19 13:03:20'),
(21, 11, 2000, 0, '', '', '2019-03-19 13:07:21'),
(22, 11, 123, 0, '', '', '2019-03-27 08:11:59'),
(23, 11, 4000, 4000, '', '1000', '2019-03-27 08:14:06'),
(24, 11, 50, 0, '', '', '2019-03-27 09:03:20'),
(25, 11, 50, 50, '', '1000', '2019-03-27 09:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `calorie` double NOT NULL,
  `image` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `calorie`, `image`, `deleted`) VALUES
(1, 'Shingara', 25, 150, 'images/food-items/shingara.jpg', 0),
(2, 'Chicken BBQ', 45, 300, 'images/food-items/chicken-bbq.jpeg', 0),
(3, 'Coffee', 20, 100, 'images/food-items/coffee.jpeg', 0),
(4, 'Samucha', 15, 120, 'images/food-items/samucha.jpeg', 0),
(5, 'Pudding', 20, 500, 'images/food-items/pudding.jpeg', 0),
(6, 'Halua', 10, 200, 'images/food-items/halua.jpeg', 0),
(7, 'Lemon Juice', 10, 60, 'images/food-items/lemon-juice.jpg', 0),
(8, 'Noodles', 35, 450, 'images/food-items/noodles.jpg', 0),
(9, 'Fruit Salad', 50, 350, 'images/food-items/salad.jpeg', 0),
(10, 'test1', 10, 0, 'images/food-items/Cat03.jpg', 0),
(11, 'Pizza', 120, 1200, 'images/food-items/pizza.jpeg', 0),
(12, 'Fish and Chips', 300, 650, 'images/food-items/fishandchips.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `description` varchar(300) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_type` varchar(16) NOT NULL DEFAULT 'Wallet',
  `total` int(11) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'Yet to be delivered',
  `verification_string` varchar(10) NOT NULL,
  `status_delivered` tinyint(1) NOT NULL DEFAULT '0',
  `status_delivered_2` tinyint(1) NOT NULL,
  `status_delivered_3` tinyint(1) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `address`, `description`, `date`, `payment_type`, `total`, `status`, `verification_string`, `status_delivered`, `status_delivered_2`, `status_delivered_3`, `deleted`) VALUES
(1, 2, 'Address 2', 'Sample Description 1', '2017-03-28 17:32:41', 'Wallet', 150, 'Cancelled by Customer', '', 0, 1, 1, 1),
(2, 2, 'New address 2', '', '2017-03-28 17:43:05', 'Wallet', 130, 'Cancelled by Customer', '', 0, 1, 1, 1),
(3, 3, 'Address 3', 'Sample Description 2', '2017-03-28 19:49:33', 'Cash On Delivery', 130, 'Yet to be delivered', '', 0, 1, 1, 0),
(4, 3, 'Address 3', '', '2017-03-28 19:52:01', 'Cash On Delivery', 130, 'Cancelled by Customer', '', 0, 1, 1, 1),
(5, 3, 'New Address 3', '', '2017-03-28 20:47:28', 'Wallet', 285, 'Paused', '', 0, 1, 1, 0),
(6, 3, 'New Address 3', '', '2017-03-30 00:43:31', 'Wallet', 325, 'Cancelled by Customer', '', 0, 1, 1, 1),
(7, 2, '12345', '', '2019-03-10 15:18:08', 'Cash On Delivery', 45, 'Yet to be delivered', '', 0, 1, 1, 0),
(8, 10, '', '', '2019-03-10 20:05:03', 'Wallet', 85, 'Cancelled by Customer', '', 0, 1, 1, 1),
(9, 10, '', '', '2019-03-10 20:06:22', 'Wallet', 45, 'Cancelled by Customer', '', 0, 1, 1, 1),
(10, 11, '', '', '2019-03-12 13:59:39', 'Wallet', 45, 'Cancelled by Customer', '', 1, 1, 1, 1),
(11, 11, '', '', '2019-03-12 14:06:32', 'Wallet', 45, 'Verified', '123', 1, 1, 1, 0),
(12, 11, '', '', '2019-03-17 20:10:38', 'Wallet', 45, 'Verified', '1aRMpsQhOf', 1, 1, 1, 0),
(13, 11, '', '', '2019-03-18 11:48:56', 'Wallet', 45, 'Verified', 'M0CBi8OLsG', 1, 1, 1, 0),
(15, 11, '', '', '2019-03-18 13:36:32', 'Wallet', 25, 'Cancelled by Customer', 'LLcgfyc8NG', 1, 1, 1, 1),
(16, 11, '', '', '2019-03-18 14:04:25', 'Wallet', 20, 'Verified', '2AAIsOeFA1', 1, 1, 1, 0),
(17, 11, '', '', '2019-03-18 14:40:46', 'Wallet', 25, 'Cancelled by Customer', 'KSBs1r1zUq', 1, 1, 1, 1),
(18, 11, '', '', '2019-03-18 15:50:08', 'Wallet', 50, 'Verified', 'hNDd9KbZv1', 1, 1, 1, 0),
(19, 11, '', '', '2019-03-18 15:59:44', 'Wallet', 45, 'Cancelled by Customer', 'w0BuVBw0L4', 1, 1, 1, 1),
(20, 11, '', '', '2019-03-18 16:19:13', 'Wallet', 100, 'Ready for pickup', 'a7nl4g8MbT', 1, 1, 1, 0),
(21, 11, '', '', '2019-03-18 16:42:20', 'Wallet', 25, 'Ready for pickup', 'FUHRtagh35', 1, 1, 1, 0),
(22, 11, '', '', '2019-03-18 17:53:41', 'Wallet', 125, 'Ready for pickup', 'i6PtvOpdpB', 1, 1, 1, 0),
(23, 11, '', '', '2019-03-18 18:23:12', 'Wallet', 55, 'Ready for pickup', 'YFmSrmaNVN', 1, 1, 1, 0),
(24, 11, '', '', '2019-03-18 19:47:11', 'Wallet', 100, 'Verified', 'R1RonOWRJ4', 1, 1, 1, 0),
(25, 11, '', '', '2019-03-19 10:50:31', 'Wallet', 55, 'Ready for pickup', '9biflchizk', 1, 1, 1, 0),
(26, 11, '', '', '2019-03-19 12:20:57', 'Wallet', 25, 'Yet to be delivered', 'fQxE6u9Xch', 1, 1, 1, 0),
(27, 11, '', '', '2019-03-19 12:37:29', 'Wallet', 45, 'Ready for pickup', 'jGwwx01Pl0', 1, 1, 1, 0),
(28, 11, '', '', '2019-03-19 13:56:36', 'Wallet', 175, 'Cancelled by Customer', 'LpvAicYZmb', 1, 1, 1, 1),
(29, 11, '', '', '2019-03-19 19:19:37', 'Wallet', 95, 'Cancelled by Customer', 'vYj3axdt3g', 1, 1, 1, 1),
(30, 11, '', 'Fresh food please! ', '2019-03-20 09:23:14', 'Wallet', 95, 'Verified', '3f3kWQ9lIf', 1, 1, 1, 0),
(31, 11, '', '', '2019-03-22 17:54:49', 'Wallet', 25, 'Yet to be delivered', 'OSHafLftPi', 1, 1, 1, 0),
(32, 11, '', '', '2019-03-22 18:03:47', 'Wallet', 25, 'Yet to be delivered', 'aAIFXd0SPT', 1, 1, 1, 0),
(33, 11, '', '', '2019-03-22 19:00:55', 'Wallet', 50, 'Yet to be delivered', 'G3UWdCVk6f', 1, 1, 1, 0),
(34, 11, '', '', '2019-03-22 19:04:09', 'Wallet', 0, 'Yet to be delivered', 'CuCZJXBcw9', 1, 1, 1, 0),
(35, 11, '', '', '2019-03-22 19:34:43', 'Wallet', 50, 'Verified', 'dOEsYhWgZV', 1, 1, 1, 0),
(36, 11, '', '', '2019-03-27 13:02:11', 'Wallet', 25, 'Processing', 'b1Yo1xwFRq', 1, 1, 1, 0),
(37, 11, '', '', '2019-03-27 14:02:05', 'Wallet', 35, 'Yet to be delivered', '0jYCuiP4a4', 1, 1, 1, 0),
(38, 11, '', '', '2019-03-27 14:02:09', 'Wallet', 35, 'Verified', 'PqJFK0l7yn', 1, 1, 1, 0),
(39, 11, '', '', '2019-03-27 14:21:39', 'Wallet', 20, 'Paused', 'uCkYghBDiC', 1, 0, 1, 0),
(40, 11, '', '', '2019-03-27 15:00:15', 'Wallet', 70, 'Delivered', 'WQFSUmmfb0', 1, 0, 1, 0),
(41, 11, '', '', '2019-03-27 15:07:19', 'Wallet', 250, 'Yet to be delivered', 'ugcb7Q7cVa', 1, 0, 1, 0),
(42, 11, '', '', '2019-03-30 17:48:18', 'Wallet', 90, 'Cancelled by Customer', 'mTBqgQtqqd', 1, 0, 1, 1),
(43, 11, '', '', '2019-03-30 20:46:25', 'Wallet', 100, 'Verified', 'DW4qUC1Q6O', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(1, 1, 2, 2, 90),
(2, 1, 3, 3, 60),
(3, 2, 2, 2, 90),
(4, 2, 3, 2, 40),
(5, 3, 2, 2, 90),
(6, 3, 3, 2, 40),
(7, 4, 2, 2, 90),
(8, 4, 3, 2, 40),
(9, 5, 2, 5, 225),
(10, 5, 3, 2, 40),
(11, 5, 5, 1, 20),
(12, 6, 2, 5, 225),
(13, 6, 3, 3, 60),
(14, 6, 5, 2, 40),
(15, 7, 2, 1, 45),
(16, 8, 2, 1, 45),
(17, 8, 3, 1, 20),
(18, 8, 5, 1, 20),
(19, 9, 2, 1, 45),
(20, 10, 2, 1, 45),
(21, 11, 2, 2, 90),
(22, 12, 2, 1, 45),
(23, 13, 2, 7, 315),
(24, 15, 1, 1, 25),
(25, 16, 3, 2, 40),
(26, 17, 1, 5, 125),
(27, 18, 1, 2, 50),
(28, 19, 4, 3, 45),
(29, 20, 3, 5, 100),
(30, 21, 1, 1, 25),
(31, 22, 1, 5, 125),
(32, 23, 3, 1, 20),
(33, 23, 8, 1, 35),
(34, 24, 9, 2, 100),
(35, 25, 3, 1, 20),
(36, 25, 4, 1, 15),
(37, 25, 5, 1, 20),
(38, 26, 1, 1, 25),
(39, 27, 2, 1, 45),
(40, 28, 1, 1, 25),
(41, 28, 2, 2, 90),
(42, 28, 3, 3, 60),
(43, 29, 7, 1, 10),
(44, 29, 8, 1, 35),
(45, 29, 9, 1, 50),
(46, 30, 7, 1, 10),
(47, 30, 8, 1, 35),
(48, 30, 9, 1, 50),
(49, 31, 1, 1, 25),
(50, 32, 1, 1, 25),
(51, 33, 9, 1, 50),
(52, 35, 1, 2, 50),
(53, 36, 1, 1, 25),
(54, 37, 8, 1, 35),
(55, 38, 8, 1, 35),
(56, 39, 10, 2, 20),
(57, 40, 1, 2, 50),
(58, 40, 3, 1, 20),
(59, 41, 1, 1, 25),
(60, 41, 2, 5, 225),
(61, 42, 1, 1, 25),
(62, 42, 2, 1, 45),
(63, 42, 3, 1, 20),
(64, 43, 1, 4, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'Open',
  `type` varchar(30) NOT NULL DEFAULT 'Others',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `poster_id`, `subject`, `description`, `status`, `type`, `date`, `deleted`) VALUES
(1, 2, 'Subject 1', 'New Description for Subject 1', 'Answered', 'Support', '2017-03-30 18:08:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details`
--

CREATE TABLE `ticket_details` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_details`
--

INSERT INTO `ticket_details` (`id`, `ticket_id`, `user_id`, `description`, `date`) VALUES
(1, 1, 2, 'New Description for Subject 1', '2017-03-30 18:08:51'),
(2, 1, 2, 'Reply-1 for Subject 1', '2017-03-30 19:59:09'),
(3, 1, 1, 'Reply-2 for Subject 1 from Administrator.', '2017-03-30 20:35:39'),
(4, 1, 1, 'Reply-3 for Subject 1 from Administrator.', '2017-03-30 20:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'Customer',
  `name` varchar(15) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(35) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `city` varchar(20) NOT NULL,
  `post` varchar(20) NOT NULL,
  `country` varchar(50) NOT NULL DEFAULT 'Bangladesh',
  `contact` bigint(11) NOT NULL,
  `pkey` varchar(13) DEFAULT NULL,
  `calorie` double DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `password`, `email`, `address`, `city`, `post`, `country`, `contact`, `pkey`, `calorie`, `verified`, `deleted`) VALUES
(1, 'Administrator', 'Admin 1', 'root', '$2y$12$fUXNoUTeFwzmKgT6jUV.4OacdqSj3aRSWVqXElldW.kH.u2KXpmaq', 'admin@admin.com', 'Address 1', '', '', 'Bangladesh', 9898000000, NULL, NULL, 1, 0),
(2, 'Customer', 'Customer 1', 'user1', 'pass1', 'mail2@example.com', 'Address 2', '', '', 'Bangladesh', 9898000001, NULL, NULL, 1, 0),
(3, 'Customer', 'Customer 2', 'user2', 'pass2', 'mail3@example.com', 'Address 3', '', '', 'Bangladesh', 9898000002, NULL, NULL, 1, 0),
(4, 'Customer', 'Customer 3', 'user3', 'pass3', 'mail4@example.com', '', '', '', 'Bangladesh', 9898000003, NULL, NULL, 0, 0),
(5, 'Customer', 'Customer 4', 'user4', 'pass4', 'mail5@example.com', '', '', '', 'Bangladesh', 9898000004, NULL, NULL, 0, 0),
(6, 'Customer', 'Test User 10', 'user10', '12345678', 'mai10@example.com', NULL, '', '', 'Bangladesh', 0, NULL, NULL, 0, 0),
(7, 'Customer', 'Test User 12', 'user12', '$2y$12$5f2agh.qS', 'mail12@example.com', NULL, '', '', 'Bangladesh', 0, NULL, NULL, 0, 0),
(8, 'Customer', 'Test User 13', 'user13', '$2y$12$9XSp5gDV7iGQ/luKH8xpQ.JVlvvXLaqsbv4T2lAXkdAM.QPqp.ra6', 'mail13@example.com', NULL, '', '', 'Bangladesh', 0, NULL, NULL, 0, 0),
(9, 'Customer', 'Test user 14', 'user14', '$2y$12$pIUJ8VzYAj.BIpmMRwE55.4VpgMef0LCCVwqqGCXn9YL.ymeQUYre', 'mail14@example.com', NULL, '', '', 'Bangladesh', 0, NULL, NULL, 0, 0),
(10, 'Customer', 'Test User 15', 'user15', '$2y$12$FLAP3evlRka/NJv.H7AuwO1wgg3kL.ek5f8v9OP3pzldBtaZNnJ0e', 'mai15@example.com', 'Bashundhara', 'Hello WOrld', '1250', 'Dinajpur', 1234, NULL, NULL, 0, 0),
(11, 'Customer', 'Test User 16', 'user16', '$2y$12$U45/iWmp6uc.qdBBstfvhu5Bie5T0eGRpQXH7WNnuvCtKYn3DhwD6', 'mai16@example.com', 'North South University, Bashundhara R/A', 'Dhaka', '1205', 'Bangladesh', 12345689, 'lpMyhT4BL4mHs', 2052, 1, 0),
(12, 'Customer', 'Test User 17', 'user17', '$2y$12$IU4gk1w0bt03s.KnVsg8Zu7SZB6AmVnN27zFbQw4HSqQPWT2FIhYG', 'mail17@example.com', NULL, '', '', 'Bangladesh', 0, 'rNmAdLR45mnnU', NULL, 0, 0),
(13, 'Customer', 'asd', 'user18', '$2y$12$STix7MRkzsJlNYcjZCXW9eDsi2O/SVb.DnAT1R80SgbyVCkoHReVe', 'asd@asd.com', NULL, '', '', 'Bangladesh', 0, 'IA3lMuQwKCU2K', NULL, 0, 0),
(14, 'Customer', 'Edwardthish', 'Edwardthis', '$2y$12$h4b5xA5JVGeCarK/PqpKWuafp7coQw9/xxfAHmXIZ8OsPx2ZKsn3i', 'khaydaralikas9@mail.ru', NULL, '', '', 'Bangladesh', 0, 'ac9M4gmj5kPsG', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `balance` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `customer_id`, `balance`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0),
(7, 7, 0),
(8, 8, 0),
(9, 10, 1915),
(10, 11, 50),
(11, 12, 10),
(12, 13, 50),
(13, 14, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poster_id` (`poster_id`);

--
-- Indexes for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `string` (`pkey`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_details`
--
ALTER TABLE `ticket_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`poster_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD CONSTRAINT `ticket_details_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `ticket_details_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
