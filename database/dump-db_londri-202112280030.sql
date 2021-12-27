-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: db_londri
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.20-MariaDB

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
-- Table structure for table `costumers`
--

DROP TABLE IF EXISTS `costumers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `costumers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `costumers`
--

LOCK TABLES `costumers` WRITE;
/*!40000 ALTER TABLE `costumers` DISABLE KEYS */;
INSERT INTO `costumers` VALUES (5,'Indra','081290669170','Jakarta',1,NULL,NULL,NULL),(6,'Rudi','081290669170','Jakarta Indonesia',1,NULL,NULL,NULL),(7,'Rudi','081290669170','Jakarta Indonesia',1,NULL,NULL,NULL),(8,'Rudi','081290669170','Jakarta Indonesia',1,NULL,NULL,NULL),(9,'Rudi','08129','Jakarta',1,NULL,NULL,1),(10,'1','1','2',1,NULL,NULL,1),(11,'Marlo','081290669170','Jakarta Indonesia',1,NULL,NULL,2);
/*!40000 ALTER TABLE `costumers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `error_log`
--

DROP TABLE IF EXISTS `error_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `error_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `error` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `error_log`
--

LOCK TABLES `error_log` WRITE;
/*!40000 ALTER TABLE `error_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `error_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_category`
--

DROP TABLE IF EXISTS `menu_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_category`
--

LOCK TABLES `menu_category` WRITE;
/*!40000 ALTER TABLE `menu_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_category` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2021_11_13_035124_stok',1),(6,'2021_11_13_035330_suplier',1),(7,'2021_11_13_035649_service',1),(8,'2021_11_13_035819_menu_category',1),(9,'2021_11_13_040146_create_transactions_table',1),(10,'2021_11_13_040559_create_costumers_table',1),(11,'2021_11_13_041248_error_log',1),(12,'2021_11_28_062532_status',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
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
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_discount` int(11) NOT NULL,
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'Cuci Setrika Express','CGX','7000','1',0,NULL,1,NULL,NULL),(2,'Cuci Setrika Standard','CGS','7000','3',0,NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,0,'proses',NULL,NULL),(2,1,'cuci',NULL,NULL),(3,2,'setrika',NULL,NULL),(4,3,'selesai',NULL,NULL),(5,4,'diambil',NULL,NULL);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stok`
--

DROP TABLE IF EXISTS `stok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stok` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `id_suplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok`
--

LOCK TABLES `stok` WRITE;
/*!40000 ALTER TABLE `stok` DISABLE KEYS */;
INSERT INTO `stok` VALUES (1,'Pewangi',100,'3',1500,1,'2021-11-13 22:06:03','2021-11-13 22:06:03',NULL),(2,'Detergen',10,'3',30000,1,'2021-12-04 23:42:06','2021-12-04 23:42:06',NULL),(3,'Pemutih',1000,'3',5000,1,'2021-12-11 22:21:06','2021-12-11 22:21:06',NULL),(4,'Pewangi',100,'3',1000,1,'2021-12-11 22:22:57','2021-12-11 22:22:57','1');
/*!40000 ALTER TABLE `stok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suplier`
--

DROP TABLE IF EXISTS `suplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suplier` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suplier`
--

LOCK TABLES `suplier` WRITE;
/*!40000 ALTER TABLE `suplier` DISABLE KEYS */;
INSERT INTO `suplier` VALUES (3,'Molto','/assets/suplier/1636865625185.png','011111','Indonesia',NULL,1,NULL,NULL),(4,'Rinso','0','081290669170','Jakarta Indonesia',NULL,1,'2021-12-26 20:30:49',NULL);
/*!40000 ALTER TABLE `suplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `costumer_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_type` int(11) NOT NULL DEFAULT 0,
  `pay_amount` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,999999,0,5,10,NULL,70000,4,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-04 17:00:00',NULL,1,100000),(2,463142,0,5,3,NULL,21000,3,'{\"payment_tipe\":\"2\",\"service_id\":\"2\"}','2021-12-09 17:00:00',NULL,0,0),(3,248874,1,8,1,0,7000,0,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-11 17:00:00',NULL,1,10000),(4,106401,1,9,10,0,70000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-17 17:00:00','2021-12-28 05:00:46',1,100000),(5,880706,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-26 17:00:00',NULL,0,NULL),(6,855027,1,9,30,0,210000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 08:54:14',NULL,0,100000),(7,800088,1,9,11,0,77000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"2\"}','2021-12-27 08:57:12',NULL,0,1333333),(8,944511,1,9,11,0,77000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:02:05',NULL,0,133333333),(9,529109,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:08:12',NULL,0,1000),(10,668417,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:09:41',NULL,0,1000),(11,826500,1,9,10,0,70000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"2\"}','2021-12-27 16:09:58',NULL,0,1),(12,149630,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:10:45',NULL,0,1),(13,549348,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:12:14',NULL,0,1),(14,237128,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:12:24',NULL,0,1),(15,774885,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:13:02',NULL,0,1),(16,958027,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:13:43',NULL,0,11111),(17,858457,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:14:14',NULL,0,111),(18,751768,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:15:07',NULL,0,1),(19,965391,1,9,3,0,21000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:16:33',NULL,0,10000),(20,392108,1,9,3,0,21000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:21:51',NULL,0,25000),(21,252706,1,9,11,0,77000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:28:00',NULL,1,100000),(22,524631,1,9,3,0,21000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:28:48',NULL,1,1),(23,464437,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:29:50',NULL,1,33),(24,152289,1,9,3,0,21000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:30:03',NULL,1,33),(25,960378,1,9,3,0,21000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:35:22',NULL,1,1111),(26,337218,1,9,5,0,35000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:36:04',NULL,1,1),(27,794575,1,9,3,0,21000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:36:14',NULL,1,1),(28,331119,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:36:42',NULL,1,1),(29,793958,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:37:00',NULL,1,1),(30,634492,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:37:13',NULL,1,1),(31,790030,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"2\"}','2021-12-27 16:37:55',NULL,1,1),(32,804463,1,10,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:39:20',NULL,1,1),(33,547504,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:43:45',NULL,1,1),(34,874681,1,9,1,0,7000,1,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 16:44:29',NULL,1,10000),(35,867155,2,11,10,0,70000,2,'{\"payment_tipe\":\"1\",\"service_id\":\"1\"}','2021-12-27 17:19:41','2021-12-28 05:19:44',1,100000);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com','admin ',NULL,'$2y$10$c4YwktbTTkPNmCZcXd3XNOBldM4H7cv5ipbDmHpwHR8NmHYVItMZm','1',NULL,NULL,NULL,'081290669170','Jakarta Raya Indonesia',1),(2,'Padel','padel@mail.com','padel',NULL,'$2y$10$syKBlmwSv8NR4EXGBxfTceP9Pjr5Vi6G3IzAtFReSITHdE76y6TkW','0',NULL,NULL,NULL,'081290669170','Jakarta',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'db_londri'
--

--
-- Dumping routines for database 'db_londri'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-28  0:30:36
