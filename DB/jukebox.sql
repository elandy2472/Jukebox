-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-08-2024 a las 00:55:00
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
-- Base de datos: `jukebox`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `contraseñaTemporal` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adminempresa`
--

CREATE TABLE `adminempresa` (
  `id` smallint(6) NOT NULL,
  `primer_nombre` varchar(30) NOT NULL,
  `segundo_nombre` varchar(30) DEFAULT NULL,
  `primer_apellido` varchar(30) NOT NULL,
  `segundo_apellido` varchar(30) DEFAULT NULL,
  `correo` varchar(30) NOT NULL,
  `cedula` smallint(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `contraseñaTemporal` varchar(30) DEFAULT NULL,
  `nombre_empresa` varchar(30) NOT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `imagen_verificacion` blob DEFAULT NULL,
  `ciudad` varchar(30) DEFAULT NULL,
  `nit` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` smallint(6) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `aceptarCookies` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listareproduccion`
--

CREATE TABLE `listareproduccion` (
  `id` smallint(6) NOT NULL,
  `estadoReproduccion` varchar(15) NOT NULL,
  `idCliente` smallint(6) DEFAULT NULL,
  `idAdmin` smallint(6) DEFAULT NULL,
  `idAdminEmpresa` smallint(6) DEFAULT NULL,
  `idSala` smallint(6) DEFAULT NULL,
  `cancion` varchar(100) NOT NULL,
  `genero` varchar(30) DEFAULT NULL,
  `artista` varchar(30) DEFAULT NULL,
  `duracion` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `id` smallint(6) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `estadoSala` tinyint(1) NOT NULL,
  `aforoSala` tinyint(4) NOT NULL,
  `idSession` smallint(6) DEFAULT NULL,
  `idListaReproduccion` smallint(6) DEFAULT NULL,
  `idAdmin` smallint(6) DEFAULT NULL,
  `idAdminEmpresa` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `id` smallint(6) NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `idCliente` smallint(6) DEFAULT NULL,
  `idAdmin` smallint(6) DEFAULT NULL,
  `idAdminEmpresa` smallint(6) DEFAULT NULL,
  `idSala` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `adminempresa`
--
ALTER TABLE `adminempresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- Indices de la tabla `listareproduccion`
--
ALTER TABLE `listareproduccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_lista` (`idCliente`),
  ADD KEY `fk_admin_lista` (`idAdmin`),
  ADD KEY `fk_admin_empresa_lista` (`idAdminEmpresa`),
  ADD KEY `fk_sala_lista` (`idSala`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente` (`idCliente`),
  ADD KEY `fk_admin` (`idAdmin`),
  ADD KEY `fk_admin_empresa` (`idAdminEmpresa`),
  ADD KEY `fk_sala` (`idSala`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `adminempresa`
--
ALTER TABLE `adminempresa`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `listareproduccion`
--
ALTER TABLE `listareproduccion`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sala`
--
ALTER TABLE `sala`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `listareproduccion`
--
ALTER TABLE `listareproduccion`
  ADD CONSTRAINT `fk_admin_empresa_lista` FOREIGN KEY (`idAdminEmpresa`) REFERENCES `adminempresa` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_admin_lista` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_cliente_lista` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_sala_lista` FOREIGN KEY (`idSala`) REFERENCES `sala` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_admin_empresa` FOREIGN KEY (`idAdminEmpresa`) REFERENCES `adminempresa` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_sala` FOREIGN KEY (`idSala`) REFERENCES `sala` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
