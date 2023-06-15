-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 15, 2023 at 02:16 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_konta`
--

CREATE TABLE `dane_konta` (
  `id` int(11) NOT NULL,
  `id_loginu` int(11) NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `data_urodzenia` date DEFAULT NULL,
  `nr_tel` varchar(20) DEFAULT NULL,
  `miasto` varchar(100) DEFAULT NULL,
  `kraj` varchar(100) DEFAULT NULL,
  `opis_konta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_konta`
--

INSERT INTO `dane_konta` (`id`, `id_loginu`, `nazwa`, `avatar`, `data_urodzenia`, `nr_tel`, `miasto`, `kraj`, `opis_konta`) VALUES
(1, 1, 'Krzychu', 'avatary/2023-05-17-16-42-07.png', '2004-05-03', '885332400', 'Wieruszów', 'Niger', 'Założyciel'),
(4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `loginy`
--

CREATE TABLE `loginy` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `data_rejestru` datetime NOT NULL,
  `ostatnie_logowanie` datetime DEFAULT NULL,
  `token_hasla` char(20) DEFAULT NULL,
  `data_zmiany_hasla` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `loginy`
--

INSERT INTO `loginy` (`id`, `login`, `pass`, `data_rejestru`, `ostatnie_logowanie`, `token_hasla`, `data_zmiany_hasla`) VALUES
(1, 'admin1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$YjFBeFE1SkJaa1pScDMxNQ$2ef4mk9Xz32gOvjNEAUMHKYWvZKcrKfGfVBSmIydQNE', '2023-05-15 17:29:12', '2023-06-15 14:00:04', 'fef15f5bfbc48e99a8ab', '2023-06-06 17:21:09'),
(2, 'nowy1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$c0plM0lRdzV5aWwwY29kQQ$I6CEs3PrwqnxD8kgxV52o7KPIrAPk86dFQzwVztUbqY', '2023-05-16 01:02:49', '2023-05-16 01:02:58', NULL, NULL),
(3, 'krzychu1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$TTduOTV3ZzNZQjhpTjdSRg$t645NztZ3WK3AUsCnDEU3UpmuphJjg8NBMUAywS6xDI', '2023-05-24 00:03:01', NULL, NULL, NULL),
(4, 'kurw1@w.pl', '$argon2i$v=19$m=65536,t=4,p=1$bVQvWUFEaDRjejNMU1ExeQ$pv7h8gW1X0tZZClupi7KiZka+V0OLWWWdIo+vPQM5t4', '2023-05-24 00:27:42', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(200) NOT NULL,
  `cena` smallint(6) NOT NULL,
  `ilosc` smallint(6) NOT NULL,
  `rodzaj` varchar(50) NOT NULL,
  `rozmiar` varchar(20) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dane_konta`
--
ALTER TABLE `dane_konta`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `loginy`
--
ALTER TABLE `loginy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dane_konta`
--
ALTER TABLE `dane_konta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loginy`
--
ALTER TABLE `loginy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
