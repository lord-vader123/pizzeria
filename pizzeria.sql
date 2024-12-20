-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Lis 17, 2024 at 03:54 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pizza`
--

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL,
  `skladniki` varchar(255) DEFAULT NULL,
  `rozmiar` enum('Mała','Średnia','Duża') DEFAULT NULL,
  `cena` float(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`id`, `nazwa`, `skladniki`, `rozmiar`, `cena`) VALUES
(1, 'Margarita', 'Sos pomidorowy, ser', 'Średnia', 40.55),
(2, 'Caprisiosa', 'Sos pomidorowy, ser, pieczarki', 'Mała', 40.22),
(3, 'Z krewetkami', 'Sos pomidorowy, krewetki, ser, pieczarki', 'Duża', 120.00),
(4, 'Z rucolą', 'Sos pomidorowy, ser, rucola', 'Średnia', 50.00),
(5, 'Pepperoni', 'sos pomidorowy, mozzarella, pepperoni', 'Średnia', 26.99),
(6, 'Hawajska', 'sos pomidorowy, mozzarella, szynka, ananas', 'Duża', 28.50),
(7, 'Quattro Stagioni', 'sos pomidorowy, mozzarella, szynka, pieczarki, karczochy, oliwki', 'Średnia', 30.00),
(8, 'Vegetariana', 'sos pomidorowy, mozzarella, papryka, cukinia, bakłażan, cebula', 'Duża', 27.99),
(9, 'Diavola', 'sos pomidorowy, mozzarella, salami, papryczki chili', 'Mała', 23.50),
(10, 'Frutti di Mare', 'sos pomidorowy, mozzarella, owoce morza, czosnek', 'Średnia', 32.00),
(11, 'BBQ Chicken', 'sos BBQ, mozzarella, kurczak, cebula, kukurydza', 'Duża', 29.99),
(12, 'Carbonara', 'sos śmietanowy, mozzarella, boczek, jajko, cebula', 'Średnia', 26.50),
(13, 'Marinara', 'sos pomidorowy, czosnek, oliwa, oregano, bazylia', 'Mała', 21.00),
(14, 'Truflowa', 'sos pomidorowy, mozzarella, trufle, pieczarki, rukola', 'Duża', 34.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
