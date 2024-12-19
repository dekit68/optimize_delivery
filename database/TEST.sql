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

-- Dumping structure for table mec_foods.food
CREATE TABLE IF NOT EXISTS `food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT 0,
  `discount` int(11) DEFAULT 0,
  `food_img` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.food: ~1 rows (approximately)
REPLACE INTO `food` (`id`, `type_id`, `name`, `price`, `discount`, `food_img`) VALUES
	(1, 1, 'ddd', 100, 0, '0');

-- Dumping structure for table mec_foods.food_type
CREATE TABLE IF NOT EXISTS `food_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.food_type: ~1 rows (approximately)
REPLACE INTO `food_type` (`id`, `name`, `shop_id`) VALUES
	(1, 'fastfood', NULL);

-- Dumping structure for table mec_foods.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` enum('user','admin','manager','delivery') NOT NULL DEFAULT 'user',
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` longtext DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table mec_foods.users: ~4 rows (approximately)
REPLACE INTO `users` (`id`, `role`, `firstname`, `lastname`, `email`, `password`, `profile_image`, `status`) VALUES
	(3, 'user', 'name', 'lname', 'user@gmail.com', 'mec123456', '../uploads/profile/1734488938_1733068191_รูป.jpg', 0),
	(4, 'admin', 'name', 'lname', 'admin@gmail.com', 'mec123456', NULL, 0),
	(5, 'delivery', 'Delivery', 'Nutto', 'delivery@gmail.com', 'mec123456', NULL, 0),
	(6, 'manager', 'name', 'lname', 'manager@gmail.com', 'mec123456', NULL, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
