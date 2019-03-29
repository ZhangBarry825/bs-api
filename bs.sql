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

 Date: 29/03/2019 16:51:17
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
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `goods_id` int(255) NOT NULL COMMENT '商品编号',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` double(10, 2) NOT NULL,
  `type_id` int(255) NOT NULL COMMENT '分类',
  `pic1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(255) NOT NULL COMMENT '0下架1正常',
  `stock` int(255) NOT NULL COMMENT '库存',
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品详情',
  `express_cost` double(10, 2) NOT NULL COMMENT '运费',
  `create_time` int(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES (1, 640437952, '电风扇', 158.00, 583909172, 'http://bs-api.barry.umdev.cn/static/uploads/20190328/75b34c39173e14ad87cee3894656ebbf.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/280952189fc2a0d97fc4c00d3264f586.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/495b41f15f5521aeb543d6074bb0e4f9.jpg', 1, 555, '<p>风<img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190328/d0c4298f6f53806c77884e673d26579c.jpg\" /></p>', 50.00, 1553764043);
INSERT INTO `goods` VALUES (2, 664841126, '扫地机器人', 552.00, 583907635, 'http://bs-api.barry.umdev.cn/static/uploads/20190328/5307919f5b54dc211ad0c1ece8177247.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/7413e93480e424944596e26e5a63cdce.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/82b815a3b49eeeae28863562d0860b1e.jpg', 1, 2323, '<p><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190328/50c8400dae08c258735726f886ba3d0a.jpg\" /></p>', 20.00, 1553766484);
INSERT INTO `goods` VALUES (3, 200089124, '空调', 3542.50, 668099167, 'http://bs-api.barry.umdev.cn/static/uploads/20190329/6f04a6c814dd3c81b6cf48fc3d0bb901.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190329/9e0005294588ef43f45ae4ab4690ef1e.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190329/12da5772c4368dcd1b331f71c99fb8d9.jpg', 1, 123, '<p><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190329/e909654475d94b61578091674ee448ba.jpg\" /><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190329/039919a6760634250c5a3a2e355cc2a5.jpg\" /><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190329/5c62a535c60220e12a0d3d96be19bf81.jpg\" /><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190329/36897f8af940b5b452e3fe049294bf1e.jpg\" /></p>', 54.00, 1553820008);

-- ----------------------------
-- Table structure for goods_specification
-- ----------------------------
DROP TABLE IF EXISTS `goods_specification`;
CREATE TABLE `goods_specification`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `goods_id` int(255) NOT NULL COMMENT '商品编号',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '规格名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of goods_specification
-- ----------------------------
INSERT INTO `goods_specification` VALUES (1, 640437952, '强劲1');
INSERT INTO `goods_specification` VALUES (2, 640437952, '中等2');
INSERT INTO `goods_specification` VALUES (3, 640437952, '迷你3');
INSERT INTO `goods_specification` VALUES (4, 664841126, '黑色');
INSERT INTO `goods_specification` VALUES (5, 664841126, '蓝色');
INSERT INTO `goods_specification` VALUES (6, 200089124, '大功率');
INSERT INTO `goods_specification` VALUES (7, 200089124, '中等功率');
INSERT INTO `goods_specification` VALUES (8, 200089124, '小功率');

-- ----------------------------
-- Table structure for goods_type
-- ----------------------------
DROP TABLE IF EXISTS `goods_type`;
CREATE TABLE `goods_type`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `type_id` int(255) NOT NULL COMMENT '分类编号',
  `level` int(2) NOT NULL COMMENT '分类级别',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `belong_id` int(255) NOT NULL COMMENT '所属一级分类id',
  `create_time` int(20) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of goods_type
-- ----------------------------
INSERT INTO `goods_type` VALUES (42, 583901056, 1, '包', '', 0, 1553758390);
INSERT INTO `goods_type` VALUES (43, 583907635, 2, '小包', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/548b6d0cfa33a89d492b1ee10f42421a.jpg', 583901056, 1553758390);
INSERT INTO `goods_type` VALUES (44, 583909172, 2, '大包', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/13a306b9c078e54f5841f9d5f01ef36f.jpg', 583901056, 1553758390);
INSERT INTO `goods_type` VALUES (49, 668091332, 1, '家电', '', 0, 1553766809);
INSERT INTO `goods_type` VALUES (50, 668099167, 2, '电器', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/f744264c9037740074d3884596854da7.jpg', 668091332, 1553766809);

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
  `commission` double(255, 2) NOT NULL COMMENT '佣金',
  `balance` double(255, 2) UNSIGNED NOT NULL,
  `expense` double(255, 2) UNSIGNED NOT NULL,
  `create_time` int(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `referrer_id` int(255) NOT NULL,
  `referrer` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(255) NOT NULL COMMENT '1正常 0禁用',
  `is_shopper` int(255) NOT NULL COMMENT '1是0否',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of membership
-- ----------------------------
INSERT INTO `membership` VALUES (21, 96114956, '张三', '大番薯', '15138389776', 0.00, 0.00, 0.00, 1553674956, '4297f44b13955235245b2497399d7a93', 0, '总店', 1, 1);
INSERT INTO `membership` VALUES (23, 96111407, '张三', '小番薯', '17611319611', 0.00, 0.00, 0.00, 1553821407, '4297f44b13955235245b2497399d7a93', 96114956, '大番薯', 1, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `order_id` int(255) NOT NULL COMMENT '订单号',
  `shopper` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分销商',
  `shopper_id` int(255) NOT NULL COMMENT '分销商会员号',
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `membership_id` int(255) NOT NULL,
  `price` double(10, 2) NOT NULL,
  `status` int(5) NOT NULL COMMENT '0待付款1待发货2已发货3已完成4待退款5同意退款6拒绝退款7已退款',
  `create_time` int(255) NOT NULL COMMENT '下单时间',
  `apply_refund_time` int(255) NOT NULL COMMENT '申请退款时间',
  `refund_time` int(255) NOT NULL COMMENT '退款时间',
  `pay_time` int(255) NOT NULL COMMENT '付款时间',
  `contacts` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '联系人',
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '联系电话',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '地址信息',
  `refund_contacts` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商家联系人',
  `refund_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商家电话',
  `refund_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商家地址',
  `refund_express_company` int(255) NOT NULL COMMENT '退货物流公司',
  `refund_express_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '退货物流单号',
  `express_company` int(255) NOT NULL COMMENT '快递公司',
  `express_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '快递编号',
  `express_cost` double(10, 2) NOT NULL COMMENT '快递费用',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (28, 2147483647, '大番薯', 96114956, '小番薯', '张三', 96111407, 350.00, 0, 1553824516, 0, 1553833325, 1553835360, '张三', '17611319611', '河南省郑州市中原区中原路146号', '', '', '', 0, '', 4, '445233654', 50.00, '多放辣椒不要蒜');
INSERT INTO `order` VALUES (29, 2147483647, '大番薯', 96114956, '小番薯', '张三', 96111407, 350.00, 7, 1553824516, 1553834918, 1553835395, 1553828601, '张三', '17611319611', '河南省郑州市中原区中原路146号', '123', '123', '123', 0, '', 4, '445233654', 50.00, '多放辣椒不要蒜');

-- ----------------------------
-- Table structure for order_goods
-- ----------------------------
DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `order_id` int(255) NOT NULL,
  `goods_id` int(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` double(10, 2) NOT NULL,
  `pic1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `express_cost` double(10, 2) NOT NULL,
  `num` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of order_goods
-- ----------------------------
INSERT INTO `order_goods` VALUES (1, 2147483647, 640437952, '电风扇', 150.00, 'http://bs-api.barry.umdev.cn/static/uploads/20190328/75b34c39173e14ad87cee3894656ebbf.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/280952189fc2a0d97fc4c00d3264f586.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/495b41f15f5521aeb543d6074bb0e4f9.jpg', 50.00, 2);

-- ----------------------------
-- Table structure for regulation
-- ----------------------------
DROP TABLE IF EXISTS `regulation`;
CREATE TABLE `regulation`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `require_type` int(11) NOT NULL COMMENT '成为分销商门槛',
  `require_expense` double(10, 2) NOT NULL COMMENT '消费额',
  `require_price` double(10, 2) NOT NULL COMMENT '门槛价格',
  `display_agreement` int(2) NOT NULL COMMENT '0不展示协议1展示协议',
  `agreement_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `agreement_content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `level_one` double(10, 2) NOT NULL COMMENT '一级分销比例',
  `level_two` double(10, 2) NOT NULL COMMENT '二级分销比例',
  `level_three` double(10, 2) NOT NULL COMMENT '三级分销比例',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of regulation
-- ----------------------------
INSERT INTO `regulation` VALUES (1, 1, 3.00, 1.00, 1, '标题2', '这是一条购买协议\n这是一条购买协议', 3.00, 2.00, 1.00);

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
