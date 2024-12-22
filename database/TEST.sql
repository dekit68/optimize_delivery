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
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.food: ~3 rows (approximately)
REPLACE INTO `food` (`id`, `type_id`, `shop_id`, `name`, `price`, `discount`, `food_img`) VALUES
	(11, 11, 10, 'ลาบ', 80, 5, '../uploads/food/1734795206_5264144b1f7657ba52865d58ef19a33b.jpg'),
	(13, 15, 11, 'มวยโค้ก', 20, 5, '../uploads/food/1734795397_e142abef81359b68d01a0cc5a7afed26.png'),
	(14, 14, 11, 'ต้มอะไรไม่รู้', 50, 2, '../uploads/food/1734887349_aa9db68ba59edcaa4c9317dd3af648c5.jpg');

-- Dumping structure for table mec_foods.food_type
CREATE TABLE IF NOT EXISTS `food_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.food_type: ~4 rows (approximately)
REPLACE INTO `food_type` (`id`, `name`, `shop_id`) VALUES
	(11, 'อาหารอีสาน', 10),
	(12, 'อาหารตามสั่ง', 10),
	(13, 'เครื่องดื่ม', 10),
	(14, 'อาหารไทย', 11),
	(15, 'เครื่องดื่ม', 11);

-- Dumping structure for table mec_foods.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NULL DEFAULT NULL,
  `delivery_status` int(11) DEFAULT 0,
  `shop_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.orders: ~2 rows (approximately)
REPLACE INTO `orders` (`id`, `time`, `delivery_status`, `shop_id`, `user_id`, `delivery_id`) VALUES
	(54, '2024-12-22 18:37:18', 1, 10, 12, 15),
	(55, '2024-12-22 18:37:18', 1, 11, 12, 15);

-- Dumping structure for table mec_foods.orders_detail
CREATE TABLE IF NOT EXISTS `orders_detail` (
  `id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.orders_detail: ~2 rows (approximately)
REPLACE INTO `orders_detail` (`id`, `price`, `discount`, `qty`, `total_price`, `food_id`) VALUES
	(54, 80, 5, 1, 75, 11),
	(55, 20, 5, 1, 15, 13);

-- Dumping structure for table mec_foods.review
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_review_users` (`user_id`),
  KEY `FK_review_users_2` (`food_id`),
  CONSTRAINT `FK_review_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_review_users_2` FOREIGN KEY (`food_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.shop: ~2 rows (approximately)
REPLACE INTO `shop` (`id`, `name`, `address`, `phone`, `approve`, `type_id`, `user_id`) VALUES
	(10, 'ยายดำครัวระเบิก', 'mec tect 49000', '0826419844', 1, 24, 14),
	(11, 'ร้านเนื้อเขียวเหนียวจัด', 'mec tect 49000', '0826419844', 1, 23, 16);

-- Dumping structure for table mec_foods.shop_type
CREATE TABLE IF NOT EXISTS `shop_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.shop_type: ~2 rows (approximately)
REPLACE INTO `shop_type` (`id`, `name`) VALUES
	(23, 'อาหารอีสาน'),
	(24, 'อาหารตามสั่ง');

-- Dumping structure for table mec_foods.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` enum('user','admin','manager','delivery') NOT NULL DEFAULT 'user',
  `firstname` varchar(255) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` longtext DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.users: ~5 rows (approximately)
REPLACE INTO `users` (`id`, `role`, `firstname`, `address`, `lastname`, `phone`, `email`, `password`, `profile_image`, `status`) VALUES
	(12, 'user', 'Userx', 'mectect', 'User', '0826419844', 'user@gmail.com', '1234', '../uploads/profile/1734786532_3b77e4f8519eaf696f0453768fbab1c5.jpg', 1),
	(13, 'admin', 'Admin', 'mectect', 'Admin', '0826419844', 'admin@gmail.com', '1234', '../uploads/profile/1734774924_63febc9e5731d7fd981eea16886878b5.jpg', 1),
	(14, 'manager', 'Manager', 'mectect', 'Manager', '0826419844', 'manager@gmail.com', '1234', '../uploads/profile/1734784950_49bc0dafabadabd352ca65819af10faf.jfif', 1),
	(15, 'delivery', 'Delivery', 'mectect', 'Delivery', '0826419844', 'delivery@gmail.com', '1234', NULL, 1),
	(16, 'manager', 'Manager', 'mectect', 'Manager', '0826419844', 'manager2@gmail.com', '1234', NULL, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
