-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 21 2018 г., 17:18
-- Версия сервера: 5.7.22-0ubuntu0.16.04.1
-- Версия PHP: 7.2.6-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `url`) VALUES
(1, 'Компьютеры', '/'),
(2, 'Ноутбуки и нетбуки', '/'),
(3, 'Комплектующие', '/'),
(4, 'Планшеты', '/'),
(5, 'Программное обеспечение', '/'),
(6, 'Телефоны', '/'),
(7, 'Фото и Видео', '/');

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Донецк');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `second_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `city_id`, `second_name`, `first_name`, `father_name`, `birthday`) VALUES
(1, 1, 'Тест', 'Тест', 'Тество', '2002-01-01'),
(2, 1, 'aaa', 'aaa', 'aaa', '2002-01-01'),
(3, 1, 'тест', 'ооо', 'ааа', '2002-01-01'),
(4, 1, 'jk', 'knekn', 'jnbdjfvbfd', '2002-01-01'),
(5, 1, 'Порошенко', 'Петр', 'Ивановчи', '1964-01-01'),
(6, 1, 'ттт', 'ттт', 'ттт', '2002-01-01'),
(7, 1, 'jwmrkl', 'kenvfk', 'kfknkvef', '2002-01-01'),
(8, 1, 'egtlm,ewr', 'kendbk', 'fdknvkmdf', '2002-01-01'),
(9, 1, 'Тест', 'Тест', 'Тестов', '2002-01-01'),
(10, 1, 'yyy', 'yyy', 'yyy', '1995-01-01');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coefficient` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `name`, `coefficient`) VALUES
(1, 'US Dollar', 1),
(2, 'Рубль', 0.017381),
(3, 'Гривна', 0.038048),
(4, 'Euro', 1.1951);

-- --------------------------------------------------------

--
-- Структура таблицы `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `orderitems`
--

INSERT INTO `orderitems` (`id`, `order_id`, `product_id`, `count`) VALUES
(1, 1, 1, 1),
(2, 1, 4, 1),
(3, 2, 6, 2),
(4, 2, 1, 3),
(5, 2, 2, 3),
(6, 2, 3, 2),
(7, NULL, 1, 1),
(8, 3, 5, 1),
(9, 4, 6, 1),
(10, 6, 1, 1),
(11, 6, 2, 1),
(12, 6, 6, 1),
(13, 6, 3, 3),
(14, 7, 7, 1),
(15, 8, 5, 1),
(16, 9, 1, 1),
(17, 10, 2, 1),
(18, NULL, 1, 1),
(19, NULL, 5, 1),
(20, 3, 6, 3),
(21, 11, 3, 1),
(22, 12, 7, 1),
(23, 13, 1, 1),
(24, 14, 7, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `status_id`, `date`, `client_id`) VALUES
(1, 1, '2018-04-14 22:27:00', 1),
(2, 1, '2018-05-14 22:53:00', NULL),
(3, 1, '2018-05-25 22:46:00', 1),
(4, 1, '2018-05-25 22:54:40', NULL),
(6, 1, '2018-05-26 00:01:00', 1),
(7, 1, '2018-06-03 17:57:32', 5),
(8, 1, '2018-06-03 18:04:44', 6),
(9, 1, '2018-06-03 18:07:58', 7),
(10, 1, '2018-06-03 18:09:43', 8),
(11, 1, '2018-06-08 02:12:04', 1),
(12, 1, '2018-06-08 02:16:31', 1),
(13, 1, '2018-06-08 03:45:05', 9),
(14, 1, '2018-06-21 17:03:58', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `ordersstatuses`
--

CREATE TABLE `ordersstatuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `ordersstatuses`
--

INSERT INTO `ordersstatuses` (`id`, `name`) VALUES
(1, 'В обработке'),
(2, 'Ожидает клиента');

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id`, `product_id`, `url`) VALUES
(6, NULL, '/images/1528224189jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `photo`, `subcategory_id`, `category_id`) VALUES
(1, 'Mac Mini', 'Mac mini — компьютер, выпускаемый Apple Inc. и относящийся к семейству Macintosh. Официально был представлен публике 11 января 2005 на MacWorld Expo. С тех пор модельный ряд обновлялся в 2005, 2006, 2007, 2009, 2010, 2011, 2012 и 2014 гг. — предположительно, это последняя модель в истории линейки Mac mini.\r\n\r\nИмеет относительно малые для устройств данного уровня размеры: квадратное со скругленными краями основание со стороной 16,5 см и 5,1-сантиметровую высоту (модели до 2009 года включительно), что практически идентично пяти сложенным одной стопкой коробкам от компакт-дисков. Масса — 1,32 кг.\r\n\r\nМодель 2010 года имеет размеры 19,7x19,7x3,6 см. Масса 1,37 кг.\r\n\r\nКомпьютер продается без монитора, клавиатуры и мыши, в расчёте на то, что у пользователя они уже есть от его РС или старого макинтоша. В комплекте с первыми моделями на базе процессора Intel шёл пульт дистанционного управления Apple Remote, с помощью которого можно управлять проигрыванием на компьютере музыки, видео и фотоколлекцией через Front Row. В настоящий момент пульт Apple Remote исключён из поставки и предлагается опционально.', 1000, 'https://cnet4.cbsistatic.com/img/TC5EF2OSjqQOQRbymOwthZxevc4=/830x467/2012/11/08/d9373f8e-0541-11e3-bf02-d4ae52e62bcc/Mac_Mini_35536140_35522798_35440708_35522800_02.jpg', 2, 1),
(2, 'iMac', 'Настольный компьютер, который погружает вас в контент. Буквально. Эта идея лежит в основе современного iMac — и сегодня она актуальна как никогда. Совершенно новые процессоры, инновационные графические технологии, передовые накопители и разъёмы с впечатляющей пропускной способностью — всё это новый iMac. А его дисплей Retina способен оживить любую картинку, ведь по яркости и качеству цветопередачи ему нет равных среди iMac. Работать на iMac теперь ещё интереснее и увлекательнее', 1500, 'https://i2.rozetka.ua/goods/2207387/copy_apple_mk442ua_a_59b8e2fa713e0_images_2207387283.jpg', 2, 1),
(3, 'iPhone SE', 'Компания Apple представила iPhone SE — самый мощный 4‑дюймовый смартфон в истории. Чтобы создать его, Apple взяли за основу полюбившийся дизайн и полностью поменяли содержание. Установили тот же передовой процессор A9, что и на iPhone 6s, и камеру 12 Мп для съёмки невероятных фотографий и видео 4K. А благодаря Live Photos любой ваш снимок буквально оживёт. Результат? Небольшой iPhone с огромными возможностями.', 700, 'https://img.mvideo.ru/Pdb/30027843b.jpg', 6, 6),
(4, 'Galaxy S9', 'Записывайте оригинальные ролики с невероятной скоростью: 960 кадров в секунду. Задействованный в смартфоне сверхскоростной сенсор позволит проявить талант режиссера. С его помощью вы сможете добавить в видеоряд замедленные кадры, или сделать эффектным один момент, используя супер-замедленный кадр. Режим SuperSlow-mo поддерживает только HD разрешение. Добавляйте музыку из предварительно скачанных файлов или используйте треки со своего плейлиста для создания оригинальных видеороликов. Также вы можете создавать GIF с тремя вариантами зацикливания.', 1200, 'https://www.bhphotovideo.com/images/images2500x2500/samsung_sm_g960uzkaxaa_samsung_galaxy_s9_1394702.jpg', 6, 6),
(5, 'Galaxy Note 8', 'Samsung Galaxy Note 8 - продолжение линейки смартфонов со стилусом. После неудачи с модель Note 7, компания Samsung учла недостатки конструкции предыдущего поколения и исключила подобные проблемы в седьмой версии устройства. Смартфон получил дизайн в стиле флагманов 2017 года - моделей S8 и S8+ и его корпус обладает минимальными рамками вокруг дисплея. Также дисплей получил скругленные края, что усиливает визуальный эффект безрамочной конструкции. Сам дисплей выполнен по технологии Super AMOLED и обладает разрешением 2960х1440, что в сочетании с диагональю 6,3 дюйма дает плотность точек в 521 пиксель на дюйм. Производительность устройства находится на очень высоком уровне, благодаря процессору Samsung Exynos 8895 с максимальной тактовой частотой 2,4 ГГц. Одно из самых главных нововведений смартфона - двойная основная камера, каждый из двух 12-мегапиксельных модулей которой поддерживает оптическую стабилизацию. Смартфон оснащен аккумулятором емкостью 3300 мАч и поддерживает функцию беспроводной и быстрой проводной зарядки. Главный козырь устройства - стилус S Pen получил новую функциональностью в виде нового программного обеспечения для создания рисунков и текстового ввода.', 1300, 'https://i1.rozetka.ua/goods/2161713/samsung_sm_n950fzvdsek_images_2161713793.jpg', 6, 6),
(6, 'Nokia 1280', 'Это телефон начального уровня от Nokia. Аппарат выполнен в форм-факторе моноблока с монохромным дисплеем и цифровой клавиатурой. Nokia 1280 может похвастаться длительным временем автономной работы: 8,5 часов разговоров и 22 дня в режиме ожидания. Среди характеристик стоит отметить присутствие FM-радио, MP3-мелодий звонка, встроенного фонарика, громкой связи и защищенной от попадания пыли клавиатуры. Телефонная книга аппарата расчитана на 500 различных пользователей. Кроме того, для телефона будут доступны разноцветные сменные панели корпуса. Телефон поддерживает сервисы Nokia Life Tools, призванные обеспечить информацией по вопросам сельского хозяйства с помощью мобильных телефонов, и которые специально предназначены для населения аграрных регионов и небольших городов.\r\nПодробнее: https://rozetka.com.ua/nokia_1280_black/p96493/', 25, 'https://i1.rozetka.ua/goods/1883/nokia_1280_black_images_1883446.jpg', 5, 6),
(7, 'Acer Aspire T3-710', 'Неограниченные возможности для работы и творчества. Даже такие ресурсоемкие задачи, как работа с видео и создание фотоальбомов, можно с легкостью выполнить с помощью ПК серии Aspire T нового поколения, который обеспечивает высокую производительность и возможностью апгрейда. Элегантный черный корпус с передней панелью для доступа к основным разъемам — это все, что необходимо для удобной работы.', 250, 'https://i2.rozetka.ua/goods/2227676/acer_dt_b1hme_001_images_2227676972.jpg', 1, 1),
(9, 'test', 'test', 350, 'https://i2.rozetka.ua/goods/2207387/copy_apple_mk442ua_a_59b8e2fa713e0_images_2207387283.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `productspecification`
--

CREATE TABLE `productspecification` (
  `id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `productspecification`
--

INSERT INTO `productspecification` (`id`, `value`, `product_id`, `name_id`) VALUES
(7, 'Intel1', 1, 1),
(8, 'Intel2', 2, 1),
(9, 'Radeon1', 1, 2),
(10, 'Radeon2', 2, 2),
(11, 'ARM1', 3, 1),
(12, 'IPS', 4, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `specificationnames`
--

CREATE TABLE `specificationnames` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `specificationnames`
--

INSERT INTO `specificationnames` (`id`, `name`) VALUES
(1, 'Процессор'),
(2, 'Видео Карта'),
(3, 'Экран');

-- --------------------------------------------------------

--
-- Структура таблицы `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `url`, `category_id`) VALUES
(1, 'ПК', '/', 1),
(2, 'Mac', '/', 1),
(3, 'На Windows', '/', 2),
(4, 'На MacOS', '/', 2),
(5, 'Телефоны', '', 6),
(6, 'Смартфоны', '', 6),
(7, 'На iOS', '', 4),
(8, 'На Android', '', 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C82E748BAC62AF` (`city_id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F1CAA3418D9F6D38` (`order_id`),
  ADD KEY `IDX_F1CAA3414584665A` (`product_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E52FFDEE6BF700BD` (`status_id`),
  ADD KEY `IDX_E52FFDEE19EB6921` (`client_id`);

--
-- Индексы таблицы `ordersstatuses`
--
ALTER TABLE `ordersstatuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_876E0D94584665A` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B3BA5A5A5DC6FE57` (`subcategory_id`),
  ADD KEY `IDX_B3BA5A5A12469DE2` (`category_id`);

--
-- Индексы таблицы `productspecification`
--
ALTER TABLE `productspecification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D9C05A584584665A` (`product_id`),
  ADD KEY `IDX_D9C05A5871179CD6` (`name_id`);

--
-- Индексы таблицы `specificationnames`
--
ALTER TABLE `specificationnames`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6562A1CB12469DE2` (`category_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `ordersstatuses`
--
ALTER TABLE `ordersstatuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `productspecification`
--
ALTER TABLE `productspecification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `specificationnames`
--
ALTER TABLE `specificationnames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `FK_C82E748BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Ограничения внешнего ключа таблицы `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `FK_F1CAA3414584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK_F1CAA3418D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEE19EB6921` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `FK_E52FFDEE6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `ordersstatuses` (`id`);

--
-- Ограничения внешнего ключа таблицы `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `FK_876E0D94584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_B3BA5A5A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_B3BA5A5A5DC6FE57` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Ограничения внешнего ключа таблицы `productspecification`
--
ALTER TABLE `productspecification`
  ADD CONSTRAINT `FK_D9C05A584584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK_D9C05A5871179CD6` FOREIGN KEY (`name_id`) REFERENCES `specificationnames` (`id`);

--
-- Ограничения внешнего ключа таблицы `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `FK_6562A1CB12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
