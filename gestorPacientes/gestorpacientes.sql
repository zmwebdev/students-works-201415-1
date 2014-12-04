-- phpMyAdmin SQL Dump
-- version 4.0.10.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.2.118.2:3306
-- Tiempo de generación: 12-11-2014 a las 08:06:05
-- Versión del servidor: 5.5.37
-- Versión de PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gestorpacientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE IF NOT EXISTS `pacientes` (
  `dni_medico` varchar(9) NOT NULL,
  `dni_paciente` varchar(9) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `localidad` varchar(20) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `historial` varchar(250) NOT NULL,
  PRIMARY KEY (`dni_medico`,`dni_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `password` varchar(12) NOT NULL,
  `localidad` varchar(20) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `apellidos`, `password`, `localidad`, `telefono`, `tipo`) VALUES
('12345678R', 'r', 'r', 'rrrrrr', 'r', '111111111', 'medico');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`dni_medico`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
