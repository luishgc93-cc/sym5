-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-01-2021 a las 12:00:06
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
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210104084846', '2021-01-04 09:22:09', 219),
('DoctrineMigrations\\Version20210104092137', '2021-01-04 09:22:09', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reset_password_request`
--

INSERT INTO `reset_password_request` (`id`, `user_id`, `selector`, `hashed_token`, `requested_at`, `expires_at`) VALUES
(1, 8, 'Zw8Vub0nY6vNk7u1kz6o', 'wEV1xOOfuIj4hy9eu1XQmMK5dh5sm2I0eA2TdGRB5Ag=', '2021-01-04 09:23:08', '2021-01-04 10:23:08'),
(2, 8, 'oo7VueGu6II6JBdpdGkP', 'keQKsvYV9UMLaUpq2ttRrUeofZXGlPta07l394sBojo=', '2021-01-04 10:30:10', '2021-01-04 11:30:10'),
(3, 8, 'kqUZaz7Iqwp8JPc9FE6R', 'VtY83YBGndAFNTYhOAejaZnharrlgtBMQ0bZopMZ99I=', '2021-01-04 11:33:18', '2021-01-04 12:33:18'),
(4, 8, 'J6iBPzFOuddIckTkoVuF', 'B9O/DzcGX0G/NUdORSfBk9PKnfi9NuQs9iJEllfJ7K4=', '2021-01-04 12:59:48', '2021-01-04 13:59:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `hours` int(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_task_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `content`, `priority`, `hours`, `created_at`) VALUES
(14, 21, 'fds', 'fsd', 'high', 2, '2021-01-07 10:57:57'),
(15, 21, 'tarea para luis', 'tarea para luis', 'low', 2, '2021-01-07 11:23:54'),
(16, 8, 'tarea para luis 2', 'tarea para luis 2', 'high', 2, '2021-01-07 11:24:51'),
(17, 8, 'tarea para luis 3', 'dadas', 'high', 2222, '2021-01-07 11:25:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `email`, `password`, `created_at`) VALUES
(8, 'ROLE_ADMIN', 'Luis', 'Chavez', 'luishomerogonzales93@gmail.com', '$2y$04$bzci0Y7VllRA1AhRfoCHuOiR2hJV5Qw..HksWBo7crex1FTMnFk1S', '2021-01-04 09:10:50'),
(9, 'ROLE_USER', 'pepe', 'pepe', 'pepe@dsa.com', '$2y$04$loazdCrSvFUb3v.S5Tbw1.nMARGfoMRsBefX9yQ2Nf1HMlpTddpNS', '2021-01-04 15:49:35'),
(10, 'ROLE_USER', 'pepito', 'epepe', 'alooo@gmail.com', '$2y$04$XHj/O1F5bFzyRSi2tp6Jvux4zGJu6qHLNag5RJ9MdlLdcK7BJzA.C', '2021-01-04 15:50:18'),
(11, 'ROLE_USER', 'luis', 'luis', 'luis@gmail.com', '$2y$04$ILuP9uHcSIZSJ0aOTY5aiekp6.HdhQ1EJfbrW2E3ORhHUcCqqNyYq', '2021-01-04 15:59:58'),
(12, 'ROLE_USER', 'carlos', 'carlos', 'carlos@gmail.com', '$2y$04$/aV7KX4OZuzZky/wLG4FZeIdit2lqcWXMh8NmjVxhz0rBKksOmV8W', '2021-01-04 16:00:25'),
(14, 'ROLE_USER', 'pepe', 'pepe', 'pepe@gdaas.com', '$2y$04$Z8Zow6CWeAvQyUSS3pten.K1NFbXPXEO0aGTgUW3ekfZHILrm22le', '2021-01-04 16:22:04'),
(15, 'ROLE_USER', 'pepepeepp', 'epepe', 'pepepepe@gmail.com', '$2y$04$7yeuAiOYobMG3Gi41ux7WeI8s.S4UJq2UCV8WPDGL0pl9abdOWf7e', '2021-01-05 10:00:38'),
(21, 'ROLE_ADMIN', 'admin', 'admins', 'admin@admin.com', '$2y$04$ZJeRkvSs6EnUNsVJvwXo7ugg04e0QZPgBCttwHdeftv8pvKFu3bpa', '2021-01-07 08:49:22');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_task_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
