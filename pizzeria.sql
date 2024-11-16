-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Lis 16, 2024 at 11:10 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `id` int(11) NOT NULL,
  `ulica` varchar(40) DEFAULT NULL,
  `nr_domu` int(11) DEFAULT NULL,
  `nr_mieszkania` int(11) DEFAULT NULL,
  `kod_pocztowy` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `adres`
--

INSERT INTO `adres` (`id`, `ulica`, `nr_domu`, `nr_mieszkania`, `kod_pocztowy`) VALUES
(1, 'Gorkiego', 32, 13, '70-390'),
(2, 'Gorkiego', 32, 13, '70-390'),
(3, 'Gorkiego', 32, 13, '70-390'),
(4, 'Gorkiego', 32, 13, '70-390'),
(5, 'Gorkiego', 32, 13, '70-390'),
(6, 'Gorkiego', 32, 13, '70-390'),
(7, 'Gorkiego', 32, 13, '70-390'),
(8, 'Gorkiego', 32, 13, '70-390'),
(9, 'Gorkiego', 32, 13, '70-390'),
(10, 'Gorkiego', 32, 13, '70-390'),
(11, 'Gorkiego', 32, 13, '70-390'),
(12, 'Gorkiego', 32, 13, '70-390'),
(13, 'Gorkiego', 32, 13, '70-390'),
(14, 'Gorkiego', 32, 13, '70-390'),
(15, 'Gorkiego', 32, 13, '70-390'),
(16, 'Gorkiego', 32, 13, '70-390'),
(17, 'Gorkiego', 32, 13, '70-390'),
(18, 'Gorkiego', 32, 13, '70-390'),
(19, 'Gorkiego', 32, 13, '70-390');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pizza`
--

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL,
  `skladniki` varchar(255) DEFAULT NULL,
  `rozmiar` enum('Ma?a','?rednia','Du?a') DEFAULT NULL,
  `cena` float(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) DEFAULT NULL,
  `nazwisko` varchar(50) DEFAULT NULL,
  `login` varchar(60) NOT NULL,
  `haslo` varchar(60) NOT NULL,
  `plec` tinyint(1) DEFAULT NULL,
  `zdjecie_src` varchar(255) DEFAULT NULL,
  `adres` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `uzytkownik`
--

INSERT INTO `uzytkownik` (`id`, `imie`, `nazwisko`, `login`, `haslo`, `plec`, `zdjecie_src`, `adres`) VALUES
(4, 'Szymon', 'Prusiewicz', 'szymon_p', '$2y$10$qfV.L6PY1UejPqoaObmYUO684UpKym4v6U6vLz84sFhahfcMOehX2', 1, '/mnt/uwu/home_extended/szymon/Dokumenty/kodowanie/github/pizzeria/assets/users/zrzut_17-05-21_16-11-2024.png', 19);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie`
--

CREATE TABLE `zamowienie` (
  `id` int(11) NOT NULL,
  `klient` int(11) DEFAULT NULL,
  `pizza_id` int(11) DEFAULT NULL,
  `ilosc` int(11) DEFAULT 1,
  `cena` float(6,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`) USING BTREE,
  ADD KEY `adres` (`adres`);

--
-- Indeksy dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klient` (`klient`),
  ADD KEY `pizza_id` (`pizza_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adres`
--
ALTER TABLE `adres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zamowienie`
--
ALTER TABLE `zamowienie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD CONSTRAINT `uzytkownik_ibfk_1` FOREIGN KEY (`adres`) REFERENCES `adres` (`id`);

--
-- Constraints for table `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD CONSTRAINT `zamowienie_ibfk_1` FOREIGN KEY (`klient`) REFERENCES `uzytkownik` (`id`),
  ADD CONSTRAINT `zamowienie_ibfk_2` FOREIGN KEY (`pizza_id`) REFERENCES `pizza` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
