-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 18-08-2025 a las 16:45:10
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
(2, 'admin', '$2y$10$f9WSe9zzoBMxNrM.1BcN8eunsk.ZfT2hLsyUTZlDYJu6pdioUD2iO'),
(3, 'zuaid0101', '$2y$10$Tc6/W67XRs72R1c3EIlDouS74IJwVGr5hd9AVwiZWDJRRSt4yYQM6'),
(4, 'admin2', '$2y$10$EYnDNj9dp3WJjpdIt76XgewvwMDuf9UPC9iZWBkFK2l4VTGxpzCq2'),
(5, 'dani', '$2y$10$77sXbtmzxB4C69nHRbHDJujQH3MMh6CeuYf1KPDXuxoDMqCKTXw6.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `grado_session` varchar(50) NOT NULL,
  `id_representante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `cedula`, `nombre`, `apellido`, `grado_session`, `id_representante`) VALUES
(4, '12312451', 'geiser jose', 'villahermosa', '4to año Seccion B', 4),
(5, '31949969', 'DANIEL DAVID ABAD', 'RODRIGUEZ NARVAEZ', '4to año Seccion A', 5),
(6, '4127371', 'davier', 'RODRIGUEZ NARVAEZ', '5to año Seccion B', 6);

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
(4, '31949969', 'DANIEL DAVID ABAD', 'RODRIGUEZ NARVAEZ', '02877222430', 'DAVIERELDAVI20@GMAIL.COM', 'M', 'PALOMA LAS PALOMAS', 'Padre'),
(5, '20852421', 'davier zhaid ilich', 'RODRIGUEZ NARVAEZ', '02877222430', 'rfrancismar77@gmail.com', 'M', 'PALOMA LAS PALOMAS', 'Padre'),
(6, '19859367', 'amira chinquinquira', 'Coromoto', '02877222430', 'yannelysurquia@hotmail.com', 'F', 'PALOMA LAS PALOMAS', 'Madre');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
