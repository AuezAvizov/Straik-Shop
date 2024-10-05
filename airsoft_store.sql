-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 02 2024 г., 18:35
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `airsoft_store`
--

-- --------------------------------------------------------

--
-- Структура таблицы `about_us`
--

CREATE TABLE `about_us` (
  `about_id` int(10) NOT NULL,
  `about_heading` text NOT NULL,
  `about_short_desc` text NOT NULL,
  `about_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Дамп данных таблицы `about_us`
--

INSERT INTO `about_us` (`about_id`, `about_heading`, `about_short_desc`, `about_desc`) VALUES
(1, 'About Us - Our Story', 'Welcome to the Airsoft Store, where you can find everything you need for airsoft battles.', 'At Airsoft Store, we offer a wide range of airsoft guns, tactical gear, and accessories to suit both beginners and experienced players. Our mission is to provide the best quality products and customer service.');

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_image` text NOT NULL,
  `admin_contact` varchar(255) NOT NULL,
  `admin_country` text NOT NULL,
  `admin_job` varchar(255) NOT NULL,
  `admin_about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `admin_image`, `admin_contact`, `admin_country`, `admin_job`, `admin_about`) VALUES
(1, 'Administrator', 'admin@airsoftstore.com', 'adminpassword', 'admin-image.png', '1234567890', 'USA', 'Admin', 'Admin of Airsoft Store.'),
(2, 'Auez', 'pajdspad@mail.ru', '123', 'mystery_file.zip', '123213', '123', 'Job', ' asdfsdfs');

-- --------------------------------------------------------

--
-- Структура таблицы `bundles`
--

CREATE TABLE `bundles` (
  `bundle_id` int(11) NOT NULL,
  `bundle_title` varchar(255) NOT NULL,
  `bundle_desc` text NOT NULL,
  `bundle_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `bundle_product_relation`
--

CREATE TABLE `bundle_product_relation` (
  `relation_id` int(11) NOT NULL,
  `bundle_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `p_price` varchar(255) NOT NULL,
  `size` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL,
  `cat_title` text NOT NULL,
  `cat_top` text NOT NULL,
  `cat_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_top`, `cat_image`) VALUES
(1, 'Airsoft Guns', 'yes', 'air_soft_guns.jpg'),
(2, 'Tactical Gear', 'yes', 'tactical_gear.jpg'),
(3, 'Accessories', 'yes', 'accessories.jpg'),
(4, 'Apparel', 'yes', 'apparel.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL,
  `contact_heading` varchar(255) NOT NULL,
  `contact_desc` text NOT NULL,
  `contact_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `contact_us`
--

INSERT INTO `contact_us` (`contact_id`, `contact_heading`, `contact_desc`, `contact_email`) VALUES
(1, 'Contact  To Us', 'If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.', 'ecomstore@mail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `coupon_title` varchar(255) NOT NULL,
  `coupon_price` decimal(10,2) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_limit` int(11) NOT NULL,
  `coupon_used` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `coupon_title`, `coupon_price`, `coupon_code`, `coupon_limit`, `coupon_used`, `product_id`) VALUES
(1, 'цйук', 123123.00, '3', 1, 0, 17);

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_pass` varchar(255) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_confirm_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`, `customer_confirm_code`) VALUES
(1, 'John Doe', 'john@doe.com', 'johnpassword', 'USA', 'New York', '1234567890', '1234 Elm Street', 'john.jpg', '127.0.0.1', ''),
(2, 'Jane Smith', 'jane@smith.com', 'janepassword', 'USA', 'Los Angeles', '0987654321', '5678 Oak Street', 'jane.jpg', '127.0.0.1', ''),
(5, 'Auez', 'user@mail.ru', '123', 'Kazahstan', 'Astana', '+8921374', 'Beibishilik', 'logo.png', '::1', '1774837919');

-- --------------------------------------------------------

--
-- Структура таблицы `customer_orders`
--

CREATE TABLE `customer_orders` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `due_amount` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `qty` int(10) NOT NULL,
  `size` text NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Дамп данных таблицы `customer_orders`
--

INSERT INTO `customer_orders` (`order_id`, `customer_id`, `due_amount`, `invoice_no`, `qty`, `size`, `order_date`, `order_status`) VALUES
(1, 1, 150, 12345, 2, 'M', '2024-07-01 10:00:00', 'pending'),
(2, 2, 200, 12346, 1, 'L', '2024-07-01 11:00:00', 'complete'),
(3, 20, 75, 2062538619, 1, 'Large', '2024-10-01 04:20:31', 'Complete'),
(4, 20, 213, 2062538619, 1, 'Small', '2024-10-02 13:18:27', 'Complete'),
(5, 20, 25, 957570842, 1, 'Small', '2024-09-30 04:48:25', 'pending'),
(6, 20, 30, 1499436882, 1, 'Small', '2024-10-01 04:18:05', 'pending'),
(7, 5, 75, 1296912203, 1, 'Small', '2024-10-01 15:38:17', 'pending'),
(8, 20, 75, 172967896, 1, 'Small', '2024-10-02 13:18:11', 'pending'),
(9, 20, 25, 136076604, 1, 'Small', '2024-10-02 15:00:01', 'pending'),
(10, 20, 600, 951520451, 2, 'Small', '2024-10-02 15:24:45', 'pending'),
(11, 20, 25, 951520451, 1, 'Small', '2024-10-02 15:24:45', 'pending'),
(12, 21, 25, 1621426461, 1, 'Small', '2024-10-02 16:07:55', 'Complete'),
(13, 21, 150, 1621426461, 2, 'Small', '2024-10-02 16:07:35', 'pending');

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturers`
--

CREATE TABLE `manufacturers` (
  `manufacturer_id` int(10) NOT NULL,
  `manufacturer_title` text NOT NULL,
  `manufacturer_top` text NOT NULL,
  `manufacturer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Дамп данных таблицы `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `manufacturer_title`, `manufacturer_top`, `manufacturer_image`) VALUES
(1, 'Tokyo Marui', 'yes', 'tokyo_marui.png'),
(2, 'G&G Armament', 'yes', 'gg_armament.png'),
(3, 'Lancer Tactical', 'yes', 'lancer_tactical.png'),
(4, 'VFC', 'yes', 'vfc.png');

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `ref_no` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `payments`
--

INSERT INTO `payments` (`payment_id`, `invoice_no`, `amount`, `payment_mode`, `ref_no`, `code`, `payment_date`) VALUES
(1, 'asd', 0.00, 'Bank Code', 'sadasd', 'asd', '0000-00-00'),
(2, 'asd', 0.00, 'Bank Code', 'asd', 'asd', '0000-00-00'),
(3, 'вфыв', 0.00, 'Bank Code', 'фывфвы', 'фывфыв', '0000-00-00');

-- --------------------------------------------------------

--
-- Структура таблицы `pending_orders`
--

CREATE TABLE `pending_orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `pending_orders`
--

INSERT INTO `pending_orders` (`order_id`, `customer_id`, `invoice_no`, `product_id`, `qty`, `size`, `order_status`) VALUES
(1, 20, '2062538619', 20, 1, 'Large', 'pending'),
(2, 20, '2062538619', 23, 1, 'Small', 'pending'),
(3, 20, '957570842', 19, 1, 'Small', 'Complete'),
(4, 20, '1499436882', 17, 1, 'Small', 'Complete'),
(5, 5, '1296912203', 20, 1, 'Small', 'pending'),
(6, 20, '172967896', 20, 1, 'Small', 'pending'),
(7, 20, '136076604', 19, 1, 'Small', 'pending'),
(8, 20, '951520451', 18, 2, 'Small', 'pending'),
(9, 20, '951520451', 19, 1, 'Small', 'pending'),
(10, 21, '1621426461', 19, 1, 'Small', 'pending'),
(11, 21, '1621426461', 20, 2, 'Small', 'pending');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `p_cat_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `manufacturer_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_title` mediumtext NOT NULL,
  `product_url` mediumtext NOT NULL,
  `product_img1` mediumtext NOT NULL,
  `product_img2` mediumtext NOT NULL,
  `product_img3` mediumtext NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_psp_price` int(100) NOT NULL,
  `product_desc` mediumtext NOT NULL,
  `product_features` mediumtext NOT NULL,
  `product_video` mediumtext NOT NULL,
  `product_keywords` mediumtext NOT NULL,
  `product_label` mediumtext NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `p_cat_id`, `cat_id`, `manufacturer_id`, `date`, `product_title`, `product_url`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_psp_price`, `product_desc`, `product_features`, `product_video`, `product_keywords`, `product_label`, `status`) VALUES
(16, 4, 4, 4, '2024-08-13 18:17:43', 'Tactical FSBE-Vest', 'airsoft-tactical-vest', 'vest.jpg', 'vest.jpg', 'vest.jpg', 120, 110, 'Это идеальное сочетание комфорта и функциональности. Изготовленный из прочного нейлона 600D с технологией RIP-STOP, он устойчив к износу и повреждениям. Полная совместимость с системой MOLLE позволяет легко настроить жилет под любые задачи, а регулируемые плечевые ремни и пояс обеспечивают отличную посадку и комфорт. Встроенные карманы для бронепластин (пластинки не входят в комплект) обеспечивают дополнительную защиту. Жилет оснащен множеством карманов для удобного хранения магазинов и другого снаряжения.', 'Durable, lightweight, adjustable', 'https://www.youtube.com/watch?v=PPhPLv8A-B0', 'tactical vest, airsoft gear', 'New', 'product'),
(17, 5, 4, 3, '2024-08-02 04:42:14', 'Airsoft Combat Gloves', 'airsoft-combat-gloves', 'tactical_gloves.jpg', 'tactical_gloves.jpg', 'tactical_gloves.jpg', 35, 30, 'Protective combat gloves designed for airsoft enthusiasts. Provides excellent grip and protection.', 'Breathable, anti-slip, reinforced knuckles', 'https://www.youtube.com/embed/abc456', 'combat gloves, airsoft gloves', 'Sale', 'product'),
(18, 6, 4, 0, '2024-08-02 04:44:22', 'Airsoft Sniper Rifle', 'airsoft-sniper-rifle', 'airsoft_sniper_rifle.jpg', 'airsoft_sniper_rifle.jpg', 'airsoft_sniper_rifle.jpg', 300, 280, 'High-precision airsoft sniper rifle with adjustable scope and bipod.', 'High accuracy, long range, adjustable scope', 'https://www.youtube.com/embed/def789', 'sniper rifle, airsoft sniper', 'Featured', 'product'),
(19, 7, 4, 0, '2024-08-02 04:46:25', 'Airsoft Protective Goggles', 'airsoft-protective-goggles', 'tactical_gloses.jpg', 'tactical_gloses.jpg', 'tactical_gloses.jpg', 25, 20, 'High-impact resistant protective goggles for airsoft games. Anti-fog and UV protection.', 'Anti-fog, UV protection, adjustable strap', 'https://www.youtube.com/embed/ghi012', 'protective goggles, airsoft goggles', 'New', 'product'),
(20, 8, 4, 0, '2024-08-02 04:48:41', 'Airsoft Camouflage Jacket', 'airsoft-camouflage-jacket', 'tactical_jacket.jpg', 'tactical_jacket.jpg', 'tactical_jacket.jpg', 80, 75, 'Camouflage jacket designed for airsoft players. Provides excellent concealment and comfort.', 'Camouflage, breathable, durable', 'https://www.youtube.com/embed/jkl345', 'camouflage jacket, airsoft jacket', 'Sale', 'product'),
(23, 1, 2, 1, '2024-09-28 05:17:14', 'adads', 'navy-blue-t-shirt', 'logo (1).png', 'mystery_file.zip', 'back01.png', 213, 123, 'asdads', 'sadasd', 'asdsad', 'asdasd', '12dsfa', 'bundle');

-- --------------------------------------------------------

--
-- Структура таблицы `product_categories`
--

CREATE TABLE `product_categories` (
  `p_cat_id` int(11) NOT NULL,
  `p_cat_title` varchar(255) NOT NULL,
  `p_cat_top` enum('yes','no') DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product_categories`
--

INSERT INTO `product_categories` (`p_cat_id`, `p_cat_title`, `p_cat_top`) VALUES
(1, 'Airsoft Guns', 'yes'),
(2, 'Airsoft Gear', 'no'),
(3, 'Camouflage Clothing', 'no');

-- --------------------------------------------------------

--
-- Структура таблицы `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_title` varchar(255) NOT NULL,
  `store_image` varchar(255) NOT NULL,
  `store_desc` text NOT NULL,
  `store_button` varchar(255) NOT NULL,
  `store_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Дамп данных таблицы `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `customer_id`, `product_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(6, 8, 19),
(7, 20, 19),
(8, 20, 20),
(10, 21, 19);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`about_id`);

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Индексы таблицы `bundles`
--
ALTER TABLE `bundles`
  ADD PRIMARY KEY (`bundle_id`);

--
-- Индексы таблицы `bundle_product_relation`
--
ALTER TABLE `bundle_product_relation`
  ADD PRIMARY KEY (`relation_id`),
  ADD KEY `bundle_id` (`bundle_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Индексы таблицы `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Индексы таблицы `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Индексы таблицы `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Индексы таблицы `pending_orders`
--
ALTER TABLE `pending_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`p_cat_id`);

--
-- Индексы таблицы `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Индексы таблицы `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `about_us`
--
ALTER TABLE `about_us`
  MODIFY `about_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `bundles`
--
ALTER TABLE `bundles`
  MODIFY `bundle_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `bundle_product_relation`
--
ALTER TABLE `bundle_product_relation`
  MODIFY `relation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `manufacturer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `pending_orders`
--
ALTER TABLE `pending_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `p_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bundle_product_relation`
--
ALTER TABLE `bundle_product_relation`
  ADD CONSTRAINT `bundle_product_relation_ibfk_1` FOREIGN KEY (`bundle_id`) REFERENCES `bundles` (`bundle_id`),
  ADD CONSTRAINT `bundle_product_relation_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Ограничения внешнего ключа таблицы `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
