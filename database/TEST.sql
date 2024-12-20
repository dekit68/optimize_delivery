-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.6.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for mec_foods
CREATE DATABASE IF NOT EXISTS `mec_foods` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `mec_foods`;

-- Dumping structure for table mec_foods.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `food_img` longtext DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.cart: ~0 rows (approximately)

-- Dumping structure for table mec_foods.food
CREATE TABLE IF NOT EXISTS `food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT 0,
  `discount` int(11) DEFAULT 0,
  `food_img` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_food_food_type` (`type_id`),
  KEY `FK_food_shop` (`shop_id`),
  CONSTRAINT `FK_food_food_type` FOREIGN KEY (`type_id`) REFERENCES `food_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_food_shop` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.food: ~1 rows (approximately)
REPLACE INTO `food` (`id`, `type_id`, `shop_id`, `name`, `price`, `discount`, `food_img`) VALUES
	(6, 1, 9, 'แฮมเบอร์เก้อ', 100, 20, '../uploads/food/1734673008_Screenshot 2024-12-14 010429.png');

-- Dumping structure for table mec_foods.food_type
CREATE TABLE IF NOT EXISTS `food_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.food_type: ~1 rows (approximately)
REPLACE INTO `food_type` (`id`, `name`) VALUES
	(1, 'fastfood');

-- Dumping structure for table mec_foods.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NULL DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.orders: ~1 rows (approximately)
REPLACE INTO `orders` (`id`, `time`, `price`, `user_id`, `shop_id`, `delivery_id`) VALUES
	(1, '2024-12-20 06:03:28', 100, 3, 9, 9);

-- Dumping structure for table mec_foods.orders_detail
CREATE TABLE IF NOT EXISTS `orders_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `delivery_status` int(11) DEFAULT 0,
  `pay_status` int(11) DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.orders_detail: ~0 rows (approximately)

-- Dumping structure for table mec_foods.review
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.review: ~0 rows (approximately)

-- Dumping structure for table mec_foods.shop
CREATE TABLE IF NOT EXISTS `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `approve` int(11) DEFAULT 0,
  `type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_shop_users` (`user_id`),
  KEY `FK_shop_shop_type` (`type_id`),
  CONSTRAINT `FK_shop_shop_type` FOREIGN KEY (`type_id`) REFERENCES `shop_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_shop_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.shop: ~1 rows (approximately)
REPLACE INTO `shop` (`id`, `name`, `address`, `phone`, `approve`, `type_id`, `user_id`) VALUES
	(9, 'asdasd', 'mec tect 49000', '0826419844', 1, 20, 11);

-- Dumping structure for table mec_foods.shop_type
CREATE TABLE IF NOT EXISTS `shop_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.shop_type: ~1 rows (approximately)
REPLACE INTO `shop_type` (`id`, `name`) VALUES
	(20, 'อีสาน');

-- Dumping structure for table mec_foods.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` enum('user','admin','manager','delivery') NOT NULL DEFAULT 'user',
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` longtext DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.users: ~7 rows (approximately)
REPLACE INTO `users` (`id`, `role`, `firstname`, `lastname`, `phone`, `email`, `password`, `profile_image`, `status`) VALUES
	(3, 'user', 'name', 'lname', NULL, 'user@gmail.com', '1234', '../uploads/profile/1734488938_1733068191_รูป.jpg', 1),
	(4, 'admin', 'name', 'lname', NULL, 'admin@gmail.com', 'mec123456', NULL, 1),
	(5, 'delivery', 'Delivery', 'Nutto', NULL, 'delivery@gmail.com', 'mec123456', NULL, 1),
	(8, 'user', 'name', 'lname', NULL, 'user2@gmail.com', 'mec123456', NULL, 1),
	(9, 'user', 'name', 'lname', NULL, 'admin2@gmail.com', 'mec123456', NULL, 1),
	(10, 'admin', 'name', 'lname', NULL, 'admin3@gmail.com', '1234', NULL, 1),
	(11, 'manager', 'Delivery', 'lname', NULL, 'manager@gmail.com', 'mec123456', '../uploads/profile/1734631242_Screenshot 2024-12-09 223459.png', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
