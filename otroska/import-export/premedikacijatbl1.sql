-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 23. apr 2025 ob 21.40
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

CREATE TABLE `premedikacija1tbl` (
  `id` int(3) UNSIGNED NOT NULL,
  `ucinkovina` varchar(225) DEFAULT NULL,  
  `teza` int(3) DEFAULT NULL,
  `doza` decimal(3,1) DEFAULT NULL,
  `koncentracija` decimal(3,1) DEFAULT NULL,
  `navodila` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `premedikacija1tbl`
--

INSERT INTO `premedikacija1tbl` (`id`, `ucinkovina`, `teza`, `doza`, `koncentracija`, `navodila`) VALUES
(1,'midazolam',1, '0.5', '1.5', 'Midazolam sirup 1,5 mg/ml'),

(2,'dexmedetomidin',1, '3.0', '10.0', '10 mcg/ml (1 ml originalnega zdravila dexmedetomidin 100 mcg/ml razredčimo z 9 ml 0,9% NaCl)'),

(3,'dexmedetomidin',1, '3.0', '10.0', '50 mcg/ml (1 ml originalnega zdravila dexmedetomidin 100 mcg/ml razredčimo z 1 ml 0,9% NaCl)'),

(4,'dexmedetomidin',1, '3.0', '10.0', '100 mcg/ml (originalnega zdravila dexmedetomidin 100 mcg/ml ni potrebno redčiti)'),

(5,'ketamin',1, '5.0', '25.0', 'raztopina za injekcije 25mg/ml');


--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `premedikacija1tbl`
--
ALTER TABLE `premedikacija1tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `premedikacija1tbl`
--
ALTER TABLE `premedikacija1tbl`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
