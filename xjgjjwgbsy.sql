-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `api_user`;
CREATE TABLE `api_user` (
  `api_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `api_user_name` varchar(60) NOT NULL,
  `api_user_mname` varchar(60) NOT NULL,
  `api_user_lname` varchar(60) NOT NULL,
  `api_user_email` varchar(250) NOT NULL,
  `api_user_password` varchar(250) NOT NULL,
  `thumbnail` varchar(250) NOT NULL,
  `phone` varchar(80) NOT NULL,
  `address` varchar(400) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `api_start_date` date NOT NULL,
  `access_typ` enum('FULL','ROUTE','OPERATOR') NOT NULL DEFAULT 'FULL',
  `payment_typ` enum('PRE','POST') NOT NULL DEFAULT 'PRE',
  `wallet_balance` decimal(9,2) NOT NULL,
  `api_key` varchar(250) NOT NULL,
  `api_salt` varchar(250) NOT NULL,
  `insert_date` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0-pending 1-active',
  PRIMARY KEY (`api_user_id`),
  UNIQUE KEY `api_user_email` (`api_user_email`),
  UNIQUE KEY `api_key` (`api_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `api_user` (`api_user_id`, `api_user_name`, `api_user_mname`, `api_user_lname`, `api_user_email`, `api_user_password`, `thumbnail`, `phone`, `address`, `company_name`, `api_start_date`, `access_typ`, `payment_typ`, `wallet_balance`, `api_key`, `api_salt`, `insert_date`, `status`) VALUES
(3,	'Super Admin',	'',	'',	'ecom@gmail.com',	'e6e061838856bf47e1de730719fb2609',	'',	'',	'',	'',	'2021-03-01',	'FULL',	'PRE',	0.00,	'Jk452yubyYPzs7dw0e',	'sIgTZQWmtEoka6XifU85jhgtrfdre',	'2021-03-19 19:52:49',	1);

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bnr_heading` varchar(300) NOT NULL,
  `readmore_url` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `alt_tag` varchar(300) NOT NULL,
  `bnr_img` varchar(300) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `del_status` int(1) NOT NULL DEFAULT 0,
  `sequence` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `banner` (`id`, `bnr_heading`, `readmore_url`, `description`, `alt_tag`, `bnr_img`, `status`, `del_status`, `sequence`, `created_on`, `modified_on`, `created_by`) VALUES
(1,	'Maa Ramachandi Temple',	'',	'',	'Maa Ramachandi Temple',	'Banner1.jpg',	1,	0,	0,	'2022-02-17 21:04:38',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(2,	'Maa Ramachandi Temple',	'',	'',	'Maa Ramachandi Temple',	'Banner2.jpg',	1,	0,	0,	'2022-02-17 21:05:13',	'0000-00-00 00:00:00',	'Rt4rgd56');

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(300) NOT NULL,
  `slug_url` varchar(300) NOT NULL,
  `heading` text NOT NULL,
  `post_type` enum('Product','News') NOT NULL,
  `parent_id` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL DEFAULT 0,
  `post_img` text NOT NULL,
  `bg_img` text NOT NULL,
  `sml_dsc` text NOT NULL,
  `full_dsc` text NOT NULL,
  `sequence` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `is_featured` int(1) NOT NULL DEFAULT 0,
  `del_status` int(1) NOT NULL DEFAULT 0,
  `meta_title` varchar(300) NOT NULL,
  `meta_key` varchar(300) NOT NULL,
  `meta_desc` varchar(300) NOT NULL,
  `extra_meta` text NOT NULL,
  `canonical_code` text NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `category` (`id`, `cat_name`, `slug_url`, `heading`, `post_type`, `parent_id`, `subcat_id`, `post_img`, `bg_img`, `sml_dsc`, `full_dsc`, `sequence`, `status`, `is_featured`, `del_status`, `meta_title`, `meta_key`, `meta_desc`, `extra_meta`, `canonical_code`, `created_on`, `modified_on`, `created_by`) VALUES
(1,	'Single Relay',	'single-relay',	'',	'Product',	4,	0,	'service-1.jpg',	'',	'',	'',	1,	1,	1,	0,	'',	'',	'',	'',	'',	'2021-09-24 19:39:24',	'2021-10-12 20:22:15',	'Rt4rgd56'),
(2,	'Industrial Relay',	'industrial-relay',	'',	'Product',	4,	0,	'service-5.jpg',	'',	'',	'',	2,	1,	1,	0,	'',	'',	'',	'',	'',	'2021-09-24 19:40:07',	'2021-10-12 20:24:28',	'Rt4rgd56'),
(3,	'Automotive Relay',	'automotive-relay',	'',	'Product',	4,	0,	'service-3.jpg',	'',	'',	'',	3,	1,	1,	0,	'',	'',	'',	'',	'',	'2021-10-12 20:20:10',	'2021-10-12 20:24:41',	'Rt4rgd56'),
(4,	'Product',	'product',	'',	'Product',	0,	0,	'',	'',	'',	'',	0,	1,	0,	0,	'',	'',	'',	'',	'',	'2021-10-12 20:22:02',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(5,	'Single Phase SSR',	'single-phase-ssr',	'',	'Product',	4,	0,	'service-4.jpg',	'',	'',	'',	4,	1,	1,	0,	'',	'',	'',	'',	'',	'2021-10-12 20:25:20',	'2021-10-12 20:28:55',	'Rt4rgd56'),
(6,	'Three Phase SSR',	'three-phase-ssr',	'',	'Product',	4,	0,	'service-2.jpg',	'',	'',	'',	5,	1,	1,	0,	'',	'',	'',	'',	'',	'2021-10-12 20:32:10',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(7,	'Industrial SSR',	'industrial-ssr',	'',	'Product',	4,	0,	'service-5_20211012203714.jpg',	'',	'',	'',	6,	1,	1,	0,	'',	'',	'',	'',	'',	'2021-10-12 20:37:14',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(8,	'Energy',	'energy',	'',	'News',	0,	0,	'',	'',	'',	'',	1,	0,	0,	0,	'',	'',	'',	'',	'',	'2021-10-13 19:55:32',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(9,	'Industry News',	'industry',	'',	'News',	0,	0,	'',	'',	'',	'',	2,	1,	0,	0,	'',	'',	'',	'',	'',	'2021-10-13 19:55:50',	'2021-10-23 21:09:10',	'Rt4rgd56'),
(10,	'Company News',	'company',	'',	'News',	0,	0,	'',	'',	'',	'',	3,	1,	0,	0,	'',	'',	'',	'',	'',	'2021-10-13 19:56:02',	'2021-10-23 21:09:26',	'Rt4rgd56');

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` mediumblob NOT NULL,
  `inserttime` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(500) NOT NULL,
  `request_data` text NOT NULL COMMENT 'Json Data',
  `added_on` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `contacts` (`id`, `form_name`, `request_data`, `added_on`, `status`) VALUES
(2,	'Contact Us',	'{\"name\":\"Rintu\",\"phonenumber\":\"74858585855\",\"email\":\"admin@gmail.com\",\"subject\":\"Demo\",\"message\":\" This is a demo message only\",\"submit-form\":\"\"}',	'2021-06-19 09:01:51',	0),
(3,	'Quick Quote',	'{\"name\":\"Rintu\",\"email\":\"kajds@gmail.com\",\"phone\":\"788455422244\",\"submit-form\":\"\"}',	'2021-06-19 09:30:30',	0),
(4,	'Contact Us',	'{\"post_name\":\"Deer Under Tree\",\"name\":\"Rintu\",\"email\":\"abc@gmail.com\",\"phonenumber\":\"745455555\",\"subject\":\"Demo\",\"message\":\"This is demo only\"}',	'2021-06-19 10:52:47',	1),
(5,	'Product Enquiry Form',	'{\"name\":\"Chakra\",\"email\":\"admin1@gmail.com\",\"phonenumber\":\"7895652458\",\"product_nm\":\"Bear Fishing Door\",\"message\":\"This is a demo message\",\"btn_enquiry\":\"\"}',	'2021-07-02 19:14:06',	1),
(6,	'Product Enquiry Form',	'{\"name\":\"Rintu\",\"email\":\"admin1@gmail.com\",\"phonenumber\":\"7895652458\",\"product_nm\":\"Church Door\",\"message\":\"This is demo only.\",\"btn_enquiry\":\"\"}',	'2021-07-02 19:46:11',	1),
(7,	'Product Enquiry Form',	'{\"name\":\"Chakra\",\"email\":\"admin1@gmail.com\",\"phonenumber\":\"7895652458\",\"product_nm\":\"DEER TREE DOOR WITHOUT SIDELIGHTS\",\"message\":\"This is demo only\",\"btn_enquiry\":\"\"}',	'2021-07-02 19:51:23',	1),
(8,	'Quick Quote',	'{\"name\":\"Demo\",\"email\":\"kmg_space@yahoo.com\",\"phonenumber\":\"8547123654\"}',	'2021-07-14 23:34:14',	1),
(9,	'Contact Us',	'{\"name\":\"Demo\",\"email\":\"admin1@gmail.com\",\"phonenumber\":\"7895652458\",\"zip\":\"754154\",\"message\":\"This is a demo message.\",\"submit-form\":\"\"}',	'2021-10-23 22:34:06',	1),
(10,	'Enquiry Form',	'{\"product_nm\":\"HRT4100\",\"name\":\"Demo\",\"email\":\"admin1@gmail.com\",\"phonenumber\":\"7895652458\",\"subject\":\"Dmeo\",\"message\":\"This is a demo message.\",\"btn_enquiry\":\"\"}',	'2021-10-23 23:11:04',	1),
(11,	'Product Enquiry On HRT4078',	'{\"post_name\":\"HRT4078\",\"name\":\"Demo\",\"email\":\"admin1@gmail.com\",\"phonenumber\":\"7895652458\",\"subject\":\"Dmeo\",\"message\":\"This is a demo message.\",\"submit-form\":\"\"}',	'2021-10-24 19:44:06',	1),
(12,	'Product Enquiry On HRT4078',	'{\"post_name\":\"HRT4078\",\"name\":\"Demo\",\"email\":\"admin1@gmail.com\",\"phonenumber\":\"7895652458\",\"subject\":\"Dmeo\",\"message\":\"This is a demo message.\",\"submit-form\":\"\"}',	'2021-10-24 19:45:55',	1),
(13,	'Contact Us',	'{\"form_name\":\"Daniela Giraldo\",\"form_email\":\"daniellagiralda64@gmail.com\",\"form_subject\":\"YouTube Promotion: 700-1500 new subscribers each month\",\"form_phone\":\"529825878\",\"form_message\":\"Hi there,\r\n\r\nWe run a Youtube growth service, where we can increase your subscriber count safely and practically. \r\n\r\n- Guaranteed: We guarantee to gain you 700-1500 new subscribers each month.\r\n- Real, human subscribers who subscribe because they are interested in your channel/videos.\r\n- Safe: All actions are done, without using any automated tasks / bots.\r\n\r\nOur price is just $60 (USD) per month and we can start immediately.\r\n\r\nIf you are interested then we can discuss further.\r\n\r\nKind Regards,\r\nDaniela\",\"form_botcheck\":\"\"}',	'2024-06-12 13:06:25',	0);

DROP TABLE IF EXISTS `donation`;
CREATE TABLE `donation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(25) NOT NULL,
  `address` varchar(500) NOT NULL,
  `d_type` int(11) NOT NULL COMMENT '1- cash, 2 - UPi, 3 - Bank Transfer, 4 - Other',
  `d_amount` varchar(10) NOT NULL,
  `dod` date NOT NULL,
  `year` int(4) unsigned NOT NULL,
  `month` varchar(20) NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `sequence` int(11) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `donation_for` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `donation` (`id`, `name`, `email`, `mobile_no`, `address`, `d_type`, `d_amount`, `dod`, `year`, `month`, `img`, `description`, `status`, `sequence`, `created_on`, `modified_on`, `created_by`, `donation_for`) VALUES
(1,	'Raj Kishor Tarei',	'',	'7377245943',	'karapada, Ganjam',	2,	'',	'2022-02-21',	2022,	'02',	'donation-1.jpg',	'Received Brass Bowl for Temple',	1,	0,	'2022-02-20 20:01:48',	'2022-02-20 20:18:25',	'Rt4rgd56',	0),
(2,	'Karan Sinha',	'',	'7412589632',	'Karapada, Ganjam, 761020',	2,	'',	'2022-02-23',	2022,	'02',	'donation-2.jpg',	'Received Brass Bell for Temple',	1,	0,	'2022-02-20 20:35:47',	'2022-02-20 20:41:03',	'Rt4rgd56',	0),
(3,	'Raj Kishor',	'',	'7896547852',	'address will be here',	2,	'',	'2022-01-19',	2022,	'01',	'donation-3.jpg',	'Received Brass Bowl for Temple',	1,	0,	'2022-02-20 20:39:20',	'2022-02-20 20:42:42',	'Rt4rgd56',	0),
(4,	'asdasd',	'',	'4574575545',	'A-37, Ruchika Market',	2,	'',	'2021-12-02',	0,	'',	'WhatsApp Image 2022-02-19 at 10.50.44 PM.jpeg',	'asdasdasda',	0,	0,	'2022-02-20 22:27:14',	'0000-00-00 00:00:00',	'Rt4rgd56',	0),
(5,	'Chakra',	'',	'7377245943',	'',	2,	'5000',	'2023-03-02',	2023,	'03',	NULL,	'',	1,	0,	'2023-03-02 23:01:52',	'0000-00-00 00:00:00',	'User',	0),
(6,	'',	'',	'',	'',	0,	'',	'2024-02-28',	2024,	'02',	NULL,	'',	1,	0,	'2024-02-28 23:01:36',	'0000-00-00 00:00:00',	'User',	0);

DROP TABLE IF EXISTS `faq`;
CREATE TABLE `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qns` varchar(500) NOT NULL,
  `ans` varchar(500) NOT NULL,
  `sequence` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `del_status` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `faq` (`id`, `qns`, `ans`, `sequence`, `created_on`, `modified_on`, `created_by`, `del_status`, `status`) VALUES
(1,	'How to analyze marketing strategies?',	'Nostrud exercitation ullamco laboris nisi ut aliquip aute irure dolor indy reprehenderit in voluptate velit esse cillum dole Veniam quis nul pariatur excepteur sint nulla ipsum occaecat.',	1,	'2021-10-18 23:27:48',	'2021-10-18 23:30:35',	'Rt4rgd56',	0,	1),
(2,	'What are latest updates and how to get it?',	'Nostrud exercitation ullamco laboris nisi ut aliquip aute irure dolor indy reprehenderit in voluptate velit esse cillum dole Veniam quis nul pariatur excepteur sint nulla ipsum occaecat.',	2,	'2021-10-18 23:31:57',	'0000-00-00 00:00:00',	'Rt4rgd56',	0,	1),
(3,	'How can I customize projects to add members?',	'Nostrud exercitation ullamco laboris nisi ut aliquip aute irure dolor indy reprehenderit in voluptate velit esse cillum dole Veniam quis nul pariatur excepteur sint nulla ipsum occaecat.',	3,	'2021-10-18 23:32:14',	'0000-00-00 00:00:00',	'Rt4rgd56',	0,	1),
(4,	'Why you respond so much late?',	'Nostrud exercitation ullamco laboris nisi ut aliquip aute irure dolor indy reprehenderit in voluptate velit esse cillum dole Veniam quis nul pariatur excepteur sint nulla ipsum occaecat.',	4,	'2021-10-18 23:32:27',	'0000-00-00 00:00:00',	'Rt4rgd56',	0,	1),
(5,	'How can I customize projects to add members?',	'Nostrud exercitation ullamco laboris nisi ut aliquip aute irure dolor indy reprehenderit in voluptate velit esse cillum dole Veniam quis nul pariatur excepteur sint nulla ipsum occaecat.',	5,	'2021-10-18 23:32:50',	'0000-00-00 00:00:00',	'Rt4rgd56',	0,	1);

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_cid` int(11) NOT NULL,
  `alt_tag` varchar(250) NOT NULL,
  `img` varchar(500) NOT NULL,
  `descr` varchar(500) NOT NULL,
  `video_url` varchar(500) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `del_status` int(1) NOT NULL DEFAULT 0,
  `sequence` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `gallery_cat`;
CREATE TABLE `gallery_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` varchar(250) NOT NULL,
  `slug_url` varchar(250) NOT NULL,
  `short_desc` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `del_status` int(1) NOT NULL DEFAULT 0,
  `sequence` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `img_gallery`;
CREATE TABLE `img_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `gallery_img` varchar(250) NOT NULL,
  `img_tag` varchar(500) NOT NULL,
  `is_first` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1,
  `sequence` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `img_gallery` (`id`, `cat_id`, `cat_name`, `gallery_img`, `img_tag`, `is_first`, `status`, `sequence`, `created_on`, `modified_on`, `created_by`) VALUES
(1,	3,	'Other',	'434172341_20220221224859.jpeg',	'',	0,	1,	0,	'2022-02-21 22:48:59',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(2,	3,	'Other',	'1819665019_20220221224859.jpeg',	'',	0,	1,	0,	'2022-02-21 22:48:59',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(3,	3,	'Other',	'1571696793_20220221224859.jpeg',	'',	0,	1,	0,	'2022-02-21 22:48:59',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(4,	3,	'Other',	'5534701_20220221224859.jpeg',	'',	0,	1,	0,	'2022-02-21 22:48:59',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(5,	1,	'Temple',	'116150776_20220221225104.jpg',	'',	0,	1,	0,	'2022-02-21 22:51:04',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(6,	2,	'Construction',	'1625315946_20220222211641.jpg',	'',	0,	1,	0,	'2022-02-21 22:51:30',	'2022-02-22 21:16:41',	'Rt4rgd56'),
(7,	2,	'Construction',	'1010576284_20220221225130.jpg',	'',	0,	0,	0,	'2022-02-21 22:51:30',	'0000-00-00 00:00:00',	'Rt4rgd56');

DROP TABLE IF EXISTS `lang`;
CREATE TABLE `lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL,
  `locale` varchar(20) DEFAULT NULL,
  `main` int(11) DEFAULT 0,
  `checked` int(11) DEFAULT 0,
  `rank` int(11) DEFAULT 0,
  `tag` varchar(20) DEFAULT NULL,
  `rtl` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `lang` (`id`, `title`, `locale`, `main`, `checked`, `rank`, `tag`, `rtl`) VALUES
(1,	'Français',	'fr_FR',	0,	1,	2,	'fr',	0),
(2,	'English',	'en_GB',	1,	1,	1,	'en',	0),
(3,	'عربي',	'ar_MA',	0,	1,	3,	'ar',	1);

DROP TABLE IF EXISTS `live_members`;
CREATE TABLE `live_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `gotra` varchar(100) NOT NULL,
  `yrly_donation` varchar(10) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `dates` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `live_members` (`id`, `name`, `address`, `gotra`, `yrly_donation`, `purpose`, `dates`, `status`, `created_by`, `created_on`, `updated_on`) VALUES
(1,	'Shri Binod Kumar Padhy',	'Chatrapur',	'Nageswar',	'25000',	'For Temple',	'2023-03-07',	1,	'Rt4rgd56',	'2022-02-20 17:15:26',	'2023-03-07 22:37:44'),
(2,	'Shri Kamal Kumar Panda',	'Chatrapur',	'',	'21000',	'For Construction',	'2023-02-02',	1,	'Rt4rgd56',	'2022-02-20 17:36:06',	'2023-03-07 22:42:52'),
(3,	'Shri Prasant Nayak',	'Chatrapur',	'',	'30000',	'For Temple',	'2023-02-23',	1,	'Rt4rgd56',	'2023-03-07 22:44:50',	'0000-00-00 00:00:00'),
(4,	'Shri Kasinath Brahma',	'Chatrapur',	'',	'22000',	'For Temple',	'2023-02-10',	1,	'Rt4rgd56',	'2023-03-07 22:46:02',	'0000-00-00 00:00:00'),
(5,	'Shri Simanchala Raula',	'Chatrapur',	'',	'20000',	'For Construction',	'2023-01-05',	1,	'Rt4rgd56',	'2023-03-07 22:47:20',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `master_menu`;
CREATE TABLE `master_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_labelnm` varchar(254) NOT NULL,
  `status` int(1) unsigned NOT NULL,
  `del_status` int(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `master_menu` (`id`, `menu_labelnm`, `status`, `del_status`) VALUES
(1,	'Header Menu',	1,	0),
(2,	'Footer Menu',	1,	0);

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_type` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desg` varchar(50) NOT NULL,
  `img` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `sequence` int(11) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `members` (`id`, `member_type`, `name`, `desg`, `img`, `status`, `sequence`, `created_on`, `modified_on`, `created_by`) VALUES
(1,	1,	'Shri Binod Kumar Padhy',	'Trustee',	'Binod_Kumar_Padhy.jpg',	1,	1,	'2022-02-20 00:04:59',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(2,	1,	'Smt. Manjula Panda',	'Trustee',	'Manhula_Panda.jpg',	1,	2,	'2022-02-20 00:26:23',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(3,	1,	'Shri Sudhakar Panda',	'Trustee',	'',	1,	3,	'2022-02-20 00:46:46',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(4,	1,	'Shri Kasinath Brahma',	'Trustee',	'',	1,	4,	'2022-02-20 00:50:56',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(5,	1,	'Shri Laxmi Nursiha Panda',	'Trustee',	'',	1,	5,	'2022-02-20 00:51:44',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(6,	1,	'Shri Pramod Kumar Panda',	'Trustee',	'',	1,	6,	'2022-02-20 00:52:03',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(7,	1,	'Dr. Bharadwaj',	'Trustee',	'',	1,	7,	'2022-02-20 00:52:23',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(8,	2,	'Shri Rabindra Nath Panda',	'Advisor',	'RabindraNathPanda.jpeg',	1,	1,	'2022-02-20 15:43:28',	'2024-02-29 23:29:57',	'Rt4rgd56'),
(9,	2,	'Shri Kamal Kumar Panda',	'Co-ordinator',	'Kamal-kumar-panda.jpg',	1,	2,	'2022-02-20 15:45:23',	'2022-02-21 20:34:56',	'Rt4rgd56'),
(10,	2,	'Shri Prasant Nayak',	'President',	'prasant-kumar-nayak.jpg',	1,	3,	'2022-02-20 15:46:10',	'2022-02-20 22:58:17',	'Rt4rgd56'),
(11,	2,	'Shri Basant Kumar Maharana',	'Working President',	'Shri-Basant-Kumar-Maharana.jpg',	1,	4,	'2022-02-20 15:53:15',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(12,	2,	'Shri Rabindra Kumar Panda',	'Secretary',	'Rabindra-Kumar-Panda.jpg',	1,	5,	'2022-02-20 15:53:48',	'2022-02-20 23:33:13',	'Rt4rgd56'),
(13,	2,	'Shri Pramod Kumar Sahu',	'Asst. Secretary',	'PramodKumarSahu.jpeg',	1,	6,	'2022-02-20 15:55:13',	'2024-02-29 23:25:39',	'Rt4rgd56'),
(14,	2,	'Shri Santosh Kumar Padhy',	' Vice President',	'Santosh-Kumar-Padhy.jpg',	1,	7,	'2022-02-20 15:55:34',	'2022-02-20 23:36:20',	'Rt4rgd56'),
(15,	2,	'Shri Khirod Chandra Sahu',	'Vice President',	'Khirod-Chandra-Sahu.jpg',	1,	8,	'2022-02-20 15:55:54',	'2022-02-20 23:36:54',	'Rt4rgd56'),
(16,	2,	'Shri Suresh Kumar Panda',	'Treasure',	'',	1,	9,	'2022-02-20 15:56:15',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(17,	2,	'Shri Bijay Kumar Nayak',	'Member',	'Bijay-Kumar-Nayak.jpg',	1,	10,	'2022-02-20 15:56:39',	'2022-02-20 23:35:44',	'Rt4rgd56'),
(18,	2,	'Shri Bhaskar Nayak',	'Member',	'',	1,	11,	'2022-02-20 15:57:23',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(19,	2,	'Sarapanch Rajapur',	'Member',	'',	1,	12,	'2022-02-20 15:57:39',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(20,	2,	'Sarapanch Karapada',	'Member',	'',	1,	13,	'2022-02-20 15:58:02',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(21,	3,	'Shri Durga Prasad Panda',	'',	'',	1,	1,	'2022-02-20 16:02:07',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(22,	3,	'Shri Santosh Kumar Pandaa',	'Manager',	'',	1,	2,	'2022-02-20 16:02:27',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(23,	3,	'Shri Adikanda Raula',	'Pujaka',	'',	1,	3,	'2022-02-20 16:02:45',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(24,	3,	'Shri Simanchala Raula',	'Pujaka',	'',	1,	4,	'2022-02-20 16:03:05',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(25,	3,	'Shri Shri Kalia Raula',	'Pujaka',	'',	1,	5,	'2022-02-20 16:03:26',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(26,	3,	'Shri Trilochan Raula',	'Pujaka',	'',	1,	6,	'2022-02-20 16:03:40',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(27,	2,	'Satrughana Mahankuda',	'',	'satrughana-mahankuda.jpeg',	1,	0,	'2024-02-29 23:27:06',	'0000-00-00 00:00:00',	'Rt4rgd56');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `master_menu_id` int(11) NOT NULL,
  `table_nm` varchar(254) NOT NULL,
  `col_value` int(10) unsigned NOT NULL,
  `menu_name` varchar(254) NOT NULL,
  `menu_url` varchar(254) NOT NULL,
  `parent_menu_id` int(3) unsigned NOT NULL,
  `parent_submenu_id` int(3) unsigned NOT NULL,
  `post_type` varchar(100) NOT NULL,
  `sequence` int(3) unsigned NOT NULL,
  `del_status` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `menu_n`;
CREATE TABLE `menu_n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `master_menu_id` int(11) NOT NULL,
  `table_nm` varchar(254) NOT NULL,
  `col_value` int(10) unsigned NOT NULL,
  `menu_name` varchar(254) NOT NULL,
  `menu_url` varchar(254) NOT NULL,
  `parent_id` int(3) unsigned NOT NULL,
  `post_type` varchar(100) NOT NULL,
  `sequence` int(3) unsigned NOT NULL,
  `del_status` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `m_media_coverage`;
CREATE TABLE `m_media_coverage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `publish_date` date DEFAULT NULL,
  `cut_img` varchar(500) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `info` varchar(250) NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 - Active, 2 - Inactive',
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `m_media_coverage` (`id`, `publish_date`, `cut_img`, `link`, `info`, `active_status`, `created_on`, `created_by`, `updated_on`, `update_by`, `deleted_at`, `deleted_by`) VALUES
(1,	NULL,	'Image-1.jpg',	'',	'',	1,	'2023-02-26 15:57:39',	2,	NULL,	NULL,	NULL,	NULL),
(2,	'2023-01-11',	'Image-2.jpeg',	'',	'',	1,	'2023-02-26 16:08:04',	2,	NULL,	NULL,	NULL,	NULL),
(3,	'2023-01-04',	'Image-3.jpeg',	'',	'',	1,	'2023-02-26 16:10:16',	2,	'2023-02-26 16:14:14',	2,	NULL,	NULL),
(4,	NULL,	'Image-4.jpeg',	'',	'',	1,	'2023-02-26 16:16:22',	2,	NULL,	NULL,	NULL,	NULL),
(5,	NULL,	'Image-5.jpeg',	'',	'',	1,	'2023-02-26 16:17:03',	2,	NULL,	NULL,	NULL,	NULL),
(6,	NULL,	'Image-6.jpeg',	'',	'',	1,	'2023-02-26 16:17:16',	2,	NULL,	NULL,	NULL,	NULL),
(7,	NULL,	'Image-9.jpeg',	'',	'',	1,	'2023-02-26 16:17:43',	2,	'2023-02-26 16:17:55',	2,	NULL,	NULL),
(8,	NULL,	'Image-10-20230226163019.jpeg',	'',	'',	1,	'2023-02-26 16:30:19',	2,	NULL,	NULL,	NULL,	NULL),
(9,	NULL,	'Image-11.jpeg',	'',	'',	1,	'2023-02-26 16:30:31',	2,	NULL,	NULL,	NULL,	NULL),
(10,	NULL,	'Image-12.jpeg',	'',	'',	1,	'2023-02-26 16:30:46',	2,	NULL,	NULL,	NULL,	NULL),
(11,	NULL,	'Image-13.jpeg',	'',	'',	1,	'2023-02-26 16:31:27',	2,	NULL,	NULL,	NULL,	NULL),
(12,	NULL,	'Image-14.jpeg',	'',	'',	1,	'2023-02-26 16:31:39',	2,	NULL,	NULL,	NULL,	NULL),
(13,	NULL,	'Image-15.jpeg',	'',	'',	1,	'2023-02-26 16:31:49',	2,	NULL,	NULL,	NULL,	NULL),
(14,	NULL,	'Image-16.jpeg',	'',	'',	1,	'2023-02-26 16:32:00',	2,	NULL,	NULL,	NULL,	NULL),
(15,	NULL,	'Image-18.jpeg',	'',	'',	1,	'2023-02-26 16:32:15',	2,	NULL,	NULL,	NULL,	NULL),
(16,	NULL,	'Image-20.jpeg',	'',	'',	1,	'2023-02-26 16:32:31',	2,	NULL,	NULL,	NULL,	NULL),
(17,	NULL,	'Image-21.jpeg',	'',	'',	1,	'2023-02-26 16:33:22',	2,	NULL,	NULL,	NULL,	NULL),
(18,	NULL,	'Image-23.jpeg',	'',	'',	1,	'2023-02-26 16:33:40',	2,	NULL,	NULL,	NULL,	NULL),
(19,	NULL,	'Image-25.jpeg',	'',	'',	1,	'2023-02-26 16:34:23',	2,	NULL,	NULL,	NULL,	NULL),
(20,	NULL,	'Image-26.jpg',	'',	'',	1,	'2023-02-26 16:35:20',	2,	'2023-02-26 16:40:12',	2,	NULL,	NULL),
(21,	NULL,	'Image-27.jpeg',	'',	'',	1,	'2023-02-26 16:40:25',	2,	NULL,	NULL,	NULL,	NULL),
(22,	NULL,	'Image-31.jpeg',	'',	'',	1,	'2023-02-26 16:40:44',	2,	NULL,	NULL,	NULL,	NULL),
(23,	NULL,	'Image-32.jpeg',	'',	'',	1,	'2023-02-26 16:40:58',	2,	'2023-02-26 16:41:08',	2,	NULL,	NULL),
(24,	NULL,	'Image-34.jpeg',	'',	'',	1,	'2023-02-26 16:41:28',	2,	NULL,	NULL,	NULL,	NULL),
(25,	NULL,	'Image-35.jpeg',	'',	'',	1,	'2023-02-26 16:41:38',	2,	NULL,	NULL,	NULL,	NULL),
(26,	NULL,	'Image-37.jpeg',	'',	'',	1,	'2023-02-26 16:41:54',	2,	NULL,	NULL,	NULL,	NULL),
(27,	NULL,	'Image-38.jpeg',	'',	'',	1,	'2023-02-26 16:42:19',	2,	NULL,	NULL,	NULL,	NULL),
(28,	NULL,	'Image-39.jpeg',	'',	'',	1,	'2023-02-26 16:42:31',	2,	NULL,	NULL,	NULL,	NULL),
(29,	NULL,	'Image-40.jpeg',	'',	'',	1,	'2023-02-26 16:42:43',	2,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(2) NOT NULL,
  `parent_pg` int(11) NOT NULL,
  `pg_name` varchar(300) NOT NULL,
  `sub_title` varchar(300) NOT NULL,
  `slug_url` varchar(300) NOT NULL,
  `bg_img` varchar(300) NOT NULL,
  `sml_desc` text NOT NULL,
  `full_desc` text NOT NULL,
  `ext_notes` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `del_status` int(1) NOT NULL DEFAULT 0,
  `meta_title` varchar(300) NOT NULL,
  `meta_key` varchar(300) NOT NULL,
  `meta_desc` varchar(500) NOT NULL,
  `canonical_code` varchar(300) NOT NULL,
  `extra_meta` varchar(300) NOT NULL,
  `is_featured` int(1) unsigned NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `page` (`id`, `template_id`, `parent_pg`, `pg_name`, `sub_title`, `slug_url`, `bg_img`, `sml_desc`, `full_desc`, `ext_notes`, `status`, `del_status`, `meta_title`, `meta_key`, `meta_desc`, `canonical_code`, `extra_meta`, `is_featured`, `created_on`, `modified_on`, `created_by`) VALUES
(1,	1,	0,	'About Us',	'????? ????? ?????????? - ?? ??? ???????? ????? ??????? ??????',	'about-us',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“http://mvwebsolutions.com/dev/hirelay/abour-us\" />',	'',	0,	'2021-10-14 19:32:49',	'2023-07-01 10:58:38',	'Rt4rgd56'),
(2,	0,	0,	'FAQ\'s',	'',	'faqs',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“http://mvwebsolutions.com/dev/hirelay/faq-s\" />',	'',	0,	'2021-10-14 19:33:21',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(3,	1,	0,	'Feedback',	'',	'feedback',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“http://mvwebsolutions.com/dev/hirelay/feedback\" />',	'',	0,	'2021-10-14 19:33:56',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(4,	0,	0,	'News',	'',	'news',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“http://mvwebsolutions.com/dev/hirelay/news\" />',	'',	0,	'2021-10-14 19:34:26',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(5,	6,	0,	'Contact Us',	'',	'contact-us',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“http://mvwebsolutions.com/dev/hirelay/contact-us\" />',	'',	0,	'2021-10-14 19:34:51',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(6,	0,	0,	'Privacy Policy',	'',	'privacy-policy',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“http://mvwebsolutions.com/dev/hirelay/privacy-policy\" />',	'',	0,	'2021-10-23 21:03:00',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(7,	1,	1,	'Committee Members',	'',	'committee-members',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/committee-members\" />',	'',	0,	'2022-02-16 23:06:42',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(9,	0,	0,	'Trustee Members',	'',	'trustee-members',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/trustee-members\" />',	'',	0,	'2022-02-16 23:18:31',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(10,	0,	0,	'Live Members',	'',	'live-members',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/live-members\" />',	'',	0,	'2022-02-16 23:28:51',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(11,	0,	0,	'Yearly Program',	'',	'yearly-program',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/yearly-program\" />',	'',	0,	'2022-02-16 23:37:14',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(12,	0,	0,	'Upcoming Events',	'',	'upcoming-events',	'',	'',	'<p>asdas asdasasdsasd</p>\r\n',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/upcoming-events\" />',	'',	0,	'2022-02-16 23:37:53',	'2023-02-26 12:13:02',	'Rt4rgd56'),
(13,	0,	0,	'Occassionally Program',	'',	'occassionally-program',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/occassionally-program\" />',	'',	0,	'2022-02-16 23:38:26',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(14,	0,	0,	'Maha Bhog',	'',	'maha-bhog',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/maha-bhog\" />',	'',	0,	'2022-02-16 23:38:54',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(15,	0,	0,	'Maha Puja',	'',	'maha-puja',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/maha-puja\" />',	'',	0,	'2022-02-16 23:39:04',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(16,	0,	0,	'Gallery',	'',	'gallery',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/gallery\" />',	'',	0,	'2022-02-16 23:39:18',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(17,	0,	0,	'Booking',	'',	'booking',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/room-booking\" />',	'',	0,	'2022-02-16 23:39:38',	'2023-02-26 22:40:08',	'Rt4rgd56'),
(18,	0,	0,	'Mandap Booking',	'',	'mandap-booking',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'',	'',	0,	'2022-02-16 23:39:53',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(19,	0,	0,	'Development Work',	'',	'development-work',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/development-work\" />',	'',	0,	'2022-02-16 23:41:31',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(20,	0,	0,	'Donation',	'',	'donation',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/donation\" />',	'',	0,	'2022-02-16 23:41:39',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(21,	0,	0,	'Temple Management',	'',	'temple-mgmt-members',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“https://www.maaramachanditemple.com/test/temple-management\" />',	'',	0,	'2022-02-18 23:13:56',	'0000-00-00 00:00:00',	'Rt4rgd56'),
(22,	0,	0,	'Media Coverage',	'',	'media-coverage',	'',	'',	'',	'',	1,	0,	'',	'',	'',	'<link rel=“canonical” href=“http://www.maaramachanditemple.com/test/media-coverage\" />',	'',	0,	'2023-02-26 15:35:01',	'2023-02-26 15:35:35',	'Rt4rgd56');

DROP TABLE IF EXISTS `page_meta`;
CREATE TABLE `page_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_url` text NOT NULL,
  `meta_title` varchar(300) NOT NULL,
  `meta_key` varchar(300) NOT NULL,
  `meta_desc` varchar(500) NOT NULL,
  `canonical_code` varchar(300) NOT NULL,
  `extra_meta` varchar(300) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `del_status` int(1) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `partner_nm` varchar(300) NOT NULL,
  `img_tag` varchar(300) NOT NULL,
  `partner_img` varchar(500) NOT NULL,
  `url` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `del_status` int(11) NOT NULL DEFAULT 0,
  `sequence` int(11) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `post_name` varchar(300) NOT NULL,
  `slug_url` varchar(300) NOT NULL,
  `model` varchar(500) DEFAULT NULL,
  `post_type` enum('Product','News','Solution') NOT NULL,
  `post_slab` int(11) NOT NULL DEFAULT 0,
  `posted_by` varchar(500) NOT NULL,
  `posted_on` date NOT NULL,
  `post_img` varchar(500) NOT NULL,
  `news_dtls_bnr` varchar(500) NOT NULL,
  `bg_img` varchar(300) NOT NULL,
  `sml_desc` text DEFAULT NULL,
  `side_desc` text DEFAULT NULL,
  `full_desc` text DEFAULT NULL,
  `specs` text DEFAULT NULL,
  `prd_vdo` text DEFAULT NULL,
  `q_a` text DEFAULT NULL,
  `links` text DEFAULT NULL,
  `is_featured` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `del_status` int(1) NOT NULL DEFAULT 0,
  `sequence` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `hits` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_name` (`post_name`),
  KEY `slug_url` (`slug_url`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `post` (`id`, `cat_id`, `subcat_id`, `post_name`, `slug_url`, `model`, `post_type`, `post_slab`, `posted_by`, `posted_on`, `post_img`, `news_dtls_bnr`, `bg_img`, `sml_desc`, `side_desc`, `full_desc`, `specs`, `prd_vdo`, `q_a`, `links`, `is_featured`, `status`, `del_status`, `sequence`, `created_on`, `modified_on`, `created_by`, `hits`) VALUES
(1,	8,	0,	'Default Interest Rate in Small Loans Now is Lowest',	'default-interest-rate-in-small-loans-now-is-lowest',	NULL,	'News',	0,	'Admin',	'2021-10-12',	'news-2.jpg',	'',	'',	'Default Interest Rate in Small Loans Now is Lowest',	NULL,	'<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n',	NULL,	NULL,	NULL,	NULL,	1,	0,	0,	1,	'2021-10-13 19:59:03',	'0000-00-00 00:00:00',	'Rt4rgd56',	1),
(2,	9,	0,	'We believe inlong lasting our business relationships',	'we-believe-inlong-lasting-our-business-relationships',	NULL,	'News',	0,	'Admin',	'2021-10-12',	'news-1.jpg',	'',	'',	'We believe inlong lasting our business relationships',	NULL,	'<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n',	NULL,	NULL,	NULL,	NULL,	1,	1,	0,	2,	'2021-10-13 20:03:57',	'0000-00-00 00:00:00',	'Rt4rgd56',	7),
(3,	10,	0,	'Default Interest Rate in Small Loans Now is Lowests',	'default-interest-rate-in-small-loans-now-is-lowests',	NULL,	'News',	0,	'Admin',	'2021-10-12',	'news-1-20211013200506.jpg',	'',	'',	'Default Interest Rate in Small Loans Now is Lowest',	NULL,	'<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n',	NULL,	NULL,	NULL,	NULL,	1,	1,	0,	3,	'2021-10-13 20:05:06',	'0000-00-00 00:00:00',	'Rt4rgd56',	13),
(4,	9,	0,	'We believe inlong lasting our business relationship',	'we-believe-inlong-lasting-our-business-relationship',	NULL,	'News',	0,	'Admin',	'2021-10-16',	'news-3.jpg',	'',	'',	'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',	NULL,	'<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n',	NULL,	NULL,	NULL,	NULL,	1,	1,	0,	4,	'2021-10-13 20:05:58',	'0000-00-00 00:00:00',	'Rt4rgd56',	1),
(5,	1,	0,	'HRT23',	'hrt23',	NULL,	'Product',	0,	'',	'0000-00-00',	'HRT23.9.1.jpg',	'',	'',	NULL,	'<p>Mechanical engineering is a diverse subject that derives its breadth from the need to design and manufacture everything from small individual parts and devices.</p>\r\n',	'<p><img alt=\"\" src=\"http://mvwebsolutions.com/dev/hirelay/userfiles/images/20210623191437_81745.png\" /></p>\r\n',	NULL,	NULL,	NULL,	NULL,	0,	1,	0,	0,	'2021-10-18 23:00:43',	'0000-00-00 00:00:00',	'Rt4rgd56',	0),
(8,	1,	0,	'HRT4100',	'hrt4100',	NULL,	'Product',	0,	'',	'0000-00-00',	'HRT4100.10.1.jpg',	'',	'',	NULL,	'<p>Mechanical engineering is a diverse subject that derives its breadth from the need to design and manufacture everything from small individual parts and devices.</p>\r\n',	'<p><br />\r\n<img alt=\"\" src=\"http://mvwebsolutions.com/dev/hirelay/userfiles/images/20210623191658_51979.png\" /></p>\r\n',	NULL,	NULL,	NULL,	NULL,	0,	1,	0,	2,	'2021-10-18 23:11:28',	'0000-00-00 00:00:00',	'Rt4rgd56',	0),
(9,	1,	0,	'HRT4078',	'hrt4078',	NULL,	'Product',	0,	'',	'0000-00-00',	'HRT4078.12.1.jpg',	'',	'',	NULL,	'<p>Mechanical engineering is a diverse subject that derives its breadth from the need to design and manufacture everything from small individual parts and devices.</p>\r\n',	'<p><br />\r\n<img alt=\"\" src=\"http://mvwebsolutions.com/dev/hirelay/userfiles/images/20210623192133_94738.png\" /></p>\r\n',	NULL,	NULL,	NULL,	NULL,	0,	1,	0,	3,	'2021-10-18 23:13:19',	'0000-00-00 00:00:00',	'Rt4rgd56',	0);

DROP TABLE IF EXISTS `post_desc`;
CREATE TABLE `post_desc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `heading` text NOT NULL,
  `content` text NOT NULL,
  `cnt_position` int(1) NOT NULL DEFAULT 2 COMMENT '0 - left, 1 - Right, 2 - Center',
  `image` varchar(500) NOT NULL,
  `img_position` int(1) NOT NULL DEFAULT 2 COMMENT '0 - left, 1 - Right, 2 - Center',
  `footer_line` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0 - block, 1 - Active',
  `sequence` int(11) DEFAULT 0,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `post_gallery`;
CREATE TABLE `post_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `gallery_img` varchar(250) NOT NULL,
  `img_tag` varchar(500) NOT NULL,
  `is_first` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1,
  `sequence` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `post_meta`;
CREATE TABLE `post_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `meta_title` varchar(500) DEFAULT NULL,
  `meta_key` varchar(500) DEFAULT NULL,
  `meta_desc` varchar(500) DEFAULT NULL,
  `canonical_code` varchar(500) DEFAULT NULL,
  `extra_meta` varchar(500) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `room_numbering`;
CREATE TABLE `room_numbering` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `room_type`;
CREATE TABLE `room_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type` varchar(50) NOT NULL,
  `cool_status` varchar(50) NOT NULL,
  `no_of_rooms` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_by` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `sitemst`;
CREATE TABLE `sitemst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_live` int(1) NOT NULL DEFAULT 0 COMMENT '0 - under construnction, 1 - Live',
  `business_hrs1` text NOT NULL,
  `business_hrs2` text NOT NULL,
  `map` text NOT NULL,
  `web_email` varchar(200) DEFAULT NULL,
  `booking_email` varchar(200) DEFAULT NULL,
  `contact_email` varchar(200) DEFAULT NULL,
  `prm_contact` varchar(150) DEFAULT NULL,
  `sec_contact` varchar(150) DEFAULT NULL,
  `alt_contact` varchar(150) DEFAULT NULL,
  `fax` varchar(500) DEFAULT NULL,
  `facebook_url` varchar(300) DEFAULT NULL,
  `twitter_url` varchar(300) DEFAULT NULL,
  `linkedin_url` varchar(300) DEFAULT NULL,
  `instagram_url` varchar(300) DEFAULT NULL,
  `youtube_url` text DEFAULT NULL,
  `rss_url` text DEFAULT NULL,
  `pintersest_url` text DEFAULT NULL,
  `whatsapp_url` text DEFAULT NULL,
  `skype_url` varchar(500) DEFAULT NULL,
  `hm_pg_desc` text DEFAULT NULL,
  `hm_pg_heading` text DEFAULT NULL,
  `business_addr` text NOT NULL,
  `business_full_addr` text NOT NULL,
  `prd_page_desc` text DEFAULT NULL,
  `copyright_text` text DEFAULT NULL,
  `footer_abt_cmp` text DEFAULT NULL,
  `whatspp_no` varchar(15) DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_key` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `canonical_code` text DEFAULT NULL,
  `extra_meta` text DEFAULT NULL,
  `c_site_key` varchar(500) DEFAULT NULL,
  `c_secret_key` varchar(500) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `sitemst` (`id`, `site_live`, `business_hrs1`, `business_hrs2`, `map`, `web_email`, `booking_email`, `contact_email`, `prm_contact`, `sec_contact`, `alt_contact`, `fax`, `facebook_url`, `twitter_url`, `linkedin_url`, `instagram_url`, `youtube_url`, `rss_url`, `pintersest_url`, `whatsapp_url`, `skype_url`, `hm_pg_desc`, `hm_pg_heading`, `business_addr`, `business_full_addr`, `prd_page_desc`, `copyright_text`, `footer_abt_cmp`, `whatspp_no`, `meta_title`, `meta_key`, `meta_desc`, `canonical_code`, `extra_meta`, `c_site_key`, `c_secret_key`, `created_on`, `modified_on`, `created_by`) VALUES
(1485,	0,	'9am To 6pm',	'',	' <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.391132529536!2d85.01436181531608!3d19.395499246890946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a17fc05bf681e53%3A0xccee7a62719b8ca9!2sMaa%20Ramachandi%20Temple!5e0!3m2!1sen!2sin!4v1617202523521!5m2!1sen!2sin\" width=\"100%\" height=\"500\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>',	'maaramachanditempletrust@gmail.com',	'maaramachanditempletrust@gmail.com',	'maaramachanditempletrust@gmail.com',	'7684982330',	'',	'',	'',	'#',	'#',	'#',	'#',	'#',	'#',	'#',	'#',	'#',	'',	'',	'Niladripur, karapada,  Chatrapur, Odisha-761026',	'Niladripur, karapada,  Chatrapur, Odisha-761026',	'',	'',	'Ningbo Hirelay Technology Co.,Ltd is a professional relay manufacturer which is located in Ningbo. the company setup at 2014 , mainly produces including: Telecom relay, General purpose relays.',	NULL,	'',	'',	'',	'',	'',	'6LffypUeAAAAAHZQZO1aqZzAkWPfnRJHdiG9DZQ6',	'6LffypUeAAAAAKqAwmd4v4Jde98QPdmNsFh45VDi',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'');

DROP TABLE IF EXISTS `table_folder`;
CREATE TABLE `table_folder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tbl_nm` varchar(250) NOT NULL,
  `field_nm` text NOT NULL,
  `folder` text NOT NULL,
  `thumb` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `table_folder` (`id`, `tbl_nm`, `field_nm`, `folder`, `thumb`) VALUES
(1,	'banner',	'[\"bnr_img\"]',	'[\"banner_img\"]',	'[\"thumb\"]'),
(2,	'testimonial',	'[\"auth_img\"]',	'[\"testimonial_img\"]',	'[\"thumb\"]'),
(3,	'partners',	'[\"partner_img\"]',	'[\"partners\"]',	''),
(4,	'post',	'[\"post_img\"]',	'[\"post\"]',	'[\"thumb\"]');

DROP TABLE IF EXISTS `template`;
CREATE TABLE `template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_template` varchar(500) NOT NULL,
  `page_name` varchar(500) NOT NULL,
  `table_nm` varchar(500) NOT NULL,
  `level_page` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `template` (`id`, `page_template`, `page_name`, `table_nm`, `level_page`) VALUES
(1,	'Content Page',	'page',	'page',	0),
(2,	'Listing',	'listing',	'post',	0),
(3,	'Listing Details',	'details',	'post',	1),
(4,	'Testimonial',	'testimonial',	'testimonial',	0),
(5,	'Gallery',	'gallery',	'gallery',	0),
(6,	'Contact Us Page',	'contactus',	'',	0),
(7,	'All Products',	'all_products',	'post',	0);

DROP TABLE IF EXISTS `testimonial`;
CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(300) NOT NULL,
  `title` text NOT NULL,
  `contents` text NOT NULL,
  `desg` varchar(100) NOT NULL,
  `iframe_url` text NOT NULL,
  `auth_img` varchar(300) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 1,
  `status` int(1) NOT NULL DEFAULT 0,
  `del_status` int(1) NOT NULL DEFAULT 0,
  `sequence` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `t_booking`;
CREATE TABLE `t_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_type` tinyint(4) NOT NULL COMMENT '1 - Room, 2 - Mandap',
  `tent_booking` tinyint(4) NOT NULL COMMENT '1 -Yes, 2 - No',
  `adv_booking` tinyint(4) NOT NULL COMMENT '1 -Yes, 2 - No',
  `name` varchar(96) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `from_dt` date NOT NULL,
  `to_dt` date NOT NULL,
  `no_of_person` varchar(16) NOT NULL,
  `purpose` varchar(256) NOT NULL,
  `adhaar_pan` varchar(16) NOT NULL,
  `address` varchar(528) NOT NULL,
  `add_info` varchar(500) NOT NULL,
  `created_by` varchar(128) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 - active, 2 - inactive',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `t_booking` (`id`, `booking_type`, `tent_booking`, `adv_booking`, `name`, `email`, `mobile`, `from_dt`, `to_dt`, `no_of_person`, `purpose`, `adhaar_pan`, `address`, `add_info`, `created_by`, `created_on`, `status`, `deleted_at`, `deleted_by`) VALUES
(1,	1,	1,	2,	'Chakra',	'admin1@gmail.com',	'',	'2023-03-02',	'2023-03-03',	'6',	'Demo ',	'',	'Address: asda asd asd asd',	'asd aasdaseasdasd',	'User',	'2023-03-02 13:51:03',	1,	NULL,	NULL),
(2,	1,	1,	2,	'Chakra',	'admin1@gmail.com',	'7521458963',	'2023-03-09',	'2023-03-11',	'5',	'Demo ',	'1123131231',	'\n Address: asdasa asdasr',	'asd arasdd',	'User',	'2023-03-02 13:54:33',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `user_mst`;
CREATE TABLE `user_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `full_name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `usr_pwd` varchar(200) NOT NULL,
  `usr_type` enum('Admin','Super Admin') NOT NULL,
  `sec_email` varchar(500) DEFAULT NULL,
  `verify_status` int(11) NOT NULL DEFAULT 0,
  `rand_key` varchar(200) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0 - Inactive, 1 - Active',
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `user_mst` (`id`, `user_id`, `full_name`, `email`, `address`, `mobile`, `usr_pwd`, `usr_type`, `sec_email`, `verify_status`, `rand_key`, `status`, `created_on`, `modified_on`) VALUES
(1,	'Fg85hnk',	'Super Admin',	'control@admin.com',	NULL,	NULL,	'5f4dcc3b5aa765d61d8327deb882cf99',	'Super Admin',	NULL,	0,	NULL,	1,	'2020-03-31 07:07:09',	'0000-00-00 00:00:00'),
(2,	'Rt4rgd56',	'Admin',	'admin1@gmail.com',	NULL,	NULL,	'5f4dcc3b5aa765d61d8327deb882cf99',	'Admin',	NULL,	0,	NULL,	1,	'2020-03-31 04:15:09',	'0000-00-00 00:00:00');

-- 2024-10-05 17:36:22
