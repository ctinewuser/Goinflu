-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2022 at 07:30 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctinf0eg_goinflu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `city` varchar(255) NOT NULL,
  `percent` varchar(10) NOT NULL,
  `ads_count` int(11) NOT NULL,
  `remember` varchar(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `company`, `email`, `password`, `image`, `pass`, `city`, `percent`, `ads_count`, `remember`, `first_name`, `last_name`, `bio`, `mobile_number`, `language`, `location`, `created_at`) VALUES
(1, 'GoInflu', 'Test GOinflu', 'goinflu@mailinator.com', 'e10adc3949ba59abbe56e057f20f883e', 'b386073cd29ba85d3c9b0218209331ae.png', '123456', '', '5', 0, 'on', 'GoInflu', 'AdminProfile', 'GoInflu  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 2000s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ', '7897895241', 'German', 'Indore(M.P.)', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `messages_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_image` varchar(522) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `receiver_image` varchar(522) NOT NULL,
  `messages` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` longtext NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-unseen, 0-seen',
  `refer_id` varchar(255) NOT NULL,
  `datetime` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`messages_id`, `sender_id`, `sender_name`, `sender_image`, `receiver_id`, `receiver_name`, `receiver_image`, `messages`, `image`, `type`, `status`, `refer_id`, `datetime`, `created_at`) VALUES
(1, 8, 'Shikha', '41e715392330daebe17d09d10e97db5a.jpg', 4, 'Neha', '41e715392330daebe17d09d10e97db5a.jpg', 'Test Chat!!', '', 0, 0, '1', '2021/08/11', '2021-11-08 00:00:00'),
(2, 8, 'Yuvraj', '41e715392330daebe17d09d10e97db5a.jpg', 4, 'Nancy', '41e715392330daebe17d09d10e97db5a.jpg', 'Test Chat!!', '', 0, 0, '1', '2021/08/11', '2021-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `chat_schdule`
--

CREATE TABLE `chat_schdule` (
  `id` int(11) NOT NULL,
  `chat_by` int(255) NOT NULL,
  `chat_with` int(255) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'in Euro',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `end_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL COMMENT '0=pending, 1=accept, 2=reject',
  `chat_duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'in min.',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chat_schdule`
--

INSERT INTO `chat_schdule` (`id`, `chat_by`, `chat_with`, `price`, `date`, `time`, `end_datetime`, `status`, `chat_duration`, `created_at`) VALUES
(1, 8, 41, '50', '2021-11-10', '14:34:50', '2022-01-19 00:00:00', 0, '5', '2022-01-13 10:49:37'),
(6, 47, 48, '30', '2021-11-10', '18:28:35', '2022-01-19 00:00:00', 0, '5', '2022-01-14 06:18:43'),
(8, 8, 44, '5', '2021-11-10', '18:28:35', '2022-01-19 00:00:00', 0, '5', '2022-01-13 10:49:37'),
(10, 48, 47, '5', '2021-11-10', '18:28:35', '2022-01-19 00:00:00', 0, '5', '2022-01-18 12:56:43'),
(15, 51, 47, '5', '2021-11-10', '18:28:35', '2022-01-19 00:00:00', 0, '5', '2022-01-18 12:23:16'),
(16, 58, 54, '5', '2021-11-10', '18:28:35', '2022-01-19 00:00:00', 0, '5', '2022-01-14 07:47:35'),
(17, 52, 47, '58', '2021-11-10', '18:28:35', '2022-01-19 00:00:00', 0, '5', '2022-01-18 12:23:19'),
(69, 48, 41, '50', '2022-01-21', '17:00:00', '2022-01-21 17:05:00', 0, '5', '2022-01-19 11:28:55'),
(70, 48, 41, '50', '2022-01-06', '17:08:00', '2022-01-06 17:13:00', 0, '5', '2022-01-19 11:36:14'),
(71, 48, 41, '50', '2022-01-21', '17:14:00', '2022-01-21 17:19:00', 0, '5', '2022-01-19 11:44:08'),
(72, 58, 41, '50', '2022-01-07', '20:08:00', '2022-01-07 20:13:00', 0, '5', '2022-01-24 13:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `concerts`
--

CREATE TABLE `concerts` (
  `concert_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `concert_title` varchar(255) NOT NULL,
  `concert_time` time NOT NULL,
  `concert_date` date NOT NULL,
  `concert_venue` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `concert_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `concerts`
--

INSERT INTO `concerts` (`concert_id`, `user_id`, `concert_title`, `concert_time`, `concert_date`, `concert_venue`, `description`, `created_at`, `concert_image`) VALUES
(1, 18, 'Hiphop Musics', '10:55:00', '2021-08-05', ' Clerk Colony. Address: 505, Alma HQ Road, Clerk Colony', 'Hiphop Artist on the floor yeah!!   ', '2021-07-31 12:47:29', 'musicicon.png'),
(2, 18, 'Zumba', '10:55:00', '2021-08-05', ' Clerk Colony. Address: 505, Alma HQ Road, Clerk Colony', 'Zumba Fitness on the floor yeah!!', '2021-07-31 12:47:36', 'musicicon.png'),
(3, 18, 'PT training', '10:55:00', '2021-08-05', ' Clerk Colony. Address: 505, Alma HQ Road, Clerk Colony', 'Personal Training for fitness yeah!!', '2021-07-31 12:47:39', 'musicicon.png'),
(12, 8, 'Konzert', '20:45:00', '0000-00-00', 'Garage', 'Fette Party', '2021-09-30 05:58:02', '');

-- --------------------------------------------------------

--
-- Table structure for table `concert_booking`
--

CREATE TABLE `concert_booking` (
  `id` int(11) NOT NULL,
  `concert_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `concert_booking`
--

INSERT INTO `concert_booking` (`id`, `concert_id`, `user_id`, `created_at`) VALUES
(1, '1', '8', '2021-08-25 13:54:20'),
(2, '2', '29', '2021-08-25 13:54:37'),
(3, '3', '29', '2021-08-25 13:54:45'),
(5, '1', '30', '2021-08-25 13:54:23'),
(6, '3', '30', '2021-08-25 13:54:49'),
(7, '1', '23', '2021-08-25 13:54:27'),
(8, '3', '23', '2021-08-25 13:54:53'),
(10, '2', '8', '2021-08-25 13:54:33'),
(11, '3', '8', '2021-08-25 13:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `contact_about`
--

CREATE TABLE `contact_about` (
  `id` int(11) NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contactnumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_about`
--

INSERT INTO `contact_about` (`id`, `data`, `email`, `contactnumber`, `address`, `type`, `created_at`) VALUES
(1, 'Goinflu About Us details Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged about.', '', '', '', 'About Us', '2022-01-27 12:53:33'),
(2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. ', 'Goinflu@gmail.com', '9893859874', 'Clerk Colony. Address: 505, Alma HQ Road, Clerk Colony Indore', 'Contact Us', '2022-01-27 12:53:18'),
(3, 'Terms and Services Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Terms GoInflu', '', '', '', 'Terms Services', '2022-01-27 12:52:38'),
(4, '<p style=\"font-size:28\">\r\nPrivacy Policy \r\nLorem dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. privacy policy goinflu</p>\r\n\r\n', '', '', '', 'Privacy Policy ', '2022-01-27 12:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `create_group`
--

CREATE TABLE `create_group` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tittle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `members` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `create_group`
--

INSERT INTO `create_group` (`id`, `user_id`, `tittle`, `description`, `image`, `banner_image`, `members`, `created_at`) VALUES
(1, '18', 'Musical God', 'Test Group Users', '186dfdfade221cc3a9c123d7c91faccf.jpg', '186dfdfade221cc3a9c123d7c91faccf.jpg', '18', '31-07-2020 11:29:40'),
(2, '8', 'Digital Creator', 'Test Group Users', '186dfdfade221cc3a9c123d7c91faccf.jpg', '186dfdfade221cc3a9c123d7c91faccf.jpg', '24', '31-07-2020 11:29:40'),
(3, '8', 'Marketing ', 'Test Group Users', '186dfdfade221cc3a9c123d7c91faccf.jpg', '186dfdfade221cc3a9c123d7c91faccf.jpg', '24,8,23', '31-07-2020 11:29:40'),
(4, '18', 'Urban Artist', 'Urban Test Users', '186dfdfade221cc3a9c123d7c91faccf.jpg', '186dfdfade221cc3a9c123d7c91faccf.jpg', '18,8,23', '31-07-2020 11:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE `follower` (
  `id` int(11) NOT NULL,
  `influencer_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`id`, `influencer_id`, `user_id`, `created_at`) VALUES
(6, '8', '30', '2021-08-13 11:55:19'),
(7, '8', '29', '2021-08-13 11:55:19'),
(14, '8', '8', '2021-09-21 14:55:07'),
(50, '76', '8', '2022-01-15 09:23:34'),
(55, '58', '47', '2022-01-17 13:38:02'),
(62, '78', '47', '2022-01-18 05:56:49'),
(64, '66', '47', '2022-01-18 06:04:14'),
(72, '51', '52', '2022-01-18 07:32:06'),
(73, '51', '8', '2022-01-18 07:32:11'),
(88, '41', '48', '2022-01-18 12:55:03'),
(91, '41', '58', '2022-01-24 13:34:01'),
(92, '58', '76', '2022-01-24 13:41:45'),
(93, '41', '47', '2022-01-25 10:05:10'),
(94, '47', '8', '2022-01-25 10:23:12'),
(95, '47', '82', '2022-01-25 10:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `influencer_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `influencer_id`, `created_at`) VALUES
(2, '29', '22', '2021-07-29 11:44:05'),
(3, '23', '24', '2021-08-23 09:41:50'),
(5, '30', '29', '2021-08-12 07:19:42'),
(6, '30', '23', '2021-08-16 09:40:01'),
(7, '30', '18', '2021-08-16 09:40:03'),
(8, '30', '22', '2021-08-16 09:40:04'),
(9, '23', '29', '2021-08-23 09:41:50'),
(10, '23', '30', '2021-07-31 11:36:39'),
(12, '23', '22', '2021-08-24 11:16:02'),
(36, '8', '22', '2021-09-15 10:38:48'),
(38, '8', '', '2021-09-15 10:39:09'),
(41, '8', '29', '2021-09-15 10:48:00'),
(45, '8', '', '2021-09-16 12:07:03'),
(46, '22', '', '2021-09-16 12:29:58'),
(48, '8', '', '2021-09-20 09:55:28'),
(51, '22', '23', '2021-09-20 12:04:12'),
(52, '8', '30', '2021-09-20 12:58:48'),
(53, '8', '', '2021-09-20 12:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `status`, `image`, `created_at`) VALUES
(1, 'Hindi', 0, 'india.png', '2022-01-06 12:48:21'),
(2, 'English', 0, 'united-kingdom.png', '2022-01-06 12:09:35'),
(3, 'German', 0, 'germany.png', '2022-01-06 12:09:14'),
(4, 'Chinese', 0, 'china.png', '2022-01-06 12:48:45'),
(5, 'Spanish', 0, 'spain.png', '2022-01-06 12:51:19'),
(6, 'Russian', 0, 'russia.png', '2022-01-06 12:09:24'),
(7, 'Turkish', 0, 'turkey.png', '2022-01-06 12:50:06'),
(8, 'Italian', 0, 'italy.png', '2022-01-06 12:48:33'),
(9, 'Japanese', 0, 'japan.png', '2022-01-06 12:51:10'),
(10, 'Korean', 0, 'south-korea.png', '2022-01-06 12:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` date NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 post , 2 share 3 member request',
  `refer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `message`, `user_id`, `created_time`, `created_at`, `type_name`, `type`, `refer_id`) VALUES
(1, 'Dev 2 liked your post', 4, '2021-09-17 12:56:25', '2021-09-17', 'Like', 1, 3),
(2, 'Dev 2 liked your post', 47, '2022-01-20 10:42:26', '2021-09-17', 'Goinflu', 4, 3),
(101, 'what uni did you go to and what did you study?', 8, '2021-11-08 10:43:19', '2021-10-30', 'University', 4, 0),
(111, 'Notification New Data!!', 15, '2021-11-08 10:43:19', '2021-10-30', 'University', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `bitpack_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `txn_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_gross` float(10,2) NOT NULL,
  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `payer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payer_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `bitpack_id`, `user_id`, `txn_id`, `payment_gross`, `currency_code`, `payer_name`, `payer_email`, `status`, `created_at`) VALUES
(3, 2, 23, '15E390324V3213948', 600.00, 'USD', '', 'sb-tsp6h7437792@business.example.com', 'Completed', '2021-09-01 07:08:16'),
(4, 2, 23, '0MT386944M0773814', 600.00, 'USD', '', 'sb-tsp6h7437792@business.example.com', 'Completed', '2021-09-01 07:13:07'),
(5, 2, 23, '92C9711691473935J', 600.00, 'USD', '', 'sb-tsp6h7437792@business.example.com', 'Completed', '2021-09-01 07:14:54'),
(6, 3, 23, '5H9298134M476852C', 350.00, 'USD', 'John Doe', 'sb-tsp6h7437792@business.example.com', 'Completed', '2021-09-01 07:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `amount_in_euro` varchar(255) NOT NULL COMMENT 'in euro',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plan_users`
--

CREATE TABLE `plan_users` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `plan_amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images' COMMENT 'images,video,song',
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_like` int(11) NOT NULL DEFAULT '0',
  `total_comment` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `post_type`, `description`, `total_like`, `total_comment`, `created_at`) VALUES
(1, 8, 'images', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1, 1, '2022-01-25 09:55:45'),
(2, 8, 'images', 'Lorem ipsum dolor sit amet, consectetur adipiscing ', 0, 2, '2022-01-18 10:39:49'),
(6, 8, 'images', 'Lorem ', 1, 3, '2022-01-19 10:40:29'),
(7, 54, 'images', 'Loreum ipsum', 0, 0, '2022-01-18 10:44:32'),
(8, 51, 'images', 'German', 1, 0, '2022-01-18 10:44:05'),
(9, 44, 'images', 'new post', 3, 2, '2022-01-19 13:26:08'),
(40, 48, 'images', 'newwww', 0, 2, '2022-01-27 08:05:00'),
(11, 52, 'images', 'so great', 1, 1, '2022-01-25 09:33:03'),
(12, 67, 'images', 'ciao come stai', 2, 5, '2022-01-25 11:12:10'),
(21, 81, 'images', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, 0, '2022-01-24 13:40:59'),
(3, 77, 'images', ' vf ygcgv', 0, 9, '2022-01-18 10:44:59'),
(4, 78, 'images', ' vf ygcgv', 0, 9, '2022-01-17 10:54:08'),
(5, 58, 'images', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 0, 1, '2022-01-27 08:05:51'),
(34, 47, 'images', 'my latest post', 1, 1, '2022-01-27 07:53:48'),
(36, 52, 'images', 'egdgfdgfdf', 0, 0, '2022-01-24 23:56:36'),
(37, 41, 'images', 'Neeeewwwww', 0, 6, '2022-01-27 07:30:20'),
(38, 58, 'images', 'Test', 3, 15, '2022-01-27 07:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE `post_comment` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` varchar(2555) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` date NOT NULL,
  `created_time` time NOT NULL,
  `refer_id` int(11) NOT NULL,
  `total_like` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_comment`
--

INSERT INTO `post_comment` (`comment_id`, `post_id`, `reciever_id`, `sender_id`, `message`, `created_date`, `created_time`, `refer_id`, `total_like`, `created_at`) VALUES
(28, 38, 8, 0, ' gcggvtc', '2022-01-03', '12:30:23', 0, 2, '2022-01-27 06:15:23'),
(29, 9, 48, 0, 'hello', '2022-01-04', '20:28:55', 0, 2, '2022-01-25 11:54:57'),
(70, 39, 8, 0, 'Nain Test New Comment!!', '2021-12-27', '13:41:06', 0, 0, '2021-12-27 08:11:06'),
(99, 60, 8, 0, 'test', '2021-12-28', '19:01:00', 0, 0, '2021-12-28 13:31:00'),
(110, 10, 47, 0, 'nice', '2022-01-07', '15:56:57', 0, 0, '2022-01-07 10:26:57'),
(111, 12, 76, 0, 'sto bene', '2022-01-09', '13:37:08', 0, 0, '2022-01-09 08:07:08'),
(112, 12, 76, 0, 'ciao come stai ', '2022-01-09', '18:34:56', 0, 0, '2022-01-09 13:04:56'),
(113, 13, 8, 0, 'hy', '2022-01-11', '16:58:43', 0, 0, '2022-01-11 11:28:43'),
(114, 12, 76, 0, 'jeybbv', '2022-01-11', '17:06:19', 0, 0, '2022-01-11 11:36:19'),
(117, 12, 76, 0, ' uvvouviuicy', '2022-01-12', '12:32:03', 0, 0, '2022-01-12 07:02:03'),
(118, 6, 41, 0, 'hy', '2022-01-12', '17:30:47', 0, 0, '2022-01-12 12:00:47'),
(119, 6, 41, 0, 'dghafhwfh', '2022-01-12', '17:35:43', 0, 0, '2022-01-12 12:05:43'),
(120, 6, 41, 0, 'hy', '2022-01-12', '17:40:36', 0, 0, '2022-01-12 12:10:36'),
(121, 14, 8, 0, 'uhhununi', '2022-01-12', '17:42:45', 0, 0, '2022-01-12 12:12:45'),
(124, 14, 8, 0, 'h', '2022-01-12', '17:44:43', 0, 0, '2022-01-12 12:14:43'),
(128, 14, 8, 0, 'ucgcixuycoucoh', '2022-01-12', '17:51:42', 0, 0, '2022-01-12 12:21:42'),
(131, 10, 47, 0, 'ugvuuv', '2022-01-12', '18:37:26', 0, 0, '2022-01-12 13:07:26'),
(132, 10, 47, 0, 'new', '2022-01-12', '18:37:35', 0, 0, '2022-01-12 13:07:35'),
(133, 22, 41, 0, 'hy', '2022-01-18', '18:25:14', 0, 0, '2022-01-18 12:55:14'),
(134, 10, 47, 0, 'j', '2022-01-20', '15:30:10', 0, 0, '2022-01-20 10:00:10'),
(135, 10, 47, 0, 'givvjv', '2022-01-20', '15:31:30', 0, 0, '2022-01-20 10:01:30'),
(136, 37, 41, 0, ' hy', '2022-01-24', '17:58:14', 0, 0, '2022-01-24 12:28:14'),
(137, 38, 58, 0, 'Testing', '2022-01-24', '19:02:22', 0, 0, '2022-01-24 13:32:22'),
(138, 37, 41, 0, 'tedt', '2022-01-24', '19:04:15', 0, 0, '2022-01-24 13:34:15'),
(139, 38, 58, 0, 'test comment', '2022-01-24', '19:10:20', 0, 0, '2022-01-24 13:40:20'),
(140, 38, 58, 0, 'ciao', '2022-01-24', '19:12:23', 0, 0, '2022-01-24 13:42:23'),
(141, 38, 58, 0, 'new', '2022-01-25', '15:00:08', 0, 0, '2022-01-25 09:30:08'),
(142, 37, 41, 0, 'ycvuvuvu', '2022-01-25', '15:01:48', 0, 0, '2022-01-25 09:31:48'),
(143, 11, 52, 0, 'Nain Test New Comment!!', '2022-01-25', '15:03:03', 0, 0, '2022-01-25 09:33:03'),
(144, 38, 58, 0, 'hfkchhdllud', '2022-01-25', '15:09:30', 0, 0, '2022-01-25 09:39:30'),
(145, 39, 47, 0, 'gcbjbjhi.', '2022-01-25', '15:14:44', 0, 0, '2022-01-25 09:44:44'),
(146, 38, 58, 0, 'other', '2022-01-25', '15:14:59', 0, 0, '2022-01-25 09:44:59'),
(147, 37, 41, 0, 'hhnh', '2022-01-25', '15:15:24', 0, 0, '2022-01-25 09:45:24'),
(148, 38, 58, 0, 'ndndnd', '2022-01-25', '15:18:40', 0, 0, '2022-01-25 09:48:40'),
(149, 38, 47, 0, 'Nain Test New Comment!', '2022-01-25', '15:21:00', 0, 1, '2022-01-25 12:18:53'),
(150, 38, 47, 0, 'my post', '2022-01-25', '15:24:33', 0, 1, '2022-01-25 12:18:43'),
(151, 10, 47, 0, 'new', '2022-01-25', '15:25:17', 0, 0, '2022-01-25 09:55:17'),
(152, 1, 47, 0, 'new', '2022-01-25', '15:25:45', 0, 0, '2022-01-25 09:55:45'),
(153, 38, 47, 0, 'hello', '2022-01-25', '15:45:27', 0, 1, '2022-01-27 06:15:45'),
(154, 12, 76, 0, 'Ok', '2022-01-25', '16:42:10', 0, 0, '2022-01-25 11:12:10'),
(164, 38, 58, 47, 'Test!!!! last', '2022-01-25', '18:52:36', 28, 1, '2022-01-27 06:12:47'),
(165, 38, 58, 48, 'ok yfcguvgi hbi', '2022-01-27', '11:43:07', 164, 0, '2022-01-27 06:15:03'),
(166, 38, 58, 48, 'hy', '2022-01-27', '11:54:21', 153, 1, '2022-01-27 06:24:31'),
(167, 38, 58, 48, 'hyyy', '2022-01-27', '12:39:17', 165, 1, '2022-01-27 07:12:22'),
(168, 37, 41, 48, 'hy', '2022-01-27', '12:59:55', 147, 1, '2022-01-27 07:30:02'),
(169, 37, 41, 48, 'hyyy', '2022-01-27', '13:00:20', 136, 0, '2022-01-27 07:30:20'),
(170, 34, 47, 0, 'hy', '2022-01-27', '13:23:48', 0, 0, '2022-01-27 07:53:48'),
(171, 40, 48, 0, 'hy', '2022-01-27', '13:33:53', 0, 0, '2022-01-27 08:03:53'),
(172, 40, 48, 48, 'hello', '2022-01-27', '13:35:00', 171, 0, '2022-01-27 08:05:00'),
(173, 5, 48, 0, 'hello', '2022-01-27', '13:35:51', 0, 0, '2022-01-27 08:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `post_comment_like`
--

CREATE TABLE `post_comment_like` (
  `like_id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `created_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_comment_like`
--

INSERT INTO `post_comment_like` (`like_id`, `user_id`, `comment_id`, `group_id`, `created_date`, `created_time`) VALUES
(1, '8', '1', 0, '2021-07-23', '19:15:28'),
(3, '8', '5', 0, '2021-07-23', '19:17:57'),
(6, '23', '2', 0, '2021-07-23', '20:08:21'),
(7, '23', '7', 0, '2021-07-23', '20:08:35'),
(12, '8', '40', 0, '2021-07-30', '16:41:01'),
(14, '8', '10', 0, '2021-07-30', '16:41:28'),
(15, '30', '12', 0, '2021-07-30', '17:57:42'),
(20, '8', '22', 0, '2021-08-04', '01:11:56'),
(24, '8', '28', 0, '2021-08-16', '18:21:22'),
(27, '22', '35', 0, '2021-09-16', '17:38:08'),
(29, '8', '46', 0, '2021-09-22', '15:07:47'),
(30, '8', '45', 0, '2021-09-27', '19:13:27'),
(32, '47', '28', 0, '2022-01-25', '17:08:58'),
(33, '8', '29', 0, '2022-01-25', '17:24:44'),
(34, '47', '29', 0, '2022-01-25', '17:24:57'),
(35, '22', '28', 0, '2022-01-25', '17:26:13'),
(37, '48', '150', 0, '2022-01-25', '17:48:43'),
(38, '48', '149', 0, '2022-01-25', '17:48:53'),
(40, '48', '164', 0, '2022-01-27', '11:42:47'),
(42, '48', '28', 0, '2022-01-27', '11:45:23'),
(43, '48', '153', 0, '2022-01-27', '11:45:45'),
(44, '48', '166', 0, '2022-01-27', '11:54:31'),
(45, '48', '167', 0, '2022-01-27', '12:42:22'),
(46, '48', '168', 0, '2022-01-27', '13:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `post_image`
--

CREATE TABLE `post_image` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `post_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_type` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'images,video,song',
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_image`
--

INSERT INTO `post_image` (`id`, `user_id`, `group_id`, `post_id`, `image`, `post_type`, `created_at`) VALUES
(1, '8', 0, '1', 'cfeab0ab4dc0348fc6ee93623a8b4145.jpeg', '', '0000-00-00 00:00:00'),
(2, '8', 0, '2', '5647e6caffd79a2033ceabdc44c69aaa.png', '', '0000-00-00 00:00:00'),
(3, '8', 0, '7', '6e5b259349b4eb0d857f24d6b0b0a4ca.png', '', '2022-01-04 17:49:44'),
(4, '41', 0, '4', '6e5b259349b4eb0d857f24d6b0b0a4ca.png', '', '2022-01-04 17:49:44'),
(5, '48', 0, '9', 'e8d53bdb42bf78bab1223734828defcd.jpg', '', '2022-01-04 18:44:06'),
(23, '48', 0, '40', '9f1a9daaec0538f0e8ce5fe4b38d6cb9.jpg', '', '2022-01-27 13:33:36'),
(7, '76', 0, '11', 'd78b110761ad259f02e1c5f32da06293.jpg', '', '2022-01-04 20:30:38'),
(8, '76', 0, '12', '2aeb1eb5aece0b27ab73cac189cbd865.jpg', '', '2022-01-09 13:36:52'),
(20, '47', 0, '34', '0bcb0b040eedeaa732858ff7c13c8aca.jpg', '', '2022-01-20 17:38:15'),
(10, '48', 0, '8', '6e5b259349b4eb0d857f24d6b0b0a4ca.png', '', '2022-01-04 17:49:44'),
(11, '48', 0, '5', '6e5b259349b4eb0d857f24d6b0b0a4ca.png', '', '2022-01-04 17:49:44'),
(12, '48', 0, '6', '6e5b259349b4eb0d857f24d6b0b0a4ca.png', '', '2022-01-04 17:49:44'),
(21, '58', 0, '38', '0e5577e37160f384ed7e75353670e334.jpg', '', '2022-01-24 19:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `created_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`like_id`, `user_id`, `post_id`, `group_id`, `created_date`, `created_time`) VALUES
(363, 8, 9, 0, '2022-01-07', '15:56:13'),
(364, 8, 1, 0, '2022-01-07', '15:56:28'),
(366, 76, 8, 0, '2022-01-09', '13:37:39'),
(367, 76, 9, 0, '2022-01-09', '13:37:44'),
(368, 76, 11, 0, '2022-01-09', '13:37:56'),
(370, 8, 6, 0, '2022-01-12', '17:30:33'),
(373, 8, 12, 0, '2022-01-15', '14:53:17'),
(374, 48, 18, 0, '2022-01-18', '18:24:52'),
(376, 47, 9, 0, '2022-01-19', '18:56:08'),
(379, 47, 34, 0, '2022-01-20', '17:48:28'),
(380, 0, 0, 0, '2022-01-21', '10:35:28'),
(381, 58, 38, 0, '2022-01-24', '19:02:12'),
(382, 76, 12, 0, '2022-01-24', '19:10:54'),
(383, 76, 21, 0, '2022-01-24', '19:10:59'),
(386, 47, 38, 0, '2022-01-25', '13:39:48'),
(387, 48, 38, 0, '2022-01-25', '17:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `post_schdule`
--

CREATE TABLE `post_schdule` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `influencer_id` int(255) NOT NULL,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'in euro',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending, 1=accept, 2=reject',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_schdule`
--

INSERT INTO `post_schdule` (`id`, `user_id`, `influencer_id`, `post_id`, `price`, `description`, `date`, `time`, `status`, `created_at`) VALUES
(1, 41, 52, 47, '50', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '2021-11-17', '12:33:09', 0, '2022-01-17 07:53:41'),
(2, 77, 66, 47, '50', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2021-11-18', '10:33:09', 0, '2022-01-17 07:53:51'),
(4, 47, 52, 47, '52', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2021-11-18', '11:33:09', 1, '2022-01-24 10:55:06'),
(6, 47, 48, 47, '52', 'Test New Post!!', '2021-11-18', '11:33:09', 1, '2022-01-18 13:33:48'),
(7, 51, 52, 47, '52', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy .', '2021-11-18', '11:33:09', 0, '2022-01-18 11:22:20'),
(9, 48, 51, 0, '50', 'Test Post Schdule!', '2022-01-20', '23:57:00', 0, '2022-01-19 09:50:11'),
(15, 48, 51, 0, '50', 'Post description test!', '2022-01-20', '23:57:00', 0, '2022-01-19 10:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `post_share`
--

CREATE TABLE `post_share` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `share_to` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `share_link` varchar(522) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_share`
--

INSERT INTO `post_share` (`id`, `post_id`, `share_to`, `user_id`, `share_link`, `created_at`) VALUES
(1, 11, 18, 30, '?post_id=11', '2021-08-17 07:52:10'),
(2, 3, 22, 30, '?post_id=3', '2021-08-17 07:52:29'),
(3, 11, 29, 30, '?post_id=11', '2021-08-17 10:03:32'),
(4, 11, 29, 30, '?post_id=11', '2021-08-17 10:08:43'),
(5, 11, 29, 30, '?post_id=11', '2021-08-17 10:09:08'),
(6, 11, 29, 30, '?post_id=11', '2021-08-17 10:13:51'),
(7, 11, 29, 30, '?post_id=11', '2021-08-17 10:19:59'),
(8, 11, 23, 30, '?post_id=11', '2021-08-17 10:20:00'),
(9, 9, 29, 30, '?post_id=9', '2021-08-17 10:20:08'),
(10, 9, 23, 30, '?post_id=9', '2021-08-17 10:20:10'),
(11, 9, 18, 30, '?post_id=9', '2021-08-17 10:20:11'),
(12, 9, 22, 30, '?post_id=9', '2021-08-17 10:20:12'),
(13, 3, 29, 30, '?post_id=3', '2021-08-17 10:20:44'),
(14, 3, 29, 30, '?post_id=3', '2021-08-17 10:20:45'),
(15, 3, 29, 30, '?post_id=3', '2021-08-17 10:20:45'),
(16, 3, 23, 30, '?post_id=3', '2021-08-17 10:20:46'),
(17, 3, 18, 30, '?post_id=3', '2021-08-17 10:20:48'),
(18, 3, 22, 30, '?post_id=3', '2021-08-17 10:20:49'),
(19, 11, 29, 30, '?post_id=11', '2021-08-17 10:21:16'),
(20, 11, 29, 30, '?post_id=11', '2021-08-17 10:21:17'),
(21, 11, 29, 30, '?post_id=11', '2021-08-17 10:21:17'),
(22, 11, 23, 30, '?post_id=11', '2021-08-17 10:21:18'),
(23, 11, 23, 30, '?post_id=11', '2021-08-17 10:21:18'),
(24, 11, 18, 30, '?post_id=11', '2021-08-17 10:21:21'),
(25, 11, 22, 30, '?post_id=11', '2021-08-17 10:21:23'),
(26, 11, 29, 30, '?post_id=11', '2021-08-17 10:21:33'),
(27, 11, 23, 30, '?post_id=11', '2021-08-17 10:21:35'),
(28, 11, 18, 30, '?post_id=11', '2021-08-17 10:21:36'),
(29, 11, 22, 30, '?post_id=11', '2021-08-17 10:21:38'),
(30, 11, 23, 8, '?post_id=11', '2021-08-17 13:04:42'),
(31, 11, 23, 8, '?post_id=11', '2021-08-19 10:44:14'),
(32, 11, 23, 8, '?post_id=11', '2021-08-19 10:45:17'),
(33, 18, 23, 22, '?post_id=18', '2021-08-19 10:49:41'),
(34, 3, 23, 22, '?post_id=3', '2021-08-19 10:50:48'),
(35, 3, 23, 22, '?post_id=3', '2021-08-19 10:53:58'),
(36, 3, 23, 22, '?post_id=3', '2021-08-19 11:01:55'),
(37, 11, 22, 30, '?post_id=11', '2021-08-19 11:54:08'),
(38, 11, 18, 30, '?post_id=11', '2021-08-19 11:54:08'),
(39, 11, 23, 30, '?post_id=11', '2021-08-19 11:54:08'),
(40, 11, 29, 30, '?post_id=11', '2021-08-19 11:54:08'),
(41, 11, 0, 30, '?post_id=11', '2021-08-19 11:54:24'),
(42, 11, 0, 30, '?post_id=11', '2021-08-19 11:54:35'),
(43, 11, 22, 30, '?post_id=11', '2021-08-19 11:54:44'),
(44, 11, 18, 30, '?post_id=11', '2021-08-19 11:54:44'),
(45, 11, 23, 30, '?post_id=11', '2021-08-19 11:54:44'),
(46, 11, 29, 30, '?post_id=11', '2021-08-19 11:54:44'),
(47, 11, 18, 30, '?post_id=11', '2021-08-19 12:18:55'),
(48, 11, 22, 30, '?post_id=11', '2021-08-19 12:18:55'),
(49, 11, 23, 30, '?post_id=11', '2021-08-19 12:18:55'),
(50, 11, 18, 30, '?post_id=11', '2021-08-19 12:19:07'),
(51, 1, 29, 30, '?post_id=1', '2021-08-19 12:19:35'),
(52, 3, 23, 22, '?post_id=3', '2021-08-19 14:27:08'),
(53, 11, 23, 30, '?post_id=11', '2021-08-20 05:50:11'),
(54, 11, 29, 30, '?post_id=11', '2021-08-20 05:50:12'),
(55, 1, 29, 30, '?post_id=1', '2021-08-20 05:53:45'),
(56, 1, 23, 30, '?post_id=1', '2021-08-20 05:53:45'),
(57, 1, 18, 30, '?post_id=1', '2021-08-20 05:53:46'),
(58, 1, 22, 30, '?post_id=1', '2021-08-20 05:53:46'),
(59, 11, 29, 30, '?post_id=11', '2021-08-20 06:06:52'),
(60, 11, 23, 30, '?post_id=11', '2021-08-20 06:06:52'),
(61, 1, 8, 23, '?post_id=1', '2021-08-24 10:42:07'),
(62, 1, 23, 22, '?post_id=1', '2021-08-24 11:16:55'),
(63, 12, 29, 8, '?post_id=12', '2021-09-22 09:33:30'),
(64, 13, 23, 8, '?post_id=13', '2021-09-29 18:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USD',
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `currency`, `status`) VALUES
(1, 'pro1', '', 200.00, 'USD', '1');

-- --------------------------------------------------------

--
-- Table structure for table `report_user`
--

CREATE TABLE `report_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `block_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 post block , 1 artist block',
  `influenecer_report` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `language_id` varchar(200) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT '0' COMMENT '0 = user ,1 =  infuencer',
  `chat_charge` int(11) NOT NULL COMMENT 'in euro',
  `post_charge` int(11) NOT NULL COMMENT 'in euro',
  `video_call_charge` int(11) NOT NULL COMMENT 'in euro',
  `euro_sign` varchar(255) NOT NULL DEFAULT '€',
  `device_type` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `fcm_token` longtext NOT NULL,
  `token` longtext NOT NULL,
  `social` varchar(255) NOT NULL,
  `facebook` text NOT NULL,
  `otp` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0 = not verify, 1 = verified',
  `notification_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `email`, `full_name`, `language_id`, `user_type`, `chat_charge`, `post_charge`, `video_call_charge`, `euro_sign`, `device_type`, `profile_image`, `fcm_token`, `token`, `social`, `facebook`, `otp`, `status`, `notification_status`, `created_at`, `total_like`) VALUES
(8, 'e10adc3949ba59abbe56e057f20f883e', 'neha@gmail.com', 'Neha', '2,1', '0', 0, 0, 0, '€', '', '41e715392330daebe17d09d10e97db5a.jpg', '', '', '', '', '', 1, 1, '2021-12-30 12:05:07', 0),
(41, 'df780a97b7d6a8f779f14728bccd3c4c', 'nancy.ctinfotech@gmail.com', 'Aman Gupta!', '1', '1', 50, 65, 80, '€', '', 'db6ed831c82884553a86d2af8f9dab97.png', '', '', '', '', '', 1, 1, '2022-01-07 06:47:21', 0),
(44, '82ce0614ca14d4da48afacb69e75b496', 'sh123@gmail.com', 'shikhu', '1,2', '1', 5, 25, 30, '€', '', 'f228d25712746ae6cfc2ef525a2f003e.png', '', '', '', '', '', 1, 1, '2021-12-30 12:07:24', 0),
(47, 'e10adc3949ba59abbe56e057f20f883e', 'nehajayswal1508@gmail.com', 'neha jayswal ', '7, 6, 5', '1', 200, 250, 100, '€', '', '5fd30d4bea1aab23079bba4f56d05c45.jpg', '', 'ccae9b5dc88b2fc29e93c2e3a650d55f', '', '', '', 1, 1, '2022-01-18 12:32:49', 0),
(48, '96e79218965eb72c92a549dd5a330112', 'nehuj6756@gmail.com', 'neha mam!!', '1', '0', 0, 0, 0, '€', '', '2a31246e6645610eae30a4be8e6121c3.jpg', '', '', '', '', '', 1, 1, '2022-01-21 05:20:53', 0),
(51, 'e10adc3949ba59abbe56e057f20f883e', 'nehajayswal@gmail.com', 'neha', '1,5', '1', 20, 52, 25, '€', '', '5fd30d4bea1aab23079bba4f56d05c45.jpg', '', '', '', '', '', 1, 1, '2022-01-06 12:30:49', 0),
(52, '60c8d4a0147f75649ba71807bd825a68', 'chandni.ctinfotech@gmail.com', 'chandni', '7', '0', 0, 0, 0, '€', '', '74cb96ff58b68cc8326ea35e4157f35f.jpg', '', '', '', '', '', 1, 1, '2022-01-18 12:28:25', 0),
(54, 'e10adc3949ba59abbe56e057f20f883e', 'influ@gmail.com', 'neha mam!!', '2,4', '1', 5, 6, 8, '€', '', 'f228d25712746ae6cfc2ef525a2f003e.png', '', '', '', '', '', 1, 1, '2022-01-21 05:20:59', 0),
(58, 'e10adc3949ba59abbe56e057f20f883e', 'er.amitholkar@gmail.com', 'Amit holkar', '1,2', '0', 0, 0, 0, '€', '', 'a65d5fabc003d038817351ff578bc3f0.jpg', '', '', '', '', '', 1, 1, '2022-01-10 07:49:53', 0),
(66, '96e79218965eb72c92a549dd5a330112', 'neha@gmail.com', 'neha jayswal', '7,1', '0', 0, 0, 0, '€', '', '52ae145046496d42a2aa1d44f89a5ed8.jpg', '', '', '', '', '', 1, 1, '2022-01-10 07:59:00', 0),
(67, '96e79218965eb72c92a549dd5a330112', 'my@gmail.com', 'myra', '7', '1', 25, 32, 222, '€', '', 'db6ed831c82884553a86d2af8f9dab97.png', '', '', '', '', '', 1, 1, '2022-01-04 13:32:58', 0),
(76, '27b4b5b01b0d1fcab2046369720ff75e', 'i.maneschi@gmail.com', 'ilie', '1,3,4', '1', 8, 150, 5, '€', '', '92e641e7169e01f1b555f63fafc9d476.png', '', '', '', '', '', 1, 1, '2022-01-27 12:51:46', 0),
(77, 'e10adc3949ba59abbe56e057f20f883e', 'nehajayaswal.ctinfotech@gmail.com', 'nehu', '1', '1', 18, 50, 70, '€', '', 'c8313eaa7ad1cb4a9ee36bc5944a28d7.png', '', '', '', '', '', 1, 1, '2022-01-17 08:06:58', 0),
(78, 'cc6ef53c2bf1fb2ab777e2be27e2bd72', 'dario.d2004@libero.it', 'Dario', '1,2,3', '0', 0, 0, 0, '€', '', '32631ccd4a55148dadf23d3fd896c3b9.png', '', '', '', '', '', 1, 1, '2022-01-21 12:54:02', 0),
(81, '96e79218965eb72c92a549dd5a330112', 'shree@gmail.com', 'ctcc', '1,5,7', '1', 5, 25, 85, '€', '', 'c9585b38d4da046aec1f2ad180445c54.png', '', '', '', '', '', 1, 1, '2022-01-25 05:01:06', 0),
(82, 'e10adc3949ba59abbe56e057f20f883e', 'Aman@gmail.com', 'Aman', '1, 2', '0', 0, 0, 0, '€', '', 'a4fa8feadd7b7729fe499addf4af3efd.png', '', '', '', '', '', 1, 1, '2022-01-25 08:02:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `video_schdule`
--

CREATE TABLE `video_schdule` (
  `id` int(11) NOT NULL,
  `video_call_by` int(255) NOT NULL,
  `video_call_with` int(255) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'in euro',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `end_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL COMMENT '0=pending, 1=accept, 2=reject',
  `video_call_duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'in min',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `video_schdule`
--

INSERT INTO `video_schdule` (`id`, `video_call_by`, `video_call_with`, `price`, `date`, `time`, `end_datetime`, `status`, `video_call_duration`, `created_at`) VALUES
(1, 8, 51, '50', '2021-11-17', '12:33:09', '2022-01-19 03:37:06', 0, '5', '2022-01-17 07:46:52'),
(2, 8, 54, '50', '2021-11-18', '12:33:09', '2022-01-19 03:37:06', 0, '5', '2022-01-17 07:47:06'),
(5, 48, 47, '25', '2021-11-18', '12:33:09', '2022-01-19 03:37:06', 0, '5', '2022-01-18 12:23:35'),
(6, 51, 47, '25', '2021-11-18', '12:33:09', '2022-01-19 03:37:06', 0, '50', '2022-01-18 12:23:39'),
(7, 52, 51, '25', '2021-11-18', '12:33:09', '2022-01-19 03:37:06', 0, '50', '2022-01-18 11:25:00'),
(11, 48, 41, '80', '2022-01-21', '17:08:00', '2022-01-21 17:13:00', 0, '5', '2022-01-19 11:36:44'),
(12, 48, 41, '80', '2022-01-21', '17:08:00', '2022-01-21 17:13:00', 0, '5', '2022-01-19 11:37:28'),
(13, 48, 54, '80', '2022-01-20', '23:57:00', '2022-01-21 00:02:00', 0, '5', '2022-01-19 11:38:15'),
(14, 48, 41, '80', '2022-01-21', '17:14:00', '2022-01-21 17:19:00', 0, '5', '2022-01-19 11:42:11'),
(15, 48, 41, '80', '2022-01-21', '17:14:00', '2022-01-21 17:19:00', 0, '5', '2022-01-19 11:43:18'),
(16, 48, 41, '80', '2022-01-21', '17:14:00', '2022-01-21 17:19:00', 0, '5', '2022-01-19 11:47:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`messages_id`);

--
-- Indexes for table `chat_schdule`
--
ALTER TABLE `chat_schdule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`concert_id`);

--
-- Indexes for table `concert_booking`
--
ALTER TABLE `concert_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_about`
--
ALTER TABLE `contact_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `create_group`
--
ALTER TABLE `create_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_users`
--
ALTER TABLE `plan_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `post_comment_like`
--
ALTER TABLE `post_comment_like`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `post_image`
--
ALTER TABLE `post_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `post_schdule`
--
ALTER TABLE `post_schdule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_share`
--
ALTER TABLE `post_share`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_user`
--
ALTER TABLE `report_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_schdule`
--
ALTER TABLE `video_schdule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `messages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `chat_schdule`
--
ALTER TABLE `chat_schdule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `concert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `concert_booking`
--
ALTER TABLE `concert_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_about`
--
ALTER TABLE `contact_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `create_group`
--
ALTER TABLE `create_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `follower`
--
ALTER TABLE `follower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plan_users`
--
ALTER TABLE `plan_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `post_comment_like`
--
ALTER TABLE `post_comment_like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `post_image`
--
ALTER TABLE `post_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

--
-- AUTO_INCREMENT for table `post_schdule`
--
ALTER TABLE `post_schdule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post_share`
--
ALTER TABLE `post_share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report_user`
--
ALTER TABLE `report_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `video_schdule`
--
ALTER TABLE `video_schdule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
