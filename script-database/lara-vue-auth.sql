/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : lara-vue-auth

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-02-01 08:32:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_01_31_071719_create_roles_table', '2');
INSERT INTO `migrations` VALUES ('4', '2019_02_01_062132_field_role_id_user', '3');
INSERT INTO `migrations` VALUES ('5', '2019_02_01_075001_field_user_profile', '4');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Administrador', '1', '2019-01-31 07:02:18', '2019-01-31 07:02:18');
INSERT INTO `roles` VALUES ('2', 'Usuario', '1', '2019-01-31 07:02:18', '2019-01-31 07:02:18');
INSERT INTO `roles` VALUES ('3', 'Vendedor', '1', '2019-01-31 07:02:18', '2019-01-31 07:02:18');
INSERT INTO `roles` VALUES ('10', 'prueba', '1', '2019-02-01 05:11:38', '2019-02-01 05:11:38');
INSERT INTO `roles` VALUES ('11', 'otro rol editado', '1', '2019-02-01 08:58:48', '2019-02-01 08:58:53');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL DEFAULT '1',
  `profile` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'admin@admin.com', '$2y$10$vCQvGGtTk.isEvR/1AJH.eGzaODQTJhNEBGwXURhLJXXNrnMDpPp6', null, '2019-01-31 06:41:19', '2019-02-01 08:53:03', '1', '1549011076-laravel.png');
INSERT INTO `users` VALUES ('4', 'tonaaaa', 'testt@testt.com', '$2y$10$Tr2l6b5z6dpwUBNd6BKoG..AaWDXWqZSbZPbmBMwyJy/m8JFwF/PO', null, '2019-02-01 07:51:54', '2019-02-01 08:21:55', '2', '1549007514-DELL WINDOWS 10-2.jpg');
INSERT INTO `users` VALUES ('8', 'prueba', 'prueba@prueba.com', '$2y$10$DAifz5nSdx6JGmArkaTAyOCg7xKFAmlWT27uOPPlHqMTOUOWSdNgS', null, '2019-02-01 08:59:13', '2019-02-01 08:59:13', '1', '1549011553-nemesis.jpg');
