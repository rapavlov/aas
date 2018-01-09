-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 28 2017 г., 12:36
-- Версия сервера: 5.5.53-log
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `articles`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` bigint(15) UNSIGNED NOT NULL,
  `alt` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `category_id` int(5) NOT NULL,
  `category_name_url` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text,
  `meta_desc` varchar(255) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `alt`, `img_url`, `category_id`, `category_name_url`, `title`, `text`, `meta_desc`, `h1`, `meta_keywords`, `url`) VALUES
(1, 'первая статья альт', 'первая статья имж', 1, 'ffffffffffffffffffffff', 'первая статья титл', '<p>первая статья</p>\r\n\r\n<p><strong>ffffffffffff</strong></p>\r\n\r\n<p>ffffff</p>\r\n\r\n<p><em>ffffffffffff<img alt=\"\" src=\"/images/global/IRON%20Systems_%D0%BE%D1%82%D0%BA%D1%80%D1%8B%D1%82%D0%BA%D0%B0%20%D0%9D%D0%93%202018.jpg\" /><img alt=\"\" src=\"/images/global/IRON%20Systems_%D0%BE%D1%82%D0%BA%D1%80%D1%8B%D1%82%D0%BA%D0%B0%20%D0%9D%D0%93%202018.jpg\" /></em></p>\r\n', 'первая статья дескрипшион', 'первая статья х1', 'первая статья х1', 'firstpage'),
(2, 'вторая статья', 'вторая статья имж', 1, 'ййййй', 'вторая статья титл', '<p>вторая статья      йййй</p>\r\n', 'вторая статья деск', 'вторая статья х1', 'вторая статья кей', 'secondpage');

-- --------------------------------------------------------

--
-- Структура таблицы `articles_category`
--

CREATE TABLE `articles_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `meta_key` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filePath` varchar(400) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `isMain` tinyint(1) DEFAULT NULL,
  `modelName` varchar(150) NOT NULL,
  `urlAlias` varchar(400) NOT NULL,
  `name` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1514031166),
('m140622_111540_create_image_table', 1514031183),
('m140622_111545_add_name_to_image_table', 1514031183);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `role` int(5) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `auth_key`, `role`) VALUES
(1, 'admin', '$2y$13$2G5H5gvTU.uyseol9SFCluUJLCTfvCleQpQm28pchNCeRd6fm8/Hm', 'HFdUaLCAXYHC1zXUWmQYji_D5E-ZSn9D', 10),
(2, 'mehanik', '$2y$13$RF2q6yLG0mjan15IlfGsJuzmnPiUsUPiomVBR35Mrg7pU2W5F37kC', NULL, 30);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `articles_category`
--
ALTER TABLE `articles_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_3` (`id`),
  ADD KEY `id_4` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles_category`
--
ALTER TABLE `articles_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
