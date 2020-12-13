-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 11:42 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techvents`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `post` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(12, 'December-07-2020 15:42:30', 'Why Blockchain is Hard', 'Blockchain', 'Shreyas', 'Blockchain.jpg', '                                                                                                            The hype around blockchain is massive. To hear the blockchain hype train tell it, blockchain will now:\r\n<img src=\"https://img.icons8.com/officel/16/000000/blockchain-new-logo.png\"/>\r\n    Solve income inequality\r\n    Make all data secure forever\r\n    Make everything much more efficient and trustless\r\n    Save dying babies\r\n\r\nWhat the heck is a blockchain, anyway? And can it really do all these things? Can blockchain bring something amazing to industries as diverse as health care, finance, supply chain management and music rights?\r\n\r\nAnd doesn’t being for Bitcoin mean that you’re pro-blockchain? How can you be for Bitcoin but say anything bad about the technology behind it?\r\n\r\nIn this article, I seek to answer a lot of these questions by looking at what a blockchain is and more importantly, what it’s not.\r\nWhat is a blockchain?\r\n\r\nTo examine some of these claims, we have to        '),
(14, 'December-07-2020 11:14:29', 'Learn Blockchains by Building One', 'Blockchain', 'Shreyas', 'Blockchain.jpg', 'ou’re here because, like me, you’re psyched about the rise of Cryptocurrencies. And you want to know how Blockchains work—the fundamental technology behind them.\r\n\r\nBut understanding Blockchains isn’t easy—or at least wasn’t for me. I trudged through dense videos, followed porous tutorials, and dealt with the amplified frustration of too few examples.\r\n\r\nI like learning by doing. It forces me to deal with the subject matter at a code level, which gets it sticking. If you do the same, at the end of this guide you’ll have a functioning Blockchain with a solid grasp of how they work.\r\nBefore you get started…\r\n\r\nRemember that a blockchain is an immutable, sequential chain of records called Blocks. They can contain transactions, files or any data you like, really. But the important thing is that they’re chained together using hashes.\r\n\r\nIf you aren’t sure what a hash is, here’s an explanation.\r\n\r\nWho is this guide aimed at? You should be comfy reading and writing some basic Python, as well '),
(18, 'December-07-2020 11:18:22', 'Internet of Things (IoT) Market Ecosystem Map', 'Internet of Things', 'Shreyas', 'IoT.jpg', ' wanted to gain a better understanding of the Internet of Things market and how all of the different players fit together. I created a map for myself, hopefully you will find it useful too.\r\n\r\nSome caveats before we dive into the analysis.\r\n\r\n    This ecosystem map is not designed to be 100% comprehensive. It’s more to understand all the different spaces within IoT.\r\n    I am biased towards startups in the space.\r\n    If I am missing something tweet me @mccannatron.\r\n    This space is developing quickly so take this into consideration.\r\n\r\nObservations\r\n\r\n    There are currently more devices connected to the internet than humans, and this is predicted to continue along an upward trend. It is estimated by 2020, 26 billion “things” will be connected to the internet.\r\n    If the true vision of “Internet of things” plays out, it has the potential to transform the operations of many industries (both consumer and enterprise).\r\n    The Internet of Things is still in its very early stages. On t'),
(23, 'December-07-2020 11:21:58', 'Understanding the amazing Internet of Things (IoT) — innovation creates value.', 'Internet of Things', 'Shreyas', 'IoT.jpg', 'Many people have overlooked the Internet of Things (Iot) permeating our lives. With the term “Internet of Things” perhaps dating back as far as 1999, the idea is not new. Today however, we stand at the precipice of a new era of data connectivity that far surpasses anything we’ve seen emerge from the ubiquity of mobile devices — absolutely mind-blowing potential for consumer and enterprise innovation.\r\nWhat is IoT?\r\n\r\nWikipedia has a nice definition which explains IoT as:\r\n\r\n    the network of physical objects — devices, vehicles, buildings and other items — embedded with electronics, software, sensors, and network connectivity that enables these objects to collect and exchange data.\r\n\r\nPractically, IoT means installing micro-sensors and controllers on things to make them ‘smart,’ i.e. allowing everyday devices to communicate and share data to some sort of network. Anything that can produce data can be considered IoT, practically EVERYTHING in our natural and unnatural world: nano-techn'),
(27, 'December-07-2020 11:25:36', 'Why Is Network Security Important?', 'Network Security', 'Praveenkumar', 'Network_Secutity.jpg', 'As the internet evolves and computer networks become bigger and bigger, network security has become one of the most important factors for companies to consider. Big enterprises like Microsoft are designing and building software products that need to be protected against foreign attacks.\r\n\r\nBy increasing network security, you decrease the chance of privacy spoofing, identity or information theft and so on. Piracy is a big concern to enterprises that are victims of its effects.\r\n\r\nAnything from software, music and movies to books, games, etc. are stolen and copied because security is breached by malicious individuals.'),
(29, 'December-07-2020 11:27:25', 'Changing How Startups See Network Security', 'Network Security', 'Praveenkumar', 'Network_Secutity.jpg', 'Experience is a good teacher. However, you don’t have to wait to get your system hacked before learning a thing or two about the evils of technology. Just because you are only starting up does not mean you are prone from cyber attacks. Think about what happened to startups, some well-funded at that, when they failed to prioritize digital security.'),
(30, 'December-07-2020 11:28:18', 'How I would explain a decade of web development to a time traveler from 2007', 'Web Development', 'Praveenkumar', 'Web_Development.jpg', 'Hello friend! I hope you like this new world of ours. It’s a lot different than the world of 2007. Quick tip: if you just got a mortgage, go back and cancel it. Trust me.\r\n\r\nI’m glad that you’re still interested in computers! Today we have many more of them than we did 10 years ago, and that comes with new challenges. We wear computers on our wrists and faces, keep them in our pockets, and have them in our fridges and kettles. The cars are driving themselves pretty well, and we’ve taught programs to be better than humans at pretty much every game out there — except maybe drinking.'),
(41, 'December-07-2020 11:37:55', 'Fantasy Football + Artificial Intelligence Cheat Sheet!', 'Artificial Intelligence', 'Bob', 'AI.jpg', 'After hours and days of trial and error (and error and trial again) I feel confident enough to release the culmination of my two previous articles (part 1 & part 2) — a Machine Learning / Artificial Intelligence fantasy football 2017 cheat sheet.\r\n\r\nThe R squared scores were .84 and .78 for the top models run on QB and RB respectively!\r\n\r\nDid I lose you? Read below… and then buy my cheat sheet and let’s try this thing.'),
(42, 'December-07-2020 13:18:19', 'Web Dev in 2020!', 'Web Development', 'Bob', 'Web_Development.jpg', 'Web development is the work involved in developing a Web site for the Internet or an intranet. Web development can range from developing a simple single static page of plain text to complex Web-based Internet applications, electronic businesses, and social network services'),
(43, 'December-13-2020 14:20:24', '👌What is the IoT? Everything you need to know about the Internet of Things right now', 'Internet of Things', 'Aditya', 'download.png', '                The Internet of Things, or IoT, refers to the billions of physical devices around the world that are now connected to the internet, all collecting and sharing data. Thanks to the arrival of super-cheap computer chips and the ubiquity of wireless networks, it\'s possible to turn anything, from something as small as a pill to something as big as an aeroplane, into a part of the IoT. Connecting up all these different objects and adding sensors to them adds a level of digital intelligence to devices that would be otherwise dumb, enabling them to communicate real-time data without involving a human being. The Internet of Things is making the fabric of the world around us more smarter and more responsive, merging the digital and physical universes.             ');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creatorname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `datetime`, `name`, `creatorname`) VALUES
(11, 'December-07-2020 11:04:02', 'Blockchain', 'Shreyas'),
(12, 'December-07-2020 11:05:24', 'Artificial Intelligence', 'Shreyas'),
(13, 'December-07-2020 11:05:43', 'Web Development', 'Shreyas'),
(14, 'December-07-2020 11:05:52', 'Network Security', 'Shreyas'),
(15, 'December-07-2020 11:06:21', 'Internet of Things', 'Shreyas');

-- --------------------------------------------------------

--
-- Table structure for table `claps`
--

CREATE TABLE `claps` (
  `id` int(10) NOT NULL,
  `datetime` varchar(200) NOT NULL,
  `clapedby` int(10) NOT NULL,
  `admin_panel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claps`
--

INSERT INTO `claps` (`id`, `datetime`, `clapedby`, `admin_panel_id`) VALUES
(2, 'December-08-2020 19:12:30', 14, 42),
(12, 'December-13-2020 14:24:22', 14, 43);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `approvedby` varchar(200) NOT NULL,
  `status` varchar(5) NOT NULL,
  `admin_panel_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `approvedby`, `status`, `admin_panel_id`) VALUES
(8, 'December-07-2020 15:47:00', 'arnold', 'alp@yahoo.com', 'Great Image!!\r\nWith Great stuff.', 'Aditya', 'ON', 12),
(9, 'December-07-2020 15:49:30', 'hitesh', 'hitesh@ryt.com', '<b>Bold</b>\r\n<i>Italics</i>', 'Shreyas', 'ON', 29),
(10, 'December-07-2020 18:30:20', 'bob', 'bob@gmail.com', 'Nice Article\r\n<b>Great Stuff</b>', 'Praveenkumar', 'OFF', 41),
(11, 'December-07-2020 18:31:57', 'opinion', 'op@345', 'Agreed Completely!', 'Shreyas', 'OFF', 42),
(15, 'December-12-2020 19:19:32', 'RandomGuy 2.0', 'rdguy@234', 'I just love FPL!', 'Aditya', 'ON', 41);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `addedby` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `datetime`, `addedby`, `username`, `password`, `role`) VALUES
(13, 'December-10-2020 06:17:37', 'Aditya Kotkar', 'Akash', '$2y$10$Iztg1WwnZzK5f4G3HyZFIOFvZ5jd4sHkfuw3.JvM2lyKe6kwE/wXe', 'User'),
(14, 'December-08-2020 10:41:50', 'Shreyas', 'Aditya', '$2y$10$7ouYYKYgP1rrYg3IUFkzaeDDeiZcJvM6PnYCNmFV11rqpB4Pxm6kC', 'Admin'),
(15, 'December-10-2020 05:59:58', 'Aditya Kotkar', 'Shreyas', '$2y$10$4ynrvn0pUFEVnEz.p2Tryezvt9qcX/5NQP4cBHyv2zuITSK6HXit.', 'User'),
(16, 'December-10-2020 06:36:12', 'Aditya Kotkar', 'Bob', '$2y$10$7bQQ82715MQmmK6e1ZUQsOgSdRPbhxr72d9t0CJchnEedj3irFlF.', 'User'),
(18, 'December-12-2020 18:44:55', 'Aditya Kotkar', 'Praveen', '$2y$10$u7CVePZoi7q1aGthbDI5SO/w/bFL4uMZcHCjbdgDQtEHBkB0Of6XW', 'User'),
(19, 'December-13-2020 14:30:14', 'Aditya Kotkar', 'Srajan', '$2y$10$zPPVQQWlBNXvW0AVAkNbueFsEDh34zeApNy3iPQEA.QxUVYr8BPYW', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claps`
--
ALTER TABLE `claps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Post_id` (`admin_panel_id`),
  ADD KEY `Clapped_by` (`clapedby`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_panel_id` (`admin_panel_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panel`
--
ALTER TABLE `admin_panel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `claps`
--
ALTER TABLE `claps`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claps`
--
ALTER TABLE `claps`
  ADD CONSTRAINT `Clapped_by` FOREIGN KEY (`clapedby`) REFERENCES `registration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Post_id` FOREIGN KEY (`admin_panel_id`) REFERENCES `admin_panel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign_Key_to_admin_panel` FOREIGN KEY (`admin_panel_id`) REFERENCES `admin_panel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
