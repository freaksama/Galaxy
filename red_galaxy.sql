-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 29-05-2016 a las 20:03:41
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `red_galaxy`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `bloqueos_ip`
-- 

CREATE TABLE `bloqueos_ip` (
  `id_bloqueo_ip` int(11) NOT NULL auto_increment,
  `ip` varchar(16) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `motivo` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY  (`id_bloqueo_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `bloqueos_ip`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `busquedas`
-- 

CREATE TABLE `busquedas` (
  `id_busqueda` int(11) NOT NULL auto_increment,
  `consulta` text NOT NULL,
  `nav` varchar(512) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY  (`id_busqueda`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `busquedas`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `comentarios`
-- 

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL auto_increment,
  `id_ref` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` datetime NOT NULL,
  `id_tipo_comentario` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY  (`id_comentario`),
  KEY `idx_id_ref` (`id_ref`,`id_tipo_comentario`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `comentarios`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `contenido`
-- 

CREATE TABLE `contenido` (
  `id_contenido` int(11) NOT NULL auto_increment,
  `id_tipo_contenido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_rt` int(11) NOT NULL,
  `id_usuario_rt` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL default '7',
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `link` varchar(512) NOT NULL,
  `src` varchar(512) NOT NULL,
  `codigo` text NOT NULL,
  `tags` varchar(256) NOT NULL,
  `tipo_archivo` varchar(8) NOT NULL,
  `tamanio` varchar(16) NOT NULL,
  `fecha_c` datetime NOT NULL,
  `fecha_m` datetime NOT NULL,
  `fecha_p` datetime NOT NULL,
  `adulto` varchar(1) NOT NULL,
  `fav` varchar(1) NOT NULL,
  `visibilidad` varchar(1) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `status` varchar(1) NOT NULL,
  `veces_visto` int(11) NOT NULL,
  `num_com` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `num_rt` int(11) NOT NULL,
  `reporte` varchar(1) NOT NULL default 'N',
  `visto_bueno` varchar(1) NOT NULL default 'N',
  PRIMARY KEY  (`id_contenido`),
  KEY `idx_rt` (`id_rt`,`status`),
  KEY `idx_rt_2` (`id_rt`),
  KEY `idx_general` (`status`,`visibilidad`,`fecha_p`,`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `contenido`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `contenido_imagenes`
-- 

CREATE TABLE `contenido_imagenes` (
  `id_imagen` int(11) NOT NULL auto_increment,
  `id_contenido` int(11) NOT NULL,
  `src` varchar(512) NOT NULL,
  `tipo_archivo` varchar(8) NOT NULL,
  `tamanio` varchar(16) NOT NULL,
  PRIMARY KEY  (`id_imagen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `contenido_imagenes`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `correos_pendientes`
-- 

CREATE TABLE `correos_pendientes` (
  `id_correo_p` int(11) NOT NULL auto_increment,
  `fromc` varchar(128) character set utf8 NOT NULL,
  `toc` varchar(128) character set utf8 NOT NULL,
  `asunto` varchar(128) character set utf8 NOT NULL,
  `mensaje` text character set utf8 NOT NULL,
  `plantilla` varchar(1) character set utf8 NOT NULL,
  `tipo` varchar(1) character set utf8 NOT NULL,
  `fecha_c` datetime NOT NULL,
  `fecha_e` datetime NOT NULL,
  `status` varchar(1) character set utf8 NOT NULL,
  PRIMARY KEY  (`id_correo_p`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `correos_pendientes`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `c_categorias`
-- 

CREATE TABLE `c_categorias` (
  `id_categoria` int(11) NOT NULL auto_increment,
  `nombre_categoria` varchar(64) character set utf8 NOT NULL,
  `codigo_categoria` varchar(16) character set utf8 NOT NULL,
  `descripcion` text character set utf8 NOT NULL,
  `img` varchar(256) character set utf8 NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nsfw` varchar(1) character set utf8 NOT NULL,
  `status` varchar(1) character set utf8 NOT NULL,
  PRIMARY KEY  (`id_categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- 
-- Volcar la base de datos para la tabla `c_categorias`
-- 

INSERT INTO `c_categorias` VALUES (1, 'Anime', 'anime', 'Contenido para otakus, anime, manga y cultura friki ', 'img/anime-48.png', '2015-01-06', 1, '', 'A');
INSERT INTO `c_categorias` VALUES (2, 'Gamer', 'videojuegos', 'Contenido para videojugarores. Nintendo playstation, xbox', 'img/game-48.png', '2015-01-06', 1, '', 'A');
INSERT INTO `c_categorias` VALUES (3, 'Deportes', 'deportes', 'Todo el contenido para futbol, tenis, fulbol americano, todos los deportes', 'img/deporte-48.png', '2015-01-06', 1, '', 'A');
INSERT INTO `c_categorias` VALUES (4, 'Música', 'musica', 'Toco lo consentirte a la musica. Cantantes y musica en general.  ', 'img/musica-48.png', '2016-02-18', 1, '', 'C');
INSERT INTO `c_categorias` VALUES (5, 'Moda y Fama', 'moda', 'Todo lo que tenga que ver con los espectaculos.', 'img/moda-48.png', '2015-01-06', 1, '', 'A');
INSERT INTO `c_categorias` VALUES (6, 'Cine', 'cine', 'Contenido para cinefilos. ', 'img/cine-48.png', '2015-01-06', 1, '', 'A');
INSERT INTO `c_categorias` VALUES (7, 'Random', 'random', 'Contenido random todo es permitido aqui', 'img/random-48.png', '2015-01-06', 1, '', 'A');
INSERT INTO `c_categorias` VALUES (8, 'Libros', 'libros', '', 'img/libros-48.png', '2015-01-09', 1, '', 'A');
INSERT INTO `c_categorias` VALUES (9, 'Adulto', 'nsfw', 'Contenido para adulto', 'img/adulto-64.png', '2015-02-05', 1, 'S', 'A');
INSERT INTO `c_categorias` VALUES (10, 'Comic', 'comic', 'Comic en general DC, Marvel', 'img/batman-128.png', '2015-04-20', 1, '', 'A');
INSERT INTO `c_categorias` VALUES (11, 'Animacion', 'animacion', 'caricaturas en general estadounidenses', 'img/animacion-150.jpg', '2015-07-02', 1, '', 'A');
INSERT INTO `c_categorias` VALUES (13, 'Autos', '', 'Todo lo que tenga que ver con veiculos ', '', '2015-07-02', 1, '', 'C');
INSERT INTO `c_categorias` VALUES (14, 'Hentai', 'Hentai', 'Solo hentai y del bueno xD á', 'img/ecchi-32.png', '2015-07-02', 1, 'S', 'A');
INSERT INTO `c_categorias` VALUES (15, 'Autos ', '', 'Todo lo que tenga que ver con autos ', 'img/car-128.png', '2015-07-02', 1, 'n', 'A');
INSERT INTO `c_categorias` VALUES (16, 'Porno', '', 'des', 'img/hentai-32.png', '2015-07-04', 1, 'S', 'C');
INSERT INTO `c_categorias` VALUES (17, 'Motos', 'motocicletas', 'Descripcion motos', '', '2015-07-02', 1, 'N', 'A');
INSERT INTO `c_categorias` VALUES (18, 'LGBT', 'lgbt', 'Solo gays', 'img/lgbt-32.png', '2015-07-02', 1, 'N', 'A');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `c_ip`
-- 

CREATE TABLE `c_ip` (
  `id_ip` int(11) NOT NULL auto_increment,
  `nombre_ip` varchar(128) character set utf8 NOT NULL,
  `ip` varchar(16) NOT NULL,
  `des` text character set utf8 NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY  (`id_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `c_ip`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `c_sexo`
-- 

CREATE TABLE `c_sexo` (
  `id_sexo` int(11) NOT NULL auto_increment,
  `nombre_sexo` varchar(128) NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY  (`id_sexo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

-- 
-- Volcar la base de datos para la tabla `c_sexo`
-- 

INSERT INTO `c_sexo` VALUES (1, 'Hombre', '0000-00-00', 0, 'A');
INSERT INTO `c_sexo` VALUES (2, 'Mujer', '0000-00-00', 0, 'A');
INSERT INTO `c_sexo` VALUES (3, 'Soy un robot', '0000-00-00', 0, 'A');
INSERT INTO `c_sexo` VALUES (4, 'Gay', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (5, 'Lesbiana', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (6, 'Traps', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (7, 'Bestia', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (8, 'Transexual', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (9, 'Homosexual', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (10, 'Mutante', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (11, 'Extraterreste', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (12, 'Friki', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (13, 'Travesti', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (14, 'Neutro', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (15, 'Ninguno', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (16, 'Pansexual', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (17, 'Asexual mujer', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (18, 'Asexual varón', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (19, 'Mujer bisexual', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (20, 'Varón bisexual', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (21, 'Poliamorosx', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (22, 'Poliamorosa', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (23, 'Poliamoroso', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (24, 'Mujer heterosexual', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (25, 'Varón heterosexual', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (26, 'Mujer homosexual', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (27, 'Varón homosexual', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (28, 'Puto', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (29, 'Torta', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (30, 'Trava', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (31, 'Mujer heteroflexible', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (32, 'Varón heteroflexible', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (33, 'Lesboflexible', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (34, 'Cysexual masculino', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (35, 'Cysexual masculina', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (36, 'Cysexual femenina', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (37, 'Cysexual femenino', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (38, 'Cysexual mujer', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (39, 'Cysexual varón.', '2014-12-16', 1, 'A');
INSERT INTO `c_sexo` VALUES (40, 'Nuevo sexo', '2015-10-02', 1, 'A');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `c_situaciones`
-- 

CREATE TABLE `c_situaciones` (
  `id_situacion` int(11) NOT NULL auto_increment,
  `nombre_situacion` varchar(64) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY  (`id_situacion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

-- 
-- Volcar la base de datos para la tabla `c_situaciones`
-- 

INSERT INTO `c_situaciones` VALUES (1, 'Soltero(a)', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (2, 'Casado(a)', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (3, 'Divorciado(a)', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (4, 'Viudo(a)', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (5, 'Separado(a)', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (6, 'Enamorado(a) *_*', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (7, 'Confundido(a) :s', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (8, 'Sin Compromiso', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (9, 'Extrañándote ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (10, 'Jugando minicraft', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (11, 'Cupido me odia', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (12, 'Hasta Rexona me abandona', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (13, 'Forever Alone ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (14, 'Esperando un milagro', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (15, 'Es complicado ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (16, 'Con menos suerte que la ardilla de la era de hielo', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (17, 'Pensado seriamente volverme sacerdote ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (18, 'Hace varias noches que ya no espero un mensaje tuyo ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (19, 'Más vale solo que mal acompañado', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (20, 'Todas mías ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (21, 'Tengo hambre ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (22, 'Todavía nadie logra domarme ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (23, 'En busca de mi pareja perfecta ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (24, 'La quiero pero ella a mí no', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (25, 'Lo quiero pero él a mí no ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (26, 'Mi media naranja alguien la hizo jugo', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (27, 'Esta cabrón mantener a alguien que no sea nada tuyo ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (28, 'Corazón herido y maltratado ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (29, 'Buscando algo inusual en los demás ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (30, 'Completamente Feliz!', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (31, 'Tengo una relación', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (32, 'Tengo una relación abierta', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (33, 'Tengo amigovias', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (34, 'Tengo amigovios', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (35, 'Aquí borrando de la penca del maguey tu nombre', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (36, 'Lo importante es que tenemos salud', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (37, 'Autosuficiente ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (38, 'Todo depende de ti ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (39, 'Enamorado(a) de un personaje Ficticio', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (40, 'Maldecido por no enviar cadenas de amor', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (41, 'Mágica: Nada por aquí, nada por allá', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (42, 'Jugando al Candy Crush :D', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (43, 'Mi mamá me Ama', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (44, 'Esperando a alguien que valga la pena ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (45, 'Me voy a disfrazar de campana a ver si alguien me toca ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (46, 'Acá engordando', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (47, 'En una relación eterna con mi cama, la comida y mi música. ', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (48, 'En una relación seria con la cerveza', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (49, 'Con ganas de portarme mal', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (50, 'Siéndole fiel a alguien sin ser nada', 1, '2015-08-17', 'A');
INSERT INTO `c_situaciones` VALUES (51, 'En pijama todo el día', 1, '2015-08-17', 'A');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `c_tipo_comentarios`
-- 

CREATE TABLE `c_tipo_comentarios` (
  `id_tipo_comentario` int(11) NOT NULL auto_increment,
  `nombre_tipo` varchar(64) NOT NULL,
  PRIMARY KEY  (`id_tipo_comentario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `c_tipo_comentarios`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `c_tipo_contenido`
-- 

CREATE TABLE `c_tipo_contenido` (
  `id_tipo_contenido` int(11) NOT NULL auto_increment,
  `nombre_contenido` varchar(64) character set utf8 NOT NULL,
  `des` varchar(128) character set utf8 NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(1) character set utf8 NOT NULL,
  PRIMARY KEY  (`id_tipo_contenido`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Volcar la base de datos para la tabla `c_tipo_contenido`
-- 

INSERT INTO `c_tipo_contenido` VALUES (1, 'Links', 'Grupo para los links del sistema', '2014-11-03', 'A');
INSERT INTO `c_tipo_contenido` VALUES (2, 'Imagenes', 'Grupos para imagenes del sistema ', '2014-11-03', 'A');
INSERT INTO `c_tipo_contenido` VALUES (5, 'Contacto', 'Grupo para los contactos', '2014-11-05', 'A');
INSERT INTO `c_tipo_contenido` VALUES (3, 'Videos', 'Grupo para los videos ', '2014-11-03', 'A');
INSERT INTO `c_tipo_contenido` VALUES (4, 'Libros', 'Grupo para los libros', '2014-11-03', 'A');
INSERT INTO `c_tipo_contenido` VALUES (6, 'Estado', 'Estado actual del usuario', '2014-11-20', 'A');
INSERT INTO `c_tipo_contenido` VALUES (7, 'Podcast', 'Para comparti el link de la descarga del podcart', '2015-02-18', 'A');
INSERT INTO `c_tipo_contenido` VALUES (8, 'Preguntas', 'Para que entre usurios se puedan hacer preguntas ', '2015-02-18', 'A');
INSERT INTO `c_tipo_contenido` VALUES (9, 'Musica', 'Archivos mp3', '2016-03-28', 'A');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `c_tipo_notificaciones`
-- 

CREATE TABLE `c_tipo_notificaciones` (
  `id_tipo_notificacion` int(11) NOT NULL auto_increment,
  `nombre_tipo` varchar(256) NOT NULL,
  `descripcion` text NOT NULL,
  `nivel` varchar(1) NOT NULL,
  PRIMARY KEY  (`id_tipo_notificacion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Volcar la base de datos para la tabla `c_tipo_notificaciones`
-- 

INSERT INTO `c_tipo_notificaciones` VALUES (1, 'Aumento Karma', 'Aumento +1 de karma', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (2, 'Disminuir karma', 'Disminución -1 de karma', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (3, 'Comentario', 'Un usuario realizo un comentario acerca de un link ', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (4, 'Pregunta Hecha', 'Pregunta que te ha hecho un otro usuario a ti ', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (5, 'Pregunta Respondida', 'Pregunta que te han respondido', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (6, 'Cambio de Avatar', 'Cambio de avatar ', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (7, 'Actualizacion de bio', 'El usuario ha actualizado su bio', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (8, 'Cambio de sexo ', 'El usuario a cambiado de sexo', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (10, 'Compartir', 'Se lanza cuando se comparte un contenido de otro usuario', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (9, 'Nuevo seguidor', 'Se lanza cuando tienes un nuevo seguidor ', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (11, 'Mención ', 'Se lanza cuando alguien te menciona ', '');
INSERT INTO `c_tipo_notificaciones` VALUES (12, 'Vista Post', 'Se lanza cuando un usuario ve una publicacion tuya ', '1');
INSERT INTO `c_tipo_notificaciones` VALUES (13, 'Cambio de sexo', 'Se lanza uno de las personas que sigues cambia de sexo ', '');
INSERT INTO `c_tipo_notificaciones` VALUES (14, 'Cambio de situacion sentimental ', 'Se lanza cuando uno de las personas que sigues cambia la siatuacion sentimental ', '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `frases_random`
-- 

CREATE TABLE `frases_random` (
  `id_frase` int(11) NOT NULL auto_increment,
  `frase` text NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY  (`id_frase`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `frases_random`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `inbox`
-- 

CREATE TABLE `inbox` (
  `id_inbox` int(11) NOT NULL auto_increment,
  `id_usuario_e` int(11) NOT NULL,
  `id_usuario_r` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `src` varchar(256) NOT NULL,
  `tamanio` varchar(16) NOT NULL,
  `tipo_archivo` varchar(8) NOT NULL,
  `fecha_envio` datetime NOT NULL,
  `fecha_visto` datetime NOT NULL,
  `status_m` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY  (`id_inbox`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `inbox`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `likes`
-- 

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL auto_increment,
  `id_contenido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY  (`id_like`),
  KEY `idx_id_contenido` (`id_contenido`,`status`),
  KEY `idx_con_usu_sta` (`id_contenido`,`id_usuario`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `likes`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `lista_blanca`
-- 

CREATE TABLE `lista_blanca` (
  `id_lista_b` int(11) NOT NULL auto_increment,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_reg` int(11) NOT NULL,
  `status` varchar(1) character set utf8 NOT NULL,
  PRIMARY KEY  (`id_lista_b`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `lista_blanca`
-- 

INSERT INTO `lista_blanca` VALUES (1, 1, 1, 'A');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `notificaciones`
-- 

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL auto_increment,
  `id_tipo_notificacion` int(11) NOT NULL,
  `id_ref` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `detalles` text NOT NULL,
  `fecha` datetime NOT NULL,
  `visto` varchar(1) NOT NULL default 'N',
  PRIMARY KEY  (`id_notificacion`),
  KEY `idx_not` (`id_ref`,`id_tipo_notificacion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `notificaciones`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `seguidores`
-- 

CREATE TABLE `seguidores` (
  `id_seguidor` int(11) NOT NULL auto_increment,
  `id_usuario_pri` int(11) NOT NULL,
  `id_usuario_seg` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY  (`id_seguidor`),
  KEY `idx_seguidor_pri_status` (`id_usuario_pri`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `seguidores`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `session_activa`
-- 

CREATE TABLE `session_activa` (
  `id_session` int(11) NOT NULL auto_increment,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY  (`id_session`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `session_activa`
-- 

INSERT INTO `session_activa` VALUES (3, 1, '2016-05-29 20:02:56');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sub_cuentas`
-- 

CREATE TABLE `sub_cuentas` (
  `id_sub_cuenta` int(11) NOT NULL auto_increment,
  `id_usuario_prin` int(11) NOT NULL,
  `id_usuario_sec` int(11) NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `fecha_mod` datetime NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY  (`id_sub_cuenta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `sub_cuentas`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tags_count`
-- 

CREATE TABLE `tags_count` (
  `id_tags` int(11) NOT NULL auto_increment,
  `tags` varchar(128) character set utf8 NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY  (`id_tags`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `tags_count`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuarios`
-- 

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL auto_increment,
  `tipo_usuario` varchar(1) NOT NULL default '1',
  `nombre` varchar(64) NOT NULL,
  `nombre_usuario` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `tipo_login_ext` varchar(16) NOT NULL,
  `id_login_ext` int(11) NOT NULL,
  `bio` varchar(256) NOT NULL,
  `avatar` varchar(128) NOT NULL,
  `ubicacion` varchar(64) NOT NULL,
  `id_sexo` int(1) NOT NULL,
  `id_situacion` int(11) NOT NULL,
  `intereses` text NOT NULL,
  `pasatiempos` text NOT NULL,
  `peliculas` text NOT NULL,
  `musica` text NOT NULL,
  `videojuegos` text NOT NULL,
  `libros` text NOT NULL,
  `otros` text NOT NULL,
  `tema` varchar(2) NOT NULL default '1',
  `fecha_reg` date NOT NULL,
  `fecha_ult` datetime NOT NULL,
  `token` varchar(32) NOT NULL,
  `registro_completo` varchar(2) NOT NULL,
  `id_ult_not` int(11) NOT NULL,
  `per_nsfw` varchar(1) NOT NULL default 'N',
  `per_enviar_correo` varchar(1) NOT NULL,
  `fondo_web` varchar(512) NOT NULL,
  `desp_inf` varchar(1) NOT NULL default 'S',
  `token_session` varchar(32) NOT NULL,
  `tipo_dash` varchar(1) NOT NULL,
  `num_post` int(11) NOT NULL,
  `num_like` int(11) NOT NULL,
  `seguidores` int(11) NOT NULL,
  `siguiendo` int(11) NOT NULL,
  `visibilidad_default` varchar(1) NOT NULL default 'P',
  `status` varchar(1) NOT NULL,
  `visitas_perfil` int(11) NOT NULL,
  `id_ref` int(11) NOT NULL,
  `correo_activo` varchar(1) NOT NULL default 'N',
  `img_like` text NOT NULL,
  PRIMARY KEY  (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `usuarios`
-- 

INSERT INTO `usuarios` VALUES (1, '2', '', 'Admin', '202cb962ac59075b964b07152d234b70', 'Admin@gmail.com', '', 0, '', 'http://redgalaxy.org/img/user.png', '', 0, 0, '', '', '', '', '', '', '', '1', '2016-05-29', '2016-05-29 20:00:56', '', '', 0, 'N', '', '', 'S', 'df8a3b7f53cbc02967752d37698cec75', '', 1, 0, 0, 0, 'P', 'A', 0, 0, 'N', 'img/like.png');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `visitas`
-- 

CREATE TABLE `visitas` (
  `id_visita` int(11) NOT NULL auto_increment,
  `seccion` text NOT NULL,
  `src` varchar(64) NOT NULL,
  `page` text NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `nav` varchar(128) NOT NULL,
  PRIMARY KEY  (`id_visita`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `visitas`
-- 

