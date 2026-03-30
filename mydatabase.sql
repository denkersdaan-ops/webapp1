-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Gegenereerd op: 30 mrt 2026 om 14:51
-- Serverversie: 8.4.8
-- PHP-versie: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(1, 'Burgers', '/img/categories/burgers.png'),
(2, 'Fries', '/img/categories/fries.png'),
(3, 'Drinks', '/img/categories/drinks.png'),
(4, 'Desserts', '/img/categories/desserts.png'),
(5, 'Chicken', '\\img\\categories\\chicken.png'),
(23, '...', '...');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `info` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int NOT NULL,
  `bought` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `name`, `info`, `price`, `category_id`, `bought`) VALUES
(1, 'Basic Burger', 'a pork burger with some tomatoes and mayo', 6.90, 1, 11),
(2, 'Cheeseburger', 'Classic beef burger with melted cheddar cheese.', 5.99, 1, 7),
(3, 'Double Bacon Burger', 'Two beef patties, crispy bacon and special sauce.', 8.49, 1, 4),
(4, 'Jalapeno Spicy Burger', 'Beef burger topped with jalapenos and hot sauce.', 6.99, 1, 0),
(5, 'Regular Fries', 'Crispy salted fries.', 2.49, 2, 0),
(6, 'Cheese Fries', 'Fries with melted cheese sauce.', 3.49, 2, 0),
(7, 'Curly Fries', 'Seasoned curly fries with extra crunch.', 3.99, 2, 0),
(8, 'Cola', 'Chilled carbonated cola beverage.', 1.99, 3, 0),
(9, 'Lemonade', 'Fresh and sweet homemade lemonade.', 2.29, 3, 0),
(10, 'Chocolate Sundae', 'Vanilla ice cream with chocolate syrup.', 2.99, 4, 0),
(11, 'Chicken Strips', 'Crispy fried golden chicken strips.', 4.99, 5, 0),
(13, 'Chicken burger', 'A nice crispy chicken on our burger', 6.50, 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `isAdmin`) VALUES
(1, 'admin', 'password', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
