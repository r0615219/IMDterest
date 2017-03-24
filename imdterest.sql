-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 mrt 2017 om 17:39
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imdterest`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `username`, `password`) VALUES
(3, '123@test.be', 'Name', 'Hi', '$2y$12$ZnyoBlC5EZNBaUGN33MOs.zBXuvRxEDslqRuuzucwm9ldlBPNgEae'),
(4, '456@mail.be', 'John Smith', 'jsmith', '$2y$12$V97o6.6iqQLTF4/ywpDhDeCsiClku4yg8rfrlB2JA3hNKKbSRDSmu'),
(5, 'simon.vanherzele@gmail.com', 'Simon Van Herzele', 'DonSimon', '$2y$12$XanG5JbTwmCzCOHECaUENuYdjdvA7shAbT8XMpQuwY7RdGCbhAg7i'),
(6, 'test@test.be', 'Test', 'Test123', '$2y$12$bh4VVEohScZlgWVKd9Kgb.3muwx858dv6lAqd5qh5rgZyCjGkOypm'),
(7, 'Persoon@test.com', 'Mens De Persoon', 'Mens', '$2y$12$okGCwaKfe5gLgdpaVkcnNewPsXnBFVMs41MFqprFg3FUXf8jrKamS'),
(8, 'fFrank@gmail.tank', 'Frank De Tank', 'Tank', '$2y$12$wjjMC.Nz4Y42ycOKrA0MFOvODzJfAM56S8xFVpWDGbEG1CXEBdaDa');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
