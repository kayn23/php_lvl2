-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 11 2018 г., 01:38
-- Версия сервера: 10.1.36-MariaDB
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mymag`
--
CREATE DATABASE IF NOT EXISTS `mymag` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `mymag`;

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

DROP TABLE IF EXISTS `basket`;
CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `accepted_at` datetime NOT NULL,
  `closed_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `created_at`, `accepted_at`, `closed_at`) VALUES
(1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `author`, `description`, `img`, `price`) VALUES
(2, 'О них', 'by John Smit', '', 'img/load/o_nikh.jpg', '4500.00'),
(8, 'Мы', 'Замятин', 'Книга написанная про Нас', 'img/load/my.jpg', '2500.00'),
(9, 'PHP 7', 'Дмитрий Котеров, Игорь Симдянов', 'Рассмотрены основы языка PHP и его рабочего окружения в Windows, Mac OS X и Linux.Отражены радикальные изменения в языке PHP, произошедшие с момента выхода предыдущего издания: трейты, пространство имен, анонимные функции, замыкания, элементы строгой типизации, генераторы, встроенный Web-сервер и многие другие возможности. Приведено описание синтаксиса PHP 7, а также функций для работы с массивами, файлами, СУБД MySQL, memcached, регулярными выражениями, графическими примитивами, почтой, сессиями и т. д. \r\nОсобое внимание уделено рабочему окружению: сборке PHP-FPM и Web-сервера nginx, СУБД MySQL, протоколу SSH, виртуальным машинам VirtualBox и менеджеру виртуальных машин Vagrant. Рассмотрены современные подходы к Web-разработке, система контроля версий Git, GitHub и другие бесплатные Git-хостинги, новая система распространения программных библиотек и их разработки, сборка Web-приложений менеджером Composer, стандарты PSR и другие инструменты и приемы работы современного PHP-сообщества.\r\nВ третьем издании добавлены 24 новые главы, остальные главы обновлены или переработаны. \r\nНа сайте издательства находятся  исходные коды всех листингов.', 'img/load/php_7.jpg', '1000.00'),
(10, 'PHP.', 'Мэт Зандстра', 'Четвертое издание книги было пересмотрено и дополнено новым материалом. Книга начинается с обзора объектно-ориентированных возможностей PHP, в который включены важные темы, такие как определение классов, наследование, инкапсуляция, рефлексия и многое другое. Этот материал закладывает основы объектно-ориентированного проектирования и программирования на PHP. Вы изучите также некоторые основополагающие принципы проектирования. В этом издании книги также описаны возможности, появившиеся в PHP версии 5.4, такие как трейты, дополнительные расширения на основе рефлексии, уточнения типов параметров методов, улучшенная обработка исключений и много других мелких расширений языка. Следующая часть книги посвящена шаблонам проектирования, которые органически дополняют тему ООП и являются описанием элегантных решений распространенных проблем, возникающих при проектировании программного обеспечения. В ней описываются концепции шаблонов проектирования и показаны способы реализации нескольких важных шаблонов в приложениях на PHP. В этой же части приведен материал, посвященный шаблонам корпоративных приложений и баз данных. \r\nВ последней части книги описывается несколько важных утилит и методик, помогающих осуществить успешный проект на основе разрозненных кусков кода.', 'img/load/php._obekty,_shablony_i_metodiki_programmirovaniya.jpg', '1500.00'),
(11, 'Изучаем PHP 7.', 'Дэвид Скляр', 'Эта книга адресована тем, кто только начинает изучать язык программирования PHP. Ее автор, Дэвид Скляр, являющийся также соавтором книги PHP Cookbook, раскрывает особенности данного языка, которые следует знать для построения динамических веб-сайтов, размещаемых на веб-серверах. Освоив языковые средства версии PHP 5.x и наиболее примечательные нововведения последней версии PHP 7, вы научитесь работать с веб-серверами, браузерами, базами данных и веб-службами. Упражнения, приведенные в конце первых 13 глав книги, помогут вам закрепить усвоенный материал. Это постепенное введение в язык PHP рассчитано на широкий круг читателей: от любителей, стремящихся построить свой динамический веб-сайт, до опытных разработчиков веб-приложений, серверных и прочих программ, желающих быстро освоить данный язык программирования. Оно охватывает самые разные особенности современной версии PHP, включая интернационализацию, применение PHP в режиме командной строки и управление пакетами.', 'img/load/izuchaem_php_7..jpg', '1500.00');

-- --------------------------------------------------------

--
-- Структура таблицы `status_order`
--

DROP TABLE IF EXISTS `status_order`;
CREATE TABLE `status_order` (
  `id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `status_order`
--

INSERT INTO `status_order` (`id`, `status`) VALUES
(0, 'не создан'),
(1, 'Создан'),
(2, 'Выполняется'),
(3, 'Выполнен');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@example.com');

--
-- Триггеры `users`
--
DROP TRIGGER IF EXISTS `user_role_trigger`;
DELIMITER $$
CREATE TRIGGER `user_role_trigger` AFTER INSERT ON `users` FOR EACH ROW begin
	insert into user_role(`user_id`,`role`) values (new.id,'user');
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role`) VALUES
(1, 1, 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_id` (`product_id`),
  ADD KEY `fk_order_id` (`order_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
