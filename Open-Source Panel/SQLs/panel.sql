-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 07. Nov 2023 um 20:40
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
-- Datenbank: `panel`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `globalbanlist`
--

CREATE TABLE `globalbanlist` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `steam` varchar(50) DEFAULT NULL,
  `license` varchar(50) NOT NULL,
  `xbl` varchar(50) DEFAULT NULL,
  `live` varchar(50) DEFAULT NULL,
  `discord` varchar(50) DEFAULT NULL,
  `playerip` varchar(50) DEFAULT NULL,
  `hwid` varchar(950) DEFAULT NULL,
  `reason` varchar(255) NOT NULL DEFAULT 'Banned by https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat',
  `screen` text NOT NULL DEFAULT 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/ui06900b.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ipreset`
--

CREATE TABLE `ipreset` (
  `id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `new_ip` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `keys`
--

CREATE TABLE `keys` (
  `license` varchar(200) NOT NULL,
  `exp` varchar(200) NOT NULL DEFAULT 'ERROR',
  `licenseid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `text` varchar(1000) NOT NULL,
  `date` varchar(200) NOT NULL,
  `user` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notifications`
--

CREATE TABLE `notifications` (
  `text` varchar(1000) NOT NULL,
  `date` varchar(200) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `panelbans`
--

CREATE TABLE `panelbans` (
  `userid` varchar(40) NOT NULL,
  `reason` varchar(100) NOT NULL DEFAULT 'No reason specified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `playerlist`
--

CREATE TABLE `playerlist` (
  `id` int(30) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `idd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `redem_license`
--

CREATE TABLE `redem_license` (
  `licenseid` int(11) NOT NULL,
  `license` varchar(50) NOT NULL,
  `expires` varchar(255) NOT NULL,
  `serverid` varchar(11) NOT NULL DEFAULT 'not set',
  `rede_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userid` int(11) NOT NULL,
  `lastreset` date DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `server`
--

CREATE TABLE `server` (
  `serverid` int(11) NOT NULL,
  `serverip` varchar(25) NOT NULL,
  `name` longtext NOT NULL,
  `port` varchar(20) NOT NULL DEFAULT 'not set',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `licenseid` varchar(50) NOT NULL DEFAULT 'not found',
  `latestres_name` varchar(50) NOT NULL DEFAULT 'imoshield',
  `is_blacklisted` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` varchar(30) DEFAULT NULL,
  `server_id` varchar(30) DEFAULT NULL,
  `botAccessRole` varchar(20) DEFAULT NULL,
  `logsChannel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `serverconfigs`
--

CREATE TABLE `serverconfigs` (
  `serverid` int(11) NOT NULL,
  `json` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `system`
--

CREATE TABLE `system` (
  `maintenance` int(11) NOT NULL,
  `auth_maintenance` int(11) NOT NULL,
  `downloadlink` varchar(200) NOT NULL,
  `version` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_since` text NOT NULL,
  `usergroup` varchar(25) NOT NULL DEFAULT 'user',
  `avatarurl` text NOT NULL DEFAULT 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png',
  `2fa_secret` varchar(255) DEFAULT NULL,
  `2fa_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `discord` varchar(20) DEFAULT NULL,
  `is_emailConfirmed` int(11) NOT NULL DEFAULT 0,
  `emailcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_server`
--

CREATE TABLE `users_server` (
  `userid` int(11) NOT NULL,
  `serverid` int(11) NOT NULL,
  `is_owner` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `globalbanlist`
--
ALTER TABLE `globalbanlist`
  ADD PRIMARY KEY (`license`);

--
-- Indizes für die Tabelle `ipreset`
--
ALTER TABLE `ipreset`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`licenseid`);

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indizes für die Tabelle `panelbans`
--
ALTER TABLE `panelbans`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `userid` (`userid`);

--
-- Indizes für die Tabelle `playerlist`
--
ALTER TABLE `playerlist`
  ADD PRIMARY KEY (`idd`);

--
-- Indizes für die Tabelle `redem_license`
--
ALTER TABLE `redem_license`
  ADD PRIMARY KEY (`license`),
  ADD KEY `userid` (`userid`),
  ADD KEY `serverid` (`serverid`),
  ADD KEY `licenseid` (`licenseid`),
  ADD KEY `license` (`license`);

--
-- Indizes für die Tabelle `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`serverid`),
  ADD KEY `licenseid` (`licenseid`);

--
-- Indizes für die Tabelle `serverconfigs`
--
ALTER TABLE `serverconfigs`
  ADD PRIMARY KEY (`serverid`),
  ADD KEY `serverid` (`serverid`);

--
-- Indizes für die Tabelle `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indizes für die Tabelle `users_server`
--
ALTER TABLE `users_server`
  ADD PRIMARY KEY (`userid`,`serverid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `serverid` (`serverid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ipreset`
--
ALTER TABLE `ipreset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `keys`
--
ALTER TABLE `keys`
  MODIFY `licenseid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `playerlist`
--
ALTER TABLE `playerlist`
  MODIFY `idd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `server`
--
ALTER TABLE `server`
  MODIFY `serverid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
