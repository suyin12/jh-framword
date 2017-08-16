/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : thinkphpcms

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2016-09-22 16:53:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tpcms_admininfo`
-- ----------------------------
DROP TABLE IF EXISTS `tpcms_admininfo`;
CREATE TABLE `tpcms_admininfo` (
  `tpcms_ID` int(10) NOT NULL AUTO_INCREMENT,
  `tpcms_userName` varchar(20) COLLATE utf8_bin NOT NULL,
  `tpcms_password` varchar(50) COLLATE utf8_bin NOT NULL,
  `tpcms_tel` varchar(20) COLLATE utf8_bin NOT NULL,
  `tpcms_qq` varchar(20) COLLATE utf8_bin NOT NULL,
  `tpcms_email` varchar(50) COLLATE utf8_bin NOT NULL,
  `tpcms_createTime` datetime DEFAULT NULL,
  `tpcms_status` int(5) NOT NULL,
  PRIMARY KEY (`tpcms_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tpcms_admininfo
-- ----------------------------

-- ----------------------------
-- Table structure for `tpcms_login`
-- ----------------------------
DROP TABLE IF EXISTS `tpcms_login`;
CREATE TABLE `tpcms_login` (
  `userName` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tpcms_login
-- ----------------------------

-- ----------------------------
-- Table structure for `tpcms_menberinfo`
-- ----------------------------
DROP TABLE IF EXISTS `tpcms_menberinfo`;
CREATE TABLE `tpcms_menberinfo` (
  `tpcms_ID` int(10) NOT NULL AUTO_INCREMENT,
  `tpcms_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `tpcms_password` varchar(50) COLLATE utf8_bin NOT NULL,
  `tpcms_question` varchar(50) COLLATE utf8_bin NOT NULL,
  `tpcms_answer` varchar(20) COLLATE utf8_bin NOT NULL,
  `tpcms_pID` varchar(30) COLLATE utf8_bin NOT NULL,
  `tpcms_tel` varchar(20) COLLATE utf8_bin NOT NULL,
  `tpcms_qq` varchar(20) COLLATE utf8_bin NOT NULL,
  `tpcms_email` varchar(50) COLLATE utf8_bin NOT NULL,
  `tpcms_address` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `tpcms_money` float DEFAULT NULL,
  `tpcms_blance` float DEFAULT NULL,
  `tpcms_createTime` datetime DEFAULT NULL,
  `tpcms_status` int(5) DEFAULT NULL,
  PRIMARY KEY (`tpcms_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tpcms_menberinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `tpcms_newsinfo`
-- ----------------------------
DROP TABLE IF EXISTS `tpcms_newsinfo`;
CREATE TABLE `tpcms_newsinfo` (
  `tpcms_ID` int(10) NOT NULL AUTO_INCREMENT,
  `tpcms_PID` int(10) NOT NULL,
  `tpcms_title` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `tpcms_intro` text COLLATE utf8_bin,
  `tpcms_contents` text COLLATE utf8_bin,
  `tpcms_hits` int(10) DEFAULT NULL,
  `tpcms_createTime` datetime DEFAULT NULL,
  `tpcms_status` int(5) DEFAULT NULL,
  PRIMARY KEY (`tpcms_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tpcms_newsinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `tpcms_newstype`
-- ----------------------------
DROP TABLE IF EXISTS `tpcms_newstype`;
CREATE TABLE `tpcms_newstype` (
  `tpcms_ID` int(10) NOT NULL AUTO_INCREMENT,
  `tpcms_parentID` int(10) NOT NULL,
  `tpcms_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `tpcms_intro` text COLLATE utf8_bin,
  PRIMARY KEY (`tpcms_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tpcms_newstype
-- ----------------------------

-- ----------------------------
-- Table structure for `tpcms_orderinfo`
-- ----------------------------
DROP TABLE IF EXISTS `tpcms_orderinfo`;
CREATE TABLE `tpcms_orderinfo` (
  `tpcms_ID` int(10) NOT NULL AUTO_INCREMENT,
  `tpcms_num` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `tpcms_name` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `tpcms_nums` int(10) DEFAULT NULL,
  `tpcms_money` float DEFAULT NULL,
  `tpcms_taker` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `tpcms_address` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `tpcms_tel` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `tpcms_paymethod` int(5) DEFAULT NULL,
  `tpcms_createTime` datetime DEFAULT NULL,
  `tpcms_status` int(5) DEFAULT NULL,
  `tpcms_remark` text COLLATE utf8_bin,
  PRIMARY KEY (`tpcms_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tpcms_orderinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `tpcms_orderproduct`
-- ----------------------------
DROP TABLE IF EXISTS `tpcms_orderproduct`;
CREATE TABLE `tpcms_orderproduct` (
  `tpcms_ID` int(10) NOT NULL AUTO_INCREMENT,
  `tpcms_num` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `tpcms_PID` int(11) DEFAULT NULL,
  `tpcms_unitPrice` float DEFAULT NULL,
  `tpcms_nums` int(11) DEFAULT NULL,
  `tpcms_flod` float DEFAULT NULL,
  `tpcms_price` float DEFAULT NULL,
  PRIMARY KEY (`tpcms_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tpcms_orderproduct
-- ----------------------------

-- ----------------------------
-- Table structure for `tpcms_productinfo`
-- ----------------------------
DROP TABLE IF EXISTS `tpcms_productinfo`;
CREATE TABLE `tpcms_productinfo` (
  `tpcms_ID` int(10) NOT NULL AUTO_INCREMENT,
  `tpcms_PID` int(10) NOT NULL,
  `tpcms_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `tpcms_model` varchar(300) COLLATE utf8_bin NOT NULL,
  `tpcms_image` varchar(300) COLLATE utf8_bin NOT NULL,
  `tpcms_intro` text COLLATE utf8_bin NOT NULL,
  `tpcms_brand` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `tpcms_mPrice` float DEFAULT NULL,
  `tpcms_vPrice` float DEFAULT NULL,
  `tpcms_sellNum` int(20) DEFAULT NULL,
  `tpcms_storeNum` int(20) DEFAULT NULL,
  `tpcms_hist` int(11) DEFAULT NULL,
  `tpcms_createTime` datetime DEFAULT NULL,
  `tpcms_status` int(5) DEFAULT NULL,
  PRIMARY KEY (`tpcms_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tpcms_productinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `tpcms_producttype`
-- ----------------------------
DROP TABLE IF EXISTS `tpcms_producttype`;
CREATE TABLE `tpcms_producttype` (
  `tpcms_ID` int(10) NOT NULL AUTO_INCREMENT,
  `tpcms_parentID` int(10) NOT NULL,
  `tpcms_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `tpcms_intro` text COLLATE utf8_bin,
  PRIMARY KEY (`tpcms_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tpcms_producttype
-- ----------------------------
