-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 08:30 AM
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
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `pre_id` int(11) DEFAULT NULL,
  `pre_date` date DEFAULT NULL,
  `medicine_name` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `med_id` int(11) DEFAULT NULL,
  `dis_id` int(11) DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `hospital_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`pre_id`, `pre_date`, `medicine_name`, `quantity`, `med_id`, `dis_id`, `cus_id`, `doc_id`, `hospital_name`) VALUES
(1, '2023-10-01', 'Aspirin', 2, 1, 15, 1, 1, 'City Hospital'),
(1, '2023-10-01', 'Paracetamol', 1, 4, 11, 1, 1, 'City Hospital'),
(1, '2023-10-01', 'Cetirizine', 3, 7, 3, 1, 1, 'City Hospital'),
(2, '2023-10-02', 'Ibuprofen', 3, 2, 9, 2, 3, 'Community Clinic'),
(2, '2023-10-02', 'Loratadine', 2, 5, 4, 2, 3, 'Community Clinic'),
(3, '2023-11-12', 'Paracetamol', 5, 4, 11, 2, 6, 'Downtown Clinic'),
(5, '2023-10-05', 'Paracetamol', 12, 5, 4, 3, 4, 'General Hospital'),
(5, '2023-10-05', 'Cetirizine', 6, 7, 3, 3, 4, 'General Hospital'),
(5, '2023-10-07', 'Amoxicillin', 1, 3, 2, 3, 4, 'General Hospital'),
(4, '2023-10-07', 'Loratadine', 3, 5, 2, 4, NULL, NULL),
(4, '2023-10-08', 'Ibuprofen', 2, 2, 4, 4, NULL, NULL),
(4, '2023-10-09', 'Amoxicillin', 1, 3, 1, 4, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD KEY `med_id` (`med_id`),
  ADD KEY `dis_id` (`dis_id`),
  ADD KEY `cus_id` (`cus_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`med_id`) REFERENCES `medicine` (`med_id`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`dis_id`) REFERENCES `disease` (`dis_id`),
  ADD CONSTRAINT `prescription_ibfk_3` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`),
  ADD CONSTRAINT `prescription_ibfk_4` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
