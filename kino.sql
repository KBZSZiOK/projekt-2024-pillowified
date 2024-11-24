-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 25, 2024 at 12:13 AM
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
-- Database: `kino`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bilety`
--

CREATE TABLE `bilety` (
  `ID` int(11) NOT NULL,
  `SEANS_ID` int(11) NOT NULL,
  `SPRZEDAWCA_ID` int(11) NOT NULL,
  `KLIENT_ID` int(11) NOT NULL,
  `CENA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bilety`
--

INSERT INTO `bilety` (`ID`, `SEANS_ID`, `SPRZEDAWCA_ID`, `KLIENT_ID`, `CENA`) VALUES
(1, 1, 1, 1, 25),
(2, 2, 2, 2, 30.5),
(3, 1, 1, 3, 20),
(4, 3, 3, 1, 15),
(5, 4, 2, 2, 22.5),
(6, 5, 1, 3, 28),
(7, 6, 3, 1, 18);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filmy`
--

CREATE TABLE `filmy` (
  `ID` int(11) NOT NULL,
  `TYTUŁ` varchar(50) NOT NULL,
  `REŻYSER` varchar(50) NOT NULL,
  `CZAS_TRWANIA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filmy`
--

INSERT INTO `filmy` (`ID`, `TYTUŁ`, `REŻYSER`, `CZAS_TRWANIA`) VALUES
(1, 'Pulp Fiction', 'Quentin Tarantino', 120),
(2, 'Inception', 'Christopher Nolan', 142),
(3, 'Lady Bird', 'Greta Gerwig', 95),
(4, 'The Irishman', 'Martin Scorsese', 158),
(5, 'Avatar', 'James Cameron', 104),
(6, 'Fight Club', 'David Fincher', 135),
(7, 'Dune', 'Denis Villeneuve', 126),
(8, 'Toy Story', 'Pixar Animation Studios', 87),
(9, 'The Lord of the Rings: The Fellowship of the Ring', 'Peter Jackson', 112),
(10, 'Jurassic Park', 'Steven Spielberg', 130),
(11, 'Jazda', 'Rysiu Gąsowski', 104),
(12, 'Robi Lore', 'Krzysztof Gosz', 60);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filmy_rodzaj`
--

CREATE TABLE `filmy_rodzaj` (
  `ID` int(11) NOT NULL,
  `FILMY_ID` int(11) NOT NULL,
  `RODZAJ_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filmy_rodzaj`
--

INSERT INTO `filmy_rodzaj` (`ID`, `FILMY_ID`, `RODZAJ_ID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 3, 3),
(5, 4, 2),
(6, 5, 1),
(7, 2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `ID` int(11) NOT NULL,
  `IMIĘ` varchar(50) NOT NULL,
  `NAZWISKO` varchar(50) NOT NULL,
  `MAIL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`ID`, `IMIĘ`, `NAZWISKO`, `MAIL`) VALUES
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
-- Struktura tabeli dla tabeli `rodzaj_filmu`
--

CREATE TABLE `rodzaj_filmu` (
  `ID` int(11) NOT NULL,
  `NAZWA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rodzaj_filmu`
--

INSERT INTO `rodzaj_filmu` (`ID`, `NAZWA`) VALUES
(1, 'Romantic'),
(2, 'Documentary'),
(3, 'Animation'),
(4, 'Action'),
(5, 'Comedy'),
(6, 'Drama'),
(7, 'Horror'),
(8, 'Thriller'),
(9, 'Science Fiction'),
(10, 'Fantasy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sale`
--

CREATE TABLE `sale` (
  `ID` int(11) NOT NULL,
  `ILOŚĆ_MIEJSC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`ID`, `ILOŚĆ_MIEJSC`) VALUES
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
-- Struktura tabeli dla tabeli `seanse`
--

CREATE TABLE `seanse` (
  `ID` int(11) NOT NULL,
  `TERMIN` datetime NOT NULL,
  `SALA_ID` int(11) NOT NULL,
  `FILM_ID` int(11) NOT NULL,
  `LICZBA_WOLNYCH_MIEJSC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seanse`
--

INSERT INTO `seanse` (`ID`, `TERMIN`, `SALA_ID`, `FILM_ID`, `LICZBA_WOLNYCH_MIEJSC`) VALUES
(1, '2024-10-30 18:00:00', 1, 1, 80),
(2, '2024-10-30 20:00:00', 2, 2, 100),
(3, '2024-10-31 18:00:00', 1, 1, 50),
(4, '2024-10-31 21:00:00', 3, 3, 70),
(5, '2024-11-01 19:00:00', 2, 2, 30),
(6, '2024-11-02 15:00:00', 4, 4, 0),
(7, '2024-11-03 17:30:00', 5, 5, 150),
(8, '2024-11-06 00:00:00', 2, 3, 123);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprzedawcy`
--

CREATE TABLE `sprzedawcy` (
  `ID` int(11) NOT NULL,
  `IMIĘ` varchar(50) NOT NULL,
  `NAZWISKO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sprzedawcy`
--

INSERT INTO `sprzedawcy` (`ID`, `IMIĘ`, `NAZWISKO`) VALUES
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `Nazwa` varchar(50) NOT NULL,
  `Haslo` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL,
  `Access` tinyint(1) NOT NULL,
  `Select` tinyint(1) NOT NULL,
  `Modify` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`Nazwa`, `Haslo`, `ID`, `Access`, `Select`, `Modify`) VALUES
('admin', 'hotdog32', 1, 1, 1, 1),
('moderator', 'kebab123', 2, 1, 1, 0),
('viewer', 'password', 3, 0, 0, 0),
('kamil', 'west', 19, 1, 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bilety`
--
ALTER TABLE `bilety`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Seans` (`SEANS_ID`),
  ADD KEY `fk_Sprzedawca` (`SPRZEDAWCA_ID`),
  ADD KEY `fk_Klient` (`KLIENT_ID`);

--
-- Indeksy dla tabeli `filmy`
--
ALTER TABLE `filmy`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `filmy_rodzaj`
--
ALTER TABLE `filmy_rodzaj`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Rodzaj_Filmu` (`RODZAJ_ID`),
  ADD KEY `fk_Filmy` (`FILMY_ID`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `rodzaj_filmu`
--
ALTER TABLE `rodzaj_filmu`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `seanse`
--
ALTER TABLE `seanse`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Film` (`FILM_ID`),
  ADD KEY `fk_Sale` (`SALA_ID`);

--
-- Indeksy dla tabeli `sprzedawcy`
--
ALTER TABLE `sprzedawcy`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bilety`
--
ALTER TABLE `bilety`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `filmy`
--
ALTER TABLE `filmy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `filmy_rodzaj`
--
ALTER TABLE `filmy_rodzaj`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rodzaj_filmu`
--
ALTER TABLE `rodzaj_filmu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seanse`
--
ALTER TABLE `seanse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sprzedawcy`
--
ALTER TABLE `sprzedawcy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bilety`
--
ALTER TABLE `bilety`
  ADD CONSTRAINT `fk_Klient` FOREIGN KEY (`KLIENT_ID`) REFERENCES `klienci` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Seans` FOREIGN KEY (`SEANS_ID`) REFERENCES `seanse` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Sprzedawca` FOREIGN KEY (`SPRZEDAWCA_ID`) REFERENCES `sprzedawcy` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `filmy_rodzaj`
--
ALTER TABLE `filmy_rodzaj`
  ADD CONSTRAINT `fk_Filmy` FOREIGN KEY (`FILMY_ID`) REFERENCES `filmy` (`ID`),
  ADD CONSTRAINT `fk_Rodzaj_Filmu` FOREIGN KEY (`RODZAJ_ID`) REFERENCES `rodzaj_filmu` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `seanse`
--
ALTER TABLE `seanse`
  ADD CONSTRAINT `fk_Film` FOREIGN KEY (`FILM_ID`) REFERENCES `filmy` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Sala` FOREIGN KEY (`SALA_ID`) REFERENCES `sale` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Sale` FOREIGN KEY (`SALA_ID`) REFERENCES `sale` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
