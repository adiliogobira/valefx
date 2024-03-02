/*
 Navicat Premium Data Transfer

 Source Server         : Localhost XAMPP
 Source Server Type    : MySQL
 Source Server Version : 100427
 Source Host           : localhost:3306
 Source Schema         : valefx

 Target Server Type    : MySQL
 Target Server Version : 100427
 File Encoding         : 65001

 Date: 02/03/2024 19:37:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `recover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `access_level` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `status` enum('Inativo','Ativo','Suspenso') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Inativo',
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Adilio', 'Gobira Neves Reis', 'adiliogobira@gmail.com', '$2y$10$asKy4/jVz.JagHnzTpoVDeyEDlXQ0yt.zECqxW1q0a58ARttthudO', NULL, '5', 'Ativo', '2024-02-13 14:15:41', '2024-02-13 14:15:41');
INSERT INTO `users` VALUES (2, 'Ruan', 'Barbosa', 'ruabarbosarock@gmail.com', '$2y$10$AMDXeriSfbUJ6yaoNA9r0u0p7Z7cNFqMiGRfMHYUbM912ipk8qbim', NULL, '2', 'Ativo', '2024-02-13 15:12:55', '2024-02-13 15:12:55');

SET FOREIGN_KEY_CHECKS = 1;
