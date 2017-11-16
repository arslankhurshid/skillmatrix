-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2017 at 12:41 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skillmatrix`
--

-- --------------------------------------------------------

--
-- Table structure for table `competency`
--

CREATE TABLE `competency` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `competency`
--

INSERT INTO `competency` (`id`, `name`, `order`, `parent_id`) VALUES
(5, 'SWE', 3, 0),
(6, 'WBCRM SWE', 4, 5),
(7, 'WB2000 SWE', 5, 5),
(8, 'SWE Allg', 6, 5),
(9, 'SW Architektur', 7, 5),
(10, 'Infrastruktur', 8, 0),
(11, 'Windows Server', 11, 10),
(12, 'MS Client', 12, 10),
(13, 'Switching/Routing', 13, 10),
(14, 'IT-Security', 10, 10),
(15, '1st level allgemein', 14, 10),
(16, 'IBM i Systemtechnik', 9, 10),
(17, 'Drucker', 15, 10),
(18, 'Applikationen', 1, 0),
(19, 'WBCRM Support', 2, 18),
(21, 'WB2000 Support', 0, 18);

-- --------------------------------------------------------

--
-- Table structure for table `job_title`
--

CREATE TABLE `job_title` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_title`
--

INSERT INTO `job_title` (`id`, `title`) VALUES
(1, 'Softwareentwickler'),
(2, 'Network Admin');

-- --------------------------------------------------------

--
-- Table structure for table `job_title_has_comp`
--

CREATE TABLE `job_title_has_comp` (
  `id` int(11) UNSIGNED NOT NULL,
  `job_title_id` int(11) NOT NULL,
  `competency_id` int(11) NOT NULL,
  `skill_value` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_title_has_comp`
--

INSERT INTO `job_title_has_comp` (`id`, `job_title_id`, `competency_id`, `skill_value`) VALUES
(6, 2, 8, '1'),
(7, 2, 13, '3'),
(8, 2, 14, '4'),
(9, 2, 17, '4'),
(23, 1, 8, '1'),
(24, 1, 12, '1'),
(25, 1, 14, '1');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(7);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`) VALUES
(1, 'Basic'),
(2, 'Intermediate'),
(3, 'Advanced'),
(4, 'Expert');

-- --------------------------------------------------------

--
-- Table structure for table `strength`
--

CREATE TABLE `strength` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(120) NOT NULL,
  `lname` varchar(120) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `ausbildung` varchar(120) NOT NULL,
  `job_title_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `dob`, `address`, `ausbildung`, `job_title_id`) VALUES
(2, 'Emplyee', 'B', '13.17.1980', 'Mosserhofgasse 14, 8010 Graz', 'Ing', 0),
(3, 'Employee', 'C', '13.17.2017', 'St. Peter gasse 23, 8010. Graz', 'Master in Informatik, First level tech support', 0),
(7, 'Name', 'A', '01.11.1980', 'Dr. Robert Graf Strasse 12/3/11', 'Ing', 0),
(8, 'Name', 'E', '06.05.1970', 'Mosserhofgasse 14, 8010 Graz', 'IT', 0),
(17, 'Test', 'Mitarbeiter23', '15.02.2017', 'Mosserhofgasse 14, 8010 Graz', 'SWe Ing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_comp`
--

CREATE TABLE `user_has_comp` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `competency_id` int(11) NOT NULL,
  `skill_value` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_has_comp`
--

INSERT INTO `user_has_comp` (`id`, `user_id`, `competency_id`, `skill_value`) VALUES
(2, 6, 11, '3'),
(3, 6, 12, '4'),
(4, 6, 14, '2'),
(5, 7, 6, '1'),
(6, 7, 7, '1'),
(7, 7, 9, '2'),
(8, 8, 11, '2'),
(9, 8, 14, '1'),
(109, 17, 6, '1'),
(110, 17, 8, '2'),
(111, 17, 11, '3'),
(112, 17, 21, '4'),
(114, 3, 6, '1'),
(115, 3, 9, '4'),
(116, 2, 7, '4'),
(117, 2, 19, '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competency`
--
ALTER TABLE `competency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_title`
--
ALTER TABLE `job_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_title_has_comp`
--
ALTER TABLE `job_title_has_comp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strength`
--
ALTER TABLE `strength`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_has_comp`
--
ALTER TABLE `user_has_comp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competency`
--
ALTER TABLE `competency`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `job_title`
--
ALTER TABLE `job_title`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `job_title_has_comp`
--
ALTER TABLE `job_title_has_comp`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `strength`
--
ALTER TABLE `strength`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user_has_comp`
--
ALTER TABLE `user_has_comp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
