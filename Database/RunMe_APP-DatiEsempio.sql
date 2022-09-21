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
-- Dump dei dati per la tabella `Esecuzioni`
--

INSERT INTO `Esecuzioni` (`id`, `nome`, `descrizione`, `eseguibile`, `mostraOutput`, `disabilitato`) VALUES
(1, 'Lista', 'Mostra i file presenti nella cartella corrente. Solo parametri senza valori', 'ls.sh', 1, 0),
(2, 'HelloWorld', 'Nessun parametro, exitcode casuale', 'hello.sh', 1, 0),
(3, 'NoHello', 'Parametri obbligatori, ma nessun output', 'hello.sh', 0, 0),
(4, 'Mirror', 'Tutti i tipi di parametri. Restituisce il comando eseguito.', 'mirror.sh', 1, 0),
(5, 'Fail', 'Comando non esistente o non eseguibile.', 'nonexist.sh', 0, 0);

-- --------------------------------------------------------

--
-- Dump dei dati per la tabella `Parametri`
--

INSERT INTO `Parametri` (`id`, `idEsecuzione`, `nome`, `descrizione`, `pre`, `valore`, `post`, `tipoParametro`, `tipoValore`) VALUES
(3, 1, '-a', 'Mostra i file nascosti', '', '-a', '', 2, 0),
(4, 1, '-l', 'Formato Lungo', '-l', '', '', 2, 0),
(5, 1, '-t', 'Ordina per data', '', '', '-t', 2, 0),
(6, 3, 'Risposta', 'Cosa rispondi al saluto?', '--risposta=\"', '', '\"', 0, 2),
(7, 4, 'Parametro 1', 'facoltativo, senza valore', '--p1 ', 'si', '', 1, 0),
(8, 4, 'Parametro 2', 'obbligatorio, ma può essere vuoto', '--p2 ', 'si', '', 0, 1),
(9, 4, 'Parametro 3', 'obbligatorio che NON può essere vuoto', '--p3 ', 'si', '', 0, 2),
(10, 4, 'Parametro 4', 'facoltativo (non attivo di default)', '--p4 ', 'si', '', 2, 1),
(11, 4, 'Parametro 5', 'Nascosto', '-p5 ', 'nascosto', '', 3, 1);

-- --------------------------------------------------------

--
-- Dump dei dati per la tabella `Permessi`
--

INSERT INTO `Permessi` (`id`, `idUtente`, `idEsecuzione`) VALUES
(2, 4, 1),
(3, -1, 3),
(4, 4, 5),
(5, 4, 2),
(6, 4, 4),
(7, 20, 1),
(8, 20, 4);

-- --------------------------------------------------------

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`id`, `username`, `password`, `email`, `admin`) VALUES
(4, 'user1', '5f4dcc3b5aa765d61d8327deb882cf99', 'user1@runme.it', 0),
(20, 'user2', '5f4dcc3b5aa765d61d8327deb882cf99', 'user2@runme.it', 0);


--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Esecuzioni`
--
ALTER TABLE `Esecuzioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `Log`
--
ALTER TABLE `Log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Parametri`
--
ALTER TABLE `Parametri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `Permessi`
--
ALTER TABLE `Permessi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `Utenti`
--
ALTER TABLE `Utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
