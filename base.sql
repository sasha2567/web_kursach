-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.25 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных kursach_web
CREATE DATABASE IF NOT EXISTS `kursach_web` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `kursach_web`;


-- Дамп структуры для таблица kursach_web.web_coment
CREATE TABLE IF NOT EXISTS `web_coment` (
  `coment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `coment` mediumtext NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`coment_id`),
  KEY `FK_web_coment_web_user` (`user_id`),
  KEY `FK_web_coment_web_recipe` (`recipe_id`),
  CONSTRAINT `FK_web_coment_web_recipe` FOREIGN KEY (`recipe_id`) REFERENCES `web_recipe` (`recipe_id`),
  CONSTRAINT `FK_web_coment_web_user` FOREIGN KEY (`user_id`) REFERENCES `web_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_coment: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `web_coment` DISABLE KEYS */;
INSERT INTO `web_coment` (`coment_id`, `user_id`, `recipe_id`, `coment`, `datetime`) VALUES
	(1, 2, 1, '1234', '2015-10-29 23:03:11'),
	(2, 2, 1, 'qwerty', '2015-10-30 00:04:58'),
	(3, 2, 2, 'классный рецепт', '2015-11-21 17:36:52'),
	(4, 3, 1, 'Мне очень понравился этот рецепт, но я бы добавил в него описание', '2015-12-04 23:40:41'),
	(5, 2, 12, 'qwertyuiklxghd fcb dd', '2015-12-05 11:41:16');
/*!40000 ALTER TABLE `web_coment` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_master
CREATE TABLE IF NOT EXISTS `web_master` (
  `master_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `provide` int(11) NOT NULL,
  `dateprovide` datetime NOT NULL,
  PRIMARY KEY (`master_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_master: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `web_master` DISABLE KEYS */;
INSERT INTO `web_master` (`master_id`, `subject`, `description`, `provide`, `dateprovide`) VALUES
	(1, 'aaaaaaa', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA AAAAAAAAAAA', 0, '2015-12-05 11:09:00'),
	(2, 'bbbbbbb', 'BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB', 0, '2015-12-05 12:06:47');
/*!40000 ALTER TABLE `web_master` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_master_user
CREATE TABLE IF NOT EXISTS `web_master_user` (
  `master_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `FK__web_master` (`master_id`),
  KEY `FK__web_user` (`user_id`),
  CONSTRAINT `FK__web_master` FOREIGN KEY (`master_id`) REFERENCES `web_master` (`master_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__web_user` FOREIGN KEY (`user_id`) REFERENCES `web_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_master_user: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `web_master_user` DISABLE KEYS */;
INSERT INTO `web_master_user` (`master_id`, `user_id`) VALUES
	(1, 3);
/*!40000 ALTER TABLE `web_master_user` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_messege
CREATE TABLE IF NOT EXISTS `web_messege` (
  `messege_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `messege` text NOT NULL,
  PRIMARY KEY (`messege_id`),
  KEY `FK_web_messeges_web_user` (`user_id`),
  CONSTRAINT `FK_web_messeges_web_user` FOREIGN KEY (`user_id`) REFERENCES `web_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_messege: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `web_messege` DISABLE KEYS */;
INSERT INTO `web_messege` (`messege_id`, `user_id`, `messege`) VALUES
	(1, 2, 'qwerty'),
	(2, 2, 'йцукен;'),
	(3, 2, ';select * from user');
/*!40000 ALTER TABLE `web_messege` ENABLE KEYS */;


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
  CONSTRAINT `FK_web_recipe_recipe_web_section` FOREIGN KEY (`section_id`) REFERENCES `web_section` (`section_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_recipe: ~12 rows (приблизительно)
/*!40000 ALTER TABLE `web_recipe` DISABLE KEYS */;
INSERT INTO `web_recipe` (`recipe_id`, `section_id`, `description`, `recipe`, `image`, `date`) VALUES
	(1, 2, 'qqqq', 'qqqqrr', '1.jpg', '2015-10-29 17:14:31'),
	(2, 1, 'wwww', 'wwww', '2.jpg', '2015-10-29 17:15:59'),
	(3, 1, 'eee', 'eeeeeee', '1.jpg', '2015-11-02 22:31:26'),
	(4, 1, 'rrr', 'ккк', '3.jpg', '2015-11-22 11:34:31'),
	(5, 1, 'ttt', 'аасролдор порларрпа лалроа алрав лрв лр', '4.jpg', '2015-11-22 11:41:10'),
	(6, 2, 'рецепт 6', 'ff', 'WIN_20150707_155445.JPG', '2015-11-22 18:48:23'),
	(7, 1, 'йцукен', 'йцукенгшз', 'WIN_20150712_194306.JPG', '2015-11-23 11:32:50'),
	(8, 2, 'горячая картошка', 'хороший рецепт', 'WIN_20150901_17_43_28_Pro.jpg', '2015-12-01 13:22:01'),
	(9, 1, 'qq', 'qqqqq', '3.jpg', '2015-12-04 19:29:27'),
	(10, 2, 'q', 'q', '2.jpg', '0000-00-00 00:00:00'),
	(11, 2, 'qqqqqq', 'qqqqqqqq', '4.jpj', '2015-12-04 21:22:10'),
	(12, 1, 'nnnnnnnnn', 'все тщательно перемешать', 'WIN_20150901_17_43_28_Pro.jpg1449273454', '2015-12-05 03:57:34');
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
  CONSTRAINT `FK_web_recipe_product_web_types` FOREIGN KEY (`type_id`) REFERENCES `web_types` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_web_recipe_web_products` FOREIGN KEY (`product_id`) REFERENCES `web_products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_web_recipe_web_recipe_recipe` FOREIGN KEY (`recipe_id`) REFERENCES `web_recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_recipe_product: ~21 rows (приблизительно)
/*!40000 ALTER TABLE `web_recipe_product` DISABLE KEYS */;
INSERT INTO `web_recipe_product` (`recipe_id`, `product_id`, `count`, `type_id`) VALUES
	(1, 1, 1, 1),
	(1, 3, 2, 1),
	(1, 5, 5, 1),
	(4, 1, 1, 1),
	(4, 3, 1, 1),
	(5, 1, 1, 1),
	(5, 3, 2, 1),
	(5, 2, 3, 1),
	(5, 4, 4, 1),
	(6, 1, 1, 1),
	(7, 1, 1, 1),
	(7, 2, 2, 1),
	(7, 3, 3, 1),
	(7, 4, 4, 1),
	(7, 5, 1, 1),
	(7, 6, 2, 1),
	(7, 7, 3, 1),
	(8, 1, 2, 1),
	(8, 2, 4, 1),
	(12, 1, 1, 1),
	(12, 2, 1, 1);
/*!40000 ALTER TABLE `web_recipe_product` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_section
CREATE TABLE IF NOT EXISTS `web_section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_section: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `web_section` DISABLE KEYS */;
INSERT INTO `web_section` (`section_id`, `title`) VALUES
	(1, 'feast'),
	(2, 'daily');
/*!40000 ALTER TABLE `web_section` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_theme
CREATE TABLE IF NOT EXISTS `web_theme` (
  `theme_id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`theme_id`),
  UNIQUE KEY `theme` (`theme`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_theme: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `web_theme` DISABLE KEYS */;
INSERT INTO `web_theme` (`theme_id`, `theme`, `date`) VALUES
	(1, 'ddddd', '0000-00-00 00:00:00'),
	(2, 'fffffff', '0000-00-00 00:00:00'),
	(3, 'как сделать правильно бульон', '0000-00-00 00:00:00'),
	(4, 'ee', '2015-12-04 18:23:56'),
	(5, 'не кочегары мы не плотники', '2015-12-05 01:19:05');
/*!40000 ALTER TABLE `web_theme` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_theme_messege
CREATE TABLE IF NOT EXISTS `web_theme_messege` (
  `theme_id` int(11) NOT NULL,
  `messege_id` int(11) NOT NULL,
  KEY `FK__web_theme` (`theme_id`),
  KEY `FK__web_messeges` (`messege_id`),
  CONSTRAINT `FK__web_messeges` FOREIGN KEY (`messege_id`) REFERENCES `web_messege` (`messege_id`),
  CONSTRAINT `FK__web_theme` FOREIGN KEY (`theme_id`) REFERENCES `web_theme` (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_theme_messege: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `web_theme_messege` DISABLE KEYS */;
INSERT INTO `web_theme_messege` (`theme_id`, `messege_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3);
/*!40000 ALTER TABLE `web_theme_messege` ENABLE KEYS */;


-- Дамп структуры для таблица kursach_web.web_types
CREATE TABLE IF NOT EXISTS `web_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_types: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `web_types` DISABLE KEYS */;
INSERT INTO `web_types` (`type_id`, `type`) VALUES
	(1, 'шт.'),
	(2, 'мл.'),
	(3, 'л.'),
	(4, 'кг.'),
	(5, 'гр.'),
	(6, 'ч.л'),
	(7, 'ст.л');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kursach_web.web_user: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `web_user` DISABLE KEYS */;
INSERT INTO `web_user` (`user_id`, `username`, `password`, `fio`, `email`, `is_comented`) VALUES
	(0, 'guest', 'pasword', '\' \'', '\' \'', 1),
	(1, 'admin', 'ghjcnjnf', '', '', 1),
	(2, 'sasha2567', '1234', 'LIS', 'sasha25678@mail.ru', 1),
	(3, 'sasha25678', 'qwerty', 'L A I', 'sasha_94@i.ua', 0);
/*!40000 ALTER TABLE `web_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
