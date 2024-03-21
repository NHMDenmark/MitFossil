-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-07-2023 a las 13:12:50
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mitfossil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ages`
--

DROP TABLE IF EXISTS `ages`;
CREATE TABLE IF NOT EXISTS `ages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `epoch_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ages_epoch_id_foreign` (`epoch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `ages`
--

INSERT INTO `ages` (`id`, `epoch_id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Meghalayan', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(2, 1, 'Northgrippian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(3, 1, 'Upper', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(4, 2, 'Upper', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(5, 2, 'Chibanian ', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(6, 2, 'Calabrian ', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(7, 2, 'Gelasian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(8, 3, 'Piacenzian ', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(9, 3, 'Zanclean', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(10, 4, 'Messinian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(11, 4, 'Tortonian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(12, 4, 'Serravallian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(13, 4, 'Langhian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(14, 4, 'Burdigalian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(15, 4, 'Aquitanian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(16, 5, 'Chattian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(17, 5, 'Rupelian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(18, 6, 'Priabonian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(19, 6, 'Bartonian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(20, 6, 'Lutetian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(21, 6, 'Ypresian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(22, 7, 'Thanetian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(23, 7, 'Selandian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(24, 7, 'Danian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(25, 8, 'Maastrichtian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(26, 8, 'Campanian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(27, 8, 'Santonian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(28, 8, 'Coniacian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(29, 8, 'Turonian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(30, 8, 'Cenomanian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(31, 9, 'Albian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(32, 9, 'Aptian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(33, 9, 'Barremian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(34, 9, 'Hauterivian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(35, 9, 'Valanginian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(36, 9, 'Berriasian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(37, 10, 'Tithonian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(38, 10, 'Kimmeridgian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(39, 10, 'Oxfordian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(40, 11, 'Callovian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(41, 11, 'Bathonian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(42, 11, 'Bajocian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(43, 11, 'Aalenian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(44, 12, 'Toarcian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(45, 12, 'Pliensbachian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(46, 12, 'Sinemurian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(47, 12, 'Hettangian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(48, 13, 'Rhaetian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(49, 13, 'Norian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(50, 13, 'Carnian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(51, 14, 'Ladinian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(52, 14, 'Anisian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(53, 15, 'Olenekian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(54, 15, 'Induan', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(55, 16, 'Changhsingian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(56, 16, 'Wuchiapingian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(57, 17, 'Capitanian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(58, 17, 'Wordian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(59, 17, 'Roadian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(60, 18, 'Kungurian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(61, 18, 'Artinskian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(62, 18, 'Sakmarian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(63, 18, 'Asselian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(64, 19, 'Gzhelian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(65, 19, 'Kasimovian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(66, 20, 'Moscovian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(67, 21, 'Bashkirian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(68, 22, 'Serpukhovian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(69, 23, 'Visean', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(70, 24, 'Tournaisian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(71, 25, 'Famennian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(72, 25, 'Frasnian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(73, 26, 'Givetian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(74, 26, 'Eifelian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(75, 27, 'Emsian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(76, 27, 'Pragian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(77, 27, 'Lochkovian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(78, 29, 'Ludfordian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(79, 29, 'Gorstian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(80, 30, 'Homerian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(81, 30, 'Sheinwoodian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(82, 31, 'Telychian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(83, 31, 'Aeronian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(84, 31, 'Rhuddanian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(85, 32, 'Hirnantian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(86, 32, 'Katian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(87, 32, 'Sandbian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(88, 33, 'Darriwilian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(89, 33, 'Dapingian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(90, 34, 'Floian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(91, 34, 'Tremadocian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(92, 35, 'Stage 10', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(93, 35, 'Jiangshanian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(94, 35, 'Paibian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(95, 36, 'Guzhangian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(96, 36, 'Drumian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(97, 36, 'Wuliuan', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(98, 37, 'Stage 4', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(99, 37, 'Stage 3', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(100, 38, 'Stage 2', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21'),
(101, 38, 'Fortunian', 1, '2023-05-10 11:37:21', '2023-05-10 11:37:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copyright_rules`
--

DROP TABLE IF EXISTS `copyright_rules`;
CREATE TABLE IF NOT EXISTS `copyright_rules` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `copyright_rules`
--

INSERT INTO `copyright_rules` (`id`, `description`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Rule 1', 'notes', '2023-04-26 13:20:56', '2023-04-26 13:20:57'),
(2, 'Rule 2', 'notes', '2023-04-26 13:21:07', '2023-04-26 13:21:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `counties`
--

DROP TABLE IF EXISTS `counties`;
CREATE TABLE IF NOT EXISTS `counties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `counties`
--

INSERT INTO `counties` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Hovedstaden', 1, '2023-05-05 04:22:01', '2023-05-05 04:22:01'),
(2, 'Midtjylland', 1, '2023-05-05 04:22:01', '2023-05-05 04:22:01'),
(3, 'Syddanmark', 1, '2023-05-05 04:22:01', '2023-05-05 04:22:01'),
(4, 'Sjælland', 1, '2023-05-05 04:22:01', '2023-05-05 04:22:01'),
(5, 'Nordjylland', 1, '2023-05-05 04:22:01', '2023-05-05 04:22:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Denmark', 1, '2023-05-05 04:19:43', '2023-05-05 04:19:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eons`
--

DROP TABLE IF EXISTS `eons`;
CREATE TABLE IF NOT EXISTS `eons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `eons`
--

INSERT INTO `eons` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Phanerozoic', 1, '2023-05-10 11:22:25', '2023-05-10 11:22:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epoches`
--

DROP TABLE IF EXISTS `epoches`;
CREATE TABLE IF NOT EXISTS `epoches` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `period_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `epoches_period_id_foreign` (`period_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `epoches`
--

INSERT INTO `epoches` (`id`, `period_id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Holocene ', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(2, 1, 'Pleistocene ', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(3, 1, 'Pliocene', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(4, 2, 'Miocene', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(5, 3, 'Oligocene ', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(6, 3, 'Eocene ', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(7, 3, 'Paleocene', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(8, 4, 'Upper ', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(9, 4, 'Lower', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(10, 5, 'Upper', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(11, 5, 'Middle', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(12, 5, 'Lower', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(13, 6, 'Upper', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(14, 6, 'Middle', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(15, 6, 'Lower', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(16, 7, 'Lopingian', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(17, 7, 'Guadalupian', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(18, 7, 'Cisuralian', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(19, 8, 'Upper', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(20, 8, 'Middle', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(21, 8, 'Lower', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(22, 9, 'Upper', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(23, 9, 'Middle', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(24, 9, 'Lower', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(25, 10, 'Upper', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(26, 10, 'Middle', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(27, 10, 'Lower', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(28, 11, 'Pridoli', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(29, 11, 'Ludlow', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(30, 11, 'Wenlock', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(31, 11, 'Llandovery', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(32, 12, 'Upper', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(33, 12, 'Middle', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(34, 12, 'Lower', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(35, 13, 'Furongian', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(36, 13, 'Miaolingian', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(37, 13, 'Series', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26'),
(38, 13, 'Terreneuvian', 1, '2023-05-10 11:30:26', '2023-05-10 11:30:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eras`
--

DROP TABLE IF EXISTS `eras`;
CREATE TABLE IF NOT EXISTS `eras` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `eon_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eras_eon_id_foreign` (`eon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `eras`
--

INSERT INTO `eras` (`id`, `eon_id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cenozoic', 1, '2023-05-10 11:22:55', '2023-05-10 11:22:55'),
(2, 1, 'Mesozoic', 1, '2023-05-10 11:23:10', '2023-05-10 11:23:10'),
(3, 1, 'Paleozoic', 1, '2023-05-10 11:23:22', '2023-05-10 11:23:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossils`
--

DROP TABLE IF EXISTS `fossils`;
CREATE TABLE IF NOT EXISTS `fossils` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `county_id` bigint UNSIGNED DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `municipality` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `locality_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `hide_location` tinyint(1) NOT NULL,
  `eon_id` bigint UNSIGNED DEFAULT NULL,
  `era_id` bigint UNSIGNED DEFAULT NULL,
  `period_id` bigint UNSIGNED DEFAULT NULL,
  `epoch_id` bigint UNSIGNED DEFAULT NULL,
  `age_id` bigint UNSIGNED DEFAULT NULL,
  `group` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `formation` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `member` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `geochronology_id` bigint UNSIGNED DEFAULT NULL,
  `length` int NOT NULL,
  `width` int NOT NULL,
  `height` int NOT NULL,
  `identifier` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `collector` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date_find` date NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `personal_id` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `need_identify` tinyint(1) NOT NULL DEFAULT '0',
  `vote_scientific` tinyint(1) NOT NULL DEFAULT '0',
  `vote_danekrae` tinyint(1) NOT NULL DEFAULT '0',
  `validated_fossil` tinyint(1) DEFAULT NULL,
  `vote_curator` tinyint(1) DEFAULT NULL,
  `fossil_identify_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fossils_country_id_foreign` (`country_id`),
  KEY `fossils_county_id_foreign` (`county_id`),
  KEY `fossils_eon_id_foreign` (`eon_id`),
  KEY `fossils_era_id_foreign` (`era_id`),
  KEY `fossils_period_id_foreign` (`period_id`),
  KEY `fossils_epoch_id_foreign` (`epoch_id`),
  KEY `fossils_age_id_foreign` (`age_id`),
  KEY `fossils_geochronology_id_foreign` (`geochronology_id`),
  KEY `fossils_user_id_foreign` (`user_id`),
  KEY `fossils_identify_id_foreign` (`fossil_identify_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossils`
--

INSERT INTO `fossils` (`id`, `author`, `country_id`, `county_id`, `city`, `municipality`, `locality_name`, `latitude`, `longitude`, `hide_location`, `eon_id`, `era_id`, `period_id`, `epoch_id`, `age_id`, `group`, `formation`, `member`, `geochronology_id`, `length`, `width`, `height`, `identifier`, `collector`, `date_find`, `notes`, `personal_id`, `user_id`, `created_at`, `updated_at`, `need_identify`, `vote_scientific`, `vote_danekrae`, `validated_fossil`, `vote_curator`, `fossil_identify_id`) VALUES
(2, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 1, 0, NULL, NULL, NULL),
(3, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, NULL, NULL, NULL),
(4, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, NULL, NULL),
(5, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 1, NULL, NULL, NULL),
(6, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, NULL, NULL),
(7, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, NULL, NULL, NULL),
(8, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, NULL, NULL),
(9, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, NULL, NULL, NULL),
(10, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, NULL, NULL),
(11, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, NULL, NULL, NULL),
(12, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, 1, NULL),
(13, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, 1, NULL, NULL),
(14, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, NULL, NULL),
(15, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, NULL, NULL, NULL),
(16, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, NULL, NULL),
(17, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, NULL, NULL, NULL),
(18, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, NULL, NULL),
(19, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, NULL, NULL, NULL),
(20, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, NULL, NULL),
(21, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, NULL, NULL, NULL),
(22, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, NULL, NULL),
(23, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, NULL, NULL, NULL),
(24, 'Mauricio', 1, 1, 'Østengård', 'Østengård', 'Østengård', 55.73223712825193, 9.48529335885684, 0, 1, 1, 1, 1, 1, NULL, NULL, NULL, 1, 100, 100, 100, '1', NULL, '2023-05-10', 'lorem', '1', 3, '2023-05-10 11:53:50', '2023-05-10 11:53:50', 0, 0, 0, NULL, NULL, NULL),
(25, 'Mauricio', 1, 2, 'Fodklinikken', 'Fodklinikken', 'Fodklinikken', 55.7468863949487, 9.4918797972377, 0, 1, 1, 1, 1, 2, NULL, NULL, NULL, 1, 200, 200, 200, '2', NULL, '2023-05-10', 'lorem', '2', 3, '2023-05-12 11:54:23', '2023-05-10 11:54:23', 0, 0, 0, NULL, NULL, NULL),
(26, 'AAA', 1, 1, 'AAA', 'BBB', 'CCC', 56.103937686332, 8.8063156935425, 0, 1, 1, 2, 4, 15, 'AAA', 'BBB', 'CCC', NULL, 100, 100, 100, 'AAA', 'BBB', '2023-05-10', 'AAA', 'AAA', 3, '2023-05-12 22:15:46', '2023-05-12 22:15:46', 0, 0, 0, NULL, NULL, NULL),
(27, 'AAA', 1, 1, 'AAA', 'BBB', 'CCC', 56.103937686332, 8.8063156935425, 0, 1, 1, 2, 4, 15, 'AAA', 'BBB', 'CCC', NULL, 100, 100, 100, 'AAA', 'BBB', '2023-05-10', 'AAA', 'AAA', 6, '2023-05-12 22:15:46', '2023-05-12 22:15:46', 0, 0, 0, NULL, NULL, NULL),
(28, 'AAA', 1, 1, 'AAA', 'BBB', 'CCC', 56.103937686332, 8.8063156935425, 0, 1, 1, 2, 4, 15, 'AAA', 'BBB', 'CCC', NULL, 100, 100, 100, 'AAA', 'BBB', '2023-05-10', 'AAA', 'AAA', 6, '2023-05-12 22:15:46', '2023-05-12 22:15:46', 0, 0, 0, NULL, NULL, NULL),
(29, 'AAA', 1, 1, 'AAA', 'BBB', 'CCC', 56.103937686332, 8.8063156935425, 0, 1, 1, 2, 4, 15, 'AAA', 'BBB', 'CCC', NULL, 100, 100, 100, 'AAA', 'BBB', '2023-05-10', 'AAA', 'AAA', 6, '2023-05-12 22:15:46', '2023-05-12 22:15:46', 0, 0, 0, NULL, NULL, NULL),
(30, 'Autor 1', 1, 1, 'AMMN', 'AABVV', 'MNBVH', 56.384936842759, 9.6567690703125, 0, 1, 2, 6, 14, 51, 'Grupo `', 'Form 1', 'Member 1', NULL, 250, 250, 250, 'asdasd', 'asdasd', '2023-06-11', 'dsada', '1', 3, '2023-06-11 21:00:40', '2023-06-11 21:00:40', 0, 0, 0, NULL, NULL, NULL),
(34, 'Autor 2', 1, 1, 'CSDS', 'ADDS', 'ADAD', 56.331157451727, 9.3930971953125, 0, 1, 1, 3, 5, 17, 'Group 1', 'Formation 1', 'Member 1', NULL, 300, 300, 300, 'asd', 'sad', '2023-06-11', 'wadas', '2', 3, '2023-06-11 21:21:03', '2023-06-11 21:21:03', 0, 0, 0, NULL, NULL, NULL),
(35, 'Mauricio', 1, 1, 'Lomas', 'Lomas', 'Lomas', 56.12159646551, 9.3381655546875, 0, 1, 1, 1, 1, 1, 'GROUP', 'FORMATION', 'MEMBER', NULL, 100, 100, 100, '1', '1', '2023-07-14', 'sad', '1', 3, '2023-07-07 22:52:06', '2023-07-07 22:52:06', 0, 0, 0, NULL, NULL, NULL),
(36, 'Mauricio', 1, 1, 'Lomas', 'Lomas', 'Lomas', 56.237779120886, 10.667511257813, 0, 1, 1, 1, 1, 1, 'A', 'A', 'A', NULL, 100, 100, 100, '1', 'B', '2023-07-07', 'Notes', '1', 3, '2023-07-08 03:51:37', '2023-07-09 00:58:57', 0, 1, 1, 0, 0, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_classes`
--

DROP TABLE IF EXISTS `fossil_classes`;
CREATE TABLE IF NOT EXISTS `fossil_classes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_classes`
--

INSERT INTO `fossil_classes` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'class 1', 1, '2023-05-05 04:24:16', '2023-05-05 04:24:16'),
(2, 'class 2', 1, '2023-05-05 04:24:16', '2023-05-05 04:24:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_commons`
--

DROP TABLE IF EXISTS `fossil_commons`;
CREATE TABLE IF NOT EXISTS `fossil_commons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_commons`
--

INSERT INTO `fossil_commons` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'common 1', 1, '2023-05-05 04:24:35', '2023-05-05 04:24:35'),
(2, 'common 2', 1, '2023-05-05 04:24:35', '2023-05-05 04:24:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_families`
--

DROP TABLE IF EXISTS `fossil_families`;
CREATE TABLE IF NOT EXISTS `fossil_families` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_families`
--

INSERT INTO `fossil_families` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'family 1', 1, '2023-05-05 04:24:52', '2023-05-05 04:24:52'),
(2, 'family 2', 1, '2023-05-05 04:24:52', '2023-05-05 04:24:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_genres`
--

DROP TABLE IF EXISTS `fossil_genres`;
CREATE TABLE IF NOT EXISTS `fossil_genres` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_genres`
--

INSERT INTO `fossil_genres` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'gender 1', 1, '2023-05-05 04:25:07', '2023-05-05 04:25:07'),
(2, 'gender 2', 1, '2023-05-05 04:25:07', '2023-05-05 04:25:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_identifies`
--

DROP TABLE IF EXISTS `fossil_identifies`;
CREATE TABLE IF NOT EXISTS `fossil_identifies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `fossil_id` bigint UNSIGNED NOT NULL,
  `fossil_taxonomy_id` bigint UNSIGNED DEFAULT NULL,
  `fossil_kingdom` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_common` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_phylum` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_class` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_order` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_family` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_genre` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_subgenre` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `specific_epithet` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fossil_subspecies` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_suggest_id` bigint UNSIGNED DEFAULT NULL,
  `user_curator_id` bigint UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `vote_curator` tinyint(1) NOT NULL DEFAULT '0',
  `vote_expert` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vote_user` int NOT NULL DEFAULT '0',
  `vote_users_json` json DEFAULT NULL,
  `vote_curator_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fossil_identifies_fossil_id_foreign` (`fossil_id`),
  KEY `fossil_identifies_fossil_taxonomy_id_foreign` (`fossil_taxonomy_id`),
  KEY `fossil_identifies_fossil_kingdom_id_foreign` (`fossil_kingdom`),
  KEY `fossil_identifies_fossil_common_id_foreign` (`fossil_common`),
  KEY `fossil_identifies_fossil_phylum_id_foreign` (`fossil_phylum`),
  KEY `fossil_identifies_fossil_class_id_foreign` (`fossil_class`),
  KEY `fossil_identifies_fossil_order_id_foreign` (`fossil_order`),
  KEY `fossil_identifies_fossil_family_id_foreign` (`fossil_family`),
  KEY `fossil_identifies_fossil_genre_id_foreign` (`fossil_genre`),
  KEY `fossil_identifies_fossil_subgenre_id_foreign` (`fossil_subgenre`),
  KEY `fossil_identifies_specific_epithet_id_foreign` (`specific_epithet`),
  KEY `fossil_identifies_fossil_subspecies_id_foreign` (`fossil_subspecies`),
  KEY `fossil_identifies_user_id_foreign` (`user_id`),
  KEY `fossil_identifies_user_suggest_id_foreign` (`user_suggest_id`),
  KEY `fossil_identifies_user_curator_id_foreign` (`user_curator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_identifies`
--

INSERT INTO `fossil_identifies` (`id`, `fossil_id`, `fossil_taxonomy_id`, `fossil_kingdom`, `fossil_common`, `fossil_phylum`, `fossil_class`, `fossil_order`, `fossil_family`, `fossil_genre`, `fossil_subgenre`, `specific_epithet`, `fossil_subspecies`, `user_id`, `user_suggest_id`, `user_curator_id`, `active`, `vote_curator`, `vote_expert`, `created_at`, `updated_at`, `vote_user`, `vote_users_json`, `vote_curator_id`) VALUES
(1, 34, NULL, '1', '2', '1', '1', '1', '1', '1', '1', '1', '1', 3, NULL, NULL, 1, 0, 0, '2023-06-11 21:21:03', '2023-06-11 21:21:03', 0, NULL, NULL),
(2, 35, NULL, 'UNKNOWN', 'common 2', 'phylum 2', 'class 2', 'order 2', 'family 2', 'gender 2', 'subgenre 2', 'epithet 2', 'subspecies 2', 3, NULL, NULL, 1, 0, 0, '2023-07-07 22:52:06', '2023-07-07 22:52:06', 0, NULL, NULL),
(3, 36, NULL, 'kingdom 2', 'Comun', 'phylum 2', 'class 2', 'order 2', 'family 2', 'gender 2', 'subgenre 2', 'epithet 2', 'UNKNOWN', 3, NULL, NULL, 1, 0, 0, '2023-07-08 03:51:37', '2023-07-09 00:58:57', 1, '[7]', 7),
(4, 27, NULL, 'UNKNOWN', 'UNKNOWN', 'UNKNOWN', 'UNKNOWN', 'UNKNOWN', 'UNKNOWN', 'UNKNOWN', 'UNKNOWN', 'UNKNOWN', 'UNKNOWN', 6, NULL, NULL, 1, 0, 0, '2023-07-08 02:09:36', '2023-07-08 02:09:36', 0, NULL, NULL),
(5, 36, NULL, 'kingdom 1', 'Comun', 'phylum 2', 'class 2', 'order 2', 'family 2', 'gender 2', 'subgenre 2', 'epithet 2', 'UNKNOWN', 7, NULL, NULL, 1, 0, 0, '2023-07-08 18:02:06', '2023-07-09 00:42:30', 1, '[7]', 7),
(12, 36, NULL, 'UNKNOWN', 'common 1', 'phylum 1', 'UNKNOWN', 'UNKNOWN', 'UNKNOWN', 'gender 1', 'subgenre 1', 'epithet 1', 'UNKNOWN', 7, NULL, NULL, 0, 1, 0, '2023-07-08 22:55:33', '2023-07-09 00:58:57', 1, '[7]', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_kingdoms`
--

DROP TABLE IF EXISTS `fossil_kingdoms`;
CREATE TABLE IF NOT EXISTS `fossil_kingdoms` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_kingdoms`
--

INSERT INTO `fossil_kingdoms` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'kingdom 1', 1, '2023-05-05 04:25:27', '2023-05-05 04:25:27'),
(2, 'kingdom 2', 1, '2023-05-05 04:25:27', '2023-05-05 04:25:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_orders`
--

DROP TABLE IF EXISTS `fossil_orders`;
CREATE TABLE IF NOT EXISTS `fossil_orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_orders`
--

INSERT INTO `fossil_orders` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'order 1', 1, '2023-05-05 04:25:46', '2023-05-05 04:25:46'),
(2, 'order 2', 1, '2023-05-05 04:25:46', '2023-05-05 04:25:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_phylums`
--

DROP TABLE IF EXISTS `fossil_phylums`;
CREATE TABLE IF NOT EXISTS `fossil_phylums` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_phylums`
--

INSERT INTO `fossil_phylums` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'phylum 1', 1, '2023-05-05 04:27:31', '2023-05-05 04:27:31'),
(2, 'phylum 2', 1, '2023-05-05 04:27:31', '2023-05-05 04:27:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_regions`
--

DROP TABLE IF EXISTS `fossil_regions`;
CREATE TABLE IF NOT EXISTS `fossil_regions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_specialities`
--

DROP TABLE IF EXISTS `fossil_specialities`;
CREATE TABLE IF NOT EXISTS `fossil_specialities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_subgenres`
--

DROP TABLE IF EXISTS `fossil_subgenres`;
CREATE TABLE IF NOT EXISTS `fossil_subgenres` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_subgenres`
--

INSERT INTO `fossil_subgenres` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'subgenre 1', 1, '2023-05-05 04:27:49', '2023-05-05 04:27:49'),
(2, 'subgenre 2', 1, '2023-05-05 04:27:49', '2023-05-05 04:27:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_subspecies`
--

DROP TABLE IF EXISTS `fossil_subspecies`;
CREATE TABLE IF NOT EXISTS `fossil_subspecies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_subspecies`
--

INSERT INTO `fossil_subspecies` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'subspecies 1', 1, '2023-05-05 04:28:14', '2023-05-05 04:28:14'),
(2, 'subspecies 2', 1, '2023-05-05 04:28:14', '2023-05-05 04:28:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fossil_taxonomies`
--

DROP TABLE IF EXISTS `fossil_taxonomies`;
CREATE TABLE IF NOT EXISTS `fossil_taxonomies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fossil_kingdom_id` bigint UNSIGNED DEFAULT NULL,
  `fossil_common_id` bigint UNSIGNED DEFAULT NULL,
  `fossil_phylum_id` bigint UNSIGNED DEFAULT NULL,
  `fossil_class_id` bigint UNSIGNED DEFAULT NULL,
  `fossil_order_id` bigint UNSIGNED DEFAULT NULL,
  `fossil_family_id` bigint UNSIGNED DEFAULT NULL,
  `fossil_genre_id` bigint UNSIGNED DEFAULT NULL,
  `fossil_subgenre_id` bigint UNSIGNED DEFAULT NULL,
  `specific_epithet_id` bigint UNSIGNED DEFAULT NULL,
  `fossil_subspecies_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fossil_taxonomies_fossil_kingdom_id_foreign` (`fossil_kingdom_id`),
  KEY `fossil_taxonomies_fossil_common_id_foreign` (`fossil_common_id`),
  KEY `fossil_taxonomies_fossil_phylum_id_foreign` (`fossil_phylum_id`),
  KEY `fossil_taxonomies_fossil_class_id_foreign` (`fossil_class_id`),
  KEY `fossil_taxonomies_fossil_order_id_foreign` (`fossil_order_id`),
  KEY `fossil_taxonomies_fossil_family_id_foreign` (`fossil_family_id`),
  KEY `fossil_taxonomies_fossil_genre_id_foreign` (`fossil_genre_id`),
  KEY `fossil_taxonomies_fossil_subgenre_id_foreign` (`fossil_subgenre_id`),
  KEY `fossil_taxonomies_specific_epithet_id_foreign` (`specific_epithet_id`),
  KEY `fossil_taxonomies_fossil_subspecies_id_foreign` (`fossil_subspecies_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `fossil_taxonomies`
--

INSERT INTO `fossil_taxonomies` (`id`, `description`, `active`, `created_at`, `updated_at`, `fossil_kingdom_id`, `fossil_common_id`, `fossil_phylum_id`, `fossil_class_id`, `fossil_order_id`, `fossil_family_id`, `fossil_genre_id`, `fossil_subgenre_id`, `specific_epithet_id`, `fossil_subspecies_id`) VALUES
(1, 'taxonomy 1', 1, '2023-05-05 04:28:39', '2023-05-05 04:28:39', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2),
(2, 'taxonomy 2', 1, '2023-05-05 04:28:39', '2023-05-05 04:28:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `geochronologies`
--

DROP TABLE IF EXISTS `geochronologies`;
CREATE TABLE IF NOT EXISTS `geochronologies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `eon_id` bigint UNSIGNED DEFAULT NULL,
  `epoche_id` bigint UNSIGNED DEFAULT NULL,
  `era_id` bigint UNSIGNED DEFAULT NULL,
  `period_id` bigint UNSIGNED DEFAULT NULL,
  `age_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `geochronologies_eon_id_foreign` (`eon_id`),
  KEY `geochronologies_epoche_id_foreign` (`epoche_id`),
  KEY `geochronologies_era_id_foreign` (`era_id`),
  KEY `geochronologies_period_id_foreign` (`period_id`),
  KEY `geochronologies_age_id_foreign` (`age_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `geochronologies`
--

INSERT INTO `geochronologies` (`id`, `description`, `created_at`, `updated_at`, `eon_id`, `epoche_id`, `era_id`, `period_id`, `age_id`) VALUES
(1, 'geochronology 1', '2023-05-05 04:29:06', '2023-05-05 04:29:06', 1, 1, 1, 1, 1),
(2, 'geochronology 2', '2023-05-05 04:29:06', '2023-05-05 04:29:06', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `fossil_id` int NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `principal` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `fossil_id`, `path`, `created_at`, `updated_at`, `principal`) VALUES
(1, 3, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(2, 3, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(3, 2, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:53:06', '2023-04-28 09:53:07', 1),
(4, 4, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(5, 4, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(6, 5, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(7, 6, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(8, 6, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(9, 7, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 1),
(10, 8, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(11, 8, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(12, 9, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(13, 10, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(14, 10, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(15, 11, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 1),
(16, 12, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(17, 12, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(18, 13, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(19, 13, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(20, 14, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(21, 14, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(22, 15, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(23, 15, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(24, 16, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(25, 16, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(26, 17, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:33:39', '2023-04-28 09:31:29', 1),
(27, 18, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:39', 1),
(28, 18, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:33:39', '2023-04-28 09:31:29', 0),
(29, 19, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:39', 1),
(30, 20, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:33:39', '2023-04-28 09:31:29', 1),
(31, 20, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:39', 0),
(32, 21, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:33:39', '2023-04-28 09:31:29', 1),
(33, 22, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:39', 1),
(34, 22, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:33:39', '2023-04-28 09:31:29', 0),
(35, 23, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:39', 1),
(36, 24, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(37, 25, '/storage/images/_100433069_gettyimages-116496314.jpg', '2023-04-28 09:33:39', '2023-04-28 09:33:40', 0),
(38, 25, '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', '2023-04-28 09:31:29', '2023-04-28 09:31:30', 1),
(39, 26, '/storage/images/9c5ce651277c24166727c28abd31ebf5.jpg', '2023-05-12 22:15:46', '2023-05-12 22:15:46', 1),
(40, 30, '/storage/images/906caba9804b5b705991257beeba1048.jpg', '2023-06-11 21:00:40', '2023-06-11 21:00:40', 1),
(44, 34, '/storage/images/13fe42fadb9373e61e43dc994ff7d61a.jpg', '2023-06-11 21:21:03', '2023-06-11 21:21:03', 1),
(45, 35, '/storage/images/4a61fbc68325746e07aef9e21932ff14.jpg', '2023-07-07 22:52:06', '2023-07-07 22:52:06', 1),
(46, 35, '/storage/images/a3395a47d0aaf3e7c18073979f5b9d03.jpg', '2023-07-07 22:52:06', '2023-07-07 22:52:06', 1),
(47, 35, '/storage/images/7354d2d835d129b80f547ae07dd1285f.jpg', '2023-07-07 22:52:06', '2023-07-07 22:52:06', 1),
(48, 36, '/storage/images/4aa53096b49d8d419a5d9c2ec66fc2f6.jpg', '2023-07-08 03:51:37', '2023-07-08 03:51:37', 1),
(49, 36, '/storage/images/2c16c252f3205c6744e97131e4a2d148.jpg', '2023-07-08 03:51:37', '2023-07-08 03:51:37', 1),
(50, 36, '/storage/images/3eb853b8952c7a4f73b3609cd302588d.jpg', '2023-07-08 03:51:37', '2023-07-08 03:51:37', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licences`
--

DROP TABLE IF EXISTS `licences`;
CREATE TABLE IF NOT EXISTS `licences` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `licences`
--

INSERT INTO `licences` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Prueba', '2023-04-24 19:39:19', '2023-04-24 19:39:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `map_resources`
--

DROP TABLE IF EXISTS `map_resources`;
CREATE TABLE IF NOT EXISTS `map_resources` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `map_resources`
--

INSERT INTO `map_resources` (`id`, `title`, `description`, `latitude`, `longitude`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Prueba', 'Prueba', 55.73223712825193, 9.48529335885684, 1, '2023-07-09 01:24:39', '2023-07-09 01:24:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_14_035221_add_role_to_users_table', 2),
(6, '2023_04_20_234132_add_picture_licence_id_to_users', 3),
(7, '2023_04_20_234557_add_table_licences', 3),
(8, '2023_04_23_205313_add_table_fossil', 4),
(9, '2023_04_24_181517_create_table_images', 4),
(10, '2023_04_24_190520_create_table_geochronologies', 4),
(11, '2023_04_24_200602_add_state_to_fossils', 5),
(12, '2023_04_25_235126_add_table_copyright_rules', 6),
(15, '2023_04_26_000008_add_copyright_rule_id_to_users', 7),
(19, '2023_05_04_184642_add_table_fossil_classes', 8),
(20, '2023_05_04_184715_add_table_fossil_orders', 8),
(21, '2023_05_04_184752_add_table_fossil_families', 8),
(22, '2023_05_04_184812_add_table_fossil_genus', 8),
(23, '2023_05_04_185130_add_table_fossil_subgenres', 8),
(24, '2023_05_04_185239_add_table_specific_epithets', 8),
(25, '2023_05_04_185400_add_table_fossil_subpecies', 8),
(26, '2023_05_04_185534_add_table_fossil_taxonomies', 8),
(27, '2023_05_04_185605_add_table_countries', 8),
(28, '2023_05_04_185636_add_table_counties', 8),
(34, '2023_05_04_183950_add_table_common', 9),
(35, '2023_05_04_184356_add_table_kingdoms', 9),
(36, '2023_05_04_184434_add_table_phylums', 9),
(40, '2023_05_04_190037_add_table_eons', 10),
(41, '2023_05_04_190100_add_table_eras', 10),
(42, '2023_05_04_190138_add_table_periods', 10),
(43, '2023_05_04_190211_add_table_epoches', 10),
(44, '2023_05_04_191149_add_table_ages', 10),
(45, '2023_05_04_191412_add_table_fossils', 10),
(46, '2023_05_20_120001_add_need_identify_to_fossil', 11),
(47, '2023_05_29_211600_add_vote_curator_to_fossil', 12),
(48, '2023_06_08_180544_add_table_resources', 13),
(49, '2023_06_11_164355_add_table_indentifies', 14),
(50, '2023_06_11_170955_remove_fossils_columns', 15),
(51, '2023_06_14_050324_add_vote_user_to_fossil_identifies', 16),
(52, '2023_06_14_182757_add_fossil_identify_votes', 16),
(53, '2023_07_04_125138_add_columns_to_fossil_taxonomies_table', 16),
(54, '2023_07_05_223313_add_columns_to_geochronologiess_table', 16),
(55, '2023_07_06_201303_add_images_to_resources', 16),
(56, '2023_07_06_205924_news', 16),
(57, '2023_07_07_000322_add_table_fossil_specialites', 16),
(58, '2023_07_07_002103_add_table_fossil_regions', 16),
(59, '2023_07_07_235857_add_region_speciality_to_users', 17),
(60, '2023_07_08_175137_add_columns_to_users_table_active', 18),
(61, '2023_07_08_201027_add_table_map_resources', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `endpoint` varchar(250) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `html` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `new_order` int NOT NULL,
  `active` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `name`, `endpoint`, `description`, `html`, `new_order`, `active`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'test', 'lorem', '<p>asdasd</p><p>asdasd</p><p>asdsad</p><p>sadsad</p><p>asdasd</p>', 1, 1, '/storage/images/eb6a904434811a5e1b788d0fa57eafe4.jpg', '2023-07-07 05:22:48', '2023-07-07 05:31:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periods`
--

DROP TABLE IF EXISTS `periods`;
CREATE TABLE IF NOT EXISTS `periods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `era_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `periods_era_id_foreign` (`era_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `periods`
--

INSERT INTO `periods` (`id`, `era_id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Quaternary', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(2, 1, 'Neogene', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(3, 1, 'Paleogene', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(4, 2, 'Cretaceous', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(5, 2, 'Jurassic', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(6, 2, 'Triassic', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(7, 3, 'Permian', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(8, 3, 'Carboniferous Pennsylvanian', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(9, 3, 'Carboniferous  Mississippian', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(10, 3, 'Devonian', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(11, 3, 'Silurian', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(12, 3, 'Ordovician', 1, '2023-05-10 11:24:55', '2023-05-10 11:24:55'),
(13, 3, 'Cambrian', 1, '2023-05-10 11:26:48', '2023-05-10 11:26:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources`
--

DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `endpoint` varchar(250) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `html` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `resource_order` int NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `images` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `resources`
--

INSERT INTO `resources` (`id`, `name`, `endpoint`, `description`, `html`, `resource_order`, `active`, `created_at`, `updated_at`, `images`) VALUES
(1, 'Hjælp ', 'help', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, fugit illo incidunt, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 'HELP Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, <b>fugit illo incidunt</b>, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 1, 1, '2023-06-08 17:08:32', '2023-06-08 17:08:33', NULL),
(2, 'Om os ', 'about-us', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, fugit illo incidunt, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 'ABOUT US Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, <b>fugit illo incidunt</b>, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 2, 1, '2023-06-08 17:10:02', '2023-06-08 17:10:02', NULL),
(3, 'Fossile ressourcer', 'fossil-resources', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, fugit illo incidunt, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 'FOSSIL RESOURCE Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, <b>fugit illo incidunt</b>, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 3, 1, '2023-06-08 17:10:02', '2023-06-08 17:10:02', NULL),
(4, 'Fossiljagt og Fossiler', 'fossil-hunting-and-fossils', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, fugit illo incidunt, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 'FOSSIL HUNTING Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, <b>fugit illo incidunt</b>, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 4, 1, '2023-06-08 17:10:02', '2023-06-08 17:10:02', NULL),
(5, 'Danekræ', 'danish-beef', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, fugit illo incidunt, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 'DANISH Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, <b>fugit illo incidunt</b>, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 5, 1, '2023-06-08 17:10:02', '2023-06-08 17:10:02', NULL),
(6, 'Danmarks fossil-lokaliteter', 'denmarks-fossil-sites', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, fugit illo incidunt, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 'DENMARK Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, <b>fugit illo incidunt</b>, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 6, 1, '2023-06-08 17:10:02', '2023-06-08 17:10:02', NULL),
(7, 'Inspiration til sådan et kort kan ses på', 'inspiration-for-such-a-card-can-be-seen-at', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, fugit illo incidunt, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 'INSPIRATION Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias blanditiis corporis culpa doloremque enim facilis fuga, <b>fugit illo incidunt</b>, ipsam laudantium nihil nulla officia possimus quo ratione sit voluptatibus?', 7, 1, '2023-06-08 17:14:00', '2023-06-08 17:14:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specific_epithets`
--

DROP TABLE IF EXISTS `specific_epithets`;
CREATE TABLE IF NOT EXISTS `specific_epithets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `specific_epithets`
--

INSERT INTO `specific_epithets` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'epithet 1', 1, '2023-05-05 04:30:03', '2023-05-05 04:30:03'),
(2, 'epithet 2', 1, '2023-05-05 04:30:03', '2023-05-05 04:30:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'customer',
  `picture` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `licence_id` int DEFAULT NULL,
  `username` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `copyright_rule_id` int DEFAULT NULL,
  `fossil_speciality_id` bigint UNSIGNED DEFAULT NULL,
  `fossil_region_id` bigint UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_fossil_speciality_id_foreign` (`fossil_speciality_id`),
  KEY `users_fossil_region_id_foreign` (`fossil_region_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `picture`, `licence_id`, `username`, `copyright_rule_id`, `fossil_speciality_id`, `fossil_region_id`, `active`) VALUES
(3, 'Mauricio Torres Ramos', 'mauricio3389@gmail.com', '2023-04-26 15:00:18', '$2y$10$XSg6fza0jcSoUCf6Wk2I/uHyeq5PF47osfscxVL9na7JFT4DjNHhC', NULL, '2023-04-26 16:44:51', '2023-07-09 04:01:01', 'customer', '/storage/images/1d45b5c28613aa8ebac2a581c3f33175.png', 1, 'mauricio3389', 1, NULL, NULL, 1),
(6, 'Julio Mauricio torres Ramos', 'mauricio3389@hotmail.com', '2023-06-05 23:17:34', '$2y$10$XSg6fza0jcSoUCf6Wk2I/uHyeq5PF47osfscxVL9na7JFT4DjNHhC', NULL, '2023-04-26 17:35:36', '2023-04-26 17:35:36', 'admin', '/storage/images/542ab3561dca854af39ea0da9bf32992.jpg', 1, 'admin', 1, NULL, NULL, 1),
(7, 'Curator', 'mauricio0289@gmail.com', '2023-07-08 15:44:16', '$2y$10$Yu3upGSSw36alxMAOz5imuxoa4NntbI6kpORokPorevRKSt/RSvbK', NULL, '2023-07-08 15:44:16', '2023-07-08 15:44:16', 'curator', NULL, NULL, 'curator', NULL, NULL, NULL, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ages`
--
ALTER TABLE `ages`
  ADD CONSTRAINT `ages_epoch_id_foreign` FOREIGN KEY (`epoch_id`) REFERENCES `epoches` (`id`);

--
-- Filtros para la tabla `epoches`
--
ALTER TABLE `epoches`
  ADD CONSTRAINT `epoches_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`);

--
-- Filtros para la tabla `eras`
--
ALTER TABLE `eras`
  ADD CONSTRAINT `eras_eon_id_foreign` FOREIGN KEY (`eon_id`) REFERENCES `eons` (`id`);

--
-- Filtros para la tabla `fossils`
--
ALTER TABLE `fossils`
  ADD CONSTRAINT `fossils_age_id_foreign` FOREIGN KEY (`age_id`) REFERENCES `ages` (`id`),
  ADD CONSTRAINT `fossils_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `fossils_county_id_foreign` FOREIGN KEY (`county_id`) REFERENCES `counties` (`id`),
  ADD CONSTRAINT `fossils_eon_id_foreign` FOREIGN KEY (`eon_id`) REFERENCES `eons` (`id`),
  ADD CONSTRAINT `fossils_epoch_id_foreign` FOREIGN KEY (`epoch_id`) REFERENCES `epoches` (`id`),
  ADD CONSTRAINT `fossils_era_id_foreign` FOREIGN KEY (`era_id`) REFERENCES `eras` (`id`),
  ADD CONSTRAINT `fossils_geochronology_id_foreign` FOREIGN KEY (`geochronology_id`) REFERENCES `geochronologies` (`id`),
  ADD CONSTRAINT `fossils_identify_id_foreign` FOREIGN KEY (`fossil_identify_id`) REFERENCES `fossil_identifies` (`id`),
  ADD CONSTRAINT `fossils_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`),
  ADD CONSTRAINT `fossils_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `fossil_identifies`
--
ALTER TABLE `fossil_identifies`
  ADD CONSTRAINT `fossil_identifies_fossil_id_foreign` FOREIGN KEY (`fossil_id`) REFERENCES `fossils` (`id`),
  ADD CONSTRAINT `fossil_identifies_fossil_taxonomy_id_foreign` FOREIGN KEY (`fossil_taxonomy_id`) REFERENCES `fossil_taxonomies` (`id`),
  ADD CONSTRAINT `fossil_identifies_user_curator_id_foreign` FOREIGN KEY (`user_curator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fossil_identifies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fossil_identifies_user_suggest_id_foreign` FOREIGN KEY (`user_suggest_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `fossil_taxonomies`
--
ALTER TABLE `fossil_taxonomies`
  ADD CONSTRAINT `fossil_taxonomies_fossil_class_id_foreign` FOREIGN KEY (`fossil_class_id`) REFERENCES `fossil_classes` (`id`),
  ADD CONSTRAINT `fossil_taxonomies_fossil_common_id_foreign` FOREIGN KEY (`fossil_common_id`) REFERENCES `fossil_commons` (`id`),
  ADD CONSTRAINT `fossil_taxonomies_fossil_family_id_foreign` FOREIGN KEY (`fossil_family_id`) REFERENCES `fossil_families` (`id`),
  ADD CONSTRAINT `fossil_taxonomies_fossil_genre_id_foreign` FOREIGN KEY (`fossil_genre_id`) REFERENCES `fossil_genres` (`id`),
  ADD CONSTRAINT `fossil_taxonomies_fossil_kingdom_id_foreign` FOREIGN KEY (`fossil_kingdom_id`) REFERENCES `fossil_kingdoms` (`id`),
  ADD CONSTRAINT `fossil_taxonomies_fossil_order_id_foreign` FOREIGN KEY (`fossil_order_id`) REFERENCES `fossil_orders` (`id`),
  ADD CONSTRAINT `fossil_taxonomies_fossil_phylum_id_foreign` FOREIGN KEY (`fossil_phylum_id`) REFERENCES `fossil_phylums` (`id`),
  ADD CONSTRAINT `fossil_taxonomies_fossil_subgenre_id_foreign` FOREIGN KEY (`fossil_subgenre_id`) REFERENCES `fossil_subgenres` (`id`),
  ADD CONSTRAINT `fossil_taxonomies_fossil_subspecies_id_foreign` FOREIGN KEY (`fossil_subspecies_id`) REFERENCES `fossil_subspecies` (`id`),
  ADD CONSTRAINT `fossil_taxonomies_specific_epithet_id_foreign` FOREIGN KEY (`specific_epithet_id`) REFERENCES `specific_epithets` (`id`);

--
-- Filtros para la tabla `geochronologies`
--
ALTER TABLE `geochronologies`
  ADD CONSTRAINT `geochronologies_age_id_foreign` FOREIGN KEY (`age_id`) REFERENCES `ages` (`id`),
  ADD CONSTRAINT `geochronologies_eon_id_foreign` FOREIGN KEY (`eon_id`) REFERENCES `eons` (`id`),
  ADD CONSTRAINT `geochronologies_epoche_id_foreign` FOREIGN KEY (`epoche_id`) REFERENCES `epoches` (`id`),
  ADD CONSTRAINT `geochronologies_era_id_foreign` FOREIGN KEY (`era_id`) REFERENCES `eras` (`id`),
  ADD CONSTRAINT `geochronologies_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`);

--
-- Filtros para la tabla `periods`
--
ALTER TABLE `periods`
  ADD CONSTRAINT `periods_era_id_foreign` FOREIGN KEY (`era_id`) REFERENCES `eras` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fossil_region_id_foreign` FOREIGN KEY (`fossil_region_id`) REFERENCES `fossil_regions` (`id`),
  ADD CONSTRAINT `users_fossil_speciality_id_foreign` FOREIGN KEY (`fossil_speciality_id`) REFERENCES `fossil_specialities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
