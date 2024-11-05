-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-09-2024 a las 20:29:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdconnected`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idAdmin` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellidos` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `Rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdmin`, `Nombre`, `Apellidos`, `Correo`, `Usuario`, `Contraseña`, `Rol`) VALUES
(1, 'Sebastian', 'Restrepo Leon', 'srestrepoleon@gmail.com', 'sebasrl01', '12345', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `Lugar` varchar(100) NOT NULL,
  `Nit` varchar(50) NOT NULL,
  `NumeroContacto` varchar(20) NOT NULL,
  `CorreoContacto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `Lugar`, `Nit`, `NumeroContacto`, `CorreoContacto`) VALUES
(1, 'Amsterdam Plaza', '901921092', '3014889595', 'Amsterdam.plaza@gmail.com'),
(2, 'El Tesoro', '019201921012', '3004810090', 'tesoro.cc@gmail.com'),
(3, 'Viva Envigado', '999000111', '3248819900', 'Viva.SM@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `idTarea` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `Descripcion` text NOT NULL,
  `FechaAsignacion` date NOT NULL,
  `FechaFinalizacion` datetime NOT NULL,
  `Hora` time NOT NULL,
  `Lugar` varchar(100) NOT NULL,
  `Estado` varchar(20) NOT NULL DEFAULT 'Pendiente',
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`idTarea`, `idUsuario`, `Descripcion`, `FechaAsignacion`, `FechaFinalizacion`, `Hora`, `Lugar`, `Estado`, `idCliente`) VALUES
(1, 1, 'Mantenimiento', '2024-08-22', '2024-09-09 19:47:34', '07:00:00', '', 'Finalizada', 3),
(2, 1, 'Cambio de cable de impresora de caja', '2024-08-23', '2024-08-21 19:19:09', '08:00:00', '', 'Pendiente', 2),
(3, 1, 'Cambio de cable de fuente en impresora de sushi', '2024-08-21', '2024-08-21 19:18:10', '09:00:00', '', 'Finalizada', 1),
(4, 1, 'Mantenimiento a impresoras  y tomapedidos', '2024-08-30', '0000-00-00 00:00:00', '09:00:00', '', 'Pendiente', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellidos` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `Rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Nombre`, `Apellidos`, `Correo`, `Usuario`, `Contraseña`, `Rol`) VALUES
(1, 'Jhoan', 'Restrepo Leon', 'Jhoan@gmail.com', 'Jhoan01', '12345', 'Usuario'),
(2, 'Carlos', 'Bustamante', 'Car.Bte@gmail.com', 'Carlos01', '12345', 'Usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdmin`),
  ADD UNIQUE KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`idTarea`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `Usuario` (`Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `idTarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
