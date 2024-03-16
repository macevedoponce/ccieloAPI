-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-03-2024 a las 17:15:48
-- Versión del servidor: 8.0.36-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ccieloapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Puntos`
--

CREATE TABLE `Puntos` (
  `puntos_id` int NOT NULL,
  `puntos_participacion` int DEFAULT NULL,
  `puntos_asistencia` int DEFAULT NULL,
  `puntos_biblia` int DEFAULT NULL,
  `puntos_fecha` date DEFAULT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE `Roles` (
  `rol_id` int NOT NULL,
  `rol_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Roles`
--

INSERT INTO `Roles` (`rol_id`, `rol_nombre`) VALUES
(1, 'Docente'),
(2, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE `Users` (
  `user_id` int NOT NULL,
  `user_nombres` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_apellidos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_dni` int DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_rol` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Users`
--

INSERT INTO `Users` (`user_id`, `user_nombres`, `user_apellidos`, `user_dni`, `user_password`, `user_foto`, `id_rol`) VALUES
(1, 'Miguel Angel', 'Acevedo Ponce', 73122365, '$2y$12$BjkFpePtzAIcP586Gx.dY.1ZUI9iOhXvoO45mJoCtg8sM3j58FlTy', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Puntos`
--
ALTER TABLE `Puntos`
  ADD PRIMARY KEY (`puntos_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Puntos`
--
ALTER TABLE `Puntos`
  MODIFY `puntos_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Roles`
--
ALTER TABLE `Roles`
  MODIFY `rol_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Puntos`
--
ALTER TABLE `Puntos`
  ADD CONSTRAINT `Puntos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `Users` (`user_id`);

--
-- Filtros para la tabla `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `Roles` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
