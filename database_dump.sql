CREATE DATABASE  IF NOT EXISTS `main` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `main`;
-- MySQL dump 10.13  Distrib 5.5.24, for osx10.5 (i386)
--
-- Host: localhost    Database: main
-- ------------------------------------------------------
-- Server version	5.5.29

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issueid` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `createdby` int(11) NOT NULL,
  `creationdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,2,'I\'ll work on it ASAP.',3,'2012-12-29 19:58:10'),(2,2,'Still looking into it.',3,'2012-12-29 19:58:54'),(3,2,'Unable to reproduce.',3,'2012-12-29 19:59:11'),(4,2,'All is well as far as I can tell.',3,'2012-12-29 22:11:21'),(5,2,'Adding a comment, nothing to see here.',3,'2012-12-29 22:13:23'),(6,2,'Adding morning comment.',3,'2012-12-30 08:58:08'),(7,2,'Testing?',3,'2012-12-30 14:27:55'),(8,1,'Well duh! I just started working on it last week!',3,'2012-12-30 19:32:52'),(9,2,'Checking update time.',3,'2012-12-30 19:39:29'),(10,1,'Checking last update fixes.',3,'2012-12-30 19:46:03'),(11,1,'Checking last update fixes.\r\n',3,'2012-12-30 20:19:04'),(12,2,'Testing adding users.',3,'2012-12-30 21:03:53'),(13,2,'Testing again.',3,'2012-12-30 21:04:06'),(14,4,'This has been fixed. Ready to be closed.',3,'2012-12-30 22:22:08'),(15,5,'This has been fixed and can be closed.',3,'2012-12-30 22:22:58'),(16,3,'I will fix this in a later update.',3,'2012-12-30 22:23:19');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issueTags`
--

DROP TABLE IF EXISTS `issueTags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issueTags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issueID` int(11) NOT NULL,
  `tag` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issueTags`
--

LOCK TABLES `issueTags` WRITE;
/*!40000 ALTER TABLE `issueTags` DISABLE KEYS */;
INSERT INTO `issueTags` VALUES (1,1,'General'),(2,1,'PHP'),(3,1,'Error'),(4,2,'PHP'),(5,3,'bug'),(6,3,'php'),(7,3,'issue'),(8,4,'php'),(9,4,'bug'),(10,4,'mysql'),(11,5,'php'),(12,5,'mysql');
/*!40000 ALTER TABLE `issueTags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issueUsers`
--

DROP TABLE IF EXISTS `issueUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issueUsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issueID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issueUsers`
--

LOCK TABLES `issueUsers` WRITE;
/*!40000 ALTER TABLE `issueUsers` DISABLE KEYS */;
INSERT INTO `issueUsers` VALUES (1,1,1),(2,1,2),(3,1,6),(4,2,1),(6,2,6),(7,2,3),(21,4,3),(22,5,3),(23,3,3);
/*!40000 ALTER TABLE `issueUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `createdby` int(11) NOT NULL,
  `creationdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `application` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
INSERT INTO `issues` VALUES (1,'Bug in Issue Tracker','Nothing really works yet.',1,'2012-12-26 21:32:00','2012-12-29 21:32:00','','Issue Tracker'),(2,'Creating Issue Error','Creating issues causes crash.',3,'2012-12-29 14:24:29','2012-12-30 21:04:06','','Issue Tracker'),(3,'No emails are being sent','When I create new issues, no one is getting e',3,'2012-12-30 21:34:46','2012-12-30 22:23:19','',''),(4,'Application doesn\'t appear on new tickets','When creating a new issue, the application do',3,'2012-12-30 21:37:49','2012-12-30 22:22:08','','Issue Tracker'),(5,'Users Aren\'t Added','When creating a new ticket, selected users aren\'t added.',3,'2012-12-30 21:39:41','2012-12-30 22:22:58','','Issue Tracker');
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jillian','Curcio','Jeremy1026@gmail.com',''),(3,'Jeremy','Curcio','j.curcio@me.com','fCryptography::password_hash#p2axvTcP0F#591ed77ec393c43341cc1c9376524020ccafd1c7'),(4,'Test','User','test@test.com','fCryptography::password_hash#xpJvoYx1im#cecbf43a4aeb7da9bd26fe85fc9668e4d6354961'),(6,'No','One','noone@fake.com','fCryptography::password_hash#sAGTqddeG7#5f9295aac6f11cb3b91f38ce29981ceaf86c0169');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-30 22:24:21
