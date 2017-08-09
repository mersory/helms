  
INSERT INTO `mip_settings`  VALUES  ('53', 'urlCategory', '');
INSERT INTO `mip_settings`  VALUES  ('54', 'urlPageBreak', '_');
INSERT INTO `mip_settings`  VALUES  ('55', 'baiduSearchPcUrl', '');
INSERT INTO `mip_settings`  VALUES  ('56', 'baiduSearchMUrl', '');
INSERT INTO `mip_settings`  VALUES  ('57', 'baiduYuanChuangUrl', '');
INSERT INTO `mip_settings`  VALUES  ('58', 'baiduTimePcUrl', '');
INSERT INTO `mip_settings`  VALUES  ('59', 'baiduTimeMUrl', '');
INSERT INTO `mip_settings`  VALUES  ('60', 'publishTime', '');
INSERT INTO `mip_settings`  VALUES  ('61', 'baiduYuanChuangStatus', '');
INSERT INTO `mip_settings`  VALUES  ('62', 'baiduTimePcStatus', '');
INSERT INTO `mip_settings`  VALUES  ('63', 'baiduTimeMStatus', '');
--
-- 版本更新 每个版本都有
--

--
-- 更新当前版本
--
UPDATE `mip_settings` SET `val` = '211' WHERE `key` = 'localCurrentVersionNum';

--
-- 更新当前版本副本
--
UPDATE `mip_settings` SET `val` = 'v2.1.1' WHERE `key` = 'localCurrentVersion';
  