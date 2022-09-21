-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Set 21, 2022 alle 17:52
-- Versione del server: 10.5.15-MariaDB-0+deb11u1
-- Versione PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RunMe_APP`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Esecuzioni`
--

CREATE TABLE `Esecuzioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `eseguibile` varchar(255) NOT NULL,
  `mostraOutput` tinyint(1) NOT NULL,
  `disabilitato` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Log`
--

CREATE TABLE `Log` (
  `id` int(11) NOT NULL,
  `idAdmin` int(11) DEFAULT NULL,
  `idUtente` int(11) DEFAULT NULL,
  `idEsecuzione` int(11) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `testo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Parametri`
--

CREATE TABLE `Parametri` (
  `id` int(11) NOT NULL,
  `idEsecuzione` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `descrizione` varchar(255) NOT NULL,
  `pre` varchar(50) DEFAULT NULL,
  `valore` varchar(50) DEFAULT NULL,
  `post` varchar(50) DEFAULT NULL,
  `tipoParametro` int(11) NOT NULL,
  `tipoValore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Permessi`
--

CREATE TABLE `Permessi` (
  `id` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL,
  `idEsecuzione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(130) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`id`, `username`, `password`, `email`, `admin`) VALUES
(-1, '_anonymous_', 'aaa', NULL, 0),
(0, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin@runme.it', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Esecuzioni`
--
ALTER TABLE `Esecuzioni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indici per le tabelle `Log`
--
ALTER TABLE `Log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log-id_admin` (`idAdmin`),
  ADD KEY `log-id_utente` (`idUtente`),
  ADD KEY `log-id_esecuzione` (`idEsecuzione`);

--
-- Indici per le tabelle `Parametri`
--
ALTER TABLE `Parametri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome-esecuzione` (`idEsecuzione`,`nome`);

--
-- Indici per le tabelle `Permessi`
--
ALTER TABLE `Permessi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_esecuzione` (`idEsecuzione`) USING BTREE,
  ADD KEY `permessi-id_utente` (`idUtente`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Log`
--
ALTER TABLE `Log`
  ADD CONSTRAINT `log-id_admin` FOREIGN KEY (`idAdmin`) REFERENCES `Utenti` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `log-id_esecuzione` FOREIGN KEY (`idEsecuzione`) REFERENCES `Esecuzioni` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `log-id_utente` FOREIGN KEY (`idUtente`) REFERENCES `Utenti` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `Parametri`
--
ALTER TABLE `Parametri`
  ADD CONSTRAINT `parametri-id_esecuzione` FOREIGN KEY (`idEsecuzione`) REFERENCES `Esecuzioni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Permessi`
--
ALTER TABLE `Permessi`
  ADD CONSTRAINT `permessi-id_esecuzione` FOREIGN KEY (`idEsecuzione`) REFERENCES `Esecuzioni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permessi-id_utente` FOREIGN KEY (`idUtente`) REFERENCES `Utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
