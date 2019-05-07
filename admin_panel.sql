-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 07, 2019 at 11:14 AM
-- Server version: 5.7.24
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

DROP TABLE IF EXISTS `backup`;
CREATE TABLE IF NOT EXISTS `backup` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `backup_name` varchar(255) NOT NULL,
  `backup_location` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `backup_name_UNIQUE` (`backup_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `co_gallery`
--

DROP TABLE IF EXISTS `co_gallery`;
CREATE TABLE IF NOT EXISTS `co_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `photo_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `co_gallery_section`
--

DROP TABLE IF EXISTS `co_gallery_section`;
CREATE TABLE IF NOT EXISTS `co_gallery_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `section_name` varchar(255) NOT NULL,
  `section_desc` varchar(50) NOT NULL,
  `section_slug` varchar(60) NOT NULL,
  `section_photo` varchar(60) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sorting` int(11) NOT NULL,
  `language` varchar(2) NOT NULL DEFAULT 'tr',
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `co_news`
--

DROP TABLE IF EXISTS `co_news`;
CREATE TABLE IF NOT EXISTS `co_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_subject` varchar(100) NOT NULL,
  `news_content` text NOT NULL,
  `news_photo` varchar(255) NOT NULL,
  `news_slug` varchar(255) NOT NULL,
  `language` varchar(2) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `co_sections`
--

DROP TABLE IF EXISTS `co_sections`;
CREATE TABLE IF NOT EXISTS `co_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_id` int(11) NOT NULL DEFAULT '0',
  `section_name` varchar(255) NOT NULL,
  `section_url` varchar(50) NOT NULL,
  `section_slug` varchar(60) NOT NULL,
  `seo_desc` varchar(50) NOT NULL,
  `seo_keywords` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sorting` int(11) NOT NULL,
  `language` varchar(2) NOT NULL DEFAULT 'tr',
  `section_type` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `co_slider`
--

DROP TABLE IF EXISTS `co_slider`;
CREATE TABLE IF NOT EXISTS `co_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(255) NOT NULL,
  `section_desc` varchar(50) NOT NULL,
  `section_photo` varchar(60) NOT NULL,
  `section_url` varchar(60) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sorting` int(11) NOT NULL,
  `language` varchar(2) NOT NULL DEFAULT 'tr',
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `co_users`
--

DROP TABLE IF EXISTS `co_users`;
CREATE TABLE IF NOT EXISTS `co_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_surname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email_address` varchar(60) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(10) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `co_users`
--

INSERT INTO `co_users` (`id`, `name_surname`, `username`, `password`, `email_address`, `created_date`, `reset_date`, `role`, `status`) VALUES
(1, 'Site User', 'siteuser', 'a19a10fbe74604a330443d71c43a7305', 'your@email.com', '2019-05-07 14:10:42', '0000-00-00 00:00:00', 'user', '1');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(50) NOT NULL,
  `iso_code` varchar(3) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `iso_code`, `status`) VALUES
(1, 'Türkçe', 'tr', 1),
(2, 'English', 'en', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(60) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `module_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `module_icon` varchar(20) NOT NULL,
  `permission` varchar(5) NOT NULL DEFAULT '1',
  `module_type` int(1) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `sname`, `module_id`, `created_date`, `module_icon`, `permission`, `module_type`, `status`) VALUES
(1, 'Panel Kullanıcıları', 'users', 150, '2016-05-27 13:54:38', 'fa-users', 'admin', 0, 1),
(2, 'Diller', 'languages', 200, '2016-05-27 13:54:38', 'fa-flag', 'admin', 0, 1),
(3, 'Sosyal Medya', 'social', 250, '2016-05-27 16:12:23', 'fa-facebook-square', 'user', 0, 1),
(4, 'Yedekleme', 'backup', 350, '2016-05-30 15:38:06', 'fa-arrow-circle-down', 'admin', 0, 1),
(5, 'Modüller', 'modules', 100, '2016-05-31 11:07:38', 'fa-sort-alpha-asc', 'admin', 0, 1),
(6, 'Sayfalar', 'co_pages', 100, '2016-05-31 11:38:04', 'fa-files-o', 'user', 1, 1),
(7, 'Galeri', 'co_gallery', 200, '2016-07-18 11:48:28', 'fa-camera', 'user', 1, 1),
(8, 'Sanal Mağaza', 'co_shopping', 300, '2016-07-18 11:57:41', 'fa-shopping-cart', 'admin', 1, 1),
(9, 'Site Ayarları', 'setup', 300, '2016-08-31 10:12:52', 'fa-wrench', 'admin', 0, 1),
(10, 'Duyurular', 'co_news', 150, '2016-09-05 14:32:27', 'fa-newspaper-o', 'user', 1, 1),
(11, 'Kullanıcı İşlemleri', 'co_users', 250, '2016-09-19 10:12:26', 'fa-users', 'admin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_config`
--

DROP TABLE IF EXISTS `site_config`;
CREATE TABLE IF NOT EXISTS `site_config` (
  `config_label` varchar(255) NOT NULL,
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL,
  `config_help_text` varchar(255) NOT NULL,
  `config_section` varchar(1) NOT NULL,
  `config_input_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_config`
--

INSERT INTO `site_config` (`config_label`, `config_name`, `config_value`, `config_help_text`, `config_section`, `config_input_type`) VALUES
('Site Başlığı', 'site_title', 'Admin Demo Page', '', 's', 'text'),
('Site Kısa Açıklaması', 'site_desc', 'Admin Codeigniter Demo Page', 'Site Açıklaması (maks:160 krt)', 's', 'text'),
('Site Anahtar Kelimeler', 'site_key', 'codeigniter, admin', 'Site Anahtar Kelimeler (maks:160 krt)', 's', 'text'),
('Site URL', 'site_url', 'http://manager.local/', '', 's', 'text'),
('E-Mail Adresi', 'site_email', 'your@email.com', '', 's', 'text'),
('Adres Tanımı', 'contact_address_name', '', 'Adres Tanımı, Örn: Fabrika', 'c', 'text'),
('Adres', 'contact_address', '', '', 'c', 'textarea'),
('Telefon', 'contact_phone', '', '', 'c', 'text'),
('Telefon 2', 'contact_phone2', '', '', 'c', 'text'),
('GSM', 'contact_gsm', '', '', 'c', 'text'),
('Faks', 'contact_fax', '', '', 'c', 'text'),
('Site URL', 'contact_url', '', '', 'c', 'text'),
('E-Mail Adresi', 'contact_email', '', '', 'c', 'text'),
('Google Analytics', 'analytics_google', '', '', 'a', 'text'),
('Facebook Pixel', 'analytics_facebook', '', '', 'a', 'text'),
('Harita Bilgileri', 'contact_map', 'Google Map', 'Google Harita Kodu', 'c', 'textarea'),
('Site Kayıt Kodu', 'site_reg_code', 'D65316', 'Bu kodu şifre öğrenmek için kullanabilirsiniz', 's', 'text'),
('Siteyi Kapat', 'site_close', '0', '', 's', ''),
('Mail Server', 'mail_server', 'ssl://', '', 'm', 'text'),
('Mail Kullanıcı Adı', 'mail_username', 'info@yourmail.com', '', 'm', 'text'),
('Mail Şifresi', 'mail_password', '', '', 'm', 'password'),
('Mail Portu', 'mail_port', '465', '', 'm', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

DROP TABLE IF EXISTS `socials`;
CREATE TABLE IF NOT EXISTS `socials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `social_name` varchar(50) NOT NULL,
  `social_url` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `social_name`, `social_url`, `icon`, `status`) VALUES
(1, 'Facebook', 'http://www.facebook.com', 'fa-facebook-square', 1),
(2, 'Twitter', 'http://www.twitter.com', 'fa-twitter', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_surname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email_address` varchar(60) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name_surname`, `username`, `password`, `email_address`, `created_date`, `reset_date`, `role`) VALUES
(2, 'Site Admin', 'admin', '0c7540eb7e65b553ec1ba6b20de79608', 'your@email.com', '2016-05-30 15:32:59', '2019-05-07 14:10:01', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
