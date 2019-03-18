-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2019 at 10:32 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
(12, 12, 10, 10, '', '1000', '2019-03-12 14:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `image`, `deleted`) VALUES
(1, 'Shingara', 25, 'images/food-items/shingara.jpg', 0),
(2, 'Chicken BBQ', 45, 'images/food-items/chicken-bbq.jpeg', 0),
(3, 'Coffee', 20, 'images/food-items/coffee.jpeg', 0),
(4, 'Samucha', 15, 'images/food-items/samucha.jpeg', 0),
(5, 'Pudding', 20, 'images/food-items/pudding.jpeg', 0);

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
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `address`, `description`, `date`, `payment_type`, `total`, `status`, `verification_string`, `status_delivered`, `deleted`) VALUES
(1, 2, 'Address 2', 'Sample Description 1', '2017-03-28 17:32:41', 'Wallet', 150, 'Cancelled by Customer', '', 0, 1),
(2, 2, 'New address 2', '', '2017-03-28 17:43:05', 'Wallet', 130, 'Cancelled by Customer', '', 0, 1),
(3, 3, 'Address 3', 'Sample Description 2', '2017-03-28 19:49:33', 'Cash On Delivery', 130, 'Yet to be delivered', '', 0, 0),
(4, 3, 'Address 3', '', '2017-03-28 19:52:01', 'Cash On Delivery', 130, 'Cancelled by Customer', '', 0, 1),
(5, 3, 'New Address 3', '', '2017-03-28 20:47:28', 'Wallet', 285, 'Paused', '', 0, 0),
(6, 3, 'New Address 3', '', '2017-03-30 00:43:31', 'Wallet', 325, 'Cancelled by Customer', '', 0, 1),
(7, 2, '12345', '', '2019-03-10 15:18:08', 'Cash On Delivery', 45, 'Yet to be delivered', '', 0, 0),
(8, 10, '', '', '2019-03-10 20:05:03', 'Wallet', 85, 'Cancelled by Customer', '', 0, 1),
(9, 10, '', '', '2019-03-10 20:06:22', 'Wallet', 45, 'Cancelled by Customer', '', 0, 1),
(10, 11, '', '', '2019-03-12 13:59:39', 'Wallet', 45, 'Cancelled by Customer', '', 0, 1),
(11, 11, '', '', '2019-03-12 14:06:32', 'Wallet', 45, 'Verified', '123', 0, 0),
(12, 11, '', '', '2019-03-17 20:10:38', 'Wallet', 45, 'Verified', '1aRMpsQhOf', 0, 0),
(13, 11, '', '', '2019-03-18 11:48:56', 'Wallet', 45, 'Verified', 'M0CBi8OLsG', 0, 0),
(15, 11, '', '', '2019-03-18 13:36:32', 'Wallet', 25, 'Yet to be delivered', 'LLcgfyc8NG', 0, 0),
(16, 11, '', '', '2019-03-18 14:04:25', 'Wallet', 20, 'Verified', '2AAIsOeFA1', 0, 0),
(17, 11, '', '', '2019-03-18 14:40:46', 'Wallet', 25, 'Yet to be delivered', 'KSBs1r1zUq', 0, 0);

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
(26, 17, 1, 5, 125);

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
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `password`, `email`, `address`, `city`, `post`, `country`, `contact`, `pkey`, `verified`, `deleted`) VALUES
(1, 'Administrator', 'Admin 1', 'root', '$2y$12$fUXNoUTeFwzmKgT6jUV.4OacdqSj3aRSWVqXElldW.kH.u2KXpmaq', 'admin@admin.com', 'Address 1', '', '', 'Bangladesh', 9898000000, NULL, 1, 0),
(2, 'Customer', 'Customer 1', 'user1', 'pass1', 'mail2@example.com', 'Address 2', '', '', 'Bangladesh', 9898000001, NULL, 1, 0),
(3, 'Customer', 'Customer 2', 'user2', 'pass2', 'mail3@example.com', 'Address 3', '', '', 'Bangladesh', 9898000002, NULL, 1, 0),
(4, 'Customer', 'Customer 3', 'user3', 'pass3', 'mail4@example.com', '', '', '', 'Bangladesh', 9898000003, NULL, 0, 0),
(5, 'Customer', 'Customer 4', 'user4', 'pass4', 'mail5@example.com', '', '', '', 'Bangladesh', 9898000004, NULL, 0, 1),
(6, 'Customer', 'Test User 10', 'user10', '12345678', 'mai10@example.com', NULL, '', '', 'Bangladesh', 0, NULL, 0, 0),
(7, 'Customer', 'Test User 12', 'user12', '$2y$12$5f2agh.qS', 'mail12@example.com', NULL, '', '', 'Bangladesh', 0, NULL, 0, 0),
(8, 'Customer', 'Test User 13', 'user13', '$2y$12$9XSp5gDV7iGQ/luKH8xpQ.JVlvvXLaqsbv4T2lAXkdAM.QPqp.ra6', 'mail13@example.com', NULL, '', '', 'Bangladesh', 0, NULL, 0, 0),
(9, 'Customer', 'Test user 14', 'user14', '$2y$12$pIUJ8VzYAj.BIpmMRwE55.4VpgMef0LCCVwqqGCXn9YL.ymeQUYre', 'mail14@example.com', NULL, '', '', 'Bangladesh', 0, NULL, 0, 0),
(10, 'Customer', 'Test User 15', 'user15', '$2y$12$FLAP3evlRka/NJv.H7AuwO1wgg3kL.ek5f8v9OP3pzldBtaZNnJ0e', 'mai15@example.com', 'Bashundhara', 'Hello WOrld', '1250', 'Dinajpur', 1234, NULL, 0, 0),
(11, 'Customer', 'Test User 16', 'user16', '$2y$12$U45/iWmp6uc.qdBBstfvhu5Bie5T0eGRpQXH7WNnuvCtKYn3DhwD6', 'mai16@example.com', 'North South University, Bashundhara R/A', 'Dhaka', '1205', 'Bangladesh', 12345689, 'lpMyhT4BL4mHs', 1, 0),
(12, 'Customer', 'Test User 17', 'user17', '$2y$12$IU4gk1w0bt03s.KnVsg8Zu7SZB6AmVnN27zFbQw4HSqQPWT2FIhYG', 'mail17@example.com', NULL, '', '', 'Bangladesh', 0, 'rNmAdLR45mnnU', 0, 0);

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
(10, 11, 8980),
(11, 12, 10);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
