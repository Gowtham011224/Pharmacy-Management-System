-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 01:25 PM
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
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `bill_amt` decimal(10,2) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `bill_time` time DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `pre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `bill_amt`, `emp_id`, `sup_id`, `cus_id`, `branch_id`, `bill_time`, `bill_date`, `pre_id`) VALUES
(1, 120.50, 3, NULL, 1, 1, '12:30:00', '2023-10-15', 1),
(2, 75.20, 9, NULL, 4, 2, '14:45:00', '2023-10-16', 2),
(3, 50.80, 18, NULL, 5, 3, '16:20:00', '2023-10-17', 3),
(4, 1200.50, 3, 2, NULL, 1, '12:30:00', '2023-10-15', NULL),
(5, 70.20, 9, NULL, 5, 2, '14:45:00', '2023-10-16', 2),
(6, 5000.80, 18, 4, NULL, 3, '16:20:00', '2023-10-17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `sup_id` (`sup_id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`s_id`),
  ADD CONSTRAINT `bill_ibfk_3` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`),
  ADD CONSTRAINT `bill_ibfk_4` FOREIGN KEY (`branch_id`) REFERENCES `pharmacy` (`branch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
