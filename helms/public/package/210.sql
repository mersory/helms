
INSERT INTO `mip_settings`  VALUES  ('33', 'tagModelName', '标签'), ('34', 'tagModelUrl', 'tag'), ('35', 'loginCaptcha', null), ('36', 'registerCaptcha', null), ('46', 'biaduZn', '12775452642328057043'), ('37', 'articleStatus', '1'), ('38', 'askStatus', ''), ('39', 'aritcleLevelRemove', ''), ('40', 'askLevelRemove', ''), ('41', 'articleDomain', ''), ('42', 'askDomain', ''), ('43', 'superSites', ''), ('47', 'rewrite', ''), ('44', 'topDomain', 'test.com'), ('45', 'superTpl', ''), ('48', 'diyUrlStatus', ''), ('49', 'urlApiAddress', null), ('50', 'mipPostStatus', ''), ('52', 'mipTemplate', 'default'), ('51', 'articlePagesNum', '1000');



ALTER TABLE `mip_articles_category` ADD `seo_title`  varchar(255) DEFAULT NULL;
ALTER TABLE `mip_item_tags` ADD `item_add_time`  int(11) DEFAULT NULL;


ALTER TABLE `mip_tags` ADD `relevance_num` int(11) DEFAULT NULL COMMENT '关联数量';
ALTER TABLE `mip_tags` ADD `creator_uid`  char(24) DEFAULT NULL COMMENT '标签的创建者';
ALTER TABLE `mip_tags` ADD `add_time` int(11) DEFAULT NULL;
ALTER TABLE `mip_tags` ADD `description`  varchar(255) DEFAULT NULL;
ALTER TABLE `mip_item_tags`  modify column `id` char(24) NOT NULL;
ALTER TABLE `mip_item_tags`  modify column `item_id` char(24) DEFAULT NULL;
ALTER TABLE `mip_item_tags`  modify column `tags_id` char(24) DEFAULT NULL;
ALTER TABLE `mip_tags`  modify column `id` char(24) NOT NULL;


ALTER TABLE `mip_articles` ADD `url_name`  varchar(255) DEFAULT NULL;



-- ----------------------------
--  Table structure for `mip_asks_setting`
-- ----------------------------
DROP TABLE IF EXISTS `mip_asks_setting`;
CREATE TABLE `mip_asks_setting` (
  `key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `val` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`key`),
  KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `mip_asks_setting`
-- ----------------------------
BEGIN;
INSERT INTO `mip_asks_setting` VALUES ('askPublishName', '提问'), ('askPublishStatus', '1'), ('askPublishUserNumDay', '15'), ('askPublishUserTime', '5'), ('askPublishUserIntegral', '1'), ('answerStatus', '1'), ('answerShowNum', '20'), ('askDomain', null), ('answerUserNum', '1');
COMMIT;



--
-- 版本更新 每个版本都有
--

--
-- 更新当前版本
--
UPDATE `mip_settings` SET `val` = '210' WHERE `key` = 'localCurrentVersionNum';

--
-- 更新当前版本副本
--
UPDATE `mip_settings` SET `val` = 'v2.1.0' WHERE `key` = 'localCurrentVersion';

UPDATE `mip_settings` SET `val` = 'http://' WHERE `id` = '30';

UPDATE `mip_settings` SET `key` = 'httpType' WHERE `id` = '30';
