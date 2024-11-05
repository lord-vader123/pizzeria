-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Lis 05, 2024 at 02:55 PM
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
-- Struktura tabeli dla tabeli `Adresy`
--

CREATE TABLE `Adresy` (
  `id` int(11) NOT NULL,
  `ulica` varchar(100) DEFAULT NULL,
  `nr_bloku` varchar(10) DEFAULT NULL,
  `nr_domu` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Klienci`
--

CREATE TABLE `Klienci` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) DEFAULT NULL,
  `nazwisko` varchar(50) DEFAULT NULL,
  `id_adresu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Pizze`
--

CREATE TABLE `Pizze` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL,
  `cena` float(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Płatności`
--

CREATE TABLE `Płatności` (
  `id` int(11) NOT NULL,
  `id_zamowienia` int(11) DEFAULT NULL,
  `id_typu_platnosci` int(11) DEFAULT NULL,
  `status_platności` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Skladniki`
--

CREATE TABLE `Skladniki` (
  `id` int(11) NOT NULL,
  `nazwa_skladnika` varchar(50) DEFAULT NULL,
  `id_pizzy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Typy_platnosci`
--

CREATE TABLE `Typy_platnosci` (
  `id` int(11) NOT NULL,
  `nazwa_typu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Zamowienia`
--

CREATE TABLE `Zamowienia` (
  `id` int(11) NOT NULL,
  `id_klienta` int(11) DEFAULT NULL,
  `id_pizzy` int(11) DEFAULT NULL,
  `data_zamowienia` date DEFAULT NULL,
  `cena_zamowienia` float(6,2) NOT NULL,
  `kosz_dostawy` float(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Adresy`
--
ALTER TABLE `Adresy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Klienci`
--
ALTER TABLE `Klienci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_adresu` (`id_adresu`);

--
-- Indeksy dla tabeli `Pizze`
--
ALTER TABLE `Pizze`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Płatności`
--
ALTER TABLE `Płatności`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_zamowienia` (`id_zamowienia`),
  ADD KEY `id_typu_platnosci` (`id_typu_platnosci`);

--
-- Indeksy dla tabeli `Skladniki`
--
ALTER TABLE `Skladniki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pizzy` (`id_pizzy`);

--
-- Indeksy dla tabeli `Typy_platnosci`
--
ALTER TABLE `Typy_platnosci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Zamowienia`
--
ALTER TABLE `Zamowienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klienta` (`id_klienta`),
  ADD KEY `id_pizzy` (`id_pizzy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Adresy`
--
ALTER TABLE `Adresy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Klienci`
--
ALTER TABLE `Klienci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Pizze`
--
ALTER TABLE `Pizze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Płatności`
--
ALTER TABLE `Płatności`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Skladniki`
--
ALTER TABLE `Skladniki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Typy_platnosci`
--
ALTER TABLE `Typy_platnosci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Zamowienia`
--
ALTER TABLE `Zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Klienci`
--
ALTER TABLE `Klienci`
  ADD CONSTRAINT `Klienci_ibfk_1` FOREIGN KEY (`id_adresu`) REFERENCES `Adresy` (`id`);

--
-- Constraints for table `Płatności`
--
ALTER TABLE `Płatności`
  ADD CONSTRAINT `Płatności_ibfk_1` FOREIGN KEY (`id_zamowienia`) REFERENCES `Zamowienia` (`id`),
  ADD CONSTRAINT `Płatności_ibfk_2` FOREIGN KEY (`id_typu_platnosci`) REFERENCES `Typy_platnosci` (`id`);

--
-- Constraints for table `Skladniki`
--
ALTER TABLE `Skladniki`
  ADD CONSTRAINT `Skladniki_ibfk_1` FOREIGN KEY (`id_pizzy`) REFERENCES `Pizze` (`id`);

--
-- Constraints for table `Zamowienia`
--
ALTER TABLE `Zamowienia`
  ADD CONSTRAINT `Zamowienia_ibfk_1` FOREIGN KEY (`id_klienta`) REFERENCES `Klienci` (`id`),
  ADD CONSTRAINT `Zamowienia_ibfk_2` FOREIGN KEY (`id_pizzy`) REFERENCES `Pizze` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
