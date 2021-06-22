/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.17-MariaDB : Database - dbecommerce
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbecommerce` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `dbecommerce`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `divisi` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`name`,`number`,`image`,`email`,`email_verified_at`,`password`,`role_id`,`status`,`created_at`,`updated_at`,`divisi`,`address`,`fullname`) values 
(2,'LEXADEV','88888','LEXADEV.jpg','lexadev@lexadev.com','2021-03-29 15:30:40','$2y$10$6eU01laMSLjDc2qadiQvjeDzkd29U.Zt9RJ7JebHaStn3OnAn8sCO',2,1,'2021-03-29 15:30:40','2021-04-07 01:30:57','WEBDEV','BANDUNG','ADMIN LEXADEV'),
(5,'surya','7777777','surya.jpg','surya@gmail.com',NULL,'$2y$10$KH6IPo1UJ9nYgNwrOSaUPOlhtRhOOSouslJwZ/6kcUdWsIUo51kWy',10,0,'2021-04-03 09:39:08','2021-05-03 16:14:53','IT Support',NULL,NULL);

/*Table structure for table `attribute_options` */

DROP TABLE IF EXISTS `attribute_options`;

CREATE TABLE `attribute_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_options_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `attribute_options` */

/*Table structure for table `attributes` */

DROP TABLE IF EXISTS `attributes`;

CREATE TABLE `attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_required` tinyint(1) DEFAULT 0,
  `is_unique` tinyint(1) DEFAULT 0,
  `is_filterable` tinyint(1) DEFAULT 0,
  `is_configurable` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `attributes` */

insert  into `attributes`(`id`,`code`,`name`,`type`,`validation`,`is_required`,`is_unique`,`is_filterable`,`is_configurable`,`created_at`,`updated_at`) values 
(4,'dsfsd','masterdata','3','number',0,0,1,1,'2021-06-22 17:02:07','2021-06-22 17:02:07');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`banner`,`slug`,`status`,`created_at`,`updated_at`) values 
(4,'Notebook','banner-1622439837.jpg','notebook',1,'2021-05-31 12:43:58','2021-05-31 12:43:58'),
(5,'PC','banner-1622439851.jpg','pc',1,'2021-05-31 12:44:11','2021-05-31 12:44:11'),
(7,'Pakaian Wanita','banner-1622440415.jpg','pakaian-wanita',1,'2021-05-31 12:53:35','2021-05-31 12:53:49');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

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

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2021_03_24_035745_create_admins_table',1),
(6,'2021_03_29_054406_create_items_table',1),
(7,'2021_03_29_145730_create_roles_table',1),
(8,'2021_03_29_145832_create_permissions_table',1),
(9,'2021_04_05_100859_create_profiles_table',2),
(11,'2021_04_07_065322_create_user_menu',3),
(12,'2021_04_07_065322_create_user_sub_menu',4),
(13,'2019_12_14_000001_create_personal_access_tokens_table',5),
(16,'2021_03_28_041110_create_categories_table',6),
(17,'2021_05_28_115816_create_products_table',7),
(18,'2021_05_28_124856_create_attributes_table',8),
(19,'2021_05_28_125247_create_product_attributes_values_table',9),
(20,'2021_05_28_130322_create_product_inventories_table',10),
(21,'2021_05_28_131636_create_product_categories_table',11),
(22,'2021_05_28_132005_create_product_images_table',12),
(23,'2021_06_22_130004_create_attribute_options_table',13);

/*Table structure for table `parmissions` */

DROP TABLE IF EXISTS `parmissions`;

CREATE TABLE `parmissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parmission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `parmissions` */

insert  into `parmissions`(`id`,`parmission`,`role_id`,`created_at`,`updated_at`) values 
(3,'{\"System Management\":\"1\",\"Master Data\":\"1\",\"Role\":{\"add\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\",\"list\":\"1\"},\"Parmission\":{\"add\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\",\"list\":\"1\"},\"Menu\":{\"add\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\",\"list\":\"1\"},\"User\":{\"add\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\",\"list\":\"1\"},\"Category\":{\"add\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\",\"list\":\"1\"},\"Product\":{\"add\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\",\"list\":\"1\"},\"Attribute\":{\"add\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\",\"list\":\"1\"}}',2,'2021-04-03 03:38:50','2021-06-22 13:25:44'),
(11,'{\"System Management\":\"1\",\"Role\":{\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"list\":\"1\"},\"Parmission\":{\"list\":\"1\"},\"User\":{\"list\":\"1\"}}',10,'2021-05-03 16:44:47','2021-05-07 12:26:36');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `external_id` varchar(100) NOT NULL,
  `payment_channel` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`external_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `payments` */

insert  into `payments`(`external_id`,`payment_channel`,`email`,`price`,`status`,`create_at`,`update_at`) values 
('va-1620393464','Virtual Account','lexalexadevcom',120000,0,NULL,NULL);

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

insert  into `personal_access_tokens`(`id`,`tokenable_type`,`tokenable_id`,`name`,`token`,`abilities`,`last_used_at`,`created_at`,`updated_at`) values 
(10,'App\\Models\\User',1,'token','d177c79ff8e0717616449b451ebdc2986a8fbb6e399965171b8b81da8dddf206','[\"*\"]','2021-05-17 11:19:29','2021-05-11 14:16:42','2021-05-17 11:19:29'),
(11,'App\\Models\\User',1,'token','dba4c311a494ad053bfbf5a0cda88a8a2a450a851432c12036f453db890e3c6a','[\"*\"]',NULL,'2021-05-17 09:32:15','2021-05-17 09:32:15');

/*Table structure for table `product_attributes_values` */

DROP TABLE IF EXISTS `product_attributes_values`;

CREATE TABLE `product_attributes_values` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `attribute_id` bigint(20) unsigned NOT NULL,
  `text_value` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `integer_value` int(11) DEFAULT NULL,
  `fload_value` decimal(8,2) DEFAULT NULL,
  `datetime_value` datetime DEFAULT NULL,
  `date_value` date DEFAULT NULL,
  `json_value` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attributes_values_product_id_foreign` (`product_id`),
  KEY `product_attributes_values_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `product_attributes_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_attributes_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product_attributes_values` */

/*Table structure for table `product_categories` */

DROP TABLE IF EXISTS `product_categories`;

CREATE TABLE `product_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_categories_product_id_foreign` (`product_id`),
  KEY `product_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `product_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product_categories` */

/*Table structure for table `product_images` */

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`path`,`created_at`,`updated_at`) values 
(57,27,'20210618150005-1589778877_folder-icons.png','2021-06-18 15:00:05','2021-06-18 15:00:05'),
(58,27,'20210618150006-44719055325_76829d8ddc_b.jpg','2021-06-18 15:00:06','2021-06-18 15:00:06'),
(59,27,'20210618150006-COVER-756x394.jpg','2021-06-18 15:00:06','2021-06-18 15:00:06'),
(60,27,'20210618150006-CYBERPOWERPC-Gamer-Xtreme-GXiVR8060A8.jpg','2021-06-18 15:00:06','2021-06-18 15:00:06'),
(61,27,'20210618150006-karl-pawlowicz-QUHuwyNgSA0-unsplash.jpg','2021-06-18 15:00:06','2021-06-18 15:00:06'),
(62,28,'20210622113449-Screenshot from 2021-01-19 20-23-36.png','2021-06-22 11:34:49','2021-06-22 11:34:49'),
(63,28,'20210622113449-Screenshot from 2021-01-19 20-23-42.png','2021-06-22 11:34:49','2021-06-22 11:34:49'),
(64,28,'20210622113449-Screenshot from 2021-02-11 20-42-19.png','2021-06-22 11:34:49','2021-06-22 11:34:49'),
(65,28,'20210622113450-Screenshot from 2021-02-11 20-45-44.png','2021-06-22 11:34:50','2021-06-22 11:34:50'),
(66,28,'20210622113450-Screenshot from 2021-02-19 21-31-45.png','2021-06-22 11:34:50','2021-06-22 11:34:50'),
(67,28,'20210622113450-Screenshot from 2021-03-15 12-08-24.png','2021-06-22 11:34:50','2021-06-22 11:34:50');

/*Table structure for table `product_inventories` */

DROP TABLE IF EXISTS `product_inventories`;

CREATE TABLE `product_inventories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `product_attribute_value_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_inventories_product_id_foreign` (`product_id`),
  KEY `product_inventories_product_attribute_value_id_foreign` (`product_attribute_value_id`),
  CONSTRAINT `product_inventories_product_attribute_value_id_foreign` FOREIGN KEY (`product_attribute_value_id`) REFERENCES `product_attributes_values` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product_inventories` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned NOT NULL,
  `text_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `banner` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_admin_id_foreign` (`admin_id`),
  CONSTRAINT `products_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`sku`,`name`,`slug`,`price`,`weight`,`width`,`height`,`length`,`category_id`,`admin_id`,`text_description`,`description`,`status`,`banner`,`created_at`,`updated_at`) values 
(27,'AB0004','PC Buildup','pc-buildup',70000.00,7.00,100.00,100.00,100.00,5,2,'Raw denim you probably haven\'t heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus purus sed venenatis. Vivamus varius metus quam, id dapibus velit mattis eu. Praesent et semper risus. Vestibulum erat erat, condimentum at elit at, bibendum placerat orci. Nullam gravida velit mauris, in pellentesque urna pellentesque viverra. Nullam non pellentesque justo, et ultricies neque. Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque interdum efficitur nunc vitae consectetur. Suspendisse venenatis, tortor non convallis interdum, urna mi molestie eros, vel tempor justo lacus ac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel metus.',1,'banner-1624003204.jpg','2021-06-18 15:00:04','2021-06-18 15:00:04'),
(28,'AB0004','surya','surya',80000.00,0.20,100.00,100.00,100.00,7,2,'sdfdsf','fsdfsdf',1,'banner-1624336489.png','2021-06-22 11:34:49','2021-06-22 11:34:49');

/*Table structure for table `profiles` */

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `profiles` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`created_at`,`updated_at`) values 
(2,'Admin','2021-03-31 08:50:42','2021-03-31 08:50:42'),
(10,'Author','2021-04-07 04:57:07','2021-04-07 04:57:23');

/*Table structure for table `user_menu` */

DROP TABLE IF EXISTS `user_menu`;

CREATE TABLE `user_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_left` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_right` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6379 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_menu` */

insert  into `user_menu`(`id`,`menu`,`icon_left`,`icon_right`,`created_at`,`updated_at`,`order`) values 
(1,'System Management','fas fa-universal-access','fas fa-star',NULL,'2021-05-28 12:43:45',1),
(2,'Master Data','fas fa-database','fas fa-star','2021-04-23 17:41:56','2021-05-28 12:30:31',NULL);

/*Table structure for table `user_sub_menu` */

DROP TABLE IF EXISTS `user_sub_menu`;

CREATE TABLE `user_sub_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_sub_menu_menu_id_foreign` (`menu_id`),
  CONSTRAINT `user_sub_menu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_sub_menu` */

insert  into `user_sub_menu`(`id`,`menu_id`,`title`,`slug`,`icon`,`is_active`,`created_at`,`updated_at`) values 
(1,1,'Role','/role/show-all-role','far fa-circle text-danger nav-icon',1,NULL,NULL),
(2,1,'Parmission','/parmission/show-all-parmission','far fa-circle text-danger nav-icon',1,NULL,NULL),
(3,1,'Menu','/menu/show-all-menu','far fa-circle text-danger nav-icon',1,'2021-04-23 12:19:54','2021-04-23 12:19:54'),
(4,1,'User','/user/show-all-user','far fa-circle text-danger nav-icon',1,'2021-04-27 09:28:41','2021-05-17 12:23:03'),
(5,2,'Category','/category/show-all-category','fas fa-hand-point-right',1,'2021-04-23 17:42:50','2021-05-28 12:33:06'),
(14,2,'Product','/product/show-all-product','fab fa-product-hunt',1,'2021-05-28 13:30:16','2021-05-28 13:30:16'),
(15,2,'Attribute','/attribute/show-all-attribute','fab fa-creative-commons-by',1,'2021-06-22 13:25:26','2021-06-22 14:31:32');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'dev','dev@lexadev.com',NULL,'$2y$10$oBw7ASV7M1GUypVnWbDKoOFyc413nHT0sdulcb.MlEcHI3ll12d1q',NULL,'2021-05-11 13:18:26','2021-05-11 13:18:26');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
