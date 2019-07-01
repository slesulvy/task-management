/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 10.3.15-MariaDB : Database - taskmanager
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`taskmanager` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `taskmanager`;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
  -- UNIQUE KEY `cate_name_unique` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_name`,`created_by`,`status`,`created_at`,`updated_at`) values 
(1,'Real Estate & Properties',0,1,NULL,NULL),
(2,'Job Recruitement & Agency',0,1,NULL,NULL),
(13,'Ecommerce & Products',0,1,'2019-06-20 03:39:56','2019-06-20 03:39:56'),
(17,'Information Website & Design',0,1,'2019-06-20 03:42:11','2019-06-20 03:42:11'),
(18,'Medical',0,1,'2019-06-20 07:27:46','2019-06-20 07:27:46'),
(19,'Transprt & Logistics',0,1,'2019-06-21 02:25:06','2019-06-21 02:25:06'),
(20,'Custom Software',0,1,'2019-06-24 06:29:48','2019-06-24 06:29:48');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_06_18_025151_create_tasks_table',2),
(4,'2019_06_18_025357_create_taskdoing_table',2),
(5,'2019_06_18_025430_create_taskhandlers_table',2),
(6,'2019_06_18_025506_create_taskdone_table',2),
(7,'2019_06_18_025604_create_taskcomments_table',2),
(8,'2019_06_18_025817_create_sys_role_table',2),
(9,'2019_06_18_025904_create_sys_permission_table',2),
(10,'2019_06_18_025934_create_sys_rolepermission_table',2),
(11,'2019_06_18_031014_create_projects_table',2),
(12,'2019_06_18_040018_create_category_table',2);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `project_member` */

DROP TABLE IF EXISTS `project_member`;

CREATE TABLE `project_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `assign_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unigue_project_user` (`project_id`,`user_id`),
  KEY `project_user_key` (`project_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

/*Data for the table `project_member` */

insert  into `project_member`(`id`,`project_id`,`user_id`,`assign_by`,`removed_by`,`status`,`created_at`,`updated_at`) values 
(56,29,1,1,0,1,'2019-06-28 03:34:00','2019-06-28 03:34:00'),
(57,29,3,1,0,1,'2019-06-28 03:34:25','2019-06-28 03:34:25'),
(58,29,7,1,0,1,'2019-06-28 03:39:23','2019-06-28 03:39:23'),
(59,29,4,1,0,1,'2019-06-28 03:39:25','2019-06-28 03:39:25'),
(60,29,2,1,0,1,'2019-06-28 03:39:28','2019-06-28 03:39:28');

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `project_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `projectname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `closed_by` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `projects` */

insert  into `projects`(`project_id`,`category_id`,`projectname`,`description`,`created_by`,`status`,`created_at`,`updated_at`,`closed_by`) values 
(29,20,'PCA Project','PCA Project description goes here',1,1,'2019-06-28 03:34:00','2019-06-28 03:37:38',1);

/*Table structure for table `sys_permission` */

DROP TABLE IF EXISTS `sys_permission`;

CREATE TABLE `sys_permission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sys_permission` */

/*Table structure for table `sys_role` */

DROP TABLE IF EXISTS `sys_role`;

CREATE TABLE `sys_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sys_role` */

insert  into `sys_role`(`id`,`role_name`,`description`,`created_at`,`updated_at`,`status`) values 
(1,'Administrator','Full Cntrol','2019-06-20 04:36:31','2019-06-20 04:36:31',1),
(2,'Normal User','Normal User','2019-06-20 04:44:09','2019-06-20 04:57:26',0);

/*Table structure for table `sys_rolepermission` */

DROP TABLE IF EXISTS `sys_rolepermission`;

CREATE TABLE `sys_rolepermission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sys_rolepermission` */

/*Table structure for table `taskcomments` */

DROP TABLE IF EXISTS `taskcomments`;

CREATE TABLE `taskcomments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comments` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `comment_key` (`task_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `taskcomments` */

insert  into `taskcomments`(`id`,`task_id`,`user_id`,`comments`,`created_at`,`updated_at`) values 
(2,92,1,'Hello','2019-06-27 15:10:18','2019-06-27 15:10:18'),
(3,95,1,'Hello','2019-06-27 09:03:07','2019-06-27 09:03:07'),
(4,95,1,'Hr.LENG Ratha','2019-06-27 09:03:26','2019-06-27 09:03:26'),
(5,95,1,'@dell How are you boy?','2019-06-27 09:04:20','2019-06-27 09:04:20'),
(6,95,1,'eererew','2019-06-27 09:05:21','2019-06-27 09:05:21'),
(7,95,1,'sdada','2019-06-27 09:56:50','2019-06-27 09:56:50'),
(8,100,1,'fxfs','2019-06-27 14:47:24','2019-06-27 14:47:24'),
(9,101,1,'Hello demo','2019-06-28 03:40:59','2019-06-28 03:40:59'),
(10,101,3,'Hello br','2019-06-28 03:41:20','2019-06-28 03:41:20'),
(11,103,1,'dssfsdfs','2019-06-28 04:01:19','2019-06-28 04:01:19');

/*Table structure for table `taskhandlers` */

DROP TABLE IF EXISTS `taskhandlers`;

CREATE TABLE `taskhandlers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_by` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hadler_unique` (`task_id`,`user_id`),
  KEY `handler_key` (`task_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `taskhandlers` */

insert  into `taskhandlers`(`id`,`task_id`,`user_id`,`created_by`,`created_at`,`updated_at`) values 
(78,101,1,1,'2019-06-28 03:38:08','2019-06-28 03:38:08'),
(79,101,3,1,'2019-06-28 03:39:41','2019-06-28 03:39:41'),
(80,101,7,1,'2019-06-28 03:39:44','2019-06-28 03:39:44'),
(81,101,4,1,'2019-06-28 03:39:47','2019-06-28 03:39:47'),
(82,102,1,1,'2019-06-28 03:43:09','2019-06-28 03:43:09'),
(83,103,1,1,'2019-06-28 03:43:12','2019-06-28 03:43:12');

/*Table structure for table `tasks` */

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL,
  `taskname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `finish_date` timestamp NULL DEFAULT NULL,
  `priority` smallint(6) DEFAULT 1,
  `created_by` smallint(6) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '1 active, 2 archive or delete',
  `step` tinyint(1) DEFAULT 1 COMMENT 'where 1 is task to do, 2 inprogress, and 3 completed',
  PRIMARY KEY (`id`),
  KEY `project_idtask` (`project_id`,`taskname`),
  KEY `taskname` (`taskname`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tasks` */

insert  into `tasks`(`id`,`project_id`,`taskname`,`description`,`start_date`,`due_date`,`finish_date`,`priority`,`created_by`,`created_at`,`updated_at`,`status`,`step`) values 
(101,29,'Design Interface','Urgent task',NULL,'2019-06-05 00:00:00',NULL,3,1,'2019-06-28 03:38:08','2019-06-28 03:42:45',1,1),
(102,29,'task 2',NULL,NULL,NULL,NULL,1,1,'2019-06-28 03:43:09','2019-06-28 03:43:09',1,3),
(103,29,'task 3',NULL,NULL,NULL,NULL,1,1,'2019-06-28 03:43:12','2019-06-28 03:43:12',1,3);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_id` tinyint(4) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.jpg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`role_id`,`password`,`remember_token`,`created_at`,`updated_at`,`status`,`img`) values 
(1,'LENG Ratha','mr.lengratha@gmail.com',NULL,1,'$2y$10$Pk/IQ7MeA1KDq.mK6AQAV.uZm2wSqP0M7jetx7QIMX5CEaTbpqgn.',NULL,'2019-06-20 07:01:19','2019-06-20 07:01:19',1,'a2.jpg'),
(2,'MR. Lipton','mr.lipton@gmail.com',NULL,2,'$2y$10$8lzeS30yp4AAtL3q60tfgeJGd2kWRc5gTgbWpn.l8usyupjVKX/wq',NULL,'2019-06-20 07:04:29','2019-06-20 07:08:01',1,'a3.jpg'),
(3,'demo','demo@gmail.com',NULL,1,'$2y$10$dxD1Rm2ukjY5Pay0FTLxkuXltWG.fkyXT6diq11MKnbjgnj4dgumq',NULL,'2019-06-20 13:34:12','2019-06-20 13:34:12',1,'a4.jpg'),
(4,'Loto','loto@gmail.com',NULL,2,'$2y$10$ztJh6.anGHXdUb2rStGix.cCiSJmL56/nZoNMTE9CfVZg85oiZMTa',NULL,'2019-06-26 01:32:01','2019-06-26 01:32:01',1,'a5.jpg'),
(5,'acer','acer@gmail.com',NULL,2,'$2y$10$6U5jN4ENvyufzxLTrWuljOgVU7Kx4pMd7ScHyeEszprczjFvToCdC',NULL,'2019-06-26 01:32:49','2019-06-26 01:32:49',1,'a6.jpg'),
(6,'dell','dell@gmail.com',NULL,2,'$2y$10$.T/BzuHHkZK.Dh07aAaur.Arg21dgEqqlD0kJWc2.EnDOuD0BxCHW',NULL,'2019-06-26 01:33:01','2019-06-26 01:33:01',1,'a7.jpg'),
(7,'lenovo','lenovo@gmail.com',NULL,2,'$2y$10$7Ej6mgT/83A2BGl.vb9aXOS.Bl6q1hz6D/eRi0nXfzVgzU9OD9lEe',NULL,'2019-06-26 01:33:18','2019-06-26 01:33:18',1,'avatar.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
