/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : db_shop

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-06-08 13:19:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_address
-- ----------------------------
DROP TABLE IF EXISTS `tb_address`;
CREATE TABLE `tb_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `info` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT '1',
  `createtime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(13) NOT NULL DEFAULT '',
  `province` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `area` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_address
-- ----------------------------
INSERT INTO `tb_address` VALUES ('1', '1', '北华大学', '1', '2018-05-27 10:51:27', null, '15945678945', '北京市', '北京市市辖区', '东城区', '郝帅');
INSERT INTO `tb_address` VALUES ('2', '1', '新地山湾', '1', '2018-05-29 20:03:47', null, '15590062337', '山西省', '阳泉市', '平定县', '郝铁柱');
INSERT INTO `tb_address` VALUES ('3', '1', '', '1', '2018-06-05 21:00:48', null, '15590062337', '吉林', '吉林', '吉林', 'haha');

-- ----------------------------
-- Table structure for tb_banner
-- ----------------------------
DROP TABLE IF EXISTS `tb_banner`;
CREATE TABLE `tb_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `createtime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_banner
-- ----------------------------
INSERT INTO `tb_banner` VALUES ('1', '123', 'https://img3.doubanio.com/img/files/file-1527764147-0.jpg', '2', '2018-06-05 15:42:36', '2018-06-05 15:42:36', '1');
INSERT INTO `tb_banner` VALUES ('2', '456', 'https://img3.doubanio.com/img/files/file-1525686721-1.jpg', '3', '2018-06-05 15:42:42', '2018-06-05 15:42:42', '1');
INSERT INTO `tb_banner` VALUES ('3', '789', 'https://img3.doubanio.com/img/files/file-1524881486-0.jpg', '4', '2018-06-05 15:42:47', '2018-06-05 15:42:47', '1');
INSERT INTO `tb_banner` VALUES ('4', '好看', 'https://img3.doubanio.com/img/files/file-1524122635-0.jpg', 'www.baidu.com', '2018-06-05 15:42:53', '2018-06-05 15:42:53', '1');
INSERT INTO `tb_banner` VALUES ('5', '好玩222', 'https://img3.doubanio.com/img/files/file-1524199263-0.jpg', 'http://www.sina.com', '2018-06-05 15:43:00', '2018-06-05 15:43:00', '1');
INSERT INTO `tb_banner` VALUES ('6', 'xixi', 'https://img3.doubanio.com/img/files/file-1527764147-0.jpg', '5', '2018-06-05 15:43:01', '2018-06-05 15:43:01', '1');

-- ----------------------------
-- Table structure for tb_cart
-- ----------------------------
DROP TABLE IF EXISTS `tb_cart`;
CREATE TABLE `tb_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `goods_num` int(11) NOT NULL DEFAULT '0',
  `goods_price` int(11) NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT '1',
  `createtime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT '',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_goods` (`goods_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_cart
-- ----------------------------
INSERT INTO `tb_cart` VALUES ('14', '5', '1', '108', '50', '1', '2018-06-03 10:11:49', '2018-06-03 10:11:49', './Uploads/2018-05-24/5b06837350b9a.jpg', 'wanfan');
INSERT INTO `tb_cart` VALUES ('29', '7', '1', '2', '69', '1', '2018-06-03 10:32:29', '2018-06-03 10:32:29', './Uploads/2018-05-26/5b09048eb07d6.jpg', '书包');
INSERT INTO `tb_cart` VALUES ('30', '6', '1', '4', '80', '1', '2018-06-03 10:04:07', '2018-06-03 10:04:07', './Uploads/2018-05-25/5b07c6d73dc19.png', '麻辣烫');
INSERT INTO `tb_cart` VALUES ('52', '2', '1', '1', '1', '1', '2018-06-03 10:04:00', '2018-06-03 10:04:00', './Uploads/2018-05-24/5b067fd0b7155.JPG', '1');
INSERT INTO `tb_cart` VALUES ('53', '1', '1', '2', '99', '1', '2018-06-06 10:55:25', null, 'https://img3.doubanio.com/view/dianpu_page_widget/raw/public/e020e63fbde3646.jpg', '豆瓣收藏夹');
INSERT INTO `tb_cart` VALUES ('54', '1', '2', '10', '0', '1', '2018-06-07 20:46:47', '2018-06-07 20:46:47', 'https://img3.doubanio.com/view/dianpu_page_widget/raw/public/e020e63fbde3646.jpg', '豆瓣收藏夹');

-- ----------------------------
-- Table structure for tb_comment
-- ----------------------------
DROP TABLE IF EXISTS `tb_comment`;
CREATE TABLE `tb_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` varchar(100) NOT NULL,
  `create_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_comment
-- ----------------------------

-- ----------------------------
-- Table structure for tb_goods
-- ----------------------------
DROP TABLE IF EXISTS `tb_goods`;
CREATE TABLE `tb_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(50) NOT NULL DEFAULT '',
  `goods_info` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `tag_id` varchar(255) DEFAULT '',
  `createtime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `price` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_goods
-- ----------------------------
INSERT INTO `tb_goods` VALUES ('1', '豆瓣收藏夹', '万千票据一本搞定，珍藏你的回忆', 'https://img3.doubanio.com/view/dianpu_page_widget/raw/public/e020e63fbde3646.jpg', '2', '2018-06-05 15:37:35', '2018-06-05 15:37:35', '1', '9900');
INSERT INTO `tb_goods` VALUES ('2', '豆瓣心茶', '联手百年茶庄王德传，精心窖制花茶', 'https://img3.doubanio.com/view/dianpu_page_widget/raw/public/1c8bdf9ec12dee4.jpg', '2', '2018-06-05 15:37:39', '2018-06-05 15:37:39', '1', '6800');
INSERT INTO `tb_goods` VALUES ('3', '双肩包·「三刻」', '双肩斜挎瞬间变形，多仓储存容量大', 'https://img3.doubanio.com/view/dianpu_page_widget/raw/public/cf603f96874d866.jpg', '1', '2018-06-05 15:37:45', '2018-06-05 15:37:45', '1', '49900');
INSERT INTO `tb_goods` VALUES ('4', '精品挂耳咖啡', '甄选COE获奖精品咖啡，香浓可口', 'https://img3.doubanio.com/view/dianpu_page_widget/raw/public/94610e62b8d7936.jpg', '1', '2018-06-05 15:37:50', '2018-06-05 15:37:50', '1', '5600');
INSERT INTO `tb_goods` VALUES ('5', '手机壳·电影畅想系列', '经典电影元素图案，防磨防刮抗摔打', 'https://img3.doubanio.com/view/dianpu_page_widget/raw/public/b5dc77cf3bd7a20.jpg', '1', '2018-06-05 15:37:55', '2018-06-05 15:37:55', '1', '4800');
INSERT INTO `tb_goods` VALUES ('6', '布面精装本', '落笔顺畅不洇墨，在书写中相遇世界', 'https://img1.doubanio.com/view/dianpu_page_widget/raw/public/aa69db404b73b99.jpg', '2', '2018-06-05 15:38:03', '2018-06-05 15:38:03', '1', '4800');
INSERT INTO `tb_goods` VALUES ('7', '帆布包·早餐系列', '简约版型，多层收纳，清爽文艺百搭', 'https://img1.doubanio.com/view/dianpu_page_widget/raw/public/4d784545429b759.jpg', '2', '2018-06-05 15:38:10', '2018-06-05 15:38:10', '1', '14900');
INSERT INTO `tb_goods` VALUES ('8', '豆瓣电影日历', '高分片单，翻页设计，陪你感受时光', 'https://img3.doubanio.com/view/dianpu_page_widget/raw/public/025756b97d6de64.jpg', '3', '2018-06-05 15:38:17', '2018-06-05 15:38:17', '1', '9800');

-- ----------------------------
-- Table structure for tb_order
-- ----------------------------
DROP TABLE IF EXISTS `tb_order`;
CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `address_id` int(11) NOT NULL DEFAULT '1',
  `pay_status` int(11) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL,
  `createtime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_order
-- ----------------------------

-- ----------------------------
-- Table structure for tb_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `tb_order_goods`;
CREATE TABLE `tb_order_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `goods_price` int(11) NOT NULL,
  `goods_num` int(11) NOT NULL,
  `order_money` int(11) NOT NULL,
  `createtime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_order_goods
-- ----------------------------

-- ----------------------------
-- Table structure for tb_order_tmp
-- ----------------------------
DROP TABLE IF EXISTS `tb_order_tmp`;
CREATE TABLE `tb_order_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_info` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_order_tmp
-- ----------------------------
INSERT INTO `tb_order_tmp` VALUES ('44', '[{\"goodsId\":\"2\",\"count\":\"1\"}]', '1');
INSERT INTO `tb_order_tmp` VALUES ('45', '[{\"goodsId\":\"7\",\"count\":\"2\"},{\"goodsId\":\"1\",\"count\":\"1\"}]', '1');
INSERT INTO `tb_order_tmp` VALUES ('46', '[{\"goodsId\":\"1\",\"count\":\"2\"}]', '1');

-- ----------------------------
-- Table structure for tb_tags
-- ----------------------------
DROP TABLE IF EXISTS `tb_tags`;
CREATE TABLE `tb_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(20) NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_tags
-- ----------------------------
INSERT INTO `tb_tags` VALUES ('1', '新品', 'rgb(242, 190, 64)');
INSERT INTO `tb_tags` VALUES ('2', '热卖', 'rgb(155, 155, 155)');
INSERT INTO `tb_tags` VALUES ('3', '售罄', 'rgb(155, 155, 155)');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `password` varchar(32) NOT NULL,
  `createtime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updatetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `account` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'haoshuai777', '15590062337', 'Haoshuai666', '2018-06-06 10:40:19', '2018-06-06 10:40:19', '1', '100');
INSERT INTO `tb_user` VALUES ('2', 'haoshuai111', '15590062337', 'Haoshuai666', null, null, '1', '0');
INSERT INTO `tb_user` VALUES ('3', 'hahah11', '13659598979', 'Haoshuai1111', null, null, '1', '0');
INSERT INTO `tb_user` VALUES ('4', 'ahaha11', '15965659595', 'Haoshuai111', '2018-05-27 10:00:09', null, '1', '0');
INSERT INTO `tb_user` VALUES ('5', 'Nihao666', '13689895959', 'Haoshuai999', '2018-06-06 09:38:05', '2018-06-06 09:38:05', '1', '5000');
INSERT INTO `tb_user` VALUES ('6', 'Nihao666', '13689895959', 'Haoshuai999', '2018-06-06 10:45:29', null, '1', '0');
INSERT INTO `tb_user` VALUES ('7', '呃呃呃', '呃呃呃', 'ee', '2018-06-07 14:58:32', null, '1', '0');
INSERT INTO `tb_user` VALUES ('8', '123', '123', '123', '2018-06-07 15:01:18', null, '1', '0');
INSERT INTO `tb_user` VALUES ('9', '123', '123', '123', '2018-06-07 15:01:20', null, '1', '0');
INSERT INTO `tb_user` VALUES ('10', '123', '123', '123', '2018-06-07 15:01:21', null, '1', '0');
INSERT INTO `tb_user` VALUES ('11', '123', '123', '123', '2018-06-07 15:01:54', null, '1', '0');
INSERT INTO `tb_user` VALUES ('12', '123', '123', '123', '2018-06-07 15:01:54', null, '1', '0');
INSERT INTO `tb_user` VALUES ('13', '骆', '123', '123', '2018-06-07 15:02:08', null, '1', '0');
INSERT INTO `tb_user` VALUES ('14', '骆', '123', 'aaaa', '2018-06-07 15:02:31', null, '1', '0');
INSERT INTO `tb_user` VALUES ('15', '哈喽', '112345678', '12345', '2018-06-07 15:03:20', null, '1', '0');
INSERT INTO `tb_user` VALUES ('16', '哈喽', '112345678', '234', '2018-06-07 15:04:04', null, '1', '0');
