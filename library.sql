-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 04 2023 г., 21:54
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authorization`
--

CREATE TABLE `authorization` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `authorization`
--

INSERT INTO `authorization` (`id`, `login`, `password`) VALUES
(15, 'admin', 'admin'),
(24, 'dsc', 'admin'),
(25, '', ''),
(26, '54321', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `uid` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `history`
--

INSERT INTO `history` (`id`, `time`, `uid`) VALUES
(26, '2023-04-30 19:26:40', '43894027'),
(27, '2023-04-30 19:26:43', '3034860643'),
(28, '2023-04-30 19:27:12', '3034860643'),
(29, '2023-04-30 19:27:17', '2343894027'),
(30, '2023-04-30 19:27:20', '2343894027'),
(31, '2023-04-30 19:49:09', '34860643'),
(32, '2023-04-30 19:49:11', '3034860643'),
(33, '2023-04-30 19:49:13', '3034860643'),
(34, '2023-04-30 20:00:02', '3034860643'),
(35, '2023-04-30 20:00:10', '\r\n2343894027'),
(36, '2023-04-30 20:00:13', '\r\n963837156'),
(37, '2023-04-30 20:00:38', '963837156'),
(38, '2023-04-30 20:01:10', '2343894027'),
(39, '2023-04-30 20:01:52', '963837156'),
(40, '2023-04-30 20:02:37', '3837156'),
(41, '2023-04-30 20:02:39', '963837156'),
(42, '2023-04-30 20:02:42', '2343894027'),
(43, '2023-04-30 20:02:45', '3034860643'),
(44, '2023-04-30 20:03:42', '34860643'),
(45, '2023-04-30 20:03:54', '3034860643'),
(46, '2023-04-30 20:06:16', '963837156'),
(47, '2023-04-30 20:06:29', '3034860643'),
(48, '2023-05-02 16:11:22', '3034860643');

-- --------------------------------------------------------

--
-- Структура таблицы `person_info`
--

CREATE TABLE `person_info` (
  `phone` varchar(12) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `person_info`
--

INSERT INTO `person_info` (`phone`, `first_name`, `last_name`, `patronymic`, `email`) VALUES
('', '', '', '', ''),
('54321', 'Анна', 'Кретова', 'Андреевна', 'ef@edu.hse.ru'),
('890048681324', '', '', '', ''),
('89004868201', 'Дан', 'Чу', 'фвавфа', 'adfadf@saf'),
('89004868206', 'Анна', 'Кретова', '10/08/2001', 'ak@mail.ru'),
('89991726541', 'Даниил', 'Чуйко', '16.10.2001', 'da@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `rfid_uid_area`
--

CREATE TABLE `rfid_uid_area` (
  `uid` varchar(12) NOT NULL,
  `area` varchar(50) NOT NULL,
  `pid` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `rfid_uid_area`
--

INSERT INTO `rfid_uid_area` (`uid`, `area`, `pid`) VALUES
('1', 'Выдано', '2'),
('2343894027', 'Библиотека', '0'),
('3034860643', 'Библиотека', '0'),
('4', 'Библиотека', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `rfid_uid_name`
--

CREATE TABLE `rfid_uid_name` (
  `uid` varchar(12) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `rfid_uid_name`
--

INSERT INTO `rfid_uid_name` (`uid`, `name`) VALUES
('1', 'Первая книга'),
('2', 'Вторая книга'),
('3', 'Третья книга'),
('3034860643', 'Книга с UID 30...'),
('4', 'Книга с красивым названием');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authorization`
--
ALTER TABLE `authorization`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `person_info`
--
ALTER TABLE `person_info`
  ADD PRIMARY KEY (`phone`);

--
-- Индексы таблицы `rfid_uid_area`
--
ALTER TABLE `rfid_uid_area`
  ADD PRIMARY KEY (`uid`);

--
-- Индексы таблицы `rfid_uid_name`
--
ALTER TABLE `rfid_uid_name`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authorization`
--
ALTER TABLE `authorization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
