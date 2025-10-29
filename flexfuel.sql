-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2025 a las 09:58:41
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
-- Base de datos: `flexfuel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `detalle_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`detalle_id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 27, 1, 899.00),
(2, 1, 1, 1, 599.00),
(3, 1, 2, 1, 699.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `favorito_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('Pendiente','Procesando','Enviado','Completado','Cancelado') NOT NULL DEFAULT 'Pendiente',
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`pedido_id`, `usuario_id`, `fecha_pedido`, `estado`, `total`) VALUES
(1, 1, '2025-10-28 08:41:15', 'Procesando', 2197.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `subcategoria` varchar(50) DEFAULT NULL,
  `genero` enum('Hombre','Mujer','Unisex') NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `nombre`, `descripcion`, `precio`, `categoria`, `subcategoria`, `genero`, `imagen_url`, `stock`) VALUES
(1, 'Strap Premium', 'Mejor soporte y agarre en levantamientos pesados.', 599.00, 'Equipamiento', 'Straps', 'Unisex', 'strap1.jpg', 50),
(2, 'Strap Pro', 'Durabilidad y comodidad para entrenamientos intensos.', 699.00, 'Equipamiento', 'Straps', 'Unisex', 'strap2.jpg', 50),
(3, 'Strap Básico', 'Ligero y efectivo para iniciarte en el levantamiento.', 399.00, 'Equipamiento', 'Straps', 'Unisex', 'strap3.jpg', 50),
(4, 'Muñequera Pro', 'Soporte firme para movimientos pesados.', 499.00, 'Equipamiento', 'Muñequeras', 'Unisex', 'muñequera1.jpg', 50),
(5, 'Muñequera Premium', 'Estabilidad y confort en cada levantamiento.', 599.00, 'Equipamiento', 'Muñequeras', 'Unisex', 'muñequera2.jpg', 50),
(6, 'Muñequera Básica', 'Perfecta para principiantes en el entrenamiento.', 399.00, 'Equipamiento', 'Muñequeras', 'Unisex', 'muñequera3.jpg', 50),
(7, 'Rodillera Pro', 'Máxima estabilidad para sentadillas profundas.', 799.00, 'Equipamiento', 'Rodilleras', 'Unisex', 'rodillera1.jpg', 50),
(8, 'Rodillera Premium', 'Protección avanzada para entrenamientos intensos.', 899.00, 'Equipamiento', 'Rodilleras', 'Unisex', 'rodillera2.jpg', 50),
(9, 'Rodillera Básica', 'Soporte ideal para ejercicios moderados.', 599.00, 'Equipamiento', 'Rodilleras', 'Unisex', 'rodillera3.jpg', 50),
(10, 'Cinturón Elite', 'Soporte lumbar para levantamientos avanzados.', 999.00, 'Equipamiento', 'Cinturones', 'Unisex', 'cinturon1.jpg', 50),
(11, 'Cinturón Pro', 'Comodidad y estabilidad para cargas moderadas.', 799.00, 'Equipamiento', 'Cinturones', 'Unisex', 'cinturon2.jpg', 50),
(12, 'Cinturón Básico', 'Ideal para principiantes en powerlifting.', 499.00, 'Equipamiento', 'Cinturones', 'Unisex', 'cinturon3.jpg', 50),
(13, 'Codera Pro', 'Soporte superior para ejercicios de empuje.', 499.00, 'Equipamiento', 'Coderas', 'Unisex', 'codera1.jpg', 50),
(14, 'Codera Premium', 'Comodidad y protección en entrenamientos intensos.', 599.00, 'Equipamiento', 'Coderas', 'Unisex', 'codera2.jpg', 50),
(15, 'Codera Básica', 'Ligera y efectiva para principiantes.', 399.00, 'Equipamiento', 'Coderas', 'Unisex', 'codera3.jpg', 50),
(16, 'Zapatos de Levantamiento', 'Estabilidad máxima para sentadillas profundas.', 1999.00, 'Equipamiento', 'Calzado', 'Unisex', 'zapato1.jpg', 50),
(17, 'Tenis de Entrenamiento', 'Versátiles y cómodos para entrenamiento funcional.', 1499.00, 'Equipamiento', 'Calzado', 'Unisex', 'zapato2.jpg', 50),
(18, 'Zapatos Minimalistas', 'Ligereza y conexión al suelo para levantamientos precisos.', 1299.00, 'Equipamiento', 'Calzado', 'Unisex', 'zapato3.jpg', 50),
(19, 'SBD Premium', 'Muñequeras profesionales para levantamiento.', 899.00, 'Accesorios', 'SBD', 'Unisex', 'sbd1.jpg', 50),
(20, 'SBD Pro', 'Muñequeras resistentes para entrenamientos intensos.', 799.00, 'Accesorios', 'SBD', 'Unisex', 'sbd2.jpg', 50),
(21, 'SBD Básico', 'Perfecto para principiantes en el powerlifting.', 599.00, 'Accesorios', 'SBD', 'Unisex', 'sbd3.jpg', 50),
(22, 'Mochila Premium', 'Gran capacidad para llevar todo tu equipo.', 699.00, 'Accesorios', 'Mochilas', 'Unisex', 'mochila1.jpg', 50),
(23, 'Mochila Pro', 'Resistente y con diseño ergonómico.', 599.00, 'Accesorios', 'Mochilas', 'Unisex', 'mochila2.jpg', 50),
(24, 'Mochila Compacta', 'Ligera y fácil de transportar.', 499.00, 'Accesorios', 'Mochilas', 'Unisex', 'mochila3.jpg', 50),
(25, 'Shaker Premium', 'Con compartimento para suplementos.', 299.00, 'Accesorios', 'Shakers', 'Unisex', 'shaker1.jpg', 50),
(26, 'Shaker Pro', 'Material resistente y libre de BPA.', 249.00, 'Accesorios', 'Shakers', 'Unisex', 'shaker2.jpg', 50),
(27, 'Gymshark - Camisa Training', 'Cómoda y transpirable para tus entrenamientos.', 899.00, 'Ropa', 'Camisas', 'Hombre', 'gymshark1.jpg', 50),
(28, 'Gymshark - Shorts Flex', 'Diseño ligero para movilidad total.', 799.00, 'Ropa', 'Shorts', 'Hombre', 'gymshark2.jpg', 50),
(29, 'Gymshark - Hoodie Classic', 'Calidez y estilo en un diseño clásico.', 1199.00, 'Ropa', 'Hoodies', 'Hombre', 'gymshark3.jpg', 50),
(30, 'Young LA - Joggers Confort', 'Perfectos para el gimnasio y el día a día.', 1099.00, 'Ropa', 'Joggers', 'Hombre', 'youngla1.jpg', 50),
(31, 'Young LA - Camiseta Oversized', 'Estilo urbano y moderno para cualquier ocasión.', 799.00, 'Ropa', 'Camisas', 'Hombre', 'youngla2.jpg', 50),
(32, 'Young LA - Sudadera Premium', 'Comodidad absoluta en cualquier clima.', 1299.00, 'Ropa', 'Hoodies', 'Hombre', 'youngla3.jpg', 50),
(33, 'Alphalete - Leggings Infinity', 'Compresión y flexibilidad para tu entrenamiento.', 1399.00, 'Ropa', 'Leggings', 'Hombre', 'alphalete1.jpg', 50),
(34, 'Alphalete - Camiseta Luxe', 'Diseño premium con tecnología de enfriamiento.', 999.00, 'Ropa', 'Camisas', 'Hombre', 'alphalete2.jpg', 50),
(35, 'Alphalete - Hoodie Performance', 'Ligero y cálido, ideal para entrenar al aire libre.', 1599.00, 'Ropa', 'Hoodies', 'Hombre', 'alphalete3.jpg', 50),
(36, 'Gymshark - Leggings Energy', 'Leggings de compresión con diseño elegante.', 999.00, 'Ropa', 'Leggings', 'Mujer', 'gymshark11.jpg', 50),
(37, 'Gymshark - Top Vital', 'Top deportivo con soporte y comodidad.', 699.00, 'Ropa', 'Tops', 'Mujer', 'gymshark22.jpg', 50),
(38, 'Gymshark - Short Adapt', 'Shorts flexibles para cualquier entrenamiento.', 599.00, 'Ropa', 'Shorts', 'Mujer', 'gymshark33.jpg', 50),
(39, 'Young LA - Joggers Confort', 'Pantalones cómodos con estilo casual.', 1099.00, 'Ropa', 'Joggers', 'Mujer', 'youngla11.jpg', 50),
(40, 'Young LA - Camiseta Oversized', 'Diseño moderno y holgado.', 799.00, 'Ropa', 'Camisas', 'Mujer', 'youngla22.jpg', 50),
(41, 'Young LA - Sudadera Fit', 'Perfecta para entrenar o uso diario.', 1299.00, 'Ropa', 'Hoodies', 'Mujer', 'youngla33.jpg', 50),
(42, 'Lululemon - Leggings Align', 'Leggings suaves con soporte premium.', 1499.00, 'Ropa', 'Leggings', 'Mujer', 'lululemon1.jpeg', 50),
(43, 'Lululemon - Top Define', 'Soporte y estilo para entrenamientos.', 1199.00, 'Ropa', 'Tops', 'Mujer', 'lululemon2.jpg', 50),
(44, 'Lululemon - Chaqueta Scuba', 'Aislamiento térmico con diseño elegante.', 2099.00, 'Ropa', 'Hoodies', 'Mujer', 'lululemon3.jpg', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE `suscripciones` (
  `suscripcion_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha_suscripcion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre_completo`, `email`, `password_hash`, `pais`, `fecha_nacimiento`, `fecha_registro`) VALUES
(1, 'Derek Yahir', 'DerkYahr@outlook.com', '$2y$10$XIHykXyRQI0NGVbXjcFkT.tbS40kBQ01ucnF6I4A8JdVPoRYgrOL6', 'México', '2003-09-08', '2025-10-28 08:40:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`detalle_id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`favorito_id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`producto_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD PRIMARY KEY (`suscripcion_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `favorito_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  MODIFY `suscripcion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`pedido_id`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`);

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
