-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 19, 2021 at 02:44 PM
-- Server version: 8.0.25
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nginx`
--

-- --------------------------------------------------------

--
-- Table structure for table `nginx_sso`
--

CREATE TABLE `nginx_sso` (
  `user_id` int UNSIGNED NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_uac` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_cookie` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `nginx_sso`
--

INSERT INTO `nginx_sso` (`user_id`, `user_name`, `password`, `user_uac`, `user_cookie`) VALUES
(1, 'admin', '972b4810cd0c089179a15111a1e14b6540c398yu73aeae7253a5fd6b66d4792c', 'Admin', ''),
(2, 'superadmin', '972b4810cd0c089179a15111a1e14b654rt591d073aeae7253a5fd6b66d4792c', 'Admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nginx_sso`
--
ALTER TABLE `nginx_sso`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nginx_sso`
--
ALTER TABLE `nginx_sso`
  MODIFY `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

