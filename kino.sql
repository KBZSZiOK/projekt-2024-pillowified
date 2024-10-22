-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2024 at 09:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kino`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bilety`
--

CREATE TABLE `Bilety` (
  `ID` int(11) NOT NULL,
  `SEANS_ID` int(11) NOT NULL,
  `SPRZEDAWCA_ID` int(11) NOT NULL,
  `KLIENT_ID` int(11) NOT NULL,
  `CENA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Filmy`
--

CREATE TABLE `Filmy` (
  `ID` int(11) NOT NULL,
  `TYTUŁ` varchar(50) NOT NULL,
  `REŻYSER` varchar(50) NOT NULL,
  `CZAS_TRWANIA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Filmy_Rodzaj`
--

CREATE TABLE `Filmy_Rodzaj` (
  `ID` int(11) NOT NULL,
  `FILMY_ID` int(11) NOT NULL,
  `RODZAJ_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Klienci`
--

CREATE TABLE `Klienci` (
  `ID` int(11) NOT NULL,
  `IMIĘ` varchar(50) NOT NULL,
  `NAZWISKO` varchar(50) NOT NULL,
  `MAIL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Rodzaj_Filmu`
--

CREATE TABLE `Rodzaj_Filmu` (
  `ID` int(11) NOT NULL,
  `NAZWA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Sale`
--

CREATE TABLE `Sale` (
  `ID` int(11) NOT NULL,
  `ILOŚĆ_MIEJSC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Seanse`
--

CREATE TABLE `Seanse` (
  `ID` int(11) NOT NULL,
  `TERMIN` datetime NOT NULL,
  `SALA_ID` int(11) NOT NULL,
  `FILM_ID` int(11) NOT NULL,
  `LICZBA_WOLNYCH_MIEJSC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Sprzedawcy`
--

CREATE TABLE `Sprzedawcy` (
  `ID` int(11) NOT NULL,
  `IMIĘ` varchar(50) NOT NULL,
  `NAZWISKO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bilety`
--
ALTER TABLE `Bilety`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Seans` (`SEANS_ID`),
  ADD KEY `fk_Sprzedawca` (`SPRZEDAWCA_ID`),
  ADD KEY `fk_Klient` (`KLIENT_ID`);

--
-- Indexes for table `Filmy`
--
ALTER TABLE `Filmy`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Filmy_Rodzaj`
--
ALTER TABLE `Filmy_Rodzaj`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Rodzaj_Filmu` (`RODZAJ_ID`),
  ADD KEY `fk_Filmy` (`FILMY_ID`);

--
-- Indexes for table `Klienci`
--
ALTER TABLE `Klienci`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Rodzaj_Filmu`
--
ALTER TABLE `Rodzaj_Filmu`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Sale`
--
ALTER TABLE `Sale`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Seanse`
--
ALTER TABLE `Seanse`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Film` (`FILM_ID`),
  ADD KEY `fk_Sale` (`SALA_ID`);

--
-- Indexes for table `Sprzedawcy`
--
ALTER TABLE `Sprzedawcy`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bilety`
--
ALTER TABLE `Bilety`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Filmy`
--
ALTER TABLE `Filmy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Filmy_Rodzaj`
--
ALTER TABLE `Filmy_Rodzaj`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Klienci`
--
ALTER TABLE `Klienci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Rodzaj_Filmu`
--
ALTER TABLE `Rodzaj_Filmu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Sale`
--
ALTER TABLE `Sale`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Seanse`
--
ALTER TABLE `Seanse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Sprzedawcy`
--
ALTER TABLE `Sprzedawcy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bilety`
--
ALTER TABLE `Bilety`
  ADD CONSTRAINT `fk_Klient` FOREIGN KEY (`KLIENT_ID`) REFERENCES `Klienci` (`ID`),
  ADD CONSTRAINT `fk_Seans` FOREIGN KEY (`SEANS_ID`) REFERENCES `Seanse` (`ID`),
  ADD CONSTRAINT `fk_Sprzedawca` FOREIGN KEY (`SPRZEDAWCA_ID`) REFERENCES `Sprzedawcy` (`ID`);

--
-- Constraints for table `Filmy_Rodzaj`
--
ALTER TABLE `Filmy_Rodzaj`
  ADD CONSTRAINT `fk_Filmy` FOREIGN KEY (`FILMY_ID`) REFERENCES `Filmy` (`ID`),
  ADD CONSTRAINT `fk_Rodzaj_Filmu` FOREIGN KEY (`RODZAJ_ID`) REFERENCES `Rodzaj_Filmu` (`ID`);

--
-- Constraints for table `Seanse`
--
ALTER TABLE `Seanse`
  ADD CONSTRAINT `fk_Film` FOREIGN KEY (`FILM_ID`) REFERENCES `Filmy` (`ID`),
  ADD CONSTRAINT `fk_Sale` FOREIGN KEY (`SALA_ID`) REFERENCES `Sale` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
