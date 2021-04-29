-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Apr 23, 2021 alle 08:53
-- Versione del server: 10.3.16-MariaDB
-- Versione PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16206619_dbaccessi`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Administrator`
--

CREATE TABLE `Administrator` (
  `Id_A` int(11) NOT NULL,
  `Nome` text COLLATE utf8_unicode_ci NOT NULL,
  `Cognome` text COLLATE utf8_unicode_ci NOT NULL,
  `Email` text COLLATE utf8_unicode_ci NOT NULL,
  `Password_` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `Administrator`
--

INSERT INTO `Administrator` (`Id_A`, `Nome`, `Cognome`, `Email`, `Password_`) VALUES
(16, 'Matteo', 'Cacciarino', 'matcacciarino@gmail.com', '$2y$10$bLXOGcwEEuFYsY.XA/6EHOXGwqLBp7WSw/T0SeK5p4vVrvt4HClwi'),
(17, 'Davide', 'Corbetta', 'davidecorbetta@outlook.com', '$2y$10$awfu2MCt6NzUxd9BOEQwXeHuVwb23tfP5enA3PFIarrNWU5Q.WOyC'),
(18, 'Account', 'Prova', 'prova@hotmail.com', '$2y$10$yz4Ox/xJCBkgDEPiZrGacuAcyAAitbGqYCc6SSLRYVXo3YWEWkE0G'),
(19, 'sa', 'sa', 'sa@sa.sa', '$2y$10$J0ih4nia6qceEgYqHJ3mWexvoReUVDrrZsfuFXaSsXMm3q9M4k4/6');

-- --------------------------------------------------------

--
-- Struttura della tabella `Logs`
--

CREATE TABLE `Logs` (
  `Id_L` int(11) NOT NULL,
  `OraL` time NOT NULL,
  `DataL` date NOT NULL,
  `Descrizione` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `Id_A` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `Logs`
--

INSERT INTO `Logs` (`Id_L`, `OraL`, `DataL`, `Descrizione`, `Id_A`) VALUES
(92, '15:47:00', '2021-03-23', 'Administrator logged in', 16),
(93, '15:48:00', '2021-03-23', 'Administrator logged in', 17),
(94, '15:49:00', '2021-03-23', 'Administrator logged in', 18),
(95, '15:49:00', '2021-03-23', 'Administrator logged in', 16),
(96, '15:54:00', '2021-03-23', 'Administrator logged in', 16),
(97, '20:17:00', '2021-03-23', 'Administrator logged in', 17),
(98, '20:43:00', '2021-03-23', 'Administrator logged in', 17),
(99, '14:32:00', '2021-03-24', 'Administrator logged in', 16),
(100, '14:36:00', '2021-03-24', 'Administrator logged in', 16),
(101, '15:37:00', '2021-03-25', 'Administrator logged in', 16),
(102, '16:23:00', '2021-03-25', 'Administrator logged in', 16),
(103, '16:25:00', '2021-03-25', 'Administrator created a meeting', 16),
(104, '16:28:00', '2021-03-25', 'Administrator created a meeting', 16),
(105, '16:29:00', '2021-03-25', 'Administrator created a meeting', 16),
(106, '21:24:00', '2021-03-25', 'Administrator logged in', 17),
(107, '21:11:00', '2021-03-26', 'Administrator logged in', 17),
(108, '15:13:00', '2021-03-27', 'Administrator logged in', 16),
(109, '15:43:00', '2021-03-27', 'Administrator logged in', 16),
(110, '15:50:00', '2021-03-27', 'Administrator logged in', 16),
(111, '15:53:00', '2021-03-27', 'Administrator logged in', 16),
(112, '16:06:00', '2021-03-27', 'Administrator logged in', 16),
(113, '16:11:00', '2021-03-27', 'Administrator modified a meeting where id meeting is 29', 16),
(114, '16:15:00', '2021-03-27', 'Administrator logged in', 16),
(115, '16:16:00', '2021-03-27', 'Administrator logged in', 16),
(116, '16:16:00', '2021-03-27', 'Administrator logged in', 16),
(117, '16:18:00', '2021-03-27', 'Administrator logged in', 16),
(118, '16:18:00', '2021-03-27', 'Administrator logged in', 16),
(119, '16:56:00', '2021-03-27', 'Administrator logged in', 16),
(120, '17:38:00', '2021-03-27', 'Administrator logged in', 16),
(121, '17:42:00', '2021-03-27', 'Administrator logged in', 16),
(122, '17:42:00', '2021-03-27', 'Administrator created a meeting', 16),
(123, '17:49:00', '2021-03-27', 'Administrator deleted a meeting where id meeting is 27', 16),
(124, '17:49:00', '2021-03-27', 'Administrator deleted a meeting where id meeting is 29', 16),
(125, '17:49:00', '2021-03-27', 'Administrator deleted a meeting where id meeting is 30', 16),
(126, '17:54:00', '2021-03-27', 'Administrator logged in', 16),
(127, '17:57:00', '2021-03-27', 'Administrator logged in', 16),
(128, '17:58:00', '2021-03-27', 'Administrator logged in', 16),
(129, '17:59:00', '2021-03-27', 'Administrator logged in', 16),
(130, '18:05:00', '2021-03-27', 'Administrator logged in', 16),
(131, '18:08:00', '2021-03-27', 'Administrator created a meeting', 16),
(132, '18:08:00', '2021-03-27', 'Administrator logged in', 16),
(133, '10:51:00', '2021-03-28', 'Administrator logged in', 16),
(134, '10:52:00', '2021-03-30', 'Administrator logged in', 17),
(135, '15:21:00', '2021-04-06', 'Administrator logged in', 16),
(136, '15:59:00', '2021-04-06', 'Administrator logged in', 17),
(137, '16:01:00', '2021-04-06', 'Administrator logged in', 16),
(138, '16:19:00', '2021-04-06', 'Administrator logged in', 16),
(139, '16:31:00', '2021-04-06', 'Administrator created a meeting', 16),
(140, '16:32:00', '2021-04-06', 'Administrator created a meeting', 16),
(141, '16:35:00', '2021-04-06', 'Administrator created a meeting', 16),
(142, '15:48:00', '2021-04-07', 'Administrator logged in', 16),
(143, '16:42:00', '2021-04-07', 'Administrator logged in', 16),
(144, '16:52:00', '2021-04-07', 'Administrator logged in', 16),
(145, '18:28:00', '2021-04-07', 'Administrator logged in', 17),
(146, '10:45:00', '2021-04-10', 'Administrator logged in', 17),
(147, '16:48:00', '2021-04-13', 'Administrator logged in', 16),
(148, '16:58:00', '2021-04-13', 'Administrator logged in', 16),
(149, '17:21:00', '2021-04-13', 'Administrator deleted a meeting where id meeting is 34', 16),
(150, '18:20:00', '2021-04-13', 'Administrator modified a meeting where id meeting is 31', 16),
(151, '08:11:00', '2021-04-14', 'Administrator logged in', 17),
(152, '11:14:00', '2021-04-14', 'Administrator logged in', 16),
(153, '11:25:00', '2021-04-20', 'Administrator logged in', 16),
(154, '11:26:00', '2021-04-20', 'Administrator logged in', 17),
(155, '11:26:00', '2021-04-20', 'Administrator logged in', 17),
(156, '11:36:00', '2021-04-20', 'Administrator logged in', 16),
(157, '11:37:00', '2021-04-20', 'Administrator logged in', 17),
(158, '11:37:00', '2021-04-20', 'Administrator logged in', 16),
(159, '11:37:00', '2021-04-20', 'Administrator logged in', 17),
(160, '11:40:00', '2021-04-20', 'Administrator logged in', 16),
(161, '11:42:00', '2021-04-20', 'Administrator logged in', 16),
(162, '11:42:00', '2021-04-20', 'Administrator logged in', 16),
(163, '11:44:00', '2021-04-20', 'Administrator logged in', 16),
(164, '11:45:00', '2021-04-20', 'Administrator logged in', 16),
(165, '11:46:00', '2021-04-20', 'Administrator logged in', 16),
(166, '11:56:00', '2021-04-20', 'Administrator logged in', 17);

-- --------------------------------------------------------

--
-- Struttura della tabella `Meeting`
--

CREATE TABLE `Meeting` (
  `Id_M` int(11) NOT NULL,
  `DataM` date NOT NULL,
  `OraM` time NOT NULL,
  `Id_A` int(11) NOT NULL,
  `Id_P` int(11) NOT NULL,
  `Descrizione` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `Meeting`
--

INSERT INTO `Meeting` (`Id_M`, `DataM`, `OraM`, `Id_A`, `Id_P`, `Descrizione`) VALUES
(31, '2021-04-14', '17:11:00', 16, 1, ' provsa qrmodifi'),
(32, '2021-04-07', '16:34:00', 16, 1, ' ciao'),
(33, '2021-04-07', '16:32:00', 16, 1, ' ciao');

-- --------------------------------------------------------

--
-- Struttura della tabella `MeP`
--

CREATE TABLE `MeP` (
  `Id_MP` int(11) NOT NULL,
  `CheckIn` time NOT NULL,
  `CheckOut` time NOT NULL,
  `Id_M` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `MeP`
--

INSERT INTO `MeP` (`Id_MP`, `CheckIn`, `CheckOut`, `Id_M`) VALUES
(46, '18:09:00', '18:09:00', 31);

-- --------------------------------------------------------

--
-- Struttura della tabella `Partecipanti`
--

CREATE TABLE `Partecipanti` (
  `Id_P` int(11) NOT NULL,
  `Nome` text COLLATE utf8_unicode_ci NOT NULL,
  `Cognome` text COLLATE utf8_unicode_ci NOT NULL,
  `Email` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `Partecipanti`
--

INSERT INTO `Partecipanti` (`Id_P`, `Nome`, `Cognome`, `Email`) VALUES
(1, 'Lorenzo', 'Erba', 'loryerba25@libero.it'),
(3, 'Cliente', 'Cliente', 'cliente@gmail.com'),
(4, 'dfgsdfg', 'sfdgsdgrf', 'sfdgsfg@dsfsdf.it');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Administrator`
--
ALTER TABLE `Administrator`
  ADD PRIMARY KEY (`Id_A`);

--
-- Indici per le tabelle `Logs`
--
ALTER TABLE `Logs`
  ADD PRIMARY KEY (`Id_L`),
  ADD KEY `Id_A` (`Id_A`);

--
-- Indici per le tabelle `Meeting`
--
ALTER TABLE `Meeting`
  ADD PRIMARY KEY (`Id_M`),
  ADD KEY `Id_A` (`Id_A`),
  ADD KEY `Id_P` (`Id_P`);

--
-- Indici per le tabelle `MeP`
--
ALTER TABLE `MeP`
  ADD PRIMARY KEY (`Id_MP`),
  ADD KEY `Id_M` (`Id_M`);

--
-- Indici per le tabelle `Partecipanti`
--
ALTER TABLE `Partecipanti`
  ADD PRIMARY KEY (`Id_P`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Administrator`
--
ALTER TABLE `Administrator`
  MODIFY `Id_A` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `Logs`
--
ALTER TABLE `Logs`
  MODIFY `Id_L` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT per la tabella `Meeting`
--
ALTER TABLE `Meeting`
  MODIFY `Id_M` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT per la tabella `MeP`
--
ALTER TABLE `MeP`
  MODIFY `Id_MP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT per la tabella `Partecipanti`
--
ALTER TABLE `Partecipanti`
  MODIFY `Id_P` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Logs`
--
ALTER TABLE `Logs`
  ADD CONSTRAINT `Logs_ibfk_1` FOREIGN KEY (`Id_A`) REFERENCES `Administrator` (`Id_A`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Meeting`
--
ALTER TABLE `Meeting`
  ADD CONSTRAINT `Meeting_ibfk_2` FOREIGN KEY (`Id_A`) REFERENCES `Administrator` (`Id_A`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Meeting_ibfk_3` FOREIGN KEY (`Id_P`) REFERENCES `Partecipanti` (`Id_P`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `MeP`
--
ALTER TABLE `MeP`
  ADD CONSTRAINT `MeP_ibfk_1` FOREIGN KEY (`Id_M`) REFERENCES `Meeting` (`Id_M`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
