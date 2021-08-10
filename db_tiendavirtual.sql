-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-08-2021 a las 05:24:01
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del Sistema', 1),
(3, 'Clientes', 'Clientes de la tienda', 1),
(4, 'Productos', 'Todos los productos', 1),
(5, 'Pedidos', 'Pedidos', 1),
(6, 'Categorías', 'Cateforías Productos', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=552 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(384, 14, 1, 1, 0, 0, 0),
(385, 14, 2, 0, 0, 0, 0),
(386, 14, 3, 0, 0, 0, 0),
(387, 14, 4, 0, 0, 0, 0),
(388, 14, 5, 0, 0, 0, 0),
(389, 14, 6, 0, 0, 0, 0),
(516, 16, 1, 1, 0, 0, 0),
(517, 16, 2, 1, 0, 0, 0),
(518, 16, 3, 1, 1, 1, 1),
(519, 16, 4, 0, 0, 0, 0),
(520, 16, 5, 0, 0, 0, 0),
(521, 16, 6, 0, 0, 0, 0),
(546, 1, 1, 1, 0, 0, 0),
(547, 1, 2, 1, 1, 1, 1),
(548, 1, 3, 1, 1, 1, 1),
(549, 1, 4, 1, 0, 0, 0),
(550, 1, 5, 1, 0, 0, 0),
(551, 1, 6, 1, 0, 0, 0);

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
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `rolid` bigint NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpersona`),
  KEY `rolid` (`rolid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `identificacion`, `nombres`, `apellidos`, `telefono`, `email_user`, `password`, `nit`, `nombrefiscal`, `direccionfiscal`, `token`, `rolid`, `datecreated`, `status`) VALUES
(1, '75492652', 'Yoexer Elias', 'Moran Urcia', 933212236, 'yoexer@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '24252622', 'Elias', 'Santa Rosa', '', 1, '2021-06-16 00:32:17', 1),
(2, '54678678', 'Daniel Abraham', 'Moran Urcia', 655678435, 'daniel@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '', '', 15, '2021-06-16 00:37:03', 2),
(3, '71676543', 'Angie Danitza', 'Moran Urcia', 644838383, 'angie@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '345434', 'Angie M', 'Santa Rosa', '', 16, '2021-06-17 13:14:34', 1),
(4, '75649273', 'Kiara', 'Moran', 944373845, 'kiara@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '3534554643', 'Kiara Moran Urcia', 'Santa Rosa', '', 1, '2021-06-17 13:18:59', 1),
(5, '8756567', 'Cristobal Daniel', 'Moran Sanchez', 954678076, 'danilo@info.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '35345', 'Danilo', 'Santa Rosa', '8185cc618b9583dd1172-8bcc98f43471ffcbd91f-4778d05953132fc90db0-b32189c05362fde594b3', 1, '2021-06-18 13:36:04', 1),
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
(16, '899329328', 'Kevin', 'Arana', 34323234324, 'kevin@gmail.com', 'bfa951ec0419f8ac675f9cd80ed30fc647327c670adca6c6c62f135e6abab5fb', '', '', '', '', 14, '2021-06-21 14:33:44', 0),
(17, '24323423', 'Francisco', 'Jimenez', 354567895, 'francisco@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', '', '', '', 25, '2021-07-16 01:46:41', 1),
(18, '45355443', 'Alan', 'Estrada', 933456435, 'sdsd@gmail.com', 'b99b08fadf78ea9276a9ab14e5a388825b2161677f97950d40dfd541cedeb213', '', '', '', '', 16, '2021-07-20 20:26:45', 1),
(19, '455344554', 'Alan', 'Arenales', 34567567, 'alan@info.com', '3ecc87460a20bcaf0f7a0393b3e14f8689d95f52d36063bc861e64a5f613da79', 'cf', 'Alan', 'JLO', '', 23, '2021-08-03 13:51:42', 0),
(20, '12121212', 'Carlos Daniel', 'Cabrera', 966785675, 'carlos@info.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'car', 'Carlos s', 'Cix', '', 23, '2021-08-03 16:58:59', 1),
(21, '4323536776', 'Pablo', 'Herrera', 877658987, 'pablo@gmail.com', '9d140953351a9b7d282721369d323e818e27a938b3a9cdd3e65516813bef67a9', '4354', 'Pablo', 'Chiclayo', '', 23, '2021-08-04 11:12:29', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Acceso a todo el sistema', 1),
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
(14, 'Jefe', 'Es el dueño de la tienda virtual en la empresa', 1),
(15, 'Supervisor', 'Vigila todas las acciones de la empresa y de la tienda', 1),
(16, 'Vendedor 1', 'Se encarga de vender productos de la tienda en el sistema', 1),
(17, 'Vendedor 2', 'Es el reemplazante del primer vendedor 2', 1),
(18, 'rol para eliminar', 'este es un rol que va a ser eliminado', 0),
(19, 'usuario a eliminad', 'vwvevew', 0),
(20, 'Corregidor', 'Actualiza las ventas y atiende las quejas del cliente de venta', 1),
(21, 'Coordinador', 'Coordinador', 0),
(22, 'Vendedor 3', 'Vendedor para conseguir', 2),
(23, 'Clientes', 'Consumidores fieles a la tienda', 1),
(24, 'Consulta ventas', 'Consulta ventas', 0),
(25, 'Consultor', 'Consultor', 1),
(26, 'Programador', 'Programador', 1),
(27, 'Visitantes', 'Visitantes de la empresa', 1),
(28, 'Operador', 'Operador', 1),
(29, 'Terminal 2', 'Terminal 2', 1),
(30, 'Participante', 'Participante', 1);

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
