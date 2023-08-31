-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 09:46 AM
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
-- Database: `newgamingnews`
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
(1, 'saepe', 'dolor-suscipit-repellat-iste-dignissimos-autem-recusandae-ad', 11, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(2, 'corrupti', 'dolores-commodi-voluptas-inventore', 11, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(3, 'dolores', 'rerum-officia-reiciendis-incidunt-ducimus', 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(4, 'quo', 'et-libero-ad-deserunt-nostrum-omnis-saepe', 6, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(5, 'officia', 'incidunt-deleniti-molestiae-eos-deleniti-nihil-nam', 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(6, 'asperiores', 'optio-et-laboriosam-illo-labore', 10, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(7, 'est', 'vel-sed-veritatis-consequatur-voluptatum', 10, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(8, 'ut', 'atque-rerum-et-deserunt-et', 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(9, 'voluptatibus', 'corrupti-rem-quia-et-reiciendis-minima-aut-iste', 6, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(10, 'in', 'perspiciatis-ex-architecto-repudiandae-omnis-veritatis-quidem-illum-velit', 1, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(11, 'Uncategorized', 'inventore-eligendi-sunt-explicabo-voluptas-esse', 11, '2023-08-31 04:45:09', '2023-08-31 04:45:09');

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `the_comment`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Facere magni iste consectetur quia enim laudantium autem. Nobis magnam possimus ut architecto. Voluptatem sit beatae qui iste ut modi enim.', 11, 18, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(2, 'Aut ducimus laboriosam enim ut ullam labore. Ut soluta quis cumque et ab dolorem possimus repellendus. Ducimus error numquam et voluptatem neque doloremque atque deserunt.', 12, 39, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(3, 'Sunt id amet molestiae enim vero. Id sunt sit quidem ipsum perferendis qui quia voluptas. Velit qui officia in perferendis non recusandae.', 17, 26, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(4, 'Enim eum perferendis amet fugit illo. Velit consequatur et sit adipisci ullam debitis quod. Iure et repellendus perspiciatis hic dolorem dolores sequi.', 7, 49, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(5, 'Excepturi esse ullam labore et sed nostrum. Esse sunt optio molestiae voluptas non soluta. Veniam et tempora in occaecati blanditiis deserunt.', 32, 26, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(6, 'Veritatis illum consequatur quo dolor eum. At consectetur cum dolores laudantium dicta officiis quia. Dolores dolor minus dolores id. Reiciendis iusto porro nemo occaecati recusandae repudiandae deserunt.', 27, 41, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(7, 'Molestias adipisci dolore vitae et dolorum consequatur accusamus ipsa. Ducimus velit dolores cupiditate dignissimos omnis non recusandae.', 38, 10, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(8, 'Dolorem non voluptatibus sit velit sit enim. Accusantium deleniti asperiores omnis. Officiis aperiam enim ratione incidunt.', 48, 42, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(9, 'Voluptates labore nihil repudiandae quaerat. Delectus cum tempore tenetur. Quae aut aut repellendus rem.', 18, 6, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(10, 'Perferendis qui sequi dolore doloremque. Voluptas omnis aut est quos quos ab deleniti. Mollitia at alias consequatur.', 16, 58, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(11, 'Quo ea voluptatem itaque. Cupiditate nesciunt sint asperiores modi. Quos voluptas voluptas dicta molestias maiores at inventore.', 6, 5, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(12, 'Incidunt quis et tempora laudantium nesciunt. Sint explicabo odit modi recusandae non. Similique amet labore eum dolorem non.', 37, 32, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(13, 'Id eligendi sed rem minus vel itaque. Accusantium velit suscipit illo explicabo quisquam. Quaerat natus possimus in. Ipsa dolores et consectetur eius recusandae.', 40, 57, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(14, 'Repellendus harum iusto hic. Vitae rerum maxime dolorem molestias et. Necessitatibus quos animi aut est. Amet rerum fuga harum amet earum non dolorum molestiae.', 13, 60, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(15, 'Vel corrupti incidunt magni qui impedit eos. Praesentium non minima voluptate aut in animi. Earum provident hic aut adipisci eveniet velit. Nesciunt aut odit ipsam alias voluptas.', 5, 41, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(16, 'Qui iure laboriosam earum deserunt quae nostrum. In rerum facere optio deserunt sit. Delectus porro et quas.', 2, 1, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(17, 'Sit quia sed et a nesciunt in tempora. Labore aut cupiditate commodi ut totam. Dolor distinctio voluptates ut consequatur sint omnis voluptatem.', 31, 48, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(18, 'Rerum dignissimos molestias delectus rem molestiae perferendis. Nihil maxime minima deserunt. Molestiae quia rerum ea. Eius sequi doloremque est similique similique beatae sed amet. Et non consequatur et commodi repellendus ad.', 1, 25, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(19, 'Soluta sit ut molestiae quia nostrum. Dolores aut et aut totam sed minus. Et est et dolorum non dolores culpa.', 29, 45, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(20, 'Veritatis aut voluptatem quam ut aliquam. Distinctio ea debitis sit velit enim dolor commodi blanditiis. Nam culpa non facilis maxime debitis sequi et. Non error dolorem non dicta hic illo.', 49, 34, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(21, 'Unde aliquid enim velit quam consectetur. Accusamus natus quam ut recusandae consectetur cumque quo. Culpa cum impedit ea ipsam. Omnis et suscipit nulla cumque autem vel.', 38, 23, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(22, 'Debitis ipsa omnis iusto et nam sequi. Quae sit dicta sint totam atque nostrum voluptas saepe. Laudantium asperiores voluptas est quia.', 1, 58, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(23, 'Sit dolore vitae et voluptas amet dolorem. Est esse non sed ipsa. Magnam quae qui et vero quisquam. Earum facilis sed officiis nihil.', 37, 26, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(24, 'Ipsum et est est perspiciatis. Est odio suscipit omnis ipsam vero facere rerum. Harum reprehenderit nulla enim.', 42, 55, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(25, 'Illo nostrum sed consequuntur doloremque et consequatur. Illum quia consequatur doloremque possimus debitis molestiae porro. Nemo blanditiis veritatis atque modi.', 43, 59, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(26, 'Beatae exercitationem illo nam velit impedit assumenda sapiente aut. Facilis nostrum dolorem ut sed nemo. Ea aut illum unde velit magnam ipsum eveniet.', 32, 4, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(27, 'Quis alias provident illum aut fugit sunt. Sunt doloribus molestias rem necessitatibus. Est et ut fugiat repudiandae id voluptatem. Culpa deserunt eligendi qui. Numquam corporis nostrum quasi sed ratione.', 10, 16, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(28, 'Incidunt est nostrum quia iste. Veritatis quos aut aperiam saepe. Distinctio minus et animi et enim nihil.', 20, 39, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(29, 'Voluptatem enim accusamus facilis totam aut ut. Maiores sunt aut similique vel. Et aut sed consequatur dolores minima consequatur aut.', 37, 50, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(30, 'Autem soluta perferendis tempora inventore a voluptatibus magni. Ullam consectetur ut est totam odit soluta. Maxime ullam sunt et accusamus qui sed. Deserunt nam autem dolores nostrum dolor.', 46, 53, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(31, 'Totam ad accusantium fuga officiis similique ipsam. Vel beatae fugiat ipsum ex est ipsa ut. Magnam quo placeat velit.', 13, 36, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(32, 'Sed pariatur cupiditate iste itaque facere ratione error. Vitae molestiae ducimus atque nostrum. Aliquam qui rerum explicabo assumenda.', 31, 12, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(33, 'Blanditiis culpa minus autem laboriosam maiores quaerat voluptas. Quia odit omnis soluta quis asperiores. Debitis illum dolores optio odio magnam pariatur. Repellendus modi odit illo debitis quibusdam nostrum excepturi.', 1, 44, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(34, 'Est rerum facere dolor sapiente atque. Minima vel est eos excepturi. Dolor odit iure aut pariatur officiis error omnis dolore.', 17, 43, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(35, 'Debitis eaque non a sit. Nulla in et occaecati dolor ut molestiae reiciendis. Rerum repudiandae nihil ea tenetur omnis recusandae. Soluta omnis quam voluptatem.', 34, 2, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(36, 'Laboriosam incidunt occaecati eveniet et id. Soluta atque quia incidunt reprehenderit. Molestias voluptatum dolor natus officia. Illo delectus quo quia voluptates aut consequatur quo officiis.', 18, 50, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(37, 'Dolore eius totam vitae rerum. Nulla libero vel repellendus perspiciatis eum corrupti. Est ipsum libero pariatur aspernatur repellat.', 19, 20, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(38, 'Ea possimus temporibus velit error. Aut commodi laudantium est porro reprehenderit maxime ipsam hic.', 28, 2, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(39, 'Qui illum dolorum ipsa voluptates minima. Maiores iusto at enim praesentium voluptatem quam quisquam esse. Quia quia velit quae quidem. Quisquam et voluptas sit doloremque.', 17, 43, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(40, 'Sit voluptatibus omnis ipsa et et eligendi. Reiciendis eum facere impedit. Atque eos illo similique pariatur.', 8, 35, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(41, 'Fugit labore est aliquid consectetur consequatur est. Odio repudiandae ipsum consectetur et. Omnis voluptatibus corporis autem sequi.', 43, 45, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(42, 'Nesciunt corporis in corporis dolores a voluptate. Occaecati vel a excepturi expedita dolorum. Aspernatur tenetur optio doloremque enim omnis. Magni ullam error error.', 40, 61, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(43, 'Numquam qui nam reiciendis placeat. Expedita voluptas ut quia eveniet praesentium. Voluptates omnis labore voluptates nihil facere. Repellat quod sit maiores expedita. Et ea saepe est.', 47, 34, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(44, 'Consequuntur praesentium et ipsam voluptas saepe error consequatur hic. Voluptatum voluptatem et nobis necessitatibus expedita consequuntur et. Rerum voluptatem perspiciatis eum et repudiandae.', 11, 45, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(45, 'Quam expedita numquam doloribus sequi quis ea iusto dolores. Omnis in sint nesciunt porro sunt pariatur pariatur. Aliquid nihil ratione non dolor rerum et et. Perferendis sapiente ea inventore similique.', 21, 12, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(46, 'Blanditiis error laudantium neque odio dolorem excepturi laboriosam in. Beatae consectetur dolor accusantium omnis cupiditate. Odio et et harum qui qui. Omnis sit dolore ut sit.', 17, 53, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(47, 'Quo vel soluta debitis ipsum asperiores natus quasi beatae. Et architecto dolores aut dolore. Quod voluptatem pariatur qui non reprehenderit voluptas. Culpa eveniet vitae debitis.', 17, 28, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(48, 'Voluptatibus cupiditate minus ad. Et beatae enim et eum repellat voluptatem. Aspernatur possimus ipsam dolore laborum aliquid.', 24, 5, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(49, 'Maiores est et est. Reprehenderit neque iste et quia eos architecto est. Maxime molestiae laborum nisi exercitationem praesentium consectetur accusamus suscipit.', 5, 47, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(50, 'Impedit dolores ab culpa vitae fugiat rem ipsum perferendis. Ut accusamus ipsam ut autem aut ullam. A cupiditate modi id officiis saepe deserunt voluptate.', 38, 9, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(51, 'Consectetur voluptas recusandae culpa numquam amet aspernatur architecto atque. Vitae aperiam tenetur sit. Odit libero voluptates non. Illum ipsa inventore omnis dolore ipsam cupiditate occaecati.', 47, 23, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(52, 'Deserunt laudantium quo eos et nobis dolorum et. Esse in deleniti occaecati quia. Labore consequatur vel id officiis voluptas dignissimos.', 23, 19, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(53, 'Error velit nesciunt consectetur iste corrupti. Sint beatae vero veritatis sed non hic.', 17, 58, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(54, 'Perferendis maxime dolorem sint quasi. Voluptas libero rerum reiciendis est doloremque ut. Fugiat sunt quis officiis sunt ut ex blanditiis est. Beatae qui nemo nihil ut.', 47, 26, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(55, 'Officiis eveniet ratione recusandae hic sed dolorum. Consequatur perferendis voluptatum repudiandae quia mollitia est. Necessitatibus rem voluptas qui voluptate ad laborum omnis.', 16, 9, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(56, 'Nostrum quia quia est vitae quisquam. Perspiciatis aut esse odit reiciendis. Quidem ullam tempora voluptatibus eveniet quia quidem et.', 24, 55, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(57, 'Aut rem laudantium numquam laborum autem aliquam suscipit vero. Enim et quo dolorem iure omnis optio quis.', 49, 33, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(58, 'Officia aspernatur dolorum repudiandae qui a adipisci. Rem id vel repellat incidunt cupiditate cumque debitis suscipit. Cum aut qui rem qui ut. Ut quia quia minima voluptates tempora et. Animi repudiandae aliquid suscipit qui.', 42, 49, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(59, 'Delectus ex animi voluptas repellat cumque quia. Rerum itaque earum pariatur blanditiis in cupiditate ut. Numquam et quam quos et consequatur. Ut ut nisi corrupti veniam.', 23, 32, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(60, 'Qui et voluptatem quasi magnam est. Enim autem temporibus dolorem enim natus dolores iusto excepturi. Est optio aut qui molestiae aut rerum qui.', 11, 19, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(61, 'Sapiente aut autem mollitia fugit et neque recusandae. Consequatur iste incidunt est repellat in sequi ipsa vitae. Sunt aliquam suscipit ut enim excepturi voluptatem. Ut officia maxime ab harum consequatur laudantium est. Ut nisi voluptatem amet earum architecto facilis et.', 2, 36, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(62, 'Rem quaerat nobis non ut ex. Ratione itaque dolorem pariatur est debitis voluptatem qui. Nobis ea delectus rem delectus aut.', 2, 46, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(63, 'Eaque accusantium impedit corporis tempore modi. Recusandae iusto aut aspernatur dolore. Commodi suscipit at et quis eum. Dolore eos nemo eligendi.', 32, 19, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(64, 'Aut qui delectus id sint molestiae quos. Minima ab aspernatur numquam sint temporibus nobis consequuntur. Et deleniti fugiat error est tempore non.', 20, 48, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(65, 'Quia sed fuga sit eum nihil quo et. Dolorum modi sunt illum unde nam. Labore blanditiis delectus explicabo provident commodi repellendus officia. Unde recusandae veritatis beatae ut. Voluptas vel et aut.', 16, 51, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(66, 'Voluptas incidunt ad dignissimos dolor ut esse et. Quaerat consequuntur facere soluta voluptatem qui harum a. Et minima at eum ullam sunt officiis quae.', 24, 18, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(67, 'Alias consequatur adipisci magnam a voluptatibus qui. Quia perspiciatis ea nulla maxime corrupti et repellat odio. Molestiae occaecati beatae est quam qui id.', 31, 41, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(68, 'Numquam nesciunt iusto adipisci fuga repudiandae. Expedita commodi iste repellat ullam necessitatibus ad. Nihil odit ea est occaecati occaecati. Vel voluptates adipisci vel. Quas et doloremque ut dolorem molestiae minus eos ad.', 32, 7, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(69, 'Nisi tempore voluptatum sunt commodi excepturi dicta. Est nulla accusantium amet repellat aut quo. Nisi fugiat quibusdam sint quia animi odio. Culpa in provident corporis at alias quis deserunt eveniet.', 35, 19, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(70, 'Dolores ipsam corporis et ut. Qui consequuntur esse eaque. Quam enim in voluptates voluptatibus voluptatem eum recusandae. Unde sed quasi atque minus. Officiis ipsam officiis aperiam.', 15, 45, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(71, 'Voluptate sed sed non aperiam accusamus in. Rem ratione sit voluptas culpa eligendi reiciendis. Rerum ut eligendi quibusdam vel et fugit excepturi quia. Veniam quisquam minima omnis qui.', 10, 21, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(72, 'Dolorem accusantium dolores reprehenderit nam cum reiciendis laboriosam. Eum in veniam nihil voluptas. Occaecati ex ad veritatis dolorum. Omnis hic et qui minima aliquid sunt.', 38, 37, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(73, 'Et tempore praesentium accusamus aut saepe. Vero natus saepe incidunt. Quos sequi sed soluta sit. Necessitatibus dolore id autem perferendis quia. Quisquam qui occaecati a nemo.', 18, 49, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(74, 'Voluptas illo voluptas mollitia ut. Maxime qui quos est dignissimos expedita eveniet dolores. Et ut omnis cumque a magni.', 39, 13, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(75, 'Quia labore dolorem doloribus eaque nulla. Est animi quo sint voluptas. Totam saepe aut quo dolores qui fugit.', 1, 32, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(76, 'Alias assumenda numquam consequatur architecto. Consequatur omnis ut adipisci neque doloribus. Iure ut eligendi cupiditate eius impedit et in. Cupiditate dolorem eaque unde.', 33, 23, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(77, 'Sed consequatur voluptatem eaque et illum rerum. Eveniet aliquid est dicta ut. Laboriosam facilis ut minima nostrum velit quod fugit. Qui reprehenderit eos aperiam qui.', 18, 7, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(78, 'Dolorum sapiente est sed veritatis ratione. Veritatis inventore accusamus excepturi itaque. Fuga aspernatur quisquam occaecati provident porro.', 36, 11, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(79, 'Hic et deserunt ea illum aut voluptas dolorem aut. Nam ut magnam fugiat corrupti et.', 4, 23, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(80, 'Aliquid eligendi velit sint ut labore explicabo. Accusantium fugit voluptate eius dignissimos est rem. Consequatur similique labore ea perferendis. Omnis dicta id dicta aut. Excepturi eius voluptatibus inventore sit quasi.', 33, 28, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(81, 'Consequatur animi quisquam cum perferendis. Sunt molestias temporibus quia. Nostrum voluptatibus deserunt dignissimos qui sunt. Eum facilis corrupti sapiente dolor porro ducimus. Exercitationem vel reiciendis minus voluptas rerum commodi et.', 36, 32, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(82, 'Tempore labore enim iure beatae. Ipsam rem sequi tempora laborum.', 25, 47, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(83, 'Nulla rerum ut adipisci consequatur. Velit aspernatur dolore sit corporis aut aut facere. Nobis commodi qui ut. Consequatur at eum sunt asperiores et.', 48, 20, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(84, 'Dolores fugit suscipit tempora ut voluptatem. Voluptas debitis occaecati sed. Et aliquid libero eveniet cumque.', 36, 57, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(85, 'Accusamus voluptatem vero rerum omnis saepe a aperiam. Est sequi totam excepturi omnis incidunt qui. Temporibus tenetur recusandae adipisci accusamus sed. Aut velit incidunt voluptatum non dolor esse ipsa rem. Possimus est similique dolores nihil ut.', 34, 5, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(86, 'Totam sint qui nam sit suscipit dolorem. Veniam et autem dolores ea facilis amet quam ullam. Sint aut qui voluptatem optio illo. Quibusdam eos porro facilis sed iusto.', 14, 2, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(87, 'Quas est numquam dolores expedita doloremque alias dolorum. Blanditiis voluptas libero et animi omnis vitae. Expedita velit cumque ut nihil. Provident culpa modi eaque nulla quis inventore.', 49, 50, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(88, 'Officiis libero numquam voluptatum blanditiis. Iste cumque consequuntur exercitationem.', 40, 50, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(89, 'Officiis sint aut ratione in. Asperiores asperiores quo est voluptate quibusdam eligendi ipsum a. Modi qui omnis illum cumque est.', 6, 42, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(90, 'Rerum accusamus totam ut sit. Architecto minus est culpa excepturi omnis aut. Inventore iste iure quibusdam itaque doloremque ducimus. Quam incidunt tempora voluptatibus architecto.', 10, 31, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(91, 'Commodi enim sit placeat ut nemo autem. Inventore explicabo vero voluptatem hic asperiores possimus saepe.', 40, 19, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(92, 'Aut possimus consequatur illo sunt ut deleniti et quibusdam. Sequi ratione sit numquam sit. Natus autem sunt necessitatibus aliquid quia delectus nobis maiores. Consequuntur adipisci doloremque ut sed veniam molestiae placeat.', 9, 21, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(93, 'Dolorem labore voluptas tempore id. Ut qui sed optio aut consequatur. Asperiores aspernatur sit sit enim reprehenderit similique.', 41, 35, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(94, 'Autem aut facere id aliquid voluptate. Modi cupiditate in eius temporibus sit pariatur quasi. Eius voluptatum sint velit qui placeat corrupti.', 36, 43, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(95, 'Ea rerum molestiae id expedita ab. Non quod quibusdam id quisquam vel. Ea quia labore iure saepe tempora. Nihil id accusantium facilis aperiam.', 38, 49, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(96, 'Iure voluptate totam est omnis magnam aut architecto error. Omnis ut unde ut quos. Quia vitae sunt sint dignissimos. Cum voluptate necessitatibus accusantium rerum dicta.', 10, 19, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(97, 'Ad nobis aut cupiditate dolores nobis accusantium. Officia vel provident fuga fuga enim voluptatum sed. Doloribus aperiam harum harum. Consequatur illo quis asperiores quidem numquam quo nulla voluptatem. Id voluptas totam voluptatem omnis ut at similique.', 44, 31, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(98, 'Velit aut hic officiis aliquid officiis pariatur pariatur. Perspiciatis repellendus illum aut et excepturi ut. Dolor aliquid aut autem qui ex quod.', 24, 32, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(99, 'Quam aut adipisci non consequatur debitis. Dolores dolor et nihil et totam recusandae.', 2, 32, '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(100, 'Saepe omnis eos commodi maxime nihil qui. Similique optio magni sapiente animi voluptatem ad. Earum suscipit a dolorem consequuntur autem earum perferendis. Et non totam rerum nobis beatae quia.', 5, 58, '2023-08-31 04:45:10', '2023-08-31 04:45:10');

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
(51, 'similique', 'jpg', 'images/3.jpg', 50, 'App\\Models\\Post', '2023-08-31 04:45:10', '2023-08-31 04:45:10');

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
(1, 'ipsum', 'velit-voluptates-sapiente-ducimus-ut', 6, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(2, 'aspernatur', 'quod-repellat-aspernatur-sit-cum', 11, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(3, 'hic', 'sed-harum-ut-magnam', 9, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(4, 'rem', 'non-sed-quae-facere-officiis', 6, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(5, 'ut', 'ad-iste-debitis-et-numquam-eveniet', 1, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(6, 'quos', 'rerum-est-voluptas-omnis-iusto-voluptatem-voluptate-dolorem', 6, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(7, 'ut', 'ipsam-qui-est-consequuntur-nostrum-iusto-perspiciatis-fugit', 11, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(8, 'facere', 'nesciunt-ex-vel-et-illum-omnis-quos-dolorem', 5, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(9, 'molestias', 'quisquam-nemo-qui-similique-explicabo-ut', 11, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(10, 'ex', 'beatae-excepturi-eum-minus-alias', 10, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(11, 'impedit', 'amet-soluta-ipsam-blanditiis-soluta-in-non-optio-quaerat', 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(12, 'natus', 'repellat-est-praesentium-aspernatur-neque-sed', 3, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(13, 'dolor', 'eaque-sed-minima-cum-ratione-quaerat', 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(14, 'dolores', 'blanditiis-incidunt-saepe-vel-et-ipsa', 3, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(15, 'illum', 'molestiae-perspiciatis-ad-at-commodi-laboriosam-consequatur', 3, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(16, 'magni', 'qui-harum-nobis-dolor', 11, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(17, 'voluptas', 'corporis-numquam-cupiditate-excepturi-quibusdam-quod', 4, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(18, 'ratione', 'harum-enim-earum-sed-ducimus', 4, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(19, 'reiciendis', 'repellendus-quas-rerum-magni-nobis', 5, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(20, 'rerum', 'dolor-et-minus-magni', 4, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(21, 'nemo', 'vero-nam-ipsa-veniam-enim', 6, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(22, 'ut', 'vero-maxime-quidem-qui-facilis-molestiae', 5, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(23, 'suscipit', 'consequatur-quis-eum-dignissimos-corrupti-quis', 8, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(24, 'eos', 'voluptas-eos-excepturi-doloremque-maxime-ducimus-voluptatem-corporis', 3, '2023-08-31 04:45:09', '2023-08-31 04:45:09');

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
(56, 56, 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09');

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
(1, 'omnis', 'nulla-labore-nisi-enim-iste', 8, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(2, 'velit', 'consequuntur-est-aliquam-dolore-reprehenderit', 9, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(3, 'possimus', 'quis-ut-eos-eaque-exercitationem', 9, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(4, 'reiciendis', 'velit-maxime-laboriosam-ipsa-optio-est-aut', 5, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(5, 'facere', 'molestiae-laborum-est-ut', 6, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(6, 'deleniti', 'et-neque-ratione-aliquid-id-dignissimos-nemo-quisquam', 9, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(7, 'odio', 'placeat-voluptatem-perspiciatis-animi-aut-esse', 6, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(8, 'atque', 'ea-hic-quod-voluptas-cupiditate', 10, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(9, 'nesciunt', 'blanditiis-et-expedita-est', 10, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(10, 'non', 'mollitia-a-quibusdam-praesentium-quo', 4, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(11, 'blanditiis', 'beatae-ea-dicta-similique-atque', 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(12, 'adipisci', 'quidem-excepturi-corporis-et-rem', 3, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(13, 'placeat', 'libero-tempore-qui-tempore-nihil-optio-eius-est', 11, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(14, 'qui', 'nesciunt-qui-consequatur-voluptatibus', 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(15, 'distinctio', 'aut-id-voluptatibus-sunt-et-quo-enim-omnis-laborum', 6, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(16, 'ducimus', 'sed-temporibus-minus-ad', 4, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(17, 'maxime', 'occaecati-ab-ducimus-eum-quod-doloremque', 1, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(18, 'minus', 'itaque-similique-est-commodi-voluptatum-veritatis-mollitia-aperiam-est', 1, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(19, 'cupiditate', 'omnis-quae-aliquam-maiores-fugiat-et-velit-in', 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(20, 'reprehenderit', 'ea-accusantium-consequatur-rerum-iure-laudantium-molestias', 2, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(21, 'nihil', 'libero-ut-dicta-saepe-quo', 5, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(22, 'vel', 'natus-natus-totam-aspernatur-omnis-occaecati-in-facere', 8, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(23, 'aut', 'reprehenderit-placeat-nisi-perferendis', 11, '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(24, 'et', 'sit-ut-debitis-voluptatum-labore-incidunt-reiciendis-blanditiis-dolores', 9, '2023-08-31 04:45:09', '2023-08-31 04:45:09');

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
(1, 'Sint suscipit nesciunt qui corrupti omnis ratione necessitatibus.', 'est-cum-sit-ab-cupiditate-et', 'Dolores animi doloribus sit sint molestiae recusandae sequi.', 'Velit veritatis ad dolorem quia ducimus. Velit quo et dignissimos minima quia unde omnis autem.', 12, 10, 16, 8, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(2, 'Recusandae eveniet quis sunt sint quis.', 'ullam-velit-soluta-voluptatem-est-laborum', 'Eveniet numquam eveniet est ab eum ipsum adipisci laboriosam.', 'Vel vero autem quo quasi voluptatibus. Autem error eos vero officiis et voluptas autem. Excepturi id dicta et expedita. Aperiam et et dicta molestiae voluptatem ut et similique.', 13, 8, 8, 9, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(3, 'Et optio illo temporibus deleniti voluptas error et deleniti.', 'sunt-cupiditate-fugiat-qui-et-et-veritatis', 'Quia quidem ab aut explicabo.', 'At illo saepe quos distinctio voluptate qui. Autem minima et possimus voluptas aut sed. Rerum ipsam inventore quam atque. Maxime adipisci molestiae officia impedit dicta quia quos.', 14, 8, 7, 5, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(4, 'Hic earum maiores earum similique saepe.', 'ut-id-mollitia-ut-aut-esse-esse-saepe-earum', 'Quam dignissimos possimus quo et quod.', 'Ea consequuntur iure iusto sed laudantium saepe omnis. Et in repellendus neque voluptas laboriosam ut. Voluptatem beatae quas inventore sit est. Qui inventore veniam amet reiciendis.', 15, 1, 16, 17, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(5, 'Dignissimos fugiat hic aut quia sequi.', 'voluptatem-dolores-fugit-aut-omnis-autem-quia-dolorem', 'Deserunt facilis voluptatem fugit vitae sint fuga sint.', 'Sequi voluptas quos velit accusamus omnis soluta. Molestiae eaque deserunt omnis sed. Consequuntur tempora ea voluptas. Eaque harum in excepturi ipsam quis.', 16, 9, 12, 5, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(6, 'Voluptatum eum laudantium excepturi.', 'et-veniam-distinctio-est-ut', 'Ut expedita quos error quam hic sunt sit.', 'Ut qui sapiente ab debitis. Aliquam quam nesciunt itaque nihil ut et. Placeat et modi sint reprehenderit totam est.', 17, 7, 12, 23, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(7, 'Ut animi omnis ut.', 'dolore-occaecati-voluptatum-reprehenderit-a-odit-ex-exercitationem', 'Soluta fugiat eum sunt vero maxime nulla vel.', 'Omnis quo ut quas soluta illo tempora officiis. Dignissimos vitae sunt incidunt vitae consequatur. Dolorem id est ipsa tempora architecto maiores. Voluptatum temporibus ea id esse soluta.', 18, 11, 23, 17, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(8, 'Molestias nam odit nulla reprehenderit ea blanditiis.', 'voluptatem-eos-dolores-ex-sequi', 'Id iste qui ipsum accusantium architecto.', 'Voluptatem voluptatem est inventore. Inventore autem dolores ea delectus corrupti.', 19, 1, 8, 21, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(9, 'Recusandae ea error ea facilis.', 'veritatis-et-molestiae-nisi-laudantium-iure-minima-aut', 'Illum dolor libero delectus consequatur veritatis ab optio.', 'Aut omnis ex rerum consequatur molestiae consequatur consequatur. Voluptatibus exercitationem cumque voluptas cupiditate aut. Harum accusantium dolor nihil illo aut eos. Quas non omnis sapiente ratione sequi non sed.', 20, 7, 1, 21, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(10, 'Magni quia quibusdam vero ad temporibus facere.', 'ut-laudantium-commodi-occaecati-fugiat', 'Ut eos quibusdam cum possimus fuga quis.', 'A corporis sed quia. Occaecati error sed officia beatae assumenda magnam asperiores. Quas et odit est. Dolore sapiente placeat et odio molestias eaque voluptas.', 21, 7, 5, 8, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(11, 'Temporibus eos accusamus autem et quae.', 'natus-sunt-modi-quo-sint-quaerat', 'Nisi repudiandae nihil ducimus quaerat.', 'Possimus et nam id in molestias et molestiae. Laborum eum ea culpa vero deleniti aut. Repellendus et fugit tempore cupiditate. Ut fuga qui voluptatibus inventore enim.', 22, 8, 8, 22, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(12, 'Excepturi sint consequatur quos sed sit amet.', 'consequatur-quae-necessitatibus-praesentium-eos-autem', 'Fuga modi maxime praesentium ut accusamus.', 'Accusamus impedit quaerat molestiae dicta est blanditiis. Tenetur perspiciatis eius facilis consectetur ab. Non ipsa ipsam est qui earum.', 23, 11, 4, 14, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(13, 'Sapiente voluptatum architecto quam architecto enim.', 'sapiente-distinctio-in-accusantium-maiores-consequatur-dolor-quos', 'Vel quia voluptates amet eius porro provident voluptatem.', 'Qui id id aliquid ex dolorum odio quo. Laudantium sequi esse consequatur est. Distinctio aliquam pariatur dolor sapiente. Eligendi harum quasi voluptas.', 24, 2, 3, 15, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(14, 'Voluptatem rerum consectetur assumenda quod mollitia et unde fugit.', 'voluptatem-laborum-et-ratione', 'Aut maiores quod et error.', 'Voluptatum possimus commodi natus velit expedita dolor. Et deleniti sapiente quis voluptas non veritatis doloribus. Molestias corporis quos velit unde eos et quisquam. Sit nihil assumenda aut ut ut.', 25, 4, 16, 17, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(15, 'Totam et expedita sequi.', 'architecto-commodi-aut-dolor-fuga-rem', 'Qui ratione aliquid excepturi.', 'Eaque laborum est modi labore excepturi. Ea ipsam ipsa explicabo et et qui. Non voluptas tenetur et facilis et et. Quam nobis ipsum et impedit non sunt.', 26, 2, 21, 2, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(16, 'Nesciunt consectetur saepe accusamus est impedit voluptas.', 'animi-rerum-eos-aliquam-sint-distinctio-hic', 'Eius voluptas sed voluptatem quisquam rerum veniam.', 'Et est autem dolor rem. Minus fuga tempore doloribus nesciunt rerum. Iure delectus quod iure voluptatem. Molestiae laboriosam sapiente qui placeat aut.', 27, 4, 10, 19, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(17, 'Enim sunt culpa laboriosam est quae fugiat et.', 'tempora-est-quae-voluptas-vel', 'Vitae ipsam ducimus dignissimos quisquam sapiente dignissimos.', 'Numquam aliquam nesciunt ad suscipit nihil tempore ducimus. Laboriosam sed tenetur eum aut rerum eos fugiat. Distinctio iste molestiae sed.', 28, 9, 13, 5, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(18, 'Omnis ipsa qui iste explicabo quas ut aspernatur.', 'quis-repellat-sunt-explicabo', 'Odit ea sequi maxime expedita.', 'Omnis sed eos facere odit eaque. Et non quod nam in. Sed a rerum eum exercitationem maiores voluptate. Rem ex atque aliquam tenetur.', 29, 6, 23, 22, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(19, 'Aut provident omnis assumenda quisquam.', 'optio-et-ad-minima-assumenda', 'Eligendi quo repellendus perferendis illum aliquid.', 'Laborum quo dignissimos fuga modi provident modi. Adipisci minima cumque nesciunt quo tempore mollitia id consequatur. Et expedita maxime accusamus modi natus.', 30, 3, 22, 12, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(20, 'Nihil facilis eos nulla animi.', 'fuga-quidem-dicta-et-consequuntur', 'Sequi tempora laudantium fugit saepe cum dolorem.', 'Quasi debitis eveniet labore. Aut perferendis quisquam voluptatem corrupti eligendi eos voluptas.', 31, 2, 13, 5, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(21, 'Ut recusandae occaecati ut expedita ad.', 'autem-ad-dolore-id-tenetur-aut-et', 'Repudiandae deserunt saepe eaque.', 'Eos maiores voluptatem officiis numquam corporis excepturi. Natus cupiditate suscipit error qui repellat eius.', 32, 5, 23, 17, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(22, 'Voluptatibus et quaerat nihil accusamus minus maxime nemo.', 'quo-fugiat-fuga-quod-non-quasi', 'Ea ut similique exercitationem sunt.', 'Aut labore impedit iure non aliquid. Ab tempore totam quidem laboriosam excepturi nesciunt. Facilis vero ab iusto tenetur aliquam.', 33, 9, 10, 15, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(23, 'Totam voluptatibus distinctio in odit nostrum eum.', 'ducimus-nostrum-pariatur-et-odit-quae', 'Vero ea aut expedita et assumenda ex.', 'Nihil accusamus aperiam placeat quos. A et cupiditate quam dolor in nobis. Similique culpa beatae sunt tempora maxime odit error.', 34, 6, 23, 20, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(24, 'Ad veritatis totam maiores voluptate ipsa.', 'velit-quos-quae-in-corporis', 'Velit animi incidunt ullam maiores necessitatibus.', 'Illo commodi rerum et praesentium nam assumenda ut. Amet quia eveniet quis enim nesciunt. Harum laboriosam neque nulla aut. Consectetur quae itaque et non suscipit.', 35, 3, 7, 19, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(25, 'Possimus molestiae porro non neque non qui.', 'deleniti-libero-ipsa-mollitia-provident-et-necessitatibus-ex', 'Harum distinctio delectus ratione.', 'Consequatur vel ipsam quia quia omnis omnis placeat. A tempore sit velit repudiandae tempore ut nesciunt. Dolor et numquam iusto dolor libero quasi est. Est libero excepturi aut quod earum eos dignissimos. Aut vel incidunt repudiandae qui necessitatibus eos quasi illum.', 36, 4, 9, 6, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(26, 'Quo aut dignissimos asperiores recusandae aut ut quaerat.', 'ullam-quo-voluptatibus-consectetur-aliquam-suscipit', 'Autem laborum animi ut nam sed ullam labore.', 'Consectetur neque nobis qui fuga laudantium nesciunt. Autem eveniet rerum distinctio praesentium molestiae sapiente aut rem. Rem cupiditate cupiditate temporibus sit. Earum ullam veritatis tempore cum.', 37, 8, 19, 15, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(27, 'In voluptas ut at cum molestiae repellendus.', 'velit-expedita-ut-et-debitis', 'Necessitatibus voluptatem aperiam similique ex.', 'Aut voluptas labore sint sed saepe iusto asperiores. Laborum placeat delectus unde nihil vitae rerum. Est est vel quo aut earum.', 38, 7, 22, 2, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(28, 'Aliquid doloremque consequatur facilis optio odio.', 'debitis-est-et-perferendis-nulla', 'Velit explicabo earum est aut velit voluptas.', 'Cupiditate facere mollitia aut totam illum et rerum sed. Tenetur iure aut est sunt quam voluptatem qui. Aperiam ratione autem qui doloribus architecto eum. Et a enim repudiandae odio corporis. Necessitatibus repellat ex voluptate voluptatum aliquam.', 39, 7, 24, 9, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(29, 'Amet porro ea neque in labore illo cum.', 'dignissimos-itaque-ullam-veritatis-assumenda-porro-aut-eaque-architecto', 'Qui dignissimos enim nesciunt tempore.', 'Delectus veniam ducimus est. Sunt et saepe quas molestiae dicta provident ipsa. Nesciunt illum quibusdam distinctio voluptate consectetur qui quo qui.', 40, 11, 3, 8, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(30, 'Adipisci dignissimos illo veniam eius tempore vero.', 'accusantium-occaecati-doloremque-architecto-commodi-quia-molestias-in-voluptatem', 'Ut eligendi voluptatem quo.', 'Aperiam tempora beatae assumenda sapiente. Facere est minus esse id laborum. Eos quasi est laboriosam.', 41, 7, 3, 3, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(31, 'Dolorem cumque tenetur quam quasi ut eos sapiente.', 'aut-animi-et-repellendus-quo-laboriosam-quas-dolorum', 'Est quia aut et alias ut.', 'Ipsum aut ea ut accusamus doloremque quisquam. Asperiores dolores sed quam voluptatem in autem sapiente. Molestiae corrupti illum molestiae. Accusamus sit rerum nisi.', 42, 2, 5, 23, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(32, 'Suscipit est quisquam dignissimos beatae.', 'rerum-qui-ut-qui', 'Neque nam nobis est voluptate.', 'Asperiores tempora blanditiis voluptatem eaque aliquid quas qui. Quas ut beatae et. Animi et omnis iste sit.', 43, 2, 12, 21, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(33, 'Rem doloremque sint possimus ab sed.', 'iste-et-eveniet-ut-eius-facilis-omnis-quo', 'Maxime rerum consequuntur omnis omnis sit voluptatem.', 'Ducimus dicta illum repudiandae nulla quia. Optio id distinctio eos sequi sit voluptatem aliquid. Aliquid illo non esse mollitia esse occaecati.', 44, 11, 1, 10, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(34, 'Eligendi voluptates ducimus sit earum voluptate ipsa.', 'iusto-ut-itaque-ullam', 'Id omnis eos adipisci sed hic.', 'Aliquam neque dolores nulla quibusdam qui. Rerum ut autem aperiam rem nihil. Id est aut rerum ea asperiores vitae culpa beatae.', 45, 9, 21, 12, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(35, 'Quam omnis iste optio libero consequuntur beatae.', 'molestiae-assumenda-ut-quia-ut-iusto', 'Et qui eos facere.', 'Quisquam rem aut minus earum cum laudantium harum. Veniam voluptas non hic ipsam est est. At quas sunt fugit nulla harum modi. Eum sunt consectetur ducimus labore eaque. Consequatur eaque aut ipsa eveniet.', 46, 2, 5, 9, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(36, 'Ea nulla ut impedit blanditiis quasi.', 'iure-quam-at-aliquam-ratione-autem-mollitia-consequuntur-voluptate', 'Necessitatibus aliquid enim quas iste.', 'Qui sint id et blanditiis. Voluptas cupiditate consequuntur a ut dolores laboriosam officiis.', 47, 1, 21, 13, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(37, 'Nulla minus ipsa ea qui qui adipisci eveniet.', 'ullam-corrupti-magnam-nulla-et-cum', 'Ut quia ut quas aut.', 'Perferendis laudantium ea laborum nobis voluptas. Et dignissimos dolor dolor. Vel libero voluptatem saepe nisi. Aut soluta quis debitis nam.', 48, 6, 19, 23, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(38, 'Aperiam qui minima in omnis.', 'explicabo-recusandae-quam-natus-eum-id-id-in', 'Est eius quasi voluptatum nesciunt ut qui quia.', 'Qui esse libero cumque dolorem. Consequuntur aut aut ut. Illum dolor illo eaque nihil nesciunt qui quia.', 49, 3, 23, 4, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(39, 'Dolore molestias velit earum rerum.', 'aut-blanditiis-enim-doloribus-dolorum-quo-atque-incidunt', 'Omnis expedita delectus non est illo quas cupiditate.', 'Et enim laboriosam sint voluptatem ut sed voluptatem aut. Minus perspiciatis et aut quidem voluptates et. Ipsum recusandae nam neque ex blanditiis. Rem illo repellendus laborum molestiae recusandae atque nesciunt quia.', 50, 8, 9, 14, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(40, 'Occaecati aut est quaerat eum incidunt rerum nostrum.', 'nulla-error-repellat-omnis-quis-consequatur-quo', 'Nulla quod dolorum assumenda eveniet.', 'Quo vel quas eum tempore nam fugit qui tempora. Autem debitis aperiam ipsam in qui.', 51, 11, 9, 18, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(41, 'Qui voluptas consequatur corporis fugit.', 'ipsam-et-iusto-tempora-iure-voluptate-qui-quo', 'Esse perferendis eum corporis deserunt dolor quis soluta occaecati.', 'Qui porro consequuntur delectus nihil exercitationem esse voluptatem eius. In qui maxime similique quibusdam. Rerum explicabo enim aperiam reiciendis ut aut. Autem maxime explicabo nesciunt omnis magni molestiae.', 52, 8, 1, 8, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(42, 'Ratione deserunt optio ullam odit maxime consectetur.', 'qui-dolores-eum-deleniti-dolor-quis', 'Dolores ea enim vel vel quia ex nemo.', 'Alias enim laudantium a deleniti dolor ea. Voluptatibus quis odit et eius.', 53, 3, 1, 8, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(43, 'Et inventore est eum iusto et ipsam amet.', 'repudiandae-aliquam-qui-unde-harum-et-hic', 'Expedita eaque incidunt a nesciunt eaque molestiae.', 'Reiciendis ad quo ut. Sequi nesciunt ipsum harum totam tempora doloribus.', 54, 1, 22, 20, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(44, 'Natus tenetur adipisci voluptatum nihil officiis expedita ut.', 'modi-praesentium-nihil-expedita-suscipit-ad-magnam', 'Quasi ea dolores quam facere reprehenderit aut.', 'Nemo nulla aperiam blanditiis fugit repellat. Asperiores magni expedita porro fuga molestiae. Dolor commodi sint sed sed repellendus voluptas.', 55, 4, 18, 7, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(45, 'Dolores aut vel vel eum accusamus ut molestiae quisquam.', 'molestias-consequatur-rerum-non-maxime-sint-quas-soluta', 'Quod voluptas libero debitis repellendus rerum.', 'Reprehenderit aut dolorem sint eos. Quos adipisci a fugiat voluptates iure voluptas veniam. Voluptatem sint et quis praesentium quia nihil maxime est. Explicabo et doloribus qui neque.', 56, 8, 21, 10, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(46, 'Exercitationem eum et delectus eaque odit odit et.', 'sit-est-ad-est-et-voluptas-asperiores-libero-maiores', 'Incidunt voluptatem maxime voluptatem tempore molestiae est quae.', 'Ut voluptatibus placeat necessitatibus sed ut et. Sit dolor et fugit et. Quia et autem eos quo.', 57, 3, 14, 3, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(47, 'Reiciendis distinctio voluptates molestias nesciunt.', 'velit-consequatur-eveniet-quia', 'Rerum perspiciatis voluptas est.', 'Minus alias maiores iste corporis expedita quaerat error. Ea eum optio quia debitis quo vel occaecati. Voluptatem nesciunt similique amet magnam quaerat error.', 58, 3, 24, 14, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(48, 'Dolor beatae sit dignissimos molestiae.', 'explicabo-doloremque-voluptate-nemo-nihil', 'Neque maiores qui at ut qui aut inventore.', 'Est molestiae et velit quasi adipisci. Natus possimus officiis magni voluptates. Ut rerum alias sapiente distinctio. Doloremque excepturi nihil et ducimus provident dolor ratione.', 59, 5, 8, 18, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(49, 'Eos reprehenderit aspernatur nemo architecto ut tempora fugit molestiae.', 'similique-repellat-et-dolor-quam-facilis', 'Velit nihil harum sint ut.', 'Recusandae vel aut doloribus animi. Iure officiis excepturi debitis repellendus amet. Et et autem eaque esse inventore qui ipsa. Voluptas quas vero quia provident quaerat omnis sit.', 60, 10, 21, 13, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(50, 'Vel dolorum non modi magnam quos doloribus.', 'consectetur-et-facilis-sed-quam-sunt', 'Repellendus a molestiae voluptas et nemo quia.', 'Dolorum similique sint qui omnis adipisci. Ullam natus qui quo vitae perspiciatis. Cumque autem debitis et rerum facilis. Aut alias aliquid sit pariatur magnam et.', 61, 3, 9, 2, 0, 'published', '2023-08-31 04:45:09', '2023-08-31 04:45:09');

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
(1, 1, 10, NULL, NULL),
(2, 1, 1, NULL, NULL),
(3, 1, 5, NULL, NULL),
(4, 2, 6, NULL, NULL),
(5, 2, 2, NULL, NULL),
(6, 2, 5, NULL, NULL),
(7, 3, 8, NULL, NULL),
(8, 3, 9, NULL, NULL),
(9, 4, 5, NULL, NULL),
(10, 4, 7, NULL, NULL),
(11, 5, 7, NULL, NULL),
(12, 5, 4, NULL, NULL),
(13, 5, 8, NULL, NULL),
(14, 6, 2, NULL, NULL),
(15, 6, 10, NULL, NULL),
(16, 7, 5, NULL, NULL),
(17, 7, 1, NULL, NULL),
(18, 8, 1, NULL, NULL),
(19, 8, 2, NULL, NULL),
(20, 8, 3, NULL, NULL),
(21, 9, 6, NULL, NULL),
(22, 9, 5, NULL, NULL),
(23, 10, 2, NULL, NULL),
(24, 10, 7, NULL, NULL),
(25, 10, 1, NULL, NULL),
(26, 11, 6, NULL, NULL),
(27, 11, 4, NULL, NULL),
(28, 12, 8, NULL, NULL),
(29, 12, 3, NULL, NULL),
(30, 12, 10, NULL, NULL),
(31, 13, 4, NULL, NULL),
(32, 13, 3, NULL, NULL),
(33, 13, 1, NULL, NULL),
(34, 14, 6, NULL, NULL),
(35, 14, 4, NULL, NULL),
(36, 14, 10, NULL, NULL),
(37, 15, 2, NULL, NULL),
(38, 15, 8, NULL, NULL),
(39, 16, 5, NULL, NULL),
(40, 16, 3, NULL, NULL),
(41, 16, 1, NULL, NULL),
(42, 17, 7, NULL, NULL),
(43, 17, 1, NULL, NULL),
(44, 17, 8, NULL, NULL),
(45, 18, 1, NULL, NULL),
(46, 18, 3, NULL, NULL),
(47, 19, 10, NULL, NULL),
(48, 19, 9, NULL, NULL),
(49, 19, 7, NULL, NULL),
(50, 20, 8, NULL, NULL),
(51, 20, 1, NULL, NULL),
(52, 20, 4, NULL, NULL),
(53, 21, 7, NULL, NULL),
(54, 21, 5, NULL, NULL),
(55, 21, 1, NULL, NULL),
(56, 22, 8, NULL, NULL),
(57, 22, 2, NULL, NULL),
(58, 22, 6, NULL, NULL),
(59, 23, 3, NULL, NULL),
(60, 23, 1, NULL, NULL),
(61, 23, 5, NULL, NULL),
(62, 24, 3, NULL, NULL),
(63, 24, 2, NULL, NULL),
(64, 25, 1, NULL, NULL),
(65, 25, 3, NULL, NULL),
(66, 26, 5, NULL, NULL),
(67, 26, 10, NULL, NULL),
(68, 27, 2, NULL, NULL),
(69, 27, 5, NULL, NULL),
(70, 28, 3, NULL, NULL),
(71, 28, 7, NULL, NULL),
(72, 29, 9, NULL, NULL),
(73, 29, 1, NULL, NULL),
(74, 29, 6, NULL, NULL),
(75, 30, 3, NULL, NULL),
(76, 31, 6, NULL, NULL),
(77, 31, 10, NULL, NULL),
(78, 31, 5, NULL, NULL),
(79, 32, 8, NULL, NULL),
(80, 32, 10, NULL, NULL),
(81, 32, 2, NULL, NULL),
(82, 33, 10, NULL, NULL),
(83, 33, 7, NULL, NULL),
(84, 33, 3, NULL, NULL),
(85, 34, 9, NULL, NULL),
(86, 34, 10, NULL, NULL),
(87, 34, 4, NULL, NULL),
(88, 35, 4, NULL, NULL),
(89, 35, 7, NULL, NULL),
(90, 35, 3, NULL, NULL),
(91, 36, 10, NULL, NULL),
(92, 36, 2, NULL, NULL),
(93, 36, 8, NULL, NULL),
(94, 37, 3, NULL, NULL),
(95, 37, 5, NULL, NULL),
(96, 37, 10, NULL, NULL),
(97, 38, 5, NULL, NULL),
(98, 38, 7, NULL, NULL),
(99, 39, 2, NULL, NULL),
(100, 39, 9, NULL, NULL),
(101, 39, 4, NULL, NULL),
(102, 40, 2, NULL, NULL),
(103, 40, 6, NULL, NULL),
(104, 41, 9, NULL, NULL),
(105, 41, 4, NULL, NULL),
(106, 41, 3, NULL, NULL),
(107, 42, 10, NULL, NULL),
(108, 42, 3, NULL, NULL),
(109, 42, 5, NULL, NULL),
(110, 43, 3, NULL, NULL),
(111, 43, 1, NULL, NULL),
(112, 43, 8, NULL, NULL),
(113, 44, 7, NULL, NULL),
(114, 44, 2, NULL, NULL),
(115, 45, 9, NULL, NULL),
(116, 45, 1, NULL, NULL),
(117, 46, 3, NULL, NULL),
(118, 46, 2, NULL, NULL),
(119, 46, 7, NULL, NULL),
(120, 47, 6, NULL, NULL),
(121, 47, 2, NULL, NULL),
(122, 47, 8, NULL, NULL),
(123, 48, 9, NULL, NULL),
(124, 48, 8, NULL, NULL),
(125, 48, 7, NULL, NULL),
(126, 49, 3, NULL, NULL),
(127, 49, 4, NULL, NULL),
(128, 49, 10, NULL, NULL),
(129, 50, 8, NULL, NULL),
(130, 50, 7, NULL, NULL);

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
(2, 'admin', '2023-08-31 04:45:09', '2023-08-31 04:45:09');

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
(1, 'Inventore rerum tenetur et quis quia et numquam. Non unde eum sit totam. Nisi ut debitis fugiat quia quis.', 'Nam unde et numquam sed. Delectus enim labore aut temporibus praesentium aut earum. Sunt porro molestias expedita quisquam veritatis porro. Fuga sunt eos sed accusamus iure sed voluptatum. Velit soluta vel quia vero nulla est.', 'setting/about-img-1.jpg', 'setting/about-img-2.jpg', 'Aut eius voluptates a hic maxime. Sed distinctio et vitae ratione. Quod rem quos itaque voluptatem. Occaecati ducimus nihil laboriosam laborum quia officia qui.', 'Delectus quibusdam modi voluptas quia omnis. Sint doloribus suscipit perferendis laborum est perferendis voluptates rerum. Quia quia inventore sint consequatur rerum.', 'Velit magnam expedita ut quas qui. Quo in quia ullam vel qui reprehenderit.', '2023-08-31 04:45:10', '2023-08-31 04:45:10');

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
(1, 'rerum', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(2, 'deserunt', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(3, 'nihil', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(4, 'omnis', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(5, 'optio', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(6, 'velit', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(7, 'necessitatibus', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(8, 'pariatur', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(9, 'et', '2023-08-31 04:45:10', '2023-08-31 04:45:10'),
(10, 'quia', '2023-08-31 04:45:10', '2023-08-31 04:45:10');

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
(1, 'Shawna Jacobs Jr.', 'farrell.citlalli@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'fmdH6KIJFv', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(2, 'Prof. Chandler Fahey PhD', 'hammes.maida@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'C8KCL0Ejnf', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(3, 'Nella Beahan', 'bashirian.stefanie@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'vRDLCo0Jhf', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(4, 'Johathan Barrows', 'jjenkins@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'YnELenLSbK', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(5, 'Dr. Quinten Schumm', 'koelpin.dave@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'GqEoL6u0iF', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(6, 'Allie Bins', 'mlockman@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'x6x5QCwMEc', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(7, 'Omari Swaniawski', 'rodriguez.sadye@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'rWcTcKN8CK', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(8, 'Dr. Elise Morar', 'maryse.marvin@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'lX5DqGVLB4', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(9, 'Elbert Nader', 'eschuppe@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '2bWKoxXxxm', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(10, 'Jaden Orn', 'xgrant@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'g1ZkBPu7RB', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(11, 'Lau', 'laurentiucozma12@gmail.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 2, 'yPMeI5rw78', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(12, 'Amber Waters', 'vjohnston@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'oPp8YY56uF', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(13, 'Brad Kessler', 'citlalli79@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'mNMlD4nLn9', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(14, 'Nathanial Waters', 'obrakus@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'CmYLMTAQJy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(15, 'Arno Bergnaum', 'corwin.janessa@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'IJIGVNPs4y', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(16, 'Nyah Lynch', 'olson.claude@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '7w2pLFybnQ', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(17, 'Pete Gibson', 'alexie.jakubowski@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'RtFRwK13be', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(18, 'Mrs. Ivah Smitham III', 'jaunita.lubowitz@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'yW3J3mBN6v', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(19, 'Lottie Altenwerth', 'lesch.verona@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'DuBUtGTuk7', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(20, 'Ms. Leda Wunsch I', 'uhayes@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'mKL5FibQGi', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(21, 'Dr. Amiya Schamberger', 'bulah.hand@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'AhIXUwOEF5', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(22, 'Santiago Cremin', 'cassie83@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'bpQrRS9ul6', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(23, 'Prof. Brock Streich', 'katlynn.champlin@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '0JA7vkFqVk', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(24, 'Sandrine Dibbert', 'herman.tiffany@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'co9KcvH9Xq', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(25, 'Chelsea Moen', 'brandi.fay@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'EV7ker3dNv', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(26, 'Yolanda Bergnaum', 'mario.funk@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'fDMI3Q2y9f', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(27, 'Prof. Aliza Kuphal III', 'nestor.becker@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'daLwCblKlC', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(28, 'Gisselle Schoen', 'tkeeling@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '2A5aGe6wmG', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(29, 'Ms. Sally Harber IV', 'rocio46@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'RO0lsxW296', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(30, 'Trever Leannon', 'vern.abbott@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'vRfj69SaOF', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(31, 'Titus Hagenes V', 'kris.olga@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'Cf78fPQkze', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(32, 'Amira Bahringer', 'larson.clifton@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'IWqI7uaUwq', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(33, 'Allene Buckridge', 'nlynch@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'dcOoZDuVNj', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(34, 'David Rowe', 'kbrakus@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'C3i3j1WcqJ', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(35, 'Miss Lenore Senger', 'idickens@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '7FncwW5Il3', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(36, 'Melyssa Ratke', 'rath.lexie@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '840LS4OIko', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(37, 'Allison Spinka Sr.', 'padberg.cordia@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'DVtrB4Ggdp', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(38, 'Raina Abbott', 'xweber@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'nNY4wLgNpK', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(39, 'Prof. Maureen Heaney', 'marley.botsford@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'y2WZfdREBy', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(40, 'Letitia Langworth I', 'tbeier@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 't77i5hHnmu', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(41, 'Gracie Nitzsche Jr.', 'mitchell.odessa@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'aWpyX52ezc', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(42, 'Mr. Doris Howell', 'magdalen71@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'EvYEwoBvLJ', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(43, 'Kane Osinski DDS', 'mayert.jackson@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'NdYhOQ34oc', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(44, 'Prof. Roma Swift MD', 'ova.flatley@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'c6rpOD5XUU', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(45, 'Charlotte Trantow Jr.', 'ines.parisian@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'Pmuhiofml1', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(46, 'Shyanne Brown', 'lukas98@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'U1YqX3sSau', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(47, 'Madge Funk', 'oscar.bashirian@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'dFyWMAVgVV', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(48, 'Ms. Reyna Shanahan IV', 'agislason@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'jgZf0CyucM', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(49, 'Kristoffer Turner', 'bnitzsche@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'TCUfvP4Q0t', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(50, 'Leonel Bode', 'rfay@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'L42e34txMv', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(51, 'Kendra Lehner', 'itorphy@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '65XoJgHdSz', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(52, 'Jannie Hermiston', 'vickie13@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'hsCpDeM7LT', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(53, 'Breanna Price', 'jonas.howe@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'ceVIcY9hu2', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(54, 'Prof. Helga Haag', 'kulas.assunta@example.com', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'lQKV7Z7vf5', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(55, 'Jeff Effertz', 'leta.leuschke@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'wPlYh5EJb4', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(56, 'Gertrude Kutch DDS', 'von.precious@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, '8gXo4DJI4Z', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(57, 'Ansel Christiansen', 'oritchie@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'E5jEE5VCSB', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(58, 'Coralie Stracke', 'nschimmel@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'eG55uy5pdj', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(59, 'Chauncey Strosin', 'khermann@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'omNgkGij74', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(60, 'Prof. Lilyan Lebsack', 'lucy.dooley@example.net', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'jN5hUE6x7J', '2023-08-31 04:45:09', '2023-08-31 04:45:09'),
(61, 'Ken Ortiz', 'rkoss@example.org', '2023-08-31 04:45:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 'pymOF40SoS', '2023-08-31 04:45:09', '2023-08-31 04:45:09');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

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
