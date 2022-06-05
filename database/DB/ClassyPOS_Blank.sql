-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.20-0ubuntu0.16.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for classy_pos
DROP DATABASE IF EXISTS `classy_pos`;
CREATE DATABASE IF NOT EXISTS `classy_pos` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `classy_pos`;

-- Dumping structure for table classy_pos.activity_log
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `ActivityID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `ShopID` int(11) DEFAULT NULL,
  `ActivityName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ActivityID`)
) ENGINE=InnoDB AUTO_INCREMENT=618 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.advance
DROP TABLE IF EXISTS `advance`;
CREATE TABLE IF NOT EXISTS `advance` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) NOT NULL,
  `Name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Amount` decimal(11,4) DEFAULT NULL,
  `Products` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Notes` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeliveryDate` datetime DEFAULT NULL,
  `IsSold` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.bank
DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `BankID` bigint(20) NOT NULL AUTO_INCREMENT,
  `BankName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`BankID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.bank_balance
DROP TABLE IF EXISTS `bank_balance`;
CREATE TABLE IF NOT EXISTS `bank_balance` (
  `BalanceID` bigint(20) NOT NULL AUTO_INCREMENT,
  `BankID` bigint(20) NOT NULL,
  `Balance` decimal(11,4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`BalanceID`),
  UNIQUE KEY `BankID` (`BankID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.bank_ledger
DROP TABLE IF EXISTS `bank_ledger`;
CREATE TABLE IF NOT EXISTS `bank_ledger` (
  `LedgerID` bigint(20) NOT NULL AUTO_INCREMENT,
  `BankID` bigint(20) NOT NULL,
  `ChequeNumber` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RefChequeNumber` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RefBank` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Deposit` decimal(11,4) DEFAULT NULL,
  `Withdraw` decimal(11,4) DEFAULT NULL,
  `Balance` decimal(11,4) DEFAULT NULL,
  `TxBy` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Notes` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`LedgerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.cash_drawer
DROP TABLE IF EXISTS `cash_drawer`;
CREATE TABLE IF NOT EXISTS `cash_drawer` (
  `CashDrawerID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) NOT NULL,
  `FloorID` bigint(20) DEFAULT NULL,
  `TerminalID` bigint(20) DEFAULT NULL,
  `UserID` bigint(20) NOT NULL,
  `OpeningBalance` decimal(11,4) DEFAULT '0.0000',
  `ClosingBalance` decimal(11,4) DEFAULT '0.0000',
  `IsClosed` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`CashDrawerID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) DEFAULT NULL,
  `FirstName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `City` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Province` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ZipCode` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Country` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Inactive` tinyint(4) DEFAULT '0',
  `Notes` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CustomerImg` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`CustomerID`),
  UNIQUE KEY `ShopID_Phone` (`ShopID`,`Phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.customer_balance
DROP TABLE IF EXISTS `customer_balance`;
CREATE TABLE IF NOT EXISTS `customer_balance` (
  `BalanceID` bigint(22) NOT NULL AUTO_INCREMENT,
  `CustomerID` bigint(22) DEFAULT NULL,
  `Balance` decimal(11,4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`BalanceID`),
  UNIQUE KEY `CustomerID` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.customer_invoice_mapping
DROP TABLE IF EXISTS `customer_invoice_mapping`;
CREATE TABLE IF NOT EXISTS `customer_invoice_mapping` (
  `CustomerInvoiceID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CustomerID` bigint(20) DEFAULT NULL,
  `InvoiceID` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`CustomerInvoiceID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.customer_ledger
DROP TABLE IF EXISTS `customer_ledger`;
CREATE TABLE IF NOT EXISTS `customer_ledger` (
  `LedgerID` bigint(22) NOT NULL AUTO_INCREMENT,
  `CustomerID` bigint(22) DEFAULT NULL,
  `InvoiceID` bigint(22) DEFAULT NULL,
  `Debit` decimal(11,4) DEFAULT '0.0000',
  `Credit` decimal(11,4) DEFAULT '0.0000',
  `Balance` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`LedgerID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.customer_payment_transaction
DROP TABLE IF EXISTS `customer_payment_transaction`;
CREATE TABLE IF NOT EXISTS `customer_payment_transaction` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CustomerID` bigint(20) DEFAULT NULL,
  `InvoiceID` bigint(20) DEFAULT NULL,
  `ShopID` bigint(20) DEFAULT NULL,
  `MethodID` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `TransactionAmount` decimal(11,4) DEFAULT NULL,
  `CardNumber` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CardHolderName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.expense
DROP TABLE IF EXISTS `expense`;
CREATE TABLE IF NOT EXISTS `expense` (
  `ExpenseID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CategoryID` bigint(20) NOT NULL,
  `ShopID` bigint(20) NOT NULL,
  `FloorID` bigint(20) DEFAULT NULL,
  `TerminalID` bigint(20) DEFAULT NULL,
  `Amount` decimal(11,4) NOT NULL,
  `ExpenseBy` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Notes` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ExpenseID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.expense_category
DROP TABLE IF EXISTS `expense_category`;
CREATE TABLE IF NOT EXISTS `expense_category` (
  `CategoryID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.floor
DROP TABLE IF EXISTS `floor`;
CREATE TABLE IF NOT EXISTS `floor` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.income
DROP TABLE IF EXISTS `income`;
CREATE TABLE IF NOT EXISTS `income` (
  `IncomeID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CategoryID` bigint(20) NOT NULL,
  `ShopID` bigint(20) DEFAULT NULL,
  `AccountName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Amount` decimal(11,4) DEFAULT NULL,
  `Notes` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`IncomeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.income_category
DROP TABLE IF EXISTS `income_category`;
CREATE TABLE IF NOT EXISTS `income_category` (
  `CategoryID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.inventory
DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` varchar(50) DEFAULT NULL,
  `ProductID` varchar(50) DEFAULT NULL,
  `SoftQty` decimal(11,4) DEFAULT NULL,
  `HardQty` decimal(11,4) DEFAULT NULL,
  `Remark` decimal(11,4) DEFAULT NULL,
  `UserID` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.invoice
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `InvoiceID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) NOT NULL,
  `FloorID` bigint(20) DEFAULT NULL,
  `TerminalID` bigint(20) DEFAULT NULL,
  `UserID` bigint(20) NOT NULL,
  `OrderID` bigint(20) DEFAULT NULL,
  `AdvanceID` bigint(20) DEFAULT NULL,
  `SubTotal` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `TaxTotal` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `ServiceCharge` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `Discount` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `Total` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `PaidMoney` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `ReturnedMoney` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `IsVoid` tinyint(1) DEFAULT '0',
  `IsRefunded` tinyint(1) DEFAULT '0',
  `IsPaid` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`InvoiceID`)
) ENGINE=InnoDB AUTO_INCREMENT=610 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.invoice_product_mapping
DROP TABLE IF EXISTS `invoice_product_mapping`;
CREATE TABLE IF NOT EXISTS `invoice_product_mapping` (
  `InvoiceProductID` bigint(20) NOT NULL AUTO_INCREMENT,
  `UserID` bigint(20) NOT NULL,
  `ShopID` bigint(20) NOT NULL,
  `InvoiceID` bigint(20) NOT NULL,
  `ProductID` bigint(20) NOT NULL,
  `ProductName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Qty` decimal(11,4) DEFAULT '0.0000',
  `CostPrice` decimal(10,4) DEFAULT NULL,
  `Price` decimal(11,4) DEFAULT '0.0000',
  `TaxTotal` decimal(11,4) DEFAULT '0.0000',
  `Discount` decimal(11,4) DEFAULT '0.0000',
  `TotalPrice` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`InvoiceProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=5597 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.invoice_product_refund_mapping
DROP TABLE IF EXISTS `invoice_product_refund_mapping`;
CREATE TABLE IF NOT EXISTS `invoice_product_refund_mapping` (
  `InvoiceProductRefundID` bigint(20) NOT NULL AUTO_INCREMENT,
  `UserID` bigint(20) NOT NULL,
  `ShopID` bigint(20) NOT NULL,
  `InvoiceID` bigint(20) NOT NULL,
  `ProductID` bigint(20) NOT NULL,
  `ProductName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Qty` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `Price` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `TotalPrice` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `Discount` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `TaxTotal` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `RefundReason` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`InvoiceProductRefundID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.invoice_settings
DROP TABLE IF EXISTS `invoice_settings`;
CREATE TABLE IF NOT EXISTS `invoice_settings` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) NOT NULL,
  `FloorID` bigint(20) DEFAULT NULL,
  `TerminalID` bigint(20) DEFAULT NULL,
  `Header` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Footer` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Size` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.kitchen
DROP TABLE IF EXISTS `kitchen`;
CREATE TABLE IF NOT EXISTS `kitchen` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) DEFAULT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsOpen` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.kitchen_category_mapping
DROP TABLE IF EXISTS `kitchen_category_mapping`;
CREATE TABLE IF NOT EXISTS `kitchen_category_mapping` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `KitchenID` bigint(20) DEFAULT NULL,
  `CategoryID` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.language_lines
DROP TABLE IF EXISTS `language_lines`;
CREATE TABLE IF NOT EXISTS `language_lines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language_lines_group_index` (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.notice
DROP TABLE IF EXISTS `notice`;
CREATE TABLE IF NOT EXISTS `notice` (
  `NoticeID` bigint(20) NOT NULL AUTO_INCREMENT,
  `FromUserID` bigint(20) DEFAULT NULL,
  `ToUserID` bigint(20) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `ShowDate` datetime DEFAULT NULL,
  `Message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `MessageTitle` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsDismissed` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`NoticeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.on_screen_button
DROP TABLE IF EXISTS `on_screen_button`;
CREATE TABLE IF NOT EXISTS `on_screen_button` (
  `ButtonID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) NOT NULL,
  `ProductID` bigint(20) NOT NULL,
  `DisplayText` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ButtonID`),
  UNIQUE KEY `ShopID_ProductID` (`ShopID`,`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) DEFAULT NULL,
  `UserID` bigint(20) DEFAULT NULL,
  `TableID` bigint(20) DEFAULT NULL,
  `StaffID` bigint(20) DEFAULT NULL,
  `CustomerID` bigint(20) DEFAULT NULL,
  `Guests` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Notes` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsReady` tinyint(1) DEFAULT '0',
  `IsDelivered` tinyint(1) DEFAULT '0',
  `IsInvoiced` tinyint(1) DEFAULT '0',
  `IsComplete` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.package_product_mapping
DROP TABLE IF EXISTS `package_product_mapping`;
CREATE TABLE IF NOT EXISTS `package_product_mapping` (
  `MappingID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ProductID` bigint(20) DEFAULT NULL,
  `Qty` decimal(11,4) DEFAULT '0.0000',
  `Price` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT NULL,
  `updated__at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`MappingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.payment_method
DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE IF NOT EXISTS `payment_method` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `MethodName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CategoryID` bigint(20) NOT NULL,
  `VendorID` bigint(20) NOT NULL,
  `BrandID` bigint(20) DEFAULT NULL,
  `ProductName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ProductDescription` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ProductImg` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Qty` decimal(11,4) DEFAULT '0.0000',
  `MinQtyLevel` decimal(11,4) DEFAULT '0.0000',
  `CostPrice` decimal(11,4) DEFAULT '0.0000',
  `SalePrice` decimal(11,4) DEFAULT '0.0000',
  `PreferredPrice` decimal(11,4) DEFAULT '0.0000',
  `Unit` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `TaxCode` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `InactiveProduct` tinyint(1) DEFAULT '0',
  `IsPurchased` tinyint(1) DEFAULT '0',
  `AllowNegative` tinyint(1) DEFAULT '1',
  `AllowReturn` tinyint(1) NOT NULL DEFAULT '1',
  `HasAttribute` tinyint(1) DEFAULT NULL,
  `Tags` varchar(500) DEFAULT '',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.product_brand
DROP TABLE IF EXISTS `product_brand`;
CREATE TABLE IF NOT EXISTS `product_brand` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Manufacturer` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.product_category
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `CategoryID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(250) DEFAULT NULL,
  `Image` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.product_category_shop_mapping
DROP TABLE IF EXISTS `product_category_shop_mapping`;
CREATE TABLE IF NOT EXISTS `product_category_shop_mapping` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) DEFAULT NULL,
  `CategoryID` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.product_package
DROP TABLE IF EXISTS `product_package`;
CREATE TABLE IF NOT EXISTS `product_package` (
  `PackageID` bigint(20) NOT NULL AUTO_INCREMENT,
  `PackageName` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Price` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`PackageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.purchase_invoice
DROP TABLE IF EXISTS `purchase_invoice`;
CREATE TABLE IF NOT EXISTS `purchase_invoice` (
  `PurchaseInvoiceID` bigint(20) NOT NULL AUTO_INCREMENT,
  `VendorID` bigint(20) NOT NULL,
  `MemoID` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `TotalPrice` decimal(11,4) DEFAULT '0.0000',
  `CashPayment` decimal(11,4) DEFAULT '0.0000',
  `BankPayment` decimal(11,4) DEFAULT '0.0000',
  `Due` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`PurchaseInvoiceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.purchase_invoice_product_mapping
DROP TABLE IF EXISTS `purchase_invoice_product_mapping`;
CREATE TABLE IF NOT EXISTS `purchase_invoice_product_mapping` (
  `PurchaseID` bigint(20) NOT NULL AUTO_INCREMENT,
  `PurchaseInvoiceID` bigint(20) NOT NULL,
  `ProductID` bigint(20) NOT NULL,
  `Qty` decimal(11,4) DEFAULT '0.0000',
  `CostPrice` decimal(11,4) DEFAULT '0.0000',
  `TotalPrice` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`PurchaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.purchase_invoice_product_return_mapping
DROP TABLE IF EXISTS `purchase_invoice_product_return_mapping`;
CREATE TABLE IF NOT EXISTS `purchase_invoice_product_return_mapping` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `UserID` bigint(20) DEFAULT NULL,
  `ShopID` bigint(20) DEFAULT NULL,
  `InvoiceID` bigint(20) DEFAULT NULL,
  `ProductID` bigint(20) DEFAULT NULL,
  `Qty` decimal(11,4) DEFAULT '0.0000',
  `Price` decimal(11,4) DEFAULT '0.0000',
  `TotalPrice` decimal(11,4) DEFAULT '0.0000',
  `ReturnReason` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.sale_hold
DROP TABLE IF EXISTS `sale_hold`;
CREATE TABLE IF NOT EXISTS `sale_hold` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) NOT NULL,
  `CounterID` bigint(20) DEFAULT NULL,
  `Products` text COLLATE utf8_unicode_ci,
  `Notes` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsComplete` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) DEFAULT NULL,
  `IsRestaurant` tinyint(1) DEFAULT NULL,
  `IsServiceCharge` tinyint(1) DEFAULT NULL,
  `ServiceCharge` int(11) DEFAULT NULL,
  `IsTips` tinyint(1) DEFAULT NULL,
  `IsTax` tinyint(1) DEFAULT NULL,
  `IsOrder` tinyint(1) DEFAULT NULL,
  `IsHold` tinyint(1) DEFAULT NULL,
  `IsAdvance` tinyint(1) DEFAULT NULL,
  `IsBarcode` tinyint(1) DEFAULT NULL,
  `IsRefund` tinyint(1) DEFAULT NULL,
  `IsDiscount` tinyint(1) DEFAULT NULL,
  `InvoiceSize` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CurrencyName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CurrencySymbol` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.shop
DROP TABLE IF EXISTS `shop`;
CREATE TABLE IF NOT EXISTS `shop` (
  `ShopID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopName` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ShopAddress` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `City` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Province` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Website` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ShopLogo` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `VatRegNo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ShopID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.shop_product_mapping
DROP TABLE IF EXISTS `shop_product_mapping`;
CREATE TABLE IF NOT EXISTS `shop_product_mapping` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) NOT NULL,
  `ProductID` bigint(20) NOT NULL,
  `Qty` decimal(10,2) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.suborder
DROP TABLE IF EXISTS `suborder`;
CREATE TABLE IF NOT EXISTS `suborder` (
  `SubOrderID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) DEFAULT NULL,
  `OrderID` bigint(20) DEFAULT NULL,
  `KitchenID` bigint(20) DEFAULT NULL,
  `IsConfirmed` tinyint(1) DEFAULT '0',
  `IsComplete` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`SubOrderID`)
) ENGINE=InnoDB AUTO_INCREMENT=524 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.suborder_product_mapping
DROP TABLE IF EXISTS `suborder_product_mapping`;
CREATE TABLE IF NOT EXISTS `suborder_product_mapping` (
  `SubOrderProductID` bigint(20) NOT NULL AUTO_INCREMENT,
  `SubOrderID` bigint(20) DEFAULT NULL,
  `ProductID` bigint(20) DEFAULT NULL,
  `ShopID` bigint(20) DEFAULT NULL,
  `Qty` decimal(11,4) DEFAULT NULL,
  `IsCanceled` tinyint(1) DEFAULT NULL,
  `Notes` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`SubOrderProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=2650 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.tables
DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) DEFAULT NULL,
  `FloorID` bigint(20) DEFAULT NULL,
  `OrderID` bigint(20) NOT NULL,
  `InvoiceID` bigint(20) NOT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Capacity` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsBooked` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.tax_code
DROP TABLE IF EXISTS `tax_code`;
CREATE TABLE IF NOT EXISTS `tax_code` (
  `TaxCodeID` bigint(20) NOT NULL AUTO_INCREMENT,
  `TaxCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `TaxPercent` decimal(11,4) DEFAULT '0.0000',
  `Inactive` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`TaxCodeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.terminal
DROP TABLE IF EXISTS `terminal`;
CREATE TABLE IF NOT EXISTS `terminal` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) DEFAULT NULL,
  `FloorID` bigint(20) DEFAULT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsOpen` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` bigint(20) NOT NULL,
  `ShopID` bigint(20) DEFAULT NULL,
  `KitchenID` bigint(20) DEFAULT '0',
  `Phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `City` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Province` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ZipCode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Country` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `UserImg` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.user_role
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `UserRoleCategoryID` bigint(22) NOT NULL AUTO_INCREMENT,
  `RoleCategoryID` bigint(22) DEFAULT NULL,
  `UserID` bigint(22) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`UserRoleCategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.user_role_category
DROP TABLE IF EXISTS `user_role_category`;
CREATE TABLE IF NOT EXISTS `user_role_category` (
  `RoleCategoryID` bigint(22) NOT NULL AUTO_INCREMENT,
  `RoleCategoryName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RoleRouteName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`RoleCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.vendor
DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `VendorID` bigint(20) NOT NULL AUTO_INCREMENT,
  `VendorName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ContactName` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `City` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Province` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ZipCode` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Country` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone1` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone2` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fax` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Website` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `VendorImg` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `InactiveVendor` bit(1) DEFAULT b'0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`VendorID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.vendor_balance
DROP TABLE IF EXISTS `vendor_balance`;
CREATE TABLE IF NOT EXISTS `vendor_balance` (
  `BalanceID` bigint(20) NOT NULL AUTO_INCREMENT,
  `VendorID` bigint(20) NOT NULL,
  `Balance` decimal(11,4) NOT NULL DEFAULT '0.0000',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`BalanceID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.vendor_ledger
DROP TABLE IF EXISTS `vendor_ledger`;
CREATE TABLE IF NOT EXISTS `vendor_ledger` (
  `LedgerID` bigint(22) NOT NULL AUTO_INCREMENT,
  `VendorID` bigint(22) DEFAULT NULL,
  `InvoiceID` bigint(22) DEFAULT NULL,
  `Debit` decimal(11,4) DEFAULT '0.0000',
  `Credit` decimal(11,4) DEFAULT '0.0000',
  `Balance` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`LedgerID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table classy_pos.waste
DROP TABLE IF EXISTS `waste`;
CREATE TABLE IF NOT EXISTS `waste` (
  `WasteID` bigint(20) NOT NULL AUTO_INCREMENT,
  `ShopID` bigint(20) DEFAULT NULL,
  `ProductID` bigint(20) DEFAULT NULL,
  `Qty` decimal(11,4) DEFAULT NULL,
  `UnitCost` decimal(11,4) DEFAULT NULL,
  `TotalPrice` decimal(11,4) DEFAULT NULL,
  `WastedBy` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`WasteID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
