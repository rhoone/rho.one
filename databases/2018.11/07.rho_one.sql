-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2018-11-07 04:40:20
-- 服务器版本： 8.0.13
-- PHP 版本： 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `rho.one`
--
CREATE DATABASE IF NOT EXISTS `rho.one` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rho.one`;

-- --------------------------------------------------------

--
-- 表的结构 `crawl_library_tongjiuniversity_item`
--
-- 创建时间： 2018-08-12 13:40:27
-- 最后更新： 2018-11-06 15:14:57
--

DROP TABLE IF EXISTS `crawl_library_tongjiuniversity_item`;
CREATE TABLE IF NOT EXISTS `crawl_library_tongjiuniversity_item` (
  `guid` varbinary(16) NOT NULL COMMENT 'GUID',
  `marc_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `call_no` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `barcode` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `volume_period` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Create Time',
  `updated_at` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Update Time',
  PRIMARY KEY (`guid`),
  KEY `tongjiuniversity_barcode_marc` (`marc_no`),
  KEY `barcode` (`barcode`),
  KEY `call_no` (`call_no`),
  KEY `create_time` (`created_at`),
  KEY `update_time` (`updated_at`),
  KEY `position` (`position`),
  KEY `status` (`status`),
  KEY `volume_period` (`volume_period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 表的关系 `crawl_library_tongjiuniversity_item`:
--   `marc_no`
--       `crawl_library_tongjiuniversity_marc` -> `marc_no`
--

-- --------------------------------------------------------

--
-- 表的结构 `crawl_library_tongjiuniversity_marc`
--
-- 创建时间： 2018-08-12 15:18:46
--

DROP TABLE IF EXISTS `crawl_library_tongjiuniversity_marc`;
CREATE TABLE IF NOT EXISTS `crawl_library_tongjiuniversity_marc` (
  `guid` varbinary(16) NOT NULL COMMENT 'GUID',
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
  `created_at` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Create Time',
  `updated_at` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Update Time',
  PRIMARY KEY (`guid`),
  KEY `marc_no` (`marc_no`),
  KEY `create_time` (`created_at`),
  KEY `update_time` (`updated_at`),
  KEY `class` (`class`),
  KEY `press` (`press`),
  KEY `form` (`form`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 表的关系 `crawl_library_tongjiuniversity_marc`:
--

-- --------------------------------------------------------

--
-- 表的结构 `crawl_library_tongjiuniversity_status`
--
-- 创建时间： 2018-11-06 20:14:46
--

DROP TABLE IF EXISTS `crawl_library_tongjiuniversity_status`;
CREATE TABLE IF NOT EXISTS `crawl_library_tongjiuniversity_status` (
  `guid` varbinary(16) NOT NULL COMMENT 'GUID',
  `marc_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'MARC编号',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'MARC状态',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文献类型',
  `page_visit` int(255) UNSIGNED NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `created_at` datetime NOT NULL COMMENT 'Created At',
  `updated_at` datetime NOT NULL COMMENT 'Updated At',
  PRIMARY KEY (`guid`),
  KEY `tongjiuniversity_status_marc` (`marc_no`),
  KEY `page_visit` (`page_visit`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `type` (`type`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 表的关系 `crawl_library_tongjiuniversity_status`:
--   `marc_no`
--       `crawl_library_tongjiuniversity_marc` -> `marc_no`
--

-- --------------------------------------------------------

--
-- 表的结构 `extension`
--
-- 创建时间： 2018-08-12 16:24:38
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

--
-- 表的关系 `extension`:
--

-- --------------------------------------------------------

--
-- 表的结构 `headword`
--
-- 创建时间： 2018-08-12 16:24:39
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

--
-- 表的关系 `headword`:
--   `extension_guid`
--       `extension` -> `guid`
--

-- --------------------------------------------------------

--
-- 表的结构 `server`
--
-- 创建时间： 2018-08-12 16:24:39
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

--
-- 表的关系 `server`:
--

-- --------------------------------------------------------

--
-- 表的结构 `synonym`
--
-- 创建时间： 2018-08-12 16:24:40
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

--
-- 表的关系 `synonym`:
--   `headword_guid`
--       `headword` -> `guid`
--

-- --------------------------------------------------------

--
-- 表的结构 `user`
--
-- 创建时间： 2018-08-12 16:24:40
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
-- 表的关系 `user`:
--

--
-- 限制导出的表
--

--
-- 限制表 `crawl_library_tongjiuniversity_item`
--
ALTER TABLE `crawl_library_tongjiuniversity_item`
  ADD CONSTRAINT `tongjiuniversity_barcode_marc` FOREIGN KEY (`marc_no`) REFERENCES `crawl_library_tongjiuniversity_marc` (`marc_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `crawl_library_tongjiuniversity_status`
--
ALTER TABLE `crawl_library_tongjiuniversity_status`
  ADD CONSTRAINT `tongjiuniversity_status_marc` FOREIGN KEY (`marc_no`) REFERENCES `crawl_library_tongjiuniversity_marc` (`marc_no`) ON DELETE CASCADE ON UPDATE CASCADE;

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
