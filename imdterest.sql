-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 apr 2017 om 13:06
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
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `likeId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PostId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `likes`
--

INSERT INTO `likes` (`likeId`, `UserId`, `PostId`) VALUES
(1, 27, 23),
(2, 27, 25),
(3, 28, 23),
(4, 28, 24);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(200) NOT NULL,
  `topics_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `user_ID`, `image`, `description`, `link`, `topics_ID`) VALUES
(20, 21, '29_8_11_highland_cattle_iv_by_pdurdin-d48avpk.jpg', 'boe zei de koe!', '', 3),
(21, 21, 'sXjhX44-cow-backgrounds.jpg', 'Boeien, zeiden de koeien', '', 3),
(22, 21, '29_8_11_highland_cattle_iv_by_pdurdin-d48avpk.jpg', 'boe, zei weer de koe', '', 4),
(23, 27, 'rage.png', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '', 7),
(24, 27, 'https://www.facebook.com/', 'Want facebook is toch wel kunst hoor', 'https://www.facebook.com/', 7),
(25, 27, 'Herc.jpg', 'I DID IT', '', 7),
(26, 27, 'Herc.jpg', 'I DID IT', '', 7),
(27, 27, 'Herc.jpg', 'I DID IT', '', 7);

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
  `firstname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `password`, `image`) VALUES
(17, 'blub@blab.com', 'blub', 'blab', '$2y$12$Jqz6YTD8zkzwuSEx/y6.b.HfxHjzjXmx7vI6OUz9fbk9laklaDR1y', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(18, 'test@test.com', 'Test', 'Persoon', '$2y$12$UzoRl9eBeDIhzRv7f925zOoxOPJVixU.gkshlAFtRJoI2FVFpRrgW', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(19, 'test2@test.com', 'Test2', 'Persoon', '$2y$12$4NgfniKjq3eCFuK2Q9B9A.zgE8wkJ2Ba1YG0N49lXWNd/3SIOMw06', 'woef.jpg'),
(21, 'test@tester.be', 'test', 'tester', '$2y$12$O3idPcbJQGEhjfwmikGcPecOOwL7DnE.KacHjHbNLGwypohRUMFZ.', '21.jpg'),
(22, 'topicstest@topicstest.be', 'topics', 'test', '$2y$12$4jE5ASVDGOUjSKFC0wpFF.nhcQ6IjeAxl9IfAXmr0EYKY7wDtp27i', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(23, 'aiaiai@aiai.com', 'aiaiai', 'aiaiai', '$2y$12$IwLL5Lhy7ZBbU/eiIbNOc.XbjIruEGdtZrgYWwFCo35sDMUzLW766', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(24, 'blie@blaa.com', 'blieblaa', 'blieblaa', '$2y$12$B7RVu4kY6/7a3ywEiVi59uxlq5Hb..6rld5qLOPo7bl9yXs.fh/pq', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(25, 'nog@eentest.be', 'nog een test', 'nog een test', '$2y$12$NsIpUTkhjiNcCWtpYJv08uJ35hPJAauFYb9UD/qm15qvGpOKbeXPW', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(26, 'idk@idk.be', 'idk', 'idk', '$2y$12$zY.Xufqh5OmADOf41S7uve0UvZmn4ImCfNhEmWB5r7sDwykr009Ly', '26.jpg'),
(27, 'jkeirsmaekers@gmail.com', 'joris', 'keirsmaekers', '$2y$12$J0mPYT/n8a8PqRZ0ySWpfO2Kswga5Igp4EbRZSP3NhRkNmTmQ/kNG', 'profile_placeholder.png');

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
-- Gegevens worden geëxporteerd voor tabel `users_topics`
--

INSERT INTO `users_topics` (`id`, `users_ID`, `topics_ID`) VALUES
(7, 17, 1),
(8, 17, 2),
(9, 17, 3),
(10, 17, 4),
(11, 17, 5),
(12, 17, 6),
(13, 17, 7),
(14, 21, 3),
(15, 21, 4),
(16, 22, 5),
(17, 22, 6),
(18, 23, 4),
(19, 23, 7),
(20, 24, 3),
(21, 24, 5),
(22, 25, 4),
(24, 26, 3),
(23, 26, 4),
(25, 26, 5),
(26, 26, 6),
(27, 26, 7),
(29, 27, 3),
(28, 27, 4),
(30, 27, 5),
(31, 27, 6),
(32, 27, 7);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeId`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_ibfk_1` (`topics_ID`);

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
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT voor een tabel `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT voor een tabel `users_topics`
--
ALTER TABLE `users_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topics_ID`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `users_topics`
--
ALTER TABLE `users_topics`
  ADD CONSTRAINT `users_topics_ibfk_1` FOREIGN KEY (`users_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_topics_ibfk_2` FOREIGN KEY (`topics_ID`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
