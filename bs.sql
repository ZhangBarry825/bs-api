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

 Date: 08/04/2019 16:26:25
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
-- Table structure for charge_list
-- ----------------------------
DROP TABLE IF EXISTS `charge_list`;
CREATE TABLE `charge_list`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `membership_id` int(255) NOT NULL COMMENT '会员id',
  `charge_account` double(10, 2) NOT NULL COMMENT '充值金额',
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '会员昵称',
  `create_time` int(255) NOT NULL COMMENT '充值时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of charge_list
-- ----------------------------
INSERT INTO `charge_list` VALUES (1, 103211389, 100.00, '哆啦A梦', 1554708288);
INSERT INTO `charge_list` VALUES (2, 103211389, 100.00, '哆啦A梦', 1554708411);
INSERT INTO `charge_list` VALUES (3, 103211389, 100.00, '哆啦A梦', 1554708456);
INSERT INTO `charge_list` VALUES (4, 103211389, 100.00, '哆啦A梦', 1554708682);
INSERT INTO `charge_list` VALUES (5, 103211389, 100.00, '哆啦A梦', 1554708686);
INSERT INTO `charge_list` VALUES (6, 103211389, 100.00, '哆啦A梦', 1554711781);
INSERT INTO `charge_list` VALUES (7, 103211389, 100.00, '哆啦A梦', 1554711783);
INSERT INTO `charge_list` VALUES (8, 103211389, 100.00, '哆啦A梦', 1554711784);
INSERT INTO `charge_list` VALUES (9, 103211389, 100.00, '哆啦A梦', 1554711786);

-- ----------------------------
-- Table structure for commission
-- ----------------------------
DROP TABLE IF EXISTS `commission`;
CREATE TABLE `commission`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `commission_account` double(10, 2) NOT NULL COMMENT '佣金金额',
  `level_one` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '一级',
  `level_one_id` int(255) NULL DEFAULT NULL,
  `level_one_commission` double(10, 2) NULL DEFAULT NULL COMMENT '一级佣金',
  `level_two` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '二级',
  `level_two_id` int(255) NULL DEFAULT NULL,
  `level_two_commission` double(10, 2) NULL DEFAULT NULL COMMENT '二级佣金',
  `level_three` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '三级',
  `level_three_id` int(255) NULL DEFAULT NULL,
  `level_three_commission` double(10, 2) NULL DEFAULT NULL COMMENT '三级佣金',
  `customer_nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '顾客昵称',
  `customer_id` int(255) NOT NULL COMMENT '顾客会员号',
  `order_id` int(255) NOT NULL COMMENT '订单号',
  `create_time` int(255) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of commission
-- ----------------------------
INSERT INTO `commission` VALUES (1, 70.00, NULL, NULL, NULL, '大番薯', 96114956, 52.50, '小番薯', 96111407, 17.50, '大冬瓜', 96111425, 2147481230, 1554186328);
INSERT INTO `commission` VALUES (2, 140.00, '大番薯', 96114956, 70.00, '小番薯', 96111407, 52.50, '大冬瓜', 96111425, 17.50, '秦先生', 96111448, 2147483501, 1554186469);
INSERT INTO `commission` VALUES (3, 15.00, NULL, NULL, NULL, NULL, NULL, NULL, '大番薯', 96114956, 15.00, '小番薯', 96111407, 2147483647, 1554186589);
INSERT INTO `commission` VALUES (4, 70.00, NULL, NULL, NULL, '大番薯', 96114956, 52.50, '小番薯', 96111407, 17.50, '大冬瓜', 96111425, 2147481230, 1554186898);
INSERT INTO `commission` VALUES (5, 140.00, '大番薯', 96114956, 70.00, '小番薯', 96111407, 52.50, '大冬瓜', 96111425, 17.50, '秦先生', 96111448, 2147483501, 1554186952);
INSERT INTO `commission` VALUES (6, 15.00, NULL, NULL, NULL, NULL, NULL, NULL, '大番薯', 96114956, 15.00, '小番薯', 96111407, 2147483647, 1554186962);
INSERT INTO `commission` VALUES (7, 1.00, NULL, NULL, NULL, NULL, NULL, NULL, '大番薯', 96114956, 1.00, '哆啦A梦', 103211389, 1554711238, 1554711296);
INSERT INTO `commission` VALUES (8, 8.00, '大番薯', 96114956, 4.00, '小番薯', 96111407, 3.00, '大冬瓜', 96111425, 1.00, '哆啦A梦', 103211389, 1554711448, 1554711480);
INSERT INTO `commission` VALUES (9, 28.00, '大番薯', 96114956, 10.00, '小番薯', 96111407, 7.50, '大冬瓜', 96111425, 2.50, '哆啦A梦', 103211389, 1554711608, 1554711643);
INSERT INTO `commission` VALUES (10, 84.00, '大番薯', 96114956, 40.00, '小番薯', 96111407, 30.00, '大冬瓜', 96111425, 10.00, '哆啦A梦', 103211389, 1554711771, 1554711821);

-- ----------------------------
-- Table structure for encash
-- ----------------------------
DROP TABLE IF EXISTS `encash`;
CREATE TABLE `encash`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `encash_id` int(255) NOT NULL,
  `membership_id` int(255) NOT NULL,
  `account` double(10, 2) NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `encash_type` int(255) NOT NULL COMMENT '提现方式',
  `create_time` int(255) NOT NULL COMMENT '申请时间',
  `status` int(255) NOT NULL COMMENT '0申请中1已打款2已驳回',
  `pay_time` int(255) NOT NULL COMMENT '打款时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of encash
-- ----------------------------
INSERT INTO `encash` VALUES (1, 125221552, 96114956, 50.50, '大番薯', 1, 1553933302, 1, 1554082220);
INSERT INTO `encash` VALUES (2, 675626097, 96114956, 55.50, '大番薯', 1, 1554079968, 1, 1554188145);
INSERT INTO `encash` VALUES (3, 678680115, 96114956, 55.50, '大番薯', 1, 1554080182, 1, 1554188159);
INSERT INTO `encash` VALUES (4, 958714202, 96114956, 55.50, '大番薯', 1, 1554079738, 1, 1554082316);

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
  `sale_num` int(255) NOT NULL COMMENT '销量',
  `primary_price` double(10, 2) NULL DEFAULT NULL COMMENT '原价',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES (1, 640437952, '电风扇', 20.00, 668099167, 'http://bs-api.barry.umdev.cn/static/uploads/20190328/75b34c39173e14ad87cee3894656ebbf.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/280952189fc2a0d97fc4c00d3264f586.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/495b41f15f5521aeb543d6074bb0e4f9.jpg', 1, 79, '<p>风<img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190328/d0c4298f6f53806c77884e673d26579c.jpg\" /></p>', 10.00, 1553764043, 0, NULL);
INSERT INTO `goods` VALUES (2, 664841126, '扫地机器人', 50.00, 583907635, 'http://bs-api.barry.umdev.cn/static/uploads/20190328/5307919f5b54dc211ad0c1ece8177247.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/7413e93480e424944596e26e5a63cdce.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/82b815a3b49eeeae28863562d0860b1e.jpg', 1, 965, '<p><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190328/50c8400dae08c258735726f886ba3d0a.jpg\" /></p>', 20.00, 1553766484, 0, NULL);
INSERT INTO `goods` VALUES (3, 200089124, '空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调', 100.00, 668099167, 'http://bs-api.barry.umdev.cn/static/uploads/20190329/6f04a6c814dd3c81b6cf48fc3d0bb901.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190329/9e0005294588ef43f45ae4ab4690ef1e.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190329/12da5772c4368dcd1b331f71c99fb8d9.jpg', 1, 71, '<p><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190407/1c1ad833882620793c8f242bc35becde.jpg\" /><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190407/acb4bac85beb95ade4b52ea2cac69684.jpg\" /><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190407/5f87225d1cdedd3301bf109c787b8e73.jpg\" /></p>\n<p>&nbsp;</p>\n<p>我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们</p>\n<p>我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们</p>\n<p>我们</p>\n<p>我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们</p>\n<p>&nbsp;</p>\n<p>&nbsp; &nbsp; &nbsp;我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们我们</p>', 10.00, 1553820008, 0, NULL);
INSERT INTO `goods` VALUES (4, 954434068, '祝悦一号', 10.00, 953716865, 'http://bs-api.barry.umdev.cn/static/uploads/20190408/cede131b645be32985a0cf2bf37a78ba.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190408/4c74f8e0524933502901c1a9a6dcb3a8.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190408/b9bdfa2d50a698b1d6e2854d988e3ef9.jpg', 1, 1570, '<p><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190408/ec2b9efb9077c1686f15daf13d56e32d.jpg\" /><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190408/06dee2825c64c030f94f5279135298c3.jpg\" /><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190408/0334812d8641850923e3cb69bbc6e30d.jpg\" /></p>', 10.00, 1554695443, 0, NULL);

-- ----------------------------
-- Table structure for goods_specification
-- ----------------------------
DROP TABLE IF EXISTS `goods_specification`;
CREATE TABLE `goods_specification`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `goods_id` int(255) NOT NULL COMMENT '商品编号',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '规格名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
INSERT INTO `goods_specification` VALUES (9, 954434068, '一号色');
INSERT INTO `goods_specification` VALUES (10, 954434068, '二号色');
INSERT INTO `goods_specification` VALUES (11, 954434068, '三好色');

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
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of goods_type
-- ----------------------------
INSERT INTO `goods_type` VALUES (42, 583901056, 1, '包', '', 0, 1553758390);
INSERT INTO `goods_type` VALUES (43, 583907635, 2, '小包', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/548b6d0cfa33a89d492b1ee10f42421a.jpg', 583901056, 1553758390);
INSERT INTO `goods_type` VALUES (44, 583909172, 2, '大包', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/13a306b9c078e54f5841f9d5f01ef36f.jpg', 583901056, 1553758390);
INSERT INTO `goods_type` VALUES (49, 668091332, 1, '家电', '', 0, 1553766809);
INSERT INTO `goods_type` VALUES (50, 668099167, 2, '电器', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/f744264c9037740074d3884596854da7.jpg', 668091332, 1553766809);
INSERT INTO `goods_type` VALUES (51, 953712429, 1, '化妆品', '', 0, 1554695371);
INSERT INTO `goods_type` VALUES (52, 953716865, 2, '粉底液', 'http://bs-api.barry.umdev.cn/static/uploads/20190408/3e4d35605cf3f0ecc059294f170a870f.jpg', 953712429, 1554695371);

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
  `sale_account` double(255, 2) NOT NULL COMMENT '销售额',
  `expense` double(255, 2) UNSIGNED NOT NULL,
  `create_time` int(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `referrer_id` int(255) NOT NULL,
  `referrer` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(255) NOT NULL COMMENT '0未申请 1待审核 2已同意 3已拒绝 4已禁用',
  `is_shopper` int(255) NOT NULL COMMENT '1是0否',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '头像',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of membership
-- ----------------------------
INSERT INTO `membership` VALUES (21, 96114956, '张三', '大番薯', '15138389776', 50.00, 0.00, 0.00, 0.00, 1554048332, '4297f44b13955235245b2497399d7a93', 0, '', 2, 1, 'static/uploads/20190403/a29e82924ae3fd627b6dcd79ae95addc.jpg');
INSERT INTO `membership` VALUES (23, 96111407, '李四', '小番薯', '17611319611', 37.50, 0.00, 0.00, 0.00, 1554048332, '4297f44b13955235245b2497399d7a93', 96114956, '大番薯', 1, 1, 'static/uploads/20190403/a29e82924ae3fd627b6dcd79ae95addc.jpg');
INSERT INTO `membership` VALUES (24, 96111425, '赵六', '大冬瓜', '17611319612', 12.50, 0.00, 0.00, 0.00, 1554048332, '4297f44b13955235245b2497399d7a93', 96111407, '小番薯', 2, 1, 'static/uploads/20190403/a29e82924ae3fd627b6dcd79ae95addc.jpg');
INSERT INTO `membership` VALUES (25, 96111448, '王八', '秦先生', '17611319613', 0.00, 0.00, 0.00, 0.00, 1554048332, '4297f44b13955235245b2497399d7a93', 96111425, '大冬瓜', 4, 0, 'static/uploads/20190403/a29e82924ae3fd627b6dcd79ae95addc.jpg');
INSERT INTO `membership` VALUES (40, 103211389, '王五', '哆啦A梦', '15038010321', 100.00, 320.00, 100.00, 100.00, 1554271389, '4297f44b13955235245b2497399d7a93', 96114956, '大番薯', 0, 0, 'static/uploads/20190403/640b6ffc3ae5f60f3f998cadb5935546.jpg');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES (1, '重大消息通知', '<p><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190401/1ac298c3ae3510283af007fa90fb62b3.jpg\" /></p>', '拼团活动打促销', 1554082486);
INSERT INTO `message` VALUES (2, '重要通知', '<div>\n<p>昨天，朋友小夕跟我吐槽，自己遇到了一个情商特别低的人，差点耽误了她的工作。</p>\n<p>原来，不久后，小夕要出国办公谈业务，需要办理签证，而办签证需要提供加盖公司公章的收入证明。</p>\n<p>于是，小夕做好了收入证明，准备拿给掌管公章的同事盖章。</p>\n<p>结果，当天领导不在，小夕无法把盖章事由给领导签字，而那位掌管公章的同事又特别不好说话，不敢在权限范围外盖章，又不愿先打电话知会领导，盖完章再找领导签字。</p>\n<p>小夕解释，自己这是为了办签证，由于出差的时间比较近，拿到签证还需要一段时间，如果不能及时盖章可能会耽误工作，希望能够通融一下。</p>\n<p>可这位同事认死理，只能先签字，再盖章，小夕只好悻悻地回去，等领导在的时候再跑一趟。</p>\n<p>后来，小夕跟同事说了这件事之后才知道，那位管理公章的同事，一向迂腐、情商低，已经得罪了不少人。</p>\n<p>其实，我们生活中有很多这样的人，他们永远坚守着自己的准则，活在道德规定的条条框框里，只做符合规则的事，阅读只读&ldquo;名著&rdquo;，听歌只听&ldquo;有内涵&rdquo;的&hellip;&hellip;</p>\n<p>如果你情绪激动说了脏话，他们就会告诉你文明人该如何说话。</p>\n<p>如果孩子只想在长大后当个普通的打工仔，他们就会告诉孩子&ldquo;不想当将军的士兵不是好士兵&rdquo;。</p>\n<p><strong>这不是情商低，而是三观太正</strong>。</p>\n</div>', '本我是最原始的我，是生理和物质的我，超我是道德的我，而自我在中间调节和平衡本我和超我。三观太正的人就是超我比较强，本我比较弱，自我比较偏向超我的情况。', 1554701692);
INSERT INTO `message` VALUES (3, '重要通知', '<div>\n<p>昨天，朋友小夕跟我吐槽，自己遇到了一个情商特别低的人，差点耽误了她的工作。</p>\n<p>原来，不久后，小夕要出国办公谈业务，需要办理签证，而办签证需要提供加盖公司公章的收入证明。</p>\n<p>于是，小夕做好了收入证明，准备拿给掌管公章的同事盖章。</p>\n<p>结果，当天领导不在，小夕无法把盖章事由给领导签字，而那位掌管公章的同事又特别不好说话，不敢在权限范围外盖章，又不愿先打电话知会领导，盖完章再找领导签字。</p>\n<p>小夕解释，自己这是为了办签证，由于出差的时间比较近，拿到签证还需要一段时间，如果不能及时盖章可能会耽误工作，希望能够通融一下。</p>\n<p>可这位同事认死理，只能先签字，再盖章，小夕只好悻悻地回去，等领导在的时候再跑一趟。</p>\n<p>后来，小夕跟同事说了这件事之后才知道，那位管理公章的同事，一向迂腐、情商低，已经得罪了不少人。</p>\n<p>其实，我们生活中有很多这样的人，他们永远坚守着自己的准则，活在道德规定的条条框框里，只做符合规则的事，阅读只读&ldquo;名著&rdquo;，听歌只听&ldquo;有内涵&rdquo;的&hellip;&hellip;</p>\n<p>如果你情绪激动说了脏话，他们就会告诉你文明人该如何说话。</p>\n<p>如果孩子只想在长大后当个普通的打工仔，他们就会告诉孩子&ldquo;不想当将军的士兵不是好士兵&rdquo;。</p>\n<p><strong>这不是情商低，而是三观太正</strong>。</p>\n<p><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190408/8b2649f944c36b816c66f1df1066db45.jpg\" /><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190408/17db1d68d830dca0580aecdf422ad37e.jpg\" /><img class=\"wscnph\" src=\"http://bs-api.barry.umdev.cn/static/uploads/20190408/166afb2edcdd2e085d39b3f8143703ce.jpg\" /></p>\n</div>', '本我是最原始的我，是生理和物质的我，超我是道德的我，而自我在中间调节和平衡本我和超我。三观太正的人就是超我比较强，本我比较弱，自我比较偏向超我的情况。', 1554702720);

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
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (31, 1554707026, '总店', 0, '哆啦A梦', '王五', 103211389, 70.00, 5, 1554707026, 1554710476, 0, 1554708794, '老白', '15138389776', '北京北京市海淀区上地三街嘉华大厦123号', '123', '123', '123', 0, '', 1, '113212254', 20.00, '');
INSERT INTO `order` VALUES (33, 1554711238, '大番薯', 96114956, '哆啦A梦', '王五', 103211389, 20.00, 3, 1554711238, 0, 0, 1554711241, '老白', '15138389776', '北京北京市海淀区上地三街嘉华大厦123号', '', '', '', 0, '', 1, '123', 10.00, '');
INSERT INTO `order` VALUES (34, 1554711448, '大冬瓜', 96111425, '哆啦A梦', '王五', 103211389, 20.00, 3, 1554711448, 0, 0, 1554711450, '老白', '15138389776', '北京北京市海淀区上地三街嘉华大厦123号', '', '', '', 0, '', 2, '123', 10.00, '');
INSERT INTO `order` VALUES (35, 1554711608, '大冬瓜', 96111425, '哆啦A梦', '王五', 103211389, 70.00, 3, 1554711608, 0, 0, 1554711610, '老白', '15138389776', '北京北京市海淀区上地三街嘉华大厦123号', '', '', '', 0, '', 2, '23456', 20.00, '');
INSERT INTO `order` VALUES (36, 1554711771, '大冬瓜', 96111425, '哆啦A梦', '王五', 103211389, 210.00, 3, 1554711771, 0, 0, 1554711792, '老白', '15138389776', '北京北京市海淀区上地三街嘉华大厦123号', '', '', '', 0, '', 4, '123', 10.00, '');

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
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '商品属性',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of order_goods
-- ----------------------------
INSERT INTO `order_goods` VALUES (42, 1554707026, 664841126, '扫地机器人', 50.00, 'http://bs-api.barry.umdev.cn/static/uploads/20190328/5307919f5b54dc211ad0c1ece8177247.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/7413e93480e424944596e26e5a63cdce.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/82b815a3b49eeeae28863562d0860b1e.jpg', 20.00, 1, '蓝色');
INSERT INTO `order_goods` VALUES (44, 1554711238, 954434068, '祝悦一号', 10.00, 'http://bs-api.barry.umdev.cn/static/uploads/20190408/cede131b645be32985a0cf2bf37a78ba.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190408/4c74f8e0524933502901c1a9a6dcb3a8.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190408/b9bdfa2d50a698b1d6e2854d988e3ef9.jpg', 10.00, 1, '二号色');
INSERT INTO `order_goods` VALUES (45, 1554711448, 954434068, '祝悦一号', 10.00, 'http://bs-api.barry.umdev.cn/static/uploads/20190408/cede131b645be32985a0cf2bf37a78ba.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190408/4c74f8e0524933502901c1a9a6dcb3a8.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190408/b9bdfa2d50a698b1d6e2854d988e3ef9.jpg', 10.00, 1, '二号色');
INSERT INTO `order_goods` VALUES (46, 1554711608, 664841126, '扫地机器人', 50.00, 'http://bs-api.barry.umdev.cn/static/uploads/20190328/5307919f5b54dc211ad0c1ece8177247.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/7413e93480e424944596e26e5a63cdce.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190328/82b815a3b49eeeae28863562d0860b1e.jpg', 20.00, 1, '蓝色');
INSERT INTO `order_goods` VALUES (47, 1554711771, 200089124, '空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调空调', 100.00, 'http://bs-api.barry.umdev.cn/static/uploads/20190329/6f04a6c814dd3c81b6cf48fc3d0bb901.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190329/9e0005294588ef43f45ae4ab4690ef1e.jpg', 'http://bs-api.barry.umdev.cn/static/uploads/20190329/12da5772c4368dcd1b331f71c99fb8d9.jpg', 10.00, 2, '中等功率');

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
INSERT INTO `regulation` VALUES (1, 1, 3.00, 1.00, 1, '标题2', '这是一条购买协议\n这是一条购买协议', 20.00, 15.00, 5.00);

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
INSERT INTO `sys_user` VALUES (1, '15138389776', 'e10adc3949ba59abbe56e057f20f883e', '大番薯', '张三', 'admin', 'static/uploads/20190401/789919594a0402d8eeef995b7864a98b.jpg');
INSERT INTO `sys_user` VALUES (17, '17611319611', '4297f44b13955235245b2497399d7a93', '小番薯', '徐大大', 'manager', 'static/uploads/20190327/c5a5d4d6bf5e321bbb4b26fd27fd4f25.jpg');

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
