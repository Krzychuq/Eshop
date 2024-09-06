-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Wrz 06, 2024 at 02:48 PM
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
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane_do_faktury`
--

CREATE TABLE `dane_do_faktury` (
  `id` int(11) NOT NULL,
  `id_konta` int(11) NOT NULL,
  `NIP` char(10) NOT NULL,
  `nazwa_firmy` varchar(150) NOT NULL,
  `adres` varchar(150) NOT NULL,
  `kod_pocztowy` char(6) NOT NULL,
  `miasto` varchar(80) NOT NULL,
  `kraj` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_do_faktury`
--

INSERT INTO `dane_do_faktury` (`id`, `id_konta`, `NIP`, `nazwa_firmy`, `adres`, `kod_pocztowy`, `miasto`, `kraj`) VALUES
(1, 1, '9999999999', 'golesp', 'ul. marginowa 32/3b', '22-323', 'Wrocław', 'Polska');

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
  `nr_domu` smallint(6) DEFAULT NULL,
  `nr_mieszkania` smallint(6) DEFAULT NULL,
  `nr_tel` varchar(20) DEFAULT NULL,
  `miasto` varchar(100) DEFAULT NULL,
  `kod_pocztowy` char(6) DEFAULT NULL,
  `kraj` varchar(100) DEFAULT NULL,
  `dostep` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_konta`
--

INSERT INTO `dane_konta` (`id`, `id_loginu`, `imie`, `nazwisko`, `ulica`, `nr_domu`, `nr_mieszkania`, `nr_tel`, `miasto`, `kod_pocztowy`, `kraj`, `dostep`) VALUES
(1, 1, 'jan', 'Kowalski', 'poważna', 42, 2, '111111646', 'Bydgoszcz', '333333', 'Belgia', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `firmy_kurierskie`
--

CREATE TABLE `firmy_kurierskie` (
  `id` tinyint(6) NOT NULL,
  `nazwa_firmy` varchar(70) NOT NULL,
  `cena` float NOT NULL,
  `sredni_czas_wysylki` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `firmy_kurierskie`
--

INSERT INTO `firmy_kurierskie` (`id`, `nazwa_firmy`, `cena`, `sredni_czas_wysylki`) VALUES
(1, 'DHL', 13.99, '1-3'),
(2, 'Poczta Polska', 10.99, '2-4'),
(3, 'Inpost paczkomat', 9.99, '1-3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kody rabatowe`
--

CREATE TABLE `kody rabatowe` (
  `id` smallint(6) NOT NULL,
  `kod` varchar(30) NOT NULL,
  `kod_val` tinyint(4) NOT NULL,
  `opis` text NOT NULL,
  `data_ważności` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kody rabatowe`
--

INSERT INTO `kody rabatowe` (`id`, `kod`, `kod_val`, `opis`, `data_ważności`) VALUES
(1, '-10procent', 10, 'Zniżka 10% na wszystkie produkty', '2024-02-16 00:00:00');

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
(1, 'admin1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$YjFBeFE1SkJaa1pScDMxNQ$2ef4mk9Xz32gOvjNEAUMHKYWvZKcrKfGfVBSmIydQNE', '2023-05-15 17:29:12', '2024-09-05 14:46:46', 'fef15f5bfbc48e99a8ab', '2023-06-06 17:21:09');

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
  `zdjecie` varchar(250) DEFAULT NULL,
  `indeks_produktu` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `ilosc`, `rodzaj`, `opis`, `zdjecie`, `indeks_produktu`) VALUES
(52, 'Product1', 3213.00, 18, '5', 'Plecak Nike Sportswear RPM jest stworzony do przechowywania wszystkiego, czego tylko potrzebujesz. Plecak jest idealny na wypady dzięki wyściełanemu tyłowi dla wygody i uniwersalnemu systemowi pasków.', '2024-06-03-23-37-19-0.jpg', '757012d'),
(54, 'Product2', 300.99, 23, '4', 'LPP, właściciel marki House, jest partnerem inicjatywy Cotton made in Africa (CmiA), uznanego na całym świecie standardu zrównoważonej bawełny uprawianej przez drobnych, afrykańskich rolników. Pozyskujemy bawełnę zweryfikowaną przez CmiA, pomagając w ten sposób farmerom uzyskać dostęp do zrównoważonych metod produkcji. Bawełna zweryfikowana przez CmiA, której używamy w naszym łańcuchu dostaw, ma znacznie mniejszy wpływ na środowisko niż konwencjonalna bawełna. Inicjatywa wspiera społeczności wiejskie w Afryce.', '2024-06-03-23-38-39-0.jpg', '966862i'),
(55, 'Product3', 154.99, 5, '7', 'Plecak Vans Old Skool Check ma dużą komorę główną, łatwo dostępną kieszeń z przegródkami zapinaną na suwak z przodu oraz kieszeń na butelkę z wodą. Wyściełane paski naramienne o prostym kroju zapewniają dodatkową wygodę. Całości dopełnia logo Vans z przodu oraz nadruk w kratę na całej powierzchni. Wymiary: 41,9 cm dł. x 32,4 cm szer. x 12,1 cm głęb. Pojemność: 22 litry.', '2024-06-03-23-45-08-0.jpg', '98554t'),
(57, 'Product4', 180.00, 13, '7', 'Czarny męski plecak o prostej, klasycznej formie. Idealny na co dzień: do szkoły, na uczelnię, do pracy.\r\n\r\ngłówna komora oraz zewnętrzna kieszeń zapinane na suwaki\r\ndługie szelki z możliwością regulacji\r\nwewnętrzna kieszeń na laptopa\r\nniewielka naszywka z przodu', '2024-06-03-23-40-49-0.png', '996025d'),
(58, 'Product5', 70.00, 25, '2', 'KOSZULKA OVERSIZE STRONG POINT   \r\n\r\nMamy dla Was koszulkę idealną. Luźny, najmodniejszy krój, perfekcyjna długość, przewiewna bawełna, genialna dzianina. Będziecie zachwycone!  \r\n\r\nDelikatne, wyszywane logo w kolorze produktu sprawia, że koszulkę możecie nosić do niemal każdej stylizacji', '2024-06-03-23-43-43-0.jpg', '327894f'),
(62, 'Product6', 890.00, 14, '10', 'cfy', '2024-06-03-23-44-26-0.jpg', '513819u'),
(63, 'Product7', 234.00, 22, '11', 'Ładna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreomŁadna lorem lreom', '2024-06-03-23-40-33-0.png', '272335o');

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
(2, 'koszulkaW'),
(3, 'spodnieM'),
(4, 'spodnieW'),
(5, 'kurtkaM'),
(6, 'kurtkaW'),
(7, 'plecak'),
(8, 'torebka'),
(9, 'bluzaM'),
(10, 'bluzaW'),
(11, 'koszulaM'),
(12, 'koszulaW');

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
(37, 52, 'M', 7),
(45, 54, 'XXL', 6),
(48, 55, 'Uniwersalny', 5),
(49, 54, 'M', 4),
(50, 52, 'L', 8),
(51, 54, 'XS', 2),
(52, 54, 'S', 4),
(53, 54, 'L', 2),
(54, 54, 'XL', 5),
(56, 57, 'Uniwersalny', 13),
(58, 58, 'S', 4),
(59, 58, 'M', 7),
(60, 58, 'L', 2),
(61, 58, 'XL', 5),
(62, 58, 'XXL', 4),
(69, 62, 'XS', 6),
(70, 62, 'S', 1),
(71, 62, 'M', 1),
(72, 62, 'L', 2),
(73, 62, 'XL', 2),
(74, 62, 'XXL', 2),
(75, 63, 'XS', 3),
(76, 63, 'S', 5),
(77, 63, 'M', 7),
(78, 63, 'L', 2),
(79, 63, 'XL', 3),
(80, 63, 'XXL', 2),
(81, 52, 'S', 3),
(82, 58, 'XS', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status_zamowienia`
--

CREATE TABLE `status_zamowienia` (
  `id` tinyint(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_zamowienia`
--

INSERT INTO `status_zamowienia` (`id`, `nazwa`) VALUES
(1, 'Do realizacji'),
(2, 'W trakcie realizacji'),
(3, 'Wysłane'),
(4, 'Zrealizowane'),
(5, 'Anulowane'),
(6, 'Archiwum');

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
-- Dumping data for table `wiadomosci_klientow`
--

INSERT INTO `wiadomosci_klientow` (`id`, `imie`, `nazwisko`, `email`, `nr_zamowienia`, `wiadomosc`) VALUES
(7, 'Krzychu', 'Grecki', 'costam@o2.pl', 3214914, 'After creating the product gallery page, we need to work on the PHP code to perform the cart actions. They are add-to-cart, remove a single item from the cart, clear the complete cart and similar.\r\n\r\nIn the above code, I have added the HTML option to add the product to the shopping cart from the product gallery. When the user clicks the ‘Add to Cart’ button, the HTML form passes the product id to the backend PHP script.\r\n\r\nIn PHP, I receive and process the cart action with a switch control statement. I have created PHP switch cases to handle the add-to-cart, remove-single, empty-cart actions.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `nr_zamowienia` int(11) NOT NULL,
  `id_konta` int(11) NOT NULL,
  `produkty_zamowione` varchar(200) NOT NULL,
  `ilosc_produktow` varchar(200) NOT NULL,
  `koszt_calkowity` decimal(10,2) NOT NULL,
  `kurier` tinyint(11) NOT NULL,
  `data` datetime NOT NULL,
  `status` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dane_do_faktury`
--
ALTER TABLE `dane_do_faktury`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `dane_konta`
--
ALTER TABLE `dane_konta`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `firmy_kurierskie`
--
ALTER TABLE `firmy_kurierskie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kody rabatowe`
--
ALTER TABLE `kody rabatowe`
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
-- Indeksy dla tabeli `status_zamowienia`
--
ALTER TABLE `status_zamowienia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wiadomosci_klientow`
--
ALTER TABLE `wiadomosci_klientow`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`nr_zamowienia`),
  ADD KEY `dane_konta` (`id_konta`),
  ADD KEY `status` (`status`),
  ADD KEY `kurier` (`kurier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dane_do_faktury`
--
ALTER TABLE `dane_do_faktury`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dane_konta`
--
ALTER TABLE `dane_konta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `firmy_kurierskie`
--
ALTER TABLE `firmy_kurierskie`
  MODIFY `id` tinyint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kody rabatowe`
--
ALTER TABLE `kody rabatowe`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loginy`
--
ALTER TABLE `loginy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `rozmiary_produktow`
--
ALTER TABLE `rozmiary_produktow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `wiadomosci_klientow`
--
ALTER TABLE `wiadomosci_klientow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `nr_zamowienia` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rozmiary_produktow`
--
ALTER TABLE `rozmiary_produktow`
  ADD CONSTRAINT `rozmiary_produktow_ibfk_1` FOREIGN KEY (`id_produktu`) REFERENCES `produkty` (`id`);

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `dane_konta` FOREIGN KEY (`id_konta`) REFERENCES `dane_konta` (`id`),
  ADD CONSTRAINT `kurier` FOREIGN KEY (`kurier`) REFERENCES `firmy_kurierskie` (`id`),
  ADD CONSTRAINT `status` FOREIGN KEY (`status`) REFERENCES `status_zamowienia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
