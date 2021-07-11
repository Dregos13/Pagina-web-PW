CREATE TABLE `ajaxjson` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ajaxjson`
--

INSERT INTO `ajaxjson` (`ID`, `username`, `email`, `url`) VALUES
(1, 'Paco', 'paco@ugr.es', 'http://www.ugr.es'),
(2, 'Juan', 'juan@uned.es', 'http://www.uned.com'),
(3, 'Ana', 'ana@ceuta.com', 'http://www.ceuta.es');
