-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 03. apr 2025 ob 08.09
-- Različica strežnika: 10.4.17-MariaDB
-- Različica PHP: 8.0.2

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
-- Struktura tabele `premedikacijatbl`
--

CREATE TABLE `premedikacijatbl` (
  `id` int(3) UNSIGNED NOT NULL,
  `teza` int(3) DEFAULT NULL,
  `midazolamDoza` decimal(3,1) DEFAULT NULL,
  `midazolamKoncentracija` decimal(3,1) DEFAULT NULL,
  `midazolamNavodila` varchar(225) DEFAULT NULL,
  `dexmedetomidinDoza` decimal(3,1) DEFAULT NULL,
  `dexmedetomidinKoncentracija` decimal(3,1) DEFAULT NULL,
  `dexmedetomidinNavodila` varchar(225) DEFAULT NULL,
  `ketaminDoza` decimal(3,1) DEFAULT NULL,
  `ketaminKoncentracija` decimal(3,1) DEFAULT NULL,
  `ketaminNavodila` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `premedikacijatbl`
--

INSERT INTO `premedikacijatbl` (`id`, `teza`, `midazolamDoza`, `midazolamKoncentracija`, `midazolamNavodila`, `dexmedetomidinDoza`, `dexmedetomidinKoncentracija`, `dexmedetomidinNavodila`, `ketaminDoza`, `ketaminKoncentracija`, `ketaminNavodila`) VALUES
(1, 1, '0.5', '1.0', 'Midazolam sirup 1,5 mg/ml\r\n', '3.0', '10.0', '10 mcg/ml (1 ml originalnega zdravila dexmedetomidin 100 mcg/ml razredčimo z 9 ml 0,9% NaCl)', NULL, '0.0', NULL),
(2, 5, '0.5', '1.0', 'Midazolam sirup 1,5 mg/ml', '3.0', '50.0', '50 mcg/ml (1 ml originalnega zdravila dexmedetomidin 100 mcg/ml razredčimo z 1 ml 0,9% NaCl)', NULL, '0.0', NULL),
(3, 20, '0.5', '1.0', 'Midazolam sirup 1,5 mg/ml', '3.0', '99.9', '100 mcg/ml (originalnega zdravila dexmedetomidin 100 mcg/ml ni potrebno redčiti)', NULL, '0.0', NULL);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `premedikacijatbl`
--
ALTER TABLE `premedikacijatbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `premedikacijatbl`
--
ALTER TABLE `premedikacijatbl`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
