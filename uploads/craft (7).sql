-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 04:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `craft`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `unique_id`, `product_id`, `product_image`, `product_name`, `product_description`, `product_price`, `product_quantity`) VALUES
(150, 433728741, 91, 'imgproducts/67b2c99aad490.png', 't-shirt-gray', 'testing shirt', 123.00, 2),
(160, 1208048809, 88, 'imgproducts/67b2c8a174e57.png', 't-shirt', 'testing shirt', 123.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_image`, `created_at`) VALUES
(44, 'Shirt', 'imgproducts/67bcefdc6f768.jpg', '2025-02-17 05:27:40'),
(45, 'Shorts', 'imgproducts/67bcefc384ab5.jpg', '2025-02-24 19:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(75, 1474936343, 678168143, '[file:Presentation-DOrSU-DICT(1).pptx]'),
(76, 1474936343, 1208048809, '[file:back (1).png]'),
(77, 1474936343, 1208048809, 'hello po'),
(78, 1208048809, 1474936343, '[file:Aqua_com.pdf]'),
(79, 1208048809, 1474936343, '[file:remove.png]');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `unique_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_fee` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'on_hand',
  `method` varchar(50) DEFAULT 'Cash on Delivery'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `unique_id`, `product_id`, `quantity`, `price`, `subtotal`, `shipping_fee`, `total_amount`, `order_date`, `status`, `method`) VALUES
(21, '678168143', '94', 5, 123.00, 615.00, 29.00, 768.00, '2025-05-27 03:15:48', 'on_hand', 'Cash on Delivery'),
(22, '678168143', '95', 1, 124.00, 124.00, 29.00, 768.00, '2026-05-27 03:15:48', 'on_hold', 'Cash on Delivery'),
(25, '678168143', '96', 5, 123.00, 115.00, 29.00, 768.00, '2027-05-27 03:15:48', 'To Deliver', 'Cash on Delivery'),
(26, '678168143', '97', 6, 124.00, 116.00, 29.00, 768.00, '2028-02-27 03:15:48', 'on_hand', 'Cash on Delivery'),
(27, '678168143', '98', 7, 125.00, 117.00, 29.00, 768.00, '2029-02-27 03:15:48', 'on_hold', 'Cash on Delivery'),
(28, '678168143', '99', 8, 126.00, 118.00, 29.00, 768.00, '2030-02-27 03:15:48', 'on_hand', 'Cash on Delivery'),
(29, '678168143', '100', 9, 127.00, 119.00, 29.00, 768.00, '2031-02-27 03:15:48', 'on_hold', 'Cash on Delivery'),
(30, '678168143', '101', 10, 128.00, 120.00, 29.00, 768.00, '2032-02-27 03:15:48', 'on_hand', 'Cash on Delivery'),
(31, '678168143', '102', 11, 129.00, 121.00, 29.00, 768.00, '2033-02-27 03:15:48', 'on_hold', 'Cash on Delivery'),
(32, '678168143', '103', 12, 130.00, 122.00, 29.00, 768.00, '2034-02-27 03:15:48', 'on_hand', 'Cash on Delivery'),
(33, '678168143', '104', 13, 131.00, 123.00, 29.00, 768.00, '2035-02-27 03:15:48', 'on_hold', 'Cash on Delivery'),
(34, '678168143', '105', 14, 132.00, 124.00, 29.00, 768.00, '2036-02-27 03:15:48', 'on_hand', 'Cash on Delivery'),
(35, '678168143', '106', 15, 133.00, 125.00, 29.00, 768.00, '2037-02-27 03:15:48', 'on_hold', 'Cash on Delivery'),
(36, '678168143', '107', 16, 134.00, 126.00, 29.00, 768.00, '2037-02-27 03:15:48', 'on_hand', 'Cash on Delivery'),
(37, '678168143', '108', 17, 135.00, 127.00, 29.00, 768.00, '2025-02-27 03:15:48', 'on_hold', 'Cash on Delivery'),
(38, '678168143', '109', 18, 136.00, 128.00, 29.00, 768.00, '2025-02-27 03:15:48', 'on_hand', 'Cash on Delivery'),
(39, '678168143', '110', 19, 137.00, 129.00, 29.00, 768.00, '2025-02-27 03:15:48', 'on_hold', 'Cash on Delivery'),
(40, '678168143', '111', 20, 138.00, 130.00, 29.00, 768.00, '2025-02-27 03:15:48', 'on_hand', 'Cash on Delivery'),
(41, '678168143', '112', 21, 139.00, 131.00, 29.00, 768.00, '2025-02-27 03:15:48', 'on_hold', 'Cash on Delivery'),
(42, '678168143', '113', 22, 140.00, 132.00, 29.00, 768.00, '2025-02-27 03:15:48', 'on_hand', 'Cash on Delivery'),
(43, '678168143', '114', 23, 141.00, 133.00, 29.00, 768.00, '2025-02-27 03:15:48', 'on_hold', 'Cash on Delivery'),
(44, '678168143', '115', 24, 142.00, 134.00, 29.00, 768.00, '2025-02-27 03:15:48', 'on_hand', 'Cash on Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`, `created_at`) VALUES
(88, 't-shirt', 'shirt', 'testing shirt', 'imgproducts/67b2c8a174e57.png', 'imgproducts/67b2c8a17547a.png', 'imgproducts/67b2c8a1757b1.png', 'imgproducts/67b2c8a175ae2.png', 123.00, 12, 'red', '2025-02-25 02:34:13'),
(89, 't-shirt-blue', 'shirt', 'testing shirt', 'imgproducts/67b2c93b54c2a.png', 'imgproducts/67b2c93b54fe3.png', 'imgproducts/67b2c93b553ad.png', 'imgproducts/67b2c93b55684.png', 123.00, 12, 'red', '2025-02-25 02:34:13'),
(90, 't-shirt-colorful', 'shirt', 'testing shirt', 'imgproducts/67b2c97218064.png', 'imgproducts/67b2c97218389.png', 'imgproducts/67b2c9721866f.png', 'imgproducts/67b2c97218892.png', 123.00, 12, 'red', '2025-02-25 02:34:13'),
(91, 't-shirt-gray', 'shirt', 'testing shirt', 'imgproducts/67b2c99aad490.png', 'imgproducts/67b2c99aada21.png', 'imgproducts/67b2c99aade0f.png', 'imgproducts/67b2c99aae266.png', 123.00, 12, 'red', '2025-02-25 02:34:13'),
(92, 't-shirt-orange', 'shirt', 'testing shirt', 'imgproducts/67b2c9b368368.png', 'imgproducts/67b2c9b368644.png', 'imgproducts/67b2c9b368a30.png', 'imgproducts/67b2c9b368d1d.png', 123.00, 12, 'red', '2025-02-25 02:34:13'),
(93, 't-shirt-red', 'shirt', 'testing shirt', 'imgproducts/67b2c9df485ba.png', 'imgproducts/67b2c9df4885e.png', 'imgproducts/67b2c9df48a4c.png', 'imgproducts/67b2c9df48c09.png', 123.00, 12, 'red', '2025-02-25 02:34:13'),
(94, 't-shirt-white', 'shirt', 'testing shirt', 'imgproducts/67b2ca1246e0d.png', 'imgproducts/67b2ca1247077.png', 'imgproducts/67b2ca12472dc.png', 'imgproducts/67b2ca1248d69.png', 123.00, 12, 'white', '2025-02-25 02:34:13'),
(95, 'red short', 'Short ', 'Testing Short', 'imgproducts/67bcc5a2ccca2.jpg', 'imgproducts/67bcc5a2ccf92.jpg', 'imgproducts/67bcc5a2cd210.jpg', 'imgproducts/67bcc5a2cd471.jpg', 124.00, 12, 'red', '2025-02-25 03:16:50'),
(96, 'white shorts', 'Short ', 'testing short', 'imgproducts/67bcc5ecd8d13.jpg', 'imgproducts/67bcc5ecd8fd5.jpg', 'imgproducts/67bcc5ecd91f7.jpg', 'imgproducts/67bcc5ecd9426.jpg', 125.00, 12, 'white', '2025-02-25 03:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(1, 88, 18, 4, 'ahahha', '2025-06-07 19:43:02'),
(2, 88, 18, 3, 'dsdsd', '2025-06-07 20:12:36'),
(4, 88, 18, 4, 'fsfsfsfs', '2025-06-07 19:58:16'),
(5, 88, 18, 2, NULL, '2025-06-07 19:59:06'),
(6, 88, 18, 5, 'dsdsds', '2025-06-07 19:59:35'),
(8, 89, 18, 3, 'dsdsd', '2025-06-07 20:13:09'),
(9, 89, 18, 4, 'dsdsd', '2025-06-07 20:14:05'),
(10, 89, 18, 2, 'dsdsd', '2025-06-07 20:14:39'),
(11, 90, 18, 5, 'dsdsd', '2025-06-07 20:15:43'),
(12, 91, 18, 2, 'fdfd', '2025-06-07 20:40:33'),
(13, 92, 18, 4, 'dsds', '2025-06-07 20:41:20'),
(14, 93, 18, 1, 'dsds', '2025-06-07 20:41:45'),
(15, 94, 18, 4, 'dsds', '2025-06-07 20:43:04'),
(16, 95, 18, 4, 'dsds', '2025-06-07 20:43:23'),
(17, 96, 18, 4, 'dsds', '2025-06-07 20:43:36'),
(20, 88, 18, 2, 'dsds', '2025-06-07 20:59:14'),
(21, 88, 18, 1, 'dsds', '2025-06-07 21:00:01'),
(22, 88, 18, 1, 'dsds', '2025-06-07 21:00:17'),
(25, 88, 18, 4, 'dsdsd', '2025-06-07 21:21:43'),
(26, 88, 18, 2, 'dsdsd', '2025-06-07 21:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `google_id` varchar(30) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `usertype` enum('admin','user','moderator') NOT NULL DEFAULT 'user',
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiration` datetime DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `confirm_otp` varchar(20) DEFAULT NULL,
  `confirm_otp_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `google_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `usertype`, `otp`, `otp_expiration`, `phone_number`, `address`, `confirm_otp`, `confirm_otp_expiration`) VALUES
(18, 678168143, NULL, 'John Paul', 'Colita', 'colitajohnpaul2@gmail.com', '$2y$10$Z1OHbGWEo.xalI.imnkG9erlRxloID8v2bXIxp.OUW34/wyNPBcQS', 'gotit.png', 'Offline now', 'user', '974300', '2025-02-26 19:45:31', '9756657044', 'P3 Upper Tagawisan, Badas, City of Mati', NULL, NULL),
(19, 1474936343, NULL, 'John', 'Admin', 'admin@gmail.com', '$2y$10$gs8nxcSWE8pwkN27PUuJ8eLjLZ7T2DOqse4p4ijGK48PraY7LyvAS', 'admin.jpg', 'Active now', 'admin', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 1539755056, NULL, 'John Paul', 'Colita', 'colitajohnpaul@gmail.com', '$2y$10$5h0E6vH6ZvX6jevxhHqI8O2kky5PbcuGFjnkLLvr3Rm3.RFHZhlWK', 'avatar.png', 'Offline now', 'user', NULL, NULL, NULL, NULL, NULL, NULL),
(61, 433728741, NULL, 'John Paul ', 'Colita', 'paulcolitapaul@gmail.com', '$2y$10$chgoxfbJEfkr9AhUXc0AOeGd7u.L5MpbHZz1owBKhf.fPmh2LIJsi', 'avatar.png', 'Offline now', 'user', NULL, NULL, '9150522609', 'P3 Upper Tagawisan, Badas, City of Mati', NULL, NULL),
(69, 1208048809, '100779116457734010875', 'JOHN PAUL', 'COLITA', 'johnpaul.colita@dorsu.edu.ph', '', 'https://lh3.googleusercontent.com/a/ACg8ocLLRNA3b38lcvkIL5Aro7RXaQ5EmlfPf4bNe0RTfaXLnvIsMw=s96-c', 'Active now', 'user', NULL, NULL, '9150522600', 'P3 Upper Tagawisan, Badas, City of Mati', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `unique_id` (`unique_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`unique_id`) REFERENCES `users` (`unique_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
