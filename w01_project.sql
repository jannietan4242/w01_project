-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2020 at 04:32 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `w01_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(8) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `created_date`, `modified_date`, `is_deleted`) VALUES
(1, 'konfar', 'konfartrading@gmail.com', 'konfar', '2020-07-21 21:58:29', '2020-08-13 04:07:02', 1),
(2, 'Tan Jing Yi', 'tanjingyi94@gmail.com', '123', '2020-08-11 15:42:36', '2020-08-13 03:47:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(8) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `url`, `photo`, `is_deleted`, `created_date`, `modified_date`) VALUES
(1, 'The Haunted House', 'list.php', './uploads/20200802165818.jpg', 0, '2020-07-31 06:20:15', '2020-08-02 17:05:02'),
(2, 'Escape Room', '', './uploads/banner2.jpg', 0, '2020-07-31 07:05:48', '2020-07-31 07:08:46'),
(3, 'Our branches', '', './uploads/banner3.jpg', 0, '2020-07-31 07:05:58', '2020-07-31 07:09:00'),
(4, 'banner', '', './uploads/20200731081839.jpg', 1, '2020-07-31 08:18:39', '2020-07-31 08:19:07'),
(5, 'test', '', './uploads/20200731082027.jpg', 1, '2020-07-31 08:20:27', '2020-08-02 16:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(8) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_of_person` int(8) NOT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_slot` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `name`, `mobile`, `email`, `num_of_person`, `note`, `game_title`, `time_slot`, `date`, `is_deleted`, `created_date`, `modified_date`) VALUES
(20, 'Tan Jing Yi', '0167447827', 'tanjingyi94@gmail.com', 5, 'testing 2', 'Bar Murder', '17:40 - 18:00 ', '2020-08-12', 0, '2020-08-07 04:28:37', NULL),
(21, 'Tan Jing Yi', '0167447827', 'tanjingyi94@gmail.com', 2, 'abc', 'Judgement Day', '19:00 - 19:45 ', '2020-08-25', 0, '2020-08-07 10:33:45', NULL),
(22, 'Tan Jing Yi', '0167447827', 'tanjingyi94@gmail.com', 2, 'cc', 'Death Genius', '21:40 - 22:00 ', '2020-08-24', 1, '2020-08-07 10:54:28', '2020-08-13 03:45:47'),
(23, 'Tan Jing Yi', '0167447827', 'tanjingyi94@gmail.com', 2, '', 'Silence', '03:10 - 03:55 ', '2020-08-20', 1, '2020-08-07 11:23:57', '2020-08-13 03:45:49'),
(24, 'Alex', '0167447827', 'tanjingyi94@gmail.com', 1, '', 'Silence', '02:05 - 02:50 ', '2020-08-12', 1, '2020-08-07 11:25:34', '2020-08-13 03:45:52'),
(25, 'Tan Jing Yi', '0167447827', 'tanjingyi94@gmail.com', 2, '', 'Death Genius', '21:40 - 22:00 ', '2020-08-05', 0, '2020-08-07 12:01:44', '2020-08-11 16:05:49'),
(26, 'Tan Jing Yi', '0167447827', 'tanjingyi94@gmail.com', 2, '', 'Silence', '03:10 - 03:55 ', '2020-08-13', 0, '2020-08-08 04:55:57', NULL),
(27, 'Tan Jing Yi', '0167447827', 'tanjingyi94@gmail.com', 2, '', 'Bar Murder', '18:20 - 18:40 ', '2020-08-12', 0, '2020-08-08 05:05:06', NULL),
(28, 'Tan Jing Yi', '0167447827', 'tanjingyi94@gmail.com', 3, '', 'Death Genius', '21:40 - 22:00 ', '2020-08-12', 0, '2020-08-08 05:11:05', NULL),
(29, 'Tom', '0167447827', 'tanjingyi94@gmail.com', 2, '0814', 'Death Genius', '20:00 - 20:20 ', '2020-08-13', 1, '2020-08-11 10:34:55', '2020-08-11 16:01:44'),
(30, 'Max', '0167447827', 'tanjingyi94@gmail.com', 2, '0814', 'Death Genius', '20:00 - 20:20 ', '2020-08-12', 0, '2020-08-11 10:35:01', NULL),
(31, 'Brian', '0167447827', 'tanjingyi94@gmail.com', 2, '0814', 'Death Genius', '20:00 - 20:20 ', '2020-08-11', 0, '2020-08-11 10:35:05', NULL),
(32, 'Tan Jing Yi', '0167447827', 'tanjingyi94@gmail.com', 3, 'sdasd', 'Silence', '01:00 - 01:45 ', '2020-08-13', 0, '2020-08-11 11:09:12', NULL),
(33, 'Joe', '14974857', 'w-virgo@hotmail.com', 7, 'abcd', 'Death Genius', '22:30 - 22:50 ', '2020-08-26', 0, '2020-08-11 15:44:41', NULL),
(34, 'Jannie', '12345', 'tanjingyi94@gmail.com', 6, 'abcd', 'School Murder', '18:40 - 19:40 ', '2020-08-18', 0, '2020-08-13 03:43:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(8) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `venue_id` int(8) NOT NULL DEFAULT 0,
  `story` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_hide` tinyint(1) NOT NULL DEFAULT 0,
  `game_interval` int(8) DEFAULT 5,
  `game_duration` int(8) DEFAULT 5,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `min` int(3) NOT NULL DEFAULT 1,
  `max` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `title`, `photo`, `venue_id`, `story`, `created_date`, `modified_date`, `is_deleted`, `is_hide`, `game_interval`, `game_duration`, `start_time`, `end_time`, `min`, `max`) VALUES
(1, 'Bar Murder', './uploads/20200802100523.jpg', 2, '<p>A scream came from of the old and famous Wonderful Bar. The bar manager who was holding on to a spare key, and the female customer Angel stood at the aisle outside the washroom, terrified at what they saw before them. A woman hung from the ceiling in one of the toilet&#39;s cubicles. The rope had stretched the woman&#39;s neck, it looked like her neck bone was already broken, her head was slightly lowered, dragging on to a separated body. This woman was the popular movie star &ndash; Rebecca.</p>\r\n\r\n<p><br />\r\nThe investigation team quickly sealed off the bar to begin their investigation and search for clues. However, from the various events surrounding the case they realised that there was something unusual. The investigation team identified 5 individuals who each seemed to have their own ulterior motives. Though this case may appear like a suicide, there might be a hidden story behind it......</p>\r\n', '2020-07-28 16:20:33', '2020-08-03 16:25:27', 0, 0, 20, 20, '17:00:00', '22:30:00', 4, 5),
(2, 'Judgement Day', './uploads/20200802100512.jpg', 3, '<p>In this city where humans have become increasingly selfish and unethical, many bizarre horror tales have begun to spread. The most horrifying tale of all is the &ldquo;Judgement Day&rdquo;.<br />\r\n<br />\r\nIt is rumoured that all criminals who have escaped punishment from the city&rsquo;s justice system will one day be &ldquo;Judged&rdquo; and punished. The criminals would disappear from the city, only for their dry corpses to be discovered later on.<br />\r\n<br />\r\nYou have always walked on the edge of the law. To you, the tale of the Judgement Day was just a far-fetched story&hellip; Until one fateful night when you&rsquo;ve had too much to drink, you woke up in a dark and unfamiliar environment. Your head was covered with a hood and your arms were tied up, even though you couldn&rsquo;t see a thing, you felt as if a pair of evil eyes were staring right at you.<br />\r\n<br />\r\nIt was at this moment, you remembered the tale of the &ldquo;Judgement Day&rdquo; ...</p>\r\n', '2020-07-28 16:36:29', '2020-08-03 16:22:22', 0, 0, 30, 45, '19:00:00', '23:00:00', 2, 3),
(3, 'Silence', './uploads/20200802100459.jpg', 3, '<p>There is an old abandoned mannequin factory in town. The place sends chills down the spine of anyone that dares go near it. The factory is even more spooky at night, and once in a while the sound of children&#39;s laughter can be heard coming out from it. You are a close group of friends who have grown up together, and this abandoned factory is where you used to play as kids.</p>\r\n\r\n<p>As years have gone by, you all have stopped going to the factory. Recently, all of you have started to get the same strange nightmare about a little girl in the factory. In the dream, the little girl is calling out for your help, pleading that you return to save her. Being troubled by the nightmares, you all have decided to go back to the factory together, and find out the truth behind these frightening dreams.</p>\r\n', '2020-07-29 16:04:55', '2020-08-03 16:25:16', 0, 0, 20, 45, '01:00:00', '06:00:00', 2, 6),
(4, 'Death Genius', './uploads/20200802100441.jpg', 2, '<p>Special offer RM9.90!<br />\r\n<br />\r\nLOST&#39;s new, exclusive creation! Online Interactive Murder Mystery Game, gameplay that you&rsquo;ve never imagined before!<br />\r\n- 90 minutes of gameplay, fully played over WeChat<br />\r\n- Gather 4 friends, you can be next to each other or far apart, it doesn&rsquo;t matter<br />\r\n- The killer is among you. The killer needs to hide his/her identity, and the rest of the players need to catch the killer!<br />\r\n- A NPC character that will interact with you throughout the game<br />\r\n- Multiple endings! What will be the result of your choices?<br />\r\n<br />\r\nHOW TO PURCHASE:<br />\r\n1. Click &ldquo;BOOK NOW&rdquo; below, and fill in your personal details in the next page<br />\r\n2. Follow the payment instructions given<br />\r\n3. Add us on WhatsApp - 018-9504385<br />\r\n4. After receiving payment, we will contact you through WhatsApp/WeChat to book your game timing and explain the game rules<br />\r\n5. When it&#39;s your game time, just come online and start playing!</p>\r\n', '2020-07-29 16:06:26', '2020-08-03 16:20:19', 0, 0, 25, 20, '20:00:00', '23:00:00', 1, 7),
(5, 'School Murder', './uploads/20200813040940.jpg', 3, '<p>&ldquo;Yesterday, a dreadful crime happened in Chi Ren Secondary School. A 17-year-old female dead body was found in the toilet. Her head was badly mangled beyond recognition, and the floor was stained with blood. A classmate of the victim claimed that she had seen the victim quarreling with her boyfriend before her death. The police have identified her boyfriend, who has gone missing, as the primary suspect. The police are currently tracking his whereabouts. The news has turned the school into a chaos. This murder will certainly cast a shadow over students in Chi Ren Secondary school. The motivation behind the murder remains a mystery&hellip;&rdquo;<br />\r\n<br />\r\nAs members of the Special Investigation Unit, you have toreturn to the crime scene and investigate the case!</p>\r\n', '2020-08-11 15:50:17', '2020-08-13 04:09:39', 0, 0, 30, 30, '15:00:00', '23:00:00', 6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` int(8) NOT NULL,
  `venue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` smallint(1) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `venue`, `is_deleted`, `created_date`, `modified_date`) VALUES
(1, 'Sutera', 1, '2020-07-28 07:29:02', '2020-07-28 07:49:57'),
(2, 'Mount Austin', 0, '2020-07-28 07:50:53', NULL),
(3, 'Sutera', 0, '2020-07-28 07:51:05', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
