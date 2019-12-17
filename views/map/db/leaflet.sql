-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2019 at 06:26 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leaflet`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `geolocations` text NOT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `geolocations`, `keywords`) VALUES
(9, 'MARIA AURORA AREA', '121.44407272338866,15.80497218371801,121.46175384521484,15.782672788821074,121.49642944335938,15.79869556527687,121.4732551574707,15.818350641774611', 'maria'),
(11, 'Pingit Plantation', '121.50329589843749,15.763179456408846,121.59667968749999,15.667998725762747,121.76971435546874,15.744675578471627,121.67083740234375,15.863599602473085', 'pingit'),
(12, 'BALER', '121.41592025756835,15.791592841351093,121.42175674438475,15.780029734901786,121.4435577392578,15.78515062057313,121.4363479614258,15.80067767633283', 'baler');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company`, `details`, `latitude`, `longitude`, `telephone`, `keywords`) VALUES
(15, 'DATA', 'data is key', '15.7336', '121.5713', '09071978257', 'company'),
(16, 'maria', 'mahogany', '15.8016', '121.4595', '100x200', 'maria test'),
(18, 'rest', 'tesf', '15.8173', '121.4056', '09071978257', 'dsfh'),
(19, 'baler penro ', 'data', '15.8016', '121.4598', '09071978257', 'data');

-- --------------------------------------------------------

--
-- Table structure for table `streets`
--

CREATE TABLE `streets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `geolocations` text NOT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `streets`
--

INSERT INTO `streets` (`id`, `name`, `geolocations`, `keywords`) VALUES
(9, 'road map', '119.37744140625,14.00869637063467,119.0972900390625,14.461277417004244,119.9981689453125,14.205813635597496,119.794921875,14.732386081418454,120.42663574218749,14.402759378194173,120.421142578125,15.024380438910743,120.794677734375,14.806749372133767,121.212158203125,14.98193315445839,121.1517333984375,15.342464595142463,121.278076171875,15.411319377980993', 'road area');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streets`
--
ALTER TABLE `streets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `streets`
--
ALTER TABLE `streets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
