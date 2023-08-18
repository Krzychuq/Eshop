-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2023 at 02:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
-- Table structure for table `dane_konta`
--

CREATE TABLE `dane_konta` (
  `id` int(11) NOT NULL,
  `id_loginu` int(11) NOT NULL,
  `imie` varchar(60) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `nazwisko` varchar(80) COLLATE utf8mb4_polish_ci NOT NULL,
  `ulica` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `nr_tel` varchar(20) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `miasto` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `kod_pocztowy` varchar(6) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `kraj` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `dostep` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_konta`
--

INSERT INTO `dane_konta` (`id`, `id_loginu`, `imie`, `nazwisko`, `ulica`, `nr_tel`, `miasto`, `kod_pocztowy`, `kraj`, `dostep`) VALUES
(1, 1, 'Krzychu', 'Grecki', 'Warszawska 3', '885332400', 'Wieruszów', '98-400', 'Polska', 1);

-- --------------------------------------------------------

--
-- Table structure for table `firmy_kurierskie`
--

CREATE TABLE `firmy_kurierskie` (
  `id` smallint(6) NOT NULL,
  `nazwa_firmy` varchar(70) NOT NULL,
  `cena` smallint(6) NOT NULL,
  `sredni_czas_wysylki` varchar(5) NOT NULL,
  `logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loginy`
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
-- Dumping data for table `loginy`
--

INSERT INTO `loginy` (`id`, `login`, `pass`, `data_rejestru`, `ostatnie_logowanie`, `token_hasla`, `data_zmiany_hasla`) VALUES
(1, 'admin1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$YjFBeFE1SkJaa1pScDMxNQ$2ef4mk9Xz32gOvjNEAUMHKYWvZKcrKfGfVBSmIydQNE', '2023-05-15 17:29:12', '2023-08-18 08:45:56', 'fef15f5bfbc48e99a8ab', '2023-06-06 17:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(200) COLLATE utf8mb4_polish_ci NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `ilosc` smallint(6) NOT NULL,
  `rodzaj` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `opis` text COLLATE utf8mb4_polish_ci NOT NULL,
  `zdjecie1` varchar(200) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `zdjecie2` varchar(200) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `zdjecie3` varchar(200) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `zdjecie4` varchar(200) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `indeks_produktu` varchar(8) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `ilosc`, `rodzaj`, `opis`, `zdjecie1`, `zdjecie2`, `zdjecie3`, `zdjecie4`, `indeks_produktu`, `link`) VALUES
(52, 'kurtka kamuflage', '250.00', 12, '5', 'Plecak Nike Sportswear RPM jest stworzony do przechowywania wszystkiego, czego tylko potrzebujesz. Plecak jest idealny na wypady dzięki wyściełanemu tyłowi dla wygody i uniwersalnemu systemowi pasków.', 'zdjecia_produktow/2023-07-04-09-11-14.jpg', NULL, NULL, NULL, '757012d', 'http://localhost/forum/produkty/kurtka-kamuflage-757012d.php'),
(54, 'czarne spodnie', '300.99', 23, '4', 'LPP, właściciel marki House, jest partnerem inicjatywy Cotton made in Africa (CmiA), uznanego na całym świecie standardu zrównoważonej bawełny uprawianej przez drobnych, afrykańskich rolników. Pozyskujemy bawełnę zweryfikowaną przez CmiA, pomagając w ten sposób farmerom uzyskać dostęp do zrównoważonych metod produkcji. Bawełna zweryfikowana przez CmiA, której używamy w naszym łańcuchu dostaw, ma znacznie mniejszy wpływ na środowisko niż konwencjonalna bawełna. Inicjatywa wspiera społeczności wiejskie w Afryce.', 'zdjecia_produktow/2023-07-06-13-34-30.jpg', NULL, NULL, NULL, '966862i', 'http://localhost/forum/produkty/czarne-spodnie-966862i.php'),
(55, 'plecak vans', '154.99', 5, '7', 'Plecak Vans Old Skool Check ma dużą komorę główną, łatwo dostępną kieszeń z przegródkami zapinaną na suwak z przodu oraz kieszeń na butelkę z wodą. Wyściełane paski naramienne o prostym kroju zapewniają dodatkową wygodę. Całości dopełnia logo Vans z przodu oraz nadruk w kratę na całej powierzchni. Wymiary: 41,9 cm dł. x 32,4 cm szer. x 12,1 cm głęb. Pojemność: 22 litry.', 'zdjecia_produktow/2023-07-06-23-01-15.jpg', NULL, NULL, NULL, '98554t', 'http://localhost/forum/produkty/plecak-vans-98554t.php'),
(57, 'czarny plecak', '180.00', 13, '7', 'Czarny męski plecak o prostej, klasycznej formie. Idealny na co dzień: do szkoły, na uczelnię, do pracy.\r\n\r\ngłówna komora oraz zewnętrzna kieszeń zapinane na suwaki\r\ndługie szelki z możliwością regulacji\r\nwewnętrzna kieszeń na laptopa\r\nniewielka naszywka z przodu', 'zdjecia_produktow/2023-07-13-07-57-47.jpg', NULL, NULL, NULL, '996025d', 'http://localhost/forum/produkty/czarny-plecak-996025d.php'),
(58, 'koszulka', '70.00', 25, '2', 'KOSZULKA OVERSIZE STRONG POINT   \r\n\r\nMamy dla Was koszulkę idealną. Luźny, najmodniejszy krój, perfekcyjna długość, przewiewna bawełna, genialna dzianina. Będziecie zachwycone!  \r\n\r\nDelikatne, wyszywane logo w kolorze produktu sprawia, że koszulkę możecie nosić do niemal każdej stylizacji', 'zdjecia_produktow/2023-07-13-09-12-21-1.jpg', 'zdjecia_produktow/2023-07-13-09-12-21-2.jpg', 'zdjecia_produktow/2023-07-13-09-12-21-3.jpg', 'zdjecia_produktow/2023-07-13-09-12-21-4.jpg', '327894f', 'http://localhost/forum/produkty/koszulka-327894f.php'),
(62, 'bluza', '890.00', 14, '10', 'cfy', 'zdjecia_produktow/2023-07-13-13-57-31-1.jpg', NULL, NULL, NULL, '513819u', 'http://localhost/forum/produkty/bluza-513819u.php');

-- --------------------------------------------------------

--
-- Table structure for table `rodzaj_produktu`
--

CREATE TABLE `rodzaj_produktu` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL
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
(8, 'torebka'),
(9, 'bluzaM'),
(10, 'bluzaZ');

-- --------------------------------------------------------

--
-- Table structure for table `rozmiary_produktow`
--

CREATE TABLE `rozmiary_produktow` (
  `id` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `rozmiar` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
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
(54, 54, 'XL', 5),
(56, 57, 'Uniwersalny', 13),
(57, 58, 'XS', 3),
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
(74, 62, 'XXL', 2);

-- --------------------------------------------------------

--
-- Table structure for table `wiadomosci_klientow`
--

CREATE TABLE `wiadomosci_klientow` (
  `id` int(11) NOT NULL,
  `imie` varchar(100) NOT NULL,
  `nazwisko` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `nr_zamowienia` int(11) NOT NULL,
  `wiadomosc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wiadomosci_klientow`
--

INSERT INTO `wiadomosci_klientow` (`id`, `imie`, `nazwisko`, `email`, `nr_zamowienia`, `wiadomosc`) VALUES
(7, 'Krzychu', 'Grecki', 'costam@o2.pl', 3214914, 'After creating the product gallery page, we need to work on the PHP code to perform the cart actions. They are add-to-cart, remove a single item from the cart, clear the complete cart and similar.\r\n\r\nIn the above code, I have added the HTML option to add the product to the shopping cart from the product gallery. When the user clicks the ‘Add to Cart’ button, the HTML form passes the product id to the backend PHP script.\r\n\r\nIn PHP, I receive and process the cart action with a switch control statement. I have created PHP switch cases to handle the add-to-cart, remove-single, empty-cart actions.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dane_konta`
--
ALTER TABLE `dane_konta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firmy_kurierskie`
--
ALTER TABLE `firmy_kurierskie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginy`
--
ALTER TABLE `loginy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rodzaj_produktu`
--
ALTER TABLE `rodzaj_produktu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rozmiary_produktow`
--
ALTER TABLE `rozmiary_produktow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produktu` (`id_produktu`);

--
-- Indexes for table `wiadomosci_klientow`
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
-- AUTO_INCREMENT for table `firmy_kurierskie`
--
ALTER TABLE `firmy_kurierskie`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loginy`
--
ALTER TABLE `loginy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `rozmiary_produktow`
--
ALTER TABLE `rozmiary_produktow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `wiadomosci_klientow`
--
ALTER TABLE `wiadomosci_klientow`
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
