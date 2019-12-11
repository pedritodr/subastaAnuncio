-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2019 a las 17:55:06
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `subastayanuncios`
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
(14, 'carro usado en buenas condiciones', '', '', 'este es un anuncio', '', '', 1000, './uploads/anuncio/1568687944.jpg', 998724637, 3, 7, 1, '-78.4678382', '-0.1806532', 4),
(17, 'sistemas de Información ', '', '', 'prueba', '', '', 1000, './uploads/anuncio/1568734227.jpg', 2147483647, 3, 7, 1, '-67.0345443', '10.349223', 14),
(19, 'DataLabCenter', '', '', 'prueba', '', '', 2000, './uploads/anuncio/1568820529.jpg', 998724637, 3, 11, 1, '-69.28188399999999', '10.0627257', 13);

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
(3, './uploads/banner/1568051712.jpg', 1, 'https://marazul.com.ec', 'Proyecto final ', '', '', 'nuevo', '', '');

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
(19, 'vehiculos', '', '', './uploads/categoria/1568831485.png', 1),
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
(4, 'Mobiliario', '', '', './uploads/cate_anuncio/1567715099.jpg', 1),
(7, 'Locales ', '', '', './uploads/cate_anuncio/1568070353.jpg', 1);

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
  `description` varchar(100) NOT NULL,
  `descripcion_corta` varchar(100) NOT NULL,
  `imagen` varchar(120) NOT NULL,
  `descrip_eleccion` varchar(120) NOT NULL,
  `mision` varchar(100) NOT NULL,
  `vision` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `nombre`, `email`, `description`, `descripcion_corta`, `imagen`, `descrip_eleccion`, `mision`, `vision`) VALUES
(1, 'Subasta', 'pedroduran014@gmail.com', 'somos una empresa de calidad', 'esta es una descripcion corta', '', 'porque elegirnos ', 'esta es la mision', 'esta es la vision ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia`
--

CREATE TABLE `membresia` (
  `membresia_id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `nombre_ingles` varchar(60) NOT NULL,
  `nombre_arabe` varchar(60) NOT NULL,
  `precio` varchar(30) NOT NULL,
  `cant_anuncio` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `membresia`
--

INSERT INTO `membresia` (`membresia_id`, `nombre`, `nombre_ingles`, `nombre_arabe`, `precio`, `cant_anuncio`) VALUES
(1, 'Plan Oro', '', '', '600$', 100),
(2, 'Plan Premiun ', '', '', '800$', 200),
(3, 'Plan Empresarial ', '', '', '1000$', 360),
(4, 'Plan Gratis ', '', '', '0$', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia_user`
--

CREATE TABLE `membresia_user` (
  `membre_user_id` int(11) NOT NULL,
  `membresia_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `anuncios_publi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(9, './uploads/photo_anuncio/1568820584.jpg', 17);

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
(41, 22, './uploads/photo/1568835153.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puja`
--

CREATE TABLE `puja` (
  `puja_id` int(11) NOT NULL,
  `fecha_hora` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `subasta_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `descrip_espa` varchar(100) NOT NULL,
  `descrip_ingles` varchar(100) NOT NULL,
  `descrip_arabe` varchar(100) NOT NULL,
  `valor_inicial` varchar(60) NOT NULL,
  `fecha_cierre` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `valor_pago` varchar(60) NOT NULL,
  `is_open` varchar(60) NOT NULL,
  `is_active` int(11) NOT NULL,
  `ciudad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subasta`
--

INSERT INTO `subasta` (`subasta_id`, `nombre_espa`, `nombre_ingles`, `nombre_arabe`, `descrip_espa`, `descrip_ingles`, `descrip_arabe`, `valor_inicial`, `fecha_cierre`, `user_id`, `categoria_id`, `photo`, `valor_pago`, `is_open`, `is_active`, `ciudad_id`) VALUES
(17, 'Venta de Vehiculos ', '', '', 'venta de vehiculos cero kilometros, con todo incluido.', '', '', '$4500', '2019-09-28', 2, 19, './uploads/subasta/1568907953.jpg', '1500', 'abierta ', 1, 4),
(18, 'venta de Celulares', '', '', 'venta de equipos moviles', '', '', '$9000', '2019-09-21', 2, 20, './uploads/subasta/1568907969.jpg', '800', 'abierta ', 1, 6),
(19, 'computadoras', '', '', '<p>venta de computadoras</p>', '', '', '7000', '2019-09-29', 2, 21, './uploads/subasta/1568834807.jpg', '1500', 'abierta ', 1, 13),
(20, 'herramientas', '', '', '<p>venta de herramientas nuevas</p>', '', '', '$8000', '2019-09-29', 2, 22, './uploads/subasta/1568908044.jpg', '9000', 'abierta ', 1, 14),
(21, 'ropa de buena calidad', '', '', '<p>venta de ropa</p>', '', '', '$10000', '2019-10-09', 2, 24, './uploads/subasta/1568908002.jpg', '6000', 'abierta ', 1, 4),
(22, 'juguetes', '', '', '<p>venta de juguetes</p>', '', '', '$8000', '2019-09-29', 2, 25, './uploads/subasta/1568908059.jpg', '800', 'abierta ', 1, 5),
(23, 'mobiliario', '', '', '<p>venta de casa</p>', '', '', '$90000', '2019-09-21', 2, 26, './uploads/subasta/1568908105.jpg', '9880', 'abierta ', 1, 6),
(24, 'nueva subasta ', '', '', '<p>venta de relojes</p>', '', '', '$8000', '2019-09-27', 2, 27, './uploads/subasta/1568908122.jpg', '70000', 'abierta ', 1, 4);

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
(3, 'pedro duran ', 'pedrito@gmail.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 4524323, 2, '', ''),
(4, 'Ruben hidalgo', 'rubenh@gmail.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 2147483647, 4, '', ''),
(5, 'yadira flores ', 'yaflo62@gmail.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 2147483647, 2, '', '');

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
  MODIFY `anuncio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `cate_anuncio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `membresia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `membresia_user`
--
ALTER TABLE `membresia_user`
  MODIFY `membre_user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `pais_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `photo_anuncio`
--
ALTER TABLE `photo_anuncio`
  MODIFY `photo_anuncio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `photo_subasta`
--
ALTER TABLE `photo_subasta`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `puja`
--
ALTER TABLE `puja`
  MODIFY `puja_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `subasta`
--
ALTER TABLE `subasta`
  MODIFY `subasta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `sub_categoria`
--
ALTER TABLE `sub_categoria`
  MODIFY `subcate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
