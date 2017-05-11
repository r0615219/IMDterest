-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 11 mei 2017 om 03:04
-- Serverversie: 5.6.35-log
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lisawo1q_imdterest`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boardposts`
--

CREATE TABLE `boardposts` (
  `id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boards`
--

CREATE TABLE `boards` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `visibility` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `post_id`) VALUES
(1, 'Wauw', 49, 8),
(2, 'Test', 50, 12),
(3, 'Test', 50, 12),
(4, '', 50, 12),
(5, '', 50, 12),
(6, 'test', 50, 3),
(7, 'Lorem Ipsum', 50, 3),
(8, 'Prachtig!', 48, 8);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `follows`
--

CREATE TABLE `follows` (
  `id` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `follows`
--

INSERT INTO `follows` (`id`, `follower`, `user`) VALUES
(10, 41, 38),
(38, 48, 50),
(13, 49, 48),
(16, 41, 49),
(17, 49, 50),
(24, 48, 49);

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
(1, 49, 9),
(2, 49, 1),
(3, 48, 5),
(4, 49, 3),
(5, 48, 8);

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
(1, 49, 'Triangle Art', 'TriangleArt491494460109.jpg', 'Triangle Art - from 9gag', '', 10, 1494460109, 0, 'Steenokkerzeel', 0),
(3, 49, 'Trees', 'Trees491494460242.jpg', 'free images on unsplash.com', '', 12, 1494460242, 0, 'Steenokkerzeel', 0),
(8, 50, 'Toren', 'Toren501494462162.png', 'toren', '', 10, 1494462162, 0, '', 0),
(9, 48, '3D Object', '3DObject481494464296.png', '3D object gemaakt in Photoshop', '', 26, 1494464296, 0, 'Tienen', 0),
(10, 48, 'James Fridman', 'http://68.media.tumblr.com/avatar_d2be19612523_64.png', 'James Fridman', 'http://jamesfridman.com/', 8, 1494464314, 0, 'Tienen', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `post_reports`
--

CREATE TABLE `post_reports` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `post_reports`
--

INSERT INTO `post_reports` (`id`, `post_id`, `user_id`) VALUES
(1, 7, 49),
(2, 7, 49),
(3, 7, 49),
(4, 5, 48),
(5, 5, 48),
(6, 5, 48);

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
(8, 'Webdesign', 'webdesign.jpg'),
(9, 'Webdevelopment', 'webdevelopment.jpg'),
(10, 'Animation', 'animation.jpg'),
(11, 'UX Design', 'ux.jpg'),
(12, 'UI Design', 'ui.jpg'),
(13, '3D Modeling', '3d.png'),
(14, 'Art', 'art.jpg'),
(26, '3D', '3Dobject481494460181.png'),
(27, 'Iconen', 'Iconenset481494460375.png');

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
(48, 'lisa@m-release.com', 'Lisa', 'Wouters', '$2y$12$FANmDnCwJXooc/9/NerMkOt1Wr4i02JJPUKB1gBmb6rGTLepVq2w.', '481494460945.jpg'),
(49, 'lola@mail.be', 'Lola', 'The Kinks', '$2y$12$.ItHi.e8/ET2VooAjnR.3OrI9CREtAkIiiE3Yk1gvVeFv.bWfxcdu', '491494460147.jpg'),
(50, 'j@k.be', 'J', 'K', '$2y$12$IW9wyZQCHP.IPpQNML7TzuTqn964DYmar7CUhi9m.381861pa3BKO', 'profile_placeholder.png'),
(51, 'test@test.com', 'test', 'test', '$2y$12$XuacNZiP.8saShSjwxFEdu2G6EE0kjuZgMbX2iUSxOYjxNTJm/aIe', 'profile_placeholder.png');

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
(1, 48, 8),
(2, 48, 9),
(3, 48, 10),
(4, 48, 11),
(5, 48, 12),
(10, 48, 26),
(11, 48, 27),
(6, 49, 8),
(7, 49, 9),
(8, 49, 10),
(9, 49, 12),
(13, 50, 9),
(14, 50, 10),
(15, 50, 11),
(12, 50, 12),
(19, 51, 8),
(17, 51, 10),
(18, 51, 11),
(16, 51, 12);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `boardposts`
--
ALTER TABLE `boardposts`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexen voor tabel `post_reports`
--
ALTER TABLE `post_reports`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT voor een tabel `boardposts`
--
ALTER TABLE `boardposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT voor een tabel `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT voor een tabel `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT voor een tabel `users_topics`
--
ALTER TABLE `users_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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
