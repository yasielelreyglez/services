-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2018 a las 22:59:07
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
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`id`, `name`, `title`, `subtitle`, `image`, `created_at`, `updated_at`) VALUES
(1, 'inicio', 'LOSYP', 'AdministraciÃ³n', 'http://localhost/services/resources/img/homepage-banner.jpg', '2018-05-31 07:16:38', '2018-05-31 08:06:03'),
(2, 'pagos', 'PAGOS', NULL, 'http://localhost/services/resources/img/pagos-header.jpg', '2018-05-31 07:18:50', '2018-05-31 07:18:50'),
(3, 'pagos solicitados', 'pagos solicitados', '', 'http://localhost/services/resources/img/pagos-header.jpg', '2018-05-31 08:54:53', '2018-05-31 08:54:53'),
(4, 'Pagos activos', 'Pagos activos', '', 'http://localhost/services/resources/img/pagos-header.jpg', '2018-05-31 08:14:23', '2018-05-31 08:14:23'),
(5, 'Pagos expirados', 'Pagos expirados', '', 'http://localhost/services/resources/img/pagos-header.jpg', '2018-05-31 08:16:33', '2018-05-31 08:16:33'),
(6, 'pagos denegados', 'pagos denegados', '', 'http://localhost/services/resources/img/pagos-header.jpg', '2018-05-31 09:02:49', '2018-05-31 09:02:49'),
(7, 'pagos membresÃ­as', 'pagos membresÃ­as', '', 'http://localhost/services/resources/img/pagos-header.jpg', '2018-05-31 09:03:08', '2018-05-31 09:03:08'),
(8, 'servicios', 'SERVICIOS', '', 'http://localhost/services/resources/img/services-header.jpg', '2018-05-31 07:21:53', '2018-05-31 08:06:09'),
(9, 'SERVICIOS DENUNCIADOS', 'SERVICIOS DENUNCIADOS', '', 'http://localhost/services/resources/img/services-header.jpg', '2018-05-31 09:08:18', '2018-05-31 09:08:18'),
(10, 'CREAR SERVICIOS', 'CREAR SERVICIOS', '', 'http://localhost/services/resources/img/services-header.jpg', '2018-05-31 09:08:58', '2018-05-31 09:08:58'),
(11, 'editar servicio', 'editar servicio', '', 'http://localhost/services/resources/img/services-header.jpg', '2018-05-31 09:20:59', '2018-05-31 09:20:59'),
(12, 'servicio', 'servicio', '', 'http://localhost/services/resources/img/services-header.jpg', '2018-05-31 09:19:40', '2018-05-31 09:19:40'),
(13, 'categorias', 'CATEGORÃAS', NULL, 'http://localhost/services/resources/img/category-header.jpg', '2018-05-31 07:22:29', '2018-05-31 07:22:29'),
(14, 'CREAR CATEGORÃA', 'CREAR CATEGORÃA', '', 'http://localhost/services/resources/img/category-header.jpg', '2018-05-31 09:10:14', '2018-05-31 09:10:14'),
(15, 'subcategorias', 'SUBCATEGORÃAS', NULL, 'http://localhost/services/resources/img/subcategory-header.jpg', '2018-05-31 07:23:01', '2018-05-31 07:23:01'),
(16, 'CREAR SUBCATEGORÃA', 'CREAR SUBCATEGORÃA', '', 'http://localhost/services/resources/img/subcategory-header.jpg', '2018-05-31 09:10:53', '2018-05-31 09:10:53'),
(17, 'ciudades', 'CIUDADES', NULL, 'http://localhost/services/resources/img/cities-header.jpg', '2018-05-31 07:23:36', '2018-05-31 07:23:36'),
(18, 'CREAR CIUDAD', 'CREAR CIUDAD', '', 'http://localhost/services/resources/img/cities-header.jpg', '2018-05-31 09:11:34', '2018-05-31 09:11:34'),
(19, 'USUARIOS', 'USUARIOS', '', 'http://localhost/services/resources/img/user-header.jpg', '2018-05-31 09:12:35', '2018-05-31 09:12:35'),
(21, 'crear usuario', 'crear usuario', '', 'http://localhost/services/resources/img/user-header.jpg', '2018-05-31 09:13:09', '2018-05-31 09:13:09'),
(22, 'pÃ¡ginas', 'pÃ¡ginas', '', 'http://localhost/services/resources/img/profile-company-header.jpg', '2018-05-31 09:14:55', '2018-05-31 09:14:55'),
(23, 'crear pÃ¡gina', 'crear pÃ¡gina', '', 'http://localhost/services/resources/img/profile-company-header.jpg', '2018-05-31 09:15:23', '2018-05-31 09:15:23'),
(24, 'personalizar', 'personalizar', '', 'http://localhost/services/resources/img/blog-image-1.png', '2018-05-31 09:16:03', '2018-05-31 20:57:39'),
(25, 'imÃ¡genes', 'imÃ¡genes', '', 'http://localhost/services/resources/img/blog-image-1.jpg', '2018-05-31 09:17:25', '2018-05-31 09:17:25'),
(26, 'crear banner', 'crear banner', '', 'http://localhost/services/resources/img/blog-image-1.png', '2018-05-31 09:17:46', '2018-05-31 09:17:46'),
(27, 'editar categoria', 'editar categorÃ­a', '', 'http://localhost/services/resources/img/category-header.jpg', '2018-05-31 09:21:58', '2018-05-31 09:24:21'),
(33, 'editar subcategorÃ­a', 'editar subcategorÃ­a', '', 'http://localhost/services/resources/img/subcategory-header.jpg', '2018-05-31 09:24:50', '2018-05-31 09:24:50'),
(34, 'editar ciudad', 'editar ciudad', '', 'http://localhost/services/resources/img/cities-header.jpg', '2018-05-31 09:27:27', '2018-05-31 09:27:27'),
(35, 'editar usuario', 'editar usuario', '', 'http://localhost/services/resources/img/user-header.jpg', '2018-05-31 09:28:09', '2018-05-31 09:28:09'),
(36, 'editar pÃ¡gina', 'editar pÃ¡gina', '', 'http://localhost/services/resources/img/profile-company-header.jpg', '2018-05-31 09:29:05', '2018-05-31 09:29:05'),
(37, 'pÃ¡gina', 'pÃ¡gina', '', 'http://localhost/services/resources/img/profile-company-header.jpg', '2018-05-31 09:47:43', '2018-05-31 09:47:43'),
(38, 'ayuda', 'ayuda', '', 'http://localhost/services/resources/img/banner-mission.jpg', '2018-05-31 11:11:49', '2018-05-31 11:11:49'),
(41, 'administracion', 'ADMINISTRACIÃ“N', '', '/services/resources/img/blog-image-2.png', '2018-05-31 07:27:48', '2018-07-01 23:23:36'),
(42, 'TODOS LOS PAGOS', 'TODOS LOS PAGOS', 'Listadode Pagos', '/services/resources/img/services-header.jpg', '2018-07-01 23:22:42', '2018-07-01 23:25:03');

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
(31, 'Medicina', 'http://localhost/services/resources/image/categories/medicina.png'),
(32, 'catego', 'http://localhost/services/resources/image/categories/logo1.png');

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
(2, 3, 133, 'otro comentario', NULL, '2018-06-22 20:59:21', NULL, NULL),
(3, 3, 133, 'ahora buscate', NULL, '2018-06-22 21:01:00', NULL, NULL),
(4, 9, 129, 'jhgkljihliikolm;l', NULL, '2018-06-30 03:21:25', NULL, NULL),
(5, 9, 129, 'oipokp', NULL, '2018-06-30 03:22:35', NULL, NULL),
(6, 9, 129, 'buscate', NULL, '2018-06-30 03:32:20', NULL, NULL),
(7, 9, 129, 'vvgrr', NULL, '2018-06-30 03:35:12', NULL, NULL),
(8, 9, 129, 'sdsdsd', NULL, '2018-06-30 03:35:33', NULL, NULL),
(9, 9, 129, 'asdf', NULL, '2018-06-30 03:36:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configregion`
--

CREATE TABLE `configregion` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `banner_id` int(11) DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `groupRegion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `configregion`
--

INSERT INTO `configregion` (`id`, `page_id`, `banner_id`, `region`, `groupRegion`, `created_at`, `updated_at`) VALUES
(4, 3, 38, 'globalHelp', 'global', '2018-06-29 03:28:10', '2018-06-29 03:34:30'),
(5, NULL, 38, 'helpBanner', 'global', '2018-06-29 03:31:37', '2018-06-29 03:34:30'),
(6, NULL, 2, 'paymentStarBanner', 'payment', '2018-06-29 03:34:30', '2018-06-29 03:34:30'),
(7, NULL, 3, 'paymentRequestedBanner', 'payment', '2018-06-29 03:34:30', '2018-06-29 03:34:30'),
(8, NULL, 4, 'paymentEnabledBanner', 'payment', '2018-06-29 03:34:30', '2018-06-29 03:34:30'),
(9, NULL, 5, 'paymentExpiredBanner', 'payment', '2018-06-29 03:34:30', '2018-06-29 03:34:30'),
(10, NULL, 6, 'paymentDeniedBanner', 'payment', '2018-06-29 03:34:30', '2018-06-29 03:34:30'),
(11, NULL, 7, 'paymentMembresiaBanner', 'payment', '2018-06-29 03:34:30', '2018-06-29 03:34:30'),
(12, NULL, 7, 'paymentMembresiaAddBanner', 'payment', '2018-06-29 03:34:30', '2018-06-29 03:34:30'),
(13, NULL, 7, 'paymentMembresiaEditBanner', 'payment', '2018-06-29 03:34:30', '2018-06-29 03:34:30'),
(14, NULL, 7, 'paymentHelp', 'payment', '2018-06-29 03:34:30', '2018-06-29 03:34:30');

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
(41, 131, 'resources/services/131/Home.png', 'resources/services/131/thumbs/Home.png'),
(42, 133, 'resources/services/133/avatar.png', 'resources/services/133/thumbs/avatar.png'),
(43, 133, 'resources/services/133/logo1.png', 'resources/services/133/thumbs/logo1.png'),
(44, 133, 'resources/services/133/', 'resources/services/133/thumbs/');

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
  `updated_at` datetime NOT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id`, `author_id`, `destinatario_id`, `mensaje`, `estado`, `created_at`, `updated_at`, `service_id`) VALUES
(21, 9, 9, 'El anuncio otro creado ha sido denunciado', 0, '2018-03-23 19:54:52', '2018-03-23 19:54:52', NULL),
(23, 9, 9, 'El anuncio otro creado ha sido denunciado', 0, '2018-03-23 19:56:50', '2018-03-23 19:56:50', NULL),
(24, 9, 9, 'El anuncio otro creado ha sido denunciado', 0, '2018-03-23 19:56:59', '2018-03-23 19:56:59', NULL),
(25, 18, 18, 'El anuncio dddd ha sido denunciado', 0, '2018-04-19 19:06:17', '2018-04-19 19:06:17', NULL),
(28, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio ddd', 0, '2018-06-22 20:30:38', '2018-06-22 20:30:38', NULL),
(29, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio Prueba local', 0, '2018-06-22 21:01:00', '2018-06-22 21:01:00', 133),
(30, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio adsf', 0, '2018-06-30 03:32:20', '2018-06-30 03:32:20', 129),
(31, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio adsf', 0, '2018-06-30 03:35:12', '2018-06-30 03:35:12', 129),
(32, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio adsf', 0, '2018-06-30 03:35:34', '2018-06-30 03:35:34', 129),
(33, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio adsf', 0, '2018-06-30 03:36:33', '2018-06-30 03:36:33', 129),
(34, 3, 3, 'El pago sobre el anuncio serviciodesde amin ha sido aceptado,', 0, '2018-07-02 00:03:54', '2018-07-02 00:03:54', 124),
(35, 3, 3, 'El pago sobre el anuncio serviciodesde amin ha sido aceptado,Datos correctos', 0, '2018-07-02 00:15:14', '2018-07-02 00:15:14', 124),
(36, 3, 3, 'El pago sobre el anuncio serviciodesde amin ha sido aceptado,buscate', 0, '2018-07-02 00:16:44', '2018-07-02 00:16:44', 124),
(37, 3, 3, 'El pago sobre el anuncio serviciodesde amin ha sido aceptado,DATOS CORRECTOS', 0, '2018-07-02 00:41:59', '2018-07-02 00:41:59', 124),
(38, 3, 3, 'Se realizo un nuevo comentario sobre su anuncio servicio desde web', 0, '2018-07-05 05:57:17', '2018-07-05 05:57:17', 123),
(39, 3, 3, 'El anuncio servicio desde web ha sido denunciado', 0, '2018-07-05 06:15:01', '2018-07-05 06:15:01', 123);

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
(2, 'pagina_1', '<h1>html content</h1>', '2018-05-14 20:55:19', '2018-05-14 20:55:19'),
(3, 'AYUDA', '<H1>AQUI VA EL CONTENIDO DE LA AYUDA</H1>', '2018-06-29 03:25:42', '2018-06-29 03:25:42'),
(4, 'terminos_condiciones', '<h1>TERMINOS Y CONDICIONES</h1>', '2018-07-03 19:19:21', '2018-07-03 19:19:21');

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
  `cvv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`id`, `membership_id`, `service_id`, `type`, `evidence`, `country`, `phone`, `state`, `updated_at`, `created_at`, `payed_at`, `expiration_date`, `nombre`, `numero`, `caducidad`, `cvv`, `reason`) VALUES
(1, 1, 124, 1, 'http://localhost/services/resources/evidences/c2.jpg', NULL, NULL, 0, '2018-05-02 21:20:27', '2018-05-02 21:20:27', '2018-07-02 00:15:14', '2018-08-16 00:15:14', NULL, NULL, NULL, NULL, 'Datos correctos'),
(2, 1, 124, 1, 'http://localhost/services/resources/evidences/ba018c82782744dc4101cb4f7ddceccc.jpg', NULL, NULL, 1, '2018-06-18 17:05:59', '2018-06-18 17:05:59', '2018-07-02 00:41:59', '2018-08-16 00:41:59', NULL, NULL, NULL, NULL, 'DATOS CORRECTOS'),
(3, 1, 135, 1, 'http://localhost/services/resources/evidences/a', NULL, NULL, 0, '2018-07-04 23:42:01', '2018-07-04 23:42:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 135, 1, 'http://localhost/services/resources/evidences/a', NULL, NULL, 0, '2018-07-04 23:49:56', '2018-07-04 23:49:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 135, 2, NULL, NULL, NULL, 0, '2018-07-04 23:50:18', '2018-07-04 23:50:18', NULL, NULL, 'DSDASDASD', NULL, '2018-07', 'DASS', NULL);

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
(37, 'ubicacion', -0.10124742653078, -78.448365970117, 126, '2018-05-10 20:06:47', '2018-05-10 20:06:47'),
(38, 'ubicacion', -0.10124742653078, -78.448365970117, 127, '2018-05-10 20:08:51', '2018-05-10 20:08:51'),
(39, 'ubicacion', -0.10124742653078, -78.448365970117, 128, '2018-05-10 20:15:57', '2018-05-10 20:15:57'),
(40, 'vvvv', -0.016103436043369, -78.322709842188, 129, '2018-05-11 21:56:05', '2018-05-11 21:56:05'),
(50, 'ubicacion prueba en habana', 23.101830501346, -82.335382171271, 132, '2018-05-30 21:46:53', '2018-05-30 21:46:53'),
(53, 'ubicacion local', -0.10536729287992, -78.518403811914, 133, '2018-06-07 18:32:55', '2018-06-07 18:32:55'),
(54, 'buscate', 23.102923530598, -82.344654816832, 134, '2018-06-22 20:30:09', '2018-06-22 20:30:09'),
(55, 'ubicacion web', 0.015802697061893, -78.608606165809, 123, '2018-07-05 05:36:13', '2018-07-05 05:36:13'),
(56, 'nueva', 0.038924893747346, -78.827912649556, 123, '2018-07-05 05:36:13', '2018-07-05 05:36:13'),
(57, 'ubicate', -0.14805364292474, -78.984887883135, 125, '2018-07-05 05:36:31', '2018-07-05 05:36:31');

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
  `enabled` tinyint(1) NOT NULL,
  `whatsapp` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `author_id`, `title`, `subtitle`, `phone`, `address`, `other_phone`, `email`, `url`, `created`, `visits`, `created_at`, `updated_at`, `icon`, `globalrate`, `description`, `professional`, `thumb`, `domicilio`, `visit_at`, `todopais`, `ratereviews`, `enabled`, `whatsapp`) VALUES
(123, 3, 'servicio desde web', 'servicio desde web', '213213', 'servicio desde web', '7777', 'admin@gmail.com', 'http://www.google.com', '2018-04-26 21:32:51', 42, '2018-04-26 21:32:51', '2018-04-26 21:32:51', '/resources/services/color1.jpg', 5, '', 1, '/resources/services/thumbs/color1.jpg', 0, '2018-07-05 06:14:41', 0, 1, 1, NULL),
(124, 3, 'serviciodesde amin', 'serviciodesde amin', '3234234', 'serviciodesde amin', '77777778', 'correo@coje.ahi', 'http://validate.com', '2018-04-27 21:54:01', 5, '2018-04-27 21:54:01', '2018-04-27 21:54:01', '/resources/services/color3.jpg', 0, '', 1, '/resources/services/thumbs/color3.jpg', 0, '2018-05-30 21:25:54', 0, 0, 0, NULL),
(125, 3, 'titulo2', 'slogan', '3401-2309', 'direccionando', '7777', 'yoidel86@gmail.com', 'http://validate.com', '2018-04-30 20:23:19', 3, '2018-04-30 20:23:19', '2018-04-30 20:23:19', '/resources/services/color4.jpg', 0, 'describete', 0, '/resources/services/thumbs/color4.jpg', 0, '2018-07-05 06:05:11', 0, 0, 1, NULL),
(126, 3, 'mi anuncio', 'slogando', '7575757575', 'direccion', '324234', 'admin@gmail.com', 'http://validate.com', '2018-05-10 20:06:47', 6, '2018-05-10 20:06:47', '2018-05-10 20:06:47', '/resources/services/color1.jpg', 0, 'dwerasfd  asdfeasw asdfe', 0, '/resources/services/thumbs/color1.jpg', 0, '2018-07-05 05:50:20', 0, 0, 0, NULL),
(127, 3, 'mi anuncio', 'slogando', '7575757575', 'direccion', '324234', 'admin@gmail.com', 'http://validate.com', '2018-05-10 20:08:51', 0, '2018-05-10 20:08:51', '2018-05-10 20:08:51', '/resources/services/color1.jpg', 0, 'dwerasfd  asdfeasw asdfe', 0, '/resources/services/thumbs/color1.jpg', 0, NULL, 0, 0, 0, NULL),
(128, 3, 'mi anuncio', 'slogando', '7575757575', 'direccion', '324234', 'admin@gmail.com', 'http://validate.com', '2018-05-10 20:15:57', 2, '2018-05-10 20:15:57', '2018-05-10 20:15:57', '/resources/services/color1.jpg', 0, 'dwerasfd  asdfeasw asdfe', 0, '/resources/services/thumbs/color1.jpg', 0, '2018-05-17 17:31:55', 0, 0, 0, NULL),
(129, 3, 'adsf', 'asdf', '34234234', 'sdaf', '344234234', 'asdf@asd', 'http://validate.com', '2018-05-11 21:56:05', 17, '2018-05-11 21:56:05', '2018-05-11 21:56:05', '/resources/services/Logo Nuevo ValCal.png', 5, 'adsfesdfawefsadf', 0, '/resources/services/thumbs/Logo Nuevo ValCal.png', 0, '2018-07-03 17:07:25', 0, 1, 0, NULL),
(131, 3, 'Otra ciudad', 'asdf', '7575757575', 'direccion', '324324', 'asdf@asd', 'http://validate.com', '2018-05-12 22:24:41', 3, '2018-05-12 22:24:41', '2018-05-12 22:24:41', '/resources/services/Home.png', 0, 'dwdwdwddwd', 0, '/resources/services/thumbs/Home.png', 0, '2018-05-30 17:25:00', 0, 0, 0, NULL),
(132, 3, 'buscate', 'servicio creado para probar cercania', '73138060', 'direccion del servicio', '0780', 'correo@electronico.com', 'http://direccion.del.servicio', '2018-05-30 21:46:51', 1, '2018-05-30 21:46:51', '2018-05-30 21:46:51', NULL, 0, 'esta es mi descripcion', 0, NULL, 0, '2018-05-30 21:46:55', 0, 0, 1, NULL),
(133, 3, 'Prueba local', 'slogan', '462738427', 'direccion', '324324', 'asdf@asd', 'http://validate.com', '2018-06-07 16:16:57', 19, '2018-06-07 16:16:57', '2018-06-07 16:16:57', '/resources/services/', 5, 'descripcion que debe funcionar 2', 0, '/resources/services/thumbs/', 0, '2018-07-03 17:06:38', 0, 1, 1, NULL),
(134, 3, 'ddd', 'ddd', '32345234', 'ddd', NULL, NULL, NULL, '2018-06-22 20:30:09', 4, '2018-06-22 20:30:09', '2018-06-22 20:30:09', NULL, 5, 'dddd', 0, NULL, 0, '2018-06-22 20:59:04', 0, 1, 1, NULL),
(135, 9, 'testservice', 'testservice', 'tu telefono', 'midireccion', 'adicional', 'mi@correo.electronico', 'http://tu.url.com', '2018-06-30 01:01:12', 10, '2018-06-30 01:01:12', '2018-06-30 01:01:12', NULL, 0, 'describete', 0, NULL, 0, '2018-06-30 03:17:44', 0, 0, 1, 1),
(136, 3, 'testin whatsapp', 'testin whatsapp', '34234234', 'testin whatsapp', '534532', 'asdf@asd', 'http://validate.com', '2018-07-02 01:33:19', 19, '2018-07-02 01:33:19', '2018-07-02 01:33:19', NULL, 0, 'testin whatsapp', 0, NULL, 0, '2018-07-02 02:42:48', 0, 0, 1, 1),
(137, 3, 'Servicio desde admin2', 'slogan', '4834930', 'direccion', '73139040', 'admin@gmail.com', 'http://validate.com', '2018-07-05 05:31:01', 0, '2018-07-05 05:31:01', '2018-07-05 05:31:01', NULL, 0, 'esto es una descripcion', 0, NULL, 0, NULL, 0, 0, 1, NULL);

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
(131, 2),
(132, 1),
(133, 2),
(133, 3),
(134, 1),
(134, 2),
(134, 3),
(135, 1),
(135, 2),
(135, 3),
(136, 2),
(137, 2);

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
(3, 123, NULL, 5, 1, 'denunciando un servicio', '2018-07-05 06:15:01', 1, 'esto no sirve', '2018-07-05 06:14:41'),
(3, 124, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-30 21:25:54'),
(3, 125, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-06-18 17:01:21'),
(3, 126, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-06-23 05:05:57'),
(3, 128, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-17 17:31:56'),
(3, 129, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-06-07 22:02:56'),
(3, 131, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-30 17:25:00'),
(3, 132, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2018-05-30 21:46:55'),
(3, 133, NULL, 5, NULL, NULL, NULL, 1, 'ahora buscate', '2018-06-23 05:00:51'),
(3, 134, NULL, 5, 1, NULL, NULL, 1, 'comentario al quilo', '2018-06-22 20:59:04'),
(3, 136, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-07-02 02:42:49'),
(9, 123, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-07-05 06:14:30'),
(9, 125, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-07-05 06:05:12'),
(9, 126, 0, NULL, NULL, NULL, NULL, 1, NULL, '2018-07-05 05:50:20'),
(9, 129, NULL, 5, 1, NULL, NULL, 1, 'asdf', '2018-07-03 17:07:26'),
(9, 133, NULL, NULL, 1, NULL, NULL, 0, NULL, '2018-07-03 17:06:39'),
(9, 135, NULL, NULL, 1, NULL, NULL, 1, NULL, '2018-06-30 03:17:44'),
(18, 123, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-06-15 00:10:24'),
(18, 129, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-05-30 21:37:13'),
(18, 134, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2018-06-22 20:57:28');

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
(19, 30, 'Telefonos', 'http://localhost/services/resources/image/subcategories/telefonia_celular.png', 192, '2017-12-12 10:08:47', '0000-00-00 00:00:00', 'http://localhost/services/resources/image/subcategories/thumbs/servicios_medicos1.png'),
(20, 31, 'Hospital', 'http://localhost/services/resources/image/subcategories/servicios_medicos1.png', 96, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'http://localhost/services/resources/image/subcategories/thumbs/servicios_medicos1.png'),
(22, 31, 'SUBCAT EDITADA', 'http://localhost/services/resources/image/subcategories/Home.png', 19, '2018-05-13 00:43:40', '2018-05-13 00:43:40', 'http://localhost/services/resources/image/subcategories/thumbs/marker.png');

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
(124, 20),
(125, 19),
(126, 20),
(127, 20),
(128, 20),
(131, 20),
(132, 20),
(133, 20),
(134, 20),
(135, 19),
(136, 22),
(137, 20),
(137, 22);

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
(124, 126, '0', '08:00 AM', '05:00 PM'),
(125, 127, '0', '08:00 AM', '05:00 PM'),
(126, 128, '0', '08:00 AM', '05:00 PM'),
(127, 129, '1,2,3', '08:00', '16:00'),
(129, 131, '3,4,5', '08:00', '16:00'),
(138, 132, '0,2,4', '10:00', '22:00'),
(139, 134, '0,2,4', '08:00', '17:00'),
(140, 137, '0,2,4', '08:00', '16:00'),
(141, 123, '0,1,2', '08:00 AM', '05:00 PM'),
(142, 123, '1', '08:00', '16:00'),
(143, 125, '5', '08:00', '16:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `role` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forgotten_password_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forgotten_password_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_so` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_facebook` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_on`, `role`, `active`, `last_login`, `ip_address`, `salt`, `remember_code`, `forgotten_password_code`, `forgotten_password_time`, `phone_id`, `phone_so`, `is_facebook`, `name`) VALUES
(3, 'admin@gmail.com2', 'admin@gmail.com', '$2y$08$Zhj9nf1QnnSYAiY6wd6lCus9GlRevFLWjl7DsbA28HDtCfHGa9ZIi', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', 'xQ6JnAXAyedTwBGOlHwQ7.', '', '', '', '', 0, NULL),
(9, 'yoidel86@gmail.com', 'yoidel86@gmail.com', '$2y$08$IPQFruzuVMWK3x59pAccYeWCHvybskVPsZ.WRoj9g4K3GBBO1hV7C', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '127.0.0.1', '', 'JKePh02kZROFio5HydbFLO', 'mLISZGSDZFwXKYDvVr.Ov.28ce882faae2b1e408', '1530715228', '', '', 0, NULL),
(15, 'otro@gmail.com', 'otro@gmail.com', '$2y$08$VC2ypUqB8gnh5Mdv6xgVDecTDiaTa5yJQx7I9PqxutcjIzcm7GAP.', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', '', '', '', '', '', 0, NULL),
(17, 'tbarrosolopez@gmail.com', 'tbarrosolopez@gmail.com', '$2y$08$ZHAk0AE430SGAxBFfDOByO7.vb5CwsFnXHWG1yVfBsm4jYKUECbJS', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', 'YzCiRvN6bS84CjiIPDacxe', '', '', '', '', 0, NULL),
(18, 'administrator@gmail.com', 'administrator@gmail.com', '$2y$08$.8cPAEDQ8Wynys0rAyK7o.GhsDQQvBqKJ2sX7V7TRjRPtPUOn/dNG', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', '', '', '', '', '', 0, NULL),
(19, 'yoidel867@gmail.com', 'yoidel867@gmail.com', '$2y$08$EXGnmbQN1wjsp/Qi6DPeROlglNkIVCP1jTL9Gd/OYUYDBsuV8hm8K', '0000-00-00 00:00:00', 0, 1, '0000-00-00 00:00:00', '::1', '', 'TZCnOIpweSi7hIOvvvEsoe', '', '', 'id de prueba de telefono', '', 0, 'nombretest');

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
(25, 3, 1),
(23, 9, 2),
(21, 15, 1),
(22, 17, 2),
(17, 18, 1),
(24, 19, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `configregion`
--
ALTER TABLE `configregion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_38774FAAC4663E4` (`page_id`),
  ADD KEY `IDX_38774FAA684EC833` (`banner_id`);

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
  ADD KEY `IDX_9B631D01B564FBC1` (`destinatario_id`),
  ADD KEY `IDX_9B631D01ED5CA9E6` (`service_id`);

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
-- AUTO_INCREMENT de la tabla `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `configregion`
--
ALTER TABLE `configregion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `times`
--
ALTER TABLE `times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
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
-- Filtros para la tabla `configregion`
--
ALTER TABLE `configregion`
  ADD CONSTRAINT `FK_38774FAA684EC833` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`),
  ADD CONSTRAINT `FK_38774FAAC4663E4` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`);

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
  ADD CONSTRAINT `FK_9B631D01ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
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
