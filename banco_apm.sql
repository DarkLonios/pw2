-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 23-Jun-2019 às 06:29
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `banco_apm`
--
CREATE DATABASE IF NOT EXISTS `banco_apm` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `banco_apm`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_aluno`
--

CREATE TABLE IF NOT EXISTS `tabela_aluno` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `telefone` varchar(50) COLLATE utf8_bin NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(5,2) NOT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tabela_aluno`
--

INSERT INTO `tabela_aluno` (`matricula`, `nome`, `email`, `telefone`, `data`, `valor`) VALUES
(8, 'hfdiufhduifhsdi', 'ggsgs@hotmail.com', '254825418548', '2019-04-08', '50.00'),
(22, 'gdsaugduays', 'sagsauygsuy@hotmail.com', '193563565', '2000-02-20', '200.00'),
(585, 'fjdujfsd', 'hfduhs@hotmail.com', '0526', '2019-05-14', '363.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_professores`
--

CREATE TABLE IF NOT EXISTS `tabela_professores` (
  `matricula` int(5) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telefone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `data` date DEFAULT NULL,
  `valor` decimal(5,2) DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tabela_professores`
--

INSERT INTO `tabela_professores` (`matricula`, `nome`, `email`, `telefone`, `celular`, `data`, `valor`, `foto`) VALUES
(2, 'aguyhsgauysagyu', 'saghisah@hotmail.com', '33533', '119999', '1997-06-05', '200.00', NULL),
(24, 'D', 'D@hotmail.com', '193502314', '199350013', '2019-06-04', '600.00', 'a2301b1bae2e0d09cf28a98a8f0ab27c.'),
(52, 'Ramon P', 'ramonp@hotmail.com', '19335353', '1999999', '2019-06-10', '600.00', 'c6ef23f959343e4ae52d2322f66f6abc.jpg'),
(648, 'Fulano De Tal', 'Fulanodetal@hotmail.com', '19352310', '1996632000', '0000-00-00', '600.00', NULL),
(686, 'Fulano De Tal', 'Fulanodetal@hotmail.com', '19352310', '1996632000', '0000-00-00', '600.00', NULL),
(842, 'dhasidha', 'dhasudhisa@hotmail.com', '04805', '9842', '2019-05-14', '800.00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_usuarios`
--

CREATE TABLE IF NOT EXISTS `tabela_usuarios` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `senha` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `tipo` char(1) COLLATE utf8_bin DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `tabela_usuarios`
--

INSERT INTO `tabela_usuarios` (`id`, `login`, `senha`, `nome`, `tipo`, `foto`) VALUES
(1, 'ramon', '321', 'Ramon Pessoa', 'S', ''),
(2, 'ramon', '123', 'ramon', 'M', ''),
(3, 'ramon', '181', 'ramon', 'S', ''),
(4, 'ramon', '0123', 'ramon', 'C', ''),
(5, 'ramon', '848', 'ramon', 'S', ''),
(6, 'ramon', 'd848', 'ramon', 'M', ''),
(7, 'dri', '234', 'Adriano Virgilio', 'S', ''),
(8, 'ramon', '1234', 'ramon', 'S', ''),
(9, 'RamonP', '8e3308c853e47411c761429193511819', 'ramon', 'S', ''),
(10, 'ramon', 'fae0b27c451c728867a567e8c1bb4e53', 'ramon', 'S', ''),
(11, 'ramon', '0a113ef6b61820daa5611c870ed8d5ee', 'ramon', 'S', ''),
(12, 'ramonG', '550a141f12de6341fba65b0ad0433500', 'ramonG', 'S', '235bbe550e45135658992924863ee6f9.png'),
(13, 'RamonD', 'fae0b27c451c728867a567e8c1bb4e53', 'ramond', 'S', 'e5a1796a6d7b501fb7fb73b86886591d.png'),
(14, 'D', 'fae0b27c451c728867a567e8c1bb4e53', 'D', 'S', 'a7184fa10ade8ea15dc3ca50639b1fd3.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
