-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Ott 06, 2022 alle 11:14
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

--
-- Dump dei dati per la tabella `Esecuzioni`
--

INSERT INTO `Esecuzioni` (`id`, `nome`, `descrizione`, `eseguibile`, `mostraOutput`, `abilitato`) VALUES
(1, 'Lista', 'Mostra i file presenti nella cartella corrente. Solo parametri senza valori', 'ls.sh', 1, 1),
(2, 'HelloWorld', 'Nessun parametro, exitcode casuale', 'hello.sh', 1, 1),
(3, 'NoHello', 'Parametri obbligatori, ma nessun output', 'hello.sh', 0, 1),
(4, 'Mirror', 'Tutti i tipi di parametri. Restituisce il comando eseguito.', 'mirror.sh', 1, 1),
(5, 'Fail', 'Comando non esistente o non eseguibile.', 'nonexist.sh', 0, 1);

--
-- Dump dei dati per la tabella `Log`
--

INSERT INTO `Log` (`id`, `idAdmin`, `idUtente`, `idEsecuzione`, `data`, `tipo`, `testo`) VALUES
(8, NULL, NULL, 3, '2022-09-22 17:33:56', 0, 'L\'utente <i>anonimo</i> ha eseguito <strong>NoHello</strong> (3)'),
(9, NULL, -1, 3, '2022-09-24 16:19:18', 0, 'L\'utente <i>anonimo</i> ha eseguito <strong>NoHello</strong> (3)'),
(10, NULL, 0, 4, '2022-09-24 16:24:41', 0, 'L\'utente <strong>admin</strong> ha eseguito <strong>Mirror</strong> (4)'),
(12, NULL, 0, 1, '2022-09-25 16:25:54', 0, 'L\'utente <strong>admin</strong> ha eseguito <strong>Lista</strong> (1)'),
(41, 0, -1, 1, '2022-09-27 17:14:58', 38, 'L\'amministratore <strong>admin</strong> ha autorizzato <strong>_anonymous_</strong> ad eseguire <strong>Lista</strong>'),
(42, 0, -1, 2, '2022-09-27 17:19:11', 38, 'L\'amministratore <strong>admin</strong> ha autorizzato <strong>_anonymous_</strong> ad eseguire <strong>HelloWorld</strong>'),
(43, 0, 0, 1, '2022-09-27 17:19:20', 38, 'L\'amministratore <strong>admin</strong> ha autorizzato <strong>admin</strong> ad eseguire <strong>Lista</strong>'),
(44, 0, 0, 1, '2022-09-27 17:19:23', 39, 'L\'amministratore <strong>admin</strong> ha impedito a <strong>admin</strong> di eseguire <strong>Lista</strong>'),
(51, NULL, -1, 2, '2022-09-28 07:33:54', 0, 'L\'utente <i>anonimo</i> ha eseguito <strong>HelloWorld</strong> (2)'),
(52, NULL, -1, 2, '2022-09-28 07:34:02', 0, 'L\'utente <i>anonimo</i> ha eseguito <strong>HelloWorld</strong> (2)'),
(53, 0, -1, 1, '2022-09-28 07:34:24', 39, 'L\'amministratore <strong>admin</strong> ha impedito a <strong>_Utente Guest_</strong> di eseguire <strong>Lista</strong>'),
(69, NULL, 0, 2, '2022-09-28 14:49:00', 0, 'L\'utente <strong>admin</strong> ha eseguito <strong>HelloWorld</strong> (2)'),
(88, 0, 28, NULL, '2022-10-06 08:08:30', 10, 'L\'amministratore <strong>admin</strong> ha creato l\'utente <strong>user1</strong>'),
(89, 0, 28, 1, '2022-10-06 08:08:50', 38, 'L\'amministratore <strong>admin</strong> ha autorizzato <strong>user1</strong> ad eseguire <strong>Lista</strong>'),
(90, 0, 28, 4, '2022-10-06 08:08:50', 38, 'L\'amministratore <strong>admin</strong> ha autorizzato <strong>user1</strong> ad eseguire <strong>Mirror</strong>'),
(91, NULL, 28, 1, '2022-10-06 08:09:28', 0, 'L\'utente <strong>user1</strong> ha eseguito <strong>Lista</strong> (1)'),
(92, NULL, 28, 1, '2022-10-06 08:10:37', 0, 'L\'utente <strong>user1</strong> ha eseguito <strong>Lista</strong> (1)'),
(93, NULL, 28, 1, '2022-10-06 08:14:26', 0, 'L\'utente <strong>user1</strong> ha eseguito <strong>Lista</strong> (1)'),
(94, NULL, 28, 1, '2022-10-06 08:15:09', 0, 'L\'utente <strong>user1</strong> ha eseguito <strong>Lista</strong> (1)'),
(95, NULL, 28, 1, '2022-10-06 08:16:55', 0, 'L\'utente <strong>user1</strong> ha eseguito <strong>Lista</strong> (1)'),
(96, NULL, 28, 1, '2022-10-06 08:17:13', 0, 'L\'utente <strong>user1</strong> ha eseguito <strong>Lista</strong> (1)');

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

--
-- Dump dei dati per la tabella `Permessi`
--

INSERT INTO `Permessi` (`id`, `idUtente`, `idEsecuzione`) VALUES
(14, -1, 2),
(19, 28, 1),
(20, 28, 4);

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`id`, `username`, `password`, `email`, `admin`, `abilitato`) VALUES
(1, 'user1', '5f4dcc3b5aa765d61d8327deb882cf99', '', 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
