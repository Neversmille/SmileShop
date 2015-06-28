-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 28 2015 г., 15:38
-- Версия сервера: 5.1.73
-- Версия PHP: 5.2.6-1+lenny10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `st4`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(20) NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `admin_password` varchar(60) NOT NULL,
  `admin_is_active` tinyint(1) NOT NULL DEFAULT '1',
  `allow_orders` tinyint(1) NOT NULL DEFAULT '0',
  `allow_products` tinyint(1) NOT NULL DEFAULT '0',
  `allow_firms` tinyint(1) NOT NULL DEFAULT '0',
  `allow_reviews` tinyint(1) NOT NULL DEFAULT '0',
  `allow_slider` tinyint(1) NOT NULL DEFAULT '0',
  `allow_admins` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_email` (`admin_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `admin_users`
--


-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_alias` varchar(20) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `category_alias`, `category_name`) VALUES
(1, 'phones', 'Телефоны'),
(2, 'tablets', 'Планшеты'),
(3, 'notebooks', 'Ноутбуки');

-- --------------------------------------------------------

--
-- Структура таблицы `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(255) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ci_sessions`
--


-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `client_lastname` varchar(255) NOT NULL,
  `client_email` varchar(40) DEFAULT NULL,
  `client_phone` varchar(20) DEFAULT NULL,
  `client_password` varchar(60) DEFAULT NULL,
  `client_type` varchar(6) NOT NULL DEFAULT 'local',
  `client_soc_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_email` (`client_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Дамп данных таблицы `clients`
--


-- --------------------------------------------------------

--
-- Структура таблицы `firms`
--

CREATE TABLE IF NOT EXISTS `firms` (
  `firm_id` int(11) NOT NULL AUTO_INCREMENT,
  `firm_name` varchar(30) NOT NULL,
  PRIMARY KEY (`firm_id`),
  UNIQUE KEY `firm_name` (`firm_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `firms`
--


-- --------------------------------------------------------

--
-- Структура таблицы `orderItems`
--

CREATE TABLE IF NOT EXISTS `orderItems` (
  `orderItem_id` int(11) NOT NULL AUTO_INCREMENT,
  `orderItem_order_id` int(11) NOT NULL,
  `orderItem_product_id` int(11) NOT NULL,
  `orderItem_amount` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `orderItem_price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`orderItem_id`),
  KEY `orderItem_product_id` (`orderItem_product_id`),
  KEY `orderItems_ibfk_1` (`orderItem_order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `orderItems`
--


-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_price` decimal(8,2) NOT NULL,
  `order_complete` tinyint(1) NOT NULL DEFAULT '0',
  `order_client_id` int(11) NOT NULL,
  `order_text` text,
  `order_phone` varchar(20) NOT NULL,
  `order_create_date` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `order_client_id` (`order_client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `orders`
--


-- --------------------------------------------------------

--
-- Структура таблицы `parser`
--

CREATE TABLE IF NOT EXISTS `parser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime DEFAULT NULL,
  `text` text,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `parser`
--


-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_img` varchar(40) NOT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `product_avaible` enum('0','1') NOT NULL DEFAULT '0',
  `product_category_id` int(11) NOT NULL,
  `product_firm` int(11) DEFAULT NULL,
  `product_hot` enum('0','1') NOT NULL DEFAULT '0',
  `product_url` varchar(100) NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_url` (`product_url`),
  KEY `product_category_id` (`product_category_id`),
  KEY `product_firm` (`product_firm`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `products`
--


-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_text` text NOT NULL,
  `review_file` varchar(40) DEFAULT NULL,
  `review_time` datetime NOT NULL,
  `review_filename` varchar(255) DEFAULT NULL,
  `review_name` varchar(255) NOT NULL,
  `review_email` varchar(40) NOT NULL,
  `review_is_delete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Дамп данных таблицы `reviews`
--


-- --------------------------------------------------------

--
-- Структура таблицы `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_product_id` int(11) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `slider_description` text NOT NULL,
  `slider_position` int(2) NOT NULL,
  `slider_is_active` tinyint(1) NOT NULL DEFAULT '1',
  `slider_product_name` varchar(255) NOT NULL,
  PRIMARY KEY (`slider_id`),
  KEY `slider_product_id` (`slider_product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `slider`
--


--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orderItems`
--
ALTER TABLE `orderItems`
  ADD CONSTRAINT `orderItems_ibfk_1` FOREIGN KEY (`orderItem_order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderItems_ibfk_2` FOREIGN KEY (`orderItem_product_id`) REFERENCES `products` (`product_id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_client_id`) REFERENCES `clients` (`client_id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`product_firm`) REFERENCES `firms` (`firm_id`);

--
-- Ограничения внешнего ключа таблицы `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `slider_ibfk_1` FOREIGN KEY (`slider_product_id`) REFERENCES `products` (`product_id`);
