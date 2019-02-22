-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 22 2019 г., 22:43
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `malware`
--

-- --------------------------------------------------------

--
-- Структура таблицы `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `apass` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Administrators list' AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `administrators`
--

INSERT INTO `administrators` (`id`, `login`, `pass`, `apass`) VALUES
(1, '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `bots`
--

CREATE TABLE IF NOT EXISTS `bots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(64) NOT NULL,
  `tag` varchar(64) NOT NULL,
  `ip` varchar(64) NOT NULL,
  `lip` varchar(64) NOT NULL,
  `os` varchar(64) NOT NULL,
  `mhn` varchar(64) NOT NULL,
  `usr` varchar(64) NOT NULL,
  `mac` varchar(64) NOT NULL,
  `tmz` varchar(64) NOT NULL,
  `cpu` varchar(64) NOT NULL,
  `gpu` varchar(64) NOT NULL,
  `ram` varchar(64) NOT NULL,
  `fresponse` varchar(256) NOT NULL,
  `lresponse` varchar(256) NOT NULL,
  `team` varchar(256) NOT NULL,
  `buffer` longtext NOT NULL,
  `log` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
