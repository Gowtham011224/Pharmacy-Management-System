-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 08:10 AM
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
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `med_id` int(11) NOT NULL,
  `med_name` varchar(50) DEFAULT NULL,
  `med_class` varchar(40) DEFAULT NULL,
  `med_quan_sold` int(11) DEFAULT NULL,
  `med_quan_left` int(11) DEFAULT NULL,
  `med_mfg` date DEFAULT NULL,
  `med_exp` date DEFAULT NULL,
  `med_mrp` decimal(10,2) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `med_costprice` decimal(10,2) DEFAULT NULL,
  `sci_name` varchar(40) DEFAULT NULL,
  `med_type` varchar(25) DEFAULT NULL,
  `branch_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`branch_id`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`med_id`, `med_name`, `med_class`, `med_quan_sold`, `med_quan_left`, `med_mfg`, `med_exp`, `med_mrp`, `sup_id`, `med_costprice`, `sci_name`, `med_type`, `branch_id`) VALUES
(1, 'Aspirin', 'Pain Relief', 100, 50, '2022-01-01', '2023-01-01', 5.99, 1, 4.50, 'Acetylsalicylic Acid', 'Tablet', '[1,2]'),
(2, 'Ibuprofen', 'Anti-Inflammatory', 80, 30, '2022-02-01', '2023-02-01', 7.99, 2, 6.50, 'Ibuprofen', 'Capsule', '[1,2,3]'),
(3, 'Amoxicillin', 'Antibiotic', 120, 60, '2022-03-01', '2023-03-01', 12.99, 3, 10.50, 'Amoxicillin', 'Liquid', '[2,3]'),
(4, 'Paracetamol', 'Fever Reducer', 150, 70, '2022-04-01', '2023-04-01', 4.99, 4, 3.50, 'Acetaminophen', 'Tablet', '[1,3]'),
(5, 'Loratadine', 'Antihistamine', 60, 20, '2022-05-01', '2023-05-01', 9.99, 5, 8.00, 'Loratadine', 'Tablet', '[1,2,3]'),
(6, 'Omeprazole', 'Acid Reducer', 40, 15, '2022-06-01', '2023-06-01', 15.99, 1, 12.00, 'Omeprazole', 'Capsule', '[2,3]'),
(7, 'Cetirizine', 'Antihistamine', 90, 40, '2022-07-01', '2023-07-01', 6.99, 2, 5.50, 'Cetirizine', 'Tablet', '[1,2,3]'),
(8, 'Metformin', 'Antidiabetic', 110, 55, '2022-08-01', '2023-08-01', 11.99, 3, 9.00, 'Metformin', 'Tablet', '[2,3]'),
(9, 'Simvastatin', 'Cholesterol Lowering', 70, 25, '2022-09-01', '2023-09-01', 14.99, 4, 11.50, 'Simvastatin', 'Tablet', '[1,2,3]'),
(10, 'Warfarin', 'Anticoagulant', 30, 10, '2022-10-01', '2023-10-01', 8.99, 5, 7.00, 'Warfarin', 'Tablet', '[1]'),
(11, 'Diazepam', 'Anxiolytic', 50, 15, '2022-11-01', '2023-11-01', 10.99, 1, 9.50, 'Diazepam', 'Tablet', '[2]'),
(12, 'Ciprofloxacin', 'Antibiotic', 65, 30, '2022-12-01', '2023-12-01', 17.99, 2, 15.00, 'Ciprofloxacin', 'Tablet', '[3]'),
(13, 'Losartan', 'Antihypertensive', 85, 40, '2023-01-01', '2024-01-01', 16.99, 3, 14.00, 'Losartan', 'Tablet', '[1,2]'),
(14, 'Morphine', 'Pain Relief', 20, 8, '2023-02-01', '2024-02-01', 25.99, 4, 22.00, 'Morphine', 'Injection', '[2,3]'),
(15, 'Albuterol', 'Bronchodilator', 45, 20, '2023-03-01', '2024-03-01', 19.99, 5, 17.50, 'Albuterol', 'Inhaler', '[3]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`med_id`),
  ADD KEY `sup_id` (`sup_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`s_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
