-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2023 at 11:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CarRental_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `zipcode` int(5) NOT NULL,
  `district` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand_info`
--

CREATE TABLE `brand_info` (
  `model_id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `seat` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car_info`
--

CREATE TABLE `car_info` (
  `license_plate` varchar(255) NOT NULL,
  `zipcode` int(5) NOT NULL,
  `district` varchar(255) NOT NULL,
  `transmission` varchar(255) NOT NULL,
  `client _id` int(11) NOT NULL,
  `price_per_day` int(6) NOT NULL,
  `model_id` int(11) NOT NULL,
  `year_car` int(4) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client _id` int(11) NOT NULL,
  `driving_license_No` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `dateofbirth` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel_no` varchar(255) NOT NULL,
  `lessor_id` int(11) NOT NULL,
  `banking_account` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_card_client`
--

CREATE TABLE `credit_card_client` (
  `credit_card_id` int(16) NOT NULL,
  `client _id` int(11) NOT NULL,
  `expires` datetime NOT NULL,
  `card_type` varchar(255) NOT NULL,
  `cvv` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interested`
--

CREATE TABLE `interested` (
  `client _id` int(11) NOT NULL,
  `interested_car` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rent_info`
--

CREATE TABLE `rent_info` (
  `rental_id` int(11) NOT NULL,
  `client _id` int(11) NOT NULL,
  `license_plate` varchar(255) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `credit_card_id` varchar(255) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`zipcode`,`district`) USING BTREE;

--
-- Indexes for table `brand_info`
--
ALTER TABLE `brand_info`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `car_info`
--
ALTER TABLE `car_info`
  ADD PRIMARY KEY (`license_plate`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `client _id` (`client _id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client _id`);

--
-- Indexes for table `credit_card_client`
--
ALTER TABLE `credit_card_client`
  ADD PRIMARY KEY (`credit_card_id`),
  ADD KEY `client _id` (`client _id`);

--
-- Indexes for table `interested`
--
ALTER TABLE `interested`
  ADD PRIMARY KEY (`client _id`,`interested_car`);

--
-- Indexes for table `rent_info`
--
ALTER TABLE `rent_info`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `client _id` (`client _id`),
  ADD KEY `license_plate` (`license_plate`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_info`
--
ALTER TABLE `car_info`
  ADD CONSTRAINT `car_info_ibfk_1` FOREIGN KEY (`model_id`) REFERENCES `brand_info` (`model_id`),
  ADD CONSTRAINT `car_info_ibfk_3` FOREIGN KEY (`client _id`) REFERENCES `client` (`client _id`);

--
-- Constraints for table `credit_card_client`
--
ALTER TABLE `credit_card_client`
  ADD CONSTRAINT `credit_card_client_ibfk_1` FOREIGN KEY (`client _id`) REFERENCES `client` (`client _id`);

--
-- Constraints for table `interested`
--
ALTER TABLE `interested`
  ADD CONSTRAINT `interested_ibfk_1` FOREIGN KEY (`client _id`) REFERENCES `client` (`client _id`);

--
-- Constraints for table `rent_info`
--
ALTER TABLE `rent_info`
  ADD CONSTRAINT `rent_info_ibfk_1` FOREIGN KEY (`client _id`) REFERENCES `client` (`client _id`),
  ADD CONSTRAINT `rent_info_ibfk_2` FOREIGN KEY (`license_plate`) REFERENCES `car_info` (`license_plate`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
