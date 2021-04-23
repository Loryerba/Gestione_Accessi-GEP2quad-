-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Mar 02, 2021 alle 11:03
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
  `Password_` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `Administrator`
--

INSERT INTO `Administrator` (`Id_A`, `Nome`, `Cognome`, `Email`, `Password_`) VALUES
(1, 'Matteo', 'Cacciarino', 'matcaccia', 'ciao123');

-- --------------------------------------------------------

--
-- Struttura della tabella `Log`
--

CREATE TABLE `Log` (
  `Id_L` int(11) NOT NULL,
  `OraL` time NOT NULL,
  `DataL` date NOT NULL,
  `Id_A` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `MeP`
--

CREATE TABLE `MeP` (
  `Id_MP` int(11) NOT NULL,
  `CheckIn` datetime NOT NULL,
  `CheckOut` datetime NOT NULL,
  `Id_M` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 'Lorenzo', 'Erba', 'lorerba');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Administrator`
--
ALTER TABLE `Administrator`
  ADD PRIMARY KEY (`Id_A`);

--
-- Indici per le tabelle `Log`
--
ALTER TABLE `Log`
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
  MODIFY `Id_A` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `Log`
--
ALTER TABLE `Log`
  MODIFY `Id_L` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Meeting`
--
ALTER TABLE `Meeting`
  MODIFY `Id_M` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `MeP`
--
ALTER TABLE `MeP`
  MODIFY `Id_MP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Partecipanti`
--
ALTER TABLE `Partecipanti`
  MODIFY `Id_P` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Log`
--
ALTER TABLE `Log`
  ADD CONSTRAINT `Log_ibfk_1` FOREIGN KEY (`Id_A`) REFERENCES `Administrator` (`Id_A`) ON DELETE CASCADE ON UPDATE CASCADE;

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
