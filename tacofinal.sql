/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.4.24-MariaDB : Database - tacosant_2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tacosant_2` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `tacosant_2`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`slug`,`status`,`created_at`,`updated_at`) values (1,'Nat Mull','nat-mull','1','2021-03-02 22:06:40','2021-03-10 05:32:16'),(2,'Kathleen VonRueden','kathleen-vonrueden','1','2021-03-02 22:06:40','2021-03-02 22:18:28'),(3,'Kailyn O\'Connell','zachery-purdy','1','2021-03-02 22:06:40','2021-03-02 22:06:40'),(4,'Mrs. Antonia','mrs-antonia','1','2021-03-02 22:06:40','2021-03-02 22:13:27'),(5,'Dr. Miles Hansen MD','dr-ronny-rempel','1','2021-03-02 22:06:40','2021-03-02 22:06:40'),(6,'Jarred Hane','miss-bailee-douglas-iv','1','2021-03-02 22:06:40','2021-03-02 22:06:40'),(7,'Bernadette Bashirian','ana-mitchell','1','2021-03-02 22:06:40','2021-03-02 22:06:40'),(8,'Prof. Elenora Fritsch','sadie-ferry','1','2021-03-02 22:06:40','2021-03-02 22:06:40'),(9,'Marjolaine Feest I','jakayla-abbott-iv','1','2021-03-02 22:06:40','2021-03-02 22:06:40'),(10,'Maximus Prices','maximus-prices','1','2021-03-02 22:06:40','2021-03-23 17:25:52');

/*Table structure for table `clients` */

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article` int(11) DEFAULT NULL,
  `nif` int(11) DEFAULT NULL,
  `nis` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clients` */

insert  into `clients`(`id`,`client_name`,`phone`,`address`,`description`,`rc`,`article`,`nif`,`nis`,`created_at`,`updated_at`) values (1,'Anonymous','0000000000','Mila','Nothing','1000000',1000000,1000000,1000000,'2021-03-23 05:16:54','2021-03-23 05:16:54');

/*Table structure for table `costumers` */

DROP TABLE IF EXISTS `costumers`;

CREATE TABLE `costumers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `costumers` */

insert  into `costumers`(`id`,`title`,`status`) values (1,'hola','mundo');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_category_id_foreign` (`category_id`),
  CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `items` */

insert  into `items`(`id`,`category_id`,`name`,`description`,`price`,`image`,`created_at`,`updated_at`) values (1,2,'Teagan Carroll','Would YOU like cats if you were never even spoke to Time',3,'2021-03-24-605ad138ba69c.png','2021-03-02 22:06:40','2021-03-24 05:42:16'),(2,2,'Cornell Upton PhD','Would YOU like cats if you were never even spoke to Time',1,'2021-03-24-605ad432875de.png','2021-03-02 22:06:40','2021-03-24 05:54:58'),(3,2,'Mrs. Anne Smitham PhD','Would YOU like cats if you were never even spoke to Time',2,'2021-03-24-605ad7d8b8b03.png','2021-03-02 22:06:40','2021-03-24 06:10:32'),(4,7,'Dr. Alize Glover','Would YOU like cats if you were never even spoke to Time',5,'2021-03-24-605ad85c063bc.png','2021-03-02 22:06:40','2021-03-24 06:12:44'),(5,6,'Mr. Nasir Conroy','Would YOU like cats if you were never even spoke to Time',3,'2021-03-24-605ad8860718a.png','2021-03-02 22:06:40','2021-03-24 06:13:26'),(6,6,'Cassie Hackett','Would YOU like cats if you were never even spoke to Time',5,'1.jpg','2021-03-02 22:06:40','2021-03-02 22:06:40'),(7,1,'Okey Bartoletti','Would YOU like cats if you were never even spoke to Time',4,'10.jpg','2021-03-02 22:06:40','2021-03-24 05:41:58'),(8,8,'Else Bailey','Would YOU like cats if you were never even spoke to Time',5,'1.jpg','2021-03-02 22:06:40','2021-03-02 22:06:40'),(9,9,'Conrad Goldner','Would YOU like cats if you were never even spoke to Time',5,'9.jpg','2021-03-02 22:06:40','2021-03-02 22:06:40'),(10,10,'Dr. Arjun Nikolaus','Would YOU like cats if you were never even spoke to Time',4,'3.jpg','2021-03-02 22:06:40','2021-03-02 22:06:40');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_03_03_043301_create_roles_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `product_sale` */

DROP TABLE IF EXISTS `product_sale`;

CREATE TABLE `product_sale` (
  `product_id` int(20) unsigned NOT NULL,
  `quantity` int(20) DEFAULT NULL,
  `sale_id` int(20) unsigned NOT NULL,
  KEY `product_sale_product_id_foreign` (`product_id`),
  KEY `product_sale_sale_id_foreign` (`sale_id`),
  CONSTRAINT `product_sale_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_sale_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_sale` */

insert  into `product_sale`(`product_id`,`quantity`,`sale_id`) values (4,1,8),(4,1,9),(3,1,9),(4,1,11),(3,1,11),(2,1,11),(4,1,13),(3,1,13),(4,1,14),(1,1,15),(4,1,15),(4,1,16),(3,1,16),(3,1,17),(4,1,18),(3,1,19),(4,1,20),(4,2,21),(3,1,21),(4,1,22),(3,1,22),(4,1,23),(3,1,23),(4,4,24),(3,1,24),(2,1,24),(1,1,24);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_price` double(8,2) DEFAULT NULL,
  `sale_price` double(8,2) DEFAULT NULL,
  `min_stock` int(11) DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `stock` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`category_id`,`product_name`,`description`,`image`,`purchase_price`,`sale_price`,`min_stock`,`status`,`stock`,`created_at`,`updated_at`) values (1,5,'Teagan Carroll','Would YOU like cats if you were never even spoke to Time','2021-03-25-605c18c75d1c5.png',20.00,30.00,NULL,'1',18,'2021-03-02 22:06:40','2021-04-01 03:47:09'),(2,10,'Cornell Upton PhD','Would YOU like cats if you were never even spoke to Time','2021-03-25-605c244d87e4b.png',30.00,40.00,NULL,'1',8,'2021-03-02 22:06:40','2021-04-01 03:47:09'),(3,3,'Mrs. Anne Smitham PhD','Would YOU like cats if you were never even spoke to Time','2021-03-23-605a24ec73697.png',40.00,50.00,NULL,'1',10,'2021-03-02 22:06:40','2021-04-01 03:47:08'),(4,4,'Dr. Alize Glover','Would YOU like cats if you were never even spoke to Time','2021-03-23-605a24ec73697.png',50.00,60.00,NULL,'1',3,'2021-03-02 22:06:40','2021-04-01 03:47:08'),(5,6,'Mr. Nasir Conroy','Would YOU like cats if you were never even spoke to Time','2021-03-25-605c160dbc0a2.png',60.00,70.00,NULL,'1',30,'2021-03-02 22:06:40','2021-03-25 04:48:13'),(6,2,'Cassie Hackett','Would YOU like cats if you were never even spoke to Time','2021-03-25-605c15f64b633.png',70.00,80.00,NULL,'1',10,'2021-03-02 22:06:40','2021-03-25 04:47:50'),(7,10,'Okey Bartoletti','Would YOU like cats if you were never even spoke to Time','2021-03-24-605ac9575b241.png',80.00,90.00,NULL,'1',20,'2021-03-02 22:06:40','2021-03-24 05:08:39'),(8,3,'Else Bailey','Would YOU like cats if you were never even spoke to Time','2021-03-24-605ac8f02c86e.png',90.00,100.00,NULL,'1',10,'2021-03-02 22:06:40','2021-03-24 05:06:56'),(9,1,'Conrad Goldner','Would YOU like cats if you were never even spoke to Time','2021-03-24-605ac6d54419a.png',100.00,110.00,NULL,'1',20,'2021-03-02 22:06:40','2021-03-24 04:57:57');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`created_at`,`updated_at`) values (1,'admin',NULL,NULL),(2,'user',NULL,NULL);

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number_sale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `discount` double NOT NULL,
  `iva_sale` double DEFAULT NULL,
  `total_amount` double NOT NULL,
  `status` enum('paid','nopaid','debt') COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_client_id_foreign` (`client_id`),
  CONSTRAINT `sales_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sales` */

insert  into `sales`(`id`,`number_sale`,`total`,`discount`,`iva_sale`,`total_amount`,`status`,`client_id`,`created_at`,`updated_at`) values (1,'230088',30,0,4.8,34.8,'paid',1,'2021-03-27 04:07:02','2021-03-27 04:07:02'),(2,'364906',60,0,9.6,69.6,'paid',1,'2021-03-27 04:12:21','2021-03-27 04:12:21'),(3,'434320',90,0,14.4,104.4,'paid',1,'2021-03-27 04:23:48','2021-03-27 04:23:48'),(4,'578886',30,0,4.8,34.8,'paid',1,'2021-03-27 04:52:25','2021-03-27 04:52:25'),(5,'544442',330,0,0,330,'paid',1,'2021-03-27 05:02:59','2021-03-27 05:02:59'),(6,'431204',110,0,0,110,'paid',1,'2021-03-27 05:12:15','2021-03-27 05:12:15'),(7,'551142',230,0,36.800000000000004,266.8,'paid',1,'2021-03-27 06:31:24','2021-03-27 06:31:24'),(8,'992489',60,0,9.6,69.6,'paid',1,'2021-03-27 06:32:57','2021-03-27 06:32:57'),(9,'752045',110,0,17.6,127.6,'paid',1,'2021-03-27 06:33:41','2021-03-27 06:33:41'),(10,'880782',160,0,25.6,185.6,'paid',1,'2021-03-27 06:35:30','2021-03-27 06:35:30'),(11,'582805',150,0,24,174,'paid',1,'2021-03-27 06:46:28','2021-03-27 06:46:28'),(12,'939115',170,0,27.2,197.2,'paid',1,'2021-03-27 06:50:56','2021-03-27 06:50:56'),(13,'508385',110,0,17.6,127.6,'paid',1,'2021-03-27 06:53:09','2021-03-27 06:53:09'),(14,'492134',60,0,9.6,69.6,'paid',1,'2021-03-27 06:56:20','2021-03-27 06:56:20'),(15,'697327',90,0,14.4,104.4,'paid',1,'2021-03-27 07:01:04','2021-03-27 07:01:04'),(16,'525671',110,0,17.6,127.6,'paid',1,'2021-03-27 07:02:18','2021-03-27 07:02:18'),(17,'984294',50,0,8,58,'paid',1,'2021-03-27 07:05:27','2021-03-27 07:05:27'),(18,'718985',60,0,9.6,69.6,'paid',1,'2021-03-27 07:06:43','2021-03-27 07:06:43'),(19,'776553',50,0,8,58,'paid',1,'2021-03-27 07:08:33','2021-03-27 07:08:33'),(20,'991479',60,0,9.6,69.6,'paid',1,'2021-03-27 07:14:05','2021-03-27 07:14:05'),(21,'380315',170,0,27.2,197.2,'paid',1,'2021-03-27 07:14:30','2021-03-27 07:14:30'),(22,'942812',110,0,17.6,127.6,'paid',1,'2021-03-27 07:15:44','2021-03-27 07:15:44'),(23,'914036',110,0,17.6,127.6,'paid',1,'2021-03-27 07:16:26','2021-03-27 07:16:26'),(24,'214660',180,0,28.8,208.8,'paid',1,'2021-04-01 03:47:07','2021-04-01 03:47:07');

/*Table structure for table `sliders` */

DROP TABLE IF EXISTS `sliders`;

CREATE TABLE `sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sliders` */

insert  into `sliders`(`id`,`title`,`sub_title`,`image`,`status`,`created_at`,`updated_at`) values (1,'Voluptatem eaque impedit sint iusto. Quidem at explicabo reiciendis. Et temporibus voluptatibus blanditiis rerum cum reprehenderit. Tempora molestiae soluta enim.','Would YOU like cats if you were never even spoke to Time','2021-03-12-604bad19ce0ca.jpg','0','2021-03-02 22:06:40','2022-08-10 21:51:00'),(11,'sdsd','dsd','2021-03-12-604bbd6cd3307.jpg','1','2021-03-11 22:46:27','2021-03-16 18:31:53'),(12,'sds','sdsd','2021-03-16-605136bfd62e5.jpg','0','2021-03-16 22:52:47','2021-03-16 22:52:47'),(14,'cgghh','khjkjhk','2021-03-16-6051374facd81.jpg','0','2021-03-16 22:55:11','2021-03-16 22:55:11'),(15,'jgtyjghjhg','dsfsf','2021-03-16-60513766e68b9.jpg','0','2021-03-16 22:55:34','2021-03-16 22:55:34'),(17,'vvcxdffdsfsfbbvcvb','vbcvbcvbfd','2021-03-16-605137d8451ef.jpg','0','2021-03-16 22:57:28','2021-03-16 22:57:28'),(21,'Et atque minima omni','Maxime sunt ducimus','2021-03-18-6052b79c0adba.png','1','2021-03-18 02:14:52','2021-03-19 18:40:56'),(24,'Aut et cupiditate qu','nigggaaaaa','2021-03-18-6052b9aa2b867.gif','1','2021-03-18 02:23:38','2021-03-19 22:43:41'),(34,'Nostrud omnis quod s','Necessitatibus quibu','2021-03-19-60553940d7fc1.jpg','0','2021-03-19 23:52:32','2021-03-19 23:52:32'),(36,'Dolore dolore enim n','A sunt consectetur','2021-03-19-60553a8aed6a6.jpg','0','2021-03-19 23:58:02','2021-03-22 23:43:49'),(37,'Eveniet do quos duc','Proident rem elit','2021-03-19-60553a9d961df.jpg','1','2021-03-19 23:58:21','2021-03-20 00:02:44'),(39,'Magnam laboriosam m','Neque qui cumque nos','2021-03-22-6058ddb43fab1.png','1','2021-03-22 18:11:00','2021-03-22 18:27:46');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`role_id`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'Octavia Vaughan',2,'yao.rock.64@gmail.com',NULL,'$2y$10$47.bvsdwMFGSZ9XszWAqMesbRtyxVlLi5h2MlhzuojJO7vK.QnrZ.',NULL,'2021-03-03 06:11:11','2021-03-03 06:11:11'),(3,'Yen Eaton',2,'qijykupe@mailinator.com',NULL,'$2y$10$lrxN8HHzQWXzDT0YS2wd1ubftIpGGwCRCwPITM4/nfFtsUcyZXa8a',NULL,'2021-03-03 06:23:52','2021-03-03 06:23:52'),(4,'Hector Miguel Robles',1,'al221711757@gmail.com',NULL,'$2y$10$47.bvsdwMFGSZ9XszWAqMesbRtyxVlLi5h2MlhzuojJO7vK.QnrZ.','PVjiA2vaNS8inytShAI6hpNvDR8TbguhWQoLWwWYjJqBYHxZsxozXyfEoOw6','2021-03-03 06:24:12','2021-03-09 22:55:47'),(5,'fdsffds',2,'dfd@gmail.com',NULL,'$2y$10$wv5dKWhkAG/TZ3GH8JcYZOk39Yygd41lgcFo90IjJxWphO5KEdwKi',NULL,'2021-03-09 19:02:13','2021-03-09 19:02:13'),(6,'Alden Parker',2,'himufom@mailinator.com',NULL,'$2y$10$L17qmIXWYeg2R/Wh9paEO.OVGWU8XQ/x.bSO7BRIoo55XYHMSs3Ma',NULL,'2021-03-09 19:02:29','2021-03-09 19:02:29');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
