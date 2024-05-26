-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2024 at 04:13 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `street_nb` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `user_id`, `street_nb`, `country`, `state`, `city`, `zipCode`) VALUES
(37, 29, '10000', 'tyre', 'tyre', 'tyre', 124),
(38, 30, 'asdf', 'sdf', 'sdf', 'sdf', 0),
(39, 31, '147', 'Tyre', 'Tyre', 'Tyre', 1425),
(40, 32, '123', 'Saida', 'saida', 'Saida', 123),
(41, 33, '693', 'Tyre', 'Tyre', 'Tyre', 399);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `prod_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `cat_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `cat_image`) VALUES
(63, 'cat-2', 'img1.jpeg'),
(64, 'cat-3', 'img15.jpg'),
(65, 'cat-4', 'img14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `name` varchar(255) NOT NULL,
  `limitt` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `discount` int(11) NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`name`, `limitt`, `expiry_date`, `discount`, `coupon_id`) VALUES
('sdf', 0, '2023-12-15', 20, 10),
('black', 0, '2023-12-07', 3, 11),
('sdf2', 18, '2023-12-05', 15, 12),
('sdf3', 81, '2023-12-31', 17, 13);

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `footer_id` int(10) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`footer_id`, `address`, `email`, `phone_number`) VALUES
(1, '123 Street, New York, USAx', 'khaled@gmail.com', '+012 345 6789');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `carousel_id` int(10) UNSIGNED NOT NULL,
  `head_title` varchar(255) NOT NULL,
  `primary_title` varchar(255) NOT NULL,
  `carousel_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`carousel_id`, `head_title`, `primary_title`, `carousel_image`) VALUES
(57, 'xcvxz', 'dfsdf', 'img15.jpg'),
(58, 'sdfas', 'sdfa', 'img13-0.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(10) UNSIGNED NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_name`, `product_id`) VALUES
(127, 'teacher4-1-15.jpg', 0),
(128, 'teacher4-1-1 - Copy-21.jpg', 0),
(129, 'teacher4-1-1-17.jpg', 0),
(130, 'teacher4-1-16.jpg', 107),
(131, 'teacher4-1-1 - Copy-22.jpg', 107),
(132, 'teacher4-1-1-18.jpg', 107),
(135, 'teacher3-1-1-5.jpg', 108),
(136, 'teacher3-1-1-1-6.jpg', 108),
(137, 'teacher4-12.jpg', 108),
(138, 'teacher4-1-17.jpg', 108),
(139, 'teacher4-1-1 - Copy-24.jpg', 108),
(140, 'teacher4-1-1-20.jpg', 108),
(142, 'man4.jpg', 106),
(145, 'man2.jpg', 106),
(146, 'women1.jpg', 106),
(147, 'women3.jpg', 106),
(148, 'cat-1.jpg', 109),
(149, 'images (1).jpeg', 110),
(150, 'images (2).jpeg', 111),
(151, 'images (4).jpeg', 112),
(153, 'man4-2.jpg', 114),
(154, 'women5.jpg', 115),
(155, 'women5-0.jpg', 116),
(157, 'women4.jpg', 117),
(158, 'women5-1.jpg', 117),
(159, 'women4-0.jpg', 117),
(163, 'images (4)-0.jpeg', 113),
(164, 'women3-1.jpg', 113),
(165, 'women4-1.jpg', 113),
(166, 'women5-2.jpg', 113),
(170, 'women4-0.jpg', 120),
(171, 'women5-0.jpg', 120),
(172, 'women5-1.jpg', 114),
(173, 'women2.jpg', 114),
(174, 'women3-0.jpg', 114),
(175, 'women4-1.jpg', 114),
(176, 'women5-2.jpg', 114),
(177, 'man4-0.jpg', 121),
(178, 'man4-0-0.jpg', 114),
(179, 'man4-0-0-0.jpg', 114),
(180, 'cat-1.jpg', 117),
(182, 'cat-1-0.jpg', 119),
(183, 'images (1).jpeg', 122),
(185, 'images (4).jpeg', 121),
(187, 'women4-4.jpg', 124),
(188, 'women3-1.jpg', 125),
(208, 'women3-min.jpg', 123),
(209, 'women4-min.jpg', 123),
(210, 'women5-min.jpg', 123),
(211, 'images-min.jpeg', 126),
(212, 'man1-min.jpg', 126),
(213, 'women1-min (1).jpg', 126),
(214, 'images (1)-min (1).jpeg', 127),
(215, 'images (2)-min.jpeg', 127),
(216, 'images (3)-min.jpeg', 127),
(217, 'images (3)-min-0.jpeg', 128),
(218, 'images (4)-min.jpeg', 128),
(219, 'images-min-0.jpeg', 128),
(220, 'images (4)-min (1).jpeg', 129),
(221, 'images-min-1.jpeg', 129),
(222, 'man1-min-0.jpg', 130),
(223, 'women2-min.jpg', 130),
(224, 'images (4)-min (1)-0.jpeg', 132),
(225, 'images (4)-min-0.jpeg', 132),
(226, 'images-min (1).jpeg', 132),
(227, 'images-min-2.jpeg', 132),
(228, 'women4-min-0.jpg', 132),
(229, 'women5-min-0.jpg', 132),
(230, 'images (1)-min.jpeg', 133),
(231, 'women3-min (1).jpg', 133),
(232, 'images (4)-min-1.jpeg', 134),
(233, 'images-min (1)-0.jpeg', 134),
(234, 'images-min-3.jpeg', 134),
(235, 'man1-min-1.jpg', 134),
(236, 'women5-min-1.jpg', 134),
(237, 'images (2)-min-0.jpeg', 135),
(238, 'women3-min (1)-0.jpg', 135),
(240, 'images (4)-min (1)-1.jpeg', 131),
(241, 'images (4)-min-2.jpeg', 131),
(242, 'images-min (1)-1.jpeg', 131),
(243, 'images-min-4.jpeg', 131),
(244, 'man1-min-2.jpg', 131),
(245, 'women4-min-1.jpg', 131),
(246, 'women5-min-2.jpg', 131),
(248, 'img3.jpeg', 130),
(249, 'img4.jpeg', 130),
(250, 'img5.jpeg', 130),
(251, 'img13.jpeg', 130),
(252, 'img14.jpg', 130),
(253, 'img15.jpg', 130),
(255, 'teacher4-1-1 - Copy-21.jpg', 0),
(256, 'teacher4-1-1-17.jpg', 0),
(258, 'teacher4-1-1 - Copy-22.jpg', 107),
(259, 'teacher4-1-1-18.jpg', 107),
(261, 'teacher3-1-1-1-6.jpg', 108),
(264, 'teacher4-1-1 - Copy-24.jpg', 108),
(265, 'teacher4-1-1-20.jpg', 108),
(266, 'man4.jpg', 106),
(267, 'man2.jpg', 145),
(268, 'women1.jpg', 146),
(269, 'women3.jpg', 147),
(270, 'cat-1.jpg', 148),
(271, 'images (1).jpeg', 149),
(272, 'images (2).jpeg', 150),
(273, 'images (4).jpeg', 151),
(274, 'man4-2.jpg', 153),
(275, 'women5.jpg', 154),
(276, 'women5-0.jpg', 155),
(277, 'women4.jpg', 157),
(278, 'women5-1.jpg', 158),
(279, 'img13-0.jpeg', 136),
(280, 'img14-0.jpg', 136),
(281, 'img15-0.jpg', 136),
(282, 'img2.jpeg', 137),
(283, 'img3-0.jpeg', 137),
(284, 'img4-0.jpeg', 137),
(285, 'img12.jpg', 137),
(286, 'img13-1.jpeg', 137),
(287, 'img14-1.jpg', 137),
(288, 'img1.jpeg', 162),
(289, 'img2-0.jpeg', 162),
(290, 'img3-1.jpeg', 162),
(291, 'img4-1.jpeg', 162),
(292, 'img5-0.jpeg', 162),
(293, 'img6.jpg', 162),
(294, 'img11.jpg', 162),
(295, 'img12-0.jpg', 162),
(296, 'img13-2.jpeg', 162),
(297, 'img14-2.jpg', 162),
(298, 'img15-1.jpg', 162),
(299, 'img14-3.jpg', 163),
(300, 'img15-2.jpg', 163),
(301, 'img3-2.jpeg', 164),
(302, 'img13-3.jpeg', 164),
(303, 'img1-0.jpeg', 165),
(304, 'img2-1.jpeg', 165),
(305, 'img11-0.jpg', 165),
(306, 'img12-1.jpg', 165),
(307, 'img2-2.jpeg', 166),
(308, 'img12-2.jpg', 166),
(309, 'img3-3.jpeg', 167),
(310, 'img13-4.jpeg', 167),
(311, 'img4-2.jpeg', 168),
(312, 'img5-1.jpeg', 168),
(313, 'img6-0.jpg', 168),
(314, 'img14-4.jpg', 168),
(315, 'img15-3.jpg', 168),
(316, 'img4-3.jpeg', 169),
(317, 'img14-5.jpg', 169),
(318, 'img13-5.jpeg', 170),
(319, 'img14-6.jpg', 170);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `total_price` float NOT NULL,
  `order_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `status`, `total_price`, `order_price`) VALUES
(36, 29, '2023-12-10 15:21:00', 'unPaid', 386, 33),
(37, 29, '2023-12-10 15:21:00', 'unPaid', 386, 343),
(38, 29, '2023-12-10 15:25:32', 'unPaid', 55, 45),
(39, 29, '2023-12-11 07:44:14', 'unPaid', 353, 343),
(40, 29, '2023-12-11 07:48:37', 'unPaid', 43, 33),
(41, 29, '2023-12-11 07:49:07', 'unPaid', 133, 123),
(42, 29, '2023-12-11 10:32:55', 'unPaid', 65, 12),
(43, 29, '2023-12-11 10:32:55', 'unPaid', 65, 43),
(44, 29, '2023-12-11 10:45:41', 'unPaid', 232, 43),
(45, 29, '2023-12-11 10:45:41', 'unPaid', 232, 45),
(46, 29, '2023-12-11 10:45:41', 'unPaid', 232, 22),
(47, 29, '2023-12-12 07:34:07', 'unPaid', 52, 14),
(48, 29, '2023-12-12 09:13:26', 'unPaid', 87, 12),
(49, 29, '2023-12-12 09:13:26', 'unPaid', 87, 13),
(50, 30, '2023-12-12 15:41:05', 'unPaid', 29, 19),
(51, 31, '2023-12-12 15:45:52', 'unPaid', 76, 22),
(52, 29, '2023-12-12 15:48:23', 'unPaid', 42, 16),
(53, 29, '2023-12-12 16:36:50', 'unPaid', 595, 18),
(54, 29, '2023-12-12 16:36:50', 'unPaid', 595, 21),
(55, 29, '2023-12-12 16:36:50', 'unPaid', 595, 243),
(56, 31, '2023-12-12 16:37:57', 'unPaid', 66, 16),
(57, 31, '2023-12-12 16:37:57', 'unPaid', 66, 12),
(58, 29, '2023-12-14 15:08:39', 'unPaid', 46, 18),
(59, 29, '2023-12-14 15:10:15', 'unPaid', 46, 18),
(60, 29, '2023-12-14 19:20:16', 'unPaid', 179, 20),
(61, 29, '2023-12-14 19:20:16', 'unPaid', 179, 22),
(62, 29, '2023-12-14 19:20:16', 'unPaid', 179, 19),
(63, 29, '2023-12-14 19:31:14', 'unPaid', 48, 19),
(64, 29, '2023-12-15 17:36:04', 'unPaid', 105, 19),
(65, 29, '2023-12-18 07:06:17', 'unPaid', 93, 20),
(66, 29, '2023-12-18 08:51:15', 'unPaid', 84.7, 18),
(67, 29, '2023-12-19 06:38:26', 'unPaid', 76.4, 16),
(68, 29, '2023-12-19 13:28:50', 'unPaid', 100, 18),
(69, 29, '2023-12-19 13:32:10', 'unPaid', 46, 18),
(70, 29, '2023-12-19 13:50:36', 'unPaid', 80, 14),
(71, 29, '2023-12-20 09:02:57', 'unPaid', 70, 12),
(72, 29, '2023-12-20 09:12:51', 'unPaid', 84.7, 18),
(73, 29, '2023-12-20 09:56:44', 'unPaid', 49.84, 12);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `details_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `prod_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`details_id`, `order_id`, `prod_id`, `quantity`) VALUES
(24, 36, 131, 4),
(25, 37, 128, 2),
(27, 39, 128, 3),
(28, 40, 131, 3),
(29, 41, 129, 3),
(30, 42, 134, 5),
(31, 43, 127, 1),
(32, 44, 127, 3),
(34, 46, 126, 1),
(35, 47, 129, 3),
(36, 48, 134, 5),
(38, 50, 132, 1),
(39, 51, 133, 3),
(40, 52, 128, 2),
(41, 53, 127, 3),
(42, 54, 126, 2),
(44, 56, 128, 2),
(45, 57, 134, 2),
(46, 58, 127, 2),
(47, 59, 127, 2),
(48, 60, 162, 1),
(49, 61, 133, 5),
(50, 62, 132, 2),
(51, 63, 169, 2),
(52, 64, 132, 5),
(53, 65, 162, 5),
(54, 66, 127, 5),
(55, 67, 128, 5),
(56, 68, 127, 5),
(57, 69, 127, 2),
(58, 70, 168, 5),
(59, 71, 126, 5),
(60, 72, 127, 5),
(61, 73, 126, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(10) UNSIGNED NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `cat_id` int(10) UNSIGNED NOT NULL,
  `prod_description` varchar(255) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `cat_id`, `prod_description`, `prod_price`, `size`, `color`) VALUES
(126, 'prod-4', 65, 'sdf', 12, 'XL', 'blue'),
(127, 'prod-3', 64, 'sdf', 18, 'L', 'violet'),
(128, 'prod-10', 63, 'sdf', 16, '2XL', 'gray'),
(129, 'prod-5', 65, 'sdfffsad', 14, 'M', 'green'),
(130, 'prod-1', 63, 'klllsd', 20, 'XL', 'green'),
(131, 'prod-6', 64, 'sdf', 17, 'XL', 'red'),
(132, 'sdfaaa', 63, 'afds', 19, '2XL', 'purple'),
(133, 'prod-91', 63, 'no Description', 22, 'M', 'Pink'),
(134, 'prod-99', 65, 'sdaf', 12, 'l', 'blue'),
(135, 'prod-22', 63, 'ert', 13, '2xl', 'pink'),
(136, 'prod-66', 65, 'asdf', 15, 'l', 'blue'),
(162, 'last', 63, 'women dress', 20, 'm', 'brown'),
(163, 'prod-6745', 63, 'ladf', 20, 'm', 'white'),
(164, 'prod-965', 64, 'adfa', 18, 'l', 'pink'),
(165, 'prod-984', 64, 'asdga', 14, 'xl', 'pink'),
(166, 'prod-748', 64, 'asdfa', 15, 'xl', 'blue'),
(167, 'prod-9684', 65, 'asdf', 16, 'xl', 'yellow'),
(168, 'prod-526', 64, 'sada', 14, '2xl', 'pink'),
(169, 'prod-8552', 65, 'saldk', 19, 'XL', 'yellow'),
(170, 'prod-635', 65, 'adfa', 12, 'L', 'pink');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `client_firstName` varchar(255) NOT NULL,
  `client_lastName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `user_type`, `email`, `phone_number`, `firstName`, `lastName`, `client_firstName`, `client_lastName`) VALUES
(29, '$2y$10$87JHI6pvvGnnu10.ZHSF..vq6yqXFJwqXu1Z2S3ZXnSpvjrI0B.PC', 'Admin', 'khaledd@gmail.com', '963258', 'Khaled', 'Alhilal', 'khaled', 'alhilall'),
(30, '$2y$10$.Znb8XSQIkicXSRlyBnnLu/oNy9hGzbxvOwUE43qCGl7xCiYTkrWK', 'client', 'ali@gmail.com', '963274', 'ali', 'ali', 'ali', 'ali'),
(31, '$2y$10$S3MS.AUZsOITRkf82Rdu4.Vdv93MfJXhxL5Qb8hHFZdY0ziJaSrZC', 'client', 'a@gmail.com', '123', 'a', 'a', 'a', 'a'),
(32, '$2y$10$FBI.8inzciFAy1jyzNmYPu0XRQ5x7QqF1cKt33rALc2pDgT.quei.', 'client', 'dhaini@gmail.com', 'dsf', 'Mahdi', 'Dhaini', 'Mahdi', 'Dhaini'),
(33, '$2y$10$Yg7WfN35MZ.DRAKXQo3gM.h7nKrwPcTlA8/YehIdCnoN46MPeALBq', 'client', 'khaledd@gmail.com', '4534', 'khaled', 'alhilal', 'khaled', 'alhilal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`footer_id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`carousel_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `products_ibfk_1` (`cat_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `footer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `carousel_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `details_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
