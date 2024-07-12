-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 08:29 AM
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
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(15) DEFAULT NULL,
  `s_pnum` varchar(12) DEFAULT NULL,
  `s_mail` varchar(25) DEFAULT NULL,
  `s_location` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`s_id`, `s_name`, `s_pnum`, `s_mail`, `s_location`) VALUES
(1, 'X Co.', '123-456-7890', 'xco@example.com', '123 Market Street'),
(2, 'Y Ltd.', '987-654-3210', 'yltd@example.com', '456 Trade Avenue'),
(3, 'Z Inc.', '111-222-3333', 'zinc@example.com', '789 Commerce Lane'),
(4, 'W Enterprises', '555-888-7777', 'wenterprises@example.com', '987 Business Road'),
(5, 'V Corp.', '222-333-4444', 'vcorp@example.com', '654 Enterprise Street');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`s_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
