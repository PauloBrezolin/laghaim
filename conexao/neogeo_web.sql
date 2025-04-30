/*
 Navicat Premium Data Transfer

 Source Server         : locallaghaim
 Source Server Type    : MySQL
 Source Server Version : 100125
 Source Host           : 127.0.0.1:3306
 Source Schema         : neogeo_web

 Target Server Type    : MySQL
 Target Server Version : 100125
 File Encoding         : 65001

 Date: 19/03/2022 16:36:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_admininfo
-- ----------------------------
DROP TABLE IF EXISTS `t_admininfo`;
CREATE TABLE `t_admininfo`  (
  `a_index` int(10) NOT NULL AUTO_INCREMENT,
  `a_username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_password` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_displayname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_rights` int(11) NOT NULL DEFAULT 0,
  `a_role` int(11) NOT NULL DEFAULT 0,
  `a_enable` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_admininfo
-- ----------------------------
INSERT INTO `t_admininfo` VALUES (1, 'AdminAccount', '3308df2c776f7bb6c5042835f4defa34', 'Administrator', 2147483647, 1, 1);

-- ----------------------------
-- Table structure for t_adminlog
-- ----------------------------
DROP TABLE IF EXISTS `t_adminlog`;
CREATE TABLE `t_adminlog`  (
  `a_index` int(10) NOT NULL AUTO_INCREMENT,
  `a_admin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `a_time` int(11) NOT NULL DEFAULT 0,
  `a_ip` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `a_hostname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_adminlog
-- ----------------------------
INSERT INTO `t_adminlog` VALUES (1, 'AdminAccount', 1610836564, '168.0.36.0', '168.0.36.0');
INSERT INTO `t_adminlog` VALUES (2, 'AdminAccount', 1628870735, '170.233.32.143', 'guaratiba.net.br');
INSERT INTO `t_adminlog` VALUES (3, 'AdminAccount', 1629631868, '170.233.33.131', 'guaratiba.net.br');
INSERT INTO `t_adminlog` VALUES (4, 'AdminAccount', 1630346467, '189.92.215.42', '189-92-215-42.3g.claro.net.br');
INSERT INTO `t_adminlog` VALUES (5, 'AdminAccount', 1637349260, '170.233.35.141', 'guaratiba.net.br');
INSERT INTO `t_adminlog` VALUES (6, 'AdminAccount', 1638118915, '170.233.32.227', 'guaratiba.net.br');
INSERT INTO `t_adminlog` VALUES (7, 'AdminAccount', 1638899138, '189.104.174.85', '189-104-174-85.user3g.veloxzone.com.br');
INSERT INTO `t_adminlog` VALUES (8, 'AdminAccount', 1640216194, '127.0.0.1', 'activate.navicat.com');
INSERT INTO `t_adminlog` VALUES (9, 'AdminAccount', 1641427831, '127.0.0.1', 'activate.navicat.com');
INSERT INTO `t_adminlog` VALUES (10, 'AdminAccount', 1641655052, '127.0.0.1', 'activate.navicat.com');
INSERT INTO `t_adminlog` VALUES (11, 'AdminAccount', 1641856275, '127.0.0.1', 'activate.navicat.com');
INSERT INTO `t_adminlog` VALUES (12, 'AdminAccount', 1641861858, '127.0.0.1', 'activate.navicat.com');
INSERT INTO `t_adminlog` VALUES (13, 'AdminAccount', 1642454892, '127.0.0.1', 'activate.navicat.com');
INSERT INTO `t_adminlog` VALUES (14, 'AdminAccount', 1642455677, '127.0.0.1', 'activate.navicat.com');

-- ----------------------------
-- Table structure for t_banlist
-- ----------------------------
DROP TABLE IF EXISTS `t_banlist`;
CREATE TABLE `t_banlist`  (
  `a_index` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) UNSIGNED NOT NULL,
  `a_timestamp` int(11) UNSIGNED NOT NULL,
  `a_reason` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `a_admin_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `a_action` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `a_bantime` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `a_gmreason` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_donate_log
-- ----------------------------
DROP TABLE IF EXISTS `t_donate_log`;
CREATE TABLE `t_donate_log`  (
  `a_index` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(10) UNSIGNED NULL DEFAULT 0,
  `a_timestamp` int(10) UNSIGNED NULL DEFAULT 0,
  `a_euro` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `a_points` int(10) NULL DEFAULT 0,
  `a_gm` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `a_ref` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `a_reason` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_donate_log
-- ----------------------------
INSERT INTO `t_donate_log` VALUES (1, 3, 1628809155, '0', 999999, 'Administrator', '', '');
INSERT INTO `t_donate_log` VALUES (2, 1, 1628809266, '0', 999999, 'Administrator', '', '');
INSERT INTO `t_donate_log` VALUES (3, 1, 1630246352, '0', 800000, 'Administrator', '', '');

-- ----------------------------
-- Table structure for t_emails
-- ----------------------------
DROP TABLE IF EXISTS `t_emails`;
CREATE TABLE `t_emails`  (
  `a_index` int(11) NOT NULL AUTO_INCREMENT,
  `a_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_giveitemlog
-- ----------------------------
DROP TABLE IF EXISTS `t_giveitemlog`;
CREATE TABLE `t_giveitemlog`  (
  `a_index` int(11) NOT NULL AUTO_INCREMENT,
  `a_user_idx` int(11) NOT NULL DEFAULT -1,
  `a_item_idx` int(11) NOT NULL DEFAULT 0,
  `a_plus` int(11) NOT NULL DEFAULT 0,
  `a_count` int(11) NOT NULL DEFAULT 1,
  `a_time` int(11) NOT NULL DEFAULT 0,
  `a_ip` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_reason` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_gm` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_levelevent_valiant
-- ----------------------------
DROP TABLE IF EXISTS `t_levelevent_valiant`;
CREATE TABLE `t_levelevent_valiant`  (
  `a_index` int(11) NOT NULL AUTO_INCREMENT,
  `a_user_idx` int(11) NOT NULL DEFAULT -1,
  `a_char_idx` int(11) NOT NULL DEFAULT -1,
  `a_char_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_char_level` int(11) NOT NULL DEFAULT 0,
  `a_char_race` int(11) NOT NULL DEFAULT -1,
  `a_taken` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_log
-- ----------------------------
DROP TABLE IF EXISTS `t_log`;
CREATE TABLE `t_log`  (
  `a_index` int(10) NOT NULL AUTO_INCREMENT,
  `a_admin` int(10) NOT NULL DEFAULT 0,
  `a_ip` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_host` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_date` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `a_user_idx` int(10) NOT NULL DEFAULT -1,
  `a_char_idx` int(10) NOT NULL DEFAULT -1,
  `a_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `a_action` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 77 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_log
-- ----------------------------
INSERT INTO `t_log` VALUES (1, 1, '170.233.34.149', 'guaratiba.net.br ', '2021-08-12 18:57:35', 1, 1, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (2, 1, '170.233.34.149', 'guaratiba.net.br ', '2021-08-12 18:58:28', 1, 1, 'EDIT CHARACTER', 'Column[a_level] From[1] To[1000]');
INSERT INTO `t_log` VALUES (3, 1, '170.233.34.149', 'guaratiba.net.br ', '2021-08-12 18:58:34', 1, 1, 'EDIT CHARACTER', 'Column[a_name] From[ADMTITAN] To[ADM]');
INSERT INTO `t_log` VALUES (4, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-13 17:32:23', 1, 3, 'EDIT CHARACTER', 'Column[a_level] From[1] To[1000]');
INSERT INTO `t_log` VALUES (5, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-13 17:42:27', 2, 4, 'EDIT CHARACTER', 'Column[a_level] From[1] To[1000]');
INSERT INTO `t_log` VALUES (6, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-13 17:44:10', 2, 5, 'EDIT CHARACTER', 'Column[a_level] From[1] To[1000]');
INSERT INTO `t_log` VALUES (7, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-13 17:45:35', 2, 6, 'EDIT CHARACTER', 'Column[a_level] From[200] To[1000]');
INSERT INTO `t_log` VALUES (8, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-13 17:46:56', 2, 7, 'EDIT CHARACTER', 'Column[a_level] From[250] To[1000]');
INSERT INTO `t_log` VALUES (9, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-13 17:47:21', 2, 7, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (10, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-13 17:47:53', 2, 2, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (11, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-13 17:48:50', 2, 4, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (12, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-13 17:49:01', 2, 5, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (13, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-13 17:49:10', 2, 6, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (14, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-14 15:34:38', 2, 7, 'EDIT CHARACTER', 'Column[a_admin] From[11] To[0]');
INSERT INTO `t_log` VALUES (15, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-14 15:34:51', 2, 4, 'EDIT CHARACTER', 'Column[a_admin] From[11] To[0]');
INSERT INTO `t_log` VALUES (16, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-14 15:35:07', 2, 5, 'EDIT CHARACTER', 'Column[a_admin] From[11] To[0]');
INSERT INTO `t_log` VALUES (17, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-14 15:35:19', 2, 6, 'EDIT CHARACTER', 'Column[a_admin] From[11] To[0]');
INSERT INTO `t_log` VALUES (18, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-14 15:35:32', 2, 2, 'EDIT CHARACTER', 'Column[a_admin] From[11] To[0]');
INSERT INTO `t_log` VALUES (19, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-14 15:35:47', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[256] To[1000]');
INSERT INTO `t_log` VALUES (20, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-15 07:47:53', 1, 3, 'EDIT CHARACTER', 'Column[a_level] From[1000] To[999]');
INSERT INTO `t_log` VALUES (21, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-15 07:49:15', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[1000] To[999]');
INSERT INTO `t_log` VALUES (22, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-15 07:49:22', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[999] To[999]');
INSERT INTO `t_log` VALUES (23, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-15 07:49:23', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[999] To[999]');
INSERT INTO `t_log` VALUES (24, 1, '170.233.32.143', 'guaratiba.net.br ', '2021-08-16 06:30:58', 3, 8, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (25, 1, '179.242.38.5', '179-242-38-5.3g.claro.net.br ', '2021-09-02 07:57:49', 2, -1, 'EDIT USER', 'Column[passwd] From[*D7876C77683E339296B44FB37D76CA8601464734] To[t39it@n2021++]');
INSERT INTO `t_log` VALUES (26, 1, '179.242.38.5', '179-242-38-5.3g.claro.net.br ', '2021-09-02 07:57:49', 2, -1, 'EDIT USER', 'Column[passwd] From[*D7876C77683E339296B44FB37D76CA8601464734] To[t39it@n2021++]');
INSERT INTO `t_log` VALUES (27, 1, '179.242.38.5', '179-242-38-5.3g.claro.net.br ', '2021-09-02 07:57:53', 2, -1, 'EDIT USER', 'Column[passwd] From[*12EAA63E48BDB53CE2ED45FF0EB82435288C857E] To[t39it@n2021++]');
INSERT INTO `t_log` VALUES (28, 1, '179.242.38.5', '179-242-38-5.3g.claro.net.br ', '2021-09-02 08:00:08', 2, 2, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (29, 1, '179.242.38.5', '179-242-38-5.3g.claro.net.br ', '2021-09-02 08:00:41', 2, 7, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (30, 1, '179.242.38.5', '179-242-38-5.3g.claro.net.br ', '2021-09-02 08:01:07', 2, 4, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (31, 1, '179.242.38.5', '179-242-38-5.3g.claro.net.br ', '2021-09-02 08:55:11', 2, 2, 'EDIT CHARACTER', 'Column[a_name] From[ester] To[GM]');
INSERT INTO `t_log` VALUES (32, 1, '179.242.38.5', '179-242-38-5.3g.claro.net.br ', '2021-09-02 08:55:21', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[1] To[1000]');
INSERT INTO `t_log` VALUES (33, 1, '179.242.38.5', '179-242-38-5.3g.claro.net.br ', '2021-09-02 08:55:33', 2, 2, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (34, 1, '170.233.35.141', 'guaratiba.net.br ', '2021-11-19 16:38:20', 2, 2, 'EDIT CHARACTER', 'Column[a_admin] From[11] To[0]');
INSERT INTO `t_log` VALUES (35, 1, '170.233.35.141', 'guaratiba.net.br ', '2021-11-19 17:09:31', 2, 2, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (36, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-22 20:37:53', 1, 7, 'EDIT CHARACTER', 'Column[a_level] From[500] To[800]');
INSERT INTO `t_log` VALUES (37, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-23 23:35:04', 1, 5, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (38, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-24 12:05:39', 1, 7, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (39, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-24 13:23:40', 1, 7, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (40, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-24 13:23:49', 1, 3, 'EDIT CHARACTER', 'Column[a_enable] From[0] To[11]');
INSERT INTO `t_log` VALUES (41, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-24 13:23:53', 1, 3, 'EDIT CHARACTER', 'Column[a_enable] From[11] To[1]');
INSERT INTO `t_log` VALUES (42, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-24 13:23:59', 1, 3, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (43, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-24 20:44:01', 1, 4, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (44, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-24 21:11:56', 1, 6, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (45, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-24 21:12:15', 1, 3, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (46, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-24 21:12:24', 1, 7, 'EDIT CHARACTER', 'Column[a_level] From[800] To[1000]');
INSERT INTO `t_log` VALUES (47, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-24 21:12:33', 1, 7, 'EDIT CHARACTER', 'Column[a_enable] From[0] To[1]');
INSERT INTO `t_log` VALUES (48, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-25 17:01:36', 1, 7, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (49, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-25 17:01:51', 1, 3, 'EDIT CHARACTER', 'Column[a_enable] From[0] To[1]');
INSERT INTO `t_log` VALUES (50, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-25 17:22:55', 1, 3, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (51, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-25 17:23:13', 1, 7, 'EDIT CHARACTER', 'Column[a_enable] From[0] To[1]');
INSERT INTO `t_log` VALUES (52, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-25 18:03:57', 1, 6, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (53, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-25 18:04:25', 1, 3, 'EDIT CHARACTER', 'Column[a_enable] From[0] To[1]');
INSERT INTO `t_log` VALUES (54, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-25 18:05:32', 1, 7, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (55, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-25 18:05:42', 1, 6, 'EDIT CHARACTER', 'Column[a_enable] From[0] To[1]');
INSERT INTO `t_log` VALUES (56, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-26 11:47:34', 1, 6, 'EDIT CHARACTER', 'Column[a_admin] From[11] To[0]');
INSERT INTO `t_log` VALUES (57, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-29 17:24:10', 1, 3, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (58, 1, '127.0.0.1', 'activate.navicat.com ', '2021-12-29 17:24:22', 1, 7, 'EDIT CHARACTER', 'Column[a_enable] From[0] To[1]');
INSERT INTO `t_log` VALUES (59, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-05 21:11:04', 1, 6, 'EDIT CHARACTER', 'Column[a_admin] From[0] To[11]');
INSERT INTO `t_log` VALUES (60, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 12:23:38', 2, 2, 'EDIT CHARACTER', 'Column[a_admin] From[11] To[0]');
INSERT INTO `t_log` VALUES (61, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 12:26:41', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[1000] To[500]');
INSERT INTO `t_log` VALUES (62, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 13:12:15', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[500] To[999]');
INSERT INTO `t_log` VALUES (63, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 13:42:23', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[999] To[300]');
INSERT INTO `t_log` VALUES (64, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 13:56:28', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[300] To[550]');
INSERT INTO `t_log` VALUES (65, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 15:18:16', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[550] To[1000]');
INSERT INTO `t_log` VALUES (66, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 15:24:38', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[1000] To[500]');
INSERT INTO `t_log` VALUES (67, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 15:59:15', 55, 77, 'EDIT CHARACTER', 'Column[a_name] From[RACISTAS] To[TerrorAidia]');
INSERT INTO `t_log` VALUES (68, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 15:59:50', 74, 111, 'EDIT CHARACTER', 'Column[a_name] From[RACISTA] To[Terror]');
INSERT INTO `t_log` VALUES (69, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 17:56:36', 74, 111, 'EDIT CHARACTER', 'Column[a_name] From[Terror] To[TerrorDoCeu]');
INSERT INTO `t_log` VALUES (70, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 17:56:56', 55, 77, 'EDIT CHARACTER', 'Column[a_name] From[TerrorAidia] To[NewThunder]');
INSERT INTO `t_log` VALUES (71, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-08 18:12:52', 55, 77, 'EDIT CHARACTER', 'Column[a_name] From[NewThunder] To[New]');
INSERT INTO `t_log` VALUES (72, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-09 18:45:03', 1, 7, 'EDIT CHARACTER', 'Column[a_enable] From[1] To[0]');
INSERT INTO `t_log` VALUES (73, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-09 18:45:20', 1, 3, 'EDIT CHARACTER', 'Column[a_enable] From[0] To[1]');
INSERT INTO `t_log` VALUES (74, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-09 20:19:42', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[500] To[1000]');
INSERT INTO `t_log` VALUES (75, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-10 20:13:42', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[1000] To[888]');
INSERT INTO `t_log` VALUES (76, 1, '127.0.0.1', 'activate.navicat.com ', '2022-01-10 20:19:34', 2, 2, 'EDIT CHARACTER', 'Column[a_level] From[888] To[333]');

-- ----------------------------
-- Table structure for t_logfind
-- ----------------------------
DROP TABLE IF EXISTS `t_logfind`;
CREATE TABLE `t_logfind`  (
  `a_index` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_status` int(11) NOT NULL DEFAULT 0,
  `a_gm` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_search` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_filesize` int(11) NOT NULL DEFAULT 0,
  `a_password` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_date_add` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `a_date_finish` timestamp(0) NOT NULL,
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_loginfail
-- ----------------------------
DROP TABLE IF EXISTS `t_loginfail`;
CREATE TABLE `t_loginfail`  (
  `a_ip` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_time` int(11) NOT NULL DEFAULT 0,
  `a_step` int(1) NOT NULL DEFAULT 1
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_mailchange
-- ----------------------------
DROP TABLE IF EXISTS `t_mailchange`;
CREATE TABLE `t_mailchange`  (
  `a_index` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) NOT NULL DEFAULT -1,
  `a_ip` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0.0.0.0',
  `a_newmail` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for t_onlinecount
-- ----------------------------
DROP TABLE IF EXISTS `t_onlinecount`;
CREATE TABLE `t_onlinecount`  (
  `a_index` int(11) NOT NULL AUTO_INCREMENT,
  `a_timestamp` int(11) NOT NULL DEFAULT 0,
  `a_total` int(11) NOT NULL DEFAULT 0,
  `a_chan1` int(11) NOT NULL DEFAULT 0,
  `a_chan2` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Online players per hour' ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for t_requestpass
-- ----------------------------
DROP TABLE IF EXISTS `t_requestpass`;
CREATE TABLE `t_requestpass`  (
  `a_index` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_username` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_code` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_addtime` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_used` int(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_requestpass
-- ----------------------------
INSERT INTO `t_requestpass` VALUES (1, 'bagpuss', 'a98201f199e5', 1612172589, 3);
INSERT INTO `t_requestpass` VALUES (2, 'bagpuss', 'f18f135bcede', 1612174687, 0);
INSERT INTO `t_requestpass` VALUES (3, 'ezon1705', '4256dd670632', 1612329832, 0);
INSERT INTO `t_requestpass` VALUES (4, 'ledark', 'b74b6c5e16b3', 1613929345, 0);
INSERT INTO `t_requestpass` VALUES (5, 'laura', '01323aa6ccbf', 1617053592, 0);

-- ----------------------------
-- Table structure for t_roles
-- ----------------------------
DROP TABLE IF EXISTS `t_roles`;
CREATE TABLE `t_roles`  (
  `a_index` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_rights` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000',
  `a_color` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '000000',
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_roles
-- ----------------------------
INSERT INTO `t_roles` VALUES (1, 'Administrator', '11111111111111111111111111111111111111111111111111111111111111111111000111100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000', 'FF0000');
INSERT INTO `t_roles` VALUES (2, 'Head GameMaster', '11111111111011111111111111111011111111111111111111111111110111000100100011100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000', 'FFF947');
INSERT INTO `t_roles` VALUES (3, 'GameMaster', '11111111111000000000000000000010100100101010110111111100100110111100010011100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000', '0A7CFF');
INSERT INTO `t_roles` VALUES (4, 'Trial GameMaster', '11100100000000000000000000000010100100101010110001001100100000000100001011100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000', '6C89AB');
INSERT INTO `t_roles` VALUES (7, 'Full GameMaster', '11111111111010001001000000001010111100101110110111111111100110000100010011100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000', 'FA7CFF');

-- ----------------------------
-- Table structure for t_unstuck_log
-- ----------------------------
DROP TABLE IF EXISTS `t_unstuck_log`;
CREATE TABLE `t_unstuck_log`  (
  `a_index` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) NOT NULL DEFAULT -1,
  `a_ip` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0.0.0.0',
  `a_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_unstuck_log
-- ----------------------------
INSERT INTO `t_unstuck_log` VALUES (1, 1, '127.0.0.1', '2022-01-17 18:47:47');

-- ----------------------------
-- Table structure for t_user_validation
-- ----------------------------
DROP TABLE IF EXISTS `t_user_validation`;
CREATE TABLE `t_user_validation`  (
  `a_index` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_username` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_password` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_email` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_securitycode` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0000',
  `a_ip` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0.0.0.0',
  `a_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `a_validationcode` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `a_for_reg` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`a_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_user_validation
-- ----------------------------
INSERT INTO `t_user_validation` VALUES (2, 'evele', '1234567890', 'leandroevele@gmail.com', '2407', '170.233.35.141', '2021-11-19 16:30:30', '37011e22280ce5325a9298dc48ef6a822896b0a24d05eaf36971a60b625bb944c0600441988855bbe0c40d4f13faec1be586d644dbfb516c9115d2267cd5891f', 1);
INSERT INTO `t_user_validation` VALUES (3, 'evele2', '123456789', 'vikileki@hotmail.com', '2407', '170.233.35.141', '2021-11-19 16:33:29', 'd759717256c22513a8d160aa8d6a29c0f5dbee9e989a635780cfaf3a099a5d0f769d7db970af164b7fa7409f25bc0746c9a776a5dde5c2cc96b165d3980dae6b', 1);

SET FOREIGN_KEY_CHECKS = 1;
