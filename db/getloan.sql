-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2021 at 10:05 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `getloan`
--

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `loannumber` int(10) NOT NULL,
  `duedate` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `userid`, `amount`, `loannumber`, `duedate`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 20000, 1277611500, '07-02-2021', '0', '2021-01-08 09:53:08', NULL),
(2, 3, 50000, 2147483647, '07-02-2021', '1', '2021-01-08 09:54:26', '2021-01-08 09:58:08'),
(3, 2, 100000, 2147483647, '07-02-2021', '0', '2021-01-08 09:55:31', NULL),
(4, 2, 170000, 639933464, '07-02-2021', '2', '2021-01-08 09:56:12', '2021-01-08 09:58:17'),
(5, 3, 1000, 2147483647, '07-02-2021', '0', '2021-01-08 10:04:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `lastname` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` int(10) NOT NULL,
  `transpin` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `access_type` int(10) NOT NULL,
  `total_loan` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `transpin`, `password`, `access_type`, `total_loan`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', 0, '$2y$10$EaCvzQkjv69UyZxQchSC5uFeAUDZoZtw1INjXWBPzkTcY8MIQyD9G', '$2y$10$5S9dy.aygSXrBh.wFAEgwObMZBTVUQPVxLjvpgUs3gKk5t.9rcfW.', 1, 0, '2021-01-08 09:49:38', NULL),
(2, 'Ham', 'Tee', 'hamtee@gmail.com', 12345, '$2y$10$91yDlxRLTMcSMJAnFaTx3OldUtULdI3FtxakUcDL2umyNk.EqTVe6', '$2y$10$PfliIUMwYN.VkpnRSM2s3eaKgYWXmDAMNaUjTKMRxTaSTBWPgXRxe', 0, 0, '2021-01-08 09:51:50', NULL),
(3, 'Sammy', 'Yo', 'sansa@gmail.com', 121212, '$2y$10$IVRLAjW32WYn2jiaJaEndOA.5ofzb.pBxGaNx4M3Gu2vx0C0VCfk6', '$2y$10$NDGasrQel75.zarVBUnicOV465L0AVdDVZ7B2JHx3f/rXjb4usaWK', 0, 50000, '2021-01-08 09:52:39', '2021-01-08 09:58:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
