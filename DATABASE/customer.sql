-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 08:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(20) DEFAULT NULL,
  `cus_age` int(11) DEFAULT NULL,
  `cus_gender` varchar(10) DEFAULT NULL,
  `cus_phoneno` varchar(15) DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `cus_dob` date DEFAULT NULL,
  `membership_type` varchar(20) DEFAULT NULL,
  `cus_mail` varchar(50) DEFAULT NULL,
  `cus_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `cus_age`, `cus_gender`, `cus_phoneno`, `doc_id`, `cus_dob`, `membership_type`, `cus_mail`, `cus_address`) VALUES
(1, 'John Doe', 30, 'Male', '1234567890', 1, '1993-01-15', 'Gold', 'john.doe@example.com', '123 Main St'),
(2, 'Jennifer Lopez', 29, 'Female', '9998887777', 1, '1992-04-18', 'Gold', 'jennifer.lopez@example.com', '345 Cedar St'),
(3, 'Bob Johnson', 35, 'Male', '5555555555', 3, '1987-09-10', 'Bronze', 'bob.johnson@example.com', '789 Pine St'),
(4, 'Alice Williams', 28, 'Female', '1112223333', 1, '1994-07-03', 'Gold', 'alice.williams@example.com', '567 Elm St'),
(5, 'Brian Thompson', 36, 'Male', '6665554444', 4, '1986-08-29', 'Silver', 'brian.thompson@example.com', '678 Pine St');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
