-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 12, 2020 at 04:55 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bnb`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` int(10) UNSIGNED NOT NULL,
  `customerID` int(10) UNSIGNED NOT NULL,
  `roomID` int(10) UNSIGNED NOT NULL,
  `checkindate` date DEFAULT NULL,
  `checkoutdate` date DEFAULT NULL,
  `extras` varchar(100) DEFAULT NULL,
  `bookingreview` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingID`, `customerID`, `roomID`, `checkindate`, `checkoutdate`, `extras`, `bookingreview`) VALUES
(8, 26, 14, '2020-09-12', '2020-09-13', 'aa', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Garrison', 'Jordan', 'sit.amet.ornare@nequesedsem.edu', '1'),
(2, 'Desiree', 'Collier', 'Maecenas@non.co.uk', NULL),
(3, 'Irene', 'Walker', 'id.erat.Etiam@id.org', NULL),
(4, 'Forrest', 'Baldwin', 'eget.nisi.dictum@a.com', NULL),
(5, 'Beverly', 'Sellers', 'ultricies.sem@pharetraQuisqueac.co.uk', NULL),
(6, 'Glenna', 'Kinney', 'dolor@orcilobortisaugue.org', NULL),
(7, 'Montana', 'Gallagher', 'sapien.cursus@ultriciesdignissimlacus.edu', NULL),
(8, 'Harlan', 'Lara', 'Duis@aliquetodioEtiam.edu', NULL),
(9, 'Benjamin', 'King', 'mollis@Nullainterdum.org', NULL),
(10, 'Rajah', 'Olsen', 'Vestibulum.ut.eros@nequevenenatislacus.ca', NULL),
(11, 'Castor', 'Kelly', 'Fusce.feugiat.Lorem@porta.co.uk', NULL),
(12, 'Omar', 'Oconnor', 'eu.turpis@auctorvelit.co.uk', NULL),
(13, 'Porter', 'Leonard', 'dui.Fusce@accumsanlaoreet.net', NULL),
(14, 'Buckminster', 'Gaines', 'convallis.convallis.dolor@ligula.co.uk', NULL),
(15, 'Hunter', 'Rodriquez', 'ridiculus.mus.Donec@est.co.uk', NULL),
(16, 'Zahir', 'Harper', 'vel@estNunc.com', NULL),
(17, 'Sopoline', 'Warner', 'vestibulum.nec.euismod@sitamet.co.uk', NULL),
(18, 'Burton', 'Parrish', 'consequat.nec.mollis@nequenonquam.org', NULL),
(19, 'Abbot', 'Rose', 'non@et.ca', NULL),
(20, 'Barry', 'Burks', 'risus@libero.net', NULL),
(26, 'Admin', 'admin', 'admin@admin.com', '$2y$12$bjjsA8yLSOz.hvlsdZ4ED.y3yAoDMojR2DFSpQ9FhmFoF6ChD3xfW');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(10) UNSIGNED NOT NULL,
  `roomname` varchar(100) NOT NULL,
  `description` text,
  `roomtype` char(1) DEFAULT 'D',
  `beds` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomname`, `description`, `roomtype`, `beds`) VALUES
(1, 'Kellie', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing', 'S', 5),
(2, 'Herman', 'Lorem ipsum dolor sit amet, consectetuer', 'D', 5),
(3, 'Scarlett', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur', 'D', 2),
(4, 'Jelani', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam', 'S', 2),
(5, 'Sonya', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus.', 'S', 5),
(6, 'Miranda', 'Lorem ipsum dolor sit amet, consectetuer adipiscing', 'S', 4),
(7, 'Helen', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus.', 'S', 2),
(8, 'Octavia', 'Lorem ipsum dolor sit amet,', 'D', 3),
(9, 'Gretchen', 'Lorem ipsum dolor sit', 'D', 3),
(10, 'Bernard', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer', 'S', 5),
(11, 'Dacey', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur', 'D', 2),
(12, 'Preston', 'Lorem', 'D', 2),
(13, 'Dane', 'Lorem ipsum dolor', 'S', 4),
(14, 'Cole', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam', 'S', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `roomID` (`roomID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `room` (`roomID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
