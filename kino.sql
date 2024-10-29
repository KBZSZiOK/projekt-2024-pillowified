-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 29, 2024 at 01:49 PM
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
-- Table structure for table `Administratorzy`
--

CREATE TABLE `Administratorzy` (
  `Nazwa` varchar(50) NOT NULL,
  `Haslo` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Administratorzy`
--

INSERT INTO `Administratorzy` (`Nazwa`, `Haslo`, `ID`) VALUES
('admin', 'hotdog32', 1);

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

--
-- Dumping data for table `Bilety`
--

INSERT INTO `Bilety` (`ID`, `SEANS_ID`, `SPRZEDAWCA_ID`, `KLIENT_ID`, `CENA`) VALUES
(1, 1, 1, 1, 25),
(2, 2, 2, 2, 30.5),
(3, 1, 1, 3, 20),
(4, 3, 3, 1, 15),
(5, 4, 2, 2, 22.5),
(6, 5, 1, 3, 28),
(7, 6, 3, 1, 18);

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

--
-- Dumping data for table `Filmy`
--

INSERT INTO `Filmy` (`ID`, `TYTUŁ`, `REŻYSER`, `CZAS_TRWANIA`) VALUES
(1, 'Pulp Fiction', 'Quentin Tarantino', 120),
(2, 'Inception', 'Christopher Nolan', 142),
(3, 'Lady Bird', 'Greta Gerwig', 95),
(4, 'The Irishman', 'Martin Scorsese', 158),
(5, 'Avatar', 'James Cameron', 104),
(6, 'Fight Club', 'David Fincher', 135),
(7, 'Dune', 'Denis Villeneuve', 126),
(8, 'Toy Story', 'Pixar Animation Studios', 87),
(9, 'The Lord of the Rings: The Fellowship of the Ring', 'Peter Jackson', 112),
(10, 'Jurassic Park', 'Steven Spielberg', 130);

-- --------------------------------------------------------

--
-- Table structure for table `Filmy_Rodzaj`
--

CREATE TABLE `Filmy_Rodzaj` (
  `ID` int(11) NOT NULL,
  `FILMY_ID` int(11) NOT NULL,
  `RODZAJ_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Filmy_Rodzaj`
--

INSERT INTO `Filmy_Rodzaj` (`ID`, `FILMY_ID`, `RODZAJ_ID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 3, 3),
(5, 4, 2),
(6, 5, 1),
(7, 2, 3);

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

--
-- Dumping data for table `Klienci`
--

INSERT INTO `Klienci` (`ID`, `IMIĘ`, `NAZWISKO`, `MAIL`) VALUES
(1, 'Jan', 'Kowalski', 'jan.kowalski@example.com'),
(2, 'Anna', 'Nowak', 'anna.nowak@example.com'),
(3, 'Piotr', 'Kaczmarek', 'piotr.kaczmarek@example.com'),
(4, 'Katarzyna', 'Wiśniewska', 'katarzyna.wisniewska@example.com'),
(5, 'Michał', 'Wójcik', 'michal.wojcik@example.com'),
(6, 'Ewa', 'Kowalczyk', 'ewa.kowalczyk@example.com'),
(7, 'Tomasz', 'Ziemek', 'tomasz.ziemek@example.com'),
(8, 'Zofia', 'Kryszak', 'zofia.kryszak@example.com'),
(9, 'Jakub', 'Borowski', 'jakub.borowski@example.com'),
(10, 'Julia', 'Majewska', 'julia.majewska@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `Rodzaj_Filmu`
--

CREATE TABLE `Rodzaj_Filmu` (
  `ID` int(11) NOT NULL,
  `NAZWA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Rodzaj_Filmu`
--

INSERT INTO `Rodzaj_Filmu` (`ID`, `NAZWA`) VALUES
(1, 'Shrek'),
(2, 'Shrek 2'),
(3, 'Shrek 3'),
(4, 'Action'),
(5, 'Comedy'),
(6, 'Drama'),
(7, 'Horror'),
(8, 'Thriller'),
(9, 'Science Fiction'),
(10, 'Fantasy'),
(11, 'Romantic'),
(12, 'Documentary'),
(13, 'Animation');

-- --------------------------------------------------------

--
-- Table structure for table `Sale`
--

CREATE TABLE `Sale` (
  `ID` int(11) NOT NULL,
  `ILOŚĆ_MIEJSC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Sale`
--

INSERT INTO `Sale` (`ID`, `ILOŚĆ_MIEJSC`) VALUES
(1, 100),
(2, 150),
(3, 200),
(4, 75),
(5, 50),
(6, 300),
(7, 120),
(8, 90);

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

--
-- Dumping data for table `Seanse`
--

INSERT INTO `Seanse` (`ID`, `TERMIN`, `SALA_ID`, `FILM_ID`, `LICZBA_WOLNYCH_MIEJSC`) VALUES
(1, '2024-10-30 18:00:00', 1, 1, 80),
(2, '2024-10-30 20:00:00', 2, 2, 100),
(3, '2024-10-31 18:00:00', 1, 1, 50),
(4, '2024-10-31 21:00:00', 3, 3, 70),
(5, '2024-11-01 19:00:00', 2, 2, 30),
(6, '2024-11-02 15:00:00', 4, 4, 0),
(7, '2024-11-03 17:30:00', 5, 5, 150);

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
-- Dumping data for table `Sprzedawcy`
--

INSERT INTO `Sprzedawcy` (`ID`, `IMIĘ`, `NAZWISKO`) VALUES
(1, 'Kamil', 'Nowak'),
(2, 'Marta', 'Kowalska'),
(3, 'Filip', 'Zieliński'),
(4, 'Olga', 'Wojciechowska'),
(5, 'Jakub', 'Kamiński'),
(6, 'Natalia', 'Jankowska'),
(7, 'Mateusz', 'Kaczmarek'),
(8, 'Karolina', 'Zalewska'),
(9, 'Piotr', 'Mazur'),
(10, 'Ewa', 'Szymańska');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Administratorzy`
--
ALTER TABLE `Administratorzy`
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT for table `Administratorzy`
--
ALTER TABLE `Administratorzy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Bilety`
--
ALTER TABLE `Bilety`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Filmy`
--
ALTER TABLE `Filmy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Filmy_Rodzaj`
--
ALTER TABLE `Filmy_Rodzaj`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Klienci`
--
ALTER TABLE `Klienci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Rodzaj_Filmu`
--
ALTER TABLE `Rodzaj_Filmu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Sale`
--
ALTER TABLE `Sale`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Seanse`
--
ALTER TABLE `Seanse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Sprzedawcy`
--
ALTER TABLE `Sprzedawcy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
