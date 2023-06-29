-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 29, 2023 at 08:21 AM
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
  `opis_konta` text DEFAULT NULL,
  `dostep` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_konta`
--

INSERT INTO `dane_konta` (`id`, `id_loginu`, `nazwa`, `avatar`, `data_urodzenia`, `nr_tel`, `miasto`, `kraj`, `opis_konta`, `dostep`) VALUES
(1, 1, 'Krzychu', 'avatary/2023-05-17-16-42-07.png', '2004-05-03', '885332400', 'Wieruszów', 'Niger', 'Założyciel', 1),
(4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(6, 7, 's', NULL, NULL, NULL, NULL, NULL, NULL, 0);

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
(1, 'admin1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$YjFBeFE1SkJaa1pScDMxNQ$2ef4mk9Xz32gOvjNEAUMHKYWvZKcrKfGfVBSmIydQNE', '2023-05-15 17:29:12', '2023-06-23 08:32:49', 'fef15f5bfbc48e99a8ab', '2023-06-06 17:21:09'),
(3, 'krzychu1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$TTduOTV3ZzNZQjhpTjdSRg$t645NztZ3WK3AUsCnDEU3UpmuphJjg8NBMUAywS6xDI', '2023-05-24 00:03:01', '2023-06-19 14:17:05', NULL, NULL),
(4, 'kurw1@w.pl', '$argon2i$v=19$m=65536,t=4,p=1$bVQvWUFEaDRjejNMU1ExeQ$pv7h8gW1X0tZZClupi7KiZka+V0OLWWWdIo+vPQM5t4', '2023-05-24 00:27:42', NULL, NULL, NULL),
(7, 'test1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$YXJnZExsUDVKMUxkdlRmdw$pXTzJbJNc/kqGVz9T1Z2SQcxyV+R3zgx5kl5eW6+IPk', '2023-06-15 14:29:15', '2023-06-19 14:17:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(200) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `ilosc` smallint(6) NOT NULL,
  `rodzaj` varchar(50) NOT NULL,
  `opis` text NOT NULL,
  `zdjecie` varchar(255) DEFAULT NULL,
  `indeks_produktu` varchar(8) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `ilosc`, `rodzaj`, `opis`, `zdjecie`, `indeks_produktu`, `link`) VALUES
(1, 'koszulka', 32.22, 2, '1', 'Czarna męska koszulka z kolorowym napisem CROPP z przodu.\r\n\r\nuszyta w 100% z bawełny\r\nkrótkie rękawy\r\nregularny krój\r\nnadruk z efektem holo\r\n\r\n\r\nLPP, właściciel marki Cropp, jest partnerem inicjatywy Cotton made in Africa (CmiA), uznanego na całym świecie standardu zrównoważonej bawełny uprawianej przez drobnych, afrykańskich rolników. Pozyskujemy bawełnę zweryfikowaną przez CmiA, pomagając w ten sposób farmerom uzyskać dostęp do zrównoważonych metod produkcji. Bawełna zweryfikowana przez CmiA, której używamy w naszym łańcuchu dostaw, ma znacznie mniejszy wpływ na środowisko niż konwencjonalna bawełna. Inicjatywa wspiera społeczności wiejskie w Afryce.\r\n\r\nKliknij tutaj aby dowiedzieć się więcej o naszym partnerstwie z CmiA. \r\n\r\nWięcej na:\r\n\r\nwww.cottonmadeinafrica.org/en\r\n\r\nAn initiative of the Aid by Trade Foundation', 'zdjecia_produktow/2023-06-21-15-30-06.jpg', '952182t', 'http://localhost/forum/koszulka-952182t.php'),
(2, 'spodnie', 213.32, 10, '2', 'Długie', 'zdjecia_produktow/2023-06-21-15-29-58.jpg', '140337b', 'http://localhost/forum/spodnie-140337b.php'),
(3, 'kurtka', 99.23, 21, '3', 'czarna', 'zdjecia_produktow/2023-06-21-12-28-43.jpg', '72788p', 'http://localhost/forum/kurtka-72788p.php'),
(5, 'plecak', 140.00, 6, '4', 'Vans', 'zdjecia_produktow/2023-06-22-14-43-05.webp', '809535d', 'http://localhost/forum/plecak-809535d.php'),
(6, 'plecak', 109.99, 4, '4', 'Vans', 'zdjecia_produktow/2023-06-22-14-43-12.jpg', '294106j', 'http://localhost/forum/plecak-294106j.php');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaj_produktu`
--

CREATE TABLE `rodzaj_produktu` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `rodzaj_produktu`
--

INSERT INTO `rodzaj_produktu` (`id`, `nazwa`) VALUES
(0, 'czapka_z_daszkiem'),
(1, 'koszulkaM'),
(2, 'koszulkaZ'),
(3, 'spodnieM'),
(4, 'spodnieZ'),
(5, 'kurtkaM'),
(6, 'kurtkaZ'),
(7, 'plecak'),
(8, 'torebka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rozmiary_produktow`
--

CREATE TABLE `rozmiary_produktow` (
  `id` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `rozmiar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `rozmiary_produktow`
--

INSERT INTO `rozmiary_produktow` (`id`, `id_produktu`, `rozmiar`) VALUES
(1, 1, 'S'),
(2, 2, 'L'),
(3, 2, 'S'),
(4, 3, 'M'),
(5, 5, 'Uniwersalny'),
(6, 6, 'Uniwersalny'),
(7, 1, 'M');

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
-- Indeksy dla tabeli `rodzaj_produktu`
--
ALTER TABLE `rodzaj_produktu`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rozmiary_produktow`
--
ALTER TABLE `rozmiary_produktow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produktu` (`id_produktu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dane_konta`
--
ALTER TABLE `dane_konta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loginy`
--
ALTER TABLE `loginy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rozmiary_produktow`
--
ALTER TABLE `rozmiary_produktow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rozmiary_produktow`
--
ALTER TABLE `rozmiary_produktow`
  ADD CONSTRAINT `rozmiary_produktow_ibfk_1` FOREIGN KEY (`id_produktu`) REFERENCES `produkty` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
