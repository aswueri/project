-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 22 2026 г., 08:41
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kinoteka`
--

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Боевик'),
(2, 'Комедия'),
(3, 'Драма'),
(4, 'Фантастика'),
(5, 'Ужасы');

-- --------------------------------------------------------

--
-- Структура таблицы `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `year` int DEFAULT NULL,
  `description` text,
  `genre_id` int DEFAULT NULL,
  `actors` text,
  `poster` varchar(500) DEFAULT NULL
) ENGINE=InnoDB;

--
-- Дамп данных таблицы `movies`
--

INSERT INTO `movies` (`id`, `title`, `year`, `description`, `genre_id`, `actors`, `poster`) VALUES
(2, 'Аватар', 2009, 'Синие человечки на другой планете', 1, 'Сэм Уортингтон,\r\nЗои Салдана,\r\nСигурни Уивер,\r\nСтивен Лэнг,\r\nМишель Родригес,\r\nДжованни Рибизи,\r\nДжоэль Мур,\r\nСи Си Эйч Паундер,\r\nУэс Стьюди,\r\nЛас Алонсо', 'https://avatars.mds.yandex.net/get-kinopoisk-image/4774061/ddee0dfb-53b0-48f8-a0ec-f0967464e853/1920x'),
(3, 'Форсаж', 2001, 'Коп под прикрытием внедряется в банду стритрейсеров и становится одним из них. Первая часть гоночной франшизы', 1, 'Пол Уокер,\r\nВин Дизель,\r\nМишель Родригес,\r\nДжордана Брюстер,\r\nМэтт Шульце,\r\nРик Юн,\r\nЧэд Линдберг,\r\nДжонни Стронг,\r\nТед Левайн,\r\nТом Бэрри', 'https://avatars.mds.yandex.net/i?id=e9a7625f39633a90cda3f1a0a2c4dd7a_l-5433865-images-thumbs&n=13'),
(4, 'Мстители', 2012, 'Команда супергероев дает отпор скандинавскому богу Локи. Начало фантастической саги в киновселенной Marvel', 4, 'Роберт Дауни мл.,,Крис Эванс,Марк Руффало, Крис Хемсворт,\r\nСкарлетт Йоханссон,\r\nДжереми Реннер,\r\nТом Хиддлстон,\r\nСэмюэл Л. Джексон,\r\nКларк Грегг,\r\nКоби Смолдерс,Настя', 'https://avatars.mds.yandex.net/get-kinopoisk-image/1773646/3ec8d36a-207a-4a46-82b6-4f2e6c4af6bb/1920x');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `movie_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `movie_id`, `rating`, `comment`, `created_at`) VALUES
(4, 3, 4, 10, 'имбище вообще бомба\r\n', '2026-04-21 16:53:32'),
(5, 4, 4, 6, 'крутой фильм', '2026-04-21 18:39:48'),
(6, 6, 4, 2, 'ну, мне вообще Марвел не нравится, я смотрю только Сумерки', '2026-04-21 20:13:46'),
(7, 3, 2, 9, 'Графика и сюжет прост о нереальны, но мне кажется линия злодея хромает', '2026-04-21 20:15:02'),
(8, 4, 2, 7, 'хорошая графика, но сюжет не зашел', '2026-04-21 20:15:11'),
(9, 6, 3, 8, 'ыыыыыыыыы машинки ыыыы', '2026-04-21 20:23:48'),
(10, 7, 3, 10, 'Машинки, мне нравится. Легендарный фильм, пересматривал бы его вечно', '2026-04-21 20:25:18');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(3, 'мируc', 'strikalo@mail.ru'),
(4, 'Анасташа', 'edinorog@typichmo.com'),
(6, 'Некит', 'pidide@gmail.com'),
(7, 'Тимур', 'satenov@mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
