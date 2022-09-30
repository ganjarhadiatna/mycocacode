-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Sep 30, 2022 at 08:42 AM
-- Server version: 8.0.23
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_old_mycocacode`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `idbookmark` int UNSIGNED NOT NULL,
  `idstory` int UNSIGNED NOT NULL,
  `id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`idbookmark`, `idstory`, `id`) VALUES
(101, 79, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `idcomment` int UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `subcomment` int UNSIGNED DEFAULT NULL,
  `idstory` int UNSIGNED NOT NULL,
  `id` int UNSIGNED NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`idcomment`, `description`, `subcomment`, `idstory`, `id`, `created`) VALUES
(91, 'test', NULL, 83, 1, '2022-09-30 08:32:40'),
(92, 'test', NULL, 83, 1, '2022-09-30 08:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `idfollow` int UNSIGNED NOT NULL,
  `following` int UNSIGNED NOT NULL,
  `followers` int UNSIGNED NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `idimage` int UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `width` varchar(64) DEFAULT NULL,
  `height` varchar(64) DEFAULT NULL,
  `idstory` int UNSIGNED NOT NULL,
  `id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`idimage`, `image`, `width`, `height`, `idstory`, `id`) VALUES
(18, '1166452596833216f323bb67dffaa828a798a714762.jpeg', '1269', '720', 78, 1),
(19, '11664526041ad443185ad5dd8365a0b6d9d587e1241.jpeg', '1265', '719', 79, 1),
(20, '11664526066ROSÉ1.jpeg', '1263', '720', 80, 1),
(21, '11664526078ROSÉ2.jpeg', '1269', '720', 81, 1),
(22, '11664526087roseblackpinkellephotoshootuhdpaper.com4K8.1253.jpg', '3840', '2160', 82, 1),
(23, '11664526744roseblackpinkicecreamuhdpaper.com4K3.2733.jpg', '3840', '2160', 83, 1),
(24, '11664526814roseblackpinkicecreamuhdpaper.com4K7.2597.jpg', '3840', '2160', 84, 1),
(25, '11664526824roseblackpinkicecreamuhdpaper.com4K7.2591.jpg', '3840', '2160', 85, 1),
(26, '11664526840ROSÉ.jpeg', '1265', '720', 86, 1),
(27, '11664526868roseblackpinksummerdiaryuhdpaper.com4K5.2589.jpg', '3840', '2160', 87, 1);

-- --------------------------------------------------------

--
-- Table structure for table `love`
--

CREATE TABLE `love` (
  `idlove` int UNSIGNED NOT NULL,
  `idstory` int UNSIGNED NOT NULL,
  `id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `love`
--

INSERT INTO `love` (`idlove`, `idstory`, `id`) VALUES
(101, 79, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notif_f`
--

CREATE TABLE `notif_f` (
  `idnotif_f` int UNSIGNED NOT NULL,
  `id` int UNSIGNED NOT NULL,
  `iduser` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('read','unread') DEFAULT 'unread',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notif_f`
--

INSERT INTO `notif_f` (`idnotif_f`, `id`, `iduser`, `title`, `status`, `created`) VALUES
(26, 1, 2, 'Started following you', 'unread', '2018-03-17 07:09:15'),
(27, 1, 6, 'Started following you', 'unread', '2018-03-17 14:37:53'),
(28, 1, 6, 'Started following you', 'unread', '2018-03-17 14:38:26'),
(29, 1, 2, 'Started following you', 'unread', '2018-03-17 14:39:41'),
(30, 1, 4, 'Started following you', 'unread', '2018-03-17 16:18:18'),
(31, 1, 5, 'Started following you', 'read', '2018-03-17 16:18:19'),
(32, 1, 2, 'Started following you', 'unread', '2018-03-17 16:19:50'),
(33, 2, 1, 'Started following you', 'read', '2018-03-18 14:39:49'),
(34, 2, 1, 'Started following you', 'read', '2018-03-20 00:44:55'),
(35, 1, 5, 'Started following you', 'read', '2018-03-22 16:02:40'),
(36, 1, 4, 'Started following you', 'unread', '2018-03-24 03:12:07'),
(37, 1, 6, 'Started following you', 'unread', '2018-03-24 03:12:23'),
(38, 1, 8, 'Started following you', 'unread', '2018-03-24 03:30:17'),
(39, 1, 2, 'Started following you', 'unread', '2018-03-24 03:31:29'),
(40, 1, 2, 'Started following you', 'unread', '2018-03-24 09:54:27'),
(41, 2, 1, 'Started following you', 'read', '2018-03-24 11:33:16'),
(42, 2, 1, 'Started following you', 'read', '2018-03-24 11:35:04'),
(43, 1, 2, 'Started following you', 'unread', '2018-03-24 13:05:15'),
(44, 1, 2, 'Started following you', 'unread', '2018-03-24 13:05:47'),
(45, 1, 2, 'Started following you', 'unread', '2018-03-24 13:07:05'),
(46, 1, 2, 'Started following you', 'unread', '2018-03-24 13:07:55'),
(47, 1, 2, 'Started following you', 'unread', '2018-03-24 13:12:34'),
(48, 2, 1, 'Started following you', 'read', '2018-03-24 15:32:47'),
(49, 1, 7, 'Started following you', 'unread', '2018-04-04 00:01:00'),
(50, 1, 2, 'Started following you', 'unread', '2018-04-07 11:55:07'),
(51, 1, 2, 'Started following you', 'unread', '2018-04-07 11:56:56'),
(52, 1, 8, 'Started following you', 'unread', '2018-04-07 11:59:10'),
(53, 1, 12, 'Started following you', 'unread', '2018-04-07 11:59:12'),
(54, 1, 6, 'Started following you', 'unread', '2018-04-11 11:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `notif_s`
--

CREATE TABLE `notif_s` (
  `idnotif_s` int UNSIGNED NOT NULL,
  `idstory` int UNSIGNED NOT NULL,
  `idbookmark` int UNSIGNED DEFAULT NULL,
  `idcomment` int UNSIGNED DEFAULT NULL,
  `idlove` int UNSIGNED DEFAULT NULL,
  `id` int UNSIGNED NOT NULL,
  `iduser` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('bookmark','comment') DEFAULT NULL,
  `status` enum('read','unread') DEFAULT 'unread',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE `story` (
  `idstory` int UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `adult` smallint UNSIGNED DEFAULT NULL,
  `commenting` smallint UNSIGNED DEFAULT NULL,
  `cover` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int UNSIGNED DEFAULT '0',
  `id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`idstory`, `description`, `adult`, `commenting`, `cover`, `created`, `views`, `id`) VALUES
(78, 'Black Pink', NULL, NULL, '', '2022-09-30 08:19:28', 2, 1),
(79, NULL, NULL, NULL, '', '2022-09-30 08:20:41', 1, 1),
(80, NULL, NULL, NULL, '', '2022-09-30 08:21:06', 1, 1),
(81, NULL, NULL, NULL, '', '2022-09-30 08:21:18', 1, 1),
(82, NULL, NULL, NULL, '', '2022-09-30 08:21:28', 1, 1),
(83, NULL, NULL, NULL, '', '2022-09-30 08:32:25', 2, 1),
(84, NULL, NULL, NULL, '', '2022-09-30 08:33:35', 2, 1),
(85, NULL, NULL, NULL, '', '2022-09-30 08:33:45', 1, 1),
(86, NULL, NULL, NULL, '', '2022-09-30 08:34:00', 1, 1),
(87, NULL, NULL, NULL, '', '2022-09-30 08:34:29', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `idtags` int UNSIGNED NOT NULL,
  `tag` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `idstory` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`idtags`, `tag`, `link`, `idstory`) VALUES
(237, 'Black Pink', '', 78),
(238, 'Black Pink', '', 79),
(239, 'Black Pink', '', 80),
(240, 'Black Pink', '', 81),
(241, 'Black Pink', '', 82),
(242, 'Black Pink', '', 83),
(243, 'Black Pink', '', 84),
(244, 'Black Pink', '', 85),
(245, 'Black Pink', '', 86),
(246, 'Black Pink', '', 87);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `about` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitor` int UNSIGNED DEFAULT '1',
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `password`, `username`, `remember_token`, `created_at`, `updated_at`, `about`, `visitor`, `foto`, `website`, `gender`) VALUES
(1, 'Ganjar Hadiatna', 'ganjardbc@gmail.com', NULL, '$2y$10$vw8/x4gQWPyc7dGKISXFpeeUIEM.zQVIZNO.kwkCzNdRJAZXKue6G', 'ganjardbc', 'JPOBXcZO3lArvojvMyMc2446LNNHgnQZZpkWT8qGtGXaA9yylTW9jNgblewb', '2018-01-07 15:12:27', '2018-04-07 22:08:04', 'Dev-e-Loper ea', 67, '11664525928blackpinkrose.png', 'https://www.pictlr.com', NULL),
(2, 'Ahmad Saeful', 'ahmadsaeful@gmail.com', NULL, '$2y$10$JtNrF8wv6DqiCIc0sqwUmef8GyWWunVZe.v95q42wI7nQhbEJ3jmS', 'ahmadsaeful', 'cRrmr5kmUUsjmXyHS2kWx33PwNot8rsHADL6KzlXXfo6wljM2bmnXSvNuabh', '2018-01-07 15:56:44', '2018-01-07 15:56:44', 'I am a Programmer. I love Listen Music, Programming, Design Website, Playing Guitar and Many More.', 36, '215215946142.jpg', 'www.justtry.me', NULL),
(3, 'Ahmad Saefull', 'ahmadsaefull@gmail.com', NULL, '$2y$10$LrqJ1xtPYduW7IfGrdNfUOSIlMh9FPQCJJHhwr3p7XY2R1WQFNAye', 'ahmadsaefull', 'NiUKBgvXxInI4Nfg9cfZ5gthrLJZUiPqLkatb8fLcHxZ9r8UbkcJCWwYJhSS', '2018-01-13 19:19:44', '2018-01-13 19:19:44', 'Im not anything without anime', 3, '315158533409gagSabra636489751176315213.jpg', NULL, NULL),
(4, 'Ucup Sarucup', 'ucup@gmail.com', NULL, '$2y$10$C/6WcadBDHp6ZxCU9G7jCudScuVzcFr2hehrugqVt6icDb0Xfox9e', 'ucup', 'Dd8avg7TXUeGhFjaKp6ufGYFyJKUEOmGHBetuoWSNwJ3nnkWhYiehYdgtEMC', '2018-01-13 19:39:54', '2018-01-13 19:39:54', NULL, 4, '41515854441pictlrpost150454222522piny636388581415467113.jpg', NULL, NULL),
(5, 'Udin Sarifuddin', 'udin@gmail.com', NULL, '$2y$10$ccuxITTtVcPcQ39/h9NiiuCYS4Y2.gLax.n7pTz0dedlg5dKc6PeO', 'udin', 'hb3ky3UORzu3zYLQsb0WRYQhGmjWF7OU99n9OEoZeD6PORFQPQWg7P3RqrMK', '2018-01-13 19:41:19', '2018-01-13 19:41:19', NULL, 51, '51521907749images2.png', NULL, NULL),
(6, 'Kompas', 'kompas@gmail.com', NULL, '$2y$10$Zwb5XBP7D60Qh7IMsm66V.V6jwO7MKFCb3ZivhgUmqDLIODLCqe7K', 'kompas', 'PvkX0QR0a3r2vRL64nSYyix32aZRpvBSY5Sx5EZ0udpUL8XKpoTphnEVBWev', '2018-01-13 19:42:28', '2018-01-13 19:42:28', NULL, 6, '61515854568pictlrpost150595481627218276861719036133645558879993670737068032n.jpg', NULL, NULL),
(7, 'Kusnandar Sunandar Sunarya', 'kusnandar@gmail.com', NULL, '$2y$10$O3sY0o6dDvWp/8S4yh2g..sGMmFjF4EsGEKnfwKN/UBkzmBx14co.', 'kusnandar', '59tq3c0B1Wrq1bgmKhtHO5rmHgbtLcRUsAvOfxJwR2fbvLRh6ICWioot1Y6j', '2018-01-13 19:43:56', '2018-01-13 19:43:56', NULL, 4, '71515854663tkpost150876710627piny636393284884321593.jpg', NULL, NULL),
(8, 'Eki Sarifudin', 'ekisarifudin@gmail.com', NULL, '$2y$10$1/VzxsPrOqZfY.Qnn8Ubme5QflseIlAoeLH.Fja4JXsjUT/Osq8T2', 'ekisarifudin', 'FTayBlisJcCpWAMLvhujDiqKsKoESY9Shbg8Yx79ML5K3tyxSdP7gEU2bWUF', '2018-01-13 19:47:31', '2018-01-13 19:47:31', NULL, 1, '81515854877pictlrpost1505315416272137205519162996520291723456581802850779136n.jpg', NULL, NULL),
(12, 'Gema Yulia', 'gema18@gmail.com', NULL, '$2y$10$KzJi2.RFuumngkI01Uq4qejMS3ydljAmrEFtxz2M5i4gfqFVL3TXi', 'gema18', 'eLafdn1l3iXKpedjVREQGjWdHnBbeIP2ndy57CFfQDsL6JXSM7UNpdaeQZDI', '2018-04-06 23:15:14', '2018-04-06 23:15:14', NULL, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`idbookmark`),
  ADD KEY `fk_id_bookmark` (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idcomment`),
  ADD KEY `fk_idstory_comment` (`idstory`),
  ADD KEY `fk_id_comment` (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`idfollow`),
  ADD KEY `fk_following` (`following`),
  ADD KEY `fk_followers` (`followers`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`idimage`),
  ADD KEY `fk_id_image` (`id`);

--
-- Indexes for table `love`
--
ALTER TABLE `love`
  ADD PRIMARY KEY (`idlove`),
  ADD KEY `fk_id_love` (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif_f`
--
ALTER TABLE `notif_f`
  ADD PRIMARY KEY (`idnotif_f`),
  ADD KEY `fk_id_notif_f` (`id`),
  ADD KEY `fk_iduser_notif_f` (`iduser`);

--
-- Indexes for table `notif_s`
--
ALTER TABLE `notif_s`
  ADD PRIMARY KEY (`idnotif_s`),
  ADD KEY `fk_idstory_notif_s` (`idstory`),
  ADD KEY `fk_idbookmark_notif_s` (`idbookmark`),
  ADD KEY `fk_idcomment_notif_s` (`idcomment`),
  ADD KEY `fk_id_notif_s` (`id`),
  ADD KEY `fk_iduser_notif_s` (`iduser`);

--
-- Indexes for table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`idstory`),
  ADD KEY `fk_id_story` (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`idtags`),
  ADD KEY `fk_idstory` (`idstory`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `idbookmark` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `idcomment` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `idfollow` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `idimage` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `love`
--
ALTER TABLE `love`
  MODIFY `idlove` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notif_f`
--
ALTER TABLE `notif_f`
  MODIFY `idnotif_f` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `notif_s`
--
ALTER TABLE `notif_s`
  MODIFY `idnotif_s` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `story`
--
ALTER TABLE `story`
  MODIFY `idstory` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `idtags` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `fk_id_bookmark` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_id_comment` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idstory_comment` FOREIGN KEY (`idstory`) REFERENCES `story` (`idstory`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `fk_followers` FOREIGN KEY (`followers`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_following` FOREIGN KEY (`following`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_id_image` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `love`
--
ALTER TABLE `love`
  ADD CONSTRAINT `fk_id_love` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `notif_f`
--
ALTER TABLE `notif_f`
  ADD CONSTRAINT `fk_id_notif_f` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_iduser_notif_f` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notif_s`
--
ALTER TABLE `notif_s`
  ADD CONSTRAINT `fk_id_notif_s` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idbookmark_notif_s` FOREIGN KEY (`idbookmark`) REFERENCES `bookmark` (`idbookmark`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idcomment_notif_s` FOREIGN KEY (`idcomment`) REFERENCES `comment` (`idcomment`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idstory_notif_s` FOREIGN KEY (`idstory`) REFERENCES `story` (`idstory`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_iduser_notif_s` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `fk_id_story` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `fk_idstory` FOREIGN KEY (`idstory`) REFERENCES `story` (`idstory`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
