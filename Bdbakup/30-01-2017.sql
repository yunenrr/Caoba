drop database gymcaoba;
create database gymcaoba;
use gymcaoba;

create table `tbcampus` (
  `idcampus` int(11) not null,
  `namecampus` varchar(60) 
);

--
-- volcado de datos para la tabla `tbcampus`
--

insert into `tbcampus` (`idcampus`, `namecampus`) values
(0, 'campus 1'),
(1, 'campus 2');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbclientrecord`
--

create table `tbclientrecord` (
  `idclientrecord` int(11) not null,
  `idpersonuserclientrecord` varchar(20) ,
  `idservicepaymentmoduleclientrecord` int(11) not null,
  `idrelationservicescheduleclientrecord` int(11) not null,
  `startdateclientrecord` date not null,
  `finaldateclientrecord` date not null
) ;

--
-- volcado de datos para la tabla `tbclientrecord`
--

insert into `tbclientrecord` (`idclientrecord`, `idpersonuserclientrecord`, `idservicepaymentmoduleclientrecord`, `idrelationservicescheduleclientrecord`, `startdateclientrecord`, `finaldateclientrecord`) values
(0, '123', 1, 0, '2017-01-01', '2017-01-23'),
(1, '123', 2, 2, '2017-01-30', '2017-01-30'),
(2, '123', 3, 3, '2017-01-13', '2017-01-30'),
(3, '123', 3, 4, '2017-01-13', '2017-01-30');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbclinicaldetailperson`
--

create table `tbclinicaldetailperson` (
  `idclinicaldetailperson` int(11) not null,
  `idpersonclinicaldetailperson` int(11) not null,
  `idcondictionclinicaldetailperson` int(11) not null
) ;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbcondition`
--

create table `tbcondition` (
  `idcondition` int(11) not null,
  `namecondition` varchar(50)  not null
) ;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbday`
--

create table `tbday` (
  `idday` int(11) not null,
  `nameday` varchar(20)  not null
);

--
-- volcado de datos para la tabla `tbday`
--

insert into `tbday` (`idday`, `nameday`) values
(1, 'sunday'),
(2, 'monday'),
(3, 'tuesday'),
(4, 'wednesday'),
(5, 'thursday'),
(6, 'friday'),
(7, 'saturday');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbdayhourservice`
--

create table `tbdayhourservice` (
  `iddayhourservice` int(11) not null,
  `idcampusservice` int(11) not null,
  `dayservice` int(11) not null,
  `hourstartservice` int(11) not null,
  `hourendservice` int(11) not null,
  `condition` int(11) default '0'
) ;

--
-- volcado de datos para la tabla `tbdayhourservice`
--

insert into `tbdayhourservice` (`iddayhourservice`, `idcampusservice`, `dayservice`, `hourstartservice`, `hourendservice`, `condition`) values
(1, 0, 1, 6, 7, 1),
(2, 0, 1, 7, 8, 0),
(3, 0, 1, 8, 9, 0),
(4, 0, 1, 9, 10, 0),
(5, 0, 1, 10, 11, 0),
(6, 0, 1, 11, 12, 0),
(7, 0, 1, 13, 14, 0),
(8, 0, 1, 14, 15, 0),
(9, 0, 1, 15, 16, 0),
(10, 0, 1, 16, 17, 0),
(11, 0, 1, 17, 18, 0),
(12, 0, 1, 18, 19, 0),
(13, 0, 1, 19, 20, 0),
(14, 0, 1, 20, 21, 0),
(15, 0, 1, 21, 22, 0),
(16, 0, 2, 6, 7, 0),
(17, 0, 2, 7, 8, 0),
(18, 0, 2, 8, 9, 0),
(19, 0, 2, 9, 10, 1),
(20, 0, 2, 10, 11, 1),
(21, 0, 2, 11, 12, 0),
(22, 0, 2, 13, 14, 0),
(23, 0, 2, 14, 15, 0),
(24, 0, 2, 15, 16, 0),
(25, 0, 2, 16, 17, 0),
(26, 0, 2, 17, 18, 0),
(27, 0, 2, 18, 19, 0),
(28, 0, 2, 19, 20, 0),
(29, 0, 2, 20, 21, 0),
(30, 0, 2, 21, 22, 0),
(31, 0, 3, 6, 7, 0),
(32, 0, 3, 7, 8, 0),
(33, 0, 3, 8, 9, 0),
(34, 0, 3, 9, 10, 0),
(35, 0, 3, 10, 11, 0),
(36, 0, 3, 11, 12, 0),
(37, 0, 3, 13, 14, 0),
(38, 0, 3, 14, 15, 0),
(39, 0, 3, 15, 16, 0),
(40, 0, 3, 16, 17, 0),
(41, 0, 3, 17, 18, 0),
(42, 0, 3, 18, 19, 0),
(43, 0, 3, 19, 20, 0),
(44, 0, 3, 20, 21, 0),
(45, 0, 3, 21, 22, 0),
(46, 0, 4, 6, 7, 0),
(47, 0, 4, 7, 8, 0),
(48, 0, 4, 8, 9, 0),
(49, 0, 4, 9, 10, 0),
(50, 0, 4, 10, 11, 0),
(51, 0, 4, 11, 12, 0),
(52, 0, 4, 13, 14, 0),
(53, 0, 4, 14, 15, 0),
(54, 0, 4, 15, 16, 0),
(55, 0, 4, 16, 17, 0),
(56, 0, 4, 17, 18, 0),
(57, 0, 4, 18, 19, 0),
(58, 0, 4, 19, 20, 0),
(59, 0, 4, 20, 21, 0),
(60, 0, 4, 21, 22, 0),
(61, 0, 5, 6, 7, 0),
(62, 0, 5, 7, 8, 0),
(63, 0, 5, 8, 9, 0),
(64, 0, 5, 9, 10, 0),
(65, 0, 5, 10, 11, 0),
(66, 0, 5, 11, 12, 0),
(67, 0, 5, 13, 14, 0),
(68, 0, 5, 14, 15, 0),
(69, 0, 5, 15, 16, 0),
(70, 0, 5, 16, 17, 0),
(71, 0, 5, 17, 18, 0),
(72, 0, 5, 18, 19, 0),
(73, 0, 5, 19, 20, 0),
(74, 0, 5, 20, 21, 0),
(75, 0, 5, 21, 22, 0);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbdiet`
--

create table `tbdiet` (
  `iddiet` int(11) not null,
  `namediet` varchar(50)  default null,
  `descriptiondiet` varchar(50)  default null
) ;

--
-- volcado de datos para la tabla `tbdiet`
--

insert into `tbdiet` (`iddiet`, `namediet`, `descriptiondiet`) values
(1, 'ka', 'ka');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbdietperson`
--

create table `tbdietperson` (
  `iddietperson` int(11) not null,
  `idpersondietperson` int(11) not null,
  `iddietdietperson` int(11) not null
) ;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbdietplan`
--

create table `tbdietplan` (
  `iddietplan` int(11) not null,
  `idfooddietplan` int(11) not null,
  `iddietdietplan` int(11) not null,
  `dietdaydietplan` varchar(20) ,
  `diethourdietplan` int(11) not null
) ;

--
-- volcado de datos para la tabla `tbdietplan`
--

insert into `tbdietplan` (`iddietplan`, `idfooddietplan`, `iddietdietplan`, `dietdaydietplan`, `diethourdietplan`) values
(1, 0, 1, 'monday', 12),
(2, 0, 1, 'monday', 12),
(3, 0, 1, 'monday', 12);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbfamilyparenting`
--

create table `tbfamilyparenting` (
  `idfamilyparenting` int(11) not null,
  `idpersonfamilyparenting` int(11) not null,
  `idrelativefamilyparenting` int(11) not null,
  `idrelationshipfamilyparenting` int(11) not null
) ;

--
-- volcado de datos para la tabla `tbfamilyparenting`
--

insert into `tbfamilyparenting` (`idfamilyparenting`, `idpersonfamilyparenting`, `idrelativefamilyparenting`, `idrelationshipfamilyparenting`) values
(1, 1, 2, 3);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbfood`
--

create table `tbfood` (
  `idfood` int(11) not null,
  `namefood` varchar(50) ,
  `nutritionalvaluefood` varchar(50) 
) ;

--
-- volcado de datos para la tabla `tbfood`
--

insert into `tbfood` (`idfood`, `namefood`, `nutritionalvaluefood`) values
(0, 'gelatin', ' 84.4 grams of protein per 100 grams.'),
(1, 'cheese', ' 25.6 grams of protein'),
(2, 'chicken', ' 85, 9 grams of protein'),
(3, 'milk ', '15.9 grams of protein'),
(4, 'almonds', ' 20 grams of protein'),
(5, 'oats', ' 28 grams of protein');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbgender`
--

create table `tbgender` (
  `idgender` int(11) not null,
  `namegender` varchar(20)  not null
);

--
-- volcado de datos para la tabla `tbgender`
--

insert into `tbgender` (`idgender`, `namegender`) values
(1, 'heterosexual'),
(2, 'homosexual,'),
(3, 'transexual'),
(4, 'bisexual'),
(5, 'male'),
(6, 'female');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbhour`
--

create table `tbhour` (
  `idhour` int(11) not null,
  `numberhour` int(11) not null
) ;

--
-- volcado de datos para la tabla `tbhour`
--

insert into `tbhour` (`idhour`, `numberhour`) values
(1, 0),
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(6, 5),
(7, 6),
(8, 7),
(9, 8),
(10, 9),
(11, 10),
(12, 11),
(13, 12),
(14, 13),
(15, 14),
(16, 15),
(17, 16),
(18, 17),
(19, 18),
(20, 19),
(21, 20),
(22, 21),
(23, 22),
(24, 23);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbinstructor`
--

create table `tbinstructor` (
  `idinstructor` int(11) not null,
  `idpersoninstructor` int(11) not null
) ;

--
-- volcado de datos para la tabla `tbinstructor`
--

insert into `tbinstructor` (`idinstructor`, `idpersoninstructor`) values
(0, 0),
(1, 0);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbinventory`
--

create table `tbinventory` (
  `idinventory` int(11) not null,
  `nameactiveinventory` varchar(50)  not null,
  `quantityinventory` int(11) not null,
  `priceinventory` int(11) not null,
  `registrationdateinventory` date default null,
  `codeactiveinventory` varchar(20)  not null,
  `locationactveinventory` varchar(50)  not null
) ;

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbmeasurement`
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

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbpaymentmodule`
--

create table `tbpaymentmodule` (
  `idpaymentmodule` int(11) not null,
  `namepaymentmodule` varchar(50)  not null
) ;

--
-- volcado de datos para la tabla `tbpaymentmodule`
--

insert into `tbpaymentmodule` (`idpaymentmodule`, `namepaymentmodule`) values
(1, 'daily'),
(2, 'weekly'),
(3, 'biweekly'),
(4, 'monthly'),
(5, 'session');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbperson`
--

create table `tbperson` (
  `idperson` int(11) not null,
  `dniperson` varchar(20)  not null,
  `nameperson` varchar(50)  not null,
  `firstnameperson` varchar(50)  not null,
  `secondnameperson` varchar(50)  not null,
  `ageperson` int(11) not null,
  `genderperson` int(11) not null,
  `emailperson` varchar(40)  not null,
  `addressperson` varchar(60)  not null,
  `phonereferenceperson` varchar(20)  not null,
  `bloodtypeperson` varchar(10)  not null
) ;

--
-- volcado de datos para la tabla `tbperson`
--

insert into `tbperson` (`idperson`, `dniperson`, `nameperson`, `firstnameperson`, `secondnameperson`, `ageperson`, `genderperson`, `emailperson`, `addressperson`, `phonereferenceperson`, `bloodtypeperson`) values
(0, '33', '3q3', '33', '3', 3, 1, 'dd', 'dd', '4', '43'),
(1, '123', '3q3', '33', '3', 3, 1, 'dd', 'dd', '4', '43'),
(2, '123123456', 'ewrty', 'sdfdg', 'sdfg', 22, 1, 'd@fg', 's', '', '0+'),
(3, '2323', 'diego', 'sd', 'sd', 556, 1, 'ds@dd.com', 'dds', '323', '0-');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbpersonstate`
--

create table `tbpersonstate` (
  `idpersonstate` int(11) not null,
  `idclientpersonstate` varchar(20) ,
  `statepersonstate` int(11) not null
) ;

--
-- volcado de datos para la tabla `tbpersonstate`
--

insert into `tbpersonstate` (`idpersonstate`, `idclientpersonstate`, `statepersonstate`) values
(0, '33', 0),
(1, '123', 1),
(3, '123123456', 1),
(4, '2323', 1);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbphone`
--

create table `tbphone` (
  `idphone` int(11) not null,
  `idclientphone` int(11) not null,
  `numberphone` varchar(20)  not null
) ;

--
-- volcado de datos para la tabla `tbphone`
--

insert into `tbphone` (`idphone`, `idclientphone`, `numberphone`) values
(1, 0, '8687678'),
(2, 0, '6786786767'),
(3, 1, '2345678'),
(4, 0, '2345'),
(5, 0, '1234'),
(6, 0, '12'),
(7, 0, '333');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbrelationserviceschedule`
--

create table `tbrelationserviceschedule` (
  `idrelationserviceschedule` int(11) not null,
  `iddayhourservice` int(11) not null,
  `idservice` int(11) not null,
  `quotaservice` int(11) not null
) ;

--
-- volcado de datos para la tabla `tbrelationserviceschedule`
--

insert into `tbrelationserviceschedule` (`idrelationserviceschedule`, `iddayhourservice`, `idservice`, `quotaservice`) values
(0, 4, 0, 0),
(2, 7, 2, 0),
(3, 16, 3, 0),
(4, 40, 3, 0),
(6, 19, 2, 20),
(7, 20, 2, 20),
(8, 10, 2, 333),
(11, 1, 1, 20);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbrelationship`
--

create table `tbrelationship` (
  `idrelationship` int(11) not null,
  `namerelationship` varchar(50)  not null
) ;

--
-- volcado de datos para la tabla `tbrelationship`
--

insert into `tbrelationship` (`idrelationship`, `namerelationship`) values
(1, 'father'),
(2, 'mother'),
(3, 'brother'),
(4, 'son');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbroutine`
--

create table `tbroutine` (
  `idroutine` int(11) not null,
  `idpersonroutine` int(11) not null,
  `nameroutine` varchar(20)  not null,
  `seriesroutine` int(11) not null,
  `repetitionsroutine` int(11) not null,
  `commentroutine` varchar(40)  not null,
  `muscleroutine` int(11) not null
) ;

--
-- volcado de datos para la tabla `tbroutine`
--

insert into `tbroutine` (`idroutine`, `idpersonroutine`, `nameroutine`, `seriesroutine`, `repetitionsroutine`, `commentroutine`, `muscleroutine`) values
(1, 1, 'wert', 2, 2, 'sd', 0);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbservice`
--

create table `tbservice` (
  `idservice` int(11) not null,
  `idinstructorservice` int(11) not null,
  `nameservice` varchar(20)  not null,
  `descriptionservice` varchar(50)  not null,
  `quotaservice` int(11) not null,
  `stardateservice` date not null,
  `enddateservice` date not null
) ;

--
-- volcado de datos para la tabla `tbservice`
--

insert into `tbservice` (`idservice`, `idinstructorservice`, `nameservice`, `descriptionservice`, `quotaservice`, `stardateservice`, `enddateservice`) values
(0, 0, 'boxeo', 'pichazos ', 20, '2017-01-25', '2018-01-25'),
(1, 0, 'cardio', 'trtr', 20, '2017-01-25', '2018-01-25'),
(2, 0, 'rerrer', 'rere', 20, '2017-01-18', '2017-01-17'),
(3, 0, 'servico 1', 'descripcion 1', 20, '2017-01-01', '2017-06-01');

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbservicepaymentmodule`
--

create table `tbservicepaymentmodule` (
  `idservicepaymentmodule` int(11) not null,
  `idserviceservicepaymentmodule` int(11) not null,
  `idpaymentmoduleservicepaymentmodule` int(11) not null,
  `priceservicepaymentmodule` int(11) not null
) ;

--
-- volcado de datos para la tabla `tbservicepaymentmodule`
--

insert into `tbservicepaymentmodule` (`idservicepaymentmodule`, `idserviceservicepaymentmodule`, `idpaymentmoduleservicepaymentmodule`, `priceservicepaymentmodule`) values
(0, 0, 4, 9000),
(1, 1, 3, 500),
(2, 2, 5, 45),
(3, 3, 3, 4565),
(4, 0, 1, 2300),
(5, 0, 3, 2300),
(6, 0, 2, 2300);

-- --------------------------------------------------------

--
-- estructura de tabla para la tabla `tbuser`
--

create table `tbuser` (
  `iduser` int(11) not null,
  `idpersonuser` varchar(20)  not null,
  `typeuser` int(11) not null,
  `usernameuser` varchar(50)  not null,
  `passuser` varchar(50)  not null
) ;

--
-- volcado de datos para la tabla `tbuser`
--

insert into `tbuser` (`iduser`, `idpersonuser`, `typeuser`, `usernameuser`, `passuser`) values
(0, '123', 0, 'ewe', '34324'),
(1, '123123456', 0, 'sdsfg', 'dfdgfh'),
(2, '33', 0, 'fef', 'frf'),
(3, '2323', 0, 'd', 'sdsd');

--
-- índices para tablas volcadas
--

--
-- indices de la tabla `tbcampus`
--
alter table `tbcampus`
  add primary key (`idcampus`);

--
-- indices de la tabla `tbclientrecord`
--
alter table `tbclientrecord`
  add primary key (`idclientrecord`),
  add unique key `idclientrecord` (`idclientrecord`),
  add key `clientrecordfkservicepaymentmodule` (`idservicepaymentmoduleclientrecord`),
  add key `clientrecordfktbrelationserviceschedule` (`idrelationservicescheduleclientrecord`),
  add key `clientrecordfktbuser` (`idpersonuserclientrecord`);

--
-- indices de la tabla `tbclinicaldetailperson`
--
alter table `tbclinicaldetailperson`
  add primary key (`idclinicaldetailperson`),
  add unique key `idclinicaldetailperson` (`idclinicaldetailperson`),
  add key `personfkperson` (`idpersonclinicaldetailperson`),
  add key `condictionfkcondition` (`idcondictionclinicaldetailperson`);

--
-- indices de la tabla `tbcondition`
--
alter table `tbcondition`
  add primary key (`idcondition`),
  add unique key `id` (`idcondition`);

--
-- indices de la tabla `tbday`
--
alter table `tbday`
  add primary key (`idday`);

--
-- indices de la tabla `tbdayhourservice`
--
alter table `tbdayhourservice`
  add primary key (`iddayhourservice`),
  add key `servicefkday` (`dayservice`),
  add key `servicefkcampus` (`idcampusservice`),
  add key `servicefkhourstart` (`hourstartservice`),
  add key `servicefkhourend` (`hourendservice`);

--
-- indices de la tabla `tbdiet`
--
alter table `tbdiet`
  add primary key (`iddiet`),
  add unique key `iddiet` (`iddiet`),
  add unique key `id` (`iddiet`);

--
-- indices de la tabla `tbdietperson`
--
alter table `tbdietperson`
  add primary key (`iddietperson`),
  add unique key `iddietperson` (`iddietperson`),
  add unique key `id` (`iddietperson`),
  add key `dietpersonfkperson` (`idpersondietperson`),
  add key `dietpersonfkdiet` (`iddietdietperson`);

--
-- indices de la tabla `tbdietplan`
--
alter table `tbdietplan`
  add primary key (`iddietplan`),
  add unique key `iddietplan` (`iddietplan`),
  add unique key `id` (`iddietplan`),
  add key `dietplanfkfood` (`idfooddietplan`),
  add key `dietplanfkdiet` (`iddietdietplan`);

--
-- indices de la tabla `tbfamilyparenting`
--
alter table `tbfamilyparenting`
  add primary key (`idfamilyparenting`),
  add unique key `id` (`idfamilyparenting`),
  add key `relativefkfamilyparenting` (`idrelativefamilyparenting`),
  add key `relationshippkfamilyparenting` (`idrelationshipfamilyparenting`),
  add key `personfkfamilyparenting` (`idpersonfamilyparenting`);

--
-- indices de la tabla `tbfood`
--
alter table `tbfood`
  add primary key (`idfood`),
  add unique key `idfood` (`idfood`),
  add unique key `id` (`idfood`);

--
-- indices de la tabla `tbgender`
--
alter table `tbgender`
  add primary key (`idgender`),
  add unique key `id` (`idgender`);

--
-- indices de la tabla `tbhour`
--
alter table `tbhour`
  add primary key (`idhour`);

--
-- indices de la tabla `tbinstructor`
--
alter table `tbinstructor`
  add primary key (`idinstructor`),
  add unique key `id` (`idinstructor`),
  add key `instructorfkperson` (`idpersoninstructor`);

--
-- indices de la tabla `tbinventory`
--
alter table `tbinventory`
  add primary key (`idinventory`),
  add unique key `idinventory` (`idinventory`),
  add unique key `id` (`idinventory`);

--
-- indices de la tabla `tbmeasurement`
--
alter table `tbmeasurement`
  add primary key (`idmeasurement`),
  add unique key `id` (`idmeasurement`),
  add key `measurementfkperson` (`idpersonmeasurement`);

--
-- indices de la tabla `tbpaymentmodule`
--
alter table `tbpaymentmodule`
  add primary key (`idpaymentmodule`),
  add unique key `id` (`idpaymentmodule`);

--
-- indices de la tabla `tbperson`
--
alter table `tbperson`
  add primary key (`idperson`),
  add unique key `dniperson` (`dniperson`),
  add unique key `id` (`idperson`),
  add key `personfkgender` (`genderperson`);

--
-- indices de la tabla `tbpersonstate`
--
alter table `tbpersonstate`
  add primary key (`idpersonstate`),
  add unique key `id` (`idpersonstate`),
  add key `personstatefkperson` (`idclientpersonstate`);

--
-- indices de la tabla `tbphone`
--
alter table `tbphone`
  add primary key (`idphone`),
  add unique key `idphone` (`idphone`),
  add unique key `id` (`idphone`),
  add key `personphonefkperson` (`idclientphone`);

--
-- indices de la tabla `tbrelationserviceschedule`
--
alter table `tbrelationserviceschedule`
  add primary key (`idrelationserviceschedule`),
  add unique key `idrelationserviceschedule` (`idrelationserviceschedule`),
  add key `relationserviceschedulefkiddayhourservice` (`iddayhourservice`),
  add key `relationserviceschedulefkidservice` (`idservice`);

--
-- indices de la tabla `tbrelationship`
--
alter table `tbrelationship`
  add primary key (`idrelationship`),
  add unique key `id` (`idrelationship`);

--
-- indices de la tabla `tbroutine`
--
alter table `tbroutine`
  add primary key (`idroutine`),
  add unique key `idroutine` (`idroutine`),
  add unique key `id` (`idroutine`),
  add key `routinefkperson` (`idpersonroutine`);

--
-- indices de la tabla `tbservice`
--
alter table `tbservice`
  add primary key (`idservice`),
  add unique key `id` (`idservice`),
  add key `servicefkinstructor` (`idinstructorservice`);

--
-- indices de la tabla `tbservicepaymentmodule`
--
alter table `tbservicepaymentmodule`
  add primary key (`idservicepaymentmodule`),
  add unique key `idservicepaymentmodule` (`idservicepaymentmodule`),
  add key `servicefkservicepaymentmodule` (`idserviceservicepaymentmodule`),
  add key `paymentmodulefkservicepaymentmodule` (`idpaymentmoduleservicepaymentmodule`);

--
-- indices de la tabla `tbuser`
--
alter table `tbuser`
  add primary key (`iduser`),
  add unique key `id` (`iduser`),
  add unique key `username` (`usernameuser`),
  add unique key `userfkperson` (`idpersonuser`);

--
-- auto_increment de las tablas volcadas
--

--
-- auto_increment de la tabla `tbdiet`
--
alter table `tbdiet`
  modify `iddiet` int(11) not null auto_increment, auto_increment=2;
--
-- auto_increment de la tabla `tbmeasurement`
--
alter table `tbmeasurement`
  modify `idmeasurement` int(11) not null auto_increment;
--
-- restricciones para tablas volcadas
--

--
-- filtros para la tabla `tbclientrecord`
--
alter table `tbclientrecord`
  add constraint `clientrecordfkservicepaymentmodule` foreign key (`idservicepaymentmoduleclientrecord`) references `tbservicepaymentmodule` (`idservicepaymentmodule`) on delete cascade on update cascade,
  add constraint `clientrecordfktbrelationserviceschedule` foreign key (`idrelationservicescheduleclientrecord`) references `tbrelationserviceschedule` (`idrelationserviceschedule`) on delete cascade on update cascade,
  add constraint `clientrecordfktbuser` foreign key (`idpersonuserclientrecord`) references `tbuser` (`idpersonuser`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbclinicaldetailperson`
--
alter table `tbclinicaldetailperson`
  add constraint `condictionfkcondition` foreign key (`idcondictionclinicaldetailperson`) references `tbcondition` (`idcondition`) on delete cascade on update cascade,
  add constraint `personfkperson` foreign key (`idpersonclinicaldetailperson`) references `tbperson` (`idperson`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbdayhourservice`
--
alter table `tbdayhourservice`
  add constraint `servicefkcampus` foreign key (`idcampusservice`) references `tbcampus` (`idcampus`) on delete cascade on update cascade,
  add constraint `servicefkday` foreign key (`dayservice`) references `tbday` (`idday`) on delete cascade on update cascade,
  add constraint `servicefkhourend` foreign key (`hourendservice`) references `tbhour` (`idhour`) on delete cascade on update cascade,
  add constraint `servicefkhourstart` foreign key (`hourstartservice`) references `tbhour` (`idhour`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbdietperson`
--
alter table `tbdietperson`
  add constraint `dietpersonfkdiet` foreign key (`iddietdietperson`) references `tbdiet` (`iddiet`) on delete cascade on update cascade,
  add constraint `dietpersonfkperson` foreign key (`idpersondietperson`) references `tbperson` (`idperson`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbdietplan`
--
alter table `tbdietplan`
  add constraint `dietplanfkdiet` foreign key (`iddietdietplan`) references `tbdiet` (`iddiet`) on delete cascade on update cascade,
  add constraint `dietplanfkfood` foreign key (`idfooddietplan`) references `tbfood` (`idfood`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbfamilyparenting`
--
alter table `tbfamilyparenting`
  add constraint `personfkfamilyparenting` foreign key (`idpersonfamilyparenting`) references `tbperson` (`idperson`) on delete cascade on update cascade,
  add constraint `relationshippkfamilyparenting` foreign key (`idrelationshipfamilyparenting`) references `tbrelationship` (`idrelationship`) on delete cascade on update cascade,
  add constraint `relativefkfamilyparenting` foreign key (`idrelativefamilyparenting`) references `tbperson` (`idperson`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbinstructor`
--
alter table `tbinstructor`
  add constraint `instructorfkperson` foreign key (`idpersoninstructor`) references `tbperson` (`idperson`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbmeasurement`
--
alter table `tbmeasurement`
  add constraint `measurementfkperson` foreign key (`idpersonmeasurement`) references `tbperson` (`dniperson`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbperson`
--
alter table `tbperson`
  add constraint `personfkgender` foreign key (`genderperson`) references `tbgender` (`idgender`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbpersonstate`
--
alter table `tbpersonstate`
  add constraint `personstatefkperson` foreign key (`idclientpersonstate`) references `tbperson` (`dniperson`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbphone`
--
alter table `tbphone`
  add constraint `personphonefkperson` foreign key (`idclientphone`) references `tbperson` (`idperson`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbrelationserviceschedule`
--
alter table `tbrelationserviceschedule`
  add constraint `relationserviceschedulefkiddayhourservice` foreign key (`iddayhourservice`) references `tbdayhourservice` (`iddayhourservice`) on delete cascade on update cascade,
  add constraint `relationserviceschedulefkidservice` foreign key (`idservice`) references `tbservice` (`idservice`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbroutine`
--
alter table `tbroutine`
  add constraint `routinefkperson` foreign key (`idpersonroutine`) references `tbperson` (`idperson`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbservice`
--
alter table `tbservice`
  add constraint `servicefkinstructor` foreign key (`idinstructorservice`) references `tbinstructor` (`idinstructor`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbservicepaymentmodule`
--
alter table `tbservicepaymentmodule`
  add constraint `paymentmodulefkservicepaymentmodule` foreign key (`idpaymentmoduleservicepaymentmodule`) references `tbpaymentmodule` (`idpaymentmodule`) on delete cascade on update cascade,
  add constraint `servicefkservicepaymentmodule` foreign key (`idserviceservicepaymentmodule`) references `tbservice` (`idservice`) on delete cascade on update cascade;

--
-- filtros para la tabla `tbuser`
--
alter table `tbuser`
  add constraint `userfkperson` foreign key (`idpersonuser`) references `tbperson` (`dniperson`) on delete cascade on update cascade;
