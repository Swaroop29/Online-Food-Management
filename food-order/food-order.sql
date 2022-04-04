-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 07:09 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

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

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `user_name`, `password`) VALUES
(27, 'swaroop', 'swaroop29', '8ee86cc47cc35cc9613eb6044f7cf433'),
(47, 'yashavanth', 'y2k1', 'dfe00c3e2ec2202d69f9245d3225baa7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(34, 'Pizza', 'food_category_294.jpg', 'Yes', 'Yes'),
(38, 'Burger', 'food_category_414.jpg', 'Yes', 'Yes'),
(40, 'Pasta', 'food_category_248.jpg', 'Yes', 'Yes'),
(41, 'Noodles', 'food_category_930.jpg', 'Yes', 'Yes'),
(42, 'Momos', 'food_category_615.jpg', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(16, 'Veg Extravaganza', 'Black olives, capsicum, onion, grilled mushroom, corn, tomato, jalapeno & extra cheese         ', '299.00', 'Food-Name-248.jpg', 34, 'No', 'No'),
(17, 'Veggie Paradise', 'The awesome foursome! Golden corn, black olives, capsicum, red paprika    ', '219.00', 'Food-Name-4159.jpg', 34, 'Yes', 'Yes'),
(19, 'American Cheese Supreme - Veg', 'A crispy corn and cheese patty covered with a slice of cheese, creamy cocktail sauce, jalapeños and shredded onions, all packed in between perfectly toasted sesame buns.             ', '124.00', 'Food-Name-4413.jpg', 38, 'No', 'Yes'),
(20, 'Spiced Tomato Veg', 'Tangy Flavourful Red Sauce Pasta Infused With Heavenly Herbs & Spices Topped With Onion, Green Capsicum & Red Capsicum', '149.00', 'Food-Name-924.jpg', 40, 'Yes', 'Yes'),
(21, 'McVeggie Burger', 'A delectable patty filled with potatoes, peas, carrots and tasty Indian spices. Topped with crispy lettuce, mayonnaise, and packed into toasted sesame buns. ', '109.00', 'Food-Name-7289.jpg', 38, 'No', 'Yes'),
(22, 'Creamy Pasta', 'Pasta in rich creamy sauce flavoured with garlic & parsley', '199.00', 'Food-Name-4375.webp', 40, 'Yes', 'Yes'),
(23, 'Shanghai Style Fried Noodles', 'Better than take-out, flavourful and authentic Shanghai fried noodles with chicken, mushrooms, and bok choy is made in just 10 minutes - the easiest dinner!', '249.00', 'Food-Name-4085.jpg', 41, 'Yes', 'Yes'),
(25, 'STEAMED MOMO', 'Traditional delicacy straight from the Himalayas', '149.00', 'Food-Name-4829.jpg', 42, 'Yes', 'Yes'),
(26, 'GLUTEN FREE MOMO', 'Potato starch dumplings for guilt free cravings ', '249.00', 'Food-Name-3672.jpeg', 34, 'Yes', 'Yes'),
(27, 'Spicy Cumin Lamb Noodles', 'Better than takeout, flavourful stir-fried spicy cumin lamb noodles is packed with marinated lamb, noodles, and crisp bean sprouts. ', '199.00', 'Food-Name-9108.webp', 41, 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qry` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(501) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qry`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(8, 'Creamy Pasta', '199.00', 1, '199.00', '2022-01-17 08:06:35', 'Delivered', 'MxDTJTE5Pj', '9418959090', 'vyfnz@dvg7.com', 'Puttur'),
(10, 'Veg Extravaganza', '299.00', 1, '299.00', '2022-01-17 10:02:02', 'Cancelled', 'GWgas47WxL', '5196217452', 'pwo5x@vo05.com', 'Puttur'),
(11, 'Veg Extravaganza', '299.00', 2147483647, '99999999.99', '2022-01-17 10:55:52', 'On Delivery', '65JgCVNsQW', '8361732587', '2o5jw@xgry.com', 'Puttur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
