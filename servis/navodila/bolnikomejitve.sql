-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 19. dec 2022 ob 13.09
-- Različica strežnika: 10.4.19-MariaDB
-- Različica PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `navodila`
--

-- --------------------------------------------------------

--
-- Struktura tabele `omejitveTbl`
--

CREATE TABLE `omejitveTbl` (
  `id` int(3) UNSIGNED NOT NULL,
  `razlog` varchar(30) NOT NULL,
  `nivo` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `omejitveTbl`
--

INSERT INTO `omejitveTbl` (`id`, `razlog`, `nivo`) VALUES
(1, 'gdpr', 1);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `omejitveTbl`
--
ALTER TABLE `omejitveTbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `omejitveTbl`
--
ALTER TABLE `omejitveTbl`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
