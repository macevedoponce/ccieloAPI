-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-03-2024 a las 13:15:16
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

--
-- Volcado de datos para la tabla `Puntos`
--

INSERT INTO `Puntos` (`puntos_id`, `puntos_participacion`, `puntos_asistencia`, `puntos_biblia`, `puntos_fecha`, `id_user`) VALUES
(1, 4, 3, 2, '2024-03-06', 8),
(2, 3, 4, 5, '2024-03-06', 20),
(3, 2, 3, 4, '2024-03-06', 9),
(4, 5, 4, 3, '2024-03-06', 19),
(5, 1, 1, 2, '2024-03-06', 10),
(6, 2, 4, 2, '2024-03-06', 31),
(7, 2, 2, 2, '2024-03-07', 8),
(8, 1, 1, 1, '2024-03-08', 8),
(9, 1, 2, 5, '2024-03-09', 8),
(10, 1, 2, 1, '2024-03-10', 8),
(11, 3, 2, 3, '2024-03-11', 8),
(12, 1, 2, 3, '2024-03-12', 8),
(13, 5, 2, 1, '2024-03-13', 8),
(14, 1, 2, 3, '2024-03-14', 8),
(15, 5, 5, 5, '2024-03-08', 34),
(16, 5, 1, 3, '2024-03-14', 12),
(17, 5, 1, 3, '2024-03-14', 12);

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
(5, 'Miguel Angel', 'Acevedo Ponce', 73122364, '$2y$12$aPYpyelHeC7xpY.N/gldZ.Od86LaOfc2mMQUgrxobh9JYlbx6VudG', NULL, 1),
(6, 'Pedro mora', 'ramos quillatupa', 78945612, '$2y$12$oiHv0S9ZKLUnq1NspNco9OWeJesB8BQaKIyBM8ecXjSEMhWSxdj7a', NULL, 1),
(7, 'Miguel Angel ', 'Acevedo Ponce ', 73122365, '$2y$12$QHjIu5y4bDz5gjPeZNjWCuVr0fMYhOa5fK4SQYdbSI5XdkE/xQnBC', 'https://images.pexels.com/photos/1097456/pexels-photo-1097456.jpeg?cs=srgb&dl=pexels-sebastiaan-stam-1097456.jpg&fm=jpg', 1),
(8, 'Valentina Naomi', 'UCHUYPOMA CHUQUILLANQUI', 12345678, NULL, 'person5', 2),
(9, 'Max Camilo', 'LAZO HIDALGO', 87654321, NULL, 'person2', 2),
(10, 'Fabricio Valentino Jesus', 'MARTINEZ CARDENAS', 1478523, NULL, 'person3', 2),
(11, 'Adrian Lino', 'LAZARTE BAUTISTA', 96325874, NULL, 'person4', 2),
(12, 'Amira Ariadna', 'COCHACHI VELASQUEZ', 95123648, NULL, 'person5', 2),
(13, 'Sofia Ximena', 'CAPCHA CONDOR', 78495126, NULL, 'person6', 2),
(14, 'Sebastian Uriel', 'ASTUHUAMAN JORGE', 73524816, NULL, 'person7', 2),
(15, '1Max Camilo', 'LAZO HIDALGO', 17654321, NULL, 'person8', 2),
(16, '2Max Camilo', 'LAZO HIDALGO', 27654321, NULL, 'person9', 2),
(17, '3Max Camilo', 'LAZO HIDALGO', 37654321, NULL, 'person1', 2),
(18, '4Max Camilo', 'LAZO HIDALGO', 47654321, NULL, 'person2', 2),
(19, '5Max Camilo', 'LAZO HIDALGO', 57654321, NULL, 'person3', 2),
(20, '6Max Camilo', 'LAZO HIDALGO', 67654321, NULL, 'person4', 2),
(21, '7Max Camilo', 'LAZO HIDALGO', 77654321, NULL, 'person5', 2),
(22, '8Max Camilo', 'LAZO HIDALGO', 97654321, NULL, 'person6', 2),
(23, 'michin', 'michin', 36985274, NULL, 'person9', 2),
(24, 'perris', 'perris', 14725836, NULL, 'person5', 2),
(25, 'perris', 'perris', 14725836, NULL, 'person5', 2),
(26, 'perris', 'perris', 14725833, NULL, 'person2', 2),
(27, 'profe', 'apr rpofe', 11111111, NULL, 'person6', 2),
(28, 'profe', 'apr rpofe', 11111111, NULL, 'person6', 2),
(29, 'prueba', 'apellido', 99999999, NULL, 'person7', 2),
(30, 'xiomi', 'p9', 45454545, NULL, 'person3', 2),
(31, 'qwert', 'poiuyt', 12121212, NULL, 'person4', 2),
(32, 'rosita', 'rosita', 98989898, NULL, 'person5', 2),
(34, 'Nathaly Rosa ', 'Gutiérrez Cari', 76457845, NULL, 'person8', 2);

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
  MODIFY `puntos_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `Roles`
--
ALTER TABLE `Roles`
  MODIFY `rol_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
