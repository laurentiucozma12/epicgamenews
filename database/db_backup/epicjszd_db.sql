-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2023 at 11:04 AM
-- Server version: 10.5.20-MariaDB-cll-lve-log
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epicjszd_db`
--

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
(11, 'News', 'news', 11, '2023-08-31 04:45:09', '2023-09-02 20:39:04'),
(12, 'MMORPG', 'mmorpg', 11, '2023-09-02 20:11:59', '2023-09-02 20:11:59'),
(13, 'Shooter', 'shooter', 11, '2023-09-02 20:12:07', '2023-09-02 20:12:07'),
(14, 'RPG', 'rpg', 11, '2023-09-02 20:12:45', '2023-09-02 20:12:45'),
(15, 'Sandbox', 'sandbox', 11, '2023-09-02 20:13:38', '2023-09-02 20:13:38'),
(16, 'RTS', 'rts', 11, '2023-09-02 20:13:43', '2023-09-02 20:13:43'),
(17, 'MOBA', 'moba', 11, '2023-09-02 20:13:56', '2023-09-02 20:13:56'),
(18, 'Survival', 'survival', 11, '2023-09-02 20:14:11', '2023-09-02 20:14:11'),
(19, 'Horror', 'horror', 11, '2023-09-02 20:14:17', '2023-09-02 20:14:17'),
(20, 'Platformer', 'platformer', 11, '2023-09-02 20:14:31', '2023-09-02 20:14:31'),
(21, 'Indie', 'indie', 11, '2023-09-02 20:14:35', '2023-09-02 20:14:35'),
(22, 'Sports', 'sports', 11, '2023-09-02 20:14:49', '2023-09-02 20:14:49'),
(23, 'Anime', 'anime', 11, '2023-09-02 20:14:58', '2023-09-02 20:14:58'),
(24, 'Singleplayer', 'singleplayer', 11, '2023-09-02 20:15:26', '2023-09-02 20:15:26'),
(25, 'Multiplayer', 'multiplayer', 11, '2023-09-02 20:15:36', '2023-09-02 20:15:36'),
(26, 'Action', 'action', 11, '2023-09-02 20:15:44', '2023-09-02 20:15:44'),
(27, 'Casual', 'casual', 11, '2023-09-02 20:15:49', '2023-09-02 20:15:49'),
(28, 'Adventure', 'adventure', 11, '2023-09-02 20:15:58', '2023-09-02 20:15:58'),
(29, 'test user editor', 'test-user-editor', 11, '2023-09-03 13:01:11', '2023-09-03 13:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `the_comment` text NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `first_name`, `last_name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Laurentiu', 'Cozma', 'mail.v.gabriel@gmail.com', 'vrajala123', 'wqcadqp ddqwed qwd  cap de scroafa', '2023-09-02 16:21:44', '2023-09-02 16:21:44'),
(2, 'Laurentiu', 'Cozma', 'mail.v.gabriel@gmail.com', 'vrajala123', 'wqcadqp ddqwed qwd  cap de scroafa', '2023-09-02 16:21:45', '2023-09-02 16:21:45'),
(3, 'qdqwdq', 'qdwqwdq', 'qwdqwdq@gmail.com', 'dqwdqwdqwd', 'qwdqdqw', '2023-09-02 16:27:37', '2023-09-02 16:27:37'),
(4, 'qdqwdq', 'qdwqwdq', 'qwdqwdq@gmail.com', 'dqwdqwdqwd', 'qwdqdqw', '2023-09-02 16:27:40', '2023-09-02 16:27:40'),
(5, 'qdqwdq', 'qdwqwdq', 'qwdqwdq@gmail.com', 'dqwdqwdqwd', 'qwdqdqw', '2023-09-02 16:27:45', '2023-09-02 16:27:45'),
(6, 'qdqwdq', 'qdwqwdq', 'qwdqwdq@gmail.com', 'dqwdqwdqwd', 'qwdqdqw', '2023-09-02 16:28:22', '2023-09-02 16:28:22'),
(7, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:38', '2023-09-02 16:28:38'),
(8, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:41', '2023-09-02 16:28:41'),
(9, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:45', '2023-09-02 16:28:45'),
(10, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:45', '2023-09-02 16:28:45'),
(11, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:45', '2023-09-02 16:28:45'),
(12, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:46', '2023-09-02 16:28:46'),
(13, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:46', '2023-09-02 16:28:46'),
(14, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:46', '2023-09-02 16:28:46'),
(15, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:46', '2023-09-02 16:28:46'),
(16, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:46', '2023-09-02 16:28:46'),
(17, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:47', '2023-09-02 16:28:47'),
(18, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:56', '2023-09-02 16:28:56'),
(19, 'tester', 'tester', 'mail.v.gabriel@gmail.com', 'dqwdqdwqdqwd', 'dlkqwdlwlkqnwd', '2023-09-02 16:28:58', '2023-09-02 16:28:58');

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
(1, 'eligendi', 'jpg', 'images/6.jpg', 11, 'App\\Models\\User', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(2, 'fugiat', 'jpg', 'images/3.jpg', 1, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(3, 'adipisci', 'jpg', 'images/2.jpg', 2, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(4, 'neque', 'jpg', 'images/1.jpg', 3, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(5, 'ducimus', 'jpg', 'images/8.jpg', 4, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(6, 'voluptatibus', 'jpg', 'images/10.jpg', 5, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(7, 'dolor', 'jpg', 'images/8.jpg', 6, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(8, 'voluptas', 'jpg', 'images/7.jpg', 7, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(9, 'illum', 'jpg', 'images/10.jpg', 8, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(10, 'aut', 'jpg', 'images/2.jpg', 9, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(11, 'sed', 'jpg', 'images/2.jpg', 10, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(12, 'explicabo', 'jpg', 'images/7.jpg', 11, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(13, 'inventore', 'jpg', 'images/9.jpg', 12, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(14, 'commodi', 'jpg', 'images/9.jpg', 13, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(15, 'voluptas', 'jpg', 'images/9.jpg', 14, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(16, 'excepturi', 'jpg', 'images/5.jpg', 15, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(17, 'magnam', 'jpg', 'images/2.jpg', 16, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(18, 'dolor', 'jpg', 'images/8.jpg', 17, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(19, 'cum', 'jpg', 'images/5.jpg', 18, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(20, 'aspernatur', 'jpg', 'images/2.jpg', 19, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(21, 'culpa', 'jpg', 'images/8.jpg', 20, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(22, 'asperiores', 'jpg', 'images/5.jpg', 21, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(23, 'perspiciatis', 'jpg', 'images/4.jpg', 22, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(24, 'ut', 'jpg', 'images/7.jpg', 23, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(25, 'earum', 'jpg', 'images/7.jpg', 24, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(26, 'dolorem', 'jpg', 'images/6.jpg', 25, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(27, 'placeat', 'jpg', 'images/8.jpg', 26, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(28, 'illum', 'jpg', 'images/4.jpg', 27, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(29, 'magnam', 'jpg', 'images/10.jpg', 28, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(30, 'quibusdam', 'jpg', 'images/2.jpg', 29, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(31, 'blanditiis', 'jpg', 'images/3.jpg', 30, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(32, 'nulla', 'jpg', 'images/8.jpg', 31, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(33, 'quidem', 'jpg', 'images/9.jpg', 32, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(34, 'mollitia', 'jpg', 'images/3.jpg', 33, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(35, 'ad', 'jpg', 'images/5.jpg', 34, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(36, 'quod', 'jpg', 'images/8.jpg', 35, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(37, 'dolorum', 'jpg', 'images/1.jpg', 36, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(38, 'necessitatibus', 'jpg', 'images/8.jpg', 37, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(39, 'cupiditate', 'jpg', 'images/2.jpg', 38, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(40, 'ut', 'jpg', 'images/7.jpg', 39, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(41, 'nostrum', 'jpg', 'images/5.jpg', 40, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(42, 'perspiciatis', 'jpg', 'images/8.jpg', 41, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(43, 'magnam', 'jpg', 'images/3.jpg', 42, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(44, 'delectus', 'jpg', 'images/3.jpg', 43, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(45, 'ut', 'jpg', 'images/1.jpg', 44, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(46, 'necessitatibus', 'jpg', 'images/7.jpg', 45, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(47, 'sit', 'jpg', 'images/5.jpg', 46, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(48, 'ipsa', 'jpg', 'images/2.jpg', 47, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(49, 'officia', 'jpg', 'images/1.jpg', 48, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(50, 'qui', 'jpg', 'images/10.jpg', 49, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(51, 'similique', 'jpg', 'images/3.jpg', 50, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(52, 'thmb.jpg', 'jpg', 'images/YDYWJSlmuDwo4aDxi3RVEyWo4ac2mh9GsSFxhdKC.png', 51, 'App\\Models\\Post', '2023-09-02 20:37:23', '2023-09-02 21:03:16'),
(53, 'diablo.png', 'png', 'images/YkhneX3AHLZXzthDipDakOqpWx2Zj8lDN3q2LdYV.png', 52, 'App\\Models\\Post', '2023-09-03 13:11:30', '2023-09-03 13:11:30'),
(54, 'diablo.png', 'png', 'images/ApYhox1j3yFja3SyoJOQOsNqOzrnkw4L6PRzTweh.png', 53, 'App\\Models\\Post', '2023-09-03 13:15:31', '2023-09-03 13:18:41');

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
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_02_172047_create_others_table', 1),
(7, '2023_07_03_173045_create_categories_table', 1),
(8, '2023_07_03_173046_create_platforms_table', 1),
(9, '2023_07_04_174647_create_posts_table', 1),
(10, '2023_07_05_090452_create_post_tag_table', 1),
(11, '2023_07_05_090854_create_tags_table', 1),
(12, '2023_07_05_113945_create_comments_table', 1),
(13, '2023_07_06_090659_create_images_table', 1),
(14, '2023_07_15_093013_create_contacts_table', 1),
(15, '2023_08_13_154643_create_permissions_table', 1),
(16, '2023_08_13_155228_create_pivot_table_permissions_roles', 1),
(17, '2023_08_26_093154_create_settings_table', 1);

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
(1, 'News', 'news', 11, '2023-09-02 23:31:42', '2023-09-02 23:31:42');

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
(1, 'admin.index', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(2, 'admin.posts.index', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(3, 'admin.posts.create', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(4, 'admin.posts.store', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(5, 'admin.posts.show', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(6, 'admin.posts.edit', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(7, 'admin.posts.update', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(8, 'admin.posts.destroy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(9, 'admin.upload_tinymce_image', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(10, 'admin.categories.index', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(11, 'admin.categories.create', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(12, 'admin.categories.store', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(13, 'admin.categories.show', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(14, 'admin.categories.edit', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(15, 'admin.categories.update', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(16, 'admin.categories.destroy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(17, 'admin.platforms.index', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(18, 'admin.platforms.create', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(19, 'admin.platforms.store', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(20, 'admin.platforms.show', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(21, 'admin.platforms.edit', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(22, 'admin.platforms.update', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(23, 'admin.platforms.destroy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(24, 'admin.others.index', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(25, 'admin.others.create', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(26, 'admin.others.store', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(27, 'admin.others.show', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(28, 'admin.others.edit', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(29, 'admin.others.update', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(30, 'admin.others.destroy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(31, 'admin.tags.index', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(32, 'admin.tags.show', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(33, 'admin.tags.destroy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(34, 'admin.comments.index', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(35, 'admin.comments.create', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(36, 'admin.comments.store', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(37, 'admin.comments.edit', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(38, 'admin.comments.update', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(39, 'admin.comments.destroy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(40, 'admin.roles.index', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(41, 'admin.roles.create', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(42, 'admin.roles.store', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(43, 'admin.roles.edit', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(44, 'admin.roles.update', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(45, 'admin.roles.destroy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(46, 'admin.users.index', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(47, 'admin.users.create', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(48, 'admin.users.store', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(49, 'admin.users.show', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(50, 'admin.users.edit', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(51, 'admin.users.update', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(52, 'admin.users.destroy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(53, 'admin.contacts', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(54, 'admin.contacts.destroy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(55, 'admin.setting.edit', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(56, 'admin.setting.update', '2023-08-31 04:45:09', '2023-08-31 04:45:09');

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
(1, 1, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(2, 2, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(3, 3, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(4, 4, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(5, 5, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(6, 6, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(7, 7, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(8, 8, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(9, 9, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(10, 10, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(11, 11, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(12, 12, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(13, 13, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(14, 14, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(15, 15, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(16, 16, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(17, 17, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(18, 18, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(19, 19, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(20, 20, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(21, 21, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(22, 22, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(23, 23, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(24, 24, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(25, 25, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(26, 26, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(27, 27, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(28, 28, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(29, 29, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(30, 30, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(31, 31, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(32, 32, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(33, 33, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(34, 34, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(35, 35, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(36, 36, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(37, 37, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(38, 38, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(39, 39, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(40, 40, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(41, 41, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(42, 42, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(43, 43, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(44, 44, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(45, 45, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(46, 46, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(47, 47, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(48, 48, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(49, 49, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(50, 50, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(51, 51, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(52, 52, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(53, 53, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(54, 54, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(55, 55, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(56, 56, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(57, 1, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(58, 2, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(59, 3, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(60, 4, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(61, 5, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(62, 6, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(63, 7, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(64, 10, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(65, 11, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(66, 12, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(67, 13, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(68, 14, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(69, 15, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(70, 17, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(71, 18, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(72, 19, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(73, 20, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(74, 21, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(75, 22, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(76, 24, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(77, 25, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(78, 26, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(79, 27, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(80, 28, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52'),
(81, 29, 3, '2023-09-03 13:00:52', '2023-09-03 13:00:52');

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
(1, 'News', 'News', 11, '2023-09-02 23:33:01', '2023-09-02 23:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `platform_id` bigint(20) UNSIGNED NOT NULL,
  `other_id` bigint(20) UNSIGNED NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `excerpt`, `body`, `user_id`, `category_id`, `platform_id`, `other_id`, `views`, `status`, `created_at`, `updated_at`) VALUES
(51, 'Welcome to Epic Game News', 'welcome-to-epic-game-news', 'Welcome to Epic Game News', '<p style=\"text-align: center;\"><strong><img src=\"../../../storage/tinymce_uploads/o10ifvQialR3tq73Jk2AF85iB0owOQvQ2S5EG1qk.png\" alt=\"\"></strong></p>\n<p style=\"text-align: center;\"><strong>Welcome to Epic Game News</strong></p>\n<p>Welcome to Epic Game News, your ultimate source for the latest and greatest in the world of gaming. Dive into a dynamic realm of gaming news, reviews, and updates that cater to every gamer\'s passion. Stay ahead with breaking stories, exclusive insights, and in-depth analysis of your favorite games, consoles, and gaming culture. Whether you\'re a casual player or a dedicated enthusiast, Epic Game News is your trusted companion in the ever-evolving universe of video games. Join our community of gamers and be part of the epic journey!</p>', 11, 11, 1, 1, 0, 'published', '2023-09-02 20:37:23', '2023-09-02 21:03:02'),
(52, 'Diablo 4 Developer Shares Insights on the Potential Inclusion of the Blood Knight Class from Diablo Immortal', 'diablo-4-developer-shares-insights-on-the-potential-inclusion-of-the-blood-knight-class-from-diablo-immortal', 'In a recent Gamescom 2023 interview, General Manager Rod Fergusson provides a clear response regarding the fate of the Blood Knight class in Diablo 4.', '<p>While the introduction of the Blood Knight class in Diablo Immortal has certainly caught the attention of fans, Rod Fergusson, the developer behind Diablo 4, has made it clear that players should not anticipate the appearance of this bloodthirsty champion in the franchise\'s latest installment. The unveiling of Diablo 4\'s Season of Blood on August 22, which promised various fixes and quality-of-life improvements, also prominently featured a vampire theme that didn\'t escape the community\'s notice.</p>\r\n<p>Vampires in the Diablo series have traditionally played passive roles, either as run-of-the-mill adversaries or lurking in the depths of Sanctuary\'s lore. The announcement of the Blood Knight\'s arrival in Diablo Immortal finally brought vampires into the spotlight, and somewhat ironically, Diablo 4 is now embracing this concept further with its Season 2 theme. The idea of a spear-wielding, shadowy champion fits seamlessly into the Diablo class fantasy, prompting many players to wonder whether the Blood Knight might eventually find its way into Diablo 4.</p>', 11, 14, 1, 1, 0, 'published', '2023-09-03 13:11:30', '2023-09-03 13:11:30'),
(53, 'A Diablo 4 Player Displays an Astoundingly Potent Unique Weapon for Their Sorcerer', 'diablo-4-player-showcases-incredibly-powerful-sorcerer-unique-weapon', 'A fortunate Diablo 4 gamer reveals their Sorcerer\'s Unique Weapon, which has the potential to completely revolutionize the class\'s gameplay, irrespective of the chosen build.', '<p>While not everyone may be satisfied with the current itemization in Diablo 4, a recent presentation of a Unique Weapon designed for Sorcerers demonstrates that the system is fully capable of generating compelling loot. Sorcerers in Diablo 4 have been grappling with substantial nerfs endured during the Open Beta, but thanks to the changes introduced throughout Diablo 4\'s Season of the Malignant, there\'s been a notable uptick in build diversity for this iconic caster class in the Diablo universe.</p>\r\n<p>From Chain Lightning and Charged Bolts to Firewall Sorcerer builds in Diablo 4, players now have the opportunity to explore more viable endgame options beyond relying solely on Ice Shards to deal substantial damage. While concerns about an excessive reliance on defensive skills like Flame Shield, Frost Nova, and Teleport persist, it\'s hard to deny that Sorcerers are in a considerably improved state compared to their launch status.</p>', 11, 11, 1, 1, 0, 'published', '2023-09-03 13:15:31', '2023-09-03 13:18:41');

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
(131, 51, 11, NULL, NULL),
(132, 51, 12, NULL, NULL),
(133, 51, 13, NULL, NULL),
(134, 52, 14, NULL, NULL),
(135, 52, 15, NULL, NULL),
(136, 52, 16, NULL, NULL),
(137, 52, 17, NULL, NULL),
(138, 52, 18, NULL, NULL),
(139, 52, 19, NULL, NULL),
(140, 53, 20, NULL, NULL),
(141, 53, 21, NULL, NULL),
(142, 53, 22, NULL, NULL),
(143, 53, 23, NULL, NULL),
(144, 53, 24, NULL, NULL),
(145, 53, 25, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'user', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(2, 'admin', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(3, 'editor', '2023-09-03 13:00:52', '2023-09-03 13:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
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
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `about_first_text`, `about_second_text`, `about_first_image`, `about_second_image`, `about_our_mission`, `about_our_vision`, `about_services`, `created_at`, `updated_at`) VALUES
(1, 'We are a passionate team of gamers, storytellers, and tech enthusiasts who share a common love for the world of gaming. Our journey began with a simple idea: to create a platform that celebrates the gaming universe in all its glory.', 'Our story is one of dedication, fueled by a relentless pursuit of gaming excellence. From our humble beginnings to becoming a trusted source for gaming news, we\'ve been on an epic quest to bring you the latest updates, insights, and stories from the gaming world.', 'setting/hIiJZ257XhGZblY2JHqmHJE8kMfrX0CEXJAohXP6.png', 'setting/bJatXLdbniSjNn83v1mTBp61VQwMfBqA4HxDBPy2.png', '<p>At Epic Game News, our mission is crystal clear: to empower and inform gamers worldwide. We strive to deliver top-notch gaming content that informs, entertains, and inspires. Our dedication to this mission drives us to explore every corner of the gaming universe.</p>', '<p>Our vision is to create a global community where gamers from all walks of life can come together to celebrate their passion. We envision a world where every gamer has access to the latest gaming news, reviews, and resources, fostering a deeper connection with the gaming community.</p>', '<p>Epic Game News offers a range of services designed to enhance your gaming experience. From daily news updates and in-depth game reviews to tips and tricks for mastering your favorite titles, we\'re here to serve the gaming community. Join us on our mission to make every gaming moment truly epic!</p>', '2023-08-31 04:45:10', '2023-09-02 21:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(11, 'news', '2023-09-02 20:37:23', '2023-09-02 20:37:23'),
(12, 'welcome', '2023-09-02 20:37:23', '2023-09-02 20:37:23'),
(13, 'epic game news', '2023-09-02 20:37:23', '2023-09-02 20:37:23'),
(14, 'diablo 4', '2023-09-03 13:11:30', '2023-09-03 13:11:30'),
(15, 'diablo iv', '2023-09-03 13:11:30', '2023-09-03 13:11:30'),
(16, 'rpg', '2023-09-03 13:11:30', '2023-09-03 13:11:30'),
(17, 'videogame', '2023-09-03 13:11:31', '2023-09-03 13:11:31'),
(18, 'game', '2023-09-03 13:11:31', '2023-09-03 13:11:31'),
(19, 'online', '2023-09-03 13:11:31', '2023-09-03 13:11:31'),
(20, 'diablo 4', '2023-09-03 13:15:31', '2023-09-03 13:15:31'),
(21, 'diablo iv', '2023-09-03 13:15:31', '2023-09-03 13:15:31'),
(22, 'rpg', '2023-09-03 13:15:31', '2023-09-03 13:15:31'),
(23, 'online', '2023-09-03 13:15:31', '2023-09-03 13:15:31'),
(24, 'game', '2023-09-03 13:15:31', '2023-09-03 13:15:31'),
(25, 'videogame', '2023-09-03 13:15:31', '2023-09-03 13:15:31');

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
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'Lau', 'laurentiucozma12@gmail.com', '2023-08-31 04:45:09', '$2y$10$i7NElokN3ssGwlMOmkNx8eICVkxe4dDYDUssi9l8lXXBN7DZdiv1C', 1, 2, 'aTNGgbpYUVGYs9ju78DFgWhC2l2qNPin0SysAAKKRB3hCRL3gT8mJY3J50SC', '2023-08-31 04:45:09', '2023-09-03 12:57:52'),
(62, 'V Gabriel', 'mail.v.gabriel@gmail.com', NULL, '$2y$10$MtQrF79RJ7BL8KSCYOFvTe.VAoHfhH0MX4iAzSCdqXCASl55G.nPu', 1, 2, NULL, '2023-09-02 16:43:31', '2023-09-02 16:43:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
