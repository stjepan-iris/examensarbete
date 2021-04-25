-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2021 at 04:28 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `img`
--

CREATE TABLE `img` (
  `id` int(11) NOT NULL,
  `carId` varchar(255) NOT NULL,
  `fileName` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `img`
--

INSERT INTO `img` (`id`, `carId`, `fileName`) VALUES
(17, '81', '6012a54c459413.37817044.jpg'),
(21, '83', '6012a6e1109420.10294524.jpg'),
(22, '84', '6069835381a423.27038508.jpg'),
(33, '87', '607ed39b6d7ec6.65690471.png'),
(34, '88', '607fd5f22df8c3.00475781.jpg'),
(35, '87', 'test'),
(36, '89', '607fd929a52381.67389270.jpg'),
(37, '89', '607fd929a5ce02.48007593.jpg'),
(38, '89', '607fd929a67582.29018455.png'),
(40, '91', '607fd999207d67.78882240.jpg'),
(41, '91', '607fd999211b60.94070136.jpg'),
(44, '91', '607ff43f4499a2.86502371.png'),
(47, '90', '60800905ac5b03.79064493.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `carModel` varchar(150) NOT NULL,
  `carInfo` varchar(500) NOT NULL,
  `datePosted` date NOT NULL DEFAULT current_timestamp(),
  `userID` int(11) NOT NULL,
  `Img` varchar(500) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `mileage` int(255) NOT NULL,
  `color` varchar(20) NOT NULL,
  `gearbox` varchar(20) NOT NULL,
  `fuel` varchar(20) NOT NULL,
  `modelYear` int(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(69) NOT NULL,
  `price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `carModel`, `carInfo`, `datePosted`, `userID`, `Img`, `manufacturer`, `mileage`, `color`, `gearbox`, `fuel`, `modelYear`, `city`, `address`, `price`) VALUES
(90, '', '', '2021-04-21', 9, '', '', 0, '', '', '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FirstName`, `LastName`, `Email`, `UserName`, `Password`, `Role`) VALUES
(9, 'admin', 'admin', 'admin@admin.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(12, 'stjepan', 'iris', 'stjepan.iris127@gmail.com', 'asd', '7815696ecbf1c96e6894b779456d330e', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carId` (`carId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `img`
--
ALTER TABLE `img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
