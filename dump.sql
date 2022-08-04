-- MySQL dump 10.13  Distrib 5.7.38, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	5.7.38-0ubuntu0.18.04.1

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2022_08_01_160953_create_shows_table',1),(3,'2022_08_01_161802_create_time_tables_table',1),(4,'2022_08_01_180812_create_viewers_table',1),(5,'2022_08_01_195250_create_reservations_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `viewer_id` bigint(20) unsigned NOT NULL,
  `time_table_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1291 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,1,1,'2022-08-02 18:19:05','2022-08-02 18:19:06'),(2,2,1,'2022-08-02 18:19:05','2022-08-02 18:19:06'),(3,3,1,'2022-08-02 18:19:05','2022-08-02 18:19:06'),(4,4,1,'2022-08-02 18:19:05','2022-08-02 18:19:06'),(1277,7,1,'2022-08-04 05:32:19','2022-08-04 05:32:19'),(1290,7,1,'2022-08-04 05:47:37','2022-08-04 05:47:37');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shows`
--

DROP TABLE IF EXISTS `shows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shows` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shows`
--

LOCK TABLES `shows` WRITE;
/*!40000 ALTER TABLE `shows` DISABLE KEYS */;
INSERT INTO `shows` VALUES (1,'shekcpier',6,'2022-08-02 18:16:37','2022-08-04 05:18:38');
/*!40000 ALTER TABLE `shows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_tables`
--

DROP TABLE IF EXISTS `time_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_tables` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `day` enum('sat','sun','mon','tue','wed','thu','fri') COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` time NOT NULL,
  `show_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `time_tables_day_time_index` (`day`,`time`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_tables`
--

LOCK TABLES `time_tables` WRITE;
/*!40000 ALTER TABLE `time_tables` DISABLE KEYS */;
INSERT INTO `time_tables` VALUES (1,'sat','12:00:00',1,'2022-08-02 18:18:53','2022-08-02 18:18:53'),(2,'fri','12:00:00',2,'2022-08-03 12:18:52','2022-08-03 12:18:52');
/*!40000 ALTER TABLE `time_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viewers`
--

DROP TABLE IF EXISTS `viewers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viewers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viewers`
--

LOCK TABLES `viewers` WRITE;
/*!40000 ALTER TABLE `viewers` DISABLE KEYS */;
INSERT INTO `viewers` VALUES (1,'alireza','goodarzi','0018920101','2022-08-02 18:14:49','2022-08-02 18:14:50'),(2,'asghar','sharafi','0019020111','2022-08-02 18:15:11','2022-08-02 18:15:12'),(3,'rahim','norouzi','0010020211','2022-08-02 18:15:11','2022-08-02 18:15:12'),(4,'parham','asadi','0018060451','2022-08-02 18:15:11','2022-08-02 18:15:12'),(5,'mostafa','rahmani','0010060451','2022-08-02 18:15:11','2022-08-02 18:15:12'),(6,'mohsen','tanabandeh','1010060451','2022-08-02 18:15:11','2022-08-02 18:15:12'),(7,'ebrahim','momeni','1010560451','2022-08-02 18:15:11','2022-08-02 18:15:12'),(8,'Ellis','Lind','485809237','2022-08-03 12:18:52','2022-08-03 12:18:52'),(9,'Nicholas','Goodwin','968127','2022-08-03 12:18:52','2022-08-03 12:18:52'),(10,'Rhea','Hyatt','5413','2022-08-03 12:18:52','2022-08-03 12:18:52'),(11,'Danial','Runolfsdottir','181878','2022-08-03 12:18:52','2022-08-03 12:18:52'),(12,'Skylar','Mertz','37915443','2022-08-03 12:18:52','2022-08-03 12:18:52'),(13,'Alex','Reynolds','349498592','2022-08-03 12:18:52','2022-08-03 12:18:52'),(14,'Hector','Runte','80898487','2022-08-03 12:18:52','2022-08-03 12:18:52');
/*!40000 ALTER TABLE `viewers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-04 17:35:52
