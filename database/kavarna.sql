-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 24. kvě 2021, 22:16
-- Verze serveru: 10.4.13-MariaDB
-- Verze PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `kavarna`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `adopce`
--

CREATE TABLE `adopce` (
  `id` int(11) NOT NULL,
  `KockaID` int(11) DEFAULT NULL,
  `UzivatelID` int(11) DEFAULT NULL,
  `Penezni_castka` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `adopce`
--

INSERT INTO `adopce` (`id`, `KockaID`, `UzivatelID`, `Penezni_castka`) VALUES
(1, 2, NULL, 1500),
(2, 2, 11, 1700),
(3, 2, NULL, 1800),
(4, 12, 22, 5),
(5, 5, 22, 2147483647),
(6, 1, 22, 1500),
(7, 12, 16, 6554),
(8, 3, 22, 6500);

-- --------------------------------------------------------

--
-- Struktura tabulky `kocka`
--

CREATE TABLE `kocka` (
  `Jmeno` varchar(50) NOT NULL,
  `KockaID` int(11) NOT NULL,
  `Rasa` varchar(50) DEFAULT NULL,
  `Vek` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `kocka`
--

INSERT INTO `kocka` (`Jmeno`, `KockaID`, `Rasa`, `Vek`) VALUES
('Mikeš', 1, 'Ragdoll', 5),
('Mourek', 2, 'Siamská kočka', 2),
('Sněhulka', 3, 'Sokoke', 6),
('Clea', 4, 'Britská dlouhosrstá kočka', 2),
('elllssss', 5, 'ahoj', NULL),
('František', 6, '54785', 21),
('hgjghjgh', 12, 'jghjgh', 656);

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
  `Jmeno` varchar(50) NOT NULL,
  `Prijmeni` varchar(50) NOT NULL,
  `UzivatelID` int(11) NOT NULL,
  `role` varchar(10) NOT NULL,
  `heslo` varchar(100) NOT NULL,
  `uzivatelske_jmeno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`Jmeno`, `Prijmeni`, `UzivatelID`, `role`, `heslo`, `uzivatelske_jmeno`) VALUES
('Jan', 'Vedle', 11, 'uzivatel', 'heslo123', 'honza'),
('Zdeněk', 'Svěrák', 15, 'uzivatel', 'heslo123', 'zdena'),
('Petr', 'Ponížil', 16, 'uzivatel', 'heslo123', 'peta'),
('František', 'Hodný', 20, 'uzivatel', 'heslo123', 'franta1'),
('iuiuz', 'uziuz', 21, 'uzivatel', 'heslo123', 'uiui'),
('Vanda', 'Stromová', 22, 'uzivatel', 'heslo123', 'vanda'),
('admin', 'admin', 31, 'admin', 'admin', 'admin');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `adopce`
--
ALTER TABLE `adopce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_UzivatelID` (`UzivatelID`),
  ADD KEY `FK_KockaID` (`KockaID`);

--
-- Klíče pro tabulku `kocka`
--
ALTER TABLE `kocka`
  ADD PRIMARY KEY (`KockaID`);

--
-- Klíče pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`UzivatelID`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `adopce`
--
ALTER TABLE `adopce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `kocka`
--
ALTER TABLE `kocka`
  MODIFY `KockaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `UzivatelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `adopce`
--
ALTER TABLE `adopce`
  ADD CONSTRAINT `FK_KockaID` FOREIGN KEY (`KockaID`) REFERENCES `kocka` (`KockaID`),
  ADD CONSTRAINT `FK_UzivatelID` FOREIGN KEY (`UzivatelID`) REFERENCES `uzivatel` (`UzivatelID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
