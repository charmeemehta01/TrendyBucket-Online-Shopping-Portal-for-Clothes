-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2020 at 12:36 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trendybucket`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `Name` text NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Account_Bal` int(30) NOT NULL,
  `Password` text NOT NULL,
  `CVV` int(4) NOT NULL,
  `Address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`Name`, `Email`, `Account_Bal`, `Password`, `CVV`, `Address`) VALUES
('IamUtsavP', 'parekhutsav13@gmail.com', 10000, '12', 5663, 'New Ratan Apartment, S.v.road Borivali West.\\r\\n23'),
('CharmeeM', 'charmee.m@somaiya.edu', 10000, 'charmeeuser', 3003, 'Borivali West'),
('TestUser', 'test123@gmail.com', 10000, 'testUser', 8105, 'Borivali West'),
('Utsav132', 'utsav.parekh@somaiya.edu', 10000, '123', 2338, 'New Ratan Apartment, S.v.road Borivali West.\\r\\n23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
