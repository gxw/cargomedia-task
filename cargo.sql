
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for cargo_api_test
CREATE DATABASE IF NOT EXISTS `cargo_api_test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cargo_api_test`;


-- Dumping structure for table cargo_api_test.Friend
CREATE TABLE IF NOT EXISTS `Friend` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `User1` int(11) unsigned NOT NULL,
  `User2` int(11) unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `User1_User2` (`User1`,`User2`),
  KEY `FK_Friend_User_2` (`User2`),
  CONSTRAINT `FK_Friend_User` FOREIGN KEY (`User1`) REFERENCES `User` (`Id`),
  CONSTRAINT `FK_Friend_User_2` FOREIGN KEY (`User2`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- Dumping data for table cargo_api_test.Friend: ~32 rows (approximately)
DELETE FROM `Friend`;
/*!40000 ALTER TABLE `Friend` DISABLE KEYS */;
INSERT INTO `Friend` (`Id`, `User1`, `User2`) VALUES
	(1, 1, 2),
	(2, 2, 3),
	(3, 3, 4),
	(4, 3, 5),
	(5, 3, 7),
	(30, 3, 11),
	(6, 5, 6),
	(9, 5, 7),
	(8, 5, 10),
	(7, 5, 11),
	(12, 7, 8),
	(11, 7, 12),
	(10, 7, 20),
	(13, 9, 12),
	(14, 10, 11),
	(16, 11, 19),
	(15, 11, 20),
	(17, 12, 13),
	(18, 12, 20),
	(19, 13, 14),
	(20, 13, 20),
	(21, 14, 15),
	(22, 16, 18),
	(23, 16, 20),
	(24, 17, 18),
	(25, 17, 20),
	(26, 19, 20),
	(27, 21, 3),
	(28, 21, 4),
	(29, 21, 5),
	(32, 21, 18),
	(31, 21, 20);
/*!40000 ALTER TABLE `Friend` ENABLE KEYS */;


-- Dumping structure for table cargo_api_test.User
CREATE TABLE IF NOT EXISTS `User` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Surname` varchar(50) DEFAULT NULL,
  `Age` tinyint(3) unsigned DEFAULT NULL,
  `Gender` bit(1) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_User_UserGender` (`Gender`),
  CONSTRAINT `FK_User_UserGender` FOREIGN KEY (`Gender`) REFERENCES `UserGender` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Dumping data for table cargo_api_test.User: ~21 rows (approximately)
DELETE FROM `User`;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` (`Id`, `Name`, `Surname`, `Age`, `Gender`) VALUES
	(1, 'Paul', 'Crowe', 28, b'0'),
	(2, 'Rob', 'Fitz', 23, b'0'),
	(3, 'Ben', 'O\'Carola', NULL, b'0'),
	(4, 'Victor', '', 28, b'0'),
	(5, 'Peter', 'Mac', 29, b'0'),
	(6, 'John', 'Barry', 18, b'0'),
	(7, 'Sarah', 'Lane', 30, b'1'),
	(8, 'Susan', 'Downe', 28, b'1'),
	(9, 'Jack', 'Stam', 28, b'0'),
	(10, 'Amy', 'Lane', 24, b'1'),
	(11, 'Sandra', 'Phelan', 28, b'1'),
	(12, 'Laura', 'Murphy', 33, b'1'),
	(13, 'Lisa', 'Daly', 28, b'1'),
	(14, 'Mark', 'Johnson', 28, b'0'),
	(15, 'Seamus', 'Crowe', 24, b'0'),
	(16, 'Daren', 'Slater', 28, b'0'),
	(17, 'Dara', 'Zoltan', 48, b'0'),
	(18, 'Marie', 'D', 28, b'1'),
	(19, 'Catriona', 'Long', 28, b'1'),
	(20, 'Katy', 'Couch', 28, b'1'),
	(21, 'John', 'Test', 33, b'0');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;


-- Dumping structure for table cargo_api_test.UserGender
CREATE TABLE IF NOT EXISTS `UserGender` (
  `Id` bit(1) NOT NULL,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table cargo_api_test.UserGender: ~2 rows (approximately)
DELETE FROM `UserGender`;
/*!40000 ALTER TABLE `UserGender` DISABLE KEYS */;
INSERT INTO `UserGender` (`Id`, `Name`) VALUES
	(b'0', 'male'),
	(b'1', 'female');
/*!40000 ALTER TABLE `UserGender` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
