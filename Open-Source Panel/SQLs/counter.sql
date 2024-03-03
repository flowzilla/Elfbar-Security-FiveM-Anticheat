-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 07. Nov 2023 um 20:41
-- Server-Version: 10.11.4-MariaDB-1~deb12u1
-- PHP-Version: 8.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `counter`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `totalauths`
--

CREATE TABLE `totalauths` (
  `id` int(11) NOT NULL,
  `license` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `totalbans`
--

CREATE TABLE `totalbans` (
  `id` int(11) NOT NULL,
  `license` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `totaljoins`
--

CREATE TABLE `totaljoins` (
  `id` int(11) NOT NULL,
  `license` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `totalscreenshots`
--

CREATE TABLE `totalscreenshots` (
  `id` int(11) NOT NULL,
  `license` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `totalauths`
--
ALTER TABLE `totalauths`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `totalbans`
--
ALTER TABLE `totalbans`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `totaljoins`
--
ALTER TABLE `totaljoins`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `totalscreenshots`
--
ALTER TABLE `totalscreenshots`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `totalauths`
--
ALTER TABLE `totalauths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `totalbans`
--
ALTER TABLE `totalbans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `totaljoins`
--
ALTER TABLE `totaljoins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `totalscreenshots`
--
ALTER TABLE `totalscreenshots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
