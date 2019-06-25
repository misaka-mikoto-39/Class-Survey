-- MySQL dump 10.16  Distrib 10.3.10-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: classsurvey
-- ------------------------------------------------------
-- Server version	10.3.10-MariaDB-log

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tittle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diem`
--

DROP TABLE IF EXISTS `diem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `madiem` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `matieuchi` int(11) NOT NULL,
  `diem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`madiem`,`matieuchi`),
  KEY `FK_diem_dslopmonhoc` (`madiem`),
  KEY `FK_diem_tieuchi` (`matieuchi`),
  CONSTRAINT `FK_diem_dslopmonhoc` FOREIGN KEY (`madiem`) REFERENCES `dslopmonhoc` (`madiem`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_diem_tieuchi` FOREIGN KEY (`matieuchi`) REFERENCES `tieuchi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diem`
--

LOCK TABLES `diem` WRITE;
/*!40000 ALTER TABLE `diem` DISABLE KEYS */;
INSERT INTO `diem` VALUES (64,'24 16020078',7,4),(65,'24 16020078',8,1),(66,'24 16020078',9,5),(67,'24 16020078',10,2),(68,'24 16020078',11,2),(69,'24 16020078',12,2),(70,'25 16020078',7,2),(71,'25 16020078',8,2),(72,'25 16020078',9,2),(73,'25 16020078',10,4),(74,'25 16020078',11,2),(75,'25 16020078',12,2);
/*!40000 ALTER TABLE `diem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dslopmonhoc`
--

DROP TABLE IF EXISTS `dslopmonhoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dslopmonhoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listid` int(11) NOT NULL,
  `masinhvien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `madiem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`masinhvien`,`listid`),
  KEY `listid` (`listid`),
  KEY `masinhvien` (`masinhvien`),
  KEY `diem` (`madiem`),
  CONSTRAINT `FK_dslopmonhoc_lopmonhoc` FOREIGN KEY (`listid`) REFERENCES `lopmonhoc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dslopmonhoc_sinhvien` FOREIGN KEY (`masinhvien`) REFERENCES `sinhvien` (`svid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1438 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dslopmonhoc`
--

LOCK TABLES `dslopmonhoc` WRITE;
/*!40000 ALTER TABLE `dslopmonhoc` DISABLE KEYS */;
INSERT INTO `dslopmonhoc` VALUES (1353,24,'16020078','24 16020078','y'),(1354,25,'16020839','25 16020839','n'),(1355,25,'16021554','25 16021554','n'),(1356,25,'16020855','25 16020855','n'),(1357,25,'16021369','25 16021369','n'),(1358,25,'16020897','25 16020897','n'),(1359,25,'16020898','25 16020898','n'),(1360,25,'16021276','25 16021276','n'),(1361,25,'16022363','25 16022363','n'),(1362,25,'16020913','25 16020913','n'),(1363,25,'16020077','25 16020077','n'),(1364,25,'16020869','25 16020869','n'),(1365,25,'16020875','25 16020875','n'),(1366,25,'16021824','25 16021824','n'),(1367,25,'16020030','25 16020030','n'),(1368,25,'16022164','25 16022164','n'),(1369,25,'16022069','25 16022069','n'),(1370,25,'16020074','25 16020074','n'),(1371,25,'16020934','25 16020934','n'),(1372,25,'16020936','25 16020936','n'),(1373,25,'16022075','25 16022075','n'),(1374,25,'16021577','25 16021577','n'),(1375,25,'16020948','25 16020948','n'),(1376,25,'16020950','25 16020950','n'),(1377,25,'16020952','25 16020952','n'),(1378,25,'16020973','25 16020973','n'),(1379,25,'16020974','25 16020974','n'),(1380,25,'13020176','25 13020176','n'),(1381,25,'16020978','25 16020978','n'),(1382,25,'16020980','25 16020980','n'),(1383,25,'16021292','25 16021292','n'),(1384,25,'16021388','25 16021388','n'),(1385,25,'16022374','25 16022374','n'),(1386,25,'16021000','25 16021000','n'),(1387,25,'16020999','25 16020999','n'),(1388,25,'15021490','25 15021490','n'),(1389,25,'16022440','25 16022440','n'),(1390,25,'15021135','25 15021135','n'),(1391,25,'16021591','25 16021591','n'),(1392,25,'15021437','25 15021437','n'),(1393,25,'16021006','25 16021006','n'),(1394,25,'16021008','25 16021008','n'),(1395,25,'16022193','25 16022193','n'),(1396,25,'16022492','25 16022492','n'),(1397,25,'16021020','25 16021020','n'),(1398,25,'15022848','25 15022848','n'),(1399,25,'16021024','25 16021024','n'),(1400,25,'16021042','25 16021042','n'),(1401,25,'16021043','25 16021043','n'),(1402,25,'16021057','25 16021057','n'),(1403,25,'16022443','25 16022443','n'),(1404,25,'16020057','25 16020057','n'),(1405,25,'16021087','25 16021087','n'),(1406,25,'16021090','25 16021090','n'),(1407,25,'14020602','25 14020602','n'),(1408,25,'16021409','25 16021409','n'),(1409,25,'15021973','25 15021973','n'),(1410,25,'16021102','25 16021102','n'),(1411,25,'16021103','25 16021103','n'),(1412,25,'16021121','25 16021121','n'),(1413,25,'16021125','25 16021125','n'),(1414,25,'16021138','25 16021138','n'),(1415,25,'16021139','25 16021139','n'),(1416,25,'17020039','25 17020039','n'),(1417,25,'16022450','25 16022450','n'),(1418,25,'16021145','25 16021145','n'),(1419,25,'16021163','25 16021163','n'),(1420,25,'16020078','25 16020078','y'),(1421,25,'16021424','25 16021424','n'),(1422,25,'16021175','25 16021175','n'),(1423,25,'16021182','25 16021182','n'),(1424,25,'15022850','25 15022850','n'),(1425,25,'15021318','25 15021318','n'),(1426,25,'16021199','25 16021199','n'),(1427,25,'16021201','25 16021201','n'),(1428,25,'16021204','25 16021204','n'),(1429,25,'16021205','25 16021205','n'),(1430,25,'16021209','25 16021209','n'),(1431,25,'15021366','25 15021366','n'),(1432,25,'16021229','25 16021229','n'),(1433,25,'16021235','25 16021235','n'),(1434,25,'14020774','25 14020774','n'),(1435,25,'14020797','25 14020797','n'),(1436,25,'15021834','25 15021834','n'),(1437,25,'16020028','25 16020028','n');
/*!40000 ALTER TABLE `dslopmonhoc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dstieuchilmh`
--

DROP TABLE IF EXISTS `dstieuchilmh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dstieuchilmh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `malmh` int(11) NOT NULL,
  `matieuchi` int(11) NOT NULL,
  PRIMARY KEY (`id`,`malmh`,`matieuchi`),
  KEY `tieuchi` (`matieuchi`),
  KEY `FK_dstieuchilmh_lopmonhoc` (`malmh`),
  CONSTRAINT `FK_dstieuchilmh_lopmonhoc` FOREIGN KEY (`malmh`) REFERENCES `lopmonhoc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_dstieuchilmh_tieuchi` FOREIGN KEY (`matieuchi`) REFERENCES `tieuchi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dstieuchilmh`
--

LOCK TABLES `dstieuchilmh` WRITE;
/*!40000 ALTER TABLE `dstieuchilmh` DISABLE KEYS */;
INSERT INTO `dstieuchilmh` VALUES (59,24,7),(60,24,8),(61,24,9),(62,24,10),(63,24,11),(64,24,12),(65,25,7),(66,25,8),(67,25,9),(68,25,10),(69,25,11),(70,25,12);
/*!40000 ALTER TABLE `dstieuchilmh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `giangvien`
--

DROP TABLE IF EXISTS `giangvien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giangvien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gvid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`gvid`),
  KEY `FK_giangvien_users` (`gvid`),
  CONSTRAINT `FK_giangvien_users` FOREIGN KEY (`gvid`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giangvien`
--

LOCK TABLES `giangvien` WRITE;
/*!40000 ALTER TABLE `giangvien` DISABLE KEYS */;
INSERT INTO `giangvien` VALUES (25,'thanhld','Lê Đình Thanh','thanhld@vnu.edu.vn'),(34,'tunghx','Hoàng Xuân Tùng','tunghx@vnu.edu.vn'),(35,'sonnh','Nguyễn Hoài Sơn','sonnh@vnu.edu.vn'),(36,'thudm','Đào Minh Thư','thudm@vnu.edu.vn'),(37,'maitt','Trần Trúc Mai','maitt@vnu.edu.vn');
/*!40000 ALTER TABLE `giangvien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lopmonhoc`
--

DROP TABLE IF EXISTS `lopmonhoc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lopmonhoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `malop` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hocky` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `giangvien` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenmonhoc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`malop`,`hocky`),
  KEY `FK_lopmonhoc_giangvien` (`giangvien`),
  CONSTRAINT `FK_lopmonhoc_giangvien` FOREIGN KEY (`giangvien`) REFERENCES `giangvien` (`gvid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lopmonhoc`
--

LOCK TABLES `lopmonhoc` WRITE;
/*!40000 ALTER TABLE `lopmonhoc` DISABLE KEYS */;
INSERT INTO `lopmonhoc` VALUES (24,'INT3306 1','I 2018-2019','thanhld','Phát triển ứng dụng Web 1','y'),(25,'INT3306 1','I 2018-2021','thanhld','Phát triển ứng dụng Web','y');
/*!40000 ALTER TABLE `lopmonhoc` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_11_28_083113_create_category_table',1),(4,'2018_11_28_181529_user',2),(5,'2018_11_28_201839_create_users_table',3),(6,'2018_11_28_203144_create_users',4),(7,'2018_11_29_192333_create_user',5);
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
-- Table structure for table `sinhvien`
--

DROP TABLE IF EXISTS `sinhvien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sinhvien` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `svid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`svid`),
  KEY `svid` (`svid`),
  CONSTRAINT `FK_sinhvien_users` FOREIGN KEY (`svid`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=652 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sinhvien`
--

LOCK TABLES `sinhvien` WRITE;
/*!40000 ALTER TABLE `sinhvien` DISABLE KEYS */;
INSERT INTO `sinhvien` VALUES (548,'16020078','Hoàng Vĩnh Thịnh','16020078@vnu.edu.vn','QH-2016-I/CQ-C-C'),(559,'15020881','Triệu Hoàng An','15020881@vnu.edu.vn','QH-2015-I/CQ-CLC'),(560,'15021394','Bùi Châu Anh','15021394@vnu.edu.vn','QH-2015-I/CQ-CLC'),(561,'15021606','Lưu Việt Anh','15021606@vnu.edu.vn','QH-2015-I/CQ-CLC'),(562,'15021976','Nguyễn Đức Anh','15021976@vnu.edu.vn','QH-2015-I/CQ-CLC'),(563,'15021483','Nguyễn Quang Anh','15021483@vnu.edu.vn','QH-2015-I/CQ-CLC'),(564,'15022841','Nguyễn Thị Phương Anh','15022841@vnu.edu.vn','QH-2015-I/CQ-CLC'),(565,'15021332','Nguyễn Thị Vân Anh','15021332@vnu.edu.vn','QH-2015-I/CQ-CLC'),(566,'15021849','Nguyễn Tuấn Anh','15021849@vnu.edu.vn','QH-2015-I/CQ-CLC'),(567,'15021469','Nguyễn Chu Chiến','15021469@vnu.edu.vn','QH-2015-I/CQ-CLC'),(568,'15021359','Trần Minh Chiến','15021359@vnu.edu.vn','QH-2015-I/CQ-CLC'),(569,'16020839','Phạm Công Anh','16020839@vnu.edu.vn','QH-2016-I/CQ-C-C'),(570,'16021554','Phạm Tuấn Anh','16021554@vnu.edu.vn','QH-2016-I/CQ-N'),(571,'16020855','Hoàng Văn Chính','16020855@vnu.edu.vn','QH-2016-I/CQ-C-C'),(572,'16021369','Đinh Thị Thùy Dung','16021369@vnu.edu.vn','QH-2016-I/CQ-C-A-C'),(573,'16020897','Đậu Trọng Dũng','16020897@vnu.edu.vn','QH-2016-I/CQ-C-B'),(574,'16020898','Đỗ Đức Dũng','16020898@vnu.edu.vn','QH-2016-I/CQ-C-B'),(575,'16021276','Nguyễn Khánh Duy','16021276@vnu.edu.vn','QH-2016-I/CQ-T'),(576,'16022363','Phạm Văn Duy','16022363@vnu.edu.vn','QH-2016-I/CQ-T'),(577,'16020913','Nguyễn Bình Dương','16020913@vnu.edu.vn','QH-2016-I/CQ-C-B'),(578,'16020077','Hoàng Văn Đại','16020077@vnu.edu.vn','QH-2016-I/CQ-C-C'),(579,'16020869','Nguyễn Thành Đại','16020869@vnu.edu.vn','QH-2016-I/CQ-C-B'),(580,'16020875','Lê Quang Đạo','16020875@vnu.edu.vn','QH-2016-I/CQ-C-C'),(581,'16021824','Đỗ Thành Đạt','16021824@vnu.edu.vn','QH-2016-I/CQ-N'),(582,'16020030','Kiều Quốc Đạt','16020030@vnu.edu.vn','QH-2016-I/CQ-C-C'),(583,'16022164','Lê Quang Đạt','16022164@vnu.edu.vn','QH-2016-I/CQ-N'),(584,'16022069','Phan Minh Đức','16022069@vnu.edu.vn','QH-2016-I/CQ-T'),(585,'16020074','Trương Hà Anh Đức','16020074@vnu.edu.vn','QH-2016-I/CQ-C-B'),(586,'16020934','Dương Thanh Hải','16020934@vnu.edu.vn','QH-2016-I/CQ-C-C'),(587,'16020936','Lê Viết Hải','16020936@vnu.edu.vn','QH-2016-I/CQ-C-B'),(588,'16022075','Đoàn Trung Hiếu','16022075@vnu.edu.vn','QH-2016-I/CQ-T'),(589,'16021577','Đỗ Minh Hiếu','16021577@vnu.edu.vn','QH-2016-I/CQ-N'),(590,'16020948','Hà Minh Hiếu','16020948@vnu.edu.vn','QH-2016-I/CQ-C-C'),(591,'16020950','Hoàng Minh Hiếu','16020950@vnu.edu.vn','QH-2016-I/CQ-C-C'),(592,'16020952','Lê Trung Hiếu','16020952@vnu.edu.vn','QH-2016-I/CQ-C-C'),(593,'16020973','Nguyễn Đức Hoàng','16020973@vnu.edu.vn','QH-2016-I/CQ-C-B'),(594,'16020974','Nguyễn Minh Hoàng','16020974@vnu.edu.vn','QH-2016-I/CQ-C-C'),(595,'13020176','Nguyễn Xuân Hoàng','13020176@vnu.edu.vn','QH-2013-I/CQ-C-C'),(596,'16020978','Vũ Huy Hoàng','16020978@vnu.edu.vn','QH-2016-I/CQ-C-C'),(597,'16020980','Trần Đức Học','16020980@vnu.edu.vn','QH-2016-I/CQ-C-C'),(598,'16021292','Nguyễn Thị Hợp','16021292@vnu.edu.vn','QH-2016-I/CQ-T'),(599,'16021388','Cao Đức Huân','16021388@vnu.edu.vn','QH-2016-I/CQ-C-A-C'),(600,'16022374','Nguyễn Mậu Đức Huy','16022374@vnu.edu.vn','QH-2016-I/CQ-T'),(601,'16021000','Nguyễn Quang Huy','16021000@vnu.edu.vn','QH-2016-I/CQ-C-C'),(602,'16020999','Nguyễn Quang Huy','16020999@vnu.edu.vn','QH-2016-I/CQ-C-C'),(603,'15021490','Nguyễn Văn Huy','15021490@vnu.edu.vn','QH-2015-I/CQ-C-C'),(604,'16022440','Trịnh Ngọc Huy','16022440@vnu.edu.vn','QH-2016-I/CQ-N'),(605,'15021135','Lê Duy Hưng','15021135@vnu.edu.vn','QH-2015-I/CQ-C-B'),(606,'16021591','Lê Duy Hưng','16021591@vnu.edu.vn','QH-2016-I/CQ-N'),(607,'15021437','Vũ Văn Hưng','15021437@vnu.edu.vn','QH-2015-I/CQ-C-C'),(608,'16021006','Nguyễn Văn Khải','16021006@vnu.edu.vn','QH-2016-I/CQ-C-B'),(609,'16021008','Lê Duy Khánh','16021008@vnu.edu.vn','QH-2016-I/CQ-C-C'),(610,'16022193','Nguyễn Ngọc Lâm','16022193@vnu.edu.vn','QH-2016-I/CQ-N'),(611,'16022492','Nguyễn Văn Lâm','16022492@vnu.edu.vn','QH-2016-I/CQ-T'),(612,'16021020','Bùi Quang Linh','16021020@vnu.edu.vn','QH-2016-I/CQ-C-B'),(613,'15022848','Bùi Thị Diệu Linh','15022848@vnu.edu.vn','QH-2015-I/CQ-C-B'),(614,'16021024','Lê Quang Linh','16021024@vnu.edu.vn','QH-2016-I/CQ-C-C'),(615,'16021042','Cao Đức Mạnh','16021042@vnu.edu.vn','QH-2016-I/CQ-C-B'),(616,'16021043','Đào Tiến Mạnh','16021043@vnu.edu.vn','QH-2016-I/CQ-C-B'),(617,'16021057','Lê Hà My','16021057@vnu.edu.vn','QH-2016-I/CQ-C-B'),(618,'16022443','Kiều Thanh Nam','16022443@vnu.edu.vn','QH-2016-I/CQ-N'),(619,'16020057','Phạm Thị Oanh','16020057@vnu.edu.vn','QH-2016-I/CQ-C-B'),(620,'16021087','Phạm Văn Oánh','16021087@vnu.edu.vn','QH-2016-I/CQ-C-B'),(621,'16021090','Hoàng Văn Phú','16021090@vnu.edu.vn','QH-2016-I/CQ-C-C'),(622,'14020602','Phan Văn Phước','14020602@vnu.edu.vn','QH-2014-I/CQ-C-D'),(623,'16021409','Nguyễn Anh Phương','16021409@vnu.edu.vn','QH-2016-I/CQ-C-A-C'),(624,'15021973','Phạm Ngọc Quang','15021973@vnu.edu.vn','QH-2015-I/CQ-N'),(625,'16021102','Ngô Hồng Quân','16021102@vnu.edu.vn','QH-2016-I/CQ-C-B'),(626,'16021103','Nguyễn Hồng Quân','16021103@vnu.edu.vn','QH-2016-I/CQ-C-C'),(627,'16021121','Nguyễn Thái San','16021121@vnu.edu.vn','QH-2016-I/CQ-C-B'),(628,'16021125','Đinh Quang Sơn','16021125@vnu.edu.vn','QH-2016-I/CQ-C-B'),(629,'16021138','Nguyễn Thị Thanh Tân','16021138@vnu.edu.vn','QH-2016-I/CQ-C-B'),(630,'16021139','Nguyễn Hoàng Thạch','16021139@vnu.edu.vn','QH-2016-I/CQ-C-B'),(631,'17020039','Vương Hải Thanh','17020039@vnu.edu.vn','QH-2017-I/CQ-C-A-C'),(632,'16022450','Tưởng Công Thành','16022450@vnu.edu.vn','QH-2016-I/CQ-N'),(633,'16021145','Đỗ Việt Thắng','16021145@vnu.edu.vn','QH-2016-I/CQ-C-B'),(634,'16021163','Đỗ Mạnh Thế','16021163@vnu.edu.vn','QH-2016-I/CQ-C-B'),(635,'16021424','Bùi Thị Hoài Thu','16021424@vnu.edu.vn','QH-2016-I/CQ-C-A-C'),(636,'16021175','Lê Thị Thúy','16021175@vnu.edu.vn','QH-2016-I/CQ-C-B'),(637,'16021182','Nguyễn Đức Tiến','16021182@vnu.edu.vn','QH-2016-I/CQ-C-B'),(638,'15022850','Đỗ Xuân Toàn','15022850@vnu.edu.vn','QH-2015-I/CQ-C-D'),(639,'15021318','Nguyễn Thị Thu Trang','15021318@vnu.edu.vn','QH-2015-I/CQ-T'),(640,'16021199','Hà Công Trung','16021199@vnu.edu.vn','QH-2016-I/CQ-C-D'),(641,'16021201','Nguyễn Duy Trường','16021201@vnu.edu.vn','QH-2016-I/CQ-C-B'),(642,'16021204','Hà Văn Tú','16021204@vnu.edu.vn','QH-2016-I/CQ-C-B'),(643,'16021205','Nghiêm Anh Tú','16021205@vnu.edu.vn','QH-2016-I/CQ-C-B'),(644,'16021209','Đỗ Quốc Tuấn','16021209@vnu.edu.vn','QH-2016-I/CQ-C-B'),(645,'15021366','Nguyễn Văn Tùng','15021366@vnu.edu.vn','QH-2015-I/CQ-C-A-C'),(646,'16021229','Đặng Thị Tuyết','16021229@vnu.edu.vn','QH-2016-I/CQ-C-B'),(647,'16021235','Nguyễn Tiến Việt','16021235@vnu.edu.vn','QH-2016-I/CQ-C-B'),(648,'14020774','Đỗ Quốc Vương','14020774@vnu.edu.vn','QH-2014-I/CQ-C-A'),(649,'14020797','Nguyễn Đức Vượng','14020797@vnu.edu.vn','QH-2014-I/CQ-C-A-C'),(650,'15021834','Nguyễn Tuấn Vượng','15021834@vnu.edu.vn','QH-2015-I/CQ-T'),(651,'16020028','Nguyễn Tiến Xuân','16020028@vnu.edu.vn','QH-2016-I/CQ-C-B');
/*!40000 ALTER TABLE `sinhvien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tieuchi`
--

DROP TABLE IF EXISTS `tieuchi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tieuchi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieuchi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`tieuchi`),
  KEY `tieuchi` (`tieuchi`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tieuchi`
--

LOCK TABLES `tieuchi` WRITE;
/*!40000 ALTER TABLE `tieuchi` DISABLE KEYS */;
INSERT INTO `tieuchi` VALUES (7,'Giảng đường đáp ứng nhu cầu môn học','y','coso'),(8,'Các trang thiết bị tại giảng đường đáp ứng yêu cầu giảng dạy và học tập','y','coso'),(9,'Bạn được hỗ trợ kịp thời trong quá trình học môn này','y','monhoc'),(10,'Các tài liệu phục vụ môn học được cập nhật','y','monhoc'),(11,'Giảng viên thực hiện đầy đủ nội dung và thời lượng của môn học','y','hdgd'),(12,'Bạn hiểu những vấn đề dược truyền tải trên lớp','y','hdgd'),(13,'cơ sở vật chất','y','coso');
/*!40000 ALTER TABLE `tieuchi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=691 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (464,'admin','$2y$10$m0/hyZylZDzJLQCeYoLSs.dDnU9/JWdYpW6dblFvlG10GADudcyNq','admin','oy3zKzhl6OGmfKKWQVRM3R7GsQDMy2sHgeuEL2y3nOsp9PVhZ9y9OcvwFKzG','2018-12-29 23:23:54','2018-12-29 23:25:35'),(574,'thanhld','$2y$10$vvT1gdKMZPyxFsmXdj1WO.aQ7ug36Ph5HYGTuWXCmVTyxXsIzB6py','lecturers','7aVkaZKDA5AweFYZGg0YEQLsrou8XrgAGvP99LMZTUI3zYcV3z4wH5LDe2Og','2018-12-29 23:35:40','2018-12-29 23:48:44'),(579,'16020078','$2y$10$H9bURGAhV0OXYbpMvcyuROBerQr5qWrVg/KBIpPA26bt4StLIZTOO','student','mUov34XzvKHK5LMpkcOdYYPkfunjwxi4oI7upS8mG7KIzXEXQU9B7bmCn5jl','2018-12-29 23:36:54','2018-12-29 23:36:54'),(594,'15020881','$2y$10$.zNDQV5TrPK3CK9qNcJ5xehdeuyKbCj0.4zFG/ebTGMhz.g6kQCv.','student',NULL,'2018-12-30 01:09:45','2018-12-30 01:09:45'),(595,'15021394','$2y$10$nwyV3El8L73HhCiCxwxcYe.H5SZiR7McQolSPStADG3ZQTOw/spiS','student',NULL,'2018-12-30 01:09:46','2018-12-30 01:09:46'),(596,'15021606','$2y$10$YnXCrSfHmukJ71UT3yKLYubK7vBSqeiEVlXey5/AxiZv1t2WlKBIm','student',NULL,'2018-12-30 01:09:46','2018-12-30 01:09:46'),(597,'15021976','$2y$10$o9LZBNWCPh2ZCcbBRTHPmuc9dQFpytSv4bFSIRoZpRDul0Jw9H/U6','student',NULL,'2018-12-30 01:09:46','2018-12-30 01:09:46'),(598,'15021483','$2y$10$C1t8FDFeE/qR3GR8XIOUHOcdDAafV5jnTS1ETzkZ0tmfbVNhMap6q','student',NULL,'2018-12-30 01:09:46','2018-12-30 01:09:46'),(599,'15022841','$2y$10$1oDcBY7NEFGF3WyfXob2leP6OVhQV.tSszAJMh5EKJOn6cmdSNjj.','student',NULL,'2018-12-30 01:09:46','2018-12-30 01:09:46'),(600,'15021332','$2y$10$lKu8gpi2diPcl6aoQP//hurL.DINYXLceh8DTu6d1Xq2UWJNK51o2','student',NULL,'2018-12-30 01:09:46','2018-12-30 01:09:46'),(601,'15021849','$2y$10$QPkuz3VtvSG0MDfP6jUTuO3FMrpufbWNHFbx5dgBVo6xpzLQZ0LgS','student',NULL,'2018-12-30 01:09:46','2018-12-30 01:09:46'),(602,'15021469','$2y$10$Mn7fgaAAQ5lS1K8P84YNoeEz/TWqrj9aNOoblGksbYuIfbh4ti8Xm','student',NULL,'2018-12-30 01:09:46','2018-12-30 01:09:46'),(603,'15021359','$2y$10$kauqEpqBJt6ZpIbR.LIWtezDNOPFhpTT1Bbew26dn1tiKcFCt3wr.','student',NULL,'2018-12-30 01:09:46','2018-12-30 01:09:46'),(604,'tunghx','$2y$10$/M1G6YDxbMN8AWrkEmS9ve4LTZRpD3h0yVN3y0n82lmB0qc3CXTpW','lecturers',NULL,'2018-12-30 01:10:32','2018-12-30 01:10:32'),(605,'sonnh','$2y$10$PPTi4.flIeO4JMUXuFPh3eo9N0vVlhE8f3ZFmfvR3LR.iuxe.muMS','lecturers',NULL,'2018-12-30 01:10:32','2018-12-30 01:10:32'),(606,'thudm','$2y$10$BLxhtkKJtM64Aho9o.pJA.NcaAjf2ThdRaaRSWrCfx04Gyg5kPxye','lecturers',NULL,'2018-12-30 01:10:32','2018-12-30 01:10:32'),(607,'maitt','$2y$10$nJ3iRjJLAqHJjcu6ZEQiaefe9iSWN0mlcnIOyVUbTh5TsAjqCyu1W','lecturers',NULL,'2018-12-30 01:10:32','2018-12-30 01:10:32'),(608,'16020839','$2y$10$yrow4aFNUPGl0gHkfTVsDe/a6SOtcs7.FEh5LzSSewhSLafqtllea','student',NULL,'2018-12-30 01:11:08','2018-12-30 01:11:08'),(609,'16021554','$2y$10$V.QNJC3fTm6abPCLbPKf0O0sc.SANDFg4pWAxILafi3/q6jETlz9O','student',NULL,'2018-12-30 01:11:08','2018-12-30 01:11:08'),(610,'16020855','$2y$10$K349yV3oYastJGlx3yXyKuSP4FiCurpVXGcv/3IiUFA0nezvD1oay','student',NULL,'2018-12-30 01:11:09','2018-12-30 01:11:09'),(611,'16021369','$2y$10$ah5a8s6tlxGvgAbfuqGPmexSozNa51dbjJQlOoiCvZ3XPJCAIiPvC','student',NULL,'2018-12-30 01:11:09','2018-12-30 01:11:09'),(612,'16020897','$2y$10$vK0xCKLtX00/SISiNm0u2uvlnU/pP5aCB872wwRfhk1aGAClZUgjK','student',NULL,'2018-12-30 01:11:09','2018-12-30 01:11:09'),(613,'16020898','$2y$10$35zny2ikIP3VEd6.L0Jl.eNfNKN8.j3kBsxrL2x78wO91gATrwuru','student',NULL,'2018-12-30 01:11:09','2018-12-30 01:11:09'),(614,'16021276','$2y$10$Biz93DqOMenf5sdY8djBFOtzVmIgsqs79Lk73RKrZZ5pxbB7EO0hO','student',NULL,'2018-12-30 01:11:09','2018-12-30 01:11:09'),(615,'16022363','$2y$10$2C1kUR8vpY9BPIzAKKYw0.Lw7cka4hMCu/1PL/hiwbZloqtGgAbkm','student',NULL,'2018-12-30 01:11:09','2018-12-30 01:11:09'),(616,'16020913','$2y$10$Os10PD2lfD808hgHr2ChFOkKCHRjv9U8OAO6WQxcQYdcDthpqj20C','student',NULL,'2018-12-30 01:11:09','2018-12-30 01:11:09'),(617,'16020077','$2y$10$wgvxHfkuOhHS6ZbG0iqU4O7P7qFxFNPpr7RsDu/7MdRt5FB6kyLfG','student',NULL,'2018-12-30 01:11:09','2018-12-30 01:11:09'),(618,'16020869','$2y$10$ou/odk5QfWJbIrvYS/8qs.B36Fu6OKBmwYPHpBDiX4BUNccbWwc3.','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(619,'16020875','$2y$10$PUppjS91YCALOh4OWFPnIOdFSsMxCtx1s8W7CdzNnFnCxI/J27KoS','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(620,'16021824','$2y$10$nd.Zrd9x1Ht2QFxlluY7au9UnewC/MfDavXkCO6z5aGqTj97i0OgW','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(621,'16020030','$2y$10$uxyhW2yoR8HHSCmXUZC3cuFc7foeTvkYpBmslfHCblWiiyP0jJHey','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(622,'16022164','$2y$10$HfAnrClntXlmcQCxo54kvuIS8pts2C2rIBKh.xiRfZ.zkYY5m5No6','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(623,'16022069','$2y$10$4M5qWqJaHbiidR7OM4miJeomgFLcsK2wXrcEyEneuLlWddUPE/fMy','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(624,'16020074','$2y$10$JfJDk0EgvmQxrTGbgX97QeESXOtB/klfXx8.3PmQrmGAHF/GYA6Te','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(625,'16020934','$2y$10$/zA2wihDEr0xzarmjGSI6.ydyIgB0jii283hsniMDpaaeCLaKBw/K','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(626,'16020936','$2y$10$PKnmHeIAjFv.WBfrPmsFNeCdqDvwHPSYIxrxDennx3MkH.vwnohrO','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(627,'16022075','$2y$10$470Tu5H94WKlxsndZTqw.OyUa5kWobluIDUhE1DZn6m/vdeoql1I.','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(628,'16021577','$2y$10$vNk/ayvwUz5a8mkD55WV9.IfuuP6IIcqoqzkVqOo324Qoi89epnAe','student',NULL,'2018-12-30 01:11:10','2018-12-30 01:11:10'),(629,'16020948','$2y$10$KVT2mkAkMNIHrzWVB/wGLOLNRSKUPpPnu5cNvOCBF1MYcdF84KUNK','student',NULL,'2018-12-30 01:11:11','2018-12-30 01:11:11'),(630,'16020950','$2y$10$ZzjJu/StmIUhWJLIEJqpAOkmjY7MiF1qL8Pwmh6N2JDoTiOb94tJq','student',NULL,'2018-12-30 01:11:11','2018-12-30 01:11:11'),(631,'16020952','$2y$10$AZa/G3e4oJlY4JulVbt74eocfU6dlcLy3j4xXRL..0HAwdj4Df0/S','student',NULL,'2018-12-30 01:11:11','2018-12-30 01:11:11'),(632,'16020973','$2y$10$/JNDaTWNZTD7AyAuJoWSpuSzNFbRm37D0EAs5NQ1XRXc9n0bGlz46','student',NULL,'2018-12-30 01:11:11','2018-12-30 01:11:11'),(633,'16020974','$2y$10$eIqkEeSRGIDacORxUbRbnur4X3k1jnwKkcw749inCUDmrbJrqG49.','student',NULL,'2018-12-30 01:11:11','2018-12-30 01:11:11'),(634,'13020176','$2y$10$L3WXdl8F.i79rm.XdEF9GeJtPulj5R/brD6.Ehq7N8cHGIiiRXBF.','student',NULL,'2018-12-30 01:11:11','2018-12-30 01:11:11'),(635,'16020978','$2y$10$Y6EXzMpN3FFQBxkJNmhmIuDNOBqvrxcUnvErvI0rYhGX3/exnl/O6','student',NULL,'2018-12-30 01:11:11','2018-12-30 01:11:11'),(636,'16020980','$2y$10$vqTpzdQl25ycYOQv231FbOslAJKpF2gl..9TBzF3DWvEXcXv.1Gfq','student',NULL,'2018-12-30 01:11:11','2018-12-30 01:11:11'),(637,'16021292','$2y$10$FNqX7qA68dUHRdL3JyvNDugisJTo4X1M06u5SyNY04G/sgrhhrwES','student',NULL,'2018-12-30 01:11:12','2018-12-30 01:11:12'),(638,'16021388','$2y$10$Z30aX6Jq0sAr8gyASXDyu.zAm.DT5up9DU1.akcF/p26sO.SWC8zO','student',NULL,'2018-12-30 01:11:12','2018-12-30 01:11:12'),(639,'16022374','$2y$10$/VKJ4lnnwBKtqko/bAbq2.mFzMMa8hVrzNb58NlilpE146C.f2lSW','student',NULL,'2018-12-30 01:11:12','2018-12-30 01:11:12'),(640,'16021000','$2y$10$8ouYFdOVlXm786hdy3cajegd1yOx1YvNYfDI4WVw3dZxVX1FIMGIe','student',NULL,'2018-12-30 01:11:12','2018-12-30 01:11:12'),(641,'16020999','$2y$10$5V.1J3xZjlYwDII9YRl0Tu6PkLB3APEkOadS4jznXXhztHXjNyhii','student',NULL,'2018-12-30 01:11:12','2018-12-30 01:11:12'),(642,'15021490','$2y$10$GwNsnWZSiMO6j7HcpYyB9eSpcVpPdB.QZV5npO8mQlQ.o8luF8LEO','student',NULL,'2018-12-30 01:11:12','2018-12-30 01:11:12'),(643,'16022440','$2y$10$QCuD/wkJJq8qY5P/LK3Ieu4kJ1UPPFqel8AKLhN/DK7N2fDPmFaqS','student',NULL,'2018-12-30 01:11:12','2018-12-30 01:11:12'),(644,'15021135','$2y$10$xZQ2ACJVRBnfS.TqJUApIONwQj1xCq8Z907VlWyn8iQ2odJdGs2Ya','student',NULL,'2018-12-30 01:11:12','2018-12-30 01:11:12'),(645,'16021591','$2y$10$a7HmiFNerXjK3yBhv6OoEuRsv9fOkFQKwloHIlg6d.0fzq00eNP72','student',NULL,'2018-12-30 01:11:13','2018-12-30 01:11:13'),(646,'15021437','$2y$10$LctptDFH3Lfxi42BeDWsvOciXSJqjuiJnkTGfrRfboiEaiYlGqr42','student',NULL,'2018-12-30 01:11:13','2018-12-30 01:11:13'),(647,'16021006','$2y$10$ngXz34XawWeLg6LQ1Dcuxu2p/clB9qtSASTt2menSLsUlBl8ip8Da','student',NULL,'2018-12-30 01:11:13','2018-12-30 01:11:13'),(648,'16021008','$2y$10$HFJSo7CLrGuFIkgaxn/BU.MV/F6C5KtjgVPT1N8p0FPO5zysJ6DX2','student',NULL,'2018-12-30 01:11:13','2018-12-30 01:11:13'),(649,'16022193','$2y$10$fcIh7bqoSjr9.omIo2FC2.24kNan1kh8lggXKYmvn1r23.sH/Scl6','student',NULL,'2018-12-30 01:11:13','2018-12-30 01:11:13'),(650,'16022492','$2y$10$x428PWlcUEtHFc5jovgEPO23rye2iIJDClAmOQFvWCIYbga9pcNwO','student',NULL,'2018-12-30 01:11:13','2018-12-30 01:11:13'),(651,'16021020','$2y$10$93YodYl1hNqZIE4Pm5ca4O80ojoN0VxWZHfaz2uKY1Jo6elz29LGO','student',NULL,'2018-12-30 01:11:13','2018-12-30 01:11:13'),(652,'15022848','$2y$10$.IrafMd74P5d871CWBxiGe.sqFhWuMBPjaI.vSdYeXqovLnrlz5f.','student',NULL,'2018-12-30 01:11:13','2018-12-30 01:11:13'),(653,'16021024','$2y$10$2NZ7MeWbQRo/zZgMk6LREeboOsis0PU4Aw/zGF0vhfSc5YNuE/hne','student',NULL,'2018-12-30 01:11:13','2018-12-30 01:11:13'),(654,'16021042','$2y$10$.6Z9.kGHxYikkEFBWqHRgO4CgaaiHmwTfSED0br6V5K4qU.Y3kQMe','student',NULL,'2018-12-30 01:11:13','2018-12-30 01:11:13'),(655,'16021043','$2y$10$.5f5g/mjQ3h.UNA8oOHt1OLcUa8iIzfI5uzI.C9RndLNERe1ut9AG','student',NULL,'2018-12-30 01:11:14','2018-12-30 01:11:14'),(656,'16021057','$2y$10$apwd2oX541p/iJYdy8nz7uvJo3aDGFTDRLEF436vR0qgo.ZOKsI.q','student',NULL,'2018-12-30 01:11:14','2018-12-30 01:11:14'),(657,'16022443','$2y$10$2VK9zuNqxzUi/SNCdSNWPOKdCqara5sykfC.HS5ZsxxtKAmSKJw.6','student',NULL,'2018-12-30 01:11:14','2018-12-30 01:11:14'),(658,'16020057','$2y$10$Yw4vi1hiO05p4qULnvCQauKHYpcp3OoiRSoJLpDN7vb2nukX2uweu','student',NULL,'2018-12-30 01:11:14','2018-12-30 01:11:14'),(659,'16021087','$2y$10$sB5onmtHnP.jNAFZeNw5xu3GOiz9MSiiwaINwCVl9t5cNxkuKEoqy','student',NULL,'2018-12-30 01:11:14','2018-12-30 01:11:14'),(660,'16021090','$2y$10$lyCjb2GJBq3usAKLBMc.VuF3If0DGr4TXUiWHHDjAiuSmK2qQfcTa','student',NULL,'2018-12-30 01:11:14','2018-12-30 01:11:14'),(661,'14020602','$2y$10$N8Jenz0wRS0q8hF9UntHruvRZVA5vEevX7ZYiUghIoxhYmaq4yFBO','student',NULL,'2018-12-30 01:11:14','2018-12-30 01:11:14'),(662,'16021409','$2y$10$q/EDrvDiGxOQIdMOpOBzm.TfAKj1tIt28f00/Lnpkdyb7JPh/vf.G','student',NULL,'2018-12-30 01:11:14','2018-12-30 01:11:14'),(663,'15021973','$2y$10$x5I2Mq7WscLd8vg3i3UZe.WX59Bm2HXf3TGOlWzEoqEluqluMavgO','student',NULL,'2018-12-30 01:11:15','2018-12-30 01:11:15'),(664,'16021102','$2y$10$CWwUiG4fpAb0uNtgJfFvyeDsb9MkTHa5r0xYv64fOg4NDnzwtbwKC','student',NULL,'2018-12-30 01:11:15','2018-12-30 01:11:15'),(665,'16021103','$2y$10$SEJWMtE8L7nY3migYrCw1OpZOVQjDYlmeZ32fArvzgKur3xnun7IW','student',NULL,'2018-12-30 01:11:15','2018-12-30 01:11:15'),(666,'16021121','$2y$10$2lRmmGvsB0op/1nXWjNzd.V1VOGdzkXh.95EjbKpKMp0Snmf4QUFG','student',NULL,'2018-12-30 01:11:15','2018-12-30 01:11:15'),(667,'16021125','$2y$10$QmWBnPljw1/ud5Yw3jC5oOotir4uMgtmw0Zw2p.lqBYnpxzXb5mdO','student',NULL,'2018-12-30 01:11:15','2018-12-30 01:11:15'),(668,'16021138','$2y$10$sKhJmg20kxoO.pgLmDAAd.KNlJNwv6eFV6IUNebuNfKXM6SifYMY.','student',NULL,'2018-12-30 01:11:15','2018-12-30 01:11:15'),(669,'16021139','$2y$10$8HLkMRy2iochoE3oCWp8LeyaKBKFs0hmalCTcJcriimP7Th7FkZ9a','student',NULL,'2018-12-30 01:11:15','2018-12-30 01:11:15'),(670,'17020039','$2y$10$aC877EkDhZ/gP6rtMjzoru6tKus8dRy9otl0rQhjEvYPWGYBXu1ie','student',NULL,'2018-12-30 01:11:15','2018-12-30 01:11:15'),(671,'16022450','$2y$10$TNdTtuJvhegcF067Txv2ouVVFHcMmH6k7q070fKWES1dBV7HfXOKO','student',NULL,'2018-12-30 01:11:15','2018-12-30 01:11:15'),(672,'16021145','$2y$10$PTznh9W.kIYyd2K4WdzwoeLMGlZZw79uFg.ivgxtdOfP2jRleLn3a','student',NULL,'2018-12-30 01:11:15','2018-12-30 01:11:15'),(673,'16021163','$2y$10$UXcqRVZ76KAY533RmpTJke2mttiHlk70Z9sXHL7fjj6tActAbsB4S','student',NULL,'2018-12-30 01:11:16','2018-12-30 01:11:16'),(674,'16021424','$2y$10$qXfmODauYotU7ZXJz8HdqOd/J0PECLzewobvupITn8MYcDYhxVMpa','student',NULL,'2018-12-30 01:11:16','2018-12-30 01:11:16'),(675,'16021175','$2y$10$reeeXyNppZ8HfG.E00Djh.RStCW5x0YTprYC3.95I79QBddqzkdAW','student',NULL,'2018-12-30 01:11:16','2018-12-30 01:11:16'),(676,'16021182','$2y$10$KAB6IgWlgDoYFhTnn7wk/ebLOkeCvidlaGvidrLHj.jQ4Njh4oM..','student',NULL,'2018-12-30 01:11:16','2018-12-30 01:11:16'),(677,'15022850','$2y$10$K6PWsD2M5iUiK.l7TEyeDei0/c3UWJej0wKVsCtBvDwgivGFhPNNm','student',NULL,'2018-12-30 01:11:16','2018-12-30 01:11:16'),(678,'15021318','$2y$10$IOb1BVbF5kcM31/NN0gLMeLu9oF79MjO1EEFVvQEejrLd4I7yMEn.','student',NULL,'2018-12-30 01:11:16','2018-12-30 01:11:16'),(679,'16021199','$2y$10$/i9LqWzCHQeiQXxrwidViuzFWsEQ042d09OCpkgbAy/DPOIDDiUBO','student',NULL,'2018-12-30 01:11:16','2018-12-30 01:11:16'),(680,'16021201','$2y$10$hisQEbya8Yr0mLa8jqAb/ektvIE9tYLYHnI8zHryntYsU7sC24ejC','student',NULL,'2018-12-30 01:11:16','2018-12-30 01:11:16'),(681,'16021204','$2y$10$re6I78xf1f1Woj5mxDGs4elLDnN/vhgtoKbGEgWWsBj4iUtk8LlhS','student',NULL,'2018-12-30 01:11:16','2018-12-30 01:11:16'),(682,'16021205','$2y$10$/ylT37FiNEA08UhcgGOrg.6FeYizfQ1Et4rGlwl.H1d4zQsIT.b8y','student',NULL,'2018-12-30 01:11:17','2018-12-30 01:11:17'),(683,'16021209','$2y$10$H3c6AvxJCyWaVUa7ZiI/We6fKeCTTxHUm4wj2vAGVGeof67a8fBmi','student',NULL,'2018-12-30 01:11:17','2018-12-30 01:11:17'),(684,'15021366','$2y$10$0OhznR2w2TkasBahN5k6hew9NJprTGtYGTJbrG.bRWP.ciqcZiXvm','student',NULL,'2018-12-30 01:11:17','2018-12-30 01:11:17'),(685,'16021229','$2y$10$VLnIfzPw1nwy8M9hjD5.SO9aBiWeAlh30SAMbx/WTTVOdHTQsuOba','student',NULL,'2018-12-30 01:11:17','2018-12-30 01:11:17'),(686,'16021235','$2y$10$WgC8gGgIOfnNNb4blXWQqe7lbkMtHAbI2W/Zko/v.DNPXYvqpvhZe','student',NULL,'2018-12-30 01:11:17','2018-12-30 01:11:17'),(687,'14020774','$2y$10$XsZA/G87VWe5vwcnc7ZM2.UuiLK0u8.EJ79DBxN14nWvifhnnaST2','student',NULL,'2018-12-30 01:11:17','2018-12-30 01:11:17'),(688,'14020797','$2y$10$JWoxL0cgB4ARazu0so.VF.cIgBb2hCnw.JQURvB3BFlY8xi3ngpe2','student',NULL,'2018-12-30 01:11:17','2018-12-30 01:11:17'),(689,'15021834','$2y$10$njtVkL/Qo6zsTi/6H8qSpOJ9u.qxmxOYUcjCd70fsyzsMrWJBcEuq','student',NULL,'2018-12-30 01:11:17','2018-12-30 01:11:17'),(690,'16020028','$2y$10$8vpiU/urNFBavYkLsj66newmGcga9Yc1c8rksZFkbn.eNJ2C7zGqS','student',NULL,'2018-12-30 01:11:17','2018-12-30 01:11:17');
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

-- Dump completed on 2019-06-25 12:26:38
