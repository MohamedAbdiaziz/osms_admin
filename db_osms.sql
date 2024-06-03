-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 06:29 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_osms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCategory` (IN `p_ID` INT, IN `p_Name` VARCHAR(100) CHARSET ascii, IN `p_Description` VARCHAR(255) CHARSET ascii, IN `p_Status` VARCHAR(15) CHARSET ascii, IN `p_Image` VARCHAR(255) CHARSET ascii)   BEGIN
    DECLARE sqlQuery TEXT;
    DECLARE params TEXT;

    SET sqlQuery = 'UPDATE tblcategory SET ';
    SET params = '';
    
    IF p_Name IS NOT NULL THEN
        SET sqlQuery = CONCAT(sqlQuery, 'Name = ?, ');
        SET params = CONCAT(params, 's', p_Name);
    END IF;

    IF p_Description IS NOT NULL THEN
        SET sqlQuery = CONCAT(sqlQuery, 'Description = ?, ');
        SET params = CONCAT(params, 's', p_Description);
    END IF;

    IF p_Status IS NOT NULL THEN
        SET sqlQuery = CONCAT(sqlQuery, 'Status = ?, ');
        SET params = CONCAT(params, 's', p_Status);
    END IF;

    IF p_Image IS NOT NULL THEN
        SET sqlQuery = CONCAT(sqlQuery, 'Image = ?, ');
        SET params = CONCAT(params, 's', p_Image);
    END IF;
    
    -- Remove trailing comma and space
    SET sqlQuery = LEFT(sqlQuery, LENGTH(sqlQuery) - 2);
    
    SET sqlQuery = CONCAT(sqlQuery, ' WHERE ID = ?');
    
    -- Prepare and execute the statement
    SET @stmt = sqlQuery;
    PREPARE stmt FROM @stmt;
    EXECUTE stmt USING p_Name, p_Description, p_Status, p_Image, p_ID;
    DEALLOCATE PREPARE stmt;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tblcartitem`
--

CREATE TABLE `tblcartitem` (
  `ID` int(11) NOT NULL,
  `Customer` varchar(50) NOT NULL,
  `Product` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `tblcartitem`
--
DELIMITER $$
CREATE TRIGGER `check_cart_quantity` BEFORE INSERT ON `tblcartitem` FOR EACH ROW BEGIN
    DECLARE stock_quantity INT;

    -- Fetch the stock quantity for the product
    SELECT s.Quantity INTO stock_quantity
    FROM tblstock s
    WHERE s.Product = NEW.Product;

    -- Check if the new cart quantity is greater than the stock quantity
    IF NEW.Quantity > stock_quantity THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Error: Cart quantity is greater than available stock quantity';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_cart_quantity_before_update` BEFORE UPDATE ON `tblcartitem` FOR EACH ROW BEGIN
    DECLARE stock_quantity INT;

    -- Fetch the stock quantity for the product
    SELECT s.Quantity INTO stock_quantity
    FROM tblstock s
    WHERE s.Product = NEW.Product;

    -- Check if the new cart quantity is greater than the stock quantity
    IF NEW.Quantity > stock_quantity THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: Cart quantity is greater than available stock quantity';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_duplicate_product_in_cart` BEFORE INSERT ON `tblcartitem` FOR EACH ROW BEGIN
    DECLARE existing_count INT;

    -- Check if the product is already in the cart for the same user
    SELECT COUNT(*) INTO existing_count
    FROM tblcartitem
    WHERE Product = NEW.Product AND Customer = NEW.Customer;

    -- If the count is greater than 0, it means the product is already in the cart
    IF existing_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: Product already in the cart for this customer';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `CreatedDate` date NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `Name`, `Description`, `CreatedDate`, `Status`, `Image`) VALUES
(17, 'Sung', 'hjl', '2024-06-01', 'Active', ''),
(18, 'Null', 'Null', '2024-06-01', 'Deactive', ''),
(20, 'dffudhf99', 'what is the best way ', '2024-06-03', 'Deactive', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `Name` varchar(100) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Email` varchar(225) NOT NULL,
  `Password` varchar(26) NOT NULL,
  `JoinedDate` datetime NOT NULL,
  `Status` varchar(12) NOT NULL,
  `Mobile` bigint(16) NOT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`Name`, `Username`, `Email`, `Password`, `JoinedDate`, `Status`, `Mobile`, `Address`) VALUES
('Mohamed Abdiaziz', 'Mohamed3882', 'mohamedAdiaziz@gmail.com', '1234!@#$', '2024-05-21 09:18:19', 'Active', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `ID` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Category` int(11) NOT NULL,
  `DateCreated` date NOT NULL,
  `UpdatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(20) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Color` varchar(50) NOT NULL,
  `Size` varchar(10) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblstock`
--

CREATE TABLE `tblstock` (
  `ID` int(11) NOT NULL,
  `Product` int(11) NOT NULL,
  `Quantity` int(3) NOT NULL,
  `Status` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Role` varchar(15) NOT NULL,
  `Sex` varchar(10) NOT NULL,
  `BOD` date NOT NULL,
  `Password` varchar(26) NOT NULL,
  `RegisteredDate` datetime NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcartitem`
--
ALTER TABLE `tblcartitem`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Product` (`Product`),
  ADD KEY `Customer` (`Customer`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Mobile` (`Mobile`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Category` (`Category`);

--
-- Indexes for table `tblstock`
--
ALTER TABLE `tblstock`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Product` (`Product`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`,`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcartitem`
--
ALTER TABLE `tblcartitem`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblstock`
--
ALTER TABLE `tblstock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcartitem`
--
ALTER TABLE `tblcartitem`
  ADD CONSTRAINT `tblcartitem_ibfk_2` FOREIGN KEY (`Product`) REFERENCES `tblproduct` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcartitem_ibfk_3` FOREIGN KEY (`Customer`) REFERENCES `tblcustomer` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD CONSTRAINT `tblproduct_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `tblcategory` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblstock`
--
ALTER TABLE `tblstock`
  ADD CONSTRAINT `tblstock_ibfk_1` FOREIGN KEY (`Product`) REFERENCES `tblproduct` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
