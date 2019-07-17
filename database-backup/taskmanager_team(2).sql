-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 17, 2019 at 09:12 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskmanager_team`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Real Estate & Properties', 0, 1, NULL, NULL),
(2, 'Job Recruitement & Agency', 0, 1, NULL, NULL),
(13, 'Ecommerce & Products', 0, 1, '2019-06-19 20:39:56', '2019-06-19 20:39:56'),
(17, 'Information Website & Design', 0, 1, '2019-06-19 20:42:11', '2019-06-19 20:42:11'),
(18, 'Medical', 0, 1, '2019-06-20 00:27:46', '2019-06-20 00:27:46'),
(19, 'Transprt & Logistics', 0, 1, '2019-06-20 19:25:06', '2019-06-20 19:25:06'),
(20, 'Custom Software', 0, 1, '2019-06-23 23:29:48', '2019-06-23 23:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_06_18_025151_create_tasks_table', 2),
(4, '2019_06_18_025357_create_taskdoing_table', 2),
(5, '2019_06_18_025430_create_taskhandlers_table', 2),
(6, '2019_06_18_025506_create_taskdone_table', 2),
(8, '2019_06_18_025817_create_sys_role_table', 2),
(9, '2019_06_18_025904_create_sys_permission_table', 2),
(10, '2019_06_18_025934_create_sys_rolepermission_table', 2),
(11, '2019_06_18_031014_create_projects_table', 2),
(12, '2019_06_18_040018_create_category_table', 2),
(13, '2019_06_18_040018_create_project_lists_table', 3),
(14, '2019_07_02_033011_add_progress_column_to_tasks', 3),
(15, '2019_06_18_040018_alter_project_lists_table', 4),
(16, '2019_06_18_040018_create_project_member_table', 5),
(17, '2019_07_08_042247_add_progres_column_to_project_table', 6),
(18, '2019_06_18_025604_create_taskcomments_table', 7),
(19, '2019_07_11_033802_add_color_column_to_projects_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 13),
(1, 'App\\User', 19),
(3, 'App\\User', 3),
(3, 'App\\User', 7),
(3, 'App\\User', 11),
(3, 'App\\User', 19),
(3, 'App\\User', 20),
(3, 'App\\User', 21),
(3, 'App\\User', 22),
(3, 'App\\User', 23),
(3, 'App\\User', 24),
(3, 'App\\User', 25),
(3, 'App\\User', 26),
(3, 'App\\User', 27),
(3, 'App\\User', 28),
(3, 'App\\User', 29),
(3, 'App\\User', 30),
(5, 'App\\User', 10),
(5, 'App\\User', 11),
(5, 'App\\User', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2018-06-19 06:53:05', '2018-06-19 06:53:05'),
(2, 'role-create', 'web', '2018-06-19 06:53:05', '2018-06-19 06:53:05'),
(3, 'role-edit', 'web', '2018-06-19 06:53:05', '2018-06-19 06:53:05'),
(4, 'role-delete', 'web', '2018-06-19 06:53:05', '2018-06-19 06:53:05'),
(9, 'user-list', 'web', '2019-05-27 04:24:53', '2019-05-27 04:24:55'),
(10, 'user-create', 'web', '2019-05-27 04:26:11', '2019-05-27 04:26:12'),
(11, 'user-edit', 'web', '2019-05-27 04:26:31', '2019-05-27 04:26:32'),
(12, 'user-delete', 'web', '2019-05-27 04:26:50', '2019-05-27 04:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `projectname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `font_color` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#ffffff',
  `back_color` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#1ab394',
  `progress` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` tinyint(4) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `closed_by` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `category_id`, `projectname`, `description`, `font_color`, `back_color`, `progress`, `created_by`, `status`, `created_at`, `updated_at`, `closed_by`) VALUES
(29, 20, 'PCA Project', 'PCA Project description goes here', '#ffffff', '#1ab394', 57, 1, 1, '2019-06-27 20:34:00', '2019-07-16 18:37:27', 1),
(30, 2, 'test', 'd', '#ffffff', '#1ab394', 31, 13, 1, '2019-07-17 01:48:28', '2019-07-17 02:04:29', NULL),
(31, 13, 'ddd', 'ddd', '#ffffff', '#1ab394', 0, 3, 1, '2019-07-17 01:49:40', '2019-07-17 01:49:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_lists`
--

DROP TABLE IF EXISTS `project_lists`;
CREATE TABLE IF NOT EXISTS `project_lists` (
  `list_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL,
  `list_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_lists`
--

INSERT INTO `project_lists` (`list_id`, `project_id`, `list_title`, `created_by`, `modified_by`, `deleted_by`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 29, 'Hello world', 3, NULL, NULL, NULL, 0, '2019-07-04 01:00:24', '2019-07-04 01:00:24'),
(2, 29, 'Hello testing', 3, NULL, NULL, NULL, 0, '2019-07-04 01:00:42', '2019-07-04 01:00:42'),
(3, 29, 'Testing Add', 3, NULL, NULL, NULL, 0, '2019-07-04 01:01:32', '2019-07-08 20:55:11'),
(4, 29, 'Hi board', 3, NULL, NULL, NULL, 0, '2019-07-04 01:04:16', '2019-07-08 20:54:55'),
(5, 29, 'Hello world', 3, NULL, NULL, NULL, 0, '2019-07-05 00:09:42', '2019-07-08 20:54:48'),
(6, 29, 'Testing', 3, NULL, NULL, NULL, 0, '2019-07-05 00:59:45', '2019-07-09 00:53:57'),
(7, 29, 'ss', 3, NULL, NULL, NULL, 0, '2019-07-09 00:50:09', '2019-07-09 00:50:16'),
(8, 29, 'ddd', 3, NULL, NULL, NULL, 0, '2019-07-09 00:52:20', '2019-07-09 00:52:26'),
(9, 29, 'ddd', 3, NULL, NULL, NULL, 0, '2019-07-09 00:53:02', '2019-07-09 00:53:19'),
(10, 29, 'aaaa', 3, NULL, NULL, NULL, 0, '2019-07-09 00:53:10', '2019-07-09 00:53:14'),
(11, 29, 'ddd', 3, NULL, NULL, NULL, 0, '2019-07-09 00:53:47', '2019-07-09 00:53:52'),
(12, 29, 'cccc', 3, NULL, NULL, NULL, 0, '2019-07-09 00:54:03', '2019-07-09 00:54:28'),
(13, 29, 'test', 3, NULL, NULL, NULL, 0, '2019-07-09 00:55:48', '2019-07-09 00:55:53'),
(14, 29, 'cc', 3, NULL, NULL, NULL, 0, '2019-07-09 00:56:53', '2019-07-09 00:56:57'),
(15, 29, 'cc', 3, NULL, NULL, NULL, 0, '2019-07-09 00:58:29', '2019-07-09 00:58:36'),
(16, 29, 'ddd', 3, NULL, NULL, NULL, 0, '2019-07-09 00:58:57', '2019-07-09 00:59:03'),
(17, 29, 'aaa', 3, NULL, NULL, NULL, 0, '2019-07-09 00:59:28', '2019-07-09 00:59:43'),
(18, 29, 'xxx', 3, NULL, NULL, NULL, 0, '2019-07-09 00:59:33', '2019-07-09 00:59:38'),
(19, 29, 'test', 3, NULL, NULL, NULL, 0, '2019-07-09 01:00:11', '2019-07-09 01:00:16'),
(20, 29, 'ddd', 3, NULL, NULL, NULL, 0, '2019-07-09 23:40:25', '2019-07-09 23:40:33'),
(21, 30, 'sss', 13, NULL, NULL, NULL, 1, '2019-07-17 01:57:13', '2019-07-17 01:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `project_member`
--

DROP TABLE IF EXISTS `project_member`;
CREATE TABLE IF NOT EXISTS `project_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `assign_by` int(11) DEFAULT NULL,
  `removed_by` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unigue_project_user` (`project_id`,`user_id`),
  KEY `project_user_key` (`project_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_member`
--

INSERT INTO `project_member` (`id`, `project_id`, `user_id`, `assign_by`, `removed_by`, `status`, `created_at`, `updated_at`) VALUES
(56, 29, 1, 1, 0, 1, '2019-06-27 20:34:00', '2019-06-27 20:34:00'),
(57, 29, 3, 1, 0, 1, '2019-06-27 20:34:25', '2019-06-27 20:34:25'),
(58, 29, 7, 1, 0, 1, '2019-06-27 20:39:23', '2019-06-27 20:39:23'),
(59, 29, 4, 1, 0, 1, '2019-06-27 20:39:25', '2019-06-27 20:39:25'),
(60, 29, 2, 1, 0, 1, '2019-06-27 20:39:28', '2019-06-27 20:39:28'),
(61, 30, 13, 13, 0, 1, '2019-07-17 01:48:28', '2019-07-17 01:48:28'),
(62, 31, 3, 3, 0, 1, '2019-07-17 01:49:40', '2019-07-17 01:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_by` (`updated_by`),
  KEY `created_by` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Supper administrator', 'web', 0, 0, '2018-06-19 06:54:48', '2019-07-17 01:08:07'),
(3, 'Generale Staff', 'web', NULL, NULL, '2019-05-26 20:28:51', '2019-07-17 01:07:52'),
(5, 'administrator', 'web', NULL, NULL, '2019-07-16 21:03:14', '2019-07-17 01:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 4),
(2, 1),
(2, 4),
(3, 1),
(3, 4),
(4, 1),
(4, 4),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 1),
(9, 3),
(9, 5),
(10, 1),
(10, 5),
(11, 1),
(11, 5),
(12, 1),
(12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sys_permission`
--

DROP TABLE IF EXISTS `sys_permission`;
CREATE TABLE IF NOT EXISTS `sys_permission` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_role`
--

DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE IF NOT EXISTS `sys_role` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sys_role`
--

INSERT INTO `sys_role` (`id`, `role_name`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Administrator', 'Full Cntrol', '2019-06-19 21:36:31', '2019-06-19 21:36:31', 1),
(2, 'Normal User', 'Normal User', '2019-06-19 21:44:09', '2019-06-19 21:57:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sys_rolepermission`
--

DROP TABLE IF EXISTS `sys_rolepermission`;
CREATE TABLE IF NOT EXISTS `sys_rolepermission` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taskcomments`
--

DROP TABLE IF EXISTS `taskcomments`;
CREATE TABLE IF NOT EXISTS `taskcomments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `task_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `comments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `def_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taskcomments`
--

INSERT INTO `taskcomments` (`id`, `task_id`, `user_id`, `comments`, `image`, `def_image`, `status`, `created_at`, `updated_at`) VALUES
(69, 126, 3, 'dddf', NULL, NULL, 1, '2019-07-11 01:11:23', '2019-07-11 01:11:23'),
(70, 126, 3, NULL, '1729163572.jpg', '12.jpg', 1, '2019-07-11 01:11:27', '2019-07-11 01:11:27'),
(71, 126, 3, 'sdfdsf', '950859216.jpg', '2qw.jpg', 1, '2019-07-11 01:11:37', '2019-07-11 01:11:37'),
(72, 126, 3, 'sdsd', NULL, NULL, 1, '2019-07-11 01:15:48', '2019-07-11 01:15:48'),
(73, 105, 3, 'dd', NULL, NULL, 1, '2019-07-11 01:18:15', '2019-07-11 01:18:15'),
(74, 105, 3, 'ddd', '1914177307.png', 'Screenshot (4).png', 1, '2019-07-11 01:18:28', '2019-07-11 01:18:28'),
(75, 123, 3, 'ded', NULL, NULL, 1, '2019-07-11 01:20:08', '2019-07-11 01:20:08'),
(76, 124, 3, 'dddd', NULL, NULL, 1, '2019-07-11 01:20:27', '2019-07-11 01:20:27'),
(77, 124, 3, NULL, '1770446673.png', 'Screenshot (2).png', 1, '2019-07-11 01:21:03', '2019-07-11 01:21:03'),
(78, 126, 3, 'ggg', NULL, NULL, 1, '2019-07-11 01:24:23', '2019-07-11 01:24:23'),
(79, 126, 3, NULL, '2047760937.png', 'Screenshot (2).png', 1, '2019-07-11 01:24:39', '2019-07-11 01:24:39'),
(80, 127, 3, 'Test', NULL, NULL, 1, '2019-07-11 02:51:48', '2019-07-11 02:51:48'),
(81, 127, 3, 'dd', NULL, NULL, 1, '2019-07-11 18:53:15', '2019-07-11 18:53:15'),
(82, 127, 3, NULL, '876861388.jpg', '12.jpg', 1, '2019-07-11 18:53:22', '2019-07-11 18:53:22'),
(83, 127, 3, 'test', NULL, NULL, 1, '2019-07-11 21:20:04', '2019-07-11 21:20:04'),
(84, 127, 3, 'dd', NULL, NULL, 1, '2019-07-12 00:14:30', '2019-07-12 00:14:30'),
(85, 127, 3, 'dd', '1444806140.jpg', '15.jpg', 1, '2019-07-12 00:14:36', '2019-07-12 00:14:36'),
(86, 128, 13, NULL, '1247719287.jpg', '30388d6cd06820716a4ae4c03eee751c.jpg', 1, '2019-07-17 01:50:50', '2019-07-17 01:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `taskhandlers`
--

DROP TABLE IF EXISTS `taskhandlers`;
CREATE TABLE IF NOT EXISTS `taskhandlers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `task_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_by` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hadler_unique` (`task_id`,`user_id`),
  KEY `handler_key` (`task_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taskhandlers`
--

INSERT INTO `taskhandlers` (`id`, `task_id`, `user_id`, `created_by`, `created_at`, `updated_at`) VALUES
(78, 101, 1, 1, '2019-06-27 20:38:08', '2019-06-27 20:38:08'),
(79, 101, 3, 1, '2019-06-27 20:39:41', '2019-06-27 20:39:41'),
(80, 101, 7, 1, '2019-06-27 20:39:44', '2019-06-27 20:39:44'),
(81, 101, 4, 1, '2019-06-27 20:39:47', '2019-06-27 20:39:47'),
(82, 102, 1, 1, '2019-06-27 20:43:09', '2019-06-27 20:43:09'),
(83, 103, 1, 1, '2019-06-27 20:43:12', '2019-06-27 20:43:12'),
(84, 103, 3, 3, '2019-07-03 00:28:48', '2019-07-03 00:28:48'),
(85, 103, 7, 3, '2019-07-03 00:29:42', '2019-07-03 00:29:42'),
(86, 103, 2, 3, '2019-07-03 00:30:11', '2019-07-03 00:30:11'),
(87, 104, 3, 3, '2019-07-03 00:33:42', '2019-07-03 00:33:42'),
(88, 105, 3, 3, '2019-07-07 21:32:01', '2019-07-07 21:32:01'),
(89, 106, 3, 3, '2019-07-08 00:32:21', '2019-07-08 00:32:21'),
(90, 102, 3, 3, '2019-07-08 00:34:06', '2019-07-08 00:34:06'),
(91, 102, 7, 3, '2019-07-08 00:34:09', '2019-07-08 00:34:09'),
(92, 107, 3, 3, '2019-07-08 00:48:12', '2019-07-08 00:48:12'),
(93, 108, 3, 3, '2019-07-08 00:50:10', '2019-07-08 00:50:10'),
(94, 109, 3, 3, '2019-07-08 00:51:12', '2019-07-08 00:51:12'),
(95, 110, 3, 3, '2019-07-08 00:52:01', '2019-07-08 00:52:01'),
(96, 111, 3, 3, '2019-07-08 00:54:57', '2019-07-08 00:54:57'),
(97, 112, 3, 3, '2019-07-08 01:01:35', '2019-07-08 01:01:35'),
(98, 113, 3, 3, '2019-07-08 01:02:11', '2019-07-08 01:02:11'),
(99, 114, 3, 3, '2019-07-08 01:02:51', '2019-07-08 01:02:51'),
(100, 115, 3, 3, '2019-07-08 01:04:13', '2019-07-08 01:04:13'),
(101, 116, 3, 3, '2019-07-08 01:05:16', '2019-07-08 01:05:16'),
(102, 117, 3, 3, '2019-07-08 01:42:25', '2019-07-08 01:42:25'),
(103, 118, 3, 3, '2019-07-08 01:44:10', '2019-07-08 01:44:10'),
(104, 119, 3, 3, '2019-07-08 01:49:30', '2019-07-08 01:49:30'),
(105, 120, 3, 3, '2019-07-08 01:50:04', '2019-07-08 01:50:04'),
(106, 121, 3, 3, '2019-07-08 01:50:14', '2019-07-08 01:50:14'),
(107, 122, 3, 3, '2019-07-08 19:38:20', '2019-07-08 19:38:20'),
(108, 122, 7, 3, '2019-07-08 19:38:49', '2019-07-08 19:38:49'),
(109, 122, 4, 3, '2019-07-08 19:39:43', '2019-07-08 19:39:43'),
(110, 122, 2, 3, '2019-07-08 20:07:38', '2019-07-08 20:07:38'),
(111, 105, 2, 3, '2019-07-08 20:28:24', '2019-07-08 20:28:24'),
(112, 105, 1, 3, '2019-07-08 20:28:29', '2019-07-08 20:28:29'),
(113, 123, 3, 3, '2019-07-08 20:38:31', '2019-07-08 20:38:31'),
(114, 123, 7, 3, '2019-07-09 01:10:17', '2019-07-09 01:10:17'),
(115, 124, 3, 3, '2019-07-09 01:10:23', '2019-07-09 01:10:23'),
(116, 124, 1, 3, '2019-07-09 01:10:26', '2019-07-09 01:10:26'),
(117, 124, 4, 3, '2019-07-09 01:10:28', '2019-07-09 01:10:28'),
(118, 125, 3, 3, '2019-07-09 18:35:10', '2019-07-09 18:35:10'),
(119, 126, 3, 3, '2019-07-09 21:35:17', '2019-07-09 21:35:17'),
(120, 126, 4, 3, '2019-07-09 23:39:49', '2019-07-09 23:39:49'),
(121, 126, 7, 3, '2019-07-09 23:39:51', '2019-07-09 23:39:51'),
(122, 126, 2, 3, '2019-07-09 23:39:54', '2019-07-09 23:39:54'),
(123, 124, 7, 3, '2019-07-11 02:47:39', '2019-07-11 02:47:39'),
(124, 127, 3, 3, '2019-07-11 02:51:39', '2019-07-11 02:51:39'),
(125, 128, 13, 13, '2019-07-17 01:48:50', '2019-07-17 01:48:50'),
(126, 129, 3, 3, '2019-07-17 01:49:47', '2019-07-17 01:49:47'),
(127, 130, 13, 13, '2019-07-17 01:57:24', '2019-07-17 01:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) NOT NULL,
  `taskname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `due_date` timestamp NULL DEFAULT NULL,
  `finish_date` timestamp NULL DEFAULT NULL,
  `priority` smallint(6) DEFAULT '1',
  `progress` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` smallint(6) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1 active, 2 archive or delete',
  `step` tinyint(1) DEFAULT '1' COMMENT 'where 1 is task to do, 2 inprogress, and 3 completed',
  PRIMARY KEY (`id`),
  KEY `project_idtask` (`project_id`,`taskname`(191)),
  KEY `taskname` (`taskname`(191))
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `taskname`, `description`, `start_date`, `due_date`, `finish_date`, `priority`, `progress`, `created_by`, `created_at`, `updated_at`, `status`, `step`) VALUES
(101, 29, 'Design Interface', 'gjhfgghg', NULL, '2019-06-04 17:00:00', NULL, 3, 46, 1, '2019-06-27 20:38:08', '2019-07-08 00:36:40', 2, 2),
(102, 29, 'task 2', 'werawer', NULL, NULL, NULL, 1, 0, 1, '2019-06-27 20:43:09', '2019-07-08 19:38:00', 0, 5),
(103, 29, 'task 3', 'sdfdsfsdfsafasdfasdfasdf', NULL, '2019-07-04 17:00:00', NULL, 1, 0, 1, '2019-06-27 20:43:12', '2019-07-05 00:54:11', 0, 3),
(104, 29, 'Hello world', 'fdvc kkk up', NULL, NULL, NULL, 1, 100, 3, '2019-07-03 00:33:42', '2019-07-05 01:01:12', 2, 1),
(105, 29, 'Hello world', NULL, NULL, NULL, NULL, 1, 76, 3, '2019-07-07 21:32:01', '2019-07-07 21:32:17', 1, 3),
(106, 29, 'Hello world', NULL, NULL, NULL, NULL, 1, 81, 3, '2019-07-08 00:32:21', '2019-07-08 00:33:17', 0, 1),
(107, 29, 'Hello pyton', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 00:48:12', '2019-07-08 00:48:12', 0, 1),
(108, 29, 'Hi', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 00:50:10', '2019-07-08 00:50:10', 0, 1),
(109, 29, 'Hi2', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 00:51:12', '2019-07-08 00:51:12', 0, 1),
(110, 29, 'Hello', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 00:52:01', '2019-07-08 00:52:01', 0, 1),
(111, 29, 'Testing', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 00:54:57', '2019-07-08 00:54:57', 0, 1),
(112, 29, 'HIi', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 01:01:35', '2019-07-08 01:01:35', 0, 1),
(113, 29, 'Hello', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 01:02:11', '2019-07-08 01:02:11', 0, 1),
(114, 29, 'dd', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 01:02:51', '2019-07-08 01:02:51', 0, 1),
(115, 29, 'Heeloo', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 01:04:13', '2019-07-08 01:04:13', 0, 1),
(116, 29, 'Hello', NULL, NULL, '2019-07-07 17:00:00', NULL, 1, 0, 3, '2019-07-08 01:05:16', '2019-07-08 01:09:34', 0, 1),
(117, 29, 'Eee', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 01:42:25', '2019-07-08 01:42:25', 0, 1),
(118, 29, 'Hee', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 01:44:10', '2019-07-08 01:44:10', 0, 1),
(119, 29, 'Hello', NULL, NULL, '2019-07-07 17:00:00', NULL, 1, 0, 3, '2019-07-08 01:49:30', '2019-07-08 01:49:42', 0, 1),
(120, 29, 'Hello world', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-08 01:50:04', '2019-07-08 01:50:04', 2, 1),
(121, 29, 'Hello Python', NULL, NULL, '2019-07-07 17:00:00', NULL, 2, 35, 3, '2019-07-08 01:50:14', '2019-07-08 03:19:53', 2, 1),
(122, 29, 'Hello', NULL, NULL, NULL, NULL, 2, 70, 3, '2019-07-08 19:38:20', '2019-07-09 22:27:47', 1, 1),
(123, 29, 'Demo', NULL, '2019-07-08 17:00:00', '2019-07-15 17:00:00', NULL, 2, 56, 3, '2019-07-08 20:38:31', '2019-07-16 18:39:44', 1, 2),
(124, 29, 'zz', NULL, NULL, NULL, NULL, 2, 50, 3, '2019-07-09 01:10:23', '2019-07-11 01:20:29', 1, 1),
(125, 29, 'Hello', NULL, '2019-07-09 17:00:00', '2019-07-31 17:00:00', NULL, 3, 51, 3, '2019-07-09 18:35:10', '2019-07-09 18:36:25', 0, 20),
(126, 29, 'df', NULL, NULL, NULL, NULL, 2, 59, 3, '2019-07-09 21:35:17', '2019-07-11 01:20:19', 1, 1),
(127, 29, 'ddd', NULL, NULL, NULL, NULL, 2, 33, 3, '2019-07-11 02:51:39', '2019-07-16 18:37:27', 1, 1),
(128, 30, 'ss', NULL, NULL, NULL, NULL, 1, 0, 13, '2019-07-17 01:48:50', '2019-07-17 01:48:50', 1, 21),
(129, 31, 'dd', NULL, NULL, NULL, NULL, 1, 0, 3, '2019-07-17 01:49:47', '2019-07-17 01:49:47', 1, 1),
(130, 30, 'ddd', NULL, NULL, NULL, NULL, 1, 61, 13, '2019-07-17 01:57:24', '2019-07-17 02:04:29', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_id` tinyint(4) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `img` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role_id`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `img`) VALUES
(1, 'LENG Ratha', 'mr.lengratha@gmail.com', NULL, 1, '$2y$10$Pk/IQ7MeA1KDq.mK6AQAV.uZm2wSqP0M7jetx7QIMX5CEaTbpqgn.', NULL, '2019-06-20 00:01:19', '2019-07-17 00:34:08', 0, 'a2.jpg'),
(3, 'demo', 'demo@gmail.com', NULL, 1, '$2y$10$dxD1Rm2ukjY5Pay0FTLxkuXltWG.fkyXT6diq11MKnbjgnj4dgumq', NULL, '2019-06-20 06:34:12', '2019-07-17 01:28:14', 1, '2019-07-17-08-28-14-51310916f7f4e7cb9825ee219aad4b5f.jpg'),
(4, 'Loto', 'loto@gmail.com', NULL, 2, '$2y$10$ztJh6.anGHXdUb2rStGix.cCiSJmL56/nZoNMTE9CfVZg85oiZMTa', NULL, '2019-06-25 18:32:01', '2019-07-17 00:34:22', 0, 'a5.jpg'),
(5, 'acer', 'acer@gmail.com', NULL, 2, '$2y$10$6U5jN4ENvyufzxLTrWuljOgVU7Kx4pMd7ScHyeEszprczjFvToCdC', NULL, '2019-06-25 18:32:49', '2019-07-17 00:34:36', 0, 'a6.jpg'),
(6, 'dell', 'dell@gmail.com', NULL, 2, '$2y$10$.T/BzuHHkZK.Dh07aAaur.Arg21dgEqqlD0kJWc2.EnDOuD0BxCHW', NULL, '2019-06-25 18:33:01', '2019-07-17 00:34:36', 0, 'a7.jpg'),
(7, 'lenovo', 'lenovo@gmail.com', NULL, 2, '$2y$10$7Ej6mgT/83A2BGl.vb9aXOS.Bl6q1hz6D/eRi0nXfzVgzU9OD9lEe', NULL, '2019-06-25 18:33:18', '2019-07-17 00:34:35', 0, 'avatar.jpg'),
(8, 'Hean Thien', 'thiencambodia168@gmail.com', NULL, NULL, '$2y$10$8he.2jk9KPcBIvkO8TwWeulZoTPEZoMQx98toi5aRe3hcpNtHGIT2', NULL, '2019-07-16 21:46:04', '2019-07-17 00:34:35', 0, 'avatar.jpg'),
(9, 'Hean Thien', 'thienhean@gmail.com', NULL, NULL, '$2y$10$dx0Tb3utDvTBa4Q9H6E5Kuor3EkrF0coMm6zMy3uR35NFh9aXeJfK', NULL, '2019-07-16 21:49:26', '2019-07-17 00:34:35', 0, 'avatar.jpg'),
(10, 'Hean Thien', 'thienhean1233@gmail.com', NULL, NULL, '$2y$10$aFFj/BDfHcXFxJNcGzKwkeabBzHSScFV663ij4VVs/68ljhFV8x8W', NULL, '2019-07-16 21:52:01', '2019-07-17 00:34:34', 0, 'avatar.jpg'),
(11, 'mr test', 'test@gmail.com', NULL, NULL, '$2y$10$reqzyRkeeqKir.J11T.bsObTeMlm/ugVN2u17ADX0pwMuNetmLSge', NULL, '2019-07-16 21:54:47', '2019-07-16 21:54:47', 1, '2019-07-17-04-54-47-s.jpg'),
(13, 'Hean Thien', 'admin@admin.com', NULL, NULL, '$2y$10$1PdzcnrFhp84JFUGw7PoO.PLsR4MmmnDOal5kYjCk7X42FRs.Q.KW', NULL, '2019-07-17 01:09:22', '2019-07-17 01:09:22', 1, '2019-07-17-08-09-22-19.jpg'),
(14, 'Chan boromey', 'boramey@gmail.com', NULL, NULL, '$2y$10$plFx5HqIB.D3KLr0AxbRFuCYByYPNQnG6i2yIyN9sPoCnNTqy1kGO', NULL, '2019-07-17 01:25:59', '2019-07-17 01:26:40', 1, '2019-07-17-08-26-40-ef31d5db0168618c0b9c67734bd17ccd.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
