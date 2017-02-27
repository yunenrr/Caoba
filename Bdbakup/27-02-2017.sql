-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-02-2017 a las 22:22:04
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8
--
-- Base de datos: `gymcaoba`
--
create database gymcaoba;
use gymcaoba;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbaddress`
--

CREATE TABLE `tbaddress` (
  `idaddress` int(11) NOT NULL,
  `neighborhoodaddress` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbaddress`
--

INSERT INTO `tbaddress` (`idaddress`, `neighborhoodaddress`) VALUES
(1, 'La Suiza'),
(2, 'Carmen Lira'),
(3, 'Eslabón'),
(4, 'Canadá'),
(5, 'La Dominica'),
(6, 'Los Laureles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbbuy`
--

CREATE TABLE `tbbuy` (
  `idbuy` int(11) NOT NULL,
  `brandbuy` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modelbuy` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantitybuy` int(11) NOT NULL,
  `buydatebuy` date NOT NULL,
  `invoicenumberbuy` int(11) NOT NULL,
  `providerbuy` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pricebuy` int(11) NOT NULL,
  `buyerbuy` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paymentbuy` int(11) NOT NULL,
  `seriesbuy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcampus`
--

CREATE TABLE `tbcampus` (
  `idcampus` int(11) NOT NULL,
  `namecampus` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbcampus`
--

INSERT INTO `tbcampus` (`idcampus`, `namecampus`) VALUES
(0, 'Sala 1'),
(1, 'Sala 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientschedule`
--

CREATE TABLE `tbclientschedule` (
  `idclientschedule` int(11) NOT NULL,
  `idpersonclientschedule` int(11) NOT NULL,
  `startdateclientschedule` date NOT NULL,
  `enddateclientschedule` date NOT NULL,
  `hourclientschedule` int(11) NOT NULL,
  `dayclientschedule` int(11) NOT NULL,
  `idservicepaymentmoduleclientschedule` int(11) NOT NULL,
  `idserviceclientschedule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpaymentclient`
--

CREATE TABLE IF NOT EXISTS `tbpaymentclient` (
  `idpaymentclient` int(11) NOT NULL,
  `idpaymentmodulepaymentclient` int(11) NOT NULL,
  `idclientschedulepaymentclient` int(11) NOT NULL,
  `paymentpaymentclient` int(11) NOT NULL,
  `totalpaymentpaymentclient` int(11) NOT NULL,
  PRIMARY KEY (`idpaymentclient`),
  KEY `idpaymentmodulepaymentclient` (`idpaymentmodulepaymentclient`,`idclientschedulepaymentclient`),
  KEY `idclientschedulepaymentclient` (`idclientschedulepaymentclient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpaymentmoduleclient`
--

CREATE TABLE IF NOT EXISTS `tbpaymentmoduleclient` (
  `idpaymentmoduleclient` int(11) NOT NULL,
  `idpersonpaymentsclient` int(11) NOT NULL,
  `registrationdatepaymentsclient` date NOT NULL,
  `idpaymentmodulepaymentsclient` int(11) NOT NULL,
  PRIMARY KEY (`idpaymentmoduleclient`),
  KEY `idpersonpaymentsclient` (`idpersonpaymentsclient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclinicaldetailperson`
--

CREATE TABLE `tbclinicaldetailperson` (
  `idclinicaldetailperson` int(11) NOT NULL,
  `idpersonclinicaldetailperson` int(11) NOT NULL,
  `idcondictionclinicaldetailperson` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcondition`
--

CREATE TABLE `tbcondition` (
  `idcondition` int(11) NOT NULL,
  `namecondition` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `risklevelcondition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdiet`
--

CREATE TABLE `tbdiet` (
  `iddiet` int(11) NOT NULL,
  `namediet` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptiondiet` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdietperson`
--

CREATE TABLE `tbdietperson` (
  `iddietperson` int(11) NOT NULL,
  `idpersondietperson` int(11) NOT NULL,
  `iddietdietperson` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdietplan`
--

CREATE TABLE `tbdietplan` (
  `iddietplan` int(11) NOT NULL,
  `idfooddietplan` int(11) NOT NULL,
  `iddietdietplan` int(11) NOT NULL,
  `dietdaydietplan` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diethourdietplan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbexercise`
--

CREATE TABLE `tbexercise` (
  `idexercise` int(11) NOT NULL DEFAULT '0',
  `nameexercise` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfamilyparenting`
--

CREATE TABLE `tbfamilyparenting` (
  `idfamilyparenting` int(11) NOT NULL,
  `idpersonfamilyparenting` int(11) NOT NULL,
  `idrelativefamilyparenting` int(11) NOT NULL,
  `idrelationshipfamilyparenting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfood`
--

CREATE TABLE `tbfood` (
  `idfood` int(11) NOT NULL,
  `namefood` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nutritionalvaluefood` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbfood`
--

INSERT INTO `tbfood` (`idfood`, `namefood`, `nutritionalvaluefood`) VALUES
(0, 'Gelatina', '84,4 gramos de proteína por 100 gramos.'),
(1, 'Queso', '25,6 gramos de proteína'),
(2, 'Pollo', '85, 9 gramos de proteína'),
(3, 'Leche', '15,9 gramos de proteína'),
(4, 'Almendras', '20 gramos de proteína'),
(5, 'Avena', '28 gramos de proteína');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbgender`
--

CREATE TABLE `tbgender` (
  `idgender` int(11) NOT NULL,
  `namegender` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbgender`
--

INSERT INTO `tbgender` (`idgender`, `namegender`) VALUES
(1, 'Heterosexual'),
(2, 'Homosexual,'),
(3, 'Transexual'),
(4, 'Bisexual'),
(5, 'Masculino'),
(6, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbhistorycampus`
--

CREATE TABLE `tbhistorycampus` (
  `idhistorycampus` int(11) NOT NULL,
  `dnipersonhistorycampus` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `idcampushistorycampus` int(11) NOT NULL,
  `idservicehistorycampus` int(11) NOT NULL,
  `datehistorycampus` date NOT NULL,
  `hourhistorycampus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbinstructor`
--

CREATE TABLE `tbinstructor` (
  `idinstructor` int(11) NOT NULL,
  `idpersoninstructor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbinstructor`
--

INSERT INTO `tbinstructor` (`idinstructor`, `idpersoninstructor`) VALUES
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbinventory`
--

CREATE TABLE `tbinventory` (
  `idinventory` int(11) NOT NULL,
  `idgoodsinventory` int(11) NOT NULL,
  `statusinventory` int(11) NOT NULL,
  `quantityinventory` int(11) NOT NULL,
  `locationactveinventory` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmeasurement`
--

CREATE TABLE `tbmeasurement` (
  `idmeasurement` int(11) NOT NULL,
  `idpersonmeasurement` int(11) NOT NULL,
  `measurementdatemeasurement` date NOT NULL,
  `transversethoraxmeasurement` decimal(10,2) NOT NULL,
  `backthoraxmeasurement` decimal(10,2) NOT NULL,
  `biiliocrestideomeasurement` decimal(10,2) NOT NULL,
  `humeralmeasurement` decimal(10,2) NOT NULL,
  `femoralmeasurement` decimal(10,2) NOT NULL,
  `headmeasurement` decimal(10,2) NOT NULL,
  `armrelaxedmeasurement` decimal(10,2) NOT NULL,
  `armflexedmeasurement` decimal(10,2) NOT NULL,
  `forearmmeasurement` decimal(10,2) NOT NULL,
  `mesosternalthoraxmeasurement` decimal(10,2) NOT NULL,
  `waistmeasurement` decimal(10,2) NOT NULL,
  `hipmeasurement` decimal(10,2) NOT NULL,
  `innerthighmeasurement` decimal(10,2) NOT NULL,
  `upperthighmeasurement` decimal(10,2) NOT NULL,
  `calfmaxmeasurement` decimal(10,2) NOT NULL,
  `tricepsmeasurement` decimal(10,2) NOT NULL,
  `subscapularmeasurement` decimal(10,2) NOT NULL,
  `supraspiralmeasurement` decimal(10,2) NOT NULL,
  `abdominalmeasurement` decimal(10,2) NOT NULL,
  `medialthighmeasurement` decimal(10,2) NOT NULL,
  `calfmeasurement` decimal(10,2) NOT NULL,
  `musclemassmeasurement` decimal(10,2) NOT NULL,
  `weightmeasurement` decimal(10,2) NOT NULL,
  `totalfatmeasurement` decimal(10,2) NOT NULL,
  `heightmeasurement` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpaymentmodule`
--

CREATE TABLE `tbpaymentmodule` (
  `idpaymentmodule` int(11) NOT NULL,
  `namepaymentmodule` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbpaymentmodule`
--

INSERT INTO `tbpaymentmodule` (`idpaymentmodule`, `namepaymentmodule`) VALUES
(1, 'Diario'),
(2, 'Semanal'),
(3, 'Quincenal'),
(4, 'Mensual'),
(5, 'Sesión');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbperson`
--

CREATE TABLE `tbperson` (
  `idperson` int(11) NOT NULL,
  `dniperson` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nameperson` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstnameperson` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `secondnameperson` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthdayperson` date NOT NULL,
  `genderperson` int(11) NOT NULL,
  `emailperson` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `addressperson` int(11) NOT NULL,
  `phonereferenceperson` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bloodtypeperson` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbperson`
--

INSERT INTO `tbperson` (`idperson`, `dniperson`, `nameperson`, `firstnameperson`, `secondnameperson`, `birthdayperson`, `genderperson`, `emailperson`, `addressperson`, `phonereferenceperson`, `bloodtypeperson`) VALUES
(1, '0-0000-0000', 'Admin', 'Admin', 'Admin', '2006-06-06', 1, 'vanecalderon_5@hotmail.com', 2, '12345678', 'O+'),
(2, '3-0123-0321', 'Oscar', 'Saborio', 'Saborio', '1972-02-29', 1, 'oscar_saborio@hotmail.com', 2, '87654321', 'A+'),
(3, '1-0319-0601', 'Randall', 'Barboza', 'Barboza', '1972-02-28', 1, 'Randall_Barboza@hotmail.com', 6, '87654321', 'AB'),
(4, '3-0331-0163', 'Yunen', 'Ramos', 'Ramírez', '1995-04-25', 5, 'yunenrr@gmail.com', 3, '87654321', 'O+'),
(5, '3-0341-0894', 'Karen', 'Calderón', 'Calvo', '1995-04-26', 6, 'calderonvane5@gmail.com', 6, '87654321', 'AB'),
(6, '3-0451-0707', 'Edwin', 'Navarro', 'Barahona', '1994-02-02', 5, 'edwnaba@gmail.com', 4, '87654321', 'AB'),
(7, '3-0457-0638', 'Luis', 'Castillo', 'Calderón', '1990-01-01', 5, 'luisdacas17@gmail.com', 5, '87654321', 'AB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpersonstate`
--

CREATE TABLE `tbpersonstate` (
  `idpersonstate` int(11) NOT NULL,
  `idclientpersonstate` int(11) NOT NULL,
  `statepersonstate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbphone`
--

CREATE TABLE `tbphone` (
  `idphone` int(11) NOT NULL,
  `idclientphone` int(11) NOT NULL,
  `numberphone` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbrelationship`
--

CREATE TABLE `tbrelationship` (
  `idrelationship` int(11) NOT NULL,
  `namerelationship` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbrelationship`
--

INSERT INTO `tbrelationship` (`idrelationship`, `namerelationship`) VALUES
(1, 'Padre'),
(2, 'Madre'),
(3, 'Hermana'),
(4, 'Hermano'),
(5, 'Hijo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroutine`
--

CREATE TABLE `tbroutine` (
  `idroutine` int(11) NOT NULL,
  `idpersonroutine` int(11) NOT NULL,
  `nameroutine` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `seriesroutine` int(11) NOT NULL,
  `repetitionsroutine` int(11) NOT NULL,
  `commentroutine` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `periodicityroutine` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `muscleroutine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbscheduleservice`
--

CREATE TABLE `tbscheduleservice` (
  `idscheduleservice` int(11) NOT NULL,
  `datescheduleservice` date NOT NULL,
  `idcampuscheduleservice` int(11) NOT NULL,
  `idservicescheduleservice` int(11) NOT NULL,
  `dayscheduleservice` int(11) NOT NULL,
  `hourscheduleservice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbscheduleservice`
--

INSERT INTO `tbscheduleservice` (`idscheduleservice`, `datescheduleservice`, `idcampuscheduleservice`, `idservicescheduleservice`, `dayscheduleservice`, `hourscheduleservice`) VALUES
(1, '2018-02-01', 0, 1, 2, 5),
(3, '2018-02-01', 0, 1, 1, 7),
(4, '2018-02-01', 0, 1, 2, 8),
(5, '2018-02-01', 0, 1, 3, 7),
(6, '2018-02-01', 0, 1, 4, 10),
(7, '2018-02-01', 0, 1, 4, 11),
(8, '2018-02-01', 0, 1, 4, 12),
(9, '2018-02-01', 0, 1, 4, 13),
(11, '2018-02-01', 0, 1, 4, 15),
(12, '2017-07-01', 0, 2, 4, 16),
(13, '2017-07-01', 0, 2, 4, 17),
(14, '2017-07-01', 0, 2, 4, 18),
(15, '2017-07-01', 0, 2, 4, 19),
(16, '2017-07-01', 0, 2, 4, 20),
(17, '2017-07-01', 1, 2, 4, 11),
(18, '2017-07-01', 1, 2, 4, 12),
(19, '2017-07-01', 1, 2, 4, 13),
(20, '2017-07-01', 1, 2, 4, 14),
(21, '2017-07-01', 1, 2, 4, 15),
(22, '2018-02-01', 0, 1, 4, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbservice`
--

CREATE TABLE `tbservice` (
  `idservice` int(11) NOT NULL,
  `idinstructorservice` int(11) NOT NULL,
  `nameservice` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionservice` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quotaservice` int(11) NOT NULL,
  `stardateservice` date NOT NULL,
  `enddateservice` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbservice`
--

INSERT INTO `tbservice` (`idservice`, `idinstructorservice`, `nameservice`, `descriptionservice`, `quotaservice`, `stardateservice`, `enddateservice`) VALUES
(1, 1, 'Aeróbicos', 'Aeróbicos', 25, '2017-02-01', '2018-02-01'),
(2, 2, 'Spinning', 'Bicicleta', 15, '2017-01-01', '2017-07-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbservicepaymentmodule`
--

CREATE TABLE `tbservicepaymentmodule` (
  `idservicepaymentmodule` int(11) NOT NULL,
  `idserviceservicepaymentmodule` int(11) NOT NULL,
  `idpaymentmoduleservicepaymentmodule` int(11) NOT NULL,
  `priceservicepaymentmodule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbservicepaymentmodule`
--

INSERT INTO `tbservicepaymentmodule` (`idservicepaymentmodule`, `idserviceservicepaymentmodule`, `idpaymentmoduleservicepaymentmodule`, `priceservicepaymentmodule`) VALUES
(1, 1, 1, 1000),
(2, 1, 5, 500),
(3, 1, 4, 10000),
(4, 2, 5, 2000),
(5, 2, 3, 20000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbstatusgoods`
--

CREATE TABLE `tbstatusgoods` (
  `idstatusgoods` int(11) NOT NULL,
  `statusstatusgoods` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbstatusgoods`
--

INSERT INTO `tbstatusgoods` (`idstatusgoods`, `statusstatusgoods`) VALUES
(1, 'Funcionamiento'),
(2, 'Reparación'),
(3, 'Desecho'),
(4, 'Dañado en uso'),
(5, 'Robado'),
(6, 'Donado'),
(7, 'Donación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbuser`
--

CREATE TABLE `tbuser` (
  `iduser` int(11) NOT NULL,
  `idpersonuser` int(11) NOT NULL,
  `typeuser` int(11) NOT NULL,
  `usernameuser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `passuser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `startdateuser` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbuser`
--

INSERT INTO `tbuser` (`iduser`, `idpersonuser`, `typeuser`, `usernameuser`, `passuser`, `startdateuser`) VALUES
(1, 1, 4, 'admin', 'admin', '2006-06-06'),
(2, 2, 1, 'oscar_saborio@hotmail.com', 'oscar_saborio', '2016-02-01'),
(3, 3, 1, 'Randall_Barboza@hotmail.com', 'Randall_Barboza', '2015-11-11'),
(4, 4, 0, 'yunenrr@gmail.com', 'yunenrr', '2016-04-13'),
(5, 5, 0, 'calderonvane5@gmail.com', 'calderonvane5', '2016-02-10'),
(6, 6, 0, 'edwnaba@gmail.com', 'edwnaba', '2015-10-13'),
(7, 7, 0, 'luisdacas17@gmail.com', 'luisdacas17', '2015-08-11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbaddress`
--
ALTER TABLE `tbaddress`
  ADD PRIMARY KEY (`idaddress`);

--
-- Indices de la tabla `tbbuy`
--
ALTER TABLE `tbbuy`
  ADD PRIMARY KEY (`idbuy`);

--
-- Indices de la tabla `tbcampus`
--
ALTER TABLE `tbcampus`
  ADD PRIMARY KEY (`idcampus`);

--
-- Indices de la tabla `tbclientschedule`
--
ALTER TABLE `tbclientschedule`
  ADD PRIMARY KEY (`idclientschedule`),
  ADD KEY `clientschedulefkperson` (`idpersonclientschedule`),
  ADD KEY `clientschedulefkServicePaymentModule` (`idservicepaymentmoduleclientschedule`),
  ADD KEY `clientschedulefkService` (`idserviceclientschedule`);

--
-- Indices de la tabla `tbclinicaldetailperson`
--
ALTER TABLE `tbclinicaldetailperson`
  ADD PRIMARY KEY (`idclinicaldetailperson`),
  ADD UNIQUE KEY `idclinicaldetailperson` (`idclinicaldetailperson`),
  ADD KEY `condictionfkcondition` (`idcondictionclinicaldetailperson`),
  ADD KEY `personfkperson` (`idpersonclinicaldetailperson`);

--
-- Indices de la tabla `tbcondition`
--
ALTER TABLE `tbcondition`
  ADD PRIMARY KEY (`idcondition`),
  ADD UNIQUE KEY `id` (`idcondition`);

--
-- Indices de la tabla `tbdiet`
--
ALTER TABLE `tbdiet`
  ADD PRIMARY KEY (`iddiet`),
  ADD UNIQUE KEY `iddiet` (`iddiet`),
  ADD UNIQUE KEY `id` (`iddiet`);

--
-- Indices de la tabla `tbdietperson`
--
ALTER TABLE `tbdietperson`
  ADD PRIMARY KEY (`iddietperson`),
  ADD UNIQUE KEY `iddietperson` (`iddietperson`),
  ADD UNIQUE KEY `id` (`iddietperson`),
  ADD KEY `dietpersonfkdiet` (`iddietdietperson`),
  ADD KEY `dietpersonfkperson` (`idpersondietperson`);

--
-- Indices de la tabla `tbdietplan`
--
ALTER TABLE `tbdietplan`
  ADD PRIMARY KEY (`iddietplan`),
  ADD UNIQUE KEY `iddietplan` (`iddietplan`),
  ADD UNIQUE KEY `id` (`iddietplan`),
  ADD KEY `dietplanfkdiet` (`iddietdietplan`),
  ADD KEY `dietplanfkfood` (`idfooddietplan`);

--
-- Indices de la tabla `tbfamilyparenting`
--
ALTER TABLE `tbfamilyparenting`
  ADD PRIMARY KEY (`idfamilyparenting`),
  ADD UNIQUE KEY `id` (`idfamilyparenting`),
  ADD KEY `personfkfamilyparenting` (`idpersonfamilyparenting`),
  ADD KEY `relationshippkfamilyparenting` (`idrelationshipfamilyparenting`),
  ADD KEY `relativefkfamilyparenting` (`idrelativefamilyparenting`);

--
-- Indices de la tabla `tbfood`
--
ALTER TABLE `tbfood`
  ADD PRIMARY KEY (`idfood`),
  ADD UNIQUE KEY `idfood` (`idfood`),
  ADD UNIQUE KEY `id` (`idfood`);

--
-- Indices de la tabla `tbgender`
--
ALTER TABLE `tbgender`
  ADD PRIMARY KEY (`idgender`),
  ADD UNIQUE KEY `id` (`idgender`);

--
-- Indices de la tabla `tbhistorycampus`
--
ALTER TABLE `tbhistorycampus`
  ADD PRIMARY KEY (`idhistorycampus`),
  ADD KEY `tbhistorycampusfkdniperson` (`dnipersonhistorycampus`),
  ADD KEY `tbhistorycampusfkidcampus` (`idcampushistorycampus`),
  ADD KEY `tbhistorycampusfkidservice` (`idservicehistorycampus`);

--
-- Indices de la tabla `tbinstructor`
--
ALTER TABLE `tbinstructor`
  ADD PRIMARY KEY (`idinstructor`),
  ADD UNIQUE KEY `id` (`idinstructor`),
  ADD KEY `instructorfkperson` (`idpersoninstructor`);

--
-- Indices de la tabla `tbinventory`
--
ALTER TABLE `tbinventory`
  ADD PRIMARY KEY (`idinventory`),
  ADD UNIQUE KEY `idinventory` (`idinventory`),
  ADD UNIQUE KEY `id` (`idinventory`);

--
-- Indices de la tabla `tbmeasurement`
--
ALTER TABLE `tbmeasurement`
  ADD PRIMARY KEY (`idmeasurement`),
  ADD UNIQUE KEY `id` (`idmeasurement`),
  ADD KEY `measurementfkperson` (`idpersonmeasurement`);

--
-- Indices de la tabla `tbpaymentmodule`
--
ALTER TABLE `tbpaymentmodule`
  ADD PRIMARY KEY (`idpaymentmodule`),
  ADD UNIQUE KEY `id` (`idpaymentmodule`);

--
-- Indices de la tabla `tbperson`
--
ALTER TABLE `tbperson`
  ADD PRIMARY KEY (`idperson`),
  ADD UNIQUE KEY `dniperson` (`dniperson`),
  ADD UNIQUE KEY `id` (`idperson`),
  ADD KEY `personfkgender` (`genderperson`),
  ADD KEY `tbpersonfkaddressperson` (`addressperson`);

--
-- Indices de la tabla `tbpersonstate`
--
ALTER TABLE `tbpersonstate`
  ADD PRIMARY KEY (`idpersonstate`),
  ADD UNIQUE KEY `id` (`idpersonstate`),
  ADD KEY `personstatefkperson` (`idclientpersonstate`);

--
-- Indices de la tabla `tbphone`
--
ALTER TABLE `tbphone`
  ADD PRIMARY KEY (`idphone`),
  ADD UNIQUE KEY `idphone` (`idphone`),
  ADD UNIQUE KEY `id` (`idphone`),
  ADD KEY `personphonefkperson` (`idclientphone`);

--
-- Indices de la tabla `tbrelationship`
--
ALTER TABLE `tbrelationship`
  ADD PRIMARY KEY (`idrelationship`),
  ADD UNIQUE KEY `id` (`idrelationship`);

--
-- Indices de la tabla `tbroutine`
--
ALTER TABLE `tbroutine`
  ADD PRIMARY KEY (`idroutine`),
  ADD UNIQUE KEY `idroutine` (`idroutine`),
  ADD UNIQUE KEY `id` (`idroutine`),
  ADD KEY `routinefkperson` (`idpersonroutine`);

--
-- Indices de la tabla `tbscheduleservice`
--
ALTER TABLE `tbscheduleservice`
  ADD PRIMARY KEY (`idscheduleservice`),
  ADD UNIQUE KEY `idscheduleservice` (`idscheduleservice`),
  ADD KEY `tbscheduleservicefkidcampus` (`idcampuscheduleservice`),
  ADD KEY `tbscheduleservicefkidservicescheduleservice` (`idservicescheduleservice`);

--
-- Indices de la tabla `tbservice`
--
ALTER TABLE `tbservice`
  ADD PRIMARY KEY (`idservice`),
  ADD UNIQUE KEY `id` (`idservice`),
  ADD KEY `servicefkinstructor` (`idinstructorservice`);

--
-- Indices de la tabla `tbservicepaymentmodule`
--
ALTER TABLE `tbservicepaymentmodule`
  ADD PRIMARY KEY (`idservicepaymentmodule`),
  ADD UNIQUE KEY `idservicepaymentmodule` (`idservicepaymentmodule`),
  ADD KEY `paymentmodulefkservicepaymentmodule` (`idpaymentmoduleservicepaymentmodule`),
  ADD KEY `servicefkservicepaymentmodule` (`idserviceservicepaymentmodule`);

--
-- Indices de la tabla `tbstatusgoods`
--
ALTER TABLE `tbstatusgoods`
  ADD PRIMARY KEY (`idstatusgoods`);

--
-- Indices de la tabla `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `id` (`iduser`),
  ADD UNIQUE KEY `username` (`usernameuser`),
  ADD KEY `userfkperson` (`idpersonuser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbdiet`
--
ALTER TABLE `tbdiet`
  MODIFY `iddiet` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbmeasurement`
--
ALTER TABLE `tbmeasurement`
  MODIFY `idmeasurement` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbclientschedule`
--
ALTER TABLE `tbclientschedule`
  ADD CONSTRAINT `clientschedulefkService` FOREIGN KEY (`idserviceclientschedule`) REFERENCES `tbservice` (`idservice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clientschedulefkServicePaymentModule` FOREIGN KEY (`idservicepaymentmoduleclientschedule`) REFERENCES `tbservicepaymentmodule` (`idservicepaymentmodule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clientschedulefkperson` FOREIGN KEY (`idpersonclientschedule`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbclinicaldetailperson`
--
ALTER TABLE `tbclinicaldetailperson`
  ADD CONSTRAINT `condictionfkcondition` FOREIGN KEY (`idcondictionclinicaldetailperson`) REFERENCES `tbcondition` (`idcondition`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personfkperson` FOREIGN KEY (`idpersonclinicaldetailperson`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbdietperson`
--
ALTER TABLE `tbdietperson`
  ADD CONSTRAINT `dietpersonfkdiet` FOREIGN KEY (`iddietdietperson`) REFERENCES `tbdiet` (`iddiet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dietpersonfkperson` FOREIGN KEY (`idpersondietperson`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbdietplan`
--
ALTER TABLE `tbdietplan`
  ADD CONSTRAINT `dietplanfkdiet` FOREIGN KEY (`iddietdietplan`) REFERENCES `tbdiet` (`iddiet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dietplanfkfood` FOREIGN KEY (`idfooddietplan`) REFERENCES `tbfood` (`idfood`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbfamilyparenting`
--
ALTER TABLE `tbfamilyparenting`
  ADD CONSTRAINT `personfkfamilyparenting` FOREIGN KEY (`idpersonfamilyparenting`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relationshippkfamilyparenting` FOREIGN KEY (`idrelationshipfamilyparenting`) REFERENCES `tbrelationship` (`idrelationship`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relativefkfamilyparenting` FOREIGN KEY (`idrelativefamilyparenting`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbhistorycampus`
--
ALTER TABLE `tbhistorycampus`
  ADD CONSTRAINT `tbhistorycampusfkdniperson` FOREIGN KEY (`dnipersonhistorycampus`) REFERENCES `tbperson` (`dniperson`),
  ADD CONSTRAINT `tbhistorycampusfkidcampus` FOREIGN KEY (`idcampushistorycampus`) REFERENCES `tbcampus` (`idcampus`),
  ADD CONSTRAINT `tbhistorycampusfkidservice` FOREIGN KEY (`idservicehistorycampus`) REFERENCES `tbservice` (`idservice`);

--
-- Filtros para la tabla `tbinstructor`
--
ALTER TABLE `tbinstructor`
  ADD CONSTRAINT `instructorfkperson` FOREIGN KEY (`idpersoninstructor`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbmeasurement`
--
ALTER TABLE `tbmeasurement`
  ADD CONSTRAINT `measurementfkperson` FOREIGN KEY (`idpersonmeasurement`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbperson`
--
ALTER TABLE `tbperson`
  ADD CONSTRAINT `personfkgender` FOREIGN KEY (`genderperson`) REFERENCES `tbgender` (`idgender`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbpersonfkaddressperson` FOREIGN KEY (`addressperson`) REFERENCES `tbaddress` (`idaddress`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbpersonstate`
--
ALTER TABLE `tbpersonstate`
  ADD CONSTRAINT `personstatefkperson` FOREIGN KEY (`idclientpersonstate`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbphone`
--
ALTER TABLE `tbphone`
  ADD CONSTRAINT `personphonefkperson` FOREIGN KEY (`idclientphone`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbroutine`
--
ALTER TABLE `tbroutine`
  ADD CONSTRAINT `routinefkperson` FOREIGN KEY (`idpersonroutine`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbscheduleservice`
--
ALTER TABLE `tbscheduleservice`
  ADD CONSTRAINT `tbscheduleservicefkidcampus` FOREIGN KEY (`idcampuscheduleservice`) REFERENCES `tbcampus` (`idcampus`),
  ADD CONSTRAINT `tbscheduleservicefkidservicescheduleservice` FOREIGN KEY (`idservicescheduleservice`) REFERENCES `tbservice` (`idservice`);

--
-- Filtros para la tabla `tbservice`
--
ALTER TABLE `tbservice`
  ADD CONSTRAINT `servicefkinstructor` FOREIGN KEY (`idinstructorservice`) REFERENCES `tbinstructor` (`idinstructor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbservicepaymentmodule`
--
ALTER TABLE `tbservicepaymentmodule`
  ADD CONSTRAINT `paymentmodulefkservicepaymentmodule` FOREIGN KEY (`idpaymentmoduleservicepaymentmodule`) REFERENCES `tbpaymentmodule` (`idpaymentmodule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicefkservicepaymentmodule` FOREIGN KEY (`idserviceservicepaymentmodule`) REFERENCES `tbservice` (`idservice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbuser`
--
ALTER TABLE `tbuser`
  ADD CONSTRAINT `userfkperson` FOREIGN KEY (`idpersonuser`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

  --
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbpaymentclient`
--
ALTER TABLE `tbpaymentclient`
  ADD CONSTRAINT `tbpaymentclient_ibfk_3` FOREIGN KEY (`idpaymentmodulepaymentclient`) REFERENCES `tbpaymentmoduleclient` (`idpaymentmoduleclient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbpaymentclient_ibfk_2` FOREIGN KEY (`idclientschedulepaymentclient`) REFERENCES `tbclientschedule` (`idclientschedule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbpaymentmoduleclient`
--
ALTER TABLE `tbpaymentmoduleclient`
  ADD CONSTRAINT `tbpaymentmoduleclient_ibfk_1` FOREIGN KEY (`idpersonpaymentsclient`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
