-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2017 at 04:14 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `services`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `icon`) VALUES
(1, 'Bares', 'resources/image/categories/bares.png'),
(2, 'Cafeterias', 'resources/image/categories/cafeterias.png'),
(5, 'Eventos', 'resources/image/categories/eventos.png'),
(6, 'Fontaneria', 'resources/image/categories/fontaneria.png'),
(21, 'prueba', 'resources/image/categories/error_store.png'),
(22, 'prueba', 'resources/image/categories/error_store1.png'),
(23, 'prueba', 'resources/image/categories/error_store2.png');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Quito', '2017-11-08 05:11:40', '0000-00-00 00:00:00'),
(2, 'Lima', '2017-11-08 05:13:28', '0000-00-00 00:00:00'),
(3, 'La paz', '2017-11-08 05:13:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `service_id`, `title`) VALUES
(3, NULL, './resources/2/compras.png'),
(4, NULL, './resources/2/amCharts(3).png'),
(5, 2, './resources/2/amCharts(3).png'),
(6, 2, './resources/2/compras.png'),
(7, 2, './resources/2/amCharts(3).png'),
(8, 2, './resources/2/compras.png'),
(9, 2, './resources/2/IMG_20171112_200419.jpg'),
(10, 2, './resources/2/IMG_20171112_200419.jpg'),
(11, 2, './resources/2/amCharts(3).png'),
(12, 17, './resources//perfil.png'),
(13, 17, './resources//pendiente.png'),
(14, 17, './resources//completadas.png'),
(15, 18, './resources//perfil.png'),
(16, 18, './resources//pendiente.png'),
(17, 18, './resources//completadas.png'),
(18, 19, './resources//perfil.png'),
(19, 19, './resources//pendiente.png'),
(20, 19, './resources//completadas.png'),
(21, 20, './resources//perfil.png'),
(22, 20, './resources//pendiente.png'),
(23, 20, './resources//completadas.png'),
(24, 21, './resources//perfil.png'),
(25, 21, './resources//pendiente.png'),
(26, 21, './resources//completadas.png'),
(27, 22, './resources//perfil.png'),
(28, 22, './resources//pendiente.png'),
(29, 22, './resources//completadas.png');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `title`, `latitude`, `longitude`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 'Posicion 1', 23.90876, -74.82123, NULL, '2017-11-08 05:30:14', '0000-00-00 00:00:00'),
(2, 'posicion 1', 23.9593023, -81.30240902, 17, '2017-11-27 23:01:49', '2017-11-27 23:01:49'),
(3, 'otra posicion', 22.989123, -79.38231432, 17, '2017-11-27 23:01:49', '2017-11-27 23:01:49'),
(4, 'posicion 1', 23.9593023, -81.30240902, 18, '2017-11-27 23:05:47', '2017-11-27 23:05:47'),
(5, 'otra posicion', 22.989123, -79.38231432, 18, '2017-11-27 23:05:47', '2017-11-27 23:05:47'),
(6, 'posicion 1', 23.9593023, -81.30240902, 19, '2017-11-27 23:07:01', '2017-11-27 23:07:01'),
(7, 'otra posicion', 22.989123, -79.38231432, 19, '2017-11-27 23:07:01', '2017-11-27 23:07:01'),
(8, 'posicion 1', 23.9593023, -81.30240902, 21, '2017-11-27 23:29:07', '2017-11-27 23:29:07'),
(9, 'otra posicion', 22.989123, -79.38231432, 21, '2017-11-27 23:29:07', '2017-11-27 23:29:07'),
(10, 'posicion 1', 23.9593023, -81.30240902, 22, '2017-11-27 23:32:32', '2017-11-27 23:32:32'),
(11, 'otra posicion', 22.989123, -79.38231432, 22, '2017-11-27 23:32:32', '2017-11-27 23:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `week_days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `visits` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `globalrate` double NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `author_id`, `title`, `subtitle`, `phone`, `address`, `other_phone`, `email`, `url`, `week_days`, `start_time`, `end_time`, `created`, `visits`, `created_at`, `updated_at`, `icon`, `globalrate`, `description`) VALUES
(1, 3, 'Servicio1', 'subtitulo servicio1', '231450', 'calle stret entre left and right numero #', '989796', 'correo@gmail.com', 'http://url.com', '1,3,5', '08:00', '15:30', '0000-00-00 00:00:00', 26, '2017-11-08 06:16:24', '2017-11-08 06:04:10', 'resources/image/service/product.jpg', 0, NULL),
(2, 3, 'dd', 'subtitulo servicio1', '12345', 'calle stret entre left and right numero #', '32432', 'email@server.com', 'http://url.com', '1,2', '08:00', '15:30', '2017-11-14 14:51:50', 16, '2017-11-14 14:51:50', '2017-11-14 14:51:50', 'resources/image/service/product.jpg', 0, NULL),
(3, 3, 'primero', 'segundo', '45362718', 'direccion', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 18:21:06', 0, '2017-11-17 18:21:06', '2017-11-17 18:21:06', NULL, 0, NULL),
(4, 3, 'primero1', 'segundo1', '45362718', 'direccion1', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 18:39:19', 6, '2017-11-17 18:39:19', '2017-11-17 18:39:19', NULL, 0, NULL),
(5, 3, 'primer paso', '22', '3234123', 'direcc', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 18:46:30', 0, '2017-11-17 18:46:30', '2017-11-17 18:46:30', NULL, 0, NULL),
(6, 3, 'primer paso', '22', 'validado2', 'direcc', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 18:47:06', 0, '2017-11-17 18:47:06', '2017-11-17 18:47:06', NULL, 0, NULL),
(7, 3, 'otro mas', 'd', 'dfds', 'direccion1', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 18:55:36', 1, '2017-11-17 18:55:36', '2017-11-17 18:55:36', NULL, 0, NULL),
(8, 3, 'www', 'www', 'www2', 'www', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 19:59:22', 0, '2017-11-17 19:59:22', '2017-11-17 19:59:22', NULL, 0, NULL),
(9, 3, 'qw', 'qw', 'qw', 'qw', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 20:01:18', 1, '2017-11-17 20:01:18', '2017-11-17 20:01:18', NULL, 0, NULL),
(10, 3, '12', '21', '123', '321', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 20:10:27', 0, '2017-11-17 20:10:27', '2017-11-17 20:10:27', NULL, 0, NULL),
(11, 3, 'qwqw', 'qwqw', 'qwqw', 'qwqw', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 20:18:46', 2, '2017-11-17 20:18:46', '2017-11-17 20:18:46', NULL, 0, NULL),
(12, 3, 'sss', 'sss', 'sss', 'ssss', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 20:46:43', 0, '2017-11-17 20:46:43', '2017-11-17 20:46:43', NULL, 0, NULL),
(13, 3, '1', '4', '3', '2', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 20:59:05', 1, '2017-11-17 20:59:05', '2017-11-17 20:59:05', NULL, 0, NULL),
(14, 3, '1', '4', '3', '2', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 21:07:56', 0, '2017-11-17 21:07:56', '2017-11-17 21:07:56', 'resources/image/service/product.jpg', 0, NULL),
(15, 3, 'fda', 'asd', 'asdf', 'fdsa', NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-17 21:29:26', 3, '2017-11-17 21:29:26', '2017-11-17 21:29:26', 'resources/image/service/product.jpg', 0, NULL),
(17, 3, 'Completo', 'subtitulo de un servicio mostrado completo', '4233432234', 'esta es una direccion', '38210239', 'estonosirve', 'url:/ cualquierar', 'Array', '11:00', '10:00', '2017-11-27 23:01:49', 0, '2017-11-27 23:01:49', '2017-11-27 23:01:49', NULL, 0, NULL),
(18, 3, 'Completo', 'subtitulo de un servicio mostrado completo', '4233432234', 'esta es una direccion', '38210239', 'estonosirve', 'url:/ cualquierar', 'Array', '11:00', '10:00', '2017-11-27 23:05:47', 0, '2017-11-27 23:05:47', '2017-11-27 23:05:47', NULL, 0, NULL),
(19, 3, 'Completo', 'subtitulo de un servicio mostrado completo', '4233432234', 'esta es una direccion', '38210239', 'estonosirve', 'url:/ cualquierar', 'Array', '11:00', '10:00', '2017-11-27 23:07:01', 0, '2017-11-27 23:07:01', '2017-11-27 23:07:01', NULL, 0, NULL),
(20, 3, 'Completo', 'subtitulo de un servicio mostrado completo', '4233432234', 'esta es una direccion', '38210239', 'estonosirve', 'url:/ cualquierar', 'Array', '11:00', '10:00', '2017-11-27 23:16:06', 0, '2017-11-27 23:16:06', '2017-11-27 23:16:06', NULL, 0, NULL),
(21, 3, 'Completo', 'subtitulo de un servicio mostrado completo', '4233432234', 'esta es una direccion', '38210239', 'estonosirve', 'url:/ cualquierar', ',,,1,1,1,', '11:00', '10:00', '2017-11-27 23:29:07', 0, '2017-11-27 23:29:07', '2017-11-27 23:29:07', NULL, 0, NULL),
(22, 3, 'Completo', 'subtitulo de un servicio mostrado completo', '4233432234', 'esta es una direccion', '38210239', 'estonosirve', 'url:/ cualquierar', '456', '11:00', '10:00', '2017-11-27 23:32:32', 0, '2017-11-27 23:32:32', '2017-11-27 23:32:32', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_city`
--

CREATE TABLE `service_city` (
  `service_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_city`
--

INSERT INTO `service_city` (`service_id`, `city_id`) VALUES
(1, 2),
(1, 3),
(4, 1),
(4, 2),
(5, 3),
(6, 3),
(7, 1),
(7, 2),
(8, 2),
(9, 2),
(9, 3),
(10, 2),
(11, 2),
(12, 1),
(13, 2),
(14, 2),
(15, 2),
(15, 3);

-- --------------------------------------------------------

--
-- Table structure for table `service_user`
--

CREATE TABLE `service_user` (
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `favorite` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `contacted` int(11) DEFAULT NULL,
  `complaint` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complaint_created` datetime DEFAULT NULL,
  `visited` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_user`
--

INSERT INTO `service_user` (`user_id`, `service_id`, `favorite`, `rate`, `contacted`, `complaint`, `complaint_created`, `visited`) VALUES
(3, 1, 1, 9, 1, 'prueba de una queja', '2017-11-10 04:15:16', 1),
(3, 2, 0, 6, 0, 'prueba de una queja', '2017-11-10 04:15:16', 1),
(3, 3, 0, NULL, NULL, NULL, NULL, NULL),
(3, 4, 0, NULL, NULL, NULL, NULL, NULL),
(3, 11, 1, NULL, NULL, NULL, NULL, NULL),
(3, 13, 0, NULL, NULL, NULL, NULL, NULL),
(3, 14, 0, NULL, NULL, NULL, NULL, NULL),
(3, 15, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `title`, `icon`, `visits`) VALUES
(1, 1, 'Subcategoria mas visitadas', 'resources/mage/subcategories/servicios_medicos.png', 45),
(2, 2, 'subtitle3', 'resources/mage/subcategories/servicios_tecnologicos.png', 14),
(3, 2, 'subcategoria menos visitada', 'resources/image/subcategories/telefonia_celular.png', 33),
(4, 2, 'Super subcategory mas votadas', 'resources/image/subcategories/transportacion.png', 51);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory_service`
--

CREATE TABLE `subcategory_service` (
  `service_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subcategory_service`
--

INSERT INTO `subcategory_service` (`service_id`, `subcategory_id`) VALUES
(1, 1),
(1, 3),
(3, 2),
(3, 4),
(4, 1),
(4, 3),
(4, 4),
(5, 3),
(6, 3),
(7, 2),
(7, 4),
(8, 2),
(9, 3),
(9, 4),
(10, 2),
(11, 1),
(12, 2),
(13, 1),
(14, 1),
(15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL,
  `role` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_on`, `role`, `active`, `last_login`, `ip_address`, `salt`, `remember_code`) VALUES
(3, 'admin@gmail.com', 'admin@gmail.com', '$2y$08$/JOwPbrPJgJ344FmUMvFye7ZCgyMv9zmL4mRlSAZrZva/z2hqtcWa', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', '6WXw7lGt5/wLLvD/Z6.7ce');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5F9E962AA76ED395` (`user_id`),
  ADD KEY `IDX_5F9E962AED5CA9E6` (`service_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E01FBE6AED5CA9E6` (`service_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D69FE57CED5CA9E6` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7332E169F675F31B` (`author_id`);

--
-- Indexes for table `service_city`
--
ALTER TABLE `service_city`
  ADD PRIMARY KEY (`service_id`,`city_id`),
  ADD KEY `IDX_E318B6D8ED5CA9E6` (`service_id`),
  ADD KEY `IDX_E318B6D88BAC62AF` (`city_id`);

--
-- Indexes for table `service_user`
--
ALTER TABLE `service_user`
  ADD PRIMARY KEY (`user_id`,`service_id`),
  ADD KEY `IDX_43D062A5A76ED395` (`user_id`),
  ADD KEY `IDX_43D062A5ED5CA9E6` (`service_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6562A1CB12469DE2` (`category_id`);

--
-- Indexes for table `subcategory_service`
--
ALTER TABLE `subcategory_service`
  ADD PRIMARY KEY (`service_id`,`subcategory_id`),
  ADD KEY `IDX_41254D6FED5CA9E6` (`service_id`),
  ADD KEY `IDX_41254D6F5DC6FE57` (`subcategory_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_5F9E962AED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_E01FBE6AED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `FK_D69FE57CED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_7332E169F675F31B` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `service_city`
--
ALTER TABLE `service_city`
  ADD CONSTRAINT `FK_E318B6D88BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E318B6D8ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_user`
--
ALTER TABLE `service_user`
  ADD CONSTRAINT `FK_43D062A5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_43D062A5ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `FK_6562A1CB12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `subcategory_service`
--
ALTER TABLE `subcategory_service`
  ADD CONSTRAINT `FK_41254D6F5DC6FE57` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_41254D6FED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
