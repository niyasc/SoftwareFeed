-- MySQL dump 10.15  Distrib 10.0.23-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: SoftwareFeed
-- ------------------------------------------------------
-- Server version	10.0.23-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `app_users`
--

DROP TABLE IF EXISTS `app_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C2502824F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_users`
--

LOCK TABLES `app_users` WRITE;
/*!40000 ALTER TABLE `app_users` DISABLE KEYS */;
INSERT INTO `app_users` VALUES (1,'admin','$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC');
/*!40000 ALTER TABLE `app_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `software`
--

DROP TABLE IF EXISTS `software`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_77D068CF5E237E06` (`name`),
  UNIQUE KEY `UNIQ_77D068CF989D9B62` (`slug`),
  KEY `IDX_77D068CFC54C8C93` (`type_id`),
  CONSTRAINT `FK_77D068CFC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `software_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `software`
--

LOCK TABLES `software` WRITE;
/*!40000 ALTER TABLE `software` DISABLE KEYS */;
INSERT INTO `software` VALUES (1,4,'Fedora','fedora','Fedora, (formerly Fedora Core) is an independently evolved GNU/Linux distribution sponsored by Red Hat, an open source giant. Fedora make use of RPM for package management. Fedora is often referred as a testing platform for Red Hat Enterprise Linux.','7261a426f82f5d02ccccbaee0d5318db.svg'),(2,2,'Debian','debian','Debian is one of the oldest and biggest GNU/Linux project. It was started in 1993, by Ian Murdock. There are several distributions based on Debian. t comes with over 43000 packages, precompiled software bundled up in a nice format for easy installation on your machine.','d514bc99ec56845f4de28e3353dd317a.svg'),(4,2,'OpenSUSE','opensuse','openSUSE, formerly SUSE Linux and SuSE Linux Professional, is a Linux-based project and distribution sponsored by SUSE Linux GmbH and other companies. It is widely used throughout the world, particularly in Germany. The focus of its development is creating usable open-source tools for software developers and system administrators, while providing a user-friendly desktop, and feature-rich server environment.','e0f919886c7d67e03306e5d257626a9f.svg');
/*!40000 ALTER TABLE `software` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `software_children`
--

DROP TABLE IF EXISTS `software_children`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `software_children` (
  `child_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`child_id`,`parent_id`),
  KEY `IDX_56C3BD71DD62C21B` (`child_id`),
  KEY `IDX_56C3BD71727ACA70` (`parent_id`),
  CONSTRAINT `FK_56C3BD71727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `software` (`id`),
  CONSTRAINT `FK_56C3BD71DD62C21B` FOREIGN KEY (`child_id`) REFERENCES `software` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `software_children`
--

LOCK TABLES `software_children` WRITE;
/*!40000 ALTER TABLE `software_children` DISABLE KEYS */;
/*!40000 ALTER TABLE `software_children` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `software_type`
--

DROP TABLE IF EXISTS `software_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `software_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A9DB5DD55E237E06` (`name`),
  UNIQUE KEY `UNIQ_A9DB5DD5989D9B62` (`slug`),
  KEY `IDX_A9DB5DD5727ACA70` (`parent_id`),
  CONSTRAINT `FK_A9DB5DD5727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `software_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `software_type`
--

LOCK TABLES `software_type` WRITE;
/*!40000 ALTER TABLE `software_type` DISABLE KEYS */;
INSERT INTO `software_type` VALUES (1,NULL,'System Software','System Software is a computer software that is responsible for providing services for other application software packages. It act as an intermediate layer between user applications and computer hardware.','system-software'),(2,1,'Operating System','Operating System is a system software that act as an intermediate layer between computer hardware and application software packages. Operating System is responsible for performing resources management tasks such as process management, memory management, device management and file management.','operating-system'),(3,NULL,'Application Software','Application Software refers to computer software packages which performs some end user actions. Application software can be either general purpose or special purpose.','application-software'),(4,2,'Linux or GNU/Linux','The term Linux is often referred to the operating system GNU/Linux. GNU/Linux is a free and open source operating system. It includes GNU shell developed by Free Software Foundation and Linux kernel. There are hundreds of distributions based on GNU shell and Linux Kernel.','linux-or-gnu-linux'),(7,2,'BSD','BSD, Berkeley Software Distribution, was a Unix  like operating system developed and distributed by the Computer Systems Research Group (CSRG) of the University of California, Berkeley, from 1977 to 1995. Today the term \"BSD\" is often used non-specifically to refer to any of the BSD descendants which together form a branch of the family of Unix-like operating systems. Operating systems derived from the original BSD code remain actively developed and widely used.','bsd');
/*!40000 ALTER TABLE `software_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-13 22:20:28
