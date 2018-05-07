-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2018 at 11:27 AM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `africbaa_africanvalues`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `surname` varchar(255) COLLATE utf8_bin NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `cellphone` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(500) COLLATE utf8_bin NOT NULL,
  `idnumber` varchar(13) COLLATE utf8_bin NOT NULL,
  `createddate` datetime NOT NULL,
  `updateddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bankname` varchar(255) COLLATE utf8_bin NOT NULL,
  `bankaccholder` varchar(255) COLLATE utf8_bin NOT NULL,
  `bankacc` varchar(255) COLLATE utf8_bin NOT NULL,
  `bankbranch` varchar(255) COLLATE utf8_bin NOT NULL,
  `group` varchar(20) COLLATE utf8_bin NOT NULL,
  `usergroup` int(11) NOT NULL DEFAULT '1',
  `amount` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`_id`, `name`, `surname`, `username`, `cellphone`, `email`, `idnumber`, `createddate`, `updateddate`, `bankname`, `bankaccholder`, `bankacc`, `bankbranch`, `group`, `usergroup`, `amount`) VALUES
(1, 'Sibusiso', 'Ngqondo', '27662150052', '27662150052', 'sngqondo@hotmail.com', '7201234472073', '2018-05-06 23:26:17', '2018-05-06 23:26:25', 'Standard bank', 'S Ngqondo', '052899829', '051001', 'yearly', 42, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `payer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `credit` int(20) NOT NULL DEFAULT '0',
  `amount` int(20) NOT NULL,
  `debit` int(20) NOT NULL DEFAULT '0',
  `committed` int(20) NOT NULL DEFAULT '0',
  `lasttrans` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `completed` int(11) NOT NULL DEFAULT '0',
  `touched` int(11) NOT NULL DEFAULT '0',
  `paid` int(20) NOT NULL DEFAULT '0',
  `nomoney` int(11) NOT NULL DEFAULT '0',
  `queued` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `payer`, `credit`, `amount`, `debit`, `committed`, `lasttrans`, `completed`, `touched`, `paid`, `nomoney`, `queued`) VALUES
(1, '27662150052', 0, 5000, 0, 0, '2018-05-06 23:47:33', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE `recipient` (
  `id` int(11) NOT NULL,
  `payee` varchar(255) COLLATE utf8_bin NOT NULL,
  `credit` int(20) NOT NULL,
  `initamount` int(20) NOT NULL,
  `initinvest` int(20) NOT NULL,
  `reforinv` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'investor',
  `outstanding` int(20) NOT NULL,
  `committed` int(20) NOT NULL DEFAULT '0',
  `lasttrans` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `completed` int(11) NOT NULL DEFAULT '0',
  `touched` int(11) NOT NULL DEFAULT '0',
  `transactionid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `referrer`
--

CREATE TABLE `referrer` (
  `id` int(8) NOT NULL,
  `referred` varchar(255) COLLATE utf8_bin NOT NULL,
  `referrer` varchar(255) COLLATE utf8_bin NOT NULL,
  `refdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bonus` int(20) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `successful`
--

CREATE TABLE `successful` (
  `id` int(11) NOT NULL,
  `_payer` varchar(255) COLLATE utf8_bin NOT NULL,
  `_payee` varchar(255) COLLATE utf8_bin NOT NULL,
  `paidamount` int(20) NOT NULL,
  `lasttrans` datetime NOT NULL,
  `transactionid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `payer` varchar(255) COLLATE utf8_bin NOT NULL,
  `payee` varchar(255) COLLATE utf8_bin NOT NULL,
  `amount` int(20) NOT NULL,
  `paymentdate` datetime NOT NULL DEFAULT '2017-01-01 00:00:00',
  `recipientid` int(20) NOT NULL,
  `payerid` int(20) NOT NULL,
  `completed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(500) COLLATE utf8_bin NOT NULL,
  `admin` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '$2y$10$j.8Op3U5hpbNhPt9ATbLQ.br58Vwr0ZPRBbfh5AIKCgVpvjABxgkW',
  `usergroup` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`, `usergroup`) VALUES
(1, '27662150052', '$2y$10$ZN0oJ42uLUMcuICmY.xqx.fjcWehCQNN8DzHIJ9QCSoOfL6Q7PtAK', '$2y$10$j.8Op3U5hpbNhPt9ATbLQ.br58Vwr0ZPRBbfh5AIKCgVpvjABxgkW', 42);

-- --------------------------------------------------------

--
-- Table structure for table `voided`
--

CREATE TABLE `voided` (
  `id` int(11) NOT NULL,
  `_payee` varchar(255) COLLATE utf8_bin NOT NULL,
  `_payer` varchar(255) COLLATE utf8_bin NOT NULL,
  `unpaidamount` int(20) NOT NULL,
  `transactionid` int(20) NOT NULL,
  `lasttrans` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`_id`),
  ADD UNIQUE KEY `cellphone` (`cellphone`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactionid` (`transactionid`);

--
-- Indexes for table `referrer`
--
ALTER TABLE `referrer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `successful`
--
ALTER TABLE `successful`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `voided`
--
ALTER TABLE `voided`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referrer`
--
ALTER TABLE `referrer`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `successful`
--
ALTER TABLE `successful`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voided`
--
ALTER TABLE `voided`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
