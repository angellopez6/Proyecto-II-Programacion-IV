-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2020 a las 02:38:05
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `ID` int(10) NOT NULL,
  `CATEGORIA` varchar(30) NOT NULL,
  `DESCRIPCION` varchar(30) NOT NULL,
  `FECHA_CREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `FECHA_ACTUALIZACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `STATUS` varchar(30) NOT NULL,
  `USUARIO_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`ID`, `CATEGORIA`, `DESCRIPCION`, `FECHA_CREACION`, `FECHA_ACTUALIZACION`, `STATUS`, `USUARIO_ID`) VALUES
(1, 'Trabajos', 'Entregar Proyecto de Programac', '2020-06-27 00:23:13', '2020-06-27 00:23:13', 'En Proceso', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_archivadas`
--

CREATE TABLE `tareas_archivadas` (
  `ID` int(10) NOT NULL,
  `CATEGORIA` varchar(30) NOT NULL,
  `DESCRIPCION` varchar(30) NOT NULL,
  `FECHA_CREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `FECHA_ACTUALIZACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `FECHA_ELIMINACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `STATUS` varchar(30) NOT NULL,
  `USUARIO_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_pass`
--

CREATE TABLE `usuarios_pass` (
  `ID` int(11) NOT NULL,
  `USUARIOS` varchar(20) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ROL` int(1) NOT NULL,
  `NOMBRE` varchar(20) NOT NULL,
  `APELLIDO` varchar(20) NOT NULL,
  `CORREO` varchar(50) NOT NULL,
  `PROFESION` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_pass`
--

INSERT INTO `usuarios_pass` (`ID`, `USUARIOS`, `PASSWORD`, `ROL`, `NOMBRE`, `APELLIDO`, `CORREO`, `PROFESION`) VALUES
(1, 'Angel', '$2y$12$bwZfLXd.1K2nw0JFJWNtReGAg0XioqdXxnyXiM7fh6vm4yGEJhbNO', 1, 'Angel Miguel', 'Salazar Lopez', 'lopezangel025@hotmail.com', 'Estudiante de Ingeniería '),
(2, 'Hiram', '$2y$12$S/NdplSuhawKJX/IpoxvgeRQR1rTO84TVGnDA1l9SYOSGThuyj8bi', 1, 'Hiram', 'Gonzales', 'hgonzalez.4832@unimar.edu.ve', 'Ingeniero de Sistemas'),
(3, 'Oswaldo', '$2y$12$17d5WrL.YqUTi395KGxLaeFHZe9UntKXfxzvigf.AgWDfkgU2j8MS', 1, 'Oswaldo', 'Bellorin', 'oswald@gmail.com', 'Estudiante de Ingeniería'),
(4, 'Manuel', '$2y$12$fNjzNGN/HU2aBvjYnlwjeOA447A7NcrKagmIiArnjRZUFvuX4esX2', 1, 'Manuel', 'Pereira', 'Mp@hotmail.com', 'Estudiante de Ingeniería'),
(5, 'HiramUser', '$2y$12$quBiiBM/oyOAR2GPHdN6EOjyUzJtg0gyx9XeYhCN2PI.NIOEmnUZ6', 2, 'Hiram', 'Gonzales', 'hgonzalez.4832@unimar.edu.ve', 'Ingeniero de Sistemas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_pass_archivados`
--

CREATE TABLE `usuarios_pass_archivados` (
  `ID` int(11) NOT NULL,
  `USUARIOS` varchar(20) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ROL` int(1) NOT NULL,
  `NOMBRE` varchar(20) NOT NULL,
  `APELLIDO` varchar(20) NOT NULL,
  `CORREO` varchar(50) NOT NULL,
  `PROFESION` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIO_ID` (`USUARIO_ID`);

--
-- Indices de la tabla `tareas_archivadas`
--
ALTER TABLE `tareas_archivadas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIOS_ID` (`USUARIO_ID`);

--
-- Indices de la tabla `usuarios_pass`
--
ALTER TABLE `usuarios_pass`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indices de la tabla `usuarios_pass_archivados`
--
ALTER TABLE `usuarios_pass_archivados`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios_pass`
--
ALTER TABLE `usuarios_pass`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios_pass_archivados`
--
ALTER TABLE `usuarios_pass_archivados`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`USUARIO_ID`) REFERENCES `usuarios_pass` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
