-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Nov 2017 um 19:06
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `skillmatrix`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `competency`
--

CREATE TABLE `competency` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `competency`
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
(19, 'WBCRM Support', 2, 18);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `job_title`
--

CREATE TABLE `job_title` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `job_title`
--

INSERT INTO `job_title` (`id`, `title`) VALUES
(1, 'Softwareentwickler');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `job_title_has_comp`
--

CREATE TABLE `job_title_has_comp` (
  `id` int(11) UNSIGNED NOT NULL,
  `job_title_id` int(11) NOT NULL,
  `competency_id` int(11) NOT NULL,
  `skill_value` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `strength`
--

CREATE TABLE `strength` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(120) NOT NULL,
  `lname` varchar(120) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `ausbildung` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `job_title`, `dob`, `address`, `ausbildung`) VALUES
(1, 'Employee', 'A', 'Software Entwickler', '25.10.1985', 'Dr. Robert Graf Strasse', 'FH'),
(2, 'Emplyee', 'B', 'IT', '13.17.1980', 'Mosserhofgasse 14, 8010 Graz', 'Ing'),
(3, 'Employee', 'C', 'xyz', '13.17.2017', 'St. Peter gasse 23, 8010. Graz', 'Master in Informatik, First level tech support'),
(6, 'Emplyee', 'D', 'IT-Mitarbeiter', '01.05.1980', 'Test', 'Test1,Test2'),
(7, 'Name', 'A', 'IT-Mitarbeiter', '01.11.1980', 'Dr. Robert Graf Strasse 12/3/11', 'Ing'),
(8, 'Name', 'E', 'IT-Mitarbeiter', '06.05.1970', 'Mosserhofgasse 14, 8010 Graz', 'IT');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_has_comp`
--

CREATE TABLE `user_has_comp` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `competency_id` int(11) NOT NULL,
  `skill_value` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user_has_comp`
--

INSERT INTO `user_has_comp` (`id`, `user_id`, `competency_id`, `skill_value`) VALUES
(2, 6, 11, 'advanced'),
(3, 6, 12, 'expert'),
(4, 6, 14, 'intermediate'),
(5, 7, 6, 'basic'),
(6, 7, 7, 'basic'),
(7, 7, 9, 'advanced'),
(8, 8, 11, 'intermediate'),
(9, 8, 14, 'basic');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `competency`
--
ALTER TABLE `competency`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `job_title`
--
ALTER TABLE `job_title`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `job_title_has_comp`
--
ALTER TABLE `job_title_has_comp`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `strength`
--
ALTER TABLE `strength`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_has_comp`
--
ALTER TABLE `user_has_comp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `competency`
--
ALTER TABLE `competency`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT für Tabelle `job_title`
--
ALTER TABLE `job_title`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `job_title_has_comp`
--
ALTER TABLE `job_title_has_comp`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `strength`
--
ALTER TABLE `strength`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT für Tabelle `user_has_comp`
--
ALTER TABLE `user_has_comp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
