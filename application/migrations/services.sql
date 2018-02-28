-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2018 a las 23:18:11
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `services`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `title`, `icon`) VALUES
(30, 'Tecnologia', 'http://localhost/services/resources/image/categories/tecnologia.png'),
(31, 'Medicina', 'http://localhost/services/resources/image/categories/medicina.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Quito', '2017-11-08 05:11:40', '0000-00-00 00:00:00'),
(2, 'Lima', '2017-11-08 05:13:28', '0000-00-00 00:00:00'),
(3, 'La paz', '2017-11-08 05:13:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `reportuser_id` int(11) DEFAULT NULL,
  `hided` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `service_id`, `comment`, `parent`, `created`, `reportuser_id`, `hided`) VALUES
(2, 3, 92, 'mi comentario', NULL, '2018-02-28 22:58:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `facturacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `service_id`, `title`, `thumb`) VALUES
(10, 90, 'http://localhost/services//resources/services/90/imageData', 'http://localhost/services//resources/services/90/thumbs/imageData'),
(11, 90, 'http://localhost/services//resources/services/90/imageData', 'http://localhost/services//resources/services/90/thumbs/imageData'),
(12, 90, 'http://localhost/services//resources/services/90/imageData', 'http://localhost/services//resources/services/90/thumbs/imageData'),
(13, 91, 'http://localhost/services//resources/services/91/imageData', 'http://localhost/services//resources/services/91/thumbs/imageData'),
(15, 92, 'http://localhost/services//resources/services/92/Servicio 3', 'http://localhost/services//resources/services/92/thumbs/Servicio 3'),
(16, 92, 'http://localhost/services//resources/services/92/Servicio 3', 'http://localhost/services//resources/services/92/thumbs/Servicio 3'),
(17, 91, 'http://localhost/services//resources/services/91/Servicio Pro', 'http://localhost/services//resources/services/91/thumbs/Servicio Pro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `days` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `destinatario_id` int(11) DEFAULT NULL,
  `mensaje` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `membership_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `evidence` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `payed_at` datetime DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caducidad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cvv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions`
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
-- Volcado de datos para la tabla `positions`
--

INSERT INTO `positions` (`id`, `title`, `latitude`, `longitude`, `service_id`, `created_at`, `updated_at`) VALUES
(22, 'position 22', 23.068498545114, -82.408364106445, 91, '2018-02-28 23:09:02', '2018-02-28 23:09:02'),
(23, 'position 33', 23.100081801606, -82.292321015625, 91, '2018-02-28 23:09:02', '2018-02-28 23:09:02'),
(28, 'position 1', 23.064708055805, -82.404244233398, 90, '2018-02-28 23:15:36', '2018-02-28 23:15:36'),
(29, 'position 2', 23.103871293637, -82.266228486328, 90, '2018-02-28 23:15:36', '2018-02-28 23:15:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
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
  `created` datetime NOT NULL,
  `visits` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `globalrate` double NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `professional` int(11) DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domicilio` int(11) NOT NULL,
  `visit_at` datetime DEFAULT NULL,
  `todopais` int(11) NOT NULL,
  `ratereviews` double NOT NULL,
  `imagesList_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `author_id`, `title`, `subtitle`, `phone`, `address`, `other_phone`, `email`, `url`, `created`, `visits`, `created_at`, `updated_at`, `icon`, `globalrate`, `description`, `professional`, `thumb`, `domicilio`, `visit_at`, `todopais`, `ratereviews`, `imagesList_id`) VALUES
(90, 3, 'Servicio 1', 'Slogan ', '14785236', 'Direccion ', '123456', 'ejemplo@correo.com', 'google.com', '2018-02-28 22:35:00', 18, '2018-02-28 22:35:00', '2018-02-28 22:35:00', 'http://localhost/services/resources/services/imageData', 0, NULL, 0, 'http://localhost/services//resources/services/thumbs/imageData', 0, '2018-02-28 23:15:40', 0, 0, NULL),
(91, 3, 'Servicio Pro', 'Pro servicio ', '999999', 'Address', '252525', 'otro@email.com', 'google.com', '2018-02-28 22:37:49', 13, '2018-02-28 22:37:49', '2018-02-28 22:37:49', 'http://localhost/services/resources/services/Servicio Pro', 0, NULL, 1, 'http://localhost/services//resources/services/thumbs/Servicio Pro', 0, '2018-02-28 23:14:46', 0, 0, NULL),
(92, 3, 'Servicio 3', 'Slogan 3', '7777777', 'Dir 3', '258147', 'otro@esk.com', 'pop.nauta.cu', '2018-02-28 22:55:47', 7, '2018-02-28 22:55:47', '2018-02-28 22:55:47', 'http://localhost/services/resources/services/Servicio 3', 3, NULL, 1, 'http://localhost/services//resources/services/thumbs/Servicio 3', 0, '2018-02-28 23:14:51', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_city`
--

CREATE TABLE `service_city` (
  `service_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `service_city`
--

INSERT INTO `service_city` (`service_id`, `city_id`) VALUES
(90, 1),
(91, 2),
(92, 1),
(92, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_user`
--

CREATE TABLE `service_user` (
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `favorite` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `contacted` int(11) DEFAULT NULL,
  `complaint` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complaint_created` datetime DEFAULT NULL,
  `visited` int(11) DEFAULT NULL,
  `ratecomment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visited_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `service_user`
--

INSERT INTO `service_user` (`user_id`, `service_id`, `favorite`, `rate`, `contacted`, `complaint`, `complaint_created`, `visited`, `ratecomment`, `visited_at`) VALUES
(3, 90, 1, NULL, NULL, NULL, NULL, 1, NULL, '2018-02-28 23:15:40'),
(3, 91, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-02-28 23:14:46'),
(3, 92, 1, 3, NULL, NULL, NULL, 1, 'mi comentario', '2018-02-28 23:14:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visits` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `title`, `icon`, `visits`, `created_at`, `updated_at`) VALUES
(18, 30, 'Televisores', 'http://localhost/services/resources/image/subcategories/servicios_tecnologicos.png', 735, '2017-12-12 10:08:24', '0000-00-00 00:00:00'),
(19, 30, 'Telefonos', 'http://localhost/services/resources/image/subcategories/telefonia_celular.png', 121, '2017-12-12 10:08:47', '0000-00-00 00:00:00'),
(20, 31, 'Hospitales', 'http://localhost/services/resources/image/subcategories/servicios_medicos.png', 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategory_service`
--

CREATE TABLE `subcategory_service` (
  `service_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subcategory_service`
--

INSERT INTO `subcategory_service` (`service_id`, `subcategory_id`) VALUES
(90, 18),
(91, 18),
(91, 19),
(92, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `times`
--

CREATE TABLE `times` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `week_days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `times`
--

INSERT INTO `times` (`id`, `service_id`, `week_days`, `start_time`, `end_time`) VALUES
(52, 92, '0', '04:55', '21:55'),
(53, 92, '1', '17:55', '21:57'),
(54, 92, '2,3,4', '05:55', '21:55'),
(56, 90, '0,1', '22:15', '12:15'),
(57, 90, '3', '15:15', '22:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_on`, `role`, `active`, `last_login`, `ip_address`, `salt`, `remember_code`) VALUES
(3, 'admin@gmail.com', 'admin@gmail.com', '$2y$08$/JOwPbrPJgJ344FmUMvFye7ZCgyMv9zmL4mRlSAZrZva/z2hqtcWa', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', 'ERbf8fTv.b81qK6Sg4cBrO'),
(4, 'a@a.a', 'a@a.a', '$2y$08$flu/kroGf6/Q9FiumJQ/yeet7hjozcuZ3z12sNsHiFzks6yoa5zb6', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '192.168.137.1', '', 'v2QiD9otkeROJnopJMHDie'),
(5, 'b@b.b', 'b@b.b', '$2y$08$HkgWdg81cSgld5GW5wNQretKV23D751u5jBpgBhfZubeYd0x17NVq', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '192.168.137.1', '', ''),
(6, 'aasd@d.d', 'aasd@d.d', '$2y$08$WwWqDjhIzsKBQRlobgyrq.z28UZsLjvGZAlZN3mgwC0Ye2wCK5Tge', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '192.168.137.1', '', ''),
(7, 'zxc@asd.a', 'zxc@asd.a', '$2y$08$OX76Us9B1tAwrIGyK1DR7.mkvNU5KGDFuasyV9eNghrG22l1aZTeW', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '192.168.1.194', '', ''),
(8, 'yoidel87@gmail.com', 'yoidel87@gmail.com', '$2y$08$2mW/Ugj5HIscvP4.V9huVeysGKDUABbIVVE71g317mqQG0QpxpP0O', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '192.168.1.74', '', ''),
(9, 'yoidel86@gmail.com', 'yoidel86@gmail.com', '$2y$08$IPQFruzuVMWK3x59pAccYeWCHvybskVPsZ.WRoj9g4K3GBBO1hV7C', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '192.168.1.74', '', ''),
(10, 'asd@asd.ad', 'asd@asd.ad', '$2y$08$6zPET6Q8Of3WcTpS4zOikOyu.5Wb7No0nt6Pqh8Q5w5fYCtZA5vHG', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', ''),
(11, 'asd@ads.asd', 'asd@ads.asd', '$2y$08$Q0XbHZD00GpgOnUUKmgbQugInsFxPKK8LuLvpPQtjUiUkDzicJf0y', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', ''),
(12, 'yrmtnez@nauta.cu', 'yrmtnez@nauta.cu', '$2y$08$F5GKkkbU63PCXzcBDFMv3e6caqZobGsf7k37nofnYNLUekW6QMWpy', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '192.168.137.160', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 3, 2),
(2, 4, 2),
(3, 5, 2),
(4, 6, 2),
(5, 7, 2),
(7, 8, 2),
(8, 9, 2),
(9, 10, 2),
(10, 11, 2),
(11, 12, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5F9E962AA76ED395` (`user_id`),
  ADD KEY `IDX_5F9E962AED5CA9E6` (`service_id`),
  ADD KEY `IDX_5F9E962A77AEE189` (`reportuser_id`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E01FBE6AED5CA9E6` (`service_id`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9B631D01F675F31B` (`author_id`),
  ADD KEY `IDX_9B631D01B564FBC1` (`destinatario_id`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_65D29B321FB354CD` (`membership_id`),
  ADD KEY `IDX_65D29B32ED5CA9E6` (`service_id`);

--
-- Indices de la tabla `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D69FE57CED5CA9E6` (`service_id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7332E169F675F31B` (`author_id`),
  ADD KEY `IDX_7332E169C9DA0FD2` (`imagesList_id`);

--
-- Indices de la tabla `service_city`
--
ALTER TABLE `service_city`
  ADD PRIMARY KEY (`service_id`,`city_id`),
  ADD KEY `IDX_E318B6D8ED5CA9E6` (`service_id`),
  ADD KEY `IDX_E318B6D88BAC62AF` (`city_id`);

--
-- Indices de la tabla `service_user`
--
ALTER TABLE `service_user`
  ADD PRIMARY KEY (`user_id`,`service_id`),
  ADD KEY `IDX_43D062A5A76ED395` (`user_id`),
  ADD KEY `IDX_43D062A5ED5CA9E6` (`service_id`);

--
-- Indices de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6562A1CB12469DE2` (`category_id`);

--
-- Indices de la tabla `subcategory_service`
--
ALTER TABLE `subcategory_service`
  ADD PRIMARY KEY (`service_id`,`subcategory_id`),
  ADD KEY `IDX_41254D6FED5CA9E6` (`service_id`),
  ADD KEY `IDX_41254D6F5DC6FE57` (`subcategory_id`);

--
-- Indices de la tabla `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1DD7EE8CED5CA9E6` (`service_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `times`
--
ALTER TABLE `times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962A77AEE189` FOREIGN KEY (`reportuser_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_5F9E962AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_5F9E962AED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_E01FBE6AED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `FK_9B631D01B564FBC1` FOREIGN KEY (`destinatario_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_9B631D01F675F31B` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `FK_65D29B321FB354CD` FOREIGN KEY (`membership_id`) REFERENCES `membership` (`id`),
  ADD CONSTRAINT `FK_65D29B32ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Filtros para la tabla `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `FK_D69FE57CED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Filtros para la tabla `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_7332E169C9DA0FD2` FOREIGN KEY (`imagesList_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_7332E169F675F31B` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `service_city`
--
ALTER TABLE `service_city`
  ADD CONSTRAINT `FK_E318B6D88BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E318B6D8ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `service_user`
--
ALTER TABLE `service_user`
  ADD CONSTRAINT `FK_43D062A5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_43D062A5ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Filtros para la tabla `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `FK_6562A1CB12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `subcategory_service`
--
ALTER TABLE `subcategory_service`
  ADD CONSTRAINT `FK_41254D6F5DC6FE57` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_41254D6FED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `times`
--
ALTER TABLE `times`
  ADD CONSTRAINT `FK_1DD7EE8CED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
