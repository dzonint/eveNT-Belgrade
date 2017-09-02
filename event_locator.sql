-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2017 at 09:24 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_locator`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `category`) VALUES
(1, 'Obrazovanje'),
(2, 'Muzika'),
(3, 'Sport'),
(4, 'Umetnost'),
(5, 'Film'),
(6, 'Nightlife');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ID` int(11) NOT NULL,
  `event_name` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `event_desc_short` mediumtext COLLATE utf8mb4_unicode_520_ci,
  `event_desc` mediumtext COLLATE utf8mb4_unicode_520_ci,
  `event_price` int(11) DEFAULT '0',
  `event_location` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `event_picture` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `social_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID`, `event_name`, `event_desc_short`, `event_desc`, `event_price`, `event_location`, `event_date`, `event_picture`, `category_id`, `social_id`) VALUES
(1, 'Kombank arena: Sting', 'U okviru nove turneje "57th & 9th World Tour" popularni Sting održaće koncert u Kombank areni, 17. juna. Povod ovog gostovanja u Beogradu je Stingov 12. solo studijski album "57th & 9th" što je njegov prvi rock/pop projekat posle više od deset godina. Sting će u Beogradu predstaviti ceo album ali i neke starije hitove.', 'Gordon Metju Tomas Samner (engl. Gordon Matthew Thomas Sumner; rođen 2. oktobra 1951), poznatiji po nadimku Sting, je engleski muzičar rodom iz Volsenda u Severnom Tajnsajdu (Wallsend in North Tyneside). Pre solo karijere, Sting je bio glavni tekstopisac, pevač i basista rok grupe Polis. Kao solo muzičar i član grupe Polis, prodao je preko 100 miliona ploča, dobio šesnaest Gremi nagrada za svoj rad (prvi Gremi dobio je za „najbolji rok instrumental nastup“, 1981. godine) i jednom je bio nominovan za Oskara za najbolju pesmu.\r\nPovod ovog gostovanja u Beogradu je Stingov 12. solo studijski album „57th & 9th“ što je njegov prvi rock/pop projekat posle više od deset godina. Sting će u Beogradu predstaviti ceo album ali i neke starije hitove.', 2990, 'Kombank arena', '2017-09-17 21:00:00', 'img/event/sting_concert.jpg', 2, 1),
(2, 'Beogradski džez festival 2017', 'U Domu omladine Beograda i Sava centru, od 26. do 30. oktobra, biće održan 33. Beogradski džez festival pod sloganom "Džez vizije". Karte su u prodaji, a najavljeni su i prvi učesnici: Doni Mekaslin, Jan Lundgren i Eyot.', 'U Domu omladine Beograda i Sava centru, od 26. do 30. oktobra, biće održan 33. Beogradski džez festival pod sloganom „Džez vizije“.\r\n\r\nKarte su u prodaji, a najavljeni su i prvi učesnici: Doni Mekaslin, Jan Lundgren i Eyot.', 0, 'Dom omladine Beograda', '2017-08-26 18:00:00', 'img/event/beogradski-dzez-festival.jpg', 2, 2),
(3, 'Star Wars: The Last Jedi', 'Potvrđen je naslov najnovijeg filma Star Wars franšize – The Last Jedi! Scenario i režiju za novo poglavlje sage o Skajvokerima potpisuje Rajan Džonson, producenti su Ketlin Kenedi i Ram Bergman, a izvršni producenti Džej Džej Abrams, Džejson Makgatlin i Tom Karnovski.', 'Potvrđen je naslov najnovijeg filma Star Wars franšize – The Last Jedi! \r\n\r\nScenario i režiju za novo poglavlje sage o Skajvokerima potpisuje Rajan Džonson, producenti su Ketlin Kenedi i Ram Bergman, a izvršni producenti Džej Džej Abrams, Džejson Makgatlin i Tom Karnovski.\r\n\r\n„Star Wars: The Last Jedi“ u naše bioskope stiže 14. decembra ove godine, dok će premijera biti održana dan ranije u nekoliko beogradskih bioskopa! ', -1, 'Bioskopi u Beogradu', '2017-12-13 20:00:00', 'img/event/star-wars-the-last-jedi.jpg', 5, 3),
(4, 'Red Star Belgrade vs Partizan', 'Posle dugo, dugo vremena, Beograd će gledati "evropski derbi"! U nedelju od 19 časova na stadionu Rajko Mitić sastaće se fudbaleri Crvene zvezde i Partizana, samo tri dana pošto su i jedni i drugi obezbedili plasman u grupnu fazu Lige Evrope! ', 'Posle dugo, dugo vremena, Beograd će gledati "evropski derbi"! \r\n\r\nU nedelju od 19 časova na stadionu Rajko Mitić sastaće se fudbaleri Crvene zvezde i Partizana, samo tri dana pošto su i jedni i drugi obezbedili plasman u grupnu fazu Lige Evrope! \r\n\r\nPrenos je obezbeđen na TV Arena Sport. Iz ove medijske kuće najavljuju da će program posvećen "večitom derbiju" početi u 17:30 časova. U studiju Arene biće raznih gostiju, biće uključenja sa stadiona i ispred stadiona, videćete dolazak obe ekipe... \r\n\r\nProdaja ulaznica za 155. "večiti derbi" počela je u petak u 11 časova, a blagajne "Marakane" će biti otvorene do 19.00. Isto tako u subotu i nedelju.\r\n\r\nUlaznice je moguće kupiti i putem sajta iticket.rs.\r\n\r\nCene su 800 dinara (sever i jug), 1.200 (istok) i 1.500 (zapad).\r\n\r\nPredstojeći derbi igra se u okviru sedmog kola Superlige. Crvena zvezda je trenutno vodeća na tabeli sa 15 bodova, dok je Partizan peti sa 12.', 800, 'Stadion Rajko Mitić', '2017-08-23 12:34:00', 'img/event/zvezda-i-partizan.jpg', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `events_social`
--

CREATE TABLE `events_social` (
  `ID` int(11) NOT NULL,
  `facebook` text COLLATE utf8mb4_unicode_520_ci,
  `twitter` text COLLATE utf8mb4_unicode_520_ci,
  `googleplus` text COLLATE utf8mb4_unicode_520_ci,
  `instagram` text COLLATE utf8mb4_unicode_520_ci,
  `youtube` text COLLATE utf8mb4_unicode_520_ci,
  `pinterest` text COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `events_social`
--

INSERT INTO `events_social` (`ID`, `facebook`, `twitter`, `googleplus`, `instagram`, `youtube`, `pinterest`) VALUES
(1, 'https://www.facebook.com/sting/', 'https://twitter.com/officialsting', ' ', 'https://www.instagram.com/theofficialsting', 'https://www.youtube.com/channel/UC9B6c09n61wgu5w6bh1v68Q', ' '),
(2, 'a', 'b', '', 'd', 'e', 'f'),
(3, 'a', 'b', 'c', 'd', 'e', 'f'),
(4, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `icon_url` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `event_id`, `icon_url`, `lat`, `lng`) VALUES
(1, 1, 'http://maps.google.com/mapfiles/ms/micons/red-dot.png', 44.813957, 20.421267),
(2, 2, 'http://maps.google.com/mapfiles/ms/micons/red-dot.png', 44.825077, 20.451771),
(3, 3, 'http://maps.google.com/mapfiles/ms/micons/blue-dot.png', 44.813248, 20.462860),
(4, 4, 'http://maps.google.com/mapfiles/ms/micons/green-dot.png', 44.783344, 20.464909);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ID` int(11) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `event_ID` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT '1',
  `comment` mediumtext COLLATE utf8mb4_unicode_520_ci,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ID`, `user_ID`, `event_ID`, `rating`, `comment`, `date`) VALUES
(1, 4, 1, 4, 'Test sa 4 zvezdice.', '2017-09-01 19:01:09'),
(4, 5, 1, 5, 'Ova je sa pet zvezdica.', '2017-09-01 19:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `user_name` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_administrator` int(1) DEFAULT '0',
  `user_activated` tinyint(1) DEFAULT '0',
  `user_confirmnum` int(11) DEFAULT NULL,
  `user_banned` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_administrator`, `user_activated`, `user_confirmnum`, `user_banned`) VALUES
(1, 'nvtest', '7815696ecbf1c96e6894b779456d330e', 'nvtest@gmail.com', '2017-08-27 18:07:04', 1, 1, 123, 0),
(2, 'emailtest', '7815696ecbf1c96e6894b779456d330e', 'nvtesta@gmail.com', '2017-08-27 19:32:58', 0, 1, 11528, 0),
(3, 'nvadmin', '2832338b7e94eaed80b8d450a3a69392', 'nvadmin@admin.com', '2017-08-30 17:12:24', 1, 1, 28915, 0),
(4, 'revtest', '2832338b7e94eaed80b8d450a3a69392', 'revtest@gmail.com', '2017-09-01 20:44:05', 0, 1, 30946, 0),
(5, 'revtest2', '2832338b7e94eaed80b8d450a3a69392', 'revtest2@gmail.com', '2017-09-01 21:54:03', 0, 1, 3093, 0),
(6, 'emailt', '2832338b7e94eaed80b8d450a3a69392', 'l2247820@mvrht.net', '2017-09-02 21:03:33', 0, 1, 17185, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_category_id` (`category_id`),
  ADD KEY `social_id` (`social_id`);

--
-- Indexes for table `events_social`
--
ALTER TABLE `events_social`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `event_ID` (`event_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `events_social`
--
ALTER TABLE `events_social`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`social_id`) REFERENCES `events_social` (`ID`),
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`ID`);

--
-- Constraints for table `markers`
--
ALTER TABLE `markers`
  ADD CONSTRAINT `markers_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`ID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`event_ID`) REFERENCES `events` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
