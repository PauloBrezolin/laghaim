/*
 Navicat Premium Data Transfer

 Source Server         : locallaghaim
 Source Server Type    : MySQL
 Source Server Version : 100125
 Source Host           : 127.0.0.1:3306
 Source Schema         : kor_ndev_neogeo_event

 Target Server Type    : MySQL
 Target Server Version : 100125
 File Encoding         : 65001

 Date: 19/03/2022 16:36:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for 11year_event
-- ----------------------------
DROP TABLE IF EXISTS `11year_event`;
CREATE TABLE `11year_event`  (
  `a_index` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) NOT NULL DEFAULT 0,
  `a_2p4p_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `a_server` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_name` char(20) CHARACTER SET latin1 COLLATE latin1_bin NULL DEFAULT NULL,
  `a_lastdate` datetime(0) NOT NULL,
  `a_count` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest1` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest2` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest3` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest4` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest5` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`a_index`, `a_2p4p_user_code`, `a_char_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for 12year_event
-- ----------------------------
DROP TABLE IF EXISTS `12year_event`;
CREATE TABLE `12year_event`  (
  `a_index` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) NOT NULL DEFAULT 0,
  `a_2p4p_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `a_server` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_name` char(20) CHARACTER SET latin1 COLLATE latin1_bin NULL DEFAULT NULL,
  `a_lastdate` datetime(0) NOT NULL,
  `a_count` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest1` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest2` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest3` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest4` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest5` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`a_index`, `a_2p4p_user_code`, `a_char_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for bg_game_event
-- ----------------------------
DROP TABLE IF EXISTS `bg_game_event`;
CREATE TABLE `bg_game_event`  (
  `idx` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `game_money` bigint(8) UNSIGNED NULL DEFAULT 0,
  `chk_use` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'N',
  `get_date` datetime(0) NULL DEFAULT NULL,
  `join_game_type` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '24',
  `bg_game_type` smallint(2) UNSIGNED NOT NULL DEFAULT 0,
  `update_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`idx`) USING BTREE,
  INDEX `bg_game_event_user_code_idx`(`user_code`) USING BTREE,
  INDEX `bg_game_event_chk_use_idx`(`chk_use`) USING BTREE,
  INDEX `bg_game_event_bg_game_type`(`bg_game_type`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '11¿ù ÀÌÈÄ bg_game_event_goods »ç¿ë- ÀÌÆÇ»çÆÇ °ÔÀÓ¸Ó´Ï Áö±Þ' ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for bg_game_event_card
-- ----------------------------
DROP TABLE IF EXISTS `bg_game_event_card`;
CREATE TABLE `bg_game_event_card`  (
  `ecard_idx` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ecard_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `ecard_card_number` smallint(2) UNSIGNED NOT NULL DEFAULT 0,
  `ecard_site_code` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '24',
  `ecard_chk_use` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'N',
  `ecard_use_kind` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ecard_update_date` datetime(0) NOT NULL,
  PRIMARY KEY (`ecard_idx`) USING BTREE,
  INDEX `bg_game_event_card_user_code`(`ecard_user_code`) USING BTREE,
  INDEX `bg_game_event_card_chk_use`(`ecard_chk_use`) USING BTREE,
  INDEX `bg_game_event_card_card_number`(`ecard_card_number`) USING BTREE,
  INDEX `bg_game_event_card_ecard_site_code`(`ecard_site_code`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '2ÆÇ»çÆÇ °ÔÀÓ - Ä«µå ¸ðÀ¸±â' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bg_game_event_goods
-- ----------------------------
DROP TABLE IF EXISTS `bg_game_event_goods`;
CREATE TABLE `bg_game_event_goods`  (
  `egoods_index` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `egoods_user_code` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `egoods_site_code` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '24',
  `egoods_item_no` int(11) NULL DEFAULT NULL,
  `egoods_cnt` bigint(10) UNSIGNED NOT NULL DEFAULT 0,
  `egoods_org_cnt` bigint(10) UNSIGNED NOT NULL DEFAULT 0,
  `egoods_enable` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `egoods_create_date` datetime(0) NOT NULL,
  `egoods_use_date` datetime(0) NULL DEFAULT NULL,
  `egoods_give_place` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'web',
  `egoods_event_name` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'CARD',
  PRIMARY KEY (`egoods_index`) USING BTREE,
  INDEX `idx_user_code`(`egoods_user_code`, `egoods_site_code`, `egoods_enable`) USING BTREE,
  INDEX `idx_date`(`egoods_create_date`) USING BTREE,
  INDEX `egoods_event_name`(`egoods_event_name`) USING BTREE,
  INDEX `IDX_CreateDate_EventName`(`egoods_create_date`, `egoods_event_name`) USING BTREE,
  INDEX `idx_enable`(`egoods_site_code`, `egoods_enable`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '°¢ °ÔÀÓº° Áö±Þ »óÇ°' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bg_game_event_item
-- ----------------------------
DROP TABLE IF EXISTS `bg_game_event_item`;
CREATE TABLE `bg_game_event_item`  (
  `eitem_index` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `eitem_site_code` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `eitem_item_no` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `eitem_item_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`eitem_index`) USING BTREE,
  INDEX `idx_event_item`(`eitem_item_no`, `eitem_site_code`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '°¢ °ÔÀÓº° »óÇ°  ÄÚµå' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bg_game_event_lhp_day
-- ----------------------------
DROP TABLE IF EXISTS `bg_game_event_lhp_day`;
CREATE TABLE `bg_game_event_lhp_day`  (
  `event_idx` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `event_day_count` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `event_day_date` date NOT NULL,
  PRIMARY KEY (`event_idx`) USING BTREE,
  INDEX `bg_game_event_lhp_day_event_user_code`(`event_user_code`) USING BTREE,
  INDEX `bg_game_event_lhp_day_event_lhp_day_count`(`event_day_count`) USING BTREE,
  INDEX `bg_game_event_lhp_day_bg_game_event_lhp_date`(`event_day_date`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '¶ó±×ÇÏÀÓ¹è ¸Â°í ÀÌº¥Æ® - ÇÏ·ç LHP' ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for bg_game_event_lhp_total
-- ----------------------------
DROP TABLE IF EXISTS `bg_game_event_lhp_total`;
CREATE TABLE `bg_game_event_lhp_total`  (
  `event_idx` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `event_total_count` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `event_update_date` datetime(0) NOT NULL,
  PRIMARY KEY (`event_idx`) USING BTREE,
  INDEX `bg_game_event_lhp_total_event_user_code`(`event_user_code`) USING BTREE,
  INDEX `event_total_count`(`event_total_count`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '¶ó±×ÇÏÀÓ¹è ¸Â°í ÀÌº¥Æ® - ÅäÅ» LHP' ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for bg_game_event_log
-- ----------------------------
DROP TABLE IF EXISTS `bg_game_event_log`;
CREATE TABLE `bg_game_event_log`  (
  `idx` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `category` smallint(1) UNSIGNED NOT NULL DEFAULT 1,
  `money` bigint(8) UNSIGNED NOT NULL DEFAULT 0,
  `update_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`idx`) USING BTREE,
  UNIQUE INDEX `idx`(`idx`) USING BTREE,
  INDEX `user_code_idx`(`user_code`) USING BTREE,
  INDEX `category_idx`(`category`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for bg_game_event_rank
-- ----------------------------
DROP TABLE IF EXISTS `bg_game_event_rank`;
CREATE TABLE `bg_game_event_rank`  (
  `erank_index` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `erank_event_kind` int(4) UNSIGNED NOT NULL DEFAULT 1,
  `erank_rank` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `erank_user_code` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `erank_user_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1',
  `erank_nickname` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1',
  `erank_sex` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'M',
  `erank_game_level` int(4) UNSIGNED NULL DEFAULT 0,
  `erank_money` bigint(8) UNSIGNED NULL DEFAULT 0,
  `erank_event_point` int(11) UNSIGNED NULL DEFAULT 0,
  `erank_regi_date` datetime(0) NOT NULL DEFAULT '2005-10-19 00:00:00',
  PRIMARY KEY (`erank_index`) USING BTREE,
  INDEX `idx_event_rank`(`erank_event_kind`, `erank_user_code`) USING BTREE,
  INDEX `idx_event_rank_level`(`erank_rank`, `erank_event_point`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'ÀÌº¥Æ® - ·©Å·' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bg_game_itemupgrade_rank
-- ----------------------------
DROP TABLE IF EXISTS `bg_game_itemupgrade_rank`;
CREATE TABLE `bg_game_itemupgrade_rank`  (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `server_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `char_idx` int(11) NOT NULL DEFAULT 0,
  `char_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `item_position` int(11) NOT NULL DEFAULT 0,
  `item_idx` int(11) NOT NULL DEFAULT 0,
  `upgrade_count` int(11) NOT NULL DEFAULT 0,
  `create_date` datetime(0) NOT NULL,
  PRIMARY KEY (`idx`) USING BTREE,
  INDEX `idx_item_upgrade`(`char_idx`, `item_idx`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bg_game_mileage_item
-- ----------------------------
DROP TABLE IF EXISTS `bg_game_mileage_item`;
CREATE TABLE `bg_game_mileage_item`  (
  `mitem_index` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mitem_site_code` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `mitem_item_no` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `mitem_item_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `mitem_mileage` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `mitem_enable` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`mitem_index`) USING BTREE,
  INDEX `idx_event_item`(`mitem_item_no`, `mitem_site_code`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bg_laghaim_event_recommend
-- ----------------------------
DROP TABLE IF EXISTS `bg_laghaim_event_recommend`;
CREATE TABLE `bg_laghaim_event_recommend`  (
  `recom_index` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `recom_regist_2p4p_ucode` int(4) UNSIGNED NULL DEFAULT NULL,
  `recom_regist_lag_ucode` int(4) UNSIGNED NULL DEFAULT NULL,
  `recom_regist_idname` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NULL DEFAULT NULL,
  `recom_recom_2p4p_ucode` int(4) UNSIGNED NULL DEFAULT NULL,
  `recom_recom_lag_ucode` int(4) UNSIGNED NULL DEFAULT NULL,
  `recom_recom_idname` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NULL DEFAULT NULL,
  `recom_event_type` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `recom_regist_date` datetime(0) NULL DEFAULT NULL,
  `recom_generate_lp` smallint(5) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`recom_index`) USING BTREE,
  INDEX `date_2p4pucode`(`recom_regist_date`, `recom_recom_2p4p_ucode`, `recom_event_type`) USING BTREE,
  INDEX `date_2p4pucode2`(`recom_regist_date`, `recom_regist_2p4p_ucode`, `recom_event_type`) USING BTREE,
  INDEX `IDX_RegistDate_RecomIdname`(`recom_recom_idname`, `recom_regist_date`, `recom_event_type`) USING BTREE,
  INDEX `IDX_RegistDate_RegistIdName`(`recom_regist_idname`, `recom_regist_date`, `recom_event_type`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bg_laghaim_event_skt
-- ----------------------------
DROP TABLE IF EXISTS `bg_laghaim_event_skt`;
CREATE TABLE `bg_laghaim_event_skt`  (
  `eskt_index` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `eskt_memb_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `eskt_game_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `eskt_partner_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `eskt_site_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `eskt_ok_count` tinyint(1) UNSIGNED NOT NULL DEFAULT 2,
  `eskt_ok_tcount` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `eskt_phone` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '000-0000-0000',
  `eskt_date` datetime(0) NOT NULL,
  PRIMARY KEY (`eskt_index`) USING BTREE,
  INDEX `eskt_memb_index`(`eskt_memb_index`, `eskt_game_index`, `eskt_partner_id`, `eskt_site_id`, `eskt_phone`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'SKT ÀÌº¥Æ®' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bg_school_live
-- ----------------------------
DROP TABLE IF EXISTS `bg_school_live`;
CREATE TABLE `bg_school_live`  (
  `slive_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `slive_sinfo_index` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `slive_name` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `slive_grade` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `slive_class` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `slive_count_event` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`slive_index`) USING BTREE,
  INDEX `idx_slive`(`slive_sinfo_index`, `slive_class`, `slive_grade`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for bg_ssawar_count
-- ----------------------------
DROP TABLE IF EXISTS `bg_ssawar_count`;
CREATE TABLE `bg_ssawar_count`  (
  `scount_index` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `scount_event_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'star',
  `scount_userCode` int(11) NOT NULL DEFAULT 0,
  `scount_items` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'star',
  `scount_count` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `scount_count_use` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `scount_date` date NOT NULL DEFAULT '2006-04-20',
  PRIMARY KEY (`scount_index`) USING BTREE,
  INDEX `scount_group`(`scount_event_name`, `scount_userCode`, `scount_items`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for chuseok201309
-- ----------------------------
DROP TABLE IF EXISTS `chuseok201309`;
CREATE TABLE `chuseok201309`  (
  `a_index` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) NOT NULL DEFAULT 0,
  `a_2p4p_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `a_server` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_name` char(20) CHARACTER SET latin1 COLLATE latin1_bin NULL DEFAULT NULL,
  `a_lastdate` datetime(0) NOT NULL,
  `a_quest_index0` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count0` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index1` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count1` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index2` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count2` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index3` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count3` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index4` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count4` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`a_index`, `a_2p4p_user_code`, `a_char_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for chuseok201309_rank
-- ----------------------------
DROP TABLE IF EXISTS `chuseok201309_rank`;
CREATE TABLE `chuseok201309_rank`  (
  `no` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `a_2p4p_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `quest` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for event_13year_hunt
-- ----------------------------
DROP TABLE IF EXISTS `event_13year_hunt`;
CREATE TABLE `event_13year_hunt`  (
  `a_index` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) NOT NULL DEFAULT 0,
  `a_2p4p_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `a_server` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_name` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `a_lastdate` datetime(0) NOT NULL,
  `a_quest_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`a_index`) USING BTREE,
  INDEX `index`(`a_user_index`, `a_server`, `a_char_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for event_20131008_hunt
-- ----------------------------
DROP TABLE IF EXISTS `event_20131008_hunt`;
CREATE TABLE `event_20131008_hunt`  (
  `a_index` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) NOT NULL DEFAULT 0,
  `a_2p4p_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `a_server` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_name` char(20) CHARACTER SET latin1 COLLATE latin1_bin NULL DEFAULT NULL,
  `a_lastdate` datetime(0) NOT NULL,
  `a_quest_index0` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count0` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index1` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count1` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index2` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count2` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index3` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count3` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index4` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count4` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_min_quest_count` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_hunt1_totalpoint` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`a_index`, `a_2p4p_user_code`, `a_char_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for event_20131008_hunt_item
-- ----------------------------
DROP TABLE IF EXISTS `event_20131008_hunt_item`;
CREATE TABLE `event_20131008_hunt_item`  (
  `idx` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `itemtype` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idx`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for event_20131211_hunt
-- ----------------------------
DROP TABLE IF EXISTS `event_20131211_hunt`;
CREATE TABLE `event_20131211_hunt`  (
  `a_index` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) NOT NULL DEFAULT 0,
  `a_2p4p_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `a_server` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_name` char(20) CHARACTER SET latin1 COLLATE latin1_bin NULL DEFAULT NULL,
  `a_lastdate` datetime(0) NOT NULL,
  `a_quest_index0` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count0` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index1` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count1` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index2` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count2` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index3` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count3` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_index4` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest_count4` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_min_quest_count` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`a_index`, `a_2p4p_user_code`, `a_char_index`) USING BTREE,
  INDEX `a_char_index`(`a_char_index`) USING BTREE,
  INDEX `a_2p4p_user_code`(`a_2p4p_user_code`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for event_20140108_yut
-- ----------------------------
DROP TABLE IF EXISTS `event_20140108_yut`;
CREATE TABLE `event_20140108_yut`  (
  `a_index` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) NOT NULL DEFAULT 0,
  `a_server` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_name` char(20) CHARACTER SET latin1 COLLATE latin1_bin NULL DEFAULT NULL,
  `a_lastdate` datetime(0) NOT NULL,
  `a_postion_now` int(11) UNSIGNED NULL DEFAULT 0,
  `a_success_count` int(11) UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`a_index`, `a_char_index`) USING BTREE,
  INDEX `a_user_index`(`a_user_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for event_20140709_mad
-- ----------------------------
DROP TABLE IF EXISTS `event_20140709_mad`;
CREATE TABLE `event_20140709_mad`  (
  `a_user_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_complet` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `a_one_day_view` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `a_name` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  UNIQUE INDEX `a_user_index`(`a_user_index`) USING BTREE,
  INDEX `a_user_index_2`(`a_user_index`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for hunt201306
-- ----------------------------
DROP TABLE IF EXISTS `hunt201306`;
CREATE TABLE `hunt201306`  (
  `a_index` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_user_index` int(11) NOT NULL DEFAULT 0,
  `a_2p4p_user_code` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `a_server` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_index` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_name` char(20) CHARACTER SET latin1 COLLATE latin1_bin NULL DEFAULT NULL,
  `a_lastdate` datetime(0) NOT NULL,
  `a_count` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest1` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest2` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest3` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest4` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `a_quest5` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`a_index`, `a_2p4p_user_code`, `a_char_index`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for t_present85
-- ----------------------------
DROP TABLE IF EXISTS `t_present85`;
CREATE TABLE `t_present85`  (
  `a_index` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_enable` int(11) NOT NULL DEFAULT 1,
  `a_date` date NOT NULL,
  `a_user_index` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `a_char_index` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `a_vnum` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `a_org_count` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `a_count` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `a_plus` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `a_flag1` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `a_flag2` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `a_flag_ext` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `a_userdate` date NOT NULL,
  `a_serv_no` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `a_2p4p_user_code` int(4) NOT NULL DEFAULT -1,
  PRIMARY KEY (`a_index`) USING BTREE,
  INDEX `a_index_2`(`a_index`) USING BTREE,
  INDEX `IDX_UCode_VNum`(`a_2p4p_user_code`, `a_vnum`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Web¿¡¼­ ¾ÆÀÌÅÛ Áö±Þ¿ë-°¢¼­¹ö¿¡ ¼öµ¿À¸·Î Ã³¸®' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_laghaimpaymentlgaconfirmlog
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpaymentlgaconfirmlog`;
CREATE TABLE `tbl_laghaimpaymentlgaconfirmlog`  (
  `lcl_idx` mediumint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lcl_user_idx` int(11) NOT NULL DEFAULT 0,
  `lcl_lag_user_idx` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `lcl_user_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lcl_user_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `lcl_payment_code` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lcl_payment_method` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lcl_lga_payment_idx` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `lcl_lga_confirm_result` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lcl_regdate` datetime(0) NOT NULL,
  PRIMARY KEY (`lcl_idx`) USING BTREE,
  INDEX `IDX_RegDate_UserIdx_UserId_PaymentCode`(`lcl_regdate`, `lcl_user_idx`, `lcl_user_id`, `lcl_payment_code`) USING BTREE,
  INDEX `IDX_LgaPaymentIdx`(`lcl_lga_payment_idx`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_laghaimpaymentlog
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpaymentlog`;
CREATE TABLE `tbl_laghaimpaymentlog`  (
  `lpl_idx` mediumint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lpl_user_idx` int(11) NOT NULL DEFAULT 0,
  `lpl_lag_user_idx` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `lpl_user_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpl_user_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `lpl_payment_code` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpl_payment_method` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpl_lga_payment_idx` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `lpl_regdate` datetime(0) NOT NULL,
  PRIMARY KEY (`lpl_idx`) USING BTREE,
  UNIQUE INDEX `UNQ_LGAPaymentIdx`(`lpl_lga_payment_idx`) USING BTREE,
  INDEX `IDX_RegDate_UserIdx_UserId_PaymentCode`(`lpl_regdate`, `lpl_user_idx`, `lpl_user_id`, `lpl_payment_code`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '¶ó±×ÇÏÀÓ °áÁ¦ ·Î±× (2013-03-07 ½ÃÀÛ)' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_laghaimpointgoods
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpointgoods`;
CREATE TABLE `tbl_laghaimpointgoods`  (
  `lpi_idx` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lpi_item_code` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_dorm_code` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_goods_type` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_item_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_item_laghaim_point` smallint(3) NOT NULL DEFAULT 0,
  `lpi_item_laghaim_point_max` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `lpi_made_up_name_1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_1` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_1` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_2` smallint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_2` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_3` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_3` smallint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_3` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_4` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_4` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_4` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_5` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_5` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_5` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_6` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_6` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_6` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_7` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_7` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_7` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_8` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_8` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_8` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_9` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_9` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_9` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_10` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_10` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_10` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_fluctuation_type` enum('PLUS','MINUS','ZERO') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'ZERO',
  PRIMARY KEY (`lpi_idx`) USING BTREE,
  UNIQUE INDEX `UNQ_ItemCode`(`lpi_item_code`) USING BTREE,
  INDEX `IDX_ItemCode`(`lpi_item_code`, `lpi_item_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '¶ó±×ÇÏÀÓ °áÁ¦ »óÇ° ±¸ºÐ ÄÚµå' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_laghaimpointgoods_copy
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpointgoods_copy`;
CREATE TABLE `tbl_laghaimpointgoods_copy`  (
  `lpi_idx` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lpi_item_code` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_dorm_code` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_goods_type` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_item_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_item_laghaim_point` smallint(3) NOT NULL DEFAULT 0,
  `lpi_item_laghaim_point_max` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `lpi_made_up_name_1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_1` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_1` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_2` smallint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_2` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_3` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_3` smallint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_3` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_4` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_4` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_4` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_5` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_5` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_5` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_6` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_6` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_6` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_7` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_7` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_7` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_8` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_8` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_8` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_9` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_9` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_9` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_10` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_10` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_10` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`lpi_idx`) USING BTREE,
  UNIQUE INDEX `UNQ_ItemCode`(`lpi_item_code`) USING BTREE,
  INDEX `IDX_ItemCode`(`lpi_item_code`, `lpi_item_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_laghaimpointgoods_datetime
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpointgoods_datetime`;
CREATE TABLE `tbl_laghaimpointgoods_datetime`  (
  `idx` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lpi_idx` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `in_userid` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `in_date` datetime(0) NOT NULL,
  `up_userid` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `up_date` datetime(0) NOT NULL,
  PRIMARY KEY (`idx`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_laghaimpointgoods_dev
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpointgoods_dev`;
CREATE TABLE `tbl_laghaimpointgoods_dev`  (
  `lpi_idx` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lpi_item_code` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_dorm_code` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_goods_type` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_item_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpi_item_laghaim_point` smallint(3) NOT NULL DEFAULT 0,
  `lpi_item_laghaim_point_max` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `lpi_made_up_name_1` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_1` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_1` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_2` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_2` smallint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_2` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_3` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_3` smallint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_3` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_4` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_4` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_4` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_5` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_5` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_5` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_6` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_6` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_6` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_7` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_7` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_7` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_8` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_8` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_8` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_9` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_9` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_9` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_name_10` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpi_made_up_code_10` smallint(5) UNSIGNED NULL DEFAULT NULL,
  `lpi_made_up_quantity_10` tinyint(3) UNSIGNED NULL DEFAULT NULL,
  `lpi_desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`lpi_idx`) USING BTREE,
  UNIQUE INDEX `UNQ_ItemCode`(`lpi_item_code`) USING BTREE,
  INDEX `IDX_ItemCode`(`lpi_item_code`, `lpi_item_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_laghaimpointgoods_writelog
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpointgoods_writelog`;
CREATE TABLE `tbl_laghaimpointgoods_writelog`  (
  `idx` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lpi_idx` int(11) NOT NULL DEFAULT 0,
  `fuser_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `fdate` datetime(0) NOT NULL,
  `muser_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `mdate` datetime(0) NOT NULL,
  PRIMARY KEY (`idx`) USING BTREE,
  INDEX `IDX_LaghaimPointGoods_WriteLog`(`lpi_idx`, `fuser_id`, `muser_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '.... ...... .. (2013-10-21 ..)' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_laghaimpointhistory
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpointhistory`;
CREATE TABLE `tbl_laghaimpointhistory`  (
  `lph_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lph_user_idx` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `lph_user_lag_idx` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `lph_user_idname` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lph_old_point` mediumint(8) NOT NULL DEFAULT 0,
  `lph_generate_point` mediumint(6) NOT NULL DEFAULT 0,
  `lph_new_point` mediumint(8) NOT NULL DEFAULT 0,
  `lph_point_goods_code` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lph_recall_admin_info` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lph_generate_date` datetime(0) NOT NULL,
  PRIMARY KEY (`lph_idx`) USING BTREE,
  INDEX `IDX_UserIdx_PointGoodsCode_GenerateDate`(`lph_user_idx`, `lph_point_goods_code`, `lph_generate_date`) USING BTREE,
  INDEX `IDX_PointGoodsCode_GenerateDate`(`lph_point_goods_code`, `lph_generate_date`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 255 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'ÇÁ¸®¹Ì¾ö ¼­ºñ½º(Laghaim Point) È÷½ºÅä¸®' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_laghaimpointhistory
-- ----------------------------
INSERT INTO `tbl_laghaimpointhistory` VALUES (1, 1, 1, 'account', 999999, -300, 999699, 'LH01', NULL, '2021-08-12 19:06:58');
INSERT INTO `tbl_laghaimpointhistory` VALUES (2, 1, 1, 'account', 999699, -300, 999399, 'LH01', NULL, '2021-08-12 19:06:59');
INSERT INTO `tbl_laghaimpointhistory` VALUES (3, 1, 1, 'account', 999399, -300, 999099, 'LH01', NULL, '2021-08-12 19:06:59');
INSERT INTO `tbl_laghaimpointhistory` VALUES (4, 1, 1, 'account', 999099, -300, 998799, 'LH01', NULL, '2021-08-12 19:07:00');
INSERT INTO `tbl_laghaimpointhistory` VALUES (5, 1, 1, 'account', 998799, -300, 998499, 'LH01', NULL, '2021-08-12 19:07:01');
INSERT INTO `tbl_laghaimpointhistory` VALUES (6, 1, 1, 'account', 998499, -300, 998199, 'LH01', NULL, '2021-08-12 19:07:02');
INSERT INTO `tbl_laghaimpointhistory` VALUES (7, 3, 2, 'ledark', 999999, -5000, 994999, 'LH01', NULL, '2021-08-12 20:33:43');
INSERT INTO `tbl_laghaimpointhistory` VALUES (8, 3, 2, 'ledark', 994999, -5000, 989999, 'LH01', NULL, '2021-08-12 20:33:45');
INSERT INTO `tbl_laghaimpointhistory` VALUES (9, 3, 2, 'ledark', 989999, -5000, 984999, 'LH01', NULL, '2021-08-12 20:33:46');
INSERT INTO `tbl_laghaimpointhistory` VALUES (10, 3, 2, 'ledark', 984999, 1, 985000, 'LH0B', NULL, '2021-08-12 20:44:02');
INSERT INTO `tbl_laghaimpointhistory` VALUES (11, 3, 2, 'ledark', 985000, 1, 985001, 'LH0B', NULL, '2021-08-12 20:45:00');
INSERT INTO `tbl_laghaimpointhistory` VALUES (12, 3, 2, 'ledark', 985001, 1, 985002, 'LH0B', NULL, '2021-08-12 20:46:20');
INSERT INTO `tbl_laghaimpointhistory` VALUES (13, 3, 2, 'ledark', 985002, 1, 985003, 'LH0B', NULL, '2021-08-12 20:46:40');
INSERT INTO `tbl_laghaimpointhistory` VALUES (14, 3, 2, 'ledark', 985003, 1, 985004, 'LH0B', NULL, '2021-08-12 20:47:02');
INSERT INTO `tbl_laghaimpointhistory` VALUES (15, 3, 2, 'ledark', 985004, 1, 985005, 'LH0B', NULL, '2021-08-12 20:47:20');
INSERT INTO `tbl_laghaimpointhistory` VALUES (16, 3, 2, 'ledark', 985005, 1, 985006, 'LH0B', NULL, '2021-08-12 20:47:58');
INSERT INTO `tbl_laghaimpointhistory` VALUES (17, 3, 2, 'ledark', 985006, 1, 985007, 'LH0B', NULL, '2021-08-12 20:48:18');
INSERT INTO `tbl_laghaimpointhistory` VALUES (18, 3, 2, 'ledark', 985007, 1, 985008, 'LH0B', NULL, '2021-08-12 20:48:39');
INSERT INTO `tbl_laghaimpointhistory` VALUES (19, 3, 2, 'ledark', 985008, 1, 985009, 'LH0B', NULL, '2021-08-12 20:48:54');
INSERT INTO `tbl_laghaimpointhistory` VALUES (20, 3, 2, 'ledark', 985009, 1, 985010, 'LH0B', NULL, '2021-08-12 20:49:11');
INSERT INTO `tbl_laghaimpointhistory` VALUES (21, 3, 2, 'ledark', 985010, 1, 985011, 'LH0B', NULL, '2021-08-12 20:49:20');
INSERT INTO `tbl_laghaimpointhistory` VALUES (22, 3, 2, 'ledark', 985011, 1, 985012, 'LH0B', NULL, '2021-08-12 20:49:41');
INSERT INTO `tbl_laghaimpointhistory` VALUES (23, 3, 2, 'ledark', 985012, 1, 985013, 'LH0B', NULL, '2021-08-12 20:50:12');
INSERT INTO `tbl_laghaimpointhistory` VALUES (24, 3, 2, 'ledark', 985013, 1, 985014, 'LH0B', NULL, '2021-08-12 20:50:52');
INSERT INTO `tbl_laghaimpointhistory` VALUES (25, 3, 2, 'ledark', 985014, 1, 985015, 'LH0B', NULL, '2021-08-12 20:51:00');
INSERT INTO `tbl_laghaimpointhistory` VALUES (26, 3, 2, 'ledark', 985015, 1, 985016, 'LH0B', NULL, '2021-08-12 20:51:32');
INSERT INTO `tbl_laghaimpointhistory` VALUES (27, 3, 2, 'ledark', 985016, 1, 985017, 'LH0B', NULL, '2021-08-12 20:51:49');
INSERT INTO `tbl_laghaimpointhistory` VALUES (28, 3, 2, 'ledark', 985017, 1, 985018, 'LH0B', NULL, '2021-08-12 20:52:03');
INSERT INTO `tbl_laghaimpointhistory` VALUES (29, 3, 2, 'ledark', 985018, 3, 985021, 'LH0B', NULL, '2021-08-12 20:52:08');
INSERT INTO `tbl_laghaimpointhistory` VALUES (30, 3, 2, 'ledark', 985021, 1, 985022, 'LH0B', NULL, '2021-08-12 20:52:23');
INSERT INTO `tbl_laghaimpointhistory` VALUES (31, 3, 2, 'ledark', 985022, 1, 985023, 'LH0B', NULL, '2021-08-12 20:52:48');
INSERT INTO `tbl_laghaimpointhistory` VALUES (32, 3, 2, 'ledark', 985023, 1, 985024, 'LH0B', NULL, '2021-08-12 20:53:16');
INSERT INTO `tbl_laghaimpointhistory` VALUES (33, 3, 2, 'ledark', 985024, 1, 985025, 'LH0B', NULL, '2021-08-12 20:53:28');
INSERT INTO `tbl_laghaimpointhistory` VALUES (34, 3, 2, 'ledark', 985025, 1, 985026, 'LH0B', NULL, '2021-08-12 20:53:43');
INSERT INTO `tbl_laghaimpointhistory` VALUES (35, 3, 2, 'ledark', 985026, 1, 985027, 'LH0B', NULL, '2021-08-12 20:54:08');
INSERT INTO `tbl_laghaimpointhistory` VALUES (36, 3, 2, 'ledark', 985027, 1, 985028, 'LH0B', NULL, '2021-08-12 20:54:20');
INSERT INTO `tbl_laghaimpointhistory` VALUES (37, 3, 2, 'ledark', 985028, 1, 985029, 'LH0B', NULL, '2021-08-12 20:54:44');
INSERT INTO `tbl_laghaimpointhistory` VALUES (38, 3, 2, 'ledark', 985029, 1, 985030, 'LH0B', NULL, '2021-08-12 20:54:54');
INSERT INTO `tbl_laghaimpointhistory` VALUES (39, 3, 2, 'ledark', 985030, 1, 985031, 'LH0B', NULL, '2021-08-12 20:55:03');
INSERT INTO `tbl_laghaimpointhistory` VALUES (40, 3, 2, 'ledark', 985031, 1, 985032, 'LH0B', NULL, '2021-08-12 20:55:22');
INSERT INTO `tbl_laghaimpointhistory` VALUES (41, 3, 2, 'ledark', 985032, 1, 985033, 'LH0B', NULL, '2021-08-12 20:55:32');
INSERT INTO `tbl_laghaimpointhistory` VALUES (42, 3, 2, 'ledark', 985033, 1, 985034, 'LH0B', NULL, '2021-08-12 20:55:32');
INSERT INTO `tbl_laghaimpointhistory` VALUES (43, 3, 2, 'ledark', 985034, 1, 985035, 'LH0B', NULL, '2021-08-12 20:55:37');
INSERT INTO `tbl_laghaimpointhistory` VALUES (44, 3, 2, 'ledark', 985035, 1, 985036, 'LH0B', NULL, '2021-08-12 20:55:40');
INSERT INTO `tbl_laghaimpointhistory` VALUES (45, 1, 1, 'account', 998199, -20000, 978199, 'LH01', NULL, '2021-08-14 16:45:19');
INSERT INTO `tbl_laghaimpointhistory` VALUES (46, 1, 1, 'account', 978199, -5000, 973199, 'LH01', NULL, '2021-08-14 16:46:49');
INSERT INTO `tbl_laghaimpointhistory` VALUES (47, 1, 1, 'account', 973199, -5000, 968199, 'LH01', NULL, '2021-08-14 16:47:01');
INSERT INTO `tbl_laghaimpointhistory` VALUES (48, 1, 1, 'account', 968199, -5000, 963199, 'LH01', NULL, '2021-08-14 16:58:44');
INSERT INTO `tbl_laghaimpointhistory` VALUES (49, 1, 1, 'account', 1763199, -200, 1762999, 'LH01', NULL, '2021-08-29 10:17:26');
INSERT INTO `tbl_laghaimpointhistory` VALUES (50, 1, 1, 'account', 1762999, -5000, 1757999, 'LH01', NULL, '2021-08-29 10:17:40');
INSERT INTO `tbl_laghaimpointhistory` VALUES (51, 1, 1, 'account', 1757999, -150, 1757849, 'LH01', NULL, '2021-09-04 15:15:20');
INSERT INTO `tbl_laghaimpointhistory` VALUES (52, 1, 1, 'account', 1757849, -150, 1757699, 'LH01', NULL, '2021-09-04 15:15:23');
INSERT INTO `tbl_laghaimpointhistory` VALUES (53, 1, 1, 'account', 1757699, 2, 1757701, 'LH0B', NULL, '2021-09-04 15:26:31');
INSERT INTO `tbl_laghaimpointhistory` VALUES (54, 1, 1, 'account', 1757701, 2, 1757703, 'LH0B', NULL, '2021-09-04 15:26:32');
INSERT INTO `tbl_laghaimpointhistory` VALUES (55, 1, 1, 'account', 1757703, 2, 1757705, 'LH0B', NULL, '2021-09-04 15:26:50');
INSERT INTO `tbl_laghaimpointhistory` VALUES (56, 1, 1, 'account', 1757705, 2, 1757707, 'LH0B', NULL, '2021-09-04 15:26:55');
INSERT INTO `tbl_laghaimpointhistory` VALUES (57, 1, 1, 'account', 1757707, 2, 1757709, 'LH0B', NULL, '2021-09-04 15:26:56');
INSERT INTO `tbl_laghaimpointhistory` VALUES (58, 1, 1, 'account', 1757709, 2, 1757711, 'LH0B', NULL, '2021-09-04 15:26:57');
INSERT INTO `tbl_laghaimpointhistory` VALUES (59, 1, 1, 'account', 1757711, 2, 1757713, 'LH0B', NULL, '2021-09-04 15:26:57');
INSERT INTO `tbl_laghaimpointhistory` VALUES (60, 1, 1, 'account', 1757713, 2, 1757715, 'LH0B', NULL, '2021-09-04 15:26:59');
INSERT INTO `tbl_laghaimpointhistory` VALUES (61, 1, 1, 'account', 1757715, 2, 1757717, 'LH0B', NULL, '2021-09-04 15:27:03');
INSERT INTO `tbl_laghaimpointhistory` VALUES (62, 1, 1, 'account', 1757717, 2, 1757719, 'LH0B', NULL, '2021-09-04 15:28:18');
INSERT INTO `tbl_laghaimpointhistory` VALUES (63, 1, 1, 'account', 1757719, 2, 1757721, 'LH0B', NULL, '2021-09-04 15:28:18');
INSERT INTO `tbl_laghaimpointhistory` VALUES (64, 1, 1, 'account', 1757721, 50, 1757771, 'LH0B', NULL, '2021-09-04 15:31:45');
INSERT INTO `tbl_laghaimpointhistory` VALUES (65, 1, 1, 'account', 1757771, 2, 1757773, 'LH0B', NULL, '2021-09-04 15:32:24');
INSERT INTO `tbl_laghaimpointhistory` VALUES (66, 1, 1, 'account', 1757773, 50, 1757823, 'LH0B', NULL, '2021-09-04 15:32:37');
INSERT INTO `tbl_laghaimpointhistory` VALUES (67, 1, 1, 'account', 1757823, 50, 1757873, 'LH0B', NULL, '2021-09-04 15:33:46');
INSERT INTO `tbl_laghaimpointhistory` VALUES (68, 1, 1, 'account', 1757873, 100, 1757973, 'LH0B', NULL, '2021-09-04 15:33:54');
INSERT INTO `tbl_laghaimpointhistory` VALUES (69, 1, 1, 'account', 1757973, 2, 1757975, 'LH0B', NULL, '2021-09-04 15:34:56');
INSERT INTO `tbl_laghaimpointhistory` VALUES (70, 1, 1, 'account', 1757975, 1, 1757976, 'LH0B', NULL, '2021-09-04 15:41:51');
INSERT INTO `tbl_laghaimpointhistory` VALUES (71, 1, 1, 'account', 1757976, 1, 1757977, 'LH0B', NULL, '2021-09-04 15:42:09');
INSERT INTO `tbl_laghaimpointhistory` VALUES (72, 1, 1, 'account', 1757977, 1, 1757978, 'LH0B', NULL, '2021-09-04 15:42:12');
INSERT INTO `tbl_laghaimpointhistory` VALUES (73, 1, 1, 'account', 1757978, 1, 1757979, 'LH0B', NULL, '2021-09-04 15:42:35');
INSERT INTO `tbl_laghaimpointhistory` VALUES (74, 1, 1, 'account', 1757979, 100, 1758079, 'LH0B', NULL, '2021-09-04 15:42:45');
INSERT INTO `tbl_laghaimpointhistory` VALUES (75, 1, 1, 'account', 1758079, 150, 1758229, 'LH0B', NULL, '2021-09-04 15:43:46');
INSERT INTO `tbl_laghaimpointhistory` VALUES (76, 1, 1, 'account', 1758229, 1, 1758230, 'LH0B', NULL, '2021-09-04 18:06:41');
INSERT INTO `tbl_laghaimpointhistory` VALUES (77, 1, 1, 'account', 1758230, 1, 1758231, 'LH0B', NULL, '2021-09-04 18:07:17');
INSERT INTO `tbl_laghaimpointhistory` VALUES (78, 1, 1, 'account', 1758231, 1, 1758232, 'LH0B', NULL, '2021-09-04 18:07:33');
INSERT INTO `tbl_laghaimpointhistory` VALUES (79, 1, 1, 'account', 1758232, 1, 1758233, 'LH0B', NULL, '2021-09-04 18:08:05');
INSERT INTO `tbl_laghaimpointhistory` VALUES (80, 1, 1, 'account', 1758233, 1, 1758234, 'LH0B', NULL, '2021-09-04 18:08:07');
INSERT INTO `tbl_laghaimpointhistory` VALUES (81, 1, 1, 'account', 1758234, 1, 1758235, 'LH0B', NULL, '2021-09-04 18:08:23');
INSERT INTO `tbl_laghaimpointhistory` VALUES (82, 1, 1, 'account', 1758235, 1, 1758236, 'LH0B', NULL, '2021-09-04 18:08:24');
INSERT INTO `tbl_laghaimpointhistory` VALUES (83, 1, 1, 'account', 1758236, 1, 1758237, 'LH0B', NULL, '2021-09-04 18:08:31');
INSERT INTO `tbl_laghaimpointhistory` VALUES (84, 1, 1, 'account', 1758237, 1, 1758238, 'LH0B', NULL, '2021-09-04 18:08:37');
INSERT INTO `tbl_laghaimpointhistory` VALUES (85, 1, 1, 'account', 1758238, 1, 1758239, 'LH0B', NULL, '2021-09-04 18:08:37');
INSERT INTO `tbl_laghaimpointhistory` VALUES (86, 1, 1, 'account', 1758239, 1, 1758240, 'LH0B', NULL, '2021-09-04 18:08:37');
INSERT INTO `tbl_laghaimpointhistory` VALUES (87, 1, 1, 'account', 1758240, 1, 1758241, 'LH0B', NULL, '2021-09-04 18:08:37');
INSERT INTO `tbl_laghaimpointhistory` VALUES (88, 1, 1, 'account', 1758241, 1, 1758242, 'LH0B', NULL, '2021-09-04 18:17:38');
INSERT INTO `tbl_laghaimpointhistory` VALUES (89, 1, 1, 'account', 1758242, 1, 1758243, 'LH0B', NULL, '2021-09-04 18:17:40');
INSERT INTO `tbl_laghaimpointhistory` VALUES (90, 1, 1, 'account', 1758243, 1, 1758244, 'LH0B', NULL, '2021-09-04 18:17:45');
INSERT INTO `tbl_laghaimpointhistory` VALUES (91, 1, 1, 'account', 1758244, 1, 1758245, 'LH0B', NULL, '2021-09-04 18:19:58');
INSERT INTO `tbl_laghaimpointhistory` VALUES (92, 1, 1, 'account', 1758245, 1, 1758246, 'LH0B', NULL, '2021-09-04 18:20:05');
INSERT INTO `tbl_laghaimpointhistory` VALUES (93, 1, 1, 'account', 1758246, 1, 1758247, 'LH0B', NULL, '2021-09-04 18:20:05');
INSERT INTO `tbl_laghaimpointhistory` VALUES (94, 1, 1, 'account', 1758247, 1, 1758248, 'LH0B', NULL, '2021-09-04 18:20:05');
INSERT INTO `tbl_laghaimpointhistory` VALUES (95, 1, 1, 'account', 1758248, 1, 1758249, 'LH0B', NULL, '2021-09-04 18:20:05');
INSERT INTO `tbl_laghaimpointhistory` VALUES (96, 1, 1, 'account', 1758249, 1, 1758250, 'LH0B', NULL, '2021-09-04 18:20:05');
INSERT INTO `tbl_laghaimpointhistory` VALUES (97, 1, 1, 'account', 1758250, 1, 1758251, 'LH0B', NULL, '2021-09-04 18:20:05');
INSERT INTO `tbl_laghaimpointhistory` VALUES (98, 1, 1, 'account', 1758251, 1, 1758252, 'LH0B', NULL, '2021-09-04 18:20:22');
INSERT INTO `tbl_laghaimpointhistory` VALUES (99, 1, 1, 'account', 1758252, 1, 1758253, 'LH0B', NULL, '2021-09-04 18:26:08');
INSERT INTO `tbl_laghaimpointhistory` VALUES (100, 1, 1, 'account', 1758253, 1, 1758254, 'LH0B', NULL, '2021-09-04 18:26:29');
INSERT INTO `tbl_laghaimpointhistory` VALUES (101, 1, 1, 'account', 1758254, 1, 1758255, 'LH0B', NULL, '2021-09-04 18:28:03');
INSERT INTO `tbl_laghaimpointhistory` VALUES (102, 1, 1, 'account', 1758255, 1, 1758256, 'LH0B', NULL, '2021-09-04 18:31:14');
INSERT INTO `tbl_laghaimpointhistory` VALUES (103, 1, 1, 'account', 1758256, 1, 1758257, 'LH0B', NULL, '2021-09-04 18:35:04');
INSERT INTO `tbl_laghaimpointhistory` VALUES (104, 1, 1, 'account', 1758257, 1, 1758258, 'LH0B', NULL, '2021-09-04 18:36:31');
INSERT INTO `tbl_laghaimpointhistory` VALUES (105, 1, 1, 'account', 1758258, 1, 1758259, 'LH0B', NULL, '2021-09-04 18:37:02');
INSERT INTO `tbl_laghaimpointhistory` VALUES (106, 1, 1, 'account', 1758259, 1, 1758260, 'LH0B', NULL, '2021-09-04 18:37:16');
INSERT INTO `tbl_laghaimpointhistory` VALUES (107, 1, 1, 'account', 1758260, 1, 1758261, 'LH0B', NULL, '2021-09-04 18:37:31');
INSERT INTO `tbl_laghaimpointhistory` VALUES (108, 1, 1, 'account', 1758261, 1, 1758262, 'LH0B', NULL, '2021-09-04 18:37:43');
INSERT INTO `tbl_laghaimpointhistory` VALUES (109, 1, 1, 'account', 1758262, 1, 1758263, 'LH0B', NULL, '2021-09-04 18:38:03');
INSERT INTO `tbl_laghaimpointhistory` VALUES (110, 1, 1, 'account', 1758263, 1, 1758264, 'LH0B', NULL, '2021-09-04 18:38:26');
INSERT INTO `tbl_laghaimpointhistory` VALUES (111, 1, 1, 'account', 1758264, 1, 1758265, 'LH0B', NULL, '2021-09-04 18:38:31');
INSERT INTO `tbl_laghaimpointhistory` VALUES (112, 1, 1, 'account', 1758265, 1, 1758266, 'LH0B', NULL, '2021-09-04 18:38:33');
INSERT INTO `tbl_laghaimpointhistory` VALUES (113, 1, 1, 'account', 1758266, 1, 1758267, 'LH0B', NULL, '2021-09-04 18:38:33');
INSERT INTO `tbl_laghaimpointhistory` VALUES (114, 1, 1, 'account', 1758267, 1, 1758268, 'LH0B', NULL, '2021-09-04 18:39:12');
INSERT INTO `tbl_laghaimpointhistory` VALUES (115, 1, 1, 'account', 1758268, 1, 1758269, 'LH0B', NULL, '2021-09-04 18:39:15');
INSERT INTO `tbl_laghaimpointhistory` VALUES (116, 1, 1, 'account', 1758269, 1, 1758270, 'LH0B', NULL, '2021-09-04 18:39:48');
INSERT INTO `tbl_laghaimpointhistory` VALUES (117, 1, 1, 'account', 1758270, 1, 1758271, 'LH0B', NULL, '2021-09-04 18:39:48');
INSERT INTO `tbl_laghaimpointhistory` VALUES (118, 1, 1, 'account', 1758271, 1, 1758272, 'LH0B', NULL, '2021-09-04 18:39:51');
INSERT INTO `tbl_laghaimpointhistory` VALUES (119, 1, 1, 'account', 1758272, 1, 1758273, 'LH0B', NULL, '2021-09-04 18:39:54');
INSERT INTO `tbl_laghaimpointhistory` VALUES (120, 1, 1, 'account', 1758273, 1, 1758274, 'LH0B', NULL, '2021-09-04 18:40:10');
INSERT INTO `tbl_laghaimpointhistory` VALUES (121, 1, 1, 'account', 1758274, 1, 1758275, 'LH0B', NULL, '2021-09-04 18:40:12');
INSERT INTO `tbl_laghaimpointhistory` VALUES (122, 1, 1, 'account', 1758275, 1, 1758276, 'LH0B', NULL, '2021-09-04 18:40:13');
INSERT INTO `tbl_laghaimpointhistory` VALUES (123, 1, 1, 'account', 1758276, 1, 1758277, 'LH0B', NULL, '2021-09-04 18:40:14');
INSERT INTO `tbl_laghaimpointhistory` VALUES (124, 1, 1, 'account', 1758277, 1, 1758278, 'LH0B', NULL, '2021-09-04 18:43:32');
INSERT INTO `tbl_laghaimpointhistory` VALUES (125, 1, 1, 'account', 1758278, 1, 1758279, 'LH0B', NULL, '2021-09-04 18:43:42');
INSERT INTO `tbl_laghaimpointhistory` VALUES (126, 1, 1, 'account', 1758279, 1, 1758280, 'LH0B', NULL, '2021-09-04 18:43:42');
INSERT INTO `tbl_laghaimpointhistory` VALUES (127, 1, 1, 'account', 1758280, 1, 1758281, 'LH0B', NULL, '2021-09-04 18:44:02');
INSERT INTO `tbl_laghaimpointhistory` VALUES (128, 1, 1, 'account', 1758281, 1, 1758282, 'LH0B', NULL, '2021-09-04 18:44:25');
INSERT INTO `tbl_laghaimpointhistory` VALUES (129, 1, 1, 'account', 1758282, 1, 1758283, 'LH0B', NULL, '2021-09-04 18:44:26');
INSERT INTO `tbl_laghaimpointhistory` VALUES (130, 1, 1, 'account', 1758283, 1, 1758284, 'LH0B', NULL, '2021-09-04 18:44:27');
INSERT INTO `tbl_laghaimpointhistory` VALUES (131, 1, 1, 'account', 1758284, 1, 1758285, 'LH0B', NULL, '2021-09-04 18:44:30');
INSERT INTO `tbl_laghaimpointhistory` VALUES (132, 1, 1, 'account', 1758285, 1, 1758286, 'LH0B', NULL, '2021-09-04 18:45:40');
INSERT INTO `tbl_laghaimpointhistory` VALUES (133, 1, 1, 'account', 1758286, 1, 1758287, 'LH0B', NULL, '2021-09-04 18:47:08');
INSERT INTO `tbl_laghaimpointhistory` VALUES (134, 1, 1, 'account', 1758287, 1, 1758288, 'LH0B', NULL, '2021-09-04 18:47:22');
INSERT INTO `tbl_laghaimpointhistory` VALUES (135, 1, 1, 'account', 1758288, 1, 1758289, 'LH0B', NULL, '2021-09-04 18:48:19');
INSERT INTO `tbl_laghaimpointhistory` VALUES (136, 1, 1, 'account', 1758289, 1, 1758290, 'LH0B', NULL, '2021-09-04 18:48:22');
INSERT INTO `tbl_laghaimpointhistory` VALUES (137, 1, 1, 'account', 1758290, 1, 1758291, 'LH0B', NULL, '2021-09-04 18:48:26');
INSERT INTO `tbl_laghaimpointhistory` VALUES (138, 1, 1, 'account', 1758291, 1, 1758292, 'LH0B', NULL, '2021-09-04 18:48:30');
INSERT INTO `tbl_laghaimpointhistory` VALUES (139, 1, 1, 'account', 1758292, 1, 1758293, 'LH0B', NULL, '2021-09-04 18:48:32');
INSERT INTO `tbl_laghaimpointhistory` VALUES (140, 1, 1, 'account', 1758293, 1, 1758294, 'LH0B', NULL, '2021-09-04 18:48:41');
INSERT INTO `tbl_laghaimpointhistory` VALUES (141, 1, 1, 'account', 1758294, 1, 1758295, 'LH0B', NULL, '2021-09-04 18:49:24');
INSERT INTO `tbl_laghaimpointhistory` VALUES (142, 1, 1, 'account', 1758295, 1, 1758296, 'LH0B', NULL, '2021-09-04 18:49:27');
INSERT INTO `tbl_laghaimpointhistory` VALUES (143, 1, 1, 'account', 1758296, 1, 1758297, 'LH0B', NULL, '2021-09-04 18:49:31');
INSERT INTO `tbl_laghaimpointhistory` VALUES (144, 1, 1, 'account', 1758297, 1, 1758298, 'LH0B', NULL, '2021-09-04 18:49:34');
INSERT INTO `tbl_laghaimpointhistory` VALUES (145, 1, 1, 'account', 1758298, 1, 1758299, 'LH0B', NULL, '2021-09-04 18:49:35');
INSERT INTO `tbl_laghaimpointhistory` VALUES (146, 1, 1, 'account', 1758299, 1, 1758300, 'LH0B', NULL, '2021-09-04 18:49:37');
INSERT INTO `tbl_laghaimpointhistory` VALUES (147, 1, 1, 'account', 1758300, 1, 1758301, 'LH0B', NULL, '2021-09-04 18:50:04');
INSERT INTO `tbl_laghaimpointhistory` VALUES (148, 1, 1, 'account', 1758301, 1, 1758302, 'LH0B', NULL, '2021-09-04 18:50:31');
INSERT INTO `tbl_laghaimpointhistory` VALUES (149, 1, 1, 'account', 1758302, 1, 1758303, 'LH0B', NULL, '2021-09-04 18:50:33');
INSERT INTO `tbl_laghaimpointhistory` VALUES (150, 1, 1, 'account', 1758303, 1, 1758304, 'LH0B', NULL, '2021-09-04 18:50:47');
INSERT INTO `tbl_laghaimpointhistory` VALUES (151, 1, 1, 'account', 1758304, 1, 1758305, 'LH0B', NULL, '2021-09-04 18:50:47');
INSERT INTO `tbl_laghaimpointhistory` VALUES (152, 1, 1, 'account', 1758305, 1, 1758306, 'LH0B', NULL, '2021-09-04 18:50:47');
INSERT INTO `tbl_laghaimpointhistory` VALUES (153, 1, 1, 'account', 1758306, 1, 1758307, 'LH0B', NULL, '2021-09-04 18:50:47');
INSERT INTO `tbl_laghaimpointhistory` VALUES (154, 1, 1, 'account', 1758307, 1, 1758308, 'LH0B', NULL, '2021-09-04 18:51:17');
INSERT INTO `tbl_laghaimpointhistory` VALUES (155, 1, 1, 'account', 1758308, 1, 1758309, 'LH0B', NULL, '2021-09-04 18:51:17');
INSERT INTO `tbl_laghaimpointhistory` VALUES (156, 1, 1, 'account', 1758309, 1, 1758310, 'LH0B', NULL, '2021-09-04 18:51:24');
INSERT INTO `tbl_laghaimpointhistory` VALUES (157, 1, 1, 'account', 1758310, 1, 1758311, 'LH0B', NULL, '2021-09-04 18:51:59');
INSERT INTO `tbl_laghaimpointhistory` VALUES (158, 1, 1, 'account', 1758311, 1, 1758312, 'LH0B', NULL, '2021-09-04 18:52:05');
INSERT INTO `tbl_laghaimpointhistory` VALUES (159, 1, 1, 'account', 1758312, 1, 1758313, 'LH0B', NULL, '2021-09-04 18:52:07');
INSERT INTO `tbl_laghaimpointhistory` VALUES (160, 1, 1, 'account', 1758313, 1, 1758314, 'LH0B', NULL, '2021-09-04 18:52:23');
INSERT INTO `tbl_laghaimpointhistory` VALUES (161, 1, 1, 'account', 1758314, 1, 1758315, 'LH0B', NULL, '2021-09-04 18:52:36');
INSERT INTO `tbl_laghaimpointhistory` VALUES (162, 1, 1, 'account', 1758315, 1, 1758316, 'LH0B', NULL, '2021-09-04 18:52:59');
INSERT INTO `tbl_laghaimpointhistory` VALUES (163, 1, 1, 'account', 1758316, 1, 1758317, 'LH0B', NULL, '2021-09-04 18:53:26');
INSERT INTO `tbl_laghaimpointhistory` VALUES (164, 1, 1, 'account', 1758317, 1, 1758318, 'LH0B', NULL, '2021-09-04 18:53:33');
INSERT INTO `tbl_laghaimpointhistory` VALUES (165, 1, 1, 'account', 1758318, 1, 1758319, 'LH0B', NULL, '2021-09-04 18:53:43');
INSERT INTO `tbl_laghaimpointhistory` VALUES (166, 1, 1, 'account', 1758319, 1, 1758320, 'LH0B', NULL, '2021-09-04 18:53:48');
INSERT INTO `tbl_laghaimpointhistory` VALUES (167, 1, 1, 'account', 1758320, 1, 1758321, 'LH0B', NULL, '2021-09-04 18:53:58');
INSERT INTO `tbl_laghaimpointhistory` VALUES (168, 1, 1, 'account', 1758321, 1, 1758322, 'LH0B', NULL, '2021-09-04 18:54:04');
INSERT INTO `tbl_laghaimpointhistory` VALUES (169, 1, 1, 'account', 1758322, 1, 1758323, 'LH0B', NULL, '2021-09-04 18:54:19');
INSERT INTO `tbl_laghaimpointhistory` VALUES (170, 1, 1, 'account', 1758323, 1, 1758324, 'LH0B', NULL, '2021-09-04 18:55:21');
INSERT INTO `tbl_laghaimpointhistory` VALUES (171, 1, 1, 'account', 1758324, 1, 1758325, 'LH0B', NULL, '2021-09-04 18:56:31');
INSERT INTO `tbl_laghaimpointhistory` VALUES (172, 1, 1, 'account', 1758325, 1, 1758326, 'LH0B', NULL, '2021-09-04 18:58:12');
INSERT INTO `tbl_laghaimpointhistory` VALUES (173, 1, 1, 'account', 1758326, 1, 1758327, 'LH0B', NULL, '2021-09-04 19:13:41');
INSERT INTO `tbl_laghaimpointhistory` VALUES (174, 1, 1, 'account', 1758327, 1, 1758328, 'LH0B', NULL, '2021-09-04 19:16:10');
INSERT INTO `tbl_laghaimpointhistory` VALUES (175, 1, 1, 'account', 1758328, 1, 1758329, 'LH0B', NULL, '2021-09-04 19:16:19');
INSERT INTO `tbl_laghaimpointhistory` VALUES (176, 1, 1, 'account', 1758329, 1, 1758330, 'LH0B', NULL, '2021-09-04 19:29:15');
INSERT INTO `tbl_laghaimpointhistory` VALUES (177, 1, 1, 'account', 1758330, 1, 1758331, 'LH0B', NULL, '2021-09-04 19:40:48');
INSERT INTO `tbl_laghaimpointhistory` VALUES (178, 1, 1, 'account', 1758331, 1, 1758332, 'LH0B', NULL, '2021-09-04 19:43:13');
INSERT INTO `tbl_laghaimpointhistory` VALUES (179, 1, 1, 'account', 1758332, 1, 1758333, 'LH0B', NULL, '2021-09-04 21:47:08');
INSERT INTO `tbl_laghaimpointhistory` VALUES (180, 1, 1, 'account', 1758333, 1, 1758334, 'LH0B', NULL, '2021-09-05 06:32:56');
INSERT INTO `tbl_laghaimpointhistory` VALUES (181, 1, 1, 'account', 1758334, 1, 1758335, 'LH0B', NULL, '2021-09-05 06:39:12');
INSERT INTO `tbl_laghaimpointhistory` VALUES (182, 1, 1, 'account', 1758335, 1, 1758336, 'LH0B', NULL, '2021-09-05 06:42:03');
INSERT INTO `tbl_laghaimpointhistory` VALUES (183, 1, 1, 'account', 1758336, 500, 1758836, 'LH0B', NULL, '2021-09-05 10:04:53');
INSERT INTO `tbl_laghaimpointhistory` VALUES (184, 1, 1, 'account', 1758836, 500, 1759336, 'LH0B', NULL, '2021-09-05 10:05:12');
INSERT INTO `tbl_laghaimpointhistory` VALUES (185, 1, 1, 'account', 1759336, 500, 1759836, 'LH0B', NULL, '2021-09-05 10:05:14');
INSERT INTO `tbl_laghaimpointhistory` VALUES (186, 1, 1, 'account', 1759836, 500, 1760336, 'LH0B', NULL, '2021-09-05 10:05:14');
INSERT INTO `tbl_laghaimpointhistory` VALUES (187, 1, 1, 'account', 1760336, 500, 1760836, 'LH0B', NULL, '2021-09-05 10:05:17');
INSERT INTO `tbl_laghaimpointhistory` VALUES (188, 1, 1, 'account', 1760836, 500, 1761336, 'LH0B', NULL, '2021-09-05 10:05:22');
INSERT INTO `tbl_laghaimpointhistory` VALUES (189, 1, 1, 'account', 1761336, 200, 1761536, 'LH0B', NULL, '2021-09-05 10:25:13');
INSERT INTO `tbl_laghaimpointhistory` VALUES (190, 1, 1, 'account', 1761536, 200, 1761736, 'LH0B', NULL, '2021-09-05 10:40:21');
INSERT INTO `tbl_laghaimpointhistory` VALUES (191, 1, 1, 'account', 1761736, 200, 1761936, 'LH0B', NULL, '2021-09-05 11:15:05');
INSERT INTO `tbl_laghaimpointhistory` VALUES (192, 1, 1, 'account', 1761936, 200, 1762136, 'LH0B', NULL, '2021-09-05 11:15:21');
INSERT INTO `tbl_laghaimpointhistory` VALUES (193, 1, 1, 'account', 1762136, 200, 1762336, 'LH0B', NULL, '2021-09-05 11:15:21');
INSERT INTO `tbl_laghaimpointhistory` VALUES (194, 1, 1, 'account', 1762336, 200, 1762536, 'LH0B', NULL, '2021-09-05 11:15:21');
INSERT INTO `tbl_laghaimpointhistory` VALUES (195, 1, 1, 'account', 1762536, 200, 1762736, 'LH0B', NULL, '2021-09-05 11:15:21');
INSERT INTO `tbl_laghaimpointhistory` VALUES (196, 1, 1, 'account', 1762736, 200, 1762936, 'LH0B', NULL, '2021-09-05 11:15:24');
INSERT INTO `tbl_laghaimpointhistory` VALUES (197, 1, 1, 'account', 1762936, 200, 1763136, 'LH0B', NULL, '2021-09-05 11:15:25');
INSERT INTO `tbl_laghaimpointhistory` VALUES (198, 1, 1, 'account', 1763136, 200, 1763336, 'LH0B', NULL, '2021-09-05 11:17:53');
INSERT INTO `tbl_laghaimpointhistory` VALUES (199, 1, 1, 'account', 1763336, 1, 1763337, 'LH0B', NULL, '2021-09-05 13:13:55');
INSERT INTO `tbl_laghaimpointhistory` VALUES (200, 2, 2, 'accountgm', 0, 250, 250, 'LH0B', NULL, '2021-09-06 14:05:13');
INSERT INTO `tbl_laghaimpointhistory` VALUES (201, 1, 1, 'account', 1763337, 50, 1763387, 'LH0B', NULL, '2021-12-02 19:08:59');
INSERT INTO `tbl_laghaimpointhistory` VALUES (202, 1, 1, 'account', 1763387, 100, 1763487, 'LH0B', NULL, '2021-12-02 19:09:28');
INSERT INTO `tbl_laghaimpointhistory` VALUES (203, 1, 1, 'account', 1763487, 150, 1763637, 'LH0B', NULL, '2021-12-02 19:10:04');
INSERT INTO `tbl_laghaimpointhistory` VALUES (204, 1, 1, 'account', 1763637, 150, 1763787, 'LH0B', NULL, '2021-12-02 19:10:25');
INSERT INTO `tbl_laghaimpointhistory` VALUES (205, 1, 1, 'account', 1763787, 50, 1763837, 'LH0B', NULL, '2021-12-02 19:11:30');
INSERT INTO `tbl_laghaimpointhistory` VALUES (206, 1, 1, 'account', 1763837, 100, 1763937, 'LH0B', NULL, '2021-12-02 19:11:34');
INSERT INTO `tbl_laghaimpointhistory` VALUES (207, 1, 1, 'account', 1763937, 1, 1763938, 'LH0B', NULL, '2021-12-02 19:11:37');
INSERT INTO `tbl_laghaimpointhistory` VALUES (208, 1, 1, 'account', 1763938, -150, 1763788, 'LH01', NULL, '2021-12-26 13:19:58');
INSERT INTO `tbl_laghaimpointhistory` VALUES (209, 1, 1, 'account', 1763788, -150, 1763638, 'LH01', NULL, '2021-12-26 13:20:03');
INSERT INTO `tbl_laghaimpointhistory` VALUES (210, 1, 1, 'account', 1763638, -5000, 1758638, 'LH01', NULL, '2021-12-26 13:20:09');
INSERT INTO `tbl_laghaimpointhistory` VALUES (211, 1, 1, 'account', 1758638, -5000, 1753638, 'LH01', NULL, '2021-12-26 13:20:12');
INSERT INTO `tbl_laghaimpointhistory` VALUES (212, 1, 1, 'account', 1753638, -5000, 1748638, 'LH01', NULL, '2021-12-26 13:20:13');
INSERT INTO `tbl_laghaimpointhistory` VALUES (213, 1, 1, 'account', 1748638, -120, 1748518, 'LH01', NULL, '2021-12-29 20:14:00');
INSERT INTO `tbl_laghaimpointhistory` VALUES (214, 1, 1, 'account', 1748518, -120, 1748398, 'LH01', NULL, '2021-12-29 20:14:01');
INSERT INTO `tbl_laghaimpointhistory` VALUES (215, 1, 1, 'account', 1748398, -120, 1748278, 'LH01', NULL, '2021-12-29 20:14:02');
INSERT INTO `tbl_laghaimpointhistory` VALUES (216, 1, 1, 'account', 1748278, -120, 1748158, 'LH01', NULL, '2021-12-29 20:14:03');
INSERT INTO `tbl_laghaimpointhistory` VALUES (217, 1, 1, 'account', 1748158, -120, 1748038, 'LH01', NULL, '2021-12-29 20:14:04');
INSERT INTO `tbl_laghaimpointhistory` VALUES (218, 1, 1, 'account', 1748038, -120, 1747918, 'LH01', NULL, '2021-12-29 20:14:04');
INSERT INTO `tbl_laghaimpointhistory` VALUES (219, 1, 1, 'account', 1747918, -2000, 1745918, 'LH01', NULL, '2021-12-29 20:14:10');
INSERT INTO `tbl_laghaimpointhistory` VALUES (220, 1, 1, 'account', 1745918, -2000, 1743918, 'LH01', NULL, '2021-12-29 20:14:11');
INSERT INTO `tbl_laghaimpointhistory` VALUES (221, 1, 1, 'account', 1743918, -2000, 1741918, 'LH01', NULL, '2021-12-29 20:14:12');
INSERT INTO `tbl_laghaimpointhistory` VALUES (222, 1, 1, 'account', 1741918, -100, 1741818, 'LH01', NULL, '2021-12-29 20:14:24');
INSERT INTO `tbl_laghaimpointhistory` VALUES (223, 1, 1, 'account', 1741818, -200, 1741618, 'LH01', NULL, '2021-12-29 21:17:18');
INSERT INTO `tbl_laghaimpointhistory` VALUES (224, 1, 1, 'account', 1741618, -5000, 1736618, 'LH01', NULL, '2021-12-29 21:17:30');
INSERT INTO `tbl_laghaimpointhistory` VALUES (225, 1, 1, 'account', 1736618, -50000, 1686618, 'LH01', NULL, '2021-12-31 20:56:05');
INSERT INTO `tbl_laghaimpointhistory` VALUES (226, 1, 1, 'account', 1686618, -30000, 1656618, 'LH01', NULL, '2021-12-31 21:00:11');
INSERT INTO `tbl_laghaimpointhistory` VALUES (227, 1, 1, 'account', 1656618, -50, 1656568, 'LH01', NULL, '2021-12-31 21:05:28');
INSERT INTO `tbl_laghaimpointhistory` VALUES (228, 1, 1, 'account', 1656568, -120, 1656448, 'LH01', NULL, '2022-01-13 22:41:59');
INSERT INTO `tbl_laghaimpointhistory` VALUES (229, 1, 1, 'account', 1656448, -120, 1656328, 'LH01', NULL, '2022-01-13 22:41:59');
INSERT INTO `tbl_laghaimpointhistory` VALUES (230, 1, 1, 'account', 1656328, -120, 1656208, 'LH01', NULL, '2022-01-13 22:42:00');
INSERT INTO `tbl_laghaimpointhistory` VALUES (231, 1, 1, 'account', 1656208, -120, 1656088, 'LH01', NULL, '2022-01-13 22:42:02');
INSERT INTO `tbl_laghaimpointhistory` VALUES (232, 1, 1, 'account', 1656088, -120, 1655968, 'LH01', NULL, '2022-01-13 22:42:02');
INSERT INTO `tbl_laghaimpointhistory` VALUES (233, 1, 1, 'account', 1655968, -120, 1655848, 'LH01', NULL, '2022-01-13 22:42:03');
INSERT INTO `tbl_laghaimpointhistory` VALUES (234, 1, 1, 'account', 1655848, 300, 1656148, 'LH0B', NULL, '2022-01-18 23:15:48');
INSERT INTO `tbl_laghaimpointhistory` VALUES (235, 1, 1, 'account', 1656148, 1000, 1657148, 'LH0B', NULL, '2022-01-22 18:26:20');
INSERT INTO `tbl_laghaimpointhistory` VALUES (236, 1, 1, 'account', 1657148, -150, 1656998, 'LH01', NULL, '2022-01-22 18:29:55');
INSERT INTO `tbl_laghaimpointhistory` VALUES (237, 1, 1, 'account', 1656998, -150, 1656848, 'LH01', NULL, '2022-01-22 18:29:56');
INSERT INTO `tbl_laghaimpointhistory` VALUES (238, 1, 1, 'account', 1656848, -150, 1656698, 'LH01', NULL, '2022-01-22 18:30:02');
INSERT INTO `tbl_laghaimpointhistory` VALUES (239, 1, 1, 'account', 1656698, -150, 1656548, 'LH01', NULL, '2022-01-22 18:30:03');
INSERT INTO `tbl_laghaimpointhistory` VALUES (240, 1, 1, 'account', 1656548, -150, 1656398, 'LH01', NULL, '2022-01-22 18:30:04');
INSERT INTO `tbl_laghaimpointhistory` VALUES (241, 1, 1, 'account', 1656398, 1000, 1657398, 'LH0B', NULL, '2022-01-22 18:30:45');
INSERT INTO `tbl_laghaimpointhistory` VALUES (242, 1, 1, 'account', 1657398, 1000, 1658398, 'LH0B', NULL, '2022-01-22 18:34:34');
INSERT INTO `tbl_laghaimpointhistory` VALUES (243, 1, 1, 'account', 1658398, 1000, 1659398, 'LH0B', NULL, '2022-01-22 18:35:19');
INSERT INTO `tbl_laghaimpointhistory` VALUES (244, 1, 1, 'account', 1659398, 1000, 1660398, 'LH0B', NULL, '2022-01-22 18:43:33');
INSERT INTO `tbl_laghaimpointhistory` VALUES (245, 1, 1, 'account', 1660398, 1000, 1661398, 'LH0B', NULL, '2022-01-22 18:45:01');
INSERT INTO `tbl_laghaimpointhistory` VALUES (246, 1, 1, 'account', 1661398, 1000, 1662398, 'LH0B', NULL, '2022-01-22 18:45:18');
INSERT INTO `tbl_laghaimpointhistory` VALUES (247, 1, 1, 'account', 1662398, 1000, 1663398, 'LH0B', NULL, '2022-01-22 18:54:28');
INSERT INTO `tbl_laghaimpointhistory` VALUES (248, 1, 1, 'account', 1663398, 1000, 1664398, 'LH0B', NULL, '2022-01-22 19:10:47');
INSERT INTO `tbl_laghaimpointhistory` VALUES (249, 1, 1, 'account', 1664398, 1000, 1665398, 'LH0B', NULL, '2022-01-22 19:11:29');
INSERT INTO `tbl_laghaimpointhistory` VALUES (250, 1, 1, 'account', 1665398, 1000, 1666398, 'LH0B', NULL, '2022-01-22 19:11:55');
INSERT INTO `tbl_laghaimpointhistory` VALUES (251, 1, 1, 'account', 1666398, 1000, 1667398, 'LH0B', NULL, '2022-01-22 19:13:07');
INSERT INTO `tbl_laghaimpointhistory` VALUES (252, 1, 1, 'account', 1667398, 1000, 1668398, 'LH0B', NULL, '2022-01-22 19:15:25');
INSERT INTO `tbl_laghaimpointhistory` VALUES (253, 1, 1, 'account', 1668398, 1000, 1669398, 'LH0B', NULL, '2022-01-22 19:27:20');
INSERT INTO `tbl_laghaimpointhistory` VALUES (254, 1, 1, 'account', 1669398, 1000, 1670398, 'LH0B', NULL, '2022-01-22 19:30:03');

-- ----------------------------
-- Table structure for tbl_laghaimpointrepayjoin
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpointrepayjoin`;
CREATE TABLE `tbl_laghaimpointrepayjoin`  (
  `lpr_user_idx` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `lpr_lag_user_idx` mediumint(9) NULL DEFAULT NULL,
  `lpr_repay_point` mediumint(5) UNSIGNED NOT NULL DEFAULT 0,
  `lpr_goods_code` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lpr_reg_date` datetime(0) NULL DEFAULT NULL,
  INDEX `IDX_UserIdx`(`lpr_user_idx`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Laghaim Point È¯ºÒ µ¥ÀÌÅÍ ÀÓ½Ã ÀúÀå¿ë (for L.P °æ¸Å)' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_laghaimpointuser
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpointuser`;
CREATE TABLE `tbl_laghaimpointuser`  (
  `lpu_idx` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lpu_user_idx` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `lpu_user_lag_idx` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `lpu_user_idname` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lpu_user_lag_point` int(11) NOT NULL DEFAULT 0,
  `lpu_update_date` datetime(0) NOT NULL,
  PRIMARY KEY (`lpu_idx`) USING BTREE,
  UNIQUE INDEX `IDX_UserIdx`(`lpu_user_idx`) USING BTREE,
  INDEX `IDX_UserIdname`(`lpu_user_idname`) USING BTREE,
  INDEX `IDX_UserLagIdx`(`lpu_user_lag_idx`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'ÇÁ¸®¹Ì¾ö ¼­ºñ½º(Laghaim Point)' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_laghaimpointuser
-- ----------------------------
INSERT INTO `tbl_laghaimpointuser` VALUES (1, 3, 0, 'ledark', 985036, '2021-08-12 20:55:40');
INSERT INTO `tbl_laghaimpointuser` VALUES (2, 1, 0, 'account', 1670398, '2022-01-22 19:30:03');
INSERT INTO `tbl_laghaimpointuser` VALUES (3, 2, 0, 'accountgm', 250, '2021-09-06 14:05:13');

-- ----------------------------
-- Table structure for tbl_laghaimpremiumhistory
-- ----------------------------
DROP TABLE IF EXISTS `tbl_laghaimpremiumhistory`;
CREATE TABLE `tbl_laghaimpremiumhistory`  (
  `lph_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lph_user_idx` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `lph_user_lag_idx` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `lph_user_id` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lph_user_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lph_goods_code` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lph_payment_code` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `lph_lag_payment_idx` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `lph_generate_date` datetime(0) NOT NULL,
  PRIMARY KEY (`lph_idx`) USING BTREE,
  INDEX `IDX_UserIdx_PointGoodsCode_GenerateDate`(`lph_user_idx`, `lph_goods_code`, `lph_generate_date`) USING BTREE,
  INDEX `IDX_LagPaymentIdx`(`lph_lag_payment_idx`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'ÇÁ¸®¹Ì¾ö¼­ºñ½º È÷½ºÅä¸® - Ä³¸¯ÅÍ °èÁ¤ ÀÌµ¿ ¼­ºñ½º' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_premiumresulthistory
-- ----------------------------
DROP TABLE IF EXISTS `tbl_premiumresulthistory`;
CREATE TABLE `tbl_premiumresulthistory`  (
  `prh_idx` int(10) NOT NULL AUTO_INCREMENT,
  `prh_th_user_idx` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `prh_th_user_lag_idx` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `prh_th_user_idname` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `prh_tar_user_idx` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `prh_tar_user_lag_idx` int(8) UNSIGNED NOT NULL DEFAULT 0,
  `prh_tar_user_idname` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `prh_modify_before_desc` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `prh_modify_after_desc` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `prh_site_code` enum('LH','LC') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'LH',
  `prh_server` enum('0','1','2','3','4','5','6','7','8') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `prh_modify_date` datetime(0) NOT NULL,
  `prh_give_place` enum('LH','LC','web') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'LH',
  `prh_event_name` enum('none','guild','char','charmove') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'none',
  PRIMARY KEY (`prh_idx`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tbl_ticket
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ticket`;
CREATE TABLE `tbl_ticket`  (
  `tkt_idx` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tkt_coupon_no` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `tkt_user_idx` int(10) UNSIGNED NULL DEFAULT NULL,
  `tkt_game_type` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tkt_used` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'N',
  `tkt_issue_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`tkt_idx`) USING BTREE,
  INDEX `IDX_UserIdx_GameType`(`tkt_user_idx`, `tkt_game_type`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '³ð³ð³ð ÀÌº¥Æ®¿ë ¿µÈ­Æ¼ÄÏ ½Ã¸®¾ó' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
