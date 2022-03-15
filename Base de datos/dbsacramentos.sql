-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2022 a las 04:27:20
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbsacramentos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bautismo`
--

CREATE TABLE `bautismo` (
  `idbautismo` int(11) NOT NULL,
  `partida` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `libro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idfeligres` int(11) NOT NULL,
  `idmadre` int(11) DEFAULT NULL,
  `idpadre` int(11) DEFAULT NULL,
  `idmadrina` int(11) DEFAULT NULL,
  `idpadrino` int(11) DEFAULT NULL,
  `idministro` int(11) DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunion`
--

CREATE TABLE `comunion` (
  `idcomunion` int(11) NOT NULL,
  `partidacm` int(11) NOT NULL,
  `foliocm` int(11) NOT NULL,
  `librocm` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idbautismo` int(11) DEFAULT NULL,
  `idmadrina` int(11) NOT NULL,
  `idpadrino` int(11) NOT NULL,
  `idministro` int(11) NOT NULL,
  `observaciones` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunionep`
--

CREATE TABLE `comunionep` (
  `idcomunion` int(11) NOT NULL,
  `partida` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `libro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idfeligres` int(11) NOT NULL,
  `fechabautismo` date NOT NULL,
  `idmadre` int(11) NOT NULL,
  `idpadre` int(11) NOT NULL,
  `idmadrina` int(11) NOT NULL,
  `idpadrino` int(11) NOT NULL,
  `idministro` int(11) NOT NULL,
  `observaciones` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `idconfiguracion` int(11) NOT NULL,
  `parroquia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `lugar` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `municipio` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `diocesis` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`idconfiguracion`, `parroquia`, `lugar`, `municipio`, `departamento`, `diocesis`, `telefono`, `direccion`) VALUES
(1, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `confirmacion`
--

CREATE TABLE `confirmacion` (
  `idconfirmacion` int(11) NOT NULL,
  `partidacf` int(11) NOT NULL,
  `foliocf` int(11) NOT NULL,
  `librocf` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idbautismo` int(11) NOT NULL,
  `idmadrina` int(11) NOT NULL,
  `idpadrino` int(11) NOT NULL,
  `idministro` int(11) NOT NULL,
  `observaciones` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `confirmacionep`
--

CREATE TABLE `confirmacionep` (
  `idconfirmacion` int(11) NOT NULL,
  `partida` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `libro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idfeligres` int(11) NOT NULL,
  `fechabautismo` date NOT NULL,
  `idmadre` int(11) NOT NULL,
  `idpadre` int(11) NOT NULL,
  `idmadrina` int(11) NOT NULL,
  `idpadrino` int(11) NOT NULL,
  `idministro` int(11) NOT NULL,
  `observaciones` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `iddepartamento` int(11) NOT NULL,
  `nombredepartamento` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feligreses`
--

CREATE TABLE `feligreses` (
  `idfeligres` int(11) NOT NULL,
  `cui` varchar(15) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `iddepartamento` int(11) DEFAULT NULL,
  `idmunicipio` int(11) DEFAULT NULL,
  `idlugar` int(11) DEFAULT NULL,
  `idconfiguracion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feligresesep`
--

CREATE TABLE `feligresesep` (
  `idfeligres` int(11) NOT NULL,
  `cui` varchar(15) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `fechanacimiento` date NOT NULL,
  `iddepartamento` int(11) NOT NULL,
  `idmunicipio` int(11) NOT NULL,
  `idlugar` int(11) NOT NULL,
  `idparroquia` int(11) NOT NULL,
  `idconfiguracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE `lugar` (
  `idlugar` int(11) NOT NULL,
  `nombrelugar` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `madre`
--

CREATE TABLE `madre` (
  `idmadre` int(11) NOT NULL,
  `idfeligres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `madreep`
--

CREATE TABLE `madreep` (
  `idmadre` int(11) NOT NULL,
  `idfeligreses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `madrina`
--

CREATE TABLE `madrina` (
  `idmadrina` int(11) NOT NULL,
  `idfeligres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `madrinaep`
--

CREATE TABLE `madrinaep` (
  `idmadrina` int(11) NOT NULL,
  `idfeligreses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matrimonio`
--

CREATE TABLE `matrimonio` (
  `idmatrimonio` int(11) NOT NULL,
  `partida` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `libro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idtestiga` int(11) DEFAULT NULL,
  `idtestigo` int(11) DEFAULT NULL,
  `idbautismo` int(11) DEFAULT NULL,
  `edadesposo` int(3) NOT NULL,
  `idbautismo2` int(11) DEFAULT NULL,
  `edadesposa` int(3) NOT NULL,
  `idministro` int(11) DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matrimoniocombh`
--

CREATE TABLE `matrimoniocombh` (
  `idmatrimonio` int(11) NOT NULL,
  `partida` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `libro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idtestiga` int(11) NOT NULL,
  `idtestigo` int(11) NOT NULL,
  `idbautismo` int(11) NOT NULL,
  `edadesposo` int(11) NOT NULL,
  `idfeligres` int(11) NOT NULL,
  `edadesposa` int(11) NOT NULL,
  `idpadre` int(11) NOT NULL,
  `idmadre` int(11) NOT NULL,
  `idministro` int(11) NOT NULL,
  `observaciones` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matrimoniocombm`
--

CREATE TABLE `matrimoniocombm` (
  `idmatrimonio` int(11) NOT NULL,
  `partida` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `libro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idtestiga` int(11) NOT NULL,
  `idtestigo` int(11) NOT NULL,
  `idfeligres` int(11) NOT NULL,
  `edadesposo` int(11) NOT NULL,
  `idpadre` int(11) NOT NULL,
  `idmadre` int(11) NOT NULL,
  `idbautismo` int(11) NOT NULL,
  `edadesposa` int(11) NOT NULL,
  `idministro` int(11) NOT NULL,
  `observaciones` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matrimonioep`
--

CREATE TABLE `matrimonioep` (
  `idmatrimonio` int(11) NOT NULL,
  `partida` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `libro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idtestiga` int(11) NOT NULL,
  `idtestigo` int(11) NOT NULL,
  `idfeligres` int(11) NOT NULL,
  `edadesposo` int(11) NOT NULL,
  `idpadre` int(11) NOT NULL,
  `idmadre` int(11) NOT NULL,
  `idfeligres2` int(11) NOT NULL,
  `edadesposa` int(11) NOT NULL,
  `idpadre2` int(11) NOT NULL,
  `idmadre2` int(11) NOT NULL,
  `idministro` int(11) NOT NULL,
  `observaciones` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ministro`
--

CREATE TABLE `ministro` (
  `idministro` int(11) NOT NULL,
  `nombreministro` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `idmunicipio` int(11) NOT NULL,
  `nombremunicipio` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padre`
--

CREATE TABLE `padre` (
  `idpadre` int(11) NOT NULL,
  `idfeligres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padreep`
--

CREATE TABLE `padreep` (
  `idpadre` int(11) NOT NULL,
  `idfeligreses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padrino`
--

CREATE TABLE `padrino` (
  `idpadrino` int(11) NOT NULL,
  `idfeligres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padrinoep`
--

CREATE TABLE `padrinoep` (
  `idpadrino` int(11) NOT NULL,
  `idfeligreses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE `parroquia` (
  `idparroquia` int(11) NOT NULL,
  `nombreparroquia` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Secretaria/Secretario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testiga`
--

CREATE TABLE `testiga` (
  `idtestiga` int(11) NOT NULL,
  `idfeligres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testigaep`
--

CREATE TABLE `testigaep` (
  `idtestiga` int(11) NOT NULL,
  `idfeligreses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testigo`
--

CREATE TABLE `testigo` (
  `idtestigo` int(11) NOT NULL,
  `idfeligres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testigoep`
--

CREATE TABLE `testigoep` (
  `idtestigo` int(11) NOT NULL,
  `idfeligreses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`) VALUES
(1, 'administrador', 'administrador@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(6, 'Maria Perez Miranda', 'maria@gmail.com', 'maria', '263bce650e68ab4e23f28263760b9fa5', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bautismo`
--
ALTER TABLE `bautismo`
  ADD PRIMARY KEY (`idbautismo`),
  ADD KEY `idmadre` (`idmadre`),
  ADD KEY `idpadre` (`idpadre`),
  ADD KEY `idmadrina` (`idmadrina`),
  ADD KEY `idpadrino` (`idpadrino`),
  ADD KEY `idministro` (`idministro`),
  ADD KEY `idfeligres` (`idfeligres`) USING BTREE;

--
-- Indices de la tabla `comunion`
--
ALTER TABLE `comunion`
  ADD PRIMARY KEY (`idcomunion`),
  ADD KEY `idbautismo` (`idbautismo`),
  ADD KEY `idmadrina` (`idmadrina`),
  ADD KEY `idpadrino` (`idpadrino`),
  ADD KEY `idministro` (`idministro`);

--
-- Indices de la tabla `comunionep`
--
ALTER TABLE `comunionep`
  ADD PRIMARY KEY (`idcomunion`),
  ADD KEY `idfeligres` (`idfeligres`),
  ADD KEY `idmadre` (`idmadre`),
  ADD KEY `idpadre` (`idpadre`),
  ADD KEY `idmadrina` (`idmadrina`),
  ADD KEY `idpadrino` (`idpadrino`),
  ADD KEY `idministro` (`idministro`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`idconfiguracion`);

--
-- Indices de la tabla `confirmacion`
--
ALTER TABLE `confirmacion`
  ADD PRIMARY KEY (`idconfirmacion`),
  ADD KEY `idbautismo` (`idbautismo`),
  ADD KEY `idmadrina` (`idmadrina`),
  ADD KEY `idpadrino` (`idpadrino`),
  ADD KEY `idministro` (`idministro`);

--
-- Indices de la tabla `confirmacionep`
--
ALTER TABLE `confirmacionep`
  ADD PRIMARY KEY (`idconfirmacion`),
  ADD KEY `idfeligres` (`idfeligres`),
  ADD KEY `idmadre` (`idmadre`),
  ADD KEY `idpadre` (`idpadre`),
  ADD KEY `idmadrina` (`idmadrina`),
  ADD KEY `idpadrino` (`idpadrino`),
  ADD KEY `idministro` (`idministro`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`iddepartamento`);

--
-- Indices de la tabla `feligreses`
--
ALTER TABLE `feligreses`
  ADD PRIMARY KEY (`idfeligres`),
  ADD KEY `idlugar` (`idlugar`),
  ADD KEY `idconfiguracion` (`idconfiguracion`),
  ADD KEY `iddepartamento` (`iddepartamento`),
  ADD KEY `idmunicipio` (`idmunicipio`);

--
-- Indices de la tabla `feligresesep`
--
ALTER TABLE `feligresesep`
  ADD PRIMARY KEY (`idfeligres`),
  ADD KEY `iddepartamento` (`iddepartamento`),
  ADD KEY `idmunicipio` (`idmunicipio`),
  ADD KEY `idlugar` (`idlugar`),
  ADD KEY `idparroquia` (`idparroquia`),
  ADD KEY `idconfiguracion` (`idconfiguracion`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`idlugar`);

--
-- Indices de la tabla `madre`
--
ALTER TABLE `madre`
  ADD PRIMARY KEY (`idmadre`),
  ADD KEY `idfeligres` (`idfeligres`);

--
-- Indices de la tabla `madreep`
--
ALTER TABLE `madreep`
  ADD PRIMARY KEY (`idmadre`),
  ADD KEY `idfeligreses` (`idfeligreses`);

--
-- Indices de la tabla `madrina`
--
ALTER TABLE `madrina`
  ADD PRIMARY KEY (`idmadrina`),
  ADD KEY `idfeligres` (`idfeligres`);

--
-- Indices de la tabla `madrinaep`
--
ALTER TABLE `madrinaep`
  ADD PRIMARY KEY (`idmadrina`),
  ADD KEY `idfeligreses` (`idfeligreses`);

--
-- Indices de la tabla `matrimonio`
--
ALTER TABLE `matrimonio`
  ADD PRIMARY KEY (`idmatrimonio`),
  ADD KEY `idtestiga` (`idtestiga`),
  ADD KEY `idtestigo` (`idtestigo`),
  ADD KEY `idbautismo` (`idbautismo`),
  ADD KEY `idbautismo2` (`idbautismo2`),
  ADD KEY `idministro` (`idministro`);

--
-- Indices de la tabla `matrimoniocombh`
--
ALTER TABLE `matrimoniocombh`
  ADD PRIMARY KEY (`idmatrimonio`),
  ADD KEY `idtestiga` (`idtestiga`),
  ADD KEY `idtestigo` (`idtestigo`),
  ADD KEY `idpadre` (`idpadre`),
  ADD KEY `idmadre` (`idmadre`),
  ADD KEY `idbautismo` (`idbautismo`) USING BTREE,
  ADD KEY `idfeligres` (`idfeligres`) USING BTREE;

--
-- Indices de la tabla `matrimoniocombm`
--
ALTER TABLE `matrimoniocombm`
  ADD PRIMARY KEY (`idmatrimonio`),
  ADD KEY `idtestiga` (`idtestiga`),
  ADD KEY `idtestigo` (`idtestigo`),
  ADD KEY `idfeligres` (`idfeligres`),
  ADD KEY `idpadre` (`idpadre`),
  ADD KEY `idmadre` (`idmadre`),
  ADD KEY `idbautismo` (`idbautismo`),
  ADD KEY `idministro` (`idministro`);

--
-- Indices de la tabla `matrimonioep`
--
ALTER TABLE `matrimonioep`
  ADD PRIMARY KEY (`idmatrimonio`),
  ADD KEY `idtestiga` (`idtestiga`),
  ADD KEY `idtestigo` (`idtestigo`),
  ADD KEY `idfeligres` (`idfeligres`),
  ADD KEY `idpadre` (`idpadre`),
  ADD KEY `idmadre` (`idmadre`),
  ADD KEY `idfeligres2` (`idfeligres2`),
  ADD KEY `idpadre2` (`idpadre2`),
  ADD KEY `idmadre2` (`idmadre2`),
  ADD KEY `idministro` (`idministro`);

--
-- Indices de la tabla `ministro`
--
ALTER TABLE `ministro`
  ADD PRIMARY KEY (`idministro`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`idmunicipio`);

--
-- Indices de la tabla `padre`
--
ALTER TABLE `padre`
  ADD PRIMARY KEY (`idpadre`),
  ADD KEY `idfeligres` (`idfeligres`);

--
-- Indices de la tabla `padreep`
--
ALTER TABLE `padreep`
  ADD PRIMARY KEY (`idpadre`),
  ADD KEY `idfeligreses` (`idfeligreses`);

--
-- Indices de la tabla `padrino`
--
ALTER TABLE `padrino`
  ADD PRIMARY KEY (`idpadrino`),
  ADD KEY `idfeligres` (`idfeligres`);

--
-- Indices de la tabla `padrinoep`
--
ALTER TABLE `padrinoep`
  ADD PRIMARY KEY (`idpadrino`),
  ADD KEY `idfeligreses` (`idfeligreses`);

--
-- Indices de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD PRIMARY KEY (`idparroquia`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `testiga`
--
ALTER TABLE `testiga`
  ADD PRIMARY KEY (`idtestiga`),
  ADD KEY `idfeligres` (`idfeligres`);

--
-- Indices de la tabla `testigaep`
--
ALTER TABLE `testigaep`
  ADD PRIMARY KEY (`idtestiga`),
  ADD KEY `idfeligreses` (`idfeligreses`);

--
-- Indices de la tabla `testigo`
--
ALTER TABLE `testigo`
  ADD PRIMARY KEY (`idtestigo`),
  ADD KEY `idfeligres` (`idfeligres`);

--
-- Indices de la tabla `testigoep`
--
ALTER TABLE `testigoep`
  ADD PRIMARY KEY (`idtestigo`),
  ADD KEY `idfeligreses` (`idfeligreses`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bautismo`
--
ALTER TABLE `bautismo`
  MODIFY `idbautismo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comunion`
--
ALTER TABLE `comunion`
  MODIFY `idcomunion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comunionep`
--
ALTER TABLE `comunionep`
  MODIFY `idcomunion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `idconfiguracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `confirmacion`
--
ALTER TABLE `confirmacion`
  MODIFY `idconfirmacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `confirmacionep`
--
ALTER TABLE `confirmacionep`
  MODIFY `idconfirmacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `iddepartamento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `feligreses`
--
ALTER TABLE `feligreses`
  MODIFY `idfeligres` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `feligresesep`
--
ALTER TABLE `feligresesep`
  MODIFY `idfeligres` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `idlugar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `madre`
--
ALTER TABLE `madre`
  MODIFY `idmadre` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `madreep`
--
ALTER TABLE `madreep`
  MODIFY `idmadre` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `madrina`
--
ALTER TABLE `madrina`
  MODIFY `idmadrina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `madrinaep`
--
ALTER TABLE `madrinaep`
  MODIFY `idmadrina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `matrimonio`
--
ALTER TABLE `matrimonio`
  MODIFY `idmatrimonio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `matrimoniocombh`
--
ALTER TABLE `matrimoniocombh`
  MODIFY `idmatrimonio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `matrimoniocombm`
--
ALTER TABLE `matrimoniocombm`
  MODIFY `idmatrimonio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `matrimonioep`
--
ALTER TABLE `matrimonioep`
  MODIFY `idmatrimonio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ministro`
--
ALTER TABLE `ministro`
  MODIFY `idministro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `idmunicipio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `padre`
--
ALTER TABLE `padre`
  MODIFY `idpadre` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `padreep`
--
ALTER TABLE `padreep`
  MODIFY `idpadre` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `padrino`
--
ALTER TABLE `padrino`
  MODIFY `idpadrino` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `padrinoep`
--
ALTER TABLE `padrinoep`
  MODIFY `idpadrino` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `parroquia`
--
ALTER TABLE `parroquia`
  MODIFY `idparroquia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `testiga`
--
ALTER TABLE `testiga`
  MODIFY `idtestiga` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `testigaep`
--
ALTER TABLE `testigaep`
  MODIFY `idtestiga` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `testigo`
--
ALTER TABLE `testigo`
  MODIFY `idtestigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `testigoep`
--
ALTER TABLE `testigoep`
  MODIFY `idtestigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bautismo`
--
ALTER TABLE `bautismo`
  ADD CONSTRAINT `bautismo_ibfk_10` FOREIGN KEY (`idfeligres`) REFERENCES `feligreses` (`idfeligres`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bautismo_ibfk_5` FOREIGN KEY (`idmadre`) REFERENCES `madre` (`idmadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bautismo_ibfk_6` FOREIGN KEY (`idpadre`) REFERENCES `padre` (`idpadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bautismo_ibfk_7` FOREIGN KEY (`idmadrina`) REFERENCES `madrina` (`idmadrina`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bautismo_ibfk_8` FOREIGN KEY (`idpadrino`) REFERENCES `padrino` (`idpadrino`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bautismo_ibfk_9` FOREIGN KEY (`idministro`) REFERENCES `ministro` (`idministro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `comunion`
--
ALTER TABLE `comunion`
  ADD CONSTRAINT `comunion_ibfk_1` FOREIGN KEY (`idbautismo`) REFERENCES `bautismo` (`idbautismo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comunion_ibfk_2` FOREIGN KEY (`idmadrina`) REFERENCES `madrina` (`idmadrina`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comunion_ibfk_3` FOREIGN KEY (`idpadrino`) REFERENCES `padrino` (`idpadrino`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comunion_ibfk_4` FOREIGN KEY (`idministro`) REFERENCES `ministro` (`idministro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `comunionep`
--
ALTER TABLE `comunionep`
  ADD CONSTRAINT `comunionep_ibfk_1` FOREIGN KEY (`idfeligres`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comunionep_ibfk_2` FOREIGN KEY (`idmadre`) REFERENCES `madreep` (`idmadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comunionep_ibfk_3` FOREIGN KEY (`idpadre`) REFERENCES `padreep` (`idpadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comunionep_ibfk_4` FOREIGN KEY (`idmadrina`) REFERENCES `madrinaep` (`idmadrina`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comunionep_ibfk_5` FOREIGN KEY (`idpadrino`) REFERENCES `padrinoep` (`idpadrino`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comunionep_ibfk_6` FOREIGN KEY (`idministro`) REFERENCES `ministro` (`idministro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `confirmacion`
--
ALTER TABLE `confirmacion`
  ADD CONSTRAINT `confirmacion_ibfk_1` FOREIGN KEY (`idbautismo`) REFERENCES `bautismo` (`idbautismo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `confirmacion_ibfk_7` FOREIGN KEY (`idmadrina`) REFERENCES `madrina` (`idmadrina`) ON UPDATE CASCADE,
  ADD CONSTRAINT `confirmacion_ibfk_8` FOREIGN KEY (`idpadrino`) REFERENCES `padrino` (`idpadrino`) ON UPDATE CASCADE,
  ADD CONSTRAINT `confirmacion_ibfk_9` FOREIGN KEY (`idministro`) REFERENCES `ministro` (`idministro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `confirmacionep`
--
ALTER TABLE `confirmacionep`
  ADD CONSTRAINT `confirmacionep_ibfk_1` FOREIGN KEY (`idfeligres`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE,
  ADD CONSTRAINT `confirmacionep_ibfk_2` FOREIGN KEY (`idmadre`) REFERENCES `madreep` (`idmadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `confirmacionep_ibfk_3` FOREIGN KEY (`idpadre`) REFERENCES `padreep` (`idpadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `confirmacionep_ibfk_4` FOREIGN KEY (`idmadrina`) REFERENCES `madrinaep` (`idmadrina`) ON UPDATE CASCADE,
  ADD CONSTRAINT `confirmacionep_ibfk_5` FOREIGN KEY (`idpadrino`) REFERENCES `padrinoep` (`idpadrino`) ON UPDATE CASCADE,
  ADD CONSTRAINT `confirmacionep_ibfk_6` FOREIGN KEY (`idministro`) REFERENCES `ministro` (`idministro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `feligreses`
--
ALTER TABLE `feligreses`
  ADD CONSTRAINT `feligreses_ibfk_1` FOREIGN KEY (`idlugar`) REFERENCES `lugar` (`idlugar`) ON UPDATE CASCADE,
  ADD CONSTRAINT `feligreses_ibfk_2` FOREIGN KEY (`idconfiguracion`) REFERENCES `configuracion` (`idconfiguracion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `feligreses_ibfk_3` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `feligreses_ibfk_4` FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `feligresesep`
--
ALTER TABLE `feligresesep`
  ADD CONSTRAINT `feligresesep_ibfk_1` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `feligresesep_ibfk_2` FOREIGN KEY (`idmunicipio`) REFERENCES `municipio` (`idmunicipio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `feligresesep_ibfk_3` FOREIGN KEY (`idlugar`) REFERENCES `lugar` (`idlugar`) ON UPDATE CASCADE,
  ADD CONSTRAINT `feligresesep_ibfk_4` FOREIGN KEY (`idparroquia`) REFERENCES `parroquia` (`idparroquia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `feligresesep_ibfk_5` FOREIGN KEY (`idconfiguracion`) REFERENCES `configuracion` (`idconfiguracion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `madre`
--
ALTER TABLE `madre`
  ADD CONSTRAINT `madre_ibfk_1` FOREIGN KEY (`idfeligres`) REFERENCES `feligreses` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `madreep`
--
ALTER TABLE `madreep`
  ADD CONSTRAINT `madreep_ibfk_1` FOREIGN KEY (`idfeligreses`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `madrina`
--
ALTER TABLE `madrina`
  ADD CONSTRAINT `madrina_ibfk_1` FOREIGN KEY (`idfeligres`) REFERENCES `feligreses` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `madrinaep`
--
ALTER TABLE `madrinaep`
  ADD CONSTRAINT `madrinaep_ibfk_1` FOREIGN KEY (`idfeligreses`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `matrimonio`
--
ALTER TABLE `matrimonio`
  ADD CONSTRAINT `matrimonio_ibfk_1` FOREIGN KEY (`idtestiga`) REFERENCES `testiga` (`idtestiga`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonio_ibfk_2` FOREIGN KEY (`idtestigo`) REFERENCES `testigo` (`idtestigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonio_ibfk_3` FOREIGN KEY (`idbautismo`) REFERENCES `bautismo` (`idbautismo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonio_ibfk_4` FOREIGN KEY (`idbautismo2`) REFERENCES `bautismo` (`idbautismo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonio_ibfk_5` FOREIGN KEY (`idministro`) REFERENCES `ministro` (`idministro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `matrimoniocombh`
--
ALTER TABLE `matrimoniocombh`
  ADD CONSTRAINT `matrimoniocombh_ibfk_1` FOREIGN KEY (`idtestiga`) REFERENCES `testigaep` (`idtestiga`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombh_ibfk_2` FOREIGN KEY (`idtestigo`) REFERENCES `testigo` (`idtestigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombh_ibfk_3` FOREIGN KEY (`idbautismo`) REFERENCES `bautismo` (`idbautismo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombh_ibfk_4` FOREIGN KEY (`idfeligres`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombh_ibfk_5` FOREIGN KEY (`idpadre`) REFERENCES `padreep` (`idpadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombh_ibfk_6` FOREIGN KEY (`idmadre`) REFERENCES `madreep` (`idmadre`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `matrimoniocombm`
--
ALTER TABLE `matrimoniocombm`
  ADD CONSTRAINT `matrimoniocombm_ibfk_1` FOREIGN KEY (`idtestiga`) REFERENCES `testiga` (`idtestiga`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombm_ibfk_2` FOREIGN KEY (`idtestigo`) REFERENCES `testigoep` (`idtestigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombm_ibfk_3` FOREIGN KEY (`idfeligres`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombm_ibfk_4` FOREIGN KEY (`idpadre`) REFERENCES `padreep` (`idpadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombm_ibfk_5` FOREIGN KEY (`idmadre`) REFERENCES `madreep` (`idmadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombm_ibfk_6` FOREIGN KEY (`idbautismo`) REFERENCES `bautismo` (`idbautismo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimoniocombm_ibfk_7` FOREIGN KEY (`idministro`) REFERENCES `ministro` (`idministro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `matrimonioep`
--
ALTER TABLE `matrimonioep`
  ADD CONSTRAINT `matrimonioep_ibfk_1` FOREIGN KEY (`idtestiga`) REFERENCES `testigaep` (`idtestiga`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonioep_ibfk_2` FOREIGN KEY (`idtestigo`) REFERENCES `testigoep` (`idtestigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonioep_ibfk_3` FOREIGN KEY (`idfeligres`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonioep_ibfk_4` FOREIGN KEY (`idpadre`) REFERENCES `padreep` (`idpadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonioep_ibfk_5` FOREIGN KEY (`idmadre`) REFERENCES `madreep` (`idmadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonioep_ibfk_6` FOREIGN KEY (`idfeligres2`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonioep_ibfk_7` FOREIGN KEY (`idpadre2`) REFERENCES `padreep` (`idpadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonioep_ibfk_8` FOREIGN KEY (`idmadre2`) REFERENCES `madreep` (`idmadre`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matrimonioep_ibfk_9` FOREIGN KEY (`idministro`) REFERENCES `ministro` (`idministro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `padre`
--
ALTER TABLE `padre`
  ADD CONSTRAINT `padre_ibfk_1` FOREIGN KEY (`idfeligres`) REFERENCES `feligreses` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `padreep`
--
ALTER TABLE `padreep`
  ADD CONSTRAINT `padreep_ibfk_1` FOREIGN KEY (`idfeligreses`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `padrino`
--
ALTER TABLE `padrino`
  ADD CONSTRAINT `padrino_ibfk_1` FOREIGN KEY (`idfeligres`) REFERENCES `feligreses` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `padrinoep`
--
ALTER TABLE `padrinoep`
  ADD CONSTRAINT `padrinoep_ibfk_1` FOREIGN KEY (`idfeligreses`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `testiga`
--
ALTER TABLE `testiga`
  ADD CONSTRAINT `testiga_ibfk_1` FOREIGN KEY (`idfeligres`) REFERENCES `feligreses` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `testigaep`
--
ALTER TABLE `testigaep`
  ADD CONSTRAINT `testigaep_ibfk_1` FOREIGN KEY (`idfeligreses`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `testigo`
--
ALTER TABLE `testigo`
  ADD CONSTRAINT `testigo_ibfk_1` FOREIGN KEY (`idfeligres`) REFERENCES `feligreses` (`idfeligres`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `testigoep`
--
ALTER TABLE `testigoep`
  ADD CONSTRAINT `testigoep_ibfk_1` FOREIGN KEY (`idfeligreses`) REFERENCES `feligresesep` (`idfeligres`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
