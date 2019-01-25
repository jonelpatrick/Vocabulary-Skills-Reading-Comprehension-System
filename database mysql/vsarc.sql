-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2019 at 06:20 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vsarc`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_address` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `email_address`, `password`, `deleted`) VALUES
(1, 'tom@gmail.com', 'admin', 0),
(2, 'teacher@gmail.com', 'teacher', 0),
(3, 'hhh@gmail.com', 'admin', 0),
(4, 'kevin@gmail.com', 'kevin', 0),
(5, 'jess@gmail.com', '123', 0),
(7, 'asd@gmail.com', '123', 0),
(8, 'jes1s@gmail.com', '123', 0),
(9, 'raybar1703@gmail.com', '123', 0),
(10, 'kol@gmail.com', 'kol', 0),
(11, 'kendra@gmail.com', 'kendra', 0),
(12, 'jenny@gmail.com', 'jenny', 0),
(13, 'vicer@gmail.com', 'vicer', 0),
(14, 'richard@gmail.com', 'richard', 0),
(15, 'jason@gmail.com', 'jason', 0),
(16, 'andrew@gmail.com', 'andrew', 0),
(17, 'heidi@gmail.com', 'heidi', 0),
(18, 'menny@gmail.com', 'menny', 0),
(19, 'ferdinand@gmail.com', 'ferdinand', 0);

-- --------------------------------------------------------

--
-- Table structure for table `activity_inferencing`
--

CREATE TABLE IF NOT EXISTS `activity_inferencing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_code` varchar(100) NOT NULL,
  `question_code` varchar(150) NOT NULL,
  `question` text NOT NULL,
  `correct` tinyint(2) NOT NULL,
  `options` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `activity_inferencing`
--

INSERT INTO `activity_inferencing` (`id`, `activity_code`, `question_code`, `question`, `correct`, `options`, `teacher_id`) VALUES
(93, 'INFLP92', 'QIN4X0', '<p>asdasda</p>', 4, 'as', 1),
(94, 'INFLP92', 'QIN4X0', '<p>asdasda</p>', 4, 'as', 1),
(95, 'INFLP92', 'QIN4X0', '<p>asdasda</p>', 4, 'as', 1),
(96, 'INFLP92', 'QIN4X0', '<p>asdasda</p>', 4, 'sd', 1),
(97, 'INFLP92', 'QIN4X96', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><br /></div>', 4, 'asd', 1),
(98, 'INFLP92', 'QIN4X96', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><br /></div>', 4, 'sd', 1),
(99, 'INFLP92', 'QIN4X96', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><br /></div>', 4, 'sd', 1),
(100, 'INFLP92', 'QIN4X96', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><br /></div>', 4, 'sd', 1),
(101, 'INFLP92', 'QIN4X100', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><br /></div>', 4, 'asd', 1),
(102, 'INFLP92', 'QIN4X100', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><br /></div>', 4, 'asd', 1),
(103, 'INFLP92', 'QIN4X100', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><br /></div>', 4, 'asd', 1),
(104, 'INFLP92', 'QIN4X100', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><br /></div>', 4, 'asd', 1),
(105, 'INFLP92', 'QIN4X104', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)-last.</p>', 2, 'wea', 1),
(106, 'INFLP92', 'QIN4X104', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)-last.</p>', 2, 'we', 1),
(107, 'INFLP92', 'QIN4X104', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)-last.</p>', 2, 'we', 1),
(108, 'INFLP92', 'QIN4X104', '<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)-last.</p>', 2, 'we', 1),
(109, 'INFLP108', 'QIN4X108', '<p>t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here,										</p>', 2, 'this sis a test23', 1),
(110, 'INFLP108', 'QIN4X108', '<p>t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here,										</p>', 2, 'this sis a test1', 1),
(111, 'INFLP108', 'QIN4X108', '<p>t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here,										</p>', 2, 'this sis a test2', 1),
(112, 'INFLP108', 'QIN4X108', '<p>t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here,										</p>', 2, 'this sis a test4', 1),
(113, 'INFLP108', 'QIN4X112', '<p>this sis a testasdasda</p>', 1, 'sd', 1),
(114, 'INFLP108', 'QIN4X112', '<p>this sis a testasdasda</p>', 1, 's23', 1),
(115, 'INFLP108', 'QIN4X112', '<p>this sis a testasdasda</p>', 1, 's3', 1),
(116, 'INFLP108', 'QIN4X112', '<p>this sis a testasdasda</p>', 1, 's1', 1),
(117, 'INFLP116', 'QIN4X116', '<p>This is a sample inf..........</p>', 3, 'option1', 4),
(118, 'INFLP116', 'QIN4X116', '<p>This is a sample inf..........</p>', 3, 'option2', 4),
(119, 'INFLP116', 'QIN4X116', '<p>This is a sample inf..........</p>', 3, 'option3', 4),
(120, 'INFLP116', 'QIN4X116', '<p>This is a sample inf..........</p>', 3, 'option4', 4);

-- --------------------------------------------------------

--
-- Table structure for table `activity_matching`
--

CREATE TABLE IF NOT EXISTS `activity_matching` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) NOT NULL,
  `type` varchar(10) NOT NULL,
  `match_answer` varchar(10) NOT NULL,
  `activity_code` varchar(20) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `activity_matching`
--

INSERT INTO `activity_matching` (`id`, `description`, `type`, `match_answer`, `activity_code`, `teacher_id`) VALUES
(40, '<p>This is a tet23</p>', 'A', '2', 'Match18X0', 1),
(41, '<p>sdasdsdsdsB</p>', 'B', '1', 'Match18X0', 1),
(42, '<p>another 1</p>', 'A', '43', 'Match18X0', 1),
(43, '<p>asdasd</p>', 'B', '42', 'Match18X0', 1),
(44, '<p>lorem ipusum</p>', 'A', '45', 'Match18X43', 1),
(45, '<p>asdasdsad</p>', 'B', '44', 'Match18X43', 1),
(46, '<p>asdasdasd</p>', 'A', '47', 'Match18X43', 1),
(47, '<p>asdasdasd</p>', 'B', '46', 'Match18X43', 1),
(48, '<p>dasdasd</p>', 'A', '49', 'Match18X43', 1),
(49, '<p>asdasdasd</p>', 'B', '48', 'Match18X43', 1),
(54, '<p>sdfsdfsd</p>', 'A', '55', 'Match18X53', 1),
(55, '<p>sdfsdfsdf</p>', 'B', '54', 'Match18X53', 1),
(56, '<p>this is a test</p>', 'A', '57', 'Match18X0', 1),
(57, '<p>tyes</p>', 'B', '56', 'Match18X0', 1),
(58, '<p>Philippine Flag color</p>', 'A', '59', 'Match18X0', 1),
(59, '<p>Red,Blue,White,Yellow</p>', 'B', '58', 'Match18X0', 1),
(60, '<p>Lorem ipsum lorem&nbsp;</p>', 'A', '61', 'Match18X59', 4),
(61, '<p>lorem ipsum</p>', 'B', '60', 'Match18X59', 4),
(62, '<p>Animals</p>', 'A', '63', 'Match18X59', 4),
(63, '<p>Horse</p>', 'B', '62', 'Match18X59', 4),
(64, '<p>Name</p>', 'A', '65', 'Match18X59', 4),
(65, '<p>Cleo</p>', 'B', '64', 'Match18X59', 4),
(66, '<p>House</p>', 'A', '67', 'Match18X59', 4),
(67, '<p>Lot</p>', 'B', '66', 'Match18X59', 4),
(68, '<p>Flat screen TV</p>', 'A', '69', 'Match18X67', 4),
(69, '<p>Technology</p>', 'B', '68', 'Match18X67', 4),
(70, '<p>Fruits</p>', 'A', '71', 'Match18X67', 4),
(71, '<p>Orange</p>', 'B', '70', 'Match18X67', 4),
(72, '<p>Car</p>', 'A', '73', 'Match18X67', 4),
(73, '<p>Ferrari</p>', 'B', '72', 'Match18X67', 4),
(74, '<p>Wearable</p>', 'A', '75', 'Match18X67', 4),
(75, '<p>Eyeglass</p>', 'B', '74', 'Match18X67', 4),
(76, '<p>Water</p>', 'A', '77', 'Match18X67', 4),
(77, '<p>NatureSpring</p>', 'B', '76', 'Match18X67', 4);

-- --------------------------------------------------------

--
-- Table structure for table `activity_sequence`
--

CREATE TABLE IF NOT EXISTS `activity_sequence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_code` varchar(100) NOT NULL,
  `question` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `activity_sequence`
--

INSERT INTO `activity_sequence` (`id`, `activity_code`, `question`, `teacher_id`) VALUES
(1, 'SeqN18Y0', 'question questionasdasdas', 1),
(2, 'SeqN18Y1', '<p>another type of sequencing question #2</p>', 1),
(3, 'SeqN18Y2', '<p>This is a type of sequencing , please order it in order</p>', 1),
(4, 'SeqN18Y3', '<p>content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versi', 4);

-- --------------------------------------------------------

--
-- Table structure for table `activity_sequencing_step`
--

CREATE TABLE IF NOT EXISTS `activity_sequencing_step` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(150) NOT NULL,
  `activity_sequence_id` int(11) NOT NULL,
  `step` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `activity_sequencing_step`
--

INSERT INTO `activity_sequencing_step` (`id`, `file_name`, `activity_sequence_id`, `step`) VALUES
(1, 'sequence2.jpg', 2, 2),
(2, 'sequence1.jpg', 2, 1),
(3, 'sequence3.jpg', 2, 3),
(4, 'sequence4.jpg', 1, 1),
(5, 'sequence5.png', 1, 2),
(6, 'Lighthouse.jpg', 3, 1),
(7, 'Koala.jpg', 3, 3),
(8, 'Penguins.jpg', 3, 4),
(9, 'Tulips.jpg', 3, 2),
(10, 'Desert.jpg', 4, 1),
(11, 'Chrysanthemum.jpg', 4, 3),
(12, 'Hydrangeas.jpg', 4, 2),
(13, 'Jellyfish.jpg', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `activity_story`
--

CREATE TABLE IF NOT EXISTS `activity_story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `activity_story`
--

INSERT INTO `activity_story` (`id`, `title`, `category`, `file_name`, `uploaded_by`, `deleted`) VALUES
(3, 'A story of Pinoccho', 'Comedy', 'pinokyo.jpg', 1, 0),
(4, 'A Train Story', 'Action', 'a train story.jpg', 1, 0),
(5, 'Story Book of Night', 'Drama', 'story book-night.jpg', 1, 0),
(6, 'A true Story', 'Bio', 'Koala.jpg', 1, 0),
(8, 'Pokemon Story', 'Adventure', 'pokemon story.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `activity_story_pages`
--

CREATE TABLE IF NOT EXISTS `activity_story_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_story_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `activity_story_pages`
--

INSERT INTO `activity_story_pages` (`id`, `activity_story_id`, `file_name`) VALUES
(3, 3, '4449445675_cb91537b21.jpg'),
(5, 3, 'scab23.jpg'),
(6, 3, 'scanned2.jpg'),
(7, 3, 'scanned4.jpg'),
(8, 3, 'svcan23.jpg'),
(9, 4, '341sab.jpg'),
(10, 4, '4449445675_cb91537b21.jpg'),
(11, 4, 'sca21.jpg'),
(12, 4, 'scab23.jpg'),
(13, 4, 'scanned4.jpg'),
(14, 4, 'scanned5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `activity_summarizing`
--

CREATE TABLE IF NOT EXISTS `activity_summarizing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_code` varchar(100) NOT NULL,
  `article` text NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `activity_summarizing`
--

INSERT INTO `activity_summarizing` (`id`, `activity_code`, `article`, `teacher_id`, `deleted`) VALUES
(7, 'SumR18L6', '<p>This is a summary article example # 1 abac</p>', 1, 0),
(8, 'SumR18L7', '<p>Summary Article #2</p>', 1, 0),
(9, 'SumR18L8', '<p>content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `activity_summarizing_q_a`
--

CREATE TABLE IF NOT EXISTS `activity_summarizing_q_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_summarizing_id` int(11) NOT NULL,
  `question_code` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `correct` tinyint(2) NOT NULL DEFAULT '0',
  `options` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `activity_summarizing_q_a`
--

INSERT INTO `activity_summarizing_q_a` (`id`, `activity_summarizing_id`, `question_code`, `question`, `correct`, `options`) VALUES
(10, 1, 'CODEsum52G9', '<p>qweqweqwdad</p>', 4, 'wewew1'),
(11, 1, 'CODEsum52G9', '<p>qweqweqwdad</p>', 4, 'wewew22'),
(12, 1, 'CODEsum52G9', '<p>qweqweqwdad</p>', 4, 'wewe3'),
(13, 1, 'CODEsum52G9', '<p>qweqweqwdad</p>', 4, 'ssadas'),
(14, 1, 'CODEsum52G13', '<p>				yyjyjyjyjy						</p>', 1, 'g1'),
(15, 1, 'CODEsum52G13', '<p>				yyjyjyjyjy						</p>', 1, 'g2'),
(16, 7, 'CODEsum52G15', '<p>This is a test id = 7</p>', 3, 'attt1'),
(17, 7, 'CODEsum52G15', '<p>This is a test id = 7</p>', 3, 'attt2'),
(18, 7, 'CODEsum52G15', '<p>This is a test id = 7</p>', 3, 'attt3'),
(19, 8, 'CODEsum52G18', '<p>test quetion for id = 8</p>', 2, 'babab1'),
(20, 8, 'CODEsum52G18', '<p>test quetion for id = 8</p>', 2, 'abab2'),
(21, 8, 'CODEsum52G18', '<p>test quetion for id = 8</p>', 2, 'abas'),
(22, 8, 'CODEsum52G18', '<p>test quetion for id = 8</p>', 2, 'asds'),
(23, 8, 'CODEsum52G22', '<p>test questio for id= 8 2</p>', 1, 'sdsd'),
(24, 8, 'CODEsum52G22', '<p>test questio for id= 8 2</p>', 1, 'sdsd'),
(25, 8, 'CODEsum52G22', '<p>test questio for id= 8 2</p>', 1, 'sds'),
(26, 8, 'CODEsum52G22', '<p>test questio for id= 8 2</p>', 1, 'sds'),
(27, 8, 'CODEsum52G26', '<p>asdasdasd</p>', 4, 'asdsad'),
(28, 8, 'CODEsum52G26', '<p>asdasdasd</p>', 4, 'asdas2'),
(29, 8, 'CODEsum52G26', '<p>asdasdasd</p>', 4, 'sdasd1'),
(30, 8, 'CODEsum52G26', '<p>asdasdasd</p>', 4, 'asdas');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `day` varchar(100) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `section_id`, `subject_id`, `teacher_id`, `day`, `time_from`, `time_to`, `status`, `deleted`) VALUES
(2, 4, 9, 3, 'Everyday', '18:00:00', '19:00:00', 1, 1),
(3, 4, 9, 3, 'Everyday', '18:00:00', '20:00:00', 1, 1),
(4, 2, 4, 3, 'Everyday', '16:00:00', '18:00:00', 1, 1),
(5, 2, 0, 1, 'Everyday', '16:00:00', '17:00:00', 1, 0),
(6, 4, 8, 1, 'Everyday', '16:00:00', '17:00:00', 1, 1),
(7, 4, 8, 1, 'Everyday', '16:00:00', '17:00:00', 1, 0),
(8, 1, 2, 4, 'Everyday', '18:00:00', '19:00:00', 1, 0),
(9, 1, 7, 4, 'Everyday', '13:00:00', '14:00:00', 1, 0),
(10, 4, 9, 4, 'Everyday', '14:00:00', '15:00:00', 1, 0),
(11, 5, 3, 4, 'Everyday', '10:00:00', '11:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_activity`
--

CREATE TABLE IF NOT EXISTS `class_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_type` varchar(255) NOT NULL,
  `activity_code` varchar(150) NOT NULL,
  `class_id` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `class_activity`
--

INSERT INTO `class_activity` (`id`, `activity_type`, `activity_code`, `class_id`, `deleted`) VALUES
(9, 'Matching Type', 'Match18X43', 7, 0),
(10, 'Sequencing', 'SeqN18Y1', 7, 0),
(11, 'Summarizing', 'SumR18L6', 7, 1),
(12, 'Inferencing', 'INFLP92', 7, 0),
(13, 'Sequencing', 'SeqN18Y2', 7, 1),
(14, 'Matching Type', 'Match18X43', 7, 0),
(15, 'Inferencing', 'INFLP92', 7, 0),
(16, 'Matching Type', 'Match18X59', 10, 0),
(17, 'Sequencing', 'SeqN18Y3', 10, 0),
(18, 'Matching Type', 'Match18X67', 11, 0),
(19, 'Sequencing', 'SeqN18Y3', 11, 0),
(20, 'Summarizing', 'SumR18L8', 11, 0),
(21, 'Inferencing', 'INFLP116', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_list_student`
--

CREATE TABLE IF NOT EXISTS `class_list_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `class_list_student`
--

INSERT INTO `class_list_student` (`id`, `class_id`, `student_id`, `active`, `deleted`) VALUES
(6, 7, 7, 1, 0),
(7, 7, 10, 1, 0),
(8, 7, 11, 1, 0),
(9, 7, 12, 1, 0),
(10, 7, 13, 1, 0),
(11, 7, 14, 1, 1),
(12, 7, 9, 1, 0),
(13, 10, 1, 1, 1),
(14, 10, 2, 1, 0),
(15, 8, 6, 1, 0),
(16, 8, 7, 1, 0),
(17, 8, 9, 1, 0),
(18, 8, 10, 1, 0),
(19, 8, 11, 1, 0),
(20, 11, 6, 1, 0),
(21, 11, 7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_quiz`
--

CREATE TABLE IF NOT EXISTS `class_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_type` varchar(100) NOT NULL,
  `quiz_code` varchar(100) NOT NULL,
  `class_id` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `class_quiz`
--

INSERT INTO `class_quiz` (`id`, `quiz_type`, `quiz_code`, `class_id`, `deleted`) VALUES
(1, 'Reading Comprehension', 'Quiz8G0', 7, 1),
(2, 'Vocabulary', 'QuizVoc23', 7, 1),
(3, 'Reading Comprehension', 'Quiz8G0', 7, 1),
(4, 'Vocabulary', 'QuizVoc23', 7, 0),
(5, 'Reading Comprehension', 'Quiz8G1', 7, 0),
(6, 'Reading Comprehension', 'Quiz8G4', 11, 0),
(7, 'Vocabulary', 'QuizVoc25', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `co_account`
--

CREATE TABLE IF NOT EXISTS `co_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_address` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `co_account`
--

INSERT INTO `co_account` (`id`, `email_address`, `password`, `deleted`) VALUES
(1, 'tom@gmail.com', 'admin', 0),
(2, 'raybar1703@gmail.com', '', 0),
(3, 'raybar1703@gmail.com', '', 0),
(4, 'raybar1703@gmail.com1', 'awe', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_code` varchar(100) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `instruction` text NOT NULL,
  `subject` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `quiz_code`, `theme`, `instruction`, `subject`, `teacher_id`, `deleted`) VALUES
(1, 'Quiz8G0', 'Reading Comprehension', '<p>You will need to use the information in the passage to answer the following questions.</p>', 1, 1, 0),
(2, 'Quiz8G1', 'Reading Comprehension', '<p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum  Lorem ipsum Lorem ipsum </p>', 9, 1, 0),
(3, 'Quiz8G2', 'Reading Comprehension', '<p>You will need to use the information in the passage to answer the following questions.</p>', 4, 1, 0),
(4, 'QuizVoc23', 'Vocabulary', '<p>To change the question just click next question button. before doing the make sure you click the correct answer.</p>', 2, 1, 0),
(5, 'Quiz8G4', 'Reading Comprehension', '<p>Follow the instruction</p>', 1, 4, 0),
(6, 'QuizVoc25', 'Vocabulary', '<p>Follow the instruction or question below.</p>', 2, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_q_a`
--

CREATE TABLE IF NOT EXISTS `quiz_q_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question_code` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `correct` int(11) NOT NULL,
  `options` varchar(500) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `quiz_q_a`
--

INSERT INTO `quiz_q_a` (`id`, `quiz_id`, `question_code`, `question`, `correct`, `options`, `deleted`) VALUES
(1, 2, 'QuizQues8i0', '<p><strong>What does the passage describe?</strong></p>', 3, 'Arizona', 0),
(2, 2, 'QuizQues8i0', '<p><strong>What does the passage describe?</strong></p>', 3, 'Arizona State Flag', 0),
(3, 2, 'QuizQues8i0', '<p><strong>What does the passage describe?</strong></p>', 3, 'Stars and Stripes', 0),
(4, 2, 'QuizQues8i3', '<p><strong>What is NOT on the flag?</strong></p>', 2, 'copper', 0),
(5, 2, 'QuizQues8i3', '<p><strong>What is NOT on the flag?</strong></p>', 2, 'star', 0),
(6, 2, 'QuizQues8i3', '<p><strong>What is NOT on the flag?</strong></p>', 2, 'yellow and red rays', 0),
(7, 2, 'QuizQues8i6', '<p><strong>Where is the Star on the Flag?</strong></p>', 1, 'in the upper half', 0),
(8, 2, 'QuizQues8i6', '<p><strong>Where is the Star on the Flag?</strong></p>', 1, 'middle', 0),
(9, 2, 'QuizQues8i6', '<p><strong>Where is the Star on the Flag?</strong></p>', 1, 'lower half', 0),
(10, 2, 'QuizQues8i6', '<p><strong>Where is the Star on the Flag?</strong></p>', 1, 'side left half', 0),
(15, 2, 'QuizQues8i14', '<p><strong>What is the purpose of having the star on the flag?</strong></p>', 2, 'symbolizes Arizona''s many stars', 0),
(16, 2, 'QuizQues8i14', '<p><strong>What is the purpose of having the star on the flag?</strong></p>', 2, 'symbolic of the rising star', 0),
(17, 2, 'QuizQues8i14', '<p><strong>What is the purpose of having the star on the flag?</strong></p>', 2, 'symbolic of Arizona''s copper industry', 0),
(18, 2, 'QuizQues8i14', '<p><strong>What is the purpose of having the star on the flag?</strong></p>', 2, 'all of the above', 0),
(19, 2, 'QuizQues8i18', '<p><strong>How many rays are on the flag?</strong></p>', 2, '12', 0),
(20, 2, 'QuizQues8i18', '<p><strong>How many rays are on the flag?</strong></p>', 2, '13', 0),
(21, 2, 'QuizQues8i18', '<p><strong>How many rays are on the flag?</strong></p>', 2, '7', 0),
(22, 2, 'QuizQues8i18', '<p><strong>How many rays are on the flag?</strong></p>', 2, '5', 0),
(23, 2, 'QuizQues8i22', '<p><strong>What is the color blue on the Arizona flag compared to?</strong></p>', 2, 'American Flag', 0),
(24, 2, 'QuizQues8i22', '<p><strong>What is the color blue on the Arizona flag compared to?</strong></p>', 2, 'Stars', 0),
(25, 2, 'QuizQues8i22', '<p><strong>What is the color blue on the Arizona flag compared to?</strong></p>', 2, 'Stripes', 0),
(26, 2, 'QuizQues8i25', '<p><strong>Why are there red and yellow rays on the Arizona Flag?</strong></p>', 2, ' to make it pretty', 0),
(27, 2, 'QuizQues8i25', '<p><strong>Why are there red and yellow rays on the Arizona Flag?</strong></p>', 2, 'to show a setting sun', 0),
(28, 2, 'QuizQues8i25', '<p><strong>Why are there red and yellow rays on the Arizona Flag?</strong></p>', 2, ' to emphasize the star', 0),
(29, 2, 'QuizQues8i28', '<p><strong>When did the flag become official?</strong></p>', 3, '1917', 0),
(30, 2, 'QuizQues8i28', '<p><strong>When did the flag become official?</strong></p>', 3, '1927', 0),
(31, 2, 'QuizQues8i28', '<p><strong>When did the flag become official?</strong></p>', 3, '1937', 0),
(36, 4, 'QuizQuesVoc31', '<p>Sample question here</p>', 2, 'ans1', 0),
(37, 4, 'QuizQuesVoc31', '<p>Sample question here</p>', 2, 'ans2', 0),
(38, 4, 'QuizQuesVoc31', '<p>Sample question here</p>', 2, 'ans3', 0),
(39, 4, 'QuizQuesVoc31', '<p>Sample question here</p>', 2, 'ans4', 0),
(44, 4, 'QuizQuesVoc39', '<p>SAmple question #3</p>', 1, 'option1', 0),
(45, 4, 'QuizQuesVoc39', '<p>SAmple question #3</p>', 1, 'option2', 0),
(46, 4, 'QuizQuesVoc39', '<p>SAmple question #3</p>', 1, 'option3', 0),
(47, 4, 'QuizQuesVoc39', '<p>SAmple question #3</p>', 1, 'option4', 0),
(48, 5, 'QuizQues8i47', '<p>What sweet food made by bees using nectar from flowers?										</p>', 1, 'Honey', 0),
(49, 5, 'QuizQues8i47', '<p>What sweet food made by bees using nectar from flowers?										</p>', 1, 'Cheddar', 0),
(50, 5, 'QuizQues8i47', '<p>What sweet food made by bees using nectar from flowers?										</p>', 1, 'Margarine', 0),
(51, 5, 'QuizQues8i47', '<p>What sweet food made by bees using nectar from flowers?										</p>', 1, 'Tamarine', 0),
(52, 5, 'QuizQues8i51', '<p>Name the school that Harry Potter attended?</p>', 4, 'Jane', 0),
(53, 5, 'QuizQues8i51', '<p>Name the school that Harry Potter attended?</p>', 4, 'Johnson', 0),
(54, 5, 'QuizQues8i51', '<p>Name the school that Harry Potter attended?</p>', 4, 'Doe', 0),
(55, 5, 'QuizQues8i51', '<p>Name the school that Harry Potter attended?</p>', 4, 'Hogwarts', 0),
(56, 5, 'QuizQues8i55', '<p>Which country is home to the kangaroo?</p>', 2, 'Philippines', 0),
(57, 5, 'QuizQues8i55', '<p>Which country is home to the kangaroo?</p>', 2, 'Australia', 0),
(58, 5, 'QuizQues8i55', '<p>Which country is home to the kangaroo?</p>', 2, 'Mascow', 0),
(59, 5, 'QuizQues8i55', '<p>Which country is home to the kangaroo?</p>', 2, 'USA', 0),
(60, 5, 'QuizQues8i59', '<p>Which country sent an Armada to attack Britain in 1588?</p>', 3, 'Philippines', 0),
(61, 5, 'QuizQues8i59', '<p>Which country sent an Armada to attack Britain in 1588?</p>', 3, 'Davao', 0),
(62, 5, 'QuizQues8i59', '<p>Which country sent an Armada to attack Britain in 1588?</p>', 3, 'Spain', 0),
(63, 5, 'QuizQues8i59', '<p>Which country sent an Armada to attack Britain in 1588?</p>', 3, 'Sri Langka', 0),
(64, 5, 'QuizQues8i63', '<p>Saint Patrick is the Patron Saint of which country?</p>', 3, 'USA', 0),
(65, 5, 'QuizQues8i63', '<p>Saint Patrick is the Patron Saint of which country?</p>', 3, 'Russia', 0),
(66, 5, 'QuizQues8i63', '<p>Saint Patrick is the Patron Saint of which country?</p>', 3, 'Ireland', 0),
(67, 5, 'QuizQues8i63', '<p>Saint Patrick is the Patron Saint of which country?</p>', 3, 'China', 0),
(68, 6, 'QuizQuesVoc67', '<p>&nbsp;From what tree do acorns come?</p>', 2, 'Hola', 0),
(69, 6, 'QuizQuesVoc67', '<p>&nbsp;From what tree do acorns come?</p>', 2, 'Oak', 0),
(70, 6, 'QuizQuesVoc67', '<p>&nbsp;From what tree do acorns come?</p>', 2, 'Hawe', 0),
(71, 6, 'QuizQuesVoc67', '<p>&nbsp;From what tree do acorns come?</p>', 2, 'Kilo', 0),
(72, 6, 'QuizQuesVoc71', '<p>What is the top colour in a rainbow?</p>', 2, 'Blue', 0),
(73, 6, 'QuizQuesVoc71', '<p>What is the top colour in a rainbow?</p>', 2, 'Red', 0),
(74, 6, 'QuizQuesVoc71', '<p>What is the top colour in a rainbow?</p>', 2, 'Black', 0),
(75, 6, 'QuizQuesVoc71', '<p>What is the top colour in a rainbow?</p>', 2, 'Orange', 0),
(76, 6, 'QuizQuesVoc75', '<p>In the nursery rhyme, who sat on a wall before having a great fall?</p>', 1, 'Humpy Dumpy', 0),
(77, 6, 'QuizQuesVoc75', '<p>In the nursery rhyme, who sat on a wall before having a great fall?</p>', 1, 'LOL', 0),
(78, 6, 'QuizQuesVoc75', '<p>In the nursery rhyme, who sat on a wall before having a great fall?</p>', 1, 'jump', 0),
(79, 6, 'QuizQuesVoc75', '<p>In the nursery rhyme, who sat on a wall before having a great fall?</p>', 1, 'Jar', 0),
(80, 6, 'QuizQuesVoc79', '<p>Which big country is closest to New Zealand?</p>', 2, 'Japan', 0),
(81, 6, 'QuizQuesVoc79', '<p>Which big country is closest to New Zealand?</p>', 2, 'Australia', 0),
(82, 6, 'QuizQuesVoc79', '<p>Which big country is closest to New Zealand?</p>', 2, 'Russia', 0),
(83, 6, 'QuizQuesVoc79', '<p>Which big country is closest to New Zealand?</p>', 2, 'England', 0);

-- --------------------------------------------------------

--
-- Table structure for table `school_coordinator`
--

CREATE TABLE IF NOT EXISTS `school_coordinator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `co_account_id` int(11) NOT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `sex` tinyint(2) NOT NULL DEFAULT '0',
  `physical_address` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `school_coordinator`
--

INSERT INTO `school_coordinator` (`id`, `co_account_id`, `image_path`, `firstname`, `middlename`, `lastname`, `birthday`, `sex`, `physical_address`, `phone`, `active`, `deleted`) VALUES
(1, 1, 'hey_gents_article-2.png', 'Tom1', 'F', 'Tom1', '2018-09-01', 0, 'Toril City', 55512345, 1, 0),
(2, 2, NULL, 'Alvin1', 'M', 'Patrim', '2018-08-31', 0, 'Philippines\r\nPh', 2147483647, 1, 0),
(3, 3, NULL, 'aw', 'aw', 'aw', '2018-08-31', 0, 'Philippines\r\nPh', 2147483647, 0, 0),
(4, 4, NULL, 'weqwe', 'qwe', 'we', '2018-08-31', 0, 'Philippines\r\nPh', 2147483647, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `grade` int(20) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `grade`, `comment`, `deleted`) VALUES
(1, 'Galileo', 7, '', 0),
(2, 'Santan', 4, 'aw', 0),
(3, 'aw', 1, '', 1),
(4, 'Megabyte', 10, 'Grade 12 megabites section', 0),
(5, 'Aristotle', 11, 'This is a comment section', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `image_path` varchar(150) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `sex` tinyint(2) NOT NULL DEFAULT '0',
  `physical_address` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `approved` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `account_id`, `image_path`, `firstname`, `middlename`, `lastname`, `birthday`, `sex`, `physical_address`, `phone`, `approved`, `active`, `deleted`) VALUES
(1, 1, '', 'Jonel', 'L', 'Opsimar', '2018-08-30', 0, 'Somewhere Davao City', 555555123, 1, 1, 0),
(2, 4, 'pretty-boy-miner2-11.jpg', 'Kevin1', 'M', 'Kevin1', '2018-09-01', 0, 'This is a test', 5551234, 1, 1, 0),
(4, 7, '', '123', 'asd', '123', '2018-08-16', 0, 'asdad', 2312, 0, 1, 1),
(5, 8, '', 'asdas', 'we', 'we', '2018-08-03', 0, 'asdas', 23123, 1, 0, 1),
(6, 10, 'student1.jpg', 'Hef', 'M', 'Hef', '2018-10-01', 0, 'Ph', 555232, 1, 1, 0),
(7, 11, 'student5.jpg', 'Kendra', 'M', 'Kendra', '2018-10-01', 1, 'Blk 10, Lot 1 Davao City', 2147483647, 1, 1, 0),
(8, 12, 'student4.jpg', 'Jenny', 'P', 'Jenny', '2018-10-01', 1, 'Davao City', 952666665, 1, 1, 0),
(9, 13, 'student10.jpg', 'Vicer', 'L', 'Vicer', '2018-10-01', 0, 'Davao City', 952666665, 1, 1, 0),
(10, 14, 'student9.jpg', 'Richard', 'L', 'Richard', '2018-10-01', 0, 'Davao City', 952666665, 1, 1, 1),
(11, 15, 'student3.jpg', 'Jason', 'J', 'Jason', '2018-10-01', 0, 'Davao City', 2147483647, 1, 1, 0),
(12, 16, 'student8.jpg', 'Andrew', 'E', 'Andrew', '2018-10-01', 0, 'Davao City', 2147483647, 1, 1, 0),
(13, 17, 'student2.jpg', 'Heidi', 'H', 'Heidi', '2018-10-01', 0, 'Davao City', 958561245, 1, 1, 0),
(14, 18, 'student7.jpg', 'Menny', 'P', 'Menny', '2018-10-01', 0, 'Davao City', 956845127, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_score`
--

CREATE TABLE IF NOT EXISTS `student_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `test_type` varchar(150) NOT NULL,
  `test_code` varchar(150) NOT NULL,
  `No_of_items` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `date_taken` date NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `student_score`
--

INSERT INTO `student_score` (`id`, `student_id`, `test_type`, `test_code`, `No_of_items`, `score`, `date_taken`, `deleted`) VALUES
(1, 2, 'Matching', 'Match18X0', 4, 3, '2018-09-27', 0),
(2, 2, 'Matching', 'Match18X0', 4, 1, '2018-09-28', 0),
(3, 2, 'Sequencing', 'SeqN18Y0', 2, 0, '2018-09-28', 0),
(4, 2, 'Sequencing', 'SeqN18Y1', 3, 1, '2018-09-28', 0),
(5, 2, 'Summarizing', 'SumR18L7', 3, 3, '2018-09-28', 0),
(7, 2, 'Inferencing', 'INFLP92', 4, 2, '2018-09-30', 0),
(8, 2, 'Inferencing', 'INFLP108', 2, 0, '2018-09-30', 0),
(9, 2, 'Matching', 'Match18X59', 4, 4, '2018-10-01', 0),
(10, 7, 'Matching', 'Match18X43', 3, 1, '2018-10-03', 0),
(16, 7, 'Vocabulary-Quiz', 'QuizVoc23', 2, 1, '2018-10-03', 0),
(17, 7, 'Reading-Quiz', 'Quiz8G1', 8, 5, '2018-10-03', 0),
(18, 7, 'Matching', 'Match18X67', 5, 1, '2018-10-07', 0),
(19, 7, 'Sequencing', 'SeqN18Y1', 3, 1, '2018-10-07', 0),
(20, 7, 'Summarizing', 'SumR18L6', 1, 0, '2018-10-07', 0),
(21, 7, 'Inferencing', 'INFLP92', 4, 0, '2018-10-07', 0),
(22, 7, 'Reading-Quiz', 'Quiz8G4', 5, 5, '2018-10-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `deleted` tinyint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `description`, `deleted`) VALUES
(1, 'ENGLISH COMP01', 'English Comprehension Skill 01', 0),
(2, 'ENGLISH COMP02', 'English Comprehension Skill 02', 0),
(3, 'FILI01', 'Filipino & History 01', 0),
(4, 'FILI02', 'Filipino & History 02', 0),
(5, 'aw', 'aw', 1),
(6, 'awew', 'wewe', 1),
(7, 'MATH', 'Mathematics', 0),
(8, 'Math - Algebra', 'Mathematics Algebra', 0),
(9, 'Science and Technology', 'Science and Technology and daily lives', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `sex` tinyint(2) NOT NULL DEFAULT '0',
  `physical_address` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `approved` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `account_id`, `image_path`, `firstname`, `middlename`, `lastname`, `birthday`, `sex`, `physical_address`, `phone`, `approved`, `active`, `deleted`) VALUES
(1, 2, 'pretty-boy-miner.png', 'John1', 'M ', 'John1', '2018-09-01', 0, 'Toril City', 5555123, 1, 1, 0),
(2, 5, NULL, 'Jessy', 'M', 'Manta', '1991-08-23', 0, 'this is a test', 5551234, 1, 0, 0),
(3, 9, NULL, 'gg', 'gg', 'gg', '2018-08-21', 1, 'Philippines\r\nPh', 222, 0, 1, 0),
(4, 19, NULL, 'Ferdinands', 'L', 'Marcos', '1976-02-02', 0, 'Philippines\r\nPh', 95685421, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_class`
--

CREATE TABLE IF NOT EXISTS `teacher_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
