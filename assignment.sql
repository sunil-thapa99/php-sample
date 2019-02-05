-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2018 at 05:23 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`user_id` int(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pNumber` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `account_type` varchar(25) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `fname`, `lname`, `uname`, `password`, `email`, `pNumber`, `gender`, `account_type`) VALUES
(1, 'Sunil', 'Thapa', 'admin', '$2y$10$K1mE0JJYMc/vDW1l8WzJXuR/Hf.fGSXoeBFCs8CeiPr.rXtMLUdD6', 'sunil43thapa@gmail.com', '9808656340', 'male', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`cate_id` int(10) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cate_id`, `category_title`) VALUES
(1, 'Sports'),
(2, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `commenttable`
--

CREATE TABLE IF NOT EXISTS `commenttable` (
`comment_id` int(10) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `commentPublishDate` date NOT NULL,
  `newsId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `publish` varchar(5) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commenttable`
--

INSERT INTO `commenttable` (`comment_id`, `comment`, `commentPublishDate`, `newsId`, `userId`, `publish`) VALUES
(2, 'Sterling on 13 goals!!!', '2017-12-29', 4, 1, 'yes'),
(3, 'On 150 million.', '2017-12-29', 1, 1, 'yes'),
(4, 'Countinho will improve himself', '2017-12-29', 1, 1, 'yes'),
(5, 'Sterling has jersey number 7 and plays for Manchester City.', '2017-12-30', 4, 1, 'yes'),
(12, 'Sterling is very good at what he does.', '2018-01-12', 4, 1, 'yes'),
(13, 'Facebook is good.', '2018-01-12', 2, 6, 'yes'),
(15, 'I love facebook.', '2018-01-12', 2, 6, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `imagedatabase`
--

CREATE TABLE IF NOT EXISTS `imagedatabase` (
`imageId` int(10) NOT NULL,
  `imageFilePath` varchar(230) NOT NULL,
  `newsId` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagedatabase`
--

INSERT INTO `imagedatabase` (`imageId`, `imageFilePath`, `newsId`) VALUES
(3, 'images/newsImage/Sterling.jpg', 4),
(5, 'images/newsImage/coutinho.jpg', 1),
(12, 'images/newsImage/fb.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nestedcommentstoretable`
--

CREATE TABLE IF NOT EXISTS `nestedcommentstoretable` (
`nestedComment_id` int(10) NOT NULL,
  `replyCmt` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `cmt_id` int(10) NOT NULL,
  `news_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nestedcommentstoretable`
--

INSERT INTO `nestedcommentstoretable` (`nestedComment_id`, `replyCmt`, `user_id`, `cmt_id`, `news_id`) VALUES
(2, 'hyy', 1, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`news_id` int(10) NOT NULL,
  `newsTitle` varchar(255) NOT NULL,
  `articleAuthor` varchar(123) NOT NULL,
  `articleContent` varchar(2550) NOT NULL,
  `articlePostDate` date NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `newsTitle`, `articleAuthor`, `articleContent`, `articlePostDate`, `category_id`) VALUES
(1, 'Countiho To Barca', 'Ian Doyle', '										Liverpool''s Philippe Coutinho has been told he won''t regret moving to Barcelona in a latest blatant attempt by the Catalans to persuade the player to again agitate for a transfer.\r\n\r\nCoutinho has been in excellent form for the Reds in December, scoring seven goals and providing five assists for Jurgen Klopp''s side.					', '2017-12-27', 1),
(2, 'Facebook modifies the way it alerts users to fake news', 'Selena Larson', '		It is ditching the red icon indicating fake news known as the "disputed flag" and will instead show Related Articles next to hoax posts in the News Feed, the company announced on Thursday. Facebook says Related Articles will give people more context about a story, including what information in the story is false. If someone tries to share a fake news story, they will get a popup notifying them of additional reporting from fact checkers. Those articles will also appear next to fake news before someone clicks on the link on Facebook (FB).	', '2017-12-27', 2),
(4, 'RAHEEM: CITY FOCUSED ON POINTS NOT RECORDS', 'Neil Leigh', '										Sterling''s 30th minute strike made it 18 successive Premier League wins for Pep Guardiola''s side and helped the Blues go 15 points clear at the top of the table. \r\n\r\nThe latest victory also moved City to within one win of equaling Bayern Munich''s all-time record of 19 straight league triumphs. \r\n\r\nBut Raheem insisted City''s sole focus was on performance and consistency rather than securing a place in the record books.  \r\n				', '2017-12-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `normalusertable`
--

CREATE TABLE IF NOT EXISTS `normalusertable` (
`user_id` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pNumber` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `account_type` varchar(25) NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `normalusertable`
--

INSERT INTO `normalusertable` (`user_id`, `fname`, `lname`, `uname`, `password`, `email`, `pNumber`, `gender`, `account_type`) VALUES
(1, 'Sunil', 'Thapa', 'sunil43thapa', '$2y$10$F1aYfhjLYPD55yom9O7uJOiHEploPxlIloM1OJIXnp2WWhuGkL0vC', 'sunil43thapa@gmail.com', '9860740002', 'male', 'normal'),
(6, 'Pratigya', 'Dhunagana', 'pratigyaDhungana', '$2y$10$005AhqtwxMH7lkFy0amef.Lw1UTNAOkqoitjafNPM12p2hShlbJam', 'pratigya_dhungana@gmail.com', '9876123454', 'female', 'normal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`cate_id`), ADD KEY `cate_id` (`cate_id`);

--
-- Indexes for table `commenttable`
--
ALTER TABLE `commenttable`
 ADD PRIMARY KEY (`comment_id`), ADD KEY `newsId` (`newsId`), ADD KEY `userId` (`userId`), ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `imagedatabase`
--
ALTER TABLE `imagedatabase`
 ADD PRIMARY KEY (`imageId`), ADD KEY `newsId` (`newsId`);

--
-- Indexes for table `nestedcommentstoretable`
--
ALTER TABLE `nestedcommentstoretable`
 ADD PRIMARY KEY (`nestedComment_id`), ADD KEY `cmt_id` (`cmt_id`), ADD KEY `user_id` (`user_id`), ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`news_id`), ADD KEY `category_id` (`category_id`), ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `normalusertable`
--
ALTER TABLE `normalusertable`
 ADD PRIMARY KEY (`user_id`), ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `cate_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `commenttable`
--
ALTER TABLE `commenttable`
MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `imagedatabase`
--
ALTER TABLE `imagedatabase`
MODIFY `imageId` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `nestedcommentstoretable`
--
ALTER TABLE `nestedcommentstoretable`
MODIFY `nestedComment_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `news_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `normalusertable`
--
ALTER TABLE `normalusertable`
MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `commenttable`
--
ALTER TABLE `commenttable`
ADD CONSTRAINT `commentNewsId` FOREIGN KEY (`newsId`) REFERENCES `news` (`news_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `userCommentId` FOREIGN KEY (`userId`) REFERENCES `normalusertable` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imagedatabase`
--
ALTER TABLE `imagedatabase`
ADD CONSTRAINT `newsImageId` FOREIGN KEY (`newsId`) REFERENCES `news` (`news_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nestedcommentstoretable`
--
ALTER TABLE `nestedcommentstoretable`
ADD CONSTRAINT `nestedCmtId` FOREIGN KEY (`cmt_id`) REFERENCES `commenttable` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nestedUserId` FOREIGN KEY (`user_id`) REFERENCES `normalusertable` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `newsCmtId` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
ADD CONSTRAINT `categoryId` FOREIGN KEY (`category_id`) REFERENCES `categories` (`cate_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
