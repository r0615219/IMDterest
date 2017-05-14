-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 14 mei 2017 om 12:09
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

--
-- Gegevens worden geëxporteerd voor tabel `boardposts`
--

INSERT INTO `boardposts` (`id`, `board_id`, `post_id`) VALUES
(10, 3, 12),
(11, 3, 9),
(12, 4, 11),
(13, 4, 22);

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

--
-- Gegevens worden geëxporteerd voor tabel `boards`
--

INSERT INTO `boards` (`id`, `subject`, `user_id`, `visibility`) VALUES
(2, 'test board', 50, 'yes'),
(3, 'Websites', 48, 'yes'),
(4, 'Design Atelier', 49, 'yes');

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
(8, 'Prachtig!', 48, 8),
(9, 'good job!', 48, 11),
(10, 'ha ha ha', 49, 21),
(11, 'Cutie!!', 48, 18),
(12, 'Whaaaa', 49, 24),
(13, 'Awesome', 49, 24),
(14, 'Amai! :o', 48, 24),
(15, 'hiadoda', 50, 3),
(16, 'hiadoda', 50, 3),
(17, 'hiadoda', 50, 3),
(18, 'hiadoda', 50, 3),
(19, 'hiadoda', 50, 3),
(20, 'hiadoda', 50, 3),
(21, 'hiadoda', 50, 3),
(23, 'Zo schattig!!', 48, 45),
(24, 'roelifant ftw :p', 57, 45);

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
(64, 49, 54),
(13, 49, 48),
(16, 41, 49),
(17, 49, 50),
(44, 48, 49),
(71, 49, 53),
(80, 49, 55),
(81, 55, 49),
(86, 48, 55),
(87, 50, 49),
(88, 50, 53),
(92, 57, 49),
(91, 57, 48),
(93, 48, 57),
(94, 48, 50),
(95, 58, 57),
(96, 58, 48),
(97, 57, 58);

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
(5, 48, 8),
(12, 48, 11),
(13, 48, 9),
(14, 49, 20),
(15, 49, 21),
(17, 48, 18),
(18, 49, 25),
(19, 48, 22),
(25, 48, 45),
(26, 49, 45),
(27, 48, 48),
(28, 57, 3),
(29, 57, 21),
(30, 57, 18),
(31, 58, 60),
(32, 58, 3),
(33, 58, 62),
(34, 48, 59),
(35, 57, 60),
(36, 57, 61),
(37, 57, 63);

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
(8, 50, '<h1>Pixel tower</h1>', 'Toren501494462162.png', 'toren', '', 10, 1494462162, 0, '', 0),
(9, 48, '3D Object', '3DObject481494464296.png', '3D Object gemaakt in Photoshop', '', 26, 1494464296, 0, 'Tienen', 0),
(11, 53, 'My first calender', 'Myfirstcalender531494470565.png', 'I made this!', '', 10, 1494470565, 0, '', 0),
(12, 48, 'Masterani - Watch. Track. Anime.', 'http://masterani.me/static/img/touch/icon.png', 'Masterani is an anime info database with a streaming option to watch anime in HD. Join the community to keep track of your watched anime and get to follow friends to see what they\'re watching.', 'http://masterani.me', 28, 1494487231, 0, 'Mechelen', 0),
(14, 49, 'Family', 'Family491494494659.jpg', 'family la la la', '', 12, 1494494659, 0, '', 0),
(17, 49, 'Graffiti', 'Graffiti491494494826.jpg', 'Graffiti art', '', 14, 1494494826, 0, '', 0),
(18, 55, 'It\'s me!', 'It\'sme!551494494835.jpg', 'Dawgy', '', 29, 1494494835, 0, 'Mechelen', 0),
(20, 49, 'Ice skating', 'Iceskating491494494988.jpg', 'Ice skating', '', 10, 1494494988, 0, '', 0),
(21, 49, 'Unicorn', 'Unicorn491494495052.jpg', 'Arc of Noah', '', 30, 1494495052, 0, '', 0),
(22, 49, 'Dance', 'Dance491494498108.jpg', 'Footloose - Kenny Loggins', '', 31, 1494498108, 0, '', 0),
(27, 48, 'bol.com | de winkel van ons allemaal', 'https://www.bol.com/nl/upload/images/mobile/images/banner_moederdag_2017_624.jpg', 'bol.com, de winkel van ons allemaal. Kies uit &gt;14 miljoen artikelen. Snel en vanaf 20,- gratis verzonden!', 'http://bol.com', 8, 1494680496, 0, 'Tienen', 0),
(42, 57, 'character sketches', 'charactersketches571494684051.jpg', 'A concept sketch of insect-like fantasy characters.', '', 14, 1494684051, 0, 'Mechelen', 0),
(44, 57, 'Insect warrior concept art', 'Insectwarriorconceptart571494684364.jpg', 'Concept art of a winged ant soldier for a fantasy story in progress', '', 14, 1494684364, 0, 'Mechelen', 0),
(45, 57, '404 page animation', '404pageanimation571494684574.jpg', 'An animation on roelifant.com\'s 404 page', '', 10, 1494684574, 0, 'Mechelen', 0),
(46, 57, 'Skull train', 'Skulltrain571494684871.jpg', 'Made for a story concept about a flying train that would bring dead dreams and fantasies to the afterlife.', '', 14, 1494684871, 0, 'Mechelen', 0),
(47, 57, 'Mechelen Matcht logo', 'MechelenMatchtlogo571494685455.jpg', 'A logo design made for Mechelen Matcht', '', 8, 1494685455, 0, 'Mechelen', 0),
(48, 57, 'roelifant logo', 'roelifantlogo571494685608.jpg', 'The logo from roelifant.com using measurements from the golden ratio.', '', 8, 1494685608, 0, 'Mechelen', 0),
(49, 57, 'A dark room', 'Adarkroom571494685874.jpg', 'A study on perspective and lighting', '', 14, 1494685874, 0, 'Mechelen', 0),
(53, 57, 'Smashing Magazine â€“ For Professional Web Designers and Developers', 'https://www.smashingmagazine.com/wp-content/themes/smashing-magazine/assets/images/logo.png', 'Smashing Magazine â€” for web designers and developers', 'https://www.smashingmagazine.com/', 9, 1494753475, 0, 'Mechelen', 0),
(58, 57, 'Icon pack', 'Iconpack571494753977.jpg', '60 icons made for free use.', '', 8, 1494753977, 0, 'Mechelen', 0),
(59, 57, 'Sketchbook', 'Sketchbook571494754374.jpg', 'A doodle of a mask with many eyes. Made with traditional pencil and paper', '', 14, 1494754374, 0, 'Mechelen', 0),
(60, 48, 'Compressor failure', 'Compressorfailure481494755381.png', 'Compressing my images failed', '', 9, 1494755381, 0, 'Tienen', 0),
(61, 58, 'a cabin', 'acabin581494755754.jpg', 'An abandoned structure in switserland', '', 35, 1494755754, 0, 'Mechelen', 0),
(62, 48, 'iconen', 'iconen481494755979.png', 'Kleurijke en moderne iconen', '', 27, 1494755979, 0, 'Tienen', 0),
(63, 58, 'Mountain', 'Mountain581494756064.jpg', 'On the mountain side in Switserland', '', 35, 1494756064, 0, 'Mechelen', 0),
(64, 58, 'A bridge', 'Abridge581494756290.jpg', 'It\'s a bridge...', '', 35, 1494756290, 0, 'Mechelen', 0),
(66, 48, 'Logo', 'Logo481494756369.png', 'Logo van lisawouters.be', '', 34, 1494756369, 0, 'Tienen', 0),
(67, 48, 'Vtwonen redesign', 'Vtwonenredesign481494756479.png', 'Redesign van vtwonen.be', '', 11, 1494756479, 0, 'Tienen', 0);

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
(27, 'Iconen', 'Iconenset481494460375.png'),
(28, 'Websites', 'http://masterani.me/static/img/touch/icon.png'),
(29, 'cute', 'It\'sme!551494494835.jpg'),
(30, 'Funny', 'Unicorn491494495052.jpg'),
(31, 'Dance', 'Dance491494498108.jpg'),
(32, 'Photoshop', 'Photoshopkamer481494682148.jpg'),
(33, 'Illustrator', 'SneeuwmanMickey481494682201.jpg'),
(34, 'logos', 'Logolisawouters.be481494753389.png'),
(35, 'photography', 'acabin581494755754.jpg');

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
(52, 'a@e.e', 'aea', 'ada', '$2y$12$EZCeu0cmIQ62Ugx4lmXfAuQa/B1lhe36xLTyr9SOSJaWFknrmKV9y', 'profile_placeholder.png'),
(53, 'Honk@henk.haha', 'Henk', 'Honk', '$2y$12$QeGOknHtZQgLJnZrS1Bz8.zNeu9Ln65Q2lPfgO8KWR0YPqT1a.6mS', 'profile_placeholder.png'),
(55, 'mila@mail.be', 'Queen', 'Mila', '$2y$12$hCej2i9j61IXH6iDBga5DeDs2px2iasDk477m.W0KawheA3XB50pm', '551494494869.jpg'),
(56, 'j@j.j', 'joris', 'keirsmaekers', '$2y$12$0itiVRaFchTiTXG3c.L.MeRfKZIdFqfzSK8ZZf.NB7y2pTznDNTAy', 'profile_placeholder.png'),
(57, 'roelifant@gmail.com', 'Roel', 'Van Rossen', '$2y$12$/i6DR7mDLi8y68bRdNf.sOTwZh8GHVYOG.dUbBuYtsQryCtBdmSBG', '571494682301.jpg'),
(58, 'siggers@hotmail.be', 'Sigmund', 'Langnek', '$2y$12$qyR2gtt58EBcU7qC.GC3Pun/ASsMeKxi045EBFybLJXRO5K9ZO8pu', '581494756382.jpg');

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
(54, 48, 14),
(10, 48, 26),
(11, 48, 27),
(30, 48, 28),
(52, 48, 32),
(53, 48, 33),
(59, 48, 34),
(6, 49, 8),
(7, 49, 9),
(8, 49, 10),
(9, 49, 12),
(43, 49, 14),
(45, 49, 30),
(46, 49, 31),
(13, 50, 9),
(14, 50, 10),
(15, 50, 11),
(12, 50, 12),
(28, 52, 8),
(29, 52, 9),
(26, 52, 10),
(27, 52, 11),
(25, 52, 12),
(24, 53, 8),
(22, 53, 9),
(20, 53, 10),
(23, 53, 11),
(21, 53, 12),
(37, 55, 9),
(36, 55, 10),
(44, 55, 29),
(41, 56, 8),
(40, 56, 9),
(38, 56, 10),
(42, 56, 11),
(39, 56, 12),
(51, 57, 8),
(47, 57, 9),
(48, 57, 10),
(50, 57, 11),
(49, 57, 12),
(55, 57, 14),
(63, 58, 8),
(60, 58, 9),
(62, 58, 11),
(61, 58, 12),
(64, 58, 35);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT voor een tabel `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT voor een tabel `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT voor een tabel `users_topics`
--
ALTER TABLE `users_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
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
