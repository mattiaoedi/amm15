-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: mysql.netsons.com
-- Generato il: Feb 21, 2015 alle 20:48
-- Versione del server: 5.5.36-log
-- Versione PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xrvhkbvw_amm15`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `appelli`
--

CREATE TABLE IF NOT EXISTS `appelli` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `insegnamento` int(5) NOT NULL,
  `data` varchar(100) NOT NULL,
  `posti` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `insegnamento` (`insegnamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `appelli`
--

INSERT INTO `appelli` (`id`, `insegnamento`, `data`, `posti`) VALUES
(1, 1, '22/02/2015 00:00:00', 50),
(2, 1, '25/02/2015 00:00:00', 50);

-- --------------------------------------------------------

--
-- Struttura della tabella `corsi`
--

CREATE TABLE IF NOT EXISTS `corsi` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `dipartimento` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `diparimento` (`dipartimento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dump dei dati per la tabella `corsi`
--

INSERT INTO `corsi` (`id`, `nome`, `dipartimento`) VALUES
(1, 'Architettura', 1),
(2, 'Ingegneria delle telecomunicazioni', 1),
(3, 'Ingegneria ambientale', 1),
(4, 'Professioni sanitarie', 2),
(5, 'Medicina e chirurgia', 2),
(6, 'Odontoiatria', 2),
(7, 'Fisica', 3),
(8, 'Informatica', 3),
(9, 'Matematica', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `dipartimenti`
--

CREATE TABLE IF NOT EXISTS `dipartimenti` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `dipartimenti`
--

INSERT INTO `dipartimenti` (`id`, `nome`) VALUES
(1, 'Ingegneria e archittetura'),
(2, 'Medicina e chirurgia'),
(3, 'Scienze');

-- --------------------------------------------------------

--
-- Struttura della tabella `docenti`
--

CREATE TABLE IF NOT EXISTS `docenti` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `role` varchar(8) NOT NULL DEFAULT 'docente',
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `dipartimento` int(5) NOT NULL,
  `corso` int(5) DEFAULT NULL,
  `via` varchar(100) DEFAULT NULL,
  `civico` varchar(100) DEFAULT NULL,
  `citta` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `cap` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `ricevimento` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dipartimento` (`dipartimento`),
  KEY `corso` (`corso`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `docenti`
--

INSERT INTO `docenti` (`id`, `role`, `nome`, `cognome`, `dipartimento`, `corso`, `via`, `civico`, `citta`, `provincia`, `cap`, `email`, `ricevimento`, `username`, `password`, `data`) VALUES
(1, 'admin', 'Gianni', 'Fenu', 3, NULL, '', '', '', '', '', 'gi.fenu@amm15.net', '', 'gi.fenu1', '202cb962ac59075b964b07152d234b70', '2015-02-19 12:00:00'),
(2, 'docente', 'Davide', 'Spano', 3, 8, '', '', '', '', '', 'da.spano@amm15.net', '', 'da.spano2', '202cb962ac59075b964b07152d234b70', '2015-02-19 12:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `esami`
--

CREATE TABLE IF NOT EXISTS `esami` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `insegnamento` int(5) NOT NULL,
  `matricola` int(5) NOT NULL,
  `voto` int(2) NOT NULL,
  `docente` int(5) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matricola` (`matricola`),
  KEY `insegnamento` (`insegnamento`),
  KEY `docente` (`docente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `esami`
--

INSERT INTO `esami` (`id`, `insegnamento`, `matricola`, `voto`, `docente`, `data`) VALUES
(1, 1, 1, 25, 1, '2015-02-20 12:20:46'),
(2, 1, 1, 27, 1, '2015-02-20 17:43:40');

-- --------------------------------------------------------

--
-- Struttura della tabella `insegnamenti`
--

CREATE TABLE IF NOT EXISTS `insegnamenti` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `corso` int(50) NOT NULL,
  `docente` int(50) NOT NULL,
  `crediti` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `insegnamenti`
--

INSERT INTO `insegnamenti` (`id`, `nome`, `corso`, `docente`, `crediti`) VALUES
(1, 'Amministrazione di sistema', 8, 2, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `iscritti_appello`
--

CREATE TABLE IF NOT EXISTS `iscritti_appello` (
  `appello` int(5) NOT NULL,
  `studente` int(5) NOT NULL,
  PRIMARY KEY (`appello`,`studente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `iscritti_appello`
--

INSERT INTO `iscritti_appello` (`appello`, `studente`) VALUES
(0, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `studenti`
--

CREATE TABLE IF NOT EXISTS `studenti` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `role` varchar(8) NOT NULL DEFAULT 'studente',
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `corso` int(50) NOT NULL,
  `via` varchar(255) DEFAULT NULL,
  `civico` varchar(255) DEFAULT NULL,
  `citta` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `cap` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `corso` (`corso`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `studenti`
--

INSERT INTO `studenti` (`id`, `role`, `nome`, `cognome`, `corso`, `via`, `civico`, `citta`, `provincia`, `cap`, `email`, `username`, `password`, `data`) VALUES
(1, 'studente', 'Mattia', 'Sarritzu', 8, '', '', '', '', '', 'ma.sarritzu@amm15.net', 'ma.sarritzu1', '202cb962ac59075b964b07152d234b70', '2015-02-19 13:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
