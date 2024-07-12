-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 08:28 AM
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
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `dis_id` int(11) NOT NULL,
  `dis_name` varchar(100) DEFAULT NULL,
  `dis_class` varchar(50) DEFAULT NULL,
  `med_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`dis_id`, `dis_name`, `dis_class`, `med_id`) VALUES
(1, 'Hypertension', 'Cardiovascular', 13),
(2, 'Asthma', 'Respiratory', 15),
(3, 'Common Cold', 'Infectious', 3),
(4, 'Arthritis', 'Musculoskeletal', 5),
(5, 'Anxiety Disorder', 'Neurological', 11),
(6, 'Acid Reflux', 'Gastrointestinal', 6),
(7, 'Diabetes', 'Endocrine', 8),
(8, 'Allergic Dermatitis', 'Dermatological', 7),
(9, 'Conjunctivitis', 'Ophthalmological', 2),
(10, 'Urinary Tract Infection', 'Urological', 12),
(11, 'Depression', 'Psychiatric', 4),
(12, 'Breast Cancer', 'Oncological', 9),
(13, 'Autoimmune Disorders', 'Immunological', 10),
(14, 'Anemia', 'Hematological', 14),
(15, 'Cystic Fibrosis', 'Genetic', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`dis_id`),
  ADD KEY `med_id` (`med_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disease`
--
ALTER TABLE `disease`
  ADD CONSTRAINT `disease_ibfk_1` FOREIGN KEY (`med_id`) REFERENCES `medicine` (`med_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
