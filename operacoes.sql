-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 24-Maio-2021 às 01:15
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `operacoes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id do cliente',
  `descricao` varchar(100) NOT NULL COMMENT 'descricao da moeda',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `moedas`
--

DROP TABLE IF EXISTS `moedas`;
CREATE TABLE IF NOT EXISTS `moedas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id da moeda',
  `descricao` varchar(100) NOT NULL COMMENT 'descrição da moeda',
  `valor` float NOT NULL COMMENT 'valro atual da moeda\r\n',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `operacoes`
--

DROP TABLE IF EXISTS `operacoes`;
CREATE TABLE IF NOT EXISTS `operacoes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id da operação',
  `id_moeda_origem` smallint(6) NOT NULL COMMENT 'id da moeda origem',
  `id_moeda_destino` smallint(6) NOT NULL COMMENT 'id da moeda destino',
  `id_cliente` int(11) NOT NULL COMMENT 'id do cliente',
  `data_operacao` date NOT NULL COMMENT 'data da operação',
  `valor_original` float NOT NULL COMMENT 'valor original',
  `valor_convertido` float NOT NULL COMMENT 'valor convertido',
  `taxa_operacao` float NOT NULL COMMENT 'taxa cobrada',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
