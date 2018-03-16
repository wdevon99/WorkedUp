-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2018 at 06:45 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssp`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderNo` int(4) NOT NULL,
  `userId` int(4) NOT NULL,
  `orderDateTime` datetime NOT NULL,
  `orderTotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderNo`, `userId`, `orderDateTime`, `orderTotal`) VALUES
(28, 1, '2018-03-16 18:18:35', '62');

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `orderLineId` int(4) NOT NULL,
  `orderNo` int(4) NOT NULL,
  `prodId` int(4) NOT NULL,
  `quantityOrdered` int(4) NOT NULL,
  `subTotal` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`orderLineId`, `orderNo`, `prodId`, `quantityOrdered`, `subTotal`) VALUES
(9, 28, 1, 9, '54.00'),
(10, 28, 2, 4, '8.00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prodId` int(4) NOT NULL,
  `prodName` varchar(30) NOT NULL,
  `prodPicName` varchar(50) NOT NULL,
  `prodDescrip` varchar(1000) DEFAULT NULL,
  `prodPrice` decimal(6,2) NOT NULL DEFAULT '0.00',
  `prodQuantity` int(4) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodId`, `prodName`, `prodPicName`, `prodDescrip`, `prodPrice`, `prodQuantity`) VALUES
(1, 'Admiral Football Size 5', 'football.jpg', 'High polymer multi laminated 32 panel size 5 football with regular trajectory, high abrasion resistance, excellent air retention and low water uptake. Polished finish to allow high speed uptake. For recreational or training use in all climatic conditions.  High polymer multi laminated construction.  Multi layer polyester support material.  Carbon butyl seamless bladder for high air retention  Dimensions: H22 x W22 x D22 Weight: 0.5kg', '6.00', 100),
(2, 'Slazenger Tennis Ball 5 inch', 'tenisball.jpg', 'Made out of the same materials as a normal tennis ball, this oversize slazenger ball is perfect to get your favourite players to sign & then can be kept as a memento. also great fun to use to help children learn to catch.\r\n\r\nDimensions: H13 x W13 x D13\r\nWeight: 0.3kg\r\n\r\nContents:\r\n1 x 5inch tennis ball', '2.00', 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userType` varchar(255) NOT NULL,
  `userFName` varchar(255) NOT NULL,
  `userSName` varchar(255) NOT NULL,
  `userAddress` varchar(255) NOT NULL,
  `userPostCode` varchar(255) NOT NULL,
  `userTelNo` bigint(20) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userType`, `userFName`, `userSName`, `userAddress`, `userPostCode`, `userTelNo`, `userEmail`, `userPassword`) VALUES
(1, '', 'devon', 'wijesinghe', 'kandana', '11320', 779141958, 'wdevon99@gmail.com', '123'),
(2, '', 'Praveen', 'Daya', 'Colombo', '11022', 779141890, 'praveen@gmail.com', '123'),
(3, '', 'himashi', 'hetti', 'street', '12345', 768563567, 'hishi@gmail.com', '123'),
(6, '', 'James', 'Bond', 'colombo', '1212', 779827364, 'james@gmail.com', '112233');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderNo`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`orderLineId`),
  ADD KEY `orderLineId` (`orderLineId`),
  ADD KEY `prodId` (`prodId`),
  ADD KEY `orderNo` (`orderNo`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderNo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `orderLineId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prodId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_first` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `order_line_ibfk_1` FOREIGN KEY (`orderNo`) REFERENCES `orders` (`orderNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_line_ibfk_2` FOREIGN KEY (`prodId`) REFERENCES `product` (`prodId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
