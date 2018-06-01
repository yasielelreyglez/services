-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2018 a las 16:14:10
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
(23, 123, 'resources/services/123/color1.jpg', 'resources/services/123/thumbs/color1.jpg'),
(24, 123, 'resources/services/123/color5.jpg', 'resources/services/123/thumbs/color5.jpg'),
(26, 124, 'resources/services/124/color3.jpg', 'resources/services/124/thumbs/color3.jpg'),
(27, 124, 'resources/services/124/color4.jpg', 'resources/services/124/thumbs/color4.jpg'),
(28, 124, 'resources/services/124/color5.jpg', 'resources/services/124/thumbs/color5.jpg'),
(29, 125, 'resources/services/125/color4.jpg', 'resources/services/125/thumbs/color4.jpg'),
(30, 126, 'resources/services/126/color1.jpg', 'resources/services/126/thumbs/color1.jpg'),
(31, 126, 'resources/services/126/color5.jpg', 'resources/services/126/thumbs/color5.jpg'),
(32, 126, 'resources/services/126/color4.jpg', 'resources/services/126/thumbs/color4.jpg'),
(33, 127, 'resources/services/127/color1.jpg', 'resources/services/127/thumbs/color1.jpg'),
(34, 127, 'resources/services/127/color5.jpg', 'resources/services/127/thumbs/color5.jpg'),
(35, 127, 'resources/services/127/color4.jpg', 'resources/services/127/thumbs/color4.jpg'),
(36, 128, 'resources/services/128/color1.jpg', 'resources/services/128/thumbs/color1.jpg'),
(37, 128, 'resources/services/128/color5.jpg', 'resources/services/128/thumbs/color5.jpg'),
(38, 128, 'resources/services/128/color4.jpg', 'resources/services/128/thumbs/color4.jpg'),
(39, 129, 'resources/services/129/Logo Nuevo ValCal.png', 'resources/services/129/thumbs/Logo Nuevo ValCal.png'),
(40, 130, 'resources/services/130/Home.png', 'resources/services/130/thumbs/Home.png'),
(41, 131, 'resources/services/131/Home.png', 'resources/services/131/thumbs/Home.png');

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
(1, 'membresia1', 300, 45, '2018-03-19 21:31:22', '2018-03-19 21:31:22');

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

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id`, `author_id`, `destinatario_id`, `mensaje`, `estado`, `created_at`, `updated_at`) VALUES
(3, 3, 3, 'El anuncio Servicio Pro ha sido denunciado', 1, '2018-03-14 20:54:38', '2018-03-14 20:54:38'),
(4, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio 1', 1, '2018-03-16 16:16:34', '2018-03-16 16:16:34'),
(5, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio 1', 1, '2018-03-16 16:22:04', '2018-03-16 16:22:04'),
(6, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio 1', 1, '2018-03-16 16:22:40', '2018-03-16 16:22:40'),
(7, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio 1', 1, '2018-03-16 16:29:55', '2018-03-16 16:29:55'),
(8, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio 1', 1, '2018-03-16 16:57:16', '2018-03-16 16:57:16'),
(9, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio 1', 1, '2018-03-16 17:04:07', '2018-03-16 17:04:07'),
(10, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio 1', 1, '2018-03-16 17:05:02', '2018-03-16 17:05:02'),
(11, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio 1', 1, '2018-03-16 17:05:30', '2018-03-16 17:05:30'),
(12, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio 1', 1, '2018-03-16 17:08:49', '2018-03-16 17:08:49'),
(13, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio Pro', 1, '2018-03-16 17:38:05', '2018-03-16 17:38:05'),
(14, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Servicio Pro', 1, '2018-03-16 17:39:11', '2018-03-16 17:39:11'),
(15, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio ultimo 2', 1, '2018-03-19 20:38:41', '2018-03-19 20:38:41'),
(16, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio mi anuncio', 1, '2018-03-19 20:49:08', '2018-03-19 20:49:08'),
(17, 3, 3, 'El pago sobre el anuncio mi anuncio ha sido aceptado', 1, '2018-03-19 21:33:40', '2018-03-19 21:33:40'),
(18, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio mi anuncio', 1, '2018-03-21 14:08:35', '2018-03-21 14:08:35'),
(19, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio mi anuncio', 1, '2018-03-21 14:09:07', '2018-03-21 14:09:07'),
(20, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio mi anuncio', 1, '2018-03-23 17:53:30', '2018-03-23 17:53:30'),
(21, 9, 9, 'El anuncio otro creado ha sido denunciado', 0, '2018-03-23 19:54:52', '2018-03-23 19:54:52'),
(22, 3, 3, 'El anuncio mi anuncio ha sido denunciado', 1, '2018-03-23 19:56:01', '2018-03-23 19:56:01'),
(23, 9, 9, 'El anuncio otro creado ha sido denunciado', 0, '2018-03-23 19:56:50', '2018-03-23 19:56:50'),
(24, 9, 9, 'El anuncio otro creado ha sido denunciado', 0, '2018-03-23 19:56:59', '2018-03-23 19:56:59'),
(25, 18, 18, 'El anuncio dddd ha sido denunciado', 0, '2018-04-19 19:06:17', '2018-04-19 19:06:17'),
(26, 3, 3, 'El pago sobre el anuncio servicio desde web ha sido aceptado', 0, '2018-04-26 21:37:31', '2018-04-26 21:37:31'),
(27, 3, 3, 'El anuncio servicio desde web ha sido denunciado', 0, '2018-05-15 18:18:06', '2018-05-15 18:18:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pages`
--

INSERT INTO `pages` (`id`, `title`, `Content`, `created_at`, `updated_at`) VALUES
(1, 'pagina_1', '<h1>html content editado</h1>', '2018-05-14 20:51:18', '2018-05-14 20:51:18'),
(2, 'pagina_1', '<h1>html content</h1>', '2018-05-14 20:55:19', '2018-05-14 20:55:19');

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

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`id`, `membership_id`, `service_id`, `type`, `evidence`, `country`, `phone`, `state`, `updated_at`, `created_at`, `payed_at`, `expiration_date`, `nombre`, `numero`, `caducidad`, `cvv`) VALUES
(1, 1, 124, 1, 'http://localhost/services/resources/evidences/c2.jpg', NULL, NULL, 0, '2018-05-02 21:20:27', '2018-05-02 21:20:27', NULL, NULL, NULL, NULL, NULL, NULL);

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
(35, 'ubicacionadmin', -0.030088116445249, -78.443811222979, 124, '2018-04-27 22:24:37', '2018-04-27 22:24:37'),
(36, 'ubicate', -0.14805364292474, -78.984887883135, 125, '2018-04-30 20:23:19', '2018-04-30 20:23:19'),
(37, 'ubicacion', -0.10124742653078, -78.448365970117, 126, '2018-05-10 20:06:47', '2018-05-10 20:06:47'),
(38, 'ubicacion', -0.10124742653078, -78.448365970117, 127, '2018-05-10 20:08:51', '2018-05-10 20:08:51'),
(39, 'ubicacion', -0.10124742653078, -78.448365970117, 128, '2018-05-10 20:15:57', '2018-05-10 20:15:57'),
(40, 'vvvv', -0.016103436043369, -78.322709842188, 129, '2018-05-11 21:56:05', '2018-05-11 21:56:05'),
(41, 'asdf', -0.0037438171120961, -79.049867434961, 130, '2018-05-11 22:06:37', '2018-05-11 22:06:37'),
(48, 'ubicacion web', 0.015802697061893, -78.608606165809, 123, '2018-05-13 00:37:34', '2018-05-13 00:37:34'),
(49, 'nueva', 0.038924893747346, -78.827912649556, 123, '2018-05-13 00:37:34', '2018-05-13 00:37:34'),
(50, 'ubicacion prueba en habana', 23.101830501346, -82.335382171271, 132, '2018-05-30 21:46:53', '2018-05-30 21:46:53');

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
  `imagesList_id` int(11) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `author_id`, `title`, `subtitle`, `phone`, `address`, `other_phone`, `email`, `url`, `created`, `visits`, `created_at`, `updated_at`, `icon`, `globalrate`, `description`, `professional`, `thumb`, `domicilio`, `visit_at`, `todopais`, `ratereviews`, `imagesList_id`, `enabled`) VALUES
(123, 3, 'servicio desde web', 'servicio desde web', '213213', 'servicio desde web', '7777', 'admin@gmail.com', 'http://www.google.com', '2018-04-26 21:32:51', 16, '2018-04-26 21:32:51', '2018-04-26 21:32:51', '/resources/services/color1.jpg', 0, '', 1, '/resources/services/thumbs/color1.jpg', 0, '2018-05-17 17:31:49', 0, 0, NULL, 0),
(124, 3, 'serviciodesde amin', 'serviciodesde amin', '3234234', 'serviciodesde amin', '77777778', 'correo@coje.ahi', 'http://validate.com', '2018-04-27 21:54:01', 5, '2018-04-27 21:54:01', '2018-04-27 21:54:01', '/resources/services/color3.jpg', 0, '', 0, '/resources/services/thumbs/color3.jpg', 0, '2018-05-30 21:25:54', 0, 0, NULL, 0),
(125, 3, 'titulo2', 'slogan', '3401-2309', 'direccionando', '7777', 'yoidel86@gmail.com', 'http://validate.com', '2018-04-30 20:23:19', 0, '2018-04-30 20:23:19', '2018-04-30 20:23:19', '/resources/services/color4.jpg', 0, 'describete', 0, '/resources/services/thumbs/color4.jpg', 0, NULL, 0, 0, NULL, 0),
(126, 3, 'mi anuncio', 'slogando', '7575757575', 'direccion', '324234', 'admin@gmail.com', 'http://validate.com', '2018-05-10 20:06:47', 1, '2018-05-10 20:06:47', '2018-05-10 20:06:47', '/resources/services/color1.jpg', 0, 'dwerasfd  asdfeasw asdfe', 0, '/resources/services/thumbs/color1.jpg', 0, '2018-05-30 21:26:02', 0, 0, NULL, 0),
(127, 3, 'mi anuncio', 'slogando', '7575757575', 'direccion', '324234', 'admin@gmail.com', 'http://validate.com', '2018-05-10 20:08:51', 0, '2018-05-10 20:08:51', '2018-05-10 20:08:51', '/resources/services/color1.jpg', 0, 'dwerasfd  asdfeasw asdfe', 0, '/resources/services/thumbs/color1.jpg', 0, NULL, 0, 0, NULL, 0),
(128, 3, 'mi anuncio', 'slogando', '7575757575', 'direccion', '324234', 'admin@gmail.com', 'http://validate.com', '2018-05-10 20:15:57', 2, '2018-05-10 20:15:57', '2018-05-10 20:15:57', '/resources/services/color1.jpg', 0, 'dwerasfd  asdfeasw asdfe', 0, '/resources/services/thumbs/color1.jpg', 0, '2018-05-17 17:31:55', 0, 0, NULL, 0),
(129, 3, 'adsf', 'asdf', '34234234', 'sdaf', '344234234', 'asdf@asd', 'http://validate.com', '2018-05-11 21:56:05', 5, '2018-05-11 21:56:05', '2018-05-11 21:56:05', '/resources/services/Logo Nuevo ValCal.png', 0, 'adsfesdfawefsadf', 0, '/resources/services/thumbs/Logo Nuevo ValCal.png', 0, '2018-05-30 21:37:13', 0, 0, NULL, 0),
(130, 3, 'crear una sub categoria', 'slogando', '23423', '1', '324324', 'asdf@asd', 'http://validate.com', '2018-05-11 22:06:37', 7, '2018-05-11 22:06:37', '2018-05-11 22:06:37', '/resources/services/Home.png', 0, 'sdfaasfasfd', 0, '/resources/services/thumbs/Home.png', 0, '2018-05-30 21:40:35', 0, 0, NULL, 0),
(131, 3, 'Otra ciudad', 'asdf', '7575757575', 'direccion', '324324', 'asdf@asd', 'http://validate.com', '2018-05-12 22:24:41', 3, '2018-05-12 22:24:41', '2018-05-12 22:24:41', '/resources/services/Home.png', 0, 'dwdwdwddwd', 0, '/resources/services/thumbs/Home.png', 0, '2018-05-30 17:25:00', 0, 0, NULL, 0),
(132, 3, 'buscate', 'servicio creado para probar cercania', '73138060', 'direccion del servicio', '0780', 'correo@electronico.com', 'http://direccion.del.servicio', '2018-05-30 21:46:51', 1, '2018-05-30 21:46:51', '2018-05-30 21:46:51', NULL, 0, 'esta es mi descripcion', 0, NULL, 0, '2018-05-30 21:46:55', 0, 0, NULL, 1);

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
(123, 1),
(124, 2),
(125, 2),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 2),
(131, 2),
(132, 1);

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
(3, 123, NULL, NULL, NULL, 'servicio denunciado por mi', '2018-05-15 18:18:06', 1, NULL, '2018-05-17 17:31:49'),
(3, 124, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-05-30 21:25:54'),
(3, 126, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-05-30 21:26:02'),
(3, 128, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-05-17 17:31:56'),
(3, 129, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-05-30 17:11:16'),
(3, 130, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-05-30 19:22:28'),
(3, 131, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-05-30 17:25:00'),
(3, 132, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-05-30 21:46:55'),
(18, 129, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-05-30 21:37:13'),
(18, 130, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-05-30 21:40:35');

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
  `updated_at` datetime NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `title`, `icon`, `visits`, `created_at`, `updated_at`, `thumb`) VALUES
(18, 30, 'Televisores', 'http://localhost/services/resources/image/subcategories/servicios_tecnologicos.png', 818, '2017-12-12 10:08:24', '0000-00-00 00:00:00', ''),
(19, 30, 'Telefonos', 'http://localhost/services/resources/image/subcategories/telefonia_celular.png', 153, '2017-12-12 10:08:47', '0000-00-00 00:00:00', ''),
(20, 31, 'Hospitales', 'http://localhost/services/resources/image/subcategories/servicios_medicos1.png', 66, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'http://localhost/services/resources/image/subcategories/thumbs/servicios_medicos1.png'),
(21, 30, 'crear una sub categoria ', 'http://localhost/services/resources/image/subcategories/BAN12.jpg', 16, '2018-03-23 22:55:39', '2018-03-23 22:55:39', ''),
(22, 31, 'SUBCAT EDITADA', 'http://localhost/services/resources/image/subcategories/Home.png', 0, '2018-05-13 00:43:40', '2018-05-13 00:43:40', ''),
(23, 31, 'titulo', 'http://localhost/services/resources/image/subcategories/Home1.png', 0, '2018-05-15 15:29:37', '2018-05-15 15:29:37', '');

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
(123, 19),
(123, 21),
(124, 20),
(125, 19),
(126, 20),
(127, 20),
(128, 20),
(129, 18),
(129, 21),
(130, 20),
(131, 20),
(132, 20);

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
(120, 124, '5,6', '08:00', '16:00'),
(121, 124, '0,1', '08:00', '16:00'),
(122, 124, '0', '08:00', '23:00'),
(123, 125, '5', '08:00', '16:00'),
(124, 126, '0', '08:00 AM', '05:00 PM'),
(125, 127, '0', '08:00 AM', '05:00 PM'),
(126, 128, '0', '08:00 AM', '05:00 PM'),
(127, 129, '1,2,3', '08:00', '16:00'),
(128, 130, '1,2,3,4', '08:00', '16:00'),
(129, 131, '3,4,5', '08:00', '16:00'),
(136, 123, '0,1,2', '08:00 AM', '05:00 PM'),
(137, 123, '1', '08:00', '16:00'),
(138, 132, '0,2,4', '10:00', '22:00');

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
  `remember_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forgotten_password_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forgotten_password_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_on`, `role`, `active`, `last_login`, `ip_address`, `salt`, `remember_code`, `forgotten_password_code`, `forgotten_password_time`) VALUES
(3, 'admin@gmail.com', 'admin@gmail.com', '$2y$08$Zhj9nf1QnnSYAiY6wd6lCus9GlRevFLWjl7DsbA28HDtCfHGa9ZIi', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', 'RwgRShaCvxJHegExDS3V8e', '', ''),
(9, 'yoidel86@gmail.com', 'yoidel86@gmail.com', '$2y$08$IPQFruzuVMWK3x59pAccYeWCHvybskVPsZ.WRoj9g4K3GBBO1hV7C', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '127.0.0.1', '', 'YBLZRbp9FJhtchMMqOsVn.', 'R2eTj6JD0jC5ztXDM2JtHe28b21b97ab35c5a244', '1521839895'),
(15, 'otro@gmail.com', 'otro@gmail.com', '$2y$08$VC2ypUqB8gnh5Mdv6xgVDecTDiaTa5yJQx7I9PqxutcjIzcm7GAP.', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', '', '', ''),
(17, 'tbarrosolopez@gmail.com', 'tbarrosolopez@gmail.com', '$2y$08$ZHAk0AE430SGAxBFfDOByO7.vb5CwsFnXHWG1yVfBsm4jYKUECbJS', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', 'YzCiRvN6bS84CjiIPDacxe', '', ''),
(18, 'administrator@gmail.com', 'administrator@gmail.com', '$2y$08$.8cPAEDQ8Wynys0rAyK7o.GhsDQQvBqKJ2sX7V7TRjRPtPUOn/dNG', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', '', '', '');

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
(18, 3, 1),
(23, 9, 2),
(21, 15, 1),
(22, 17, 2),
(17, 18, 1);

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
-- Indices de la tabla `pages`
--
ALTER TABLE `pages`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
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
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `times`
--
ALTER TABLE `times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
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
