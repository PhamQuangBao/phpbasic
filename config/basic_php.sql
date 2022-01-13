-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 09:29 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basic_php`
--
CREATE DATABASE IF NOT EXISTS `basic_php` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `basic_php`;

-- --------------------------------------------------------

--
-- Table structure for table `users1`
--

CREATE TABLE `users1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `date_birth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `users1`
--

TRUNCATE TABLE `users1`;
--
-- Dumping data for table `users1`
--

INSERT INTO `users1` (`id`, `name`, `phone`, `email`, `password`, `gender`, `date_birth`, `address`, `created_at`, `updated_at`) VALUES
(37, 'Phạm Quang Bảo', '0899884203', 'bao2032000@gmail.com', '$2y$10$PJ4JFRgcqy89qvkX90Z/neaTXGNXI7lsn6CV0ExFWAmj3f5nWK3Gq', 1, '2021-12-27', 'Hà My Đông A, Điện Dương, Điện Bàn, Quảng Nam', '2022-01-10 07:01:58', '2022-01-07 06:36:47'),
(50, 'aaaa', '1234567890', 'bao@gmail.com', '$2y$10$CypeqdrupGq9ZsIioEiSK.e7CA1X.5luQ0O03OHs5D4pxeARnP.Xa', 1, '2021-12-27', 'aaaaaaaaaaaaa', '2022-01-10 02:17:17', NULL),
(87, 'Quang Bảoooo', '0899884204', 'baophamquang0@gmail.com', '$2y$10$v7poAUqnFdhzIpSos1tkPeI.pCdZ9Zh1ZAwoe/s0JzOl4G/uH1P2q', 1, '2021-12-26', 'Điện Dương, Điện Bàn, Quảng Nam', NULL, '2022-01-10 06:45:22'),
(102, 'aaaa', '1234567891', 'bao1@gmail.com', '$2y$10$t44BO3PBN03EX8s05r11m.viz7sjGJUCFTnV/nFtsnlZ3d0kOPA3S', 1, '2021-12-26', '82 Quang Trung, Phường Hải Châu  I, Quận Hải Châu, Thành phố Đà Nẵng', '0000-00-00 00:00:00', '2022-01-12 03:33:22'),
(106, 'aaaa', '1234567892', 'bao2@gmail.com', '$2y$10$ke5w35WxMWzJL1nohex0QuSxel0R3FnP9l1wJcg90KTWAWJhiV4hC', 1, '2022-01-04', 'aaaaaaaaaaaaa, Xã Vô Tranh, Huyện Hạ Hoà, Tỉnh Phú Thọ', NULL, NULL),
(107, 'aaaa', '1234567893', 'bao3@gmail.com', '$2y$10$/9gWwtYPdXtUf4MGoxDbEOpLzA/VyMwwToGewsqoVwzfp9guqDXWG', 1, '2022-01-04', 'aaaaaaaaaaaaa, Xã Yên Phụ, Huyện Yên Phong, Tỉnh Bắc Ninh', NULL, NULL),
(108, 'aaaa', '1234567894', 'bao4@gmail.com', '$2y$10$Sf7.4PEGuEtXp0dlHxA2lupGHW/RdCIK3x/QuzIgqcj2nhc8UEbsC', 1, '2021-12-27', 'aaaaaaaaaaaaa, Xã Yên Phụ, Huyện Yên Phong, Tỉnh Bắc Ninh', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verify1`
--

CREATE TABLE `verify1` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `verify1`
--

TRUNCATE TABLE `verify1`;
--
-- Dumping data for table `verify1`
--

INSERT INTO `verify1` (`id`, `email`, `code`, `created_at`) VALUES
(92, 'bao1@gmail.com', '$2y$10$D6gVxItnT4CvArAVzqkACeaZbsiDCREixCx.zAw6ipaCUJZRVbeYW', '2022-01-11 08:46:12'),
(93, 'baophamquang0@gmail.com', '$2y$10$zHTbi6Cx8HvmljBbB0Wc2eQiRGSY.NM2y.KTpmOpw0KVGzhOWjg.G', '2022-01-12 02:18:14'),
(97, 'bao2@gmail.com', '$2y$10$batEvCtS694NFULviL4DbuoZxbiVUyeHxHwY07vfq9hhN8oy2iReW', '2022-01-12 06:49:52'),
(98, 'bao3@gmail.com', '$2y$10$R8Z2tZT/HJ6zeYATJHuz3O/aWmHiqdD5HauaOI.MHjysnejr42Hn.', '2022-01-12 06:50:28'),
(99, 'bao4@gmail.com', '$2y$10$2BK6UEDF9tX6xxWNVghwQezZG8uHcvv3A7bJUAeKvbDfsbaNoDUeS', '2022-01-12 06:50:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify1`
--
ALTER TABLE `verify1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users1`
--
ALTER TABLE `users1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `verify1`
--
ALTER TABLE `verify1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
