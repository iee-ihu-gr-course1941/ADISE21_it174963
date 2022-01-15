-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2022 at 10:40 AM
-- Server version: 10.3.31-MariaDB-0+deb10u1-log
-- PHP Version: 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ADISE21_it174963`
--

-- --------------------------------------------------------

--
-- Table structure for table `board_1`
--

CREATE TABLE `board_1` (
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  `c_symbol` enum('Hearts','Diamonds','Spades','Clubs') DEFAULT NULL,
  `c_number` enum('A','2','3','4','5','6','7','8','9','10','J','Q','K') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




-- --------------------------------------------------------

--
-- Table structure for table `board_2`
--

CREATE TABLE `board_2` (
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  `c_symbol` enum('Hearts','Diamonds','Spades','Clubs') DEFAULT NULL,
  `c_number` enum('A','2','3','4','5','6','7','8','9','10','J','Q','K') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `board_empty`
--

CREATE TABLE `board_empty` (
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  `c_symbol` enum('Hearts','Diamonds','Spades','Clubs') DEFAULT NULL,
  `c_number` enum('A','2','3','4','5','6','7','8','9','10','J','Q','K') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `board_empty`
--

INSERT INTO `board_empty` (`x`, `y`, `c_symbol`, `c_number`) VALUES
(1, 1, '', NULL),
(1, 2, '', NULL),
(1, 3, '', NULL),
(1, 4, '', NULL),
(1, 5, '', NULL),
(1, 6, '', NULL),
(1, 7, '', NULL),
(1, 8, '', NULL),
(1, 9, '', NULL),
(1, 10, '', NULL),
(1, 11, '', NULL),
(1, 12, '', NULL),
(2, 1, '', NULL),
(2, 2, '', NULL),
(2, 3, '', NULL),
(2, 4, '', NULL),
(2, 5, '', NULL),
(2, 6, '', NULL),
(2, 7, '', NULL),
(2, 8, '', NULL),
(2, 9, '', NULL),
(2, 10, '', NULL),
(2, 11, '', NULL),
(2, 12, '', NULL),
(3, 1, '', NULL),
(3, 2, '', NULL),
(3, 3, '', NULL),
(3, 4, '', NULL),
(3, 5, '', NULL),
(3, 6, '', NULL),
(3, 7, '', NULL),
(3, 8, '', NULL),
(3, 9, '', NULL),
(3, 10, '', NULL),
(3, 11, '', NULL),
(3, 12, '', NULL),
(4, 1, '', NULL),
(4, 2, '', NULL),
(4, 3, '', NULL),
(4, 4, '', NULL),
(4, 5, '', NULL),
(4, 6, '', NULL),
(4, 7, '', NULL),
(4, 8, '', NULL),
(4, 9, '', NULL),
(4, 10, '', NULL),
(4, 11, '', NULL),
(4, 12, '', NULL),
(5, 1, '', NULL),
(5, 2, '', NULL),
(5, 3, '', NULL),
(5, 4, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `game_status`
--

CREATE TABLE `game_status` (
  `status` enum('not active','initialized','started','ended','aborded') NOT NULL DEFAULT 'not active',
  `p_turn` enum('1','2') DEFAULT NULL,
  `result` enum('0','1','2') DEFAULT NULL,
  `last_change` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game_status`
--

INSERT INTO `game_status` (`status`, `p_turn`, `result`, `last_change`) VALUES
('not active', '1', NULL, '2022-01-15 08:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `username` varchar(20) DEFAULT NULL,
  `player_side` enum('1','2') NOT NULL,
  `token` varchar(32) DEFAULT NULL,
  `last_action` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Indexes for table `board_1`
--
ALTER TABLE `board_1`
  ADD PRIMARY KEY (`x`,`y`);

--
-- Indexes for table `board_2`
--
ALTER TABLE `board_2`
  ADD PRIMARY KEY (`x`,`y`);

--
-- Indexes for table `board_empty`
--
ALTER TABLE `board_empty`
  ADD PRIMARY KEY (`x`,`y`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_side`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
