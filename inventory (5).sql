-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2019 at 11:11 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventoryreport`
--

CREATE TABLE `inventoryreport` (
  `date` date NOT NULL,
  `category` varchar(30) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `prodcode` bigint(11) NOT NULL,
  `proddesc` varchar(50) NOT NULL,
  `size` varchar(10) NOT NULL,
  `repoint` int(2) NOT NULL,
  `prodquan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventoryreport`
--

INSERT INTO `inventoryreport` (`date`, `category`, `brand`, `prodcode`, `proddesc`, `size`, `repoint`, `prodquan`) VALUES
('2019-10-11', 'pvc green', 'era', 10000000021, 'Lol', '1/2', 1, 4),
('2019-10-12', 'PVC Blue', 'Moldex', 10000000001, 'Pipes 3 Meters', '1/2', 5, 20),
('2019-10-12', 'PVC Blue', 'Moldex', 10000000002, 'Male Adaptor', '1/2', 5, 0),
('2019-10-12', 'PVC Blue', 'Tian', 10000000006, 'Threaded Tee', '4', 5, 10),
('2019-10-12', 'PVC White', 'Era', 10000000007, 'Gate Valve', '6', 5, 39),
('2019-10-12', 'pvc blue', 'Tian', 10000000008, 'Coupling', '1 1/2', 5, 10),
('2019-10-12', 'sanitary orange', 'neltex', 10000000010, 'Wye', '2', 5, 15),
('2019-10-12', 'ppr white', 'era', 10000000011, 'Male Union', '5', 5, 0),
('2019-10-12', 'pvc blue', 'tian', 10000000012, 'Cap', '2', 5, 10),
('2019-10-12', 'pvc blue', 'moldex', 10000000013, 'Female Adaptor', '2 1/2', 5, 10),
('2019-10-12', 'pvc blue', 'neltex', 10000000016, 'Ball Valve', '1/2', 10, 23),
('2019-10-12', 'ppr white', 'emerald', 10000000018, 'Female Adaptor', '4', 5, 5),
('2019-10-12', 'pvc blue', 'era', 10000000020, 'Wye', '1/2', 5, 5),
('2019-10-13', 'dww', 'wwdw', 10000000021, 'Lol', '1/2', 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `inventoryview`
-- (See below for the actual view)
--
CREATE TABLE `inventoryview` (
`now()` datetime
,`category` varchar(30)
,`brand` varchar(20)
,`prodcode` bigint(11)
,`proddesc` varchar(50)
,`size` varchar(10)
,`repoint` int(2)
,`prodquan` int(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetails`
--

CREATE TABLE `invoicedetails` (
  `invoiceNum` int(4) NOT NULL,
  `SONum` int(4) NOT NULL,
  `ProdCode` bigint(11) NOT NULL,
  `Category` varchar(30) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `ProdDesc` varchar(50) NOT NULL,
  `Size` varchar(10) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `QuantityIssued` int(5) DEFAULT NULL,
  `Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicedetails`
--

INSERT INTO `invoicedetails` (`invoiceNum`, `SONum`, `ProdCode`, `Category`, `Brand`, `ProdDesc`, `Size`, `Quantity`, `QuantityIssued`, `Price`) VALUES
(1, 1, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 10, 10, 500),
(2, 1, 10000000002, 'PVC Blue', 'Moldex', 'Male Adaptor', '1/2', 10, 10, 1500),
(2, 1, 10000000007, 'PVC White', 'Era', 'Gate Valve', '6', 10, 10, 1000),
(3, 2, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 10, 10, 500),
(4, 2, 10000000008, 'pvc blue', 'Tian', 'Coupling', '1 1/2', 10, 10, 1700),
(5, 6, 10000000002, 'PVC Blue', 'Moldex', 'Male Adaptor', '1/2', 20, 10, 1500);

--
-- Triggers `invoicedetails`
--
DELIMITER $$
CREATE TRIGGER `invoicedetails_AFTER_INSERT` AFTER INSERT ON `invoicedetails` FOR EACH ROW BEGIN
UPDATE products 
SET prodquan = prodquan - new.QuantityIssued ,
quanSold = quanSold + new.QuantityIssued
WHERE prodcode = new.ProdCode;

UPDATE salesorderdetails 
SET issued = issued + new.QuantityIssued
WHERE prodcode = new.ProdCode 
AND SONum = new.SONum;

UPDATE salesorderdetails 
SET available = available - new.QuantityIssued 
WHERE prodcode = new.ProdCode;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `invoicedetails_BEFORE_INSERT` BEFORE INSERT ON `invoicedetails` FOR EACH ROW BEGIN
IF(new.quantityissued > new.quantity) THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Exceeded expected quantity. Please try again';
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `invoicedetails_BEFORE_UPDATE` BEFORE UPDATE ON `invoicedetails` FOR EACH ROW BEGIN

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `lowstockproducts`
-- (See below for the actual view)
--
CREATE TABLE `lowstockproducts` (
`prodcode` bigint(11)
,`category` varchar(30)
,`brand` varchar(20)
,`proddesc` varchar(50)
,`size` varchar(10)
,`onhand` int(5)
,`forinventory` bigint(12)
,`fororders` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `ordermanagement`
--

CREATE TABLE `ordermanagement` (
  `SONum` int(11) NOT NULL,
  `Date` date NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `TotalAmount` double NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordermanagement`
--

INSERT INTO `ordermanagement` (`SONum`, `Date`, `CustomerName`, `Address`, `TotalAmount`, `Status`) VALUES
(1, '2019-08-23', 'Stephen Chua', 'Manila', 3000, 'Completed'),
(2, '2019-08-23', 'Matthew Vidallon', 'Alabang', 2200, 'Completed'),
(3, '2019-08-23', 'bobi', 'quezon city', 1500, 'Ongoing'),
(4, '2019-09-23', 'aly', 'batangas', 1250, 'Ongoing'),
(5, '2019-09-24', 'aly', 'laguna', 1500, 'Ongoing'),
(6, '2019-09-26', 'aly', 'laguna', 4000, 'Ongoing'),
(7, '2019-09-28', 'aly', 'laguna', 3700, 'Ongoing');

--
-- Triggers `ordermanagement`
--
DELIMITER $$
CREATE TRIGGER `ordermanagement_BEFORE_INSERT` BEFORE INSERT ON `ordermanagement` FOR EACH ROW BEGIN
SET new.status = 'Ongoing';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prodcode` bigint(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `proddesc` varchar(50) NOT NULL,
  `size` varchar(10) NOT NULL,
  `prodquan` int(5) NOT NULL,
  `repoint` int(2) NOT NULL,
  `quanSold` int(4) NOT NULL,
  `price` double NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prodcode`, `category`, `brand`, `proddesc`, `size`, `prodquan`, `repoint`, `quanSold`, `price`, `status`) VALUES
(10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 35, 5, 89, 50, ''),
(10000000002, 'PVC Blue', 'Moldex', 'Male Adaptor', '1/2', 0, 5, 50, 150, ''),
(10000000006, 'PVC Blue', 'Tian', 'Threaded Tee', '4', 10, 5, 4, 25, ''),
(10000000007, 'PVC White', 'Era', 'Gate Valve', '6', 39, 5, 14, 100, ''),
(10000000008, 'pvc blue', 'Tian', 'Coupling', '1 1/2', 10, 5, 10, 170, ''),
(10000000010, 'sanitary orange', 'neltex', 'Wye', '2', 15, 5, 5, 20, ''),
(10000000011, 'ppr white', 'era', 'Male Union', '5', 0, 5, 5, 90, ''),
(10000000012, 'pvc blue', 'tian', 'Cap', '2', 10, 5, 0, 65, ''),
(10000000013, 'pvc blue', 'moldex', 'Female Adaptor', '2 1/2', 10, 5, 0, 135, ''),
(10000000016, 'pvc blue', 'neltex', 'Ball Valve', '1/2', 23, 10, 0, 90, ''),
(10000000018, 'ppr white', 'emerald', 'Female Adaptor', '4', 5, 5, 0, 120, ''),
(10000000020, 'pvc blue', 'era', 'Wye', '1/2', 5, 5, 0, 100, 'Discontinued');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `products_AFTER_UPDATE` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
UPDATE salesorderdetails 
SET available =  new.prodquan
WHERE prodcode = new.prodcode;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `products_BEFORE_INSERT` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
DECLARE COUNT INT(2);
SET COUNT = (select count(prodcode) FROM products WHERE category = new.category AND brand = new.brand AND proddesc = new.proddesc AND size = new.size);

if(count>0) THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Item exists!';
END IF;

SET new.status = "Available";
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseaudit`
--

CREATE TABLE `purchaseaudit` (
  `Date` datetime NOT NULL,
  `PONum` int(4) NOT NULL,
  `ProductCode` bigint(11) NOT NULL,
  `Received` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseaudit`
--

INSERT INTO `purchaseaudit` (`Date`, `PONum`, `ProductCode`, `Received`) VALUES
('2019-10-17 14:56:03', 2, 10000000001, 3),
('2019-10-17 15:28:46', 2, 10000000007, 5),
('2019-10-17 15:55:39', 2, 10000000001, 0),
('2019-10-17 15:55:42', 2, 10000000007, 0),
('2019-10-17 16:05:22', 4, 10000000001, 5),
('2019-10-17 16:12:31', 5, 10000000001, 10),
('2019-10-17 16:13:31', 6, 10000000001, 10);

-- --------------------------------------------------------

--
-- Table structure for table `p_podetails`
--

CREATE TABLE `p_podetails` (
  `PONum` int(11) NOT NULL,
  `ProductCode` bigint(11) NOT NULL,
  `Category` varchar(45) NOT NULL,
  `Brand` varchar(45) NOT NULL,
  `ProductDesc` varchar(45) NOT NULL,
  `Size` varchar(45) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `ToReceive` int(5) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `p_podetails`
--

INSERT INTO `p_podetails` (`PONum`, `ProductCode`, `Category`, `Brand`, `ProductDesc`, `Size`, `Quantity`, `ToReceive`, `status`) VALUES
(1, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 10, 5, 'Stock'),
(1, 10000000002, 'PVC Blue', 'Moldex', 'Male Adaptor', '1/2', 5, 5, 'Processing'),
(2, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 10, 7, 'Shipment Timeframe'),
(2, 10000000007, 'PVC White', 'Era', 'Gate Valve', '6', 10, 5, 'Shipment Timeframe'),
(3, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 5, 0, 'Processing'),
(4, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 5, -5, 'Processing'),
(5, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 10, -10, 'Fully Received'),
(6, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 10, -10, 'Fully Received');

--
-- Triggers `p_podetails`
--
DELIMITER $$
CREATE TRIGGER `p_podetails_AFTER_UPDATE` AFTER UPDATE ON `p_podetails` FOR EACH ROW BEGIN

DECLARE numItems INT(3);
DECLARE numCancelled INT(3);
DECLARE numfullyReceived INT(3);
SET numItems = (SELECT COUNT(PONum) FROM p_podetails WHERE PONum = new.PONum); 
SET numCancelled = (SELECT COUNT(ProductCode) FROM p_podetails WHERE PONum = new.PONum AND Status = 'Shipment Timeframe' OR Status = 'Product Unavailability');
SET numfullyReceived = (SELECT COUNT(ProductCode) FROM p_podetails WHERE PONum = new.PONum AND Status = 'Fully Received'); 



if(numItems =( numfullyReceived + numCancelled)) THEN 

UPDATE p_purchasingmanagement 
SET status = 'Completed' 
WHERE PONum = new.PONum;
END IF; 

IF (numCancelled = numItems) THEN 
UPDATE p_purchasingmanagement 
SET status = 'Cancelled' 
WHERE PONum = new.PONum;

END IF;

if(new.ToReceive) THEN
INSERT INTO purchaseaudit (Date, PONum, ProductCode, Received) VALUES (now(), new.PONum, new.ProductCode, old.ToReceive - new.ToReceive);

END IF;





END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `p_podetails_BEFORE_INSERT` BEFORE INSERT ON `p_podetails` FOR EACH ROW BEGIN
set new.status = 'Processing';
set new.ToReceive = new.Quantity;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `p_podetails_BEFORE_UPDATE` BEFORE UPDATE ON `p_podetails` FOR EACH ROW BEGIN
if(new.ToReceive = 0) THEN 
SET new.status = 'Fully Received'; 
END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `p_purchasingmanagement`
--

CREATE TABLE `p_purchasingmanagement` (
  `PONum` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `SupplierName` varchar(45) NOT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `Status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `p_purchasingmanagement`
--

INSERT INTO `p_purchasingmanagement` (`PONum`, `Date`, `SupplierName`, `Address`, `Status`) VALUES
(1, '2019-10-16 00:00:00', 'mac', 'kuala lumpur', 'Cancelled'),
(2, '2019-10-17 00:00:00', 'macky', 'china', 'Cancelled'),
(3, '2019-10-17 00:00:00', 'mcdonalds', 'china', 'Ongoing'),
(4, '2019-10-17 00:00:00', 'mac macy', 'china', 'Ongoing'),
(5, '2019-10-17 00:00:00', 'mac mac', 'china', 'Completed'),
(6, '2019-10-17 00:00:00', 'mackie', 'kuala lumpur', 'Completed');

--
-- Triggers `p_purchasingmanagement`
--
DELIMITER $$
CREATE TRIGGER `p_purchasingmanagement_BEFORE_INSERT` BEFORE INSERT ON `p_purchasingmanagement` FOR EACH ROW BEGIN
SET new.status = 'Ongoing';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `salesmanagement`
--

CREATE TABLE `salesmanagement` (
  `invoiceNum` int(4) NOT NULL,
  `date` date NOT NULL,
  `customername` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `salesbeforeVat` double NOT NULL,
  `salesafterVat` double NOT NULL,
  `SONum` int(4) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesmanagement`
--

INSERT INTO `salesmanagement` (`invoiceNum`, `date`, `customername`, `address`, `salesbeforeVat`, `salesafterVat`, `SONum`, `status`) VALUES
(1, '2019-08-23', '', '', 500, 440, 1, 'Ongoing'),
(2, '2019-08-23', '', '', 2500, 2200, 1, 'Ongoing'),
(3, '2019-08-23', '', '', 500, 440, 2, 'Ongoing'),
(4, '2019-08-23', '', '', 1700, 1496, 2, 'Ongoing'),
(5, '2019-09-26', '', '', 1500, 1320, 6, 'Ongoing');

--
-- Triggers `salesmanagement`
--
DELIMITER $$
CREATE TRIGGER `salesmanagement_BEFORE_INSERT` BEFORE INSERT ON `salesmanagement` FOR EACH ROW BEGIN
SET new.status = 'Ongoing';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `salesorderdetails`
--

CREATE TABLE `salesorderdetails` (
  `SONum` int(4) NOT NULL,
  `ProdCode` bigint(11) NOT NULL,
  `Category` varchar(30) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `ProdDesc` varchar(50) NOT NULL,
  `Size` varchar(10) NOT NULL,
  `ProdQuan` int(5) NOT NULL,
  `Available` int(5) NOT NULL,
  `Issued` int(5) NOT NULL,
  `Price` double NOT NULL,
  `TotalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesorderdetails`
--

INSERT INTO `salesorderdetails` (`SONum`, `ProdCode`, `Category`, `Brand`, `ProdDesc`, `Size`, `ProdQuan`, `Available`, `Issued`, `Price`, `TotalPrice`) VALUES
(1, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 10, 35, 10, 50, 500),
(1, 10000000002, 'PVC Blue', 'Moldex', 'Male Adaptor', '1/2', 10, -10, 10, 150, 1500),
(1, 10000000007, 'PVC White', 'Era', 'Gate Valve', '6', 10, 39, 10, 100, 1000),
(2, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 10, 35, 10, 50, 500),
(2, 10000000008, 'pvc blue', 'Tian', 'Coupling', '1 1/2', 10, 0, 10, 170, 1700),
(3, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 10, 35, 0, 50, 500),
(3, 10000000007, 'PVC White', 'Era', 'Gate Valve', '6', 10, 39, 0, 100, 1000),
(4, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 10, 35, 0, 50, 500),
(4, 10000000002, 'PVC Blue', 'Moldex', 'Male Adaptor', '1/2', 5, -10, 0, 150, 750),
(5, 10000000001, 'PVC Blue', 'Moldex', 'Pipes 3 Meters', '1/2', 30, 35, 0, 50, 1500),
(6, 10000000002, 'PVC Blue', 'Moldex', 'Male Adaptor', '1/2', 20, -10, 10, 150, 3000),
(6, 10000000007, 'PVC White', 'Era', 'Gate Valve', '6', 10, 39, 0, 100, 1000),
(7, 10000000002, 'PVC Blue', 'Moldex', 'Male Adaptor', '1/2', 19, 0, 0, 150, 2850),
(7, 10000000008, 'pvc blue', 'Tian', 'Coupling', '1 1/2', 5, 10, 0, 170, 850);

--
-- Triggers `salesorderdetails`
--
DELIMITER $$
CREATE TRIGGER `salesorderdetails_AFTER_UPDATE` AFTER UPDATE ON `salesorderdetails` FOR EACH ROW BEGIN
DECLARE numItems INT(3);
DECLARE numCompleted INT(3);
SET numItems = (SELECT COUNT(SONum) FROM salesorderdetails WHERE SONum = new.SONum); 
SET numCompleted = (SELECT COUNT(SONum) FROM salesorderdetails WHERE SONum = new.SONum AND ProdQuan = Issued);


if(numItems = numCompleted) THEN 

UPDATE ordermanagement 
SET status = 'Completed' 
WHERE SONum = new.SONum;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `salesreport`
--

CREATE TABLE `salesreport` (
  `year` int(4) NOT NULL,
  `month` int(4) NOT NULL,
  `salesbeforetax` double NOT NULL,
  `vat` double NOT NULL,
  `salesaftertax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesreport`
--

INSERT INTO `salesreport` (`year`, `month`, `salesbeforetax`, `vat`, `salesaftertax`) VALUES
(2019, 6, 20000, 2400, 17600),
(2019, 7, 25000, 3000, 22000),
(2019, 8, 30000, 3600, 26400);

-- --------------------------------------------------------

--
-- Table structure for table `temporaryinvoice`
--

CREATE TABLE `temporaryinvoice` (
  `invoiceNum` int(4) NOT NULL,
  `SONum` int(4) NOT NULL,
  `ProdCode` bigint(11) NOT NULL,
  `Category` varchar(30) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `ProdDesc` varchar(50) NOT NULL,
  `Size` varchar(10) NOT NULL,
  `Quantity` varchar(5) NOT NULL,
  `QuantityIssued` varchar(5) NOT NULL,
  `Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `temporaryinvoice`
--
DELIMITER $$
CREATE TRIGGER `temporaryinvoice_BEFORE_INSERT` BEFORE INSERT ON `temporaryinvoice` FOR EACH ROW BEGIN
IF(new.Quantity < new.QuantityIssued) THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Exceeded expected quantity. Please try again';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `temporaryorders`
--

CREATE TABLE `temporaryorders` (
  `SONum` int(4) NOT NULL,
  `ProdCode` bigint(11) NOT NULL,
  `Category` varchar(30) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `ProdDesc` varchar(50) NOT NULL,
  `Size` varchar(10) NOT NULL,
  `Quantity` int(3) NOT NULL,
  `Available` int(3) NOT NULL,
  `Price` double NOT NULL,
  `TotalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `temporaryorders`
--
DELIMITER $$
CREATE TRIGGER `temporaryorders_BEFORE_INSERT` BEFORE INSERT ON `temporaryorders` FOR EACH ROW BEGIN

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `temporarypurchasing`
--

CREATE TABLE `temporarypurchasing` (
  `PONum` int(4) NOT NULL,
  `ProductCode` bigint(11) NOT NULL,
  `Category` varchar(45) NOT NULL,
  `Brand` varchar(45) NOT NULL,
  `ProductDesc` varchar(45) NOT NULL,
  `Size` varchar(10) NOT NULL,
  `SuggestedQuantity` int(5) NOT NULL,
  `QuantitytobeOrdered` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Email` varchar(50) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `Birthday` date NOT NULL,
  `Age` int(3) NOT NULL,
  `Password` varchar(12) NOT NULL,
  `UserType` varchar(20) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Email`, `LastName`, `FirstName`, `Birthday`, `Age`, `Password`, `UserType`, `Status`) VALUES
('', '', '', '0000-00-00', 0, '', '-----', 'Active'),
('aly.ramos.25@gmail.com', 'Ramos', 'Alyzza Cassandra', '2012-04-10', 0, 'password123', 'Sales', 'Disabled'),
('grace.cayabyab@gmail.com', 'Cayabyab', 'Grace', '1991-02-19', 28, 'p@ssword', 'Sales', 'Disabled'),
('janelle.sy@gmail.com', 'Sy', 'Janelle', '1991-04-17', 28, 'password123', 'Manager', 'Active'),
('jovelyn.depanay@gmail.com', 'Depanay', 'Jovelyn', '1991-01-20', 28, 'password', 'Assistant Manager', 'Active'),
('mashedpotatobender@gmail.com', 'Mouse', 'Mickey', '2014-01-03', 0, 'banana123', 'purchasing', 'Disabled'),
('tom.mccartney@gmail.com', 'Mccartney', 'Tom', '1990-04-15', 0, 'password', 'Sales', 'Active'),
('tomholland@gmail.com', 'Holland', 'Tom', '2018-12-01', 0, 'password', 'Sales', 'Disabled'),
('walker.white@gmail.com', 'White', 'Walker', '1991-03-15', 28, 'password1', 'Purchasing', 'Disabled');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `users_BEFORE_INSERT` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
set new.Status = 'Active';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `inventoryview`
--
DROP TABLE IF EXISTS `inventoryview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inventoryview`  AS  select current_timestamp() AS `now()`,`p`.`category` AS `category`,`p`.`brand` AS `brand`,`p`.`prodcode` AS `prodcode`,`p`.`proddesc` AS `proddesc`,`p`.`size` AS `size`,`p`.`repoint` AS `repoint`,`p`.`prodquan` AS `prodquan` from `products` `p` group by `p`.`category`,`p`.`brand`,`p`.`proddesc` ;

-- --------------------------------------------------------

--
-- Structure for view `lowstockproducts`
--
DROP TABLE IF EXISTS `lowstockproducts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lowstockproducts`  AS  select `p`.`prodcode` AS `prodcode`,`p`.`category` AS `category`,`p`.`brand` AS `brand`,`p`.`proddesc` AS `proddesc`,`p`.`size` AS `size`,`p`.`prodquan` AS `onhand`,`p`.`prodquan` + `p`.`repoint` AS `forinventory`,if(`so`.`ProdQuan` is null,0,`so`.`ProdQuan`) AS `fororders` from (`products` `p` left join `salesorderdetails` `so` on(`p`.`prodcode` = `so`.`ProdCode`)) where `p`.`prodquan` < `p`.`repoint` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventoryreport`
--
ALTER TABLE `inventoryreport`
  ADD PRIMARY KEY (`date`,`prodcode`);

--
-- Indexes for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD PRIMARY KEY (`invoiceNum`,`SONum`,`ProdCode`),
  ADD KEY `ProdCode` (`ProdCode`,`SONum`);

--
-- Indexes for table `ordermanagement`
--
ALTER TABLE `ordermanagement`
  ADD PRIMARY KEY (`SONum`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prodcode`,`repoint`);

--
-- Indexes for table `purchaseaudit`
--
ALTER TABLE `purchaseaudit`
  ADD PRIMARY KEY (`Date`);

--
-- Indexes for table `p_podetails`
--
ALTER TABLE `p_podetails`
  ADD PRIMARY KEY (`PONum`,`ProductCode`),
  ADD KEY `ProductCode` (`ProductCode`);

--
-- Indexes for table `p_purchasingmanagement`
--
ALTER TABLE `p_purchasingmanagement`
  ADD PRIMARY KEY (`PONum`);

--
-- Indexes for table `salesmanagement`
--
ALTER TABLE `salesmanagement`
  ADD PRIMARY KEY (`invoiceNum`),
  ADD KEY `SONum` (`SONum`);

--
-- Indexes for table `salesorderdetails`
--
ALTER TABLE `salesorderdetails`
  ADD PRIMARY KEY (`SONum`,`ProdCode`),
  ADD KEY `ProdCode` (`ProdCode`);

--
-- Indexes for table `salesreport`
--
ALTER TABLE `salesreport`
  ADD PRIMARY KEY (`year`,`month`);

--
-- Indexes for table `temporaryinvoice`
--
ALTER TABLE `temporaryinvoice`
  ADD PRIMARY KEY (`invoiceNum`,`ProdCode`,`SONum`),
  ADD KEY `SONum` (`SONum`,`ProdCode`);

--
-- Indexes for table `temporaryorders`
--
ALTER TABLE `temporaryorders`
  ADD KEY `ProdCode` (`ProdCode`);

--
-- Indexes for table `temporarypurchasing`
--
ALTER TABLE `temporarypurchasing`
  ADD PRIMARY KEY (`ProductCode`,`PONum`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ordermanagement`
--
ALTER TABLE `ordermanagement`
  MODIFY `SONum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prodcode` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000000023;

--
-- AUTO_INCREMENT for table `p_purchasingmanagement`
--
ALTER TABLE `p_purchasingmanagement`
  MODIFY `PONum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `salesmanagement`
--
ALTER TABLE `salesmanagement`
  MODIFY `invoiceNum` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD CONSTRAINT `invoicedetails_ibfk_1` FOREIGN KEY (`invoiceNum`) REFERENCES `salesmanagement` (`invoiceNum`),
  ADD CONSTRAINT `invoicedetails_ibfk_2` FOREIGN KEY (`ProdCode`,`SONum`) REFERENCES `salesorderdetails` (`ProdCode`, `SONum`);

--
-- Constraints for table `p_podetails`
--
ALTER TABLE `p_podetails`
  ADD CONSTRAINT `p_podetails_ibfk_1` FOREIGN KEY (`PONum`) REFERENCES `p_purchasingmanagement` (`PONum`),
  ADD CONSTRAINT `p_podetails_ibfk_2` FOREIGN KEY (`ProductCode`) REFERENCES `products` (`prodcode`);

--
-- Constraints for table `salesmanagement`
--
ALTER TABLE `salesmanagement`
  ADD CONSTRAINT `salesmanagement_ibfk_1` FOREIGN KEY (`SONum`) REFERENCES `ordermanagement` (`SONum`),
  ADD CONSTRAINT `salesmanagement_ibfk_2` FOREIGN KEY (`SONum`) REFERENCES `salesorderdetails` (`SONum`);

--
-- Constraints for table `salesorderdetails`
--
ALTER TABLE `salesorderdetails`
  ADD CONSTRAINT `salesorderdetails_ibfk_2` FOREIGN KEY (`ProdCode`) REFERENCES `products` (`prodcode`),
  ADD CONSTRAINT `salesorderdetails_ibfk_3` FOREIGN KEY (`SONum`) REFERENCES `ordermanagement` (`SONum`);

--
-- Constraints for table `temporaryinvoice`
--
ALTER TABLE `temporaryinvoice`
  ADD CONSTRAINT `temporaryinvoice_ibfk_1` FOREIGN KEY (`SONum`,`ProdCode`) REFERENCES `salesorderdetails` (`SONum`, `ProdCode`);

--
-- Constraints for table `temporaryorders`
--
ALTER TABLE `temporaryorders`
  ADD CONSTRAINT `temporaryorders_ibfk_1` FOREIGN KEY (`ProdCode`) REFERENCES `products` (`prodcode`);

--
-- Constraints for table `temporarypurchasing`
--
ALTER TABLE `temporarypurchasing`
  ADD CONSTRAINT `temporarypurchasing_ibfk_1` FOREIGN KEY (`ProductCode`) REFERENCES `products` (`prodcode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
