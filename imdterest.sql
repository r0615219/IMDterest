-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 02 mei 2017 om 13:49
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
(59, 23, 37),
(65, 26, 37),
(66, 25, 37),
(68, 26, 31),
(69, 26, 26),
(70, 27, 22),
(71, 27, 21),
(72, 25, 38);

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
(23, 'Board 1', 27, 'yes'),
(25, 'Board 2', 27, 'yes'),
(26, 'Board  3', 27, 'no'),
(27, 'Lisa\'s gekke koeie foto\'s', 27, 'yes');

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
(18, 'test789789aaa', 27, 37),
(28, '123456789guhgugufuy', 27, 37),
(29, 'Super mooi, WAAAUW', 27, 36),
(32, 'Ik denk da het werkt', 27, 37),
(33, 'testing', 27, 35),
(34, 'testing', 27, 35),
(35, 'testing', 27, 35),
(36, 'testing', 27, 35),
(37, 'What\'s this?', 27, 34),
(38, 'TESTING', 27, 37),
(39, 'TESTING', 27, 37),
(40, 'test ajax', 27, 37),
(48, 'test', 27, 37),
(69, 'HONK HONK', 27, 37),
(70, 'Testing again and again and again', 27, 37),
(71, 'AND THE YEARS START COMING', 27, 37),
(72, 'AND THEY DON\'T STOP COMING', 27, 37),
(73, 'Oh dear', 27, 37),
(74, 'Oh dear', 27, 37),
(75, 'DEAR LORD', 27, 37),
(76, 'I THINK THIS IS IT', 27, 37),
(77, 'I CAN DO THIS', 27, 37),
(78, 'TIS HALF 6 EN DE CAFFEINNE IS OP MAAR HET WEEEEEEEEEEERKT', 27, 37),
(79, 'Now?', 27, 37),
(80, 'YEEEEEEEES', 27, 37),
(81, 'Ah shit', 27, 35),
(82, 'testing', 27, 30),
(83, 'HMM', 27, 37),
(84, 'Dit is een probleem', 27, 36),
(85, 'ereerere', 27, 36),
(86, 'Oy vey', 27, 26),
(87, 'Oy vey', 27, 26),
(88, 'Now?', 27, 36),
(89, 'Eeeehm', 27, 37),
(90, 'Now?', 27, 36),
(91, 'ayayayay', 27, 37),
(92, 'ayayayay', 27, 37),
(93, 'ayayayay', 27, 37),
(94, 'Work pls', 27, 37),
(95, 'ayayayay', 27, 37),
(96, 'ayayayay', 27, 37),
(97, 'ayayayay', 27, 37),
(98, 'RIP', 27, 37),
(99, 'ayayayay', 27, 37),
(100, 'Tis al terug kapot, GG', 27, 37),
(101, 'ayayayay', 27, 37),
(102, 'Nog steeds kapot?', 27, 37),
(103, 'Nog steeds kapot.....', 27, 37),
(104, 'ayayayay', 27, 37),
(105, 'How about now?', 27, 37),
(106, 'ayayayay', 27, 37),
(107, 'Pls work?', 27, 37),
(108, 'IT WORKS', 27, 37),
(109, 'PRAISE JEBUS', 27, 37),
(110, 'Wait whaaa', 27, 36),
(111, 'ik ben echt ni meer mee', 27, 36),
(112, 'Ma dus', 27, 37),
(113, '', 27, 37),
(114, 'watwatwat', 27, 37),
(115, 'Ok maar nu efkes serious eh', 27, 37),
(116, 'FFS', 27, 36),
(117, 'AAAAH', 27, 37),
(118, 'FFS', 27, 36),
(119, 'FFS', 27, 36),
(120, 'Dios mios', 27, 37),
(121, 'FFS', 27, 36),
(122, 'FFS', 27, 37),
(123, 'BUT THIS SHIT DON\'T WORK OFCOURSE', 27, 36),
(124, '', 27, 37),
(125, '', 27, 37),
(126, '', 27, 37),
(127, 'Now?', 27, 37),
(128, 'Ach no', 27, 37),
(129, 'Deze foto is van een tunnel', 27, 30),
(130, 'Deze foto is van een boekje', 27, 29),
(131, 'Ma echt wel een schoon boekje', 27, 29),
(132, 'Ma echt wel een schoon boekje', 27, 29),
(133, 'Heel schoon', 27, 29),
(134, 'Zo mooi', 27, 31),
(135, 'Ellaba', 27, 26),
(136, 'Tis gemaakt boys', 27, 37),
(137, 'En girls', 27, 37),
(138, 'We don\'t discriminate', 27, 37),
(139, 'En?', 27, 37),
(140, 'En done', 27, 31),
(141, 'top!', 27, 31),
(142, 'Nu?', 27, 37);

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
(3, 28, 23),
(4, 28, 24),
(97, 27, 5),
(98, 27, 7),
(130, 27, 31),
(137, 27, 28),
(140, 27, 23),
(171, 27, 36),
(174, 27, 37),
(175, 27, 26);

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
  `reports` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `user_ID`, `title`, `image`, `description`, `link`, `topics_ID`, `time`, `reports`) VALUES
(20, 21, 'Koe', '29_8_11_highland_cattle_iv_by_pdurdin-d48avpk.jpg', 'boe zei de koe!', '', 3, 0, 0),
(21, 21, 'Koe', 'sXjhX44-cow-backgrounds.jpg', 'Boeien, zeiden de koeien', '', 3, 0, 0),
(22, 21, 'Koe', '29_8_11_highland_cattle_iv_by_pdurdin-d48avpk.jpg', 'boe, zei weer de koe', '', 4, 0, 0),
(23, 27, 'aaa', 'rage.png', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '', 7, 0, 0),
(25, 27, 'yay', 'Herc.jpg', 'I DID IT', '', 7, 0, 0),
(26, 27, 'yay', 'Herc.jpg', 'I DID IT', '', 7, 0, 0),
(28, 28, 'selfie', 'Selfie_Robbe-01.png', 'Selfie robbe', '', 7, 0, 0),
(29, 28, 'magazine', 'magazine_graph.png', 'Magazine opdracht design', '', 4, 0, 0),
(30, 28, 'foto', 'tunnel.jpg', 'tunnel', '', 5, 0, 0),
(31, 28, 'Sparkles', 'openVLD.png', 'vuurtje op een stokje', '', 3, 0, 0),
(34, 28, '3D', '3d.png', 'zakmes 3d object challenge design', '', 5, 0, 0),
(35, 28, 'Drawing', 'Room2.0.JPG', 'room perspective challenge design atelier', '', 6, 0, 0),
(36, 28, 'Variatio', 'variatio.jpg', 'fotografie variatio', '', 7, 0, 0),
(37, 19, 'Schildpad', 'a_dream.png', 'zefrgergzetztthg', '', 3, 0, 0),
(38, 27, 'Disgusting', 'Disgusting271493725021.png', 'Eike bah', '', 7, 1493725021, 0);

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
(1, 'Webdesign', 'https://tinyurl.com/n7fdy2z'),
(2, 'Webdevelopment', 'https://tinyurl.com/mzugpq6'),
(3, 'Animation', 'https://tinyurl.com/l889bsq'),
(4, 'UX Design', 'https://tinyurl.com/n3su56g'),
(5, 'UI Design', 'https://tinyurl.com/n8h393g'),
(6, '3D Modeling', 'https://tinyurl.com/p93lljs'),
(7, 'Art', 'https://tinyurl.com/my2l3ux');

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
(21, 'test@tester.be', 'test', 'tester', '$2y$12$O3idPcbJQGEhjfwmikGcPecOOwL7DnE.KacHjHbNLGwypohRUMFZ.', '21.jpg'),
(22, 'topicstest@topicstest.be', 'topics', 'test', '$2y$12$4jE5ASVDGOUjSKFC0wpFF.nhcQ6IjeAxl9IfAXmr0EYKY7wDtp27i', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(23, 'aiaiai@aiai.com', 'aiaiai', 'aiaiai', '$2y$12$IwLL5Lhy7ZBbU/eiIbNOc.XbjIruEGdtZrgYWwFCo35sDMUzLW766', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(24, 'blie@blaa.com', 'blieblaa', 'blieblaa', '$2y$12$B7RVu4kY6/7a3ywEiVi59uxlq5Hb..6rld5qLOPo7bl9yXs.fh/pq', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(25, 'nog@eentest.be', 'nog een test', 'nog een test', '$2y$12$NsIpUTkhjiNcCWtpYJv08uJ35hPJAauFYb9UD/qm15qvGpOKbeXPW', 'http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png'),
(26, 'idk@idk.be', 'idk', 'idk', '$2y$12$zY.Xufqh5OmADOf41S7uve0UvZmn4ImCfNhEmWB5r7sDwykr009Ly', '26.jpg'),
(27, 'jkeirsmaekers@gmail.com', 'joris', 'keirsmaekers', '$2y$12$J0mPYT/n8a8PqRZ0ySWpfO2Kswga5Igp4EbRZSP3NhRkNmTmQ/kNG', 'profile_placeholder.png'),
(28, 'lola@mail.be', 'Lola', 'The Kinks', '$2y$12$EqdcukRQ.ZNhIty4spJVN.HDn5mYTQeNVdBiMH7xp/pf3NoiY9/kK', '28.jpg');

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
(37, 28, 7);

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
-- AUTO_INCREMENT voor een tabel `boardposts`
--
ALTER TABLE `boardposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT voor een tabel `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT voor een tabel `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT voor een tabel `users_topics`
--
ALTER TABLE `users_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
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
