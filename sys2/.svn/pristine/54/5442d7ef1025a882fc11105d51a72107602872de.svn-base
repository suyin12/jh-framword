/*
Navicat MySQL Data Transfer

Source Server         : 开发环境
Source Server Version : 50615
Source Host           : 115.29.168.253:3306
Source Database       : paiqian

Target Server Type    : MYSQL
Target Server Version : 50615
File Encoding         : 65001

Date: 2016-02-19 16:23:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wx_action`
-- ----------------------------
DROP TABLE IF EXISTS `wx_action`;
CREATE TABLE `wx_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text COMMENT '行为规则',
  `log` text COMMENT '日志规则',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='系统行为表';

-- ----------------------------
-- Records of wx_action
-- ----------------------------
INSERT INTO `wx_action` VALUES ('1', 'user_login', '用户登录', '积分+10，每天一次', 'table:member|field:score|condition:uid={$self} AND status>-1|rule:score+10|cycle:24|max:1;', '[user|get_nickname]在[time|time_format]登录了管理中心', '1', '0', '1393685660');
INSERT INTO `wx_action` VALUES ('2', 'add_article', '发布文章', '积分+5，每天上限5次', 'table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:5', '', '2', '0', '1380173180');
INSERT INTO `wx_action` VALUES ('3', 'review', '评论', '评论积分+1，无限制', 'table:member|field:score|condition:uid={$self}|rule:score+1', '', '2', '0', '1383285646');
INSERT INTO `wx_action` VALUES ('4', 'add_document', '发表文档', '积分+10，每天上限5次', 'table:member|field:score|condition:uid={$self}|rule:score+10|cycle:24|max:5', '[user|get_nickname]在[time|time_format]发表了一篇文章。\r\n表[model]，记录编号[record]。', '2', '0', '1386139726');
INSERT INTO `wx_action` VALUES ('5', 'add_document_topic', '发表讨论', '积分+5，每天上限10次', 'table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:10', '', '2', '0', '1383285551');
INSERT INTO `wx_action` VALUES ('6', 'update_config', '更新配置', '新增或修改或删除配置', '', '', '1', '1', '1383294988');
INSERT INTO `wx_action` VALUES ('7', 'update_model', '更新模型', '新增或修改模型', '', '', '1', '1', '1383295057');
INSERT INTO `wx_action` VALUES ('8', 'update_attribute', '更新属性', '新增或更新或删除属性', '', '', '1', '1', '1383295963');
INSERT INTO `wx_action` VALUES ('9', 'update_channel', '更新导航', '新增或修改或删除导航', '', '', '1', '1', '1383296301');
INSERT INTO `wx_action` VALUES ('10', 'update_menu', '更新菜单', '新增或修改或删除菜单', '', '', '1', '1', '1383296392');
INSERT INTO `wx_action` VALUES ('11', 'update_category', '更新分类', '新增或修改或删除分类', '', '', '1', '1', '1383296765');
INSERT INTO `wx_action` VALUES ('12', 'admin_login', '登录后台', '管理员登录后台', '', '[user|get_nickname]在[time|time_format]登录了后台', '2', '1', '1393685618');

-- ----------------------------
-- Table structure for `wx_action_log`
-- ----------------------------
DROP TABLE IF EXISTS `wx_action_log`;
CREATE TABLE `wx_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `action_id_ix` (`action_id`),
  KEY `user_id_ix` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COMMENT='行为日志表';

-- ----------------------------
-- Records of wx_action_log
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_addon_category`
-- ----------------------------
DROP TABLE IF EXISTS `wx_addon_category`;
CREATE TABLE `wx_addon_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `icon` int(10) unsigned DEFAULT NULL COMMENT '分类图标',
  `title` varchar(255) DEFAULT NULL COMMENT '分类名',
  `sort` int(10) DEFAULT '0' COMMENT '排序号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='插件分类表';

-- ----------------------------
-- Records of wx_addon_category
-- ----------------------------
INSERT INTO `wx_addon_category` VALUES ('1', null, '奖励功能', '4');
INSERT INTO `wx_addon_category` VALUES ('2', null, '互动功能', '3');
INSERT INTO `wx_addon_category` VALUES ('7', '0', '高级功能', '10');
INSERT INTO `wx_addon_category` VALUES ('4', null, '公众号管理', '20');
INSERT INTO `wx_addon_category` VALUES ('8', '0', '用户管理', '1');

-- ----------------------------
-- Table structure for `wx_addons`
-- ----------------------------
DROP TABLE IF EXISTS `wx_addons`;
CREATE TABLE `wx_addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  `type` tinyint(1) DEFAULT '0' COMMENT '插件类型 0 普通插件 1 微信插件 2 易信插件',
  `cate_id` int(11) DEFAULT NULL,
  `is_show` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `sti` (`status`,`is_show`)
) ENGINE=MyISAM AUTO_INCREMENT=200 DEFAULT CHARSET=utf8 COMMENT='微信插件表';

-- ----------------------------
-- Records of wx_addons
-- ----------------------------
INSERT INTO `wx_addons` VALUES ('160', 'CustomReply', '自定义回复', '支持图文回复、多图文回复、文本回复功能', '1', 'null', '凡星', '0.1', '1448265263', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('161', 'AutoReply', '自动回复', 'WeiPHP基础功能，能实现配置关键词，用户回复此关键词后自动回复对应的文件，图文，图片信息', '1', 'null', '凡星', '0.1', '1448265611', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('162', 'WeiSite', '微官网', '微3G网站、支持分类管理，文章管理、底部导航管理、微信引导信息配置，微网站统计代码部署。同时支持首页多模板切换、信息列表多模板切换、信息详情模板切换、底部导航多模板切换。并配置有详细的模板二次开发教程', '1', '{\"title\":\"\\u70b9\\u51fb\\u8fdb\\u5165\\u9996\\u9875\",\"cover\":\"\",\"info\":\"\",\"background\":\"\",\"code\":\"\",\"template_index\":\"ColorV1\",\"template_footer\":\"V1\",\"template_lists\":\"V1\",\"template_detail\":\"V1\"}', '凡星', '0.1', '1448265667', '0', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('163', 'UserCenter', '微信用户中心', '实现3G首页、微信登录，微信用户绑定，微信用户信息初始化等基本功能', '1', '{\"score\":\"100\",\"experience\":\"100\",\"need_bind\":\"1\",\"bind_start\":\"0\",\"jumpurl\":\"\"}', '凡星', '0.1', '1448265671', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('164', 'Exam', '微考试', '主要功能有试卷管理，题目录入管理，考生信息和考分汇总管理。', '1', 'null', '凡星', '0.1', '1448265686', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('165', 'Draw', '比赛抽奖', '功能主要有奖品设置，抽奖配置和抽奖统计', '1', 'null', '凡星', '0.1', '1448265689', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('166', 'Extensions', '融合第三方', '第三方功能扩展', '1', 'null', '凡星', '0.1', '1448265693', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('167', 'Forms', '通用表单', '管理员可以轻松地增加一个表单用于收集用户的信息，如活动报名、调查反馈、预约填单等', '1', 'null', '凡星', '0.1', '1448265695', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('168', 'DeveloperTool', '开发者工具箱', '开发者可以用来调试，监控运营系统的参数', '1', 'null', '凡星', '0.1', '1448265698', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('190', 'YouaskService', '你问我答客服系统', '一个支持你问我答,关键词制定客服的客服系统', '1', '{\"state\":\"0\",\"zrg\":\"\\u4eba\\u5de5\\u5ba2\\u670d\",\"model\":\"1\",\"tcrg\":\"\\u9000\\u51fa\\u4eba\\u5de5\\u5ba2\\u670d\"}', '陌路生人', '0.1', '1448265818', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('191', 'RealPrize', '实物奖励', '实物奖励设置', '1', 'null', 'aManx', '0.1', '1448265822', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('192', 'Xydzp', '幸运大转盘', '网络上最热门的抽奖活动 支持作弊等各种详细配置', '1', '{\"need_trueljinfo\":\"1\"}', '南方卫视', '0.1', '1448265825', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('193', 'Reserve', '微预约', '微预约是商家利用微营销平台实现在线预约的一种服务，可以运用于汽车、房产、酒店、医疗、餐饮等一系列行业，给用户的出行办事、购物、消费带来了极大的便利！且操作简单， 响应速度非常快，受到业界的一致好评！', '1', 'null', '凡星', '0.1', '1448265828', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('188', 'Scratch', '刮刮卡', '刮刮卡', '1', 'null', '凡星', '0.1', '1448265811', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('169', 'Coupon', '优惠券', '配合粉丝圈子，打造粉丝互动的运营激励基础', '1', 'null', '凡星', '0.1', '1448265702', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('170', 'Guess', '竞猜', '节目竞猜 有奖竞猜 竞猜项目配置', '1', 'null', '无名', '0.1', '1448265704', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('171', 'Comment', '评论互动', '可放到手机界面里进行评论，显示支持弹屏方式', '1', '{\"min_time\":\"30\",\"limit\":\"15\"}', '凡星', '0.1', '1448265708', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('172', 'Game', '互动游戏', '这是一个临时描述', '1', 'null', '凡星', '0.1', '1448265711', '0', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('173', 'ConfigureAccount', '帐号配置', '配置共众帐号的信息', '0', '{\"title\":\"WeiPHP\\u6447\\u7535\\u89c6\",\"id\":\"gh_dd85ac50d2dd\",\"account\":\"weiphp-tv\",\"type\":\"3\",\"logo\":\"\",\"articleurl\":\"\"}', 'manx', '0.1', '1448265714', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('176', 'Ask', '抢答', '用于电视互动答题', '1', '{\"random\":\"1\"}', '凡星', '0.1', '1448265769', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('199', 'TestCms', '测试CMS', '这是一个临时描述', '1', '{\"random\":\"1\"}', '无名', '0.1', '1449992932', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('178', 'HelloWorld', '微信入门案例', '这是一个简单的入门案例', '1', 'null', '凡星', '0.1', '1448265779', '0', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('182', 'Vote', '投票', '支持文本和图片两类的投票功能', '1', '{\"random\":\"1\"}', '凡星', '0.1', '1448265793', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('183', 'Sms', '短信服务', '短信服务，短信验证，短信发送', '1', '{\"random\":\"1\"}', 'jacy', '0.1', '1448265796', '0', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('184', 'Survey', '微调研', '实现通用的调研功能，支持单选、多选和简答三种题目的录入', '1', 'null', '凡星', '0.1', '1448265799', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('198', 'Paiqian', '派遣功能', '派遣项目的主要功能实现', '1', '{\"random\":\"1\"}', '凡星', '0.1', '1449111637', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('187', 'WishCard', '微贺卡', 'Diy贺卡 自定贺卡内容 发给好友 后台编辑', '1', 'null', '凡星', '0.1', '1448265808', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('186', 'Wecome', '欢迎语', '用户关注公众号时发送的欢迎信息，支持文本，图片，图文的信息', '1', '{\"type\":\"1\",\"keyword\":\"\",\"title\":\"\",\"description\":\"\",\"pic_url\":\"\",\"url\":\"\",\"appmsg_id\":\"\"}', '凡星', '0.1', '1448265805', '0', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('179', 'Invite', '微邀约', '微邀约适合各行各业，可用于会议邀约、活动邀约，同时实现微信报名人数自动统计等功能。', '1', 'null', '无名', '0.1', '1448265783', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('180', 'Tongji', '统计监控', '统计实时参与摇电视的次数', '1', 'null', '凡星', '0.1', '1448265787', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('181', 'Test', '微测试', '主要功能有问卷管理，题目录入管理，用户信息和得分汇总管理。', '1', 'null', '凡星', '0.1', '1448265790', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('175', 'CardVouchers', '微信卡券', '在微信平台创建卡券后，可配置到这里生成素材提供用户领取，它既支持电视台自己公众号发布的卡券，也支持由商家公众号发布的卡券', '1', 'null', '凡星', '0.1', '1448265766', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('159', 'CustomMenu', '自定义菜单', '自定义菜单能够帮助公众号丰富界面，让用户更好更快地理解公众号的功能', '1', 'null', '凡星', '0.1', '1448265257', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('195', 'Payment', '支付通', '微信支付,财富通,支付宝', '1', '{\"isopen\":\"1\",\"isopenwx\":\"1\",\"isopenzfb\":\"0\",\"isopencftwap\":\"0\",\"isopencft\":\"0\",\"isopenyl\":\"0\",\"isopenload\":\"1\"}', '拉帮姐派(陌路生人)', '0.1', '1448265835', '1', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('196', 'Leaflets', '微信宣传页', '微信公众号二维码推广页面，用作推广或者制作广告易拉宝，可以发布到QQ群微博博客论坛等等...', '1', '{\"random\":\"1\"}', '凡星', '0.1', '1448265839', '0', '0', null, '1');
INSERT INTO `wx_addons` VALUES ('197', 'NoAnswer', '没回答的回复', '当用户提供的内容或者关键词系统无关识别回复时，自动把当前配置的内容回复给用户', '1', '{\"random\":\"1\"}', '凡星', '0.1', '1448265842', '0', '0', null, '1');

-- ----------------------------
-- Table structure for `wx_analysis`
-- ----------------------------
DROP TABLE IF EXISTS `wx_analysis`;
CREATE TABLE `wx_analysis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sports_id` int(10) DEFAULT NULL COMMENT 'sports_id',
  `type` varchar(30) DEFAULT NULL COMMENT 'type',
  `time` varchar(50) DEFAULT NULL COMMENT 'time',
  `total_count` int(10) DEFAULT '0' COMMENT 'total_count',
  `follow_count` int(10) DEFAULT '0' COMMENT 'follow_count',
  `aver_count` int(10) DEFAULT '0' COMMENT 'aver_count',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_analysis
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_article_style`
-- ----------------------------
DROP TABLE IF EXISTS `wx_article_style`;
CREATE TABLE `wx_article_style` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `group_id` int(10) DEFAULT '0' COMMENT '分组样式',
  `style` text COMMENT '样式内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_article_style
-- ----------------------------
INSERT INTO `wx_article_style` VALUES ('1', '1', '<section style=\"border: 0px none; padding: 0px; box-sizing: border-box; margin: 0px; font-family: 微软雅黑;\"><section class=\"main\" style=\"border: none rgb(0,187,236); margin: 0.8em 5% 0.3em; box-sizing: border-box; padding: 0px;\"><section class=\"main2 wxqq-color wxqq-bordertopcolor wxqq-borderleftcolor wxqq-borderrightcolor wxqq-borderbottomcolor\" data-brushtype=\"text\" style=\"color: rgb(0,187,236); font-size: 20px; letter-spacing: 3px; padding: 9px 4px 14px; text-align: center; margin: 0px auto; border: 4px solid rgb(0,187,236); border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; box-sizing: border-box;\">理念<span class=\"main3 wxqq-color\" data-brushtype=\"text\" style=\"display: block; font-size: 10px; line-height: 12px; border-color: rgb(0,187,236); color: inherit; box-sizing: border-box; padding: 0px; margin: 0px;\">PHILOSOPHY</span></section><section class=\"main4 wxqq-bordertopcolor wxqq-borderbottomcolor\" style=\"width: 0px; margin-right: auto; margin-left: auto; border-top-width: 0.6em; border-top-style: solid; border-bottom-color: rgb(0,187,236); border-top-color: rgb(0,187,236); height: 10px; color: inherit; border-left-width: 0.7em !important; border-left-style: solid !important; border-left-color: transparent !important; border-right-width: 0.7em !important; border-right-style: solid !important; border-right-color: transparent !important; box-sizing: border-box; padding: 0px;\" data-width=\"0px\"></section></section></section>');
INSERT INTO `wx_article_style` VALUES ('2', '3', '<section label=\"Copyright © 2015 playhudong All Rights Reserved.\" style=\"\r\nmargin:1em auto;\r\npadding: 1em 2em;\r\nborder-style: none;\" id=\"shifu_c_001\"><span style=\"\r\nfloat: left;\r\nmargin-left: 19px;\r\nmargin-top: -9px;\r\noverflow: hidden;\r\ndisplay:block;\"><img style=\"\r\nvertical-align: top;\r\ndisplay:inline-block;\" src=\"http://1251001145.cdn.myqcloud.com/1251001145/style/images/card-3.gif\"><section class=\"color\" style=\"\r\nmin-height: 30px;\r\ncolor: #fff;\r\ndisplay: inline-block;\r\ntext-align: center;\r\nbackground: #999999;\r\nfont-size: 15px;\r\npadding: 7px 5px;\r\nmin-width: 30px;\"><span style=\"font-size:15px;\"> 01 </span></section></span><section style=\"\r\npadding: 16px;\r\npadding-top: 28px;\r\nborder: 2px solid #999999;\r\nwidth: 100%;\r\nfont-size: 14px;\r\nline-height: 1.4;\"><span>星期一天气晴我离开你／不带任何行李／除了一本陪我放逐的日记／今天天晴／心情很低／突然决定离开你</span></section></section>');
INSERT INTO `wx_article_style` VALUES ('3', '1', '<section><section class=\"wxqq-borderleftcolor wxqq-borderRightcolor wxqq-bordertopcolor wxqq-borderbottomcolor\" style=\"border:5px solid #A50003;padding:5px;width:100%;\"><section class=\"wxqq-borderleftcolor wxqq-borderRightcolor wxqq-bordertopcolor wxqq-borderbottomcolor\" style=\"border:1px solid #A50003;padding:15px 20px;\"><p style=\"color:#A50003;text-align:center;border-bottom:1px solid #A50003\"><span class=\"wxqq-color\" data-brushtype=\"text\" style=\"font-size:48px\">情人节快乐</span></p><section data-style=\"color:#A50003;text-align:center;font-size:18px\" style=\"color:#A50003;text-align:center;width:96%;margin-left:5px;\"><p class=\"wxqq-color\" style=\"color:#A50003;text-align:center;font-size:18px\">happy valentine\'s day<span style=\"color:inherit; font-size:24px; line-height:1.6em; text-align:right; text-indent:2em\"></span><span style=\"color:rgb(227, 108, 9); font-size:24px; line-height:1.6em; text-align:right; text-indent:2em\"></span></p><section style=\"width:100%;\"><section><section><p style=\"color:#000;text-align:left;\">我们没有秘密，整天花前月下，别人以为我们不懂爱情，我们乐呵呵地笑大人们都太傻。</p></section></section></section></section></section></section></section>');
INSERT INTO `wx_article_style` VALUES ('4', '4', '<p><img src=\"http://www.wxbj.cn//ys/gz/gx2.gif\"></p>');
INSERT INTO `wx_article_style` VALUES ('5', '5', '<section class=\"tn-Powered-by-XIUMI\" style=\"margin-top: 0.5em; margin-bottom: 0.5em; border: none rgb(142, 201, 101); font-size: 14px; font-family: inherit; font-weight: inherit; text-decoration: inherit; color: rgb(142, 201, 101);\"><img data-src=\"http://mmbiz.qpic.cn/mmbiz/4HiaqFGEibVwaxcmNMU5abRHm7bkZ9icUxC3DrlItWpOnXSjEpZXIeIr2K0923xw43aKw8oibucqm8wkMYZvmibqDkg/0?wx_fmt=png\" class=\"tn-Powered-by-XIUMI\" data-type=\"png\" data-ratio=\"0.8055555555555556\" data-w=\"36\" _width=\"2.6em\" src=\"https://mmbiz.qlogo.cn/mmbiz/4HiaqFGEibVwaxcmNMU5abRHm7bkZ9icUxC3DrlItWpOnXSjEpZXIeIr2K0923xw43aKw8oibucqm8wkMYZvmibqDkg/640?wx_fmt=png\" style=\"float: right; width: 2.6em !important; visibility: visible !important; background-color: rgb(142, 201, 101);\"><section class=\"tn-Powered-by-XIUMI\" style=\"clear: both;\"></section><section class=\"tn-Powered-by-XIUMI\" style=\"padding-right: 10px; padding-left: 10px; text-align: center;\"><section class=\"tn-Powered-by-XIUMI\" style=\"text-align: left;\">炎热的夏季，应该吃点什么好呢！我们为您打造7月盛夏美食狂欢季，清暑解渴的热带水果之王【芒果下午茶】，海鲜盛宴上的【生蚝狂欢】，肉食者的天堂【澳洲之夜】，呼朋唤友，户外聚餐的最佳攻略【夏季BBQ】，消暑瘦身利器【迷你冬瓜盅】，清淡亦或重口味，总有一款是你所爱！</section></section><img data-src=\"http://mmbiz.qpic.cn/mmbiz/4HiaqFGEibVwaxcmNMU5abRHm7bkZ9icUxCkEmrfLmAXYYOXO0q4RGYsQqfzhO6SOdoFCTqYqwlS87ovGrQjCYmWw/0?wx_fmt=png\" class=\"tn-Powered-by-XIUMI\" data-type=\"png\" data-ratio=\"0.8055555555555556\" data-w=\"36\" _width=\"2.6em\" src=\"https://mmbiz.qlogo.cn/mmbiz/4HiaqFGEibVwaxcmNMU5abRHm7bkZ9icUxCkEmrfLmAXYYOXO0q4RGYsQqfzhO6SOdoFCTqYqwlS87ovGrQjCYmWw/640?wx_fmt=png\" style=\"width: 2.6em !important; visibility: visible !important; background-color: rgb(142, 201, 101);\"><p><br></p></section>');
INSERT INTO `wx_article_style` VALUES ('8', '6', '<blockquote class=\"wxqq-borderTopColor wxqq-borderRightColor wxqq-borderBottomColor wxqq-borderLeftColor\" style=\"border: 3px dotted rgb(230, 37, 191); padding: 10px; margin: 10px 0px; font-weight: normal; border-top-left-radius: 5px !important; border-top-right-radius: 5px !important; border-bottom-right-radius: 5px !important; border-bottom-left-radius: 5px !important;\"><h3 style=\"color:rgb(89,89,89);font-size:14px;margin:0;\"><span class=\"wxqq-bg\" style=\"background-color: rgb(230, 37, 191); color: rgb(255, 255, 255); padding: 2px 5px; font-size: 14px; margin-right: 15px; border-top-left-radius: 5px !important; border-top-right-radius: 5px !important; border-bottom-right-radius: 5px !important; border-bottom-left-radius: 5px !important;\">微信编辑器</span>微信号：<span class=\"wxqq-bg\" style=\"background-color: rgb(230, 37, 191); color: rgb(255, 255, 255); padding: 2px 5px; font-size: 14px; border-top-left-radius: 5px !important; border-top-right-radius: 5px !important; border-bottom-right-radius: 5px !important; border-bottom-left-radius: 5px !important;\">wxbj.cn</span></h3><p style=\"margin:10px 0 5px 0;\">微信公众号简介，欢迎使用微信在线图文排版编辑器助手！</p></blockquote>');
INSERT INTO `wx_article_style` VALUES ('9', '8', '<p><img src=\"http://www.wxbj.cn/ys/gz/yw1.gif\"></p>');
INSERT INTO `wx_article_style` VALUES ('7', '7', '<p><img src=\"https://mmbiz.qlogo.cn/mmbiz/cZV2hRpuAPhuxibIOsThcH7HF1lpQ0Yvkvh88U3ia9AbTPJSmriawnJ7W7S5iblSlSianbHLGO6IvD0N4g2y2JEFRoA/0/mmbizgif\"></p>');

-- ----------------------------
-- Table structure for `wx_article_style_group`
-- ----------------------------
DROP TABLE IF EXISTS `wx_article_style_group`;
CREATE TABLE `wx_article_style_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `group_name` varchar(255) DEFAULT NULL COMMENT '分组名称',
  `desc` text COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_article_style_group
-- ----------------------------
INSERT INTO `wx_article_style_group` VALUES ('1', '标题', '标题样式');
INSERT INTO `wx_article_style_group` VALUES ('3', '卡片', '类卡片样式');
INSERT INTO `wx_article_style_group` VALUES ('4', '关注', '引导关注公众号的样式');
INSERT INTO `wx_article_style_group` VALUES ('5', '内容', '内容样式');
INSERT INTO `wx_article_style_group` VALUES ('6', '互推', '互推公众号的样式');
INSERT INTO `wx_article_style_group` VALUES ('7', '分割', '分割样式');
INSERT INTO `wx_article_style_group` VALUES ('8', '原文引导', '原文引导样式');

-- ----------------------------
-- Table structure for `wx_ask`
-- ----------------------------
DROP TABLE IF EXISTS `wx_ask`;
CREATE TABLE `wx_ask` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `keyword_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '关键词类型',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `intro` text COMMENT '封面简介',
  `mTime` int(10) DEFAULT NULL COMMENT '修改时间',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '封面图片',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `finish_tip` text COMMENT '结束语',
  `content` text COMMENT '活动介绍',
  `shop_address` text COMMENT '商家地址',
  `appids` text COMMENT '提示关注的公众号',
  `finish_button` text COMMENT '成功抢答完后显示的按钮',
  `card_id` varchar(255) DEFAULT NULL COMMENT '卡券ID',
  `appsecre` varchar(255) DEFAULT NULL COMMENT '卡券对应的appsecre',
  `template` varchar(255) DEFAULT 'default' COMMENT '素材模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_ask
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_ask_answer`
-- ----------------------------
DROP TABLE IF EXISTS `wx_ask_answer`;
CREATE TABLE `wx_ask_answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `answer` text COMMENT '回答内容',
  `openid` varchar(255) DEFAULT NULL COMMENT 'OpenId',
  `uid` int(10) DEFAULT NULL COMMENT '用户UID',
  `question_id` int(10) unsigned NOT NULL COMMENT 'question_id',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `ask_id` int(10) unsigned NOT NULL COMMENT 'ask_id',
  `is_correct` tinyint(2) DEFAULT '1' COMMENT '是否回答正确',
  `times` int(4) DEFAULT '0' COMMENT '次数',
  PRIMARY KEY (`id`),
  KEY `ask_id_uid` (`ask_id`,`uid`),
  KEY `question_uid` (`uid`,`question_id`,`times`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_ask_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_ask_question`
-- ----------------------------
DROP TABLE IF EXISTS `wx_ask_question`;
CREATE TABLE `wx_ask_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `intro` text COMMENT '问题描述',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `is_must` tinyint(2) DEFAULT '1' COMMENT '是否必填',
  `extra` text NOT NULL COMMENT '参数',
  `type` char(50) NOT NULL DEFAULT 'radio' COMMENT '问题类型',
  `ask_id` int(10) unsigned NOT NULL COMMENT 'ask_id',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序号',
  `answer` varchar(255) NOT NULL COMMENT '正确答案',
  `is_last` tinyint(2) DEFAULT '0' COMMENT '是否最后一题',
  `wait_time` int(10) DEFAULT '0' COMMENT '等待时间',
  `percent` int(10) DEFAULT '100' COMMENT '抢中概率',
  `answer_time` int(10) DEFAULT NULL COMMENT '答题时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_ask_question
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_attachment`
-- ----------------------------
DROP TABLE IF EXISTS `wx_attachment`;
CREATE TABLE `wx_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT '0' COMMENT '用户ID',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '附件显示名',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件类型',
  `source` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源ID',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联记录ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '附件大小',
  `dir` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '上级目录ID',
  `sort` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `idx_record_status` (`record_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表';

-- ----------------------------
-- Records of wx_attachment
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `wx_attribute`;
CREATE TABLE `wx_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '字段注释',
  `field` varchar(100) NOT NULL DEFAULT '' COMMENT '字段定义',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '数据类型',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字段默认值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `extra` text NOT NULL COMMENT '参数',
  `model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `validate_rule` varchar(255) NOT NULL DEFAULT '',
  `validate_time` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `error_info` varchar(100) NOT NULL DEFAULT '',
  `validate_type` varchar(25) NOT NULL DEFAULT '',
  `auto_rule` varchar(100) NOT NULL DEFAULT '',
  `auto_time` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `auto_type` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12176 DEFAULT CHARSET=utf8 COMMENT='模型属性表';

-- ----------------------------
-- Records of wx_attribute
-- ----------------------------
INSERT INTO `wx_attribute` VALUES ('5', 'nickname', '用户名', 'text NULL', 'string', '', '', '0', '', '1', '1', '1', '1447302832', '1436929161', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('6', 'password', '登录密码', 'varchar(100) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302859', '1436929210', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('7', 'truename', '真实姓名', 'varchar(30) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302886', '1436929252', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('8', 'mobile', '联系电话', 'varchar(30) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302825', '1436929280', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('9', 'email', '邮箱地址', 'varchar(100) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302817', '1436929305', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('10', 'sex', '性别', 'tinyint(2) NULL', 'radio', '', '', '0', '0:保密\r\n1:男\r\n2:女', '1', '0', '1', '1447302800', '1436929397', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11', 'headimgurl', '头像地址', 'varchar(255) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302811', '1436929482', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12', 'city', '城市', 'varchar(30) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302793', '1436929506', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('13', 'province', '省份', 'varchar(30) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302787', '1436929524', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('14', 'country', '国家', 'varchar(30) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302781', '1436929541', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('15', 'language', '语言', 'varchar(20) NULL', 'string', 'zh-cn', '', '0', '', '1', '0', '1', '1447302725', '1436929571', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('16', 'score', '金币值', 'int(10) NULL', 'num', '0', '', '0', '', '1', '0', '1', '1447302731', '1436929597', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('17', 'experience', '经验值', 'int(10) NULL', 'num', '0', '', '0', '', '1', '0', '1', '1447302738', '1436929619', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('18', 'unionid', '微信第三方ID', 'varchar(50) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302717', '1436929681', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('19', 'login_count', '登录次数', 'int(10) NULL', 'num', '0', '', '0', '', '1', '0', '1', '1447302710', '1436930011', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('20', 'reg_ip', '注册IP', 'varchar(30) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302746', '1436930035', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('21', 'reg_time', '注册时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1', '0', '1', '1447302754', '1436930051', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('22', 'last_login_ip', '最近登录IP', 'varchar(30) NULL', 'string', '', '', '0', '', '1', '0', '1', '1447302761', '1436930072', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('23', 'last_login_time', '最近登录时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1', '0', '1', '1447302770', '1436930087', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('24', 'status', '状态', 'tinyint(2) NULL', 'bool', '1', '', '0', '0:禁用\r\n1:启用', '1', '0', '1', '1447302703', '1436930138', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('25', 'is_init', '初始化状态', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:未初始化\r\n1:已初始化', '1', '0', '1', '1447302696', '1436930184', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('26', 'is_audit', '审核状态', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:未审核\r\n1:已审核', '1', '0', '1', '1447302688', '1436930216', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('27', 'subscribe_time', '用户关注公众号时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1', '0', '1', '1437720655', '1437720655', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('28', 'remark', '微信用户备注', 'varchar(100) NULL', 'string', '', '', '0', '', '1', '0', '1', '1437720686', '1437720686', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('29', 'groupid', '微信端的分组ID', 'int(10) NULL', 'num', '', '', '0', '', '1', '0', '1', '1437720714', '1437720714', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('4', 'come_from', '来源', 'tinyint(1) NULL', 'select', '0', '', '0', '0:PC注册用户\r\n1:微信同步用户\r\n2:手机注册用户', '1', '0', '1', '1447302852', '1438331357', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('31', 'uid', '用户ID', 'int(10) NULL', 'num', '', '', '1', '', '2', '1', '1', '1436932588', '1436932588', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('32', 'has_public', '是否配置公众号', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:否\r\n1:是', '2', '0', '1', '1436933464', '1436933464', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('33', 'headface_url', '管理员头像', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '2', '0', '1', '1436933503', '1436933503', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('34', 'GammaAppId', '摇电视的AppId', 'varchar(30) NULL', 'string', '', '', '1', '', '2', '0', '1', '1436933562', '1436933562', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('35', 'GammaSecret', '摇电视的Secret', 'varchar(100) NULL', 'string', '', '', '1', '', '2', '0', '1', '1436933602', '1436933602', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('36', 'copy_right', '授权信息', 'varchar(255) NULL', 'string', '', '', '1', '', '2', '0', '1', '1436933690', '1436933690', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('37', 'tongji_code', '统计代码', 'text NULL', 'textarea', '', '', '1', '', '2', '0', '1', '1436933778', '1436933778', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('38', 'website_logo', '网站LOGO', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '2', '0', '1', '1436934006', '1436934006', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('39', 'menu_type', '菜单类型', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:顶级菜单|pid@hide\r\n1:侧栏菜单|pid@show', '3', '0', '1', '1435218508', '1435216049', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('40', 'pid', '上级菜单', 'varchar(50) NULL', 'cascade', '0', '', '1', 'type=db&table=manager_menu&menu_type=0&uid=[manager_id]', '3', '0', '1', '1438858450', '1435216147', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('41', 'title', '菜单名', 'varchar(50) NULL', 'string', '', '', '1', '', '3', '1', '1', '1435216185', '1435216185', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('42', 'url_type', '链接类型', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:插件|addon_name@show,url@hide\r\n1:外链|addon_name@hide,url@show', '3', '0', '1', '1435218596', '1435216291', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('43', 'addon_name', '插件名', 'varchar(30) NULL', 'dynamic_select', '', '', '1', 'table=addons&type=0&value_field=name&title_field=title&order=id asc', '3', '0', '1', '1439433250', '1435216373', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('44', 'url', '外链', 'varchar(255) NULL', 'string', '', '', '1', '', '3', '0', '1', '1435216436', '1435216436', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('45', 'target', '打开方式', 'char(50) NULL', 'select', '_self', '', '1', '_self:当前窗口打开\r\n_blank:在新窗口打开', '3', '0', '1', '1435216626', '1435216626', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('46', 'is_hide', '是否隐藏', 'tinyint(2) NULL', 'radio', '0', '', '1', '0:否\r\n1:是', '3', '0', '1', '1435216697', '1435216697', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('47', 'sort', '排序号', 'int(10) NULL', 'num', '0', '值越小越靠前', '1', '', '3', '0', '1', '1435217270', '1435217270', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('48', 'uid', '管理员ID', 'int(10) NULL', 'num', '', '', '4', '', '3', '0', '1', '1435224916', '1435223957', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('49', 'keyword', '关键词', 'varchar(100) NOT NULL ', 'string', '', '', '1', '', '4', '1', '1', '1388815953', '1388815953', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('50', 'addon', '关键词所属插件', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '4', '1', '1', '1388816207', '1388816207', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('51', 'aim_id', '插件表里的ID值', 'int(10) unsigned NOT NULL ', 'num', '', '', '1', '', '4', '1', '1', '1388816287', '1388816287', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('52', 'cTime', '创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '4', '0', '1', '1407251221', '1388816392', '', '1', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('53', 'token', 'Token', 'varchar(100) NULL ', 'string', '', '', '0', '', '4', '0', '1', '1408945788', '1391399528', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('54', 'keyword_length', '关键词长度', 'int(10) unsigned NULL ', 'num', '0', '', '1', '', '4', '0', '1', '1407251147', '1393918566', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('55', 'keyword_type', '匹配类型', 'tinyint(2) NULL ', 'select', '0', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配\r\n4:正则匹配\r\n5:随机匹配', '4', '0', '1', '1417745067', '1393919686', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('56', 'extra_text', '文本扩展', 'text NULL ', 'textarea', '', '', '0', '', '4', '0', '1', '1407251248', '1393919736', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('57', 'extra_int', '数字扩展', 'int(10) NULL ', 'num', '', '', '0', '', '4', '0', '1', '1407251240', '1393919798', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('58', 'request_count', '请求数', 'int(10) NULL', 'num', '0', '用户回复的次数', '0', '', '4', '0', '1', '1401938983', '1401938983', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('59', 'qr_code', '二维码', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '5', '1', '1', '1406127577', '1388815953', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('60', 'addon', '二维码所属插件', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '5', '1', '1', '1406127594', '1388816207', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('61', 'aim_id', '插件表里的ID值', 'int(10) unsigned NOT NULL ', 'num', '', '', '1', '', '5', '1', '1', '1388816287', '1388816287', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('62', 'cTime', '创建时间', 'int(10) NULL', 'datetime', '', '', '1', '', '5', '0', '1', '1388816392', '1388816392', '', '1', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('63', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '5', '0', '1', '1391399528', '1391399528', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('64', 'action_name', '二维码类型', 'char(30) NULL', 'select', 'QR_SCENE', 'QR_SCENE为临时,QR_LIMIT_SCENE为永久 ', '1', 'QR_SCENE:临时二维码\r\nQR_LIMIT_SCENE:永久二维码', '5', '0', '1', '1406130162', '1393919686', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('65', 'extra_text', '文本扩展', 'text NULL ', 'textarea', '', '', '1', '', '5', '0', '1', '1393919736', '1393919736', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('66', 'extra_int', '数字扩展', 'int(10) NULL ', 'num', '', '', '1', '', '5', '0', '1', '1393919798', '1393919798', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('67', 'request_count', '请求数', 'int(10) NULL', 'num', '0', '用户回复的次数', '0', '', '5', '0', '1', '1402547625', '1401938983', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('68', 'scene_id', '场景ID', 'int(10) NULL', 'num', '0', '', '1', '', '5', '0', '1', '1406127542', '1406127542', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('69', 'is_use', '是否为当前公众号', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:否\r\n1:是', '6', '0', '1', '1391682184', '1391682184', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('70', 'token', 'Token', 'varchar(100) NULL', 'string', '', '', '0', '', '6', '0', '1', '1402453598', '1391597344', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('71', 'uid', '用户ID', 'int(10) NULL ', 'num', '', '', '0', '', '6', '1', '1', '1391575873', '1391575210', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('72', 'public_name', '公众号名称', 'varchar(50) NOT NULL', 'string', '', '', '1', '', '6', '1', '1', '1391576452', '1391575955', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('73', 'public_id', '公众号原始id', 'varchar(100) NOT NULL', 'string', '', '请正确填写，保存后不能再修改，且无法接收到微信的信息', '1', '', '6', '1', '1', '1402453976', '1391576015', '', '1', '公众号原始ID已经存在，请不要重复增加', 'unique', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('74', 'wechat', '微信号', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '6', '1', '1', '1391576484', '1391576144', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('75', 'interface_url', '接口地址', 'varchar(255) NULL', 'string', '', '', '0', '', '6', '0', '1', '1392946881', '1391576234', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('76', 'headface_url', '公众号头像', 'varchar(255) NULL', 'picture', '', '', '1', '', '6', '0', '1', '1429847363', '1391576300', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('77', 'area', '地区', 'varchar(50) NULL', 'string', '', '', '0', '', '6', '0', '1', '1392946934', '1391576435', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('78', 'addon_config', '插件配置', 'text NULL', 'textarea', '', '', '0', '', '6', '0', '1', '1391576537', '1391576537', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('79', 'addon_status', '插件状态', 'text NULL', 'textarea', '', '', '0', '160:自定义回复\r\n161:自动回复\r\n162:微官网\r\n163:微信用户中心\r\n164:微考试\r\n165:比赛抽奖\r\n166:融合第三方\r\n167:通用表单\r\n168:开发者工具箱\r\n190:你问我答客服系统\r\n191:实物奖励\r\n192:幸运大转盘\r\n193:微预约\r\n188:刮刮卡\r\n169:优惠券\r\n170:竞猜\r\n171:评论互动\r\n172:互动游戏\r\n176:抢答\r\n199:测试CMS\r\n178:微信入门案例\r\n182:投票\r\n183:短信服务\r\n184:微调研\r\n198:派遣功能\r\n187:微贺卡\r\n186:欢迎语\r\n179:微邀约\r\n180:统计监控\r\n181:微测试\r\n175:微信卡券\r\n159:自定义菜单\r\n195:支付通\r\n196:微信宣传页\r\n197:没回答的回复\r\n', '6', '0', '1', '1391576571', '1391576571', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11269', 'keyword', '关键词', 'varchar(255) NULL', 'string', '', '', '1', '', '1143', '0', '1', '1396602514', '1396602514', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11270', 'keyword_type', '关键词类型', 'tinyint(2) NULL', 'select', '0', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配\r\n4:正则匹配\r\n5:随机匹配', '1143', '0', '1', '1396602706', '1396602548', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11271', 'mult_ids', '多图文ID', 'varchar(255) NULL', 'string', '', '', '0', '', '1143', '0', '1', '1396602601', '1396602578', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11272', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1143', '0', '1', '1396602821', '1396602821', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11273', 'keyword', '关键词', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1144', '1', '1', '1396061575', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('80', 'type', '公众号类型', 'char(10) NULL', 'radio', '0', '', '1', '0:普通订阅号\r\n1:认证订阅号/普通服务号\r\n2:认证服务号', '6', '0', '1', '1416904702', '1393718575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('81', 'appid', 'AppID', 'varchar(255) NULL', 'string', '', '应用ID', '1', '', '6', '0', '1', '1416904750', '1393718735', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('82', 'secret', 'AppSecret', 'varchar(255) NULL', 'string', '', '应用密钥', '1', '', '6', '0', '1', '1416904771', '1393718806', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('83', 'group_id', '等级', 'int(10) unsigned NULL ', 'select', '0', '', '0', '', '6', '0', '1', '1393753499', '1393724468', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('84', 'is_audit', '是否审核', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:否\r\n1:是', '6', '1', '1', '1430879018', '1430879007', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('85', 'is_init', '是否初始化', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:否\r\n1:是', '6', '1', '1', '1430888244', '1430878899', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('86', 'encodingaeskey', 'EncodingAESKey', 'varchar(255) NULL', 'string', '', '安全模式下必填', '1', '', '6', '0', '1', '1419775850', '1419775850', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('87', 'tips_url', '提示关注公众号的文章地址', 'varchar(255) NULL', 'string', '', '', '1', '', '6', '0', '1', '1420789769', '1420789769', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('88', 'GammaAppId', 'GammaAppId', 'varchar(255) NULL', 'string', '', '', '1', '', '6', '0', '1', '1424529968', '1424529968', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('89', 'GammaSecret', 'GammaSecret', 'varchar(255) NULL', 'string', '', '', '1', '', '6', '0', '1', '1424529990', '1424529990', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('90', 'public_copy_right', '版权信息', 'varchar(255) NULL', 'string', '', '', '1', '', '6', '0', '1', '1431141576', '1431141576', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('91', 'domain', '自定义域名', 'varchar(30) NULL', 'string', '', '', '0', '', '6', '0', '1', '1439698931', '1439698931', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('92', 'title', '等级名', 'varchar(50) NULL', 'string', '', '', '1', '', '7', '0', '1', '1393724854', '1393724854', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('93', 'addon_status', '插件权限', 'text NULL', 'checkbox', '', '', '1', '160:自定义回复\r\n161:自动回复\r\n162:微官网\r\n163:微信用户中心\r\n164:微考试\r\n165:比赛抽奖\r\n166:融合第三方\r\n167:通用表单\r\n168:开发者工具箱\r\n190:你问我答客服系统\r\n191:实物奖励\r\n192:幸运大转盘\r\n193:微预约\r\n188:刮刮卡\r\n169:优惠券\r\n170:竞猜\r\n171:评论互动\r\n172:互动游戏\r\n176:抢答\r\n199:测试CMS\r\n178:微信入门案例\r\n182:投票\r\n183:短信服务\r\n184:微调研\r\n198:派遣功能\r\n187:微贺卡\r\n186:欢迎语\r\n179:微邀约\r\n180:统计监控\r\n181:微测试\r\n175:微信卡券\r\n159:自定义菜单\r\n195:支付通\r\n196:微信宣传页\r\n197:没回答的回复\r\n', '7', '0', '1', '1393731903', '1393725072', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11314', 'pid', '一级目录', 'int(10) NULL', 'cascade', '0', '', '1', 'type=db&table=weisite_category&pid=id', '1148', '0', '1', '1439522271', '1439469294', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11315', 'keyword', '关键词', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1149', '1', '1', '1396061575', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11316', 'keyword_type', '关键词类型', 'tinyint(2) NULL', 'select', '', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配\r\n4:正则匹配\r\n5:随机匹配', '1149', '0', '1', '1396061814', '1396061765', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('94', 'uid', '管理员UID', 'int(10) NULL ', 'admin', '', '', '1', '', '8', '1', '1', '1447215599', '1398933236', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('95', 'mp_id', '公众号ID', 'int(10) unsigned NOT NULL ', 'num', '', '', '4', '', '8', '1', '1', '1398933300', '1398933300', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('96', 'is_creator', '是否为创建者', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:不是\r\n1:是', '8', '0', '1', '1398933380', '1398933380', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('97', 'addon_status', '插件权限', 'text NULL', 'checkbox', '', '', '1', '160:自定义回复\r\n161:自动回复\r\n162:微官网\r\n163:微信用户中心\r\n164:微考试\r\n165:比赛抽奖\r\n166:融合第三方\r\n167:通用表单\r\n168:开发者工具箱\r\n190:你问我答客服系统\r\n191:实物奖励\r\n192:幸运大转盘\r\n193:微预约\r\n188:刮刮卡\r\n169:优惠券\r\n170:竞猜\r\n171:评论互动\r\n172:互动游戏\r\n176:抢答\r\n199:测试CMS\r\n178:微信入门案例\r\n182:投票\r\n183:短信服务\r\n184:微调研\r\n198:派遣功能\r\n187:微贺卡\r\n186:欢迎语\r\n179:微邀约\r\n180:统计监控\r\n181:微测试\r\n175:微信卡券\r\n159:自定义菜单\r\n195:支付通\r\n196:微信宣传页\r\n197:没回答的回复\r\n', '8', '0', '1', '1398933475', '1398933475', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11309', 'icon', '分类图片', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '1148', '0', '1', '1395988966', '1395988966', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11310', 'url', '外链', 'varchar(255) NULL', 'string', '', '为空时默认跳转到该分类的文章列表页面', '1', '', '1148', '0', '1', '1401408363', '1395989660', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11311', 'is_show', '显示', 'tinyint(2) NULL', 'bool', '1', '', '1', '0: 不显示\r\n1: 显示', '1148', '0', '1', '1395989709', '1395989709', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11312', 'token', 'Token', 'varchar(100) NULL ', 'string', '', '', '0', '', '1148', '0', '1', '1395989760', '1395989760', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('98', 'is_use', '是否为当前管理的公众号', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:不是\r\n1:是', '8', '0', '1', '1398996982', '1398996975', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('99', 'attach', '上传文件', 'int(10) unsigned NOT NULL ', 'file', '', '支持xls,xlsx两种格式', '1', '', '9', '1', '1', '1407554177', '1407554177', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('100', 'icon', '分类图标', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '10', '0', '1', '1400047745', '1400047745', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('101', 'title', '分类名', 'varchar(255) NULL', 'string', '', '', '1', '', '10', '0', '1', '1400047764', '1400047764', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('102', 'sort', '排序号', 'int(10) NULL', 'num', '0', '值越小越靠前', '1', '', '10', '0', '1', '1400050453', '1400047786', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12064', 'uid', '用户uid', 'int(10) NULL', 'num', '', '', '0', '', '1230', '0', '1', '1445255505', '1445255505', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12065', 'aim_id', 'aim_id', 'int(10) NULL', 'num', '', '', '0', '', '1230', '0', '1', '1445253482', '1445253482', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12063', 'status', '支付状态', 'tinyint(2) NOT NULL', 'bool', '0', '', '1', '0:未支付\r\n1:已支付\r\n2:支付失败', '1230', '0', '1', '1420597026', '1420597026', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12062', 'showwxpaytitle', '是否显示标题', 'tinyint(2) NOT NULL', 'bool', '0', '', '1', '0:不显示\r\n1:显示', '1230', '0', '1', '1420596980', '1420596980', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12061', 'paytype', '支付方式', 'varchar(30) NOT NULL', 'string', '', '', '1', '', '1230', '0', '1', '1420596929', '1420596929', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12060', 'wecha_id', 'OpenID', 'varchar(200) NOT NULL', 'string', '', '', '1', '', '1230', '0', '1', '1420596530', '1420596530', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12059', 'token', 'Token', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1230', '0', '1', '1420596492', '1420596492', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('110', 'name', '分类标识', 'varchar(255) NULL', 'string', '', '只能使用英文', '0', '', '12', '0', '1', '1403711345', '1397529355', '', '3', '只能输入由数字、26个英文字母或者下划线组成的标识名', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('111', 'title', '分类标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '12', '1', '1', '1397529407', '1397529407', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('112', 'icon', '分类图标', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '12', '0', '1', '1397529461', '1397529461', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('113', 'pid', '上一级分类', 'int(10) unsigned NULL ', 'select', '0', '如果你要增加一级分类，这里选择“无”即可', '1', '0:无', '12', '0', '1', '1398266132', '1397529555', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('114', 'path', '分类路径', 'varchar(255) NULL', 'string', '', '', '0', '', '12', '0', '1', '1397529604', '1397529604', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('115', 'module', '分类所属功能', 'varchar(255) NULL', 'string', '', '', '0', '', '12', '0', '1', '1397529671', '1397529671', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('116', 'sort', '排序号', 'int(10) unsigned NULL ', 'num', '0', '数值越小越靠前', '1', '', '12', '0', '1', '1397529705', '1397529705', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('117', 'is_show', '是否显示', 'tinyint(2) NULL', 'bool', '1', '', '1', '0:不显示\r\n1:显示', '12', '0', '1', '1397532496', '1397529809', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('118', 'intro', '分类描述', 'varchar(255) NULL', 'string', '', '', '1', '', '12', '0', '1', '1398414247', '1398414247', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('119', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '12', '0', '1', '1398593086', '1398523502', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('120', 'code', '分类扩展编号', 'varchar(255) NULL', 'string', '', '原分类或者导入分类的扩展编号', '0', '', '12', '0', '1', '1404182741', '1404182630', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('121', 'cTime', '发布时间', 'int(10) UNSIGNED NULL', 'datetime', '', '', '0', '', '13', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('122', 'name', '分组标识', 'varchar(100) NOT NULL', 'string', '', '英文字母或者下划线，长度不超过30', '1', '', '13', '1', '1', '1403624543', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('123', 'title', '分组标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '13', '1', '1', '1403624556', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('124', 'level', '最多级数', 'tinyint(1) unsigned NULL', 'select', '3', '', '1', '1:1级\r\n2:2级\r\n3:3级\r\n4:4级\r\n5:5级\r\n6:6级\r\n7:7级', '13', '0', '1', '1404193097', '1404192897', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('125', 'token', 'Token', 'varchar(100) NULL', 'string', '', '', '0', '', '13', '1', '1', '1408947244', '1396602859', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('126', 'title', '积分描述', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '14', '1', '1', '1438589622', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('127', 'name', '积分标识', 'varchar(50) NULL', 'string', '', '', '1', '', '14', '0', '1', '1438589601', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('128', 'mTime', '修改时间', 'int(10) NULL', 'datetime', '', '', '0', '', '14', '0', '1', '1396624664', '1396624664', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('129', 'experience', '经验值', 'int(10) NULL', 'num', '0', '可以是正数，也可以是负数，如 -10 表示减10个经验值', '1', '', '14', '0', '1', '1398564024', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('130', 'score', '金币值', 'int(10) NULL', 'num', '0', '可以是正数，也可以是负数，如 -10 表示减10个金币值', '1', '', '14', '0', '1', '1398564097', '1396062146', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('131', 'token', 'Token', 'varchar(255) NULL', 'string', '0', '', '0', '', '14', '0', '1', '1398564146', '1396602859', '', '3', '', 'regex', '', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('132', 'credit_name', '积分标识', 'varchar(50) NULL', 'string', '', '', '1', '', '15', '0', '1', '1398564405', '1398564405', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('133', 'uid', '用户ID', 'int(10) NULL', 'num', '0', '', '1', '', '15', '0', '1', '1398564351', '1398564351', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('134', 'experience', '经验值', 'int(10) NULL', 'num', '0', '', '1', '', '15', '0', '1', '1398564448', '1398564448', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('135', 'score', '金币值', 'int(10) NULL', 'num', '0', '', '1', '', '15', '0', '1', '1398564486', '1398564486', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('136', 'cTime', '记录时间', 'int(10) NULL', 'datetime', '', '', '0', '', '15', '0', '1', '1398564567', '1398564567', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('137', 'admin_uid', '操作者UID', 'int(10) NULL', 'num', '0', '', '0', '', '15', '0', '1', '1398564629', '1398564629', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('138', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '15', '0', '1', '1400603451', '1400603451', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('139', 'cover_id', '图片在本地的ID', 'int(10) NULL', 'num', '', '', '0', '', '16', '0', '1', '1438684652', '1438684652', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('140', 'cover_url', '本地URL', 'varchar(255) NULL', 'string', '', '', '0', '', '16', '0', '1', '1438684692', '1438684692', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('141', 'media_id', '微信端图文消息素材的media_id', 'varchar(100) NULL', 'string', '0', '', '0', '', '16', '0', '1', '1438744962', '1438684776', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('142', 'wechat_url', '微信端的图片地址', 'varchar(255) NULL', 'string', '', '', '0', '', '16', '0', '1', '1439973558', '1438684807', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('143', 'cTime', '创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '16', '0', '1', '1438684829', '1438684829', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('144', 'manager_id', '管理员ID', 'int(10) NULL', 'num', '', '', '0', '', '16', '0', '1', '1438684847', '1438684847', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('145', 'token', 'Token', 'varchar(100) NULL', 'string', '', '', '0', '', '16', '0', '1', '1438684865', '1438684865', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('146', 'title', '标题', 'varchar(100) NULL', 'string', '', '', '1', '', '17', '1', '1', '1438670933', '1438670933', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('147', 'author', '作者', 'varchar(30) NULL', 'string', '', '', '1', '', '17', '0', '1', '1438670961', '1438670961', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('148', 'cover_id', '封面', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '17', '0', '1', '1438674438', '1438670980', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('149', 'intro', '摘要', 'varchar(255) NULL', 'textarea', '', '', '1', '', '17', '0', '1', '1438671024', '1438671024', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('150', 'content', '内容', 'longtext  NULL', 'editor', '', '', '1', '', '17', '0', '1', '1440473839', '1438671049', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('151', 'link', '外链', 'varchar(255) NULL', 'string', '', '', '1', '', '17', '0', '1', '1438671066', '1438671066', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('152', 'group_id', '多图文组的ID', 'int(10) NULL', 'num', '0', '0 表示单图文，多于0 表示多图文中的第一个图文的ID值', '0', '', '17', '0', '1', '1438671163', '1438671163', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('153', 'thumb_media_id', '图文消息的封面图片素材id（必须是永久mediaID）', 'varchar(100) NULL', 'string', '', '', '0', '', '17', '0', '1', '1438671302', '1438671285', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('154', 'media_id', '微信端图文消息素材的media_id', 'varchar(100) NULL', 'string', '0', '', '1', '', '17', '0', '1', '1438744941', '1438671373', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('155', 'manager_id', '管理员ID', 'int(10) NULL', 'num', '', '', '0', '', '17', '0', '1', '1438683172', '1438683172', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('156', 'token', 'Token', 'varchar(100) NULL', 'string', '', '', '0', '', '17', '0', '1', '1438683194', '1438683194', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('157', 'cTime', '发布时间', 'int(10) NULL', 'datetime', '', '', '0', '', '17', '0', '1', '1438683499', '1438683499', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('158', 'bind_keyword', '关联关键词', 'varchar(50) NULL', 'string', '', '先在自定义回复里增加图文，多图文或者文本内容，再把它的关键词填写到这里', '1', '', '18', '0', '1', '1437984209', '1437984184', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('159', 'preview_openids', '预览人OPENID', 'text NULL', 'textarea', '', '选填，多个可用逗号或者换行分开，OpenID值可在微信用户的列表中找到', '1', '', '18', '0', '1', '1438049470', '1437985038', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('160', 'group_id', '群发对象', 'int(10) NULL', 'dynamic_select', '0', '全部用户或者某分组用户', '1', 'table=auth_group&manager_id=[manager_id]&token=[token]&value_field=id&title_field=title&first_option=全部用户', '18', '0', '1', '1438049058', '1437985498', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('161', 'type', '素材来源', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:站内关键词|bind_keyword@show,media_id@hide\r\n1:微信永久素材ID|bind_keyword@hide,media_id@show', '18', '0', '1', '1437988869', '1437988869', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('162', 'media_id', '微信素材ID', 'varchar(100) NULL', 'string', '', '微信后台的素材管理里永久素材的media_id值', '1', '', '18', '0', '1', '1437988973', '1437988973', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('163', 'send_type', '发送方式', 'tinyint(1) NULL', 'bool', '0', '', '1', '0:按用户组发送|group_id@show,send_openids@hide\r\n1:指定OpenID发送|group_id@hide,send_openids@show', '18', '0', '1', '1438049241', '1438049241', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('164', 'send_openids', '要发送的OpenID', 'text NULL', 'textarea', '', '多个可用逗号或者换行分开，OpenID值可在微信用户的列表中找到', '1', '', '18', '0', '1', '1438049362', '1438049362', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('165', 'msg_id', 'msg_id', 'varchar(255) NULL', 'string', '', '', '0', '', '18', '0', '1', '1439980539', '1438054616', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('166', 'publicid', '公众号ID', 'int(10) NULL', 'num', '0', '', '0', '', '19', '0', '1', '1439448400', '1439448400', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('167', 'module_name', '类型名', 'varchar(30) NULL', 'string', '', '', '0', '', '19', '0', '1', '1439448516', '1439448516', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('168', 'controller_name', '控制器名', 'varchar(30) NULL', 'string', '', '', '0', '', '19', '0', '1', '1439448567', '1439448567', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('169', 'action_name', '方法名', 'varchar(30) NULL', 'string', '', '', '0', '', '19', '0', '1', '1439448616', '1439448616', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('170', 'uid', '访问者ID', 'varchar(255) NULL', 'string', '0', '', '0', '', '19', '0', '1', '1439448654', '1439448654', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('171', 'ip', 'ip地址', 'varchar(30) NULL', 'string', '', '', '0', '', '19', '0', '1', '1439448742', '1439448742', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('172', 'brower', '浏览器', 'varchar(30) NULL', 'string', '', '', '0', '', '19', '0', '1', '1439448792', '1439448792', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('173', 'param', '其它GET参数', 'text NULL', 'textarea', '', '', '0', '', '19', '0', '1', '1439448834', '1439448834', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('174', 'referer', '访问的URL', 'varchar(255) NULL', 'string', '', '', '0', '', '19', '0', '1', '1439448886', '1439448874', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('175', 'cTime', '时间', 'int(10) NULL', 'datetime', '', '', '0', '', '19', '0', '1', '1439450668', '1439450668', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('176', 'wechat_group_name', '微信端的分组名', 'varchar(100) NULL', 'string', '', '', '0', '', '20', '0', '1', '1437635205', '1437635205', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('177', 'wechat_group_id', '微信端的分组ID', 'int(10) NULL', 'num', '-1', '', '0', '', '20', '0', '1', '1447659224', '1437635149', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('178', 'qr_code', '微信二维码', 'varchar(255) NULL', 'string', '', '', '0', '', '20', '0', '1', '1437635117', '1437635117', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('179', 'is_default', '是否默认自动加入', 'tinyint(1) NULL', 'radio', '0', '只有设置一个默认组，设置当前为默认组后之前的默认组将取消', '0', '0:否\r\n1:是', '20', '0', '1', '1437642358', '1437635042', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('180', 'token', 'Token', 'varchar(100) NULL', 'string', '', '', '0', '', '20', '0', '1', '1437634089', '1437634089', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('181', 'manager_id', '管理员ID', 'int(10) NULL', 'num', '0', '为0时表示系统用户组', '0', '', '20', '0', '1', '1437634309', '1437634062', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('182', 'rules', '权限', 'text NULL', 'textarea', '', '', '0', '', '20', '0', '1', '1437634022', '1437634022', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('183', 'type', '类型', 'tinyint(2) NULL', 'bool', '1', '', '0', '0:普通用户组\r\n1:微信用户组\r\n2:等级用户组\r\n3:认证用户组', '20', '0', '1', '1437633981', '1437633981', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('184', 'status', '状态', 'tinyint(2) NULL', 'bool', '1', '', '0', '1:正常\r\n0:禁用\r\n-1:删除', '20', '0', '1', '1437633826', '1437633826', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('185', 'description', '描述信息', 'text NULL', 'textarea', '', '', '1', '', '20', '0', '1', '1437633751', '1437633751', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('186', 'icon', '图标', 'int(10) UNSIGNED NULL', 'picture', '', '', '0', '', '20', '0', '1', '1437633711', '1437633711', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('187', 'title', '分组名称', 'varchar(30) NULL', 'string', '', '', '1', '', '20', '1', '1', '1437641907', '1437633598', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('188', 'wechat_group_count', '微信端用户数', 'int(10) NULL', 'num', '', '', '0', '', '20', '0', '1', '1437644061', '1437644061', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('189', 'is_del', '是否已删除', 'tinyint(1) NULL', 'bool', '0', '', '0', '0:否\r\n1:是', '20', '0', '1', '1437650054', '1437650044', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('190', 'sports_id', 'sports_id', 'int(10) NULL', 'num', '', '', '0', '', '21', '0', '1', '1432806979', '1432806979', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('191', 'type', 'type', 'varchar(30) NULL', 'string', '', '', '0', '', '21', '0', '1', '1432807001', '1432807001', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('192', 'time', 'time', 'varchar(50) NULL', 'string', '', '', '0', '', '21', '0', '1', '1432807028', '1432807028', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('193', 'total_count', 'total_count', 'int(10) NULL', 'num', '0', '', '0', '', '21', '0', '1', '1432807049', '1432807049', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('194', 'follow_count', 'follow_count', 'int(10) NULL', 'num', '0', '', '0', '', '21', '0', '1', '1432807063', '1432807063', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('195', 'aver_count', 'aver_count', 'int(10) NULL', 'num', '0', '', '0', '', '21', '0', '1', '1432807079', '1432807079', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('196', 'group_id', '分组样式', 'int(10) NULL', 'num', '0', '', '1', '', '22', '0', '1', '1436845570', '1436845570', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('197', 'style', '样式内容', 'text NULL', 'textarea', '', '请填写html', '1', '', '22', '1', '1', '1436846111', '1436846111', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('198', 'group_name', '分组名称', 'varchar(255) NULL', 'string', '', '', '1', '', '23', '1', '1', '1436845332', '1436845332', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('199', 'desc', '说明', 'text NULL', 'textarea', '', '', '1', '', '23', '0', '1', '1436845361', '1436845361', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12057', 'single_orderid', '订单号', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1230', '0', '1', '1420596415', '1420596415', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12058', 'price', '价格', 'decimal(10,2) NULL', 'num', '', '', '1', '', '1230', '0', '1', '1439812508', '1420596472', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12056', 'orderName', '订单名称', 'varchar(255) NULL', 'string', '', '', '1', '', '1230', '0', '1', '1439976366', '1420596373', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12055', 'from', '回调地址', 'varchar(50) NOT NULL', 'string', '', '', '1', '', '1230', '0', '1', '1420596347', '1420596347', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12054', 'join_count', '参加人数', 'int(10) NULL', 'num', '0', '', '0', '', '1229', '0', '1', '1444962764', '1444962764', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12053', 'init_count', '初始化预约数', 'int(10) NULL', 'num', '0', '', '0', '', '1229', '0', '1', '1444962246', '1444962246', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12052', 'max_limit', '最大预约数', 'int(10) NULL', 'num', '0', '为空时表示不限制', '0', '', '1229', '0', '1', '1444962264', '1444962198', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12051', 'money', '报名费用', 'decimal(11,2) NULL', 'num', '0', '', '0', '', '1229', '0', '1', '1444962160', '1444962160', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12049', 'reserve_id', '预约活动ID', 'int(10) NULL', 'num', '', '', '0', '', '1229', '0', '1', '1444962084', '1444962084', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12050', 'name', '名称', 'varchar(100) NULL', 'string', '', '', '0', '', '1229', '0', '1', '1444962123', '1444962123', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12048', 'is_pay', '是否支付', 'int(10) NULL', 'num', '0', '', '0', '', '1228', '0', '1', '1445258123', '1445258123', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12047', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1228', '0', '1', '1396690911', '1396690911', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12046', 'uid', '用户ID', 'int(10) NULL', 'num', '', '', '0', '', '1228', '0', '1', '1396688042', '1396688042', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12045', 'openid', 'OpenId', 'varchar(255) NULL', 'string', '', '', '0', '', '1228', '0', '1', '1396688187', '1396688187', '', '3', '', 'regex', 'get_openid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12044', 'cTime', '增加时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1228', '0', '1', '1396688434', '1396688434', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12043', 'value', '微预约值', 'text NULL', 'textarea', '', '', '0', '', '1228', '0', '1', '1396688355', '1396688355', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12042', 'reserve_id', '微预约ID', 'int(10) UNSIGNED NULL', 'num', '', '', '4', '', '1228', '0', '1', '1396710064', '1396688308', '', '3', '', 'regex', '', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12040', 'type', '字段类型', 'char(50) NOT NULL', 'select', 'string', '用于微预约中的展示方式', '1', 'string:单行输入\r\ntextarea:多行输入\r\nradio:单选\r\ncheckbox:多选\r\nselect:下拉选择\r\ndatetime:时间\r\npicture:上传图片', '1227', '1', '1', '1396871262', '1396683600', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12041', 'is_check', '验证是否成功', 'int(10) NULL', 'num', '0', '', '0', '', '1228', '0', '1', '1445246146', '1445246146', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12020', 'intro', '封面简介', 'text NULL', 'textarea', '', '', '1', '', '1226', '1', '1', '1439371986', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12021', 'mTime', '修改时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1226', '0', '1', '1396624664', '1396624664', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12022', 'cover', '封面图片', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1226', '1', '1', '1439372018', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12023', 'template', '模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1226', '0', '1', '1431661124', '1431661124', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12024', 'status', '状态', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:已禁用\r\n1:已开启', '1226', '0', '1', '1444917938', '1444917938', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12025', 'start_time', '报名开始时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1226', '0', '1', '1444959115', '1444959115', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12026', 'end_time', '报名结束时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1226', '0', '1', '1444959142', '1444959142', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12027', 'pay_online', '是否支持在线支付', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:否\r\n1:是', '1226', '0', '1', '1444959225', '1444959225', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12028', 'is_show', '是否显示', 'tinyint(2) NULL', 'select', '1', '是否显示在微预约中', '1', '1:显示\r\n0:不显示', '1227', '0', '1', '1396848437', '1396848437', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12029', 'reserve_id', '微预约ID', 'int(10) UNSIGNED NULL', 'num', '', '', '4', '', '1227', '0', '1', '1396710040', '1396690613', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12030', 'error_info', '出错提示', 'varchar(255) NULL', 'string', '', '验证不通过时的提示语', '1', '', '1227', '0', '1', '1396685920', '1396685920', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12031', 'sort', '排序号', 'int(10) UNSIGNED NULL', 'num', '0', '值越小越靠前', '1', '', '1227', '0', '1', '1396685825', '1396685825', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12032', 'validate_rule', '正则验证', 'varchar(255) NULL', 'string', '', '为空表示不作验证', '1', '', '1227', '0', '1', '1396685776', '1396685776', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12033', 'is_must', '是否必填', 'tinyint(2) NULL', 'bool', '', '用于自动验证', '1', '0:否\r\n1:是', '1227', '0', '1', '1396685579', '1396685579', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12034', 'remark', '字段备注', 'varchar(255) NULL', 'string', '', '用于微预约中的提示', '1', '', '1227', '0', '1', '1396685482', '1396685482', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12035', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1227', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12036', 'value', '默认值', 'varchar(255) NULL', 'string', '', '字段的默认值', '1', '', '1227', '0', '1', '1396685291', '1396685291', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12037', 'title', '字段标题', 'varchar(255) NOT NULL', 'string', '', '请输入字段标题，用于微预约显示', '1', '', '1227', '1', '1', '1396676830', '1396676830', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12038', 'mTime', '修改时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1227', '0', '1', '1396624664', '1396624664', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12039', 'extra', '参数', 'text NULL', 'textarea', '', '字段类型为单选、多选、下拉选择和级联选择时的定义数据，其它字段类型为空', '1', '', '1227', '0', '1', '1396835020', '1396685105', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12066', 'wxmchid', '微信支付商户号', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '1', '1', '1439364696', '1436437067', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12067', 'shop_id', '商店ID', 'int(10) NULL', 'num', '0', '', '0', '', '1231', '0', '1', '1436437020', '1436437003', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12068', 'quick_merid', '银联在线merid', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '0', '1', '1436436949', '1436436949', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12069', 'quick_merabbr', '商户名称', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '0', '1', '1436436970', '1436436970', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12070', 'wxpartnerid', '微信partnerid', 'varchar(255) NULL', 'string', '', '', '0', '', '1231', '0', '1', '1436437196', '1436436910', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12071', 'wxpartnerkey', '微信partnerkey', 'varchar(255) NULL', 'string', '', '', '0', '', '1231', '0', '1', '1436437236', '1436436888', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12072', 'partnerid', '财付通标识', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '0', '1', '1436436798', '1436436798', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12073', 'key', 'KEY', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '0', '1', '1436436771', '1436436771', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12074', 'ctime', '创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1231', '0', '1', '1436436498', '1436436498', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12075', 'quick_security_key', '银联在线Key', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '0', '1', '1436436931', '1436436931', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12076', 'wappartnerkey', 'WAP财付通Key', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '0', '1', '1436436863', '1436436863', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12077', 'wappartnerid', '财付通标识WAP', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '0', '1', '1436436834', '1436436834', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12078', 'partnerkey', '财付通Key', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '0', '1', '1436436816', '1436436816', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12079', 'pid', 'PID', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '0', '1', '1436436707', '1436436707', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12080', 'zfbname', '帐号', 'varchar(255) NULL', 'string', '', '', '1', '', '1231', '0', '1', '1436436653', '1436436653', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12081', 'wxappsecret', 'AppSecret', 'varchar(255) NULL', 'string', '', '微信支付中的公众号应用密钥', '1', '', '1231', '1', '1', '1439364612', '1436436618', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12082', 'wxpaysignkey', '支付密钥', 'varchar(255) NULL', 'string', '', 'PartnerKey', '1', '', '1231', '1', '1', '1439364810', '1436436569', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12083', 'wxappid', 'AppID', 'varchar(255) NULL', 'string', '', '微信支付中的公众号应用ID', '1', '', '1231', '1', '1', '1439364573', '1436436534', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12084', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1231', '0', '1', '1436436415', '1436436415', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12085', 'wx_cert_pem', '上传证书', 'int(10) UNSIGNED NULL', 'file', '', 'apiclient_cert.pem', '1', '', '1231', '0', '1', '1439804529', '1439550487', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12086', 'wx_key_pem', '上传密匙', 'int(10) UNSIGNED NULL', 'file', '', 'apiclient_key.pem', '1', '', '1231', '0', '1', '1439804544', '1439804014', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12087', 'shop_pay_score', '支付返积分', 'int(10) NULL', 'num', '0', '不设置则默认为采用该支付方式不送积分', '1', '', '1231', '0', '1', '1443065789', '1443064056', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12088', 'keyword', '关键词', 'varchar(50) NOT NULL', 'string', '', '用户在微信里回复此关键词将会触发此投票。', '1', '', '1232', '1', '1', '1392969972', '1388930888', 'keyword_unique', '1', '此关键词已经存在，请换成别的关键词再试试', 'function', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12089', 'title', '投票标题', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1232', '1', '1', '1388931041', '1388931041', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12090', 'description', '投票描述', 'text NULL', 'textarea', '', '', '1', '', '1232', '0', '1', '1400633517', '1388931173', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12091', 'picurl', '封面图片', 'int(10) unsigned NULL ', 'picture', '', '支持JPG、PNG格式，较好的效果为大图360*200，小图200*200', '1', '', '1232', '0', '1', '1388931285', '1388931285', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12092', 'type', '选择类型', 'char(10) NOT NULL', 'radio', '0', '', '0', '0:单选\r\n1:多选', '1232', '1', '1', '1430376146', '1388931487', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12093', 'start_date', '开始日期', 'int(10) NULL', 'datetime', '', '', '1', '', '1232', '0', '1', '1388931734', '1388931734', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12094', 'end_date', '结束日期', 'int(10) NULL', 'datetime', '', '', '1', '', '1232', '0', '1', '1388931769', '1388931769', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12095', 'is_img', '文字/图片投票', 'tinyint(2) NULL', 'radio', '0', '', '0', '0:文字投票\r\n1:图片投票', '1232', '1', '1', '1389081985', '1388931941', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12096', 'vote_count', '投票数', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '1232', '0', '1', '1388932035', '1388932035', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12097', 'cTime', '投票创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1232', '1', '1', '1388932128', '1388932128', '', '1', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12098', 'mTime', '更新时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1232', '0', '1', '1430379170', '1390634006', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12099', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1232', '0', '1', '1391397388', '1391397388', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12100', 'template', '素材模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1232', '0', '1', '1430188739', '1430188739', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12101', 'vote_id', '投票ID', 'int(10) unsigned NULL ', 'num', '', '', '1', '', '1233', '1', '1', '1429846753', '1388934189', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12102', 'user_id', '用户ID', 'int(10) NULL ', 'num', '', '', '1', '', '1233', '1', '1', '1429855665', '1388934265', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12103', 'token', '用户TOKEN', 'varchar(255) NULL', 'string', '', '', '0', '', '1233', '1', '1', '1429855713', '1388934296', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12104', 'options', '选择选项', 'varchar(255) NULL', 'string', '', '', '1', '', '1233', '1', '1', '1429855086', '1388934351', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12105', 'cTime', '创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1233', '0', '1', '1429874378', '1388934392', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12106', 'order', '选项排序', 'int(10) unsigned NULL ', 'num', '0', '', '1', '', '1234', '0', '1', '1388933951', '1388933951', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12107', 'opt_count', '当前选项投票数', 'int(10) unsigned NULL ', 'num', '0', '', '1', '', '1234', '0', '1', '1429861248', '1388933860', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12108', 'image', '图片选项', 'int(10) unsigned NULL ', 'picture', '', '', '5', '', '1234', '0', '1', '1388984467', '1388933679', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12109', 'name', '选项标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1234', '1', '1', '1388933552', '1388933552', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12110', 'vote_id', '投票ID', 'int(10) unsigned NOT NULL ', 'num', '', '', '4', '', '1234', '1', '1', '1388982678', '1388933478', '', '3', '', 'regex', '$_REQUEST[\'vote_id\']', '3', 'string');
INSERT INTO `wx_attribute` VALUES ('12111', 'title', '活动名称', 'varchar(255) NULL', 'string', '', '', '1', '', '1235', '1', '1', '1443148922', '1443148534', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12112', 'select_type', '投票类型', 'char(10) NULL', 'radio', '1', '', '1', '1:单选|multi_num@hide\r\n2:多选|multi_num@show', '1235', '0', '1', '1443148839', '1443148618', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12113', 'multi_num', '多选限制', 'int(10) NULL', 'num', '0', '0代表不限制', '1', '', '1235', '0', '1', '1443148734', '1443148734', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12114', 'start_time', '开始时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1235', '1', '1', '1443148948', '1443148880', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12115', 'end_time', '结束时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1235', '1', '1', '1443148958', '1443148911', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12116', 'remark', '活动说明', 'text NULL', 'textarea', '', '', '1', '', '1235', '0', '1', '1443149020', '1443149020', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12117', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1235', '0', '1', '1443149050', '1443149050', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12118', 'manager_id', '管理员id', 'int(10) NULL', 'num', '', '', '0', '', '1235', '0', '1', '1443149118', '1443149118', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12119', 'is_verify', '投票是否需要填写验证码', 'tinyint(2) NULL', 'bool', '0', '防止刷票行为时需要开启', '1', '0:不需要\r\n1:需要', '1235', '0', '1', '1446000352', '1445997031', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12120', 'truename', '参赛者', 'varchar(255) NULL', 'string', '', '', '1', '', '1236', '1', '1', '1447817227', '1443149261', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12121', 'image', '参赛图片', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1236', '1', '1', '1447817196', '1443149366', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12122', 'uid', '用户id', 'int(10) NULL', 'num', '', '', '0', '', '1236', '0', '1', '1443149449', '1443149437', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12123', 'manifesto', '参赛宣言', 'text NULL', 'textarea', '', '', '1', '', '1236', '1', '1', '1447817176', '1443149626', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12124', 'introduce', '选手介绍', 'text NULL', 'textarea', '', '', '1', '', '1236', '1', '1', '1443149732', '1443149732', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12125', 'ctime', '创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1236', '0', '1', '1443149776', '1443149776', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12126', 'vote_id', '活动id', 'int(10) NULL', 'num', '', '', '4', '', '1236', '0', '1', '1443149827', '1443149827', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12127', 'opt_count', '投票数', 'int(10) NULL', 'num', '0', '', '0', '', '1236', '0', '1', '1443154633', '1443149866', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12128', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1236', '0', '1', '1443149961', '1443149961', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12129', 'number', '编号', 'int(10) NULL', 'num', '1', '', '0', '', '1236', '0', '1', '1443173465', '1443173454', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12130', 'vote_id', '活动id', 'int(10) NULL', 'num', '', '', '1', '', '1237', '0', '1', '1443150128', '1443150128', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12131', 'option_id', '选项id', 'int(10) NULL', 'num', '', '', '1', '', '1237', '0', '1', '1443150157', '1443150157', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12132', 'uid', '投票者id', 'int(10) NULL', 'num', '', '', '1', '', '1237', '0', '1', '1443150185', '1443150185', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12133', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1237', '0', '1', '1443150248', '1443150248', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12134', 'ctime', '投票时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1237', '0', '1', '1443150271', '1443150271', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11518', 'cTime', '增加时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1171', '0', '1', '1396688434', '1396688434', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11516', 'forms_id', '表单ID', 'int(10) UNSIGNED NULL', 'num', '', '', '4', '', '1171', '0', '1', '1396710064', '1396688308', '', '3', '', 'regex', '', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11517', 'value', '表单值', 'text NULL', 'textarea', '', '', '0', '', '1171', '0', '1', '1396688355', '1396688355', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11515', 'type', '字段类型', 'char(50) NOT NULL', 'select', 'string', '用于表单中的展示方式', '1', 'string:单行输入\r\ntextarea:多行输入\r\nradio:单选\r\ncheckbox:多选\r\nselect:下拉选择\r\ndatetime:时间\r\npicture:上传图片', '1170', '1', '1', '1396871262', '1396683600', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11514', 'extra', '参数', 'text NULL', 'textarea', '', '字段类型为单选、多选、下拉选择和级联选择时的定义数据，其它字段类型为空', '1', '', '1170', '0', '1', '1396835020', '1396685105', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11513', 'mTime', '修改时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1170', '0', '1', '1396624664', '1396624664', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11512', 'title', '字段标题', 'varchar(255) NOT NULL', 'string', '', '请输入字段标题，用于表单显示', '1', '', '1170', '1', '1', '1396676830', '1396676830', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11511', 'value', '默认值', 'varchar(255) NULL', 'string', '', '字段的默认值', '1', '', '1170', '0', '1', '1396685291', '1396685291', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11510', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1170', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11509', 'name', '字段名', 'varchar(100) NULL', 'string', '', '请输入字段名 英文字母开头，长度不超过30', '1', '', '1170', '1', '1', '1447638080', '1396676792', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11508', 'remark', '字段备注', 'varchar(255) NULL', 'string', '', '用于表单中的提示', '1', '', '1170', '0', '1', '1396685482', '1396685482', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11507', 'is_must', '是否必填', 'tinyint(2) NULL', 'bool', '', '用于自动验证', '1', '0:否\r\n1:是', '1170', '0', '1', '1396685579', '1396685579', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11506', 'validate_rule', '正则验证', 'varchar(255) NULL', 'string', '', '为空表示不作验证', '1', '', '1170', '0', '1', '1396685776', '1396685776', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11504', 'error_info', '出错提示', 'varchar(255) NULL', 'string', '', '验证不通过时的提示语', '1', '', '1170', '0', '1', '1396685920', '1396685920', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11505', 'sort', '排序号', 'int(10) UNSIGNED NULL', 'num', '0', '值越小越靠前', '1', '', '1170', '0', '1', '1396685825', '1396685825', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11503', 'forms_id', '表单ID', 'int(10) UNSIGNED NULL', 'num', '', '', '4', '', '1170', '0', '1', '1396710040', '1396690613', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11502', 'is_show', '是否显示', 'tinyint(2) NULL', 'select', '1', '是否显示在表单中', '1', '1:显示\r\n0:不显示', '1170', '0', '1', '1396848437', '1396848437', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11501', 'template', '模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1169', '0', '1', '1431661124', '1431661124', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11500', 'keyword', '关键词', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1169', '1', '1', '1396866048', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11499', 'cover', '封面图片', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1169', '1', '1', '1439372018', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11498', 'mTime', '修改时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1169', '0', '1', '1396624664', '1396624664', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11497', 'intro', '封面简介', 'text NULL', 'textarea', '', '', '1', '', '1169', '1', '1', '1439371986', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11496', 'can_edit', '是否允许编辑', 'tinyint(2) NULL', 'bool', '0', '用户提交表单是否可以再编辑', '1', '0:不允许\r\n1:允许', '1169', '0', '1', '1396688624', '1396688624', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11495', 'finish_tip', '用户提交后提示内容', 'text NULL', 'string', '', '为空默认为：提交成功，谢谢参与', '1', '', '1169', '0', '1', '1447497102', '1396673689', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11494', 'content', '详细介绍', 'text NULL', 'editor', '', '可不填', '1', '', '1169', '0', '1', '1396865295', '1396865295', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11493', 'jump_url', '提交后跳转的地址', 'varchar(255) NULL', 'string', '', '要以http://开头的完整地址，为空时不跳转', '1', '', '1169', '0', '1', '1402458121', '1399800276', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11492', 'keyword_type', '关键词类型', 'tinyint(2) NOT NULL', 'select', '0', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配', '1169', '1', '1', '1396624426', '1396061765', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11330', 'icon', '图标', 'int(10) unsigned NULL ', 'picture', '', '根据选择的底部模板决定是否需要上传图标', '1', '', '1150', '0', '1', '1396506297', '1396506297', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11329', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1150', '0', '1', '1394526820', '1394526820', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11331', 'title', '标题', 'varchar(255) NULL', 'string', '', '可为空', '1', '', '1151', '0', '1', '1396098316', '1396098316', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11327', 'pid', '一级菜单', 'tinyint(2) NULL', 'select', '0', '如果是一级菜单，选择“无”即可', '1', '0:无', '1150', '0', '1', '1409045931', '1394518930', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11328', 'sort', '排序号', 'tinyint(4) NULL ', 'num', '0', '数值越小越靠前', '1', '', '1150', '0', '1', '1394523288', '1394519175', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11300', 'keyword', '关键词', 'varchar(255) NULL', 'string', '', '多个关键词可以用空格分开，如“高富帅 白富美”', '1', '', '1147', '1', '1', '1439194858', '1439194849', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11301', 'msg_type', '消息类型', 'char(50) NULL', 'select', 'text', '', '0', 'text:文本|content@show,group_id@hide,image_id@hide\r\nnews:图文|content@hide,group_id@show,image_id@hide\r\nimage:图片|content@hide,group_id@hide,image_id@show', '1147', '1', '1', '1439204529', '1439194979', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11302', 'content', '文本内容', 'text NULL', 'textarea', '', '', '1', '', '1147', '0', '1', '1439195826', '1439195091', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11303', 'group_id', '图文', 'int(10) NULL', 'news', '', '', '1', '', '1147', '0', '1', '1439204192', '1439195901', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11304', 'image_id', '上传图片', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1147', '0', '1', '1439195945', '1439195945', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11305', 'manager_id', '管理员ID', 'int(10) NULL', 'num', '', '', '0', '', '1147', '0', '1', '1439203621', '1439203575', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11306', 'token', 'Token', 'varchar(50) NULL', 'string', '', '', '0', '', '1147', '0', '1', '1439203612', '1439203612', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11307', 'image_material', '素材图片id', 'int(10) NULL', 'num', '', '', '0', '', '1147', '0', '1', '1447738833', '1447738833', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11317', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1149', '1', '1', '1396061877', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11318', 'intro', '简介', 'text NULL', 'textarea', '', '', '1', '', '1149', '0', '1', '1396061947', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11319', 'cate_id', '所属类别', 'int(10) unsigned NULL ', 'select', '0', '要先在微官网分类里配置好分类才可选择', '1', '0:请选择分类', '1149', '0', '1', '1396078914', '1396062003', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11320', 'cover', '封面图片', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '1149', '0', '1', '1396062093', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11321', 'content', '内容', 'text NULL', 'editor', '', '', '1', '', '1149', '0', '1', '1396062146', '1396062146', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11322', 'cTime', '发布时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1149', '0', '1', '1396075102', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11323', 'sort', '排序号', 'int(10) unsigned NULL ', 'num', '0', '数值越小越靠前', '1', '', '1149', '0', '1', '1396510508', '1396510508', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11324', 'view_count', '浏览数', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '1149', '0', '1', '1396510630', '1396510630', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11325', 'url', '关联URL', 'varchar(255) NULL ', 'string', '', '', '1', '', '1150', '0', '1', '1394519090', '1394519090', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11326', 'title', '菜单名', 'varchar(50) NOT NULL', 'string', '', '可创建最多 3 个一级菜单，每个一级菜单下可创建最多 5 个二级菜单。编辑中的菜单不会马上被用户看到，请放心调试。', '1', '', '1150', '1', '1', '1408950832', '1394518988', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11332', 'img', '图片', 'int(10) unsigned NOT NULL ', 'picture', '', '', '1', '', '1151', '1', '1', '1396098349', '1396098349', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11333', 'url', '链接地址', 'varchar(255) NULL', 'string', '', '', '1', '', '1151', '0', '1', '1396098380', '1396098380', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11334', 'is_show', '是否显示', 'tinyint(2) NULL', 'bool', '1', '', '1', '0:不显示\r\n1:显示', '1151', '0', '1', '1396098464', '1396098464', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11335', 'sort', '排序', 'int(10) unsigned NULL ', 'num', '0', '值越小越靠前', '1', '', '1151', '0', '1', '1396098682', '1396098682', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11336', 'token', 'Token', 'varchar(100) NULL', 'string', '', '', '0', '', '1151', '0', '1', '1396098747', '1396098747', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11337', 'keyword', '关键词', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1152', '1', '1', '1396624337', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11338', 'keyword_type', '关键词匹配类型', 'tinyint(2) NOT NULL', 'select', '0', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配', '1152', '1', '1', '1396624426', '1396061765', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11339', 'title', '试卷标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1152', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11340', 'intro', '封面简介', 'text NOT NULL', 'textarea', '', '', '1', '', '1152', '0', '1', '1396624505', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11341', 'mTime', '修改时间', 'int(10) NOT NULL', 'datetime', '', '', '0', '', '1152', '0', '1', '1396624664', '1396624664', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11342', 'cover', '封面图片', 'int(10) UNSIGNED NOT NULL', 'picture', '', '', '1', '', '1152', '0', '1', '1396624534', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11343', 'cTime', '发布时间', 'int(10) UNSIGNED NOT NULL', 'datetime', '', '', '0', '', '1152', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11344', 'token', 'Token', 'varchar(255) NOT NULL', 'string', '', '', '0', '', '1152', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11345', 'finish_tip', '结束语', 'text NOT NULL', 'string', '', '为空默认为：考试完成，谢谢参与', '1', '', '1152', '0', '1', '1447646362', '1396953940', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11346', 'start_time', '考试开始时间', 'int(10) NULL', 'datetime', '', '为空表示什么时候开始都可以', '2', '', '1152', '0', '1', '1447752638', '1397036762', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11347', 'end_time', '考试结束时间', 'int(10) NULL', 'datetime', '', '为空表示不限制结束时间', '2', '', '1152', '0', '1', '1447753072', '1397036831', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11348', 'title', '题目标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1153', '1', '1', '1397037377', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11349', 'intro', '题目描述', 'text NOT NULL', 'textarea', '', '', '1', '', '1153', '0', '1', '1396954176', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11350', 'cTime', '发布时间', 'int(10) UNSIGNED NOT NULL', 'datetime', '', '', '0', '', '1153', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11351', 'token', 'Token', 'varchar(255) NOT NULL', 'string', '', '', '0', '', '1153', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11352', 'is_must', '是否必填', 'tinyint(2) NOT NULL', 'bool', '1', '', '0', '0:否\r\n1:是', '1153', '0', '1', '1397035513', '1396954649', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11353', 'extra', '参数', 'text NOT NULL', 'textarea', '', '每个选项换一行，每项输入格式如：A:男人', '1', '', '1153', '0', '1', '1397036210', '1396954558', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11354', 'type', '题目类型', 'char(50) NOT NULL', 'radio', 'radio', '', '1', 'radio:单选题\r\ncheckbox:多选题', '1153', '1', '1', '1397036281', '1396954463', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11355', 'exam_id', 'exam_id', 'int(10) UNSIGNED NOT NULL', 'num', '', '', '4', '', '1153', '1', '1', '1396954240', '1396954240', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11356', 'sort', '排序号', 'int(10) UNSIGNED NOT NULL', 'num', '0', '值越小越靠前', '1', '', '1153', '0', '1', '1396955010', '1396955010', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11357', 'score', '分值', 'int(10) UNSIGNED NOT NULL', 'num', '0', '考生答对此题的得分数', '1', '', '1153', '0', '1', '1397035609', '1397035609', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11358', 'answer', '标准答案', 'varchar(255) NOT NULL', 'string', '', '多个答案用空格分开，如： A B C', '1', '', '1153', '0', '1', '1397035889', '1397035889', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11359', 'answer', '回答内容', 'text NOT NULL', 'textarea', '', '', '0', '', '1154', '0', '1', '1396955766', '1396955766', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11360', 'openid', 'OpenId', 'varchar(255) NOT NULL', 'string', '', '', '0', '', '1154', '0', '1', '1396955581', '1396955581', '', '3', '', 'regex', 'get_openid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11361', 'uid', '用户UID', 'int(10) UNSIGNED NOT NULL', 'num', '', '', '0', '', '1154', '0', '1', '1396955530', '1396955530', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11362', 'question_id', 'question_id', 'int(10) UNSIGNED NOT NULL', 'num', '', '', '4', '', '1154', '1', '1', '1396955412', '1396955392', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11363', 'cTime', '发布时间', 'int(10) UNSIGNED NOT NULL', 'datetime', '', '', '0', '', '1154', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11364', 'token', 'Token', 'varchar(255) NOT NULL', 'string', '', '', '0', '', '1154', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11365', 'exam_id', 'exam_id', 'int(10) UNSIGNED NOT NULL', 'num', '', '', '4', '', '1154', '1', '1', '1396955403', '1396955369', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11366', 'score', '得分', 'int(10) UNSIGNED NOT NULL', 'num', '0', '', '0', '', '1154', '0', '1', '1397040133', '1397040133', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11367', 'follow_id', '粉丝id', 'int(10) NULL', 'num', '', '', '1', '', '1155', '0', '1', '1432619233', '1432619233', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11368', 'sports_id', '场次id', 'int(10) NULL', 'num', '', '', '1', '', '1155', '0', '1', '1432690316', '1432619261', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11369', 'count', '抽奖次数', 'int(10) NULL', 'num', '0', '', '1', '', '1155', '0', '1', '1432619288', '1432619288', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11370', 'uid', 'uid', 'int(10) NULL', 'num', '', '', '0', '', '1155', '0', '1', '1435313298', '1435313298', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11371', 'cTime', '支持时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1155', '0', '1', '1432690461', '1432690461', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11372', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1155', '0', '1', '1444986759', '1444986759', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11373', 'sports_id', '活动编号', 'int(10) NULL', 'num', '', '', '1', '', '1156', '0', '1', '1432690590', '1432613794', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11374', 'award_id', '奖品编号', 'varchar(255) NULL', 'cascade', '', '', '1', '', '1156', '0', '1', '1432710935', '1432613820', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11375', 'award_num', '奖品数量', 'int(10) NULL', 'num', '', '', '1', '', '1156', '0', '1', '1432624743', '1432624743', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11376', 'uid', 'uid', 'int(10) NULL', 'num', '', '', '0', '', '1156', '0', '1', '1435313078', '1435313078', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11377', 'uid', 'uid', 'int(10) NULL', 'num', '', '', '0', '', '1157', '0', '1', '1435313219', '1435313219', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11378', 'draw_id', '活动编号', 'int(10) NULL', 'num', '', '', '1', '', '1157', '0', '1', '1432619092', '1432618270', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11379', 'sport_id', '场次编号', 'int(10) NULL', 'num', '', '', '1', '', '1157', '0', '1', '1432618305', '1432618305', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11380', 'award_id', '奖品编号', 'int(10) NULL', 'num', '', '', '1', '', '1157', '0', '1', '1432618336', '1432618336', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11381', 'follow_id', '粉丝id', 'int(10) NULL', 'num', '', '', '1', '', '1157', '0', '1', '1432618392', '1432618392', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11382', 'address', '地址', 'varchar(255) NULL', 'string', '', '', '1', '', '1157', '0', '1', '1432618543', '1432618543', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11383', 'num', '获奖数', 'int(10) NULL', 'num', '0', '', '1', '', '1157', '0', '1', '1432618584', '1432618584', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11384', 'state', '兑奖状态', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:未兑奖\r\n1:已兑奖', '1157', '0', '1', '1432644421', '1432618716', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11385', 'zjtime', '中奖时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1157', '0', '1', '1432716949', '1432618837', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11386', 'djtime', '兑奖时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1157', '0', '1', '1432618922', '1432618922', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11387', 'remark', '备注', 'text NULL', 'textarea', '', '', '1', '', '1157', '0', '1', '1445056786', '1445056786', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11388', 'aim_table', '活动标识', 'varchar(255) NULL', 'string', '', '', '0', '', '1157', '0', '1', '1444966689', '1444966689', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11389', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1157', '0', '1', '1444966581', '1444966581', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11390', 'scan_code', '核销码', 'varchar(255) NULL', 'string', '', '', '1', '', '1157', '0', '1', '1446202559', '1446202559', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11391', 'title', '活动名称', 'varchar(255) NULL', 'string', '', '', '1', '', '1158', '1', '1', '1435306559', '1435306559', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11392', 'remark', '活动描述', 'text NULL', 'textarea', '', '', '1', '', '1158', '1', '1', '1435307454', '1435307126', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11393', 'logo_img', '活动LOGO', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1158', '1', '1', '1435307446', '1435307174', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11394', 'start_time', '开始时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1158', '1', '1', '1435310820', '1435307277', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11395', 'end_time', '结束时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1158', '1', '1', '1435310830', '1435307296', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11396', 'get_prize_tip', '中奖提示信息', 'varchar(255) NULL', 'string', '', '', '1', '', '1158', '1', '1', '1435307421', '1435307411', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11397', 'no_prize_tip', '未中奖提示信息', 'varchar(255) NULL', 'string', '', '', '1', '', '1158', '1', '1', '1435307517', '1435307517', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11398', 'ctime', '活动创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1158', '0', '1', '1435307577', '1435307577', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11399', 'uid', 'uid', 'int(10) NULL', 'num', '', '', '0', '', '1158', '0', '1', '1435307671', '1435307671', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11400', 'lottery_number', '抽奖次数', 'int(10) NULL', 'num', '1', '每日允许用户抽奖的机会数，小于0 为无限次', '1', '', '1158', '0', '1', '1436233580', '1435585561', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11401', 'comment_status', '评论是否需要审核', 'char(10) NULL', 'radio', '0', '', '1', '0:不审核\r\n1:审核', '1158', '0', '1', '1436155693', '1435665821', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11402', 'get_prize_count', '中奖次数', 'int(10) NULL', 'num', '1', '每用户是否允许多次中奖', '1', '', '1158', '0', '1', '1436181974', '1436181850', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11403', 'lzwg_id', '活动编号', 'int(10) NULL', 'num', '', '', '1', '', '1159', '0', '1', '1435734910', '1435734886', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11404', 'lzwg_type', '活动类型', 'char(10) NULL', 'radio', '0', '', '1', '0:投票\r\n1:调查', '1159', '0', '1', '1435734977', '1435734977', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11405', 'vote_id', '题目编号', 'int(10) NULL', 'num', '', '', '1', '', '1159', '0', '1', '1435735047', '1435735047', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11406', 'vote_type', '问题类型', 'char(10) NULL', 'radio', '1', '', '1', '0:单选\r\n1:多选', '1159', '0', '1', '1435735092', '1435735092', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11407', 'vote_limit', '最多选择几项', 'int(10) NULL', 'num', '', '', '1', '', '1159', '0', '1', '1435735172', '1435735172', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11408', 'img', '奖品图片', 'int(10) NOT NULL', 'picture', '', '', '1', '', '1160', '1', '1', '1432609211', '1432607410', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11409', 'name', '奖项名称', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1160', '1', '1', '1432621511', '1432607270', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11410', 'score', '积分数', 'int(10) NULL', 'num', '0', '虚拟奖品积分奖励', '1', '', '1160', '1', '1', '1433312545', '1433304974', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11411', 'award_type', '奖品类型', 'varchar(30) NULL', 'bool', '1', '选择奖品类别', '1', '1:实物奖品|price@show,score@hide\r\n0:虚拟奖品|price@hide,score@show', '1160', '1', '1', '1433312276', '1433303130', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11412', 'price', '商品价格', 'FLOAT(10) NULL', 'num', '0', '价格默认为0，表示未报价', '1', '', '1160', '0', '1', '1433312127', '1432607574', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11413', 'explain', '奖品说明', 'text NULL', 'textarea', '', '', '1', '', '1160', '0', '1', '1432621815', '1432607605', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11414', 'count', '奖品数量', 'int(10) NOT NULL', 'num', '', '', '1', '', '1160', '1', '1', '1447833730', '1432607983', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11415', 'sort', '排序号', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '1160', '0', '1', '1432809831', '1432608522', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11416', 'uid', 'uid', 'int(10) NULL', 'num', '', '', '0', '', '1160', '0', '1', '1435308540', '1435308540', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11417', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1160', '0', '1', '1444879923', '1444879923', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11418', 'coupon_id', '选择赠送券', 'char(50) NULL', 'select', '', '', '1', '', '1160', '0', '1', '1444893831', '1444881398', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11419', 'money', '返现金额', 'float(10) NULL', 'num', '', '', '1', '', '1160', '0', '1', '1444882709', '1444881428', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11420', 'aim_table', '活动标识', 'varchar(255) NULL', 'string', '', '', '0', '', '1160', '0', '1', '1444883071', '1444883071', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11421', 'score', '比分', 'varchar(30) NULL', 'string', '', '输入格式：4:1', '1', '', '1161', '0', '1', '1432781750', '1432556644', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11422', 'content', '说明', 'text NULL', 'textarea', '', '请输入说明', '1', '', '1161', '0', '1', '1432556696', '1432556696', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11423', 'start_time', '时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1161', '1', '1', '1432556499', '1432556499', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11424', 'visit_team', '客场球队', 'varchar(255) NULL', 'cascade', '', '', '1', 'type=db&table=sports_team', '1161', '1', '1', '1432558295', '1432556450', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11425', 'home_team', '主场球队', 'varchar(255) NULL', 'cascade', '', '', '1', 'type=db&table=sports_team', '1161', '1', '1', '1432558269', '1432556380', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11426', 'countdown', '擂鼓时长', 'int(10) NULL', 'num', '60', '擂鼓倒计的时长,单位为秒,取值范围: 10~99', '1', '', '1161', '0', '1', '1432645901', '1432642097', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11427', 'drum_count', '擂鼓次数', 'int(10) NULL', 'num', '0', '', '0', '', '1161', '0', '1', '1432642664', '1432642664', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11428', 'drum_follow_count', '擂鼓人数', 'int(10) NULL', 'num', '0', '', '0', '', '1161', '0', '1', '1432642718', '1432642718', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11429', 'home_team_support_count', '主场球队支持数', 'int(10) NULL', 'num', '0', '', '0', '', '1161', '0', '1', '1432642808', '1432642808', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11430', 'visit_team_support_count', '客场球队支持人数', 'int(10) NULL', 'num', '0', '', '0', '', '1161', '0', '1', '1432642849', '1432642849', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11431', 'home_team_drum_count', '主场球队擂鼓数', 'int(10) NULL', 'num', '0', '', '0', '', '1161', '0', '1', '1432642978', '1432642978', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11432', 'visit_team_drum_count', '客场球队擂鼓数', 'int(10) NULL', 'num', '0', '', '0', '', '1161', '0', '1', '1432644311', '1432643015', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11433', 'yaotv_count', '摇一摇总次', 'int(10) NULL', 'num', '0', '', '0', '', '1161', '0', '1', '1432884957', '1432784354', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11434', 'draw_count', '抽奖总次数', 'int(10) NULL', 'num', '0', '', '0', '', '1161', '0', '1', '1432887571', '1432784416', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11435', 'is_finish', '是否已结束', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:未结束\r\n1:已结束', '1161', '0', '1', '1432868975', '1432868975', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11436', 'yaotv_follow_count', '摇电视总人数', 'int(10) NULL', 'num', '0', '', '0', '', '1161', '0', '1', '1432884721', '1432884721', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11437', 'draw_follow_count', '抽奖总人数', 'int(10) NULL', 'num', '0', '', '0', '', '1161', '0', '1', '1432887553', '1432887553', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11438', 'comment_status', '评论是否需要审核', 'tinyint(2) NULL', 'radio', '0', '', '1', '0:不审核\r\n1:审核', '1161', '0', '1', '1435109668', '1435030411', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11439', 'sports_id', '场次ID', 'int(10) NULL', 'num', '', '', '0', '', '1162', '0', '1', '1432642290', '1432642290', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11440', 'team_id', '球队ID', 'int(10) NULL', 'num', '', '', '0', '', '1162', '0', '1', '1432642312', '1432642312', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11441', 'follow_id', '用户ID', 'int(10) NULL', 'num', '', '', '0', '', '1162', '0', '1', '1432642354', '1432642354', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11442', 'drum_count', '擂鼓次数', 'int(10) NULL', 'num', '', '', '0', '', '1162', '0', '1', '1432642384', '1432642384', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11443', 'cTime', '时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1162', '0', '1', '1432642409', '1432642409', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11444', 'sports_id', '场次ID', 'int(10) NULL', 'num', '', '', '0', '', '1163', '0', '1', '1432635120', '1432635120', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11445', 'team_id', '球队ID', 'int(10) NULL', 'num', '', '', '0', '', '1163', '0', '1', '1432635147', '1432635147', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11446', 'follow_id', '用户ID', 'int(10) NULL', 'num', '', '', '0', '', '1163', '0', '1', '1432635168', '1432635168', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11447', 'cTime', '支持时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1163', '0', '1', '1432635202', '1432635202', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11448', 'sort', '排序号', 'int(10) NULL', 'num', '0', '', '0', '', '1164', '0', '1', '1432559360', '1432559360', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11449', 'intro', '球队说明', 'text  NULL', 'textarea', '', '', '1', '', '1164', '0', '1', '1432557159', '1432556960', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11450', 'pid', 'pid', 'int(10) NULL', 'num', '0', '', '0', '', '1164', '0', '1', '1432557085', '1432557085', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11451', 'logo', '球队图标', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1164', '1', '1', '1432556913', '1432556913', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11452', 'title', '球队名称', 'varchar(100) NULL', 'string', '', '请输入球队名称', '1', '', '1164', '1', '1', '1432958716', '1432556869', 'unique', '3', '球队名称不能重复', 'unique', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11453', 'title', '活动名称', 'varchar(255) NULL', 'string', '', '', '1', '', '1165', '1', '1', '1444877324', '1444877324', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11454', 'game_type', '游戏类型', 'char(10) NULL', 'radio', '1', '', '1', '1:刮刮乐\r\n2:大转盘\r\n3:砸金蛋\r\n4:九宫格', '1165', '1', '1', '1444877425', '1444877425', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11455', 'status', '状态', 'char(10) NULL', 'radio', '1', '', '1', '1:开启\r\n0:禁用', '1165', '0', '1', '1444877482', '1444877468', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11456', 'start_time', '开始时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1165', '1', '1', '1444877509', '1444877509', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11457', 'end_time', '结束时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1165', '1', '1', '1444877530', '1444877530', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11458', 'day_attend_limit', '每人每天抽奖次数', 'int(10) NULL', 'num', '0', '0，则不限制，超过此限制点击抽奖，系统会提示“您今天的抽奖次数已经用完!”', '1', '', '1165', '0', '1', '1444879540', '1444878111', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11459', 'attend_limit', '每人总共抽奖次数', 'int(10) NULL', 'num', '0', '0，则不限制；否则必须>=每人每天抽奖次数，超过此限制点击抽奖，系统会提示“您的所有抽奖次数已用完!”', '1', '', '1165', '0', '1', '1444879552', '1444878167', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11460', 'day_win_limit', '每人每天中奖次数', 'int(10) NULL', 'num', '0', '0，则不限制，超过此限制点击抽奖，抽奖者将无概率中奖', '1', '', '1165', '0', '1', '1444879608', '1444878254', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11461', 'win_limit', '每人总共中奖次数', 'int(10) NULL', 'num', '0', '0，则不限制；否则必须>=每人每天中奖次数，超过此限制点击抽奖，抽奖者将无概率中奖', '1', '', '1165', '0', '1', '1444879656', '1444878336', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11462', 'day_winners_count', '每天最多中奖人数', 'int(10) NULL', 'num', '0', '0，则不限制，超过此限制时，系统会提示“今天奖品已抽完，明天再来吧!”', '1', '', '1165', '0', '1', '1444879673', '1444878419', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11463', 'url', '关注链接', 'varchar(300) NULL', 'string', '', '', '0', '', '1165', '0', '1', '1445068488', '1444878621', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11464', 'remark', '活动说明', 'text NULL', 'textarea', '', '', '1', '', '1165', '0', '1', '1444878676', '1444878676', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11465', 'keyword', '微信关键词', 'varchar(255) NULL', 'string', '', '', '1', '', '1165', '1', '1', '1444878722', '1444878722', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11466', 'attend_num', '参与总人数', 'int(10) NULL', 'num', '0', '', '0', '', '1165', '0', '1', '1444878774', '1444878774', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11467', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1165', '0', '1', '1444878837', '1444878837', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11468', 'manager_id', '管理员id', 'int(10) NULL', 'num', '', '', '0', '', '1165', '0', '1', '1444878900', '1444878900', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11469', 'award_id', '奖品id', 'int(10) NULL', 'num', '', '', '1', '', '1166', '1', '1', '1444901378', '1444900999', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11470', 'games_id', '抽奖游戏id', 'int(10) NULL', 'num', '', '', '1', '', '1166', '1', '1', '1444901386', '1444901037', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11471', 'grade', '中奖等级', 'varchar(255) NULL', 'string', '', '', '1', '', '1166', '1', '1', '1444901399', '1444901079', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11472', 'num', '奖品数量', 'int(10) NULL', 'num', '', '', '1', '', '1166', '1', '1', '1444901364', '1444901364', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11473', 'max_count', '最多抽奖', 'int(10) NULL', 'num', '', 'n次,把奖品发放完, 不能小于奖品数量', '1', '', '1166', '0', '1', '1444901486', '1444901486', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11474', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1166', '0', '1', '1444901512', '1444901512', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11475', 'follow_id', '粉丝id', 'int(10) NULL', 'num', '', '', '1', '', '1167', '0', '1', '1432619233', '1432619233', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11476', 'sports_id', '场次id', 'int(10) NULL', 'num', '', '', '1', '', '1167', '0', '1', '1432690316', '1432619261', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11477', 'count', '抽奖次数', 'int(10) NULL', 'num', '0', '', '1', '', '1167', '0', '1', '1432619288', '1432619288', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11478', 'uid', 'uid', 'int(10) NULL', 'num', '', '', '0', '', '1167', '0', '1', '1435313298', '1435313298', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11479', 'cTime', '支持时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1167', '0', '1', '1432690461', '1432690461', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11480', 'keyword_type', '关键词匹配类型', 'tinyint(2) NULL', 'select', '0', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配', '1168', '0', '1', '1394268247', '1393921586', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11481', 'api_token', 'Token', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1168', '0', '1', '1393922455', '1393912408', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11482', 'cTime', '创建时间', 'int(10) NOT NULL', 'datetime', '', '', '0', '', '1168', '0', '1', '1393913608', '1393913608', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11483', 'api_url', '第三方URL', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1168', '0', '1', '1393912354', '1393912354', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11484', 'output_format', '数据输出格式', 'tinyint(1) NULL', 'select', '0', '', '1', '0:标准微信xml\r\n1:json格式', '1168', '0', '1', '1394268422', '1393912288', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11485', 'keyword_filter', '关键词过滤', 'tinyint(2) NOT NULL', 'bool', '0', '如设置电影为触发词,用户输入 电影 美国派 时，如果启用过滤只将美国派这个词发送到的你的接口，如果不过滤 就是整个 电影 美国派全部发送到的接口', '1', '0:不过滤\r\n1:过滤', '1168', '0', '1', '1394268410', '1393912057', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11486', 'keyword', '关键词', 'varchar(255) NOT NULL', 'string', '', '多个关键词请用空格格开', '1', '', '1168', '1', '1', '1393912492', '1393911842', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11487', 'token', 'Token', 'varchar(255) NOT NULL', 'string', '', '', '0', '', '1168', '0', '1', '1402454223', '1402454223', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11488', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1169', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11489', 'cTime', '发布时间', 'int(10) UNSIGNED NULL', 'datetime', '', '', '0', '', '1169', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11490', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1169', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11491', 'password', '表单密码', 'varchar(255) NULL', 'string', '', '如要用户输入密码才能进入表单，则填写此项。否则留空，用户可直接进入表单', '0', '', '1169', '0', '1', '1396871497', '1396672643', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11313', 'sort', '排序号', 'int(10) NULL ', 'num', '0', '数值越小越靠前', '1', '', '1148', '0', '1', '1396340334', '1396340334', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11308', 'title', '分类标题', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1148', '1', '1', '1408950771', '1395988016', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11291', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1145', '0', '1', '1396603007', '1396603007', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11290', 'sort', '排序号', 'int(10) unsigned NULL ', 'num', '0', '', '1', '', '1145', '0', '1', '1396580674', '1396580674', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11289', 'view_count', '浏览数', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '1145', '0', '1', '1396580643', '1396580643', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11288', 'content', '回复内容', 'text NULL', 'textarea', '', '请不要多于1000字否则无法发送。支持加超链接，但URL必须带http://', '1', '', '1145', '0', '1', '1396607362', '1396578597', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('723', 'sn', 'SN码', 'varchar(255) NULL', 'string', '', '', '0', '', '81', '0', '1', '1399272236', '1399272228', '', '3', '', 'regex', 'uniqid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('724', 'uid', '粉丝UID', 'int(10) NULL', 'num', '', '', '0', '', '81', '0', '1', '1399772738', '1399272401', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('725', 'cTime', '创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '81', '0', '1', '1399272456', '1399272456', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('726', 'is_use', '是否已使用', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:未使用\r\n1:已使用', '81', '0', '1', '1400601159', '1399272514', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('727', 'use_time', '使用时间', 'int(10) NULL', 'datetime', '', '', '0', '', '81', '0', '1', '1399272560', '1399272537', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('728', 'addon', '来自的插件', 'varchar(255) NULL', 'string', 'Coupon', '', '4', '', '81', '0', '1', '1399272651', '1399272651', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('729', 'target_id', '来源ID', 'int(10) unsigned NULL ', 'num', '', '', '4', '', '81', '0', '1', '1399272705', '1399272705', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('730', 'prize_id', '奖项ID', 'int(10) unsigned NULL ', 'num', '', '', '0', '', '81', '0', '1', '1399686317', '1399686317', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('731', 'prize_title', '奖项', 'varchar(255) NULL', 'string', '', '', '1', '', '81', '0', '1', '1399790367', '1399790367', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('732', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '81', '0', '1', '1404525481', '1404525481', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('733', 'can_use', '是否可用', 'tinyint(2) NULL', 'bool', '1', '', '0', '0:不可用\r\n1:可用', '81', '0', '1', '1418890020', '1418890020', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('734', 'server_addr', '服务器IP', 'varchar(50) NULL', 'string', '', '', '1', '', '81', '0', '1', '1425807865', '1425807865', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('776', 'title', '应用标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '87', '1', '1', '1402758132', '1394033402', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('777', 'uid', '用户ID', 'int(10) NULL ', 'num', '0', '', '0', '', '87', '0', '1', '1394087733', '1394033447', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('778', 'content', '应用详细介绍', 'text NULL ', 'editor', '', '', '1', '', '87', '1', '1', '1402758118', '1394033484', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('779', 'cTime', '发布时间', 'int(10) NULL ', 'datetime', '', '', '0', '', '87', '0', '1', '1394033571', '1394033571', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('780', 'attach', '应用压缩包', 'varchar(255) NULL ', 'file', '', '需要上传zip文件', '1', '', '87', '0', '1', '1402758100', '1394033674', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('781', 'is_top', '置顶', 'int(10) NULL ', 'bool', '0', '0表示不置顶，否则其它值表示置顶且值是置顶的时间', '1', '0:不置顶\r\n1:置顶', '87', '0', '1', '1402800009', '1394068787', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('782', 'cid', '分类', 'tinyint(4) NULL ', 'select', '', '', '0', '1:基础模块\r\n2:行业模块\r\n3:会议活动\r\n4:娱乐模块\r\n5:其它模块', '87', '0', '1', '1402758069', '1394069964', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('783', 'view_count', '浏览数', 'int(11) unsigned NULL ', 'num', '0', '', '0', '', '87', '0', '1', '1394072168', '1394072168', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('784', 'download_count', '下载数', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '87', '0', '1', '1394085763', '1394085763', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('785', 'img_2', '应用截图2', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '87', '0', '1', '1402758035', '1394084714', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('786', 'img_1', '应用截图1', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '87', '0', '1', '1402758046', '1394084635', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('787', 'img_3', '应用截图3', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '87', '0', '1', '1402758021', '1394084757', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('788', 'img_4', '应用截图4', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '87', '0', '1', '1402758011', '1394084797', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('789', 'uid', 'uid', 'int(10) NULL', 'num', '', '', '1', '', '88', '0', '1', '1430880974', '1430880974', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('790', 'name', '素材名称', 'varchar(100) NULL', 'string', '', '', '1', '', '88', '0', '1', '1424612322', '1424611929', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('791', 'status', '状态', 'char(10) NULL', 'radio', 'UnSubmit', '', '1', 'UnSubmit:未提交\r\nWaiting:入库中\r\nSuccess:入库成功\r\nFailure:入库失败', '88', '0', '1', '1424612039', '1424612039', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('792', 'cTime', '提交时间', 'int(10) NULL', 'datetime', '', '', '1', '', '88', '0', '1', '1424612114', '1424612114', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('793', 'url', '实际摇一摇所使用的页面URL', 'varchar(255) NULL', 'string', '', '', '1', '', '88', '0', '1', '1424612483', '1424612154', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('794', 'type', '素材类型', 'varchar(255) NULL', 'string', '', '', '1', '', '88', '0', '1', '1424612421', '1424612421', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('795', 'detail', '素材内容', 'text NULL', 'textarea', '', '', '1', '', '88', '0', '1', '1424612456', '1424612456', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('796', 'reason', '入库失败的原因', 'text NULL', 'textarea', '', '', '1', '', '88', '0', '1', '1424612509', '1424612509', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('797', 'create_time', '申请时间', 'int(10) NULL', 'datetime', '', '', '1', '', '88', '0', '1', '1424612542', '1424612542', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('798', 'checked_time', '入库时间', 'int(10) NULL', 'datetime', '', '', '1', '', '88', '0', '1', '1424612571', '1424612571', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('799', 'source', '来源', 'varchar(50) NULL', 'string', '', '', '1', '', '88', '0', '1', '1424836818', '1424836818', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('800', 'source_id', '来源ID', 'int(10) NULL', 'num', '', '', '1', '', '88', '0', '1', '1424836842', '1424836842', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('801', 'wechat_id', '微信端的素材ID', 'int(10) NULL', 'num', '', '', '0', '', '88', '0', '1', '1425370605', '1425370605', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('802', 'uid', '管理员id', 'int(10) NULL', 'num', '', '', '1', '', '89', '0', '1', '1431575588', '1431575588', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('803', 'token', '用户token', 'varchar(255) NULL', 'string', '', '', '1', '', '89', '0', '1', '1431575617', '1431575617', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('804', 'addons', '插件名称', 'varchar(255) NULL', 'string', '', '', '1', '', '89', '0', '1', '1431590322', '1431575667', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('805', 'template', '模版名称', 'varchar(255) NULL', 'string', '', '', '1', '', '89', '0', '1', '1431575691', '1431575691', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('832', 'title', '公告标题', 'varchar(255) NULL', 'string', '', '', '1', '', '93', '1', '1', '1431143985', '1431143985', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('833', 'content', '公告内容', 'text  NULL', 'editor', '', '', '1', '', '93', '1', '1', '1431144020', '1431144020', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('834', 'create_time', '发布时间', 'int(10) NULL', 'datetime', '', '', '4', '', '93', '0', '1', '1431146373', '1431144069', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('835', 'version', '版本号', 'int(10) unsigned NOT NULL ', 'num', '', '', '1', '', '94', '1', '1', '1393770457', '1393770457', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('836', 'title', '升级包名', 'varchar(50) NOT NULL', 'string', '', '', '1', '', '94', '1', '1', '1393770499', '1393770499', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('837', 'description', '描述', 'text NULL', 'textarea', '', '', '1', '', '94', '0', '1', '1393770546', '1393770546', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('838', 'create_date', '创建时间', 'int(10) NULL', 'datetime', '', '', '1', '', '94', '0', '1', '1393770591', '1393770591', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('839', 'download_count', '下载统计', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '94', '0', '1', '1393770659', '1393770659', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('840', 'package', '升级包地址', 'varchar(255) NOT NULL', 'textarea', '', '', '1', '', '94', '1', '1', '1393812247', '1393770727', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11980', 'template', '素材模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1221', '0', '1', '1431659474', '1431659474', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11979', 'background', '背景图', 'int(10) UNSIGNED NULL', 'picture', '', '图片尺寸建议是760X421 并且主要内容要居中并留出大转盘位置', '1', '', '1221', '0', '1', '1419997464', '1419997464', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11977', 'start_date', '开始时间', 'int(10) NULL ', 'datetime', '', '', '1', '', '1221', '0', '1', '1395395676', '1395395179', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11978', 'experience', '消耗经验值', 'int(10) NULL', 'num', '0', '', '1', '', '1221', '0', '1', '1419299966', '1419299966', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11976', 'keyword', '关键词', 'varchar(255) NULL ', 'string', '', '用户发送 “关键词” 触发', '1', '', '1221', '0', '1', '1395395713', '1395395179', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11975', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1221', '0', '1', '1395396571', '1395396571', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11974', 'des_jj', '活动介绍', 'text NULL ', 'textarea', '', '活动介绍简介 用于给用户发送消息时候的图文描述', '1', '', '1221', '0', '1', '1431068323', '1395395179', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11973', 'des', '活动介绍', 'text NULL ', 'textarea', '', '', '0', '', '1221', '0', '1', '1431068356', '1395395179', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11972', 'choujnum', '每日抽奖次数', 'int(10) unsigned NULL ', 'num', '0', '', '1', '', '1221', '0', '1', '1395395485', '1395395179', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11971', 'guiz', '活动规则', 'text NULL ', 'textarea', '', '', '1', '', '1221', '0', '1', '1418369751', '1395395179', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11970', 'title', '活动标题', 'varchar(255) NULL ', 'string', '', '', '1', '', '1221', '0', '1', '1395395535', '1395395179', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11969', 'picurl', '封面图片', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '1221', '1', '1', '1439370422', '1395395179', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11968', 'states', '活动状态', 'char(10) NULL ', 'radio', '0', '', '0', '0:未开始\r\n1:已结束', '1221', '0', '1', '1395395602', '1395395179', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11967', 'cTime', '活动创建时间', 'int(10) NULL ', 'datetime', '', '', '0', '', '1221', '0', '1', '1395395963', '1395395179', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11966', 'end_date', '结束日期', 'int(10) NULL ', 'datetime', '', '', '1', '', '1221', '0', '1', '1395395670', '1395395179', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11965', 'template', '素材模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1220', '0', '1', '1430132994', '1430132994', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11964', 'prize_title', '活动标题', 'varchar(255) NULL', 'string', '', '', '1', '', '1220', '1', '1', '1429855569', '1429855569', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11963', 'use_content', '使用说明', 'text NULL', 'textarea', '', '用户领取成功后才会看到', '1', '', '1220', '1', '1', '1429757185', '1429757185', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11960', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1220', '0', '1', '1429521039', '1429521039', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11961', 'fail_content', '领取失败提示', 'text NULL', 'textarea', '', '用户领取失败，或者没有领取到时看到的提示', '1', '', '1220', '1', '1', '1429860149', '1429860149', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11962', 'prize_type', '奖品类型', 'tinyint(2) NULL', 'radio', '1', '选择奖品类型', '1', '1:实物\r\n0:虚拟', '1220', '1', '1', '1429756998', '1429756539', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('896', 'ToUserName', 'Token', 'varchar(100) NULL', 'string', '', '', '0', '', '103', '0', '1', '1438143065', '1438143065', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('897', 'FromUserName', 'OpenID', 'varchar(100) NULL', 'string', '', '', '0', '', '103', '0', '1', '1438143098', '1438143098', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('898', 'CreateTime', '创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '103', '0', '1', '1438143120', '1438143120', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('899', 'MsgType', '消息类型', 'varchar(30) NULL', 'string', '', '', '0', '', '103', '0', '1', '1438143139', '1438143139', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('900', 'MsgId', '消息ID', 'varchar(100) NULL', 'string', '', '', '0', '', '103', '0', '1', '1438143182', '1438143182', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('901', 'Content', '文本消息内容', 'text NULL', 'textarea', '', '', '0', '', '103', '0', '1', '1438143218', '1438143218', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('902', 'PicUrl', '图片链接', 'varchar(255) NULL', 'string', '', '', '0', '', '103', '0', '1', '1438143273', '1438143273', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('903', 'MediaId', '多媒体文件ID', 'varchar(100) NULL', 'string', '', '', '0', '', '103', '0', '1', '1438143357', '1438143357', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('904', 'Format', '语音格式', 'varchar(30) NULL', 'string', '', '', '0', '', '103', '0', '1', '1438143397', '1438143397', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('905', 'ThumbMediaId', '缩略图的媒体id', 'varchar(30) NULL', 'string', '', '', '0', '', '103', '0', '1', '1438143445', '1438143426', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('906', 'Title', '消息标题', 'varchar(100) NULL', 'string', '', '', '0', '', '103', '0', '1', '1438143471', '1438143471', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('907', 'Description', '消息描述', 'text NULL', 'textarea', '', '', '0', '', '103', '0', '1', '1438143535', '1438143535', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('908', 'Url', 'Url', 'varchar(255) NULL', 'string', '', '', '0', '', '103', '0', '1', '1438143558', '1438143558', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('909', 'collect', '收藏状态', 'tinyint(1) NULL', 'bool', '0', '', '0', '0:未收藏\r\n1:已收藏', '103', '0', '1', '1438153936', '1438153936', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('910', 'deal', '处理状态', 'tinyint(1) NULL', 'bool', '0', '', '0', '0:未处理\r\n1:已处理', '103', '0', '1', '1438165005', '1438153991', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('911', 'is_read', '是否已读', 'tinyint(1) NULL', 'bool', '0', '', '1', '0:未读\r\n1:已读', '103', '0', '1', '1438165062', '1438165062', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('912', 'type', '消息分类', 'tinyint(1) NULL', 'bool', '0', '', '1', '0:用户消息\r\n1:管理员回复消息', '103', '0', '1', '1438168301', '1438168301', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12002', 'num', '库存数量', 'int(10) unsigned NULL ', 'num', '0', '', '1', '', '1224', '0', '1', '1396667941', '1395395190', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('12001', 'miaoshu', '奖品描述', 'text NULL ', 'textarea', '', '', '1', '', '1224', '0', '1', '1418628021', '1395395190', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('12000', 'pic', '奖品图片', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '1224', '0', '1', '1395495279', '1395395190', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('12008', 'uid', '用户id', 'varchar(255) NULL', 'string', '', '用户id', '0', '', '1225', '0', '1', '1395567404', '1395567404', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11998', 'duijma', '兑奖码', 'text NULL', 'textarea', '', '请输入兑奖码，一行一个', '0', '', '1224', '0', '1', '1419300292', '1396253842', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11999', 'title', '奖品名称', 'varchar(255) NULL ', 'string', '', '', '1', '', '1224', '0', '1', '1395495283', '1395395190', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('1062', 'login_name', 'login_name', 'varchar(100) NULL', 'string', '', '', '1', '', '1', '0', '1', '1447302647', '1439978705', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1063', 'content', '文本消息内容', 'text NULL', 'textarea', '', '', '0', '', '18', '0', '1', '1439980070', '1439980070', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11986', 'gailv_maxnum', '单日发放上限', 'int(10) UNSIGNED NULL', 'num', '0', '每天最多发放奖品的数量', '1', '', '1222', '0', '1', '1395559281', '1395559281', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11987', 'xydzp_option_id', '幸运大转盘关联的全局奖品id', 'int(10) UNSIGNED NULL', 'num', '', '幸运大转盘关联的全局奖品id', '0', '', '1222', '0', '1', '1395555085', '1395555085', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11988', 'uid', '用户openid', 'varchar(255) NULL', 'string', '', '', '0', '', '1223', '0', '1', '1396686415', '1396686415', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11989', 'message', '留言', 'text NULL ', 'string', '', '', '1', '', '1223', '0', '1', '1395395200', '1395395200', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11990', 'address', '收件地址', 'text NULL ', 'string', '', '', '1', '', '1223', '0', '1', '1395395200', '1395395200', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('1071', 'is_bind', '是否为微信开放平台绑定账号', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:否\r\n1:是', '6', '0', '1', '1440746890', '1440746890', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11984', 'jlnum', '奖励数量', 'int(10) UNSIGNED NULL', 'num', '1', '中奖后，获得该奖品的数量', '0', '', '1222', '0', '1', '1419303776', '1395559386', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11985', 'type', '奖品中奖方式', 'char(50) NULL', 'select', '0', '选择奖品中奖的方式', '0', '0:按概率中奖\r\n1:按时间中奖(未启用)\r\n2:按顺序中奖(未启用)\r\n3:按指定用户id中奖(未启用)', '1222', '0', '1', '1419303723', '1395559102', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11983', 'xydzp_id', '幸运大转盘关联的活动id', 'int(10) UNSIGNED NULL', 'num', '0', '幸运大转盘关联的活动id', '0', '', '1222', '0', '1', '1395555019', '1395555019', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11878', 'cover', '封面图片', 'int(10) unsigned NULL ', 'picture', '', '可为空', '1', '', '1210', '0', '1', '1399710705', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11877', 'end_time', '结束时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1210', '0', '1', '1399259433', '1399259433', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11876', 'intro', '封面简介', 'text NULL', 'editor', '', '', '1', '', '1210', '0', '1', '1420983308', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11875', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1210', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11869', 'num', '名额数量', 'int(10) unsigned NULL ', 'num', '', '', '1', '', '1209', '1', '1', '1439370137', '1399348843', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11870', 'sort', '排序号', 'int(10) unsigned NULL ', 'num', '0', '值越小越靠前', '1', '', '1209', '0', '1', '1399557716', '1399557716', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11871', 'img', '奖品图片', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '1209', '0', '1', '1399557997', '1399557997', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11872', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1209', '0', '1', '1404525428', '1404525428', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11873', 'keyword', '关键词', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1210', '1', '1', '1396624337', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11874', 'use_tips', '使用说明', 'varchar(255) NOT NULL', 'textarea', '', '用户获取刮刮卡后显示的提示信息', '1', '', '1210', '1', '1', '1420989679', '1399259489', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1101', 'url', '图文页url', 'varchar(255) NULL', 'string', '', '', '0', '', '17', '0', '1', '1441077355', '1441077355', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11991', 'iphone', '电话', 'varchar(255) NULL ', 'string', '', '', '1', '', '1223', '0', '1', '1395395200', '1395395200', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11992', 'zip', '邮编', 'int(10) unsigned NULL ', 'string', '', '', '1', '', '1223', '0', '1', '1395395200', '1395395200', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11993', 'state', '领奖状态', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:未领取\r\n1:已领取', '1223', '0', '1', '1396705093', '1395395200', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11994', 'xydzp_option_id', '奖品id', 'int(10) unsigned NULL ', 'string', '0', '', '1', '', '1223', '0', '1', '1395395200', '1395395200', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11995', 'xydzp_id', '活动id', 'int(10) unsigned NULL ', 'string', '0', '', '1', '', '1223', '0', '1', '1395395200', '1395395200', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11996', 'zjdate', '中奖时间', 'int(10) UNSIGNED NULL', 'num', '', '', '0', '', '1223', '0', '1', '1396191999', '1396191999', '', '3', '', 'regex', 'time()', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11997', 'jptype', '奖品类型', 'char(10) NULL ', 'select', '0', '奖品的类型', '1', '0:经验值|coupon_id@hide,experience@show,num@show,card_url@hide\r\n1:优惠券|coupon_id@show,experience@hide,num@show,card_url@hide\r\n2:谢谢参与|coupon_id@hide,experience@hide,num@hide,card_url@hide\r\n3:微信卡券|coupon_id@hide,experience@hide,num@show,card_url@show', '1224', '0', '1', '1420207419', '1395395190', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1825', 'ToUserName', 'token', 'varchar(255) NULL', 'string', '', '', '1', '', '201', '0', '1', '1447241964', '1447241964', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1826', 'FromUserName', 'openid', 'varchar(255) NULL', 'string', '', '', '1', '', '201', '0', '1', '1447242006', '1447242006', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1827', 'cTime', '创建时间', 'int(10) NULL', 'datetime', '', '', '1', '', '201', '0', '1', '1447242030', '1447242030', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1828', 'msgType', '消息类型', 'varchar(255) NULL', 'string', '', '', '1', '', '201', '0', '1', '1447242059', '1447242059', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1829', 'manager_id', '管理员id', 'int(10) NULL', 'num', '', '', '1', '', '201', '0', '1', '1447242090', '1447242090', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1830', 'content', '内容', 'text NULL', 'textarea', '', '', '1', '', '201', '0', '1', '1447242120', '1447242120', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1831', 'media_id', '多媒体文件id', 'varchar(255) NULL', 'string', '', '', '1', '', '201', '0', '1', '1447242146', '1447242146', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1832', 'is_send', '是否已经发送', 'int(10) NULL', 'num', '', '', '1', '0:未发\r\n1:已发', '201', '0', '1', '1447242181', '1447242181', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1833', 'uid', '粉丝uid', 'int(10) NULL', 'num', '', '', '1', '', '201', '0', '1', '1447242202', '1447242202', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1834', 'news_group_id', '图文组id', 'varchar(255) NULL', 'string', '', '', '1', '', '201', '0', '1', '1447242229', '1447242229', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1835', 'video_title', '视频标题', 'varchar(255) NULL', 'string', '', '', '1', '', '201', '0', '1', '1447242267', '1447242267', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1836', 'video_description', '视频描述', 'text NULL', 'textarea', '', '', '1', '', '201', '0', '1', '1447242291', '1447242291', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1837', 'video_thumb', '视频缩略图', 'varchar(255) NULL', 'string', '', '', '1', '', '201', '0', '1', '1447242366', '1447242366', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1844', 'voice_id', '语音id', 'int(10) NULL', 'num', '', '', '1', '', '201', '0', '1', '1447242400', '1447242400', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1845', 'image_id', '图片id', 'int(10) NULL', 'num', '', '', '1', '', '201', '0', '1', '1447242440', '1447242440', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1846', 'video_id', '视频id', 'int(10) NULL', 'num', '', '', '1', '', '201', '0', '1', '1447242464', '1447242464', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1847', 'send_type', '发送方式', 'int(10) NULL', 'num', '', '', '1', '0:分组\r\n1:指定用户', '201', '0', '1', '1447242498', '1447242498', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1848', 'send_opends', '指定用户', 'text NULL', 'textarea', '', '', '1', '', '201', '0', '1', '1447242529', '1447242529', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1849', 'group_id', '分组id', 'int(10) NULL', 'num', '', '', '1', '', '201', '0', '1', '1447242553', '1447242553', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1850', 'diff', '区分消息标识', 'int(10) NULL', 'num', '0', '', '1', '', '201', '0', '1', '1447242584', '1447242584', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1326', 'content', '文本内容', 'text NULL', 'textarea', '', '', '1', '', '148', '1', '1', '1442976151', '1442976151', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1327', 'token', 'Token', 'varchar(50) NULL', 'string', '', '', '0', '', '148', '0', '1', '1442978004', '1442978004', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('1328', 'uid', 'uid', 'int(10) NULL', 'num', '', '', '0', '', '148', '0', '1', '1442978041', '1442978041', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('1820', 'is_use', '可否使用', 'int(10) NULL', 'num', '1', '', '0', '0:不可用\r\n1:可用', '148', '0', '1', '1445496947', '1445496947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1821', 'aim_id', '添加来源标识id', 'int(10) NULL', 'num', '', '', '0', '', '148', '0', '1', '1445497010', '1445497010', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1822', 'aim_table', '来源表名', 'varchar(255) NULL', 'string', '', '', '0', '', '148', '0', '1', '1445497218', '1445497218', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1329', 'file_id', '上传文件', 'int(10) NULL', 'file', '', '', '1', '', '149', '0', '1', '1442982169', '1438684652', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1330', 'cover_url', '本地URL', 'varchar(255) NULL', 'string', '', '', '0', '', '149', '0', '1', '1438684692', '1438684692', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1331', 'media_id', '微信端图文消息素材的media_id', 'varchar(100) NULL', 'string', '0', '', '0', '', '149', '0', '1', '1438744962', '1438684776', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1332', 'wechat_url', '微信端的文件地址', 'varchar(255) NULL', 'string', '', '', '0', '', '149', '0', '1', '1439973558', '1438684807', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1333', 'cTime', '创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '149', '0', '1', '1443004484', '1438684829', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('1334', 'manager_id', '管理员ID', 'int(10) NULL', 'num', '', '', '0', '', '149', '0', '1', '1442982446', '1438684847', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('1335', 'token', 'Token', 'varchar(100) NULL', 'string', '', '', '0', '', '149', '0', '1', '1442982460', '1438684865', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('1336', 'title', '素材名称', 'varchar(100) NULL', 'string', '', '', '1', '', '149', '0', '1', '1442981165', '1442981165', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1341', 'type', '类型', 'int(10) NULL', 'num', '', '', '0', '1:语音素材\r\n2:视频素材', '149', '0', '1', '1445599238', '1443006101', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1838', 'introduction', '描述', 'text NULL', 'textarea', '', '', '0', '', '149', '0', '1', '1447299133', '1445684769', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1121', 'level', '管理等级', 'tinyint(2) NULL', 'num', '0', '', '0', '', '1', '0', '1', '1441522953', '1441522953', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12007', 'card_url', '领取卡券的地址', 'varchar(255) NULL', 'string', '', '', '1', '', '1224', '0', '1', '1420207297', '1420207297', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12009', 'xydzp_id', '幸运大转盘关联的活动id', 'int(10) UNSIGNED NULL', 'num', '', '幸运大转盘关联的活动id', '0', '', '1225', '0', '1', '1395567452', '1395567452', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12010', 'num', '已经抽奖的次数', 'int(10) UNSIGNED NULL', 'num', '0', '', '1', '', '1225', '0', '1', '1395567486', '1395567486', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12011', 'cjdate', '抽奖日期', 'int(10) NULL', 'datetime', '', '', '1', '', '1225', '0', '1', '1395567537', '1395567537', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12012', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1226', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12013', 'cTime', '发布时间', 'int(10) UNSIGNED NULL', 'datetime', '', '', '0', '', '1226', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12014', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1226', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12015', 'password', '微预约密码', 'varchar(255) NULL', 'string', '', '如要用户输入密码才能进入微预约，则填写此项。否则留空，用户可直接进入微预约', '0', '', '1226', '0', '1', '1396871497', '1396672643', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12016', 'jump_url', '提交后跳转的地址', 'varchar(255) NULL', 'string', '', '要以http://开头的完整地址，为空时不跳转', '1', '', '1226', '0', '1', '1402458121', '1399800276', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12017', 'content', '详细介绍', 'text NULL', 'editor', '', '可不填', '1', '', '1226', '0', '1', '1396865295', '1396865295', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12018', 'finish_tip', '用户提交后提示内容', 'text NULL', 'textarea', '', '为空默认为：提交成功，谢谢参与', '1', '', '1226', '0', '1', '1396676366', '1396673689', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12019', 'can_edit', '是否允许编辑', 'tinyint(2) NULL', 'bool', '0', '用户提交预约是否可以再编辑', '1', '0:不允许\r\n1:允许', '1226', '0', '1', '1396688624', '1396688624', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11744', 'cover', '封面图片', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '1193', '1', '1', '1439368240', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11743', 'mTime', '修改时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1193', '0', '1', '1396624664', '1396624664', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11742', 'intro', '封面简介', 'text NULL', 'textarea', '', '', '1', '', '1193', '0', '1', '1396624505', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11741', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1193', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11739', 'keyword', '关键词', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1193', '1', '1', '1396624337', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11740', 'keyword_type', '关键词类型', 'tinyint(2) NOT NULL', 'select', '0', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配\r\n4:正则匹配\r\n5:随机匹配', '1193', '1', '1', '1396624426', '1396061765', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11982', 'gailv_str', '参数', 'varchar(255) NULL', 'string', '', '请输入对应中奖方式的相应值 多个以英文状态下的 逗号(,)分隔', '0', '', '1222', '0', '1', '1419303819', '1395559219', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11981', 'gailv', '中奖概率', 'int(10) UNSIGNED NULL', 'num', '0', '请输入0-100之间的整数', '1', '', '1222', '0', '1', '1419303857', '1395559151', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1112', 'login_password', '登录密码', 'varchar(255) NULL', 'string', '', '', '1', '', '1', '0', '1', '1441187439', '1441187439', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1114', 'manager_id', '公众号管理员ID', 'int(10) NULL', 'num', '0', '', '0', '', '1', '0', '1', '1441512815', '1441512815', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12005', 'coupon_id', '优惠券编号', 'int(10) NULL', 'num', '', '', '1', '', '1224', '0', '1', '1419300336', '1419300336', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12006', 'experience', '奖励经验值', 'int(10) NULL', 'num', '0', '', '1', '', '1224', '0', '1', '1419300396', '1419300396', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12004', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1224', '0', '1', '1395554191', '1395554191', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12003', 'isdf', '是否为谢谢惠顾类', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:中奖品\r\n1:该奖为谢谢惠顾类', '1224', '0', '1', '1419392345', '1396191564', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11867', 'title', '奖项标题', 'varchar(255) NULL', 'string', '', '如特等奖、一等奖。。。', '1', '', '1209', '1', '1', '1439370111', '1399348734', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11868', 'name', '奖项', 'varchar(255) NULL', 'string', '', '如iphone、吹风机等', '1', '', '1209', '1', '1', '1439370125', '1399348785', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11757', 'survey_id', 'survey_id', 'int(10) unsigned NOT NULL ', 'num', '', '', '4', '', '1194', '1', '1', '1396955403', '1396955369', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11753', 'uid', '用户UID', 'int(10) NULL ', 'num', '', '', '0', '', '1194', '0', '1', '1396955530', '1396955530', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11754', 'question_id', 'question_id', 'int(10) unsigned NOT NULL ', 'num', '', '', '4', '', '1194', '1', '1', '1396955412', '1396955392', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11755', 'cTime', '发布时间', 'int(10) unsigned NULL ', 'datetime', '', '', '0', '', '1194', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11756', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1194', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11745', 'cTime', '发布时间', 'int(10) unsigned NULL ', 'datetime', '', '', '0', '', '1193', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11746', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1193', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11747', 'finish_tip', '结束语', 'text NULL', 'string', '', '为空默认为：调研完成，谢谢参与', '1', '', '1193', '0', '1', '1447640072', '1396953940', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11748', 'template', '素材模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1193', '0', '1', '1430193696', '1430193696', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11749', 'start_time', '开始时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1193', '1', '1', '1440408604', '1440407931', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11750', 'end_time', '结束时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1193', '1', '1', '1440408598', '1440407951', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11751', 'answer', '回答内容', 'text NULL', 'textarea', '', '', '0', '', '1194', '0', '1', '1396955766', '1396955766', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11752', 'openid', 'OpenId', 'varchar(255) NULL', 'string', '', '', '0', '', '1194', '0', '1', '1396955581', '1396955581', '', '3', '', 'regex', 'get_openid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('1155', 'membership', '会员等级', 'char(50) NULL', 'select', '0', '请在会员等级 添加会员级别名称', '0', '', '1', '0', '1', '1447302405', '1441795509', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11758', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1195', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11759', 'intro', '问题描述', 'text NULL', 'textarea', '', '', '1', '', '1195', '0', '1', '1396954176', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11760', 'cTime', '发布时间', 'int(10) unsigned NULL ', 'datetime', '', '', '0', '', '1195', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11761', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1195', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11762', 'is_must', '是否必填', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:否\r\n1:是', '1195', '0', '1', '1396954649', '1396954649', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11763', 'extra', '参数', 'text NULL', 'textarea', '', '类型为单选、多选时的定义数据，格式见上面的提示', '1', '', '1195', '0', '1', '1396954558', '1396954558', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11764', 'type', '问题类型', 'char(50) NOT NULL', 'radio', 'radio', '', '1', 'radio:单选题\r\ncheckbox:多选题\r\ntextarea:简答题', '1195', '1', '1', '1396962517', '1396954463', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11765', 'survey_id', 'survey_id', 'int(10) unsigned NOT NULL ', 'num', '', '', '4', '', '1195', '1', '1', '1396954240', '1396954240', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11766', 'sort', '排序号', 'int(10) unsigned NULL ', 'num', '0', '值越小越靠前', '1', '', '1195', '0', '1', '1396955010', '1396955010', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12155', 'cTime', '发布时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1240', '0', '1', '1396075102', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12154', 'content', '内容', 'text NULL', 'editor', '', '', '1', '', '1240', '1', '1', '1449159114', '1396062146', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12164', 'invite_uid', '邀请人ID', 'int(10) NULL', 'num', '', '', '0', '', '1241', '0', '1', '1449488835', '1449488835', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12153', 'cover', '封面图片', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '1240', '1', '1', '1449159084', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12163', 'invite_code', '邀请码', 'varchar(50) NULL', 'string', '', '', '0', '', '1', '0', '1', '1449488369', '1449488360', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12152', 'cate_id', '所属类别', 'int(10) unsigned NULL ', 'select', '0', '', '1', '0:请选择分类', '1240', '1', '1', '1449159104', '1396062003', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12151', 'intro', '简介', 'text NULL', 'textarea', '', '', '1', '', '1240', '1', '1', '1449159093', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12146', 'sort', '排序号', 'int(10) NULL ', 'num', '0', '数值越小越靠前', '1', '', '1239', '0', '1', '1396340334', '1396340334', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12144', 'is_show', '显示', 'tinyint(2) NULL', 'bool', '1', '', '1', '0:不显示\r\n1:显示', '1239', '0', '1', '1449157379', '1395989709', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12145', 'token', 'Token', 'varchar(100) NULL ', 'string', '', '', '0', '', '1239', '0', '1', '1395989760', '1395989760', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12166', 'cTime', '邀请时间', 'int(10) NULL', 'num', '', '', '0', '', '1241', '0', '1', '1449488893', '1449488893', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12141', 'title', '分类标题', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1239', '1', '1', '1408950771', '1395988016', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12150', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1240', '1', '1', '1449158905', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12140', 'token', 'Token', 'varchar(100) NULL', 'string', '', '', '0', '', '1238', '0', '1', '1396098747', '1396098747', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12139', 'sort', '排序', 'int(10) unsigned NULL ', 'num', '0', '值越小越靠前', '1', '', '1238', '0', '1', '1396098682', '1396098682', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12135', 'title', '标题', 'varchar(255) NULL', 'string', '', '可为空', '0', '', '1238', '0', '1', '1449201375', '1396098316', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12136', 'img', '图片', 'int(10) unsigned NOT NULL ', 'picture', '', '', '1', '', '1238', '1', '1', '1396098349', '1396098349', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12137', 'url', '链接地址', 'varchar(255) NULL', 'string', '', '', '1', '', '1238', '0', '1', '1396098380', '1396098380', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12138', 'is_show', '是否显示', 'tinyint(2) NULL', 'bool', '1', '', '1', '0:不显示\r\n1:显示', '1238', '0', '1', '1396098464', '1396098464', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12175', 'type', '自动回复类型', 'char(10) NULL', 'radio', '1', '', '1', '1:文本\r\n2:图片\r\n3:图文', '1213', '0', '1', '1453276470', '1453276458', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12174', 'msg_test', '素材文本', 'varchar(255) NULL', 'string', '', '', '1', '', '1213', '0', '1', '1453276355', '1453276355', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12173', 'image_id', '素材图片', 'int(10) NULL', 'num', '', '', '4', '', '1213', '0', '1', '1453285277', '1453276179', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12172', 'appmsg_id', '图文素材', 'int(10) NULL', 'num', '', '', '4', '', '1213', '0', '1', '1453276143', '1453275668', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12171', 'cate_id', '分类', 'varchar(255) NULL', 'cascade', '', '', '1', 'table=paiqian_category', '1242', '0', '1', '1449996279', '1449996100', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12168', 'uid', 'UID', 'int(10) NULL', 'num', '', '', '0', '', '1242', '0', '1', '1449993194', '1449993194', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12169', 'img', '图片', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1242', '0', '1', '1449993249', '1449993249', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12170', 'content', '内容', 'text  NULL', 'editor', '', '', '1', '', '1242', '0', '1', '1449993271', '1449993271', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12167', 'title', '标题', 'varchar(255) NULL', 'string', '', '这个需要', '1', '', '1242', '1', '1', '1449993155', '1449993155', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12162', 'is_top', '置顶', 'tinyint(2) NULL', 'bool', '0', '置顶后会在资讯列表中显示在最上面', '1', '0:不置顶\r\n1:置顶', '1240', '0', '1', '1449158589', '1449158589', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12161', 'is_index', '首页显示', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:不显示\r\n1:显示', '1240', '0', '1', '1449158403', '1449158403', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12160', 'author', '作者', 'varchar(50) NULL', 'string', '', '为空时取当前用户名', '1', '', '1240', '0', '1', '1437988055', '1437988055', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12159', 'jump_url', '外链', 'varchar(255) NULL', 'string', '', '如需跳转填写网址(记住必须有http://)如果填写了图文详细内容，这里请留空，不要设置！', '1', '', '1240', '0', '1', '1402482073', '1402482073', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12158', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1240', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('12157', 'view_count', '浏览数', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '1240', '0', '1', '1396510630', '1396510630', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('12165', 'uid', '被邀请人ID', 'int(10) NULL', 'num', '', '', '0', '', '1241', '0', '1', '1449488868', '1449488868', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11849', 'send_name', '发送人', 'varchar(255) NULL', 'string', '', '', '1', '', '1206', '1', '1', '1429346507', '1429346507', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11850', 'receive_name', '接收人', 'varchar(255) NULL', 'string', '', '', '1', '', '1206', '1', '1', '1429346556', '1429346556', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11851', 'content', '祝福语', 'text NULL', 'textarea', '', '', '1', '', '1206', '1', '1', '1429346679', '1429346679', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11852', 'create_time', ' 创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1206', '0', '1', '1429604045', '1429346729', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11853', 'template', '模板', 'char(50) NULL', 'string', '', '模板的文件夹名称，不能为中文', '1', '', '1206', '1', '1', '1429348371', '1429346979', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11854', 'template_cate', '模板分类', 'varchar(255) NULL', 'string', '', '', '4', '', '1206', '1', '1', '1429348355', '1429347540', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11855', 'read_count', '浏览次数', 'int(10) NULL', 'num', '0', '', '0', '', '1206', '0', '1', '1429348951', '1429348951', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11856', 'mid', '用户Id', 'varchar(255) NULL', 'num', '', '', '0', '', '1206', '0', '1', '1429673299', '1429512603', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11857', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1206', '0', '1', '1429764969', '1429764969', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11858', 'content_cate_id', '祝福语类别Id', 'int(10) NULL', 'num', '0', '', '4', '', '1207', '1', '1', '1429349347', '1429349074', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11859', 'content', '祝福语', 'text NULL', 'textarea', '', '', '1', '', '1207', '1', '1', '1429349162', '1429349162', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11860', 'content_cate', '类别', 'varchar(255) NULL', 'select', '', '', '1', '', '1207', '0', '1', '1429522282', '1429350568', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11861', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1207', '0', '1', '1429523422', '1429512730', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11862', 'content_cate_name', '祝福语类别', 'varchar(255) NULL', 'string', '', '', '1', '', '1208', '1', '1', '1429349396', '1429349396', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11863', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1208', '0', '1', '1429520955', '1429512697', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11864', 'content_cate_icon', '类别图标', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1208', '0', '1', '1429597855', '1429597855', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11865', 'addon', '来源插件', 'varchar(255) NULL', 'string', 'Scratch', '', '0', '', '1209', '0', '1', '1399348676', '1399348676', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11866', 'target_id', '来源ID', 'int(10) unsigned NULL ', '', '', '', '1', '', '1209', '0', '1', '1420980352', '1399348699', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11738', 'plat_type', '平台标识', 'int(10) NULL', 'num', '', '', '1', '', '1192', '0', '1', '1446110716', '1446110716', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11737', 'status', '使用状态', 'int(10) NULL', 'num', '', '', '1', '', '1192', '0', '1', '1446110690', '1446110690', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11715', 'title', '题目标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1190', '1', '1', '1397037377', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11716', 'intro', '题目描述', 'text NOT NULL', 'textarea', '', '', '1', '', '1190', '0', '1', '1396954176', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11717', 'cTime', '发布时间', 'int(10) UNSIGNED NOT NULL', 'datetime', '', '', '0', '', '1190', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11718', 'token', 'Token', 'varchar(255) NOT NULL', 'string', '', '', '0', '', '1190', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11719', 'is_must', '是否必填', 'tinyint(2) NOT NULL', 'bool', '1', '', '0', '0:否\r\n1:是', '1190', '0', '1', '1397035513', '1396954649', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11720', 'extra', '参数', 'text NOT NULL', 'textarea', '', '输入格式见上面的提示', '1', '', '1190', '0', '1', '1397142592', '1396954558', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11721', 'type', '题目类型', 'char(50) NOT NULL', 'radio', 'radio', '', '0', 'radio:单选题', '1190', '1', '1', '1397142548', '1396954463', '', '3', '', 'regex', 'radio', '1', 'string');
INSERT INTO `wx_attribute` VALUES ('11722', 'test_id', 'test_id', 'int(10) UNSIGNED NOT NULL', 'num', '', '', '4', '', '1190', '1', '1', '1396954240', '1396954240', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11723', 'sort', '排序号', 'int(10) UNSIGNED NOT NULL', 'num', '0', '值越小越靠前', '1', '', '1190', '0', '1', '1396955010', '1396955010', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11724', 'answer', '回答内容', 'text NOT NULL', 'textarea', '', '', '0', '', '1191', '0', '1', '1396955766', '1396955766', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11725', 'openid', 'OpenId', 'varchar(255) NOT NULL', 'string', '', '', '0', '', '1191', '0', '1', '1396955581', '1396955581', '', '3', '', 'regex', 'get_openid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11726', 'uid', '用户UID', 'int(10) NOT NULL', 'num', '', '', '0', '', '1191', '0', '1', '1396955530', '1396955530', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11727', 'question_id', 'question_id', 'int(10) UNSIGNED NOT NULL', 'num', '', '', '4', '', '1191', '1', '1', '1396955412', '1396955392', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11728', 'cTime', '发布时间', 'int(10) UNSIGNED NOT NULL', 'datetime', '', '', '0', '', '1191', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11729', 'token', 'Token', 'varchar(255) NOT NULL', 'string', '', '', '0', '', '1191', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11730', 'test_id', 'test_id', 'int(10) UNSIGNED NOT NULL', 'num', '', '', '4', '', '1191', '1', '1', '1396955403', '1396955369', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11731', 'score', '得分', 'int(10) UNSIGNED NOT NULL', 'num', '0', '', '0', '', '1191', '0', '1', '1397040133', '1397040133', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11732', 'from_type', '用途', 'varchar(255) NULL', 'string', '', '', '1', '', '1192', '0', '1', '1446107717', '1446107717', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11733', 'code', '验证码', 'varchar(255) NULL', 'string', '', '', '1', '', '1192', '0', '1', '1446110095', '1446110095', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11734', 'smsId', '短信唯一标识', 'varchar(255) NULL', 'string', '', '', '1', '', '1192', '0', '1', '1446110244', '1446110244', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11735', 'phone', '手机号', 'varchar(255) NULL', 'string', '', '', '1', '', '1192', '0', '1', '1446110276', '1446110276', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11736', 'cTime', '创建时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1192', '0', '1', '1446110405', '1446110405', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11287', 'keyword_type', '关键词类型', 'tinyint(2) NULL', 'select', '0', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配\r\n4:正则匹配\r\n5:随机匹配', '1145', '0', '1', '1396623302', '1396578249', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11286', 'keyword', '关键词', 'varchar(255) NULL', 'string', '', '多个关键词请用空格分开：例如: 高 富 帅', '1', '', '1145', '0', '1', '1396578460', '1396578212', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11285', 'author', '作者', 'varchar(50) NULL', 'string', '', '为空时取当前用户名', '1', '', '1144', '0', '1', '1437988055', '1437988055', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11284', 'jump_url', '外链', 'varchar(255) NULL', 'string', '', '如需跳转填写网址(记住必须有http://)如果填写了图文详细内容，这里请留空，不要设置！', '1', '', '1144', '0', '1', '1402482073', '1402482073', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11283', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1144', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11282', 'view_count', '浏览数', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '1144', '0', '1', '1396510630', '1396510630', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11281', 'sort', '排序号', 'int(10) unsigned NULL ', 'num', '0', '数值越小越靠前', '1', '', '1144', '0', '1', '1396510508', '1396510508', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11280', 'cTime', '发布时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1144', '0', '1', '1396075102', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11279', 'content', '内容', 'text NULL', 'editor', '', '', '1', '', '1144', '0', '1', '1396062146', '1396062146', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11278', 'cover', '封面图片', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '1144', '0', '1', '1396062093', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11277', 'cate_id', '所属类别', 'int(10) unsigned NULL ', 'select', '0', '要先在微官网分类里配置好分类才可选择', '1', '0:请选择分类', '1144', '0', '1', '1396078914', '1396062003', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11268', 'jump_type', '推送类型', 'char(10) NULL', 'radio', '0', '', '1', '1:URL|keyword@hide,url@show\r\n0:关键词|keyword@show,url@hide', '1142', '0', '1', '1447208981', '1447208981', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11267', 'sucai_type', '素材类型', 'char(50) NULL', 'select', '0', '', '1', '0:请选择\r\n1:图文\r\n2:文本\r\n3:图片\r\n4:语音\r\n5:视频', '1142', '0', '1', '1447208890', '1447208890', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11266', 'target_id', '选择内容', 'int(10) NULL', 'num', '', '', '4', '0:请选择', '1142', '0', '1', '1447208825', '1447208825', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11265', 'addon', '选择插件', 'char(50) NULL', 'select', '0', '', '1', '0:请选择', '1142', '0', '1', '1447208750', '1447208750', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11264', 'from_type', '配置动作', 'char(50) NULL', 'select', '-1', '', '1', '0:站内信息|keyword@hide,url@hide,type@hide,sucai_type@hide,addon@show,jump_type@show\r\n1:站内素材|keyword@hide,url@hide,type@hide,sucai_type@show,addon@hide,jump_type@hide\r\n9:自定义|keyword@show,url@hide,type@show,addon@hide,sucai_type@hide,jump_type@hide\r\n-1:请选择|keyword@hide,url@hide,type@hide,addon@hide,sucai_type@hide,jump_type@hide', '1142', '0', '1', '1447318552', '1447208677', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11275', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1144', '1', '1', '1396061877', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11276', 'intro', '简介', 'text NULL', 'textarea', '', '', '1', '', '1144', '0', '1', '1396061947', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11959', 'prize_image', '奖品图片', 'varchar(255) NULL', 'picture', '上传奖品图片', '', '1', '', '1220', '1', '1', '1429756675', '1429516329', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11958', 'prize_count', '奖品个数', 'int(10) NULL', 'num', '', '', '1', '', '1220', '1', '1', '1429779465', '1429516109', '/^[0-9]*$/', '3', '奖品个数不能小于0', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11957', 'prize_conditions', '活动说明', 'text NULL', 'textarea', '', '奖品说明', '1', '', '1220', '1', '1', '1429756762', '1429516052', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11955', 'prizeid', '奖品编号', 'int(10) NULL', 'num', '', '', '4', '', '1219', '0', '1', '1447832021', '1429607543', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11956', 'prize_name', '奖品名称', 'varchar(255) NULL', 'string', '', '', '1', '', '1220', '1', '1', '1429515512', '1429515512', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11953', 'uid', '用户id', 'int(10) NULL', 'num', '', '', '0', '', '1219', '0', '1', '1429673948', '1429522086', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11954', 'remark', '备注', 'varchar(255) NULL', 'string', '', '', '1', '', '1219', '0', '1', '1429598446', '1429598446', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11951', 'mobile', '手机', 'varchar(50) NULL', 'string', '', '', '1', '', '1219', '1', '1', '1429521877', '1429521877', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11952', 'turename', '收货人姓名', 'varchar(255) NULL', 'string', '', '', '1', '', '1219', '1', '1', '1429672245', '1429521930', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11950', 'address', '奖品收货地址', 'varchar(255) NULL', 'textarea', '', '', '1', '', '1219', '1', '1', '1429857152', '1429521685', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11885', 'max_num', '每人最多允许抽奖次数', 'int(10) unsigned NULL ', 'num', '1', '0表示不限制数量', '1', '', '1210', '0', '1', '1399260079', '1399260079', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11884', 'predict_num', '预计参与人数', 'int(10) unsigned NOT NULL ', 'num', '', '预计人数直接影响抽奖概率：中奖概率 = 奖品总数/(预估活动人数*每人抽奖次数) 要确保100%中奖可设置为1', '1', '', '1210', '1', '1', '1399710446', '1399259992', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11883', 'end_img', '过期提示图片', 'int(10) unsigned NULL ', 'picture', '', '可为空', '1', '', '1210', '0', '1', '1399712676', '1399711987', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11882', 'end_tips', '过期说明', 'text NULL', 'textarea', '', '活动过期或者结束说明', '1', '', '1210', '0', '1', '1399259570', '1399259570', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11881', 'start_time', '开始时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1210', '0', '1', '1399259416', '1399259416', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11880', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1210', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11879', 'cTime', '发布时间', 'int(10) unsigned NULL ', 'datetime', '', '', '0', '', '1210', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11523', 'keyword', '关键词', 'varchar(100) NULL', 'string', '', '', '0', '', '1172', '0', '1', '1422330526', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11522', 'background', '素材背景图', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1172', '0', '1', '1422000992', '1422000992', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11521', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1171', '0', '1', '1396690911', '1396690911', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11260', 'keyword', '关联关键词', 'varchar(100) NULL', 'string', '', '', '1', '', '1142', '0', '1', '1416812109', '1394519054', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11261', 'url', '关联URL', 'varchar(255) NULL ', 'string', '', '', '1', '', '1142', '0', '1', '1394519090', '1394519090', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11262', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1142', '0', '1', '1394526820', '1394526820', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11263', 'type', '类型', 'varchar(30) NULL', 'bool', 'click', '', '1', 'click:点击推事件|keyword@show,url@hide\r\nview:跳转URL|keyword@hide,url@show\r\nscancode_push:扫码推事件|keyword@show,url@hide\r\nscancode_waitmsg:扫码带提示|keyword@show,url@hide\r\npic_sysphoto:弹出系统拍照发图|keyword@show,url@hide\r\npic_photo_or_album:弹出拍照或者相册发图|keyword@show,url@hide\r\npic_weixin:弹出微信相册发图器|keyword@show,url@hide\r\nlocation_select:弹出地理位置选择器|keyword@show,url@hide\r\nnone:无事件的一级菜单|keyword@hide,url@hide', '1142', '0', '1', '1416812039', '1416810588', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11519', 'openid', 'OpenId', 'varchar(255) NULL', 'string', '', '', '0', '', '1171', '0', '1', '1396688187', '1396688187', '', '3', '', 'regex', 'get_openid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11520', 'uid', '用户ID', 'int(10) NULL', 'num', '', '', '0', '', '1171', '0', '1', '1396688042', '1396688042', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11274', 'keyword_type', '关键词类型', 'tinyint(2) NULL', 'select', '', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配\r\n4:正则匹配\r\n5:随机匹配', '1144', '0', '1', '1396061814', '1396061765', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11257', 'sort', '排序号', 'tinyint(4) NULL ', 'num', '0', '数值越小越靠前', '1', '', '1142', '0', '1', '1394523288', '1394519175', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11258', 'pid', '一级菜单', 'int(10) NULL', 'select', '0', '如果是一级菜单，选择“无”即可', '1', '0:无', '1142', '0', '1', '1416810279', '1394518930', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11259', 'title', '菜单名', 'varchar(50) NOT NULL', 'string', '', '可创建最多 3 个一级菜单，每个一级菜单下可创建最多 5 个二级菜单。编辑中的菜单不会马上被用户看到，请放心调试。', '1', '', '1142', '1', '1', '1408951570', '1394518988', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11539', 'addon_condition', '插件场景限制', 'varchar(255) NULL', 'string', '', '格式：[插件名:id值]，如[投票:10]表示对ID为10的投票投完才能领取，更多的说明见表单上的提示', '0', '', '1172', '0', '1', '1418885827', '1399261026', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11538', 'credit_bug', '积分消费', 'int(10) unsigned NULL ', 'num', '0', '用积分中的财富兑换、兑换后扣除相应的积分财富', '0', '', '1172', '0', '1', '1418885794', '1399260764', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11537', 'credit_conditon', '积分限制', 'int(10) unsigned NULL ', 'num', '0', '粉丝达到多少积分后才能领取，领取后不扣积分', '0', '', '1172', '0', '1', '1418885804', '1399260618', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11551', 'shop_name', '商家名称', 'varchar(255) NULL', 'string', '优惠商家', '', '1', '', '1172', '0', '1', '1427280255', '1427280255', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11550', 'use_start_time', '使用开始时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1172', '1', '1', '1427280116', '1427280008', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11593', 'is_audit', '是否审核', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:未审核\r\n1:已审核', '1178', '0', '1', '1435031747', '1435029949', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11549', 'over_time', '使用的截止时间', 'int(10) NULL', 'datetime', '', '券的使用截止时间，为空时表示不限制', '1', '', '1172', '0', '1', '1427161334', '1427161118', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11547', 'start_tips', '活动还没开始时的提示语', 'varchar(255) NULL', 'string', '', '', '1', '', '1172', '0', '1', '1423134546', '1423134546', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11548', 'more_button', '其它按钮', 'text NULL', 'textarea', '', '格式：按钮名称|按钮跳转地址，每行一个。如：查看官网|http://weiphp.cn', '1', '', '1172', '0', '1', '1423193853', '1423193853', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11601', 'code', '卡券code码', 'text NULL', 'textarea', '', '指定的卡券code 码，只能被领一次。use_custom_code 字段为true 的卡券必须填写，非自定义code 不必填写', '1', '', '1179', '0', '1', '1421980773', '1421980773', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11600', 'appsecre', '开通卡券的商家公众号密钥', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1179', '1', '1', '1421980516', '1421980516', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11595', 'uid', 'uid', 'int(10) NULL', 'num', '', '', '1', '', '1179', '0', '1', '1430998977', '1430998977', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11596', 'cover', '素材封面', 'int(10) UNSIGNED NULL', 'picture', '', '', '0', '', '1179', '0', '1', '1427435373', '1422000629', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11597', 'balance', '红包余额', 'varchar(30) NULL', 'string', '', '红包余额，以分为单位。红包类型必填 （LUCKY_MONEY），其他卡券类型不填', '0', '', '1179', '0', '1', '1427435295', '1421982394', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11598', 'card_id', '卡券ID', 'varchar(100) NOT NULL', 'string', '', '', '0', '', '1179', '1', '1', '1427435272', '1421980436', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11599', 'openid', 'OpenID', 'text NULL', 'textarea', '', '指定领取者的openid，只有该用户能领取。bind_openid字段为true的卡券必须填写，非自定义openid 不必填写', '0', '', '1179', '0', '1', '1427435344', '1421980851', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1542', 'score', '修改积分', 'int(10) NULL', 'num', '', '', '1', '', '176', '1', '1', '1444302622', '1444302410', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1543', 'branch_id', '修改门店', 'int(10) NULL', 'num', '', '', '1', '', '176', '0', '1', '1444302450', '1444302450', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1544', 'operator', '操作员', 'varchar(255) NULL', 'string', '', '', '1', '', '176', '0', '1', '1444302474', '1444302474', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1545', 'cTime', '修改时间', 'int(10) NULL', 'datetime', '', '', '0', '', '176', '0', '1', '1444302508', '1444302508', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1546', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '1', '', '176', '0', '1', '1444302539', '1444302539', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1547', 'member_id', '会员卡id', 'int(10) NULL', 'num', '', '', '4', '', '176', '0', '1', '1444302566', '1444302566', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1548', 'manager_id', '管理员id', 'int(10) NULL', 'num', '', '', '1', '', '176', '0', '1', '1444302595', '1444302595', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11610', 'more_button', '添加更多按钮', 'text NULL', 'textarea', '', '', '1', '', '1179', '0', '1', '1427512791', '1427512791', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11609', 'shop_logo', '商家LOGO', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1179', '0', '1', '1427437781', '1427437781', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11608', 'shop_name', '商家名称', 'varchar(255) NULL', 'string', '', '', '1', '', '1179', '0', '1', '1427438002', '1427438002', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11607', 'head_bg_color', '头部背景颜色', 'varchar(255) NULL', 'string', '#35a2dd', '', '1', '', '1179', '0', '1', '1427435535', '1427435535', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11606', 'button_color', '领取按钮颜色', 'varchar(255) NULL', 'string', '#0dbd02', '', '1', '', '1179', '0', '1', '1427435492', '1427435492', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11602', 'content', '活动介绍', 'text NULL', 'editor', '', '', '1', '', '1179', '0', '1', '1421981078', '1421981078', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11603', 'background', '背景图', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1179', '0', '1', '1422000931', '1422000931', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11604', 'token', 'token', 'varchar(50) NULL', 'string', '', '', '1', '', '1179', '0', '1', '1430999013', '1430999013', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11605', 'title', '卡券标题', 'varchar(255) NULL', 'string', '卡券', '', '1', '', '1179', '0', '1', '1427435445', '1427435445', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11592', 'content', '评论内容', 'text NULL', 'textarea', '', '', '0', '', '1178', '1', '1', '1432602376', '1432602376', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11530', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1172', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11531', 'start_time', '开始时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1172', '0', '1', '1422330558', '1399259416', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11532', 'end_tips', '领取结束说明', 'text NULL', 'textarea', '', '活动过期或者结束说明', '1', '', '1172', '0', '1', '1427161168', '1399259570', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11533', 'end_img', '领取结束提示图片', 'int(10) unsigned NULL ', 'picture', '', '可为空', '1', '', '1172', '0', '1', '1427161296', '1400989793', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11534', 'num', '优惠券数量', 'int(10) unsigned NULL ', 'num', '0', '0表示不限制数量', '1', '', '1172', '0', '1', '1399259838', '1399259808', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11535', 'max_num', '每人最多允许获取次数', 'int(10) unsigned NULL ', 'num', '1', '0表示不限制数量', '0', '', '1172', '0', '1', '1447758805', '1399260079', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11536', 'follower_condtion', '粉丝状态', 'char(50) NULL', 'select', '1', '粉丝达到设置的状态才能获取', '0', '0:不限制\r\n1:已关注\r\n2:已绑定信息\r\n3:会员卡成员', '1172', '0', '1', '1418885814', '1399260479', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11625', 'card_id', '卡券ID', 'varchar(255) NULL', 'string', '', '可为空', '1', '', '1180', '0', '1', '1421406387', '1421406387', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11624', 'finish_button', '成功抢答完后显示的按钮', 'text NULL', 'textarea', '', '格式：按钮名|跳转链接，如：百度|www.baidu.com 多个时换行分割', '1', '', '1180', '0', '1', '1420857847', '1420857847', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11611', 'template', '素材模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1179', '0', '1', '1430129779', '1430129779', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11612', 'keyword', '关键词', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1180', '1', '1', '1396624337', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11613', 'keyword_type', '关键词类型', 'tinyint(2) NOT NULL', 'select', '0', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配\r\n4:正则匹配\r\n5:随机匹配', '1180', '1', '1', '1396624426', '1396061765', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11614', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1180', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11615', 'intro', '封面简介', 'text NULL', 'textarea', '', '', '1', '', '1180', '1', '1', '1439367292', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11616', 'mTime', '修改时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1180', '0', '1', '1396624664', '1396624664', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11617', 'cover', '封面图片', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '1180', '0', '1', '1396624534', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11618', 'cTime', '发布时间', 'int(10) unsigned NULL ', 'datetime', '', '', '0', '', '1180', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11619', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1180', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11620', 'finish_tip', '结束语', 'text NULL', 'textarea', '', '为空默认为：抢答完成，谢谢参与', '1', '', '1180', '1', '1', '1439367319', '1396953940', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11621', 'content', '活动介绍', 'text NULL', 'editor', '', '显示在用户进入的开始界面', '1', '', '1180', '0', '1', '1420791982', '1420791908', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11622', 'shop_address', '商家地址', 'text NULL', 'textarea', '', '显示在马上开始的下面，多个地址用英文逗号或者换行分割', '1', '', '1180', '0', '1', '1420798853', '1420794534', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11623', 'appids', '提示关注的公众号', 'text NULL', 'textarea', '', '格式：广东南方卫视|wx2d7ce60bbfc928ef 多个公众号用换行分割', '1', '', '1180', '0', '1', '1420798902', '1420796356', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11558', 'name', '店名', 'varchar(100) NULL', 'string', '', '', '1', '', '1173', '1', '1', '1427164635', '1427164635', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11541', 'view_count', '浏览人数', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '1172', '0', '1', '1399270926', '1399270926', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11542', 'addon', '插件', 'char(50) NULL', 'select', 'public', '', '0', 'public:通用\r\ninvite:微邀约', '1172', '0', '1', '1418885638', '1418885638', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11543', 'shop_uid', '商家管理员ID', 'varchar(255) NULL', 'string', '', '', '0', '', '1172', '0', '1', '1421750246', '1418900122', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11544', 'use_count', '已使用数', 'int(10) NULL', 'num', '0', '', '0', '', '1172', '0', '1', '1418910237', '1418910237', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11545', 'pay_password', '核销密码', 'varchar(255) NULL', 'string', '', '', '1', '', '1172', '0', '1', '1420875229', '1420875229', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11546', 'empty_prize_tips', '奖品抽完后的提示', 'varchar(255) NULL', 'string', '', '不填写时默认显示：您来晚了，优惠券已经领取完', '1', '', '1172', '0', '1', '1421394437', '1421394267', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11559', 'address', '详细地址', 'varchar(255) NULL', 'string', '', '', '1', '', '1173', '1', '1', '1427164668', '1427164668', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11560', 'phone', '联系电话', 'varchar(30) NULL', 'string', '', '', '1', '', '1173', '0', '1', '1427166529', '1427164707', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11561', 'gps', 'GPS经纬度', 'varchar(50) NULL', 'string', '', '格式：经度,纬度', '1', '', '1173', '0', '1', '1427371523', '1427164833', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11562', 'coupon_id', '所属优惠券编号', 'int(10) NULL', 'num', '', '', '4', '', '1173', '0', '1', '1427165806', '1427165806', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11563', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1173', '0', '1', '1440071867', '1440071805', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11564', 'manager_id', '管理员id', 'int(10) NULL', 'num', '', '', '0', '', '1173', '0', '1', '1440071927', '1440071917', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11565', 'open_time', '营业时间', 'varchar(50) NULL', 'string', '', '', '1', '', '1173', '0', '1', '1443106576', '1443106576', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11566', 'img', '门店展示图', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1173', '0', '1', '1447060275', '1447060275', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11567', 'coupon_id', 'coupon_id', 'int(10) NULL', 'num', '', '', '1', '', '1174', '0', '1', '1427356371', '1427356371', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11568', 'shop_id', 'shop_id', 'int(10) NULL', 'num', '', '', '1', '', '1174', '0', '1', '1427356387', '1427356387', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11569', 'title', '竞猜标题', 'varchar(255) NULL', 'string', '', '', '1', '', '1175', '1', '1', '1428655010', '1428655010', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11570', 'desc', '活动说明', 'text NULL', 'textarea', '', '', '1', '', '1175', '0', '1', '1428657017', '1428657017', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11571', 'start_time', '开始时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1175', '1', '1', '1428657086', '1428657086', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11572', 'end_time', '结束时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1175', '1', '1', '1428657122', '1428657122', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11573', 'create_time', '创建时间', 'int(10) NULL', 'datetime', '', '', '4', '', '1175', '0', '1', '1428664508', '1428664122', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11574', 'guess_count', '', 'int(10) unsigned NULL ', 'num', '0', '', '4', '', '1175', '0', '1', '1428718033', '1428717991', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11575', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1175', '0', '1', '1429521291', '1429512366', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11576', 'template', '素材模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1175', '0', '1', '1430115411', '1430103969', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11577', 'cover', '主题图片', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1175', '0', '1', '1430384839', '1430384839', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11578', 'user_id', '用户ID', 'int(10) unsigned NULL', 'num', '0', '', '0', '', '1176', '0', '1', '1428738317', '1428738317', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11579', 'guess_id', '竞猜Id', 'int(10) unsigned NULL', 'num', '0', '', '0', '', '1176', '0', '1', '1428738379', '1428738379', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11580', 'token', '用户token', 'varchar(255) NULL', 'string', '', '', '1', '', '1176', '0', '1', '1428738405', '1428738405', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11581', 'optionIds', '用户猜的选项IDs', 'varchar(255) NULL', 'string', '', '', '0', '', '1176', '0', '1', '1428738522', '1428738522', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11582', 'cTime', '创时间', 'int(10) NULL', 'date', '', '', '0', '', '1176', '0', '1', '1428738552', '1428738552', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11583', 'guess_id', '竞猜活动的Id', 'int(10) NULL', 'num', '0', '', '4', '', '1177', '0', '1', '1428659228', '1428659228', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11584', 'name', '选项名称', 'varchar(255) NULL', 'string', '', '', '1', '', '1177', '1', '1', '1428659270', '1428659270', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11585', 'image', '选项图片', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1177', '0', '1', '1428659313', '1428659313', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11586', 'order', '选项顺序', 'int(10) NULL', 'num', '0', '', '1', '', '1177', '0', '1', '1428659354', '1428659354', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11587', 'guess_count', '竞猜人数', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '1177', '0', '1', '1430302786', '1428659432', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11588', 'aim_table', '评论关联数据表', 'varchar(30) NULL', 'string', '', '', '0', '', '1178', '0', '1', '1432602501', '1432602501', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11589', 'aim_id', '评论关联ID', 'int(10) NULL', 'num', '', '', '0', '', '1178', '0', '1', '1432602466', '1432602466', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11590', 'cTime', '评论时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1178', '0', '1', '1432602404', '1432602404', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11591', 'follow_id', 'follow_id', 'int(10) NULL', 'num', '', '', '0', '', '1178', '1', '1', '1432602345', '1432602345', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11540', 'collect_count', '已领取数', 'int(10) unsigned NULL ', 'num', '0', '', '0', '', '1172', '0', '1', '1400992246', '1399270900', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11524', 'use_tips', '使用说明', 'text NULL', 'editor', '', '用户获取优惠券后显示的提示信息', '1', '', '1172', '1', '1', '1420868972', '1399259489', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11525', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1172', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11526', 'intro', '封面简介', 'text NULL', 'textarea', '', '', '0', '', '1172', '0', '1', '1418885972', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11527', 'end_time', '领取结束时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1172', '0', '1', '1427161023', '1399259433', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11528', 'cover', '优惠券图片', 'int(10) unsigned NULL ', 'picture', '', '', '1', '', '1172', '0', '1', '1418886050', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11529', 'cTime', '发布时间', 'int(10) unsigned NULL ', 'datetime', '', '', '0', '', '1172', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('1663', 'credit_title', '积分标题', 'varchar(50) NULL', 'string', '', '', '0', '', '15', '0', '1', '1444731976', '1444731976', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11714', 'finish_tip', '评论语', 'text NOT NULL', 'textarea', '', '详细说明见上面的提示，配置格式：[0-59]不合格', '1', '', '1189', '0', '1', '1397142371', '1396953940', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11713', 'token', 'Token', 'varchar(255) NOT NULL', 'string', '', '', '0', '', '1189', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11712', 'cover', '封面图片', 'int(10) UNSIGNED NOT NULL', 'picture', '', '', '1', '', '1189', '0', '1', '1396624534', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11626', 'appsecre', '卡券对应的appsecre', 'varchar(255) NULL', 'string', '', '', '1', '', '1180', '0', '1', '1421406470', '1421406470', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11627', 'template', '素材模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1180', '0', '1', '1430210161', '1430210161', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11628', 'answer', '回答内容', 'text NULL', 'textarea', '', '', '0', '', '1181', '0', '1', '1396955766', '1396955766', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11629', 'openid', 'OpenId', 'varchar(255) NULL', 'string', '', '', '0', '', '1181', '0', '1', '1430286439', '1396955581', '', '3', '', 'regex', 'get_openid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11630', 'uid', '用户UID', 'int(10) NULL ', 'num', '', '', '0', '', '1181', '0', '1', '1396955530', '1396955530', '', '3', '', 'regex', 'get_mid', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11631', 'question_id', 'question_id', 'int(10) unsigned NOT NULL ', 'num', '', '', '4', '', '1181', '1', '1', '1396955412', '1396955392', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11632', 'cTime', '发布时间', 'int(10) unsigned NULL ', 'datetime', '', '', '0', '', '1181', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11633', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1181', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11634', 'ask_id', 'ask_id', 'int(10) unsigned NOT NULL ', 'num', '', '', '4', '', '1181', '1', '1', '1396955403', '1396955369', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11635', 'is_correct', '是否回答正确', 'tinyint(2) NULL', 'bool', '1', '', '0', '0:不正确\r\n1:正确', '1181', '0', '1', '1420685956', '1420685956', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11636', 'times', '次数', 'int(4) NULL', 'num', '0', '', '0', '', '1181', '0', '1', '1420965038', '1420965038', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11637', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1182', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11638', 'intro', '问题描述', 'text NULL', 'textarea', '', '', '1', '', '1182', '0', '1', '1396954176', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11639', 'cTime', '发布时间', 'int(10) unsigned NULL ', 'datetime', '', '', '0', '', '1182', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11640', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1182', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11641', 'is_must', '是否必填', 'tinyint(2) NULL', 'bool', '1', '', '0', '0:否\r\n1:是', '1182', '0', '1', '1420686586', '1396954649', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11642', 'extra', '参数', 'text NOT NULL', 'textarea', '', '类型为单选、多选时的定义数据，格式见上面的提示', '1', '', '1182', '1', '1', '1421749164', '1396954558', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11643', 'type', '问题类型', 'char(50) NOT NULL', 'radio', 'radio', '', '1', 'radio:单选题\r\ncheckbox:多选题', '1182', '1', '1', '1420689062', '1396954463', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11644', 'ask_id', 'ask_id', 'int(10) unsigned NOT NULL ', 'num', '', '', '4', '', '1182', '1', '1', '1396954240', '1396954240', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11645', 'sort', '排序号', 'int(10) unsigned NULL ', 'num', '0', '值越小越靠前', '1', '', '1182', '0', '1', '1420689390', '1396955010', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11646', 'answer', '正确答案', 'varchar(255) NOT NULL', 'string', '', '多个答案用空格分开，如： A B C', '1', '', '1182', '1', '1', '1421749143', '1420685041', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11647', 'is_last', '是否最后一题', 'tinyint(2) NULL', 'bool', '0', '如设置为最后一题，用户回答后进入完成页面，否则进入等待下一题提示页面', '0', '0:否\r\n1:是', '1182', '0', '1', '1421749096', '1420686448', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11648', 'wait_time', '等待时间', 'int(10) NULL', 'num', '0', '单位为秒，表示答题后进入下一题的间隔时间', '1', '', '1182', '0', '1', '1420688805', '1420688703', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11649', 'percent', '抢中概率', 'int(10) NULL', 'num', '100', '抢到题目的百分比，请填写0~100之间的整数，如填写50表示概率为50%', '1', '', '1182', '0', '1', '1420855970', '1420855970', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11650', 'answer_time', '答题时间', 'int(10) NULL', 'num', '', '不填则为无答题时间限制', '1', '', '1182', '0', '1', '1427541360', '1427541360', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11684', 'keyword', '关键词', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1186', '1', '1', '1396624337', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11685', 'keyword_type', '关键词类型', 'tinyint(2) NOT NULL', 'select', '0', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配', '1186', '1', '1', '1396624426', '1396061765', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11686', 'title', '标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1186', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11687', 'intro', '封面简介', 'text NULL', 'textarea', '', '', '1', '', '1186', '1', '1', '1447826199', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11688', 'mTime', '修改时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1186', '0', '1', '1396624664', '1396624664', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11689', 'cover', '封面图片', 'int(10) UNSIGNED NOT NULL', 'picture', '', '', '1', '', '1186', '1', '1', '1418266006', '1396062093', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11690', 'experience', '消耗经验值', 'int(10) NULL', 'num', '0', '', '1', '', '1186', '0', '1', '1418180506', '1418180506', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11691', 'cTime', '发布时间', 'int(10) UNSIGNED NULL', 'datetime', '', '', '0', '', '1186', '0', '1', '1396624612', '1396075102', '', '3', '', 'regex', 'time', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11692', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1186', '0', '1', '1396602871', '1396602859', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11693', 'num', '邀请人数', 'int(10) NULL', 'num', '0', '邀请多少人后才能用优惠券', '1', '', '1186', '1', '1', '1447826376', '1418180590', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11694', 'coupon_id', '优惠券编号', 'int(10) NULL', 'num', '', '可以在优惠券列表中找到对应的编号', '1', '', '1186', '1', '1', '1447826355', '1418180739', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11695', 'coupon_num', '优惠券数', 'int(10) NULL', 'num', '0', '赠送多少张优惠券', '0', '', '1186', '0', '1', '1418959022', '1418180812', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11696', 'receive_num', '已领取优惠券数', 'int(10) NULL', 'num', '0', '', '0', '', '1186', '0', '1', '1418181528', '1418181528', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11697', 'content', '邀约介绍', 'text NULL', 'editor', '', '', '1', '', '1186', '1', '1', '1447826165', '1418265599', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11698', 'template', '模板名称', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1186', '0', '1', '1430122784', '1430122766', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11699', 'token', 'Token', 'varchar(255) NULL', 'string', '', '', '0', '', '1187', '0', '1', '1418192408', '1418192408', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11700', 'uid', '用户ID', 'int(10) NULL', 'num', '', '', '0', '', '1187', '0', '1', '1418192629', '1418192629', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11701', 'invite_id', '邀约ID', 'int(10) NULL', 'num', '', '', '1', '', '1187', '0', '1', '1418192878', '1418192878', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11702', 'invite_num', '已邀请人数', 'int(10) NULL', 'num', '', '', '0', '', '1187', '0', '1', '1418192971', '1418192971', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11703', 'token', 'Token', 'varchar(255) NOT NULL', 'string', '', '', '0', '', '1188', '0', '1', '1401371165', '1401371165', '', '3', '', 'regex', 'get_token', '1', 'function');
INSERT INTO `wx_attribute` VALUES ('11704', 'month', '月份', 'int(10) NOT NULL', 'num', '', '', '1', '', '1188', '0', '1', '1401371192', '1401371192', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11705', 'day', '日期', 'int(10) NOT NULL', 'num', '', '', '1', '', '1188', '0', '1', '1401371209', '1401371209', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11706', 'content', '统计数据', 'text NOT NULL', 'textarea', '', '', '1', '', '1188', '0', '1', '1401371292', '1401371292', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11707', 'keyword', '关键词', 'varchar(100) NOT NULL', 'string', '', '', '1', '', '1189', '1', '1', '1396624337', '1396061575', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11708', 'keyword_type', '关键词匹配类型', 'tinyint(2) NOT NULL', 'select', '0', '', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配', '1189', '1', '1', '1396624426', '1396061765', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11709', 'title', '问卷标题', 'varchar(255) NOT NULL', 'string', '', '', '1', '', '1189', '1', '1', '1396624461', '1396061859', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11710', 'intro', '封面简介', 'text NOT NULL', 'textarea', '', '', '1', '', '1189', '0', '1', '1396624505', '1396061947', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11711', 'mTime', '修改时间', 'int(10) NOT NULL', 'datetime', '', '', '0', '', '1189', '0', '1', '1396624664', '1396624664', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11552', 'shop_logo', '商家LOGO', 'int(10) UNSIGNED NULL', 'picture', '', '', '1', '', '1172', '0', '1', '1427280293', '1427280293', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11553', 'head_bg_color', '头部背景颜色', 'varchar(255) NULL', 'string', '#35a2dd', '', '1', '', '1172', '0', '1', '1427282839', '1427282785', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11554', 'button_color', '按钮颜色', 'varchar(255) NULL', 'string', '#0dbd02', '', '1', '', '1172', '0', '1', '1427282886', '1427282886', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11555', 'template', '素材模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1172', '0', '1', '1430127336', '1430127336', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11556', 'member', '选择人群', 'varchar(100) NULL', 'checkbox', '0', '', '1', '0:所有用户\r\n-1:所有会员', '1172', '0', '1', '1444821380', '1444821380', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11557', 'is_del', '是否删除', 'int(10) NULL', 'num', '0', '', '0', '', '1172', '0', '1', '1446119564', '1446119564', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11594', 'uid', 'uid', 'int(10) NULL', 'num', '', '', '0', '', '1178', '0', '1', '1435561416', '1435561392', '', '3', '', 'regex', 'get_mid', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1823', 'is_material', '设置为文本素材', 'int(10) NULL', 'num', '0', '', '0', '0:不设置\r\n1:设置', '103', '0', '1', '1445497359', '1445497359', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1824', 'admin_uid', '核销管理员ID', 'int(10) NULL', 'num', '', '', '0', '', '81', '0', '1', '1445504807', '1445504807', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1839', 'msgtype', '消息类型', 'varchar(255) NULL', 'string', '', '', '1', '', '18', '0', '1', '1445833955', '1445833955', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1840', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '1', '', '18', '0', '1', '1445834006', '1445834006', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1841', 'appmsg_id', '图文id', 'int(10) NULL', 'num', '', '', '1', '', '18', '0', '1', '1445840292', '1445834101', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1842', 'voice_id', '语音id', 'int(10) NULL', 'num', '', '', '1', '', '18', '0', '1', '1445834144', '1445834144', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1843', 'video_id', '视频id', 'int(10) NULL', 'num', '', '', '1', '', '18', '0', '1', '1445834174', '1445834174', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('1851', 'cTime', '群发时间', 'int(10) NULL', 'datetime', '', '', '1', '', '18', '0', '1', '1445856491', '1445856442', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11886', 'follower_condtion', '粉丝状态', 'char(50) NULL', 'select', '1', '粉丝达到设置的状态才能获取', '1', '0:不限制\r\n1:已关注\r\n2:已绑定信息\r\n3:会员卡成员', '1210', '0', '1', '1399260479', '1399260479', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11887', 'credit_conditon', '积分限制', 'int(10) unsigned NULL ', 'num', '0', '粉丝达到多少积分后才能领取，领取后不扣积分', '1', '', '1210', '0', '1', '1399260618', '1399260618', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11888', 'credit_bug', '积分消费', 'int(10) unsigned NULL ', 'num', '0', '用积分中的财富兑换、兑换后扣除相应的积分财富', '1', '', '1210', '0', '1', '1399260764', '1399260764', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11889', 'addon_condition', '插件场景限制', 'varchar(255) NULL', 'string', '', '格式：[插件名:id值]，如[投票:10]表示对ID为10的投票投完才能领取，更多的说明见表单上的提示', '1', '', '1210', '0', '1', '1399274022', '1399261026', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11890', 'collect_count', '已领取人数', 'int(10) unsigned NULL ', 'num', '0', '', '1', '', '1210', '0', '1', '1420980201', '1399270900', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11891', 'view_count', '浏览人数', 'int(10) unsigned NULL ', 'num', '0', '', '1', '', '1210', '0', '1', '1420980183', '1399270926', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11892', 'update_time', '更新时间', 'int(10) NULL', 'datetime', '', '', '0', '', '1210', '0', '1', '1399562468', '1399359204', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11893', 'template', '素材模板', 'varchar(255) NULL', 'string', 'default', '', '1', '', '1210', '0', '1', '1430201266', '1430201266', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11894', 'fid', '', 'int(11) NULL ', 'string', '', '', '1', '', '1211', '0', '1', '1404033503', '1404033503', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11895', 'token', '', 'varchar(60) NULL ', 'string', '', '', '1', '', '1211', '0', '1', '1404033503', '1404033503', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11896', 'openid', '', 'varchar(60) NULL ', 'string', '', '', '1', '', '1211', '0', '1', '1404033503', '1404033503', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11897', 'date', '', 'varchar(11) NULL ', 'string', '', '', '1', '', '1211', '0', '1', '1404033504', '1404033504', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11898', 'enddate', '', 'int(11) NULL ', 'string', '', '', '1', '', '1211', '0', '1', '1404033504', '1404033504', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11899', 'model', '', 'varchar(60) NULL ', 'string', '', '', '1', '', '1211', '0', '1', '1404033504', '1404033504', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11900', 'num', '', 'int(11) NULL ', 'string', '', '', '1', '', '1211', '0', '1', '1404033505', '1404033505', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11901', 'keyword', '', 'varchar(60) NULL ', 'string', '', '', '1', '', '1211', '0', '1', '1404033505', '1404033505', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11902', 'type', '', 'tinyint(1) NULL ', 'string', '', '', '1', '', '1211', '0', '1', '1404033505', '1404033505', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11903', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1212', '0', '1', '1404485505', '1404475530', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11904', 'groupname', '分组名称', 'varchar(255) NULL', 'string', '', '', '1', '', '1212', '0', '1', '1404475556', '1404475556', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11905', 'groupdata', '分组数据源', 'text NULL', 'textarea', '', '', '0', '', '1212', '0', '1', '1404476127', '1404476127', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11906', 'msgkeyword', '消息关键字', 'varchar(555) NULL', 'string', '', '当用户发送的消息中含有关键字时,将自动转到分配的客服人员', '1', '', '1213', '0', '1', '1404399336', '1404399336', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11907', 'msgkeyword_type', '关键字类型', 'char(50) NULL', 'select', '3', '选择关键字匹配的类型', '1', '0:完全匹配\r\n1:左边匹配\r\n2:右边匹配\r\n3:模糊匹配\r\n4:正则匹配\r\n5:随机匹配', '1213', '0', '1', '1404399466', '1404399466', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11908', 'msgkfaccount', '接待的客服人员', 'varchar(255) NULL', 'string', '', '', '0', '', '1213', '0', '1', '1404403340', '1404399587', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11909', 'cTime', '创建时间', 'int(10) NULL', 'date', '', '', '0', '', '1213', '0', '1', '1404399629', '1404399629', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11910', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1213', '0', '1', '1404399656', '1404399656', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11911', 'msgstate', '关键字状态', 'tinyint(2) NULL', 'bool', '1', '停用后用户将不会触发此关键词', '1', '0:停用\r\n1:启用', '1213', '0', '1', '1404399749', '1404399749', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11912', 'zjnum', '转接次数', 'int(10) NULL', 'num', '', '', '0', '', '1213', '0', '1', '1404399784', '1404399784', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11913', 'zdtype', '指定类型', 'char(10) NULL', 'radio', '0', '选择关键字匹配时是按指定人员或者指定客服组', '1', '0:指定客服人员\r\n1:指定客服组', '1213', '0', '1', '1404474672', '1404474672', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11914', 'kfgroupid', '客服分组id', 'int(10) NULL', 'num', '0', '', '0', '', '1213', '0', '1', '1404474777', '1404474777', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11915', 'pid', '', 'int(11) NULL ', 'string', '', '', '1', '', '1214', '0', '1', '1403947272', '1403947272', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11916', 'openid', '', 'varchar(60) NULL ', 'string', '', '', '1', '', '1214', '0', '1', '1403947273', '1403947273', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11917', 'enddate', '', 'int(11) NULL ', 'string', '', '', '1', '', '1214', '0', '1', '1403947273', '1403947273', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11918', 'keyword', '', 'varchar(200) NULL ', 'string', '', '', '1', '', '1214', '0', '1', '1403947274', '1403947274', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11919', 'status', '', 'tinyint(1) NULL ', 'string', '2', '', '1', '', '1214', '0', '1', '1403947274', '1403947274', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11920', 'name', '客服昵称', 'varchar(60) NULL ', 'string', '', '', '1', '', '1215', '0', '1', '1403959775', '1403947255', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11921', 'token', 'token', 'varchar(60) NULL ', 'string', '', '', '0', '', '1215', '0', '1', '1403959638', '1403947256', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11922', 'userName', '客服帐号', 'varchar(60) NULL ', 'string', '', '', '1', '', '1215', '0', '1', '1403959752', '1403947256', '', '3', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11923', 'userPwd', '客服密码', 'varchar(32) NULL ', 'string', '', '', '1', '', '1215', '0', '1', '1403959722', '1403947257', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11924', 'endJoinDate', '客服加入时间', 'int(11) NULL ', 'string', '', '', '0', '', '1215', '0', '1', '1403959825', '1403947257', '', '3', '', 'regex', 'time', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11925', 'status', '客服在线状态', 'tinyint(1) NULL ', 'bool', '0', '', '0', '0:离线\r\n1:在线', '1215', '0', '1', '1404016782', '1403947258', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `wx_attribute` VALUES ('11926', 'state', '客服状态', 'tinyint(2) NULL', 'bool', '0', '', '1', '0:停用\r\n1:启用', '1215', '0', '1', '1404016877', '1404016877', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11927', 'isdelete', '是否删除', 'tinyint(2) NULL', 'bool', '0', '', '0', '0:正常\r\n1:已被删除', '1215', '0', '1', '1404016931', '1404016931', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11928', 'kfid', '客服编号', 'varchar(255) NULL', 'string', '', '', '1', '', '1215', '0', '1', '1404398387', '1404398387', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11929', 'openid', '', 'varchar(60) NULL ', 'string', '', '', '1', '', '1216', '0', '1', '1404026716', '1404026716', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11930', 'enddate', '', 'int(11) NULL ', 'string', '', '', '1', '', '1216', '0', '1', '1404026716', '1404026716', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11931', 'joinUpDate', '', 'int(11) NULL ', 'string', '0', '', '1', '', '1216', '0', '1', '1404026716', '1404026716', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11932', 'uid', '', 'int(11) NULL ', 'string', '0', '', '1', '', '1216', '0', '1', '1404026717', '1404026717', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11933', 'token', '', 'varchar(40) NULL ', 'string', '', '', '1', '', '1216', '0', '1', '1404026717', '1404026717', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11934', 'g_id', '', 'varchar(20) NULL ', 'string', '', '', '1', '', '1217', '0', '1', '1404027302', '1404027302', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11935', 'nickname', '', 'varchar(60) NULL ', 'string', '', '', '1', '', '1217', '0', '1', '1404027302', '1404027302', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11936', 'sex', '', 'tinyint(1) NULL ', 'string', '', '', '1', '', '1217', '0', '1', '1404027303', '1404027303', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11937', 'province', '', 'varchar(20) NULL ', 'string', '', '', '1', '', '1217', '0', '1', '1404027303', '1404027303', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11938', 'city', '', 'varchar(30) NULL ', 'string', '', '', '1', '', '1217', '0', '1', '1404027303', '1404027303', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11939', 'headimgurl', '', 'varchar(200) NULL ', 'string', '', '', '1', '', '1217', '0', '1', '1404027304', '1404027304', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11940', 'subscribe_time', '', 'int(11) NULL ', 'string', '', '', '1', '', '1217', '0', '1', '1404027304', '1404027304', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11941', 'token', '', 'varchar(30) NULL ', 'string', '', '', '1', '', '1217', '0', '1', '1404027305', '1404027305', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11942', 'openid', '', 'varchar(60) NULL ', 'string', '', '', '1', '', '1217', '0', '1', '1404027305', '1404027305', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11943', 'status', '', 'tinyint(1) NULL ', 'string', '', '', '1', '', '1217', '0', '1', '1404027305', '1404027305', '', '0', '', '', '', '0', '');
INSERT INTO `wx_attribute` VALUES ('11944', 'opercode', '会话状态', 'int(10) NULL', 'num', '', '', '1', '', '1218', '0', '1', '1406094322', '1406094322', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11945', 'text', '消息', 'text NULL', 'textarea', '', '', '1', '', '1218', '0', '1', '1406094387', '1406094387', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11946', 'time', '时间', 'int(10) NULL', 'datetime', '', '', '1', '', '1218', '0', '1', '1406094341', '1406094341', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11947', 'openid', 'openid', 'varchar(255) NULL', 'string', '', '', '1', '', '1218', '0', '1', '1406094276', '1406094276', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11948', 'token', 'token', 'varchar(255) NULL', 'string', '', '', '0', '', '1218', '0', '1', '1406094177', '1406094177', '', '3', '', 'regex', 'get_token', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11949', 'worker', '客服名称', 'varchar(255) NULL', 'string', '', '', '1', '', '1218', '0', '1', '1406094257', '1406094257', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11242', 'is_use', '可否使用', 'int(10) NULL', 'num', '1', '', '0', '0:不可用\r\n1:可用', '149', '0', '1', '1447405173', '1447403730', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11243', 'aim_id', '添加来源标识id', 'int(10) NULL', 'num', '', '', '0', '', '149', '0', '1', '1447404930', '1447404930', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11244', 'aim_table', '来源表名', 'varchar(255) NULL', 'string', '', '', '1', '', '149', '0', '1', '1447405156', '1447405156', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11245', 'is_use', '可否使用', 'int(10) NULL', 'num', '1', '', '0', '0:不可用\r\n1:可用', '16', '0', '1', '1447405234', '1447405234', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11246', 'aim_id', '添加来源标识id', 'int(10) NULL', 'num', '', '', '0', '', '16', '0', '1', '1447405283', '1447405283', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11247', 'aim_table', '来源表名', 'varchar(255) NULL', 'string', '', '', '1', '', '16', '0', '1', '1447405301', '1447405301', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11248', 'is_use', '可否使用', 'int(10) NULL', 'num', '1', '', '0', '0:不可用\r\n1:可用', '17', '0', '1', '1447405553', '1447405510', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11249', 'aim_id', '添加来源标识id', 'int(10) NULL', 'num', '', '', '0', '', '17', '0', '1', '1447405545', '1447405545', '', '3', '', 'regex', '', '3', 'function');
INSERT INTO `wx_attribute` VALUES ('11250', 'aim_table', '来源表名', 'varchar(255) NULL', 'string', '', '', '0', '', '17', '0', '1', '1447405577', '1447405577', '', '3', '', 'regex', '', '3', 'function');

-- ----------------------------
-- Table structure for `wx_auth_extend`
-- ----------------------------
DROP TABLE IF EXISTS `wx_auth_extend`;
CREATE TABLE `wx_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL COMMENT '用户id',
  `extend_id` mediumint(8) unsigned NOT NULL COMMENT '扩展表中数据的id',
  `type` tinyint(1) unsigned NOT NULL COMMENT '扩展类型标识 1:栏目分类权限;2:模型权限',
  UNIQUE KEY `group_extend_type` (`group_id`,`extend_id`,`type`),
  KEY `uid` (`group_id`),
  KEY `group_id` (`extend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组与分类的对应关系表';

-- ----------------------------
-- Records of wx_auth_extend
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `wx_auth_group`;
CREATE TABLE `wx_auth_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(30) DEFAULT NULL COMMENT '分组名称',
  `icon` int(10) unsigned DEFAULT NULL COMMENT '图标',
  `description` text COMMENT '描述信息',
  `status` tinyint(2) DEFAULT '1' COMMENT '状态',
  `type` tinyint(2) DEFAULT '1' COMMENT '类型',
  `rules` text COMMENT '权限',
  `manager_id` int(10) DEFAULT '0' COMMENT '管理员ID',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `is_default` tinyint(1) DEFAULT '0' COMMENT '是否默认自动加入',
  `qr_code` varchar(255) DEFAULT NULL COMMENT '微信二维码',
  `wechat_group_id` int(10) DEFAULT '-1' COMMENT '微信端的分组ID',
  `wechat_group_name` varchar(100) DEFAULT NULL COMMENT '微信端的分组名',
  `wechat_group_count` int(10) DEFAULT NULL COMMENT '微信端用户数',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '是否已删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_auth_group
-- ----------------------------
INSERT INTO `wx_auth_group` VALUES ('1', '默认用户组', null, '通用的用户组', '1', '0', '1,2,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,81,82,83,84,86,87,88,89,90,91,92,93,94,95,96,97,100,102,103,105,106', '0', '', '0', '', null, '', null, '0');
INSERT INTO `wx_auth_group` VALUES ('2', '公众号粉丝组', null, '所有从公众号自动注册的粉丝用户都会自动加入这个用户组', '1', '0', '1,2,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,82,83,84,88,89,90,91,92,93,96,97,100,102,103,195', '0', '', '0', '', null, '', null, '0');
INSERT INTO `wx_auth_group` VALUES ('3', '公众号管理组', null, '公众号管理员注册时会自动加入这个用户组', '1', '0', '', '0', '', '0', '', null, '', null, '0');
INSERT INTO `wx_auth_group` VALUES ('4', '未分组', null, null, '1', '1', null, '1', 'gh_1784a6c712f0', '0', 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQGw8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xLzcwbkpHQ3psZFZnTWpUMm9TMlhfAAIEUv_eVgMEAAAAAA==', '0', '未分组', '31', '0');
INSERT INTO `wx_auth_group` VALUES ('5', '黑名单', null, null, '1', '1', null, '1', 'gh_1784a6c712f0', '0', 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQEp8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL29rbkRYaUxsWmxnZmlIRDNRV1hfAAIEUv_eVgMEAAAAAA==', '1', '黑名单', '0', '0');
INSERT INTO `wx_auth_group` VALUES ('6', '星标组', null, null, '1', '1', null, '1', 'gh_1784a6c712f0', '0', 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQEO8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL2hFbTdlaXZsTGxoWGcxYmpPV1hfAAIEUv_eVgMEAAAAAA==', '2', '星标组', '4', '0');

-- ----------------------------
-- Table structure for `wx_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `wx_auth_group_access`;
CREATE TABLE `wx_auth_group_access` (
  `uid` int(10) DEFAULT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_auth_group_access
-- ----------------------------
INSERT INTO `wx_auth_group_access` VALUES ('1', '3');
INSERT INTO `wx_auth_group_access` VALUES ('28', '4');
INSERT INTO `wx_auth_group_access` VALUES ('29', '4');
INSERT INTO `wx_auth_group_access` VALUES ('30', '4');
INSERT INTO `wx_auth_group_access` VALUES ('31', '4');
INSERT INTO `wx_auth_group_access` VALUES ('32', '6');
INSERT INTO `wx_auth_group_access` VALUES ('33', '4');
INSERT INTO `wx_auth_group_access` VALUES ('34', '4');
INSERT INTO `wx_auth_group_access` VALUES ('35', '6');
INSERT INTO `wx_auth_group_access` VALUES ('36', '4');
INSERT INTO `wx_auth_group_access` VALUES ('37', '4');
INSERT INTO `wx_auth_group_access` VALUES ('38', '4');
INSERT INTO `wx_auth_group_access` VALUES ('39', '4');
INSERT INTO `wx_auth_group_access` VALUES ('40', '4');
INSERT INTO `wx_auth_group_access` VALUES ('41', '4');
INSERT INTO `wx_auth_group_access` VALUES ('42', '4');
INSERT INTO `wx_auth_group_access` VALUES ('43', '4');
INSERT INTO `wx_auth_group_access` VALUES ('44', '4');
INSERT INTO `wx_auth_group_access` VALUES ('45', '4');
INSERT INTO `wx_auth_group_access` VALUES ('46', '4');
INSERT INTO `wx_auth_group_access` VALUES ('47', '4');
INSERT INTO `wx_auth_group_access` VALUES ('48', '4');
INSERT INTO `wx_auth_group_access` VALUES ('71', '4');
INSERT INTO `wx_auth_group_access` VALUES ('73', '6');
INSERT INTO `wx_auth_group_access` VALUES ('74', '6');

-- ----------------------------
-- Table structure for `wx_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `wx_auth_rule`;
CREATE TABLE `wx_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  `group` char(30) DEFAULT '默认分组',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=280 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_auth_rule
-- ----------------------------
INSERT INTO `wx_auth_rule` VALUES ('241', 'Admin/Rule/createRule', '权限节点管理', '1', '', '默认分组');
INSERT INTO `wx_auth_rule` VALUES ('242', 'Admin/AuthManager/index', '用户组管理', '1', '', '默认分组');
INSERT INTO `wx_auth_rule` VALUES ('243', 'Admin/User/index', '用户信息', '1', '', '用户管理');

-- ----------------------------
-- Table structure for `wx_auto_reply`
-- ----------------------------
DROP TABLE IF EXISTS `wx_auto_reply`;
CREATE TABLE `wx_auto_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `msg_type` char(50) DEFAULT 'text' COMMENT '消息类型',
  `content` text COMMENT '文本内容',
  `group_id` int(10) DEFAULT NULL COMMENT '图文',
  `image_id` int(10) unsigned DEFAULT NULL COMMENT '上传图片',
  `manager_id` int(10) DEFAULT NULL COMMENT '管理员ID',
  `token` varchar(50) DEFAULT NULL COMMENT 'Token',
  `image_material` int(10) DEFAULT NULL COMMENT '素材图片id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_auto_reply
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_card_vouchers`
-- ----------------------------
DROP TABLE IF EXISTS `wx_card_vouchers`;
CREATE TABLE `wx_card_vouchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) DEFAULT NULL COMMENT 'uid',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '素材封面',
  `balance` varchar(30) DEFAULT NULL COMMENT '红包余额',
  `card_id` varchar(100) NOT NULL COMMENT '卡券ID',
  `openid` text COMMENT 'OpenID',
  `appsecre` varchar(255) NOT NULL COMMENT '开通卡券的商家公众号密钥',
  `code` text COMMENT '卡券code码',
  `content` text COMMENT '活动介绍',
  `background` int(10) unsigned DEFAULT NULL COMMENT '背景图',
  `token` varchar(50) DEFAULT NULL COMMENT 'token',
  `title` varchar(255) DEFAULT '卡券' COMMENT '卡券标题',
  `button_color` varchar(255) DEFAULT '#0dbd02' COMMENT '领取按钮颜色',
  `head_bg_color` varchar(255) DEFAULT '#35a2dd' COMMENT '头部背景颜色',
  `shop_name` varchar(255) DEFAULT NULL COMMENT '商家名称',
  `shop_logo` int(10) unsigned DEFAULT NULL COMMENT '商家LOGO',
  `more_button` text COMMENT '添加更多按钮',
  `template` varchar(255) DEFAULT 'default' COMMENT '素材模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_card_vouchers
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_channel`
-- ----------------------------
DROP TABLE IF EXISTS `wx_channel`;
CREATE TABLE `wx_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级频道ID',
  `title` char(30) NOT NULL COMMENT '频道标题',
  `url` char(100) NOT NULL COMMENT '频道连接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `target` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_channel
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_comment`
-- ----------------------------
DROP TABLE IF EXISTS `wx_comment`;
CREATE TABLE `wx_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `aim_table` varchar(30) DEFAULT NULL COMMENT '评论关联数据表',
  `aim_id` int(10) DEFAULT NULL COMMENT '评论关联ID',
  `cTime` int(10) DEFAULT NULL COMMENT '评论时间',
  `follow_id` int(10) DEFAULT NULL COMMENT 'follow_id',
  `content` text COMMENT '评论内容',
  `is_audit` tinyint(2) DEFAULT '0' COMMENT '是否审核',
  `uid` int(10) DEFAULT NULL COMMENT 'uid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_common_category`
-- ----------------------------
DROP TABLE IF EXISTS `wx_common_category`;
CREATE TABLE `wx_common_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) DEFAULT NULL COMMENT '分类标识',
  `title` varchar(255) NOT NULL COMMENT '分类标题',
  `icon` int(10) unsigned DEFAULT NULL COMMENT '分类图标',
  `pid` int(10) unsigned DEFAULT '0' COMMENT '上一级分类',
  `path` varchar(255) DEFAULT NULL COMMENT '分类路径',
  `module` varchar(255) DEFAULT NULL COMMENT '分类所属功能',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序号',
  `is_show` tinyint(2) DEFAULT '1' COMMENT '是否显示',
  `intro` varchar(255) DEFAULT NULL COMMENT '分类描述',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `code` varchar(255) DEFAULT NULL COMMENT '分类扩展编号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_common_category
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_common_category_group`
-- ----------------------------
DROP TABLE IF EXISTS `wx_common_category_group`;
CREATE TABLE `wx_common_category_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL COMMENT '分组标识',
  `title` varchar(255) NOT NULL COMMENT '分组标题',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `level` tinyint(1) unsigned DEFAULT '3' COMMENT '最多级数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_common_category_group
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_config`
-- ----------------------------
DROP TABLE IF EXISTS `wx_config`;
CREATE TABLE `wx_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Records of wx_config
-- ----------------------------
INSERT INTO `wx_config` VALUES ('1', 'WEB_SITE_TITLE', '1', '网站标题', '1', '', '网站标题前台显示标题', '1378898976', '1430825115', '1', 'weiphp3.0', '0');
INSERT INTO `wx_config` VALUES ('2', 'WEB_SITE_DESCRIPTION', '2', '网站描述', '1', '', '网站搜索引擎描述', '1378898976', '1379235841', '1', 'weiphp是互联网+的IT综合解决方案', '1');
INSERT INTO `wx_config` VALUES ('3', 'WEB_SITE_KEYWORD', '2', '网站关键字', '1', '', '网站搜索引擎关键字', '1378898976', '1381390100', '1', 'weiphp,互联网+,微信开源开发框架', '8');
INSERT INTO `wx_config` VALUES ('4', 'WEB_SITE_CLOSE', '4', '关闭站点', '1', '0:关闭\r\n1:开启', '站点关闭后其他用户不能访问，管理员可以正常访问', '1378898976', '1406859591', '1', '1', '1');
INSERT INTO `wx_config` VALUES ('9', 'CONFIG_TYPE_LIST', '3', '配置类型列表', '4', '', '主要用于数据解析和页面表单的生成', '1378898976', '1379235348', '1', '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举', '2');
INSERT INTO `wx_config` VALUES ('10', 'WEB_SITE_ICP', '1', '网站备案号', '1', '', '设置在网站底部显示的备案号，如“沪ICP备12007941号-2', '1378900335', '1379235859', '1', '', '9');
INSERT INTO `wx_config` VALUES ('11', 'DOCUMENT_POSITION', '3', '文档推荐位', '2', '', '文档推荐位，推荐到多个位置KEY值相加即可', '1379053380', '1379235329', '1', '1:列表页推荐\r\n2:频道页推荐\r\n4:网站首页推荐', '3');
INSERT INTO `wx_config` VALUES ('12', 'DOCUMENT_DISPLAY', '3', '文档可见性', '2', '', '文章可见性仅影响前台显示，后台不收影响', '1379056370', '1379235322', '1', '0:所有人可见\r\n1:仅注册会员可见\r\n2:仅管理员可见', '4');
INSERT INTO `wx_config` VALUES ('13', 'COLOR_STYLE', '4', '后台色系', '1', 'default_color:默认\r\nblue_color:紫罗兰', '后台颜色风格', '1379122533', '1379235904', '1', 'default_color', '10');
INSERT INTO `wx_config` VALUES ('20', 'CONFIG_GROUP_LIST', '3', '配置分组', '4', '', '配置分组', '1379228036', '1384418383', '1', '1:基本\r\n3:用户\r\n4:系统\r\n5:站点', '4');
INSERT INTO `wx_config` VALUES ('21', 'HOOKS_TYPE', '3', '钩子的类型', '4', '', '类型 1-用于扩展显示内容，2-用于扩展业务处理', '1379313397', '1379313407', '1', '1:视图\r\n2:控制器', '6');
INSERT INTO `wx_config` VALUES ('22', 'AUTH_CONFIG', '3', 'Auth配置', '4', '', '自定义Auth.class.php类配置', '1379409310', '1379409564', '1', 'AUTH_ON:1\r\nAUTH_TYPE:2', '8');
INSERT INTO `wx_config` VALUES ('23', 'OPEN_DRAFTBOX', '4', '是否开启草稿功能', '2', '0:关闭草稿功能\r\n1:开启草稿功能\r\n', '新增文章时的草稿功能配置', '1379484332', '1379484591', '1', '1', '1');
INSERT INTO `wx_config` VALUES ('24', 'DRAFT_AOTOSAVE_INTERVAL', '0', '自动保存草稿时间', '2', '', '自动保存草稿的时间间隔，单位：秒', '1379484574', '1386143323', '1', '60', '2');
INSERT INTO `wx_config` VALUES ('25', 'LIST_ROWS', '0', '后台每页记录数', '4', '', '后台数据每页显示记录数', '1379503896', '1391938052', '1', '20', '10');
INSERT INTO `wx_config` VALUES ('26', 'USER_ALLOW_REGISTER', '4', '是否允许用户注册', '3', '0:关闭注册\r\n1:允许注册', '是否开放用户注册', '1379504487', '1379504580', '1', '1', '0');
INSERT INTO `wx_config` VALUES ('27', 'CODEMIRROR_THEME', '4', '预览插件的CodeMirror主题', '4', '3024-day:3024 day\r\n3024-night:3024 night\r\nambiance:ambiance\r\nbase16-dark:base16 dark\r\nbase16-light:base16 light\r\nblackboard:blackboard\r\ncobalt:cobalt\r\neclipse:eclipse\r\nelegant:elegant\r\nerlang-dark:erlang-dark\r\nlesser-dark:lesser-dark\r\nmidnight:midnight', '详情见CodeMirror官网', '1379814385', '1384740813', '1', 'ambiance', '3');
INSERT INTO `wx_config` VALUES ('28', 'DATA_BACKUP_PATH', '1', '数据库备份根路径', '4', '', '路径必须以 / 结尾', '1381482411', '1381482411', '1', './Data/', '5');
INSERT INTO `wx_config` VALUES ('29', 'DATA_BACKUP_PART_SIZE', '0', '数据库备份卷大小', '4', '', '该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M', '1381482488', '1381729564', '1', '20971520', '7');
INSERT INTO `wx_config` VALUES ('30', 'DATA_BACKUP_COMPRESS', '4', '数据库备份文件是否启用压缩', '4', '0:不压缩\r\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '1381713345', '1381729544', '1', '1', '9');
INSERT INTO `wx_config` VALUES ('31', 'DATA_BACKUP_COMPRESS_LEVEL', '4', '数据库备份文件压缩级别', '4', '1:普通\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '1381713408', '1381713408', '1', '9', '10');
INSERT INTO `wx_config` VALUES ('32', 'DEVELOP_MODE', '4', '开启开发者模式', '4', '0:关闭\r\n1:开启', '是否开启开发者模式', '1383105995', '1440555973', '1', '0', '0');
INSERT INTO `wx_config` VALUES ('33', 'ALLOW_VISIT', '3', '不受限控制器方法', '0', '', '', '1386644047', '1386644741', '1', '0:article/draftbox\r\n1:article/mydocument\r\n2:Category/tree\r\n3:Index/verify\r\n4:file/upload\r\n5:file/download\r\n6:user/updatePassword\r\n7:user/updateNickname\r\n8:user/submitPassword\r\n9:user/submitNickname', '0');
INSERT INTO `wx_config` VALUES ('34', 'DENY_VISIT', '3', '超管专限控制器方法', '0', '', '仅超级管理员可访问的控制器方法', '1386644141', '1386644659', '1', '0:Addons/addhook\r\n1:Addons/edithook\r\n2:Addons/delhook\r\n3:Addons/updateHook\r\n4:Admin/getMenus\r\n5:Admin/recordList\r\n6:AuthManager/updateRules\r\n7:AuthManager/tree', '0');
INSERT INTO `wx_config` VALUES ('35', 'REPLY_LIST_ROWS', '0', '回复列表每页条数', '2', '', '', '1386645376', '1387178083', '1', '20', '0');
INSERT INTO `wx_config` VALUES ('36', 'ADMIN_ALLOW_IP', '2', '后台允许访问IP', '4', '', '多个用逗号分隔，如果不配置表示不限制IP访问', '1387165454', '1387165553', '1', '', '12');
INSERT INTO `wx_config` VALUES ('37', 'SHOW_PAGE_TRACE', '4', '是否显示页面Trace', '4', '0:关闭\r\n1:开启', '是否显示页面Trace信息', '1387165685', '1387165685', '1', '0', '1');
INSERT INTO `wx_config` VALUES ('38', 'WEB_SITE_VERIFY', '4', '登录验证码', '1', '0:关闭\r\n1:开启', '登录时是否需要验证码', '1378898976', '1406859544', '1', '0', '2');
INSERT INTO `wx_config` VALUES ('42', 'ACCESS', '2', '未登录时可访问的页面', '4', '', '不区分大小写', '1390656601', '1390664079', '1', 'Home/User/*\r\nHome/Index/*\r\nhome/weixin/*\r\nadmin/File/*\r\nhome/File/*\r\nhome/Forum/*\r\nHome/Material/detail', '0');
INSERT INTO `wx_config` VALUES ('44', 'DEFAULT_PUBLIC_GROUP_ID', '0', '公众号默认等级ID', '3', '', '前台新增加的公众号的默认等级，值为0表示不做权限控制，公众号拥有全部插件的权限', '1393759885', '1393759981', '1', '0', '2');
INSERT INTO `wx_config` VALUES ('45', 'SYSTEM_UPDATE_REMIND', '4', '系统升级提醒', '4', '0:关闭\r\n1:开启', '开启后官方有新升级信息会及时在后台的网站设置页面头部显示升级提醒', '1393764263', '1393764263', '1', '0', '5');
INSERT INTO `wx_config` VALUES ('46', 'SYSTEM_UPDATRE_VERSION', '0', '系统升级最新版本号', '4', '', '记录当前系统的版本号，这是与官方比较是否有升级包的唯一标识，不熟悉者只勿改变其数值', '1393764702', '1394337646', '1', '20150826', '0');
INSERT INTO `wx_config` VALUES ('47', 'FOLLOW_YOUKE_UID', '0', '粉丝游客ID', '0', '', '', '1398927704', '1398927704', '1', '-27143', '0');
INSERT INTO `wx_config` VALUES ('48', 'DEFAULT_PUBLIC', '0', '注册后默认可管理的公众号ID', '3', '', '可为空。配置用户注册后即可管理的公众号ID，多个时用英文逗号分割', '1398928794', '1398929088', '1', '', '3');
INSERT INTO `wx_config` VALUES ('49', 'DEFAULT_PUBLIC_CREATE_MAX_NUMB', '0', '默认用户最多可创建的公众号数', '3', '', '注册用户最多的创建数，也可以在用户管理里对每个用户设置不同的值', '1398949652', '1398950115', '1', '5', '4');
INSERT INTO `wx_config` VALUES ('50', 'COPYRIGHT', '1', '版权信息', '1', '', '', '1401018910', '1401018910', '1', '版本由圆梦云科技有限公司所有', '3');
INSERT INTO `wx_config` VALUES ('51', 'WEIPHP_STORE_LICENSE', '1', '应用商店授权许可证', '1', '', '要与 应用商店》网站信息 里的授权许可证保持一致', '1402972720', '1402977473', '1', '', '0');
INSERT INTO `wx_config` VALUES ('52', 'SYSTEM_LOGO', '1', '网站LOGO', '5', '', '填写LOGO的网址，为空时默认显示weiphp的logo', '1403566699', '1403566746', '1', '', '0');
INSERT INTO `wx_config` VALUES ('53', 'SYSTEM_CLOSE_REGISTER', '4', '前台注册开关', '5', '0:不关闭\r\n1:关闭', '关闭后在登录页面不再显示注册链接', '1403568006', '1403568006', '1', '0', '0');
INSERT INTO `wx_config` VALUES ('54', 'SYSTEM_CLOSE_ADMIN', '4', '后台管理开关', '5', '0:不关闭\r\n1:关闭', '关闭后在登录页面不再显示后台登录链接', '1403568006', '1403568006', '1', '0', '0');
INSERT INTO `wx_config` VALUES ('55', 'SYSTEM_CLOSE_WIKI', '4', '二次开发开关', '5', '0:不关闭\r\n1:关闭', '关闭后在登录页面不再显示二次开发链接', '1403568006', '1403568006', '1', '0', '0');
INSERT INTO `wx_config` VALUES ('56', 'SYSTEM_CLOSE_BBS', '4', '官方论坛开关', '5', '0:不关闭\r\n1:关闭', '关闭后在登录页面不再显示官方论坛链接', '1403568006', '1403568006', '1', '0', '0');
INSERT INTO `wx_config` VALUES ('57', 'LOGIN_BACKGROUP', '1', '登录界面背景图', '5', '', '请输入图片网址，为空时默认使用自带的背景图', '1403568006', '1403570059', '1', '', '0');
INSERT INTO `wx_config` VALUES ('60', 'TONGJI_CODE', '2', '第三方统计JS代码', '5', '', '', '1428634717', '1428634717', '1', '', '0');
INSERT INTO `wx_config` VALUES ('61', 'SENSITIVE_WORDS', '1', '敏感词', '0', '', '当出现有敏感词的地方，会用*号代替, (多个敏感词用 , 隔开 )', '1433125977', '1435062628', '1', 'bitch,shit', '0');
INSERT INTO `wx_config` VALUES ('63', 'PUBLIC_BIND', '4', '公众号第三方平台', '5', '0:关闭\r\n1:开启', '申请审核通过微信开放平台里的公众号第三方平台账号后，就可以开启体验了', '1434542818', '1434542818', '1', '0', '0');
INSERT INTO `wx_config` VALUES ('64', 'COMPONENT_APPID', '1', '公众号开放平台的AppID', '5', '', '公众号第三方平台开启后必填的参数', '1434542891', '1434542975', '1', '', '0');
INSERT INTO `wx_config` VALUES ('65', 'COMPONENT_APPSECRET', '1', '公众号开放平台的AppSecret', '5', '', '公众号第三方平台开启后必填的参数', '1434542936', '1434542984', '1', '', '0');
INSERT INTO `wx_config` VALUES ('62', 'REG_AUDIT', '4', '注册审核', '3', '0:需要审核\r\n1:不需要审核', '', '1439811099', '1439811099', '1', '1', '1');

-- ----------------------------
-- Table structure for `wx_coupon`
-- ----------------------------
DROP TABLE IF EXISTS `wx_coupon`;
CREATE TABLE `wx_coupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `background` int(10) unsigned DEFAULT NULL COMMENT '素材背景图',
  `keyword` varchar(100) DEFAULT NULL COMMENT '关键词',
  `use_tips` text COMMENT '使用说明',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `intro` text COMMENT '封面简介',
  `end_time` int(10) DEFAULT NULL COMMENT '领取结束时间',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '优惠券图片',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `start_time` int(10) DEFAULT NULL COMMENT '开始时间',
  `end_tips` text COMMENT '领取结束说明',
  `end_img` int(10) unsigned DEFAULT NULL COMMENT '领取结束提示图片',
  `num` int(10) unsigned DEFAULT '0' COMMENT '优惠券数量',
  `max_num` int(10) unsigned DEFAULT '1' COMMENT '每人最多允许获取次数',
  `follower_condtion` char(50) DEFAULT '1' COMMENT '粉丝状态',
  `credit_conditon` int(10) unsigned DEFAULT '0' COMMENT '积分限制',
  `credit_bug` int(10) unsigned DEFAULT '0' COMMENT '积分消费',
  `addon_condition` varchar(255) DEFAULT NULL COMMENT '插件场景限制',
  `collect_count` int(10) unsigned DEFAULT '0' COMMENT '已领取数',
  `view_count` int(10) unsigned DEFAULT '0' COMMENT '浏览人数',
  `addon` char(50) DEFAULT 'public' COMMENT '插件',
  `shop_uid` varchar(255) DEFAULT NULL COMMENT '商家管理员ID',
  `use_count` int(10) DEFAULT '0' COMMENT '已使用数',
  `pay_password` varchar(255) DEFAULT NULL COMMENT '核销密码',
  `empty_prize_tips` varchar(255) DEFAULT NULL COMMENT '奖品抽完后的提示',
  `start_tips` varchar(255) DEFAULT NULL COMMENT '活动还没开始时的提示语',
  `more_button` text COMMENT '其它按钮',
  `over_time` int(10) DEFAULT NULL COMMENT '使用的截止时间',
  `use_start_time` int(10) DEFAULT NULL COMMENT '使用开始时间',
  `shop_name` varchar(255) DEFAULT '优惠商家' COMMENT '商家名称',
  `shop_logo` int(10) unsigned DEFAULT NULL COMMENT '商家LOGO',
  `head_bg_color` varchar(255) DEFAULT '#35a2dd' COMMENT '头部背景颜色',
  `button_color` varchar(255) DEFAULT '#0dbd02' COMMENT '按钮颜色',
  `template` varchar(255) DEFAULT 'default' COMMENT '素材模板',
  `member` varchar(100) DEFAULT '0' COMMENT '选择人群',
  `is_del` int(10) DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_coupon
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_coupon_shop`
-- ----------------------------
DROP TABLE IF EXISTS `wx_coupon_shop`;
CREATE TABLE `wx_coupon_shop` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) DEFAULT NULL COMMENT '店名',
  `address` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `phone` varchar(30) DEFAULT NULL COMMENT '联系电话',
  `gps` varchar(50) DEFAULT NULL COMMENT 'GPS经纬度',
  `coupon_id` int(10) DEFAULT NULL COMMENT '所属优惠券编号',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `manager_id` int(10) DEFAULT NULL COMMENT '管理员id',
  `open_time` varchar(50) DEFAULT NULL COMMENT '营业时间',
  `img` int(10) unsigned DEFAULT NULL COMMENT '门店展示图',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_coupon_shop
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_coupon_shop_link`
-- ----------------------------
DROP TABLE IF EXISTS `wx_coupon_shop_link`;
CREATE TABLE `wx_coupon_shop_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `coupon_id` int(10) DEFAULT NULL COMMENT 'coupon_id',
  `shop_id` int(10) DEFAULT NULL COMMENT 'shop_id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_coupon_shop_link
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_credit_config`
-- ----------------------------
DROP TABLE IF EXISTS `wx_credit_config`;
CREATE TABLE `wx_credit_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '积分描述',
  `name` varchar(50) DEFAULT NULL COMMENT '积分标识',
  `mTime` int(10) DEFAULT NULL COMMENT '修改时间',
  `experience` varchar(30) DEFAULT '0' COMMENT '经验值',
  `score` varchar(30) DEFAULT '0' COMMENT '金币值',
  `token` varchar(255) DEFAULT '0' COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_credit_config
-- ----------------------------
INSERT INTO `wx_credit_config` VALUES ('1', '关注公众号', 'subscribe', '1438587911', '100', '100', '0');
INSERT INTO `wx_credit_config` VALUES ('2', '取消关注公众号', 'unsubscribe', '1438596459', '-100', '-100', '0');
INSERT INTO `wx_credit_config` VALUES ('3', '参与投票', 'vote', '1398565597', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('4', '参与调研', 'survey', '1398565640', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('5', '参与考试', 'exam', '1398565659', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('6', '参与测试', 'test', '1398565681', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('7', '微信聊天', 'chat', '1398565740', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('8', '建议意见反馈', 'suggestions', '1398565798', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('9', '会员卡绑定', 'card_bind', '1438596438', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('10', '获取优惠卷', 'coupons', '1398565926', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('11', '访问微网站', 'weisite', '1398565973', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('12', '查看自定义回复内容', 'custom_reply', '1398566068', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('13', '填写通用表单', 'forms', '1398566118', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('14', '访问微商店', 'shop', '1398566206', '0', '0', '0');
INSERT INTO `wx_credit_config` VALUES ('32', '程序自由增加', 'auto_add', '1442659667', '￥', '￥', '0');

-- ----------------------------
-- Table structure for `wx_credit_data`
-- ----------------------------
DROP TABLE IF EXISTS `wx_credit_data`;
CREATE TABLE `wx_credit_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) DEFAULT '0' COMMENT '用户ID',
  `credit_name` varchar(50) DEFAULT NULL COMMENT '积分标识',
  `experience` int(10) DEFAULT '0' COMMENT '体力值',
  `score` int(10) DEFAULT '0' COMMENT '积分值',
  `cTime` int(10) DEFAULT NULL COMMENT '记录时间',
  `admin_uid` int(10) DEFAULT '0' COMMENT '操作者UID',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `credit_title` varchar(50) DEFAULT NULL COMMENT '积分标题',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_credit_data
-- ----------------------------
INSERT INTO `wx_credit_data` VALUES ('2', '0', 'unsubscribe', '-100', '-100', '1449547033', '0', 'gh_741263a45132', '取消关注公众号');
INSERT INTO `wx_credit_data` VALUES ('4', '0', 'unsubscribe', '-100', '-100', '1449548514', '0', 'gh_741263a45132', '取消关注公众号');
INSERT INTO `wx_credit_data` VALUES ('5', '10', 'subscribe', '100', '100', '1449645830', '0', 'gh_741263a45132', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('6', '0', 'unsubscribe', '-100', '-100', '1451462483', '0', 'gh_1784a6c712f0', '取消关注公众号');
INSERT INTO `wx_credit_data` VALUES ('8', '0', 'unsubscribe', '-100', '-100', '1451462525', '0', 'gh_1784a6c712f0', '取消关注公众号');
INSERT INTO `wx_credit_data` VALUES ('10', '0', 'unsubscribe', '-100', '-100', '1451462703', '0', 'gh_1784a6c712f0', '取消关注公众号');
INSERT INTO `wx_credit_data` VALUES ('11', '51', 'subscribe', '100', '100', '1451462707', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('12', '52', 'subscribe', '100', '100', '1451872422', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('13', '54', 'subscribe', '100', '100', '1451962023', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('14', '55', 'subscribe', '100', '100', '1452135123', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('15', '56', 'subscribe', '100', '100', '1452214868', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('16', '57', 'subscribe', '100', '100', '1452218794', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('17', '58', 'subscribe', '100', '100', '1452218810', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('18', '59', 'subscribe', '100', '100', '1452218817', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('19', '60', 'subscribe', '100', '100', '1452218823', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('20', '61', 'subscribe', '100', '100', '1452218831', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('21', '0', 'unsubscribe', '-100', '-100', '1452434545', '0', 'gh_1784a6c712f0', '取消关注公众号');
INSERT INTO `wx_credit_data` VALUES ('22', '70', 'subscribe', '100', '100', '1453260089', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('24', '0', 'unsubscribe', '-100', '-100', '1453263158', '0', 'gh_1784a6c712f0', '取消关注公众号');
INSERT INTO `wx_credit_data` VALUES ('25', '72', 'subscribe', '100', '100', '1453263206', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('26', '73', 'subscribe', '100', '100', '1453263298', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('27', '74', 'subscribe', '100', '100', '1453271035', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('28', '75', 'subscribe', '100', '100', '1453792942', '0', 'gh_1784a6c712f0', '关注公众号');
INSERT INTO `wx_credit_data` VALUES ('29', '76', 'subscribe', '100', '100', '1453796644', '0', 'gh_1784a6c712f0', '关注公众号');

-- ----------------------------
-- Table structure for `wx_custom_menu`
-- ----------------------------
DROP TABLE IF EXISTS `wx_custom_menu`;
CREATE TABLE `wx_custom_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sort` tinyint(4) DEFAULT '0' COMMENT '排序号',
  `pid` int(10) DEFAULT '0' COMMENT '一级菜单',
  `title` varchar(50) NOT NULL COMMENT '菜单名',
  `keyword` varchar(100) DEFAULT NULL COMMENT '关联关键词',
  `url` varchar(255) DEFAULT NULL COMMENT '关联URL',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `type` varchar(30) DEFAULT 'click' COMMENT '类型',
  `from_type` char(50) DEFAULT '-1' COMMENT '配置动作',
  `addon` char(50) DEFAULT '0' COMMENT '选择插件',
  `target_id` int(10) DEFAULT NULL COMMENT '选择内容',
  `sucai_type` char(50) DEFAULT '0' COMMENT '素材类型',
  `jump_type` char(10) DEFAULT '0' COMMENT '推送类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_custom_menu
-- ----------------------------
INSERT INTO `wx_custom_menu` VALUES ('1', '0', '0', '查询', '', '[website]/?s=/addon/Paiqian/Wap/index/publicid/[publicid]', 'gh_be33dc482e19', 'view', '9', '0', '0', '0', '0');
INSERT INTO `wx_custom_menu` VALUES ('2', '0', '0', '查询', '', 'http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Wap/index/publicid/2', 'gh_1784a6c712f0', 'view', '9', '0', '0', '0', '0');
INSERT INTO `wx_custom_menu` VALUES ('3', '0', '0', '客服', 'custom_sucai_text_1', '', 'gh_1784a6c712f0', 'click', '1', '0', '1', '2', '0');
INSERT INTO `wx_custom_menu` VALUES ('5', '0', '0', '客服3', '03', '', 'gh_1784a6c712f0', 'click', '9', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `wx_custom_reply_mult`
-- ----------------------------
DROP TABLE IF EXISTS `wx_custom_reply_mult`;
CREATE TABLE `wx_custom_reply_mult` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `keyword_type` tinyint(2) DEFAULT '0' COMMENT '关键词类型',
  `mult_ids` varchar(255) DEFAULT NULL COMMENT '多图文ID',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_custom_reply_mult
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_custom_reply_news`
-- ----------------------------
DROP TABLE IF EXISTS `wx_custom_reply_news`;
CREATE TABLE `wx_custom_reply_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `keyword_type` tinyint(2) DEFAULT NULL COMMENT '关键词类型',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `intro` text COMMENT '简介',
  `cate_id` int(10) unsigned DEFAULT '0' COMMENT '所属类别',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '封面图片',
  `content` text COMMENT '内容',
  `cTime` int(10) DEFAULT NULL COMMENT '发布时间',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序号',
  `view_count` int(10) unsigned DEFAULT '0' COMMENT '浏览数',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `jump_url` varchar(255) DEFAULT NULL COMMENT '外链',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_custom_reply_news
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_custom_reply_text`
-- ----------------------------
DROP TABLE IF EXISTS `wx_custom_reply_text`;
CREATE TABLE `wx_custom_reply_text` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `keyword_type` tinyint(2) DEFAULT '0' COMMENT '关键词类型',
  `content` text COMMENT '回复内容',
  `view_count` int(10) unsigned DEFAULT '0' COMMENT '浏览数',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序号',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_custom_reply_text
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_custom_sendall`
-- ----------------------------
DROP TABLE IF EXISTS `wx_custom_sendall`;
CREATE TABLE `wx_custom_sendall` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `ToUserName` varchar(255) DEFAULT NULL COMMENT 'token',
  `FromUserName` varchar(255) DEFAULT NULL COMMENT 'openid',
  `cTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `msgType` varchar(255) DEFAULT NULL COMMENT '消息类型',
  `manager_id` int(10) DEFAULT NULL COMMENT '管理员id',
  `content` text COMMENT '内容',
  `media_id` varchar(255) DEFAULT NULL COMMENT '多媒体文件id',
  `is_send` int(10) DEFAULT NULL COMMENT '是否已经发送',
  `uid` int(10) DEFAULT NULL COMMENT '粉丝uid',
  `news_group_id` varchar(10) DEFAULT NULL COMMENT '图文组id',
  `video_title` varchar(255) DEFAULT NULL COMMENT '视频标题',
  `video_description` text COMMENT '视频描述',
  `video_thumb` varchar(255) DEFAULT NULL COMMENT '视频缩略图',
  `voice_id` int(10) DEFAULT NULL COMMENT '语音id',
  `image_id` int(10) DEFAULT NULL COMMENT '图片id',
  `video_id` int(10) DEFAULT NULL COMMENT '视频id',
  `send_type` int(10) DEFAULT NULL COMMENT '发送方式',
  `send_opends` text COMMENT '指定用户',
  `group_id` int(10) DEFAULT NULL COMMENT '分组id',
  `diff` int(10) DEFAULT '0' COMMENT '区分消息标识',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_custom_sendall
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_customer`
-- ----------------------------
DROP TABLE IF EXISTS `wx_customer`;
CREATE TABLE `wx_customer` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT '',
  `sex` varchar(4) DEFAULT '',
  `mobile` varchar(200) DEFAULT '',
  `tel` varchar(200) DEFAULT '',
  `email` varchar(200) DEFAULT '',
  `company` varchar(100) DEFAULT '',
  `job` varchar(20) DEFAULT '',
  `address` varchar(120) DEFAULT '',
  `website` varchar(200) DEFAULT '',
  `qq` varchar(16) DEFAULT '',
  `weixin` varchar(50) DEFAULT '',
  `yixin` varchar(50) DEFAULT '',
  `weibo` varchar(50) DEFAULT '',
  `laiwang` varchar(50) DEFAULT '',
  `remark` varchar(255) DEFAULT '',
  `origin` bigint(20) unsigned NOT NULL DEFAULT '0',
  `originName` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `createUser` varchar(32) NOT NULL DEFAULT '',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0',
  `groupId` varchar(20) NOT NULL DEFAULT '',
  `groupName` varchar(200) DEFAULT '',
  `group` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_customer
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_draw_follow_log`
-- ----------------------------
DROP TABLE IF EXISTS `wx_draw_follow_log`;
CREATE TABLE `wx_draw_follow_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `follow_id` int(10) DEFAULT NULL COMMENT '粉丝id',
  `sports_id` int(10) DEFAULT NULL COMMENT '场次id',
  `count` int(10) DEFAULT '0' COMMENT '抽奖次数',
  `uid` int(10) DEFAULT NULL COMMENT 'uid',
  `cTime` int(10) DEFAULT NULL COMMENT '支持时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  PRIMARY KEY (`id`),
  KEY `sports_id` (`sports_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_draw_follow_log
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_exam`
-- ----------------------------
DROP TABLE IF EXISTS `wx_exam`;
CREATE TABLE `wx_exam` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `keyword_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '关键词匹配类型',
  `title` varchar(255) NOT NULL COMMENT '试卷标题',
  `intro` text NOT NULL COMMENT '封面简介',
  `mTime` int(10) NOT NULL COMMENT '修改时间',
  `cover` int(10) unsigned NOT NULL COMMENT '封面图片',
  `cTime` int(10) unsigned NOT NULL COMMENT '发布时间',
  `token` varchar(255) NOT NULL COMMENT 'Token',
  `finish_tip` text NOT NULL COMMENT '结束语',
  `start_time` int(10) DEFAULT NULL COMMENT '考试开始时间',
  `end_time` int(10) DEFAULT NULL COMMENT '考试结束时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_exam
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_exam_answer`
-- ----------------------------
DROP TABLE IF EXISTS `wx_exam_answer`;
CREATE TABLE `wx_exam_answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `answer` text NOT NULL COMMENT '回答内容',
  `openid` varchar(255) NOT NULL COMMENT 'OpenId',
  `uid` int(10) unsigned NOT NULL COMMENT '用户UID',
  `question_id` int(10) unsigned NOT NULL COMMENT 'question_id',
  `cTime` int(10) unsigned NOT NULL COMMENT '发布时间',
  `token` varchar(255) NOT NULL COMMENT 'Token',
  `exam_id` int(10) unsigned NOT NULL COMMENT 'exam_id',
  `score` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '得分',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_exam_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_exam_question`
-- ----------------------------
DROP TABLE IF EXISTS `wx_exam_question`;
CREATE TABLE `wx_exam_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '题目标题',
  `intro` text NOT NULL COMMENT '题目描述',
  `cTime` int(10) unsigned NOT NULL COMMENT '发布时间',
  `token` varchar(255) NOT NULL COMMENT 'Token',
  `is_must` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否必填',
  `extra` text NOT NULL COMMENT '参数',
  `type` char(50) NOT NULL DEFAULT 'radio' COMMENT '题目类型',
  `exam_id` int(10) unsigned NOT NULL COMMENT 'exam_id',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序号',
  `score` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分值',
  `answer` varchar(255) NOT NULL COMMENT '标准答案',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_exam_question
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_extensions`
-- ----------------------------
DROP TABLE IF EXISTS `wx_extensions`;
CREATE TABLE `wx_extensions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword_type` tinyint(2) DEFAULT '0' COMMENT '关键词匹配类型',
  `api_token` varchar(255) NOT NULL COMMENT 'Token',
  `cTime` int(10) NOT NULL COMMENT '创建时间',
  `api_url` varchar(255) NOT NULL COMMENT '第三方URL',
  `output_format` tinyint(1) DEFAULT '0' COMMENT '数据输出格式',
  `keyword_filter` tinyint(2) NOT NULL DEFAULT '0' COMMENT '关键词过滤',
  `keyword` varchar(255) NOT NULL COMMENT '关键词',
  `token` varchar(255) NOT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_extensions
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_file`
-- ----------------------------
DROP TABLE IF EXISTS `wx_file`;
CREATE TABLE `wx_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `savename` char(20) NOT NULL DEFAULT '' COMMENT '保存名称',
  `savepath` char(30) NOT NULL DEFAULT '' COMMENT '文件保存路径',
  `ext` char(5) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `mime` char(40) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `location` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文件保存位置',
  `create_time` int(10) unsigned NOT NULL COMMENT '上传时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_md5` (`md5`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文件表';

-- ----------------------------
-- Records of wx_file
-- ----------------------------
INSERT INTO `wx_file` VALUES ('1', 'apiclient_cert.pem', '568cd7d406673.pem', '2016-01-06/', 'pem', 'application/octet-stream', '1606', '47288dc1178b4c88dc67f349d9893ada', 'e3230b00fe863d4f7926d5a4c27f93bc043d1f8a', '0', '1452070867');
INSERT INTO `wx_file` VALUES ('2', 'apiclient_key.pem', '568cd7d831ec1.pem', '2016-01-06/', 'pem', 'application/octet-stream', '1704', '4818c3303d67fc9d78ce8fbb0279354e', '30e0fe00520e9146aa3dc876bc86e9de5a659b8b', '0', '1452070872');

-- ----------------------------
-- Table structure for `wx_forms`
-- ----------------------------
DROP TABLE IF EXISTS `wx_forms`;
CREATE TABLE `wx_forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `password` varchar(255) DEFAULT NULL COMMENT '表单密码',
  `keyword_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '关键词类型',
  `jump_url` varchar(255) DEFAULT NULL COMMENT '提交后跳转的地址',
  `content` text COMMENT '详细介绍',
  `finish_tip` text COMMENT '用户提交后提示内容',
  `can_edit` tinyint(2) DEFAULT '0' COMMENT '是否允许编辑',
  `intro` text COMMENT '封面简介',
  `mTime` int(10) DEFAULT NULL COMMENT '修改时间',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '封面图片',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `template` varchar(255) DEFAULT 'default' COMMENT '模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_forms
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_forms_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `wx_forms_attribute`;
CREATE TABLE `wx_forms_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `is_show` tinyint(2) DEFAULT '1' COMMENT '是否显示',
  `forms_id` int(10) unsigned DEFAULT NULL COMMENT '表单ID',
  `error_info` varchar(255) DEFAULT NULL COMMENT '出错提示',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序号',
  `validate_rule` varchar(255) DEFAULT NULL COMMENT '正则验证',
  `is_must` tinyint(2) DEFAULT NULL COMMENT '是否必填',
  `remark` varchar(255) DEFAULT NULL COMMENT '字段备注',
  `name` varchar(100) DEFAULT NULL COMMENT '字段名',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `value` varchar(255) DEFAULT NULL COMMENT '默认值',
  `title` varchar(255) NOT NULL COMMENT '字段标题',
  `mTime` int(10) DEFAULT NULL COMMENT '修改时间',
  `extra` text COMMENT '参数',
  `type` char(50) NOT NULL DEFAULT 'string' COMMENT '字段类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_forms_attribute
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_forms_value`
-- ----------------------------
DROP TABLE IF EXISTS `wx_forms_value`;
CREATE TABLE `wx_forms_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `forms_id` int(10) unsigned DEFAULT NULL COMMENT '表单ID',
  `value` text COMMENT '表单值',
  `cTime` int(10) DEFAULT NULL COMMENT '增加时间',
  `openid` varchar(255) DEFAULT NULL COMMENT 'OpenId',
  `uid` int(10) DEFAULT NULL COMMENT '用户ID',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_forms_value
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_forum`
-- ----------------------------
DROP TABLE IF EXISTS `wx_forum`;
CREATE TABLE `wx_forum` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `uid` int(10) DEFAULT '0' COMMENT '用户ID',
  `content` text COMMENT '内容',
  `cTime` int(10) DEFAULT NULL COMMENT '发布时间',
  `attach` varchar(255) DEFAULT NULL COMMENT '附件',
  `is_top` int(10) DEFAULT '0' COMMENT '置顶',
  `cid` tinyint(4) DEFAULT NULL COMMENT '分类',
  `view_count` int(11) unsigned DEFAULT '0' COMMENT '浏览数',
  `reply_count` int(11) unsigned DEFAULT '0' COMMENT '回复数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_forum
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_guess`
-- ----------------------------
DROP TABLE IF EXISTS `wx_guess`;
CREATE TABLE `wx_guess` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) DEFAULT NULL COMMENT '竞猜标题',
  `desc` text COMMENT '活动说明',
  `start_time` int(10) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(10) DEFAULT NULL COMMENT '结束时间',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `guess_count` int(10) unsigned DEFAULT '0',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `template` varchar(255) DEFAULT 'default' COMMENT '素材模板',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '主题图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_guess
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_guess_log`
-- ----------------------------
DROP TABLE IF EXISTS `wx_guess_log`;
CREATE TABLE `wx_guess_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(10) unsigned DEFAULT '0' COMMENT '用户ID',
  `guess_id` int(10) unsigned DEFAULT '0' COMMENT '竞猜Id',
  `token` varchar(255) DEFAULT NULL COMMENT '用户token',
  `optionIds` varchar(255) DEFAULT NULL COMMENT '用户猜的选项IDs',
  `cTime` int(10) DEFAULT NULL COMMENT '创时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_guess_log
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_guess_option`
-- ----------------------------
DROP TABLE IF EXISTS `wx_guess_option`;
CREATE TABLE `wx_guess_option` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `guess_id` int(10) DEFAULT '0' COMMENT '竞猜活动的Id',
  `name` varchar(255) DEFAULT NULL COMMENT '选项名称',
  `image` int(10) unsigned DEFAULT NULL COMMENT '选项图片',
  `order` int(10) DEFAULT '0' COMMENT '选项顺序',
  `guess_count` int(10) unsigned DEFAULT '0' COMMENT '竞猜人数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_guess_option
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_hooks`
-- ----------------------------
DROP TABLE IF EXISTS `wx_hooks`;
CREATE TABLE `wx_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` text NOT NULL COMMENT '钩子挂载的插件 ''，''分割',
  PRIMARY KEY (`id`),
  UNIQUE KEY `搜索索引` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='插件钩子表';

-- ----------------------------
-- Records of wx_hooks
-- ----------------------------
INSERT INTO `wx_hooks` VALUES ('1', 'pageHeader', '页面header钩子，一般用于加载插件CSS文件和代码', '1', '0', '');
INSERT INTO `wx_hooks` VALUES ('2', 'pageFooter', '页面footer钩子，一般用于加载插件JS文件和JS代码', '1', '0', 'ReturnTop');
INSERT INTO `wx_hooks` VALUES ('3', 'documentEditForm', '添加编辑表单的 扩展内容钩子', '1', '0', '');
INSERT INTO `wx_hooks` VALUES ('4', 'documentDetailAfter', '文档末尾显示', '1', '0', 'SocialComment');
INSERT INTO `wx_hooks` VALUES ('5', 'documentDetailBefore', '页面内容前显示用钩子', '1', '0', '');
INSERT INTO `wx_hooks` VALUES ('6', 'documentSaveComplete', '保存文档数据后的扩展钩子', '2', '0', '');
INSERT INTO `wx_hooks` VALUES ('7', 'documentEditFormContent', '添加编辑表单的内容显示钩子', '1', '0', 'Editor');
INSERT INTO `wx_hooks` VALUES ('8', 'adminArticleEdit', '后台内容编辑页编辑器', '1', '1378982734', 'EditorForAdmin');
INSERT INTO `wx_hooks` VALUES ('13', 'AdminIndex', '首页小格子个性化显示', '1', '1382596073', 'SiteStat,SystemInfo,DevTeam');
INSERT INTO `wx_hooks` VALUES ('14', 'topicComment', '评论提交方式扩展钩子。', '1', '1380163518', 'Editor');
INSERT INTO `wx_hooks` VALUES ('16', 'app_begin', '应用开始', '2', '1384481614', '');
INSERT INTO `wx_hooks` VALUES ('17', 'weixin', '微信插件必须加载的钩子', '1', '1388810858', 'Hitegg,Diy,RedBag,WeMedia,ShopCoupon,Card,SingIn,Seckill,CustomMenu,CustomReply,AutoReply,WeiSite,UserCenter,Exam,Draw,Extensions,Forms,Coupon,Guess,Comment,Game,ConfigureAccount,CardVouchers,Ask,HelloWorld,Invite,Tongji,Test,Vote,Sms,Survey,Wecome,WishCard,Scratch,YouaskService,RealPrize,Xydzp,Reserve,Payment,Leaflets,NoAnswer,Paiqian,TestCms');
INSERT INTO `wx_hooks` VALUES ('18', 'cascade', '级联菜单', '1', '1398694587', 'Cascade');
INSERT INTO `wx_hooks` VALUES ('19', 'page_diy', '万能页面的钩子', '1', '1399040364', 'Diy');
INSERT INTO `wx_hooks` VALUES ('20', 'dynamic_select', '动态下拉菜单', '1', '1435223189', 'DynamicSelect');
INSERT INTO `wx_hooks` VALUES ('21', 'news', '图文素材选择', '1', '1439196828', 'News');

-- ----------------------------
-- Table structure for `wx_import`
-- ----------------------------
DROP TABLE IF EXISTS `wx_import`;
CREATE TABLE `wx_import` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `attach` int(10) unsigned NOT NULL COMMENT '上传文件',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_import
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_invite`
-- ----------------------------
DROP TABLE IF EXISTS `wx_invite`;
CREATE TABLE `wx_invite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `keyword_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '关键词类型',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `intro` text COMMENT '封面简介',
  `mTime` int(10) DEFAULT NULL COMMENT '修改时间',
  `cover` int(10) unsigned NOT NULL COMMENT '封面图片',
  `experience` int(10) DEFAULT '0' COMMENT '消耗经验值',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `num` int(10) DEFAULT '0' COMMENT '邀请人数',
  `coupon_id` int(10) DEFAULT NULL COMMENT '优惠券编号',
  `coupon_num` int(10) DEFAULT '0' COMMENT '优惠券数',
  `receive_num` int(10) DEFAULT '0' COMMENT '已领取优惠券数',
  `content` text COMMENT '邀约介绍',
  `template` varchar(255) DEFAULT 'default' COMMENT '模板名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_invite
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_invite_code`
-- ----------------------------
DROP TABLE IF EXISTS `wx_invite_code`;
CREATE TABLE `wx_invite_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_invite_code
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_invite_user`
-- ----------------------------
DROP TABLE IF EXISTS `wx_invite_user`;
CREATE TABLE `wx_invite_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `uid` int(10) DEFAULT NULL COMMENT '用户ID',
  `invite_id` int(10) DEFAULT NULL COMMENT '邀约ID',
  `invite_num` int(10) DEFAULT NULL COMMENT '已邀请人数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_invite_user
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_join_count`
-- ----------------------------
DROP TABLE IF EXISTS `wx_join_count`;
CREATE TABLE `wx_join_count` (
  `follow_id` int(10) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aim_id` int(10) DEFAULT NULL,
  `count` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fid_aim` (`follow_id`,`aim_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_join_count
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_keyword`
-- ----------------------------
DROP TABLE IF EXISTS `wx_keyword`;
CREATE TABLE `wx_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `addon` varchar(255) NOT NULL COMMENT '关键词所属插件',
  `aim_id` int(10) unsigned NOT NULL COMMENT '插件表里的ID值',
  `cTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `keyword_length` int(10) unsigned DEFAULT '0' COMMENT '关键词长度',
  `keyword_type` tinyint(2) DEFAULT '0' COMMENT '匹配类型',
  `extra_text` text COMMENT '文本扩展',
  `extra_int` int(10) DEFAULT NULL COMMENT '数字扩展',
  `request_count` int(10) DEFAULT '0' COMMENT '请求数',
  PRIMARY KEY (`id`),
  KEY `keyword_token` (`keyword`,`token`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_keyword
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_lottery_games`
-- ----------------------------
DROP TABLE IF EXISTS `wx_lottery_games`;
CREATE TABLE `wx_lottery_games` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) DEFAULT NULL COMMENT '活动名称',
  `game_type` char(10) DEFAULT '1' COMMENT '游戏类型',
  `status` char(10) DEFAULT '1' COMMENT '状态',
  `start_time` int(10) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(10) DEFAULT NULL COMMENT '结束时间',
  `day_attend_limit` int(10) DEFAULT '0' COMMENT '每人每天抽奖次数',
  `attend_limit` int(10) DEFAULT '0' COMMENT '每人总共抽奖次数',
  `day_win_limit` int(10) DEFAULT '0' COMMENT '每人每天中奖次数',
  `win_limit` int(10) DEFAULT '0' COMMENT '每人总共中奖次数',
  `day_winners_count` int(10) DEFAULT '0' COMMENT '每天最多中奖人数',
  `url` varchar(300) DEFAULT NULL COMMENT '关注链接',
  `remark` text COMMENT '活动说明',
  `keyword` varchar(255) DEFAULT NULL COMMENT '微信关键词',
  `attend_num` int(10) DEFAULT '0' COMMENT '参与总人数',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `manager_id` int(10) DEFAULT NULL COMMENT '管理员id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_lottery_games
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_lottery_games_award_link`
-- ----------------------------
DROP TABLE IF EXISTS `wx_lottery_games_award_link`;
CREATE TABLE `wx_lottery_games_award_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `award_id` int(10) DEFAULT NULL COMMENT '奖品id',
  `games_id` int(10) DEFAULT NULL COMMENT '抽奖游戏id',
  `grade` varchar(255) DEFAULT NULL COMMENT '中奖等级',
  `num` int(10) DEFAULT NULL COMMENT '奖品数量',
  `max_count` int(10) DEFAULT NULL COMMENT '最多抽奖',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_lottery_games_award_link
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_lottery_prize_list`
-- ----------------------------
DROP TABLE IF EXISTS `wx_lottery_prize_list`;
CREATE TABLE `wx_lottery_prize_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sports_id` int(10) DEFAULT NULL COMMENT '活动编号',
  `award_id` varchar(255) DEFAULT NULL COMMENT '奖品编号',
  `award_num` int(10) DEFAULT NULL COMMENT '奖品数量',
  `uid` int(10) DEFAULT NULL COMMENT 'uid',
  PRIMARY KEY (`id`),
  KEY `sports_id` (`sports_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_lottery_prize_list
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_lucky_follow`
-- ----------------------------
DROP TABLE IF EXISTS `wx_lucky_follow`;
CREATE TABLE `wx_lucky_follow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) DEFAULT NULL COMMENT 'uid',
  `draw_id` int(10) DEFAULT NULL COMMENT '活动编号',
  `sport_id` int(10) DEFAULT NULL COMMENT '场次编号',
  `award_id` int(10) DEFAULT NULL COMMENT '奖品编号',
  `follow_id` int(10) DEFAULT NULL COMMENT '粉丝id',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `num` int(10) DEFAULT '0' COMMENT '获奖数',
  `state` tinyint(2) DEFAULT '0' COMMENT '兑奖状态',
  `zjtime` int(10) DEFAULT NULL COMMENT '中奖时间',
  `djtime` int(10) DEFAULT NULL COMMENT '兑奖时间',
  `remark` text COMMENT '备注',
  `aim_table` varchar(255) DEFAULT NULL COMMENT '活动标识',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `scan_code` varchar(255) DEFAULT NULL COMMENT '核销码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_lucky_follow
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_lzwg_activities`
-- ----------------------------
DROP TABLE IF EXISTS `wx_lzwg_activities`;
CREATE TABLE `wx_lzwg_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) DEFAULT NULL COMMENT '活动名称',
  `remark` text COMMENT '活动描述',
  `logo_img` int(10) unsigned DEFAULT NULL COMMENT '活动LOGO',
  `start_time` int(10) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(10) DEFAULT NULL COMMENT '结束时间',
  `get_prize_tip` varchar(255) DEFAULT NULL COMMENT '中奖提示信息',
  `no_prize_tip` varchar(255) DEFAULT NULL COMMENT '未中奖提示信息',
  `ctime` int(10) DEFAULT NULL COMMENT '活动创建时间',
  `uid` int(10) DEFAULT NULL COMMENT 'uid',
  `lottery_number` int(10) DEFAULT '1' COMMENT '抽奖次数',
  `comment_status` char(10) DEFAULT '0' COMMENT '评论是否需要审核',
  `get_prize_count` int(10) DEFAULT '1' COMMENT '中奖次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_lzwg_activities
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_lzwg_activities_vote`
-- ----------------------------
DROP TABLE IF EXISTS `wx_lzwg_activities_vote`;
CREATE TABLE `wx_lzwg_activities_vote` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `lzwg_id` int(10) DEFAULT NULL COMMENT '活动编号',
  `lzwg_type` char(10) DEFAULT '0' COMMENT '活动类型',
  `vote_id` int(10) DEFAULT NULL COMMENT '题目编号',
  `vote_type` char(10) DEFAULT '1' COMMENT '问题类型',
  `vote_limit` int(10) DEFAULT NULL COMMENT '最多选择几项',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_lzwg_activities_vote
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_manager`
-- ----------------------------
DROP TABLE IF EXISTS `wx_manager`;
CREATE TABLE `wx_manager` (
  `uid` int(10) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `has_public` tinyint(2) DEFAULT '0' COMMENT '是否配置公众号',
  `headface_url` int(10) unsigned DEFAULT NULL COMMENT '管理员头像',
  `GammaAppId` varchar(30) DEFAULT NULL COMMENT '摇电视的AppId',
  `GammaSecret` varchar(100) DEFAULT NULL COMMENT '摇电视的Secret',
  `copy_right` varchar(255) DEFAULT NULL COMMENT '授权信息',
  `tongji_code` text COMMENT '统计代码',
  `website_logo` int(10) unsigned DEFAULT NULL COMMENT '网站LOGO',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_manager
-- ----------------------------
INSERT INTO `wx_manager` VALUES ('1', '1', '21', null, null, '', '', '16');

-- ----------------------------
-- Table structure for `wx_manager_menu`
-- ----------------------------
DROP TABLE IF EXISTS `wx_manager_menu`;
CREATE TABLE `wx_manager_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `menu_type` tinyint(2) DEFAULT '0' COMMENT '菜单类型',
  `pid` varchar(50) DEFAULT '0' COMMENT '上级菜单',
  `title` varchar(50) DEFAULT NULL COMMENT '菜单名',
  `url_type` tinyint(2) DEFAULT '0' COMMENT '链接类型',
  `addon_name` varchar(30) DEFAULT NULL COMMENT '插件名',
  `url` varchar(255) DEFAULT NULL COMMENT '外链',
  `target` char(50) DEFAULT '_self' COMMENT '打开方式',
  `is_hide` tinyint(2) DEFAULT '0' COMMENT '是否隐藏',
  `sort` int(10) DEFAULT '0' COMMENT '排序号',
  `uid` int(10) DEFAULT NULL COMMENT '管理员ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=364 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_manager_menu
-- ----------------------------
INSERT INTO `wx_manager_menu` VALUES ('14', '0', '', '首页', '1', '', 'home/index/main', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('15', '0', '', '用户管理', '0', 'UserCenter', '', '_self', '0', '1', '1');
INSERT INTO `wx_manager_menu` VALUES ('16', '1', '15', '微信用户', '0', 'UserCenter', '', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('17', '0', '', '互动应用', '0', 'Vote', '', '_self', '0', '2', '1');
INSERT INTO `wx_manager_menu` VALUES ('18', '1', '17', '普通投票', '0', 'Vote', '', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('19', '1', '17', '微调研', '0', 'Survey', '', '_self', '0', '1', '1');
INSERT INTO `wx_manager_menu` VALUES ('20', '1', '17', '刮刮卡', '0', 'Scratch', '', '_self', '0', '2', '1');
INSERT INTO `wx_manager_menu` VALUES ('30', '1', '17', '微邀约', '0', 'Invite', '', '_self', '0', '12', '1');
INSERT INTO `wx_manager_menu` VALUES ('22', '1', '17', '大转盘', '0', 'Xydzp', '', '_self', '0', '4', '1');
INSERT INTO `wx_manager_menu` VALUES ('23', '1', '17', '通用表单', '0', 'Forms', '', '_self', '0', '5', '1');
INSERT INTO `wx_manager_menu` VALUES ('24', '1', '17', '竞猜', '0', 'Guess', '', '_self', '0', '6', '1');
INSERT INTO `wx_manager_menu` VALUES ('25', '1', '17', '微贺卡', '0', 'WishCard', '', '_self', '0', '7', '1');
INSERT INTO `wx_manager_menu` VALUES ('26', '1', '17', '微信卡券', '0', 'CardVouchers', '', '_self', '0', '8', '1');
INSERT INTO `wx_manager_menu` VALUES ('27', '1', '17', '优惠券', '0', 'Coupon', '', '_self', '0', '9', '1');
INSERT INTO `wx_manager_menu` VALUES ('29', '1', '17', '实物奖励', '0', 'RealPrize', '', '_self', '0', '11', '1');
INSERT INTO `wx_manager_menu` VALUES ('46', '1', '45', '欢迎语设置', '0', 'Wecome', '', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('44', '1', '15', '微信咨询', '1', '', 'home/WeixinMessage/lists', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('45', '0', '', '公众号功能', '0', 'Wecome', '', '_self', '0', '1', '1');
INSERT INTO `wx_manager_menu` VALUES ('41', '1', '15', '用户分组', '1', '', 'home/AuthGroup/lists', '_self', '0', '2', '1');
INSERT INTO `wx_manager_menu` VALUES ('42', '1', '15', '用户积分', '1', '', 'home/CreditConfig/lists', '_self', '0', '3', '1');
INSERT INTO `wx_manager_menu` VALUES ('43', '1', '15', '群发消息', '1', '', 'home/Message/add', '_self', '0', '4', '1');
INSERT INTO `wx_manager_menu` VALUES ('47', '1', '45', '自定义菜单', '0', 'CustomMenu', '', '_self', '0', '1', '1');
INSERT INTO `wx_manager_menu` VALUES ('48', '1', '45', '自动回复', '0', 'AutoReply', '', '_self', '0', '2', '1');
INSERT INTO `wx_manager_menu` VALUES ('49', '1', '45', '微信宣传页', '0', 'Leaflets', '', '_self', '0', '3', '1');
INSERT INTO `wx_manager_menu` VALUES ('59', '1', '45', '支付配置', '1', '', 'Payment://Payment/lists', '_self', '0', '9', '1');
INSERT INTO `wx_manager_menu` VALUES ('60', '0', '', '素材管理', '1', '', 'Home/Material/material_lists', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('339', '1', '45', '未识别回复', '0', 'NoAnswer', '', '_self', '0', '1', '1');
INSERT INTO `wx_manager_menu` VALUES ('360', '1', '45', '测试CMS', '0', 'TestCms', '', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('345', '1', '17', '比赛投票', '1', '', 'Vote://ShopVote/lists', '_self', '0', '1', '1');
INSERT INTO `wx_manager_menu` VALUES ('349', '1', '17', '微预约', '0', 'Reserve', '', '_self', '0', '9', '1');
INSERT INTO `wx_manager_menu` VALUES ('350', '1', '17', '抽奖游戏', '1', '', 'Draw://Games/lists', '_self', '0', '19', '1');
INSERT INTO `wx_manager_menu` VALUES ('351', '1', '17', '微考试', '0', 'Exam', '', '_self', '0', '4', '1');
INSERT INTO `wx_manager_menu` VALUES ('352', '1', '17', '微测试', '0', 'Test', '', '_self', '0', '5', '1');
INSERT INTO `wx_manager_menu` VALUES ('353', '1', '17', '微抢答', '0', 'Ask', '', '_self', '0', '12', '1');
INSERT INTO `wx_manager_menu` VALUES ('363', '1', '45', '多客服管理', '0', 'YouaskService', '', '_self', '0', '10', '1');
INSERT INTO `wx_manager_menu` VALUES ('362', '0', '361', '自定义', '0', 'CustomReply', '', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('356', '0', '', '派遣管理', '1', '', 'Paiqian://Slideshow/lists', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('357', '1', '356', '首页幻灯片', '1', '', 'Paiqian://Slideshow/lists', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('358', '1', '356', '资讯分类', '1', '', 'Paiqian://Category/lists', '_self', '0', '0', '1');
INSERT INTO `wx_manager_menu` VALUES ('359', '1', '356', '资讯配置', '1', '', 'Paiqian://Cms/lists', '_self', '0', '0', '1');

-- ----------------------------
-- Table structure for `wx_material_file`
-- ----------------------------
DROP TABLE IF EXISTS `wx_material_file`;
CREATE TABLE `wx_material_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `file_id` int(10) DEFAULT NULL COMMENT '上传文件',
  `cover_url` varchar(255) DEFAULT NULL COMMENT '本地URL',
  `media_id` varchar(100) DEFAULT '0' COMMENT '微信端图文消息素材的media_id',
  `wechat_url` varchar(255) DEFAULT NULL COMMENT '微信端的文件地址',
  `cTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `manager_id` int(10) DEFAULT NULL COMMENT '管理员ID',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `title` varchar(100) DEFAULT NULL COMMENT '素材名称',
  `type` int(10) DEFAULT NULL COMMENT '类型',
  `introduction` text COMMENT '描述',
  `is_use` int(10) DEFAULT '1' COMMENT '可否使用',
  `aim_id` int(10) DEFAULT NULL COMMENT '添加来源标识id',
  `aim_table` varchar(255) DEFAULT NULL COMMENT '来源表名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_material_file
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_material_image`
-- ----------------------------
DROP TABLE IF EXISTS `wx_material_image`;
CREATE TABLE `wx_material_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cover_id` int(10) DEFAULT NULL COMMENT '图片在本地的ID',
  `cover_url` varchar(255) DEFAULT NULL COMMENT '本地URL',
  `media_id` varchar(100) DEFAULT '0' COMMENT '微信端图文消息素材的media_id',
  `wechat_url` varchar(255) DEFAULT NULL COMMENT '微信端的图片地址',
  `cTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `manager_id` int(10) DEFAULT NULL COMMENT '管理员ID',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `is_use` int(10) DEFAULT '1' COMMENT '可否使用',
  `aim_id` int(10) DEFAULT NULL COMMENT '添加来源标识id',
  `aim_table` varchar(255) DEFAULT NULL COMMENT '来源表名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_material_image
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_material_news`
-- ----------------------------
DROP TABLE IF EXISTS `wx_material_news`;
CREATE TABLE `wx_material_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `author` varchar(30) DEFAULT NULL COMMENT '作者',
  `cover_id` int(10) unsigned DEFAULT NULL COMMENT '封面',
  `intro` varchar(255) DEFAULT NULL COMMENT '摘要',
  `content` longtext COMMENT '内容',
  `link` varchar(255) DEFAULT NULL COMMENT '外链',
  `group_id` int(10) DEFAULT '0' COMMENT '多图文组的ID',
  `thumb_media_id` varchar(100) DEFAULT NULL COMMENT '图文消息的封面图片素材id（必须是永久mediaID）',
  `media_id` varchar(100) DEFAULT '0' COMMENT '微信端图文消息素材的media_id',
  `manager_id` int(10) DEFAULT NULL COMMENT '管理员ID',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `cTime` int(10) DEFAULT NULL COMMENT '发布时间',
  `url` varchar(255) DEFAULT NULL COMMENT '图文页url',
  `is_use` int(10) DEFAULT '1' COMMENT '可否使用',
  `aim_id` int(10) DEFAULT NULL COMMENT '添加来源标识id',
  `aim_table` varchar(255) DEFAULT NULL COMMENT '来源表名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_material_news
-- ----------------------------
INSERT INTO `wx_material_news` VALUES ('11', '  商品房过剩总库存21亿平方米 楼市进过剩时代', '', '20', '  商品房过剩总库存21亿平方米 楼市进过剩时代', '<p><span style=\"color: rgb(34, 34, 34); font-family: Consolas, \'Lucida Console\', monospace; font-size: 12px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">　　报告称，2016年中国楼市内部条件与外部环境并不乐观，在此背景下，房价存在较大幅度下跌的波动运行可能性，但由于宏观政策进一步宽松，房地产市场不会硬着陆。</span></p>', 'http://www.paiqian.qn/index.php?s=/addon/Paiqian/Wap/cmsDetail/id/5/publicid/1.html', '11', null, '0', '1', 'gh_be33dc482e19', '1451294193', null, '1', '5', 'paiqian_news');
INSERT INTO `wx_material_news` VALUES ('12', '快递包裹：中国邮政温柔的进击之举', '', '15', '有鉴于此，所以说，即便一线城市已经没有市场，纵使不去收“份子钱”，基于现有的优势，再充分利用占据的各种资源，借助国家当下“互联网+农村”、“互联网+外贸”的政策大势，邮政打一场漂亮的翻身仗也不是没有可能。', '<p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">据1月12日《每日经济新闻》报道，日前中国邮政内部下发了一份《中国邮政包裹快递业务改革方案》（以下简称《方案》），将现行邮政公司和速递物流公司（EMS）分别经营的包裹快递业务产品进行了整合。并且，包裹快递业务产品管理权统一收归集团公司。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">进而言之，即将原EMS经济快递、国内小包和快递包裹整合为一个产品，新产品名为“快递包裹”。整合后，国内产品体系分为标准快递、快递包裹、普通包裹三种。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">所谓的“快递包裹”，大抵就是这么一回事。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-style: inherit; font-variant: inherit; font-weight: 800; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">进击的“快递包裹”，其实也是纠偏</span></p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">在电子商务物流迅猛发展的今天，寄递业务备受民营快递冲击的邮政，此次推出“快递包裹”，整合整个包裹快递业务，虽是进击之举，但其实也有纠偏之意。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">事情还得从EMS自身说起。作为邮政集团的子公司，EMS伊始时的市场定位是清晰的。比方说，以高质量为用户传递国际、国内紧急信函、文件资料、金融票据、商品货样等各类文件资料和物品。在集团内部不存在职能交叉的情况，甚至扮演着邮政市场化之路先行者的角色。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">然而，当快递物流市场、资本市场和监管等全方位发生激变的时候，EMS却显得跟不上发展的脚步。典型如EMS在2013年12月底突然主动撤回IPO申请，而直接原因就在于市场激烈竞争的倒逼。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">据悉，彼时“通达系”（一般指申通、中通、圆通、韵达）一级梯队已经占据了整个中国快递市场80%以上的份额，EMS或许连20%都不到；在2009年—2011年三年内，EMS的营收增长已连续低于行业平均水平。须知，1999年的时候，EMS的市场份额可是有90%以上。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">屋漏偏逢连夜雨。当EMS放下身段，在产品、服务、价格等方面改变策略，以低姿态抢夺客户的时候，不可避免的又与邮政的普邮业务发生冲突。比如邮政小包和EMS的易邮宝，就存在明显的竞争关系。而一旦各自的生产、销售、利润等任务一下来，难免就会出现内耗的问题。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">以上种种，显然也是邮政推出“快递包裹”的原因。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-style: inherit; font-variant: inherit; font-weight: 800; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">夹缝中的“快递包裹”，难以激起涟漪</span></p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">当然，与“快递包裹”配套，邮政也有另外的举措。正如新闻报道中所述，一方面，快递包裹将主要满足国内电商包裹快递市场需求，帮助EMS提升电商市场份额（快递包裹虽比普通包裹价格高，但相比顺丰、“通达系”等仍比较低）。另一方面，邮政航空刚刚购买了17架波音飞机，将持续提升EMS航空标准件的竞争力。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">如此一来，在价格上走中间路线，避免“通达系”的正面冲击，在运力上走空运快线，实现差异化竞争，由此超越“通达系”和快递新势力（德邦、远成等零担快运和京东、亚马逊、苏宁等自营快递）。但一切又果真会照此发展？</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">根据《中国快递行业发展报告2014》，在业务量、业务收入等方面，除了国际及港澳邮件领域，民营快递都占据8成以上，基本上甩以邮政为代表的国有快递好几条街。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">再说2015年，1年时间内，中国快递业务量从100亿件发展到200亿件，快递行业可谓形式一片大好。但邮政普遍服务业务却逐步萎缩。来自国家邮政局的数据显示，2015年1~4月，邮政函件业务累计完成16.7亿件，同比下降17.1%；包裹业务累计完成1905.8万件，同比下降5.9%；报纸业务累计完成62.2亿份，同比下降1.5%；杂志业务累计完成3.5亿份，同比下降4.5%；汇兑业务累计完成2910万笔，同比下降41%。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">竞争性业务领域的市场份额更是难堪，如今EMS大抵只有10%的样子。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">由此可见，在快递产业蓬勃兴起的时候，邮政不管是垄断的普遍服务业务，抑或竞争性业务，却都是全线失守。如今单靠一招“快递包裹”，显然无法挽回败局。因为问题已涉及到邮政那僵化且庞大的体制。要想华丽转身，唯有对制度、职能、架构等进行刮骨疗伤，方有胜算。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">更何况，“快递包裹”也有明显不足。走中间价格路线的快递包裹，把普通包裹的价格也顺便拉高两倍，势必会进一步影响到邮政普遍服务业务。另一方面，当前，民生快递的生态链越来越多地被电商巨头遥控，拥有订单和大数据的企业才是链主企业，但“快递包裹”只字未提——值得一提的是，2014年6月份，邮政与阿里的联姻曾轰轰烈烈，但吊诡的是，如今阿里的物流战车上捆绑最紧的有圆通、苏宁物流、韵达等等，却偏偏少了邮政。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-style: inherit; font-variant: inherit; font-weight: 800; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">手握好牌，邮政应该更激进</span></p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">说到底，“快递包裹”之举失之温柔。在全面深化改革的路上，在“规范经营决策、资产保值增值、公平参与竞争、提高企业效率、增强企业活力、承担社会责任”（交通部部长杨传堂语）等方面，手握好牌的邮政，应该更激进一些。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">作为国企，邮政的既有优势是显而易见的。比如，众所周知，农村市场是电商发展的下一个蓝海。阿里研究院预计，2016年全国农村网购市场预计将突破4600亿元。更有数据显示，未来农资市场容量有望超过1.5万亿元、农产品市场容量超过4万亿元。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">正是如此，京东、阿里等电商企业已纷纷开始发力农村市场。如此一来，唯一一张能够覆盖全国农村、校园、偏远极寒地的无盲区物流快递网络，拥有快递服务营业网点11.8万处，包括村邮站、三农服务站、社区服务店的中国邮政，无疑就有着先发优势。因为截至目前，顺丰、三通一达等快递网络基本上都只能到达县级城镇，从县级到村级物流的覆盖及建站，很大程度上还是一大空白。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">再如跨境电商包裹快递市场。与农村电商相似，首先是市场潜力极大。预测2020年全球跨境B2C电商交易额将达到9940亿美元，惠及9.43亿全球消费者。中国有望成为全球最大的跨境B2C消费市场，中国跨境进出口电商将带动全球跨境消费年均增速拉高近4%。其次，则是因为体制缘故，在万国邮联的通关方面，在成本方面，相比民营、外资快递，邮政具有极大的优势。比如，邮政在海关、航空等部门均享有优先处理权。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">有鉴于此，所以说，即便一线城市已经没有市场，纵使不去收“份子钱”，基于现有的优势，再充分利用占据的各种资源，借助国家当下“互联网+农村”、“互联网+外贸”的政策大势，邮政打一场漂亮的翻身仗也不是没有可能。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">一言以蔽之，改造传统实物传输网络，完善物流基础设施建设，提升整个物流服务水平，盘活现有资产，关键看邮政有没有突破体制藩篱的决心和毅力。</p><p><br/></p>', 'http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Wap/cmsDetail/id/6/publicid/2.html', '12', null, '0', '1', 'gh_1784a6c712f0', '1452836791', null, '1', '6', 'paiqian_news');
INSERT INTO `wx_material_news` VALUES ('10', '  商品房过剩总库存21亿平方米 楼市进过剩时代', '', '14', '报告称，2016年中国楼市内部条件与外部环境并不乐观，在此背景下，房价存在较大幅度下跌的波动运行可能性，但由于宏观政策进一步宽松，房地产市场不会硬着陆', '<div class=\"TRS_Editor\"><p>　\r\n　中国社会科学院财经战略研究院3日发布《中国住房报告（2015-2016）》。报告指出，2015年房地产市场的住房形势超出预期。一方面投资增速呈\r\n俯冲式下降，对经济增长直接贡献几乎为零；另一方面，库存高企，去化压力增大，商品住房过剩总库存高达21亿平方米，仅现房库存去化就需23至24个月。\r\n与此同时，住房市场步入“结构性过剩”时代，内部结构失衡，“一线城市供求矛盾突出”与“三四线城市供过于求”并存。</p><p>　　报告称，2016年中国楼市内部条件与外部环境并不乐观，在此背景下，房价存在较大幅度下跌的波动运行可能性，但由于宏观政策进一步宽松，房地产市场不会硬着陆。</p><p>　　<strong>加剧 现房库存去化周期高达24个月</strong></p><p>　　报告指出，今年以来，虽然宏观政策一再宽松，商品住房库存去化却难见好转。作为代表开发商预期、潜在库存以及市场需求的新开工面积、施工面积以及竣工面积三个典型指标，虽然整体趋缓，供应量减少，但待售库存压力却没有较大缓解。</p><p>　　具体来看，新开工方面，自年初以来同比持续下滑，2月到9月之间累计额的同比增长率甚至为-13.5%到-20.9%。施工面积方面，自2004年10月8.8%的同比增幅逐步放缓至2015年8月的0.2%。竣工方面，则仅维持在-10%到-20%。</p><p>　　尽管投资、施工等数据大幅放缓，但新建商品住房待售量却未减，截至10月底，新建商品住房待售面积为43654万平方米，同比上升14%。</p><p>　　中国社会科学院城市与竞争力研究中心主任倪鹏飞表示，宏观政策刺激力度加大，特别是信贷宽松，促使5月以来住房销售速度显著提升，但市场观望情绪浓厚，仍未扭转库存高企的现实，也再次说明了库存的严峻性。</p><p>　　“商品住房过剩总库存量高达21亿平方米。”倪鹏飞说。报告指出，目前现房方面，去化超过18个月以上的过剩1亿平方米，期房方面，去化超过2年的过剩面积达19.96亿平方米。</p><p>　　以2015年商品住房总库存计算，总库存预计达39.96亿平方米，其中，期房库存即在建房待售面积35.7亿平方米，去化周期达4.5年，现\r\n房待售面积方面，库存4.26亿平方米，去化周期为23个月。值得注意的是，按照最大合理库存存销比例，商品住房合理总库存仅为22亿平方米，其中，现房\r\n库存去化周期18个月，面积为3.21亿平方米，期房去化24个月，涉及15.78亿平方米。</p><p>　　去化周期方面，目前现房库存高达23至24个月，远高于6至18个月的合理区间，较2012年的11个月左右更是大幅上涨。</p><p>　　<strong>失衡 住房市场步入“结构性过剩”时代</strong></p><p>　　报告指出，当前我国住房市场一个很突出的问题是，住房市场发展严重失衡，结构性过剩与结构性短缺并存。一线城市住房供求矛盾突出，房价畸高；三四线城市及部分二线城市住房市场呈现阶段性过剩，库存高企，房价下跌。</p><p>　　社科院财经战略研究院邹琳华博士表示，过去十年，在快速城镇化与工业化浪潮的推动下，城镇住房整体呈现供不应求态势。但2014年以来，住房总量“供不应求”时代淡出，“结构性过剩”时代到来。</p><p>　　邹琳华表示，虽然住房总量短缺时代已过去，三四线城市住房短期过剩明显，但由于人口的净流入及收入水平的提高，一线城市住房现阶段仍存部分短缺。</p><p>　　同时，在部分大城市，住房面积狭小和职住不平衡等结构性短缺问题严重。而许多二线城市如西安、青岛等，都出现了大户型优质住宅销售状况较好，而90平方米以下的小户型销售遇冷的局面。</p><p>　　报告指出，在内部结构性过剩严重、外部环境趋于恶化的条件下，如果仍继续原有的“经济房地产化”导向，刺激住房消费以维系高房价与经济高增长，将加重住房结构性过剩。</p><p>　　倪鹏飞表示，过去十年，虽然住房市场促进了经济快速增长，但被作为宏观经济支柱与地方政府财源，也承载了过多的压力。“房价被认为可涨不可跌，也使城镇居民家庭负担过重，进而影响经济内需不足，产业转型乏力。”</p><p>　　<strong>预警 明年房价或较大程度下跌波动</strong></p><p>　　倪鹏飞表示，2015年6月后，房地产销售面积一改同比下降趋势，出现明显的回暖趋向，升中企稳。但在宏观经济下行压力、结构调整与短期增长有\r\n冲突的背景下，不能保证2016年房价稳定的可持续性。考虑到宏观政策影响与自我调整程度，2016年房价或存在较大程度下跌波动的可能。</p><p>　　此外，倪鹏飞指出，在政策激励下，2015年商品房销售量接近2013年峰值水平，改善性需求大幅释放。但从目前来看，销售增长却显乏力，库存\r\n压力缓解有限。因此，2016年住房市场回暖基础不稳，波动风险较大，分化或趋于严重。但他同时表示，由于金融环境宽松，购房信贷成本处于历史低点，因\r\n此，房价并不会出现硬着陆，仍以相对稳定为主。</p><p>　　报告建议，住房市场发展应与转变经济增长方式相结合，通过适度藏富于民，实现住房市场与经济社会的协调发展。如出台按揭贷款利息抵扣个人所得税政策，降低购房还款负担，实现居者有其屋和藏富于民双重目标。对居民家庭购买首套普通商品住房提供购房补贴和利息补贴。</p><p>　　“应减免普通商品住房交易税费，促进自由迁徙和居住条件改善。”倪鹏飞表示，应扩大契税优惠，所有普通商品住房契税均按1%的优惠税率收取；取\r\n消2年限制，所有普通商品住房交易免征营业税；取消自用5年及唯一生活用房限制，所有出售普通商品住房的所得均免征个人所得税；对于卖一买一的换房需求除\r\n给予税费减免外，还可给予适度财政补贴。</p><p>　　对于供给端，倪鹏飞表示，应减少开工，扶持开发企业转型升级。例如主业不是房地产的开发企业转型时，在土地用途调整、行政审批、税费方面给予部分扶持。并鼓励企业并购重组，以减少烂尾风险。</p><p>　　而对于房价畸高、住房供需矛盾突出的热点城市，倪鹏飞表示，应加大普通住房土地供应，加快住房用地入市节奏，对未完成供地任务的城市将调减整体供地指标作为惩罚。同时在补交土地出让金和科学规划的前提下，支持商改住、工改住。</p><p>　　倪鹏飞表示，未来三大政策目标包括去库存、防风险、促投资。具体来看，加快对未来5年总供给的88.2亿平方米库存的消化，并保持价格平稳，防止大起大落，带来违约风险。投资负面，促进投资维持10%左右的增速，恢复正常水平。</p></div><p><br/></p>', 'http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Wap/cmsDetail/id/2/publicid/1.html', '10', null, '0', '1', 'gh_741263a45132', '1449545256', null, '1', '2', 'paiqian_news');
INSERT INTO `wx_material_news` VALUES ('8', '长租市场标准化应该摆正互联网的位置', '韦小宝', '12', '互联网创业者所说的“某个领域是否还有机会”， 隐藏着一个关键信息，即该领域是否还有互联网技术可以渗透和改造的机会', '<p class=\"text\">租房市场无外乎短租与长租两种常见形式，二者分别对应着两种不同的市场需求，不同需求也催生出两种不同的创业模式。从创业成本和运作模式上看，短租模式相对较轻，长租模式则相对较重。不过，模式上的悬殊并没有妨碍这两类创业项目同时获得资本市场的青睐。</p><p class=\"text\">尽管有资本推动，试图在国内复制Airbnb模式的短租市场创业者们仍然无一幸免地遭遇到了水土不服的尴尬，而在市场声\r\n量上长时间处于沉寂中的长租产品却表现出了十足的后劲儿。寓见公寓的创始人程远说创业应该“顺势而为”，这个“势”绝不是“造势”的“势”，而是“趋势”\r\n的“势”。</p><p class=\"text\"><strong>长租市场的机会始终摆在那里</strong></p><p class=\"text\">一个优秀的创业者多半也是一个目光敏锐的机会主义者，特别是在当前互联网技术向众多行业加速渗透的社会背景之下，能够从行业转型与升级中看到机会，便已经向成功靠近了一步。当然，这个意义上的“机会主义”并不包含任何贬义。</p><p class=\"text\">通常情况下，互联网创业者所说的“某个领域是否还有机会”，隐藏着一个关键信息，即该领域是否还有互联网技术可以渗透和\r\n改造的机会。互联网的本质是什么？有人说是“连接”，有人说是“打破信息不对称”，我认为都对但具体到某个行业上要具体分析。与寓见公寓的程远一样，我也\r\n认为长租市场有着很大机会，这是由长租市场的特征和痛点所决定的。</p><p class=\"text\">任何一个有过租房经历的人恐怕都会将租房的过程视为一种苦不堪言的体验，从寻找房源到现场看房，再到签订合同并正式入\r\n住，整个过程伴随着假房源、二房东、价格高等糟糕体验。与此同时，北上广深每年有超过8000万的租房人群，而这一庞大的市场需求对应的却是如此糟糕的租\r\n房体验。根本原因便在于整个长租市场的信息不透明和流程、服务、价格的非标准化。</p><p class=\"text\">解决流动人口的租房问题是社会职能部门要解决的问题，而优化租房体验则是长租行业和产品需要解决的问题。过去几年，北上\r\n广等城市都在管理群租房的问题上费尽周折，目的是为了减少安全隐患，但反过来流动人口的租房问题得不到解决又成了另一个隐患。所以，长租市场走向标准化顺\r\n应的既是租房者的需求趋势也是相关职能部门的管理趋势。这个趋势应该也是程远所谓“顺势而为”的含义。</p><p class=\"text\">不同于短租市场的短暂爆发，长租市场的问题是由来已久的，且机会也一直存在。行业里也不乏革新者，链家也曾尝试互联网模式推出自如品牌，但由于保准化不够彻底也遭到不少诟病。那么对于长租市场而言，究竟应该如何标准化？</p><p class=\"text\"><strong>该标准化的不只是装修和服务</strong></p><p class=\"text\">所谓标准化我认为首先应该是一套成熟固定的流程，不应受某些因素干扰而有所波动。对长租行业而言，应该标准化的不应该只是装修和服务，也应该涵盖定价、预约看房、签订合同、支付房租等所有环节在内的整套流程。</p><p class=\"text\">标准化的目的在于提升用户租房的效率，优化租房的体验，所以整个环节的公开透明很重要。传统租房之所以体验糟糕无外乎房\r\n屋环境描述不清或与实际环境不符，消耗租房者大量时间和精力。价格不透明且波动空间较大，需要租房者与对方进行商定，包括目前一些互联网租房产品，虽然给\r\n出了定价但实际看房时却发现要高出这个价格，这都是导致租房体验糟糕的因素。</p><p class=\"text\">一个好的长租产品，我认为不仅要为产品制定统一的标准，还要实现彻底的标准化。甚至具体到一些细节上，比如带领租房者看\r\n房的服务人员的言行是否规范，是否使用礼貌用语，这些细节都需要规范到位。如果用互联网的方式改造租房市场，就要用互联网产品的标准来要求租房产品，如果\r\n说装修和服务是对产品的标准化包装，那么完成整个体验闭环的各个环节的标准化则是一个成熟的互联网模式。</p><p class=\"text\">寓见公寓的模式相比传统租房，在定价、装修和服务上的确做到了标准化，但仍有一定优化空间。值得一提的是，寓见在与互联\r\n网的结合上要更为彻底，引入支付宝作为支付工具，并积极打造住宿生态系统，引入保洁、洗衣、外卖等O2O服务，这使得寓见的互联网色彩变得更加浓厚，但在\r\n我看来，长租市场的互联网化一定要处理好与互联网的关系，摆正互联网的位置。</p><p class=\"text\"><strong>关键还要摆正互联网的位置</strong></p><p class=\"text\">过去几年，传统住宿业在快速向互联网转型，而互联网创业者也在不断尝试用互联网的方式涉足这个行业。但有一个需要注意的\r\n现象是，此前已经形成品牌效应的酒店和公寓品牌互联网化的过程中并不存在太多难点，在很短时间内就实现了互联网或移动互联网预订、支付等环节，而新兴品牌\r\n却很艰难。这说明，品牌塑造的优先级应该大于互联网模式，而品牌的塑造有赖于更多因素的共同协作。</p><p class=\"text\">任何一个领域的创业者都应该认识到互联网只是用以改造优化某个行业的工具，而非万能解药。寓见公寓的创始人程远在回忆创\r\n业经历时说，“创业之前整体讨论商业模式，创业之后面对的人群从激情澎湃的创业者变成了淳朴憨厚的施工队长，去的最多的地方成了建材市场和工地。”当互联\r\n网创业者深入到某个传统行业中时，难免会感受到这种身份转变和落差，而在这个阶段互联网几乎发挥不出任何作用。</p><p class=\"text\">互联网思维和模式很重要，但更重要的是用所掌握的专业知识和能力用心做好一个品牌，最大限度发挥出品牌效应，而后再利用\r\n互联网工具进行优化升级，才是获得成功的关键。反过来说，如果空有互联网思维和模式，缺乏某领域的专业能力依然无法获得成功。互联网的能动性不可否认，但\r\n其本质是个工具，长租市场的标准化也应该摆正互联网的位置。</p><p><br/></p>', 'http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Wap/cmsDetail/id/4/publicid/1.html', '8', null, '0', '1', 'gh_741263a45132', '1449199770', null, '1', '4', 'paiqian_news');
INSERT INTO `wx_material_news` VALUES ('9', '从846家初创倒下 看A轮融资后的悬崖', '韦小宝', '13', '据相关数据显示，2014年拿到A轮投资的企业高达846家。然而，能够坚持到现在的却寥寥无几。尤其是在今年，更是加速了倒闭的进程。O2O初创企业成为这场寒冬的重灾区，让人扼腕叹息', '<p class=\"text\">相比往年，今年的寒冷冬天来得更早。在互联网行业，今年的“大雪”更是比上次的金融泡沫来的更早一些。BAT、新浪等巨\r\n头纷纷停止招聘；垂直电商股价犹如黄河之水一样倾泻不止；P2P网贷平台跑路消息接踵而至；智能手机厂商利润贴地飞行……种种迹象表明，这场互联网寒冬并\r\n没有那么容易度过。</p><p class=\"text\">但在这场寒冬中最受影响的，却不是这些还能生存，还能喧哗的互联网企业，是那些刚刚拿到天使投资、A轮融资，正在畅想未来光明前景，却戛然而止的初创企业。它们原本都有着看似美好的未来，却因为种种原因停下前行的脚步。这道悬崖，成为它们怎么也迈步过去的坎儿。</p><p class=\"text\"><strong> O2O初创成重灾区 近千企业成B轮亡魂</strong></p><p class=\"text\">当下，网购、搜索、社交等领域，几乎成为初创企业的“禁地”。相比之下，O2O领域成为初创企业的最爱。之所其以受到青\r\n睐，无非在于这个领域概念足够新鲜、项目门槛低、启动快，且很容易就拿到融资——前提是会将故事，会包装。由此，近两年，打着各种名目的O2O项目如雨后\r\n春笋般般出现。</p><p class=\"text\">但也正是因为入门门槛实在太低，导致每个O2O细分领域都“人满为患”，竞争极其惨烈。即使故事说得再好，始终逃不掉烧钱补贴换市场的怪圈。当融来的钱没支撑到初见成效、收益的时候，就已经在惨烈的竞争中败下阵来。</p><p class=\"text\">据数据显示，2014年拿到A轮投资的企业高达846家。然而，能够坚持到现在的却寥寥无几。尤其是在今年，更是加速了倒闭的进程。O2O初创企业成为这场寒冬的重灾区，让人扼腕叹息。</p><p class=\"text\"><strong> 烧钱，成为O2O唯一或很长时间内驱动力</strong></p><p class=\"text\">此前，几乎所有的O2O初创企业在推出相关项目时，都对未来持以乐观态度。因为它们知道，不用太过担心盈利问题，只要有\r\n源源不断的资金融入，就能将编好的故事一直说下去。或者说它们将盈利的目标放在N轮融资之后，只是不断向这个目标推进，中间的过程却是为了满足自己的创\r\n业、个人需求。</p><p class=\"text\">以往O2O初创企业轮番的造势，让O2O领域成功忽悠了很多投资人，认定其是未来最佳商业模式，甚至有可能颠覆一切。在\r\n资本的力推下，O2O的确席卷了一切。但O2O火爆的前提却大多是依靠“源源不断资金投入”，对于市场的盈利途径，很多可能还未真正来得及去实施。这样造\r\n成，很多O2O项目在资本寒冬到来前根本没有盈利的可能。以往借助O2O这个巨大的风口，不断忽悠投资人往里投钱，以烧钱补贴换市场当做模式和借口，当没\r\n有了资本时，一切的美好规划都成为了泡影。</p><p class=\"text\">完全依赖烧钱为驱动力的O2O初创企业，相比其他互联网企业，天生就显得有些“畸形”。靠概念忽悠，总归不是长久之计。资本浪潮退去后，O2O初创企业完全就是在裸泳。</p><p class=\"text\"><strong> B轮融资需求资金更大 大势促成悬崖之势</strong></p><p class=\"text\">今年以来，由于多种原因的影响，经济下行，大环境并不好，导致很多投资人也囊中羞涩。在这样的大势下，自然会减少对\r\nO2O领域的投入。但没想到的是，一撤资，立刻O2O初创企业的软肋就立刻暴露出来。完全依靠巨资推进的O2O项目，没有了资金的支持，烧钱补贴成为空\r\n谈，成为大众摒弃的对象。去年10月上线的推拿O2O项目“功夫熊”不到两个月就先后获得数百万元天使投资和数百万美元的A轮融资，被所有人看好。但却于\r\n前些日子宣布倒闭，就在于投资人对烧钱补贴换市场的模式失去耐心——尤其是迟迟不见回报的情况下。</p><p class=\"text\">大势的疲态，导致很多拿到A轮融资的初创企业及时将饼画得再大，也没能打动投资者。毕竟B轮融资需求资金较大，投资者肯定会更为慎重。不过那些融到B轮融资的初创企业也未到兴奋的时候。虽然幸运地躲过了这场寒冬，但接下来的C轮、D轮等融资节点，依然会让它们挠头。</p><p class=\"text\"><strong> 卧薪尝胆？卷土重来尚需时间</strong></p><p class=\"text\">如果O2O初创企业现在想避过这场寒冬，开启收缩战略，将摊子弄小，同样也无济于事。因为按照目前的态势发展，这场寒冬\r\n将会持续很长一段时间，绝不是简单的“节流”就能躲过去的。更为严重的是，众多O2O初创企业倒闭给投资者带来警告：O2O领域没没有想象中那么美好。那\r\n些缺乏创意，只靠烧钱撑起来的项目将首先成为“炮灰”。</p><p class=\"text\">一夜成名、一夜暴富的盛况在O2O领域已然成为过去。最好的方法就是，初创企业蛰伏起来，并不去趟O2O领域这趟浑水。初创企业只能保持灵敏的嗅觉，在大势逐渐复苏的时候再行切入。只是，这需要时间的沉淀。（科技新发现 康斯坦丁/文）</p><p><br/></p>', 'http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Wap/cmsDetail/id/3/publicid/1.html', '9', null, '0', '1', 'gh_741263a45132', '1449199789', null, '1', '3', 'paiqian_news');

-- ----------------------------
-- Table structure for `wx_material_text`
-- ----------------------------
DROP TABLE IF EXISTS `wx_material_text`;
CREATE TABLE `wx_material_text` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `content` text COMMENT '文本内容',
  `token` varchar(50) DEFAULT NULL COMMENT 'Token',
  `uid` int(10) DEFAULT NULL COMMENT 'uid',
  `is_use` int(10) DEFAULT '1' COMMENT '可否使用',
  `aim_id` int(10) DEFAULT NULL COMMENT '添加来源标识id',
  `aim_table` varchar(255) DEFAULT NULL COMMENT '来源表名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_material_text
-- ----------------------------
INSERT INTO `wx_material_text` VALUES ('1', '客服\r\n客服1\r\n客服2\r\n客服3', 'gh_1784a6c712f0', '1', '1', null, null);

-- ----------------------------
-- Table structure for `wx_menu`
-- ----------------------------
DROP TABLE IF EXISTS `wx_menu`;
CREATE TABLE `wx_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=utf8 COMMENT='后台导航数据表';

-- ----------------------------
-- Records of wx_menu
-- ----------------------------
INSERT INTO `wx_menu` VALUES ('4', '新增', '3', '0', 'article/add', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('5', '编辑', '3', '0', 'article/edit', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('6', '改变状态', '3', '0', 'article/setStatus', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('7', '保存', '3', '0', 'article/update', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('8', '保存草稿', '3', '0', 'article/autoSave', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('9', '移动', '3', '0', 'article/move', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('10', '复制', '3', '0', 'article/copy', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('11', '粘贴', '3', '0', 'article/paste', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('12', '导入', '3', '0', 'article/batchOperate', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('14', '还原', '13', '0', 'article/permit', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('15', '清空', '13', '0', 'article/clear', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('16', '用户', '0', '2', 'User/index', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('17', '用户信息', '16', '0', 'User/index', '0', '', '用户管理', '0');
INSERT INTO `wx_menu` VALUES ('18', '新增用户', '17', '0', 'User/add', '0', '添加新用户', '', '0');
INSERT INTO `wx_menu` VALUES ('19', '用户行为', '16', '0', 'User/action', '0', '', '行为管理', '0');
INSERT INTO `wx_menu` VALUES ('20', '新增用户行为', '19', '0', 'User/addaction', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('21', '编辑用户行为', '19', '0', 'User/editaction', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('22', '保存用户行为', '19', '0', 'User/saveAction', '0', '\"用户->用户行为\"保存编辑和新增的用户行为', '', '0');
INSERT INTO `wx_menu` VALUES ('23', '变更行为状态', '19', '0', 'User/setStatus', '0', '\"用户->用户行为\"中的启用,禁用和删除权限', '', '0');
INSERT INTO `wx_menu` VALUES ('24', '禁用会员', '19', '0', 'User/changeStatus?method=forbidUser', '0', '\"用户->用户信息\"中的禁用', '', '0');
INSERT INTO `wx_menu` VALUES ('25', '启用会员', '19', '0', 'User/changeStatus?method=resumeUser', '0', '\"用户->用户信息\"中的启用', '', '0');
INSERT INTO `wx_menu` VALUES ('26', '删除会员', '19', '0', 'User/changeStatus?method=deleteUser', '0', '\"用户->用户信息\"中的删除', '', '0');
INSERT INTO `wx_menu` VALUES ('27', '用户组管理', '16', '0', 'AuthManager/index', '0', '', '用户管理', '0');
INSERT INTO `wx_menu` VALUES ('28', '删除', '27', '0', 'AuthManager/changeStatus?method=deleteGroup', '0', '删除用户组', '', '0');
INSERT INTO `wx_menu` VALUES ('29', '禁用', '27', '0', 'AuthManager/changeStatus?method=forbidGroup', '0', '禁用用户组', '', '0');
INSERT INTO `wx_menu` VALUES ('30', '恢复', '27', '0', 'AuthManager/changeStatus?method=resumeGroup', '0', '恢复已禁用的用户组', '', '0');
INSERT INTO `wx_menu` VALUES ('31', '新增', '27', '0', 'AuthManager/createGroup', '0', '创建新的用户组', '', '0');
INSERT INTO `wx_menu` VALUES ('32', '编辑', '27', '0', 'AuthManager/editGroup', '0', '编辑用户组名称和描述', '', '0');
INSERT INTO `wx_menu` VALUES ('33', '保存用户组', '27', '0', 'AuthManager/writeGroup', '0', '新增和编辑用户组的\"保存\"按钮', '', '0');
INSERT INTO `wx_menu` VALUES ('34', '授权', '27', '0', 'AuthManager/group', '0', '\"后台 \\ 用户 \\ 用户信息\"列表页的\"授权\"操作按钮,用于设置用户所属用户组', '', '0');
INSERT INTO `wx_menu` VALUES ('35', '访问授权', '27', '0', 'AuthManager/access', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"访问授权\"操作按钮', '', '0');
INSERT INTO `wx_menu` VALUES ('36', '成员授权', '27', '0', 'AuthManager/user', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"成员授权\"操作按钮', '', '0');
INSERT INTO `wx_menu` VALUES ('37', '解除授权', '27', '0', 'AuthManager/removeFromGroup', '0', '\"成员授权\"列表页内的解除授权操作按钮', '', '0');
INSERT INTO `wx_menu` VALUES ('38', '保存成员授权', '27', '0', 'AuthManager/addToGroup', '0', '\"用户信息\"列表页\"授权\"时的\"保存\"按钮和\"成员授权\"里右上角的\"添加\"按钮)', '', '0');
INSERT INTO `wx_menu` VALUES ('39', '分类授权', '27', '0', 'AuthManager/category', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"分类授权\"操作按钮', '', '0');
INSERT INTO `wx_menu` VALUES ('40', '保存分类授权', '27', '0', 'AuthManager/addToCategory', '0', '\"分类授权\"页面的\"保存\"按钮', '', '0');
INSERT INTO `wx_menu` VALUES ('41', '模型授权', '27', '0', 'AuthManager/modelauth', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"模型授权\"操作按钮', '', '0');
INSERT INTO `wx_menu` VALUES ('42', '保存模型授权', '27', '0', 'AuthManager/addToModel', '0', '\"分类授权\"页面的\"保存\"按钮', '', '0');
INSERT INTO `wx_menu` VALUES ('43', '插件管理', '0', '7', 'Addons/index', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('44', '插件管理', '43', '1', 'Admin/Plugin/index', '0', '', '扩展', '0');
INSERT INTO `wx_menu` VALUES ('45', '创建', '44', '0', 'Addons/create', '0', '服务器上创建插件结构向导', '', '0');
INSERT INTO `wx_menu` VALUES ('46', '检测创建', '44', '0', 'Addons/checkForm', '0', '检测插件是否可以创建', '', '0');
INSERT INTO `wx_menu` VALUES ('47', '预览', '44', '0', 'Addons/preview', '0', '预览插件定义类文件', '', '0');
INSERT INTO `wx_menu` VALUES ('48', '快速生成插件', '44', '0', 'Addons/build', '0', '开始生成插件结构', '', '0');
INSERT INTO `wx_menu` VALUES ('49', '设置', '44', '0', 'Addons/config', '0', '设置插件配置', '', '0');
INSERT INTO `wx_menu` VALUES ('50', '禁用', '44', '0', 'Addons/disable', '0', '禁用插件', '', '0');
INSERT INTO `wx_menu` VALUES ('51', '启用', '44', '0', 'Addons/enable', '0', '启用插件', '', '0');
INSERT INTO `wx_menu` VALUES ('52', '安装', '44', '0', 'Addons/install', '0', '安装插件', '', '0');
INSERT INTO `wx_menu` VALUES ('53', '卸载', '44', '0', 'Addons/uninstall', '0', '卸载插件', '', '0');
INSERT INTO `wx_menu` VALUES ('54', '更新配置', '44', '0', 'Addons/saveconfig', '0', '更新插件配置处理', '', '0');
INSERT INTO `wx_menu` VALUES ('55', '插件后台列表', '44', '0', 'Addons/adminList', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('56', 'URL方式访问插件', '44', '0', 'Addons/execute', '0', '控制是否有权限通过url访问插件控制器方法', '', '0');
INSERT INTO `wx_menu` VALUES ('57', '钩子管理', '43', '3', 'Addons/hooks', '0', '', '扩展', '0');
INSERT INTO `wx_menu` VALUES ('58', '模型管理', '68', '3', 'Model/index', '0', '', '系统设置', '0');
INSERT INTO `wx_menu` VALUES ('59', '新增', '58', '0', 'model/add', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('60', '编辑', '58', '0', 'model/edit', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('61', '改变状态', '58', '0', 'model/setStatus', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('62', '保存数据', '58', '0', 'model/update', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('64', '新增', '63', '0', 'Attribute/add', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('65', '编辑', '63', '0', 'Attribute/edit', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('66', '改变状态', '63', '0', 'Attribute/setStatus', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('67', '保存数据', '63', '0', 'Attribute/update', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('68', '系统', '0', '1', 'Config/group', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('69', '网站设置', '68', '1', 'Config/group', '0', '', '系统设置', '0');
INSERT INTO `wx_menu` VALUES ('70', '配置管理', '68', '4', 'Config/index', '0', '', '系统设置', '0');
INSERT INTO `wx_menu` VALUES ('71', '编辑', '70', '0', 'Config/edit', '0', '新增编辑和保存配置', '', '0');
INSERT INTO `wx_menu` VALUES ('72', '删除', '70', '0', 'Config/del', '0', '删除配置', '', '0');
INSERT INTO `wx_menu` VALUES ('73', '新增', '70', '0', 'Config/add', '0', '新增配置', '', '0');
INSERT INTO `wx_menu` VALUES ('74', '保存', '70', '0', 'Config/save', '0', '保存配置', '', '0');
INSERT INTO `wx_menu` VALUES ('75', '菜单管理', '68', '5', 'Menu/index', '0', '', '系统设置', '0');
INSERT INTO `wx_menu` VALUES ('76', '导航管理', '68', '6', 'Channel/index', '0', '', '系统设置', '0');
INSERT INTO `wx_menu` VALUES ('77', '新增', '76', '0', 'Channel/add', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('78', '编辑', '76', '0', 'Channel/edit', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('79', '删除', '76', '0', 'Channel/del', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('146', '权限节点', '16', '0', 'Admin/Rule/index', '0', '', '用户管理', '1');
INSERT INTO `wx_menu` VALUES ('81', '编辑', '80', '0', 'Category/edit', '0', '编辑和保存栏目分类', '', '0');
INSERT INTO `wx_menu` VALUES ('82', '新增', '80', '0', 'Category/add', '0', '新增栏目分类', '', '0');
INSERT INTO `wx_menu` VALUES ('83', '删除', '80', '0', 'Category/remove', '0', '删除栏目分类', '', '0');
INSERT INTO `wx_menu` VALUES ('84', '移动', '80', '0', 'Category/operate/type/move', '0', '移动栏目分类', '', '0');
INSERT INTO `wx_menu` VALUES ('85', '合并', '80', '0', 'Category/operate/type/merge', '0', '合并栏目分类', '', '0');
INSERT INTO `wx_menu` VALUES ('86', '备份数据库', '68', '0', 'Database/index?type=export', '0', '', '数据备份', '0');
INSERT INTO `wx_menu` VALUES ('87', '备份', '86', '0', 'Database/export', '0', '备份数据库', '', '0');
INSERT INTO `wx_menu` VALUES ('88', '优化表', '86', '0', 'Database/optimize', '0', '优化数据表', '', '0');
INSERT INTO `wx_menu` VALUES ('89', '修复表', '86', '0', 'Database/repair', '0', '修复数据表', '', '0');
INSERT INTO `wx_menu` VALUES ('90', '还原数据库', '68', '0', 'Database/index?type=import', '0', '', '数据备份', '0');
INSERT INTO `wx_menu` VALUES ('91', '恢复', '90', '0', 'Database/import', '0', '数据库恢复', '', '0');
INSERT INTO `wx_menu` VALUES ('92', '删除', '90', '0', 'Database/del', '0', '删除备份文件', '', '0');
INSERT INTO `wx_menu` VALUES ('96', '新增', '75', '0', 'Menu/add', '0', '', '系统设置', '0');
INSERT INTO `wx_menu` VALUES ('98', '编辑', '75', '0', 'Menu/edit', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('104', '下载管理', '102', '0', 'Think/lists?model=download', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('105', '配置管理', '102', '0', 'Think/lists?model=config', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('106', '行为日志', '16', '0', 'Action/actionlog', '0', '', '行为管理', '0');
INSERT INTO `wx_menu` VALUES ('108', '修改密码', '16', '0', 'User/updatePassword', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('109', '修改昵称', '16', '0', 'User/updateNickname', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('110', '查看行为日志', '106', '0', 'action/edit', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('112', '新增数据', '58', '0', 'think/add', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('113', '编辑数据', '58', '0', 'think/edit', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('114', '导入', '75', '0', 'Menu/import', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('115', '生成', '58', '0', 'Model/generate', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('116', '新增钩子', '57', '0', 'Addons/addHook', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('117', '编辑钩子', '57', '0', 'Addons/edithook', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('118', '文档排序', '3', '0', 'Article/sort', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('119', '排序', '70', '0', 'Config/sort', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('120', '排序', '75', '0', 'Menu/sort', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('121', '排序', '76', '0', 'Channel/sort', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('124', '微信插件', '43', '0', 'Admin/Addons/index', '0', '', '扩展', '0');
INSERT INTO `wx_menu` VALUES ('126', '公众号等级', '16', '0', 'admin/PublicGroup/PublicGroup', '0', '', '公众号管理', '0');
INSERT INTO `wx_menu` VALUES ('127', '公众号管理', '16', '1', 'admin/PublicGroup/PublicAdmin', '0', '', '公众号管理', '0');
INSERT INTO `wx_menu` VALUES ('128', '在线升级', '68', '5', 'Admin/Update/index', '0', '', '系统设置', '0');
INSERT INTO `wx_menu` VALUES ('129', '清除缓存', '68', '10', 'Admin/Update/delcache', '0', '', '系统设置', '0');
INSERT INTO `wx_menu` VALUES ('130', '应用商店', '0', '8', 'admin/store/index', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('131', '素材图标', '130', '2', 'admin/store/index?type=material', '0', '', '应用类型', '0');
INSERT INTO `wx_menu` VALUES ('132', '微站模板', '130', '1', 'admin/store/index?type=template', '0', '', '应用类型', '0');
INSERT INTO `wx_menu` VALUES ('133', '我是开发者', '130', '1', '/index.php?s=/home/developer/myApps', '0', '', '开发者', '0');
INSERT INTO `wx_menu` VALUES ('134', '新手安装指南', '130', '0', 'admin/store/index?type=help', '0', '', '我是站长', '0');
INSERT INTO `wx_menu` VALUES ('135', '万能页面', '130', '3', 'admin/store/index?type=diy', '0', '', '应用类型', '0');
INSERT INTO `wx_menu` VALUES ('136', '上传新应用', '130', '2', '/index.php?s=/home/developer/submitApp', '0', '', '开发者', '0');
INSERT INTO `wx_menu` VALUES ('137', '二次开发教程', '130', '3', '/wiki', '0', '', '开发者', '0');
INSERT INTO `wx_menu` VALUES ('138', '网站信息', '130', '0', 'admin/store/index?type=home', '0', '', '我是站长', '0');
INSERT INTO `wx_menu` VALUES ('139', '充值记录', '130', '0', 'admin/store/index?type=recharge', '0', '', '我是站长', '0');
INSERT INTO `wx_menu` VALUES ('140', '消费记录', '130', '0', 'admin/store/index?type=bug', '0', '', '我是站长', '0');
INSERT INTO `wx_menu` VALUES ('141', '官方交流论坛', '130', '4', '/bbs', '0', '', '开发者', '0');
INSERT INTO `wx_menu` VALUES ('142', '在线充值', '130', '0', 'admin/store/index?type=online_recharge', '0', '', '我是站长', '0');
INSERT INTO `wx_menu` VALUES ('143', '微信插件', '130', '0', 'admin/store/index?type=addon', '0', '', '应用类型', '0');
INSERT INTO `wx_menu` VALUES ('144', '公告管理', '68', '4', 'Notice/lists', '0', '', '系统设置', '0');
INSERT INTO `wx_menu` VALUES ('147', '图文样式编辑', '68', '4', 'ArticleStyle/lists', '0', '', '系统设置', '0');
INSERT INTO `wx_menu` VALUES ('148', '增加', '147', '0', 'ArticleStyle/add', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('149', '分组管理', '147', '0', 'ArticleStyle/group', '0', '', '', '0');
INSERT INTO `wx_menu` VALUES ('150', '微信接口节点', '16', '0', 'Admin/Rule/wechat', '0', '', '用户管理', '0');
INSERT INTO `wx_menu` VALUES ('151', '公众号组管理', '16', '0', 'Admin/AuthManager/wechat', '0', '', '用户管理', '0');
INSERT INTO `wx_menu` VALUES ('152', '积分选项管理', '16', '6', 'Admin/Credit/lists', '0', '', '用户管理', '1');

-- ----------------------------
-- Table structure for `wx_message`
-- ----------------------------
DROP TABLE IF EXISTS `wx_message`;
CREATE TABLE `wx_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `bind_keyword` varchar(50) DEFAULT NULL COMMENT '关联关键词',
  `preview_openids` text COMMENT '预览人OPENID',
  `group_id` int(10) DEFAULT '0' COMMENT '群发对象',
  `type` tinyint(2) DEFAULT '0' COMMENT '素材来源',
  `media_id` varchar(100) DEFAULT NULL COMMENT '微信素材ID',
  `send_type` tinyint(1) DEFAULT '0' COMMENT '发送方式',
  `send_openids` text COMMENT '要发送的OpenID',
  `msg_id` varchar(255) DEFAULT NULL COMMENT 'msg_id',
  `content` text COMMENT '文本消息内容',
  `msgtype` varchar(255) DEFAULT NULL COMMENT '消息类型',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `appmsg_id` int(10) DEFAULT NULL COMMENT '图文id',
  `voice_id` int(10) DEFAULT NULL COMMENT '语音id',
  `video_id` int(10) DEFAULT NULL COMMENT '视频id',
  `cTime` int(10) DEFAULT NULL COMMENT '群发时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_message
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_model`
-- ----------------------------
DROP TABLE IF EXISTS `wx_model`;
CREATE TABLE `wx_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '模型标识',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '模型名称',
  `extend` int(10) unsigned DEFAULT '0' COMMENT '继承的模型',
  `relation` varchar(30) DEFAULT '' COMMENT '继承与被继承模型的关联字段',
  `need_pk` tinyint(1) unsigned DEFAULT '1' COMMENT '新建表时是否需要主键字段',
  `field_sort` text COMMENT '表单字段排序',
  `field_group` varchar(255) DEFAULT '1:基础' COMMENT '字段分组',
  `attribute_list` text COMMENT '属性列表（表的字段）',
  `template_list` varchar(100) DEFAULT '' COMMENT '列表模板',
  `template_add` varchar(100) DEFAULT '' COMMENT '新增模板',
  `template_edit` varchar(100) DEFAULT '' COMMENT '编辑模板',
  `list_grid` text COMMENT '列表定义',
  `list_row` smallint(2) unsigned DEFAULT '10' COMMENT '列表数据长度',
  `search_key` varchar(50) DEFAULT '' COMMENT '默认搜索字段',
  `search_list` varchar(255) DEFAULT '' COMMENT '高级搜索的字段',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned DEFAULT '0' COMMENT '状态',
  `engine_type` varchar(25) DEFAULT 'MyISAM' COMMENT '数据库引擎',
  `addon` varchar(50) DEFAULT NULL COMMENT '所属插件',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=1243 DEFAULT CHARSET=utf8 COMMENT='系统模型表';

-- ----------------------------
-- Records of wx_model
-- ----------------------------
INSERT INTO `wx_model` VALUES ('1', 'user', '用户信息表', '0', '', '0', '[\"come_from\",\"nickname\",\"password\",\"truename\",\"mobile\",\"email\",\"sex\",\"headimgurl\",\"city\",\"province\",\"country\",\"language\",\"score\",\"experience\",\"unionid\",\"login_count\",\"reg_ip\",\"reg_time\",\"last_login_ip\",\"last_login_time\",\"status\",\"is_init\",\"is_audit\"]', '1:基础', '', '', '', '', 'headimgurl|url_img_html:头像\r\nlogin_name:登录账号\r\nlogin_password:登录密码\r\nnickname|deal_emoji:用户昵称\r\nsex|get_name_by_status:性别\r\ngroup:分组\r\nscore:金币值\r\nexperience:经历值\r\nids:操作:set_login?uid=[uid]|设置登录账号,detail?uid=[uid]|详细资料,[EDIT]|编辑', '20', '', '', '1436929111', '1441187405', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('2', 'manager', '公众号管理员配置', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1436932532', '1436942362', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('3', 'manager_menu', '公众号管理员菜单', '0', '', '1', '[\"menu_type\",\"pid\",\"title\",\"url_type\",\"addon_name\",\"url\",\"target\",\"is_hide\",\"sort\"]', '1:基础', '', '', '', '', 'title:菜单名\r\nmenu_type|get_name_by_status:菜单类型\r\naddon_name:插件名\r\nurl:外链\r\ntarget|get_name_by_status:打开方式\r\nis_hide|get_name_by_status:隐藏\r\nsort:排序号\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', '', '', '1435215960', '1437623073', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('4', 'keyword', '关键词表', '0', '', '1', '[\"keyword\",\"keyword_type\",\"addon\",\"aim_id\",\"keyword_length\",\"cTime\",\"extra_text\",\"extra_int\"]', '1:基础', '', '', '', '', 'id:编号\r\nkeyword:关键词\r\naddon:所属插件\r\naim_id:插件数据ID\r\ncTime|time_format:增加时间\r\nrequest_count|intval:请求数\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'keyword', '', '1388815871', '1407251192', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('5', 'qr_code', '二维码表', '0', '', '1', '[\"qr_code\",\"addon\",\"aim_id\",\"cTime\",\"extra_text\",\"extra_int\",\"scene_id\",\"action_name\"]', '1:基础', '', '', '', '', 'scene_id:事件KEY值\r\nqr_code|get_code_img:二维码\r\naction_name|get_name_by_status: 	二维码类型\r\naddon:所属插件\r\naim_id:插件数据ID\r\ncTime|time_format:增加时间\r\nrequest_count|intval:请求数\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'qr_code', '', '1388815871', '1406130247', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('6', 'public', '公众号管理', '0', '', '1', '[\"public_name\",\"public_id\",\"wechat\",\"headface_url\",\"type\",\"appid\",\"secret\",\"encodingaeskey\",\"tips_url\",\"GammaAppId\",\"GammaSecret\",\"public_copy_right\"]', '1:基础', '', '', '', '', 'id:公众号ID\r\npublic_name:公众号名称\r\ntoken:Token\r\ncount:管理员数\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,main&public_id=[id]|进入管理', '20', 'public_name', '', '1391575109', '1447231672', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('7', 'public_group', '公众号等级', '0', '', '1', '[\"title\",\"addon_status\"]', '1:基础', '', '', '', '', 'id:等级ID\r\ntitle:等级名\r\naddon_status:授权的插件\r\npublic_count:公众号数\r\nids:操作:editPublicGroup&id=[id]|编辑,delPublicGroup&id=[id]|删除', '20', 'title', '', '1393724788', '1393730663', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('8', 'public_link', '公众号与管理员的关联关系', '0', '', '1', '[\"uid\",\"addon_status\"]', '1:基础', '', '', '', '', 'uid|get_nickname|deal_emoji:15%管理员(不包括创始人)\r\naddon_status:授权的插件\r\nids:10%操作:[EDIT]|编辑,[DELETE]|删除', '20', '', '', '1398933192', '1447233745', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('9', 'import', '导入数据', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1407554076', '1407554076', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('10', 'addon_category', '插件分类', '0', '', '1', '[\"icon\",\"title\",\"sort\"]', '1:基础', '', '', '', '', 'icon|get_img_html:分类图标\r\ntitle:分类名\r\nsort:排序号\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1400047655', '1437451028', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('12', 'common_category', '通用分类', '0', '', '1', '[\"pid\",\"title\",\"icon\",\"intro\",\"sort\",\"is_show\"]', '1:基础', '', '', '', '', 'code:编号\r\ntitle:标题\r\nicon|get_img_html:图标\r\nsort:排序号\r\nis_show|get_name_by_status:显示\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1397529095', '1404182789', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('13', 'common_category_group', '通用分类分组', '0', '', '1', '[\"name\",\"title\"]', '1:基础', '', '', '', '', 'name:分组标识\r\ntitle:分组标题\r\nids:操作:cascade?target=_blank&module=[name]|数据管理,[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1396061373', '1403664378', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('14', 'credit_config', '积分配置', '0', '', '1', '[\"name\",\"title\",\"score\",\"experience\"]', '1:基础', '', '', '', '', 'title:积分描述\r\nname:积分标识\r\nexperience:经验值\r\nscore:金币值\r\nids:操作:[EDIT]|配置', '20', 'title', '', '1396061373', '1438591151', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('15', 'credit_data', '用户积分记录', '0', '', '1', '[\"uid\",\"experience\",\"score\",\"credit_name\"]', '1:基础', '', '', '', '', 'uid:用户\r\ncredit_title:积分来源\r\nexperience:经验值\r\nscore:金币值\r\ncTime|time_format:记录时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'uid', '', '1398564291', '1447250833', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('16', 'material_image', '图片素材', '0', '', '1', '', '1:基础', '', '', '', '', '', '10', '', '', '1438684613', '1438684613', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('17', 'material_news', '图文素材', '0', '', '1', '', '1:基础', '', '', '', '', '', '10', '', '', '1438670890', '1438670890', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('18', 'message', '群发消息', '0', '', '1', '[\"type\",\"bind_keyword\",\"media_id\",\"openid\",\"send_type\",\"group_id\",\"send_openids\"]', '1:基础', '', '', '', '', '', '20', '', '', '1437984111', '1438049406', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('19', 'visit_log', '网站访问日志', '0', '', '1', '', '1:基础', '', '', '', '', '', '10', '', '', '1439448351', '1439448351', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('20', 'auth_group', '用户组', '0', '', '1', '[\"title\",\"description\"]', '1:基础', '', '', '', '', 'title:分组名称\r\ndescription:描述\r\nqr_code:二维码\r\nids:操作:export?id=[id]|导出用户,[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1437633503', '1447660681', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('21', 'analysis', '统计分析', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1432806941', '1432806941', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('22', 'article_style', '图文样式', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1436845488', '1436845488', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('23', 'article_style_group', '图文样式分组', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1436845186', '1436845186', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('1217', 'youaskservice_wechat_grouplist', 'youaskservice_wechat_grouplist', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1404027300', '1404027300', '1', 'MyISAM', 'YouaskService');
INSERT INTO `wx_model` VALUES ('1218', 'youaskservice_wxlogs', '你问我答- 微信聊天记录', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1406094050', '1406094093', '1', 'MyISAM', 'YouaskService');
INSERT INTO `wx_model` VALUES ('1219', 'prize_address', '奖品收货地址', '0', '', '1', '[\"address\",\"mobile\",\"turename\",\"remark\"]', '1:基础', '', '', '', '', 'prizeid:奖品名称\r\nturename:收货人\r\nmobile:联系方式\r\naddress:收货地址\r\nremark:备注\r\nids:操作:address_edit&id=[id]&_controller=RealPrize&_addons=RealPrize|编辑,[DELETE]|删除', '20', '', '', '1429521514', '1447831599', '1', 'MyISAM', 'RealPrize');
INSERT INTO `wx_model` VALUES ('1220', 'real_prize', '实物奖励', '0', '', '1', '[\"prize_title\",\"prize_name\",\"prize_conditions\",\"prize_count\",\"prize_image\",\"prize_type\",\"use_content\",\"fail_content\",\"template\"]', '1:基础', '', '', '', '', 'prize_name:20%奖品名称\r\nprize_conditions:20%活动说明\r\nprize_count:10%奖品个数\r\nprize_type|get_name_by_status:10%奖品类型\r\nuse_content:20%使用说明\r\nid:20%操作:[EDIT]|编辑,[DELETE]|删除,address_lists?target_id=[id]|查看数据,preview?id=[id]&target=_blank|预览', '20', '', '', '1429515376', '1437452269', '1', 'MyISAM', 'RealPrize');
INSERT INTO `wx_model` VALUES ('1221', 'xydzp', '幸运大转盘', '0', '', '1', '[\"keyword\",\"title\",\"picurl\",\"des_jj\",\"guiz\",\"choujnum\",\"start_date\",\"end_date\",\"experience\",\"background\",\"template\"]', '1:基础', '', '', '', '', 'id:编号\r\nkeyword:触发关键词\r\ntitle:标题\r\nstart_date|time_format:开始时间\r\nend_date|time_format:结束日期\r\nchoujnum:每日抽奖次数\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,zjloglists?id=[id]|中奖记录,jplists?xydzp_id=[id]|奖品设置,preview?id=[id]&target=_blank|预览', '20', 'title', 'des', '1395395179', '1437449460', '1', 'MyISAM', 'Xydzp');
INSERT INTO `wx_model` VALUES ('1222', 'xydzp_jplist', '幸运大转盘奖品列表', '0', '', '1', '[\"gailv\",\"gailv_maxnum\"]', '1:基础', '', '', '', '', 'xydzp_option_id:奖品名称\r\ngailv:中奖概率（0-100）\r\ngailv_maxnum:单日发放上限\r\nids:操作:jpedit?id=[id]|编辑,jpdel?id=[id]|删除', '20', '', '', '1395554963', '1419305652', '1', 'MyISAM', 'Xydzp');
INSERT INTO `wx_model` VALUES ('1223', 'xydzp_log', '幸运大转盘中奖列表', '0', '', '1', '[\"xydzp_id\",\"xydzp_option_id\",\"zip\",\"iphone\",\"address\",\"message\"]', '1:基础', '', '', '', '', 'id:编号\r\ntruename:用户名称\r\nopenid:用户ID\r\nmobile:联系电话\r\ntitle:奖品名称\r\nstate|get_name_by_status:领奖状态\r\nzjdate|time_format:中奖时间\r\nid:标记:ylingqu?id=[id]|已领取,wlingqu?id=[id]|未领取', '20', '', '', '1395395200', '1420358394', '1', 'MyISAM', 'Xydzp');
INSERT INTO `wx_model` VALUES ('1224', 'xydzp_option', '幸运大转盘奖品库设置', '0', '', '1', '[\"title\",\"jptype\",\"coupon_id\",\"experience\",\"num\",\"pic\",\"miaoshu\"]', '1:基础', '', '', '', '', 'pic|get_img_html:奖品图片\r\ntitle:奖品名称\r\njptype|get_name_by_status:奖品类型\r\nnum:库存数量\r\nids:操作:jpopedit?id=[id]|编辑,jpopdel?id=[id]|删除', '20', 'title', '', '1395395190', '1419303406', '1', 'MyISAM', 'Xydzp');
INSERT INTO `wx_model` VALUES ('1225', 'xydzp_userlog', '幸运大转盘用户抽奖记录', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1395567366', '1395567366', '1', 'MyISAM', 'Xydzp');
INSERT INTO `wx_model` VALUES ('1226', 'reserve', '微预约', '0', '', '1', '[\"title\",\"intro\",\"cover\",\"can_edit\",\"finish_tip\",\"jump_url\",\"content\",\"template\",\"status\",\"start_time\",\"end_time\",\"pay_online\"]', '1:基础', '', '', '', '', 'title:标题\r\nstatus|get_name_by_status:状态\r\nstart_time:报名时间\r\nids:操作:preview&id=[id]|预览,[EDIT]|编辑,reserve_value&id=[id]|预约列表,[DELETE]|删除,index&_addons=Reserve&_controller=Wap&reserve_id=[id]|复制链接', '20', 'title', '', '1396061373', '1445409060', '1', 'MyISAM', 'Reserve');
INSERT INTO `wx_model` VALUES ('1227', 'reserve_attribute', '微预约字段', '0', '', '1', '[\"name\",\"title\",\"type\",\"extra\",\"value\",\"remark\",\"is_must\",\"validate_rule\",\"error_info\",\"sort\"]', '1:基础', '', '', '', '', 'title:字段标题\r\nname:字段名\r\ntype|get_name_by_status:字段类型\r\nids:操作:[EDIT]&reserve_id=[reserve_id]|编辑,[DELETE]|删除', '20', 'title', '', '1396061373', '1396710959', '1', 'MyISAM', 'Reserve');
INSERT INTO `wx_model` VALUES ('1228', 'reserve_value', '微预约数据', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1396687959', '1396687959', '1', 'MyISAM', 'Reserve');
INSERT INTO `wx_model` VALUES ('1229', 'reserve_option', '预约选项', '0', '', '1', '', '1:基础', '', '', '', '', '', '10', '', '', '1444962050', '1444962050', '1', 'MyISAM', 'Reserve');
INSERT INTO `wx_model` VALUES ('1230', 'payment_order', '订单支付记录', '0', '', '1', '[\"from\",\"orderName\",\"single_orderid\",\"price\",\"token\",\"wecha_id\",\"paytype\",\"showwxpaytitle\",\"status\"]', '1:基础', '', '', '', '', '', '20', '', '', '1420596259', '1423534012', '1', 'MyISAM', 'Payment');
INSERT INTO `wx_model` VALUES ('1231', 'payment_set', '支付配置', '0', '', '1', '[\"wxappid\",\"wxappsecret\",\"wxpaysignkey\",\"zfbname\",\"pid\",\"key\",\"partnerid\",\"partnerkey\",\"wappartnerid\",\"wappartnerkey\",\"quick_security_key\",\"quick_merid\",\"quick_merabbr\",\"wxmchid\"]', '1:基础', '', '', '', '', '', '10', '', '', '1406958084', '1439364636', '1', 'MyISAM', 'Payment');
INSERT INTO `wx_model` VALUES ('1232', 'vote', '投票', '0', '', '1', '[\"keyword\",\"title\",\"description\",\"picurl\",\"start_date\",\"end_date\",\"template\"]', '1:基础', '', '', '', '', 'id:投票ID\r\nkeyword:关键词\r\ntitle:投票标题\r\ntype|get_name_by_status:类型\r\nis_img|get_name_by_status:状态\r\nvote_count:投票数\r\nids:操作:[EDIT]&id=[id]|编辑,[DELETE]|删除,showLog&id=[id]|投票记录,showCount&id=[id]|选项票数,preview?id=[id]&target=_blank|预览', '20', 'title', 'description', '1388930292', '1437446751', '1', 'MyISAM', 'Vote');
INSERT INTO `wx_model` VALUES ('1233', 'vote_log', '投票记录', '0', '', '1', '[\"vote_id\",\"user_id\",\"options\"]', '1:基础', '', '', '', '', 'vote_id:25%用户头像\r\nuser_id:25%用户\r\noptions:25%投票选项\r\ncTime|time_format:25%创建时间\r\n\r\n\r\n\r\n', '20', '', '', '1388934136', '1447743392', '1', 'MyISAM', 'Vote');
INSERT INTO `wx_model` VALUES ('1234', 'vote_option', '投票选项', '0', '', '1', '[\"name\",\"opt_count\",\"order\"]', '1:基础', '', '', '', '', 'image|get_img_html:选项图片\r\nname:选项标题\r\nopt_count:投票数', '20', '', '', '1388933346', '1447745055', '1', 'MyISAM', 'Vote');
INSERT INTO `wx_model` VALUES ('1235', 'shop_vote', '商城微投票', '0', '', '1', '[\"title\",\"select_type\",\"multi_num\",\"start_time\",\"end_time\",\"is_verify\",\"remark\"]', '1:基础', '', '', '', '', 'title:活动名称\r\nselect_type|get_name_by_status:投票类型\r\nstart_time|time_format:开始时间\r\nend_time|time_format:结束时间\r\nremark:活动说明\r\nids:操作:[EDIT]&id=[id]|编辑,[DELETE]|删除,option_lists&vote_id=[id]|投票选项,show_log&vote_id=[id]|投票记录,preview&vote_id=[id]|预览,index&_addons=Vote&_controller=Wap&vote_id=[id]|复制链接', '10', 'title:请输入活动名称', '', '1443148496', '1445997045', '1', 'MyISAM', 'Vote');
INSERT INTO `wx_model` VALUES ('1236', 'shop_vote_option', '投票选项表', '0', '', '1', '[\"truename\",\"image\",\"manifesto\",\"introduce\"]', '1:基础', '', '', '', '', 'truename:10%参赛者\r\nimage|get_img_html:10%参赛图片\r\nmanifesto:30%参赛宣言\r\nintroduce:25%选手介绍\r\nopt_count:8%得票数\r\nids:17%操作:option_edit&id=[id]|编辑,option_del&id=[id]|删除,show_log&option_id=[id]|投票记录', '10', 'truename:请输入姓名', '', '1443149182', '1447817257', '1', 'MyISAM', 'Vote');
INSERT INTO `wx_model` VALUES ('1237', 'shop_vote_log', '商城投票记录', '0', '', '1', '[\"vote_id\",\"option_id\",\"uid\"]', '1:基础', '', '', '', '', 'vote_id:25%用户头像\r\nuid:25%用户\r\noption_id:25%投票选项\r\nctime|time_format:25%投票时间', '10', 'truename:请输入用户名字', '', '1443150057', '1447749584', '1', 'MyISAM', 'Vote');
INSERT INTO `wx_model` VALUES ('1209', 'prize', '奖项设置', '0', '', '1', '[\"title\",\"name\",\"num\",\"img\",\"sort\"]', '1:基础', '', '', '', '', 'title:奖项标题\r\nname:奖项\r\nnum:名额数量\r\nimg|get_img_html:奖品图片\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1399348610', '1399702991', '1', 'MyISAM', 'Scratch');
INSERT INTO `wx_model` VALUES ('1210', 'scratch', '刮刮卡', '0', '', '1', '[\"keyword\",\"title\",\"intro\",\"cover\",\"use_tips\",\"start_time\",\"end_time\",\"end_tips\",\"end_img\",\"predict_num\",\"max_num\",\"follower_condtion\",\"credit_conditon\",\"credit_bug\",\"addon_condition\",\"collect_count\",\"view_count\",\"template\"]', '1:基础', '', '', '', '', 'id:刮刮卡ID\r\nkeyword:关键词\r\ntitle:标题\r\ncollect_count:获取人数\r\ncTime|time_format:发布时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,lists?target_id=[id]&target=_blank&_controller=Sn|中奖管理,lists?target_id=[id]&target=_blank&_controller=Prize|奖品管理,preview?id=[id]&target=_blank|预览', '20', 'title', '', '1396061373', '1437035669', '1', 'MyISAM', 'Scratch');
INSERT INTO `wx_model` VALUES ('1206', 'wish_card', '微贺卡', '0', '', '1', '[\"send_name\",\"receive_name\",\"content\",\"template\"]', '1:基础', '', '', '', '', 'send_name:10%发送人\r\nreceive_name:10%接收人\r\ncontent:40%祝福语\r\ncreate_time|time_format:15%创建时间\r\nread_count:10%浏览次数\r\nid:15%操作:[EDIT]|编辑,card_show?id=[id]&target=_blank&_controller=Wap|预览,[DELETE]|删除', '20', 'content:祝福语', '', '1429346197', '1429760720', '1', 'MyISAM', 'WishCard');
INSERT INTO `wx_model` VALUES ('1207', 'wish_card_content', '祝福语', '0', '', '1', '[\"content_cate\",\"content\"]', '1:基础', '', '', '', '', 'content_cate_id:10%类别Id\r\ncontent_cate:20%类别\r\ncontent:50%祝福语\r\nid:20%操作:[EDIT]|编辑,[DELETE]|删除', '20', '', '', '1429348863', '1429841596', '1', 'MyISAM', 'WishCard');
INSERT INTO `wx_model` VALUES ('1208', 'wish_card_content_cate', '祝福语类别', '0', '', '1', '[\"content_cate_name\",\"content_cate_icon\"]', '1:基础', '', '', '', '', 'content_cate_name:类别\r\ncontent_cate_icon|get_img_html:图标\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'content_cate_name:类别', '', '1429348818', '1429598114', '1', 'MyISAM', 'WishCard');
INSERT INTO `wx_model` VALUES ('81', 'sn_code', 'SN码', '0', '', '1', '[\"prize_title\"]', '1:基础', '', '', '', '', 'sn:SN码\r\nuid|get_nickname|deal_emoji:昵称\r\nprize_title:奖项\r\ncTime|time_format:创建时间\r\nis_use|get_name_by_status:是否已使用\r\nuse_time|time_format:使用时间\r\nids:操作:[DELETE]|删除,set_use?id=[id]|改变使用状态', '20', 'sn', '', '1399272054', '1401013099', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('87', 'store', '应用商店', '0', '', '1', '[\"type\",\"title\",\"price\",\"attach\",\"logo\",\"content\",\"img_1\",\"img_2\",\"img_3\",\"img_4\",\"is_top\",\"audit\",\"audit_time\"]', '1:基础', '', '', '', '', 'id:ID值\r\ntype|get_name_by_status:应用类型\r\ntitle:应用标题\r\nprice:价格\r\nlogo|get_img_html:应用LOGO\r\nmTime|time_format:更新时间\r\naudit|get_name_by_status:审核状态\r\naudit_time|time_format:审核时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1394033250', '1402885526', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('88', 'sucai', '素材管理', '0', '', '1', '[\"name\",\"status\",\"cTime\",\"url\",\"type\",\"detail\",\"reason\",\"create_time\",\"checked_time\",\"source\",\"source_id\"]', '1:基础', '', '', '', '', 'name:素材名称\r\nstatus|get_name_by_status:状态\r\nurl:页面URL\r\ncreate_time|time_format:申请时间\r\nchecked_time|time_format:入库时间\r\nids:操作', '20', 'name', '', '1424611702', '1425386629', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('89', 'sucai_template', '素材模板库', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1431575544', '1431575544', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('93', 'system_notice', '系统公告表', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1431141043', '1431141043', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('94', 'update_version', '系统版本升级', '0', '', '1', '[\"version\",\"title\",\"description\",\"create_date\",\"package\"]', '1:基础', '', '', '', '', 'version:版本号\r\ntitle:升级包名\r\ndescription:描述\r\ncreate_date|time_format:创建时间\r\ndownload_count:下载统计数\r\nids:操作:[EDIT]&id=[id]|编辑,[DELETE]&id=[id]|删除', '20', '', '', '1393770420', '1393771807', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('1239', 'paiqian_category', '资讯分类', '0', '', '1', '[\"title\",\"sort\",\"is_show\"]', '1:基础', '', '', '', '', 'title:分类标题\r\nsort:排序号\r\nis_show|get_name_by_status:显示\r\nid:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title:请输入分类标题搜索', '', '1395987942', '1449157315', '1', 'MyISAM', 'Paiqian');
INSERT INTO `wx_model` VALUES ('1240', 'paiqian_news', '资讯内容', '0', '', '1', '[\"keyword\",\"title\",\"cover\",\"intro\",\"cate_id\",\"content\",\"sort\",\"jump_url\",\"author\",\"is_index\",\"is_top\"]', '1:基础', '', '', '', '', 'id:5%ID\r\ntitle:30%标题\r\ncate_id:10%分类\r\nview_count:8%浏览数\r\nis_index|get_name_by_status:首页显示\r\nis_top|get_name_by_status:置顶\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title:请输入标题搜索', '', '1396061373', '1449158734', '1', 'MyISAM', 'Paiqian');
INSERT INTO `wx_model` VALUES ('1241', 'paiqian_invite_log', '邀请日志', '0', '', '1', '', '1:基础', null, '', '', '', null, '10', '', '', '1449488770', '1449488770', '1', 'MyISAM', 'Paiqian');
INSERT INTO `wx_model` VALUES ('1242', 'test_cms', 'testcms', '0', '', '1', '[\"img\",\"title\",\"content\"]', '1:基础', null, '', '', '', 'title:标题\r\nuid|get_nickname:作者\r\nid:操作:[EDIT]|编辑,[DELETE]|删除', '10', 'title:请输入文章标题进行搜索', '', '1449993089', '1449993649', '1', 'MyISAM', 'TestCms');
INSERT INTO `wx_model` VALUES ('103', 'weixin_message', '微信消息管理', '0', '', '1', '', '1:基础', '', '', '', '', 'FromUserName:用户\r\ncontent:内容\r\nCreateTime:时间', '20', '', '', '1438142999', '1438151555', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('1211', 'youaskservice_behavior', 'youaskservice_behavior', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1404033501', '1404033501', '1', 'MyISAM', 'YouaskService');
INSERT INTO `wx_model` VALUES ('1212', 'youaskservice_group', '你问我答-客服分组', '0', '', '1', '[\"groupname\"]', '1:基础', '', '', '', '', 'id:编号\r\ngroupname:分组名称\r\ntoken:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'groupname', '', '1404475456', '1404491410', '1', 'MyISAM', 'YouaskService');
INSERT INTO `wx_model` VALUES ('1213', 'youaskservice_keyword', '你问我答-关键词指配', '0', '', '1', '[\"msgkeyword\",\"msgkeyword_type\",\"zdtype\",\"msgstate\",\"type\",\"msg_test\"]', '1:基础', '', '', '', '', 'id:编号\r\nmsgkeyword:关键字\r\nmsgkeyword_type|get_name_by_status:匹配类型\r\nmsgkfaccount:指定的接待客服或分组\r\nmsgstate|get_name_by_status:状态\r\nzdtype:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'msgkeyword', '', '1404399143', '1453276555', '1', 'MyISAM', 'YouaskService');
INSERT INTO `wx_model` VALUES ('1214', 'youaskservice_logs', '你问我答-聊天记录管理', '0', '', '1', '[\"pid\",\"openid\",\"enddate\",\"keyword\",\"status\"]', '1:基础', '', '', '', '', 'id:编号\r\nkeyword:回复内容\r\nenddate:回复时间', '20', 'keyword', '', '1403947270', '1404060187', '1', 'MyISAM', 'YouaskService');
INSERT INTO `wx_model` VALUES ('1215', 'youaskservice_user', '你问我答-客服工号', '0', '', '1', '[\"name\",\"userName\",\"userPwd\",\"state\",\"kfid\"]', '1:基础', '', '', '', '', 'kfid:编号\r\nname:客服昵称\r\nuserName:客服帐号', '20', 'name', 'userName', '1403947253', '1404398415', '1', 'MyISAM', 'YouaskService');
INSERT INTO `wx_model` VALUES ('1192', 'sms', '短信记录', '0', '', '1', '', '1:基础', '', '', '', '', '', '10', '', '', '1446107661', '1446107661', '1', 'MyISAM', 'Sms');
INSERT INTO `wx_model` VALUES ('1193', 'survey', '调研问卷', '0', '', '1', '[\"keyword\",\"keyword_type\",\"title\",\"cover\",\"intro\",\"finish_tip\",\"template\",\"start_time\",\"end_time\"]', '1:基础', '', '', '', '', 'id:微调研ID\r\nkeyword:关键词\r\nkeyword_type|get_name_by_status:关键词类型\r\ntitle:标题\r\ncTime|time_format:发布时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,survey_answer&id=[id]|数据管理,preview?id=[id]&target=_blank|预览', '20', 'title', '', '1396061373', '1447640225', '1', 'MyISAM', 'Survey');
INSERT INTO `wx_model` VALUES ('1194', 'survey_answer', '调研回答', '0', '', '1', '', '1:基础', '', '', '', '', 'openid:OpenId\r\nnickname:昵称\r\nmobile:手机号\r\ncTime|time_format:参与时间\r\nids:操作:detail?uid=[uid]&survey_id=[survey_id]|回答内容', '20', 'title', '', '1396061373', '1447645551', '1', 'MyISAM', 'Survey');
INSERT INTO `wx_model` VALUES ('201', 'custom_sendall', '客服群发消息', '0', '', '1', '', '1:基础', null, '', '', '', null, '10', '', '', '1447241925', '1447241925', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('148', 'material_text', '文本素材', '0', '', '1', '[\"content\"]', '1:基础', '', '', '', '', 'id:编号\r\ncontent:文本内容\r\nids:操作:text_edit?id=[id]|编辑,text_del?id=[id]|删除', '10', 'content:请输入文本内容搜索', '', '1442976119', '1442977453', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('149', 'material_file', '文件素材', '0', '', '1', '[\"title\",\"file_id\"]', '1:基础', '', '', '', '', '', '10', '', '', '1438684613', '1442982212', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('1190', 'test_question', '测试题目', '0', '', '1', '{\"1\":[\"title\",\"extra\",\"intro\",\"sort\"]}', '1:基础', '', '', '', '', 'id:问题编号\r\ntitle:标题\r\nextra:参数\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '10', 'title', '', '1396061373', '1397145854', '1', 'MyISAM', 'Test');
INSERT INTO `wx_model` VALUES ('1177', 'guess_option', '竞猜项目', '0', '', '1', '[\"name\",\"image\",\"order\"]', '1:基础', '', '', '', '', 'title:活动名称\r\nname:选项名称\r\nimage|get_img_html:选项图片\r\norder:选项顺序\r\nguess_count:竞猜人数\r\nids:操作:optionLog&guess_id=[guess_id]&option_id=[id]|查看选项竞猜记录', '20', '', '', '1428659140', '1430374342', '1', 'MyISAM', 'Guess');
INSERT INTO `wx_model` VALUES ('1178', 'comment', '评论互动', '0', '', '1', '[\"is_audit\"]', '1:基础', '', '', '', '', 'headimgurl|url_img_html:用户头像\r\nnickname|deal_emoji:用户姓名\r\ncontent:评论内容\r\ncTime|time_format:评论时间\r\nis_audit|get_name_by_status:审核状态\r\nids:操作:[DELETE]|删除', '20', 'content:请输入评论内容', '', '1432602310', '1435310857', '1', 'MyISAM', 'Comment');
INSERT INTO `wx_model` VALUES ('1179', 'card_vouchers', '微信卡券', '0', '', '1', '[\"appsecre\",\"code\",\"content\",\"background\",\"title\",\"button_color\",\"head_bg_color\",\"shop_name\",\"uid\",\"token\",\"shop_logo\",\"more_button\",\"template\"]', '1:基础', '', '', '', '', 'title:卡券名称\r\ncard_id:卡券ID\r\nappsecre:商家公众号密钥\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,preview?id=[id]&target=_blank|预览', '20', 'card_id', '', '1421980317', '1437451096', '1', 'MyISAM', 'CardVouchers');
INSERT INTO `wx_model` VALUES ('1180', 'ask', '抢答问卷', '0', '', '1', '[\"keyword\",\"keyword_type\",\"title\",\"cover\",\"intro\",\"finish_tip\",\"shop_address\",\"appids\",\"finish_button\",\"content\",\"card_id\",\"appsecre\",\"template\"]', '1:基础', '', '', '', '', 'id:微抢答ID\r\nkeyword:关键词\r\ntitle:标题\r\ncTime|time_format:发布时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,ask_question&id=[id]|问题管理,ask_answer&id=[id]|数据管理,preview&id=[id]&target=_blank|预览', '20', 'title', '', '1396061373', '1437449751', '1', 'MyISAM', 'Ask');
INSERT INTO `wx_model` VALUES ('1181', 'ask_answer', '抢答回答', '0', '', '1', '', '1:基础', '', '', '', '', 'uid:用户ID\r\nnickname|deal_emoji:昵称\r\nquestion_id:问题\r\nanswer:回答\r\nis_correct:是否正确\r\ntrue_answer:正确答案\r\ntimes:第几轮\r\ncTime|time_format:回答时间', '20', 'uid:请输入用户ID', '', '1396061373', '1430290975', '1', 'MyISAM', 'Ask');
INSERT INTO `wx_model` VALUES ('1182', 'ask_question', '抢答问题', '0', '', '1', '[\"title\",\"type\",\"extra\",\"answer\",\"wait_time\",\"sort\",\"percent\",\"intro\"]', '1:基础', '', '', '', '', 'title:标题\r\ntype|get_name_by_status:问题类型\r\nwait_time:时间间隔\r\npercent:抢中概率\r\nanswer:正确答案\r\nsort:排序号\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1396061373', '1421749210', '1', 'MyISAM', 'Ask');
INSERT INTO `wx_model` VALUES ('1186', 'invite', '微邀约', '0', '', '1', '[\"keyword\",\"keyword_type\",\"title\",\"intro\",\"cover\",\"experience\",\"num\",\"coupon_id\",\"content\",\"template\"]', '1:基础', '', '', '', '', 'keyword:关键词\r\ntitle:标题\r\nexperience:消耗经验值\r\ncoupon_id:优惠券编号\r\ncoupon_name:优惠券标题\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,lists?target_id=[coupon_id]&target=_blank&_addons=Coupon&_controller=Sn|领取记录,preview?id=[id]&target=_blank|预览', '20', 'title', '', '1396061373', '1437448319', '1', 'MyISAM', 'Invite');
INSERT INTO `wx_model` VALUES ('1187', 'invite_user', '微邀约用户记录', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1418192328', '1418192328', '1', 'MyISAM', 'Invite');
INSERT INTO `wx_model` VALUES ('1188', 'tongji', '运营统计', '0', '', '1', '{\"1\":[\"month\",\"day\",\"content\"]}', '1:基础', '', '', '', '', 'day:日期', '10', 'day', '', '1401371050', '1401371409', '1', 'MyISAM', 'Tongji');
INSERT INTO `wx_model` VALUES ('1189', 'test', '测试问卷', '0', '', '1', '[\"keyword\",\"keyword_type\",\"title\",\"intro\",\"cover\",\"finish_tip\"]', '1:基础', '', '', '', '', 'keyword:关键词\r\nkeyword_type|get_name_by_status:关键词匹配类型\r\ntitle:问卷标题\r\nid:操作:[EDIT]|编辑,[DELETE]|删除,test_question&target=_blank&id=[id]|题目管理,test_answer&target=_blank&id=[id]|用户记录,preview&target=_blank&id=[id]|问卷预览', '10', 'title', '', '1396061373', '1448248071', '1', 'MyISAM', 'Test');
INSERT INTO `wx_model` VALUES ('1173', 'coupon_shop', '适用门店', '0', '', '1', '[\"name\",\"address\",\"gps\",\"phone\"]', '1:基础', '', '', '', '', 'name:店名\r\nphone:联系电话\r\naddress:详细地址\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'name:店名搜索', '', '1427164604', '1439465222', '1', 'MyISAM', 'Coupon');
INSERT INTO `wx_model` VALUES ('1174', 'coupon_shop_link', '门店关联', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1427356350', '1427356350', '1', 'MyISAM', 'Coupon');
INSERT INTO `wx_model` VALUES ('1175', 'guess', '竞猜', '0', '', '1', '[\"title\",\"desc\",\"start_time\",\"end_time\",\"template\",\"cover\"]', '1:基础', '', '', '', '', 'title:活动名称\r\nstart_time|time_format:开始时间\r\nend_time|time_format:结束时间\r\nguess_count:参与人数\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,guessOption&guess_id=[id]&target=_blank|竞猜选项,guessLog&guess_id=[id]&target=_blank|竞猜记录,preview?id=[id]&target=_blank|预览', '20', 'title:活动名称', '', '1428654951', '1437450636', '1', 'MyISAM', 'Guess');
INSERT INTO `wx_model` VALUES ('1176', 'guess_log', '竞猜记录', '0', '', '1', '[\"token\"]', '1:基础', '', '', '', '', 'optionIds:竞猜选项\r\nuser_id:用户id\r\nuser_name:用户昵称\r\ntoken:用户token\r\ncTime|time_format:竞猜时间\r\n', '20', '', '', '1428738271', '1430374436', '1', 'MyISAM', 'Guess');
INSERT INTO `wx_model` VALUES ('176', 'update_score_log', '修改积分记录', '0', '', '1', '', '1:基础', null, '', '', '', null, '10', '', '', '1444302325', '1444302325', '1', 'MyISAM', 'Core');
INSERT INTO `wx_model` VALUES ('1171', 'forms_value', '通用表单数据', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1396687959', '1396687959', '1', 'MyISAM', 'Forms');
INSERT INTO `wx_model` VALUES ('1172', 'coupon', '优惠券', '0', '', '1', '[\"title\",\"cover\",\"use_tips\",\"start_time\",\"start_tips\",\"end_time\",\"end_tips\",\"end_img\",\"num\",\"max_num\",\"over_time\",\"empty_prize_tips\",\"pay_password\",\"background\",\"more_button\",\"use_start_time\",\"shop_name\",\"shop_logo\",\"head_bg_color\",\"button_color\",\"template\",\"member\"]', '1:基础', '', '', '', '', 'id:优惠券编号\r\ntitle:标题\r\nnum:计划发送数\r\ncollect_count:已领取数\r\nuse_count:已使用数\r\nstart_time|time_format:开始时间\r\nend_time|time_format:结束时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,lists?target_id=[id]&target=_blank&_controller=Sn|成员管理,preview?id=[id]&target=_blank|预览', '20', 'title', '', '1396061373', '1447756274', '1', 'MyISAM', 'Coupon');
INSERT INTO `wx_model` VALUES ('1170', 'forms_attribute', '表单字段', '0', '', '1', '[\"name\",\"title\",\"type\",\"extra\",\"value\",\"remark\",\"is_must\",\"validate_rule\",\"error_info\",\"sort\"]', '1:基础', '', '', '', '', 'title:字段标题\r\nname:字段名\r\ntype|get_name_by_status:字段类型\r\nids:操作:[EDIT]&forms_id=[forms_id]|编辑,[DELETE]|删除', '20', 'title', '', '1396061373', '1396710959', '1', 'MyISAM', 'Forms');
INSERT INTO `wx_model` VALUES ('1166', 'lottery_games_award_link', '抽奖游戏奖品设置', '0', '', '1', '', '1:基础', '', '', '', '', '', '10', '', '', '1444900969', '1444900969', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1167', 'draw_follow_log', '粉丝抽奖记录', '0', '', '1', '[\"follow_id\",\"sports_id\",\"count\",\"cTime\"]', '1:基础', '', '', '', '', '', '20', '', '', '1432619171', '1432719012', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1168', 'extensions', '融合第三方', '0', '', '1', '', '1:基础', '', '', '', '', 'keyword:关键词\r\nkeyword_filter|get_name_by_status:关键词过滤\r\noutput_format|get_name_by_status:数据输出格式\r\napi_url:第三方地址\r\napi_token:Token\r\ncTime|time_format:增加时间\r\nid:操作:[EDIT]|编辑,[DELETE]|删除', '10', 'keyword', '', '1393911774', '1394267850', '1', 'MyISAM', 'Extensions');
INSERT INTO `wx_model` VALUES ('1169', 'forms', '通用表单', '0', '', '1', '[\"keyword\",\"keyword_type\",\"title\",\"intro\",\"cover\",\"can_edit\",\"finish_tip\",\"jump_url\",\"content\",\"template\"]', '1:基础', '', '', '', '', 'id:通用表单ID\r\nkeyword:关键词\r\nkeyword_type|get_name_by_status:关键词类型\r\ntitle:标题\r\ncTime|time_format:发布时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,forms_attribute&id=[id]|字段管理,forms_value&id=[id]|数据管理,preview&id=[id]|预览', '20', 'title', '', '1396061373', '1437450012', '1', 'MyISAM', 'Forms');
INSERT INTO `wx_model` VALUES ('1143', 'custom_reply_mult', '多图文配置', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1396602475', '1396602475', '1', 'MyISAM', 'CustomReply');
INSERT INTO `wx_model` VALUES ('1144', 'custom_reply_news', '图文回复', '0', '', '1', '[\"keyword\",\"keyword_type\",\"title\",\"intro\",\"cate_id\",\"cover\",\"content\",\"sort\"]', '1:基础', '', '', '', '', 'id:5%ID\r\nkeyword:10%关键词\r\nkeyword_type|get_name_by_status:20%关键词类型\r\ntitle:30%标题\r\ncate_id:10%所属分类\r\nsort:7%排序号\r\nview_count:8%浏览数\r\nid:10%操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1396061373', '1401368247', '1', 'MyISAM', 'CustomReply');
INSERT INTO `wx_model` VALUES ('1145', 'custom_reply_text', '文本回复', '0', '', '1', '[\"keyword\",\"keyword_type\",\"content\",\"sort\"]', '1:基础', '', '', '', '', 'id:ID\r\nkeyword:关键词\r\nkeyword_type|get_name_by_status:关键词类型\r\nsort:排序号\r\nview_count:浏览数\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'keyword', '', '1396578172', '1401017369', '1', 'MyISAM', 'CustomReply');
INSERT INTO `wx_model` VALUES ('1147', 'auto_reply', '自动回复', '0', '', '1', '[\"keyword\",\"content\",\"group_id\",\"image_id\"]', '1:基础', '', '', '', '', 'keyword:关键词\r\ncontent:文件内容\r\ngroup_id:图文\r\nimage_id:图片\r\nids:操作:[EDIT]&type=[msg_type]|编辑,[DELETE]|删除', '10', 'keyword:请输入关键词', '', '1439194522', '1439258843', '1', 'MyISAM', 'AutoReply');
INSERT INTO `wx_model` VALUES ('1148', 'weisite_category', '微官网分类', '0', '', '1', '[\"title\",\"icon\",\"url\",\"is_show\",\"sort\",\"pid\"]', '1:基础', '', '', '', '', 'title:15%分类标题\r\nicon|get_img_html:分类图片\r\nurl:30%外链\r\nsort:10%排序号\r\npid:10%一级目录\r\nis_show|get_name_by_status:10%显示\r\nid:10%操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1395987942', '1439522869', '1', 'MyISAM', 'WeiSite');
INSERT INTO `wx_model` VALUES ('1149', 'weisite_cms', '文章管理', '0', '', '1', '[\"keyword\",\"keyword_type\",\"title\",\"intro\",\"cate_id\",\"cover\",\"content\",\"sort\"]', '1:基础', '', '', '', '', 'keyword:关键词\r\nkeyword_type|get_name_by_status:关键词类型\r\ntitle:标题\r\ncate_id:所属分类\r\nsort:排序号\r\nview_count:浏览数\r\nids:操作:[EDIT]&module_id=[pid]|编辑,[DELETE]|删除', '20', 'title', '', '1396061373', '1408326292', '1', 'MyISAM', 'WeiSite');
INSERT INTO `wx_model` VALUES ('1150', 'weisite_footer', '底部导航', '0', '', '1', '[\"pid\",\"title\",\"url\",\"sort\"]', '1:基础', '', '', '', '', 'title:菜单名\r\nicon:图标\r\nurl:关联URL\r\nsort:排序号\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1394518309', '1396507698', '1', 'MyISAM', 'WeiSite');
INSERT INTO `wx_model` VALUES ('1151', 'weisite_slideshow', '幻灯片', '0', '', '1', '[\"title\",\"img\",\"url\",\"is_show\",\"sort\"]', '1:基础', '', '', '', '', 'title:标题\r\nimg:图片\r\nurl:链接地址\r\nis_show|get_name_by_status:显示\r\nsort:排序\r\nids:操作:[EDIT]&module_id=[pid]|编辑,[DELETE]|删除', '20', 'title', '', '1396098264', '1408323347', '1', 'MyISAM', 'WeiSite');
INSERT INTO `wx_model` VALUES ('1152', 'exam', '考试试卷', '0', '', '1', '[\"keyword\",\"keyword_type\",\"title\",\"intro\",\"cover\",\"finish_tip\"]', '1:基础', '', '', '', '', 'keyword:关键词\r\nkeyword_type|get_name_by_status:关键词匹配类型\r\ntitle:试卷标题\r\nstart_time|time_format:开始时间\r\nend_time|time_format:结束时间\r\nid:操作:[EDIT]|编辑,[DELETE]|删除,exam_question&target=_blank&id=[id]|题目管理,exam_answer&target=_blank&id=[id]|考生成绩,preview&id=[id]&target=_blank|试卷预览', '10', 'title:请输入试卷标题搜索', '', '1396061373', '1447755312', '1', 'MyISAM', 'Exam');
INSERT INTO `wx_model` VALUES ('1153', 'exam_question', '考试题目', '0', '', '1', '{\"1\":[\"title\",\"type\",\"extra\",\"intro\",\"is_must\",\"sort\"]}', '1:基础', '', '', '', '', 'title:标题\r\ntype|get_name_by_status:题目类型\r\nscore:分值\r\nid:操作:[EDIT]|编辑,[DELETE]|删除', '10', 'title', '', '1396061373', '1397035409', '1', 'MyISAM', 'Exam');
INSERT INTO `wx_model` VALUES ('1154', 'exam_answer', '考试回答', '0', '', '1', '', '1:基础', '', '', '', '', 'openid:OpenId\r\ntruename:姓名\r\nmobile:手机号\r\nscore:成绩\r\ncTime|time_format:考试时间\r\nid:操作:detail?uid=[uid]&exam_id=[exam_id]|答题详情', '10', 'title', '', '1396061373', '1397036455', '1', 'MyISAM', 'Exam');
INSERT INTO `wx_model` VALUES ('1155', 'draw_follow_log', '粉丝抽奖记录', '0', '', '1', '[\"follow_id\",\"sports_id\",\"count\",\"cTime\"]', '1:基础', '', '', '', '', '', '20', '', '', '1432619171', '1432719012', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1156', 'lottery_prize_list', '抽奖奖品列表', '0', '', '1', '[\"sports_id\",\"award_id\",\"award_num\"]', '1:基础', '', '', '', '', 'sports_id:比赛场次\r\naward_id:奖品名称\r\naward_num:奖品数量\r\nid:编辑:[EDIT]|编辑,[DELETE]|删除,add?sports_id=[sports_id]|添加', '20', '', '', '1432613700', '1432710817', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1157', 'lucky_follow', '中奖者信息', '0', '', '1', '[\"draw_id\",\"sport_id\",\"award_id\",\"follow_id\",\"address\",\"num\",\"state\",\"zjtime\",\"djtime\"]', '1:基础', '', '', '', '', 'nickname|deal_emoji:8%微信昵称\r\narea:6%地区\r\nmobile:12%手机号\r\ntruename:7%姓名\r\naddress:6%地址\r\naward_id:10%中奖奖品\r\nnum:5%数量\r\nsport_id:9%中奖场次\r\nzjtime|time_format:8%中奖时间\r\nstate|get_name_by_status:6%兑奖状态\r\ndjtime|time_format:9%兑奖时间\r\ndrum_count:7%擂鼓次数\r\nid:8%中奖人其他信息:luckyFollowDetail?id=[id]|查看\r\n\r\n\r\n', '20', 'award_id:输入奖品名称', '', '1432618091', '1435031703', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1158', 'lzwg_activities', '靓妆活动', '0', '', '1', '[\"title\",\"remark\",\"logo_img\",\"start_time\",\"end_time\",\"get_prize_tip\",\"no_prize_tip\",\"lottery_number\",\"get_prize_count\",\"comment_status\"]', '1:基础', '', '', '', '', 'title:活动名称\r\nremark:活动描述\r\nlogo_img|get_img_html:活动LOGO\r\nactivitie_time:活动时间\r\nget_prize_tip:中将提示信息\r\nno_prize_tip:未中将提示信息\r\ncomment_list:评论列表\r\nset_vote:设置投票\r\nset_award:设置奖品\r\nget_prize_list:中奖列表\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', '', '', '1435306468', '1436181872', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1159', 'lzwg_activities_vote', '投票答题活动', '0', '', '1', '[\"lzwg_id\",\"vote_type\",\"vote_limit\",\"lzwg_type\",\"vote_id\"]', '1:基础', '', '', '', '', 'lzwg_name:活动名称\r\nstart_time|time_format:活动开始时间\r\nend_time|time_format:活动结束时间\r\nlzwg_type|get_name_by_status:活动类型\r\nvote_title:题目\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,tongji&id=[id]|用户参与分析\r\n', '20', 'lzwg_id:活动名称', '', '1435734819', '1435825972', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1160', 'sport_award', '抽奖奖品', '0', '', '1', '[\"award_type\",\"name\",\"count\",\"img\",\"price\",\"score\",\"explain\"]', '1:基础', '', '', '', '', 'id:6%编号\r\nname:23%奖项名称\r\nimg|get_img_html:8%商品图片\r\nprice:8%商品价格\r\nexplain:24%奖品说明\r\ncount:8%奖品数量\r\nid:20%操作:[EDIT]|编辑,[DELETE]|删除,getlistByAwardId?awardId=[id]&_controller=LuckyFollow|中奖者列表', '20', 'name:请输入抽奖名称', '', '1432607100', '1433312389', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1161', 'sports', '体育赛事', '0', '', '1', '[\"home_team\",\"visit_team\",\"start_time\",\"score\",\"content\",\"countdown\",\"comment_status\"]', '1:基础', '', '', '', '', 'start_time|time_format:20%比赛场次\r\nvs_team:20%对战球队（主场VS客场）\r\nscore_title:8%比分\r\ncontent|lists_msubstr:27%对战球队的介绍\r\nids:23%操作:add?sports_id=[id]&_controller=LotteryPrizeList&_addons=Draw&target=_blank|奖品配置,lists?sports_id=[id]&_addons=Draw&_controller=LuckyFollow&target=_blank|中奖列表,lists?sports_id=[id]&_addons=Comment&_controller=Comment&target=_blank|评论列表,package?id=[id]&_controller=Sucai&_addons=Sucai&source=Sports&is_preview=1&target=_blank|预览,package?id=[id]&_controller=Sucai&_addons=Sucai&source=Sports&is_download=1&target=_blank|下载素材,[EDIT]|编辑,[DELETE]|删除', '20', 'home_team:请输入球队名', '', '1432556238', '1436173617', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1162', 'sports_drum', '擂鼓记录', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1432642253', '1432642253', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1163', 'sports_support', '球队支持记录', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1432635084', '1432635084', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1164', 'sports_team', '比赛球队', '0', '', '1', '[\"title\",\"logo\",\"intro\"]', '1:基础', '', '', '', '', 'logo|get_img_html:球队图标\r\ntitle:球队名称\r\nintro|lists_msubstr:球队说明\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title:请输入球队名', '', '1432556797', '1432886417', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1238', 'paiqian_slideshow', '幻灯片', '0', '', '1', '[\"img\",\"url\",\"is_show\",\"sort\"]', '1:基础', '', '', '', '', 'img:图片\r\nurl:链接地址\r\nis_show|get_name_by_status:显示\r\nsort:排序\r\nids:操作:[EDIT]&module_id=[pid]|编辑,[DELETE]|删除', '20', 'title', '', '1396098264', '1449201389', '1', 'MyISAM', 'Paiqian');
INSERT INTO `wx_model` VALUES ('1216', 'youaskservice_wechat_enddate', 'youaskservice_wechat_enddate', '0', '', '1', '', '1:基础', '', '', '', '', '', '20', '', '', '1404026714', '1404026714', '1', 'MyISAM', 'YouaskService');
INSERT INTO `wx_model` VALUES ('1191', 'test_answer', '测试回答', '0', '', '1', '', '1:基础', '', '', '', '', 'openid:OpenId\r\ntruename:姓名\r\nmobile:手机号\r\nscore:得分\r\ncTime|time_format:测试时间\r\nid:操作:detail?uid=[uid]&test_id=[test_id]|答题详情', '10', 'title', '', '1396061373', '1397145984', '1', 'MyISAM', 'Test');
INSERT INTO `wx_model` VALUES ('1165', 'lottery_games', '抽奖游戏', '0', '', '1', '[\"title\",\"keyword\",\"game_type\",\"start_time\",\"end_time\",\"status\",\"day_attend_limit\",\"attend_limit\",\"day_win_limit\",\"win_limit\",\"day_winners_count\",\"remark\"]', '1:基础', '', '', '', '', 'id:序号\r\ntitle:活动名称\r\ngame_type|get_name_by_status:游戏类型\r\nkeyword:关键词\r\nstart_time|time_format:开始时间\r\nend_time|time_format:结束时间\r\nstatus:活动状态\r\nattend_num:参与人数\r\nwinners_list:中奖人列表\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,preview&games_id=[id]|预览,index&_addons=Draw&_controller=Wap&games_id=[id]|复制链接', '10', '', '', '1444877287', '1445482517', '1', 'MyISAM', 'Draw');
INSERT INTO `wx_model` VALUES ('1195', 'survey_question', '调研问题', '0', '', '1', '[\"title\",\"type\",\"extra\",\"intro\",\"is_must\",\"sort\"]', '1:基础', '', '', '', '', 'title:标题\r\ntype|get_name_by_status:问题类型\r\nis_must|get_name_by_status:是否必填\r\nids:操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1396061373', '1396955090', '1', 'MyISAM', 'Survey');
INSERT INTO `wx_model` VALUES ('1142', 'custom_menu', '自定义菜单', '0', '', '1', '[\"pid\",\"title\",\"from_type\",\"type\",\"jump_type\",\"addon\",\"sucai_type\",\"keyword\",\"url\",\"sort\"]', '1:基础', '', '', '', '', 'title:10%菜单名\r\nkeyword:10%关联关键词\r\nurl:50%关联URL\r\nsort:5%排序号\r\nid:10%操作:[EDIT]|编辑,[DELETE]|删除', '20', 'title', '', '1394518309', '1447317015', '1', 'MyISAM', 'CustomMenu');

-- ----------------------------
-- Table structure for `wx_online_count`
-- ----------------------------
DROP TABLE IF EXISTS `wx_online_count`;
CREATE TABLE `wx_online_count` (
  `publicid` int(11) DEFAULT NULL,
  `addon` varchar(30) DEFAULT NULL,
  `aim_id` int(11) DEFAULT NULL,
  `time` bigint(12) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  KEY `tc` (`time`,`count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_online_count
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_paiqian_category`
-- ----------------------------
DROP TABLE IF EXISTS `wx_paiqian_category`;
CREATE TABLE `wx_paiqian_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(100) NOT NULL COMMENT '分类标题',
  `is_show` tinyint(2) DEFAULT '1' COMMENT '显示',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `sort` int(10) DEFAULT '0' COMMENT '排序号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of wx_paiqian_category
-- ----------------------------
INSERT INTO `wx_paiqian_category` VALUES ('1', '行业新闻', '1', 'gh_741263a45132', '0');
INSERT INTO `wx_paiqian_category` VALUES ('2', '系统推荐', '1', 'gh_741263a45132', '0');
INSERT INTO `wx_paiqian_category` VALUES ('3', '最新', '1', 'gh_be33dc482e19', '0');
INSERT INTO `wx_paiqian_category` VALUES ('4', '热门', '1', 'gh_be33dc482e19', '0');
INSERT INTO `wx_paiqian_category` VALUES ('5', '公司新闻', '1', 'gh_1784a6c712f0', '0');
INSERT INTO `wx_paiqian_category` VALUES ('6', '行业头条', '1', 'gh_1784a6c712f0', '0');
INSERT INTO `wx_paiqian_category` VALUES ('7', '互动活动', '1', 'gh_1784a6c712f0', '0');

-- ----------------------------
-- Table structure for `wx_paiqian_invite_log`
-- ----------------------------
DROP TABLE IF EXISTS `wx_paiqian_invite_log`;
CREATE TABLE `wx_paiqian_invite_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `invite_uid` int(10) DEFAULT NULL COMMENT '邀请人ID',
  `uid` int(10) DEFAULT NULL COMMENT '被邀请人ID',
  `cTime` int(10) DEFAULT NULL COMMENT '邀请时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of wx_paiqian_invite_log
-- ----------------------------
INSERT INTO `wx_paiqian_invite_log` VALUES ('1', '9', '1', '1449549184');

-- ----------------------------
-- Table structure for `wx_paiqian_news`
-- ----------------------------
DROP TABLE IF EXISTS `wx_paiqian_news`;
CREATE TABLE `wx_paiqian_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `intro` text COMMENT '简介',
  `cate_id` int(10) unsigned DEFAULT '0' COMMENT '所属类别',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '封面图片',
  `content` text COMMENT '内容',
  `cTime` int(10) DEFAULT NULL COMMENT '发布时间',
  `view_count` int(10) unsigned DEFAULT '0' COMMENT '浏览数',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `jump_url` varchar(255) DEFAULT NULL COMMENT '外链',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `is_index` tinyint(2) DEFAULT '0' COMMENT '首页显示',
  `is_top` tinyint(2) DEFAULT '0' COMMENT '置顶',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of wx_paiqian_news
-- ----------------------------
INSERT INTO `wx_paiqian_news` VALUES ('2', '  商品房过剩总库存21亿平方米 楼市进过剩时代', '报告称，2016年中国楼市内部条件与外部环境并不乐观，在此背景下，房价存在较大幅度下跌的波动运行可能性，但由于宏观政策进一步宽松，房地产市场不会硬着陆', '1', '14', '<div class=\"TRS_Editor\"><p>　\r\n　中国社会科学院财经战略研究院3日发布《中国住房报告（2015-2016）》。报告指出，2015年房地产市场的住房形势超出预期。一方面投资增速呈\r\n俯冲式下降，对经济增长直接贡献几乎为零；另一方面，库存高企，去化压力增大，商品住房过剩总库存高达21亿平方米，仅现房库存去化就需23至24个月。\r\n与此同时，住房市场步入“结构性过剩”时代，内部结构失衡，“一线城市供求矛盾突出”与“三四线城市供过于求”并存。</p><p>　　报告称，2016年中国楼市内部条件与外部环境并不乐观，在此背景下，房价存在较大幅度下跌的波动运行可能性，但由于宏观政策进一步宽松，房地产市场不会硬着陆。</p><p>　　<strong>加剧 现房库存去化周期高达24个月</strong></p><p>　　报告指出，今年以来，虽然宏观政策一再宽松，商品住房库存去化却难见好转。作为代表开发商预期、潜在库存以及市场需求的新开工面积、施工面积以及竣工面积三个典型指标，虽然整体趋缓，供应量减少，但待售库存压力却没有较大缓解。</p><p>　　具体来看，新开工方面，自年初以来同比持续下滑，2月到9月之间累计额的同比增长率甚至为-13.5%到-20.9%。施工面积方面，自2004年10月8.8%的同比增幅逐步放缓至2015年8月的0.2%。竣工方面，则仅维持在-10%到-20%。</p><p>　　尽管投资、施工等数据大幅放缓，但新建商品住房待售量却未减，截至10月底，新建商品住房待售面积为43654万平方米，同比上升14%。</p><p>　　中国社会科学院城市与竞争力研究中心主任倪鹏飞表示，宏观政策刺激力度加大，特别是信贷宽松，促使5月以来住房销售速度显著提升，但市场观望情绪浓厚，仍未扭转库存高企的现实，也再次说明了库存的严峻性。</p><p>　　“商品住房过剩总库存量高达21亿平方米。”倪鹏飞说。报告指出，目前现房方面，去化超过18个月以上的过剩1亿平方米，期房方面，去化超过2年的过剩面积达19.96亿平方米。</p><p>　　以2015年商品住房总库存计算，总库存预计达39.96亿平方米，其中，期房库存即在建房待售面积35.7亿平方米，去化周期达4.5年，现\r\n房待售面积方面，库存4.26亿平方米，去化周期为23个月。值得注意的是，按照最大合理库存存销比例，商品住房合理总库存仅为22亿平方米，其中，现房\r\n库存去化周期18个月，面积为3.21亿平方米，期房去化24个月，涉及15.78亿平方米。</p><p>　　去化周期方面，目前现房库存高达23至24个月，远高于6至18个月的合理区间，较2012年的11个月左右更是大幅上涨。</p><p>　　<strong>失衡 住房市场步入“结构性过剩”时代</strong></p><p>　　报告指出，当前我国住房市场一个很突出的问题是，住房市场发展严重失衡，结构性过剩与结构性短缺并存。一线城市住房供求矛盾突出，房价畸高；三四线城市及部分二线城市住房市场呈现阶段性过剩，库存高企，房价下跌。</p><p>　　社科院财经战略研究院邹琳华博士表示，过去十年，在快速城镇化与工业化浪潮的推动下，城镇住房整体呈现供不应求态势。但2014年以来，住房总量“供不应求”时代淡出，“结构性过剩”时代到来。</p><p>　　邹琳华表示，虽然住房总量短缺时代已过去，三四线城市住房短期过剩明显，但由于人口的净流入及收入水平的提高，一线城市住房现阶段仍存部分短缺。</p><p>　　同时，在部分大城市，住房面积狭小和职住不平衡等结构性短缺问题严重。而许多二线城市如西安、青岛等，都出现了大户型优质住宅销售状况较好，而90平方米以下的小户型销售遇冷的局面。</p><p>　　报告指出，在内部结构性过剩严重、外部环境趋于恶化的条件下，如果仍继续原有的“经济房地产化”导向，刺激住房消费以维系高房价与经济高增长，将加重住房结构性过剩。</p><p>　　倪鹏飞表示，过去十年，虽然住房市场促进了经济快速增长，但被作为宏观经济支柱与地方政府财源，也承载了过多的压力。“房价被认为可涨不可跌，也使城镇居民家庭负担过重，进而影响经济内需不足，产业转型乏力。”</p><p>　　<strong>预警 明年房价或较大程度下跌波动</strong></p><p>　　倪鹏飞表示，2015年6月后，房地产销售面积一改同比下降趋势，出现明显的回暖趋向，升中企稳。但在宏观经济下行压力、结构调整与短期增长有\r\n冲突的背景下，不能保证2016年房价稳定的可持续性。考虑到宏观政策影响与自我调整程度，2016年房价或存在较大程度下跌波动的可能。</p><p>　　此外，倪鹏飞指出，在政策激励下，2015年商品房销售量接近2013年峰值水平，改善性需求大幅释放。但从目前来看，销售增长却显乏力，库存\r\n压力缓解有限。因此，2016年住房市场回暖基础不稳，波动风险较大，分化或趋于严重。但他同时表示，由于金融环境宽松，购房信贷成本处于历史低点，因\r\n此，房价并不会出现硬着陆，仍以相对稳定为主。</p><p>　　报告建议，住房市场发展应与转变经济增长方式相结合，通过适度藏富于民，实现住房市场与经济社会的协调发展。如出台按揭贷款利息抵扣个人所得税政策，降低购房还款负担，实现居者有其屋和藏富于民双重目标。对居民家庭购买首套普通商品住房提供购房补贴和利息补贴。</p><p>　　“应减免普通商品住房交易税费，促进自由迁徙和居住条件改善。”倪鹏飞表示，应扩大契税优惠，所有普通商品住房契税均按1%的优惠税率收取；取\r\n消2年限制，所有普通商品住房交易免征营业税；取消自用5年及唯一生活用房限制，所有出售普通商品住房的所得均免征个人所得税；对于卖一买一的换房需求除\r\n给予税费减免外，还可给予适度财政补贴。</p><p>　　对于供给端，倪鹏飞表示，应减少开工，扶持开发企业转型升级。例如主业不是房地产的开发企业转型时，在土地用途调整、行政审批、税费方面给予部分扶持。并鼓励企业并购重组，以减少烂尾风险。</p><p>　　而对于房价畸高、住房供需矛盾突出的热点城市，倪鹏飞表示，应加大普通住房土地供应，加快住房用地入市节奏，对未完成供地任务的城市将调减整体供地指标作为惩罚。同时在补交土地出让金和科学规划的前提下，支持商改住、工改住。</p><p>　　倪鹏飞表示，未来三大政策目标包括去库存、防风险、促投资。具体来看，加快对未来5年总供给的88.2亿平方米库存的消化，并保持价格平稳，防止大起大落，带来违约风险。投资负面，促进投资维持10%左右的增速，恢复正常水平。</p></div><p><br/></p>', '1449197310', '4', 'gh_741263a45132', '', '', '0', '1');
INSERT INTO `wx_paiqian_news` VALUES ('3', '从846家初创倒下 看A轮融资后的悬崖', '据相关数据显示，2014年拿到A轮投资的企业高达846家。然而，能够坚持到现在的却寥寥无几。尤其是在今年，更是加速了倒闭的进程。O2O初创企业成为这场寒冬的重灾区，让人扼腕叹息', '2', '13', '<p class=\"text\">相比往年，今年的寒冷冬天来得更早。在互联网行业，今年的“大雪”更是比上次的金融泡沫来的更早一些。BAT、新浪等巨\r\n头纷纷停止招聘；垂直电商股价犹如黄河之水一样倾泻不止；P2P网贷平台跑路消息接踵而至；智能手机厂商利润贴地飞行……种种迹象表明，这场互联网寒冬并\r\n没有那么容易度过。</p><p class=\"text\">但在这场寒冬中最受影响的，却不是这些还能生存，还能喧哗的互联网企业，是那些刚刚拿到天使投资、A轮融资，正在畅想未来光明前景，却戛然而止的初创企业。它们原本都有着看似美好的未来，却因为种种原因停下前行的脚步。这道悬崖，成为它们怎么也迈步过去的坎儿。</p><p class=\"text\"><strong> O2O初创成重灾区 近千企业成B轮亡魂</strong></p><p class=\"text\">当下，网购、搜索、社交等领域，几乎成为初创企业的“禁地”。相比之下，O2O领域成为初创企业的最爱。之所其以受到青\r\n睐，无非在于这个领域概念足够新鲜、项目门槛低、启动快，且很容易就拿到融资——前提是会将故事，会包装。由此，近两年，打着各种名目的O2O项目如雨后\r\n春笋般般出现。</p><p class=\"text\">但也正是因为入门门槛实在太低，导致每个O2O细分领域都“人满为患”，竞争极其惨烈。即使故事说得再好，始终逃不掉烧钱补贴换市场的怪圈。当融来的钱没支撑到初见成效、收益的时候，就已经在惨烈的竞争中败下阵来。</p><p class=\"text\">据数据显示，2014年拿到A轮投资的企业高达846家。然而，能够坚持到现在的却寥寥无几。尤其是在今年，更是加速了倒闭的进程。O2O初创企业成为这场寒冬的重灾区，让人扼腕叹息。</p><p class=\"text\"><strong> 烧钱，成为O2O唯一或很长时间内驱动力</strong></p><p class=\"text\">此前，几乎所有的O2O初创企业在推出相关项目时，都对未来持以乐观态度。因为它们知道，不用太过担心盈利问题，只要有\r\n源源不断的资金融入，就能将编好的故事一直说下去。或者说它们将盈利的目标放在N轮融资之后，只是不断向这个目标推进，中间的过程却是为了满足自己的创\r\n业、个人需求。</p><p class=\"text\">以往O2O初创企业轮番的造势，让O2O领域成功忽悠了很多投资人，认定其是未来最佳商业模式，甚至有可能颠覆一切。在\r\n资本的力推下，O2O的确席卷了一切。但O2O火爆的前提却大多是依靠“源源不断资金投入”，对于市场的盈利途径，很多可能还未真正来得及去实施。这样造\r\n成，很多O2O项目在资本寒冬到来前根本没有盈利的可能。以往借助O2O这个巨大的风口，不断忽悠投资人往里投钱，以烧钱补贴换市场当做模式和借口，当没\r\n有了资本时，一切的美好规划都成为了泡影。</p><p class=\"text\">完全依赖烧钱为驱动力的O2O初创企业，相比其他互联网企业，天生就显得有些“畸形”。靠概念忽悠，总归不是长久之计。资本浪潮退去后，O2O初创企业完全就是在裸泳。</p><p class=\"text\"><strong> B轮融资需求资金更大 大势促成悬崖之势</strong></p><p class=\"text\">今年以来，由于多种原因的影响，经济下行，大环境并不好，导致很多投资人也囊中羞涩。在这样的大势下，自然会减少对\r\nO2O领域的投入。但没想到的是，一撤资，立刻O2O初创企业的软肋就立刻暴露出来。完全依靠巨资推进的O2O项目，没有了资金的支持，烧钱补贴成为空\r\n谈，成为大众摒弃的对象。去年10月上线的推拿O2O项目“功夫熊”不到两个月就先后获得数百万元天使投资和数百万美元的A轮融资，被所有人看好。但却于\r\n前些日子宣布倒闭，就在于投资人对烧钱补贴换市场的模式失去耐心——尤其是迟迟不见回报的情况下。</p><p class=\"text\">大势的疲态，导致很多拿到A轮融资的初创企业及时将饼画得再大，也没能打动投资者。毕竟B轮融资需求资金较大，投资者肯定会更为慎重。不过那些融到B轮融资的初创企业也未到兴奋的时候。虽然幸运地躲过了这场寒冬，但接下来的C轮、D轮等融资节点，依然会让它们挠头。</p><p class=\"text\"><strong> 卧薪尝胆？卷土重来尚需时间</strong></p><p class=\"text\">如果O2O初创企业现在想避过这场寒冬，开启收缩战略，将摊子弄小，同样也无济于事。因为按照目前的态势发展，这场寒冬\r\n将会持续很长一段时间，绝不是简单的“节流”就能躲过去的。更为严重的是，众多O2O初创企业倒闭给投资者带来警告：O2O领域没没有想象中那么美好。那\r\n些缺乏创意，只靠烧钱撑起来的项目将首先成为“炮灰”。</p><p class=\"text\">一夜成名、一夜暴富的盛况在O2O领域已然成为过去。最好的方法就是，初创企业蛰伏起来，并不去趟O2O领域这趟浑水。初创企业只能保持灵敏的嗅觉，在大势逐渐复苏的时候再行切入。只是，这需要时间的沉淀。（科技新发现 康斯坦丁/文）</p><p><br/></p>', '1449197386', '3', 'gh_741263a45132', '', '韦小宝', '1', '1');
INSERT INTO `wx_paiqian_news` VALUES ('4', '长租市场标准化应该摆正互联网的位置', '互联网创业者所说的“某个领域是否还有机会”， 隐藏着一个关键信息，即该领域是否还有互联网技术可以渗透和改造的机会', '1', '12', '<p class=\"text\">租房市场无外乎短租与长租两种常见形式，二者分别对应着两种不同的市场需求，不同需求也催生出两种不同的创业模式。从创业成本和运作模式上看，短租模式相对较轻，长租模式则相对较重。不过，模式上的悬殊并没有妨碍这两类创业项目同时获得资本市场的青睐。</p><p class=\"text\">尽管有资本推动，试图在国内复制Airbnb模式的短租市场创业者们仍然无一幸免地遭遇到了水土不服的尴尬，而在市场声\r\n量上长时间处于沉寂中的长租产品却表现出了十足的后劲儿。寓见公寓的创始人程远说创业应该“顺势而为”，这个“势”绝不是“造势”的“势”，而是“趋势”\r\n的“势”。</p><p class=\"text\"><strong>长租市场的机会始终摆在那里</strong></p><p class=\"text\">一个优秀的创业者多半也是一个目光敏锐的机会主义者，特别是在当前互联网技术向众多行业加速渗透的社会背景之下，能够从行业转型与升级中看到机会，便已经向成功靠近了一步。当然，这个意义上的“机会主义”并不包含任何贬义。</p><p class=\"text\">通常情况下，互联网创业者所说的“某个领域是否还有机会”，隐藏着一个关键信息，即该领域是否还有互联网技术可以渗透和\r\n改造的机会。互联网的本质是什么？有人说是“连接”，有人说是“打破信息不对称”，我认为都对但具体到某个行业上要具体分析。与寓见公寓的程远一样，我也\r\n认为长租市场有着很大机会，这是由长租市场的特征和痛点所决定的。</p><p class=\"text\">任何一个有过租房经历的人恐怕都会将租房的过程视为一种苦不堪言的体验，从寻找房源到现场看房，再到签订合同并正式入\r\n住，整个过程伴随着假房源、二房东、价格高等糟糕体验。与此同时，北上广深每年有超过8000万的租房人群，而这一庞大的市场需求对应的却是如此糟糕的租\r\n房体验。根本原因便在于整个长租市场的信息不透明和流程、服务、价格的非标准化。</p><p class=\"text\">解决流动人口的租房问题是社会职能部门要解决的问题，而优化租房体验则是长租行业和产品需要解决的问题。过去几年，北上\r\n广等城市都在管理群租房的问题上费尽周折，目的是为了减少安全隐患，但反过来流动人口的租房问题得不到解决又成了另一个隐患。所以，长租市场走向标准化顺\r\n应的既是租房者的需求趋势也是相关职能部门的管理趋势。这个趋势应该也是程远所谓“顺势而为”的含义。</p><p class=\"text\">不同于短租市场的短暂爆发，长租市场的问题是由来已久的，且机会也一直存在。行业里也不乏革新者，链家也曾尝试互联网模式推出自如品牌，但由于保准化不够彻底也遭到不少诟病。那么对于长租市场而言，究竟应该如何标准化？</p><p class=\"text\"><strong>该标准化的不只是装修和服务</strong></p><p class=\"text\">所谓标准化我认为首先应该是一套成熟固定的流程，不应受某些因素干扰而有所波动。对长租行业而言，应该标准化的不应该只是装修和服务，也应该涵盖定价、预约看房、签订合同、支付房租等所有环节在内的整套流程。</p><p class=\"text\">标准化的目的在于提升用户租房的效率，优化租房的体验，所以整个环节的公开透明很重要。传统租房之所以体验糟糕无外乎房\r\n屋环境描述不清或与实际环境不符，消耗租房者大量时间和精力。价格不透明且波动空间较大，需要租房者与对方进行商定，包括目前一些互联网租房产品，虽然给\r\n出了定价但实际看房时却发现要高出这个价格，这都是导致租房体验糟糕的因素。</p><p class=\"text\">一个好的长租产品，我认为不仅要为产品制定统一的标准，还要实现彻底的标准化。甚至具体到一些细节上，比如带领租房者看\r\n房的服务人员的言行是否规范，是否使用礼貌用语，这些细节都需要规范到位。如果用互联网的方式改造租房市场，就要用互联网产品的标准来要求租房产品，如果\r\n说装修和服务是对产品的标准化包装，那么完成整个体验闭环的各个环节的标准化则是一个成熟的互联网模式。</p><p class=\"text\">寓见公寓的模式相比传统租房，在定价、装修和服务上的确做到了标准化，但仍有一定优化空间。值得一提的是，寓见在与互联\r\n网的结合上要更为彻底，引入支付宝作为支付工具，并积极打造住宿生态系统，引入保洁、洗衣、外卖等O2O服务，这使得寓见的互联网色彩变得更加浓厚，但在\r\n我看来，长租市场的互联网化一定要处理好与互联网的关系，摆正互联网的位置。</p><p class=\"text\"><strong>关键还要摆正互联网的位置</strong></p><p class=\"text\">过去几年，传统住宿业在快速向互联网转型，而互联网创业者也在不断尝试用互联网的方式涉足这个行业。但有一个需要注意的\r\n现象是，此前已经形成品牌效应的酒店和公寓品牌互联网化的过程中并不存在太多难点，在很短时间内就实现了互联网或移动互联网预订、支付等环节，而新兴品牌\r\n却很艰难。这说明，品牌塑造的优先级应该大于互联网模式，而品牌的塑造有赖于更多因素的共同协作。</p><p class=\"text\">任何一个领域的创业者都应该认识到互联网只是用以改造优化某个行业的工具，而非万能解药。寓见公寓的创始人程远在回忆创\r\n业经历时说，“创业之前整体讨论商业模式，创业之后面对的人群从激情澎湃的创业者变成了淳朴憨厚的施工队长，去的最多的地方成了建材市场和工地。”当互联\r\n网创业者深入到某个传统行业中时，难免会感受到这种身份转变和落差，而在这个阶段互联网几乎发挥不出任何作用。</p><p class=\"text\">互联网思维和模式很重要，但更重要的是用所掌握的专业知识和能力用心做好一个品牌，最大限度发挥出品牌效应，而后再利用\r\n互联网工具进行优化升级，才是获得成功的关键。反过来说，如果空有互联网思维和模式，缺乏某领域的专业能力依然无法获得成功。互联网的能动性不可否认，但\r\n其本质是个工具，长租市场的标准化也应该摆正互联网的位置。</p><p><br/></p>', '1449197453', '1', 'gh_741263a45132', '', '韦小宝', '1', '0');
INSERT INTO `wx_paiqian_news` VALUES ('5', '  商品房过剩总库存21亿平方米 楼市进过剩时代', '  商品房过剩总库存21亿平方米 楼市进过剩时代', '3', '20', '<p><span style=\"color: rgb(34, 34, 34); font-family: Consolas, \'Lucida Console\', monospace; font-size: 12px; white-space: pre-wrap; background-color: rgb(255, 255, 255);\">　　报告称，2016年中国楼市内部条件与外部环境并不乐观，在此背景下，房价存在较大幅度下跌的波动运行可能性，但由于宏观政策进一步宽松，房地产市场不会硬着陆。</span></p>', '1451294194', '1', 'gh_be33dc482e19', '', '', '0', '0');
INSERT INTO `wx_paiqian_news` VALUES ('6', '快递包裹：中国邮政温柔的进击之举', '有鉴于此，所以说，即便一线城市已经没有市场，纵使不去收“份子钱”，基于现有的优势，再充分利用占据的各种资源，借助国家当下“互联网+农村”、“互联网+外贸”的政策大势，邮政打一场漂亮的翻身仗也不是没有可能。', '6', '15', '<p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">据1月12日《每日经济新闻》报道，日前中国邮政内部下发了一份《中国邮政包裹快递业务改革方案》（以下简称《方案》），将现行邮政公司和速递物流公司（EMS）分别经营的包裹快递业务产品进行了整合。并且，包裹快递业务产品管理权统一收归集团公司。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">进而言之，即将原EMS经济快递、国内小包和快递包裹整合为一个产品，新产品名为“快递包裹”。整合后，国内产品体系分为标准快递、快递包裹、普通包裹三种。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">所谓的“快递包裹”，大抵就是这么一回事。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-style: inherit; font-variant: inherit; font-weight: 800; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">进击的“快递包裹”，其实也是纠偏</span></p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">在电子商务物流迅猛发展的今天，寄递业务备受民营快递冲击的邮政，此次推出“快递包裹”，整合整个包裹快递业务，虽是进击之举，但其实也有纠偏之意。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">事情还得从EMS自身说起。作为邮政集团的子公司，EMS伊始时的市场定位是清晰的。比方说，以高质量为用户传递国际、国内紧急信函、文件资料、金融票据、商品货样等各类文件资料和物品。在集团内部不存在职能交叉的情况，甚至扮演着邮政市场化之路先行者的角色。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">然而，当快递物流市场、资本市场和监管等全方位发生激变的时候，EMS却显得跟不上发展的脚步。典型如EMS在2013年12月底突然主动撤回IPO申请，而直接原因就在于市场激烈竞争的倒逼。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">据悉，彼时“通达系”（一般指申通、中通、圆通、韵达）一级梯队已经占据了整个中国快递市场80%以上的份额，EMS或许连20%都不到；在2009年—2011年三年内，EMS的营收增长已连续低于行业平均水平。须知，1999年的时候，EMS的市场份额可是有90%以上。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">屋漏偏逢连夜雨。当EMS放下身段，在产品、服务、价格等方面改变策略，以低姿态抢夺客户的时候，不可避免的又与邮政的普邮业务发生冲突。比如邮政小包和EMS的易邮宝，就存在明显的竞争关系。而一旦各自的生产、销售、利润等任务一下来，难免就会出现内耗的问题。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">以上种种，显然也是邮政推出“快递包裹”的原因。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-style: inherit; font-variant: inherit; font-weight: 800; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">夹缝中的“快递包裹”，难以激起涟漪</span></p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">当然，与“快递包裹”配套，邮政也有另外的举措。正如新闻报道中所述，一方面，快递包裹将主要满足国内电商包裹快递市场需求，帮助EMS提升电商市场份额（快递包裹虽比普通包裹价格高，但相比顺丰、“通达系”等仍比较低）。另一方面，邮政航空刚刚购买了17架波音飞机，将持续提升EMS航空标准件的竞争力。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">如此一来，在价格上走中间路线，避免“通达系”的正面冲击，在运力上走空运快线，实现差异化竞争，由此超越“通达系”和快递新势力（德邦、远成等零担快运和京东、亚马逊、苏宁等自营快递）。但一切又果真会照此发展？</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">根据《中国快递行业发展报告2014》，在业务量、业务收入等方面，除了国际及港澳邮件领域，民营快递都占据8成以上，基本上甩以邮政为代表的国有快递好几条街。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">再说2015年，1年时间内，中国快递业务量从100亿件发展到200亿件，快递行业可谓形式一片大好。但邮政普遍服务业务却逐步萎缩。来自国家邮政局的数据显示，2015年1~4月，邮政函件业务累计完成16.7亿件，同比下降17.1%；包裹业务累计完成1905.8万件，同比下降5.9%；报纸业务累计完成62.2亿份，同比下降1.5%；杂志业务累计完成3.5亿份，同比下降4.5%；汇兑业务累计完成2910万笔，同比下降41%。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">竞争性业务领域的市场份额更是难堪，如今EMS大抵只有10%的样子。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">由此可见，在快递产业蓬勃兴起的时候，邮政不管是垄断的普遍服务业务，抑或竞争性业务，却都是全线失守。如今单靠一招“快递包裹”，显然无法挽回败局。因为问题已涉及到邮政那僵化且庞大的体制。要想华丽转身，唯有对制度、职能、架构等进行刮骨疗伤，方有胜算。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">更何况，“快递包裹”也有明显不足。走中间价格路线的快递包裹，把普通包裹的价格也顺便拉高两倍，势必会进一步影响到邮政普遍服务业务。另一方面，当前，民生快递的生态链越来越多地被电商巨头遥控，拥有订单和大数据的企业才是链主企业，但“快递包裹”只字未提——值得一提的是，2014年6月份，邮政与阿里的联姻曾轰轰烈烈，但吊诡的是，如今阿里的物流战车上捆绑最紧的有圆通、苏宁物流、韵达等等，却偏偏少了邮政。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><span style=\"margin: 0px; padding: 0px; font-style: inherit; font-variant: inherit; font-weight: 800; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; -webkit-font-smoothing: antialiased;\">手握好牌，邮政应该更激进</span></p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">说到底，“快递包裹”之举失之温柔。在全面深化改革的路上，在“规范经营决策、资产保值增值、公平参与竞争、提高企业效率、增强企业活力、承担社会责任”（交通部部长杨传堂语）等方面，手握好牌的邮政，应该更激进一些。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">作为国企，邮政的既有优势是显而易见的。比如，众所周知，农村市场是电商发展的下一个蓝海。阿里研究院预计，2016年全国农村网购市场预计将突破4600亿元。更有数据显示，未来农资市场容量有望超过1.5万亿元、农产品市场容量超过4万亿元。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">正是如此，京东、阿里等电商企业已纷纷开始发力农村市场。如此一来，唯一一张能够覆盖全国农村、校园、偏远极寒地的无盲区物流快递网络，拥有快递服务营业网点11.8万处，包括村邮站、三农服务站、社区服务店的中国邮政，无疑就有着先发优势。因为截至目前，顺丰、三通一达等快递网络基本上都只能到达县级城镇，从县级到村级物流的覆盖及建站，很大程度上还是一大空白。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">再如跨境电商包裹快递市场。与农村电商相似，首先是市场潜力极大。预测2020年全球跨境B2C电商交易额将达到9940亿美元，惠及9.43亿全球消费者。中国有望成为全球最大的跨境B2C消费市场，中国跨境进出口电商将带动全球跨境消费年均增速拉高近4%。其次，则是因为体制缘故，在万国邮联的通关方面，在成本方面，相比民营、外资快递，邮政具有极大的优势。比如，邮政在海关、航空等部门均享有优先处理权。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">有鉴于此，所以说，即便一线城市已经没有市场，纵使不去收“份子钱”，基于现有的优势，再充分利用占据的各种资源，借助国家当下“互联网+农村”、“互联网+外贸”的政策大势，邮政打一场漂亮的翻身仗也不是没有可能。</p><p class=\"text\" style=\"margin-top: 25px; margin-bottom: 25px; padding: 0px; font-stretch: inherit; font-size: 14px; line-height: 24px; font-family: arial, \'Hiragino Sans GB\', 微软雅黑, MicrosoftYaHei, 宋体, 宋体, Tahoma, Arial, Helvetica, STHeiti; vertical-align: baseline; -webkit-font-smoothing: antialiased; text-indent: 28px; color: rgb(51, 51, 51); letter-spacing: 0.5px; white-space: normal; background-color: rgb(255, 255, 255);\">一言以蔽之，改造传统实物传输网络，完善物流基础设施建设，提升整个物流服务水平，盘活现有资产，关键看邮政有没有突破体制藩篱的决心和毅力。</p><p><br/></p>', '1452836791', '5', 'gh_1784a6c712f0', '', '', '1', '0');

-- ----------------------------
-- Table structure for `wx_paiqian_slideshow`
-- ----------------------------
DROP TABLE IF EXISTS `wx_paiqian_slideshow`;
CREATE TABLE `wx_paiqian_slideshow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `img` int(10) unsigned NOT NULL COMMENT '图片',
  `url` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `is_show` tinyint(2) DEFAULT '1' COMMENT '是否显示',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of wx_paiqian_slideshow
-- ----------------------------
INSERT INTO `wx_paiqian_slideshow` VALUES ('1', '上线啦', '11', '###', '1', '0', 'gh_741263a45132');
INSERT INTO `wx_paiqian_slideshow` VALUES ('2', '', '10', '', '1', '0', 'gh_741263a45132');
INSERT INTO `wx_paiqian_slideshow` VALUES ('3', '', '9', '', '1', '0', 'gh_741263a45132');
INSERT INTO `wx_paiqian_slideshow` VALUES ('4', null, '22', '', '1', '0', 'gh_be33dc482e19');
INSERT INTO `wx_paiqian_slideshow` VALUES ('5', null, '41', '', '1', '0', 'gh_1784a6c712f0');
INSERT INTO `wx_paiqian_slideshow` VALUES ('6', null, '42', '', '1', '0', 'gh_1784a6c712f0');

-- ----------------------------
-- Table structure for `wx_payment_order`
-- ----------------------------
DROP TABLE IF EXISTS `wx_payment_order`;
CREATE TABLE `wx_payment_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `from` varchar(50) NOT NULL COMMENT '回调地址',
  `orderName` varchar(255) DEFAULT NULL COMMENT '订单名称',
  `single_orderid` varchar(100) NOT NULL COMMENT '订单号',
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `token` varchar(100) NOT NULL COMMENT 'Token',
  `wecha_id` varchar(200) NOT NULL COMMENT 'OpenID',
  `paytype` varchar(30) NOT NULL COMMENT '支付方式',
  `showwxpaytitle` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否显示标题',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '支付状态',
  `uid` int(10) DEFAULT NULL COMMENT '用户uid',
  `aim_id` int(10) DEFAULT NULL COMMENT 'aim_id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_payment_order
-- ----------------------------
INSERT INTO `wx_payment_order` VALUES ('1', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '123456', '1400.00', 'gh_741263a45132', '-1', 'Weixin', '1', '0', '1', null);
INSERT INTO `wx_payment_order` VALUES ('2', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20150902514555', '1400.00', 'gh_741263a45132', 'ow8pdtxGIWLZB7VgTNUeQMlQOyy4', 'Weixin', '1', '0', '6', null);
INSERT INTO `wx_payment_order` VALUES ('3', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20151215174858431', '20194.96', 'gh_741263a45132', '-1', 'Weixin', '1', '0', '-12806', null);
INSERT INTO `wx_payment_order` VALUES ('4', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20151217123407248', '13875.00', 'gh_be33dc482e19', 'oQT4ZvzqhB_PMdoUNTq24_qboIjw', 'Weixin', '1', '0', '-12868', null);
INSERT INTO `wx_payment_order` VALUES ('5', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20151229195943485', '24629.29', 'gh_be33dc482e19', '-1', 'Weixin', '1', '0', '-13325', null);
INSERT INTO `wx_payment_order` VALUES ('6', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20151230152701539', '46558.19', 'gh_be33dc482e19', '-1', 'Weixin', '1', '0', '1', null);
INSERT INTO `wx_payment_order` VALUES ('7', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '2015123111370138', '48829.85', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', 'Weixin', '1', '0', '51', null);
INSERT INTO `wx_payment_order` VALUES ('8', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20151231170857943', '12942.35', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', 'Weixin', '1', '0', '51', null);
INSERT INTO `wx_payment_order` VALUES ('9', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160106163414252023', '0.01', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', 'Weixin', '1', '1', '51', null);
INSERT INTO `wx_payment_order` VALUES ('10', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160106163252650564', '35917.50', 'gh_1784a6c712f0', '-1', 'Weixin', '1', '0', '1', null);
INSERT INTO `wx_payment_order` VALUES ('11', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '2016010616341425202123', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('12', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '2016010616341425202423', '0.01', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', 'Weixin', '1', '0', '51', null);
INSERT INTO `wx_payment_order` VALUES ('13', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160106163414252021237', '0.01', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', 'Weixin', '1', '0', '51', null);
INSERT INTO `wx_payment_order` VALUES ('14', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '201601061634142520212334', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('15', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '2016010616341425202123232', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('16', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '2016010616341425202123231', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('17', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '201601061634142520212321', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('18', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '201601061634142520212325', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('19', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '201601061634142520212329', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('20', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '201601061634142520212328', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('21', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '201601061634142520212327', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('22', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160106163123', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('23', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '201601061631231', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('24', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '2016010616312312', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('25', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160106163123121', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('26', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '2016010616312314', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('27', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '201601061631231412', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('28', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '2016010616312314121', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('29', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '2016123121231', '0.01', 'gh_1784a6c712f0', 'oOqnfskRBRfKmKg1kLScMBuUcBMI', 'Weixin', '1', '0', '55', null);
INSERT INTO `wx_payment_order` VALUES ('30', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160108090429445903', '30.00', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', 'Weixin', '1', '0', '51', null);
INSERT INTO `wx_payment_order` VALUES ('31', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160108101805525791', '0.01', 'gh_1784a6c712f0', 'oOqnfsvJ2FXc4mo1TgbH_LcVQP7g', 'Weixin', '1', '0', '57', null);
INSERT INTO `wx_payment_order` VALUES ('32', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160118100356905947', '4802.34', 'gh_1784a6c712f0', 'oOqnfsouJMTa-2QCDByQrkz4Gq-o', 'Weixin', '1', '0', '59', null);
INSERT INTO `wx_payment_order` VALUES ('33', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160118105426351701', '4802.34', 'gh_1784a6c712f0', 'oOqnfsk7jgHSBd6hGR254LogHbNg', 'Weixin', '1', '0', '58', null);
INSERT INTO `wx_payment_order` VALUES ('34', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160120145920143426', '7233.51', 'gh_1784a6c712f0', '-1', 'Weixin', '1', '0', '-26270', null);
INSERT INTO `wx_payment_order` VALUES ('35', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160120151231552273', '4053.73', 'gh_1784a6c712f0', '-1', 'Weixin', '1', '0', '-26281', null);
INSERT INTO `wx_payment_order` VALUES ('36', 'Paiqian:__Wap_payOk', '%E7%94%B3%E7%BC%B4%E6%94%AF%E4%BB%98', '20160121144129668432', '8935.68', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', 'Weixin', '1', '0', '51', null);

-- ----------------------------
-- Table structure for `wx_payment_set`
-- ----------------------------
DROP TABLE IF EXISTS `wx_payment_set`;
CREATE TABLE `wx_payment_set` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `wxmchid` varchar(255) DEFAULT NULL COMMENT '微信支付商户号',
  `shop_id` int(10) DEFAULT '0' COMMENT '商店ID',
  `quick_merid` varchar(255) DEFAULT NULL COMMENT '银联在线merid',
  `quick_merabbr` varchar(255) DEFAULT NULL COMMENT '商户名称',
  `wxpartnerid` varchar(255) DEFAULT NULL COMMENT '微信partnerid',
  `wxpartnerkey` varchar(255) DEFAULT NULL COMMENT '微信partnerkey',
  `partnerid` varchar(255) DEFAULT NULL COMMENT '财付通标识',
  `key` varchar(255) DEFAULT NULL COMMENT 'KEY',
  `ctime` int(10) DEFAULT NULL COMMENT '创建时间',
  `quick_security_key` varchar(255) DEFAULT NULL COMMENT '银联在线Key',
  `wappartnerkey` varchar(255) DEFAULT NULL COMMENT 'WAP财付通Key',
  `wappartnerid` varchar(255) DEFAULT NULL COMMENT '财付通标识WAP',
  `partnerkey` varchar(255) DEFAULT NULL COMMENT '财付通Key',
  `pid` varchar(255) DEFAULT NULL COMMENT 'PID',
  `zfbname` varchar(255) DEFAULT NULL COMMENT '帐号',
  `wxappsecret` varchar(255) DEFAULT NULL COMMENT 'AppSecret',
  `wxpaysignkey` varchar(255) DEFAULT NULL COMMENT '支付密钥',
  `wxappid` varchar(255) DEFAULT NULL COMMENT 'AppID',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `wx_cert_pem` int(10) unsigned DEFAULT NULL COMMENT '上传证书',
  `wx_key_pem` int(10) unsigned DEFAULT NULL COMMENT '上传密匙',
  `shop_pay_score` int(10) DEFAULT '0' COMMENT '支付返积分',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_payment_set
-- ----------------------------
INSERT INTO `wx_payment_set` VALUES ('1', '1267146001', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, '732738d9a04a9afef68d3b1e8f3eb233', '732738d9a04a9afef68d3b1e8f3eb233', 'wx2747ce56900a4ecc', 'gh_1784a6c712f0', '1', '2', '0');

-- ----------------------------
-- Table structure for `wx_picture`
-- ----------------------------
DROP TABLE IF EXISTS `wx_picture`;
CREATE TABLE `wx_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `status` (`id`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_picture
-- ----------------------------
INSERT INTO `wx_picture` VALUES ('1', '/Uploads/Picture/2015-12-01/565d3afa9e584.jpg', '', '5a855564dc44d78bf09ff29ce6ebbf6e', '9a7460b6f28f10371d497c8b48e714c60d1f1037', '1', '1448950522');
INSERT INTO `wx_picture` VALUES ('2', '/Uploads/Picture/2015-12-01/565d3b016b67b.jpg', '', 'fcae045f4c9ade863d1bc99b4bbde69d', '6cec2d51b837831c996f890a06eac0f224f2699d', '1', '1448950529');
INSERT INTO `wx_picture` VALUES ('3', '/Uploads/Picture/2015-12-03/56606150011ce.jpg', '', '37e08f4a98aa3156ea35d3f29bf60a8a', '654fc3050eb96a2b5aa2fe7808055d8143dd5c25', '1', '1449156943');
INSERT INTO `wx_picture` VALUES ('4', '/Uploads/Picture/2015-12-04/5660fe81153bf.jpg', '', '915c11b794fb79b139cd9875de558811', '62d1ebebaddf3c9658b0370bb9cccf0bebf71596', '1', '1449197184');
INSERT INTO `wx_picture` VALUES ('5', '/Uploads/Picture/2015-12-04/5660fe9370f98.jpg', '', 'd6f41027388324cd1b7056c10b2c91e4', 'cb2de85a61d72094522fb61e03fee76164402989', '1', '1449197203');
INSERT INTO `wx_picture` VALUES ('6', '/Uploads/Picture/2015-12-04/5660fed8b2208.jpg', '', 'f7568b6aa5206b52d7e192647b98d20b', 'ea1253a4f2465c0d9e7aa2084eee398fa00dddf2', '1', '1449197272');
INSERT INTO `wx_picture` VALUES ('7', '/Uploads/Picture/2015-12-04/5660ff23c1d1c.png', '', '78d4a07c7d5aa21228f98fa50e43d196', '29a05b4f8e8cca9c49160729b024cb9a0d21f770', '1', '1449197347');
INSERT INTO `wx_picture` VALUES ('8', '/Uploads/Picture/2015-12-04/5660ff7081e51.png', '', 'bb7e5810cebc49035f31c990e9ff5e52', 'dc9fbf4ad47341a676389766d092b3499dbb3c9a', '1', '1449197424');
INSERT INTO `wx_picture` VALUES ('9', '/Uploads/Picture/2015-12-08/56664db58902b.png', '', 'bb7e5810cebc49035f31c990e9ff5e52', 'dc9fbf4ad47341a676389766d092b3499dbb3c9a', '1', '1449545141');
INSERT INTO `wx_picture` VALUES ('10', '/Uploads/Picture/2015-12-08/56664dc8c737e.jpg', '', 'b4377d45ddb19c09b398b5daa0ff3f92', '604bf63b90edbb2c9316ad9910b5a5d9e05c7304', '1', '1449545160');
INSERT INTO `wx_picture` VALUES ('11', '/Uploads/Picture/2015-12-08/56664dd701f3b.jpg', '', 'e9795e2157855ae77fde87bb4c9a8de8', 'c5e3731a7d23ce3f5f2e5797d3018556d8dde41c', '1', '1449545174');
INSERT INTO `wx_picture` VALUES ('12', '/Uploads/Picture/2015-12-08/56664def3c34b.jpg', '', 'd6f41027388324cd1b7056c10b2c91e4', 'cb2de85a61d72094522fb61e03fee76164402989', '1', '1449545199');
INSERT INTO `wx_picture` VALUES ('13', '/Uploads/Picture/2015-12-08/56664e0b8daa9.png', '', '78d4a07c7d5aa21228f98fa50e43d196', '29a05b4f8e8cca9c49160729b024cb9a0d21f770', '1', '1449545227');
INSERT INTO `wx_picture` VALUES ('14', '/Uploads/Picture/2015-12-08/56664e23e80d3.jpg', '', '226834ceb03d3f66811194a71457841b', '1774c2e36620cf27b4bd0da1a07ebc425e6afa7e', '1', '1449545251');
INSERT INTO `wx_picture` VALUES ('15', '/Uploads/Picture/2015-12-13/566d247223b7a.jpg', '', '62ce90ae3867b1d5fb1163254ac8fdfc', '49162b5d9408e9e44813f9f5509f43351040be18', '1', '1449993329');
INSERT INTO `wx_picture` VALUES ('16', '/Uploads/Picture/2015-12-18/5673abe536dfd.jpg', '', '6fde461f04d4967ea00a315e43e9e7b2', 'aba8fcb3330c4b6ce3b8c36f0f407c0386acde5a', '1', '1450421220');
INSERT INTO `wx_picture` VALUES ('17', '/Uploads/Picture/2015-12-21/5677a12d5cb0a.jpg', '', '3ebb3f0f52f3f65085f1f272df9bf8e0', 'd3f8f044666f4d1a389c1c6cb2409d670eb5c309', '1', '1450680620');
INSERT INTO `wx_picture` VALUES ('18', '/Uploads/Picture/2015-12-21/5677a1348170a.jpg', '', '190761697de7add7965c14716342deb9', '30fc79d564c2b9e2fdf85e0370b204c7b7a24460', '1', '1450680627');
INSERT INTO `wx_picture` VALUES ('19', '/Uploads/Picture/2015-12-28/5680fceaa04f5.jpg', '', '17303e2b8c12c7a47de94e3a0f0838b7', '9f5669b3ee0190843a14ff3441d6182b624a22dc', '1', '1451293929');
INSERT INTO `wx_picture` VALUES ('20', '/Uploads/Picture/2015-12-28/5680fdcdb31b1.jpg', '', '4d50d2b1ccb7e3efeaccf02ceb070a8b', '8026954c1a2563194bcd15bdca223373a187daed', '1', '1451294157');
INSERT INTO `wx_picture` VALUES ('21', '/Uploads/Picture/2015-12-29/5681f17dcb141.png', '', 'bb7e5810cebc49035f31c990e9ff5e52', 'dc9fbf4ad47341a676389766d092b3499dbb3c9a', '1', '1451356541');
INSERT INTO `wx_picture` VALUES ('22', '/Uploads/Picture/2015-12-29/5681f1c9d1c65.png', '', 'bb7e5810cebc49035f31c990e9ff5e52', 'dc9fbf4ad47341a676389766d092b3499dbb3c9a', '1', '1451356617');
INSERT INTO `wx_picture` VALUES ('23', '/Uploads/Picture/2015-12-29/56824c594139f.jpg', '', 'e7dea61726c6c36ebdf2ec6f660c4482', 'ce3024a44d6bb9401a8c4f0eae804f0f62eaba7b', '1', '1451379800');
INSERT INTO `wx_picture` VALUES ('24', '/Uploads/Picture/2015-12-29/56824d1d92f34.jpg', '', '81215ca73d74bffb5f69c3f7f91b8975', '57a538ec32d5c9d29a77886a02b1aae2f97fefdf', '1', '1451379997');
INSERT INTO `wx_picture` VALUES ('25', '/Uploads/Picture/2015-12-29/56824d2c7ca0b.jpg', '', 'd90dbe3e2d6d20377936a045e8d8f9a4', 'ff60c558e121662e199a1d60559f8f34256d5831', '1', '1451380012');
INSERT INTO `wx_picture` VALUES ('26', '/Uploads/Picture/2015-12-29/56824faa20946.jpg', '', 'a0a4de5e9fbb3c9ed0b44a6ce94dbf73', '69b498293a4f4b69b57c4080f7d836f5856d8408', '1', '1451380649');
INSERT INTO `wx_picture` VALUES ('27', '/Uploads/Picture/2015-12-29/56825159e9515.jpg', '', '172be4fbf53a868ac1edbce10f6270b0', 'bbf0803564c7d3742f0141c0e765282f789d53e8', '1', '1451381081');
INSERT INTO `wx_picture` VALUES ('28', '/Uploads/Picture/2015-12-31/5684a04e21a27.jpg', '', '27232bb7849b9eabd7b6acb3b1c050bf', '3cc5a687c6c253004918f85273b6d4051ea9ea45', '1', '1451532365');
INSERT INTO `wx_picture` VALUES ('29', '/Uploads/Picture/2015-12-31/5684a057f0169.jpg', '', 'ad83e35f98fc4a2bb9c0e72cd67af45c', '4829d37b74293fec768e2fcf88934ad8bd1b65d5', '1', '1451532375');
INSERT INTO `wx_picture` VALUES ('30', '/Uploads/Picture/2016-01-06/568cd127d500e.jpg', '', '0092eaf737754c353e069d5c22df3a00', 'fd430fc170a5cb476bb57b664849b46b967b759d', '1', '1452069159');
INSERT INTO `wx_picture` VALUES ('31', '/Uploads/Picture/2016-01-06/568cd130deaf0.jpg', '', '35f5f9cf0ddd158ff5b2c9b3d221a844', 'bd476d1feaf3124e7cbc189990a16112e6ffcad0', '1', '1452069168');
INSERT INTO `wx_picture` VALUES ('32', '/Uploads/Picture/2016-01-08/568f1a587793a.jpg', '', 'b768b0d513330f1f6653463889e6d9b4', '136a5f35b3f05e6b5b31e940ca95d02247f2c209', '1', '1452218968');
INSERT INTO `wx_picture` VALUES ('33', '/Uploads/Picture/2016-01-08/568f1a5fa9dfb.jpg', '', 'ac3d92a37f9b8d37b1005f517227756a', '26b68b64d011139a353344095e7bcd9af5502ea7', '1', '1452218975');
INSERT INTO `wx_picture` VALUES ('34', '/Uploads/Picture/2016-01-08/568f1a6a4173a.jpg', '', 'a79fe0646495eae3717eaafb23456b6a', '70a894e6e13f4ac3985cd78138fdb7aa5103d957', '1', '1452218986');
INSERT INTO `wx_picture` VALUES ('35', '/Uploads/Picture/2016-01-08/568f1a6fd3b4d.jpg', '', '954e7541d55c18c3c5e305a9290f8002', '7d3d06bd765f6e327722ada6397f42bce46435d5', '1', '1452218991');
INSERT INTO `wx_picture` VALUES ('36', '/Uploads/Picture/2016-01-08/568f1a732d9e4.jpg', '', '29cdc5605da0897ffa034066714d420b', 'dbf7d169ba83d5eaba47ff61f17a5159b933fbae', '1', '1452218995');
INSERT INTO `wx_picture` VALUES ('37', '/Uploads/Picture/2016-01-08/568f1a781db6b.jpg', '', 'e1d0081fe723c22876630104ee8323dc', '00cf906e759fe246ad72ab6d6245cc34328bc13f', '1', '1452219000');
INSERT INTO `wx_picture` VALUES ('38', '/Uploads/Picture/2016-01-08/568f1a9226e91.jpg', '', '481154b2e4080055953c01a38cc49ca0', 'ab8cd1a323c3bca7f860c54d75f0afcef141f098', '1', '1452219026');
INSERT INTO `wx_picture` VALUES ('39', '/Uploads/Picture/2016-01-14/56975998ab1c0.jpg', '', '8480b468fbc785ea08c8f77cd5a36b49', 'eca9e47a154cadcb4e3dca15e284e87f054b9cb5', '1', '1452759448');
INSERT INTO `wx_picture` VALUES ('40', '/Uploads/Picture/2016-01-14/569759a6c8e02.jpg', '', '2d48b547c10cceb9b7e7bd54381aa299', 'f62ddcf3ae6a23ca6400e4f84352ef02a431e4fb', '1', '1452759462');
INSERT INTO `wx_picture` VALUES ('41', '/Uploads/Picture/2016-01-15/569886b25f774.png', '', '6243a6b7473eadfa3c0c91e9ccb082bb', 'fc71000e371f74bbe2c5a8521f740359a2b8f6da', '1', '1452836530');
INSERT INTO `wx_picture` VALUES ('42', '/Uploads/Picture/2016-01-15/569886d981e22.jpg', '', '9425310284bddfe395d11ed4c00ec6a2', '69ce57323368917365a946644bc31af9fcd669c9', '1', '1452836569');
INSERT INTO `wx_picture` VALUES ('43', '/Uploads/Picture/2016-01-18/569c4210ba654.jpg', '', '3e232a4bf9c9166a70f8fcc4e6c6837e', 'f1d5ef6d772838c1efc67e04c5c5b7b2eebad87e', '1', '1453081104');
INSERT INTO `wx_picture` VALUES ('44', '/Uploads/Picture/2016-01-19/569ddd30c5dee.jpg', '', '7b23636a6df27b9ea17ed557628c6f02', '3c34c54d6939b8017ad1409b9688186ea15669f6', '1', '1453186352');

-- ----------------------------
-- Table structure for `wx_plugin`
-- ----------------------------
DROP TABLE IF EXISTS `wx_plugin`;
CREATE TABLE `wx_plugin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  `cate_id` int(11) DEFAULT NULL,
  `is_show` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `sti` (`status`,`is_show`)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COMMENT='系统插件表';

-- ----------------------------
-- Records of wx_plugin
-- ----------------------------
INSERT INTO `wx_plugin` VALUES ('15', 'EditorForAdmin', '后台编辑器', '用于增强整站长文本的输入和显示', '1', '{\"editor_type\":\"2\",\"editor_wysiwyg\":\"2\",\"editor_height\":\"500px\",\"editor_resize_type\":\"1\"}', 'thinkphp', '0.1', '1383126253', '0', null, '1');
INSERT INTO `wx_plugin` VALUES ('2', 'SiteStat', '站点统计信息', '统计站点的基础信息', '0', '{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"width\":\"2\",\"display\":\"1\"}', 'thinkphp', '0.1', '1379512015', '0', null, '1');
INSERT INTO `wx_plugin` VALUES ('22', 'DevTeam', '开发团队信息', '开发团队成员信息', '0', '{\"title\":\"OneThink\\u5f00\\u53d1\\u56e2\\u961f\",\"width\":\"2\",\"display\":\"1\"}', 'thinkphp', '0.1', '1391687096', '0', null, '1');
INSERT INTO `wx_plugin` VALUES ('4', 'SystemInfo', '系统环境信息', '用于显示一些服务器的信息', '1', '{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"width\":\"2\",\"display\":\"1\"}', 'thinkphp', '0.1', '1379512036', '0', null, '1');
INSERT INTO `wx_plugin` VALUES ('5', 'Editor', '前台编辑器', '用于增强整站长文本的输入和显示', '1', '{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"300px\",\"editor_resize_type\":\"1\"}', 'thinkphp', '0.1', '1379830910', '0', null, '1');
INSERT INTO `wx_plugin` VALUES ('9', 'SocialComment', '通用社交化评论', '集成了各种社交化评论插件，轻松集成到系统中。', '1', '{\"comment_type\":\"1\",\"comment_uid_youyan\":\"1669260\",\"comment_short_name_duoshuo\":\"\",\"comment_form_pos_duoshuo\":\"buttom\",\"comment_data_list_duoshuo\":\"10\",\"comment_data_order_duoshuo\":\"asc\"}', 'thinkphp', '0.1', '1380273962', '0', null, '1');
INSERT INTO `wx_plugin` VALUES ('58', 'Cascade', '级联菜单', '支持无级级联菜单，用于地区选择、多层分类选择等场景。菜单的数据来源支持查询数据库和直接用户按格式输入两种方式', '1', 'null', '凡星', '0.1', '1398694996', '0', null, '1');
INSERT INTO `wx_plugin` VALUES ('120', 'DynamicSelect', '动态下拉菜单', '支持动态从数据库里取值显示', '1', 'null', '凡星', '0.1', '1435223177', '0', null, '1');
INSERT INTO `wx_plugin` VALUES ('125', 'News', '图文素材选择器', '', '1', 'null', '凡星', '0.1', '1439198046', '0', null, '1');

-- ----------------------------
-- Table structure for `wx_prize`
-- ----------------------------
DROP TABLE IF EXISTS `wx_prize`;
CREATE TABLE `wx_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `addon` varchar(255) DEFAULT 'Scratch' COMMENT '来源插件',
  `target_id` int(10) unsigned DEFAULT NULL COMMENT '来源ID',
  `title` varchar(255) DEFAULT NULL COMMENT '奖项标题',
  `name` varchar(255) DEFAULT NULL COMMENT '奖项',
  `num` int(10) unsigned DEFAULT NULL COMMENT '名额数量',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序号',
  `img` int(10) unsigned DEFAULT NULL COMMENT '奖品图片',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_prize
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_prize_address`
-- ----------------------------
DROP TABLE IF EXISTS `wx_prize_address`;
CREATE TABLE `wx_prize_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `address` varchar(255) DEFAULT NULL COMMENT '奖品收货地址',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机',
  `turename` varchar(255) DEFAULT NULL COMMENT '收货人姓名',
  `uid` int(10) DEFAULT NULL COMMENT '用户id',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `prizeid` int(10) DEFAULT NULL COMMENT '奖品编号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_prize_address
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_public`
-- ----------------------------
DROP TABLE IF EXISTS `wx_public`;
CREATE TABLE `wx_public` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) DEFAULT NULL COMMENT '用户ID',
  `public_name` varchar(50) DEFAULT NULL COMMENT '公众号名称',
  `public_id` varchar(100) DEFAULT NULL COMMENT '公众号原始id',
  `wechat` varchar(100) DEFAULT NULL COMMENT '微信号',
  `interface_url` varchar(255) DEFAULT NULL COMMENT '接口地址',
  `headface_url` varchar(255) DEFAULT NULL COMMENT '公众号头像',
  `area` varchar(50) DEFAULT NULL COMMENT '地区',
  `addon_config` text COMMENT '插件配置',
  `addon_status` text COMMENT '插件状态',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `is_use` tinyint(2) DEFAULT '0' COMMENT '是否为当前公众号',
  `type` char(10) DEFAULT '0' COMMENT '公众号类型',
  `appid` varchar(255) DEFAULT NULL COMMENT 'AppID',
  `secret` varchar(255) DEFAULT NULL COMMENT 'AppSecret',
  `group_id` int(10) unsigned DEFAULT '0' COMMENT '等级',
  `encodingaeskey` varchar(255) DEFAULT NULL COMMENT 'EncodingAESKey',
  `tips_url` varchar(255) DEFAULT NULL COMMENT '提示关注公众号的文章地址',
  `domain` varchar(30) DEFAULT NULL COMMENT '自定义域名',
  `is_bind` tinyint(2) DEFAULT '0' COMMENT '是否为微信开放平台绑定账号',
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_public
-- ----------------------------
INSERT INTO `wx_public` VALUES ('1', '1', '人事代理', 'gh_be33dc482e19', 'gh_be33dc482e19', null, null, null, '{\"Payment\":{\"isopen\":\"1\",\"isopenload\":\"1\",\"isopenwx\":\"1\",\"isopenshop\":\"0\",\"isopenzfb\":\"1\"}}', null, 'gh_be33dc482e19', '0', '3', 'wx00f249ca19e47f51', '8f8d3f7637be8e08414d3e0f82d8a498', '0', 'OrsNjoUGaL8ZnsXprXZ2yex5unLfFlbXeaX1EHpCH4V', null, null, '0');
INSERT INTO `wx_public` VALUES ('2', '1', '鑫锦程HR', 'gh_1784a6c712f0', 'cnhrmo', null, null, null, '{\"YouaskService\":{\"state\":\"1\",\"zrg\":\"\\u4eba\\u5de5\\u5ba2\\u670d\",\"model\":\"1\",\"tcrg\":\"\\u9000\\u51fa\\u4eba\\u5de5\\u5ba2\\u670d\"},\"Payment\":{\"isopen\":\"1\",\"isopenload\":\"1\",\"isopenwx\":\"1\",\"isopenshop\":\"0\",\"isopenzfb\":\"1\"}}', null, 'gh_1784a6c712f0', '0', '3', 'wx2747ce56900a4ecc', '732738d9a04a9afef68d3b1e8f3eb233', '0', 'kuupqI6vkA6omqEdPkffwgN5OAMcVXvBtHEqt39CjSN', null, null, '0');
INSERT INTO `wx_public` VALUES ('3', '1', '软件攻城狮', 'gh_09735745541e', 'gh_09735745541e', null, null, null, null, null, 'gh_09735745541e', '0', '0', 'wx4454c30580b9b32d', 'd4624c36b6795d1d99dcf0547af5443d', '0', '329e5bc0855ce7cd750bbe49efc070db', null, null, '0');
INSERT INTO `wx_public` VALUES ('4', '1', null, null, null, null, null, null, '{\"Payment\":{\"isopen\":\"1\",\"isopenload\":\"1\",\"isopenwx\":\"1\",\"isopenshop\":\"0\",\"isopenzfb\":\"1\"}}', null, 'gh_741263a45132', '0', '0', null, null, '0', null, null, null, '0');

-- ----------------------------
-- Table structure for `wx_public_auth`
-- ----------------------------
DROP TABLE IF EXISTS `wx_public_auth`;
CREATE TABLE `wx_public_auth` (
  `name` char(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type_0` tinyint(1) DEFAULT '0' COMMENT '普通订阅号的开关',
  `type_1` tinyint(1) DEFAULT '0' COMMENT '微信认证订阅号的开关',
  `type_2` tinyint(1) DEFAULT '0' COMMENT '普通服务号的开关',
  `type_3` tinyint(1) DEFAULT '0' COMMENT '微信认证服务号的开关',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_public_auth
-- ----------------------------
INSERT INTO `wx_public_auth` VALUES ('GET_ACCESS_TOKEN', '基础支持-获取access_token', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('GET_WECHAT_IP', '基础支持-获取微信服务器IP地址', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('GET_MSG', '接收消息-验证消息真实性、接收普通消息、接收事件推送、接收语音识别结果', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('SEND_REPLY_MSG', '发送消息-被动回复消息', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('SEND_CUSTOM_MSG', '发送消息-客服接口', '0', '1', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('SEND_GROUP_MSG', '发送消息-群发接口', '0', '1', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('SEND_NOTICE', '发送消息-模板消息接口（发送业务通知）', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('USER_GROUP', '用户管理-用户分组管理', '0', '1', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('USER_REMARK', '用户管理-设置用户备注名', '0', '1', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('USER_BASE_INFO', '用户管理-获取用户基本信息', '0', '1', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('USER_LIST', '用户管理-获取用户列表', '0', '1', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('USER_LOCATION', '用户管理-获取用户地理位置', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('USER_OAUTH', '用户管理-网页授权获取用户openid/用户基本信息', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('QRCODE', '推广支持-生成带参数二维码', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('LONG_URL', '推广支持-长链接转短链接口', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('MENU', '界面丰富-自定义菜单', '0', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('MATERIAL', '素材管理-素材管理接口', '0', '1', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('SEMANTIC', '智能接口-语义理解接口', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('CUSTOM_SERVICE', '多客服-获取多客服消息记录、客服管理', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('PAYMENT', '微信支付接口', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('SHOP', '微信小店接口', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('CARD', '微信卡券接口', '0', '1', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('DEVICE', '微信设备功能接口', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_BASE', '微信JS-SDK-基础接口', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_SHARE', '微信JS-SDK-分享接口', '0', '1', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_IMG', '微信JS-SDK-图像接口', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_AUDIO', '微信JS-SDK-音频接口', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_SEMANTIC', '微信JS-SDK-智能接口（网页语音识别）', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_DEVICE', '微信JS-SDK-设备信息', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_LOCATION', '微信JS-SDK-地理位置', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_MENU', '微信JS-SDK-界面操作', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_SCAN', '微信JS-SDK-微信扫一扫', '1', '1', '1', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_SHOP', '微信JS-SDK-微信小店', '0', '0', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_CARD', '微信JS-SDK-微信卡券', '0', '1', '0', '1');
INSERT INTO `wx_public_auth` VALUES ('JSSKD_PAYMENT', '微信JS-SDK-微信支付', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `wx_public_follow`
-- ----------------------------
DROP TABLE IF EXISTS `wx_public_follow`;
CREATE TABLE `wx_public_follow` (
  `openid` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `has_subscribe` tinyint(1) DEFAULT '0',
  `syc_status` tinyint(1) DEFAULT '2' COMMENT '0 开始同步中 1 更新用户信息中 2 完成同步',
  `remark` varchar(100) DEFAULT NULL,
  UNIQUE KEY `openid` (`openid`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_public_follow
-- ----------------------------
INSERT INTO `wx_public_follow` VALUES ('ow8pdt3eBTOUYyKXoDYFEkguB7vg', 'gh_741263a45132', '2', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('ow8pdt8SffRXhVIUn42k7Wolby10', 'gh_741263a45132', '3', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('ow8pdt1BoGbf6dhWkguNonNUKsGI', 'gh_741263a45132', '4', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('ow8pdt1EICrApXF1UqyunreMnPq0', 'gh_741263a45132', '5', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('ow8pdt8VnFfPPOrLAhVs-8-NyOTY', 'gh_741263a45132', '10', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('ow8pdtxGIWLZB7VgTNUeQMlQOyy4', 'gh_741263a45132', '9', '0', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv_XxbqJLHch5fVEmkdkWDPw', 'gh_be33dc482e19', '11', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4ZvytP349vk4PmU55-PmkMCC4', 'gh_be33dc482e19', '12', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv1kPK-egMlFVPfEHyT7Y5pQ', 'gh_be33dc482e19', '13', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4ZvzqhB_PMdoUNTq24_qboIjw', 'gh_be33dc482e19', '14', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv8hE-FcqPe6bgyy23mkk62E', 'gh_be33dc482e19', '15', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv4AHebqd2OhS6K5n-hDv1SA', 'gh_be33dc482e19', '16', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv45Ggkv6Hd9T8K3hinZVQyU', 'gh_be33dc482e19', '17', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv2_4aJDV18tkh1ddx91aDbM', 'gh_be33dc482e19', '18', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4ZvxJb7AWCe81D1rT4QQ5xXFE', 'gh_be33dc482e19', '19', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv1QmA7hNPNkXJkiU70y0w54', 'gh_be33dc482e19', '20', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv70MMnXBDc_uKEC3GTHCEss', 'gh_be33dc482e19', '21', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv3CLzIiKgSjjDcZLJDYWX2o', 'gh_be33dc482e19', '22', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv5gT9bwXKbZDo7apXrU0Fn0', 'gh_be33dc482e19', '23', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4ZvwyQqwG3BOMO_v6iRZkUbaU', 'gh_be33dc482e19', '24', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zvw2YQ9Y8c0RbKlMRWsCGL-I', 'gh_be33dc482e19', '25', '0', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zvy8LGm68Sm_vsFWVh7uYqC8', 'gh_be33dc482e19', '26', '0', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv7QT_cjAyF2B6nIl9_kyXTQ', 'gh_be33dc482e19', '27', '0', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsnMVEvRBN-VANZlkkLIvQ_c', 'gh_1784a6c712f0', '52', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsqPtTkKYcLx6jIh4-CPulHw', 'gh_1784a6c712f0', '29', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsu-PT7Uqu9xn5dlU70mb-p8', 'gh_1784a6c712f0', '30', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsvrmaWGHBAMxhPjy8N2dEd8', 'gh_1784a6c712f0', '31', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfskODLlY5VFGaBsyD2ynJRLA', 'gh_1784a6c712f0', '32', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfshGil3XBpp6JPXmXjq38bo8', 'gh_1784a6c712f0', '33', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsu0z-qPs0jNMaAVTKJrBCt0', 'gh_1784a6c712f0', '34', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsrvCaF1oPOD2y2suqFbTr5U', 'gh_1784a6c712f0', '35', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfshWd5wcrR3Wx7zevbTSCF6s', 'gh_1784a6c712f0', '36', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfslh81rYv-bPmESQ8qfePcxI', 'gh_1784a6c712f0', '37', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfstgY2lyShkPWjoYWRp-eQvQ', 'gh_1784a6c712f0', '38', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsqk8zlf3sbdGMYwSfUb66wk', 'gh_1784a6c712f0', '39', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsumsWHNZqz9qDPnlvlkz3Lo', 'gh_1784a6c712f0', '40', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsoXLfR0C6d3W-sGkXjXrYtE', 'gh_1784a6c712f0', '41', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfshxgbS13uSZ1z9K6OK7lp3w', 'gh_1784a6c712f0', '42', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsiCPr0dRZBu4kCydyDOkbhM', 'gh_1784a6c712f0', '43', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfslc93cpNPxBCnAzHaX2zIxI', 'gh_1784a6c712f0', '44', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfstsu6xpT1tzI63zg0qmq2GQ', 'gh_1784a6c712f0', '45', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfss2JZKvAnjBhdrD-pAbK99E', 'gh_1784a6c712f0', '46', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfssQPBjTV_UrJKn-ZEe6aLw8', 'gh_1784a6c712f0', '47', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfshlE85yp_QVkpM2D7HgzMYE', 'gh_1784a6c712f0', '48', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfslfFegs_2AltHLkKJzUEOQQ', 'gh_1784a6c712f0', '51', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv0wd8B8fgTrvdKfiOgnj-bA', 'gh_be33dc482e19', '53', '0', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsqHq62mgWNXjjffvzdpNVJA', 'gh_1784a6c712f0', '54', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfskRBRfKmKg1kLScMBuUcBMI', 'gh_1784a6c712f0', '55', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsndP_9AK7lFNvNdBomJCBaQ', 'gh_1784a6c712f0', '56', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsvJ2FXc4mo1TgbH_LcVQP7g', 'gh_1784a6c712f0', '57', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsk7jgHSBd6hGR254LogHbNg', 'gh_1784a6c712f0', '58', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsouJMTa-2QCDByQrkz4Gq-o', 'gh_1784a6c712f0', '59', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfslkNCfnurP1TYo9p-o0UQvQ', 'gh_1784a6c712f0', '60', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsvmztkG1dS-CrRO3kqjnP_I', 'gh_1784a6c712f0', '61', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv2j_QN8ev7zqwm9wkYoCDQM', 'gh_be33dc482e19', '62', '0', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv2rEJQEENOmnf_0Uwv0n58g', 'gh_be33dc482e19', '63', '0', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsh7kgfWNKvUXVh2gR7S03iU', 'gh_1784a6c712f0', '64', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zvyx3Pkr4kb8NQ0Nm2J29D7o', 'gh_be33dc482e19', '66', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4ZvwD41sG-H9_5CdPT_FRLjKs', 'gh_be33dc482e19', '67', '0', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv_D9z9gK4pT3-Io1j_tQ7Ds', 'gh_be33dc482e19', '68', '0', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv37A1SREjT83MqBHfMUOvB4', 'gh_be33dc482e19', '69', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsmlcWYK1kcjpVdBQEjTQD9w', 'gh_1784a6c712f0', '70', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfslWuN797-U456agliRgBxh8', 'gh_1784a6c712f0', '73', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsi_pBYQEPf_Dpgo-npc0bzw', 'gh_1784a6c712f0', '72', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsv6E_dUrc1EUlP0uCn0fc54', 'gh_1784a6c712f0', '74', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsi7ve6Q-vyCOl7_DWRp3Rcw', 'gh_1784a6c712f0', '75', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfslx8hllSt1Rcr8CSOMi4tbw', 'gh_1784a6c712f0', '76', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oQT4Zv6J93Us_VV9Gycqfvp_40QE', 'gh_be33dc482e19', '77', '1', '2', null);
INSERT INTO `wx_public_follow` VALUES ('oOqnfsgCugzVnO2tIFczMzy4mDt0', 'gh_1784a6c712f0', '78', '0', '2', null);

-- ----------------------------
-- Table structure for `wx_public_group`
-- ----------------------------
DROP TABLE IF EXISTS `wx_public_group`;
CREATE TABLE `wx_public_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(50) DEFAULT NULL COMMENT '等级名',
  `addon_status` text COMMENT '插件权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_public_group
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_public_link`
-- ----------------------------
DROP TABLE IF EXISTS `wx_public_link`;
CREATE TABLE `wx_public_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) DEFAULT NULL COMMENT '管理员UID',
  `mp_id` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `is_creator` tinyint(2) DEFAULT '0' COMMENT '是否为创建者',
  `addon_status` text COMMENT '插件权限',
  `is_use` tinyint(2) DEFAULT '0' COMMENT '是否为当前管理的公众号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `um` (`uid`,`mp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_public_link
-- ----------------------------
INSERT INTO `wx_public_link` VALUES ('1', '1', '1', '1', null, '0');
INSERT INTO `wx_public_link` VALUES ('2', '1', '2', '1', null, '0');
INSERT INTO `wx_public_link` VALUES ('3', '1', '3', '1', null, '0');

-- ----------------------------
-- Table structure for `wx_qr_code`
-- ----------------------------
DROP TABLE IF EXISTS `wx_qr_code`;
CREATE TABLE `wx_qr_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `qr_code` varchar(255) NOT NULL COMMENT '二维码',
  `addon` varchar(255) NOT NULL COMMENT '二维码所属插件',
  `aim_id` int(10) unsigned NOT NULL COMMENT '插件表里的ID值',
  `cTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `action_name` char(30) DEFAULT 'QR_SCENE' COMMENT '二维码类型',
  `extra_text` text COMMENT '文本扩展',
  `extra_int` int(10) DEFAULT NULL COMMENT '数字扩展',
  `request_count` int(10) DEFAULT '0' COMMENT '请求数',
  `scene_id` int(10) DEFAULT '0' COMMENT '场景ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_qr_code
-- ----------------------------
INSERT INTO `wx_qr_code` VALUES ('1', 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQGw8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xLzcwbkpHQ3psZFZnTWpUMm9TMlhfAAIEUv_eVgMEAAAAAA==', 'UserCenter', '4', '1453260626', 'gh_1784a6c712f0', 'QR_LIMIT_SCENE', '', '0', '0', '1');
INSERT INTO `wx_qr_code` VALUES ('2', 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQEp8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL29rbkRYaUxsWmxnZmlIRDNRV1hfAAIEUv_eVgMEAAAAAA==', 'UserCenter', '5', '1453260626', 'gh_1784a6c712f0', 'QR_LIMIT_SCENE', '', '0', '0', '2');
INSERT INTO `wx_qr_code` VALUES ('3', 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQEO8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL2hFbTdlaXZsTGxoWGcxYmpPV1hfAAIEUv_eVgMEAAAAAA==', 'UserCenter', '6', '1453260626', 'gh_1784a6c712f0', 'QR_LIMIT_SCENE', '', '0', '0', '3');

-- ----------------------------
-- Table structure for `wx_real_prize`
-- ----------------------------
DROP TABLE IF EXISTS `wx_real_prize`;
CREATE TABLE `wx_real_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `prize_name` varchar(255) DEFAULT NULL COMMENT '奖品名称',
  `prize_conditions` text COMMENT '活动说明',
  `prize_count` int(10) DEFAULT NULL COMMENT '奖品个数',
  `prize_image` varchar(255) DEFAULT '上传奖品图片' COMMENT '奖品图片',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `fail_content` text COMMENT '领取失败提示',
  `prize_type` tinyint(2) DEFAULT '1' COMMENT '奖品类型',
  `use_content` text COMMENT '使用说明',
  `prize_title` varchar(255) DEFAULT NULL COMMENT '活动标题',
  `template` varchar(255) DEFAULT 'default' COMMENT '素材模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_real_prize
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_reserve`
-- ----------------------------
DROP TABLE IF EXISTS `wx_reserve`;
CREATE TABLE `wx_reserve` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `password` varchar(255) DEFAULT NULL COMMENT '微预约密码',
  `jump_url` varchar(255) DEFAULT NULL COMMENT '提交后跳转的地址',
  `content` text COMMENT '详细介绍',
  `finish_tip` text COMMENT '用户提交后提示内容',
  `can_edit` tinyint(2) DEFAULT '0' COMMENT '是否允许编辑',
  `intro` text COMMENT '封面简介',
  `mTime` int(10) DEFAULT NULL COMMENT '修改时间',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '封面图片',
  `template` varchar(255) DEFAULT 'default' COMMENT '模板',
  `status` tinyint(2) DEFAULT '0' COMMENT '状态',
  `start_time` int(10) DEFAULT NULL COMMENT '报名开始时间',
  `end_time` int(10) DEFAULT NULL COMMENT '报名结束时间',
  `pay_online` tinyint(2) DEFAULT '0' COMMENT '是否支持在线支付',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_reserve
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_reserve_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `wx_reserve_attribute`;
CREATE TABLE `wx_reserve_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `is_show` tinyint(2) DEFAULT '1' COMMENT '是否显示',
  `reserve_id` int(10) unsigned DEFAULT NULL COMMENT '微预约ID',
  `error_info` varchar(255) DEFAULT NULL COMMENT '出错提示',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序号',
  `validate_rule` varchar(255) DEFAULT NULL COMMENT '正则验证',
  `is_must` tinyint(2) DEFAULT NULL COMMENT '是否必填',
  `remark` varchar(255) DEFAULT NULL COMMENT '字段备注',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `value` varchar(255) DEFAULT NULL COMMENT '默认值',
  `title` varchar(255) NOT NULL COMMENT '字段标题',
  `mTime` int(10) DEFAULT NULL COMMENT '修改时间',
  `extra` text COMMENT '参数',
  `type` char(50) NOT NULL DEFAULT 'string' COMMENT '字段类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_reserve_attribute
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_reserve_option`
-- ----------------------------
DROP TABLE IF EXISTS `wx_reserve_option`;
CREATE TABLE `wx_reserve_option` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `reserve_id` int(10) DEFAULT NULL COMMENT '预约活动ID',
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `money` decimal(11,2) DEFAULT '0.00' COMMENT '报名费用',
  `max_limit` int(10) DEFAULT '0' COMMENT '最大预约数',
  `init_count` int(10) DEFAULT '0' COMMENT '初始化预约数',
  `join_count` int(10) DEFAULT '0' COMMENT '参加人数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_reserve_option
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_reserve_value`
-- ----------------------------
DROP TABLE IF EXISTS `wx_reserve_value`;
CREATE TABLE `wx_reserve_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `is_check` int(10) DEFAULT '0' COMMENT '验证是否成功',
  `reserve_id` int(10) unsigned DEFAULT NULL COMMENT '微预约ID',
  `value` text COMMENT '微预约值',
  `cTime` int(10) DEFAULT NULL COMMENT '增加时间',
  `openid` varchar(255) DEFAULT NULL COMMENT 'OpenId',
  `uid` int(10) DEFAULT NULL COMMENT '用户ID',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `is_pay` int(10) DEFAULT '0' COMMENT '是否支付',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_reserve_value
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_scratch`
-- ----------------------------
DROP TABLE IF EXISTS `wx_scratch`;
CREATE TABLE `wx_scratch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `use_tips` varchar(255) NOT NULL COMMENT '使用说明',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `intro` text COMMENT '封面简介',
  `end_time` int(10) DEFAULT NULL COMMENT '结束时间',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '封面图片',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `start_time` int(10) DEFAULT NULL COMMENT '开始时间',
  `end_tips` text COMMENT '过期说明',
  `end_img` int(10) unsigned DEFAULT NULL COMMENT '过期提示图片',
  `predict_num` int(10) unsigned NOT NULL COMMENT '预计参与人数',
  `max_num` int(10) unsigned DEFAULT '1' COMMENT '每人最多允许抽奖次数',
  `follower_condtion` char(50) DEFAULT '1' COMMENT '粉丝状态',
  `credit_conditon` int(10) unsigned DEFAULT '0' COMMENT '积分限制',
  `credit_bug` int(10) unsigned DEFAULT '0' COMMENT '积分消费',
  `addon_condition` varchar(255) DEFAULT NULL COMMENT '插件场景限制',
  `collect_count` int(10) unsigned DEFAULT '0' COMMENT '已领取人数',
  `view_count` int(10) unsigned DEFAULT '0' COMMENT '浏览人数',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `template` varchar(255) DEFAULT 'default' COMMENT '素材模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_scratch
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_smalltools`
-- ----------------------------
DROP TABLE IF EXISTS `wx_smalltools`;
CREATE TABLE `wx_smalltools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `tooltype` tinyint(2) DEFAULT '0' COMMENT '工具类型',
  `keyword` varchar(255) DEFAULT NULL COMMENT ' 关键词 ',
  `cTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `toolname` varchar(255) DEFAULT NULL COMMENT '工具名称',
  `tooldes` text COMMENT '工具描述',
  `toolnum` varchar(255) DEFAULT NULL COMMENT '工具唯一编号',
  `toolstate` tinyint(2) DEFAULT '0' COMMENT '工具状态',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_smalltools
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_sms`
-- ----------------------------
DROP TABLE IF EXISTS `wx_sms`;
CREATE TABLE `wx_sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `from_type` varchar(255) DEFAULT NULL COMMENT '用途',
  `code` varchar(255) DEFAULT NULL COMMENT '验证码',
  `smsId` varchar(255) DEFAULT NULL COMMENT '短信唯一标识',
  `phone` varchar(255) DEFAULT NULL COMMENT '手机号',
  `cTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `status` int(10) DEFAULT NULL COMMENT '使用状态',
  `plat_type` int(10) DEFAULT NULL COMMENT '平台标识',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_sms
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_sn_code`
-- ----------------------------
DROP TABLE IF EXISTS `wx_sn_code`;
CREATE TABLE `wx_sn_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sn` varchar(255) DEFAULT NULL COMMENT 'SN码',
  `uid` int(10) DEFAULT NULL COMMENT '粉丝UID',
  `cTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `is_use` tinyint(2) DEFAULT '0' COMMENT '是否已使用',
  `use_time` int(10) DEFAULT NULL COMMENT '使用时间',
  `addon` varchar(255) DEFAULT 'Coupon' COMMENT '来自的插件',
  `target_id` int(10) unsigned DEFAULT NULL COMMENT '来源ID',
  `prize_id` int(10) unsigned DEFAULT NULL COMMENT '奖项ID',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否可用',
  `prize_title` varchar(255) DEFAULT NULL COMMENT '奖项',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `can_use` tinyint(2) DEFAULT '1' COMMENT '是否可用',
  `server_addr` varchar(50) DEFAULT NULL COMMENT '服务器IP',
  `admin_uid` int(10) DEFAULT NULL COMMENT '核销管理员ID',
  PRIMARY KEY (`id`),
  KEY `id` (`uid`,`target_id`,`addon`),
  KEY `addon` (`target_id`,`addon`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_sn_code
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_sport_award`
-- ----------------------------
DROP TABLE IF EXISTS `wx_sport_award`;
CREATE TABLE `wx_sport_award` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `img` int(10) NOT NULL COMMENT '奖品图片',
  `name` varchar(255) NOT NULL COMMENT '奖项名称',
  `score` int(10) DEFAULT '0' COMMENT '积分数',
  `award_type` varchar(30) DEFAULT '1' COMMENT '奖品类型',
  `price` float DEFAULT '0' COMMENT '商品价格',
  `explain` text COMMENT '奖品说明',
  `count` int(10) NOT NULL COMMENT '奖品数量',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序号',
  `uid` int(10) DEFAULT NULL COMMENT 'uid',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `coupon_id` char(50) DEFAULT NULL COMMENT '选择赠送券',
  `money` float DEFAULT NULL COMMENT '返现金额',
  `aim_table` varchar(255) DEFAULT NULL COMMENT '活动标识',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_sport_award
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_sports`
-- ----------------------------
DROP TABLE IF EXISTS `wx_sports`;
CREATE TABLE `wx_sports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `score` varchar(30) DEFAULT NULL COMMENT '比分',
  `content` text COMMENT '说明',
  `start_time` int(10) DEFAULT NULL COMMENT '时间',
  `visit_team` varchar(255) DEFAULT NULL COMMENT '客场球队',
  `home_team` varchar(255) DEFAULT NULL COMMENT '主场球队',
  `countdown` int(10) DEFAULT '60' COMMENT '擂鼓时长',
  `drum_count` int(10) DEFAULT '0' COMMENT '擂鼓次数',
  `drum_follow_count` int(10) DEFAULT '0' COMMENT '擂鼓人数',
  `home_team_support_count` int(10) DEFAULT '0' COMMENT '主场球队支持数',
  `visit_team_support_count` int(10) DEFAULT '0' COMMENT '客场球队支持人数',
  `home_team_drum_count` int(10) DEFAULT '0' COMMENT '主场球队擂鼓数',
  `visit_team_drum_count` int(10) DEFAULT '0' COMMENT '客场球队擂鼓数',
  `yaotv_count` int(10) DEFAULT '0' COMMENT '摇一摇总次',
  `draw_count` int(10) DEFAULT '0' COMMENT '抽奖总次数',
  `is_finish` tinyint(2) DEFAULT '0' COMMENT '是否已结束',
  `yaotv_follow_count` int(10) DEFAULT '0' COMMENT '摇电视总人数',
  `draw_follow_count` int(10) DEFAULT '0' COMMENT '抽奖总人数',
  `comment_status` tinyint(2) DEFAULT '0' COMMENT '评论是否需要审核',
  PRIMARY KEY (`id`),
  KEY `start_time` (`start_time`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_sports
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_sports_drum`
-- ----------------------------
DROP TABLE IF EXISTS `wx_sports_drum`;
CREATE TABLE `wx_sports_drum` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sports_id` int(10) DEFAULT NULL COMMENT '场次ID',
  `team_id` int(10) DEFAULT NULL COMMENT '球队ID',
  `follow_id` int(10) DEFAULT NULL COMMENT '用户ID',
  `drum_count` int(10) DEFAULT NULL COMMENT '擂鼓次数',
  `cTime` int(10) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `ctime` (`sports_id`,`cTime`),
  KEY `team_id` (`sports_id`,`team_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_sports_drum
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_sports_support`
-- ----------------------------
DROP TABLE IF EXISTS `wx_sports_support`;
CREATE TABLE `wx_sports_support` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sports_id` int(10) DEFAULT NULL COMMENT '场次ID',
  `team_id` int(10) DEFAULT NULL COMMENT '球队ID',
  `follow_id` int(10) DEFAULT NULL COMMENT '用户ID',
  `cTime` int(10) DEFAULT NULL COMMENT '支持时间',
  PRIMARY KEY (`id`),
  KEY `sf` (`sports_id`,`follow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_sports_support
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_sports_team`
-- ----------------------------
DROP TABLE IF EXISTS `wx_sports_team`;
CREATE TABLE `wx_sports_team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sort` int(10) DEFAULT '0' COMMENT '排序号',
  `intro` text COMMENT '球队说明',
  `pid` int(10) DEFAULT '0' COMMENT 'pid',
  `logo` int(10) unsigned DEFAULT NULL COMMENT '球队图标',
  `title` varchar(100) DEFAULT NULL COMMENT '球队名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_sports_team
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_store`
-- ----------------------------
DROP TABLE IF EXISTS `wx_store`;
CREATE TABLE `wx_store` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `uid` int(10) DEFAULT '0' COMMENT '用户ID',
  `content` text COMMENT '内容',
  `cTime` int(10) DEFAULT NULL COMMENT '发布时间',
  `attach` varchar(255) DEFAULT NULL COMMENT '插件安装包',
  `is_top` int(10) DEFAULT '0' COMMENT '置顶',
  `cid` tinyint(4) DEFAULT NULL COMMENT '分类',
  `view_count` int(11) unsigned DEFAULT '0' COMMENT '浏览数',
  `img_1` int(10) unsigned DEFAULT NULL COMMENT '插件截图1',
  `img_2` int(10) unsigned DEFAULT NULL COMMENT '插件截图2',
  `img_3` int(10) unsigned DEFAULT NULL COMMENT '插件截图3',
  `img_4` int(10) unsigned DEFAULT NULL COMMENT '插件截图4',
  `download_count` int(10) unsigned DEFAULT '0' COMMENT '下载数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_store
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_sucai`
-- ----------------------------
DROP TABLE IF EXISTS `wx_sucai`;
CREATE TABLE `wx_sucai` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) DEFAULT NULL COMMENT '素材名称',
  `status` char(10) DEFAULT 'UnSubmit' COMMENT '状态',
  `cTime` int(10) DEFAULT NULL COMMENT '提交时间',
  `url` varchar(255) DEFAULT NULL COMMENT '实际摇一摇所使用的页面URL',
  `type` varchar(255) DEFAULT NULL COMMENT '素材类型',
  `detail` text COMMENT '素材内容',
  `reason` text COMMENT '入库失败的原因',
  `create_time` int(10) DEFAULT NULL COMMENT '申请时间',
  `checked_time` int(10) DEFAULT NULL COMMENT '入库时间',
  `source` varchar(50) DEFAULT NULL COMMENT '来源',
  `source_id` int(10) DEFAULT NULL COMMENT '来源ID',
  `wechat_id` int(10) DEFAULT NULL COMMENT '微信端的素材ID',
  `uid` int(10) DEFAULT NULL COMMENT 'uid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_sucai
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_sucai_template`
-- ----------------------------
DROP TABLE IF EXISTS `wx_sucai_template`;
CREATE TABLE `wx_sucai_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) DEFAULT NULL COMMENT '管理员id',
  `token` varchar(255) DEFAULT NULL COMMENT '用户token',
  `addons` varchar(255) DEFAULT NULL COMMENT '插件名称',
  `template` varchar(255) DEFAULT NULL COMMENT '模版名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_sucai_template
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_survey`
-- ----------------------------
DROP TABLE IF EXISTS `wx_survey`;
CREATE TABLE `wx_survey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `keyword_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '关键词类型',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `intro` text COMMENT '封面简介',
  `mTime` int(10) DEFAULT NULL COMMENT '修改时间',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '封面图片',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `finish_tip` text COMMENT '结束语',
  `template` varchar(255) DEFAULT 'default' COMMENT '素材模板',
  `start_time` int(10) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(10) DEFAULT NULL COMMENT '结束时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_survey
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_survey_answer`
-- ----------------------------
DROP TABLE IF EXISTS `wx_survey_answer`;
CREATE TABLE `wx_survey_answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `answer` text COMMENT '回答内容',
  `openid` varchar(255) DEFAULT NULL COMMENT 'OpenId',
  `uid` int(10) DEFAULT NULL COMMENT '用户UID',
  `question_id` int(10) unsigned NOT NULL COMMENT 'question_id',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `survey_id` int(10) unsigned NOT NULL COMMENT 'survey_id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_survey_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_survey_question`
-- ----------------------------
DROP TABLE IF EXISTS `wx_survey_question`;
CREATE TABLE `wx_survey_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `intro` text COMMENT '问题描述',
  `cTime` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `is_must` tinyint(2) DEFAULT '0' COMMENT '是否必填',
  `extra` text COMMENT '参数',
  `type` char(50) NOT NULL DEFAULT 'radio' COMMENT '问题类型',
  `survey_id` int(10) unsigned NOT NULL COMMENT 'survey_id',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_survey_question
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_system_notice`
-- ----------------------------
DROP TABLE IF EXISTS `wx_system_notice`;
CREATE TABLE `wx_system_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) DEFAULT NULL COMMENT '公告标题',
  `content` text COMMENT '公告内容',
  `create_time` int(10) DEFAULT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_system_notice
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_template_msg`
-- ----------------------------
DROP TABLE IF EXISTS `wx_template_msg`;
CREATE TABLE `wx_template_msg` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `is_send` tinyint(4) NOT NULL DEFAULT '0',
  `param` text NOT NULL,
  `templateID` varchar(255) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `sendTime` datetime NOT NULL,
  `msg` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_template_msg
-- ----------------------------
INSERT INTO `wx_template_msg` VALUES ('19', '51', '1', 'a:1:{s:4:\"data\";a:5:{s:5:\"first\";a:2:{s:5:\"value\";s:21:\"投保订单已生成\";s:5:\"color\";s:7:\"#173177\";}s:8:\"keyword1\";a:2:{s:5:\"value\";s:19:\"2015-12-30 20:43:00\";s:5:\"color\";s:7:\"#173177\";}s:8:\"keyword2\";a:2:{s:5:\"value\";s:12:\"缴交社保\";s:5:\"color\";s:7:\"#173177\";}s:8:\"keyword3\";a:2:{s:5:\"value\";s:17:\"20151230204300665\";s:5:\"color\";s:7:\"#E60B43\";}s:6:\"remark\";a:2:{s:5:\"value\";s:58:\"恭喜您下单成功,请在订单有效期内完成支付\";s:5:\"color\";s:7:\"#173177\";}}}', '', 'http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Wap/choosePayType/orderID/20151230204300665.html', '2015-12-30 20:56:01', '发送成功');
INSERT INTO `wx_template_msg` VALUES ('20', '51', '1', 'a:1:{s:4:\"data\";a:5:{s:5:\"first\";a:2:{s:5:\"value\";s:21:\"投保订单已生成\";s:5:\"color\";s:7:\"#173177\";}s:8:\"keyword1\";a:2:{s:5:\"value\";s:19:\"2015-12-30 20:43:56\";s:5:\"color\";s:7:\"#173177\";}s:8:\"keyword2\";a:2:{s:5:\"value\";s:12:\"缴交社保\";s:5:\"color\";s:7:\"#173177\";}s:8:\"keyword3\";a:2:{s:5:\"value\";s:17:\"20151230204356127\";s:5:\"color\";s:7:\"#E60B43\";}s:6:\"remark\";a:2:{s:5:\"value\";s:58:\"恭喜您下单成功,请在订单有效期内完成支付\";s:5:\"color\";s:7:\"#173177\";}}}', '1dDOEWdLvKbxmVRBKhLr7Iq1kfxpuOn-M3R6OUDfaR8', 'http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Wap/choosePayType/orderID/20151230204356127.html', '2015-12-30 20:56:01', '发送成功');
INSERT INTO `wx_template_msg` VALUES ('21', '51', '1', 'a:1:{s:4:\"data\";a:5:{s:5:\"first\";a:2:{s:5:\"value\";s:21:\"投保订单已生成\";s:5:\"color\";s:7:\"#173177\";}s:8:\"keyword1\";a:2:{s:5:\"value\";s:19:\"2015-12-30 20:43:57\";s:5:\"color\";s:7:\"#173177\";}s:8:\"keyword2\";a:2:{s:5:\"value\";s:12:\"缴交社保\";s:5:\"color\";s:7:\"#173177\";}s:8:\"keyword3\";a:2:{s:5:\"value\";s:17:\"20151230204357631\";s:5:\"color\";s:7:\"#E60B43\";}s:6:\"remark\";a:2:{s:5:\"value\";s:58:\"恭喜您下单成功,请在订单有效期内完成支付\";s:5:\"color\";s:7:\"#173177\";}}}', '1dDOEWdLvKbxmVRBKhLr7Iq1kfxpuOn-M3R6OUDfaR8', 'http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Wap/choosePayType/orderID/20151230204357631.html', '2015-12-30 20:56:01', '发送成功');

-- ----------------------------
-- Table structure for `wx_test`
-- ----------------------------
DROP TABLE IF EXISTS `wx_test`;
CREATE TABLE `wx_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `keyword_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '关键词匹配类型',
  `title` varchar(255) NOT NULL COMMENT '问卷标题',
  `intro` text NOT NULL COMMENT '封面简介',
  `mTime` int(10) NOT NULL COMMENT '修改时间',
  `cover` int(10) unsigned NOT NULL COMMENT '封面图片',
  `token` varchar(255) NOT NULL COMMENT 'Token',
  `finish_tip` text NOT NULL COMMENT '评论语',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_test
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_test_answer`
-- ----------------------------
DROP TABLE IF EXISTS `wx_test_answer`;
CREATE TABLE `wx_test_answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `answer` text NOT NULL COMMENT '回答内容',
  `openid` varchar(255) NOT NULL COMMENT 'OpenId',
  `uid` int(10) NOT NULL COMMENT '用户UID',
  `question_id` int(10) unsigned NOT NULL COMMENT 'question_id',
  `cTime` int(10) unsigned NOT NULL COMMENT '发布时间',
  `token` varchar(255) NOT NULL COMMENT 'Token',
  `test_id` int(10) unsigned NOT NULL COMMENT 'test_id',
  `score` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '得分',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_test_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_test_cms`
-- ----------------------------
DROP TABLE IF EXISTS `wx_test_cms`;
CREATE TABLE `wx_test_cms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `uid` int(10) DEFAULT NULL COMMENT 'UID',
  `img` int(10) unsigned DEFAULT NULL COMMENT '图片',
  `content` text COMMENT '内容',
  `cate_id` varchar(255) DEFAULT NULL COMMENT '分类',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of wx_test_cms
-- ----------------------------
INSERT INTO `wx_test_cms` VALUES ('1', '333这是标题内容', '1', '15', '<p>erwpreupwerw22222222</p>', null);

-- ----------------------------
-- Table structure for `wx_test_question`
-- ----------------------------
DROP TABLE IF EXISTS `wx_test_question`;
CREATE TABLE `wx_test_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '题目标题',
  `intro` text NOT NULL COMMENT '题目描述',
  `cTime` int(10) unsigned NOT NULL COMMENT '发布时间',
  `token` varchar(255) NOT NULL COMMENT 'Token',
  `is_must` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否必填',
  `extra` text NOT NULL COMMENT '参数',
  `type` char(50) NOT NULL DEFAULT 'radio' COMMENT '题目类型',
  `test_id` int(10) unsigned NOT NULL COMMENT 'test_id',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_test_question
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_tongji`
-- ----------------------------
DROP TABLE IF EXISTS `wx_tongji`;
CREATE TABLE `wx_tongji` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `token` varchar(255) NOT NULL COMMENT 'Token',
  `month` int(10) NOT NULL COMMENT '月份',
  `day` int(10) NOT NULL COMMENT '日期',
  `content` text NOT NULL COMMENT '统计数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_tongji
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_update_score_log`
-- ----------------------------
DROP TABLE IF EXISTS `wx_update_score_log`;
CREATE TABLE `wx_update_score_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `score` int(10) DEFAULT NULL COMMENT '修改积分',
  `branch_id` int(10) DEFAULT NULL COMMENT '修改门店',
  `operator` varchar(255) DEFAULT NULL COMMENT '操作员',
  `cTime` int(10) DEFAULT NULL COMMENT '修改时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `member_id` int(10) DEFAULT NULL COMMENT '会员卡id',
  `manager_id` int(10) DEFAULT NULL COMMENT '管理员id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_update_score_log
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_update_version`
-- ----------------------------
DROP TABLE IF EXISTS `wx_update_version`;
CREATE TABLE `wx_update_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `version` int(10) unsigned NOT NULL COMMENT '版本号',
  `title` varchar(50) NOT NULL COMMENT '升级包名',
  `description` text COMMENT '描述',
  `create_date` int(10) DEFAULT NULL COMMENT '创建时间',
  `download_count` int(10) unsigned DEFAULT '0' COMMENT '下载统计',
  `package` varchar(255) NOT NULL COMMENT '升级包地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_update_version
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_user`
-- ----------------------------
DROP TABLE IF EXISTS `wx_user`;
CREATE TABLE `wx_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` text COMMENT '用户名',
  `password` varchar(100) DEFAULT NULL COMMENT '登录密码',
  `truename` varchar(30) DEFAULT NULL COMMENT '真实姓名',
  `mobile` varchar(30) DEFAULT NULL COMMENT '联系电话',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱地址',
  `sex` tinyint(2) DEFAULT NULL COMMENT '性别',
  `headimgurl` varchar(255) DEFAULT NULL COMMENT '头像地址',
  `city` varchar(30) DEFAULT NULL COMMENT '城市',
  `province` varchar(30) DEFAULT NULL COMMENT '省份',
  `country` varchar(30) DEFAULT NULL COMMENT '国家',
  `language` varchar(20) DEFAULT 'zh-cn' COMMENT '语言',
  `score` int(10) DEFAULT '0' COMMENT '金币值',
  `experience` int(10) DEFAULT '0' COMMENT '经验值',
  `unionid` varchar(50) DEFAULT NULL COMMENT '微信第三方ID',
  `login_count` int(10) DEFAULT '0' COMMENT '登录次数',
  `reg_ip` varchar(30) DEFAULT NULL COMMENT '注册IP',
  `reg_time` int(10) DEFAULT NULL COMMENT '注册时间',
  `last_login_ip` varchar(30) DEFAULT NULL COMMENT '最近登录IP',
  `last_login_time` int(10) DEFAULT NULL COMMENT '最近登录时间',
  `status` tinyint(2) DEFAULT '1' COMMENT '状态',
  `is_init` tinyint(2) DEFAULT '0' COMMENT '初始化状态',
  `is_audit` tinyint(2) DEFAULT '0' COMMENT '审核状态',
  `subscribe_time` int(10) DEFAULT NULL COMMENT '用户关注公众号时间',
  `remark` varchar(100) DEFAULT NULL COMMENT '微信用户备注',
  `groupid` int(10) DEFAULT NULL COMMENT '微信端的分组ID',
  `come_from` tinyint(1) DEFAULT '0' COMMENT '来源',
  `login_name` varchar(100) DEFAULT NULL COMMENT 'login_name',
  `login_password` varchar(255) DEFAULT NULL COMMENT '登录密码',
  `manager_id` int(10) DEFAULT '0' COMMENT '公众号管理员ID',
  `level` tinyint(2) DEFAULT '0' COMMENT '管理等级',
  `membership` char(50) DEFAULT '0' COMMENT '会员等级',
  `invite_code` varchar(50) DEFAULT NULL COMMENT '邀请码',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_user
-- ----------------------------
INSERT INTO `wx_user` VALUES ('1', 'admin', '5fa63d9b2142cdb670ee11a7ec4a3031', null, '13510455105', 'admin@admin.cn', null, null, null, null, null, 'zh-cn', '0', '0', null, '125', '0', '1448942760', '1903438274', '1455784147', '1', '1', '1', null, null, null, '0', 'admin', null, '0', '0', '0', '56c2757875a84');
INSERT INTO `wx_user` VALUES ('2', '\"jacy\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/qMOcdVicCuic51ZFHCGicAmDBbxWAmk1ibz3Z0gkMOj6gKpG51tatLQlFZKB1bCicY6T0nNMIPpYrOJpM5BYSjYmR1CxNIh81vInib/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', null, '0', null, '1438170107', null, null, '1', '1', '1', '1438170107', '', '0', '0', null, null, '0', '0', '0', '56c2757875ce5');
INSERT INTO `wx_user` VALUES ('3', '\"\\u5c0f\\u5229\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLC30gZgpU1BVPuuCCKFCP5EpTibGloTzRLD5bViaCgaibcpWhEcOQicXxHF67JH2CcqibHKuOcRero9mWw/0', '', 'Hebei', 'China', 'zh_CN', '100', '100', null, '0', null, '1438158998', null, null, '1', '1', '1', '1438158998', '', '0', '0', null, null, '0', '0', '0', '56c2757875eb3');
INSERT INTO `wx_user` VALUES ('4', '\"man_ x\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/9B3ZOw9JdEpicRRA1I3hb6wW02DEfjqaqnXsQRadsf8M6CriaZ4vEe0wAJCuazQkdcvkR3vF0tPZndZL3q7XIxz6XOmicLFQPh6/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', null, '0', null, '1438158936', null, null, '1', '1', '1', '1438158936', '', '2', '0', null, null, '0', '0', '0', '56c275787606f');
INSERT INTO `wx_user` VALUES ('5', '\"\\u65f6\\u5149\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Mjzdia7evAzxUTK4YE66ibL9j1rJVFysNeG2tvNV7MrdTfECwFMOwmwSIx2wCbwOWNk4S7ADIHzYeqTuxs6LAkEff9iciaoLQfhI/0', 'Yulin', 'Guangxi', 'China', 'zh_CN', '100', '100', null, '0', null, '1438159739', null, null, '1', '1', '1', '1438159739', '', '0', '0', null, null, '0', '0', '0', '56c2757876235');
INSERT INTO `wx_user` VALUES ('25', '\"\\u4f24\\u611f\\u6d41\\u5e74\\u3002\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/gGWztaMlXzfbPbh3Wv22ibXr2kCABvBH4qCWMDuvWqTyx2vHqPvx1CRDzPx8fUJGXwnciaUpGetXUegQkX02eR2YGP6ObQ6eP7/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', null, '0', '236006614', '1450940467', '236006614', '1450940467', '2', '1', '1', '1450940460', '', '0', '1', null, null, '0', '0', '0', '56c2757878436');
INSERT INTO `wx_user` VALUES ('9', '\"\\u97e6\\u5fc3\\u7ea2\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLDtJ6lYf0cN8n0gGZLK9c4uWoGxHEzQBia9bo06Pdaqaq05Pxab9a1vb4ic3bI1EXpwakttBttEvHyQ/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', null, '0', '3085465638', '1449548874', '3085465638', '1449548874', '2', '1', '1', '1449548532', '', '0', '1', null, null, '0', '0', '0', '56c27578765b1');
INSERT INTO `wx_user` VALUES ('8', '韦心红', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLDtJ6lYf0cN8n0gGZLK9c4uWoGxHEzQBia9bo06Pdaqaq05Pxab9a1vb4ic3bI1EXpwakttBttEvHyQ/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', null, '0', '2362390094', '1449547047', '2362390094', '1449547047', '1', '1', '1', '1449547039', '', '0', '1', null, null, '0', '0', '0', '56c27578763f9');
INSERT INTO `wx_user` VALUES ('10', '\"sToNe\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/IvenS6TvU7vWCrxgXzPtN7RDLAQaHLA925M4xmzJqDdf4WGyqJcs3Bicf1pK5Oibet6dtAfs8X53DsHymrg9wJl3csoYmgicUicg/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', null, '0', '2362390096', '1449645830', '2362390096', '1449645830', '2', '1', '1', '1449645830', '', '0', '1', null, null, '0', '0', '0', '56c2757876768');
INSERT INTO `wx_user` VALUES ('11', '\"\\u609f\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/gGWztaMlXzfjhDhGhY48bpicV2gA0gBia67o8Kn8wyiasEMH6WdFPSDuvjVueHBj7NWCia15NWYWibKxnKezra5rNtg/0', '', 'Kerry', '', 'zh_CN', '100', '100', null, '0', null, '1448646291', null, null, '2', '1', '1', '1448646291', '', '0', '0', null, null, '0', '0', '0', '56c27578769ae');
INSERT INTO `wx_user` VALUES ('12', '\"\\u738b\\u5350\\u950b\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLAGdcoaTTx7m8j4CS1GoeTv6L8SsxyqOm9c8zNgLw9zwwkGy5vBtDfTTW5OXOncNZ1CiaZIYyfH40Q/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', null, '0', null, '1449555904', null, null, '1', '1', '1', '1449555904', '', '0', '0', null, null, '0', '0', '0', '56c2757876bf1');
INSERT INTO `wx_user` VALUES ('13', '\"\\u5927\\u5b87\\u00b7\\u200d\\u200d\\u51ef\\u200d\\u610f\\u673a\\u68b0\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKWKRB5T9ckVQZ4c9yVw4OB3YoNgVxpy6yicA5RdrrbfdFHkLfOyoBcUxGmzRhpzoq5YUicIXO4Cz5w/0', 'Taizhou', 'Jiangsu', 'China', 'zh_CN', '100', '100', null, '0', null, '1448873083', null, null, '1', '1', '1', '1448873083', '', '0', '0', null, null, '0', '0', '0', '56c2757876e44');
INSERT INTO `wx_user` VALUES ('14', '\"sToNe\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/OE9N0c3q5uYyMuLlMlc5zTI7YZ7V0GbRomlqIAjQojuib0u8iaLniaiaiaDzx4ObjENHSSt0Mu8gGCQ3F35bQFCfQJkSjY0B7m0NB/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', null, '0', null, '1446533350', null, null, '2', '1', '1', '1446533350', '', '0', '0', null, null, '0', '0', '0', '56c275787707b');
INSERT INTO `wx_user` VALUES ('15', '\"\\u9759_Rain  \\u2600\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/fFgUJknhibCywgJJPg0gBL1HxFCz85iaZ8p3ibT8vo80tib3Omuf7ngX9q8niba0PuHouMwvvdhwak10E9fEeoPc3PQ/0', 'Jinzhong', 'Shanxi', 'China', 'zh_CN', '100', '100', null, '0', null, '1448882523', null, null, '1', '1', '1', '1448882523', '', '0', '0', null, null, '0', '0', '0', '56c27578772e9');
INSERT INTO `wx_user` VALUES ('16', '\"\\u6e05 \\u542c\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/fFgUJknhibCzfllu1tz94MLgibiciaf3Q3Iyc7fEN0H0DQNbIqkQNz8N2GiaTnjBpSPaLIJoqdXdqNmTibdM77ziaKRHw/0', 'Qingdao', 'Shandong', 'China', 'zh_CN', '100', '100', null, '0', null, '1448630784', null, null, '1', '1', '1', '1448630784', '', '0', '0', null, null, '0', '0', '0', '56c27578774db');
INSERT INTO `wx_user` VALUES ('17', '\"\\u8001\\u5434\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/rbqRmuMthQwRt8XsrYRc5WKStCpXNT5M92VEe12gyAywNdwLnsWUmqAdfcrapWk2qhxZjad7hg8zwQ4IMQkYH1UQjxwwBJaj/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', null, '0', null, '1446644347', null, null, '1', '1', '1', '1446644347', '', '0', '0', null, null, '0', '0', '0', '56c27578776aa');
INSERT INTO `wx_user` VALUES ('18', '\"A\\u65b0\\u666f\\u754c\\u7b7e\\u8bc1\\u4e2d\\u5fc3\\uff1a\\u5434\\u8363\\u6d69\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/gGWztaMlXzc4zvw8anTCZEtyicmlPF0Ria1bhQnxONE1fTgaxzicqyiavR1vzqhmfiagjF5OFTV16pqiawKibL7VAPk3fGgj1kpOqYd/0', '', 'Tsuen Wan', 'Hong Kong', 'zh_CN', '100', '100', null, '0', null, '1449461924', null, null, '1', '1', '1', '1449461924', '', '0', '0', null, null, '0', '0', '0', '56c2757877860');
INSERT INTO `wx_user` VALUES ('19', '\"\\u4e09\\u4e2b\\u5934\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/VYWzsxhVKewjBTQq7WoQ7rM4eD65tPsCEtGyVMHeicribAM4HOFYuXofY79YARyd2RDhialGIrj5DicKDMatYE6g9PC5abRGh1jG/0', 'Xi\'an', 'Shaanxi', 'China', 'zh_CN', '100', '100', null, '0', null, '1448897138', null, null, '1', '1', '1', '1448897138', '', '0', '0', null, null, '0', '0', '0', '56c2757877a20');
INSERT INTO `wx_user` VALUES ('20', '\"\\u25d0\\u2582\\u25d0\\u76fc\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/VYWzsxhVKeztus13q62MmINpXgFWiaEicAQpa2uaYKbutjkDkGC0AQhUU8tQwp3xdvTujiahbL35B8wRlicDCYrW9FRQQW1MbzZB/0', 'Yuncheng', 'Shanxi', 'China', 'zh_CN', '100', '100', null, '0', null, '1448264733', null, null, '1', '1', '1', '1448264733', '', '0', '0', null, null, '0', '0', '0', '56c2757877bc3');
INSERT INTO `wx_user` VALUES ('21', '\"A\\u5fae\\u4fe1\\u516c\\u4f17\\u53f7\\u5f00\\u53d1\\u848b18866237908\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/gGWztaMlXzf2A0k3VzMRSCCyZDJQ6WuXce4Ax0jQRXH0rwARBms06kg4fDSEicUqCzSsTkNKxHg3fMUBfk7JKZg6gYMnI3lhd/0', 'Qingdao', 'Shandong', 'China', 'zh_CN', '100', '100', null, '0', null, '1446873036', null, null, '1', '1', '1', '1446873036', '', '0', '0', null, null, '0', '0', '0', '56c2757877d97');
INSERT INTO `wx_user` VALUES ('22', '\"\\u9b4f\\u5f70\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/fFgUJknhibCwneJyP0YZYAZfKMUdyLkLmrnNEQhA68C9eJq0o2gU9eNfHl5XtuTGDJic2LFibUGufFIy4XG6F4ZFOsNPmM17QPx/0', 'Ganzhou', 'Jiangxi', 'China', 'zh_CN', '100', '100', null, '0', null, '1449019356', null, null, '1', '1', '1', '1449019356', '', '0', '0', null, null, '0', '0', '0', '56c2757877f3d');
INSERT INTO `wx_user` VALUES ('23', '\"\\u5b89\\u9759\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/VYWzsxhVKexSibanc4dDawDyJUsaLicXwsES97CqS0rrsOTJ1Tq2Xe5IwJsZyxL4qJ01uFhjICiaKZ6mx19wm4NhcFV8mAP2SM7/0', 'Weihai', 'Shandong', 'China', 'zh_CN', '100', '100', null, '0', null, '1450665834', null, null, '1', '1', '1', '1450665834', '', '0', '0', null, null, '0', '0', '0', '56c27578780f2');
INSERT INTO `wx_user` VALUES ('24', '\"DeTeNeLe\"', null, null, null, null, '0', 'http://wx.qlogo.cn/mmopen/gGWztaMlXzfyZpZjKGPatknPGKVegnko3PkFuf1LUaprQTre4WsoZe6CXNo98XNViaRicA5Zq8MqZ987R7jYq7bicTNEVX94r4Y/0', '', '', '', 'zh_CN', '100', '100', null, '0', null, '1450756197', null, null, '1', '1', '1', '1450756197', '', '0', '0', null, null, '0', '0', '0', '56c2757878298');
INSERT INTO `wx_user` VALUES ('26', '\"jacy\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/gGWztaMlXzd7b6CJJcuibAWFoOLQ0rCy14UZ9RAM0m9VKhQehJLQIoowHibP0Apz9zrpvtyvp8UnXpqibZlUS31BqWyFpavYBmC/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', null, '0', '1903437102', '1451376977', '1903437102', '1451376977', '2', '1', '1', '1451376972', '', '0', '1', null, null, '0', '0', '0', '56c27578785e9');
INSERT INTO `wx_user` VALUES ('27', '\"\\u97e6\\u5fc3\\u7ea2\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCcEAdawQjDzzuhz4hMIe63n5YFzZv6czmP0Wy795ouuvEwzuLyvicXnpQeb5uXNAm9QLxc2t4O2yw/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', null, '0', '3085465638', '1451378692', '3085465638', '1451378692', '2', '1', '1', null, null, null, '1', null, null, '0', '0', '0', '56c275787878a');
INSERT INTO `wx_user` VALUES ('29', '\"\\u5468\\u80b2\\u946b\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/6uicNI5TpH8gSOPOmX4HBvPdCEKUhbTeVGErUrIicvzAQOHFG6eVW7hhxBEf0e9PPfqabeXjG3snCiaYdTgD4yWpt5REjdL079l/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', 'oiP75vvsJIORxwmgYeALLm6QLLCY', '0', null, '1440664810', null, null, '1', '1', '1', '1440664810', '', '0', '0', null, null, '0', '0', '0', '56c2757878940');
INSERT INTO `wx_user` VALUES ('30', '\"Dana Xu\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLB9RgclzQUnxxZhbDibkNQsXoibZHcOmMewTyAbZ5Ql5M93KXouIevuBw7EzOPjeAkosnoW9MDql1Dw/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', 'oiP75vmubeXk4dFSw-SdRAbCX40I', '0', null, '1440254047', null, null, '1', '1', '1', '1440254047', '', '0', '0', null, null, '0', '0', '0', '56c2757878ada');
INSERT INTO `wx_user` VALUES ('31', '\"\\ud83d\\udc19 connie  \"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/6uicNI5TpH8grFh5ibFdIrjqhrWdSk58mMrmdfDkAxhWI8L17iakYSIQUDyI0yjTS8uUKfFfJuUVOItGlib1PhuHxa8QGHySaFVT/0', 'Shenzhen', 'Guangdong', 'China', 'zh_TW', '100', '100', 'oiP75vt4sa75NiXDjbc8XzGjeS-c', '0', null, '1448276762', null, null, '1', '1', '1', '1448276762', '', '0', '0', null, null, '0', '0', '0', '56c2757878d2a');
INSERT INTO `wx_user` VALUES ('32', '\"\\u8001\\u5434\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OLTI81gLXqVHz7R8drNOEzeyvsJSN2w39Gvwh85H2wZTUFcDuMx9ls2FGP5y751XSLAZepaDSiaNl06qkY6bBNpR/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', 'oiP75vnHK2znUHORDveiwvEq8mBo', '0', null, '1404459165', null, null, '1', '1', '1', '1404459165', '', '2', '0', null, null, '0', '0', '0', '56c2757878fb2');
INSERT INTO `wx_user` VALUES ('33', '\"\\u5927\\u6d77\\u626c\\u6ce2\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OLTI81gLXqVHyKYOicArMw2mvvAVUVYqsA0naMlr6hMxqCsmfKZ7uJrYoK7jQ94m6QwenL9rowIibrqesdba2Y0JK/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', 'oiP75voRmMvIym80huJPwfzOpKVQ', '0', null, '1445507085', null, null, '2', '1', '1', '1445507085', '', '0', '0', null, null, '0', '0', '0', '56c2757879221');
INSERT INTO `wx_user` VALUES ('34', '\"\\u5662\"', null, null, null, null, '0', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OLTI81gLXqVH8o8icP1PAVAsLricOjJvicI1DaAHruxENQw29vnGGfkAibcYh36LtHDTTQmjtSKN3fKTvOOYXY3bgxu/0', '', '', '', 'zh_CN', '100', '100', 'oiP75vs-WtoczIjAHVhDxJPh2t-E', '0', null, '1429871879', null, null, '1', '1', '1', '1429871879', '', '0', '0', null, null, '0', '0', '0', '56c2757879478');
INSERT INTO `wx_user` VALUES ('35', '\"\\u5f20\\u660e\\u8d35\"', null, null, null, null, '0', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OI6jABQd8fI5ahXRyvDHhQPRWLpcXcuv7wBV1pYrhBKUsoicHKVCAmMDJKjwXZulzwHXibqJ5NyWhhrnWZTdZoViaB/0', '', '', '', 'zh_CN', '100', '100', 'oiP75vm7BeXz2siddi4E1dyY09eI', '0', null, '1403764774', null, null, '1', '1', '1', '1403764774', '', '2', '0', null, null, '0', '0', '0', '56c2757879700');
INSERT INTO `wx_user` VALUES ('36', '\"\\u679c\\u679c\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OJU59qFPzGjmUsjoCvk0HDbRZb3RMD1IrMb68RfM8AfJpmyeicFHERAjHyUMzhwtFbR8Cib6SgX3qSXuiaGJKNNWFk/0', 'Wuhan', 'Hubei', 'China', 'zh_CN', '100', '100', 'oiP75vks4Eol84Vy1OHoIlKimQ9g', '0', null, '1441366373', null, null, '1', '1', '1', '1441366373', '', '0', '0', null, null, '0', '0', '0', '56c275787996c');
INSERT INTO `wx_user` VALUES ('37', '\"\\u7279\\u52a1\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/6uicNI5TpH8jD8629ojibFoeMExCpssuOHWsXpPDo4TUVWYzCuzfiaPkrbEibUUOicHFyRyWlbrict0I3npXhEp2L1Twicj1eRMJ4vc/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', 'oiP75vgsHIUrwv9hvyxWnkCwQLe8', '0', null, '1445861752', null, null, '1', '1', '1', '1445861752', '', '0', '0', null, null, '0', '0', '0', '56c2757879bde');
INSERT INTO `wx_user` VALUES ('38', '\"Wesson\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/xKCkW8VCnT0vhFYvB6iczWTfMm983tjExickIfdux70UsMDb0RSgWVRDGn9xxYdb8gJU48Nj60nTWIr4U1nlFtVVEtA1KSdOOc/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', 'oiP75vgYc0wXrST_73FZMF-RmKEw', '0', null, '1448107883', null, null, '2', '1', '1', '1448107883', '', '0', '0', null, null, '0', '0', '0', '56c2757879dce');
INSERT INTO `wx_user` VALUES ('39', '\"\\u7ed3\\u4f34\\u540c\\u884c\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Xewa2JUmZ1qiaqjHTgwOHN7CibFKpugFOv6auntMtZSPP87OjBsBEFRKNDmHUjB4041Udf0APLWUibkp0D7qjmiadcLmFDGIZY1E/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', 'oiP75vu-wNptz7PvVEMcUX51xW_0', '0', null, '1440243000', null, null, '1', '1', '1', '1440243000', '', '0', '0', null, null, '0', '0', '0', '56c2757879f77');
INSERT INTO `wx_user` VALUES ('40', '\"\\u5f00\\u5fc3\\u679c\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OKDk9UAM8MfcLDiclpE0REImezAYsFkqvMahP7cBrrajkdsfPHmoHYicbLkgoVnMHTprKgmr4ib3fWpjSBSU0UlJJ3/0', '', '', 'Andorra', 'zh_CN', '100', '100', 'oiP75vrVAbnpsdD6gJ7igymSwgmE', '0', null, '1435899175', null, null, '1', '1', '1', '1435899175', '', '0', '0', null, null, '0', '0', '0', '56c275787a139');
INSERT INTO `wx_user` VALUES ('41', '\"\\u4e2d\\u6821\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM4QPgKqWAjibj44UNV3icICPCribegww0g6g8oDYSNssyxFpWOhu7PQUIsmHVrsbo80KFMiaYMP3XQBHUqBW6nLlgEMemFC1Rg6Nzw/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', 'oiP75vtn2suukubiYrO84b4Gd0Nc', '0', null, '1430047276', null, null, '1', '1', '1', '1430047276', '', '0', '0', null, null, '0', '0', '0', '56c275787a2d8');
INSERT INTO `wx_user` VALUES ('42', '\"\\u7231\\u7b11\\u7684\\u773c\\u775b\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/xKCkW8VCnT03RIB8WYDz9W1RFNribqnNere6OWDQR2UNLQYl5JLAzOk5TicJXWqT597MqcKUg4rtnFcP2c2SQC6pytQkhNibXYia/0', 'Yongin', 'Jeju-do', 'Korea', 'zh_CN', '100', '100', 'oiP75vlnBQUaPVCX84GEWmKdlxbs', '0', null, '1449493529', null, null, '1', '1', '1', '1449493529', '', '0', '0', null, null, '0', '0', '0', '56c275787a493');
INSERT INTO `wx_user` VALUES ('43', '\"\\u864e\\u80c6\\u9f99\\u5a018\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OJU59qFPzGjmY0ZmrPbGfLmHYBKyaasJWElFDZSxwF9jEia3eh2h1bic8yQ5o0cZrkc08Deb2ic4HOia5HuDXneVIbj/0', 'Handan', 'Hebei', 'China', 'zh_CN', '100', '100', 'oiP75vkSD-QexjwsfLDPQgu8Fcwo', '0', null, '1443067742', null, null, '1', '1', '1', '1443067742', '', '0', '0', null, null, '0', '0', '0', '56c275787a630');
INSERT INTO `wx_user` VALUES ('44', '\"mao\"', null, null, null, null, '1', '', 'Changsha', 'Hunan', 'China', 'zh_CN', '100', '100', 'oiP75vmfWF3_KnIUzwwAfPFZp3kM', '0', null, '1415590790', null, null, '1', '1', '1', '1415590790', '', '0', '0', null, null, '0', '0', '0', '56c275787a7d9');
INSERT INTO `wx_user` VALUES ('45', '\"\\u84dd\\u5ef7\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OIWDsmePnISqicn5DF7Tn9DLmsIqEpEIWZ12NcWXiafITSFfiaoGIItllXgC3UFla1kiba2AdverCm1icn9BhrKQbDrX/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', 'oiP75vjsix5oTybxBUAS_nZOrpaw', '0', null, '1444659696', null, null, '1', '1', '1', '1444659696', '', '0', '0', null, null, '0', '0', '0', '56c275787a97b');
INSERT INTO `wx_user` VALUES ('46', '\"\\u4eba\\u751f\\u8def\\u6f2b\\u6f2b\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OLqpoEpDic93e3YaUJrNN1TwM99H40RREk84NXbOUgIOMic6WPoCwtbU0SMjZC7ia4HcK0VHWmBdJlnJmngeMPibRw6/0', 'Shenzhen', 'Guangdong', 'China', 'zh_CN', '100', '100', 'oiP75vsQAvXyVFiVOEiZlSgj4HSQ', '0', null, '1447754818', null, null, '1', '1', '1', '1447754818', '', '0', '0', null, null, '0', '0', '0', '56c275787ab17');
INSERT INTO `wx_user` VALUES ('47', '\"Anzersen\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OJU59qFPzGjmVsuAg3Jm0Dh5Fts5eYjNfDtEg0t4ETuMMZoOmA3x8oibSKxW8ddeXs2sZ24QticibRlS8U9klJwLu6/0', 'Jiangbei', 'Chongqing', 'China', 'zh_CN', '100', '100', 'oiP75vpCTvwfRxC5xIYDoXl5RCJ4', '0', null, '1449494325', null, null, '1', '1', '1', '1449494325', '', '0', '0', null, null, '0', '0', '0', '56c275787accd');
INSERT INTO `wx_user` VALUES ('48', '\"\\u4e60\\u60efD\\u8c03\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM520ia3NOGpGgMC2I2vHLkiaT9yRr9kBKibyTOsAmHMnuNL9eic0Lib8TI1Kl7VW4XhENcz6fQNasHpgFaz8tebibomxiaOCMIhMyT4Pw/0', 'Suzhou', 'Jiangsu', 'China', 'zh_CN', '100', '100', 'oiP75vpQNFUahcUeLGMU9wtLBU9w', '0', null, '1449494325', null, null, '1', '1', '1', '1449494325', '', '0', '0', null, null, '0', '0', '0', '56c275787ae66');
INSERT INTO `wx_user` VALUES ('51', '\"sToNe\"', 'f6b666ffe292820dae81bba3e9d6774f', null, '13538060870', null, '1', 'http://wx.qlogo.cn/mmopen/3ia9g1HB2WI5zrYTiboxgewKRicwTZFJthlLX65TdDy42THUeLTyvt9xumZMbpLracd11t31Ar2qZC1ibnoCJXFZIGw1tkL3FL9p/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vmKNwKs9gQxl6jqsWpzn_JE', '0', '2362390094', '1451462707', '2362390094', '1451462707', '2', '1', '1', '1451462707', '', '0', '1', null, null, '0', '0', '0', '56c275787b01b');
INSERT INTO `wx_user` VALUES ('52', '\"\\u6d41\\u6c13\\u732a\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OLTI81gLXqVH2iaCYZTgXTIJSzuKcQljco2P844SKaqW3rguaX6iaaV9ApkdgfRNdnQKJrgRMzEUAjbYr734vmXBB/0', '', '', '中国', 'zh_CN', '200', '200', 'oiP75viNh96SJbLGZyqACOv3xY8Y', '0', '2362390094', '1451872421', '2362390094', '1451872421', '2', '1', '1', '1451872421', '', '0', '1', null, null, '0', '0', '0', '56c275787b1cb');
INSERT INTO `wx_user` VALUES ('53', '\"\\u6d41\\u6c13\\u732a\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/rbqRmuMthQwRt8XsrYRc5eKRMTZepNplqh219PP5QVxFxNh7vl3EPJYd2e2ndLXUzFN99oibdh2KhWbtpU7fPzWqia53Eib3kAz/0', '', '', '中国', 'zh_CN', '100', '100', null, '0', '3682936845', '1451905902', '3682936845', '1451905902', '2', '1', '1', '1451872458', '', '0', '1', null, null, '0', '0', '0', '56c275787b360');
INSERT INTO `wx_user` VALUES ('54', '向', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OIKvibytjUYCJCkEsP0nCO2aP23VNSzvsicoia4Rm06AO03Iu8ibvwD3RElVXoUstFweUMAtQHaXDuIfSgoiaPhcZ5Hz/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vkQ4TdUE6ZHcGiwKrFyNGrY', '0', '2362390095', '1451962020', '2362390095', '1451962020', '1', '1', '1', '1451962019', '', '0', '1', null, null, '0', '0', '0', '56c275787b558');
INSERT INTO `wx_user` VALUES ('55', '\"\\u97e6\\u5fc3\\u7ea2\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLD6kypzjw0aicY6z4j7NRrHq7Lq87QDjIMpTAibAicD0JEjWfEtGMIkP3DdRiaUXJnC43dtFH38WTQXxw/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vhGQ5euV-hOn2D20vZlSCY8', '0', '2362390089', '1452135123', '2362390089', '1452135123', '2', '1', '1', '1452135122', '', '0', '1', null, null, '0', '0', '0', '56c275787b6f1');
INSERT INTO `wx_user` VALUES ('56', '伤感流年。', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/xKCkW8VCnT0CQVQf42fJsW2ozhr7dGI7ntWBia0WjGfyjAwAfVQcR1pP23azcshTxcGKUTOgDOfFFJEsiczfbHk3U0vgP1hWGh/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75voI_LkFNpW7IvkrbnaCsmY0', '0', '2362390092', '1452214867', '2362390092', '1452214867', '1', '1', '1', '1452214867', '', '0', '1', null, null, '0', '0', '0', '56c275787b8a5');
INSERT INTO `wx_user` VALUES ('57', '\"\\u59da\\u4e50\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OLTI81gLXqVHzOxa7FvlibWcdrB6vtBFaTbibHGROS4yDw7oPj2Gia2OSbHTZolnHuR3BXOvYics713kBu5VQLF98zD/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vtGqhT-73yRWNy_YVWhfeqo', '0', '2362390089', '1452218794', '2362390089', '1452218794', '2', '1', '1', '1452218794', '', '0', '1', null, null, '0', '0', '0', '56c275787ba45');
INSERT INTO `wx_user` VALUES ('58', '\"\\u4f55\\u4e3d\\u840d\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/6uicNI5TpH8jTzZ1mt7ibQVw7jVic4r7sJU7CS6icOn0HMyHQzpA3BmgkKQ1FUl1rY5mElAVAibEnxicnG04I858iazNVJRUV8wtUUz/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vk1i96LpePaiqPcbGboMx0Q', '0', '2362390091', '1452218810', '2362390091', '1452218810', '2', '1', '1', '1452218810', '', '0', '1', null, null, '0', '0', '0', '56c275787bbfd');
INSERT INTO `wx_user` VALUES ('59', '\"\\u7f8a\\u8102\\u767d\\u7389\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/xKCkW8VCnT1zc7FlibteiaYv27QQAYeKrvQnJk7jDrIpNbUwaYwrV5qod4uvC02HMSrLG7c7wG7ABsNLuH8Df0HHmibJo8gz3jK/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vp0wBHs-Y7gr0cf8_LTL1u8', '0', '2362390096', '1452218817', '2362390096', '1452218817', '2', '1', '1', '1452218817', '', '0', '1', null, null, '0', '0', '0', '56c275787bd9a');
INSERT INTO `wx_user` VALUES ('60', '\"\\u661f\\u5c39\\u7af9\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/ax6PlJtB7eIaCdMf37icxyvFrDjh1TbKoLzYAlwoYUXicOe9Gmt7sgsybqupRyxtSvu017PVeSx5cjibHqmUtES6x4GUqPUKpHK/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vgsArv2nQ0nzhuk6SXB5RBw', '0', '2362390096', '1452218823', '2362390096', '1452218823', '2', '1', '1', '1452218823', '', '0', '1', null, null, '0', '0', '0', '56c275787bf4d');
INSERT INTO `wx_user` VALUES ('61', '\"\\u90d1\\u51e4\\u6566\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/xKCkW8VCnT0DSYH5uYq9PbR8yVz0nZQg7ic3ic13Lm9cL6q0l2ib0zjmAxkHTgzz9PmiaMAbCE9aOdnJFvXJ6zK8QYlXwibMITXZj/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vgsP95keofYrmVRdGlsRLhc', '0', '2362390095', '1452218831', '2362390095', '1452218831', '2', '1', '1', '1452218831', '', '0', '1', null, null, '0', '0', '0', '56c275787c0ef');
INSERT INTO `wx_user` VALUES ('62', '\"\\u84dd\\u6d77\\u8c5a\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/gGWztaMlXzckPL53FNeCG8LRjbILfUqOXXOicV1PW1hiaxrQiaIypmuhltPmocdDDyD6q5OdaUeib1MF7ZRmWWe4zjiauQC1JDseq/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', null, '0', '236006615', '1452244659', '236006615', '1452244659', '2', '1', '1', '1452244609', '', '0', '1', null, null, '0', '0', '0', '56c275787c283');
INSERT INTO `wx_user` VALUES ('63', '\"\\u4ece\\u96f6\\u5f00\\u59cb\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/gGWztaMlXzdWZcibFmjEZAduHc9a2SE2S6WJ7NYWrRDfYztyicxZIv7kjlgRu6ARykHSuanduuLicIVSNkVJofvTkKoXziaX3LPk/0', '桂林', '广西', '中国', 'zh_CN', '100', '100', null, '0', '3062675541', '1452306379', '3062675541', '1452306379', '2', '1', '1', '1452306371', '', '0', '1', null, null, '0', '0', '0', '56c275787c437');
INSERT INTO `wx_user` VALUES ('64', '\"\\ud83d\\udc41kicaa\\ud83d\\udc41\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/Xewa2JUmZ1ohpWqaLLAHdwHVkCPpJtHldPd5xhshqSbK5oqFrU3libMIDiaOafoeJCX8nDtpt8icibkdSicBVT7qrJg/0', '', '广东', '中国', 'zh_HK', '100', '100', 'oiP75vu8BTaJYUuM513uHz8VNmOc', '0', null, '1452217519', null, null, '2', '1', '1', '1452217519', '', '0', '0', null, null, '0', '0', '0', '56c275787c5d0');
INSERT INTO `wx_user` VALUES ('66', '\"\\u5c0f\\u5229\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLABFp3vfBAbibrjxibiaFuucdzckEcfibvBuUic76EEhT7LhMt8BlBlibTyiaXV5h1r6gaPWTwBTvaybYicDw/0', '', 'Hebei', 'China', 'zh_CN', '100', '100', null, '0', null, '1452244405', null, null, '1', '1', '1', '1452244405', '', '0', '0', null, null, '0', '0', '0', '56c275787c77b');
INSERT INTO `wx_user` VALUES ('67', '\"Penny Nie\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/jLTWKvcPq6YAFAJa38XeIoiasLEk0qrblC6YqEZbUbrx0s3JHCKBMwevRt59HZVsXOwhrCgSRM7T1ryMowA2CL6r2rbH9Rdric/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', null, '0', '1947727385', '1452824265', '1947727385', '1452824265', '2', '1', '1', '1452823766', '', '0', '1', null, null, '0', '0', '0', '56c275787c937');
INSERT INTO `wx_user` VALUES ('68', '\"FDCfdc\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/rbqRmuMthQwRt8XsrYRc5UCjiask2hOW9ldp5lutwQyz6Kh9LGWu9Gc2XbR0TaxJJK0LE9BtHD8SiaPj2R6ibqK8sOAPFbmticre/0', '', '', '中国', 'zh_CN', '100', '100', null, '0', '1971852926', '1453103534', '1971852926', '1453103534', '2', '1', '1', '1453103518', '', '0', '1', null, null, '0', '0', '0', '56c275787cad6');
INSERT INTO `wx_user` VALUES ('69', '\"\\u8def\\u8fc7\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/gGWztaMlXzdWZcibFmjEZAenZeflIq8ezFIZuNpJLqUhHDWzDmAWtbSc9kaM9Q1HSveCCLTRwlXrH1qsJs3qn9vic5oaAr0pUb/0', 'Huaian', 'Jiangsu', 'China', 'zh_CN', '100', '100', null, '0', null, '1452907672', null, null, '1', '1', '1', '1452907672', '', '0', '0', null, null, '0', '0', '0', '56c275787cc75');
INSERT INTO `wx_user` VALUES ('70', '\"DeTeNeLe\"', null, null, null, null, '0', 'http://wx.qlogo.cn/mmopen/xKCkW8VCnT22iarptUYO2Mq8tiakI3xTWHevM0XVkjgk4RIYNupFlfaicYkgwBIFqGiakuzIcbfrLHPB7DvI3Pouy6mVxXvRv5Re/0', '', '', '中国', 'zh_CN', '200', '200', 'oiP75vlF-g_gs93Bk31sb25W_MW0', '0', '2362390089', '1453260089', '2362390089', '1453260089', '2', '1', '1', '1453260089', '', '0', '1', null, null, '0', '0', '0', '56c275787ce0f');
INSERT INTO `wx_user` VALUES ('72', '时光', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/Xewa2JUmZ1omHOoE6Khbuq8j2ibFvSTCOkiclSV8ibxPDUZmnb9uiaXelT0jJ96qAk8PibEf3MJtbTy3uqWyBj9hicic9u0bLTtejyr/0', '玉林', '广西', '中国', 'zh_CN', '200', '200', 'oiP75vvrXt6nw3bTvxxOreT2e4Nw', '0', '2362390094', '1453263206', '2362390094', '1453263206', '1', '1', '1', '1453263205', '', '0', '1', null, null, '0', '0', '0', '56c275787cfbe');
INSERT INTO `wx_user` VALUES ('73', '\"man_ x\"', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/6uicNI5TpH8iaXfeWTQF0iamicM3yZLaqx9cqpDqro1Xwle3htsMUnmfStB4y727MKsSl03I32YXMjTVY2QDwuFYw7RLHs6eCHcl/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vnNIRfTRXL5ALfalxp8KXhw', '0', '2362390095', '1453263298', '2362390095', '1453263298', '2', '1', '1', '1453263298', '', '0', '1', null, null, '0', '0', '0', '56c275787d158');
INSERT INTO `wx_user` VALUES ('74', 'AMan', null, null, null, null, '1', '', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vm6wh_xuC-_S8YXSoP5gdZ8', '0', '2362390095', '1453271035', '2362390095', '1453271035', '1', '1', '1', '1453271035', '', '0', '1', null, null, '0', '0', '0', '56c275787d2fd');
INSERT INTO `wx_user` VALUES ('75', 'sumyu', null, null, null, null, '2', 'http://wx.qlogo.cn/mmopen/Hmw3wANa1OLTI81gLXqVHxr8TTj7P54VskTcRTo9qvBtVpv8zXVsILsIu89MpLiaLPH314hqX4ib3aMPn8fekRa6q2Xjvtwmxn/0', '深圳', '广东', '中国', 'zh_CN', '200', '200', 'oiP75vhHQIOn4_0CXZqwu0gZjhRA', '0', '2362390095', '1453792942', '2362390095', '1453792942', '1', '1', '1', '1453792942', '', '0', '1', null, null, '0', '0', '0', '56c275787d4ca');
INSERT INTO `wx_user` VALUES ('76', '\"307\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/6uicNI5TpH8hM94z76bZdJksp53UiaZEHoibIU7ehmkTiaLbFFlFVBBEQIfhAPyib1OWJVUe2Skvia9bfGSp5XWRwuMOcnicfa3jPGo/0', '商丘', '河南', '中国', 'zh_CN', '200', '200', 'oiP75vgesx6nPZTof4CqjsT3PiKQ', '0', '2362390096', '1453796643', '2362390096', '1453796643', '2', '1', '1', '1453796643', '', '0', '1', null, null, '0', '0', '0', '56c275787d667');
INSERT INTO `wx_user` VALUES ('77', '\"\\u71d5\\u9894\\u4e66\\u751f\"', null, null, null, null, '1', '', 'Dongguan', 'Guangdong', 'China', 'zh_CN', '100', '100', null, '0', null, '1453903084', null, null, '1', '1', '1', '1453903084', '', '0', '0', null, null, '0', '0', '0', '56c275787d804');
INSERT INTO `wx_user` VALUES ('78', '\"jacy\"', null, null, null, null, '1', 'http://wx.qlogo.cn/mmopen/xKCkW8VCnT2QcqX3f5kKzHfcT1UGAGrSKxBiaiaAyvTHhSrXCuRLNrUzx4UxOqibKDANTCwY0V6mwVlJsVKd1c5u7Tf0pQib3YAI/0', '深圳', '广东', '中国', 'zh_CN', '100', '100', 'oiP75vjdFQmPMBYjK1Bih8vTp4iU', '0', '1903438274', '1455779222', '1903438274', '1455779222', '2', '1', '1', null, null, null, '1', null, null, '0', '0', '0', '51EL7');

-- ----------------------------
-- Table structure for `wx_user_follow`
-- ----------------------------
DROP TABLE IF EXISTS `wx_user_follow`;
CREATE TABLE `wx_user_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `publicid` int(11) DEFAULT NULL,
  `follow_id` int(11) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_user_follow
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_visit_log`
-- ----------------------------
DROP TABLE IF EXISTS `wx_visit_log`;
CREATE TABLE `wx_visit_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `publicid` int(10) DEFAULT '0' COMMENT 'publicid',
  `module_name` varchar(30) DEFAULT NULL COMMENT 'module_name',
  `controller_name` varchar(30) DEFAULT NULL COMMENT 'controller_name',
  `action_name` varchar(30) DEFAULT NULL COMMENT 'action_name',
  `uid` varchar(255) DEFAULT '0' COMMENT 'uid',
  `ip` varchar(30) DEFAULT NULL COMMENT 'ip',
  `brower` varchar(30) DEFAULT NULL COMMENT 'brower',
  `param` text COMMENT 'param',
  `referer` varchar(255) DEFAULT NULL COMMENT 'referer',
  `cTime` int(10) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1019 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_visit_log
-- ----------------------------
INSERT INTO `wx_visit_log` VALUES ('1010', '2', 'Home', 'Public', 'lists', '1', '113.116.41.194', 'Google', '{\"from\":\"5\"}', 'http://project.weiphp.cn/paiqian/index.php?s=/Home/Public/lists/from/5.html', '1455779002');
INSERT INTO `wx_visit_log` VALUES ('1018', '2', 'Home', 'Public', 'lists', '1', '113.116.41.194', 'Firefox', '{\"from\":\"5\"}', 'http://project.weiphp.cn/paiqian/index.php?s=/Home/Public/lists/from/5.html', '1455784130');
INSERT INTO `wx_visit_log` VALUES ('1017', '2', 'Home', 'Public', 'lists', '1', '::1', 'Google', '{\"from\":\"5\"}', 'http://localhost/paiqian/index.php?s=/Home/Public/lists/from/5.html', '1455780427');
INSERT INTO `wx_visit_log` VALUES ('1016', '2', 'Home', 'Index', 'main', '1', '113.116.41.194', 'Google', '[]', 'http://project.weiphp.cn/paiqian/index.php?s=/Home/Index/main/publicid/2.html', '1455779317');
INSERT INTO `wx_visit_log` VALUES ('1015', '2', 'Home', 'Public', 'lists', '1', '113.116.41.194', 'Google', '{\"from\":\"5\"}', 'http://project.weiphp.cn/paiqian/index.php?s=/Home/Public/lists/from/5.html', '1455779281');
INSERT INTO `wx_visit_log` VALUES ('1013', '2', 'Home', 'Index', 'main', '1', '113.116.41.194', 'Google', '[]', 'http://project.weiphp.cn/paiqian/index.php?s=/Home/Index/main/publicid/2.html', '1455779075');
INSERT INTO `wx_visit_log` VALUES ('1014', '2', 'Paiqian', 'Slideshow', 'lists', '1', '113.116.41.194', 'Google', '[]', 'http://project.weiphp.cn/paiqian/index.php?s=/addon/Paiqian/Slideshow/lists.html&mdm=356|357', '1455779185');
INSERT INTO `wx_visit_log` VALUES ('1012', '2', 'Home', 'Public', 'lists', '1', '113.116.41.194', 'Google', '{\"from\":\"5\"}', 'http://project.weiphp.cn/paiqian/index.php?s=/Home/Public/lists/from/5.html', '1455779015');
INSERT INTO `wx_visit_log` VALUES ('1011', '2', 'Home', 'Public', 'step_0', '1', '113.116.41.194', 'Google', '[]', 'http://project.weiphp.cn/paiqian/index.php?s=/Home/Public/step_0.html', '1455779014');

-- ----------------------------
-- Table structure for `wx_weisite_category`
-- ----------------------------
DROP TABLE IF EXISTS `wx_weisite_category`;
CREATE TABLE `wx_weisite_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(100) NOT NULL COMMENT '分类标题',
  `icon` int(10) unsigned DEFAULT NULL COMMENT '分类图片',
  `url` varchar(255) DEFAULT NULL COMMENT '外链',
  `is_show` tinyint(2) DEFAULT '1' COMMENT '显示',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  `sort` int(10) DEFAULT '0' COMMENT '排序号',
  `pid` int(10) DEFAULT '0' COMMENT '一级目录',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_weisite_category
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_weisite_cms`
-- ----------------------------
DROP TABLE IF EXISTS `wx_weisite_cms`;
CREATE TABLE `wx_weisite_cms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `keyword_type` tinyint(2) DEFAULT NULL COMMENT '关键词类型',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `intro` text COMMENT '简介',
  `cate_id` int(10) unsigned DEFAULT '0' COMMENT '所属类别',
  `cover` int(10) unsigned DEFAULT NULL COMMENT '封面图片',
  `content` text COMMENT '内容',
  `cTime` int(10) DEFAULT NULL COMMENT '发布时间',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序号',
  `view_count` int(10) unsigned DEFAULT '0' COMMENT '浏览数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_weisite_cms
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_weisite_footer`
-- ----------------------------
DROP TABLE IF EXISTS `wx_weisite_footer`;
CREATE TABLE `wx_weisite_footer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `url` varchar(255) DEFAULT NULL COMMENT '关联URL',
  `title` varchar(50) NOT NULL COMMENT '菜单名',
  `pid` tinyint(2) DEFAULT '0' COMMENT '一级菜单',
  `sort` tinyint(4) DEFAULT '0' COMMENT '排序号',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `icon` int(10) unsigned DEFAULT NULL COMMENT '图标',
  PRIMARY KEY (`id`),
  KEY `token` (`token`,`pid`,`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_weisite_footer
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_weisite_slideshow`
-- ----------------------------
DROP TABLE IF EXISTS `wx_weisite_slideshow`;
CREATE TABLE `wx_weisite_slideshow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `img` int(10) unsigned NOT NULL COMMENT '图片',
  `url` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `is_show` tinyint(2) DEFAULT '1' COMMENT '是否显示',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序',
  `token` varchar(100) DEFAULT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_weisite_slideshow
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_weixin_log`
-- ----------------------------
DROP TABLE IF EXISTS `wx_weixin_log`;
CREATE TABLE `wx_weixin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cTime` int(11) DEFAULT NULL,
  `cTime_format` varchar(30) DEFAULT NULL,
  `data` text,
  `data_post` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12365 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_weixin_log
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_weixin_message`
-- ----------------------------
DROP TABLE IF EXISTS `wx_weixin_message`;
CREATE TABLE `wx_weixin_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `ToUserName` varchar(100) DEFAULT NULL COMMENT 'Token',
  `FromUserName` varchar(100) DEFAULT NULL COMMENT 'OpenID',
  `CreateTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `MsgType` varchar(30) DEFAULT NULL COMMENT '消息类型',
  `MsgId` varchar(100) DEFAULT NULL COMMENT '消息ID',
  `Content` text COMMENT '文本消息内容',
  `PicUrl` varchar(255) DEFAULT NULL COMMENT '图片链接',
  `MediaId` varchar(100) DEFAULT NULL COMMENT '多媒体文件ID',
  `Format` varchar(30) DEFAULT NULL COMMENT '语音格式',
  `ThumbMediaId` varchar(30) DEFAULT NULL COMMENT '缩略图的媒体id',
  `Title` varchar(100) DEFAULT NULL COMMENT '消息标题',
  `Description` text COMMENT '消息描述',
  `Url` varchar(255) DEFAULT NULL COMMENT 'Url',
  `collect` tinyint(1) DEFAULT '0' COMMENT '收藏状态',
  `deal` tinyint(1) DEFAULT '0' COMMENT '处理状态',
  `is_read` tinyint(1) DEFAULT '0' COMMENT '是否已读',
  `type` tinyint(1) DEFAULT '0' COMMENT '消息分类',
  `is_material` int(10) DEFAULT '0' COMMENT '设置为文本素材',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_weixin_message
-- ----------------------------
INSERT INTO `wx_weixin_message` VALUES ('1', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', '1451479662', 'text', '6234057679501257052', '123466', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('2', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', '1453192093', 'text', '6241412514643464375', '头疼', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('3', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453260651', 'text', '6241706969011369752', '01', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('4', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453260660', 'text', '6241707007666075420', '02', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('5', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453260675', 'text', '6241707072090584862', '黄总，收到吗！', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('6', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453260726', 'text', '6241707291133916986', '人工客服', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('7', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453260771', 'text', '6241707484407445338', '01', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('8', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453260777', 'text', '6241707510177249118', '02', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('9', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453260862', 'text', '6241707875249469346', '人工客服', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('10', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453261000', 'text', '6241708467954956290', '55', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('11', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453261196', 'text', '6241709309768546448', '55', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('12', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453261707', 'text', '6241711504496835099', '返回！', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('13', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453261713', 'text', '6241711530266638878', '收到了吗！', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('14', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', '1453262587', 'text', '6241715284068056008', '03', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('15', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453262720', null, null, '客服\r\n客服1\r\n客服2\r\n客服3', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('16', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453262750', 'text', '6241715984147725323', '03', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('17', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453262767', 'text', '6241716057162169363', '111', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('18', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', '1453262922', null, null, '客服\r\n客服1\r\n客服2\r\n客服3', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('19', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453263106', null, null, '客服\r\n客服1\r\n客服2\r\n客服3', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('20', 'gh_1784a6c712f0', 'oOqnfsi_pBYQEPf_Dpgo-npc0bzw', '1453263119', null, null, '客服\r\n客服1\r\n客服2\r\n客服3', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('21', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453263526', 'text', '6241719317042347470', '嘿嘿嘿', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('22', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453264610', 'text', '6241723972786896842', '1', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('23', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453264624', 'text', '6241724032916438997', '1', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('24', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453268872', null, null, '客服\r\n客服1\r\n客服2\r\n客服3', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('25', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453268884', 'text', '6241742329477123925', '1', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('26', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453270785', 'text', '6241750494209954886', '3', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('27', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453270797', 'text', '6241750545749562442', '03', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('28', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453274115', null, null, '您好，为你接入客服0023', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('29', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453274136', null, null, '您好，为你接入客服0023', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('30', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453274160', null, null, '您好，为你接入客服0023', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('31', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453288368', null, null, '{\"news\":{\"articles\":[{\"title\":\"\\u5feb\\u9012\\u5305\\u88f9\\uff1a\\u4e2d\\u56fd\\u90ae\\u653f\\u6e29\\u67d4\\u7684\\u8fdb\\u51fb\\u4e4b\\u4e3e\",\"description\":\"\\u6709\\u9274\\u4e8e\\u6b64\\uff0c\\u6240\\u4ee5\\u8bf4\\uff0c\\u5373\\u4fbf\\u4e00\\u7ebf\\u57ce\\u5e02\\u5df2\\u7ecf\\u6ca1\\u6709\\u5e02\\u573a\\uff0c\\u7eb5\\u4f7f\\u4e0d\\u53bb\\u6536\\u201c\\u4efd\\u5b50\\u94b1\\u201d\\uff0c\\u57fa\\u4e8e\\u73b0\\u6709\\u7684\\u4f18\\u52bf\\uff0c\\u518d\\u5145\\u5206\\u5229\\u7528\\u5360\\u636e\\u7684\\u5404\\u79cd\\u8d44\\u6e90\\uff0c\\u501f\\u52a9\\u56fd\\u5bb6\\u5f53\\u4e0b\\u201c\\u4e92\\u8054\\u7f51+\\u519c\\u6751\\u201d\\u3001\\u201c\\u4e92\\u8054\\u7f51+\\u5916\\u8d38\\u201d\\u7684\\u653f\\u7b56\\u5927\\u52bf\\uff0c\\u90ae\\u653f\\u6253\\u4e00\\u573a\\u6f02\\u4eae\\u7684\\u7ffb\\u8eab\\u4ed7\\u4e5f\\u4e0d\\u662f\\u6ca1\\u6709\\u53ef\\u80fd\\u3002\",\"url\":\"http:\\/\\/project.weiphp.cn\\/paiqian\\/index.php?s=\\/Home\\/Material\\/news_detail\\/id\\/12.html\",\"picurl\":\"http:\\/\\/project.weiphp.cn\\/paiqian\\/Uploads\\/Picture\\/2015-12-13\\/566d247223b7a.jpg\"}]},\"touser\":\"oOqnfslWuN797-U456agliRgBxh8\",\"msgtype\":\"news\"}', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('32', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', '1453288409', null, null, '{\"news\":{\"articles\":[{\"title\":\"\\u5feb\\u9012\\u5305\\u88f9\\uff1a\\u4e2d\\u56fd\\u90ae\\u653f\\u6e29\\u67d4\\u7684\\u8fdb\\u51fb\\u4e4b\\u4e3e\",\"description\":\"\\u6709\\u9274\\u4e8e\\u6b64\\uff0c\\u6240\\u4ee5\\u8bf4\\uff0c\\u5373\\u4fbf\\u4e00\\u7ebf\\u57ce\\u5e02\\u5df2\\u7ecf\\u6ca1\\u6709\\u5e02\\u573a\\uff0c\\u7eb5\\u4f7f\\u4e0d\\u53bb\\u6536\\u201c\\u4efd\\u5b50\\u94b1\\u201d\\uff0c\\u57fa\\u4e8e\\u73b0\\u6709\\u7684\\u4f18\\u52bf\\uff0c\\u518d\\u5145\\u5206\\u5229\\u7528\\u5360\\u636e\\u7684\\u5404\\u79cd\\u8d44\\u6e90\\uff0c\\u501f\\u52a9\\u56fd\\u5bb6\\u5f53\\u4e0b\\u201c\\u4e92\\u8054\\u7f51+\\u519c\\u6751\\u201d\\u3001\\u201c\\u4e92\\u8054\\u7f51+\\u5916\\u8d38\\u201d\\u7684\\u653f\\u7b56\\u5927\\u52bf\\uff0c\\u90ae\\u653f\\u6253\\u4e00\\u573a\\u6f02\\u4eae\\u7684\\u7ffb\\u8eab\\u4ed7\\u4e5f\\u4e0d\\u662f\\u6ca1\\u6709\\u53ef\\u80fd\\u3002\",\"url\":\"http:\\/\\/project.weiphp.cn\\/paiqian\\/index.php?s=\\/Home\\/Material\\/news_detail\\/id\\/12.html\",\"picurl\":\"http:\\/\\/project.weiphp.cn\\/paiqian\\/Uploads\\/Picture\\/2015-12-13\\/566d247223b7a.jpg\"}]},\"touser\":\"oOqnfslfFegs_2AltHLkKJzUEOQQ\",\"msgtype\":\"news\"}', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('33', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453288660', null, null, '{\"news\":{\"articles\":[{\"title\":\"\\u5feb\\u9012\\u5305\\u88f9\\uff1a\\u4e2d\\u56fd\\u90ae\\u653f\\u6e29\\u67d4\\u7684\\u8fdb\\u51fb\\u4e4b\\u4e3e\",\"description\":\"\\u6709\\u9274\\u4e8e\\u6b64\\uff0c\\u6240\\u4ee5\\u8bf4\\uff0c\\u5373\\u4fbf\\u4e00\\u7ebf\\u57ce\\u5e02\\u5df2\\u7ecf\\u6ca1\\u6709\\u5e02\\u573a\\uff0c\\u7eb5\\u4f7f\\u4e0d\\u53bb\\u6536\\u201c\\u4efd\\u5b50\\u94b1\\u201d\\uff0c\\u57fa\\u4e8e\\u73b0\\u6709\\u7684\\u4f18\\u52bf\\uff0c\\u518d\\u5145\\u5206\\u5229\\u7528\\u5360\\u636e\\u7684\\u5404\\u79cd\\u8d44\\u6e90\\uff0c\\u501f\\u52a9\\u56fd\\u5bb6\\u5f53\\u4e0b\\u201c\\u4e92\\u8054\\u7f51+\\u519c\\u6751\\u201d\\u3001\\u201c\\u4e92\\u8054\\u7f51+\\u5916\\u8d38\\u201d\\u7684\\u653f\\u7b56\\u5927\\u52bf\\uff0c\\u90ae\\u653f\\u6253\\u4e00\\u573a\\u6f02\\u4eae\\u7684\\u7ffb\\u8eab\\u4ed7\\u4e5f\\u4e0d\\u662f\\u6ca1\\u6709\\u53ef\\u80fd\\u3002\",\"url\":\"http:\\/\\/project.weiphp.cn\\/paiqian\\/index.php?s=\\/Home\\/Material\\/news_detail\\/id\\/12.html\",\"picurl\":\"http:\\/\\/project.weiphp.cn\\/paiqian\\/Uploads\\/Picture\\/2015-12-13\\/566d247223b7a.jpg\"}]},\"touser\":\"oOqnfslWuN797-U456agliRgBxh8\",\"msgtype\":\"news\"}', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('34', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453290005', null, null, '{\"news\":{\"articles\":[{\"title\":\"\\u5feb\\u9012\\u5305\\u88f9\\uff1a\\u4e2d\\u56fd\\u90ae\\u653f\\u6e29\\u67d4\\u7684\\u8fdb\\u51fb\\u4e4b\\u4e3e\",\"description\":\"\\u6709\\u9274\\u4e8e\\u6b64\\uff0c\\u6240\\u4ee5\\u8bf4\\uff0c\\u5373\\u4fbf\\u4e00\\u7ebf\\u57ce\\u5e02\\u5df2\\u7ecf\\u6ca1\\u6709\\u5e02\\u573a\\uff0c\\u7eb5\\u4f7f\\u4e0d\\u53bb\\u6536\\u201c\\u4efd\\u5b50\\u94b1\\u201d\\uff0c\\u57fa\\u4e8e\\u73b0\\u6709\\u7684\\u4f18\\u52bf\\uff0c\\u518d\\u5145\\u5206\\u5229\\u7528\\u5360\\u636e\\u7684\\u5404\\u79cd\\u8d44\\u6e90\\uff0c\\u501f\\u52a9\\u56fd\\u5bb6\\u5f53\\u4e0b\\u201c\\u4e92\\u8054\\u7f51+\\u519c\\u6751\\u201d\\u3001\\u201c\\u4e92\\u8054\\u7f51+\\u5916\\u8d38\\u201d\\u7684\\u653f\\u7b56\\u5927\\u52bf\\uff0c\\u90ae\\u653f\\u6253\\u4e00\\u573a\\u6f02\\u4eae\\u7684\\u7ffb\\u8eab\\u4ed7\\u4e5f\\u4e0d\\u662f\\u6ca1\\u6709\\u53ef\\u80fd\\u3002\",\"url\":\"http:\\/\\/project.weiphp.cn\\/paiqian\\/index.php?s=\\/Home\\/Material\\/news_detail\\/id\\/12.html\",\"picurl\":\"http:\\/\\/project.weiphp.cn\\/paiqian\\/Uploads\\/Picture\\/2015-12-13\\/566d247223b7a.jpg\"}]},\"touser\":\"oOqnfslWuN797-U456agliRgBxh8\",\"msgtype\":\"news\"}', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('35', 'gh_1784a6c712f0', 'oOqnfslWuN797-U456agliRgBxh8', '1453290519', null, null, '你好，正在转接客服中', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('36', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', '1453337408', null, null, '你好，正在转接客服中', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('37', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', '1453337413', null, null, '客服\r\n客服1\r\n客服2\r\n客服3', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('38', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', '1453337421', 'text', '6242036693650723584', '03', null, null, null, null, null, null, null, '0', '0', '0', '0', '0');
INSERT INTO `wx_weixin_message` VALUES ('39', 'gh_1784a6c712f0', 'oOqnfslfFegs_2AltHLkKJzUEOQQ', '1453337421', null, null, '你好，正在转接客服中', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('40', 'gh_1784a6c712f0', 'oOqnfsndP_9AK7lFNvNdBomJCBaQ', '1453429604', null, null, '客服\r\n客服1\r\n客服2\r\n客服3', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('41', 'gh_1784a6c712f0', 'oOqnfsndP_9AK7lFNvNdBomJCBaQ', '1453429609', null, null, '你好，正在转接客服中', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('42', 'gh_1784a6c712f0', 'oOqnfsndP_9AK7lFNvNdBomJCBaQ', '1453429740', null, null, '你好，正在转接客服中', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('43', 'gh_1784a6c712f0', 'oOqnfslx8hllSt1Rcr8CSOMi4tbw', '1453796651', null, null, '你好，正在转接客服中', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('44', 'gh_1784a6c712f0', 'oOqnfslx8hllSt1Rcr8CSOMi4tbw', '1453796651', null, null, '客服\r\n客服1\r\n客服2\r\n客服3', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('45', 'gh_1784a6c712f0', 'oOqnfsnMVEvRBN-VANZlkkLIvQ_c', '1455865511', null, null, '客服\r\n客服1\r\n客服2\r\n客服3', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');
INSERT INTO `wx_weixin_message` VALUES ('46', 'gh_1784a6c712f0', 'oOqnfsnMVEvRBN-VANZlkkLIvQ_c', '1455865518', null, null, '你好，正在转接客服中', null, null, null, null, null, null, null, '0', '0', '1', '1', '0');

-- ----------------------------
-- Table structure for `wx_wish_card`
-- ----------------------------
DROP TABLE IF EXISTS `wx_wish_card`;
CREATE TABLE `wx_wish_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `send_name` varchar(255) DEFAULT NULL COMMENT '发送人',
  `receive_name` varchar(255) DEFAULT NULL COMMENT '接收人',
  `content` text COMMENT '祝福语',
  `create_time` int(10) DEFAULT NULL COMMENT ' 创建时间',
  `template` char(50) DEFAULT NULL COMMENT '模板',
  `template_cate` varchar(255) DEFAULT NULL COMMENT '模板分类',
  `read_count` int(10) DEFAULT '0' COMMENT '浏览次数',
  `mid` varchar(255) DEFAULT NULL COMMENT '用户Id',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_wish_card
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_wish_card_content`
-- ----------------------------
DROP TABLE IF EXISTS `wx_wish_card_content`;
CREATE TABLE `wx_wish_card_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `content_cate_id` int(10) DEFAULT '0' COMMENT '祝福语类别Id',
  `content` text COMMENT '祝福语',
  `content_cate` varchar(255) DEFAULT NULL COMMENT '类别',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_wish_card_content
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_wish_card_content_cate`
-- ----------------------------
DROP TABLE IF EXISTS `wx_wish_card_content_cate`;
CREATE TABLE `wx_wish_card_content_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `content_cate_name` varchar(255) DEFAULT NULL COMMENT '祝福语类别',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `content_cate_icon` int(10) unsigned DEFAULT NULL COMMENT '类别图标',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_wish_card_content_cate
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_xdlog`
-- ----------------------------
DROP TABLE IF EXISTS `wx_xdlog`;
CREATE TABLE `wx_xdlog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid_int` int(11) NOT NULL,
  `biztitle` text,
  `biztype` int(11) NOT NULL DEFAULT '0',
  `opttime` bigint(20) DEFAULT NULL,
  `xd` bigint(20) DEFAULT NULL,
  `sceneid` bigint(20) DEFAULT '0',
  `remark` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_xdlog
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_xydzp`
-- ----------------------------
DROP TABLE IF EXISTS `wx_xydzp`;
CREATE TABLE `wx_xydzp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `end_date` int(10) DEFAULT NULL COMMENT '结束日期',
  `cTime` int(10) DEFAULT NULL COMMENT '活动创建时间',
  `states` char(10) DEFAULT '0' COMMENT '活动状态',
  `picurl` int(10) unsigned DEFAULT NULL COMMENT '封面图片',
  `title` varchar(255) DEFAULT NULL COMMENT '活动标题',
  `guiz` text COMMENT '活动规则',
  `choujnum` int(10) unsigned DEFAULT '0' COMMENT '每日抽奖次数',
  `des` text COMMENT '活动介绍',
  `des_jj` text COMMENT '活动介绍',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `start_date` int(10) DEFAULT NULL COMMENT '开始时间',
  `experience` int(10) DEFAULT '0' COMMENT '消耗经验值',
  `background` int(10) unsigned DEFAULT NULL COMMENT '背景图',
  `template` varchar(255) DEFAULT 'default' COMMENT '素材模板',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_xydzp
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_xydzp_jplist`
-- ----------------------------
DROP TABLE IF EXISTS `wx_xydzp_jplist`;
CREATE TABLE `wx_xydzp_jplist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `gailv` int(10) unsigned DEFAULT '0' COMMENT '中奖概率',
  `gailv_str` varchar(255) DEFAULT NULL COMMENT '参数',
  `xydzp_id` int(10) unsigned DEFAULT '0' COMMENT '幸运大转盘关联的活动id',
  `jlnum` int(10) unsigned DEFAULT '1' COMMENT '奖励数量',
  `type` char(50) DEFAULT '0' COMMENT '奖品中奖方式',
  `gailv_maxnum` int(10) unsigned DEFAULT '0' COMMENT '单日发放上限',
  `xydzp_option_id` int(10) unsigned DEFAULT NULL COMMENT '幸运大转盘关联的全局奖品id',
  PRIMARY KEY (`id`),
  KEY `xydzp_id` (`xydzp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_xydzp_jplist
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_xydzp_log`
-- ----------------------------
DROP TABLE IF EXISTS `wx_xydzp_log`;
CREATE TABLE `wx_xydzp_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` varchar(255) DEFAULT NULL COMMENT '用户openid',
  `message` text COMMENT '留言',
  `address` text COMMENT '收件地址',
  `iphone` varchar(255) DEFAULT NULL COMMENT '电话',
  `zip` int(10) unsigned DEFAULT NULL COMMENT '邮编',
  `state` tinyint(2) DEFAULT '0' COMMENT '领奖状态',
  `xydzp_option_id` int(10) unsigned DEFAULT '0' COMMENT '奖品id',
  `xydzp_id` int(10) unsigned DEFAULT '0' COMMENT '活动id',
  `zjdate` int(10) unsigned DEFAULT NULL COMMENT '中奖时间',
  PRIMARY KEY (`id`),
  KEY `xydzp_id` (`uid`,`xydzp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_xydzp_log
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_xydzp_option`
-- ----------------------------
DROP TABLE IF EXISTS `wx_xydzp_option`;
CREATE TABLE `wx_xydzp_option` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `jptype` char(10) DEFAULT '0' COMMENT '奖品类型',
  `duijma` text COMMENT '兑奖码',
  `title` varchar(255) DEFAULT NULL COMMENT '奖品名称',
  `pic` int(10) unsigned DEFAULT NULL COMMENT '奖品图片',
  `miaoshu` text COMMENT '奖品描述',
  `num` int(10) unsigned DEFAULT '0' COMMENT '库存数量',
  `isdf` tinyint(2) DEFAULT '0' COMMENT '是否为谢谢惠顾类',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `coupon_id` int(10) DEFAULT NULL COMMENT '优惠券编号',
  `experience` int(10) DEFAULT '0' COMMENT '奖励经验值',
  `card_url` varchar(255) DEFAULT NULL COMMENT '领取卡券的地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_xydzp_option
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_xydzp_userlog`
-- ----------------------------
DROP TABLE IF EXISTS `wx_xydzp_userlog`;
CREATE TABLE `wx_xydzp_userlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` varchar(255) DEFAULT NULL COMMENT '用户id',
  `xydzp_id` int(10) unsigned DEFAULT NULL COMMENT '幸运大转盘关联的活动id',
  `num` int(10) unsigned DEFAULT '0' COMMENT '已经抽奖的次数',
  `cjdate` int(10) DEFAULT NULL COMMENT '抽奖日期',
  PRIMARY KEY (`id`),
  KEY `xydzp_id` (`uid`,`xydzp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_xydzp_userlog
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_youaskservice_behavior`
-- ----------------------------
DROP TABLE IF EXISTS `wx_youaskservice_behavior`;
CREATE TABLE `wx_youaskservice_behavior` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `fid` int(11) DEFAULT NULL,
  `token` varchar(60) DEFAULT NULL,
  `openid` varchar(60) DEFAULT NULL,
  `date` varchar(11) DEFAULT NULL,
  `enddate` int(11) DEFAULT NULL,
  `model` varchar(60) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `keyword` varchar(60) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_youaskservice_behavior
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_youaskservice_group`
-- ----------------------------
DROP TABLE IF EXISTS `wx_youaskservice_group`;
CREATE TABLE `wx_youaskservice_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `groupname` varchar(255) DEFAULT NULL COMMENT '分组名称',
  `groupdata` text COMMENT '分组数据源',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_youaskservice_group
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_youaskservice_keyword`
-- ----------------------------
DROP TABLE IF EXISTS `wx_youaskservice_keyword`;
CREATE TABLE `wx_youaskservice_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `msgkeyword` varchar(555) DEFAULT NULL COMMENT '消息关键字',
  `msgkeyword_type` char(50) DEFAULT '3' COMMENT '关键字类型',
  `msgkfaccount` varchar(255) DEFAULT NULL COMMENT '接待的客服人员',
  `cTime` int(10) DEFAULT NULL COMMENT '创建时间',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `msgstate` tinyint(2) DEFAULT '1' COMMENT '关键字状态',
  `zjnum` int(10) DEFAULT NULL COMMENT '转接次数',
  `zdtype` char(10) DEFAULT '0' COMMENT '指定类型',
  `kfgroupid` int(10) DEFAULT '0' COMMENT '客服分组id',
  `appmsg_id` int(10) DEFAULT NULL COMMENT '图文素材',
  `image_id` int(10) DEFAULT NULL COMMENT '素材图片',
  `msg_test` varchar(255) DEFAULT NULL COMMENT '素材文本',
  `type` char(10) DEFAULT '1' COMMENT '自动回复类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_youaskservice_keyword
-- ----------------------------
INSERT INTO `wx_youaskservice_keyword` VALUES ('1', '01', '0', '100001@cnhrmo', '1453260468', 'gh_1784a6c712f0', '1', null, '0', '0', null, null, null, '1');
INSERT INTO `wx_youaskservice_keyword` VALUES ('2', '02', '0', '100002@cnhrmo', '1453260591', 'gh_1784a6c712f0', '1', null, '0', '0', null, null, null, '1');
INSERT INTO `wx_youaskservice_keyword` VALUES ('3', '03', '3', '001@cnhrmo', '1453290502', 'gh_1784a6c712f0', '1', null, '0', '0', '0', '0', '你好，正在转接客服中', '1');

-- ----------------------------
-- Table structure for `wx_youaskservice_logs`
-- ----------------------------
DROP TABLE IF EXISTS `wx_youaskservice_logs`;
CREATE TABLE `wx_youaskservice_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `pid` int(11) DEFAULT NULL,
  `openid` varchar(60) DEFAULT NULL,
  `enddate` int(11) DEFAULT NULL,
  `keyword` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_youaskservice_logs
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_youaskservice_user`
-- ----------------------------
DROP TABLE IF EXISTS `wx_youaskservice_user`;
CREATE TABLE `wx_youaskservice_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(60) DEFAULT NULL COMMENT '客服昵称',
  `token` varchar(60) DEFAULT NULL COMMENT 'token',
  `userName` varchar(60) DEFAULT NULL COMMENT '客服帐号',
  `userPwd` varchar(32) DEFAULT NULL COMMENT '客服密码',
  `endJoinDate` int(11) DEFAULT NULL COMMENT '客服加入时间',
  `status` tinyint(1) DEFAULT '0' COMMENT '客服在线状态',
  `state` tinyint(2) DEFAULT '0' COMMENT '客服状态',
  `isdelete` tinyint(2) DEFAULT '0' COMMENT '是否删除',
  `kfid` varchar(255) DEFAULT NULL COMMENT '客服编号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_youaskservice_user
-- ----------------------------
INSERT INTO `wx_youaskservice_user` VALUES ('14', 'koko', 'gh_1784a6c712f0', '100002@cnhrmo', null, null, '0', '0', '0', '1002');
INSERT INTO `wx_youaskservice_user` VALUES ('13', '001', 'gh_1784a6c712f0', '001@cnhrmo', null, null, '0', '0', '0', '1003');
INSERT INTO `wx_youaskservice_user` VALUES ('8', '01', 'gh_be33dc482e19', '001@szhrmo', null, null, '0', '0', '0', '1001');
INSERT INTO `wx_youaskservice_user` VALUES ('15', 'yoyo', 'gh_1784a6c712f0', '100001@cnhrmo', null, null, '0', '0', '0', '1001');

-- ----------------------------
-- Table structure for `wx_youaskservice_wechat_enddate`
-- ----------------------------
DROP TABLE IF EXISTS `wx_youaskservice_wechat_enddate`;
CREATE TABLE `wx_youaskservice_wechat_enddate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `openid` varchar(60) DEFAULT NULL,
  `enddate` int(11) DEFAULT NULL,
  `joinUpDate` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `token` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_youaskservice_wechat_enddate
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_youaskservice_wechat_grouplist`
-- ----------------------------
DROP TABLE IF EXISTS `wx_youaskservice_wechat_grouplist`;
CREATE TABLE `wx_youaskservice_wechat_grouplist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `g_id` varchar(20) DEFAULT NULL,
  `nickname` varchar(60) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `headimgurl` varchar(200) DEFAULT NULL,
  `subscribe_time` int(11) DEFAULT NULL,
  `token` varchar(30) DEFAULT NULL,
  `openid` varchar(60) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_youaskservice_wechat_grouplist
-- ----------------------------

-- ----------------------------
-- Table structure for `wx_youaskservice_wxlogs`
-- ----------------------------
DROP TABLE IF EXISTS `wx_youaskservice_wxlogs`;
CREATE TABLE `wx_youaskservice_wxlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `opercode` int(10) DEFAULT NULL COMMENT '会话状态',
  `text` text COMMENT '消息',
  `time` int(10) DEFAULT NULL COMMENT '时间',
  `openid` varchar(255) DEFAULT NULL COMMENT 'openid',
  `token` varchar(255) DEFAULT NULL COMMENT 'token',
  `worker` varchar(255) DEFAULT NULL COMMENT '客服名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_youaskservice_wxlogs
-- ----------------------------
