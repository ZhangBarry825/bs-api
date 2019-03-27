/*
 Navicat Premium Data Transfer

 Source Server         : bs
 Source Server Type    : MySQL
 Source Server Version : 50637
 Source Host           : 192.168.33.10:3306
 Source Schema         : bs

 Target Server Type    : MySQL
 Target Server Version : 50637
 File Encoding         : 65001

 Date: 27/03/2019 16:29:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章标题',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章分类',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章描述',
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章内容',
  `cover` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '文章封面',
  `status` int(10) NOT NULL COMMENT '文章状态 1正常 0禁用',
  `create_time` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `update_time` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for membership
-- ----------------------------
DROP TABLE IF EXISTS `membership`;
CREATE TABLE `membership`  (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `membership_id` int(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `balance` double(255, 2) UNSIGNED NOT NULL,
  `expense` double(255, 2) UNSIGNED NOT NULL,
  `create_time` int(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `referrer` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(255) NOT NULL COMMENT '1正常 0禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of membership
-- ----------------------------
INSERT INTO `membership` VALUES (21, 96114956, '张三', '大番薯', '17611319611', 0.00, 0.00, 1553674956, '4297f44b13955235245b2497399d7a93', '小薯头', 1);

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content_short` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_time` bigint(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 115 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES (29, '123', '<p>312<img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190327/010caecce11f759261ca1deb04d23296.jpg\" width=\"100\" /></p>', '123', 1553666448);
INSERT INTO `message` VALUES (32, '123', '<p>123</p>', '123', 1553654731);
INSERT INTO `message` VALUES (33, '123', '<p>123</p>', '123', 1553654731);
INSERT INTO `message` VALUES (34, '123', '<p>123</p>', '123', 1553654732);
INSERT INTO `message` VALUES (35, '123', '<p>123</p>', '123', 1553654732);
INSERT INTO `message` VALUES (36, '123', '<p>123</p>', '123', 1553654732);
INSERT INTO `message` VALUES (37, '123', '<p>123</p>', '123', 1553654732);
INSERT INTO `message` VALUES (38, '123', '<p>123</p>', '123', 1553654732);
INSERT INTO `message` VALUES (39, '123', '<p>123</p>', '123', 1553654733);
INSERT INTO `message` VALUES (40, '123', '<p>123</p>', '123', 1553654733);
INSERT INTO `message` VALUES (71, '123', '<p>123</p>', '123123', 1553654978);

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` int(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名暨手机号',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `roles` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '1系统管理员 2普通管理员',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES (1, '15138389776', 'e10adc3949ba59abbe56e057f20f883e', '大番薯', '张三', 'admin', 'static/uploads/20190327/c5a5d4d6bf5e321bbb4b26fd27fd4f25.jpg');
INSERT INTO `sys_user` VALUES (17, '17611319611', 'e10adc3949ba59abbe56e057f20f883e', '小番薯', '徐大大', 'manager', 'static/uploads/20190327/c5a5d4d6bf5e321bbb4b26fd27fd4f25.jpg');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '昵称',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '账号',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `roles` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '角色',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '张三', 'admin', '4297f44b13955235245b2497399d7a93', 'admin', 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1553658083440&di=5bbe02990ac8763f8d1e11b6af4a244b&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201801%2F29%2F20180129152805_5xE2F.thumb.700_0.jpeg');

SET FOREIGN_KEY_CHECKS = 1;
