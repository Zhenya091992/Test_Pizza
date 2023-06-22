-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: mysql
-- Время создания: Июн 22 2023 г., 01:51
-- Версия сервера: 8.0.21
-- Версия PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pizzas`
--

CREATE TABLE `pizzas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` tinytext NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pizzas`
--

INSERT INTO `pizzas` (`id`, `name`, `price`) VALUES
(1, 'пепперони', 3.3),
(2, 'деревенская', 3.6),
(3, 'Гавайская', 3.9),
(4, 'Грибная', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `sauces`
--

CREATE TABLE `sauces` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sauces`
--

INSERT INTO `sauces` (`id`, `name`, `price`) VALUES
(1, 'сырный', 2.3),
(2, 'кисло-сладкий', 2.5),
(3, 'чесночный', 2.1),
(4, 'барбекю', 2.7);

-- --------------------------------------------------------

--
-- Структура таблицы `sizes`
--

CREATE TABLE `sizes` (
  `id` int NOT NULL,
  `size` int NOT NULL,
  `price` float NOT NULL,
  `area` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `price`, `area`) VALUES
(1, 21, 3.5, 346.4),
(2, 26, 4.5, 531),
(3, 31, 5, 754.9),
(4, 45, 6.3, 1590.6);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `sauces`
--
ALTER TABLE `sauces`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `sauces`
--
ALTER TABLE `sauces`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
