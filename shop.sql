-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lip 12, 2023 at 02:19 PM
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
  `imie` varchar(60) DEFAULT NULL,
  `nazwisko` varchar(80) NOT NULL,
  `ulica` varchar(255) DEFAULT NULL,
  `nr_tel` varchar(20) DEFAULT NULL,
  `miasto` varchar(100) DEFAULT NULL,
  `kod_pocztowy` varchar(6) DEFAULT NULL,
  `kraj` varchar(100) DEFAULT NULL,
  `dostep` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_konta`
--

INSERT INTO `dane_konta` (`id`, `id_loginu`, `imie`, `nazwisko`, `ulica`, `nr_tel`, `miasto`, `kod_pocztowy`, `kraj`, `dostep`) VALUES
(1, 1, 'Krzychu', 'Grecki', 'Warszawska 3', '885332400', 'Wieruszów', '98-400', 'Polska', 1);

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
(1, 'admin1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$YjFBeFE1SkJaa1pScDMxNQ$2ef4mk9Xz32gOvjNEAUMHKYWvZKcrKfGfVBSmIydQNE', '2023-05-15 17:29:12', '2023-07-11 09:24:26', 'fef15f5bfbc48e99a8ab', '2023-06-06 17:21:09');

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
  `zdjecie1` varchar(200) DEFAULT NULL,
  `zdjecie2` varchar(200) DEFAULT NULL,
  `zdjecie3` varchar(200) DEFAULT NULL,
  `zdjecie4` varchar(200) DEFAULT NULL,
  `indeks_produktu` varchar(8) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `ilosc`, `rodzaj`, `opis`, `zdjecie1`, `zdjecie2`, `zdjecie3`, `zdjecie4`, `indeks_produktu`, `link`) VALUES
(52, 'kurtka kamuflage', 250.00, 12, '5', 'Plecak Nike Sportswear RPM jest stworzony do przechowywania wszystkiego, czego tylko potrzebujesz. Plecak jest idealny na wypady dzięki wyściełanemu tyłowi dla wygody i uniwersalnemu systemowi pasków.', 'zdjecia_produktow/2023-07-04-09-11-14.jpg', NULL, NULL, NULL, '757012d', 'http://localhost/forum/produkty/kurtka-kamuflage-757012d.php'),
(54, 'czarne spodnie', 300.99, 23, '4', 'LPP, właściciel marki House, jest partnerem inicjatywy Cotton made in Africa (CmiA), uznanego na całym świecie standardu zrównoważonej bawełny uprawianej przez drobnych, afrykańskich rolników. Pozyskujemy bawełnę zweryfikowaną przez CmiA, pomagając w ten sposób farmerom uzyskać dostęp do zrównoważonych metod produkcji. Bawełna zweryfikowana przez CmiA, której używamy w naszym łańcuchu dostaw, ma znacznie mniejszy wpływ na środowisko niż konwencjonalna bawełna. Inicjatywa wspiera społeczności wiejskie w Afryce.', 'zdjecia_produktow/2023-07-06-13-34-30.jpg', NULL, NULL, NULL, '966862i', 'http://localhost/forum/produkty/czarne-spodnie-966862i.php'),
(55, 'plecak vans', 154.99, 5, '7', 'Plecak Vans Old Skool Check ma dużą komorę główną, łatwo dostępną kieszeń z przegródkami zapinaną na suwak z przodu oraz kieszeń na butelkę z wodą. Wyściełane paski naramienne o prostym kroju zapewniają dodatkową wygodę. Całości dopełnia logo Vans z przodu oraz nadruk w kratę na całej powierzchni. Wymiary: 41,9 cm dł. x 32,4 cm szer. x 12,1 cm głęb. Pojemność: 22 litry.', 'zdjecia_produktow/2023-07-06-23-01-15.jpg', NULL, NULL, NULL, '98554t', 'http://localhost/forum/produkty/plecak-vans-98554t.php');

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
  `rozmiar` varchar(20) NOT NULL,
  `ilosc` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `rozmiary_produktow`
--

INSERT INTO `rozmiary_produktow` (`id`, `id_produktu`, `rozmiar`, `ilosc`) VALUES
(37, 52, 'M', 8),
(45, 54, 'XXL', 6),
(48, 55, 'Uniwersalny', 5),
(49, 54, 'M', 4),
(50, 52, 'L', 4),
(51, 54, 'XS', 2),
(52, 54, 'S', 4),
(53, 54, 'L', 2),
(54, 54, 'XL', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wiadomosci_klientow`
--

CREATE TABLE `wiadomosci_klientow` (
  `id` int(11) NOT NULL,
  `imie` varchar(100) NOT NULL,
  `nazwisko` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `nr_zamowienia` int(11) NOT NULL,
  `wiadomosc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indeksy dla tabeli `wiadomosci_klientow`
--
ALTER TABLE `wiadomosci_klientow`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `rozmiary_produktow`
--
ALTER TABLE `rozmiary_produktow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `wiadomosci_klientow`
--
ALTER TABLE `wiadomosci_klientow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
