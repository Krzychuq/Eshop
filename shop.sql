-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2023 at 11:24 PM
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
  `nazwa` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `data_urodzenia` date DEFAULT NULL,
  `nr_tel` varchar(20) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `miasto` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `kraj` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `opis_konta` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `dostep` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `dane_konta`
--

INSERT INTO `dane_konta` (`id`, `id_loginu`, `nazwa`, `avatar`, `data_urodzenia`, `nr_tel`, `miasto`, `kraj`, `opis_konta`, `dostep`) VALUES
(1, 1, 'Krzychu', 'avatary/2023-05-17-16-42-07.png', '2004-05-03', '885332400', 'Wieruszów', 'Polska', 'Założyciel', 1),
(4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(6, 7, 's', NULL, NULL, NULL, NULL, NULL, NULL, 0);

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
(1, 'admin1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$YjFBeFE1SkJaa1pScDMxNQ$2ef4mk9Xz32gOvjNEAUMHKYWvZKcrKfGfVBSmIydQNE', '2023-05-15 17:29:12', '2023-07-06 21:39:28', 'fef15f5bfbc48e99a8ab', '2023-06-06 17:21:09'),
(3, 'krzychu1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$TTduOTV3ZzNZQjhpTjdSRg$t645NztZ3WK3AUsCnDEU3UpmuphJjg8NBMUAywS6xDI', '2023-05-24 00:03:01', '2023-06-19 14:17:05', NULL, NULL),
(4, 'kurw1@w.pl', '$argon2i$v=19$m=65536,t=4,p=1$bVQvWUFEaDRjejNMU1ExeQ$pv7h8gW1X0tZZClupi7KiZka+V0OLWWWdIo+vPQM5t4', '2023-05-24 00:27:42', NULL, NULL, NULL),
(7, 'test1@g.pl', '$argon2i$v=19$m=65536,t=4,p=1$YXJnZExsUDVKMUxkdlRmdw$pXTzJbJNc/kqGVz9T1Z2SQcxyV+R3zgx5kl5eW6+IPk', '2023-06-15 14:29:15', '2023-06-19 14:17:19', NULL, NULL);

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
  `zdjecie` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `indeks_produktu` varchar(8) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `ilosc`, `rodzaj`, `opis`, `zdjecie`, `indeks_produktu`, `link`) VALUES
(52, 'kurtka kamuflage', '109.99', 9, '5', 'Plecak Nike Sportswear RPM jest stworzony do przechowywania wszystkiego, czego tylko potrzebujesz. Plecak jest idealny na wypady dzięki wyściełanemu tyłowi dla wygody i uniwersalnemu systemowi pasków.', 'zdjecia_produktow/2023-07-04-09-11-14.jpg', '757012d', 'http://localhost/forum/produkty/kurtka-kamuflage-757012d.php'),
(54, 'czarne spodnie', '300.99', 35, '4', 'LPP, właściciel marki House, jest partnerem inicjatywy Cotton made in Africa (CmiA), uznanego na całym świecie standardu zrównoważonej bawełny uprawianej przez drobnych, afrykańskich rolników. Pozyskujemy bawełnę zweryfikowaną przez CmiA, pomagając w ten sposób farmerom uzyskać dostęp do zrównoważonych metod produkcji. Bawełna zweryfikowana przez CmiA, której używamy w naszym łańcuchu dostaw, ma znacznie mniejszy wpływ na środowisko niż konwencjonalna bawełna. Inicjatywa wspiera społeczności wiejskie w Afryce.', 'zdjecia_produktow/2023-07-06-13-34-30.jpg', '966862i', 'http://localhost/forum/produkty/czarne-spodnie-966862i.php'),
(55, 'plecak vans', '154.99', 5, '7', 'Plecak Vans Old Skool Check ma dużą komorę główną, łatwo dostępną kieszeń z przegródkami zapinaną na suwak z przodu oraz kieszeń na butelkę z wodą. Wyściełane paski naramienne o prostym kroju zapewniają dodatkową wygodę. Całości dopełnia logo Vans z przodu oraz nadruk w kratę na całej powierzchni. Wymiary: 41,9 cm dł. x 32,4 cm szer. x 12,1 cm głęb. Pojemność: 22 litry.', 'zdjecia_produktow/2023-07-06-23-01-15.jpg', '98554t', 'http://localhost/forum/produkty/plecak-vans-98554t.php');

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
(8, 'torebka');

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
(37, 52, 'M', 4),
(38, 52, 'S', 5),
(41, 54, 'S', 6),
(42, 54, 'M', 6),
(43, 54, 'L', 6),
(44, 54, 'XL', 6),
(45, 54, 'XXL', 6),
(47, 54, 'XS', 5),
(48, 55, 'Uniwersalny', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dane_konta`
--
ALTER TABLE `dane_konta`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
