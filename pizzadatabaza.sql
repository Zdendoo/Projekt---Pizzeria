-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: So 13.Jún 2026, 20:15
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `pizzadatabaza`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `kontakty`
--

CREATE TABLE `kontakty` (
  `id` int(11) NOT NULL,
  `meno` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `predmet` varchar(255) DEFAULT NULL,
  `sprava` text DEFAULT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `kontakty`
--

INSERT INTO `kontakty` (`id`, `meno`, `email`, `predmet`, `sprava`, `datum`) VALUES
(1, 'Denis Valkovič', 'denisvalkovic390@gmail.com', 'Skuska 1', 'Toto je test', '2026-04-14 13:50:35'),
(4, 'Denis Valkovič', 'denisvalkovic390@gmail.com', 'Skuska 2', 'halooooooooooo', '2026-06-10 16:46:43'),
(5, 'Denis Valkovič', 'denisvalkovic390@gmail.com', 'Sťažnosť', 'nebola dobrá', '2026-06-10 17:24:55');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pizze`
--

CREATE TABLE `pizze` (
  `id` int(11) NOT NULL,
  `nazov` varchar(100) NOT NULL,
  `popis` varchar(255) NOT NULL,
  `obrazok` varchar(255) NOT NULL,
  `cena` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `pizze`
--

INSERT INTO `pizze` (`id`, `nazov`, `popis`, `obrazok`, `cena`) VALUES
(3, 'Margarita', 'Rajčinová omáčka, mozzarella, šunka, ananás - A1, A7 - (500g)', 'gallery-img3.jpg', 8.90),
(4, 'Primavera', 'Rajčinová omáčka, mozzarella, cherry rajčinky, prosciutto, rukola - A1, A7 - (480g)', 'gallery-img4.jpg', 8.70),
(5, 'Al Salamino', 'Rajčinová omáčka, mozzarella, saláma, feferónky, cibuľa, kukurica - A1, A7 - (550g)', 'gallery-img2.jpg', 8.10);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `kontakty`
--
ALTER TABLE `kontakty`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `pizze`
--
ALTER TABLE `pizze`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `kontakty`
--
ALTER TABLE `kontakty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `pizze`
--
ALTER TABLE `pizze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
