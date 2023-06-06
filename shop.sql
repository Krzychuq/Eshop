-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Cze 2023, 20:04
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_konta`
--

CREATE TABLE `dane_konta` (
  `id` int(11) NOT NULL,
  `id_loginu` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `data_urodzenia` date DEFAULT NULL,
  `nr_tel` varchar(20) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `miasto` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `kraj` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `opis_konta` text COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `dane_konta`
--

INSERT INTO `dane_konta` (`id`, `id_loginu`, `nazwa`, `avatar`, `data_urodzenia`, `nr_tel`, `miasto`, `kraj`, `opis_konta`) VALUES
(1, 1, 'Krzychu', 'avatary/2023-05-17-16-42-07.png', '2004-05-03', '885332400', 'Wieruszów', 'Polska', 'Założyciel'),
(4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarz`
--

CREATE TABLE `komentarz` (
  `id` int(11) NOT NULL,
  `id_postu` int(11) NOT NULL,
  `tresc` text COLLATE utf8mb4_polish_ci NOT NULL,
  `lapkaGora` int(11) NOT NULL,
  `lapkaDol` int(11) NOT NULL,
  `data_utworzenia` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `loginy`
--

CREATE TABLE `loginy` (
  `id` int(11) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `data_rejestru` datetime NOT NULL,
  `ostatnie_logowanie` datetime DEFAULT NULL,
  `token_hasla` char(20) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `data_zmiany_hasla` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `loginy`
--

INSERT INTO `loginy` (`id`, `login`, `pass`, `data_rejestru`, `ostatnie_logowanie`, `token_hasla`, `data_zmiany_hasla`) VALUES
(1, 'admin1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$YjFBeFE1SkJaa1pScDMxNQ$2ef4mk9Xz32gOvjNEAUMHKYWvZKcrKfGfVBSmIydQNE', '2023-05-15 17:29:12', '2023-06-06 17:21:21', 'fef15f5bfbc48e99a8ab', '2023-06-06 17:21:09'),
(2, 'nowy1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$c0plM0lRdzV5aWwwY29kQQ$I6CEs3PrwqnxD8kgxV52o7KPIrAPk86dFQzwVztUbqY', '2023-05-16 01:02:49', '2023-05-16 01:02:58', NULL, NULL),
(3, 'krzychu1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$TTduOTV3ZzNZQjhpTjdSRg$t645NztZ3WK3AUsCnDEU3UpmuphJjg8NBMUAywS6xDI', '2023-05-24 00:03:01', NULL, NULL, NULL),
(4, 'kurw1@w.pl', '$argon2i$v=19$m=65536,t=4,p=1$bVQvWUFEaDRjejNMU1ExeQ$pv7h8gW1X0tZZClupi7KiZka+V0OLWWWdIo+vPQM5t4', '2023-05-24 00:27:42', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `tytul` varchar(300) COLLATE utf8mb4_polish_ci NOT NULL,
  `tresc` text COLLATE utf8mb4_polish_ci NOT NULL,
  `data_utworzenia` datetime NOT NULL,
  `lapkaGora` mediumint(9) DEFAULT NULL,
  `lapkaDol` mediumint(9) DEFAULT NULL
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
-- Indeksy dla tabeli `komentarz`
--
ALTER TABLE `komentarz`
  ADD KEY `id_postu` (`id_postu`);

--
-- Indeksy dla tabeli `loginy`
--
ALTER TABLE `loginy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `dane_konta`
--
ALTER TABLE `dane_konta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `loginy`
--
ALTER TABLE `loginy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `komentarz`
--
ALTER TABLE `komentarz`
  ADD CONSTRAINT `komentarz_ibfk_1` FOREIGN KEY (`id_postu`) REFERENCES `post` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
