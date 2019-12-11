-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-09-2019 a las 06:08:27
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `subasta_anuncio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

CREATE TABLE `anuncio` (
  `anuncio_id` int(11) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `titulo_ingles` varchar(60) NOT NULL,
  `titulo_arabe` varchar(60) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `descrip_ingles` varchar(80) NOT NULL,
  `descrip_arabe` varchar(80) NOT NULL,
  `precio` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `whatsapp` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subcate_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `lng` varchar(64) NOT NULL,
  `lat` varchar(64) NOT NULL,
  `ciudad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anuncio`
--

INSERT INTO `anuncio` (`anuncio_id`, `titulo`, `titulo_ingles`, `titulo_arabe`, `descripcion`, `descrip_ingles`, `descrip_arabe`, `precio`, `photo`, `whatsapp`, `user_id`, `subcate_id`, `is_active`, `lng`, `lat`, `ciudad_id`) VALUES
(14, 'carro usado ', '', '', 'este es un anuncio', '', '', 1000, './uploads/anuncio/1568687944.jpg', 998724637, 3, 7, 1, '-78.4678382', '-0.1806532', 4),
(17, 'sistemas de Información ', '', '', 'prueba', '', '', 1000, './uploads/anuncio/1568734227.jpg', 2147483647, 3, 7, 1, '-67.0345443', '10.349223', 14),
(19, 'DataLabCenter', '', '', 'prueba', '', '', 2000, './uploads/anuncio/1568820529.jpg', 998724637, 3, 11, 1, '-69.28188399999999', '10.0627257', 13),
(20, 'Titulo de prueba', '', '', 'hola', '', '', 52, './uploads/anuncio/1568964515.jpg', 2147483647, 3, 8, 1, '-78.47624960747072', '-0.16937383293382885', 4),
(21, 'Carro bonito', '', '', 'esta es un carro', '', '', 2500, './uploads/anuncio/1569002850.png', 980562425, 3, 13, 1, '-79.00426094921261', '-2.9043040435444456', 5),
(22, 'carrtio de salchipapas', '', '', 'hola', '', '', 500, './uploads/anuncio/1569018632.png', 2147483647, 4, 12, 1, '-78.4964977215958', '-0.18921378363341423', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `foto` varchar(70) NOT NULL,
  `is_active` int(11) NOT NULL,
  `url` varchar(120) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `titulo_ingles` varchar(100) NOT NULL,
  `titulo_arabe` varchar(100) NOT NULL,
  `subtitulo` varchar(100) NOT NULL,
  `subti_ingles` varchar(100) NOT NULL,
  `subti_arabe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banner`
--

INSERT INTO `banner` (`banner_id`, `foto`, `is_active`, `url`, `titulo`, `titulo_ingles`, `titulo_arabe`, `subtitulo`, `subti_ingles`, `subti_arabe`) VALUES
(3, './uploads/banner/1569015979.jpg', 1, 'https://datalabcenter.com', 'Espacio disponible para publicidad', '', '', '¡Busque entre los mayores clasificados y publique clasificados ilimitados gratis!', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `name_espa` varchar(60) NOT NULL,
  `name_ingles` varchar(60) NOT NULL,
  `name_arabe` varchar(60) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `name_espa`, `name_ingles`, `name_arabe`, `photo`, `is_active`) VALUES
(19, 'vehiculos nuevos', '', '', './uploads/categoria/1569001734.png', 1),
(20, 'telefonos', '', '', './uploads/categoria/1568831507.png', 1),
(21, 'computadoras', '', '', './uploads/categoria/1568831708.png', 1),
(22, 'Herramientas ', '', '', './uploads/categoria/1568831730.png', 1),
(24, 'Ropa', '', '', './uploads/categoria/1568831764.png', 1),
(25, 'juguetes', '', '', './uploads/categoria/1568831814.png', 1),
(26, 'mobiliario', '', '', './uploads/categoria/1568831830.png', 1),
(27, 'Maletas', '', '', './uploads/categoria/1568831843.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cate_anuncio`
--

CREATE TABLE `cate_anuncio` (
  `cate_anuncio_id` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `nombre_ingles` varchar(100) NOT NULL,
  `nombre_arabe` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cate_anuncio`
--

INSERT INTO `cate_anuncio` (`cate_anuncio_id`, `nombre`, `nombre_ingles`, `nombre_arabe`, `photo`, `is_active`) VALUES
(4, 'Computacion', '', '', './uploads/cate_anuncio/1569001782.png', 1),
(7, 'Locales ', '', '', './uploads/cate_anuncio/1568070353.jpg', 1),
(8, 'categoria de prueba', '', '', './uploads/cate_anuncio/1569001851.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `ciudad_id` int(11) NOT NULL,
  `name_ciudad` varchar(100) NOT NULL,
  `name_ingles` varchar(100) NOT NULL,
  `name_arabe` varchar(100) NOT NULL,
  `pais_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`ciudad_id`, `name_ciudad`, `name_ingles`, `name_arabe`, `pais_id`) VALUES
(4, 'Quito', '', '', 4),
(5, 'Cuenca', '', '', 4),
(6, 'Santiago de Chicle', '', '', 5),
(10, 'Manta', '', '', 4),
(13, 'barquisimeto', '', '', 2),
(14, 'caracas', '', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresa_id` int(11) NOT NULL,
  `nombre` varchar(65) NOT NULL,
  `email` varchar(64) NOT NULL,
  `sobre_nosotros` text NOT NULL,
  `imagen` varchar(120) NOT NULL,
  `mision` text NOT NULL,
  `vision` text NOT NULL,
  `facebook` varchar(64) NOT NULL,
  `instagram` varchar(64) NOT NULL,
  `youtube` varchar(64) NOT NULL,
  `video` varchar(64) NOT NULL,
  `direccion` varchar(128) NOT NULL,
  `telefonos` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `nombre`, `email`, `sobre_nosotros`, `imagen`, `mision`, `vision`, `facebook`, `instagram`, `youtube`, `video`, `direccion`, `telefonos`) VALUES
(1, 'Subasta y Anuncios', 'pedroduran014@gmail.com', 'somos una empresa de calidad', '', 'esta es la mision', 'esta es la vision', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.youtube.com', '', 'Luis Cordero, Quito, Ecuador', '(+593) 993705837 - 022260388 - 022260454 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia`
--

CREATE TABLE `membresia` (
  `membresia_id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `nombre_ingles` varchar(60) NOT NULL,
  `nombre_arabe` varchar(60) NOT NULL,
  `precio` float NOT NULL,
  `cant_anuncio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `membresia`
--

INSERT INTO `membresia` (`membresia_id`, `nombre`, `nombre_ingles`, `nombre_arabe`, `precio`, `cant_anuncio`) VALUES
(1, 'Plan Oro', '', '', 600, 100),
(2, 'Plan Premiun ', '', '', 800, 200),
(3, 'Plan Empresarial ', '', '', 1000, 360),
(4, 'Plan Gratis ', '', '', 0, 50),
(5, 'Super', '', '', 2500, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia_user`
--

CREATE TABLE `membresia_user` (
  `membre_user_id` int(11) NOT NULL,
  `membresia_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `anuncios_publi` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `membresia_user`
--

INSERT INTO `membresia_user` (`membre_user_id`, `membresia_id`, `user_id`, `anuncios_publi`, `fecha`) VALUES
(7, 2, 1, 0, '2019-09-20'),
(8, 2, 1, 0, '2019-09-20'),
(9, 2, 3, 0, '2019-09-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `mensaje_id` int(11) NOT NULL,
  `email` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` text COLLATE utf8_spanish_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`mensaje_id`, `email`, `name`, `mensaje`, `is_active`, `fecha_creacion`) VALUES
(1, 'pedro@datalabcenter.com', 'pedro duran', 'hola', 1, '2019-09-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `pais_id` int(11) NOT NULL,
  `name_pais` varchar(100) NOT NULL,
  `name_pais_ingles` varchar(100) NOT NULL,
  `name_pais_arabe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`pais_id`, `name_pais`, `name_pais_ingles`, `name_pais_arabe`) VALUES
(2, 'Venezuela', '', ''),
(4, 'Ecuador ', '', ''),
(5, 'chile', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photo_anuncio`
--

CREATE TABLE `photo_anuncio` (
  `photo_anuncio_id` int(11) NOT NULL,
  `photo_anuncio` varchar(120) NOT NULL,
  `anuncio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `photo_anuncio`
--

INSERT INTO `photo_anuncio` (`photo_anuncio_id`, `photo_anuncio`, `anuncio_id`) VALUES
(1, './uploads/photo_anuncio/1568305621.jpg', 9),
(2, './uploads/photo_anuncio/1568305662.jpg', 9),
(4, './uploads/photo_anuncio/1568310229.jpg', 10),
(5, './uploads/photo_anuncio/1568310337.png', 10),
(6, './uploads/photo_anuncio/1568310607.jpg', 10),
(7, './uploads/photo_anuncio/1568762433.jpg', 16),
(8, './uploads/photo_anuncio/1568820546.jpg', 19),
(9, './uploads/photo_anuncio/1568820584.jpg', 17),
(10, './uploads/photo_anuncio/1568964694.jpg', 14),
(11, './uploads/photo_anuncio/1569002889.png', 14),
(12, './uploads/photo_anuncio/1569018654.jpg', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photo_subasta`
--

CREATE TABLE `photo_subasta` (
  `photo_id` int(11) NOT NULL,
  `subasta_id` int(11) NOT NULL,
  `url_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `photo_subasta`
--

INSERT INTO `photo_subasta` (`photo_id`, `subasta_id`, `url_photo`) VALUES
(11, 8, './uploads/photo/1568739648.png'),
(17, 7, './uploads/photo/1567710442.jpg'),
(18, 7, './uploads/photo/1567710373.jpg'),
(19, 7, './uploads/photo/1567710452.gif'),
(20, 7, './uploads/photo/1567710462.png'),
(21, 8, './uploads/photo/1567710489.png'),
(23, 8, './uploads/photo/1567710513.jpg'),
(24, 11, './uploads/photo/1568762270.jpg'),
(25, 11, './uploads/photo/1568762277.jpg'),
(26, 13, './uploads/photo/1568762311.jpg'),
(27, 12, './uploads/photo/1568817514.jpg'),
(29, 13, './uploads/photo/1568817558.jpg'),
(30, 14, './uploads/photo/1568817575.jpg'),
(31, 14, './uploads/photo/1568817592.jpg'),
(32, 15, './uploads/photo/1568817609.jpg'),
(33, 12, './uploads/photo/1568818713.jpg'),
(34, 17, './uploads/photo/1568835054.jpg'),
(35, 18, './uploads/photo/1568835070.jpg'),
(36, 19, './uploads/photo/1568835081.jpg'),
(37, 19, './uploads/photo/1568835090.jpg'),
(38, 17, './uploads/photo/1568835103.jpg'),
(39, 24, './uploads/photo/1568835123.jpg'),
(40, 21, './uploads/photo/1568835138.jpg'),
(41, 22, './uploads/photo/1568835153.jpg'),
(43, 22, './uploads/photo/1569017671.png'),
(44, 22, './uploads/photo/1569278177.jpg'),
(45, 22, './uploads/photo/1569278185.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puja`
--

CREATE TABLE `puja` (
  `puja_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `valor` float NOT NULL,
  `subasta_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puja`
--

INSERT INTO `puja` (`puja_id`, `fecha_hora`, `valor`, `subasta_user_id`) VALUES
(1, '2019-09-24 21:56:10', 501, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`role_id`, `name`) VALUES
(1, 'administrador'),
(2, 'cliente '),
(3, 'subastadores '),
(4, 'usuario no autenticado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subasta`
--

CREATE TABLE `subasta` (
  `subasta_id` int(11) NOT NULL,
  `nombre_espa` varchar(60) NOT NULL,
  `nombre_ingles` varchar(60) NOT NULL,
  `nombre_arabe` varchar(60) NOT NULL,
  `descrip_espa` text NOT NULL,
  `descrip_ingles` text NOT NULL,
  `descrip_arabe` text NOT NULL,
  `valor_inicial` float NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `valor_pago` float NOT NULL,
  `is_open` int(11) NOT NULL,
  `ciudad_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subasta`
--

INSERT INTO `subasta` (`subasta_id`, `nombre_espa`, `nombre_ingles`, `nombre_arabe`, `descrip_espa`, `descrip_ingles`, `descrip_arabe`, `valor_inicial`, `fecha_cierre`, `user_id`, `categoria_id`, `photo`, `valor_pago`, `is_open`, `ciudad_id`, `is_active`) VALUES
(17, '1 Venta de Vehiculos ', '', '', 'venta de vehiculos cero kilometros, con todo incluido.', '', '', 500, '2019-09-28 00:00:00', 2, 19, './uploads/subasta/1568907953.jpg', 1500, 1, 4, 1),
(18, '2 venta de Celulares', '', '', 'venta de equipos moviles', '', '', 500, '2019-09-21 00:00:00', 2, 20, './uploads/subasta/1568907969.jpg', 800, 1, 6, 1),
(19, '3 computadoras', '', '', '<p>venta de computadoras</p>', '', '', 500, '2019-09-29 00:00:00', 2, 21, './uploads/subasta/1568834807.jpg', 1500, 1, 13, 1),
(20, '4 herramientas', '', '', '<p>venta de herramientas nuevas</p>', '', '', 500, '2019-09-29 00:00:00', 2, 22, './uploads/subasta/1568908044.jpg', 9000, 1, 14, 1),
(21, '5 ropa de buena calidad', '', '', '<p>venta de ropa</p>', '', '', 500, '2019-09-29 00:00:00', 2, 24, './uploads/subasta/1568908002.jpg', 6000, 1, 4, 1),
(22, '6 juguetes', '', '', '<p>venta de juguetes</p>', '', '', 500, '2019-09-29 00:00:00', 2, 25, './uploads/subasta/1568908059.jpg', 800, 1, 5, 1),
(23, '7 mobiliario', '', '', '<p>venta de casa</p>', '', '', 500, '2019-09-21 00:00:00', 2, 26, './uploads/subasta/1568908105.jpg', 9880, 1, 6, 1),
(24, '8 nueva subasta ', '', '', '<p>venta de relojes</p>', '', '', 500, '2019-09-27 00:00:00', 2, 27, './uploads/subasta/1568908122.jpg', 70000, 1, 4, 1),
(26, '9 asasa', '', '', '<p>aa</p>', '', '', 500, '2019-09-07 00:00:00', 3, 19, './uploads/subasta/1568928797.png', 100, 1, 4, 0),
(27, '10 otra ', '', '', '<p>hola</p>', '', '', 1200, '2019-09-13 00:00:00', 3, 19, './uploads/subasta/1568930650.png', 100, 1, 4, 1),
(28, '11 nombre subasta de prueba', '', '', '<p>hola prueba</p>', '', '', 500, '2019-09-30 00:00:00', 2, 21, './uploads/subasta/1569001928.png', 50, 0, 4, 1),
(29, '12 prueba', '', '', '<p>hola</p>', '', '', 1200, '2019-12-24 08:34:44', 4, 20, './uploads/subasta/1569023913.png', 100, 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subasta_user`
--

CREATE TABLE `subasta_user` (
  `subasta_user_id` int(11) NOT NULL,
  `subasta_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subasta_user`
--

INSERT INTO `subasta_user` (`subasta_user_id`, `subasta_id`, `user_id`, `is_active`) VALUES
(1, 17, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_categoria`
--

CREATE TABLE `sub_categoria` (
  `subcate_id` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `nombre_ingles` varchar(100) NOT NULL,
  `nombre_arabe` varchar(100) NOT NULL,
  `cate_anuncio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sub_categoria`
--

INSERT INTO `sub_categoria` (`subcate_id`, `nombre`, `nombre_ingles`, `nombre_arabe`, `cate_anuncio_id`) VALUES
(7, 'Vehiculo nuevo', '', '', 2),
(8, 'prueba ', '', '', 4),
(9, 'Moviliarios nuevos', '', '', 2),
(10, 'nueva tarea', '', '', 5),
(11, 'Locales nuevos', '', '', 7),
(12, 'bodegas', '', '', 7),
(13, 'muebles', '', '', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` int(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` varchar(60) NOT NULL,
  `photo` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `phone`, `role_id`, `status`, `photo`) VALUES
(1, 'ruben Dario ', 'rubendario@gmail.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 4268941, 3, '', ''),
(2, 'Indira Perez', 'indiraepf03@gmail.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 998724637, 1, '', ''),
(3, 'pedro duran ', 'pedroduran014@gmail.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 4524323, 3, '', ''),
(4, 'pedro Duran', 'pedro@datalabcenter.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 2147483647, 1, '', ''),
(5, 'yadira flores ', 'yaflo62@gmail.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 2147483647, 2, '', ''),
(6, 'Luis', 'luis@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 980562425, 1, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`anuncio_id`);

--
-- Indices de la tabla `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `cate_anuncio`
--
ALTER TABLE `cate_anuncio`
  ADD PRIMARY KEY (`cate_anuncio_id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`ciudad_id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_id`);

--
-- Indices de la tabla `membresia`
--
ALTER TABLE `membresia`
  ADD PRIMARY KEY (`membresia_id`);

--
-- Indices de la tabla `membresia_user`
--
ALTER TABLE `membresia_user`
  ADD PRIMARY KEY (`membre_user_id`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`mensaje_id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`pais_id`);

--
-- Indices de la tabla `photo_anuncio`
--
ALTER TABLE `photo_anuncio`
  ADD PRIMARY KEY (`photo_anuncio_id`);

--
-- Indices de la tabla `photo_subasta`
--
ALTER TABLE `photo_subasta`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indices de la tabla `puja`
--
ALTER TABLE `puja`
  ADD PRIMARY KEY (`puja_id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `subasta`
--
ALTER TABLE `subasta`
  ADD PRIMARY KEY (`subasta_id`);

--
-- Indices de la tabla `subasta_user`
--
ALTER TABLE `subasta_user`
  ADD PRIMARY KEY (`subasta_user_id`);

--
-- Indices de la tabla `sub_categoria`
--
ALTER TABLE `sub_categoria`
  ADD PRIMARY KEY (`subcate_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `anuncio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `cate_anuncio`
--
ALTER TABLE `cate_anuncio`
  MODIFY `cate_anuncio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `ciudad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `membresia`
--
ALTER TABLE `membresia`
  MODIFY `membresia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `membresia_user`
--
ALTER TABLE `membresia_user`
  MODIFY `membre_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `mensaje_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `pais_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `photo_anuncio`
--
ALTER TABLE `photo_anuncio`
  MODIFY `photo_anuncio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `photo_subasta`
--
ALTER TABLE `photo_subasta`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `puja`
--
ALTER TABLE `puja`
  MODIFY `puja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `subasta`
--
ALTER TABLE `subasta`
  MODIFY `subasta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `subasta_user`
--
ALTER TABLE `subasta_user`
  MODIFY `subasta_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sub_categoria`
--
ALTER TABLE `sub_categoria`
  MODIFY `subcate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
