-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 11:06 AM
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
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doc_id` int(4) NOT NULL,
  `doc_name` varchar(20) DEFAULT NULL,
  `doc_phoneno` varchar(12) DEFAULT NULL,
  `doc_email` varchar(30) DEFAULT NULL,
  `hospital_name` varchar(30) DEFAULT NULL,
  `hospital_loc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doc_id`, `doc_name`, `doc_phoneno`, `doc_email`, `hospital_name`, `hospital_loc`) VALUES
(1, 'Dr. Sarah Johnson', '555-123-4567', 'sarah@example.com', 'City Hospital', '123 Health Street'),
(2, 'Dr. Michael Smith', '666-234-5678', 'michael@example.com', 'Central Medical Center', '456 Medical Avenue'),
(3, 'Dr. Emily Davis', '777-345-6789', 'emily@example.com', 'Community Clinic', '789 Care Lane'),
(4, 'Dr. James Harris', '888-456-7890', 'james@example.com', 'General Hospital', '987 Wellness Road'),
(5, 'Dr. Sophia White', '999-567-8901', 'sophia@example.com', 'Metropolitan Health Center', '654 Cure Street'),
(6, 'Dr. Sarah Johnson', '111-222-3333', 'sarahjohn@example.com', 'Downtown Clinic', '321 Cure Lane');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
