-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 08-11-2025 a las 02:32:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cotua`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id`, `usuario`, `clave_hash`) VALUES
(11, 'admin', '$2y$10$MhgkJdPuoSYfPAOasdMSYu3jKTOj3OFkAiKNLbZQzYM0YAN0EqcFW'),
(12, 'jose', '$2y$10$H37hSBhH5/okv/FaLv8Ta.a2PMkUDyxYkgamMq2KkijqudCTJC8EC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `genero` varchar(55) DEFAULT NULL,
  `grado_session` varchar(50) NOT NULL,
  `Fecha_nacimiento` date DEFAULT NULL,
  `lug_nacimiento` varchar(150) DEFAULT NULL,
  `TZ` varchar(20) DEFAULT NULL,
  `TC` varchar(20) DEFAULT NULL,
  `TP` varchar(20) DEFAULT NULL,
  `foto` longblob DEFAULT NULL,
  `id_representante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `cedula`, `nombre`, `apellido`, `genero`, `grado_session`, `Fecha_nacimiento`, `lug_nacimiento`, `TZ`, `TC`, `TP`, `foto`, `id_representante`) VALUES
(19, '12312312312', 'amira', 'Rodriguez Narvaez', 'M', '5to-año C', '2025-10-22', 'Ciudad Bolivar', '42', 'M', NULL, 0x696d672f657374756469616e7465732f666f746f5f36393037633337313938386631312e32313236303139322e6a7067, 24),
(21, '214125414', 'federico', 'gutierrez', 'M', '3er-Grado B', '2025-10-28', 'Ciudad Bolivar', '54', 'O', NULL, 0x696d672f657374756469616e7465732f666f746f5f36393035333937326232633530332e36363237303431362e6a7067, 26),
(22, '213123', 'Pene', 'aasdygasd', 'M', '3er-Grado C', '2025-10-13', 'tucupita', '42', 'F', '32', NULL, 26),
(24, '2134124', 'mariaq', 'Rodriguez Narvaez', 'M', '5to-año C', '2025-10-09', 'Ciudad Bolivar', '23', 'L', NULL, NULL, 28),
(25, '12412412', 'Pene', 'comes', 'M', '5to-año C', '2025-10-02', 'tucupita', '42', 'M', '32', 0x696d672f657374756469616e7465732f666f746f5f36393035363966656230643237352e33313534353838352e6a7067, 28),
(26, '214124', 'Daniel David', 'Rodriguez Narvaez', 'M', '1er-Nivel A', '2025-11-05', 'Ciudad Bolivar', '41', 'L', NULL, 0x696d672f657374756469616e7465732f666f746f5f36393037373134343965613165382e34383636393934332e6a7067, 29),
(27, '12461254', 'daniel', 'aasdygasd', 'M', '3er-Grado B', '2025-10-28', 'tucupita', '12', 'S', '32', NULL, 29),
(28, '24123134', 'mariaq', 'Coromoto', 'M', '5to-año C', '2025-11-19', 'Ciudad Bolivar', '94', 'M', NULL, NULL, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

CREATE TABLE `representantes` (
  `id` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `parentesco` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`id`, `cedula`, `nombre`, `apellido`, `telefono`, `correo`, `genero`, `direccion`, `parentesco`) VALUES
(24, '26475819', 'Francisco', 'Agreda', '0412547452', 'danieleldani2020@gmail.com', 'M', 'PALOMA LAS PALOMAS', 'Madre'),
(26, '231241', 'Piña', 'Rodriguez Narvaez', '12412421', 'peneescrotopene@gmail.com', 'M', 'PALOMA LAS PALOMAS', 'Padre'),
(28, '12341241', 'lucas', 'saragoza', '1241231124', 'pene@gmail.com', 'M', 'PALOMA LAS PALOMAS', 'Padre'),
(29, '124124', 'Piña', 'Coromoto', '12412421', 'danieleldani2020@gmail.com', 'M', 'Tucupita', 'Tio'),
(30, '3421354324', 'Piña', 'Coromoto', '0412547452', 'peneescrotopene@gmail.com', 'M', 'PALOMA LAS PALOMAS', 'Padre');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_representante` (`id_representante`);

--
-- Indices de la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`id_representante`) REFERENCES `representantes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
