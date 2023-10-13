-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 06:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epicgamenews`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_first_text` text NOT NULL,
  `about_second_text` text NOT NULL,
  `about_first_image` varchar(255) NOT NULL,
  `about_second_image` varchar(255) NOT NULL,
  `about_our_mission` text NOT NULL,
  `about_our_vision` text NOT NULL,
  `about_services` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `about_first_text`, `about_second_text`, `about_first_image`, `about_second_image`, `about_our_mission`, `about_our_vision`, `about_services`, `created_at`, `updated_at`) VALUES
(1, 'We are a passionate team of gamers and journalists who love everything about the gaming world. Our collective expertise and enthusiasm drive us to provide the latest gaming news and insights to our readers.', 'Our story began with a shared love for gaming. We saw a need for a reliable source of gaming news and decided to create this platform. Our journey has been one of growth, learning, and a commitment to delivering the best gaming content.', 'about/about-img-1.jpg', 'about/about-img-2.jpg', '<p>Our mission is to be the go-to source for gamers seeking accurate and engaging information about the gaming industry. We aim to keep our readers informed, entertained, and connected to the gaming community.</p>', '<p>Our vision is to foster a vibrant and inclusive gaming community. We envision a world where gaming is celebrated, understood, and enjoyed by all, and where our platform plays a key role in making that vision a reality.</p>', '<ul>\r\n<li><strong>Breaking News</strong>: Stay updated with the latest gaming news as it happens.</li>\r\n<li><strong>Reviews</strong>: In-depth game reviews to help you make informed choices.</li>\r\n<li><strong>Features</strong>: Engaging articles, interviews, and editorials on various gaming topics.</li>\r\n<li><strong>Community</strong>: A place for gamers to connect, discuss, and share their gaming experiences.</li>\r\n<li><strong>Events</strong>: Coverage and highlights of major gaming events and conventions.</li>\r\n<li><strong>Tutorials</strong>: Guides and tips to enhance your gaming skills.</li>\r\n</ul>', '2023-10-12 13:54:58', '2023-10-13 00:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'uncategorized', 'uncategorized', 7, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(12, 'MMORPG', 'mmorpg', 1, '2023-10-13 00:38:28', '2023-10-13 00:38:28'),
(13, 'MOBA', 'moba', 1, '2023-10-13 00:38:39', '2023-10-13 00:38:39'),
(14, 'Shooter', 'shooter', 1, '2023-10-13 00:38:51', '2023-10-13 00:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `imageable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `extension`, `path`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(1, 'esse', 'jpg', 'images/9.jpg', 2, 'App\\Models\\VideoGame', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(2, 'et', 'jpg', 'images/6.jpg', 3, 'App\\Models\\VideoGame', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(3, 'corporis', 'jpg', 'images/5.jpg', 4, 'App\\Models\\VideoGame', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(4, 'enim', 'jpg', 'images/1.jpg', 5, 'App\\Models\\VideoGame', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(5, 'aut', 'jpg', 'images/5.jpg', 6, 'App\\Models\\VideoGame', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(6, 'id', 'jpg', 'images/5.jpg', 7, 'App\\Models\\VideoGame', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(7, 'praesentium', 'jpg', 'images/10.jpg', 8, 'App\\Models\\VideoGame', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(8, 'expedita', 'jpg', 'images/10.jpg', 9, 'App\\Models\\VideoGame', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(9, 'quos', 'jpg', 'images/3.jpg', 10, 'App\\Models\\VideoGame', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(10, 'dolorum', 'jpg', 'images/1.jpg', 11, 'App\\Models\\VideoGame', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(11, 'nihil', 'jpg', 'images/10.jpg', 2, 'App\\Models\\Category', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(12, 'veritatis', 'jpg', 'images/5.jpg', 3, 'App\\Models\\Category', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(13, 'eaque', 'jpg', 'images/10.jpg', 4, 'App\\Models\\Category', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(14, 'sint', 'jpg', 'images/8.jpg', 5, 'App\\Models\\Category', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(15, 'delectus', 'jpg', 'images/2.jpg', 6, 'App\\Models\\Category', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(16, 'doloremque', 'jpg', 'images/6.jpg', 7, 'App\\Models\\Category', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(17, 'optio', 'jpg', 'images/8.jpg', 8, 'App\\Models\\Category', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(18, 'occaecati', 'jpg', 'images/3.jpg', 9, 'App\\Models\\Category', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(19, 'et', 'jpg', 'images/7.jpg', 10, 'App\\Models\\Category', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(20, 'sunt', 'jpg', 'images/5.jpg', 11, 'App\\Models\\Category', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(21, 'thumbnail_placeholder.jpg', 'jpg', 'platforms/AE78yfcUApIZAXCblf32hj04Hz9FoePNV9gzheLq.jpg', 1, 'App\\Models\\Platform', '2023-10-12 13:54:58', '2023-10-13 00:18:18'),
(22, 'pc.jpg', 'jpg', 'platforms/L5OzGPEwLY6PCvwPRanQyvAnDHvoEakn2VhVVzjs.jpg', 2, 'App\\Models\\Platform', '2023-10-12 13:54:58', '2023-10-12 14:05:20'),
(23, 'playstation.jpg', 'jpg', 'platforms/fWixCZslDZR58WXduXfz556usHfhQCd7K67lihn1.jpg', 3, 'App\\Models\\Platform', '2023-10-12 13:54:58', '2023-10-12 14:05:14'),
(24, 'xbox.jpg', 'jpg', 'platforms/skXuYaZudypGssxyLqxDSKG6pv4rtLsEWevEwDh8.jpg', 4, 'App\\Models\\Platform', '2023-10-12 13:54:58', '2023-10-12 14:05:09'),
(25, 'mobile.jpg', 'jpg', 'platforms/SXvRFk0UbaYYvFIbBZbzCn3i15TYfqhThOFITQO8.jpg', 5, 'App\\Models\\Platform', '2023-10-12 13:54:58', '2023-10-12 14:04:59'),
(26, 'nintendo.jpg', 'jpg', 'platforms/AqlAH6JtrrPH7vxLYB8RNBclEb1Ps5HV4QSYDbJ3.jpg', 6, 'App\\Models\\Platform', '2023-10-12 13:54:58', '2023-10-12 14:04:51'),
(27, 'thumbnail_placeholder.jpg', 'jpg', 'others/s180NoGvRbbQoiiaffhIJD5YoggSVSouMKpBAG6B.jpg', 1, 'App\\Models\\Other', '2023-10-12 13:54:58', '2023-10-13 00:18:46'),
(28, 'game-trailers.jpg', 'jpg', 'others/j5oepidAH3BkMNgdS7UUpxaIzfDkmNlbzbOG52N8.jpg', 2, 'App\\Models\\Other', '2023-10-12 13:54:58', '2023-10-13 00:19:09'),
(29, 'anime.jpg', 'jpg', 'others/igrZG2wZB00yF5fn4AaSJJuk3Vmbs4Seibxmgjjx.jpg', 3, 'App\\Models\\Other', '2023-10-12 13:54:58', '2023-10-13 00:19:14'),
(30, 'cartoons.jpg', 'jpg', 'others/nCTN3fq9SUUhCzQpLuRmYbN3B2SqxHhAbysJw41y.jpg', 4, 'App\\Models\\Other', '2023-10-12 13:54:58', '2023-10-13 00:19:19'),
(31, 'movies.jpg', 'jpg', 'others/vzDFt8lcvgBoS7MuIwD9XFnx6hTGztFVnN2GvR6M.jpg', 5, 'App\\Models\\Other', '2023-10-12 13:54:58', '2023-10-13 00:19:25'),
(32, 'series.jpg', 'jpg', 'others/xhyaOex6nVekCkLSVKRti8YHIh53w3c5Zx9zp23m.jpg', 6, 'App\\Models\\Other', '2023-10-12 13:54:58', '2023-10-13 00:19:30'),
(33, 'lists.jpg', 'jpg', 'others/5j0Wlp1VanGHkDySp4fd5pinqUeKlEkxUanjm8CR.jpg', 7, 'App\\Models\\Other', '2023-10-12 13:54:58', '2023-10-13 00:19:50'),
(34, 'quibusdam', 'jpg', 'images/3.jpg', 1, 'App\\Models\\Post', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(35, 'repudiandae', 'jpg', 'images/2.jpg', 2, 'App\\Models\\Post', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(36, 'perferendis', 'jpg', 'images/5.jpg', 3, 'App\\Models\\Post', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(37, 'voluptatem', 'jpg', 'images/6.jpg', 4, 'App\\Models\\Post', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(38, 'facere', 'jpg', 'images/1.jpg', 5, 'App\\Models\\Post', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(39, 'neque', 'jpg', 'images/10.jpg', 6, 'App\\Models\\Post', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(40, 'veniam', 'jpg', 'images/2.jpg', 7, 'App\\Models\\Post', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(41, 'dolorem', 'jpg', 'images/5.jpg', 8, 'App\\Models\\Post', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(42, 'et', 'jpg', 'images/2.jpg', 9, 'App\\Models\\Post', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(43, 'quia', 'jpg', 'images/1.jpg', 10, 'App\\Models\\Post', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(44, 'mmorpg.jpg', 'jpg', 'categories/w7lglySivFiuJ48Qyhu4kYYKL2BpWYk8vKGXKWS3.jpg', 12, 'App\\Models\\Category', '2023-10-13 00:38:28', '2023-10-13 00:38:28'),
(45, 'moba.jpg', 'jpg', 'categories/mJsA8L3uZ7fZTHFglnkXwYbAdiVcFq2GSljwqZcJ.jpg', 13, 'App\\Models\\Category', '2023-10-13 00:38:39', '2023-10-13 00:38:39'),
(46, 'shooter.jpg', 'jpg', 'categories/jVuGiBKcJr7hF9lNQPOdE9nNn6P2x5ohturwZUBN.jpg', 14, 'App\\Models\\Category', '2023-10-13 00:38:51', '2023-10-13 00:38:51'),
(47, 'gw2.jpg', 'jpg', 'video_games/NhgP7rlFqOcwftaBeo8Up30dBfALaZZPOUSBYcSJ.jpg', 12, 'App\\Models\\VideoGame', '2023-10-13 00:40:59', '2023-10-13 00:40:59'),
(48, 'lol.jpg', 'jpg', 'video_games/QZPP8hFiuwi6x1IWsJNWl5HVB7LxHGg5KHAB8Voi.jpg', 13, 'App\\Models\\VideoGame', '2023-10-13 00:41:28', '2023-10-13 00:41:28'),
(49, 'valorant.jpg', 'jpg', 'video_games/9Fvg7Rd5MevD1vhpU0vKB81M3aNXYJsvXYhqVkLq.jpg', 14, 'App\\Models\\VideoGame', '2023-10-13 00:41:38', '2023-10-13 00:41:38'),
(50, 'wow-wotlk.jpg', 'jpg', 'video_games/2QCmiIjxMDBzvX3Jy32n5TNZdys7yB2iFtLzXjhh.jpg', 15, 'App\\Models\\VideoGame', '2023-10-13 00:42:00', '2023-10-13 00:42:00'),
(51, '2023-10-13-04-oct.-00-Lau-gw2.jpg', 'jpg', 'images/2023-10-13-04-oct.-00-Lau-gw2.jpg', 11, 'App\\Models\\Post', '2023-10-13 01:03:00', '2023-10-13 01:03:00'),
(52, '2023-10-13-04-oct.-27-Lau-lol.jpg', 'jpg', 'images/2023-10-13-04-oct.-27-Lau-lol.jpg', 12, 'App\\Models\\Post', '2023-10-13 01:08:27', '2023-10-13 01:08:27'),
(53, '2023-10-13-04-oct.-12-Lau-valorant.jpg', 'jpg', 'images/2023-10-13-04-oct.-12-Lau-valorant.jpg', 13, 'App\\Models\\Post', '2023-10-13 01:11:12', '2023-10-13 01:11:12'),
(54, '2023-10-13-04-oct.-37-Lau-wow-wotlk.jpg', 'jpg', 'images/2023-10-13-04-oct.-37-Lau-wow-wotlk.jpg', 14, 'App\\Models\\Post', '2023-10-13 01:14:37', '2023-10-13 01:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_07_04_154426_create_roles_table', 1),
(2, '2014_10_04_000000_create_users_table', 1),
(3, '2014_10_07_165712_create_role_user_table', 1),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2019_12_14_000001_create_video_games_table', 1),
(8, '2019_12_14_000002_create_posts_table', 1),
(9, '2023_07_02_172047_create_others_table', 1),
(10, '2023_07_03_173045_create_categories_table', 1),
(11, '2023_07_03_173046_create_platforms_table', 1),
(12, '2023_07_03_173046_create_post_category_table', 1),
(13, '2023_07_03_173047_create_post_platform_table', 1),
(14, '2023_07_05_090452_create_post_tag_table', 1),
(15, '2023_07_05_090854_create_tags_table', 1),
(16, '2023_07_06_090659_create_images_table', 1),
(17, '2023_07_15_093013_create_contacts_table', 1),
(18, '2023_08_13_154643_create_permissions_table', 1),
(19, '2023_08_26_093154_create_abouts_table', 1),
(20, '2023_10_08_110442_create_permission_role_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`id`, `name`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'uncategorized', 'uncategorized', 3, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(2, 'Game Trailers', 'game-trailers', 9, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(3, 'Anime', 'anime', 5, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(4, 'Cartoons', 'cartoons', 1, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(5, 'Movies', 'movies', 8, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(6, 'Series', 'series', 9, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(7, 'Lists', 'lists', 6, '2023-10-12 13:54:58', '2023-10-12 13:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin.index', '2023-10-12 13:54:57', '2023-10-12 13:54:57'),
(2, 'admin.posts.index', '2023-10-12 13:54:57', '2023-10-12 13:54:57'),
(3, 'admin.posts.create', '2023-10-12 13:54:57', '2023-10-12 13:54:57'),
(4, 'admin.posts.store', '2023-10-12 13:54:57', '2023-10-12 13:54:57'),
(5, 'admin.posts.edit', '2023-10-12 13:54:57', '2023-10-12 13:54:57'),
(6, 'admin.posts.update', '2023-10-12 13:54:57', '2023-10-12 13:54:57'),
(7, 'admin.posts.destroy', '2023-10-12 13:54:57', '2023-10-12 13:54:57'),
(8, 'admin.upload_tinymce_image', '2023-10-12 13:54:57', '2023-10-12 13:54:57'),
(9, 'admin.video_games.index', '2023-10-12 13:54:57', '2023-10-12 13:54:57'),
(10, 'admin.video_games.create', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(11, 'admin.video_games.store', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(12, 'admin.video_games.edit', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(13, 'admin.video_games.update', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(14, 'admin.', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(15, 'admin.video_games.destroy', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(16, 'admin.video_games.show', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(17, 'admin.categories.index', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(18, 'admin.categories.create', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(19, 'admin.categories.store', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(20, 'admin.categories.edit', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(21, 'admin.categories.update', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(22, 'admin.categories.destroy', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(23, 'admin.categories.show', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(24, 'admin.platforms.index', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(25, 'admin.platforms.create', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(26, 'admin.platforms.store', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(27, 'admin.platforms.edit', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(28, 'admin.platforms.update', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(29, 'admin.platforms.destroy', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(30, 'admin.platforms.show', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(31, 'admin.others.index', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(32, 'admin.others.create', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(33, 'admin.others.store', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(34, 'admin.others.edit', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(35, 'admin.others.update', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(36, 'admin.others.destroy', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(37, 'admin.others.show', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(38, 'admin.tags.index', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(39, 'admin.tags.show', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(40, 'admin.tags.destroy', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(41, 'admin.roles.index', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(42, 'admin.roles.create', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(43, 'admin.roles.store', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(44, 'admin.roles.edit', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(45, 'admin.roles.update', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(46, 'admin.roles.destroy', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(47, 'admin.users.index', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(48, 'admin.users.create', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(49, 'admin.users.store', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(50, 'admin.users.edit', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(51, 'admin.users.update', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(52, 'admin.users.destroy', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(53, 'admin.users.showUsers', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(54, 'admin.users.showPosts', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(55, 'admin.users.showVideoGames', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(56, 'admin.users.showCategories', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(57, 'admin.contacts', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(58, 'admin.contacts.destroy', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(59, 'admin.about.edit', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(60, 'admin.about.update', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(61, 'admin.storageLink', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(62, 'admin.terminal.index', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(63, 'admin.terminal.migrate', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(64, 'admin.terminal.migrateStatus', '2023-10-12 13:54:58', '2023-10-12 13:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(2, 2, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(3, 3, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(4, 4, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(5, 5, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(6, 6, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(7, 7, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(8, 8, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(9, 9, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(10, 10, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(11, 11, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(12, 12, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(13, 13, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(14, 14, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(15, 15, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(16, 16, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(17, 17, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(18, 18, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(19, 19, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(20, 20, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(21, 21, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(22, 22, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(23, 23, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(24, 24, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(25, 25, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(26, 26, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(27, 27, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(28, 28, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(29, 29, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(30, 30, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(31, 31, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(32, 32, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(33, 33, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(34, 34, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(35, 35, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(36, 36, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(37, 37, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(38, 38, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(39, 39, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(40, 40, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(41, 41, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(42, 42, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(43, 43, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(44, 44, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(45, 45, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(46, 46, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(47, 47, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(48, 48, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(49, 49, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(50, 50, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(51, 51, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(52, 52, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(53, 53, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(54, 54, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(55, 55, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(56, 56, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(57, 57, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(58, 58, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(59, 59, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(60, 60, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(61, 61, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(62, 62, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(63, 63, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(64, 64, 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `name`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'uncategorized', 'uncategorized', 9, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(2, 'PC', 'pc', 1, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(3, 'PlayStation', 'playstation', 10, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(4, 'Xbox', 'xbox', 1, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(5, 'Mobile', 'mobile', 11, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(6, 'Nintendo', 'nintendo', 9, '2023-10-12 13:54:58', '2023-10-12 13:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `author_thumbnail` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `video_game_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `other_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `views` int(11) NOT NULL DEFAULT 0,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `excerpt`, `author_thumbnail`, `body`, `user_id`, `video_game_id`, `other_id`, `views`, `approved`, `created_at`, `updated_at`) VALUES
(11, 'Exploring Guild Wars 2\'s \"Secrets of the Obscure', 'exploring-guild-wars-2-secrets-of-the-obscure', 'Secrets of the Obscure\" promises new, more frequent updates for Guild Wars 2. Learn what players think.', NULL, '<p>MassivelyOP was recently granted the unique privilege of embarking on an exclusive guided expedition through the enchanting landscapes of Guild Wars 2\'s latest expansion, \"Secrets of the Obscure.\" As we ventured into the uncharted territories and encountered the mysteries that awaited, we witnessed firsthand the potential this expansion holds for the game\'s ever-evolving narrative.</p>\r\n<p>This new expansion, preceded by a mixed reception from the Guild Wars 2 community, marks a significant shift in ArenaNet\'s content delivery strategy. \"Secrets of the Obscure\" is designed to provide players with more frequent updates, steering the game into a fresh and promising direction. While players\' initial reactions were divided, with some eagerly anticipating the prospect of regular content drops, while others expressed concerns, the opportunity to explore this expansion first-hand promised valuable insights.</p>\r\n<p>Our journey through \"Secrets of the Obscure\" took us into two stunningly crafted new zones, each brimming with hidden stories, formidable challenges, and breathtaking landscapes. These areas not only provide a fresh canvas for players to explore but also serve as a stage for the game\'s evolving narrative.</p>\r\n<p>During our guided tour, we delved into the lore, gameplay mechanics, and overall ambiance of these zones. Our experience allowed us to form a more nuanced perspective on \"Secrets of the Obscure,\" transcending initial expectations and perceptions. We engaged with both the passionate development team behind the expansion and the Guild Wars 2 player community, gathering their thoughts and expectations, which we will share in this comprehensive account.</p>\r\n<p>In this in-depth article, we will explore the impact of \"Secrets of the Obscure\" on the Guild Wars 2 universe and what it represents for the future of the game. We\'ll also provide a platform for players\' voices, capturing the essence of their excitement, reservations, and anticipations. By the end of this detailed journey, readers will have a well-rounded understanding of the expansion\'s potential and how it could shape the evolving landscape of Guild Wars 2.</p>', 1, 12, 1, 0, 1, '2023-10-13 01:02:59', '2023-10-13 01:03:20'),
(12, 'Ranking the 25 Most Newbie-Friendly Champions in League of Legends', 'ranking-the-25-most-newbie-friendly-champions-in-league-of-legends', 'Learning League of Legends can be daunting for newcomers, but these champions make the journey considerably smoother.', NULL, '<p>Discover the top 25 champions in League of Legends that are perfect for beginners. Whether you\'re new to the game or looking for champions with straightforward mechanics, this list will guide you toward a more accessible and enjoyable experience on the Fields of Justice.</p>\r\n<ol>\r\n<li><strong>Garen</strong>: A straightforward and tanky top laner.</li>\r\n<li><strong>Ashe</strong>: A basic but effective marksman for bot lane.</li>\r\n<li><strong>Annie</strong>: A simple mage with powerful burst damage.</li>\r\n<li><strong>Amumu</strong>: A durable and crowd-controlling jungle tank.</li>\r\n<li><strong>Morgana</strong>: An easy-to-learn support with crowd control.</li>\r\n<li><strong>Warwick</strong>: A beginner-friendly jungle champion with sustain.</li>\r\n<li><strong>Malphite</strong>: A tanky top laner with strong initiation.</li>\r\n<li><strong>Sona</strong>: A straightforward support with healing and auras.</li>\r\n<li><strong>Master Yi</strong>: A basic attack damage jungler.</li>\r\n<li><strong>Janna</strong>: An easy-to-play support with strong disengage.</li>\r\n<li><strong>Darius</strong>: A durable top laner with a straightforward kit.</li>\r\n<li><strong>Trundle</strong>: A versatile jungle tank with regenerative abilities.</li>\r\n<li><strong>Miss Fortune</strong>: A simple but effective AD carry.</li>\r\n<li><strong>Anivia</strong>: A mage with crowd control and area denial.</li>\r\n<li><strong>Yi</strong>: A melee carry with strong dueling potential.</li>\r\n<li><strong>Leona</strong>: An easy-to-play tanky support with crowd control.</li>\r\n<li><strong>Malzahar</strong>: A mage with simple but powerful abilities.</li>\r\n<li><strong>Nunu &amp; Willump</strong>: A jungle duo with solid utility.</li>\r\n<li><strong>Sivir</strong>: A marksman with good wave-clearing abilities.</li>\r\n<li><strong>Soraka</strong>: A support with strong healing capabilities.</li>\r\n<li><strong>Nasus</strong>: A scaling top laner with straightforward mechanics.</li>\r\n<li><strong>Lux</strong>: A mage with long-range poke and crowd control.</li>\r\n<li><strong>Caitlyn</strong>: A marksman with long-range and safety.</li>\r\n<li><strong>Alistar</strong>: A tanky support with excellent crowd control.</li>\r\n<li><strong>Tristana</strong>: A versatile AD carry with an easy-to-grasp kit.</li>\r\n</ol>\r\n<p>These champions are perfect for new players, offering accessible gameplay while you get acquainted with the complex world of League of Legends.</p>', 1, 13, 1, 0, 1, '2023-10-13 01:08:27', '2023-10-13 01:15:13'),
(13, 'Ranking the Top 5 Valorant Ultimates', 'ranking-the-top-5-valorant-ultimates', 'While every agent in Valorant possesses a potent Ultimate ability, these top 5 Ultimates stand head and shoulders above the rest.', NULL, '<p>In the competitive realm of tactical FPS games, Valorant, developed by Riot Games, stands out with its unique character-based abilities. Each agent brings a distinctive set of abilities into the game, including a chargeable Ultimate that often defines their playstyle. Here are the top 5 Valorant agents and their game-changing Ultimate abilities:</p>\r\n<ol>\r\n<li>\r\n<p><strong>Jett - Blade Storm:</strong> Jett\'s Ultimate equips her with throwing knives, allowing precise ranged attacks and resets on eliminations. It\'s a game-changer in the hands of a skilled player.</p>\r\n</li>\r\n<li>\r\n<p><strong>Brimstone - Orbital Strike:</strong> Brimstone\'s Ultimate calls down a devastating orbital strike, covering a large area and forcing enemies to scramble for cover.</p>\r\n</li>\r\n<li>\r\n<p><strong>Sage - Resurrection:</strong> Sage\'s Ultimate ability, Resurrection, brings a fallen teammate back to life, often turning the tide of a round with a well-timed revive.</p>\r\n</li>\r\n<li>\r\n<p><strong>Omen - From the Shadows:</strong> Omen\'s Ultimate allows him to teleport across the map, creating confusion and disrupting enemy strategies, making it a powerful tool for map control.</p>\r\n</li>\r\n<li>\r\n<p><strong>Phoenix - Run It Back:</strong> Phoenix\'s Ultimate, Run It Back, grants him a second chance by respawning at his original location if he\'s eliminated, providing a significant advantage during clutch situations.</p>\r\n</li>\r\n</ol>\r\n<p>These Ultimates redefine the battlefield in Valorant and can turn the tide of a match when used skillfully.</p>', 1, 14, 1, 0, 1, '2023-10-13 01:11:12', '2023-10-13 01:15:03'),
(14, 'WoW WotLK Classic: Earning the Ironbound Proto-Drake Mount', 'wow-wotlk-classic-earning-the-ironbound-proto-drake-mount', 'Discover the path to acquiring the Ironbound Proto-Drake mount in World of Warcraft\'s Wrath of the Lich King Classic.', NULL, '<p>The Ironbound Proto-Drake, renowned for its stunning appearance, is a highly coveted mount in the world of World of Warcraft\'s Wrath of the Lich King Classic. However, the journey to obtain this magnificent mount is no easy feat. To add the Ironbound Proto-Drake to your collection, you must unlock the \"Glory of the Ulduar Raider (25 player)\" meta-achievement, a challenging task that demands the completion of no less than 13 distinct achievements within the Ulduar raid.</p>\r\n<p>This achievement is separate from acquiring the Time-Lost Proto Drake, which has its own unique method of acquisition. If you\'re part of a dedicated Ulduar raid group, this guide provides valuable tips and tricks to help you conquer all the required challenges. It\'s important to note that the achievements can be completed in any order, offering flexibility to raiding parties.</p>\r\n<p>To begin, your raid must defeat Thorim on Hard mode. Activating Hard mode necessitates engaging Thorim within three minutes of starting the gauntlet, which is no easy task. However, this challenge pales in comparison to the Hard mode encounter with Thorim himself. In this mode, you\'ll face an empowered version of the boss while dealing with the immortal and hostile Sif. Your focus should remain solely on the boss during this intense battle.</p>\r\n<p>The next achievement can be unlocked during the encounter with the Assembly of Iron, a trio of bosses consisting of Runemaster Molgeim, Stormcaller Brundir, and Steelbreaker. To earn this achievement, you must defeat Molgeim and Brundir before taking down Steelbreaker. Keep in mind that each time one of the bosses falls, the remaining ones are fully healed and become more formidable. Steelbreaker, the most powerful of the trio, must be the last one standing to secure this achievement.</p>\r\n<p>The timed event involves defeating Hodir before he destroys his first cache, occurring three minutes after the encounter begins and cannot be delayed. The Hodir fight is intricate, so it\'s advisable to attempt the achievement on normal mode or consult walkthroughs. High DPS is crucial in this battle, so ensure your raid includes more damage dealers than usual. Freeing the Mages following each Flash Freeze will increase your chances of success in this intense encounter.</p>', 1, 15, 1, 0, 1, '2023-10-13 01:14:36', '2023-10-13 01:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`id`, `post_id`, `category_id`, `created_at`, `updated_at`) VALUES
(26, 11, 12, NULL, NULL),
(27, 12, 13, NULL, NULL),
(28, 13, 14, NULL, NULL),
(29, 14, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_platform`
--

CREATE TABLE `post_platform` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `platform_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_platform`
--

INSERT INTO `post_platform` (`id`, `post_id`, `platform_id`, `created_at`, `updated_at`) VALUES
(27, 11, 2, NULL, NULL),
(28, 12, 2, NULL, NULL),
(30, 13, 2, NULL, NULL),
(31, 14, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(11, 11, 2, NULL, NULL),
(12, 11, 3, NULL, NULL),
(13, 11, 4, NULL, NULL),
(14, 11, 5, NULL, NULL),
(15, 12, 6, NULL, NULL),
(16, 12, 7, NULL, NULL),
(17, 12, 8, NULL, NULL),
(18, 13, 9, NULL, NULL),
(19, 14, 2, NULL, NULL),
(20, 14, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'user', 1, '2023-10-12 13:54:57', '2023-10-12 13:54:57'),
(2, 'admin', 1, '2023-10-12 13:54:57', '2023-10-12 13:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 7, 1, NULL, NULL),
(8, 8, 1, NULL, NULL),
(9, 9, 1, NULL, NULL),
(10, 10, 1, NULL, NULL),
(11, 11, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'mmorpg', 'mmorpg', 1, '2023-10-13 01:03:00', '2023-10-13 01:03:00'),
(3, 'role play', 'role-play', 1, '2023-10-13 01:03:00', '2023-10-13 01:03:00'),
(4, 'adventure', 'adventure', 1, '2023-10-13 01:03:00', '2023-10-13 01:03:00'),
(5, 'crossplatform', 'crossplatform', 1, '2023-10-13 01:03:00', '2023-10-13 01:03:00'),
(6, 'moba', 'moba', 1, '2023-10-13 01:08:27', '2023-10-13 01:08:27'),
(7, 'action', 'action', 1, '2023-10-13 01:08:27', '2023-10-13 01:08:27'),
(8, 'fantasy', 'fantasy', 1, '2023-10-13 01:08:27', '2023-10-13 01:08:27'),
(9, 'shooter', 'shooter', 1, '2023-10-13 01:11:12', '2023-10-13 01:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lau', 'laurentiucozma12@gmail.com', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'y1aJrT5ENY', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(2, 'Isom Lemke', 'ondricka.angus@example.com', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'DZaJNgNat6', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(3, 'Mrs. Janis Auer', 'bbergnaum@example.com', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'mKPYEoHDZi', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(4, 'Ms. Dorris Beer PhD', 'marian.turcotte@example.org', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'mOl5OBkkpq', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(5, 'Laurianne Schmitt', 'brenden26@example.net', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'xFUbgRC3x2', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(6, 'Wilson Conn MD', 'dschmidt@example.net', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 't82DJrcsWk', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(7, 'Alverta Johns', 'chadd26@example.net', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'pSa329nJyu', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(8, 'Malinda Nolan', 'filomena.batz@example.net', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'sPlXtme02m', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(9, 'Dr. Jasmin Windler', 'daugherty.kobe@example.com', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'YMUgND8K4c', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(10, 'Dejuan Green', 'mcarter@example.net', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'UC7P5X6uXL', '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(11, 'Jarrod Kshlerin', 'litzy.marvin@example.com', '2023-10-12 13:54:58', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, '4uNjM8IOnD', '2023-10-12 13:54:58', '2023-10-12 13:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `video_games`
--

CREATE TABLE `video_games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_games`
--

INSERT INTO `video_games` (`id`, `name`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'uncategorized', 'uncategorized', 2, '2023-10-12 13:54:58', '2023-10-12 13:54:58'),
(12, 'Guild Wars 2', 'guild-wars-2', 1, '2023-10-13 00:40:59', '2023-10-13 00:40:59'),
(13, 'League of Legends', 'league-of-legends', 1, '2023-10-13 00:41:28', '2023-10-13 00:41:28'),
(14, 'Valorant', 'valorant', 1, '2023-10-13 00:41:38', '2023-10-13 00:41:38'),
(15, 'World of Warcraft WOTLK', 'world-of-warcraft-wotlk', 1, '2023-10-13 00:42:00', '2023-10-13 00:42:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `others_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `platforms_slug_unique` (`slug`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_category_post_id_foreign` (`post_id`),
  ADD KEY `post_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `post_platform`
--
ALTER TABLE `post_platform`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_platform_post_id_foreign` (`post_id`),
  ADD KEY `post_platform_platform_id_foreign` (`platform_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_post_id_foreign` (`post_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `video_games`
--
ALTER TABLE `video_games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `video_games_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `post_platform`
--
ALTER TABLE `post_platform`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `video_games`
--
ALTER TABLE `video_games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `post_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_category_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_platform`
--
ALTER TABLE `post_platform`
  ADD CONSTRAINT `post_platform_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_platform_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
