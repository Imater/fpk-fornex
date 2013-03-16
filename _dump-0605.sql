-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 06 2012 г., 19:20
-- Версия сервера: 5.5.9
-- Версия PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- База данных: `h116`
--

-- --------------------------------------------------------

--
-- Структура таблицы `2_kvn`
--

DROP TABLE IF EXISTS `2_kvn`;
CREATE TABLE `2_kvn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `name2` text CHARACTER SET utf8 NOT NULL,
  `year` smallint(6) NOT NULL,
  `show` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `2_kvn`
--

INSERT INTO `2_kvn` VALUES(1, 'Мисс Мира', 'Пенза', 2010, 1);
INSERT INTO `2_kvn` VALUES(2, 'Общага', 'Российский Университет Кооперации', 2010, 1);
INSERT INTO `2_kvn` VALUES(3, 'Союз', 'Тюменская область', 2010, 1);
INSERT INTO `2_kvn` VALUES(4, 'Краснодар - Сочи', 'сборная Краснодарского края', 2010, 1);
INSERT INTO `2_kvn` VALUES(5, 'Плохая команда', 'сборная Краснодарского края', 2010, 1);
INSERT INTO `2_kvn` VALUES(6, 'Сборная Физтеха', 'Долгопрудный', 2010, 1);
INSERT INTO `2_kvn` VALUES(7, 'Сборная Евразийского Института', 'РостГМУ, Ростов-на-Дону', 2010, 1);
INSERT INTO `2_kvn` VALUES(8, 'Самоцветы - Наше серебро', 'Кострома', 2010, 1);
INSERT INTO `2_kvn` VALUES(9, 'Сборная Алтайского края', 'Барнаул', 2010, 1);
INSERT INTO `2_kvn` VALUES(10, 'ЖеСТ', 'ТГПИ, Таганрог', 2010, 1);
INSERT INTO `2_kvn` VALUES(11, 'Родина Чехова', 'Таганрог', 2010, 0);
INSERT INTO `2_kvn` VALUES(12, 'Общее дело', 'Сборная ГГУ, Москва', 2010, 1);
INSERT INTO `2_kvn` VALUES(13, 'Уральские пельмени', 'Екатеринбург', 2011, 1);
INSERT INTO `2_kvn` VALUES(14, 'Транзит', 'Российский Университет Кооперации', 2011, 1);
INSERT INTO `2_kvn` VALUES(15, 'Союз', 'Тюменская область', 2011, 1);
INSERT INTO `2_kvn` VALUES(16, 'Краснодар - Сочи', 'сборная Краснодарского края', 2011, 1);
INSERT INTO `2_kvn` VALUES(17, 'Плохая команда', 'сборная Краснодарского края', 2011, 1);
INSERT INTO `2_kvn` VALUES(18, 'Икота', 'Долгопрудный', 2011, 1);
INSERT INTO `2_kvn` VALUES(19, 'Окно в европу', 'РостГМУ, Ростов', 2011, 1);
INSERT INTO `2_kvn` VALUES(20, 'Самоцветы - Наше серебро', 'Кострома', 2011, 1);
INSERT INTO `2_kvn` VALUES(21, 'Игры разума', 'Барнаул', 2011, 1);
INSERT INTO `2_kvn` VALUES(22, 'ЖеСТ', 'ТГПИ, Таганрог', 2011, 1);
INSERT INTO `2_kvn` VALUES(23, 'Родина Чехова', 'Таганрог', 2011, 0);
INSERT INTO `2_kvn` VALUES(24, 'Общее дело', 'Сборная ГГУ, Москва', 2011, 1);
INSERT INTO `2_kvn` VALUES(25, 'Мисс Мира', 'Пенза', 2012, 1);
INSERT INTO `2_kvn` VALUES(26, 'Общага', 'Российский Университет Кооперации', 2012, 1);
INSERT INTO `2_kvn` VALUES(27, 'Союз', 'Тюменская область', 2012, 1);
INSERT INTO `2_kvn` VALUES(28, 'Краснодар - Сочи', 'сборная Краснодарского края', 2012, 1);
INSERT INTO `2_kvn` VALUES(29, 'Плохая команда', 'сборная Краснодарского края', 2012, 1);
INSERT INTO `2_kvn` VALUES(30, 'Сборная Физтеха', 'Долгопрудный', 2012, 1);
INSERT INTO `2_kvn` VALUES(31, 'Сборная Евразийского Института', 'РостГМУ, Ростов-на-Дону', 2012, 1);
INSERT INTO `2_kvn` VALUES(32, 'Самоцветы - Наше серебро', 'Кострома', 2012, 1);
INSERT INTO `2_kvn` VALUES(33, 'Сборная Алтайского края', 'Барнаул', 2012, 1);
INSERT INTO `2_kvn` VALUES(34, 'ЖеСТ', 'ТГПИ, Таганрог', 2012, 1);
INSERT INTO `2_kvn` VALUES(35, 'Родина Чехова', 'Таганрог', 2012, 0);
INSERT INTO `2_kvn` VALUES(36, 'Общее дело', 'Сборная ГГУ, Москва', 2012, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `2_kvn_game`
--

DROP TABLE IF EXISTS `2_kvn_game`;
CREATE TABLE `2_kvn_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_team` int(11) NOT NULL,
  `data_game` date NOT NULL,
  `name_game` text CHARACTER SET utf32 NOT NULL,
  `rating_game` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `2_kvn_game`
--

INSERT INTO `2_kvn_game` VALUES(1, 1, '2010-10-29', 'Сказочный лес', 5);
INSERT INTO `2_kvn_game` VALUES(2, 2, '2010-10-29', 'Сказочный лес', 4.2);
INSERT INTO `2_kvn_game` VALUES(3, 4, '2010-10-29', 'Сказочный лес', 5);
INSERT INTO `2_kvn_game` VALUES(4, 6, '2010-10-29', 'Сказочный лес', 4);
INSERT INTO `2_kvn_game` VALUES(5, 3, '2010-12-06', 'Снегодяи', 4.6);
INSERT INTO `2_kvn_game` VALUES(6, 5, '2010-12-06', 'Снегодяи', 3.9);
INSERT INTO `2_kvn_game` VALUES(7, 7, '2010-12-06', 'Снегодяи', 3.1);
INSERT INTO `2_kvn_game` VALUES(8, 9, '2010-12-06', 'Снегодяи', 4.4);
INSERT INTO `2_kvn_game` VALUES(9, 11, '2010-12-06', 'Снегодяи', 4.1);
INSERT INTO `2_kvn_game` VALUES(10, 13, '2011-03-29', 'Веснушка', 5);
INSERT INTO `2_kvn_game` VALUES(11, 15, '2011-03-29', 'Веснушка', 4.7);
INSERT INTO `2_kvn_game` VALUES(12, 17, '2011-03-29', 'Веснушка', 4.5);
INSERT INTO `2_kvn_game` VALUES(13, 19, '2011-03-29', 'Веснушка', 4.6);
INSERT INTO `2_kvn_game` VALUES(14, 14, '2011-05-02', 'Зеленая пора', 4.3);
INSERT INTO `2_kvn_game` VALUES(15, 16, '2011-05-02', 'Зеленая пора', 4.8);
INSERT INTO `2_kvn_game` VALUES(16, 18, '2011-05-02', 'Зеленая пора', 5);
INSERT INTO `2_kvn_game` VALUES(17, 20, '2011-05-02', 'Зеленая пора', 4.6);
INSERT INTO `2_kvn_game` VALUES(18, 21, '2011-08-07', 'Золото', 5);
INSERT INTO `2_kvn_game` VALUES(19, 22, '2011-08-07', 'Золото', 4.7);
INSERT INTO `2_kvn_game` VALUES(20, 23, '2011-08-07', 'Золото', 3.5);
INSERT INTO `2_kvn_game` VALUES(21, 24, '2011-08-07', 'Золото', 4.2);
INSERT INTO `2_kvn_game` VALUES(22, 25, '2012-01-27', 'Снегурчка', 5);
INSERT INTO `2_kvn_game` VALUES(23, 27, '2012-01-27', 'Снегурчка', 4.1);
INSERT INTO `2_kvn_game` VALUES(24, 29, '2012-01-27', 'Снегурчка', 3.3);
INSERT INTO `2_kvn_game` VALUES(25, 30, '2012-01-27', 'Снегурчка', 4);
INSERT INTO `2_kvn_game` VALUES(26, 32, '2012-01-27', 'Снегурчка', 4.9);
INSERT INTO `2_kvn_game` VALUES(27, 24, '2012-03-10', 'Капель', 2);
INSERT INTO `2_kvn_game` VALUES(28, 27, '2012-03-10', 'Капель', 4.7);
INSERT INTO `2_kvn_game` VALUES(29, 30, '2012-03-10', 'Капель', 3.5);
INSERT INTO `2_kvn_game` VALUES(30, 32, '2012-03-10', 'Капель', 4.2);
INSERT INTO `2_kvn_game` VALUES(31, 29, '2012-03-10', 'Капель', 2);
INSERT INTO `2_kvn_game` VALUES(32, 34, '2012-03-10', 'Капель', 4.7);
INSERT INTO `2_kvn_game` VALUES(33, 24, '2012-05-02', 'Майя', 4);
INSERT INTO `2_kvn_game` VALUES(34, 34, '2012-05-02', 'Майя', 4.2);
INSERT INTO `2_kvn_game` VALUES(35, 35, '2012-05-02', 'Майя', 3.1);
INSERT INTO `2_kvn_game` VALUES(36, 36, '2012-05-02', 'Майя', 4.2);
INSERT INTO `2_kvn_game` VALUES(37, 28, '2012-05-02', 'Майя', 3);
