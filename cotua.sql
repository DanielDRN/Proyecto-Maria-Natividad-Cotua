-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 07-10-2025 a las 23:40:41
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
(6, 'admin', '$2y$10$HH6wOXqyGfsVUT.jPmFvq.PKgH5DTQc7YhghgNS7ZNfrBeRb2DCX6');

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
  `foto` longblob DEFAULT NULL,
  `id_representante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `cedula`, `nombre`, `apellido`, `genero`, `grado_session`, `Fecha_nacimiento`, `foto`, `id_representante`) VALUES
(1, '13744724', 'geiser jose', 'RODRIGUEZ NARVAEZ', 'M', '5to-Grado B', NULL, 0x696d672f657374756469616e7465732f666f746f5f36386133386164343966373535302e31303837383634312e6a706567, 12),
(8, '31949969', 'amira', 'coromoto', 'F', '5to-Grado A', NULL, 0x696d672f657374756469616e7465732f666f746f5f36386133386238336164313965362e35393330343032332e6a706567, 13),
(9, '31949969', 'DANIEL DAVID ABAD', 'RODRIGUEZ NARVAEZ', 'M', '5to-año B', '2004-12-29', NULL, 14),
(10, '1231231', 'daniel', 'rodriguez', 'M', '4to-Grado B', '2025-09-17', 0x696d672f657374756469616e7465732f666f746f5f36386330623138383161306131382e39333334383737352e6a7067, 15),
(11, '28282451', 'Edmari ', 'Maldonado', 'F', '1er-Grado A', '2000-03-02', NULL, 16);

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
(12, '2085242', 'DANIEL DAVID ABAD', 'RODRIGUEZ ', '0287722243', 'yannelysurquia@hotmail', 'm', 'PALOMA LAS PALOMA', 'padre'),
(13, '32910795', 'davier zhaid ilich', 'RODRIGUEZ NARVAEZ', '02877222430', 'zuaidd7@gmail.com', 'm', 'PALOMA LAS PALOMAS', 'madre'),
(14, '13744724', 'Zuiad Dayana', 'Velasquez', '02877222430', 'zuaidd7@gmail.com', 'F', 'PALOMA LAS PALOMAS', 'F'),
(15, '31293123', 'amira', 'coromoto', '0412412', 'danieleldani2029@gmail.com', 'M', 'paloma las palomas', 'M'),
(16, '9860124', 'Mariela Del Valle', 'Tablante Martínez', '04124288475', 'marielatablante@gmail.com', 'F', 'La Perimetral', 'F');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
