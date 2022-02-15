-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2021 at 11:37 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `admin_account` (
  `admin_user_id` int(11) NOT NULL UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `department_id` INT(11), 
  `depatment_name` VARCHAR(80) NOT NULL,
  `depatment_name_abbreviation` VARCHAR(30) NOT NULL,
  `school_id` VARCHAR(30) NOT NULL, 
  `school_name` VARCHAR(30) NOT NULL,
  `account_status` VARCHAR(30) NOT NULL,
  `account_profile` VARCHAR(80) NOT NULL,
  `school_admin` VARCHAR(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `admin_account` (`admin_user_id`, `full_name`, `email`, `password`,`department_id`,`depatment_name`,`depatment_name_abbreviation`,`school_id`,`school_name`,`account_status`,`account_profile`,`admin_type`) VALUES
(`1`, 'Elias Abdurrahman', 'eliasfsdev@gmail.com', '$2y$10$Nqq/y251QX2Ccvb1Ax7hUuMqQSkG3yRLCxN2KPdetnSP3oaXVH70a',`1`,`College of Information Technology and Computer Science`,`CITCS`,`UCBCF`,`UC`,`active`,`administrator`);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`admin_user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `admin_account`
  MODIFY `admin_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;