-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 09:00 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `is_projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnika` int(11) NOT NULL,
  `ime` varchar(50) DEFAULT NULL,
  `prezime` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `broj_telefona` varchar(20) DEFAULT NULL,
  `adresa` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnika`, `ime`, `prezime`, `username`, `password`, `email`, `broj_telefona`, `adresa`) VALUES
(2, 'Pera', 'Peric', 'pera123', 'pera123', 'pera@gmail.com', '06283217953', 'Vojvode Stepe 243'),
(3, 'Marko', 'Markovic', 'marko1', 'marko1', 'marko@gmail.com', '0623217564', 'Vojvode Stepe 240'),
(4, 'Andrej', 'Pavic', 'paja2', 'paja2', 'paja@gmail.com', '06487798424', 'Vojvode Stepe 241'),
(5, 'Nikola', 'Nikolic', 'nikola123', 'nikola123', 'nikola@gmail.com', '0623217564', 'Vojvode Stepe 245'),
(7, 'Petar', 'Petrovic', 'petar123', 'loyinka321', 'petarpetrovic@gmail.com', '0643821058', 'Vojvode Stepe 250');

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `id_proizvoda` int(11) NOT NULL,
  `naziv` varchar(100) DEFAULT NULL,
  `kategorija` varchar(50) DEFAULT NULL,
  `cena` decimal(10,2) DEFAULT NULL,
  `kolicina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`id_proizvoda`, `naziv`, `kategorija`, `cena`, `kolicina`) VALUES
(1, 'Nike majica za trening', 'odeca', '5990.00', 29),
(4, 'Adidas majica za trening', 'odeca', '5990.00', 35),
(7, 'Nike patike za trening', 'obuca', '10000.00', 51);

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `id_racuna` int(11) NOT NULL,
  `id_korisnika` int(11) DEFAULT NULL,
  `datum` timestamp NULL DEFAULT NULL,
  `ukupna_cena` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`id_racuna`, `id_korisnika`, `datum`, `ukupna_cena`) VALUES
(1, 3, '2023-05-20 14:36:00', '0.00'),
(2, 3, '2023-05-20 14:36:15', '0.00'),
(3, 3, '2023-05-20 14:47:16', '5990.00'),
(4, 3, NULL, NULL),
(7, 3, '2023-05-24 22:00:00', '5990.00'),
(8, 3, '2023-05-24 22:00:00', '11980.00'),
(9, 3, '2023-05-24 22:00:00', '0.00'),
(10, 3, '2023-05-24 22:00:00', '0.00'),
(11, 3, '2023-05-24 22:00:00', '0.00'),
(12, 3, '2023-05-25 15:43:17', '0.00'),
(13, 3, '2023-05-25 15:58:41', '11980.00'),
(14, 3, '2023-05-26 11:43:55', '11980.00'),
(15, 3, '2023-05-26 11:44:27', '5990.00'),
(16, 3, '2023-05-26 11:47:33', '5990.00'),
(17, 3, '2023-05-26 11:47:36', '0.00'),
(18, 3, '2023-05-26 11:47:41', '5990.00'),
(19, 3, '2023-05-26 11:51:31', '21980.00'),
(20, 3, '2023-05-26 11:54:43', '0.00'),
(21, 3, '2023-05-26 11:54:46', '0.00'),
(22, 3, '2023-05-26 11:54:50', '0.00'),
(23, 3, '2023-05-26 11:54:59', '0.00'),
(24, 3, '2023-05-26 11:55:23', '11980.00'),
(25, 3, '2023-05-26 11:55:31', '11980.00'),
(26, 3, '2023-05-26 11:55:58', '11980.00'),
(27, 3, '2023-05-26 12:35:18', '11980.00'),
(28, 3, '2023-05-26 22:00:00', '41930.00'),
(29, 3, '2023-05-26 22:00:00', '10000.00'),
(30, 3, '2023-05-26 22:00:00', '10000.00'),
(31, 3, '2023-05-26 22:00:00', '5990.00'),
(32, 3, '2023-05-27 17:43:47', '0.00'),
(33, 3, '2023-05-26 22:00:00', '5990.00'),
(34, 3, '2023-05-26 22:00:00', '11980.00'),
(35, 3, '2023-05-26 22:00:00', '15990.00'),
(36, 3, '2023-05-27 22:00:00', '5990.00'),
(37, 3, '2023-05-27 22:00:00', '20000.00'),
(38, 3, '2023-05-27 22:00:00', '10000.00'),
(39, 3, '2023-05-27 22:00:00', '11980.00'),
(40, 3, '2023-05-27 22:00:00', '5990.00'),
(41, 3, '2023-05-27 22:00:00', '5990.00'),
(42, 3, '2023-05-27 22:00:00', '0.00'),
(43, 3, '2023-05-27 22:00:00', '0.00'),
(44, 3, '2023-05-27 22:00:00', '10000.00'),
(45, 3, '2023-05-27 22:00:00', '10000.00'),
(46, 3, '2023-05-27 22:00:00', '21980.00');

-- --------------------------------------------------------

--
-- Table structure for table `racun_proizvod`
--

CREATE TABLE `racun_proizvod` (
  `id_proizvoda` int(11) DEFAULT NULL,
  `id_racuna` int(11) DEFAULT NULL,
  `ukupna_kolicina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `racun_proizvod`
--

INSERT INTO `racun_proizvod` (`id_proizvoda`, `id_racuna`, `ukupna_kolicina`) VALUES
(1, 1, 1),
(1, 1, 1),
(1, 2, 1),
(1, 2, 1),
(1, 3, 1),
(4, 4, 2),
(4, 4, 2),
(4, 4, 2),
(4, 4, 1),
(4, 4, 1),
(4, 7, 1),
(4, 8, 2),
(4, 9, 1),
(4, 10, 2),
(7, 10, 3),
(4, 11, 2),
(7, 11, 1),
(4, 12, 3),
(7, 12, 2),
(4, 13, 2),
(4, 14, 2),
(4, 15, 1),
(4, 16, 1),
(4, 18, 1),
(4, 19, 2),
(7, 19, 1),
(4, 24, 2),
(4, 25, 2),
(4, 26, 2),
(4, 27, 2),
(4, 28, 3),
(4, 28, 1),
(4, 28, 1),
(4, 28, 2),
(7, 29, 1),
(7, 30, 1),
(4, 31, 1),
(4, 33, 1),
(4, 34, 1),
(1, 34, 1),
(7, 35, 1),
(4, 35, 1),
(1, 36, 1),
(7, 37, 1),
(7, 37, 1),
(7, 38, 1),
(4, 39, 2),
(4, 40, 1),
(1, 41, 1),
(7, 44, 1),
(7, 45, 1),
(7, 46, 1),
(4, 46, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnika`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`id_proizvoda`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`id_racuna`),
  ADD KEY `id_korisnika` (`id_korisnika`);

--
-- Indexes for table `racun_proizvod`
--
ALTER TABLE `racun_proizvod`
  ADD KEY `id_proizvoda` (`id_proizvoda`),
  ADD KEY `id_racuna` (`id_racuna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `id_proizvoda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `id_racuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `racun_ibfk_1` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`id_korisnika`);

--
-- Constraints for table `racun_proizvod`
--
ALTER TABLE `racun_proizvod`
  ADD CONSTRAINT `racun_proizvod_ibfk_1` FOREIGN KEY (`id_proizvoda`) REFERENCES `proizvod` (`id_proizvoda`),
  ADD CONSTRAINT `racun_proizvod_ibfk_2` FOREIGN KEY (`id_racuna`) REFERENCES `racun` (`id_racuna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
