-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 08:12 AM
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
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(20) DEFAULT NULL,
  `emp_type` varchar(15) DEFAULT NULL,
  `emp_wages` decimal(10,2) DEFAULT NULL,
  `emp_phoneno` varchar(12) DEFAULT NULL,
  `emp_doj` date DEFAULT NULL,
  `emp_experience` varchar(10) DEFAULT NULL,
  `emp_qualification` varchar(50) DEFAULT NULL,
  `emp_mail` varchar(30) DEFAULT NULL,
  `emp_address` varchar(30) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `emp_type`, `emp_wages`, `emp_phoneno`, `emp_doj`, `emp_experience`, `emp_qualification`, `emp_mail`, `emp_address`, `branch_id`) VALUES
(1, 'John Doe', 'Pharmacist', 25.50, '123-456-7890', '2022-01-15', '5', 'Pharmacy Degree', 'john@example.com', '123 Main Street', 1),
(2, 'Jane Smith', 'Cashier', 15.75, '987-654-3210', '2022-02-01', '2', 'Business Administration', 'jane@example.com', '456 Oak Avenue', 1),
(3, 'Bob Johnson', 'Technician', 20.00, '111-222-3333', '2022-03-10', '3', 'Medical Technology', 'bob@example.com', '789 Elm Street', 1),
(4, 'Emily Davis', 'Pharmacist', 28.00, '555-888-7777', '2022-04-20', '7', 'Pharmacy Degree', 'emily@example.com', '987 Pine Street', 1),
(5, 'Michael Brown', 'Cashier', 16.50, '222-333-4444', '2022-05-05', '1', 'Business Administration', 'michael@example.com', '654 Birch Lane', 1),
(6, 'Sophia White', 'Technician', 22.50, '777-999-1111', '2022-06-15', '4', 'Medical Technology', 'sophia@example.com', '321 Cedar Road', 1),
(7, 'David Miller', 'Pharmacist', 26.00, '333-555-7777', '2022-01-25', '6', 'Pharmacy Degree', 'david@example.com', '789 Oak Street', 2),
(8, 'Emma Wilson', 'Cashier', 17.00, '666-888-9999', '2022-02-10', '2', 'Business Administration', 'emma@example.com', '456 Maple Avenue', 2),
(9, 'Daniel Taylor', 'Technician', 21.50, '111-222-3333', '2022-03-20', '3', 'Medical Technology', 'daniel@example.com', '987 Elm Lane', 2),
(10, 'Olivia Hall', 'Pharmacist', 29.50, '777-888-5555', '2022-04-05', '8', 'Pharmacy Degree', 'olivia@example.com', '654 Pine Road', 2),
(11, 'William Clark', 'Cashier', 18.50, '222-333-4444', '2022-05-15', '1', 'Business Administration', 'william@example.com', '321 Birch Street', 2),
(12, 'Grace Turner', 'Technician', 23.00, '888-999-1111', '2022-06-01', '5', 'Medical Technology', 'grace@example.com', '123 Cedar Avenue', 2),
(13, 'James Harris', 'Pharmacist', 24.00, '555-777-9999', '2022-01-10', '4', 'Pharmacy Degree', 'james@example.com', '987 Oak Road', 3),
(14, 'Ava Rogers', 'Cashier', 16.00, '111-222-3333', '2022-02-15', '2', 'Business Administration', 'ava@example.com', '456 Elm Lane', 3),
(15, 'Jackson Turner', 'Technician', 19.50, '777-888-5555', '2022-03-05', '3', 'Medical Technology', 'jackson@example.com', '789 Maple Avenue', 3),
(16, 'Sophie Moore', 'Pharmacist', 27.50, '222-333-4444', '2022-04-15', '6', 'Pharmacy Degree', 'sophie@example.com', '654 Pine Lane', 3),
(17, 'Logan Adams', 'Cashier', 15.00, '888-999-1111', '2022-05-01', '1', 'Business Administration', 'logan@example.com', '321 Cedar Street', 3),
(18, 'Ella King', 'Technician', 20.00, '555-777-9999', '2022-06-10', '4', 'Medical Technology', 'ella@example.com', '123 Birch Avenue', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `pharmacy` (`branch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
