-- MySQL dump 10.13  Distrib 5.6.22, for osx10.7 (x86_64)
--
-- Host: localhost    Database: trial
-- ------------------------------------------------------
-- Server version	5.6.22

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
-- Table structure for table `trial_bind_comments`
--

DROP TABLE IF EXISTS `trial_bind_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trial_bind_comments` (
  `comment_id` int(11) NOT NULL,
  `destination` varchar(20) NOT NULL,
  `destination_id` int(11) NOT NULL,
  UNIQUE KEY `comment_id_2` (`comment_id`),
  KEY `comment_id` (`destination`,`destination_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trial_bind_comments`
--

LOCK TABLES `trial_bind_comments` WRITE;
/*!40000 ALTER TABLE `trial_bind_comments` DISABLE KEYS */;
INSERT INTO `trial_bind_comments` VALUES (6,'categories',1),(1,'pages',1),(2,'pages',1),(3,'pages',1);
/*!40000 ALTER TABLE `trial_bind_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trial_categories`
--

DROP TABLE IF EXISTS `trial_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trial_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trial_categories`
--

LOCK TABLES `trial_categories` WRITE;
/*!40000 ALTER TABLE `trial_categories` DISABLE KEYS */;
INSERT INTO `trial_categories` VALUES (1,'Крутая категория','Описание не смог придумать ',0),(2,'Под категория','Описание категории',1),(3,'Еще одна категория','Круть!',2),(4,'Подкатегория \"крутой\" категории','Описание крутой категории',3);
/*!40000 ALTER TABLE `trial_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trial_comments`
--

DROP TABLE IF EXISTS `trial_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trial_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(1000) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trial_comments`
--

LOCK TABLES `trial_comments` WRITE;
/*!40000 ALTER TABLE `trial_comments` DISABLE KEYS */;
INSERT INTO `trial_comments` VALUES (1,'Test','2015-02-06 00:00:00',1,0),(2,'Let\'s try it again','2015-02-06 00:00:00',1,0),(3,'Test','2015-02-21 00:00:00',1,1),(6,'cool text','2015-02-24 16:57:53',2,0);
/*!40000 ALTER TABLE `trial_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trial_groups`
--

DROP TABLE IF EXISTS `trial_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trial_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `privileges` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trial_groups`
--

LOCK TABLES `trial_groups` WRITE;
/*!40000 ALTER TABLE `trial_groups` DISABLE KEYS */;
INSERT INTO `trial_groups` VALUES (1,'users','comment'),(2,'editors','comment,pages'),(3,'admins','*');
/*!40000 ALTER TABLE `trial_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trial_pages`
--

DROP TABLE IF EXISTS `trial_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trial_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `description` varchar(500) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trial_pages`
--

LOCK TABLES `trial_pages` WRITE;
/*!40000 ALTER TABLE `trial_pages` DISABLE KEYS */;
INSERT INTO `trial_pages` VALUES (1,'Валидация','Сегодня я напишу статью о том как работает валидацию $_POST данных.','Это будет очень длинная статья, потому что я расскажу про все способы валидации, вообще просто все способы PHP валидации, начиная от простого if условия, заканчивая сложным паттерно AbstractProxyValidationFactory.','2015-02-06 00:00:00',1,1),(2,'Пароли пользователей','Я хакнул базу данных и посмотрел таблицу юзеров. Сделал вывод что все пароли в базе данных это \"123456\", да да, \"123456\" лол.','Теперь все могут без проблем заходить в систему с паролем \"123456\" хихихи','2015-02-14 18:51:39',2,3),(3,'HTML радуга','Простой способ нарисовать радугу на своем сайте с помощью HTML4 использую тэг font.','Немного текста.','2015-02-19 16:22:37',1,1),(4,'Еще одна категория','print(\'Привет чуваки!\'); Как дела? Сегодня я буду писать про PHP','Немного текста','2015-02-20 18:23:51',1,2);
/*!40000 ALTER TABLE `trial_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trial_users`
--

DROP TABLE IF EXISTS `trial_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trial_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '1',
  `registered_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trial_users`
--

LOCK TABLES `trial_users` WRITE;
/*!40000 ALTER TABLE `trial_users` DISABLE KEYS */;
INSERT INTO `trial_users` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e',3,'2015-02-06 19:37:29'),(2,'trololo','e10adc3949ba59abbe56e057f20f883e',2,'2015-02-14 18:48:09'),(3,'Dummy','e10adc3949ba59abbe56e057f20f883e',1,'2015-02-21 20:56:47'),(4,'guest','e10adc3949ba59abbe56e057f20f883e',1,'2015-02-26 12:40:30');
/*!40000 ALTER TABLE `trial_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-01 18:53:58
