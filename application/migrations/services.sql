-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2017 a las 14:22:05
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

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
(29, 'Bares', 'http://localhost/services/resources/image/categories/bares.png'),
(30, 'Cafeterias', 'http://localhost/services/resources/image/categories/cafeterias.png'),
(31, 'Eventos', 'http://localhost/services/resources/image/categories/eventos.png'),
(32, 'Fontaneria', 'http://localhost/services/resources/image/categories/fontaneria.png'),
(33, 'Hogar', 'http://localhost/services/resources/image/categories/hogar.png'),
(34, 'MecÃ¡nica', 'http://localhost/services/resources/image/categories/mecanica.png'),
(35, 'Medicina', 'http://localhost/services/resources/image/categories/medicina.png'),
(36, 'TecnologÃ­a', 'http://localhost/services/resources/image/categories/tecnologia.png'),
(37, 'Viajes', 'http://localhost/services/resources/image/categories/viajes.png');

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
(4, 'La HabanÃ³n', '2017-12-13 03:39:24', '2017-12-15 04:40:30'),
(5, 'Pinar del Rio', '2017-12-13 03:39:52', '0000-00-00 00:00:00'),
(6, 'Matanzas', '2017-12-13 03:40:00', '0000-00-00 00:00:00');

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
(1, 3, 1, 'Este servicio es lo mejor que se ha inventado, gracias a el puedo trabajar', NULL, '2017-12-14 20:10:29', 3, NULL),
(2, 6, 2, 'Este servicio a salvado mi telefono de lo insalvable', NULL, '2017-12-15 05:08:32', NULL, NULL);

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
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `service_id`, `title`) VALUES
(1, 1, 'http://localhost/services//resources/services/1/perfil.png'),
(2, 1, 'http://localhost/services//resources/services/1/pendiente.png'),
(3, 2, 'http://localhost/services//resources/services/2/product.jpg'),
(4, 2, 'http://localhost/services//resources/services/2/IMG_20171109_151148.jpg');

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

--
-- Volcado de datos para la tabla `membership`
--

INSERT INTO `membership` (`id`, `title`, `price`, `days`, `created_at`, `updated_at`) VALUES
(1, 'Membresia mensual', 30, 30, '2017-12-15 03:49:08', '2017-12-15 03:49:08');

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
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `payed_at` datetime DEFAULT NULL,
  `state` int(11) NOT NULL,
  `expiration_date` datetime DEFAULT NULL
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
(1, 'mi casa', 23.103102133217, -82.301330566406, 1, '2017-12-14 20:09:29', '2017-12-14 20:09:29'),
(2, 'tu casa', 23.048459643377, -82.33154296875, 1, '2017-12-14 20:09:29', '2017-12-14 20:09:29');

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
  `week_days` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `visits` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `globalrate` double NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `professional` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `author_id`, `title`, `subtitle`, `phone`, `address`, `other_phone`, `email`, `url`, `week_days`, `start_time`, `end_time`, `created`, `visits`, `created_at`, `updated_at`, `icon`, `globalrate`, `description`, `professional`) VALUES
(1, 3, 'Cuidado de niÃ±os', 'menores', '3323456456', 'asdfasdfasdf', '23234234', 'admin@gmail.com', 'http://url', '0,1,2,3,4', '8:00 am', '10:00 pm', '2017-12-14 20:09:29', 7, '2017-12-14 20:09:29', '2017-12-14 20:09:29', 'http://localhost/services/resources/completadas.png', 6.5, 'aqui cuidamos tu niÃ±o', NULL),
(2, 6, 'Taller La virgen ', 'Taller de electronica y telefonia', '438038123', 'Calle mayor e/ calzada y rio,Virgen del camino', '', 'iservice@gmail.com', 'http://iservicecuba.emprende.cu', '0,1,2,3,4', '8:00', '18:00', '2017-12-15 05:06:14', 5, '2017-12-15 05:06:14', '2017-12-15 05:06:14', 'http://localhost/services/resources/product.jpg', 6.5, 'Taller de electronica y telefonia, especializado en tecnologia de Apple, con expecialistas de primer nivel con mas de 5 aÃ±os de experiencia en el campo.', NULL);

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
(1, 4),
(2, 4);

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
  `visited` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `service_user`
--

INSERT INTO `service_user` (`user_id`, `service_id`, `favorite`, `rate`, `contacted`, `complaint`, `complaint_created`, `visited`) VALUES
(3, 1, 1, 4, NULL, NULL, NULL, 1),
(3, 2, NULL, 8, NULL, NULL, NULL, 1),
(6, 1, NULL, 9, NULL, NULL, NULL, 1),
(6, 2, 1, 5, NULL, NULL, NULL, 1);

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
(5, 29, 'Cuidado de niÃ±os', 'http://localhost/services/resources/image/subcategories/completadas.png', 0, '2017-12-13 02:10:43', '2017-12-13 03:08:44'),
(6, 33, 'Electricidad', 'http://localhost/services/resources/image/subcategories/electricidad.png', 5, '2017-12-13 02:11:38', '2017-12-13 03:09:19'),
(7, 33, 'Servicios de limpieza', 'http://localhost/services/resources/image/subcategories/servicios_limpieza.png', 0, '2017-12-13 02:12:08', '2017-12-13 03:09:26'),
(8, 35, 'Servicios medicos', 'http://localhost/services/resources/image/subcategories/servicios_medicos.png', 0, '2017-12-13 02:12:30', '2017-12-13 03:09:36'),
(9, 36, 'Servicios tecnologicos', 'http://localhost/services/resources/image/subcategories/servicios_tecnologicos.png', 12, '2017-12-13 03:36:03', '2017-12-13 03:09:43'),
(10, 35, 'Servicios veterinarios', 'http://localhost/services/resources/image/subcategories/servicios_veterinarios.png', 7, '2017-12-13 03:36:30', '2017-12-13 03:09:51'),
(11, 29, 'TelefonÃ­a celular', 'http://localhost/services/resources/image/subcategories/telefonia_celular.png', 5, '2017-12-13 03:37:42', '2017-12-13 03:09:58'),
(12, 29, 'TransportaciÃ³n', 'http://localhost/services/resources/image/subcategories/transportacion.png', 0, '2017-12-13 03:38:06', '2017-12-13 03:10:04');

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
(1, 9),
(1, 10),
(2, 6),
(2, 9),
(2, 11);

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
(3, 'admin@gmail.com', 'admin@gmail.com', '$2y$08$/JOwPbrPJgJ344FmUMvFye7ZCgyMv9zmL4mRlSAZrZva/z2hqtcWa', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', 'yJGWawfD/OifU.Dj/pgHZO'),
(4, 'yasielelreyglez@gmail.com', 'yasielelreyglez@gmail.com', '$2y$08$FU/czFK9TjggjVmUuql.KeMpwFtYSYQViPBvCVXWGO3N33SGgF4WC', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', '8sxvwziDGm9XNo3pMcDW7u'),
(5, 'davidrm901503@gmail.com', 'davidrm901503@gmail.com', '$2y$08$UkYNx/XfW61nLKL6gAA77OojeifQ0WgVWZ486iyI6jvivjTyKqVl6', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', 'MYVV6u.HYV3J/p4egejz7.'),
(6, 'yoidel@gmail.com', 'yoidel@gmail.com', '$2y$08$SGA3Bapqnr411loEyMzOse9jv0JYnVGW8Oosoz8cQpiWs4GlOEoMq', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', '');

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
(4, 6, 2);

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
  ADD KEY `IDX_7332E169F675F31B` (`author_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
