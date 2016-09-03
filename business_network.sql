-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2016 at 01:04 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `business_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `about_us_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `headline_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `headline_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `headline_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_text_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_text_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_text_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_info_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_info_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_info_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_info_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_info_content_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_info_content_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_info_content_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_info_content_bgcolor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_info_leftImg` bigint(20) NOT NULL DEFAULT '1',
  `business_info_left_image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_width` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_height` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `our_team_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `our_team_headline_fontweight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `our_team_headline_fonttype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `our_team_headline_fontcolor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `our_team_div_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `our_team_div_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `our_team_div_text_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `our_team_div_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `our_team_show_picture` bigint(20) NOT NULL DEFAULT '1',
  `our_team_show_div` bigint(20) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `add_biography_image`
--

CREATE TABLE `add_biography_image` (
  `new_biography_id` bigint(20) UNSIGNED NOT NULL,
  `biography_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_price` decimal(15,2) NOT NULL,
  `valute` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_uploaded_time` datetime NOT NULL,
  `article_discount` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles_marks`
--

CREATE TABLE `articles_marks` (
  `article_mark_id` bigint(20) NOT NULL,
  `article_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_mail` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_approve_comment` bigint(20) NOT NULL DEFAULT '0',
  `customer_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_mark` bigint(20) NOT NULL,
  `quality_mark` bigint(20) NOT NULL,
  `mark_time` datetime NOT NULL,
  `read_unread_comment` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_details`
--

CREATE TABLE `article_details` (
  `article_details_id` bigint(20) NOT NULL,
  `article_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Model 1',
  `article_specifications` text COLLATE utf8mb4_unicode_ci,
  `article_details_uploaded_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_details_images`
--

CREATE TABLE `article_details_images` (
  `article_details_images_id` bigint(20) NOT NULL,
  `article_details_id` bigint(20) NOT NULL,
  `article_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_img_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_img_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_img_uploaded_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `background_images`
--

CREATE TABLE `background_images` (
  `bg_image_id` bigint(20) UNSIGNED NOT NULL,
  `bg_image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bg_image_alt_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selected_background_image` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `background_images`
--

INSERT INTO `background_images` (`bg_image_id`, `bg_image_name`, `bg_image_alt_text`, `selected_background_image`) VALUES
(17, 'img1.jpg', '', 0),
(18, 'img2.jpg', '', 0),
(19, 'img3.jpg', '', 0),
(20, 'img4.jpg', '', 0),
(21, 'img5.jpg', '', 0),
(22, 'img6.jpg', '', 0),
(23, 'img7.jpg', '', 0),
(24, 'img8.jpg', '', 0),
(25, 'img9.jpg', '', 0),
(26, 'img10.jpg', '', 0),
(27, 'img11.jpg', '', 1),
(28, 'img12.jpg', '', 0),
(29, 'img13.jpg', '', 0),
(30, 'img14.jpg', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `biography`
--

CREATE TABLE `biography` (
  `biography_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `worker_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `worker_surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `worker_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_time` datetime NOT NULL,
  `worker_biography_document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '../../about.php',
  `proffesion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `business_network_images_files`
--
CREATE TABLE `business_network_images_files` (
`user_id` bigint(20) unsigned
,`image_file_id` bigint(20) unsigned
,`image_name` varchar(255)
,`uploaded_time` datetime
,`type` varchar(11)
,`db_table` varchar(22)
);

-- --------------------------------------------------------

--
-- Table structure for table `carousel_imgs`
--

CREATE TABLE `carousel_imgs` (
  `carousel_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `carousel_image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carousel_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carousel_image_upload_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_page`
--

CREATE TABLE `contact_page` (
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `e_mail` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_page_css`
--

CREATE TABLE `contact_page_css` (
  `contact_page_css_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_headline_content_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_headline_content_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_headline_content_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_headline_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_headline_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_headline_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_content_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_content_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_content_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_content_background_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_hide_second_div_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `full_calendar_events`
--

CREATE TABLE `full_calendar_events` (
  `event_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `full_calendar_notifications`
--

CREATE TABLE `full_calendar_notifications` (
  `notification_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `notification_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_page`
--

CREATE TABLE `gallery_page` (
  `gallery_page_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gallery_headline_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_headline_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_headline_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_carousel_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_carousel_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_carousel_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_carousel_background_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_first_div_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_first_div_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_first_div_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_first_div_content_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_first_div_content_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_first_div_content_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_first_div_background_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `index_page`
--

CREATE TABLE `index_page` (
  `index_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_headline_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_headline_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_headline_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_div_background_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_headline_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_headline_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_headline_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_div_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_div_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_div_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_div_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_div_background_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message_read` bigint(20) NOT NULL DEFAULT '0',
  `message_answer` bigint(20) NOT NULL,
  `message_answer_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages_admin`
--

CREATE TABLE `messages_admin` (
  `messages_admin_id` bigint(20) NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `read_msg` bigint(20) NOT NULL DEFAULT '0',
  `answer` bigint(20) NOT NULL,
  `answer_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phonebook`
--

CREATE TABLE `phonebook` (
  `phonebook_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phonebook_company_id` bigint(20) NOT NULL,
  `phonebook_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonebook_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonebook_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonebook_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonebook_contactperson` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preview_page`
--

CREATE TABLE `preview_page` (
  `preview_page_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `preview_headline_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_headline_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_headline_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_content_background_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_content_show_hide` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `preview_specifications_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_specifications_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_specifications_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_specifications_background_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_specifications_show_hide` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `preview_comment_show_hide` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `preview_commentsHeadline_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `preview_commentsHeadline_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_commentsHeadline_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_commentsContent_font_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_content_commentBackground_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_commentsContent_font_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_commentsContent_font_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_images`
--

CREATE TABLE `uploaded_images` (
  `uploaded_img_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uploaded_img_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image3.jpg',
  `uploaded_img_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_img_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_img_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_img_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `background_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'img10.jpg',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pib` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_broj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allow_email_message` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` bigint(20) NOT NULL DEFAULT '0',
  `register_time` datetime NOT NULL,
  `status` bigint(20) NOT NULL DEFAULT '0',
  `email_confirm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `left_menu_collapse` bigint(20) NOT NULL DEFAULT '1',
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_activities` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subsidiaries_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `background_img`, `name`, `pib`, `mat_broj`, `username`, `password`, `email`, `phone`, `city`, `address`, `allow_email_message`, `active`, `register_time`, `status`, `email_confirm`, `left_menu_collapse`, `contact_person`, `tags`, `business_description`, `business_activities`, `subsidiaries_address`, `ip_address`, `current_ip_address`) VALUES
(1, 'master_admin', 'img11.jpg', 'Network Admin', '', '', 'admin', '0192023a7bbd73250516f069df18b500', 'admin@admin.com', '', '', '', '', 1, '2016-09-01 00:00:00', 0, '', 1, '', '', '', '', '', '', '::1');

-- --------------------------------------------------------

--
-- Structure for view `business_network_images_files`
--
DROP TABLE IF EXISTS `business_network_images_files`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `business_network_images_files`  AS  select `uploaded_images`.`user_id` AS `user_id`,`uploaded_images`.`uploaded_img_id` AS `image_file_id`,`uploaded_images`.`uploaded_img_name` AS `image_name`,`uploaded_images`.`uploaded_img_time` AS `uploaded_time`,'informacije' AS `type`,'uploaded_images' AS `db_table` from `uploaded_images` union select `carousel_imgs`.`user_id` AS `user_id`,`carousel_imgs`.`carousel_id` AS `image_file_id`,`carousel_imgs`.`carousel_image_name` AS `image_name`,`carousel_imgs`.`carousel_image_upload_date` AS `uploaded_time`,'slajder' AS `type`,'carousel_imgs' AS `db_table` from `carousel_imgs` union select `biography`.`user_id` AS `user_id`,`biography`.`biography_id` AS `image_file_id`,`biography`.`worker_image` AS `image_name`,`biography`.`uploaded_time` AS `uploaded_time`,'biografija' AS `type`,'biography' AS `db_table` from `biography` union select `articles`.`user_id` AS `user_id`,`articles`.`article_id` AS `image_file_id`,`articles`.`article_img` AS `image_name`,`articles`.`article_uploaded_time` AS `uploaded_time`,'artikli' AS `type`,'articles' AS `db_table` from `articles` union select `article_details_images`.`user_id` AS `user_id`,`article_details_images`.`article_details_images_id` AS `image_file_id`,`article_details_images`.`article_img_name` AS `image_name`,`article_details_images`.`article_img_uploaded_time` AS `uploaded_time`,'artikli' AS `type`,'article_details_images' AS `db_table` from `article_details_images` union select `biography`.`user_id` AS `user_id`,`biography`.`biography_id` AS `image_file_id`,`biography`.`worker_biography_document` AS `image_name`,`biography`.`uploaded_time` AS `uploaded_time`,'fajlovi' AS `type`,'biography' AS `db_table` from `biography` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`about_us_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `add_biography_image`
--
ALTER TABLE `add_biography_image`
  ADD PRIMARY KEY (`new_biography_id`),
  ADD KEY `biography_id` (`biography_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `articles_marks`
--
ALTER TABLE `articles_marks`
  ADD PRIMARY KEY (`article_mark_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `article_details`
--
ALTER TABLE `article_details`
  ADD PRIMARY KEY (`article_details_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `article_details_images`
--
ALTER TABLE `article_details_images`
  ADD PRIMARY KEY (`article_details_images_id`),
  ADD KEY `article_details_id` (`article_details_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `background_images`
--
ALTER TABLE `background_images`
  ADD PRIMARY KEY (`bg_image_id`);

--
-- Indexes for table `biography`
--
ALTER TABLE `biography`
  ADD PRIMARY KEY (`biography_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `carousel_imgs`
--
ALTER TABLE `carousel_imgs`
  ADD PRIMARY KEY (`carousel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_page`
--
ALTER TABLE `contact_page`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_page_css`
--
ALTER TABLE `contact_page_css`
  ADD PRIMARY KEY (`contact_page_css_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `full_calendar_events`
--
ALTER TABLE `full_calendar_events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `full_calendar_notifications`
--
ALTER TABLE `full_calendar_notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gallery_page`
--
ALTER TABLE `gallery_page`
  ADD PRIMARY KEY (`gallery_page_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `index_page`
--
ALTER TABLE `index_page`
  ADD PRIMARY KEY (`index_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages_admin`
--
ALTER TABLE `messages_admin`
  ADD PRIMARY KEY (`messages_admin_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `phonebook`
--
ALTER TABLE `phonebook`
  ADD PRIMARY KEY (`phonebook_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `phonebook_company_id` (`phonebook_company_id`);

--
-- Indexes for table `preview_page`
--
ALTER TABLE `preview_page`
  ADD PRIMARY KEY (`preview_page_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `uploaded_images`
--
ALTER TABLE `uploaded_images`
  ADD PRIMARY KEY (`uploaded_img_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);
ALTER TABLE `users` ADD FULLTEXT KEY `name` (`name`);
ALTER TABLE `users` ADD FULLTEXT KEY `username` (`username`);
ALTER TABLE `users` ADD FULLTEXT KEY `email` (`email`);
ALTER TABLE `users` ADD FULLTEXT KEY `phone` (`phone`);
ALTER TABLE `users` ADD FULLTEXT KEY `city` (`city`);
ALTER TABLE `users` ADD FULLTEXT KEY `address` (`address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `about_us_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `add_biography_image`
--
ALTER TABLE `add_biography_image`
  MODIFY `new_biography_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articles_marks`
--
ALTER TABLE `articles_marks`
  MODIFY `article_mark_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `article_details`
--
ALTER TABLE `article_details`
  MODIFY `article_details_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `article_details_images`
--
ALTER TABLE `article_details_images`
  MODIFY `article_details_images_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `background_images`
--
ALTER TABLE `background_images`
  MODIFY `bg_image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `biography`
--
ALTER TABLE `biography`
  MODIFY `biography_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carousel_imgs`
--
ALTER TABLE `carousel_imgs`
  MODIFY `carousel_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_page`
--
ALTER TABLE `contact_page`
  MODIFY `contact_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_page_css`
--
ALTER TABLE `contact_page_css`
  MODIFY `contact_page_css_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `full_calendar_events`
--
ALTER TABLE `full_calendar_events`
  MODIFY `event_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `full_calendar_notifications`
--
ALTER TABLE `full_calendar_notifications`
  MODIFY `notification_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery_page`
--
ALTER TABLE `gallery_page`
  MODIFY `gallery_page_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `index_page`
--
ALTER TABLE `index_page`
  MODIFY `index_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages_admin`
--
ALTER TABLE `messages_admin`
  MODIFY `messages_admin_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `phonebook`
--
ALTER TABLE `phonebook`
  MODIFY `phonebook_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `preview_page`
--
ALTER TABLE `preview_page`
  MODIFY `preview_page_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `uploaded_images`
--
ALTER TABLE `uploaded_images`
  MODIFY `uploaded_img_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `about_us`
--
ALTER TABLE `about_us`
  ADD CONSTRAINT `fk_about_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `add_biography_image`
--
ALTER TABLE `add_biography_image`
  ADD CONSTRAINT `fk_addbiographyimages_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles_marks`
--
ALTER TABLE `articles_marks`
  ADD CONSTRAINT `fk_articlesmarks_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_articlesmarks_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_details`
--
ALTER TABLE `article_details`
  ADD CONSTRAINT `fk_articledetails_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_articledetails_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_details_images`
--
ALTER TABLE `article_details_images`
  ADD CONSTRAINT `fk_articledetailsimages_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_articledetailsimages_articles_details` FOREIGN KEY (`article_details_id`) REFERENCES `article_details` (`article_details_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_articledetailsimages_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `biography`
--
ALTER TABLE `biography`
  ADD CONSTRAINT `fk_biography_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carousel_imgs`
--
ALTER TABLE `carousel_imgs`
  ADD CONSTRAINT `fk_carousel_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_page`
--
ALTER TABLE `contact_page`
  ADD CONSTRAINT `fk_contactpage_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_page_css`
--
ALTER TABLE `contact_page_css`
  ADD CONSTRAINT `fk_contactcss_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `full_calendar_events`
--
ALTER TABLE `full_calendar_events`
  ADD CONSTRAINT `fk_fullcalendar_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `full_calendar_notifications`
--
ALTER TABLE `full_calendar_notifications`
  ADD CONSTRAINT `fk_fullcalendarnotifications_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery_page`
--
ALTER TABLE `gallery_page`
  ADD CONSTRAINT `fk_gallery_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `index_page`
--
ALTER TABLE `index_page`
  ADD CONSTRAINT `fk_index_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phonebook`
--
ALTER TABLE `phonebook`
  ADD CONSTRAINT `fk_phonebook_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preview_page`
--
ALTER TABLE `preview_page`
  ADD CONSTRAINT `fk_previewpage_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uploaded_images`
--
ALTER TABLE `uploaded_images`
  ADD CONSTRAINT `fk_uploadedimgs_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
