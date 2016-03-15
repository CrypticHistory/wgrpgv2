-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2016 at 12:49 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbwgrpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacterabilitystats`
--

CREATE TABLE IF NOT EXISTS `tblcharacterabilitystats` (
  `intCharacterAbilityStatID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intStrength` int(11) NOT NULL DEFAULT '0',
  `intIntelligence` int(11) NOT NULL DEFAULT '0',
  `intAgility` int(11) NOT NULL DEFAULT '0',
  `intVitality` int(11) NOT NULL DEFAULT '0',
  `intWillpower` int(11) NOT NULL DEFAULT '0',
  `intDexterity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intCharacterAbilityStatID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tblcharacterabilitystats`
--

INSERT INTO `tblcharacterabilitystats` (`intCharacterAbilityStatID`, `intRPGCharacterID`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0),
(2, 2, 0, 0, 0, 0, 0, 0),
(3, 3, 0, 0, 0, 0, 0, 0),
(4, 4, 0, 0, 0, 0, 0, 0),
(5, 5, 5, 0, 0, 0, 0, 0),
(47, 48, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcharactereventxr`
--

CREATE TABLE IF NOT EXISTS `tblcharactereventxr` (
  `intCharacterEventXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `dtmDateAdded` datetime NOT NULL,
  PRIMARY KEY (`intCharacterEventXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`,`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1286 ;

--
-- Dumping data for table `tblcharactereventxr`
--

INSERT INTO `tblcharactereventxr` (`intCharacterEventXRID`, `intRPGCharacterID`, `intEventID`, `dtmDateAdded`) VALUES
(1, 1, 1, '2015-04-13 22:23:05'),
(2, 1, 1, '2015-04-13 22:23:10'),
(3, 1, 1, '2015-04-13 22:23:12'),
(4, 1, 1, '2015-04-13 22:23:15'),
(5, 1, 4, '2015-04-13 22:23:20'),
(6, 1, 1, '2015-04-13 22:23:20'),
(7, 1, 1, '2015-04-13 22:23:21'),
(8, 1, 4, '2015-04-13 22:23:24'),
(9, 1, 1, '2015-04-13 22:23:25'),
(10, 1, 1, '2015-04-13 22:23:26'),
(11, 1, 1, '2015-04-13 22:23:29'),
(12, 1, 4, '2015-04-13 22:23:35'),
(13, 1, 1, '2015-04-13 22:23:36'),
(14, 1, 1, '2015-04-13 22:23:39'),
(15, 1, 1, '2015-04-13 22:23:41'),
(16, 1, 1, '2015-04-13 22:23:41'),
(17, 1, 1, '2015-04-13 22:23:42'),
(18, 1, 1, '2015-04-13 22:23:43'),
(19, 1, 1, '2015-04-13 22:23:45'),
(20, 1, 5, '2015-04-13 22:23:51'),
(21, 1, 6, '2015-04-13 22:23:52'),
(22, 1, 3, '2015-04-13 22:24:05'),
(23, 1, 1, '2015-04-13 22:24:13'),
(24, 1, 1, '2015-04-13 22:24:14'),
(25, 1, 1, '2015-04-13 22:24:16'),
(26, 1, 1, '2015-04-13 22:24:17'),
(27, 1, 1, '2015-04-13 22:24:18'),
(28, 1, 4, '2015-04-13 22:24:21'),
(29, 1, 1, '2015-04-13 22:24:22'),
(30, 1, 4, '2015-04-13 22:24:26'),
(31, 1, 1, '2015-04-13 22:24:27'),
(32, 1, 3, '2015-04-13 22:24:38'),
(33, 1, 4, '2015-04-13 22:24:43'),
(34, 1, 1, '2015-04-13 22:24:44'),
(35, 1, 4, '2015-04-13 22:24:49'),
(36, 1, 4, '2015-04-13 22:24:52'),
(37, 1, 3, '2015-04-13 22:24:57'),
(38, 1, 4, '2015-04-13 22:25:01'),
(39, 1, 1, '2015-04-13 22:25:02'),
(40, 1, 1, '2015-04-13 22:25:03'),
(41, 1, 1, '2015-04-13 22:25:05'),
(42, 1, 1, '2015-04-13 22:25:06'),
(43, 1, 1, '2015-04-13 22:25:09'),
(44, 1, 1, '2015-04-13 22:25:10'),
(45, 1, 4, '2015-04-13 22:25:14'),
(46, 1, 1, '2015-04-13 22:25:16'),
(47, 1, 1, '2015-04-13 22:25:17'),
(48, 1, 1, '2015-04-13 22:25:18'),
(49, 1, 1, '2015-04-13 22:25:19'),
(50, 1, 1, '2015-04-13 22:25:22'),
(51, 1, 1, '2015-04-13 22:25:23'),
(52, 1, 1, '2015-04-13 22:25:23'),
(53, 1, 1, '2015-04-13 22:25:24'),
(54, 1, 1, '2015-04-13 22:25:25'),
(55, 1, 1, '2015-04-13 22:25:27'),
(56, 1, 1, '2015-04-13 22:25:28'),
(57, 1, 1, '2015-04-13 22:25:29'),
(58, 1, 1, '2015-04-13 22:25:33'),
(59, 1, 1, '2015-04-13 22:25:34'),
(60, 1, 1, '2015-04-13 22:25:35'),
(61, 1, 1, '2015-04-13 22:25:36'),
(62, 1, 4, '2015-04-13 22:25:43'),
(63, 1, 1, '2015-04-13 22:25:44'),
(64, 1, 1, '2015-04-13 22:25:45'),
(65, 1, 1, '2015-04-13 22:25:47'),
(66, 1, 1, '2015-04-13 22:25:50'),
(67, 1, 4, '2015-04-13 22:25:55'),
(68, 1, 4, '2015-04-13 22:26:01'),
(69, 1, 1, '2015-04-13 22:26:04'),
(70, 1, 1, '2015-04-13 22:26:05'),
(71, 1, 3, '2015-04-13 22:26:10'),
(72, 1, 1, '2015-04-13 22:26:11'),
(73, 1, 1, '2015-04-13 22:26:12'),
(74, 1, 1, '2015-04-13 22:26:13'),
(75, 1, 1, '2015-04-13 22:26:15'),
(76, 1, 1, '2015-04-13 22:26:19'),
(77, 1, 1, '2015-04-13 22:26:20'),
(78, 1, 1, '2015-04-13 22:26:24'),
(79, 1, 1, '2015-04-13 22:26:26'),
(80, 1, 1, '2015-04-13 22:26:29'),
(81, 1, 1, '2015-04-13 22:26:31'),
(82, 1, 1, '2015-04-13 22:26:32'),
(83, 1, 1, '2015-04-13 22:26:34'),
(84, 1, 1, '2015-04-13 22:26:35'),
(85, 1, 1, '2015-04-13 22:26:38'),
(86, 1, 1, '2015-04-13 22:26:39'),
(87, 1, 3, '2015-04-13 22:26:51'),
(88, 1, 1, '2015-04-13 22:26:58'),
(89, 1, 1, '2015-04-13 22:26:59'),
(90, 1, 1, '2015-04-13 22:27:05'),
(91, 1, 7, '2015-04-13 22:27:15'),
(92, 1, 4, '2015-04-13 22:27:19'),
(93, 1, 6, '2015-04-13 22:27:21'),
(94, 1, 4, '2015-04-13 22:27:27'),
(95, 1, 1, '2015-04-13 22:27:28'),
(96, 1, 1, '2015-04-13 22:27:29'),
(97, 1, 1, '2015-04-13 22:27:39'),
(98, 1, 4, '2015-04-13 22:27:42'),
(99, 1, 1, '2015-04-13 22:27:43'),
(100, 1, 1, '2015-04-13 22:27:44'),
(101, 1, 1, '2015-04-13 22:27:45'),
(102, 1, 1, '2015-04-13 22:27:46'),
(103, 1, 1, '2015-04-13 22:27:48'),
(104, 1, 1, '2015-04-13 22:27:50'),
(105, 1, 4, '2015-04-13 22:27:53'),
(106, 1, 1, '2015-04-13 22:27:55'),
(107, 1, 1, '2015-04-13 22:27:57'),
(108, 1, 1, '2015-04-13 22:28:01'),
(109, 1, 1, '2015-04-13 22:28:02'),
(110, 1, 4, '2015-04-13 22:28:05'),
(111, 1, 1, '2015-04-13 22:28:13'),
(112, 1, 1, '2015-04-13 22:28:15'),
(113, 1, 1, '2015-04-13 22:28:17'),
(114, 1, 1, '2015-04-13 22:28:18'),
(115, 1, 1, '2015-04-13 22:28:19'),
(116, 1, 1, '2015-04-13 22:28:20'),
(117, 1, 1, '2015-04-13 22:28:20'),
(118, 1, 3, '2015-04-13 22:28:27'),
(119, 1, 1, '2015-04-13 22:28:30'),
(120, 1, 1, '2015-04-13 22:28:32'),
(121, 1, 1, '2015-04-13 22:28:32'),
(122, 1, 4, '2015-04-13 22:28:35'),
(123, 1, 1, '2015-04-13 22:28:36'),
(124, 1, 1, '2015-04-13 22:28:37'),
(125, 1, 1, '2015-04-13 22:28:40'),
(126, 1, 1, '2015-04-13 22:28:41'),
(127, 1, 1, '2015-04-13 22:28:43'),
(128, 1, 1, '2015-04-13 22:28:46'),
(129, 1, 1, '2015-04-13 22:28:46'),
(130, 1, 1, '2015-04-13 22:28:47'),
(131, 1, 1, '2015-04-13 22:28:48'),
(132, 1, 4, '2015-04-13 22:28:51'),
(133, 1, 1, '2015-04-13 22:28:52'),
(134, 1, 3, '2015-04-13 22:29:04'),
(135, 1, 1, '2015-04-13 22:29:20'),
(136, 1, 1, '2015-04-13 22:29:22'),
(137, 1, 1, '2015-04-13 22:29:23'),
(138, 1, 4, '2015-04-13 22:29:25'),
(139, 1, 4, '2015-04-13 22:29:29'),
(140, 1, 3, '2015-04-13 22:29:39'),
(141, 1, 1, '2015-04-13 22:29:41'),
(142, 1, 4, '2015-04-13 22:29:44'),
(143, 1, 4, '2015-04-13 22:29:49'),
(144, 1, 1, '2015-04-13 22:29:50'),
(145, 1, 1, '2015-04-13 22:29:51'),
(146, 1, 4, '2015-04-13 22:29:54'),
(147, 1, 4, '2015-04-13 22:29:57'),
(148, 1, 1, '2015-04-13 22:29:58'),
(149, 1, 4, '2015-04-13 22:30:03'),
(150, 1, 4, '2015-04-13 22:30:05'),
(151, 1, 4, '2015-04-13 22:30:09'),
(152, 1, 1, '2015-04-13 22:30:10'),
(153, 1, 3, '2015-04-13 22:30:19'),
(154, 1, 6, '2015-04-13 22:30:22'),
(155, 1, 1, '2015-04-13 22:30:35'),
(156, 1, 1, '2015-04-13 22:30:37'),
(157, 1, 4, '2015-04-13 22:30:41'),
(158, 1, 1, '2015-04-13 22:30:42'),
(159, 1, 3, '2015-04-13 22:30:48'),
(160, 1, 6, '2015-04-13 22:30:51'),
(161, 1, 4, '2015-04-13 22:31:05'),
(162, 1, 1, '2015-04-13 22:31:06'),
(163, 1, 4, '2015-04-13 22:31:10'),
(164, 1, 1, '2015-04-13 22:31:13'),
(165, 1, 4, '2015-04-13 22:31:19'),
(166, 1, 1, '2015-04-13 22:31:20'),
(167, 1, 1, '2015-04-13 22:31:28'),
(168, 1, 1, '2015-04-13 22:31:29'),
(169, 1, 1, '2015-04-13 22:31:30'),
(170, 1, 4, '2015-04-13 22:31:32'),
(171, 1, 1, '2015-04-13 22:31:34'),
(172, 1, 4, '2015-04-13 22:31:37'),
(173, 1, 1, '2015-04-13 22:31:39'),
(174, 1, 1, '2015-04-13 22:31:40'),
(175, 1, 3, '2015-04-13 22:31:47'),
(176, 1, 3, '2015-04-13 22:32:03'),
(177, 1, 1, '2015-04-13 22:32:05'),
(178, 1, 4, '2015-04-13 22:32:09'),
(179, 1, 3, '2015-04-13 22:32:14'),
(180, 1, 6, '2015-04-13 22:32:16'),
(181, 1, 4, '2015-04-13 22:32:22'),
(182, 1, 1, '2015-04-13 22:32:28'),
(183, 1, 3, '2015-04-13 22:32:36'),
(184, 1, 4, '2015-04-13 22:32:42'),
(185, 1, 1, '2015-04-13 22:32:45'),
(186, 1, 1, '2015-04-13 22:32:47'),
(187, 1, 1, '2015-04-13 22:32:47'),
(188, 1, 1, '2015-04-13 22:32:50'),
(189, 1, 1, '2015-04-13 22:32:50'),
(190, 1, 4, '2015-04-13 22:32:54'),
(191, 1, 4, '2015-04-13 22:32:58'),
(192, 1, 1, '2015-04-13 22:33:01'),
(193, 1, 1, '2015-04-13 22:33:02'),
(194, 1, 1, '2015-04-13 22:33:03'),
(195, 1, 1, '2015-04-13 22:33:05'),
(196, 1, 1, '2015-04-13 22:33:06'),
(197, 1, 1, '2015-04-13 22:33:07'),
(198, 1, 3, '2015-04-13 22:33:12'),
(199, 1, 6, '2015-04-13 22:33:14'),
(200, 1, 1, '2015-04-13 22:33:26'),
(201, 1, 1, '2015-04-13 22:33:27'),
(202, 1, 4, '2015-04-13 22:33:31'),
(203, 1, 1, '2015-04-13 22:33:34'),
(204, 1, 1, '2015-04-13 22:33:34'),
(205, 1, 1, '2015-04-13 22:33:35'),
(206, 1, 1, '2015-04-13 22:33:36'),
(207, 1, 1, '2015-04-13 22:33:37'),
(208, 1, 1, '2015-04-13 22:33:38'),
(209, 1, 4, '2015-04-13 22:33:56'),
(210, 1, 4, '2015-04-13 22:33:59'),
(211, 1, 1, '2015-04-13 22:34:00'),
(212, 1, 1, '2015-04-13 22:34:02'),
(213, 1, 1, '2015-04-13 22:34:06'),
(214, 1, 1, '2015-04-13 22:34:14'),
(215, 1, 4, '2015-04-13 22:34:18'),
(216, 1, 1, '2015-04-13 22:34:19'),
(217, 1, 1, '2015-04-13 22:34:20'),
(218, 1, 1, '2015-04-13 22:34:23'),
(219, 1, 1, '2015-04-13 22:34:27'),
(220, 1, 1, '2015-04-13 22:34:30'),
(221, 1, 1, '2015-04-13 22:34:34'),
(222, 1, 1, '2015-04-13 22:34:35'),
(223, 1, 1, '2015-04-13 22:34:36'),
(224, 1, 4, '2015-04-13 22:34:40'),
(225, 1, 1, '2015-04-13 22:34:41'),
(226, 1, 1, '2015-04-13 22:34:42'),
(227, 1, 1, '2015-04-13 22:34:44'),
(228, 1, 4, '2015-04-13 22:34:49'),
(229, 1, 1, '2015-04-13 22:35:00'),
(230, 1, 3, '2015-04-13 22:35:05'),
(231, 1, 6, '2015-04-13 22:35:06'),
(232, 1, 1, '2015-04-13 22:35:13'),
(233, 1, 1, '2015-04-13 22:35:16'),
(234, 1, 1, '2015-04-13 22:35:17'),
(235, 1, 1, '2015-04-13 22:35:21'),
(236, 1, 1, '2015-04-13 22:35:22'),
(237, 1, 1, '2015-04-13 22:35:23'),
(238, 1, 4, '2015-04-13 22:35:26'),
(239, 1, 1, '2015-04-13 22:35:28'),
(240, 1, 1, '2015-04-13 22:35:29'),
(241, 1, 1, '2015-04-13 22:35:30'),
(242, 1, 1, '2015-04-13 22:35:31'),
(243, 1, 1, '2015-04-13 22:35:32'),
(244, 1, 1, '2015-04-13 22:35:32'),
(245, 1, 1, '2015-04-13 22:35:36'),
(246, 1, 1, '2015-04-13 22:35:37'),
(247, 1, 1, '2015-04-13 22:35:45'),
(248, 1, 1, '2015-04-13 22:35:47'),
(249, 1, 4, '2015-04-13 22:35:50'),
(250, 1, 1, '2015-04-13 22:35:58'),
(251, 1, 1, '2015-04-13 22:35:59'),
(252, 1, 1, '2015-04-13 22:36:02'),
(253, 1, 4, '2015-04-13 22:36:05'),
(254, 1, 1, '2015-04-13 22:36:07'),
(255, 1, 1, '2015-04-13 22:36:10'),
(256, 1, 1, '2015-04-13 22:36:11'),
(257, 1, 1, '2015-04-13 22:36:16'),
(258, 1, 1, '2015-04-13 22:36:17'),
(259, 1, 4, '2015-04-13 22:36:29'),
(260, 1, 1, '2015-04-13 22:36:31'),
(261, 1, 1, '2015-04-13 22:36:34'),
(262, 1, 1, '2015-04-13 22:36:36'),
(263, 1, 1, '2015-04-13 22:36:38'),
(264, 1, 1, '2015-04-13 22:36:40'),
(265, 1, 1, '2015-04-13 22:36:42'),
(266, 1, 1, '2015-04-13 22:36:42'),
(267, 1, 4, '2015-04-13 22:36:46'),
(268, 1, 4, '2015-04-13 22:36:51'),
(269, 1, 4, '2015-04-13 22:36:54'),
(270, 1, 4, '2015-04-13 22:37:06'),
(271, 1, 1, '2015-04-13 22:37:11'),
(272, 1, 1, '2015-04-13 22:37:12'),
(273, 1, 1, '2015-04-13 22:37:13'),
(274, 1, 1, '2015-04-13 22:37:14'),
(275, 1, 1, '2015-04-13 22:37:15'),
(276, 1, 3, '2015-04-13 22:37:23'),
(277, 1, 1, '2015-04-13 22:37:24'),
(278, 1, 4, '2015-04-13 22:37:29'),
(279, 1, 1, '2015-04-13 22:37:31'),
(280, 1, 1, '2015-04-13 22:37:40'),
(281, 1, 1, '2015-04-13 22:37:41'),
(282, 1, 1, '2015-04-13 22:37:43'),
(283, 1, 1, '2015-04-13 22:37:45'),
(284, 1, 1, '2015-04-13 22:37:46'),
(285, 1, 1, '2015-04-13 22:37:47'),
(286, 1, 4, '2015-04-13 22:37:51'),
(287, 1, 4, '2015-04-13 22:37:54'),
(288, 1, 1, '2015-04-13 22:37:55'),
(289, 1, 1, '2015-04-13 22:37:57'),
(290, 1, 4, '2015-04-13 22:38:01'),
(291, 1, 1, '2015-04-13 22:38:05'),
(292, 1, 4, '2015-04-13 22:38:09'),
(293, 1, 4, '2015-04-13 22:38:12'),
(294, 1, 4, '2015-04-13 22:38:15'),
(295, 1, 4, '2015-04-13 22:38:23'),
(296, 1, 1, '2015-04-13 22:38:30'),
(297, 1, 1, '2015-04-13 22:38:37'),
(298, 1, 4, '2015-04-13 22:38:41'),
(299, 1, 1, '2015-04-13 22:38:42'),
(300, 1, 1, '2015-04-13 22:38:44'),
(301, 1, 1, '2015-04-13 22:38:45'),
(302, 1, 4, '2015-04-13 22:38:48'),
(303, 1, 1, '2015-04-13 22:38:50'),
(304, 1, 1, '2015-04-13 22:38:50'),
(305, 1, 4, '2015-04-13 22:38:53'),
(306, 1, 1, '2015-04-13 22:38:55'),
(307, 1, 1, '2015-04-13 22:38:57'),
(308, 1, 1, '2015-04-13 22:38:58'),
(309, 1, 1, '2015-04-13 22:39:00'),
(310, 1, 1, '2015-04-13 22:39:04'),
(311, 1, 1, '2015-04-13 22:39:05'),
(312, 1, 1, '2015-04-13 22:39:07'),
(313, 1, 1, '2015-04-13 22:39:09'),
(314, 1, 1, '2015-04-13 22:39:11'),
(315, 1, 1, '2015-04-13 22:39:15'),
(316, 1, 4, '2015-04-13 22:39:20'),
(317, 1, 1, '2015-04-13 22:39:22'),
(318, 1, 1, '2015-04-13 22:39:25'),
(319, 1, 1, '2015-04-13 22:39:26'),
(320, 1, 1, '2015-04-13 22:39:26'),
(321, 1, 1, '2015-04-13 22:39:27'),
(322, 1, 1, '2015-04-13 22:39:29'),
(323, 1, 1, '2015-04-13 22:39:30'),
(324, 1, 4, '2015-04-13 22:39:34'),
(325, 1, 1, '2015-04-13 22:39:35'),
(326, 1, 1, '2015-04-13 22:39:36'),
(327, 1, 1, '2015-04-13 22:39:37'),
(328, 1, 1, '2015-04-13 22:39:38'),
(329, 1, 1, '2015-04-13 22:39:40'),
(330, 1, 4, '2015-04-13 22:39:45'),
(331, 1, 1, '2015-04-13 22:39:46'),
(332, 1, 1, '2015-04-13 22:39:50'),
(333, 1, 1, '2015-04-13 22:39:52'),
(334, 1, 1, '2015-04-13 22:39:53'),
(335, 1, 1, '2015-04-13 22:39:54'),
(336, 1, 1, '2015-04-13 22:39:59'),
(337, 1, 1, '2015-04-13 22:40:01'),
(338, 1, 1, '2015-04-13 22:40:02'),
(339, 1, 1, '2015-04-13 22:40:08'),
(340, 1, 4, '2015-04-13 22:40:11'),
(341, 1, 1, '2015-04-13 22:40:12'),
(342, 1, 4, '2015-04-13 22:40:17'),
(343, 1, 1, '2015-04-13 22:40:19'),
(344, 1, 4, '2015-04-13 22:40:22'),
(345, 1, 1, '2015-04-13 22:40:23'),
(346, 1, 1, '2015-04-13 22:40:25'),
(347, 1, 1, '2015-04-13 22:40:25'),
(348, 1, 1, '2015-04-13 22:40:27'),
(349, 1, 1, '2015-04-13 22:40:28'),
(350, 1, 1, '2015-04-13 22:40:29'),
(351, 1, 1, '2015-04-13 22:40:31'),
(352, 1, 4, '2015-04-13 22:40:34'),
(353, 1, 1, '2015-04-13 22:40:35'),
(354, 1, 1, '2015-04-13 22:40:37'),
(355, 1, 1, '2015-04-13 22:40:38'),
(356, 1, 1, '2015-04-13 22:40:40'),
(357, 1, 4, '2015-04-13 22:40:45'),
(358, 1, 1, '2015-04-13 22:40:47'),
(359, 1, 1, '2015-04-13 22:40:48'),
(360, 1, 1, '2015-04-13 22:40:49'),
(361, 1, 4, '2015-04-13 22:40:59'),
(362, 1, 1, '2015-04-13 22:41:00'),
(363, 1, 1, '2015-04-13 22:41:03'),
(364, 1, 4, '2015-04-13 22:41:07'),
(365, 1, 1, '2015-04-13 22:41:07'),
(366, 1, 1, '2015-04-13 22:41:08'),
(367, 1, 4, '2015-04-13 22:41:12'),
(368, 1, 1, '2015-04-13 22:41:14'),
(369, 1, 4, '2015-04-13 22:41:20'),
(370, 1, 1, '2015-04-13 22:41:21'),
(371, 1, 4, '2015-04-13 22:41:25'),
(372, 1, 4, '2015-04-13 22:41:29'),
(373, 1, 3, '2015-04-13 22:41:34'),
(374, 1, 4, '2015-04-13 22:41:37'),
(375, 1, 1, '2015-04-13 22:41:38'),
(376, 1, 1, '2015-04-13 22:41:39'),
(377, 1, 4, '2015-04-13 22:41:41'),
(378, 1, 1, '2015-04-13 22:41:42'),
(379, 1, 1, '2015-04-13 22:41:43'),
(380, 1, 1, '2015-04-13 22:41:44'),
(381, 1, 1, '2015-04-13 22:41:45'),
(382, 1, 1, '2015-04-13 22:41:48'),
(383, 1, 1, '2015-04-13 22:41:50'),
(384, 1, 3, '2015-04-13 22:41:55'),
(385, 1, 3, '2015-04-13 22:41:59'),
(386, 1, 3, '2015-04-13 22:42:05'),
(387, 1, 1, '2015-04-13 22:42:06'),
(388, 1, 1, '2015-04-13 22:42:07'),
(389, 1, 1, '2015-04-13 22:42:10'),
(390, 1, 3, '2015-04-13 22:42:14'),
(391, 1, 3, '2015-04-13 22:42:19'),
(392, 1, 4, '2015-04-13 22:42:23'),
(393, 1, 1, '2015-04-13 22:42:25'),
(394, 1, 4, '2015-04-13 22:42:29'),
(395, 1, 1, '2015-04-13 22:42:30'),
(396, 1, 4, '2015-04-13 22:42:36'),
(397, 1, 1, '2015-04-13 22:42:37'),
(398, 1, 4, '2015-04-13 22:42:40'),
(399, 1, 1, '2015-04-13 22:42:46'),
(400, 1, 1, '2015-04-13 22:42:48'),
(401, 1, 1, '2015-04-13 22:42:50'),
(402, 1, 4, '2015-04-13 22:42:53'),
(403, 1, 1, '2015-04-13 22:42:55'),
(404, 1, 3, '2015-04-13 22:43:01'),
(405, 1, 1, '2015-04-13 22:43:04'),
(406, 1, 1, '2015-04-13 22:43:06'),
(407, 1, 1, '2015-04-13 22:43:06'),
(408, 1, 4, '2015-04-13 22:43:09'),
(409, 1, 4, '2015-04-13 22:43:13'),
(410, 1, 1, '2015-04-13 22:43:15'),
(411, 1, 1, '2015-04-13 22:43:16'),
(412, 1, 1, '2015-04-13 22:43:18'),
(413, 1, 1, '2015-04-13 22:43:23'),
(414, 1, 3, '2015-04-13 22:43:29'),
(415, 2, 1, '2015-04-14 16:15:51'),
(416, 2, 1, '2015-04-14 16:15:53'),
(417, 2, 4, '2015-04-14 16:15:56'),
(418, 2, 1, '2015-04-14 16:15:57'),
(419, 2, 7, '2015-04-14 16:16:04'),
(420, 2, 3, '2015-04-14 16:16:08'),
(421, 2, 3, '2015-04-14 16:16:14'),
(422, 2, 1, '2015-04-14 16:16:19'),
(423, 2, 4, '2015-04-14 16:16:21'),
(424, 2, 3, '2015-04-14 16:16:25'),
(425, 2, 4, '2015-04-14 16:16:28'),
(426, 2, 4, '2015-04-14 16:16:32'),
(427, 2, 1, '2015-04-14 16:16:33'),
(428, 2, 1, '2015-04-14 16:16:36'),
(429, 2, 1, '2015-04-14 16:16:37'),
(430, 2, 1, '2015-04-14 16:16:39'),
(431, 2, 1, '2015-04-14 16:16:43'),
(432, 2, 4, '2015-04-14 16:16:46'),
(433, 2, 4, '2015-04-14 16:16:50'),
(434, 2, 3, '2015-04-14 16:16:55'),
(435, 2, 1, '2015-04-14 16:16:57'),
(436, 2, 1, '2015-04-14 16:16:58'),
(437, 2, 4, '2015-04-14 16:17:00'),
(438, 2, 1, '2015-04-14 16:17:01'),
(439, 2, 3, '2015-04-14 16:17:06'),
(440, 2, 1, '2015-04-14 16:17:07'),
(441, 2, 1, '2015-04-14 16:17:08'),
(442, 2, 1, '2015-04-14 16:17:08'),
(443, 2, 1, '2015-04-14 16:17:09'),
(444, 2, 1, '2015-04-14 16:17:11'),
(445, 2, 1, '2015-04-14 16:17:13'),
(446, 2, 1, '2015-04-14 16:17:14'),
(447, 2, 1, '2015-04-14 16:17:14'),
(448, 2, 4, '2015-04-14 16:17:18'),
(449, 2, 1, '2015-04-14 16:17:19'),
(450, 2, 1, '2015-04-14 16:17:20'),
(451, 2, 1, '2015-04-14 16:17:20'),
(452, 2, 3, '2015-04-14 16:17:25'),
(453, 2, 4, '2015-04-14 16:17:30'),
(454, 2, 1, '2015-04-14 16:17:31'),
(455, 2, 1, '2015-04-14 16:17:31'),
(456, 2, 3, '2015-04-14 16:17:39'),
(457, 2, 1, '2015-04-14 16:33:52'),
(458, 2, 1, '2015-04-14 16:33:56'),
(459, 2, 3, '2015-04-14 16:34:02'),
(460, 3, 1, '2015-04-14 17:58:58'),
(461, 3, 2, '2015-04-14 18:01:01'),
(462, 3, 4, '2015-04-14 18:02:22'),
(463, 3, 1, '2015-04-14 18:02:25'),
(464, 3, 1, '2015-04-14 18:02:29'),
(465, 3, 1, '2015-04-14 18:02:30'),
(466, 3, 1, '2015-04-14 18:02:33'),
(467, 3, 1, '2015-04-14 18:02:36'),
(468, 3, 1, '2015-04-14 18:02:39'),
(469, 3, 1, '2015-04-14 18:02:40'),
(470, 3, 4, '2015-04-14 18:05:14'),
(471, 2, 3, '2015-04-14 18:05:26'),
(472, 2, 2, '2015-04-14 18:08:37'),
(473, 2, 7, '2015-04-14 18:09:23'),
(474, 2, 1, '2015-04-14 18:09:25'),
(475, 2, 9, '2015-04-14 18:09:30'),
(476, 2, 1, '2015-04-14 18:09:33'),
(477, 2, 7, '2015-04-14 18:09:42'),
(478, 2, 4, '2015-04-14 18:09:46'),
(479, 2, 1, '2015-04-14 18:09:48'),
(480, 2, 1, '2015-04-14 18:09:49'),
(481, 2, 1, '2015-04-14 18:09:51'),
(482, 2, 1, '2015-04-14 18:09:52'),
(483, 2, 1, '2015-04-14 18:09:52'),
(484, 2, 3, '2015-04-14 18:09:57'),
(485, 2, 9, '2015-04-14 18:09:59'),
(486, 2, 1, '2015-04-14 18:10:14'),
(487, 2, 1, '2015-04-14 18:10:17'),
(488, 2, 1, '2015-04-14 18:10:19'),
(489, 2, 1, '2015-04-14 18:10:20'),
(490, 2, 4, '2015-04-14 18:10:24'),
(491, 2, 4, '2015-04-14 18:10:30'),
(492, 2, 1, '2015-04-14 18:10:33'),
(493, 2, 1, '2015-04-14 18:10:34'),
(494, 2, 1, '2015-04-14 18:10:36'),
(495, 2, 4, '2015-04-14 18:10:39'),
(496, 2, 1, '2015-04-14 18:10:41'),
(497, 4, 1, '2015-04-14 18:11:06'),
(498, 4, 2, '2015-04-14 18:11:21'),
(499, 4, 1, '2015-04-14 18:11:27'),
(500, 5, 1, '2015-04-14 18:11:42'),
(501, 5, 2, '2015-04-14 18:12:12'),
(502, 5, 1, '2015-04-14 18:12:21'),
(503, 5, 1, '2015-04-14 18:12:24'),
(504, 5, 1, '2015-04-14 18:12:26'),
(505, 5, 1, '2015-04-14 18:12:29'),
(506, 5, 1, '2015-04-14 18:12:32'),
(507, 5, 1, '2015-04-14 18:12:33'),
(508, 5, 4, '2015-04-14 18:12:36'),
(509, 5, 1, '2015-04-14 18:12:37'),
(510, 5, 1, '2015-04-14 18:12:42'),
(511, 5, 5, '2015-04-14 18:12:47'),
(512, 5, 1, '2015-04-14 18:12:48'),
(513, 5, 1, '2015-04-14 18:12:49'),
(514, 5, 1, '2015-04-14 18:12:50'),
(515, 5, 1, '2015-04-14 18:12:51'),
(516, 5, 4, '2015-04-14 18:12:53'),
(517, 5, 3, '2015-04-14 18:12:58'),
(518, 5, 3, '2015-04-14 18:13:06'),
(519, 5, 1, '2015-04-14 18:13:09'),
(520, 5, 4, '2015-04-14 18:13:11'),
(521, 5, 1, '2015-04-14 18:13:16'),
(522, 5, 4, '2015-04-14 18:13:19'),
(523, 5, 4, '2015-04-14 18:13:34'),
(524, 5, 1, '2015-04-14 18:13:37'),
(525, 5, 1, '2015-04-14 18:13:40'),
(526, 5, 1, '2015-04-14 18:13:41'),
(527, 5, 4, '2015-04-14 18:13:49'),
(528, 5, 4, '2015-04-14 18:13:53'),
(529, 5, 4, '2015-04-14 18:13:57'),
(530, 5, 4, '2015-04-14 18:14:01'),
(531, 5, 1, '2015-04-14 18:14:03'),
(532, 5, 1, '2015-04-14 18:14:04'),
(533, 5, 4, '2015-04-14 18:14:08'),
(534, 5, 1, '2015-04-14 18:14:09'),
(535, 5, 4, '2015-04-14 18:14:12'),
(536, 5, 3, '2015-04-14 18:14:21'),
(537, 5, 1, '2015-04-14 18:14:27'),
(538, 5, 1, '2015-04-14 18:14:28'),
(539, 5, 1, '2015-04-14 18:14:31'),
(540, 5, 3, '2015-04-14 18:14:35'),
(541, 5, 9, '2015-04-14 18:14:37'),
(542, 5, 1, '2015-04-14 18:14:41'),
(543, 5, 3, '2015-04-14 18:14:45'),
(544, 5, 1, '2015-04-14 18:14:49'),
(545, 5, 1, '2015-04-14 18:14:50'),
(546, 5, 1, '2015-04-14 18:14:51'),
(547, 5, 3, '2015-04-14 18:15:00'),
(548, 5, 1, '2015-04-14 18:15:03'),
(549, 5, 1, '2015-04-14 18:15:04'),
(550, 5, 4, '2015-04-14 18:15:10'),
(551, 5, 3, '2015-04-14 18:15:14'),
(552, 5, 9, '2015-04-14 18:15:16'),
(553, 5, 1, '2015-04-14 18:15:19'),
(554, 5, 6, '2015-04-14 18:15:22'),
(555, 5, 3, '2015-04-14 18:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacteritemxr`
--

CREATE TABLE IF NOT EXISTS `tblcharacteritemxr` (
  `intItemInstanceID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `intCaloriesRemaining` int(11) DEFAULT NULL,
  `blnDigesting` tinyint(4) NOT NULL DEFAULT '0',
  `blnEquipped` tinyint(4) NOT NULL DEFAULT '0',
  `strSize` enum('XS','S','M','L','XL','XXL','XXXL','XXXXL','Stretch') DEFAULT NULL,
  `dtmDateAdded` datetime NOT NULL,
  PRIMARY KEY (`intItemInstanceID`),
  KEY `intCharacterID` (`intRPGCharacterID`,`intItemID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=264 ;

--
-- Dumping data for table `tblcharacteritemxr`
--

INSERT INTO `tblcharacteritemxr` (`intItemInstanceID`, `intRPGCharacterID`, `intItemID`, `intCaloriesRemaining`, `blnDigesting`, `blnEquipped`, `strSize`, `dtmDateAdded`) VALUES
(4, 1, 2, 0, 0, 0, 'M', '2015-04-13 22:23:50'),
(14, 3, 3, 0, 0, 1, '', '2015-04-14 17:59:32'),
(15, 3, 4, 0, 0, 1, 'M', '2015-04-14 17:59:42'),
(18, 2, 3, 0, 0, 0, '', '2015-04-14 18:06:07'),
(19, 2, 4, 0, 0, 1, 'M', '2015-04-14 18:07:33'),
(24, 4, 3, 0, 0, 1, '', '2015-04-14 18:11:10'),
(25, 4, 4, 0, 0, 0, 'M', '2015-04-14 18:11:14'),
(26, 5, 3, 0, 0, 1, '', '2015-04-14 18:11:45'),
(27, 5, 4, 0, 0, 0, 'M', '2015-04-14 18:11:54'),
(29, 5, 2, 0, 0, 0, 'M', '2015-04-14 18:12:47'),
(40, 5, 1, 5000, 0, 0, '', '2015-04-14 18:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacteroverridexr`
--

CREATE TABLE IF NOT EXISTS `tblcharacteroverridexr` (
  `intCharacterOverrideXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intOverrideID` int(11) NOT NULL,
  PRIMARY KEY (`intCharacterOverrideXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intRPGCharacterID_2` (`intRPGCharacterID`),
  KEY `intOverrideID` (`intOverrideID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=154 ;

--
-- Dumping data for table `tblcharacteroverridexr`
--

INSERT INTO `tblcharacteroverridexr` (`intCharacterOverrideXRID`, `intRPGCharacterID`, `intOverrideID`) VALUES
(4, 1, 4),
(8, 2, 4),
(11, 3, 1),
(12, 3, 4),
(21, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacterstats`
--

CREATE TABLE IF NOT EXISTS `tblcharacterstats` (
  `intCharacterStatsID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intMaxHP` int(11) NOT NULL,
  `intStrength` int(11) NOT NULL,
  `intIntelligence` int(11) NOT NULL,
  `intAgility` int(11) NOT NULL,
  `intVitality` int(11) NOT NULL,
  `intWillpower` int(11) NOT NULL,
  `intDexterity` int(11) NOT NULL,
  `intEvasion` int(11) NOT NULL,
  `intCritDamage` int(11) NOT NULL,
  `intPierce` int(11) NOT NULL,
  `intBlockRate` int(11) NOT NULL,
  `intBlockReduction` int(11) NOT NULL,
  PRIMARY KEY (`intCharacterStatsID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tblcharacterstats`
--

INSERT INTO `tblcharacterstats` (`intCharacterStatsID`, `intRPGCharacterID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES
(1, 1, 10, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10),
(2, 2, 10, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10),
(3, 3, 10, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10),
(4, 4, 10, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10),
(5, 5, 10, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10),
(47, 48, 10, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacterstatuseffectxr`
--

CREATE TABLE IF NOT EXISTS `tblcharacterstatuseffectxr` (
  `intCharacterStatusEffectXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intStatusEffectID` int(11) NOT NULL,
  `intItemInstanceID` int(11) DEFAULT NULL,
  `intTimeRemaining` int(11) DEFAULT NULL,
  PRIMARY KEY (`intCharacterStatusEffectXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intStatusEffectID` (`intStatusEffectID`),
  KEY `intItemInstanceID` (`intItemInstanceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `tblcharacterstatuseffectxr`
--

INSERT INTO `tblcharacterstatuseffectxr` (`intCharacterStatusEffectXRID`, `intRPGCharacterID`, `intStatusEffectID`, `intItemInstanceID`, `intTimeRemaining`) VALUES
(4, 1, 4, NULL, 9999),
(8, 2, 4, NULL, 9999),
(9, 3, 1, 15, 9999),
(10, 3, 2, 15, 9999),
(11, 3, 4, NULL, 9999),
(16, 5, 4, NULL, 9999);

-- --------------------------------------------------------

--
-- Table structure for table `tblenchant`
--

CREATE TABLE IF NOT EXISTS `tblenchant` (
  `intEnchantID` int(11) NOT NULL AUTO_INCREMENT,
  `strEnchantName` varchar(45) NOT NULL,
  `strEnchantType` enum('Prefix','Suffix') NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intEnchantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblenchant`
--

INSERT INTO `tblenchant` (`intEnchantID`, `strEnchantName`, `strEnchantType`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Fattening', 'Prefix', '2014-11-04 21:26:02', 'akereliuk', NULL, NULL),
(2, 'Eternally Binding', 'Suffix', '2014-11-04 21:26:02', 'akereliuk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblenchantstatchanges`
--

CREATE TABLE IF NOT EXISTS `tblenchantstatchanges` (
  `intEnchantStatChangeID` int(11) NOT NULL AUTO_INCREMENT,
  `intEnchantID` int(11) NOT NULL,
  `strStatName` varchar(45) DEFAULT NULL,
  `intStatChangeMin` int(11) NOT NULL,
  `intStatChangeMax` int(11) NOT NULL,
  `intStatusEffectID` int(11) NOT NULL,
  PRIMARY KEY (`intEnchantStatChangeID`),
  KEY `intEnchantID` (`intEnchantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblenchantstatchanges`
--

INSERT INTO `tblenchantstatchanges` (`intEnchantStatChangeID`, `intEnchantID`, `strStatName`, `intStatChangeMin`, `intStatChangeMax`, `intStatusEffectID`) VALUES
(1, 1, NULL, 0, 0, 1),
(2, 2, NULL, 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblevent`
--

CREATE TABLE IF NOT EXISTS `tblevent` (
  `intEventID` int(11) NOT NULL AUTO_INCREMENT,
  `strEventName` varchar(45) NOT NULL,
  `txtEventDesc` text,
  `strXML` varchar(45) NOT NULL,
  `blnRepeating` tinyint(1) NOT NULL DEFAULT '1',
  `blnForcedEvent` tinyint(1) NOT NULL DEFAULT '0',
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tblevent`
--

INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `blnRepeating`, `blnForcedEvent`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Standstill', 'No event', 'standstill.xml', 1, 0, '2014-09-27 00:00:00', 'akereliuk', NULL, NULL),
(2, 'Tutorial Fairy', 'Character gets to talk to Tutorial Fairy', 'tutorialFairy.xml', 0, 1, '2014-09-27 00:00:00', 'akereliuk', NULL, NULL),
(3, 'Weight Gain', 'Character gains weight', 'weightgain.xml', 1, 0, '2014-09-27 00:00:00', 'akereliuk', NULL, NULL),
(4, 'Eat Burger', 'Character eats burger', 'eatburger.xml', 1, 0, '2014-10-02 00:00:00', 'akereliuk', NULL, NULL),
(5, 'Ayy Lmao', 'Character meats the alien', 'ayylmao.xml', 1, 0, '2014-10-11 23:31:47', 'akereliuk', NULL, NULL),
(6, 'Trying on Jeans and Tank Top', 'Character tries to fit into jeans and tank top.', 'equiptanktop.xml', 1, 0, '2014-10-12 23:36:20', 'akereliuk', NULL, NULL),
(7, 'Goblin Battle', 'Battle with a goblin', 'battlegoblin.xml', 1, 0, '2014-10-25 11:46:44', 'akereliuk', NULL, NULL),
(8, 'Equip Weapon', 'Standard equip weapon text', 'equipweapon.xml', 1, 0, '2014-10-25 19:55:32', 'akereliuk', NULL, NULL),
(9, 'Equip Cuirass', 'Equip the Leather Cuirass', 'equipCuirass.xml', 1, 0, '2014-11-05 21:57:24', 'akereliuk', NULL, NULL),
(10, 'Forced Battle Goblin', 'Forces you to battle the goblin instead of giving you an option.', 'forcedBattleGoblin.xml', 1, 0, '2016-02-12 00:00:00', 'admin', NULL, NULL),
(11, 'Leave Tower Event Long', 'When user leaves the tower for the first time to enter city.', 'leaveTowerLong.xml', 0, 0, '2016-02-12 00:00:00', 'admin', NULL, NULL),
(12, 'Leave Tower Event Short', 'When user leaves the tower after the first time.', 'leaveTowerShort.xml', 1, 0, '2016-02-12 00:00:00', 'admin', NULL, NULL),
(13, 'Sleep at Home', 'Character sleeps in their room at home.', 'sleepAtHome.xml', 1, 0, '2016-02-18 00:00:00', 'admin', NULL, NULL),
(14, 'Look at Home Mirror', 'Take a look at yourself in your full body mirror at home.', 'mirrorAtHome.xml', 1, 0, '2016-02-18 00:00:00', 'admin', NULL, NULL),
(15, 'Reset Stats at UoA', 'Reset your stats at the University of the Arcane.', 'resetStatsUoA.xml', 1, 0, '2016-02-18 00:00:00', 'admin', NULL, NULL),
(16, 'Disenchant Armour at UoA', 'Disenchant your currently equipped armour at the University of the Arcane.', 'disenchantAtUoA.xml', 1, 0, '2016-02-18 00:00:00', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblexperiencechart`
--

CREATE TABLE IF NOT EXISTS `tblexperiencechart` (
  `intLevelID` int(11) NOT NULL AUTO_INCREMENT,
  `intExpToLvl` int(11) NOT NULL,
  `intCumulativeExp` int(11) NOT NULL,
  PRIMARY KEY (`intLevelID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblexperiencechart`
--

INSERT INTO `tblexperiencechart` (`intLevelID`, `intExpToLvl`, `intCumulativeExp`) VALUES
(1, 1600, 1600),
(2, 3600, 5200),
(3, 6400, 11600),
(4, 10000, 21600),
(5, 14400, 36000),
(6, 19600, 55600),
(7, 25600, 81200),
(8, 32400, 113600),
(9, 40000, 153600),
(10, 48400, 202000);

-- --------------------------------------------------------

--
-- Table structure for table `tblfloor`
--

CREATE TABLE IF NOT EXISTS `tblfloor` (
  `intFloorID` int(11) NOT NULL AUTO_INCREMENT,
  `strFloorName` varchar(45) NOT NULL,
  `txtEntryText` text NOT NULL,
  `strFloorType` varchar(45) NOT NULL DEFAULT 'Town',
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intFloorID`),
  UNIQUE KEY `intFloorID` (`intFloorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblfloor`
--

INSERT INTO `tblfloor` (`intFloorID`, `strFloorName`, `txtEntryText`, `strFloorType`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES
(1, 'Beginner Floor 1', 'In a flash of light, you shimmer into existence. Smoke rises around you', 'Field', 'akereliuk', '2014-09-20 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblflooreventxr`
--

CREATE TABLE IF NOT EXISTS `tblflooreventxr` (
  `intFloorEventXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intFloorID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `intOccurrenceRating` int(11) NOT NULL,
  PRIMARY KEY (`intFloorEventXRID`),
  KEY `intFloorID` (`intFloorID`,`intEventID`),
  KEY `intEventID` (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tblflooreventxr`
--

INSERT INTO `tblflooreventxr` (`intFloorEventXRID`, `intFloorID`, `intEventID`, `intOccurrenceRating`) VALUES
(1, 1, 1, 2000),
(2, 1, 3, 600),
(3, 1, 4, 1000),
(4, 1, 5, 300),
(5, 1, 7, 1000),
(6, 1, 2, 9999),
(7, 1, 10, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tblitem`
--

CREATE TABLE IF NOT EXISTS `tblitem` (
  `intItemID` int(11) NOT NULL AUTO_INCREMENT,
  `strItemName` varchar(45) NOT NULL,
  `txtItemDesc` text NOT NULL,
  `txtItemDescLong` text NOT NULL,
  `strItemType` enum('Weapon:Blunt','Weapon:Sword','Weapon:Axe','Weapon:Shield','Weapon:Staff','Weapon:Tome','Weapon:Wand','Weapon:Dagger','Weapon:Shuriken','Weapon:Pistols','Weapon:Rifle','Weapon:Bow','Weapon:Claws','Weapon:Gloves','Armour:Clothes','Armour:Light','Armour:Heavy','Accessory','Food','Potion','Gem','Material','Quest') NOT NULL,
  `strHandType` varchar(45) DEFAULT NULL,
  `intCalories` int(11) DEFAULT NULL,
  `intHPHeal` int(11) NOT NULL DEFAULT '0',
  `intDamage` int(11) DEFAULT NULL,
  `intMagicDamage` int(11) DEFAULT NULL,
  `intDefence` int(11) DEFAULT NULL,
  `intMagicDefence` int(11) DEFAULT NULL,
  `strStatDamage` varchar(45) DEFAULT 'Strength',
  `intEventID` int(11) DEFAULT NULL,
  `intSellPrice` int(11) NOT NULL DEFAULT '1',
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intItemID`),
  KEY `intEventID` (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tblitem`
--

INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `txtItemDescLong`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `strStatDamage`, `intEventID`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES
(1, 'Mysterious Hamburger', 'A warm hamburger found on the ground during an event with more calories than usual.', '', 'Food', NULL, 5000, 2, NULL, NULL, NULL, NULL, NULL, 4, 1, 'akereliuk', '2014-10-09 19:58:50', NULL, NULL),
(2, 'Ayy Lmao Outfit', 'Jeans and a tank top given to you by the Ayy Lmao alien. Pretty stylish. Little dude knows his fashion.', '', 'Armour:Clothes', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, 6, 1, 'akereliuk', '2014-10-11 23:36:56', NULL, NULL),
(3, 'Goblin Mace', 'A blunt mace likely to be used by goblins.', 'A slightly more advanced type of club, this weapon is renowned for its use by bandits, evil humanoid monsters, and other lovely beasties. So obviously it''s perfect for you! The mace uses complex physics known by mace engineers as the ''lever arm'' to deliver powerful blows with its heavy metallic head and strong handle. This particular variant has metallic pyramid like structures on the head to aid in the bashing, smashing, and crashing.', 'Weapon:Blunt', 'Primary', NULL, 0, 2, NULL, NULL, NULL, 'Strength', 8, 1, 'akereliuk', '2014-10-25 19:55:58', NULL, NULL),
(4, 'Beginner Wear', 'A light leather cuirass meant to be worn on top of clothes. The bottom is a skirt which leaves the \n\nlower body unprotected. Great for mobility.', '', 'Armour:Light', NULL, NULL, 0, 0, NULL, 2, NULL, NULL, 9, 1, 'akereliuk', '2014-11-04 21:26:37', NULL, NULL),
(5, 'Small Health Potion', 'A small potion that will recover some of your health points. Use it when you are injured.', '', 'Potion', NULL, 100, 5, NULL, NULL, NULL, NULL, 'Strength', NULL, 1, 'admin', '2016-03-11 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblitemenchantxr`
--

CREATE TABLE IF NOT EXISTS `tblitemenchantxr` (
  `intItemEnchantXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intItemID` int(11) NOT NULL,
  `intEnchantID` int(11) NOT NULL,
  `intOccurrence` int(11) NOT NULL,
  PRIMARY KEY (`intItemEnchantXRID`),
  KEY `intItemID` (`intItemID`),
  KEY `intEnchantID` (`intEnchantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblitemenchantxr`
--

INSERT INTO `tblitemenchantxr` (`intItemEnchantXRID`, `intItemID`, `intEnchantID`, `intOccurrence`) VALUES
(1, 4, 1, 0),
(2, 4, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbliteminstanceenchant`
--

CREATE TABLE IF NOT EXISTS `tbliteminstanceenchant` (
  `intItemInstanceEnchantID` int(11) NOT NULL AUTO_INCREMENT,
  `intItemInstanceID` int(11) NOT NULL,
  `intSuffixEnchantID` int(11) DEFAULT NULL,
  `intPrefixEnchantID` int(11) DEFAULT NULL,
  PRIMARY KEY (`intItemInstanceEnchantID`),
  KEY `intItemInstanceID` (`intItemInstanceID`),
  KEY `intSuffixEnchantID` (`intSuffixEnchantID`),
  KEY `intPrefixEnchantID` (`intPrefixEnchantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tbliteminstanceenchant`
--

INSERT INTO `tbliteminstanceenchant` (`intItemInstanceEnchantID`, `intItemInstanceID`, `intSuffixEnchantID`, `intPrefixEnchantID`) VALUES
(1, 15, 2, 1),
(3, 25, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbllocation`
--

CREATE TABLE IF NOT EXISTS `tbllocation` (
  `intLocationID` int(11) NOT NULL AUTO_INCREMENT,
  `strLocationName` varchar(45) NOT NULL,
  `strLocationType` varchar(45) NOT NULL DEFAULT 'Building',
  `intTownID` int(11) NOT NULL DEFAULT '1',
  `txtDescription` text,
  PRIMARY KEY (`intLocationID`),
  KEY `fk_intTownID` (`intTownID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbllocation`
--

INSERT INTO `tbllocation` (`intLocationID`, `strLocationName`, `strLocationType`, `intTownID`, `txtDescription`) VALUES
(1, 'Tower Entrance', 'Hub', 1, NULL),
(2, 'Residential District', 'Hub', 1, 'The residential district is where you and most other citizens live. The most obvious exception are the merchants, guildsmen, and freemen, who live in the Commercial, Development, and Red Light districts respectively. The buildings here are the most numerous in the entire city, and range from the most decrepit shacks to the opulent mansions of the elder families. The streets are made of a flat, grey cobblestone that runs beside and behind every home, creating a great lattice of streets and alleyways for the populace to traverse. '),
(3, 'Commercial District', 'Hub', 1, 'The commercial district is one of the most diverse districts in the city. A myriad of scents and sounds assail your senses as you enter the main throughway containing the district. Merchants hawk their wares at you as you pass, and children scamper between the legs of the larger adults in laughter and play. Even so, you’ve been around the block more than once, and keep an eye on your money and yourself - the commercial district has more than its own fair share of thieves and muggers.\r\n<br/><br/>\r\nThough the children play and the streets are filled, you can’t shake the feeling that the district is… empty. Every other shop seems to be boarded up, and even those that are open for business don’t seem to be supplied very well. It makes sense, Turici was founded during the first wave of adventuring into the Tower. With it just being reopened, the city’s still recovering. Maybe with the tower’s reopening, the prospects will improve?'),
(4, 'Development District', 'Hub', 1, NULL),
(5, 'Red Light District', 'Hub', 1, NULL),
(6, 'Home', 'Building', 1, 'This is your home.'),
(7, 'Tailor', 'Building', 1, 'The store you stand in is finely organized and smells faintly of pine. Around you stand dozens of different pieces of clothing, ranging from simple blouses to gilded noble’s outfits, fit only for dances and dinner, not for the rigors of combat. Still, they look good. Other than the clothing you can see a rather elaborate seamstress’s station behind the counter. Seems that you can buy clothes here and have them tailored to fit you too!'),
(8, 'Blacksmith', 'Building', 1, 'The smithy is a claustrophobic space, filled with multitudes of weapons, shields, armour, tools, and other metallic objects. A thin veil of smoke seems to hang in the air, obscuring your sight and discoloring everything you see. Despite this, however, your untrained eye can easily see the masterful craftsmanship in many of the items for sale.\r\n\r\nThe forge is the most obvious centerpiece to all of this, as it’s set in the back wall of the structure and surrounded by plethora of smithing tools. A huge clay lined stone box with a large chimney like structure leading up through the roof, it is the heart of the smithy.'),
(9, 'Apothecary', 'Building', 1, NULL),
(10, 'Grocer', 'Building', 1, NULL),
(11, 'University of the Arcane', 'Building', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbllocationeventlink`
--

CREATE TABLE IF NOT EXISTS `tbllocationeventlink` (
  `intLocationEventLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `intLocationID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `strLinkName` varchar(45) NOT NULL,
  PRIMARY KEY (`intLocationEventLinkID`),
  KEY `fk_intLocationID` (`intLocationID`),
  KEY `fk_intEventID` (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbllocationeventlink`
--

INSERT INTO `tbllocationeventlink` (`intLocationEventLinkID`, `intLocationID`, `intEventID`, `strLinkName`) VALUES
(1, 6, 13, 'Sleep'),
(2, 6, 14, 'View Mirror'),
(3, 11, 15, 'Reset Stats'),
(4, 11, 16, 'Disenchant Armour');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocationshoplink`
--

CREATE TABLE IF NOT EXISTS `tbllocationshoplink` (
  `intLocationShopLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `intLocationID` int(11) NOT NULL,
  `intShopID` int(11) NOT NULL,
  `strLinkName` varchar(45) NOT NULL,
  PRIMARY KEY (`intLocationShopLinkID`),
  KEY `fk_intLocationID2` (`intLocationID`),
  KEY `fk_intShopID2` (`intShopID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbllocationshoplink`
--

INSERT INTO `tbllocationshoplink` (`intLocationShopLinkID`, `intLocationID`, `intShopID`, `strLinkName`) VALUES
(1, 7, 1, 'Shop'),
(2, 8, 2, 'Shop'),
(3, 9, 3, 'Shop'),
(4, 10, 4, 'Shop');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocationxrlink`
--

CREATE TABLE IF NOT EXISTS `tbllocationxrlink` (
  `intLocationXRLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `intFromLocationID` int(11) NOT NULL,
  `intToLocationID` int(11) NOT NULL,
  `strLinkName` varchar(45) NOT NULL,
  PRIMARY KEY (`intLocationXRLinkID`),
  KEY `fk_intFromLocationID` (`intFromLocationID`),
  KEY `fk_intToLocationID` (`intToLocationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbllocationxrlink`
--

INSERT INTO `tbllocationxrlink` (`intLocationXRLinkID`, `intFromLocationID`, `intToLocationID`, `strLinkName`) VALUES
(2, 2, 6, 'Home'),
(9, 3, 7, 'Tailor'),
(10, 3, 8, 'Blacksmith'),
(11, 3, 9, 'Apothecary'),
(12, 3, 10, 'Grocer'),
(14, 4, 11, 'University of the Arcane');

-- --------------------------------------------------------

--
-- Table structure for table `tblmodifier`
--

CREATE TABLE IF NOT EXISTS `tblmodifier` (
  `intModifierID` int(11) NOT NULL AUTO_INCREMENT,
  `strModifierName` varchar(45) NOT NULL,
  `strModifierType` enum('Prefix','Suffix') NOT NULL,
  `strModifierXML` varchar(45) NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intModifierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblmodifierstatchanges`
--

CREATE TABLE IF NOT EXISTS `tblmodifierstatchanges` (
  `intModifierStatChangeID` int(11) NOT NULL AUTO_INCREMENT,
  `intModifierID` int(11) NOT NULL,
  `strStatName` varchar(45) NOT NULL,
  `intStatChangeMin` int(11) NOT NULL,
  `intStatChangeMax` int(11) NOT NULL,
  `intStatusEffectID` int(11) NOT NULL,
  PRIMARY KEY (`intModifierStatChangeID`),
  KEY `intModifierID` (`intModifierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblnpc`
--

CREATE TABLE IF NOT EXISTS `tblnpc` (
  `intNPCID` int(11) NOT NULL AUTO_INCREMENT,
  `strNPCName` varchar(45) NOT NULL,
  `intWeight` int(11) NOT NULL,
  `intHeight` int(11) NOT NULL,
  `intExperienceGiven` int(11) NOT NULL,
  `intGoldDropMin` int(11) NOT NULL,
  `intGoldDropMax` int(11) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intNPCID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblnpc`
--

INSERT INTO `tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Goblin', 120, 150, 800, 0, 5, '2014-10-25 14:22:34', 'akereliuk', NULL, NULL),
(2, 'Seraphine the Tutorial Fairy', 50, 100, 1600, 0, 0, '2014-11-15 16:38:52', 'akereliuk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcitemxr`
--

CREATE TABLE IF NOT EXISTS `tblnpcitemxr` (
  `intNPCItemXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `blnEquipped` tinyint(1) NOT NULL DEFAULT '0',
  `blnDropped` tinyint(1) NOT NULL DEFAULT '0',
  `intDropRating` int(11) NOT NULL,
  `dtmDateAdded` datetime NOT NULL,
  PRIMARY KEY (`intNPCItemXRID`),
  KEY `intNPCID` (`intNPCID`,`intItemID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblnpcitemxr`
--

INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES
(1, 1, 3, 1, 1, 2000, '2014-10-25 19:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcmodifierxr`
--

CREATE TABLE IF NOT EXISTS `tblnpcmodifierxr` (
  `intNPCModifierXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `intModifierID` int(11) NOT NULL,
  `intOccurrence` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intNPCModifierXRID`),
  KEY `intNPCID` (`intNPCID`),
  KEY `intModifierID` (`intModifierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcstats`
--

CREATE TABLE IF NOT EXISTS `tblnpcstats` (
  `intNPCStatsID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `intMaxHP` int(11) NOT NULL,
  `intStrength` int(11) NOT NULL,
  `intIntelligence` int(11) NOT NULL,
  `intAgility` int(11) NOT NULL,
  `intVitality` int(11) NOT NULL,
  `intWillpower` int(11) NOT NULL,
  `intDexterity` int(11) NOT NULL,
  `intEvasion` int(11) NOT NULL,
  `intCritDamage` int(11) NOT NULL,
  `intPierce` int(11) NOT NULL,
  `intBlockRate` int(11) NOT NULL,
  `intBlockReduction` int(11) NOT NULL,
  PRIMARY KEY (`intNPCStatsID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblnpcstats`
--

INSERT INTO `tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES
(1, 1, 8, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10),
(2, 2, 8, 2, 2, 2, 2, 2, 2, 0, 150, 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbloverride`
--

CREATE TABLE IF NOT EXISTS `tbloverride` (
  `intOverrideID` int(11) NOT NULL AUTO_INCREMENT,
  `strOverrideName` varchar(45) NOT NULL,
  `strOverrideDesc` text NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intOverrideID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbloverride`
--

INSERT INTO `tbloverride` (`intOverrideID`, `strOverrideName`, `strOverrideDesc`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Armour Binding', 'Player cannot unequip their armour; must wait until it tears or falls off. Additionally, armour is always tight.', '2014-11-04 21:27:39', 'akereliuk', NULL, NULL),
(2, 'Stretchy Armour', 'Armour adjusts to player weight; always skintight.', '2014-11-04 21:27:39', 'akereliuk', NULL, NULL),
(3, 'Allow Equip Tab', 'Allows \r\n\r\nuser to access equip tab during events, but equipping anything will not cause a new event to occur with this override \r\n\r\nset.', '2014-11-13 21:08:16', 'akereliuk', NULL, NULL),
(4, 'Burdened by Weight', 'Lowers Agility stat based on the user''s BMI.', '2014-12-08 15:59:48', 'akereliuk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpost`
--

CREATE TABLE IF NOT EXISTS `tblpost` (
  `intPostID` int(11) NOT NULL AUTO_INCREMENT,
  `strUserID` varchar(45) NOT NULL,
  `strSubject` varchar(45) NOT NULL,
  `txtContents` text NOT NULL,
  `intParentID` int(11) DEFAULT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intPostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblrpgcharacter`
--

CREATE TABLE IF NOT EXISTS `tblrpgcharacter` (
  `intRPGCharacterID` int(12) NOT NULL AUTO_INCREMENT,
  `strUserID` varchar(45) NOT NULL,
  `strRPGCharacterName` varchar(45) NOT NULL,
  `intHeight` int(11) NOT NULL DEFAULT '165',
  `dblWeight` double NOT NULL,
  `intDigestionRate` int(11) NOT NULL DEFAULT '250',
  `intFloorID` int(11) NOT NULL DEFAULT '1',
  `intCurrentFloorID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL DEFAULT '1',
  `intEventNodeID` int(11) NOT NULL DEFAULT '0',
  `intStateID` int(8) NOT NULL DEFAULT '0',
  `intTownID` int(8) DEFAULT NULL,
  `intLocationID` int(11) NOT NULL DEFAULT '6',
  `intDay` int(11) NOT NULL DEFAULT '1',
  `strTime` varchar(5) NOT NULL DEFAULT '00:00',
  `intArmourRipLevel` int(11) DEFAULT NULL,
  `strGender` enum('Female','Male') NOT NULL DEFAULT 'Female',
  `strOrientation` enum('Heterosexual','Homosexual','Bisexual') NOT NULL DEFAULT 'Heterosexual',
  `strPersonality` enum('Shy','Outgoing','Stoic') NOT NULL DEFAULT 'Shy',
  `strFatStance` enum('Negative','Positive','Neutral') NOT NULL DEFAULT 'Negative',
  `strEyeColour` enum('Brown','Blue','Green','Black','Red','White') NOT NULL DEFAULT 'Brown',
  `strHairColour` enum('Brown','Blonde','Black','Red','Brunette','White','Orange','Green','Blue','Pink','Yellow','Purple') NOT NULL DEFAULT 'Brown',
  `strHairLength` enum('Short','Medium','Shoulder Length','Long') NOT NULL DEFAULT 'Short',
  `strEthnicity` enum('White','Peach','Tan','Brown','Black','Olive') NOT NULL DEFAULT 'White',
  `intLevel` int(11) NOT NULL DEFAULT '1',
  `intExperience` int(11) NOT NULL DEFAULT '0',
  `intCurrentHP` int(11) NOT NULL DEFAULT '10',
  `intStatPoints` int(11) NOT NULL DEFAULT '0',
  `intGold` int(11) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intRPGCharacterID`),
  KEY `intUserID` (`strUserID`),
  KEY `intFloorID` (`intFloorID`),
  KEY `intEventID` (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `tblrpgcharacter`
--

INSERT INTO `tblrpgcharacter` (`intRPGCharacterID`, `strUserID`, `strRPGCharacterName`, `intHeight`, `dblWeight`, `intDigestionRate`, `intFloorID`, `intCurrentFloorID`, `intEventID`, `intEventNodeID`, `intStateID`, `intTownID`, `intLocationID`, `intDay`, `strTime`, `intArmourRipLevel`, `strGender`, `strOrientation`, `strPersonality`, `strFatStance`, `strEyeColour`, `strHairColour`, `strHairLength`, `strEthnicity`, `intLevel`, `intExperience`, `intCurrentHP`, `intStatPoints`, `intGold`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'bob', 'Yaaa', 152, 614.375, 250, 1, 0, 7, 0, 0, NULL, 6, 11, '7:00', 0, 'Female', 'Heterosexual', 'Shy', 'Negative', 'Brown', 'Brown', 'Short', 'White', 1, 800, 13, 0, 3, '2015-04-14 02:23:04', 'system', NULL, NULL),
(2, 'bob', 'Ales', 165, 186.45, 250, 1, 0, 3, 1, 0, NULL, 6, 3, '5:45', 16, 'Female', 'Heterosexual', 'Shy', 'Negative', 'Brown', 'Brown', 'Short', 'White', 2, 0, 13, 5, 0, '2015-04-14 20:15:50', 'system', NULL, NULL),
(3, 'bob', 'Talia', 150, 241.625, 250, 1, 0, 7, 0, 0, NULL, 6, 1, '18:45', 15, 'Female', 'Heterosexual', 'Shy', 'Negative', 'Brown', 'Brown', 'Short', 'White', 2, 0, 13, 5, 0, '2015-04-14 21:58:57', 'system', NULL, NULL),
(4, 'bob', 'fghfhfh', 152, 109, 250, 1, 0, 4, 0, 0, NULL, 6, 1, '4:30', 0, 'Female', 'Heterosexual', 'Shy', 'Negative', 'Brown', 'Brown', 'Short', 'White', 1, 0, 10, 0, 0, '2015-04-14 22:11:06', 'system', NULL, NULL),
(5, 'bob', 'bnmbm', 152, 198, 250, 1, 0, 3, 5, 0, NULL, 6, 2, '17:15', 0, 'Female', 'Heterosexual', 'Shy', 'Negative', 'Brown', 'Brown', 'Short', 'White', 2, 0, 13, 0, 0, '2015-04-14 22:11:42', 'system', NULL, NULL),
(48, 'test', 'Test', 152, 108, 250, 1, 1, 2, 0, 4, 0, 6, 1, '00:30', 0, 'Female', 'Heterosexual', 'Shy', 'Negative', 'Brown', 'Brown', 'Short', 'White', 1, 0, 10, 0, 0, '2016-03-14 23:18:45', 'system', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblshop`
--

CREATE TABLE IF NOT EXISTS `tblshop` (
  `intShopID` int(11) NOT NULL AUTO_INCREMENT,
  `strShopName` varchar(45) NOT NULL,
  `txtShopDesc` text,
  `strShopType` varchar(45) NOT NULL,
  PRIMARY KEY (`intShopID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblshop`
--

INSERT INTO `tblshop` (`intShopID`, `strShopName`, `txtShopDesc`, `strShopType`) VALUES
(1, 'Turician Tailor', 'Buy clothes.', 'Tailor'),
(2, 'Turician Blacksmith', 'Buy armour and weapons.', 'Blacksmith'),
(3, 'Turician Apothecary', 'Buy potions.', 'Apothecary'),
(4, 'Turician Grocer', 'Buy food.', 'Grocer');

-- --------------------------------------------------------

--
-- Table structure for table `tblshopitemxr`
--

CREATE TABLE IF NOT EXISTS `tblshopitemxr` (
  `intShopItemID` int(11) NOT NULL AUTO_INCREMENT,
  `intShopID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `dblPrice` double NOT NULL,
  PRIMARY KEY (`intShopItemID`),
  KEY `fk_intShopID` (`intShopID`),
  KEY `fk_intItemID` (`intItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblshopitemxr`
--

INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES
(1, 1, 2, 1),
(2, 2, 3, 1),
(3, 3, 5, 1),
(4, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblstates`
--

CREATE TABLE IF NOT EXISTS `tblstates` (
  `intStateID` int(11) NOT NULL AUTO_INCREMENT,
  `strStateName` varchar(45) NOT NULL,
  `txtDescription` text,
  PRIMARY KEY (`intStateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tblstates`
--

INSERT INTO `tblstates` (`intStateID`, `strStateName`, `txtDescription`) VALUES
(1, 'Event', 'User is currently within an event.'),
(2, 'Combat', 'User is entered in combat.'),
(3, 'Field', 'User is in an open field where enemies and events can occur.'),
(4, 'Town', 'User is in a town where events can occur.'),
(5, 'Dungeon', 'User is in a dungeon where enemies and events can occur.'),
(6, 'Shop', 'User is currently inside a shop window.'),
(7, 'Dead', 'User is currently dead and needs to be revived.'),
(8, 'Tutorial', 'User is currently in tutorial.'),
(9, 'Stats', 'Stat gain window');

-- --------------------------------------------------------

--
-- Table structure for table `tblstatuseffect`
--

CREATE TABLE IF NOT EXISTS `tblstatuseffect` (
  `intStatusEffectID` int(11) NOT NULL AUTO_INCREMENT,
  `strStatusEffectName` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intStatusEffectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblstatuseffect`
--

INSERT INTO `tblstatuseffect` (`intStatusEffectID`, `strStatusEffectName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Fattening I', '2014-11-04 21:26:59', 'akereliuk', NULL, NULL),
(2, 'Armour Binding', '2014-11-04 21:26:59', 'akereliuk', NULL, NULL),
(3, 'Stretchy Armour', '2014-11-04 21:26:59', 'akereliuk', NULL, NULL),
(4, 'Burdened by Weight', '2014-12-08 15:59:48', 'akereliuk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstatuseffectstatchange`
--

CREATE TABLE IF NOT EXISTS `tblstatuseffectstatchange` (
  `intStatusEffectStatChangeID` int(11) NOT NULL AUTO_INCREMENT,
  `intStatusEffectID` int(11) NOT NULL,
  `strStatName` varchar(45) NOT NULL,
  `intStatChangeMin` int(11) NOT NULL,
  `intStatChangeMax` int(11) NOT NULL,
  `intOverrideID` int(11) DEFAULT NULL,
  `blnInfinite` tinyint(1) NOT NULL DEFAULT '1',
  `intDuration` int(11) DEFAULT NULL,
  `blnIncremental` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intStatusEffectStatChangeID`),
  KEY `intStatusEffectID` (`intStatusEffectID`),
  KEY `intOverrideID` (`intOverrideID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tblstatuseffectstatchange`
--

INSERT INTO `tblstatuseffectstatchange` (`intStatusEffectStatChangeID`, `intStatusEffectID`, `strStatName`, `intStatChangeMin`, `intStatChangeMax`, `intOverrideID`, `blnInfinite`, `intDuration`, `blnIncremental`) VALUES
(4, 1, 'Weight', 1, 3, NULL, 1, 9999, 1),
(5, 2, '', 0, 0, 1, 1, 9999, 0),
(6, 3, '', 0, 0, 2, 1, 9999, 0),
(7, 4, '', 0, 0, 4, 1, 9999, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbltown`
--

CREATE TABLE IF NOT EXISTS `tbltown` (
  `intTownID` int(11) NOT NULL AUTO_INCREMENT,
  `strTownName` varchar(45) NOT NULL,
  PRIMARY KEY (`intTownID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbltown`
--

INSERT INTO `tbltown` (`intTownID`, `strTownName`) VALUES
(1, 'Turici');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `intUserID` int(12) NOT NULL AUTO_INCREMENT,
  `strUserID` varchar(45) NOT NULL,
  `strPassword` varchar(45) NOT NULL,
  `blnAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intUserID`),
  UNIQUE KEY `strUserID` (`strUserID`),
  UNIQUE KEY `intUserID` (`intUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`intUserID`, `strUserID`, `strPassword`, `blnAdmin`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'bob', 'd7ae1fac04054938fd85d247cc82e80f', 0, '2015-04-14 02:22:54', 'system', NULL, NULL),
(2, 'test', 'd7ae1fac04054938fd85d247cc82e80f', 0, '2016-02-03 20:55:08', 'system', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcharacterabilitystats`
--
ALTER TABLE `tblcharacterabilitystats`
  ADD CONSTRAINT `tblcharacterabilitystats_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharactereventxr`
--
ALTER TABLE `tblcharactereventxr`
  ADD CONSTRAINT `tblcharactereventxr_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharacteritemxr`
--
ALTER TABLE `tblcharacteritemxr`
  ADD CONSTRAINT `tblcharacteritemxr_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcharacteritemxr_ibfk_2` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharacteroverridexr`
--
ALTER TABLE `tblcharacteroverridexr`
  ADD CONSTRAINT `tblcharacteroverridexr_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcharacteroverridexr_ibfk_2` FOREIGN KEY (`intOverrideID`) REFERENCES `tbloverride` (`intOverrideID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharacterstats`
--
ALTER TABLE `tblcharacterstats`
  ADD CONSTRAINT `tblcharacterstats_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharacterstatuseffectxr`
--
ALTER TABLE `tblcharacterstatuseffectxr`
  ADD CONSTRAINT `tblcharacterstatuseffectxr_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcharacterstatuseffectxr_ibfk_2` FOREIGN KEY (`intStatusEffectID`) REFERENCES `tblstatuseffect` (`intStatusEffectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcharacterstatuseffectxr_ibfk_3` FOREIGN KEY (`intItemInstanceID`) REFERENCES `tblcharacteritemxr` (`intItemInstanceID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblenchantstatchanges`
--
ALTER TABLE `tblenchantstatchanges`
  ADD CONSTRAINT `tblenchantstatchanges_ibfk_1` FOREIGN KEY (`intEnchantID`) REFERENCES `tblenchant` (`intEnchantID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblflooreventxr`
--
ALTER TABLE `tblflooreventxr`
  ADD CONSTRAINT `tblflooreventxr_ibfk_1` FOREIGN KEY (`intFloorID`) REFERENCES `tblfloor` (`intFloorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblflooreventxr_ibfk_2` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblitem`
--
ALTER TABLE `tblitem`
  ADD CONSTRAINT `tblitem_ibfk_1` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON UPDATE CASCADE;

--
-- Constraints for table `tblitemenchantxr`
--
ALTER TABLE `tblitemenchantxr`
  ADD CONSTRAINT `tblitemenchantxr_ibfk_1` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblitemenchantxr_ibfk_2` FOREIGN KEY (`intEnchantID`) REFERENCES `tblenchant` (`intEnchantID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbliteminstanceenchant`
--
ALTER TABLE `tbliteminstanceenchant`
  ADD CONSTRAINT `tbliteminstanceenchant_ibfk_1` FOREIGN KEY (`intItemInstanceID`) REFERENCES `tblcharacteritemxr` (`intItemInstanceID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbliteminstanceenchant_ibfk_2` FOREIGN KEY (`intSuffixEnchantID`) REFERENCES `tblenchant` (`intEnchantID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbliteminstanceenchant_ibfk_3` FOREIGN KEY (`intPrefixEnchantID`) REFERENCES `tblenchant` (`intEnchantID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbllocation`
--
ALTER TABLE `tbllocation`
  ADD CONSTRAINT `fk_intTownID` FOREIGN KEY (`intTownID`) REFERENCES `tbltown` (`intTownID`);

--
-- Constraints for table `tbllocationeventlink`
--
ALTER TABLE `tbllocationeventlink`
  ADD CONSTRAINT `fk_intEventID` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`),
  ADD CONSTRAINT `fk_intLocationID` FOREIGN KEY (`intLocationID`) REFERENCES `tbllocation` (`intLocationID`);

--
-- Constraints for table `tbllocationshoplink`
--
ALTER TABLE `tbllocationshoplink`
  ADD CONSTRAINT `fk_intLocationID2` FOREIGN KEY (`intLocationID`) REFERENCES `tbllocation` (`intLocationID`),
  ADD CONSTRAINT `fk_intShopID2` FOREIGN KEY (`intShopID`) REFERENCES `tblshop` (`intShopID`);

--
-- Constraints for table `tbllocationxrlink`
--
ALTER TABLE `tbllocationxrlink`
  ADD CONSTRAINT `fk_intFromLocationID` FOREIGN KEY (`intFromLocationID`) REFERENCES `tbllocation` (`intLocationID`),
  ADD CONSTRAINT `fk_intToLocationID` FOREIGN KEY (`intToLocationID`) REFERENCES `tbllocation` (`intLocationID`);

--
-- Constraints for table `tblmodifierstatchanges`
--
ALTER TABLE `tblmodifierstatchanges`
  ADD CONSTRAINT `tblmodifierstatchanges_ibfk_1` FOREIGN KEY (`intModifierID`) REFERENCES `tblmodifier` (`intModifierID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnpcitemxr`
--
ALTER TABLE `tblnpcitemxr`
  ADD CONSTRAINT `tblnpcitemxr_ibfk_1` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblnpcitemxr_ibfk_2` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnpcmodifierxr`
--
ALTER TABLE `tblnpcmodifierxr`
  ADD CONSTRAINT `tblnpcmodifierxr_ibfk_1` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblnpcmodifierxr_ibfk_2` FOREIGN KEY (`intModifierID`) REFERENCES `tblmodifier` (`intModifierID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnpcstats`
--
ALTER TABLE `tblnpcstats`
  ADD CONSTRAINT `tblnpcstats_ibfk_1` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblrpgcharacter`
--
ALTER TABLE `tblrpgcharacter`
  ADD CONSTRAINT `tblrpgcharacter_ibfk_1` FOREIGN KEY (`strUserID`) REFERENCES `tbluser` (`strUserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblrpgcharacter_ibfk_2` FOREIGN KEY (`intFloorID`) REFERENCES `tblfloor` (`intFloorID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tblrpgcharacter_ibfk_3` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON UPDATE CASCADE;

--
-- Constraints for table `tblshopitemxr`
--
ALTER TABLE `tblshopitemxr`
  ADD CONSTRAINT `fk_intItemID` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`),
  ADD CONSTRAINT `fk_intShopID` FOREIGN KEY (`intShopID`) REFERENCES `tblshop` (`intShopID`);

--
-- Constraints for table `tblstatuseffectstatchange`
--
ALTER TABLE `tblstatuseffectstatchange`
  ADD CONSTRAINT `tblstatuseffectstatchange_ibfk_1` FOREIGN KEY (`intStatusEffectID`) REFERENCES `tblstatuseffect` (`intStatusEffectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblstatuseffectstatchange_ibfk_2` FOREIGN KEY (`intOverrideID`) REFERENCES `tbloverride` (`intOverrideID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
