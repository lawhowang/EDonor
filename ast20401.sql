-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2018 at 06:27 PM
-- Server version: 5.5.60-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ast20401`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE IF NOT EXISTS `Appointment` (
  `id` int(11) NOT NULL,
  `donorId` int(11) NOT NULL,
  `venueId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `completed` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Appointment`
--

INSERT INTO `Appointment` (`id`, `donorId`, `venueId`, `date`, `completed`) VALUES
(1, 1, 1, '2018-12-14 09:00:00', 1),
(2, 2, 1, '2018-12-07 18:23:53', 1),
(3, 2, 1, '2018-12-07 18:23:53', 1),
(4, 2, 1, '2018-12-07 18:23:53', 1),
(5, 2, 1, '2018-12-07 18:23:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `BloodPack`
--

CREATE TABLE IF NOT EXISTS `BloodPack` (
  `id` int(11) NOT NULL,
  `bloodType` varchar(4) NOT NULL,
  `whiteBloodCell` decimal(2,2) NOT NULL,
  `redBloodCell` decimal(2,2) NOT NULL,
  `hemoglobin` decimal(2,2) NOT NULL,
  `hematocrit` decimal(2,2) NOT NULL,
  `entryDate` date NOT NULL,
  `expiryDate` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BloodPack`
--

INSERT INTO `BloodPack` (`id`, `bloodType`, `whiteBloodCell`, `redBloodCell`, `hemoglobin`, `hematocrit`, `entryDate`, `expiryDate`) VALUES
(1, 'A+', 0.50, 0.50, 0.50, 0.50, '2018-12-01', '2019-01-31'),
(2, 'A-', 0.50, 0.50, 0.50, 0.50, '2018-12-01', '2019-01-31'),
(3, 'B+', 0.50, 0.50, 0.50, 0.50, '2018-12-01', '2019-01-31'),
(4, 'B-', 0.50, 0.50, 0.50, 0.50, '2018-12-01', '2019-01-31'),
(5, 'O+', 0.50, 0.50, 0.50, 0.50, '2018-12-01', '2019-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `Diseases`
--

CREATE TABLE IF NOT EXISTS `Diseases` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `critical` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Donation`
--

CREATE TABLE IF NOT EXISTS `Donation` (
  `donorId` int(11) NOT NULL,
  `bloodPackId` int(11) NOT NULL,
  `venueId` int(11) NOT NULL,
  `staffId` int(11) NOT NULL,
  `donationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Donation`
--

INSERT INTO `Donation` (`donorId`, `bloodPackId`, `venueId`, `staffId`, `donationDate`) VALUES
(1, 1, 1, 1, '2018-12-07 10:02:34'),
(2, 2, 1, 1, '2018-12-07 10:25:03'),
(2, 3, 1, 1, '2018-12-07 10:25:39'),
(2, 4, 1, 1, '2018-12-07 10:25:51'),
(2, 5, 1, 1, '2018-12-07 10:26:17');

-- --------------------------------------------------------

--
-- Table structure for table `DonationVenue`
--

CREATE TABLE IF NOT EXISTS `DonationVenue` (
  `id` int(11) NOT NULL,
  `locationId` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `openTime` time NOT NULL,
  `closeTime` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DonationVenue`
--

INSERT INTO `DonationVenue` (`id`, `locationId`, `name`, `openTime`, `closeTime`) VALUES
(1, 1, 'Donation Venue 1 (Kowloon)', '09:00:00', '16:00:00'),
(2, 2, 'Donation Venue 2 (New Territories)', '10:00:00', '16:00:00'),
(3, 3, 'Donation Venue 3 (Hong Kong Island)', '11:00:00', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Donor`
--

CREATE TABLE IF NOT EXISTS `Donor` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthDate` date NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `emergencyContact` varchar(20) DEFAULT NULL,
  `verificationStatus` tinyint(1) NOT NULL DEFAULT '0',
  `bloodType` varchar(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Donor`
--

INSERT INTO `Donor` (`id`, `userId`, `firstName`, `lastName`, `gender`, `birthDate`, `photo`, `emergencyContact`, `verificationStatus`, `bloodType`) VALUES
(1, 1, 'Tai Man', 'Chan', 'F', '1999-01-01', NULL, NULL, 1, 'A+');

-- --------------------------------------------------------

--
-- Table structure for table `Hospital`
--

CREATE TABLE IF NOT EXISTS `Hospital` (
  `id` int(11) NOT NULL,
  `locationId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Hospital`
--

INSERT INTO `Hospital` (`id`, `locationId`, `name`) VALUES
(1, 4, 'Kowloon Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `Inventory`
--

CREATE TABLE IF NOT EXISTS `Inventory` (
  `id` int(11) NOT NULL,
  `bloodPackId` int(11) NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `sentDate` datetime DEFAULT NULL,
  `received` tinyint(1) NOT NULL DEFAULT '0',
  `receivedDate` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Inventory`
--

INSERT INTO `Inventory` (`id`, `bloodPackId`, `sent`, `sentDate`, `received`, `receivedDate`) VALUES
(1, 1, 0, NULL, 0, NULL),
(2, 2, 0, NULL, 0, NULL),
(3, 3, 0, NULL, 0, NULL),
(4, 4, 0, NULL, 0, NULL),
(5, 5, 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE IF NOT EXISTS `Location` (
  `id` int(11) NOT NULL,
  `area` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Location`
--

INSERT INTO `Location` (`id`, `area`, `address`) VALUES
(1, 'Kowloon', 'Donation venue in Kowloon'),
(2, 'New Territories', 'Donation venue in New Territories'),
(3, 'Hong Kong Island', 'Donation venue in Hong Kong Island'),
(4, 'Kowloon', 'Address of Kowloon Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `MedicalRecord`
--

CREATE TABLE IF NOT EXISTS `MedicalRecord` (
  `id` int(11) NOT NULL,
  `donorId` int(11) NOT NULL,
  `diseaseId` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `MedicalStaff`
--

CREATE TABLE IF NOT EXISTS `MedicalStaff` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `hospitalId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthDate` date NOT NULL,
  `photo` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MedicalStaff`
--

INSERT INTO `MedicalStaff` (`id`, `userId`, `hospitalId`, `firstName`, `lastName`, `gender`, `birthDate`, `photo`, `contact`, `position`) VALUES
(1, 3, 1, 'Siu Man', 'Lam', 'F', '1995-01-01', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Reservation`
--

CREATE TABLE IF NOT EXISTS `Reservation` (
  `hospitalId` int(11) NOT NULL,
  `bloodPackId` int(11) NOT NULL,
  `reservedDate` datetime DEFAULT NULL,
  `released` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reservation`
--

INSERT INTO `Reservation` (`hospitalId`, `bloodPackId`, `reservedDate`, `released`) VALUES
(1, 1, '2018-12-06 18:02:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE IF NOT EXISTS `Staff` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `venueId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthDate` date NOT NULL,
  `photo` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Staff`
--

INSERT INTO `Staff` (`id`, `userId`, `venueId`, `firstName`, `lastName`, `gender`, `birthDate`, `photo`, `contact`, `position`) VALUES
(1, 2, 1, 'Siu Ming', 'Chan', 'M', '1990-01-01', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Survey`
--

CREATE TABLE IF NOT EXISTS `Survey` (
  `id` int(11) NOT NULL,
  `donorId` int(11) NOT NULL,
  `donatedBefore` tinyint(1) NOT NULL DEFAULT '0',
  `hasTravel` int(11) NOT NULL,
  `lastDonationDate` date NOT NULL,
  `completedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Survey`
--

INSERT INTO `Survey` (`id`, `donorId`, `donatedBefore`, `hasTravel`, `lastDonationDate`, `completedDate`) VALUES
(1, 1, 1, 0, '0000-00-00', '2018-12-07 10:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registrationDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastLoginDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `username`, `password`, `email`, `registrationDateTime`, `lastLoginDateTime`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@gmail.com', '2018-12-07 09:45:05', '2018-12-07 18:22:25'),
(2, 'staff', '1253208465b1efa876f982d8a9e73eef', 'staff@gmail.com', '2018-12-07 09:46:46', '2018-12-07 18:24:02'),
(3, 'medicalstaff', 'd266ddc2d9568e83c1da38969b180ab5', 'medicalstaff@gmail.com', '2018-12-07 09:54:57', '2018-12-07 18:26:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `BloodPack`
--
ALTER TABLE `BloodPack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Diseases`
--
ALTER TABLE `Diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Donation`
--
ALTER TABLE `Donation`
  ADD PRIMARY KEY (`donorId`,`bloodPackId`);

--
-- Indexes for table `DonationVenue`
--
ALTER TABLE `DonationVenue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Donor`
--
ALTER TABLE `Donor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Hospital`
--
ALTER TABLE `Hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Inventory`
--
ALTER TABLE `Inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MedicalRecord`
--
ALTER TABLE `MedicalRecord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MedicalStaff`
--
ALTER TABLE `MedicalStaff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`hospitalId`,`bloodPackId`);

--
-- Indexes for table `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Survey`
--
ALTER TABLE `Survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Appointment`
--
ALTER TABLE `Appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `BloodPack`
--
ALTER TABLE `BloodPack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Diseases`
--
ALTER TABLE `Diseases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `DonationVenue`
--
ALTER TABLE `DonationVenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Donor`
--
ALTER TABLE `Donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Hospital`
--
ALTER TABLE `Hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Inventory`
--
ALTER TABLE `Inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Location`
--
ALTER TABLE `Location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `MedicalRecord`
--
ALTER TABLE `MedicalRecord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `MedicalStaff`
--
ALTER TABLE `MedicalStaff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Staff`
--
ALTER TABLE `Staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Survey`
--
ALTER TABLE `Survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
