/*
 Navicat Premium Data Transfer

 Source Server         : centos
 Source Server Type    : MySQL
 Source Server Version : 50637
 Source Host           : 192.168.33.10:3306
 Source Schema         : myTp

 Target Server Type    : MySQL
 Target Server Version : 50637
 File Encoding         : 65001

 Date: 03/08/2018 14:37:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `type` varchar(255) NOT NULL COMMENT '文章分类',
  `description` varchar(255) NOT NULL COMMENT '文章描述',
  `content` mediumtext NOT NULL COMMENT '文章内容',
  `cover` varchar(255) DEFAULT NULL COMMENT '文章封面',
  `status` int(10) NOT NULL COMMENT '文章状态 1正常 0禁用',
  `create_time` mediumtext,
  `update_time` mediumtext,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '昵称',
  `username` varchar(255) NOT NULL COMMENT '账号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `roles` varchar(255) DEFAULT NULL COMMENT '角色',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (1, '张三', 'admin', '4297f44b13955235245b2497399d7a93', 'admin', '');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
