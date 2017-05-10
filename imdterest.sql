-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 mei 2017 om 01:00
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
-- Tabelstructuur voor tabel `boards`
--

CREATE TABLE `boards` (
  `id` int(11) NOT NULL,
  `subject` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `visibility` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `post_id`) VALUES
(1, 'wa een cutie!! <3', 21, 42),
(2, 'rip :(', 21, 49),
(3, 'test comment', 21, 14),
(4, 'test comment', 21, 50),
(5, 'test', 27, 29),
(6, 'Mourinho zegt comments werken', 27, 64);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `follows`
--

CREATE TABLE `follows` (
  `followId` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `follows`
--

INSERT INTO `follows` (`followId`, `follower`, `user`) VALUES
(1, 30, 29),
(2, 27, 29),
(6, 27, 21);

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
(4, 28, 24),
(27, 30, 45),
(30, 30, 50),
(31, 30, 54),
(33, 21, 47);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(200) NOT NULL,
  `topics_ID` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `reports` int(11) NOT NULL DEFAULT '0',
  `location` varchar(200) NOT NULL,
  `privacy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `user_ID`, `title`, `image`, `description`, `link`, `topics_ID`, `time`, `reports`, `location`, `privacy`) VALUES
(20, 21, 'Koe', '29_8_11_highland_cattle_iv_by_pdurdin-d48avpk.jpg', 'boe zei de koe!', '', 3, 0, 0, '', 0),
(21, 21, 'Koe', 'sXjhX44-cow-backgrounds.jpg', 'Boeien, zeiden de koeien', '', 3, 0, 0, '', 0),
(22, 21, 'Koe', '29_8_11_highland_cattle_iv_by_pdurdin-d48avpk.jpg', 'boe, zei weer de koe', '', 4, 0, 0, '', 0),
(23, 27, 'aaa', 'rage.png', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '', 7, 0, 0, '', 0),
(24, 27, 'facebook', 'https://www.facebook.com/', 'Want facebook is toch wel kunst hoor', 'https://www.facebook.com/', 7, 0, 0, '', 0),
(25, 27, 'yay', 'Herc.jpg', 'I DID IT', '', 7, 0, 0, '', 0),
(26, 27, 'yay', 'Herc.jpg', 'I DID IT', '', 7, 0, 0, '', 1),
(27, 27, 'yay', 'Herc.jpg', 'I DID IT', '', 7, 0, 0, '', 0),
(28, 28, 'selfie', 'Selfie_Robbe-01.png', 'Selfie robbe', '', 7, 0, 0, '', 1),
(29, 28, 'magazine', 'magazine_graph.png', 'Magazine opdracht design', '', 4, 0, 0, '', 2),
(30, 28, 'foto', 'tunnel.jpg', 'tunnel', '', 5, 0, 0, '', 0),
(31, 28, 'Sparkles', 'openVLD.png', 'vuurtje op een stokje', '', 3, 0, 0, '', 0),
(34, 28, '3D', '3d.png', 'zakmes 3d object challenge design', '', 5, 0, 0, '', 0),
(35, 28, 'Drawing', 'Room2.0.JPG', 'room perspective challenge design atelier', '', 6, 0, 0, '', 0),
(36, 28, 'Variatio', 'variatio.jpg', 'fotografie variatio', '', 7, 0, 0, '', 0),
(37, 19, 'Schildpad', 'a_dream.png', 'zefrgergzetztthg', '', 3, 0, 0, '', 0),
(38, 19, 'Fladder', 'lolz engel.jpg', 'lolz hihi', '', 4, 1492939048, 0, '', 0),
(39, 19, 'Upload plz', 'Otter space.jpg', 'pls', '', 3, 1492939116, 0, '', 0),
(40, 19, 'PLZ', 'trash.png', 'pls pretty pls', '', 4, 1492939138, 0, '', 0),
(41, 21, 'Kalf', '20160709_151510.jpg', 'Kalfje', '', 3, 1493040708, 0, '', 0),
(42, 21, 'Penelope', 'Penelope8.jpg', 'Penelope', '', 3, 1493104129, 0, '', 0),
(44, 21, 'piggy and ice cream', 'tumblr_static_tumblr_static_3rhyuytz2q04g0c0s8k4ccgoo_640.jpg', 'piggy eating ice cream', '', 4, 1493104308, 3, '', 0),
(45, 21, 'piggy and ice cream', 'tumblr_static_tumblr_static_3rhyuytz2q04g0c0s8k4ccgoo_640.jpg', 'piggy eating ice cream', '', 4, 1493106150, 5, '', 0),
(49, 29, 'Blubblub', 'Blubblub291493237976.png', 'hihihihihihi', '', 3, 1493237976, 0, '', 1),
(51, 29, 'test test', 'test%20test291493283206.jpg', 'ererberrgtfrvgtfr', '', 3, 1493283206, 0, '', 0),
(52, 30, 'bol.com | de winkel van ons allemaal', 'https://www.bol.com/nl/upload/images/mobile/images/banner_elektronicadeals_mobiel_2017_624.jpg', 'bol.com, de winkel van ons allemaal. Kies uit &gt;14 miljoen artikelen. Snel en vanaf 20,- gratis verzonden!', 'http://bol.com', 8, 1493651210, 0, '', 0),
(53, 21, 'Lisa Wouters - Your website, my passion', 'http://lisawouters.beimages/logo.svg', 'Hi, I am Lisa, a passionate webdeveloper in the making!', 'http://lisawouters.be', 8, 1493676486, 0, '', 0),
(57, 30, 'sdf', 'sdf30.jpg', 'w4sd', '', 11, 1493726041, 0, '', 0),
(58, 21, 'Blijven gaan', 'Blijvengaan211494357475.jpg', 'hop hop hop hop hop!!', '', 3, 1494357475, 0, 'Tienen', 0),
(63, 21, 'qwerty', 'qwerty211494363435.jpg', 'qwerty', '', 13, 1494363435, 0, 'Tienen', 0),
(64, 27, 'werk pls', 'werkpls271494452194.jpg', 'ARbeit', '', 3, 1494452194, 0, 'Mechelen', 0),
(65, 27, 'ada', 'ada271494452372.png', 'dada', '', 5, 1494452372, 0, 'Mechelen', 0),
(66, 27, 'reeeee', 'reeeee271494452505.jpg', 'eeeeeer', '', 6, 1494452505, 0, 'Mechelen', 1),
(67, 27, 'dad', 'dad271494453637.jpg', 'da', '', 3, 1494453637, 0, 'Mechelen', 0);

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
(1, 'Webdesign', 'webdesign.jpg'),
(2, 'Webdevelopment', 'webdevelopment.jpg'),
(3, 'Animation', 'animation.jpg'),
(4, 'UX Design', 'ux.jpg'),
(5, 'UI Design', 'ui.jpg'),
(6, '3D Modeling', '3d.png'),
(7, 'Art', 'art.jpg'),
(8, 'Websites', 'https://www.bol.com/nl/upload/images/mobile/images/banner_elektronicadeals_mobiel_2017_624.jpg'),
(10, 'schattigheid', 'Cutie30.jpg'),
(11, 'wqwerty', 'sdf30.jpg'),
(13, 'qwerty', 'qwerty211494363435.jpg'),
(14, 'dfs', 'fds211494364193.png');

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
(19, 'test2@test.com', 'Test2', 'Persoon', '$2y$12$4NgfniKjq3eCFuK2Q9B9A.zgE8wkJ2Ba1YG0N49lXWNd/3SIOMw06', '19.jpg'),
(21, 'test@tester.be', 'test', 'tester', '$2y$12$O3idPcbJQGEhjfwmikGcPecOOwL7DnE.KacHjHbNLGwypohRUMFZ.', '211494354984.jpg'),
(22, 'topicstest@topicstest.be', 'topics', 'test', '$2y$12$4jE5ASVDGOUjSKFC0wpFF.nhcQ6IjeAxl9IfAXmr0EYKY7wDtp27i', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(23, 'aiaiai@aiai.com', 'aiaiai', 'aiaiai', '$2y$12$IwLL5Lhy7ZBbU/eiIbNOc.XbjIruEGdtZrgYWwFCo35sDMUzLW766', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(24, 'blie@blaa.com', 'blieblaa', 'blieblaa', '$2y$12$B7RVu4kY6/7a3ywEiVi59uxlq5Hb..6rld5qLOPo7bl9yXs.fh/pq', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(25, 'nog@eentest.be', 'nog een test', 'nog een test', '$2y$12$NsIpUTkhjiNcCWtpYJv08uJ35hPJAauFYb9UD/qm15qvGpOKbeXPW', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(26, 'idk@idk.be', 'idk', 'idk', '$2y$12$zY.Xufqh5OmADOf41S7uve0UvZmn4ImCfNhEmWB5r7sDwykr009Ly', '26.jpg'),
(27, 'jkeirsmaekers@gmail.com', 'joris', 'keirsmaekers', '$2y$12$J0mPYT/n8a8PqRZ0ySWpfO2Kswga5Igp4EbRZSP3NhRkNmTmQ/kNG', 'profile_placeholder.png'),
(28, 'lola@mail.be', 'Lola', 'The Kinks', '$2y$12$EqdcukRQ.ZNhIty4spJVN.HDn5mYTQeNVdBiMH7xp/pf3NoiY9/kK', '28.jpg'),
(29, 'Bert@bertmail.bert', 'Bert', 'Bertmans', '$2y$12$WJuRgD8fRti9/f.hnyRSr.6Mg/mG0zG38DDFHJ8A0biqTr0sfr3Qa', '291493234536.png'),
(30, 'lisa@m-release.com', 'Lisa', 'Wouters', '$2y$12$79CUy6yR6OtFvB4j.zK3UuF4FFFq2sq2RQ47PB7eAYYaEvBB2YhSy', 'profile_placeholder.png'),
(33, 'lisa@blub.be', 'Lisa', 'Blub', '$2y$12$RYRqD3vjeA0QFtU4bkiJhOxyO2eCroC3D3hAEm/jItXhQLA0sObNe', 'profile_placeholder.png');

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
(40, 19, 3),
(38, 19, 4),
(39, 19, 5),
(14, 21, 3),
(15, 21, 4),
(47, 21, 8),
(55, 21, 13),
(56, 21, 14),
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
(32, 27, 7),
(34, 28, 3),
(33, 28, 4),
(35, 28, 5),
(36, 28, 6),
(37, 28, 7),
(42, 29, 3),
(41, 29, 4),
(43, 29, 7),
(44, 30, 4),
(45, 30, 5),
(46, 30, 8),
(48, 30, 10),
(49, 30, 11),
(60, 33, 6),
(59, 33, 7);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`followId`);

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
-- AUTO_INCREMENT voor een tabel `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `follows`
--
ALTER TABLE `follows`
  MODIFY `followId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT voor een tabel `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT voor een tabel `users_topics`
--
ALTER TABLE `users_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
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
