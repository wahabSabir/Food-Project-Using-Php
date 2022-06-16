-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table food-order.tbl_admin
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table food-order.tbl_admin: ~2 rows (approximately)
INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
	(41, 'Abdulwahab', 'wahabsabir', '4297f44b13955235245b2497399d7a93'),
	(42, 'mubashir', 'mobi khan', '3d186804534370c3c817db0563f0e461');

-- Dumping structure for table food-order.tbl_category
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table food-order.tbl_category: ~2 rows (approximately)
INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
	(2, 'Burger', 'Food_category_908.jpg', 'Yes', 'Yes'),
	(7, 'Pizza', 'Food_category_962.jpg', 'Yes', 'Yes');

-- Dumping structure for table food-order.tbl_food
CREATE TABLE IF NOT EXISTS `tbl_food` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table food-order.tbl_food: ~1 rows (approximately)
INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
	(7, 'Menu Pizza', 'Large Pizza', 5.00, 'Foods_8244.jpg', 7, 'Yes', 'Yes');

-- Dumping structure for table food-order.tbl_order
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table food-order.tbl_order: ~4 rows (approximately)
INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
	(1, 'Menu Pizza', 5.00, 5, 25.00, '2022-06-08 03:48:10', 'cancelled', 'Wahab Sabir', '521721567', 'sagsahg@gmail.com', 'jashkjdhkjashjkadhskjhsdjBbzxMNBMCXZ'),
	(2, 'Menu Pizza', 5.00, 6, 30.00, '2022-06-08 03:52:59', 'delivered', 'Mubashir', '365237', 'wahab@gmail.com', 'agsjhagsjhas'),
	(3, 'Menu Pizza', 5.00, 3, 15.00, '2022-06-08 04:06:30', 'ondelivery', 'Bilal', '0321671267', 'bilalbixbi@gmail.com', 'ahgjagjdghsjhgdsjhdas'),
	(5, 'Menu Pizza', 5.00, 3, 15.00, '2022-06-08 05:30:15', 'ordered', 'Moazz', '0321671267', 'moaz@gmail.com', 'askjhsajahsjksahjkaxzbnzxbm');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
