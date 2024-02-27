-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.27 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for um
CREATE DATABASE IF NOT EXISTS `um` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `um`;

-- Dumping structure for table um.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `email`, `password`) VALUES
	(2, 'admin@gmail.com', '12345678');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table um.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.brand: ~4 rows (approximately)
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` (`id`, `name`) VALUES
	(2, 'Apple'),
	(3, 'Samsung'),
	(4, 'Asus'),
	(5, 'mi');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;

-- Dumping structure for table um.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `qty` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.cart: ~1 rows (approximately)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` (`id`, `product_id`, `user_email`, `qty`) VALUES
	(172, 20, 'anuradha.studeo@gmail.com', 1);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table um.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.category: ~3 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Mobile Phone'),
	(8, 'Laptop'),
	(9, 'Accessories'),
	(10, 'Camera');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table um.color
CREATE TABLE IF NOT EXISTS `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.color: ~7 rows (approximately)
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` (`id`, `name`) VALUES
	(1, 'Black'),
	(2, 'Red'),
	(3, 'Blue'),
	(4, 'White'),
	(5, 'Green'),
	(6, 'Purple'),
	(7, 'Orange');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;

-- Dumping structure for table um.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.condition: ~2 rows (approximately)
/*!40000 ALTER TABLE `condition` DISABLE KEYS */;
INSERT INTO `condition` (`id`, `name`) VALUES
	(1, 'Brand new'),
	(2, 'Used');
/*!40000 ALTER TABLE `condition` ENABLE KEYS */;

-- Dumping structure for table um.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table um.customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table um.distric
CREATE TABLE IF NOT EXISTS `distric` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_distric_province_idx` (`province_id`),
  CONSTRAINT `fk_distric_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.distric: ~2 rows (approximately)
/*!40000 ALTER TABLE `distric` DISABLE KEYS */;
INSERT INTO `distric` (`id`, `name`, `province_id`) VALUES
	(1, 'Kurunegala', 1),
	(2, 'Colombo', 2);
/*!40000 ALTER TABLE `distric` ENABLE KEYS */;

-- Dumping structure for table um.image
CREATE TABLE IF NOT EXISTS `image` (
  `code` varchar(50) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`code`),
  KEY `fk_image_product1_idx` (`product_id`),
  CONSTRAINT `fk_image_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.image: ~12 rows (approximately)
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` (`code`, `product_id`) VALUES
	('product_img/6312464c1dcad.png', 1),
	('product_img/6312464c3ff3f.png', 1),
	('product_img/631246ae64588.png', 2),
	('product_img/631247032f24f.png', 3),
	('product_img/6312470352752.png', 3),
	('product_img/63124dae219d9.png', 4),
	('product_img/63124dae4b17d.png', 4),
	('product_img/63124e45a3c4f.png', 5),
	('product_img/63124e45b9a07.png', 5),
	('product_img/65aeaf44ed0de.jpeg', 19),
	('product_img/65aeaf44f1373.jpeg', 19),
	('product_img/65aecdc893f3e.png', 20);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;

-- Dumping structure for table um.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `total` double DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_has_address_id` int NOT NULL,
  `shipping_address_id` int DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  KEY `fk_invoice_shipping_address1_idx` (`shipping_address_id`),
  KEY `fk_user_has address_idx` (`user_has_address_id`),
  KEY `fk_address_idx` (`id`),
  KEY `fk_invoice_user_has_address1_idx` (`user_has_address_id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_invoice_user_has_address1` FOREIGN KEY (`user_has_address_id`) REFERENCES `user_has_address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.invoice: ~59 rows (approximately)
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` (`id`, `user_email`, `total`, `date`, `user_has_address_id`, `shipping_address_id`, `status`, `note`) VALUES
	(36, 'anuradha.studeo@gmail.com', 45000, '2023-05-20 15:36:57', 18, NULL, 'completed', NULL),
	(37, 'anuradha.studeo@gmail.com', 195000, '2023-10-20 15:44:15', 18, NULL, 'completed', NULL),
	(38, 'nipun@gmail.com', 3500, '2023-10-20 16:37:20', 19, NULL, 'refund', NULL),
	(39, 'nipun@gmail.com', 60000, '2023-10-20 18:49:59', 19, NULL, 'completed', NULL),
	(40, 'nipun@gmail.com', 158500, '2023-08-20 22:20:51', 19, NULL, 'Pendding', NULL),
	(41, 'nipun@gmail.com', 10000, '2023-10-20 22:22:46', 19, NULL, 'Pendding', NULL),
	(42, 'nipun@gmail.com', 7000, '2023-10-24 01:04:20', 20, NULL, 'completed', NULL),
	(43, 'nipun@gmail.com', 45000, '2023-10-24 01:20:21', 20, NULL, 'cancle', NULL),
	(48, 'anuradha.studeo@gmail.com', 3900, '2024-01-09 22:14:31', 24, NULL, 'Pendding', NULL),
	(62, 'anuradha.studeo@gmail.com', 3900, '2024-01-09 23:18:49', 30, NULL, 'Pendding', NULL),
	(81, 'anuradha.studeo@gmail.com', 3500, '2024-01-09 23:35:32', 32, NULL, 'Pendding', NULL),
	(83, 'anuradha.studeo@gmail.com', 3900, '2024-01-10 12:38:21', 34, NULL, 'Pendding', NULL),
	(84, 'anuradha.studeo@gmail.com', 3900, '2024-01-10 12:48:45', 35, NULL, 'Pendding', NULL),
	(85, 'anuradha.studeo@gmail.com', 3900, '2024-01-10 12:59:19', 36, NULL, 'Pendding', NULL),
	(86, 'anuradha.studeo@gmail.com', 0, '2024-01-10 13:39:38', 36, NULL, 'Pendding', NULL),
	(87, 'anuradha.studeo@gmail.com', 0, '2024-01-10 13:39:38', 36, NULL, 'Pendding', NULL),
	(88, 'anuradha.studeo@gmail.com', 3900, '2024-01-10 13:55:58', 37, NULL, 'Pendding', NULL),
	(90, 'anuradha.studeo@gmail.com', 0, '2024-01-10 13:57:48', 38, NULL, 'Pendding', NULL),
	(94, 'anuradha.studeo@gmail.com', 3900, '2024-01-10 14:03:50', 40, NULL, 'Pendding', NULL),
	(95, 'anuradha.studeo@gmail.com', 3900, '2024-01-10 14:06:25', 41, NULL, 'Pendding', NULL),
	(96, 'anuradha.studeo@gmail.com', 3900, '2024-01-10 14:33:15', 42, NULL, 'Pendding', NULL),
	(97, 'anuradha.studeo@gmail.com', 3900, '2024-01-10 14:44:06', 43, NULL, 'Pendding', NULL),
	(98, 'anuradha.studeo@gmail.com', 3500, '2024-01-10 14:48:42', 44, NULL, 'Pendding', NULL),
	(99, 'anuradha.studeo@gmail.com', 3900, '2024-01-10 16:11:07', 45, NULL, 'NotPay', NULL),
	(100, 'anuradha.studeo@gmail.com', 0, '2024-01-10 16:11:23', 45, NULL, 'NotPay', NULL),
	(101, 'anuradha.studeo@gmail.com', 0, '2024-01-10 16:11:24', 45, NULL, 'NotPay', NULL),
	(102, 'anuradha.studeo@gmail.com', 3500, '2024-01-18 00:00:00', 46, NULL, 'Pendding', NULL),
	(103, 'anuradha.studeo@gmail.com', 3500, '2024-01-10 16:22:28', 47, NULL, 'Pendding', NULL),
	(104, 'anuradha.studeo@gmail.com', 3900, '2024-01-10 16:25:32', 48, NULL, 'Pendding', NULL),
	(105, 'anuradha.studeo@gmail.com', 3500, '2024-01-10 16:27:29', 49, NULL, 'Pendding', NULL),
	(106, 'anuradha.studeo@gmail.com', 15000, '2024-01-10 19:39:28', 50, NULL, 'NotPay', 'drgdfrg'),
	(109, 'anuradha.studeo@gmail.com', 7000, '2024-01-16 22:11:49', 53, NULL, 'Pendding', ''),
	(110, 'anuradha.studeo@gmail.com', 7800, '2024-01-16 22:15:30', 54, NULL, 'Pendding', ''),
	(111, 'anuradha.studeo@gmail.com', 7800, '2024-01-16 22:21:42', 55, NULL, 'Pendding', ''),
	(112, 'anuradha.studeo@gmail.com', 3900, '2024-01-16 22:24:57', 56, NULL, 'Pendding', ''),
	(113, 'anuradha.studeo@gmail.com', 0, '2024-01-16 22:27:20', 56, NULL, 'NotPay', ''),
	(114, 'anuradha.studeo@gmail.com', 3900, '2024-01-16 22:27:45', 57, NULL, 'Pendding', ''),
	(115, 'anuradha.studeo@gmail.com', 7800, '2024-01-16 22:31:41', 58, NULL, 'Pendding', ''),
	(116, 'anuradha.studeo@gmail.com', 7800, '2024-01-16 22:37:13', 59, NULL, 'Pendding', ''),
	(117, 'anuradha.studeo@gmail.com', 7800, '2024-01-16 22:47:43', 60, NULL, 'Pendding', ''),
	(118, 'anuradha.studeo@gmail.com', 7800, '2024-01-16 22:48:47', 61, NULL, 'Pendding', ''),
	(119, 'anuradha.studeo@gmail.com', 7800, '2024-01-16 22:54:10', 62, NULL, 'Pendding', ''),
	(120, 'anuradha.studeo@gmail.com', 3900, '2024-01-16 22:55:56', 63, NULL, 'Pendding', ''),
	(121, 'anuradha.studeo@gmail.com', 3900, '2024-01-16 23:05:31', 64, NULL, 'Pendding', ''),
	(123, 'anuradha.studeo@gmail.com', 3900, '2024-01-16 23:16:40', 66, NULL, 'Pendding', ''),
	(125, 'anuradha.studeo@gmail.com', 3900, '2024-01-17 00:11:27', 68, NULL, 'Pendding', ''),
	(126, 'anuradha.studeo@gmail.com', 3900, '2024-01-17 00:14:23', 69, NULL, 'Pendding', ''),
	(127, 'anuradha.studeo@gmail.com', 3900, '2024-01-17 00:17:09', 70, NULL, 'Pendding', ''),
	(129, 'anuradha.studeo@gmail.com', 0, '2024-01-17 00:18:51', 71, NULL, 'NotPay', ''),
	(130, 'anuradha.studeo@gmail.com', 3900, '2024-01-17 00:19:19', 72, NULL, 'Pendding', ''),
	(131, 'anuradha.studeo@gmail.com', 285000, '2024-01-19 01:13:08', 73, NULL, 'NotPay', ''),
	(132, 'anuradha.studeo@gmail.com', 95000, '2024-01-19 01:15:56', 74, NULL, 'NotPay', ''),
	(133, 'anuradha.studeo@gmail.com', 3900, '2024-01-19 01:48:31', 75, NULL, 'NotPay', '');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;

-- Dumping structure for table um.invoice_item
CREATE TABLE IF NOT EXISTS `invoice_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `invoice_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_invoice_item_idx` (`product_id`),
  KEY `fk_invoice_invoiceitem_idx` (`invoice_id`),
  CONSTRAINT `fk_invoice_invoiceitem` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  CONSTRAINT `fk_product_invoice_item` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.invoice_item: ~50 rows (approximately)
/*!40000 ALTER TABLE `invoice_item` DISABLE KEYS */;
INSERT INTO `invoice_item` (`id`, `product_id`, `qty`, `invoice_id`) VALUES
	(34, 2, 1, 36),
	(35, 5, 1, 37),
	(36, 3, 2, 37),
	(37, 4, 1, 38),
	(38, 1, 1, 39),
	(39, 3, 1, 40),
	(40, 1, 1, 40),
	(41, 4, 1, 40),
	(42, 5, 2, 41),
	(43, 4, 2, 42),
	(44, 2, 1, 43),
	(48, 19, 1, 48),
	(54, 19, 1, 62),
	(56, 4, 1, 81),
	(58, 19, 1, 83),
	(59, 19, 1, 84),
	(60, 19, 1, 85),
	(61, 19, 1, 88),
	(64, 19, 1, 94),
	(65, 19, 1, 95),
	(66, 19, 1, 96),
	(67, 19, 1, 97),
	(68, 4, 1, 98),
	(69, 19, 1, 99),
	(70, 4, 1, 102),
	(71, 4, 1, 103),
	(72, 19, 1, 104),
	(73, 4, 1, 105),
	(74, 5, 3, 106),
	(77, 4, 2, 109),
	(78, 19, 2, 110),
	(79, 19, 2, 111),
	(80, 19, 1, 112),
	(81, 19, 1, 114),
	(82, 19, 2, 115),
	(83, 19, 2, 116),
	(84, 19, 2, 117),
	(85, 19, 2, 118),
	(86, 19, 2, 119),
	(87, 19, 1, 120),
	(88, 19, 1, 121),
	(90, 19, 1, 123),
	(92, 19, 1, 125),
	(93, 19, 1, 126),
	(94, 19, 1, 127),
	(96, 19, 1, 130),
	(97, 3, 3, 131),
	(98, 3, 1, 132),
	(99, 19, 1, 133);
/*!40000 ALTER TABLE `invoice_item` ENABLE KEYS */;

-- Dumping structure for table um.invoice_product
CREATE TABLE IF NOT EXISTS `invoice_product` (
  `invoice_id` int NOT NULL,
  `product_id` int NOT NULL,
  KEY `FK806bu27uepq9jw1gksvegoqkd` (`product_id`),
  KEY `FKhrqne4uostar9vds76ynsosov` (`invoice_id`),
  CONSTRAINT `FK806bu27uepq9jw1gksvegoqkd` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FKhrqne4uostar9vds76ynsosov` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table um.invoice_product: ~0 rows (approximately)
/*!40000 ALTER TABLE `invoice_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_product` ENABLE KEYS */;

-- Dumping structure for table um.model
CREATE TABLE IF NOT EXISTS `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.model: ~5 rows (approximately)
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` (`id`, `name`) VALUES
	(2, 'iPhone X'),
	(5, '12 pro max'),
	(6, 'S6 Edge'),
	(7, 'Notebook'),
	(8, 'CP-520'),
	(9, 'R190'),
	(10, 'M50 plus');
/*!40000 ALTER TABLE `model` ENABLE KEYS */;

-- Dumping structure for table um.model_has_brand
CREATE TABLE IF NOT EXISTS `model_has_brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_id` int NOT NULL,
  `model_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_model_has_brand_brand1_idx` (`brand_id`),
  KEY `fk_model_has_brand_model1_idx` (`model_id`),
  CONSTRAINT `fk_model_has_brand_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `fk_model_has_brand_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.model_has_brand: ~12 rows (approximately)
/*!40000 ALTER TABLE `model_has_brand` DISABLE KEYS */;
INSERT INTO `model_has_brand` (`id`, `brand_id`, `model_id`) VALUES
	(4, 2, 5),
	(5, 3, 6),
	(6, 3, 5),
	(7, 2, 2),
	(8, 3, 2),
	(9, 2, 6),
	(10, 4, 7),
	(11, 5, 8),
	(12, 3, 8),
	(13, 4, 6),
	(14, 4, 5),
	(15, 5, 2),
	(16, 5, 9),
	(17, 5, 10);
/*!40000 ALTER TABLE `model_has_brand` ENABLE KEYS */;

-- Dumping structure for table um.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `oldPrice` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `description` text,
  `category_id` int NOT NULL,
  `condition_id` int NOT NULL,
  `model_has_brand_id` int NOT NULL,
  `status_id` int NOT NULL,
  `color_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_id`),
  KEY `fk_product_condition1_idx` (`condition_id`),
  KEY `fk_product_model_has_brand1_idx` (`model_has_brand_id`),
  KEY `fk_product_status1_idx` (`status_id`),
  KEY `fk_product_color_idx` (`color_id`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_product_color` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `fk_product_model_has_brand1` FOREIGN KEY (`model_has_brand_id`) REFERENCES `model_has_brand` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.product: ~7 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `title`, `oldPrice`, `price`, `qty`, `description`, `category_id`, `condition_id`, `model_has_brand_id`, `status_id`, `color_id`) VALUES
	(1, 'Asus notebook i3', NULL, 60000, 3, 'Asus Brand New\r\nCore i3 2.0Gz\r\n4GB RAM\r\n500GB Hdd', 8, 1, 10, 1, 1),
	(2, 'Samsung S6 edge', NULL, 45000, 1, 'Brand new condition\r\n4GB RAM\r\n64GB memory\r\nGold color', 1, 2, 5, 1, NULL),
	(3, 'Asus core i5 laptop', NULL, 95000, 0, 'Core i5 3.2Gz\r\n8GB RAM\r\n1Tb HDD', 8, 1, 10, 1, NULL),
	(4, 'Wired Headset', NULL, 3500, 5, '-', 9, 1, 11, 1, NULL),
	(5, 'Digital Camera', 6500, 5000, 10, '12Mega px\r\nDigital Zoom\r\n', 9, 1, 12, 1, NULL),
	(19, 'Bluetooth Earbud R190', 4500, 3800, 10, '<p><strong>Brand new</strong></p>\r\n\r\n<p>bluetooth 5.0v</p>\r\n\r\n<hr />\r\n<p><strong><span style="color:#2ecc71">test description. ..</span></strong></p>\r\n', 9, 1, 16, 1, 1),
	(20, 'Smartphone Mi M50 plus', NULL, 75000, 1, '<p><strong>Mi M50 plus</strong></p>\r\n\r\n<p><span style="color:#16a085">specs</span>:</p>\r\n\r\n<ul>\r\n	<li>storage 128GB</li>\r\n	<li>RAM 8GB</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n', 1, 2, 17, 1, 3);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table um.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.province: ~2 rows (approximately)
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` (`id`, `name`) VALUES
	(1, 'western province'),
	(2, 'North');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;

-- Dumping structure for table um.shipping_address
CREATE TABLE IF NOT EXISTS `shipping_address` (
  `id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `line1` text,
  `line2` text,
  `telephone` varchar(10) DEFAULT NULL,
  `city` text,
  `postal_code` varchar(10) DEFAULT NULL,
  `distric_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shipping_address_user1_idx` (`user_email`),
  KEY `fk_shipping_address_distric1_idx` (`distric_id`),
  CONSTRAINT `fk_shipping_address_distric1` FOREIGN KEY (`distric_id`) REFERENCES `distric` (`id`),
  CONSTRAINT `fk_shipping_address_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.shipping_address: ~0 rows (approximately)
/*!40000 ALTER TABLE `shipping_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipping_address` ENABLE KEYS */;

-- Dumping structure for table um.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.status: ~2 rows (approximately)
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `name`) VALUES
	(1, 'Active'),
	(2, 'Inactive');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table um.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `mobile` varchar(10) DEFAULT NULL,
  `joined_date` datetime DEFAULT NULL,
  `varification_code` varchar(20) DEFAULT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_status1_idx` (`status_id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `varification_code`, `status_id`) VALUES
	('Nipun', 'Anuradha', 'anuradha.studeo@gmail.com', '$2y$10$MOrGxF3dotzPBdXTI6zi3OWR9S/fnpD3B8C9P7cxJbcg2rvUvCiDm', '0771234567', '2022-08-27 18:21:39', '65a69b365fa3e', 1),
	('ka', 'vi', 'kavi@gmail.com', '$2y$10$.pdA57Do7uRRZ2uMOx.45uTfYmrR/GyoZEszinHVUkr7/4RkyxCr2', NULL, '2024-01-07 14:07:32', NULL, 1),
	('kavishka', 'nipun', 'nipun@gmail.com', '$2y$10$.pdA57Do7uRRZ2uMOx.45uTfYmrR/GyoZEszinHVUkr7/4RkyxCr2', NULL, '2023-10-20 16:26:53', NULL, 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table um.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `line1` text,
  `line2` text,
  `city` text NOT NULL,
  `contact_no` varchar(10) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `distric_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_idx` (`user_email`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.user_has_address: ~53 rows (approximately)
/*!40000 ALTER TABLE `user_has_address` DISABLE KEYS */;
INSERT INTO `user_has_address` (`id`, `user_email`, `fname`, `lname`, `line1`, `line2`, `city`, `contact_no`, `postal_code`, `distric_id`) VALUES
	(18, 'anuradha.studeo@gmail.com', 'Nipun', 'Anuradha', 'Kuliyapitiya', 'No 152', 'Kuliyapitiya', '0778898500', '55890', 2),
	(19, 'nipun@gmail.com', 'wer', 'werwerwerwe', 'wwerwe', 'werrvgrg', 'rerg', '0778899888', '23423', 2),
	(20, 'nipun@gmail.com', 'Ka', 'Nipun', 'address 1', 'address 2', 'city', '0778899879', '20000', 1),
	(21, 'anuradha.studeo@gmail.com', 'vcbvb', 'cvb', 'hjk', 'cvb', 'ghj', '0770087558', '40', 2),
	(22, 'anuradha.studeo@gmail.com', 'sd', 'sdf', 'sdf', 'sdf', 'sdf', '0777777777', 'sdf', 1),
	(23, 'anuradha.studeo@gmail.com', 'h', 'jkhjk', 'hj', 'khjk', 'hjk', '0778855555', 'hjk', 1),
	(24, 'anuradha.studeo@gmail.com', 'awd', 'awd', 'awd', 'awd', 'awd', '0778899992', 'awd', 2),
	(25, 'anuradha.studeo@gmail.com', 'sdf', 'dsf', 'sdf', 'sdf', 'sdf', '0714444444', 'sdf', 2),
	(26, 'anuradha.studeo@gmail.com', 'fg', 'fg', 'fg', 'fg', 'fg', '0778855222', 'fg', 1),
	(27, 'anuradha.studeo@gmail.com', 'cvb', 'cvb', 'cvb', 'cvb', 'cvb', '0778855555', 'cvb', 1),
	(28, 'anuradha.studeo@gmail.com', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', '0778899666', 'sdf', 1),
	(29, 'anuradha.studeo@gmail.com', 'sdf', 'sdf', 'sdf', 'sdf', 'sd', '0774411111', 'sdfsdf', 1),
	(30, 'anuradha.studeo@gmail.com', 'rdrg', 'drg', 'drg', 'drg', 'rgdrg', '0775588888', 'drg', 2),
	(31, 'anuradha.studeo@gmail.com', 'dfg', 'dfg', 'df', 'gdfg', 'dfg', '0778899922', 'dfg', 1),
	(32, 'anuradha.studeo@gmail.com', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', '0778899988', 'fgh', 1),
	(33, 'anuradha.studeo@gmail.com', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', '0778899888', 'sdf', 2),
	(34, 'anuradha.studeo@gmail.com', 'fgh', 'fthf', 'fgdfg', 'fghfgh', 'fddgh', '0778899888', 'fgh', 1),
	(35, 'anuradha.studeo@gmail.com', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', '0789988777', 'sdf', 1),
	(36, 'anuradha.studeo@gmail.com', 'sd', 'sdf', 'sdf', 'sdf', 'sdf', '0778888888', 'sdf', 2),
	(37, 'anuradha.studeo@gmail.com', 'vsd', 'vsdv', 'sdv', 'sd', 'sdv', '0778888888', 'sdv', 1),
	(38, 'anuradha.studeo@gmail.com', 'dfb', 'dfb', 'dfb', 'dfb', 'dfb', '0775544444', 'dfb', 1),
	(39, 'anuradha.studeo@gmail.com', 'df', 'gdfg', 'dfg', 'dfg', 'dfg', '0778899999', 'dfg', 2),
	(40, 'anuradha.studeo@gmail.com', 'fdg', 'dfg', 'dfg', 'dfg', 'dfg', '0778899999', 'ddfgdf', 1),
	(41, 'anuradha.studeo@gmail.com', 'sdf', 'sdf', 'sdf', 'sdfsd', 'fsdf', '0778899999', 'sdfs', 1),
	(42, 'anuradha.studeo@gmail.com', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', '0778888888', 'sdf', 2),
	(43, 'anuradha.studeo@gmail.com', 'dfg', 'dfg', 'dfg', 'dfg', 'dfg', '0778899888', 'dfg', 1),
	(44, 'anuradha.studeo@gmail.com', 'ttry', 'jtyjtyj', 'ghj', 'ghj', 'ghjghj', '0785522444', 'ghjgh', 2),
	(45, 'anuradha.studeo@gmail.com', 'dfg', 'dfg', 'dfg', 'fdg', 'dfg', '0778899999', 'dfg', 2),
	(46, 'anuradha.studeo@gmail.com', 'dfb', 'dfb', 'dfb', 'dfb', 'dfb', '0778899999', 'dfb', 1),
	(47, 'anuradha.studeo@gmail.com', 'fcgbdf', 'bdfb', 'dfb', 'dfhb', 'dfb', '0775588966', 'dfb', 1),
	(48, 'anuradha.studeo@gmail.com', 'rge', 'grerg', 'dfg', 'dfg', 'dfg', '0778899999', 'dfg', 1),
	(49, 'anuradha.studeo@gmail.com', 'dfg', 'dfg', 'dfg', 'dfg', 'dfg', '0778855555', 'dfg077885', 1),
	(50, 'anuradha.studeo@gmail.com', 'dfg', 'dfg', 'dfg', 'dfg', 'dfg', '0774455222', 'dfg', 1),
	(51, 'anuradha.studeo@gmail.com', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', '0778855888', 'fgh', 1),
	(52, 'anuradha.studeo@gmail.com', 'Nipun', 'Anuradha', 'Ass road', 'Ejjdkn', 'Qtui', '0770087558', '67890', 1),
	(53, 'anuradha.studeo@gmail.com', 'kavi', 'nipun', 'Kuliyapitiya Road', 'Naththandiya', 'Welipenna', '0770087558', '60240', 1),
	(54, 'anuradha.studeo@gmail.com', 'kavishka', 'npun', 'kuliyapitiya Road', 'naththandiya', 'welipenna', '0770087558', '6580', 1),
	(55, 'anuradha.studeo@gmail.com', 'nipun', 'anuradha', 'Colombo Road', 'Colombo', 'No 27', '0770087558', '6520', 1),
	(56, 'anuradha.studeo@gmail.com', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', '0778899888', 'fgh', 1),
	(57, 'anuradha.studeo@gmail.com', 'f', 'hgfgh', 'fgh', 'fgh', 'fgh', '0775544444', 'fgh', 1),
	(58, 'anuradha.studeo@gmail.com', 'nipun', 'anuradha', 'Colombo Road', 'Colombo', 'Colombo', '0770087558', '6540', 1),
	(59, 'anuradha.studeo@gmail.com', 'nipun', 'anuradha', 'Colombo Road', 'Col.ombo', 'Colombo', '0770087558', '5480', 1),
	(60, 'anuradha.studeo@gmail.com', 'sdf', 'sdf', 'sdfsdf', 'sdfsdfsdf', 'ergerg', '0774455555', '345', 1),
	(61, 'anuradha.studeo@gmail.com', 'rthrth', 'rthrh', 'rthrt', 'hrthrth', 'trh', '0770087558', 'rthrth', 1),
	(62, 'anuradha.studeo@gmail.com', 'nipun', 'anuradha', 'colombo road', 'colombo', 'colombo', '0770087558', '5480', 1),
	(63, 'anuradha.studeo@gmail.com', 'tgyj', 'gyj', 'gyj', 'gyj', 'gyj', '0774455555', 'gyj', 1),
	(64, 'anuradha.studeo@gmail.com', 'ghn', 'ghn', 'ghn', 'ghn', 'ghn', '0778899999', 'ghn', 2),
	(65, 'anuradha.studeo@gmail.com', 'ftgh', 'fgh', 'fgh', 'fgh', 'fgh', '0778855555', 'fgh', 2),
	(66, 'anuradha.studeo@gmail.com', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', '0774455555', 'fgh', 2),
	(67, 'anuradha.studeo@gmail.com', 'dfg', 'dfg', 'dfg', 'dfg', 'dfg', '0774455556', 'dfg', 1),
	(68, 'anuradha.studeo@gmail.com', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', '0745555555', 'sdf', 2),
	(69, 'anuradha.studeo@gmail.com', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', '0758888888', 'fgh', 2),
	(70, 'anuradha.studeo@gmail.com', 'dfg', 'dfg', 'dfg', 'dfg', 'dfg', '0789999999', 'dfg', 2),
	(71, 'anuradha.studeo@gmail.com', 'fgh', 'fgh', 'fgh', 'fgh', 'fgh', '0745555555', 'fgh', 1),
	(72, 'anuradha.studeo@gmail.com', 'v b', 'cvb', 'cvbcvb', 'cvbcvb', 'cvbv', '0744444444', 'cvb', 1),
	(73, 'anuradha.studeo@gmail.com', 'dgr', 'drg', 'drg', 'drg', 'drg', '0758888888', 'drg', 1),
	(74, 'anuradha.studeo@gmail.com', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', '0758899898', 'sdf', 2),
	(75, 'anuradha.studeo@gmail.com', 'dfg', 'dfg', 'dfg', 'dfg', 'dfg', '0725588777', 'dfg', 1),
	(76, 'kavi@gmail.com', 'Nipun', 'Kanjk', 'Jsjj', 'Jsjj', 'Hjjjj', '0753366115', 'Jkjj', 2),
	(77, 'anuradha.studeo@gmail.com', 'rth', 'rth', 'rth', 'rth', 'rth', '0778899999', 'rth', 1),
	(78, 'anuradha.studeo@gmail.com', 'fg', 'fg', 'fg', 'fg', 'fg', '0758888888', 'fg', 2);
/*!40000 ALTER TABLE `user_has_address` ENABLE KEYS */;

-- Dumping structure for table um.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  KEY `fk_watchlist_user1_idx` (`user_email`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table um.watchlist: ~0 rows (approximately)
/*!40000 ALTER TABLE `watchlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `watchlist` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
