-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-01-2021 a las 19:20:32
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sym-final`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjuntos`
--

DROP TABLE IF EXISTS `adjuntos`;
CREATE TABLE IF NOT EXISTS `adjuntos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adjuntos_id` int(11) DEFAULT NULL,
  `fichero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'fichero.jpg',
  PRIMARY KEY (`id`),
  KEY `IDX_3DAF436BBFFE4373` (`adjuntos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `adjuntos`
--

INSERT INTO `adjuntos` (`id`, `adjuntos_id`, `fichero`) VALUES
(25, NULL, NULL),
(26, NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  ADD CONSTRAINT `FK_3DAF436BBFFE4373` FOREIGN KEY (`adjuntos_id`) REFERENCES `tasks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
