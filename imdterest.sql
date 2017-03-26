-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 mrt 2017 om 11:49
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 7.1.1

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
-- Tabelstructuur voor tabel `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `topics`
--

INSERT INTO `topics` (`id`, `name`, `image`) VALUES
(1, 'webdesign', 'https://tinyurl.com/n7fdy2z'),
(2, 'webdevelopment', 'https://tinyurl.com/mzugpq6'),
(3, 'animation', 'https://tinyurl.com/l889bsq'),
(4, 'ux design', 'https://tinyurl.com/n3su56g'),
(5, 'ui design', 'https://tinyurl.com/n8h393g'),
(6, '3D modeling', 'https://tinyurl.com/p93lljs'),
(7, 'art', 'https://tinyurl.com/my2l3ux');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `username`, `password`, `image`) VALUES
(3, '123@test.be', 'Name', 'Hi', '$2y$12$ZnyoBlC5EZNBaUGN33MOs.zBXuvRxEDslqRuuzucwm9ldlBPNgEae', ''),
(4, '456@mail.be', 'John Smith', 'jsmith', '$2y$12$V97o6.6iqQLTF4/ywpDhDeCsiClku4yg8rfrlB2JA3hNKKbSRDSmu', ''),
(5, 'simon.vanherzele@gmail.com', 'Simon Van Herzele', 'DonSimon', '$2y$12$XanG5JbTwmCzCOHECaUENuYdjdvA7shAbT8XMpQuwY7RdGCbhAg7i', ''),
(6, 'test@test.be', 'Test', 'Test123', '$2y$12$bh4VVEohScZlgWVKd9Kgb.3muwx858dv6lAqd5qh5rgZyCjGkOypm', ''),
(7, 'Persoon@test.com', 'Mens De Persoon', 'Mens', '$2y$12$okGCwaKfe5gLgdpaVkcnNewPsXnBFVMs41MFqprFg3FUXf8jrKamS', ''),
(8, 'fFrank@gmail.tank', 'Frank De Tank', 'Tank', '$2y$12$wjjMC.Nz4Y42ycOKrA0MFOvODzJfAM56S8xFVpWDGbEG1CXEBdaDa', ''),
(11, 'blub@blub.com', 'blub blub', 'blub', '$2y$12$92Bp5t0h3tkdvL5rfeucqu63SYkDK6OzOGF6l1QhRMVMdEbqg01Ye', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(12, 'nieuw@email.be', 'nieuwe test', 'nieuwe username', '$2y$12$.HnQEXHkh84nJrF84QvI7u9ph/x0QT4JiesbpGZlQZMilhmYHXxlC', ''),
(13, 'test@user.com', 'testnaam', 'test', '$2y$12$p7U17D092TJHJ0578yavH.N3c7hEd46t3F.KBfxZyDLfhgAjE6Cpm', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users_topics`
--

CREATE TABLE `users_topics` (
  `id` int(11) NOT NULL,
  `users_ID` int(11) NOT NULL,
  `topics_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users_topics`
--
ALTER TABLE `users_topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_ID` (`users_ID`,`topics_ID`),
  ADD KEY `topics_ID` (`topics_ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `users_topics`
--
ALTER TABLE `users_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `users_topics`
--
ALTER TABLE `users_topics`
  ADD CONSTRAINT `users_topics_ibfk_1` FOREIGN KEY (`users_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_topics_ibfk_2` FOREIGN KEY (`topics_ID`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
