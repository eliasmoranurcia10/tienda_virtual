-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-06-2021 a las 02:51:24
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tiendavirtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` bigint NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `pedidoid` bigint NOT NULL,
  `productoid` bigint NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidoid` (`pedidoid`),
  KEY `productoid` (`productoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

DROP TABLE IF EXISTS `detalle_temp`;
CREATE TABLE IF NOT EXISTS `detalle_temp` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `productoid` bigint NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productoid` (`productoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

DROP TABLE IF EXISTS `modulo`;
CREATE TABLE IF NOT EXISTS `modulo` (
  `idmodulo` bigint NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmodulo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del Sistema', 1),
(3, 'Clientes', 'Clientes de la tienda', 1),
(4, 'Productos', 'Todos los productos', 1),
(5, 'Pedidos', 'Pedidos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `idpedido` bigint NOT NULL AUTO_INCREMENT,
  `personaid` bigint NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `monto` decimal(11,2) NOT NULL,
  `tipopagoid` bigint NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpedido`),
  KEY `personaid` (`personaid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `idpermiso` bigint NOT NULL AUTO_INCREMENT,
  `rolid` bigint NOT NULL,
  `moduloid` bigint NOT NULL,
  `r` int NOT NULL DEFAULT '0',
  `w` int NOT NULL DEFAULT '0',
  `u` int NOT NULL DEFAULT '0',
  `d` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpermiso`),
  KEY `rolid` (`rolid`),
  KEY `moduloid` (`moduloid`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(46, 16, 1, 1, 1, 0, 0),
(47, 16, 2, 1, 1, 0, 0),
(48, 16, 3, 1, 1, 0, 0),
(49, 16, 4, 1, 1, 0, 0),
(50, 16, 5, 1, 1, 0, 0),
(81, 14, 1, 1, 1, 1, 1),
(82, 14, 2, 1, 1, 1, 1),
(83, 14, 3, 1, 1, 1, 1),
(84, 14, 4, 1, 1, 1, 1),
(85, 14, 5, 1, 1, 1, 1),
(86, 15, 1, 1, 0, 0, 0),
(87, 15, 2, 0, 0, 0, 0),
(88, 15, 3, 1, 1, 0, 0),
(89, 15, 4, 1, 1, 1, 1),
(90, 15, 5, 1, 0, 1, 0),
(106, 23, 1, 1, 1, 1, 1),
(107, 23, 2, 0, 0, 0, 0),
(108, 23, 3, 0, 0, 0, 0),
(109, 23, 4, 1, 0, 0, 0),
(110, 23, 5, 0, 0, 0, 0),
(116, 20, 1, 0, 0, 0, 0),
(117, 20, 2, 0, 0, 0, 0),
(118, 20, 3, 1, 1, 1, 1),
(119, 20, 4, 1, 0, 1, 1),
(120, 20, 5, 1, 1, 1, 1),
(126, 17, 1, 1, 1, 0, 0),
(127, 17, 2, 1, 1, 0, 0),
(128, 17, 3, 1, 1, 1, 1),
(129, 17, 4, 1, 1, 1, 1),
(130, 17, 5, 1, 1, 1, 0),
(131, 26, 1, 1, 1, 1, 1),
(132, 26, 2, 1, 1, 1, 1),
(133, 26, 3, 1, 1, 1, 1),
(134, 26, 4, 1, 1, 1, 1),
(135, 26, 5, 1, 1, 1, 1),
(136, 22, 1, 1, 1, 1, 1),
(137, 22, 2, 0, 0, 0, 0),
(138, 22, 3, 0, 0, 0, 0),
(139, 22, 4, 0, 0, 0, 0),
(140, 22, 5, 0, 0, 0, 0),
(156, 27, 1, 1, 1, 1, 1),
(157, 27, 2, 1, 0, 0, 0),
(158, 27, 3, 1, 0, 0, 0),
(159, 27, 4, 1, 0, 0, 0),
(160, 27, 5, 1, 0, 0, 0),
(161, 25, 1, 1, 0, 0, 0),
(162, 25, 2, 0, 1, 1, 0),
(163, 25, 3, 0, 0, 0, 0),
(164, 25, 4, 0, 0, 0, 1),
(165, 25, 5, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `idpersona` bigint NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombres` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telefono` bigint NOT NULL,
  `email_user` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `nit` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombrefiscal` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `direccionfiscal` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `token` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `rolid` bigint NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpersona`),
  KEY `rolid` (`rolid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `identificacion`, `nombres`, `apellidos`, `telefono`, `email_user`, `password`, `nit`, `nombrefiscal`, `direccionfiscal`, `token`, `rolid`, `datecreated`, `status`) VALUES
(1, '75492652', 'Yoexer Elias', 'Moran Urcia', 933212236, 'yoexer@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', '', '', '', 26, '2021-06-16 00:32:17', 1),
(2, '75928485', 'Daniel', 'Moran Urcia', 944738984, 'daniel@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', '', '', '', 25, '2021-06-16 00:37:03', 1),
(3, '83647584', 'Angie', 'Moran', 644838383, 'angie@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '', '', '', '', 16, '2021-06-17 13:14:34', 2),
(4, '75649273', 'Kiara', 'Moran', 944373845, 'kiara@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '', '', '', '', 17, '2021-06-17 13:18:59', 2),
(5, '8756567', 'Danilo', 'Moran', 954678076, 'danilo@info.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', '', '', '', 14, '2021-06-18 13:36:04', 2),
(6, '7563892', 'Maria', 'Urcia', 736273849, 'maria@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', '', '', '', 14, '2021-06-18 21:01:48', 0),
(7, '42433456', 'Maria', 'Urcia', 544678467, 'mariau@gmail.com', 'b31a2a679a901270d2090b7e7732ce8828a770213a113978a125511f237a2b0f', '', '', '', '', 14, '2021-06-19 02:32:58', 0),
(8, '87327382', 'Alex', 'Custodio', 399484958, 'alex@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '', '', '', '', 23, '2021-06-19 21:02:29', 0),
(9, '434544345', 'Yoja', 'Arroyo', 234456543, 'yoja@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', '', '', '', 23, '2021-06-19 21:05:14', 0),
(10, '98672635', 'Jhon', 'Castro', 933212746, 'jhon@gmail.com', '114bd151f8fb0c58642d2170da4ae7d7c57977260ac2cc8905306cab6b2acabc', '', '', '', '', 23, '2021-06-19 21:16:16', 0),
(11, '98364785', 'Jose', 'Llontop', 746728938, 'alexll@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', '', '', '', 23, '2021-06-19 21:21:07', 0),
(12, '83794903', 'Deivi', 'Agapito', 944858940, 'deivi@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', '', '', '', 27, '2021-06-19 22:45:05', 0),
(13, '83738374', 'Asael', 'Bernal', 544567543, 'asael@gmail.com', '6f2fbeed0ab6fed112df71b65aded248cb86cd9b20de840b5bffe44812a1056f', '', '', '', '', 27, '2021-06-19 22:50:30', 0),
(14, '345766787', 'Abel', 'OS', 966356365, 'ab@info', 'eb49c49cfa5f0177a139147a3c3ea0b7e2cc05bc6d36c4ac39e944cd55ed1e4f', '', '', '', '', 14, '2021-06-21 14:21:56', 0),
(15, '76908378', 'Judas', 'Betarzo', 944594485, 'judas@inf.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '', '', '', '', 15, '2021-06-21 14:30:44', 0),
(16, '899329328', 'Kevin', 'Arana', 34323234324, 'kevin@gmail.com', 'bfa951ec0419f8ac675f9cd80ed30fc647327c670adca6c6c62f135e6abab5fb', '', '', '', '', 14, '2021-06-21 14:33:44', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` bigint NOT NULL AUTO_INCREMENT,
  `categoriaid` bigint NOT NULL,
  `codigo` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `stock` int NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idproducto`),
  KEY `categoriaid` (`categoriaid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `idrol` bigint NOT NULL AUTO_INCREMENT,
  `nombrerol` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Encargados', 'Encargados', 0),
(2, 'Supervisores', 'Supervisores', 0),
(4, 'Vendedores', 'Vendedores', 0),
(5, 'ejemplo 1', 'descripcion ejemplo 1', 0),
(6, 'Ejemplo 2', 'Descripción ejemplo 2', 0),
(7, 'Cajeros', 'Ejemplo de cajero', 0),
(8, 'Guardian', 'hola como estás', 0),
(9, 'Cajero nuevo 02', 'este es el reemplazo dale', 0),
(10, '', '', 0),
(11, 'Cajero 03', 'este es el reemplazo del cajero 02', 0),
(12, 'Supervisores 02', 'los reemplazos de los Supervisores', 0),
(13, 'Reportería', 'Este es un reporttero 2', 0),
(14, 'Jefe', 'Es el dueño de la tienda virtual', 1),
(15, 'Supervisor', 'Vigila todas las acciones de la empresa y de la tienda', 1),
(16, 'Vendedor 1', 'Se encarga de vender productos de la tienda en el sistema', 1),
(17, 'Vendedor 2', 'Es el reemplazante del primer vendedor 1', 2),
(18, 'rol para eliminar', 'este es un rol que va a ser eliminado', 0),
(19, 'usuario a eliminad', 'vwvevew', 0),
(20, 'Corregidor', 'Actualiza las ventas y atiende las quejas del cliente de venta', 1),
(21, 'Coordinador', 'Coordinador', 0),
(22, 'Vendedor 3', 'Vendedor para conseguir', 2),
(23, 'Clientes', 'Consumidores fieles a la tienda', 2),
(24, 'Consulta ventas', 'Consulta ventas', 0),
(25, 'Administrador', 'Administrador', 1),
(26, 'Programador', 'Programador', 1),
(27, 'Visitantes', 'Visitantes de la empresa', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`personaid`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoriaid`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
