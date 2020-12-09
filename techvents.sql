-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 10:01 AM
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
(13, 'December-07-2020 11:13:42', 'WTF is The Blockchain?', 'Blockchain', 'Shreyas', 'Blockchain.jpg', 'Unless you’re hiding under the rock, I am sure you’d have heard of Bitcoins and Blockchain. After all, they are the trending and media’s favorite topics these days — the buzzwords of the year. Even the people who’ve never mined a cryptocurrency or understand how it works, are talking about it. I have more non-technical friends than technical ones. They have been bugging me for weeks to explain this new buzzword to them. I guess there are thousands out there who feel the same. And when that happens, there comes a time to write something to which everyone can point the other lost souls to — that’s the purpose of this post — written in plain english that any regular internet user understands.\r\n\r\n    By the way, I am the editor of KnowyKnowy, where I teach difficult subjects (like this one) in simple English language. Support me there?\r\n\r\nBlockchain: why do we even need something this complex?\r\n\r\n    “For every complex problem there is an answer that is clear, simple, and wrong.” — H. L. M'),
(14, 'December-07-2020 11:14:29', 'Learn Blockchains by Building One', 'Blockchain', 'Shreyas', 'Blockchain.jpg', 'ou’re here because, like me, you’re psyched about the rise of Cryptocurrencies. And you want to know how Blockchains work—the fundamental technology behind them.\r\n\r\nBut understanding Blockchains isn’t easy—or at least wasn’t for me. I trudged through dense videos, followed porous tutorials, and dealt with the amplified frustration of too few examples.\r\n\r\nI like learning by doing. It forces me to deal with the subject matter at a code level, which gets it sticking. If you do the same, at the end of this guide you’ll have a functioning Blockchain with a solid grasp of how they work.\r\nBefore you get started…\r\n\r\nRemember that a blockchain is an immutable, sequential chain of records called Blocks. They can contain transactions, files or any data you like, really. But the important thing is that they’re chained together using hashes.\r\n\r\nIf you aren’t sure what a hash is, here’s an explanation.\r\n\r\nWho is this guide aimed at? You should be comfy reading and writing some basic Python, as well '),
(15, 'December-07-2020 11:15:12', 'Blockchain is not only crappy technology but a bad vision for the future', 'Blockchain', 'Shreyas', 'Blockchain.jpg', 'Blockchain is not only crappy technology but a bad vision for the future. Its failure to achieve adoption to date is because systems built on trust, norms, and institutions inherently function better than the type of no-need-for-trusted-parties systems blockchain envisions. That’s permanent: no matter how much blockchain improves it is still headed in the wrong direction.\r\n\r\nThis December I wrote a widely-circulated article on the inapplicability of blockchain to any actual problem. People objected mostly not to the technology argument, but rather hoped that decentralization could produce integrity.\r\n\r\nLet’s start with this: Venmo is a free service to transfer dollars, and bitcoin transfers are not free. Yet after I wrote an article last December saying bitcoin had no use, someone responded that Venmo and Paypal are raking in consumers’ money and people should switch to bitcoin.\r\n\r\nWhat a surreal contrast between blockchain’s non-usefulness/non-adoption and the conviction of its believ'),
(16, 'December-07-2020 11:15:54', 'Ten years in, nobody has come up with a use for blockchain', 'Blockchain', 'Shreyas', 'Blockchain.jpg', 'veryone says the blockchain, the technology underpinning cryptocurrencies such as bitcoin, is going to change EVERYTHING. And yet, after years of tireless effort and billions of dollars invested, nobody has actually come up with a use for the blockchain—besides currency speculation and illegal transactions.\r\n\r\nEach purported use case — from payments to legal documents, from escrow to voting systems—amounts to a set of contortions to add a distributed, encrypted, anonymous ledger where none was needed. What if there isn’t actually any use for a distributed ledger at all? What if, ten years after it was invented, the reason nobody has adopted a distributed ledger at scale is because nobody wants it?\r\nPayments and banking\r\n\r\nThe original intended use of the blockchain was to power currencies like bitcoin — a way to store and exchange value much like any other currency. Visa and MasterCard were dinosaurs, everyone proclaimed, because there was now a costless, instant way to exchange value '),
(17, 'December-07-2020 11:17:19', 'We already know blockchain’s killer apps', 'Blockchain', 'Shreyas', 'Blockchain.jpg', 'It wasn’t too long ago that Silicon Valley scoffed at cryptocurrencies. All over coffee shops in Mountain View and Menlo Park, you heard the same conversation: “Sure, it’s cool technology, but when are we going to see the killer app”?\r\n\r\nA few merchants dipped their toes into accepting Bitcoin in 2014. But adoption largely backed off. I remember seeing a few Bitcoin ATMs in Austin, and then they disappeared. Bitcoin reneged on its promise to replace cash, so most venture capitalists assumed it was dead on arrival. Without a killer app driving consumer adoption, cryptocurrencies seemed like they would be nothing more than a curiosity for cryptographers and paranoids.\r\n\r\nIn the last year, interest in cryptocurrencies has skyrocketed. The public cryptocurrency market cap has surged to highs of over $170B. With over 1.5B raised through ICOs in 2017, over 70 crypto exchanges open for business, and crypto hedge funds and VCs popping up left and right, it seems that everyone is clambering to '),
(18, 'December-07-2020 11:18:22', 'Internet of Things (IoT) Market Ecosystem Map', 'Internet of Things', 'Shreyas', 'IoT.jpg', ' wanted to gain a better understanding of the Internet of Things market and how all of the different players fit together. I created a map for myself, hopefully you will find it useful too.\r\n\r\nSome caveats before we dive into the analysis.\r\n\r\n    This ecosystem map is not designed to be 100% comprehensive. It’s more to understand all the different spaces within IoT.\r\n    I am biased towards startups in the space.\r\n    If I am missing something tweet me @mccannatron.\r\n    This space is developing quickly so take this into consideration.\r\n\r\nObservations\r\n\r\n    There are currently more devices connected to the internet than humans, and this is predicted to continue along an upward trend. It is estimated by 2020, 26 billion “things” will be connected to the internet.\r\n    If the true vision of “Internet of things” plays out, it has the potential to transform the operations of many industries (both consumer and enterprise).\r\n    The Internet of Things is still in its very early stages. On t'),
(19, 'December-07-2020 11:19:21', 'How New Long-Range Radios Will Change the Internet of Things', 'Internet of Things', 'Shreyas', 'IoT.jpg', 'This post is about a new radio technology.\r\n\r\nNo, hang on, keep reading — I promise it’s interesting. These radios are really significant for IoT, especially industrial sensors.\r\n\r\nDespite that, most people don’t know about them. Maybe it’s because the radios are so new, or maybe it’s because everything written about them is so technical.\r\n\r\nHere’s my attempt at an introduction for the rest of us.\r\nMiles of Range, Years of Battery Life\r\n\r\nRadios drain batteries.\r\n\r\nBy definition, in fact, radios radiate energy into space. The more energy they use to transmit, the further their signal will travel.\r\n\r\nSo device developers have traditionally faced a tradeoff between range and battery life. You can build a Bluetooth sensor that lasts for years on a battery, but you’ll only get 30 feet of range. Or you can build a cellular sensor with fantastic range, but you’ll need to recharge it every week.\r\nImage for post'),
(20, 'December-07-2020 11:20:02', 'The Glaring Flaws We Need to Fix in the Internet of Things', 'Internet of Things', 'Shreyas', 'IoT.jpg', 'The Internet of Things arrived with a bang a few years ago, and it feels like we haven’t quite recovered. Everyday appliances are Bluetooth and Wi-Fi-enabled by default, even when you don’t need them to be. (Smart shoes that lose the ability to lace up when the connected app goes down, anybody?) Many of these devices work no better than their offline alternatives, and you effectively give manufacturers carte blanche to eavesdrop on your usage habits when you buy them. And if you do buy a connected device, you can rest assured it won’t work perfectly forever.\r\n\r\nThere are countless examples of banal “smart” devices gone horribly wrong. Mattel built an internet-connected Barbie doll that was used by hackers to spy on children and say awful things. Nest cameras and thermostats have been used in domestic abuse cases. Simple software updates can go horribly wrong, bricking your thermostat or removing features you rely on.'),
(21, 'December-07-2020 11:20:50', 'Lessons learned from evaluating IOTA on Internet of Things devices', 'Internet of Things', 'Shreyas', 'IoT.jpg', 'There are few openly available quantitative results about IOTA. Motivated by this fact, we experimented with IOTA on two different IoT devices and two modern desktop and server computers. We found that despite the theoretical scalability of the Tangle, the actual IOTA protocol has relatively high energy consumption. The Proof-of-Work and transaction signing operations are computationally complex relative to the limited capabilities of many IoT devices and and may be impractical on energy-limited / battery-powered devices.\r\n\r\nNote: this article uses results from the research paper Distributed Ledger Technology and the Internet of Things: A Feasibility Study, presented in the 1st Workshop on Blockchain-enabled Networked Sensor Systems (BlockSys).'),
(22, 'December-07-2020 11:21:25', 'Designing the Internet of Things', 'Internet of Things', 'Shreyas', 'IoT.jpg', 'It’s both exciting and surreal. Exciting because of the potential to create intelligent environments. And surreal because many people still don’t know what IoT is, what it means, and why it’s important to them. And it’s this very mystery of IoT that should guide the next wave of IoT experiences.\r\n\r\nAs IoT continues to enter the mainstream, it needs to elevate beyond the technology, beyond the novelty of simply being connected. The value of IoT products needs to be clearly understood by consumers and seamlessly adapted to their lives.\r\n\r\nThis is the challenge that all IoT products and/or experiences will need to solve, and why traditional UX/UI designers will play a key role in IoT’s continued evolution. As a developer of UI’s for almost 20 years now, I’ve recently begun shifting my focus towards IoT, beginning to craft some ideas around general design principles.'),
(23, 'December-07-2020 11:21:58', 'Understanding the amazing Internet of Things (IoT) — innovation creates value.', 'Internet of Things', 'Shreyas', 'IoT.jpg', 'Many people have overlooked the Internet of Things (Iot) permeating our lives. With the term “Internet of Things” perhaps dating back as far as 1999, the idea is not new. Today however, we stand at the precipice of a new era of data connectivity that far surpasses anything we’ve seen emerge from the ubiquity of mobile devices — absolutely mind-blowing potential for consumer and enterprise innovation.\r\nWhat is IoT?\r\n\r\nWikipedia has a nice definition which explains IoT as:\r\n\r\n    the network of physical objects — devices, vehicles, buildings and other items — embedded with electronics, software, sensors, and network connectivity that enables these objects to collect and exchange data.\r\n\r\nPractically, IoT means installing micro-sensors and controllers on things to make them ‘smart,’ i.e. allowing everyday devices to communicate and share data to some sort of network. Anything that can produce data can be considered IoT, practically EVERYTHING in our natural and unnatural world: nano-techn'),
(24, 'December-07-2020 11:23:36', 'SpyPi: A Rugged, Portable Hacking Station for Teaching Network Security', 'Network Security', 'Praveenkumar', 'Network_Secutity.jpg', 'The station, called “SpyPi,” is built on a Raspberry Pi, and contains a number of programs and scripts that take advantage of simple security holes in networks. It has a network scanner for sniffing out information about nearby networks, and hacking tools like bruteforce dictionary attacks and login data catching.\r\n\r\nAnother interesting feature is a Twitter analyzer, for mining information about a given Twitter user. It sifts through the user’s tweets to find whatever it can, such as the user’s interests and things they talk about often. The purpose is twofold: to show how much personal information we put out publicly, and to point out the fact that this information can be used for nefarious purposes.'),
(25, 'December-07-2020 11:24:26', 'Crash Course Network Security', 'Network Security', 'Praveenkumar', 'Network_Secutity.jpg', 'In order to understand how fundamental networking technology influences security, we must first gain a solid understanding of how our Internet works.\r\n\r\nThe Internet is a network of interconnected machines, passing messages (via “packets”) to and from each other to communicate.\r\n\r\nI intend to dive into different aspects of computer networking in the future, but today, let’s get a brief overview of what network security is, and the components of networking technology that influences security the most.\r\nWhat does network security mean?\r\n\r\nA network is secure when it can ensure the authentication, confidentiality, integrity, and availability of the communication happening on the network.\r\n\r\nFirst, secure communication on the network means secure authentication. All sides of the communication need to be able to ensure the identity of who they are communicating with.'),
(26, 'December-07-2020 11:25:04', 'Ushering In The Future Of Cloud Network Security With Valtix', 'Network Security', 'Praveenkumar', 'Network_Secutity.jpg', 'We learned through conversations with many F500 companies that current firewalls weren’t sufficient protection against content-based attacks, particularly for encrypted traffic (e.g., SSL). Despite some cloud vendors offering point-solutions, there were no platforms that (1) met performance requirements, (2) were easily managed, and (3) could span local networks and multi-cloud environments. CISOs repeatedly pointed out performance and orchestration as key friction points slowing down cloud deployments.\r\n\r\nHeretofore, enterprises adopting the public cloud had no choice but to implement brittle security technology that (1) involved stitching together disparate vendors, (2) interacting with multiple management systems, and (3) suffered from unpredictable and high latency routing through various hardware and software components. Despite this friction, a recent Gartner survey of public cloud users, showed 81 percent of respondents are working with two or more cloud providers. As organizati'),
(27, 'December-07-2020 11:25:36', 'Why Is Network Security Important?', 'Network Security', 'Praveenkumar', 'Network_Secutity.jpg', 'As the internet evolves and computer networks become bigger and bigger, network security has become one of the most important factors for companies to consider. Big enterprises like Microsoft are designing and building software products that need to be protected against foreign attacks.\r\n\r\nBy increasing network security, you decrease the chance of privacy spoofing, identity or information theft and so on. Piracy is a big concern to enterprises that are victims of its effects.\r\n\r\nAnything from software, music and movies to books, games, etc. are stolen and copied because security is breached by malicious individuals.'),
(28, 'December-07-2020 11:26:24', 'Waves launch at exchanges and network security.', 'Network Security', 'Praveenkumar', 'Network_Secutity.jpg', 'We are preparing for the Waves launch at exchanges now. Some more time is needed for integration: the network is still young and we need to streamline certain elements of the process.\r\n\r\nWe recognise the importance of the token being traded on the open markets — both to gauge interest in the project and to allow a greater number of early investors to become a part of the Waves ecosystem. However, we will always need to find a balance between development speed and network security. We cannot risk people’s money to meet the demand from solely profit-driven traders who want to sell their tokens as soon as they can.\r\n\r\nI am writing this on the day of probably biggest debacle in crypto since the collapse of MtGox. The DAO has been hacked and millions of ETH in investors’ funds are now at stake. This is acutely relevant to our own situation. Blockchain systems are decentralised, but they are coded by humans, and humans are prone to errors. When you invest in a blockchain system you should al'),
(29, 'December-07-2020 11:27:25', 'Changing How Startups See Network Security', 'Network Security', 'Praveenkumar', 'Network_Secutity.jpg', 'Experience is a good teacher. However, you don’t have to wait to get your system hacked before learning a thing or two about the evils of technology. Just because you are only starting up does not mean you are prone from cyber attacks. Think about what happened to startups, some well-funded at that, when they failed to prioritize digital security.'),
(30, 'December-07-2020 11:28:18', 'How I would explain a decade of web development to a time traveler from 2007', 'Web Development', 'Praveenkumar', 'Web_Development.jpg', 'Hello friend! I hope you like this new world of ours. It’s a lot different than the world of 2007. Quick tip: if you just got a mortgage, go back and cancel it. Trust me.\r\n\r\nI’m glad that you’re still interested in computers! Today we have many more of them than we did 10 years ago, and that comes with new challenges. We wear computers on our wrists and faces, keep them in our pockets, and have them in our fridges and kettles. The cars are driving themselves pretty well, and we’ve taught programs to be better than humans at pretty much every game out there — except maybe drinking.'),
(31, 'December-07-2020 11:28:59', 'The Ultimate Guide to Learning Full Stack Web Development in 6 months, for $30', 'Web Development', 'Praveenkumar', 'Web_Development.jpg', 'Hey everyone! In this article I’m going to show you how to go from knowing little to nothing about Web Development to Junior Full Stack Developer in just six months, for under $30.\r\n\r\nThis article will cover everything you need to know! You’ll first learn the basics of Web Development with an online coding bootcamp ($15). You’ll follow that up with an advanced bootcamp ($15). Then, we’ll jump into free tutorials, articles, and documentation where you will reinforce everything you’ve learned in the first two bootcamps. Next, you’ll build a few projects with your new skills and open-source them on GitHub. Finally, we’ll focus on resume creation, interview preparation, and salary negotiation.'),
(32, 'December-07-2020 11:29:43', 'Increase your web development skill-set: 150 animated tips on Chrome DevTools', 'Web Development', 'Praveenkumar', 'Web_Development.jpg', 'I’ve published over 150 animated gifs which showcase how to use Chrome DevTools — as part of my Dev Tips newsletter. For most tips, you can fully grasp the feature in less than 30 seconds. I also provide a text based alternative if you want to read more about it.'),
(33, 'December-07-2020 11:30:54', 'Micro frontends—a microservice approach to front-end web development', 'Web Development', 'Praveenkumar', 'Web_Development.jpg', '                                    For web apps, the front end is becoming bigger and bigger, and the back end is getting less important. Our web app at Weld (web/app creation tool) is 90% front-end code, with a very thin back end. I can imagine that a majority of new web apps being built today are dealing with a similar situation.\r\n\r\nWeb apps also change over time, as do development techniques and frameworks. This requires support for allowing different front-end frameworks to co-exist, e.g. older modules built in JQuery or AngularJS 1.x, combined with newer modules built in React or Vue.                                '),
(34, 'December-07-2020 11:30:40', 'Angular vs. React: Which Is Better for Web Development?', 'Web Development', 'Praveenkumar', 'Web_Development.jpg', 'In this article, you will learn how Angular and React both aim to solve similar front-end problems though with very different philosophies, and whether choosing one or the other is merely a matter of personal preference. To compare them, we will build the same application twice, once with Angular and then again with React.'),
(35, 'December-07-2020 11:31:32', '8 top must-use tools to boost your web development workflow', 'Web Development', 'Praveenkumar', 'Web_Development.jpg', 'As developers, before we deploy our applications or even before we choose our cloud provider, we should consider which tools we use for our day-to-day internal workflow. The tools included in our toolbox can either boost our productivity dramatically or turn our web development project extremely complex and difficult to maintain or scale up by recruiting more team members.\r\n\r\nA major part of growing ourselves from being junior developers into senior developers involves adaptation of tools that simplifying our task management process, making communication with other team members seamless and building integrations between the tools we use so they work together in harmony to create a perfect stack that works best for you and for your team.'),
(36, 'December-07-2020 11:33:54', 'Artificial Intelligence ! What is it actually ?', 'Artificial Intelligence', 'Bob', 'AI.jpg', 'Artificial Intelligence or AI as we call it has become a new buzz word in today’s world. It has become a phenomenon which attracts many and leaves many mesmerized with its astonishing accomplishments. On one hand people are awestruck with the major feats such as self-driving cars, alpha-go (which has handsomely beaten the world GO champion 4–1 ), autonomous machines, landing of Falcon 9 , and, on the other some are equally scared by the rise of machines against humans. The concern of AI ruling humans is not only amongst non-scientific community, but, is equally shared by some of the stalwarts like Elon Musk and Prof. Stephen Hawkins.\r\n\r\nWith an increase in acceptance of machine learning, data science and AI in the society, this post is an attempt to understand what AI actually is, how it’s being used in various fields in the society and what are some common myths attached to it.'),
(37, 'December-07-2020 11:35:07', '‘I want to learn Artificial Intelligence and Machine Learning. Where can I start?’', 'Artificial Intelligence', 'Bob', 'AI.jpg', 'I was working at the Apple Store and I wanted a change. To start building the tech I was servicing.\r\n\r\nI began looking into Machine Learning (ML) and Artificial Intelligence (AI).\r\n\r\nThere’s so much going on. Too much.\r\n\r\nEvery week it seems like Google or Facebook are releasing a new kind of AI to make things faster or improve our experience.\r\n\r\nAnd don’t get me started on the number of self-driving car companies. This is a good thing though. I’m not a fan of driving and roads are dangerous.\r\n\r\nEven with all this happening, there’s still yet to be an agreed definition of what exactly artificial intelligence is.\r\n\r\nSome argue deep learning can be considered AI, others will say it’s not AI unless it passes the Turing Test.'),
(38, 'December-07-2020 11:35:41', 'Creating Flutter Application Integrated With Artificial Intelligence', 'Artificial Intelligence', 'Bob', 'AI.jpg', 'The rapid growth of digitization has successfully paved the way for emerging technologies that lead to better user experience. We are into the fast-paced life cycle where users want everything at the super-fast speed, especially when it comes to accessing the mobile applications.\r\n\r\nSome survey reports have discovered that the users uninstall 77% of the apps in just three days after downloading. The studies have revealed that the average speed of apps is not as per the expectation level of the users, and this is one of the major reasons for abandoning the application.\r\n\r\nUndoubtedly developing a mobile app has become an urgent need of an hour for businesses. Still, they often overlook the fact that how to succeed in a cut-throat competitive market where already 5 million applications are available in various business domains.'),
(39, 'December-07-2020 11:36:27', 'Artificial Intelligence vs. Machine Learning vs. Deep Learning: What’s the Difference', 'Artificial Intelligence', 'Bob', 'AI.jpg', 'Let’s clear things up: artificial intelligence (AI), machine learning (ML), and deep learning (DL) are three different things.\r\n\r\n    Artificial intelligence is a science like mathematics or biology. It studies ways to build intelligent programs and machines that can creatively solve problems, which has always been considered a human prerogative.\r\n    Machine learning is a subset of artificial intelligence (AI) that provides systems the ability to automatically learn and improve from experience without being explicitly programmed. In ML, there are different algorithms (e.g. neural networks) that help to solve problems.\r\n    Deep learning, or deep neural learning, is a subset of machine learning, which uses the neural networks to analyze different factors with a structure that is similar to the human neural system.\r\n\r\nImage for post'),
(40, 'December-07-2020 11:38:19', 'Top 7 FREE Artificial Intelligence Courses from the Ivy League Universities', 'Web Development', 'Bob', 'AI.jpg', '                                    These days it feels like every week comes with a new AI course. With such volume, we need to be really selective with our time, energy and focus. A simple but effective strategy is to attend the courses from the best minds in the field.\r\n\r\n    Use your time effectively and attend the courses from the best minds in the field.\r\n\r\nWith the help of my fellow Data Scientists, we curated a list of the top 7 Artificial Intelligence courses from the Ivy League Universities. The course had to be free to be included in the list.\r\n\r\nI haven’t attended all the courses on the list but I got high praise from my colleagues. Next on my course list, I wish to attend is the Reinforcement Learning course.                                '),
(41, 'December-07-2020 11:37:55', 'Fantasy Football + Artificial Intelligence Cheat Sheet!', 'Artificial Intelligence', 'Bob', 'AI.jpg', 'After hours and days of trial and error (and error and trial again) I feel confident enough to release the culmination of my two previous articles (part 1 & part 2) — a Machine Learning / Artificial Intelligence fantasy football 2017 cheat sheet.\r\n\r\nThe R squared scores were .84 and .78 for the top models run on QB and RB respectively!\r\n\r\nDid I lose you? Read below… and then buy my cheat sheet and let’s try this thing.'),
(42, 'December-07-2020 13:18:19', 'Web Dev in 2020!', 'Web Development', 'Bob', 'Web_Development.jpg', 'Web development is the work involved in developing a Web site for the Internet or an intranet. Web development can range from developing a simple single static page of plain text to complex Web-based Internet applications, electronic businesses, and social network services'),
(43, 'December-09-2020 00:59:13', 'What is the IoT? Everything you need to know about the Internet of Things right now', 'Internet of Things', 'Akash', 'IoT.jpg', 'The Internet of Things, or IoT, refers to the billions of physical devices around the world that are now connected to the internet, all collecting and sharing data. Thanks to the arrival of super-cheap computer chips and the ubiquity of wireless networks, it\'s possible to turn anything, from something as small as a pill to something as big as an aeroplane, into a part of the IoT. Connecting up all these different objects and adding sensors to them adds a level of digital intelligence to devices that would be otherwise dumb, enabling them to communicate real-time data without involving a human being. The Internet of Things is making the fabric of the world around us more smarter and more responsive, merging the digital and physical universes. ');

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
(1, 'December-08-2020 18:42:45', 14, 39),
(2, 'December-08-2020 19:12:30', 14, 42),
(3, 'December-08-2020 19:33:31', 15, 28);

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
(8, 'December-07-2020 15:47:00', 'arnold', 'alp@yahoo.com', 'Great Image!!\r\nWith Great stuff.', 'Pooja', 'OFF', 12),
(9, 'December-07-2020 15:49:30', 'hitesh', 'hitesh@ryt.com', '<b>Bold</b>\r\n<i>Italics</i>', 'Shreyas', 'ON', 29),
(10, 'December-07-2020 18:30:20', 'bob', 'bob@gmail.com', 'Nice Article\r\n<b>Great Stuff</b>', 'Praveenkumar', 'ON', 41),
(11, 'December-07-2020 18:31:57', 'opinion', 'op@345', 'Agreed Completely!', 'Shreyas', 'ON', 42),
(12, 'December-07-2020 20:57:05', 'ko', 'lp@fg.com', '<i>Tammy Abraham</i>\r\n<b>Bob</b>\r\n<img src=\"https://img.icons8.com/emoji/48/000000/-emoji-christmas-tree.png\"/>', 'Shreyas', 'ON', 40);

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
(13, 'December-08-2020 11:34:12', 'Aditya Kotkar', 'Akash', '$2y$10$q272wNl2sFtu8DESoVqvFOQnUWcajRI4a8obY3U/QATkfm.yBxtR6', 'User'),
(14, 'December-08-2020 10:41:50', 'Shreyas', 'Aditya', '$2y$10$7ouYYKYgP1rrYg3IUFkzaeDDeiZcJvM6PnYCNmFV11rqpB4Pxm6kC', 'Admin'),
(15, 'December-08-2020 19:31:32', 'Aditya Kotkar', 'Shreyas', '$2y$10$TYRYwZOlw5w2IgHC2t/fyu73LCHVGyq26yeFCGWYq1fYgFpyRnH5S', 'User');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `claps`
--
ALTER TABLE `claps`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
