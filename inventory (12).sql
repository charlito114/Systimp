-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 01:46 PM
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
('2019-11-18', 'pvc blue', 'moldex', 10000000000, 'pipes 3 meters', '1/2', 10, 50),
('2019-11-18', 'pvc blue', 'moldex', 10000000001, 'male adaptor', '1/2', 10, 45),
('2019-11-18', 'pvc blue', 'moldex', 10000000002, 'reducer', '2 X 1 ', 10, 0),
('2019-11-18', 'pvc blue', 'tian', 10000000003, 'cap', '2', 10, 30),
('2019-11-18', 'pvc blue', 'tian', 10000000004, 'plug', '3', 10, 0),
('2019-11-18', 'pvc blue', 'tian', 10000000005, 'threaded tee ', '4', 10, 40),
('2019-11-18', 'pvc faucet', 'n/a', 10000000006, 'plain bibb', '1/2', 10, 50),
('2019-11-18', 'pvc valves', 'n/a', 10000000007, 'ball valve', '1/2', 10, 9),
('2019-11-18', 'pvc valves', 'n/a', 10000000008, 'check valve', '1', 10, 0),
('2019-11-18', 'ppr white', 'era', 10000000009, 'gate valve', '3', 10, 0),
('2019-11-18', 'ppr white', 'era', 10000000010, 'ball valve', '2', 10, 0),
('2019-11-18', 'ppr white', 'vesbo', 10000000011, 'cap', '1', 10, 10),
('2019-11-18', 'ppr white', 'vesbo', 10000000012, 'pipes 4 meters', '1/2', 10, 25),
('2019-11-18', 'sanitary orange', 'emerald', 10000000013, 'tee reducer', '4 X 2', 10, 55),
('2019-11-18', 'sanitary orange', 'neltex', 10000000014, 'wye', '4', 10, 10),
('2019-11-18', 'sanitary orange', 'era', 10000000015, 'Ball Valve', '1/2', 10, 0),
('2019-11-19', 'pvc blue', 'moldex', 10000000000, 'pipes 3 meters', '1/2', 10, 50),
('2019-11-19', 'pvc blue', 'moldex', 10000000001, 'male adaptor', '1/2', 10, 45),
('2019-11-19', 'pvc blue', 'moldex', 10000000002, 'reducer', '2 X 1', 10, 0),
('2019-11-19', 'pvc blue', 'tian', 10000000003, 'cap', '2', 10, 30),
('2019-11-19', 'pvc blue', 'tian', 10000000004, 'plug', '3', 10, 0),
('2019-11-19', 'pvc blue', 'tian', 10000000005, 'threaded tee', '4', 10, 40),
('2019-11-19', 'pvc faucet', 'n/a', 10000000006, 'plain bibb', '1/2', 10, 50),
('2019-11-19', 'pvc valves', 'n/a', 10000000007, 'ball valve', '1/2', 10, 9),
('2019-11-19', 'pvc valves', 'n/a', 10000000008, 'check valve', '1', 10, 0),
('2019-11-19', 'ppr white', 'era', 10000000009, 'gate valve', '3', 10, 0),
('2019-11-19', 'ppr white', 'era', 10000000010, 'ball valve', '2', 10, 0),
('2019-11-19', 'ppr white', 'vesbo', 10000000011, 'cap', '1', 10, 10),
('2019-11-19', 'ppr white', 'vesbo', 10000000012, 'pipes 4 meters', '1/2', 10, 25),
('2019-11-19', 'sanitary orange', 'emerald', 10000000013, 'tee reducer', '4 X 2', 10, 55),
('2019-11-19', 'sanitary orange', 'neltex', 10000000014, 'wye', '4', 10, 10),
('2019-11-19', 'sanitary orange', 'era', 10000000015, 'Ball Valve', '1/2', 10, 0);

--
-- Triggers `inventoryreport`
--
DELIMITER $$
CREATE TRIGGER `inventoryreport_BEFORE_INSERT` BEFORE INSERT ON `inventoryreport` FOR EACH ROW BEGIN
set new.date= now();
END
$$
DELIMITER ;

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
  `invoiceNum` int(4) UNSIGNED ZEROFILL NOT NULL,
  `SONum` int(4) UNSIGNED ZEROFILL NOT NULL,
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
(0001, 0002, 10000000003, 'pvc blue', 'tian', 'cap', '2', 5, 5, 150),
(0001, 0002, 10000000007, 'pvc valves', 'n/a', 'ball valve', '1/2', 5, 5, 70),
(0002, 0003, 10000000002, 'pvc blue', 'moldex', 'reducer', '2 X 1 ', 10, 10, 45),
(0003, 0004, 10000000002, 'pvc blue', 'moldex', 'reducer', '2 X 1 ', 10, 3, 45),
(0004, 0004, 10000000001, 'pvc blue', 'moldex', 'male adaptor', '1/2', 10, 10, 50),
(0005, 0005, 10000000003, 'pvc blue', 'tian', 'cap', '2', 5, 5, 150),
(0005, 0005, 10000000008, 'pvc valves', 'n/a', 'check valve', '1', 10, 10, 60);

--
-- Triggers `invoicedetails`
--
DELIMITER $$
CREATE TRIGGER `invoicedetails_AFTER_INSERT` AFTER INSERT ON `invoicedetails` FOR EACH ROW BEGIN




END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `invoicedetails_BEFORE_INSERT` BEFORE INSERT ON `invoicedetails` FOR EACH ROW BEGIN

DECLARE prodavail INT(5); 
SET prodavail = (SELECT p.prodquan FROM products p JOIN invoiceDetails id ON p.prodcode = id.ProdCode WHERE p.prodcode = new.ProdCode LIMIT 1);
IF((new.QuantityIssued > new.Quantity)  OR (prodavail < new.QuantityIssued) OR (prodavail - new.QuantityIssued <0)) THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Exceeded expected quantity. Please try again';
END IF;


UPDATE salesorderdetails 
SET Issued = Issued + new.QuantityIssued
WHERE ProdCode = new.ProdCode 
AND SONum = new.SONum;

UPDATE salesorderdetails 
SET available = prodavail
WHERE prodcode = new.ProdCode;

UPDATE products 
SET quanSold = quanSold + new.QuantityIssued
WHERE prodcode = new.ProdCode;

UPDATE products 
SET prodquan = prodquan - new.QuantityIssued
WHERE prodcode = new.ProdCode;



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
  `SONum` int(4) UNSIGNED ZEROFILL NOT NULL,
  `Date` date NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordermanagement`
--

INSERT INTO `ordermanagement` (`SONum`, `Date`, `CustomerName`, `Address`, `TotalAmount`, `Status`) VALUES
(0001, '2019-11-17', 'aly', 'laguna', '1400.00', 'Pending'),
(0002, '2019-11-17', 'bobi', 'batangas', '1100.00', 'Completed'),
(0003, '2019-11-17', 'juliana', 'laguna', '450.00', 'Completed'),
(0004, '2019-11-19', 'aly', 'laguna', '950.00', 'Pending'),
(0005, '2019-11-24', 'aly', 'laguna', '1350.00', 'Completed'),
(0006, '2019-11-24', 'bobi', 'laguna', '500.00', 'Pending');

--
-- Triggers `ordermanagement`
--
DELIMITER $$
CREATE TRIGGER `ordermanagement_BEFORE_INSERT` BEFORE INSERT ON `ordermanagement` FOR EACH ROW BEGIN
SET new.status = 'Pending';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `pendingpo`
-- (See below for the actual view)
--
CREATE TABLE `pendingpo` (
`PONum` int(4) unsigned zerofill
,`Date` datetime
,`SupplierName` varchar(45)
,`Status` varchar(45)
,`totalItems` bigint(21)
,`pendingItems` decimal(23,0)
,`completion` decimal(31,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pendingso`
-- (See below for the actual view)
--
CREATE TABLE `pendingso` (
`Date` date
,`SONum` int(4) unsigned zerofill
,`CustomerName` varchar(100)
,`totalItems` bigint(21)
,`pendingItems` decimal(23,0)
,`completion` decimal(30,2)
);

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
  `price` decimal(10,2) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prodcode`, `category`, `brand`, `proddesc`, `size`, `prodquan`, `repoint`, `quanSold`, `price`, `status`) VALUES
(10000000000, 'pvc blue', 'moldex', 'pipes 3 meters', '1/2', 0, 10, 0, '100.00', 'Available'),
(10000000001, 'pvc blue', 'moldex', 'male adaptor', '1/2', 11, 10, 100, '50.00', 'Available'),
(10000000002, 'pvc blue', 'moldex', 'reducer', '2 X 1 ', 50, 10, 113, '45.00', 'Available'),
(10000000003, 'pvc blue', 'tian', 'cap', '2', 0, 10, 20, '150.00', 'Available'),
(10000000004, 'pvc blue', 'tian', 'plug', '3', 20, 10, 20, '20.00', 'Available'),
(10000000005, 'pvc blue', 'tian', 'threaded tee ', '4', 40, 10, 0, '90.00', 'Available'),
(10000000006, 'pvc faucet', 'n/a', 'plain bibb', '1/2', 50, 10, 0, '80.00', 'Available'),
(10000000007, 'pvc valves', 'n/a', 'ball valve', '1/2', 5, 10, 15, '70.00', 'Available'),
(10000000008, 'pvc valves', 'n/a', 'check valve', '1', 15, 10, 40, '60.00', 'Available'),
(10000000009, 'ppr white', 'era', 'gate valve', '3', 11, 10, 0, '35.00', 'Available'),
(10000000010, 'ppr white', 'era', 'ball valve', '2', 10, 10, 0, '25.00', 'Available'),
(10000000011, 'ppr white', 'vesbo', 'cap', '1', 20, 10, 0, '150.00', 'Available'),
(10000000012, 'ppr white', 'vesbo', 'pipes 4 meters', '1/2', 45, 10, 0, '120.00', 'Available'),
(10000000013, 'sanitary orange', 'emerald', 'tee reducer', '4 X 2', 55, 10, 0, '130.00', 'Available'),
(10000000014, 'sanitary orange', 'neltex', 'wye', '4', 10, 10, 0, '125.00', 'Available'),
(10000000015, 'sanitary orange', 'era', 'Ball Valve', '1/2', 20, 10, 0, '90.00', 'Available');

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
('2019-11-19 01:50:55', 1, 10000000001, 0),
('2019-11-19 01:51:24', 1, 10000000007, 5),
('2019-11-19 01:55:40', 2, 10000000001, 10),
('2019-11-19 02:06:13', 2, 10000000001, 0),
('2019-11-19 07:55:16', 3, 10000000002, 0),
('2019-11-19 07:55:39', 3, 10000000004, 1),
('2019-11-19 07:55:58', 3, 10000000004, 5),
('2019-11-19 09:46:51', 1, 10000000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `p_podetails`
--

CREATE TABLE `p_podetails` (
  `PONum` int(4) UNSIGNED ZEROFILL NOT NULL,
  `ProductCode` bigint(11) NOT NULL,
  `Category` varchar(45) NOT NULL,
  `Brand` varchar(45) NOT NULL,
  `ProductDesc` varchar(45) NOT NULL,
  `Size` varchar(45) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `ToReceive` int(5) NOT NULL,
  `Received` int(5) NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `p_podetails`
--

INSERT INTO `p_podetails` (`PONum`, `ProductCode`, `Category`, `Brand`, `ProductDesc`, `Size`, `Quantity`, `ToReceive`, `Received`, `status`) VALUES
(0001, 10000000000, 'pvc blue', 'moldex', 'pipes 3 meters', '1/2', 20, 20, 0, 'Timeframe'),
(0001, 10000000001, 'pvc blue', 'moldex', 'male adaptor', '1/2', 30, 0, 30, 'Fully Received');

--
-- Triggers `p_podetails`
--
DELIMITER $$
CREATE TRIGGER `p_podetails_AFTER_UPDATE` AFTER UPDATE ON `p_podetails` FOR EACH ROW BEGIN

DECLARE numItems INT(3);
DECLARE numCancelled INT(3);
DECLARE numfullyReceived INT(3);
SET numItems = (SELECT COUNT(PONum) FROM p_podetails WHERE PONum = new.PONum); 
SET numCancelled = (SELECT COUNT(ProductCode) FROM p_podetails WHERE PONum = new.PONum AND (Status = 'Timeframe' OR Status = 'Insufficient Stock'));
SET numfullyReceived = (SELECT COUNT(ProductCode) FROM p_podetails WHERE PONum = new.PONum AND Status = 'Fully Received'); 



if(numItems = ( numfullyReceived + numCancelled) OR (numItems = numfullyReceived)) THEN 
UPDATE p_purchasingmanagement 
SET status = 'Completed' 
WHERE PONum = new.PONum;
END IF; 

IF (numItems = numCancelled) THEN 
UPDATE p_purchasingmanagement 
SET status = 'Cancelled' 
WHERE PONum = new.PONum;

END IF;

if(new.ToReceive) THEN
INSERT INTO purchaseaudit (Date, PONum, ProductCode, Received) VALUES (now(), new.PONum, new.ProductCode, old.ToReceive - new.ToReceive);


END IF;


 UPDATE products 
 SET prodquan = prodquan + (old.ToReceive - new.ToReceive)
 WHERE prodcode = new.ProductCode;



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

if(new.Received>new.Quantity)THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Please check quantity and try again!';
END IF;





END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `p_purchasingmanagement`
--

CREATE TABLE `p_purchasingmanagement` (
  `PONum` int(4) UNSIGNED ZEROFILL NOT NULL,
  `Date` datetime NOT NULL,
  `SupplierName` varchar(45) NOT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `Status` varchar(45) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `p_purchasingmanagement`
--

INSERT INTO `p_purchasingmanagement` (`PONum`, `Date`, `SupplierName`, `Address`, `Status`) VALUES
(0001, '2019-11-19 00:00:00', 'justine', 'australia', 'Completed');

--
-- Triggers `p_purchasingmanagement`
--
DELIMITER $$
CREATE TRIGGER `p_purchasingmanagement_BEFORE_INSERT` BEFORE INSERT ON `p_purchasingmanagement` FOR EACH ROW BEGIN
SET new.status = 'Pending';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `salesmanagement`
--

CREATE TABLE `salesmanagement` (
  `invoiceNum` int(4) UNSIGNED ZEROFILL NOT NULL,
  `date` date NOT NULL,
  `customername` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `salesbeforeVat` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `vat` decimal(10,2) DEFAULT NULL,
  `salesafterVat` decimal(10,2) NOT NULL,
  `SONum` int(4) UNSIGNED ZEROFILL NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesmanagement`
--

INSERT INTO `salesmanagement` (`invoiceNum`, `date`, `customername`, `address`, `salesbeforeVat`, `discount`, `vat`, `salesafterVat`, `SONum`, `status`) VALUES
(0001, '2019-11-17', '', '', '1100.00', NULL, NULL, '1232.00', 0002, 'Ongoing'),
(0002, '2019-11-18', '', '', '450.00', NULL, NULL, '504.00', 0003, 'Ongoing'),
(0003, '2019-11-19', '', '', '115.00', NULL, NULL, '128.80', 0004, 'Ongoing'),
(0004, '2019-11-19', '', '', '500.00', NULL, NULL, '560.00', 0004, 'Ongoing'),
(0005, '2019-11-24', '', '', '1338.00', '12.00', '160.56', '1498.56', 0005, 'Ongoing');

--
-- Triggers `salesmanagement`
--
DELIMITER $$
CREATE TRIGGER `salesmanagement_AFTER_INSERT` AFTER INSERT ON `salesmanagement` FOR EACH ROW BEGIN
 
END
$$
DELIMITER ;
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
  `SONum` int(4) UNSIGNED ZEROFILL NOT NULL,
  `ProdCode` bigint(11) NOT NULL,
  `Category` varchar(30) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `ProdDesc` varchar(50) NOT NULL,
  `Size` varchar(10) NOT NULL,
  `ProdQuan` int(5) NOT NULL,
  `Available` int(5) NOT NULL,
  `Issued` int(5) NOT NULL,
  `Price` double NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesorderdetails`
--

INSERT INTO `salesorderdetails` (`SONum`, `ProdCode`, `Category`, `Brand`, `ProdDesc`, `Size`, `ProdQuan`, `Available`, `Issued`, `Price`, `TotalPrice`, `Status`) VALUES
(0001, 10000000001, 'pvc blue', 'moldex', 'male adaptor', '1/2', 10, 11, 0, 50, '500.00', 'Ready'),
(0001, 10000000002, 'pvc blue', 'moldex', 'reducer', '2 X 1 ', 20, 50, 0, 45, '900.00', 'Ready'),
(0002, 10000000003, 'pvc blue', 'tian', 'cap', '2', 5, 0, 5, 150, '750.00', 'Fully Issued'),
(0002, 10000000007, 'pvc valves', 'n/a', 'ball valve', '1/2', 5, 5, 5, 70, '350.00', 'Fully Issued'),
(0003, 10000000002, 'pvc blue', 'moldex', 'reducer', '2 X 1 ', 10, 50, 10, 45, '450.00', 'Fully Issued'),
(0004, 10000000001, 'pvc blue', 'moldex', 'male adaptor', '1/2', 10, 11, 10, 50, '500.00', 'Fully Issued'),
(0004, 10000000002, 'pvc blue', 'moldex', 'reducer', '2 X 1 ', 10, 50, 3, 45, '450.00', 'Ready'),
(0005, 10000000003, 'pvc blue', 'tian', 'cap', '2', 5, 0, 5, 150, '750.00', 'Processing'),
(0005, 10000000008, 'pvc valves', 'n/a', 'check valve', '1', 10, 15, 10, 60, '600.00', 'Fully Issued'),
(0006, 10000000001, 'pvc blue', 'moldex', 'male adaptor', '1/2', 10, 11, 0, 50, '500.00', 'Processing');

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
DELIMITER $$
CREATE TRIGGER `salesorderdetails_BEFORE_UPDATE` BEFORE UPDATE ON `salesorderdetails` FOR EACH ROW BEGIN
if(new.Issued = new.ProdQuan) THEN 
SET new.status = 'Fully Issued'; 
END IF;

if((new.Available >= new.ProdQuan) and old.status!= 'Fully Issued') THEN 
SET new.status = 'Ready'; 

elseif((new.Available < new.ProdQuan )AND old.status!= 'Fully Issued') THEN 
SET new.status = 'Processing'; 
END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `salesreport`
--

CREATE TABLE `salesreport` (
  `date` date NOT NULL,
  `grosssales` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `netsales` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temporaryinvoice`
--

CREATE TABLE `temporaryinvoice` (
  `invoiceNum` int(4) UNSIGNED ZEROFILL NOT NULL,
  `SONum` int(4) UNSIGNED ZEROFILL NOT NULL,
  `ProdCode` bigint(11) NOT NULL,
  `Category` varchar(30) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `ProdDesc` varchar(50) NOT NULL,
  `Size` varchar(10) NOT NULL,
  `Available` int(5) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `QuantityIssued` int(5) NOT NULL,
  `ToBeIssued` int(5) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temporaryinvoice`
--

INSERT INTO `temporaryinvoice` (`invoiceNum`, `SONum`, `ProdCode`, `Category`, `Brand`, `ProdDesc`, `Size`, `Available`, `Quantity`, `QuantityIssued`, `ToBeIssued`, `Price`, `TotalPrice`) VALUES
(0006, 0006, 10000000001, 'pvc blue', 'moldex', 'male adaptor', '1/2', 11, 10, 0, 10, '50.00', '500.00');

--
-- Triggers `temporaryinvoice`
--
DELIMITER $$
CREATE TRIGGER `temporaryinvoice_BEFORE_INSERT` BEFORE INSERT ON `temporaryinvoice` FOR EACH ROW BEGIN

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `temporaryinvoice_BEFORE_UPDATE` BEFORE UPDATE ON `temporaryinvoice` FOR EACH ROW BEGIN

IF(old.invoiceNum = new.invoiceNum) THEN
	IF((new.ToBeIssued > old.Available OR new.ToBeIssued > old.Quantity OR 
	new.ToBeIssued > (old.Quantity - old.QuantityIssued)))  THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Please check quantity and try again!';
	END IF;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `temporaryorders`
--

CREATE TABLE `temporaryorders` (
  `SONum` int(4) UNSIGNED ZEROFILL NOT NULL,
  `ProdCode` bigint(11) NOT NULL,
  `Category` varchar(30) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `ProdDesc` varchar(50) NOT NULL,
  `Size` varchar(10) NOT NULL,
  `Quantity` int(3) NOT NULL,
  `Available` int(3) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL
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
  `PONum` int(4) UNSIGNED ZEROFILL NOT NULL,
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

-- --------------------------------------------------------

--
-- Structure for view `pendingpo`
--
DROP TABLE IF EXISTS `pendingpo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pendingpo`  AS  select `p`.`PONum` AS `PONum`,`p`.`Date` AS `Date`,`p`.`SupplierName` AS `SupplierName`,`p`.`Status` AS `Status`,count(`pd`.`PONum`) AS `totalItems`,sum(`pd`.`status` = 'Processing') AS `pendingItems`,round(count(`pd`.`PONum`) - sum(`pd`.`status` = 'Processing'),0) / count(`pd`.`PONum`) * 100 AS `completion` from (`p_purchasingmanagement` `p` join `p_podetails` `pd` on(`p`.`PONum` = `pd`.`PONum`)) where `p`.`Status` = 'Pending' group by `p`.`PONum` ;

-- --------------------------------------------------------

--
-- Structure for view `pendingso`
--
DROP TABLE IF EXISTS `pendingso`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pendingso`  AS  select `o`.`Date` AS `Date`,`o`.`SONum` AS `SONum`,`o`.`CustomerName` AS `CustomerName`,count(`od`.`SONum`) AS `totalItems`,sum(`od`.`Status` = 'Processing') AS `pendingItems`,round((count(`od`.`SONum`) - sum(`od`.`Status` = 'Processing')) / count(`od`.`SONum`),2) * 100 AS `completion` from (`ordermanagement` `o` join `salesorderdetails` `od` on(`o`.`SONum` = `od`.`SONum`)) where `o`.`Status` = 'Pending' group by `o`.`SONum` ;

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
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `temporaryinvoice`
--
ALTER TABLE `temporaryinvoice`
  ADD PRIMARY KEY (`SONum`,`ProdCode`);

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
  MODIFY `SONum` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prodcode` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000000016;

--
-- AUTO_INCREMENT for table `p_purchasingmanagement`
--
ALTER TABLE `p_purchasingmanagement`
  MODIFY `PONum` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salesmanagement`
--
ALTER TABLE `salesmanagement`
  MODIFY `invoiceNum` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `p_podetails`
--
ALTER TABLE `p_podetails`
  ADD CONSTRAINT `p_podetails_ibfk_2` FOREIGN KEY (`ProductCode`) REFERENCES `products` (`prodcode`);

--
-- Constraints for table `salesmanagement`
--
ALTER TABLE `salesmanagement`
  ADD CONSTRAINT `salesmanagement_ibfk_1` FOREIGN KEY (`SONum`) REFERENCES `ordermanagement` (`SONum`);

--
-- Constraints for table `salesorderdetails`
--
ALTER TABLE `salesorderdetails`
  ADD CONSTRAINT `salesorderdetails_ibfk_2` FOREIGN KEY (`ProdCode`) REFERENCES `products` (`prodcode`);

--
-- Constraints for table `temporaryorders`
--
ALTER TABLE `temporaryorders`
  ADD CONSTRAINT `temporaryorders_ibfk_1` FOREIGN KEY (`ProdCode`) REFERENCES `products` (`prodcode`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `inventoryreport` ON SCHEDULE EVERY 1 DAY STARTS '2010-01-02 17:00:00' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO inventoryreport (category,brand,prodcode, proddesc, size,repoint,prodquan)
    (SELECT category, brand, prodcode, proddesc, size, repoint, prodquan FROM products)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
