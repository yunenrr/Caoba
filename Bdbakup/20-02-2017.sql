--
-- Base de datos: `gymcaoba`
--

create database gymcaoba;
use gymcaoba;


CREATE TABLE IF NOT EXISTS `tbstatusgoods` (
  `idstatusgoods` int(11) NOT NULL,
  `statusstatusgoods` varchar(20),
  PRIMARY KEY (`idstatusgoods`)
)    ;

--
-- Volcado de datos para la tabla `tbstatusgoods`
--

INSERT INTO `tbstatusgoods` (`idstatusgoods`, `statusstatusgoods`) VALUES
(1, 'functionary'),
(2, 'repair'),
(3, 'waste'),
(4, 'Damage in use'),
(5, 'stolen'),
(6, 'donated'),
(7, 'donation');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbaddress`
--

CREATE TABLE IF NOT EXISTS `tbaddress` (
  `idaddress` int(11) NOT NULL,
  `neighborhoodaddress` varchar(15),
  PRIMARY KEY (`idaddress`)
)   ;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbbuy`
--

CREATE TABLE IF NOT EXISTS `tbbuy` (
  `idbuy` int(11) NOT NULL,
  `brandbuy` varchar(15)  ,
  `modelbuy` varchar(15)  ,
  `quantitybuy` int(11) NOT NULL,
  `buydatebuy` date NOT NULL,
  `invoicenumberbuy` int(11) NOT NULL,
  `providerbuy` varchar(15)  ,
  `pricebuy` int(11) NOT NULL,
  `buyerbuy` varchar(15)  ,
  `paymentbuy` int(11) NOT NULL,
  `seriesbuy` varchar(20)  ,
  PRIMARY KEY (`idbuy`)
)   ;



CREATE TABLE `tbcampus` (
  `idcampus` int(11) NOT NULL,
  `namecampus` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbcampus`
--

INSERT INTO `tbcampus` (`idcampus`, `namecampus`) VALUES
(0, 'campus 1'),
(1, 'campus 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientrecord`
--


-- --------------------------------------------------------



CREATE TABLE `tbclientschedule` (
  `idclientschedule` int(11) NOT NULL,
  `idpersonclientschedule` int(11) NOT NULL,
  `startdateclientschedule` date NOT NULL,
  `hourclientschedule` int(11) NOT NULL,
  `dayclientschedule` int(11) NOT NULL,
  `idservicepaymentmoduleclientschedule` int(11) NOT NULL,
  `idserviceclientschedule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `namecondition` varchar(50) NOT NULL,
  `risklevelcondition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(0, 'gelatin', ' 84.4 grams of protein per 100 grams.'),
(1, 'cheese', ' 25.6 grams of protein'),
(2, 'chicken', ' 85, 9 grams of protein'),
(3, 'milk ', '15.9 grams of protein'),
(4, 'almonds', ' 20 grams of protein'),
(5, 'oats', ' 28 grams of protein');

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
(1, 'heterosexual'),
(2, 'homosexual,'),
(3, 'transexual'),
(4, 'bisexual'),
(5, 'male'),
(6, 'female');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbinstructor`
--

CREATE TABLE `tbinstructor` (
  `idinstructor` int(11) NOT NULL,
  `idpersoninstructor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbinventory`
--

CREATE TABLE `tbinventory` (
  `idinventory` int(11) NOT NULL,
  `nameactiveinventory` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quantityinventory` int(11) NOT NULL,
  `priceinventory` int(11) NOT NULL,
  `registrationdateinventory` date DEFAULT NULL,
  `codeactiveinventory` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `locationactveinventory` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmeasurement`
--

CREATE TABLE `tbmeasurement` (
  `idmeasurement` int NOT NULL,
  `idpersonmeasurement` int NOT NULL,
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


-- heightmeasurement

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
(1, 'daily'),
(2, 'weekly'),
(3, 'biweekly'),
(4, 'monthly'),
(5, 'session');

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


INSERT INTO `tbperson` (`idperson`,`dniperson`,`nameperson`,`firstnameperson`,`secondnameperson`,`birthdayperson`,`genderperson`,`emailperson`,`addressperson`,`phonereferenceperson`,`bloodtypeperson`) VALUES (0,'1-123-456','Admin','Admin','Admin','1995-04-12',1,'luisdaca@hotmail.com',0,'4','43');
INSERT INTO `tbperson` (`idperson`,`dniperson`,`nameperson`,`firstnameperson`,`secondnameperson`,`birthdayperson`,`genderperson`,`emailperson`,`addressperson`,`phonereferenceperson`,`bloodtypeperson`) VALUES (1,'1-111-111','karen','calderon','calvo','2013-01-26',1,'vanecalderon_5@hotmail.com',0,'(777)7777-7777','0-');
INSERT INTO `tbperson` (`idperson`,`dniperson`,`nameperson`,`firstnameperson`,`secondnameperson`,`birthdayperson`,`genderperson`,`emailperson`,`addressperson`,`phonereferenceperson`,`bloodtypeperson`) VALUES (2,'7-777-777','Yunen','Ramirez','Arias','1111-11-11',1,'vanecalderon_5@hotmail.com',1,'(777)7777-7777','0-');
INSERT INTO `tbperson` (`idperson`,`dniperson`,`nameperson`,`firstnameperson`,`secondnameperson`,`birthdayperson`,`genderperson`,`emailperson`,`addressperson`,`phonereferenceperson`,`bloodtypeperson`) VALUES (3,'2-222-222','Luis','Castillo','CalderÃ³n','1994-01-12',5,'vanecalderon_5@hotmail.com',2,'(999)9999-9999','A+');
INSERT INTO `tbperson` (`idperson`,`dniperson`,`nameperson`,`firstnameperson`,`secondnameperson`,`birthdayperson`,`genderperson`,`emailperson`,`addressperson`,`phonereferenceperson`,`bloodtypeperson`) VALUES (4,'3-333-333','Sebas','Solano','CalderÃ³n','2013-01-26',5,'va@ho.com',2,'(666)6666-6666','AB+');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpersonstate`
--

CREATE TABLE `tbpersonstate` (
  `idpersonstate` int(11) NOT NULL,
  `idclientpersonstate` int(11) NOT NULL,
  `statepersonstate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
INSERT INTO `tbpersonstate` values(0,0,1);

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
(1, 'father'),
(2, 'mother'),
(3, 'brother'),
(4, 'son');

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

CREATE TABLE `tbscheduleservice` (
  `idscheduleservice` int(11) NOT NULL,
  `datescheduleservice` date NOT NULL,
  `idcampuscheduleservice` int(11) NOT NULL,
  `idservicescheduleservice` int(11) NOT NULL,
  `dayscheduleservice` int(11) NOT NULL,
  `hourscheduleservice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

INSERT INTO `tbuser` (`iduser`,`idpersonuser`,`typeuser`,`usernameuser`,`passuser`,`startdateuser`) VALUES (0,0,1,'admin','1234','0000-00-00');
INSERT INTO `tbuser` (`iduser`,`idpersonuser`,`typeuser`,`usernameuser`,`passuser`,`startdateuser`) VALUES (1,2,2,'instructor','1234','1111-11-11');
INSERT INTO `tbuser` (`iduser`,`idpersonuser`,`typeuser`,`usernameuser`,`passuser`,`startdateuser`) VALUES (2,3,0,'client','1234','2017-02-02');
INSERT INTO `tbuser` (`iduser`,`idpersonuser`,`typeuser`,`usernameuser`,`passuser`,`startdateuser`) VALUES (3,4,2,'sebas','1234','2017-02-02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbcampus`
--
ALTER TABLE `tbcampus`
  ADD PRIMARY KEY (`idcampus`);

--
-- Indices de la tabla `tbclientrecord`
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
  ADD KEY `personfkgender` (`genderperson`);

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
  MODIFY `iddiet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbmeasurement`
--
ALTER TABLE `tbmeasurement`
  MODIFY `idmeasurement` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbclientrecord`
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
  ADD CONSTRAINT `personfkgender` FOREIGN KEY (`genderperson`) REFERENCES `tbgender` (`idgender`) ON DELETE CASCADE ON UPDATE CASCADE;

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
