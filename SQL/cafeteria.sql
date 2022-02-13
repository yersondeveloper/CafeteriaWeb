-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-02-2022 a las 15:39:39
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cafeteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `referencia` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `categoria` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `id_usuario_crea` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Fk_idProducto_idUsuario` (`id_usuario_crea`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `referencia`, `precio`, `peso`, `categoria`, `stock`, `estado`, `id_usuario_crea`, `fecha_creacion`, `fecha_modificacion`) VALUES
(6, 'Yogurt', 'L001', 1000, 120, 'Lacteos', 0, 1, 1, '2022-02-13', '2022-02-13'),
(7, 'Malta', 'G001', 1500, 80, 'Gaseosas', 243, 1, 1, '2022-02-13', '2022-02-13'),
(8, 'Manzana Postobon', 'G002', 1800, 300, 'Gaseosas', 438, 1, 1, '2022-02-13', '2022-02-13'),
(9, 'Leche', 'L002', 800, 80, 'Lacteos', 290, 1, 1, '2022-02-13', '2022-02-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `identificacion` int(11) NOT NULL,
  `password` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificacion` (`identificacion`),
  UNIQUE KEY `id_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `identificacion`, `password`, `id_perfil`, `fecha_creacion`, `fecha_modificacion`, `estado`) VALUES
(1, 'Administrador del sistema', 1128432446, 'Admin1234', 1, '2022-02-12', NULL, 1),
(2, 'Vendedor1', 1128432447, 'Vendedor1', 2, '2022-02-13', '2022-02-13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `numeroFactura` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valorVenta` int(11) NOT NULL,
  `fecha_venta` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_idVenta_idProducto` (`id_producto`),
  KEY `FK_idVenta_idUsuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_producto`, `id_usuario`, `numeroFactura`, `cantidad`, `valorVenta`, `fecha_venta`) VALUES
(1, 8, 1, 1, 20, 36000, '2022-02-13'),
(2, 9, 1, 2, 10, 8000, '2022-02-13'),
(3, 7, 1, 3, 7, 10500, '2022-02-13'),
(4, 6, 1, 4, 20, 20000, '2022-02-13'),
(5, 8, 1, 5, 12, 21600, '2022-02-13'),
(6, 8, 1, 6, 6, 10800, '2022-02-13'),
(7, 8, 1, 7, 9, 16200, '2022-02-13'),
(8, 8, 1, 8, 15, 27000, '2022-02-13');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `Fk_idProducto_idUsuario` FOREIGN KEY (`id_usuario_crea`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `F_idUsuario_idPerfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `FK_idVenta_idProducto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `FK_idVenta_idUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
