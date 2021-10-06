-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Sep 29, 2021 at 06:34 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paws and tails 1`
--

-- --------------------------------------------------------

--
-- Table structure for table `added post`
--

CREATE TABLE `added post` (
  `admin_id` int(5) NOT NULL,
  `post_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` varchar(20) NOT NULL,
  `email id` varchar(30) NOT NULL,
  `Phone Number` bigint(10) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Profile Picture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Photo1` varchar(50) NOT NULL,
  `Photo2` varchar(50) NOT NULL,
  `post_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `product_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dog`
--

CREATE TABLE `dog` (
  `d_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Breed` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Photo` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `Price` int(10) NOT NULL,
  `product_id` int(5) NOT NULL,
  `post_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dog products`
--

CREATE TABLE `dog products` (
  `dproduct_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` varchar(20) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Price` int(10) NOT NULL,
  `Photo` varchar(50) NOT NULL,
  `product_id` int(5) NOT NULL,
  `post_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dog req`
--

CREATE TABLE `dog req` (
  `dreq_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` varchar(20) NOT NULL,
  `Breed` varchar(20) NOT NULL,
  `age` varchar(3) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Price` int(10) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job req`
--

CREATE TABLE `job req` (
  `jreq_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Phone Number` bigint(10) NOT NULL,
  `Fees` int(20) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Experience` varchar(20) NOT NULL,
  `Photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `manages`
--

CREATE TABLE `manages` (
  `admin_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order details`
--

CREATE TABLE `order details` (
  `order_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Address` varchar(50) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Total Amount` int(10) NOT NULL,
  `Payment type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordered product`
--

CREATE TABLE `ordered product` (
  `order_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `professionals`
--

CREATE TABLE `professionals` (
  `p_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Phone Number` bigint(10) NOT NULL,
  `Fees` int(10) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Experience` varchar(20) NOT NULL,
  `Photo` varchar(50) NOT NULL,
  `product_id` int(5) NOT NULL,
  `post_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `user_id` int(5) NOT NULL,
  `dreq_id` int(5) NOT NULL,
  `jreq_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` varchar(20) NOT NULL,
  `email id` varchar(30) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone Number` bigint(10) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Profile Picture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `view request`
--

CREATE TABLE `view request` (
  `admin_id` int(5) NOT NULL,
  `jreq_id` int(5) NOT NULL,
  `dreq_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `added post`
--
ALTER TABLE `added post`
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `admin`

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `dog`
--
ALTER TABLE `dog`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `dog products`
--
ALTER TABLE `dog products`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `post_id` (`post_id`);



--
-- Indexes for table `manages`
--
ALTER TABLE `manages`
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order details`
--
ALTER TABLE `order details`
  ADD KEY `Address` (`Address`);

--
-- Indexes for table `ordered product`
--
ALTER TABLE `ordered product`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `post`
--


--
-- Indexes for table `professionals`
--
ALTER TABLE `professionals`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dreq_id` (`dreq_id`),
  ADD KEY `jreq_id` (`jreq_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `email id` (`email id`),
  ADD UNIQUE KEY `Phone Number` (`Phone Number`);

--
-- Indexes for table `view request`
--
ALTER TABLE `view request`
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `jreq_id` (`jreq_id`),
  ADD KEY `dreq_id` (`dreq_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `added post`
--
ALTER TABLE `added post`
  ADD CONSTRAINT `added post_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `added post_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `dog`
--
ALTER TABLE `dog`
  ADD CONSTRAINT `dog_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `dog_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `dog products`
--
ALTER TABLE `dog products`
  ADD CONSTRAINT `dog products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `dog products_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `manages`
--
ALTER TABLE `manages`
  ADD CONSTRAINT `manages_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `manages_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `ordered product`
--
ALTER TABLE `ordered product`
  ADD CONSTRAINT `ordered product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order details` (`order_id`),
  ADD CONSTRAINT `ordered product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `ordered product_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `professionals`
--
ALTER TABLE `professionals`
  ADD CONSTRAINT `professionals_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `professionals_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`dreq_id`) REFERENCES `dog req` (`dreq_id`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`jreq_id`) REFERENCES `job req` (`jreq_id`),
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `view request`
--
ALTER TABLE `view request`
  ADD CONSTRAINT `view request_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `view request_ibfk_2` FOREIGN KEY (`dreq_id`) REFERENCES `dog req` (`dreq_id`),
  ADD CONSTRAINT `view request_ibfk_3` FOREIGN KEY (`jreq_id`) REFERENCES `job req` (`jreq_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
