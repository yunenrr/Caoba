-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2017 a las 01:52:19
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gymcaoba`
--

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
(6, 'Los Laureles'),
(7, 'Tuis');

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

--
-- Volcado de datos para la tabla `tbbuy`
--

INSERT INTO `tbbuy` (`idbuy`, `brandbuy`, `modelbuy`, `quantitybuy`, `buydatebuy`, `invoicenumberbuy`, `providerbuy`, `pricebuy`, `buyerbuy`, `paymentbuy`, `seriesbuy`) VALUES
(1, 'Mancuernas', 'modelo', 123, '2017-01-02', 123, 'ka', 323224, 'karen', 0, '123');

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

--
-- Volcado de datos para la tabla `tbclientschedule`
--

INSERT INTO `tbclientschedule` (`idclientschedule`, `idpersonclientschedule`, `startdateclientschedule`, `enddateclientschedule`, `hourclientschedule`, `dayclientschedule`, `idservicepaymentmoduleclientschedule`, `idserviceclientschedule`) VALUES
(27, 6, '2017-02-27', '2017-03-06', 5, 2, 2, 1),
(28, 6, '2017-02-27', '2017-03-06', 5, 3, 2, 3),
(30, 6, '2017-02-27', '2017-03-06', 6, 0, 2, 3),
(32, 6, '2017-02-27', '2017-03-06', 6, 2, 2, 3),
(33, 6, '2017-02-27', '2017-03-06', 6, 3, 2, 3),
(35, 6, '2017-02-27', '2017-03-06', 7, 0, 2, 3),
(36, 6, '2017-02-27', '2017-03-06', 7, 1, 2, 1),
(37, 6, '2017-02-27', '2017-03-06', 7, 2, 2, 3),
(38, 6, '2017-02-27', '2017-03-06', 7, 3, 2, 1),
(39, 6, '2017-02-27', '2017-03-06', 7, 4, 2, 3),
(84, 6, '2017-02-27', '2017-03-06', 16, 4, 2, 2),
(89, 6, '2017-02-27', '2017-03-06', 17, 4, 2, 2),
(105, 6, '2017-02-27', '2017-03-06', 21, 0, 2, 3),
(107, 6, '2017-02-27', '2017-03-06', 21, 2, 2, 3),
(108, 6, '2017-02-27', '2017-03-06', 21, 3, 2, 3),
(109, 6, '2017-02-27', '2017-03-06', 21, 4, 2, 3),
(115, 1, '2017-02-27', '2017-03-06', 5, 0, 2, 3),
(116, 1, '2017-02-27', '2017-03-06', 5, 1, 2, 3),
(117, 1, '2017-02-27', '2017-03-06', 6, 1, 2, 3),
(118, 1, '2017-02-27', '2017-03-06', 8, 1, 2, 3),
(119, 1, '2017-02-27', '2017-03-06', 10, 4, 2, 1),
(120, 1, '2017-02-27', '2017-03-06', 9, 1, 2, 3),
(121, 1, '2017-02-27', '2017-03-06', 10, 1, 2, 3),
(122, 1, '2017-02-27', '2017-03-06', 11, 1, 2, 3),
(123, 1, '2017-02-27', '2017-03-06', 12, 1, 2, 3),
(124, 1, '2017-02-27', '2017-03-06', 13, 1, 2, 3),
(125, 1, '2017-02-27', '2017-03-06', 14, 1, 2, 3),
(126, 1, '2017-02-27', '2017-03-06', 15, 1, 2, 3),
(127, 1, '2017-02-27', '2017-03-06', 16, 1, 2, 3),
(128, 1, '2017-02-27', '2017-03-06', 17, 1, 2, 3),
(129, 1, '2017-02-27', '2017-03-06', 18, 1, 2, 3),
(130, 1, '2017-02-27', '2017-03-06', 19, 1, 2, 3),
(131, 1, '2017-02-27', '2017-03-06', 20, 1, 2, 3),
(132, 1, '2017-02-27', '2017-03-06', 21, 1, 2, 3),
(133, 1, '2017-02-28', '2017-03-07', 5, 4, 2, 3),
(134, 1, '2017-02-27', '2017-03-13', 11, 4, 3, 2),
(135, 1, '2017-02-27', '2017-03-13', 12, 4, 3, 2),
(136, 1, '2017-02-27', '2017-03-13', 13, 4, 3, 2),
(137, 1, '2017-02-27', '2017-03-13', 14, 4, 3, 2),
(138, 1, '2017-02-27', '2017-03-13', 15, 4, 3, 2),
(139, 1, '2017-02-27', '2017-03-13', 8, 0, 3, 3),
(140, 1, '2017-02-27', '2017-03-13', 8, 2, 3, 1),
(141, 1, '2017-02-27', '2017-03-13', 8, 3, 3, 3),
(142, 1, '2017-02-27', '2017-03-13', 8, 4, 3, 3),
(143, 1, '2017-02-27', '2017-03-13', 9, 0, 3, 3),
(144, 1, '2017-02-27', '2017-03-13', 9, 2, 3, 3),
(145, 1, '2017-02-27', '2017-03-13', 9, 3, 3, 3),
(147, 1, '2017-02-27', '2017-03-13', 10, 0, 3, 3),
(148, 1, '2017-02-27', '2017-03-13', 10, 2, 3, 3),
(149, 1, '2017-02-27', '2017-03-13', 10, 3, 3, 3),
(150, 1, '2017-02-27', '2017-03-13', 11, 0, 3, 3),
(151, 1, '2017-02-27', '2017-03-13', 11, 2, 3, 3),
(152, 1, '2017-02-27', '2017-03-13', 11, 3, 3, 3),
(153, 1, '2017-02-27', '2017-03-13', 12, 0, 3, 3),
(154, 1, '2017-02-27', '2017-03-13', 12, 2, 3, 3),
(155, 1, '2017-02-27', '2017-03-13', 12, 3, 3, 3),
(156, 1, '2017-02-27', '2017-03-13', 13, 0, 3, 3),
(183, 1, '2017-02-27', '2017-03-13', 13, 2, 3, 3),
(184, 1, '2017-02-27', '2017-03-13', 13, 3, 3, 3),
(185, 1, '2017-02-27', '2017-03-13', 14, 0, 3, 3),
(186, 1, '2017-02-27', '2017-03-13', 14, 2, 3, 3),
(187, 1, '2017-02-27', '2017-03-13', 14, 3, 3, 3),
(188, 1, '2017-02-27', '2017-03-13', 15, 0, 3, 3),
(189, 1, '2017-02-27', '2017-03-13', 15, 2, 3, 3),
(190, 1, '2017-02-27', '2017-03-13', 15, 3, 3, 3),
(191, 1, '2017-02-27', '2017-03-13', 16, 0, 3, 3),
(192, 1, '2017-02-27', '2017-03-13', 16, 2, 3, 3),
(209, 1, '2017-02-27', '2017-03-13', 16, 3, 3, 3),
(210, 1, '2017-02-27', '2017-03-13', 17, 0, 3, 3),
(211, 1, '2017-02-27', '2017-03-13', 17, 2, 3, 3),
(212, 1, '2017-02-27', '2017-03-13', 17, 3, 3, 3),
(213, 1, '2017-02-27', '2017-03-13', 18, 0, 3, 3),
(214, 1, '2017-02-27', '2017-03-13', 18, 2, 3, 3),
(215, 1, '2017-02-27', '2017-03-13', 18, 3, 3, 3),
(216, 1, '2017-02-27', '2017-03-13', 18, 4, 3, 2),
(225, 1, '2017-02-27', '2017-03-13', 19, 0, 3, 3),
(226, 1, '2017-02-27', '2017-03-13', 19, 2, 3, 3),
(227, 1, '2017-02-27', '2017-03-13', 19, 3, 3, 3),
(228, 1, '2017-02-27', '2017-03-13', 19, 4, 3, 2),
(233, 1, '2017-02-27', '2017-03-13', 20, 0, 3, 3),
(234, 1, '2017-02-27', '2017-03-13', 20, 2, 3, 3),
(236, 1, '2017-02-27', '2017-03-13', 20, 4, 3, 2),
(237, 1, '2017-02-27', '2017-03-13', 20, 3, 3, 3),
(238, 1, '2017-02-27', '2017-03-06', 6, 4, 2, 3),
(239, 1, '2017-02-27', '2017-03-06', 9, 4, 2, 3);

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

--
-- Volcado de datos para la tabla `tbfamilyparenting`
--

INSERT INTO `tbfamilyparenting` (`idfamilyparenting`, `idpersonfamilyparenting`, `idrelativefamilyparenting`, `idrelationshipfamilyparenting`) VALUES
(1, 4, 5, 2),
(2, 4, 6, 1),
(3, 4, 9, 4);

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
(0, 'Femenino'),
(1, 'Masculino');

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

--
-- Volcado de datos para la tabla `tbhistorycampus`
--

INSERT INTO `tbhistorycampus` (`idhistorycampus`, `dnipersonhistorycampus`, `idcampushistorycampus`, `idservicehistorycampus`, `datehistorycampus`, `hourhistorycampus`) VALUES
(1, '3-0331-0163', 0, 3, '2017-02-27', 9),
(2, '3-0457-0638', 0, 3, '2017-02-27', 9),
(3, '3-0341-0894', 0, 3, '2017-02-27', 9),
(4, '3-0451-0707', 0, 3, '2017-02-27', 9);

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
(2, 3),
(3, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbinventory`
--

CREATE TABLE `tbinventory` (
  `idinventory` int(11) NOT NULL,
  `idgoodsinventory` int(11) NOT NULL,
  `statusinventory` int(11) NOT NULL,
  `quantityinventory` int(11) NOT NULL,
  `locationactveinventory` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbinventory`
--

INSERT INTO `tbinventory` (`idinventory`, `idgoodsinventory`, `statusinventory`, `quantityinventory`, `locationactveinventory`) VALUES
(1, 1, 1, 123, '0');

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
-- Estructura de tabla para la tabla `tbpaymentclient`
--

CREATE TABLE `tbpaymentclient` (
  `idpaymentclient` int(11) NOT NULL,
  `idpaymentmodulepaymentclient` int(11) NOT NULL,
  `idclientschedulepaymentclient` int(11) NOT NULL,
  `paymentpaymentclient` int(11) NOT NULL,
  `totalpaymentpaymentclient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(5, 'Sesion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpaymentmoduleclient`
--

CREATE TABLE `tbpaymentmoduleclient` (
  `idpaymentmoduleclient` int(11) NOT NULL,
  `idpersonpaymentsclient` int(11) NOT NULL,
  `registrationdatepaymentsclient` date NOT NULL,
  `idpaymentmodulepaymentsclient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbpaymentmoduleclient`
--

INSERT INTO `tbpaymentmoduleclient` (`idpaymentmoduleclient`, `idpersonpaymentsclient`, `registrationdatepaymentsclient`, `idpaymentmodulepaymentsclient`) VALUES
(1, 8, '2017-01-02', 2);

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
(1, '1-2222-2222', 'admin', 'admin', 'admin', '2017-02-01', 0, 'vanecalderon_5@hotmail.com', 1, '', ''),
(2, '3-0123-0321', 'Oscar', 'Saborio', 'Saborio', '1972-02-29', 0, 'oscar_saborio@hotmail.com', 2, '87654321', 'A+'),
(3, '1-0319-0601', 'Randall', 'Barboza', 'Barboza', '1972-02-28', 0, 'Randall_Barboza@hotmail.com', 6, '87654321', 'AB'),
(4, '3-0331-0163', 'Yunen', 'Ramos', 'Ramirez', '1995-04-25', 1, 'yunenrr@gmail.com', 2, '(876)5432-1888', '0-'),
(5, '3-0341-0894', 'Karen', 'Calderón', 'Calvo', '1995-04-26', 1, 'calderonvane5@gmail.com', 6, '87654321', 'AB'),
(6, '3-0451-0707', 'Edwin', 'Navarro', 'Barahona', '1994-02-02', 0, 'edwnaba@gmail.com', 4, '87654321', 'AB'),
(7, '3-0457-0638', 'Luis', 'Castillo', 'Calderón', '1990-01-01', 0, 'luisdacas17@gmail.com', 5, '87654321', 'AB'),
(8, '3-5434-5353', 'Sebas', 'Solano', 'Calderon', '1992-11-05', 0, 'vane@hot.com', 1, '(686)7676-8767', '0-'),
(9, '6-8767-8678', 'Juan', 'Mora', 'Perez', '1992-11-05', 0, 'vane_5@djdjsg.com', 1, '(231)4234-3252', '0-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpersonstate`
--

CREATE TABLE `tbpersonstate` (
  `idpersonstate` int(11) NOT NULL,
  `idclientpersonstate` int(11) NOT NULL,
  `statepersonstate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbpersonstate`
--

INSERT INTO `tbpersonstate` (`idpersonstate`, `idclientpersonstate`, `statepersonstate`) VALUES
(0, 4, 1),
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 5, 1),
(5, 6, 1),
(6, 7, 1),
(7, 8, 1),
(8, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbphone`
--

CREATE TABLE `tbphone` (
  `idphone` int(11) NOT NULL,
  `idclientphone` int(11) NOT NULL,
  `numberphone` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbphone`
--

INSERT INTO `tbphone` (`idphone`, `idclientphone`, `numberphone`) VALUES
(1, 8, '(789)7897-9879');

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
(22, '2018-02-01', 0, 1, 4, 14),
(23, '2018-02-01', 1, 1, 0, 5),
(24, '2018-02-01', 1, 1, 1, 5),
(25, '2018-02-01', 1, 1, 3, 5),
(26, '2018-02-01', 1, 1, 4, 5),
(27, '2018-02-01', 1, 1, 0, 6),
(28, '2018-02-01', 1, 1, 1, 6),
(29, '2018-02-01', 1, 1, 2, 6),
(30, '2018-02-01', 1, 1, 3, 6),
(31, '2018-02-01', 1, 1, 4, 6),
(32, '2018-02-01', 1, 1, 0, 7),
(33, '2018-02-01', 1, 1, 2, 7),
(34, '2018-02-01', 1, 1, 4, 7),
(35, '2017-03-01', 0, 3, 1, 9),
(36, '2017-03-01', 0, 3, 3, 8),
(37, '2017-03-01', 0, 3, 3, 10),
(38, '2017-03-01', 0, 3, 2, 13),
(39, '2017-03-01', 0, 3, 2, 14),
(40, '2017-03-01', 0, 3, 3, 15),
(41, '2017-03-01', 0, 3, 2, 16),
(42, '2017-03-01', 0, 3, 1, 19),
(43, '2017-03-01', 0, 3, 1, 17),
(44, '2017-03-01', 0, 3, 1, 13),
(45, '2017-03-01', 0, 3, 4, 7),
(46, '2017-03-01', 0, 3, 0, 5),
(47, '2017-03-01', 0, 3, 1, 5),
(48, '2017-03-01', 0, 3, 1, 6),
(49, '2017-03-01', 0, 3, 0, 6),
(50, '2017-03-01', 0, 3, 2, 6),
(51, '2017-03-01', 0, 3, 3, 6),
(52, '2017-03-01', 0, 3, 3, 5),
(53, '2017-03-01', 0, 3, 4, 5),
(54, '2017-03-01', 0, 3, 4, 6),
(55, '2017-03-01', 0, 3, 4, 8),
(56, '2017-03-01', 0, 3, 4, 9),
(57, '2017-03-01', 0, 3, 3, 9),
(58, '2017-03-01', 0, 3, 2, 9),
(59, '2017-03-01', 0, 3, 2, 7),
(60, '2017-03-01', 0, 3, 1, 8),
(61, '2017-03-01', 0, 3, 0, 8),
(62, '2017-03-01', 0, 3, 0, 7),
(63, '2017-03-01', 0, 3, 0, 9),
(64, '2017-03-01', 0, 3, 0, 10),
(65, '2017-03-01', 0, 3, 1, 10),
(66, '2017-03-01', 0, 3, 2, 10),
(67, '2017-03-01', 0, 3, 3, 11),
(68, '2017-03-01', 0, 3, 3, 12),
(69, '2017-03-01', 0, 3, 3, 13),
(70, '2017-03-01', 0, 3, 3, 14),
(71, '2017-03-01', 0, 3, 2, 12),
(72, '2017-03-01', 0, 3, 2, 11),
(73, '2017-03-01', 0, 3, 1, 11),
(74, '2017-03-01', 0, 3, 1, 12),
(75, '2017-03-01', 0, 3, 0, 12),
(76, '2017-03-01', 0, 3, 0, 11),
(77, '2017-03-01', 0, 3, 0, 13),
(78, '2017-03-01', 0, 3, 0, 14),
(79, '2017-03-01', 0, 3, 1, 14),
(80, '2017-03-01', 0, 3, 0, 15),
(81, '2017-03-01', 0, 3, 1, 15),
(82, '2017-03-01', 0, 3, 2, 15),
(83, '2017-03-01', 0, 3, 3, 16),
(84, '2017-03-01', 0, 3, 3, 17),
(85, '2017-03-01', 0, 3, 3, 18),
(86, '2017-03-01', 0, 3, 3, 19),
(87, '2017-03-01', 0, 3, 3, 20),
(88, '2017-03-01', 0, 3, 3, 21),
(89, '2017-03-01', 0, 3, 4, 21),
(90, '2017-03-01', 0, 3, 2, 21),
(91, '2017-03-01', 0, 3, 1, 21),
(92, '2017-03-01', 0, 3, 0, 21),
(93, '2017-03-01', 0, 3, 0, 20),
(94, '2017-03-01', 0, 3, 1, 20),
(95, '2017-03-01', 0, 3, 2, 20),
(96, '2017-03-01', 0, 3, 2, 18),
(97, '2017-03-01', 0, 3, 2, 17),
(98, '2017-03-01', 0, 3, 1, 16),
(99, '2017-03-01', 0, 3, 0, 16),
(100, '2017-03-01', 0, 3, 0, 17),
(101, '2017-03-01', 0, 3, 0, 18),
(102, '2017-03-01', 0, 3, 0, 19),
(103, '2017-03-01', 0, 3, 1, 18),
(104, '2017-03-01', 0, 3, 2, 19);

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
(1, 1, 'Aerobicos', 'Aerobicos', 20, '2017-02-01', '2018-02-01'),
(2, 2, 'Spinning', 'Bicicleta', 5, '2017-01-01', '2017-07-01'),
(3, 2, 'Funcional', 'Entrenamiento de cardio.', 30, '2017-02-01', '2017-03-01');

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
(5, 2, 3, 20000),
(6, 3, 4, 10000);

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
(1, 1, 0, 'admin', 'admin', '2017-02-01'),
(2, 2, 1, 'oscar_saborio@hotmail.com', 'oscar_saborio', '2016-02-01'),
(3, 3, 2, 'Randall_Barboza@hotmail.com', 'Randall_Barboza', '2015-11-11'),
(4, 4, 0, 'yunenrr@gmail.com', 'yunenrr', '2016-04-13'),
(5, 5, 0, 'vanecalderon_5@hotmail.com', 'calderonvane5', '2016-02-10'),
(6, 6, 2, 'edwnaba@gmail.com', 'edwnaba', '2015-10-13'),
(7, 7, 0, 'luisdacas17@gmail.com', 'luisdacas17', '2015-08-11'),
(8, 8, 0, 'vane@hot.com', '1234', '2017-01-02'),
(9, 9, 1, 'vane_5@djdjsg.com', '1234', '2017-02-02');

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
-- Indices de la tabla `tbpaymentclient`
--
ALTER TABLE `tbpaymentclient`
  ADD PRIMARY KEY (`idpaymentclient`),
  ADD KEY `idpaymentmodulepaymentclient` (`idpaymentmodulepaymentclient`,`idclientschedulepaymentclient`),
  ADD KEY `idclientschedulepaymentclient` (`idclientschedulepaymentclient`);

--
-- Indices de la tabla `tbpaymentmodule`
--
ALTER TABLE `tbpaymentmodule`
  ADD PRIMARY KEY (`idpaymentmodule`),
  ADD UNIQUE KEY `id` (`idpaymentmodule`);

--
-- Indices de la tabla `tbpaymentmoduleclient`
--
ALTER TABLE `tbpaymentmoduleclient`
  ADD PRIMARY KEY (`idpaymentmoduleclient`),
  ADD KEY `idpersonpaymentsclient` (`idpersonpaymentsclient`);

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
  MODIFY `idmeasurement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
-- Filtros para la tabla `tbpaymentclient`
--
ALTER TABLE `tbpaymentclient`
  ADD CONSTRAINT `tbpaymentclient_ibfk_2` FOREIGN KEY (`idclientschedulepaymentclient`) REFERENCES `tbclientschedule` (`idclientschedule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbpaymentclient_ibfk_3` FOREIGN KEY (`idpaymentmodulepaymentclient`) REFERENCES `tbpaymentmoduleclient` (`idpaymentmoduleclient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbpaymentmoduleclient`
--
ALTER TABLE `tbpaymentmoduleclient`
  ADD CONSTRAINT `tbpaymentmoduleclient_ibfk_1` FOREIGN KEY (`idpersonpaymentsclient`) REFERENCES `tbperson` (`idperson`) ON DELETE CASCADE ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
