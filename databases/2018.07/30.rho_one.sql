-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-07-30 15:41:05
-- 服务器版本： 8.0.12
-- PHP Version: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rho.one`
--
CREATE DATABASE IF NOT EXISTS `rho.one` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rho.one`;

-- --------------------------------------------------------

--
-- 表的结构 `crawl_library_tongjiuniversity_item`
--
-- 创建时间： 2018-07-30 04:53:24
-- 最后更新： 2018-07-30 04:53:25
--

DROP TABLE IF EXISTS `crawl_library_tongjiuniversity_item`;
CREATE TABLE IF NOT EXISTS `crawl_library_tongjiuniversity_item` (
  `guid` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `marc_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `call_no` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `volume_period` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`guid`),
  KEY `tongjiuniversity_barcode_marc` (`marc_no`),
  KEY `barcode` (`barcode`),
  KEY `call_no` (`call_no`),
  KEY `create_time` (`create_time`),
  KEY `update_time` (`update_time`),
  KEY `position` (`position`),
  KEY `status` (`status`),
  KEY `volume_period` (`volume_period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `crawl_library_tongjiuniversity_item`
--

INSERT INTO `crawl_library_tongjiuniversity_item` (`guid`, `marc_no`, `call_no`, `barcode`, `volume_period`, `position`, `status`, `create_time`, `update_time`) VALUES
('11A540B4-42E5-81B8-4F91-F37D2EDB16E1', '0000903706', 'B979.2/Y724', '90057679', '2001', '人文学院分馆', '可借', '2016-04-07 17:42:29', '2016-04-07 17:42:29'),
('33B4E91D-21AC-D8D4-EF09-7A5ADC14913B', '0000812726', 'U448.272.5', '90076013', '2002', '土木学院桥梁系分馆', '可借', '2016-04-07 14:17:45', '2016-04-07 14:17:45'),
('46FE98C0-15EC-9C55-2DCF-0442E09C8D92', '0000896646', 'F766/S768', 'AU004877', '', '汽车学院分馆', '可借', '2016-04-07 16:37:30', '2016-04-07 16:37:30'),
('961D1523-ED90-F36F-4CCF-881934A621FE', '0000904053', 'I246.5/C429', '02176975', '', '古籍与特藏文献研究室', '阅览', '2016-04-07 17:45:33', '2016-04-07 17:45:33'),
('D8EE0201-9069-BE24-5081-D876862CAEE3', '0000896646', 'F766/S768', 'AU004893', '', '汽车学院分馆', '可借', '2016-04-07 16:37:30', '2016-04-07 16:37:30'),
('FD9DA81B-EEDC-06B1-DD05-60C75BE36816', '0000868389', 'TU-856/ZL587', '90090487', '2001', '设计创意学院', '可借', '2016-04-07 16:56:37', '2016-04-07 16:56:37');

-- --------------------------------------------------------

--
-- 表的结构 `crawl_library_tongjiuniversity_marc`
--
-- 创建时间： 2018-07-30 04:53:25
-- 最后更新： 2018-07-30 04:53:26
--

DROP TABLE IF EXISTS `crawl_library_tongjiuniversity_marc`;
CREATE TABLE IF NOT EXISTS `crawl_library_tongjiuniversity_marc` (
  `guid` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `marc_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ISBN` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `press` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `form` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `uniform_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `disc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `author` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_author` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `general_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `version_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abstract` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_reader` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`guid`),
  KEY `marc_no` (`marc_no`),
  KEY `create_time` (`create_time`),
  KEY `update_time` (`update_time`),
  KEY `class` (`class`),
  KEY `press` (`press`),
  KEY `form` (`form`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `crawl_library_tongjiuniversity_marc`
--

INSERT INTO `crawl_library_tongjiuniversity_marc` (`guid`, `marc_no`, `ISBN`, `title`, `price`, `press`, `form`, `uniform_title`, `additional_title`, `disc`, `author`, `group_author`, `subject`, `class`, `general_remark`, `version_remark`, `publish_remark`, `author_remark`, `abstract`, `target_reader`, `create_time`, `update_time`) VALUES
('1B068F9E-CB81-C236-9089-A881685F398C', '0000904053', '', '再見，冷荇!', '', '[\"\\u4e0a\\u6d77\\u5927\\u6771\\u66f8\\u5c40\\u4e2d\\u83ef\\u6c11\\u570b\\u4e09\\u5341\\u4e94\\u5e74 [1946]\"]', '[\"172\\u987519cm\"]', '', '', '', '[\"\\u9648\\u94e8\\u8457\"]', '', '[\"\\u4e2d\\u7bc7\\u5c0f\\u8bf4\\u4e2d\\u56fd\\u73b0\\u4ee3\"]', '[\"I246.5\",\"K827\"]', '', '', '', '', '', '', '2016-04-07 17:45:33', '2016-04-07 17:45:33'),
('1CCA29CF-5FA7-D8E8-B581-B1915F80EEDA', '0000903706', '[\"7-200-04335-4\"]', '早期西方传教士与北京', '[\"CNY22.00\"]', '[\"\\u5317\\u4eac\\u5317\\u4eac\\u51fa\\u7248\\u793e2001\"]', '[\"400\\u9875\\u56fe21cm\"]', '', '', '', '[\"\\u4f59\\u4e09\\u4e50,1948-\\u8457\"]', '', '[\"\\u8036\\u7a23\\u4f1a\\u4f20\\u6559\\u58eb\\u751f\\u5e73\\u4e8b\\u8ff9\\u897f\\u65b9\\u56fd\\u5bb617-18\\u4e16\\u7eaa\",\"\\u4e1c\\u897f\\u6587\\u5316\\u6587\\u5316\\u4ea4\\u6d41\\u7814\\u7a76\\u4e2d\\u56fd\\u3001\\u897f\\u65b9\\u56fd\\u5bb6\\u660e\\u6e05\\u65f6\\u4ee3(1368-1911)\"]', '[\"B979.95\",\"K203\",\"B979.2\"]', '', '', '', '', '', '', '2016-04-07 17:42:29', '2016-04-07 17:42:29'),
('346E732C-5650-0F12-53FF-EB2F01D7A7CD', '0000812726', '[\"7-114-04300-7\"]', '斜拉桥', '[\"CNY50.00\"]', '[\"\\u5317\\u4eac\\u4eba\\u6c11\\u4ea4\\u901a\\u51fa\\u7248\\u793e2002\"]', '[\"396\\u9875\\u56fe26cm\"]', '[\"Cable stayed bridge\"]', '', '', '[\"\\u5218\\u58eb\\u6797(\\u6865\\u6db5\\u5de5\\u7a0b)\"]', '', '[\"\\u659c\\u62c9\\u6865\\u8bbe\\u8ba1\"]', '[\"U448.272.5\"]', '', '', '', '[\"\\u9898\\u540d\\u9875\\u9898: \\u5218\\u58eb\\u6797, \\u6881\\u667a\\u6d9b, \\u4faf\\u91d1\\u9f99, \\u5b5f\\u51e1\\u8d85\\u4e3b\\u7f16\"]', '', '', '2016-04-07 14:17:45', '2016-04-07 14:17:45'),
('669FD56B-1352-E9C9-1894-01BE389EBCED', '0000896646', '[\"7-04-016745-X\"]', '汽车及配件营销', '[\"CNY18.80\"]', '[\"\\u5317\\u4eac\\u9ad8\\u7b49\\u6559\\u80b2\\u51fa\\u7248\\u793e2005\"]', '[\"226\\u9875\\u56fe23cm\"]', '', '', '', '[\"\\u5b59\\u51e4\\u82f1\\u4e3b\\u7f16\",\"\\u8881\\u4fca\\u5947\\u4e3b\\u7f16\"]', '', '[\"\\u6c7d\\u8f66\\u5e02\\u573a\\u8425\\u9500\\u5b66\\u9ad8\\u7b49\\u6559\\u80b2\\u6559\\u6750\",\"\\u6c7d\\u8f66\\u914d\\u4ef6\\u5e02\\u573a\\u8425\\u9500\\u5b66\\u9ad8\\u7b49\\u6559\\u80b2\\u6559\\u6750\"]', '[\"F766\",\"F407.471.5\"]', '', '', '', '', '本书是一部高等职业学校汽车及配件营销教材，全书共两篇：汽车营销，汽车配件营销。包括：汽车市场营销环境分析、汽车产品购买行为分析、汽车市场营销调研与市场预测等内容。', '高职高专汽车运用与维修专业学生，汽车及配件营销人员', '2016-04-07 16:37:30', '2016-04-07 16:37:30'),
('D497CE9C-5A98-0681-FB52-B02C927DFE87', '0000868389', '[\"7-5080-2427-3\"]', '城市意象', '[\"CNY26.00\"]', '[\"\\u5317\\u4eac\\u534e\\u590f\\u51fa\\u7248\\u793e2001\"]', '[\"150\\u9875\\u56fe, \\u5730\\u56fe24cm\"]', '[\"The image of the city\"]', '', '', '[\"\\u6797\\u5947(Lynch, Kevin),1918-1984\\u8457\"]', '', '[\"\\u57ce\\u5e02\\u89c4\\u5212\",\"\\u57ce\\u5e02\\u5efa\\u7b51\\u8bbe\\u8ba1\",\"\\u57ce\\u5e02\\u666f\\u89c2\\u73af\\u5883\\u8bbe\\u8ba1\\u7f8e\\u56fd \"]', '[\"TU984\",\"TU-856\",\"TU984.712\"]', '', '', '', '', '', '', '2016-04-07 16:56:37', '2016-04-07 16:56:37');

-- --------------------------------------------------------

--
-- 表的结构 `extension`
--
-- 创建时间： 2018-07-30 04:53:26
--

DROP TABLE IF EXISTS `extension`;
CREATE TABLE IF NOT EXISTS `extension` (
  `guid` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Extension GUID',
  `id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Extension ID',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Extension Name',
  `classname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'classname',
  `config_array` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Configuration Array',
  `enabled` bit(1) NOT NULL DEFAULT b'0' COMMENT 'Enabled',
  `monopolized` bit(1) NOT NULL DEFAULT b'0' COMMENT 'Monopolized',
  `default` bit(1) NOT NULL DEFAULT b'0' COMMENT 'Default',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Create Time',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Update Time',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Description',
  PRIMARY KEY (`guid`),
  UNIQUE KEY `extension_classname_unique` (`classname`) USING BTREE,
  UNIQUE KEY `extension_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `headword`
--
-- 创建时间： 2018-07-30 04:53:26
--

DROP TABLE IF EXISTS `headword`;
CREATE TABLE IF NOT EXISTS `headword` (
  `guid` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Headword GUID',
  `word` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Headword',
  `extension_guid` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Extension GUID',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Create Time',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Update Time',
  PRIMARY KEY (`guid`),
  UNIQUE KEY `headword_extension_unique` (`word`,`extension_guid`),
  KEY `headword_extension_fkey` (`extension_guid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `server`
--
-- 创建时间： 2018-07-30 04:53:27
--

DROP TABLE IF EXISTS `server`;
CREATE TABLE IF NOT EXISTS `server` (
  `guid` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Server GUID',
  `id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Server ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Server Name',
  `endpoint` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Endpoint',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Create Time',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Create Time',
  PRIMARY KEY (`guid`),
  UNIQUE KEY `server_id_unique` (`id`),
  UNIQUE KEY `server_endpoint_unique` (`endpoint`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `synonym`
--
-- 创建时间： 2018-07-30 04:53:27
--

DROP TABLE IF EXISTS `synonym`;
CREATE TABLE IF NOT EXISTS `synonym` (
  `guid` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Synonym GUID',
  `word` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Synonym',
  `headword_guid` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Headword GUID',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Create Time',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Update Time',
  PRIMARY KEY (`guid`),
  UNIQUE KEY `synonym_headword_unique` (`word`,`headword_guid`) USING BTREE,
  KEY `synonym_headword_fkey` (`headword_guid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--
-- 创建时间： 2018-07-30 04:53:27
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `guid` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass_hash` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ip_1` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ip_2` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ip_3` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ip_4` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ip_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '4',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `auth_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `access_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `source` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`guid`),
  UNIQUE KEY `user_id_unique` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 限制导出的表
--

--
-- 限制表 `crawl_library_tongjiuniversity_item`
--
ALTER TABLE `crawl_library_tongjiuniversity_item`
  ADD CONSTRAINT `tongjiuniversity_barcode_marc` FOREIGN KEY (`marc_no`) REFERENCES `crawl_library_tongjiuniversity_marc` (`marc_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `headword`
--
ALTER TABLE `headword`
  ADD CONSTRAINT `headword_extension_fkey` FOREIGN KEY (`extension_guid`) REFERENCES `extension` (`guid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `synonym`
--
ALTER TABLE `synonym`
  ADD CONSTRAINT `synonym_headword_fkey` FOREIGN KEY (`headword_guid`) REFERENCES `headword` (`guid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
