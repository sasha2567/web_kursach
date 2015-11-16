-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.23-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win64
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных kursach_web
CREATE DATABASE IF NOT EXISTS `kursach_web` /*!40100 DEFAULT CHARACTER SET utf32 COLLATE utf32_bin */;
USE `kursach_web`;


-- Дамп структуры для таблица kursach_web.web_coment
CREATE TABLE IF NOT EXISTS `web_coment` (
  `coment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `coment` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`coment_id`),
  KEY `FK_web_coment_web_recipe` (`recipe_id`),
  KEY `FK_web_coment_web_user` (`user_id`),
  CONSTRAINT `FK_web_coment_web_recipe` FOREIGN KEY (`recipe_id`) REFERENCES `web_recipe_product` (`recipe_id`),
  CONSTRAINT `FK_web_coment_web_user` FOREIGN KEY (`user_id`) REFERENCES `web_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы kursach_web.web_coment: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `web_coment` DISABLE KEYS */;
INSERT INTO `web_coment` (`coment_id`, `user_id`, `recipe_id`, `coment`, `datetime`) VALUES
	(1, 2, 1, '1234', '2015-10-29 23:03:11'),
	(2, 2, 1, 'qwerty', '2015-10-30 00:04:58');
/*!40000 ALTER TABLE `web_coment` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_products
CREATE TABLE IF NOT EXISTS `web_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_products: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `web_products` DISABLE KEYS */;
INSERT INTO `web_products` (`product_id`, `description`) VALUES
	(1, 'морковь'),
	(2, 'лук'),
	(3, 'чеснок'),
	(4, 'перец'),
	(5, 'помидор'),
	(6, 'зелень'),
	(7, 'курица');
/*!40000 ALTER TABLE `web_products` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_recipe
CREATE TABLE IF NOT EXISTS `web_recipe` (
  `recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `recipe` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`recipe_id`),
  KEY `FK_web_recipe_recipe_web_section` (`section_id`),
  CONSTRAINT `FK_web_recipe_recipe_web_section` FOREIGN KEY (`section_id`) REFERENCES `web_section` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_recipe: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `web_recipe` DISABLE KEYS */;
INSERT INTO `web_recipe` (`recipe_id`, `section_id`, `description`, `recipe`, `image`, `date`) VALUES
	(1, 2, 'qqqq', 'qqqq', '1.jpg', '2015-10-29 17:14:31'),
	(2, 1, 'wwww', 'wwww', '2.jpg', '2015-10-29 17:15:59'),
	(3, 1, 'eee', 'eeeeeee', '1.jpg', '2015-11-02 22:31:26');
/*!40000 ALTER TABLE `web_recipe` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_recipe_product
CREATE TABLE IF NOT EXISTS `web_recipe_product` (
  `recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  KEY `FK_web_recipe_web_products` (`product_id`),
  KEY `FK_web_recipe_web_recipe_recipe` (`recipe_id`),
  KEY `FK_web_recipe_product_web_types` (`type_id`),
  CONSTRAINT `FK_web_recipe_product_web_types` FOREIGN KEY (`type_id`) REFERENCES `web_types` (`type_id`),
  CONSTRAINT `FK_web_recipe_web_products` FOREIGN KEY (`product_id`) REFERENCES `web_products` (`product_id`),
  CONSTRAINT `FK_web_recipe_web_recipe_recipe` FOREIGN KEY (`recipe_id`) REFERENCES `web_recipe` (`recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы kursach_web.web_recipe_product: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `web_recipe_product` DISABLE KEYS */;
INSERT INTO `web_recipe_product` (`recipe_id`, `product_id`, `count`, `type_id`) VALUES
	(1, 1, 1, 1),
	(1, 3, 2, 1),
	(1, 5, 5, 1);
/*!40000 ALTER TABLE `web_recipe_product` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_section
CREATE TABLE IF NOT EXISTS `web_section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы kursach_web.web_section: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `web_section` DISABLE KEYS */;
INSERT INTO `web_section` (`section_id`, `title`) VALUES
	(1, 'feast'),
	(2, 'daily');
/*!40000 ALTER TABLE `web_section` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_types
CREATE TABLE IF NOT EXISTS `web_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf32_bin NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

-- Дамп данных таблицы kursach_web.web_types: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `web_types` DISABLE KEYS */;
INSERT INTO `web_types` (`type_id`, `type`) VALUES
	(1, 'шт.'),
	(2, 'мл.'),
	(3, 'л.'),
	(4, 'кг.'),
	(5, 'гр.');
/*!40000 ALTER TABLE `web_types` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_user
CREATE TABLE IF NOT EXISTS `web_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fio` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `is_comented` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы kursach_web.web_user: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `web_user` DISABLE KEYS */;
INSERT INTO `web_user` (`user_id`, `username`, `password`, `fio`, `email`, `is_comented`) VALUES
	(0, 'guest', 'pasword', '\' \'', '\' \'', 1),
	(1, 'admin', 'ghjcnjnf', '', '', 1),
	(2, 'sasha2567', '1234', 'LIS', 'sasha25678@mail.ru', 1),
	(3, 'sasha25678', 'ghjcnjnf', 'Lis', 'lis@mail.ru', 1);
/*!40000 ALTER TABLE `web_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
