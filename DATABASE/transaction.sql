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
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tran_id` int(11) NOT NULL,
  `tran_amt` decimal(10,2) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `tran_type` varchar(20) DEFAULT NULL,
  `tran_date` date DEFAULT NULL,
  `tran_time` time DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tran_id`, `tran_amt`, `emp_id`, `sup_id`, `cus_id`, `bill_id`, `tran_type`, `tran_date`, `tran_time`, `branch_id`) VALUES
(1, 120.50, 2, NULL, 1, 1, 'UPI', '2023-10-15', '12:45:00', 1),
(2, 50.80, 17, NULL, 5, 3, 'Cash', '2023-10-17', '16:22:00', 3),
(3, 1200.50, 5, 2, NULL, 4, 'Chalan', '2023-10-17', '21:00:01', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tran_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `sup_id` (`sup_id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`s_id`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`),
  ADD CONSTRAINT `transaction_ibfk_5` FOREIGN KEY (`branch_id`) REFERENCES `pharmacy` (`branch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
