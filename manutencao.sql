-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04-Maio-2022 às 10:18
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `manutencao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `checklist`
--

CREATE TABLE IF NOT EXISTS `checklist` (
`id` int(10) NOT NULL,
  `maquina` int(10) NOT NULL,
  `data` date NOT NULL,
  `obs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `checklist`
--

INSERT INTO `checklist` (`id`, `maquina`, `data`, `obs`) VALUES
(1, 55, '2022-04-19', 'ALTERADO ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `checklistitens`
--

CREATE TABLE IF NOT EXISTS `checklistitens` (
`id` int(10) NOT NULL,
  `idchecklist` int(10) NOT NULL,
  `item` int(10) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `checklistitens`
--

INSERT INTO `checklistitens` (`id`, `idchecklist`, `item`, `descricao`) VALUES
(1, 1, 1, 'teste'),
(2, 1, 2, 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `componente`
--

CREATE TABLE IF NOT EXISTS `componente` (
`idcomponente` int(11) NOT NULL,
  `maquina` int(10) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `frequencia` int(11) NOT NULL,
  `dataultima` date NOT NULL,
  `dataproxima` date NOT NULL,
  `verificacao` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `componente`
--

INSERT INTO `componente` (`idcomponente`, `maquina`, `descricao`, `frequencia`, `dataultima`, `dataproxima`, `verificacao`) VALUES
(2, 18, 'MANGUEIRAS', 365, '2022-04-15', '2023-04-15', 'trincamento ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `corretiva`
--

CREATE TABLE IF NOT EXISTS `corretiva` (
`idcorretiva` int(11) NOT NULL,
  `maquina` int(10) NOT NULL,
  `componente` int(11) DEFAULT NULL,
  `datainicio` date NOT NULL,
  `obs` longtext,
  `datafim` date DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE IF NOT EXISTS `itens` (
`id` int(10) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`id`, `descricao`) VALUES
(2, 'RUIDO'),
(3, 'produção'),
(4, 'RAÇÃO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE IF NOT EXISTS `local` (
`idlocal` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `local`
--

INSERT INTO `local` (`idlocal`, `descricao`) VALUES
(1, 'FABRICACAO DE COMPONENTES'),
(2, 'SOLDA'),
(3, 'REFRIGERACAO'),
(4, 'SOLDA ORDENHA'),
(5, 'SALA DOS COPRESSORES'),
(6, 'PRODUCAO'),
(7, 'BARRACAO NOVO'),
(12, 'AO LADO DOS COMPRESSORES'),
(13, 'MANUTENÇAO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `maquina`
--

CREATE TABLE IF NOT EXISTS `maquina` (
`idmaquina` int(11) NOT NULL,
  `numero` varchar(200) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `local` int(11) NOT NULL,
  `frequencia` int(10) DEFAULT NULL,
  `dataultima` date DEFAULT NULL,
  `dataproxima` date DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `maquina`
--

INSERT INTO `maquina` (`idmaquina`, `numero`, `descricao`, `local`, `frequencia`, `dataultima`, `dataproxima`) VALUES
(55, 'RF-A001', 'SERRA TUBO ', 1, 7, '2022-04-19', '2022-04-26'),
(2, 'RF-A002', 'CORTE PLASMA 7MT', 1, 10, '2022-04-10', '2022-04-20'),
(5, 'RF-A004', 'SOLDA PONTO BAMTECH GS30', 1, NULL, NULL, NULL),
(6, 'RF-A005', 'SOLDA PONTO CASENOTE', 1, NULL, NULL, NULL),
(7, 'RF-A006', 'SOLDA PONTO CASENOTE CPP', 1, NULL, NULL, NULL),
(8, 'RF-A007', 'SOLDA COSTURA COMPULSOLDA', 1, NULL, NULL, NULL),
(9, 'RF-A008', 'COMPRESSOR DE PARAFUSO SEM  SECADOR DE AR', 5, NULL, NULL, NULL),
(10, 'RF-A009', 'COMPRESSOR DE PARAFUSO  COM SECADOR DE AR ', 5, NULL, NULL, NULL),
(11, 'RF-A010', 'LIXADEIRA DE FUNDOS CILINDRICOS', 1, NULL, NULL, NULL),
(12, 'RF-A011', 'INJETORA DE PU', 4, NULL, NULL, NULL),
(13, 'RF-A012', 'TORNO CNC NARDINI', 3, NULL, NULL, NULL),
(14, 'RF-A013', 'TORNO  CONVENCIONALNARDINI', 3, NULL, NULL, NULL),
(15, 'RF-A014', 'BOMBA DE VACUO EDWARDS TRIFASICO', 3, NULL, NULL, NULL),
(16, 'RF-A015', 'BOMBA DE VACUO EDWARDS MONOFASICO', 3, NULL, NULL, NULL),
(17, 'RF-A16', 'BOMBA LAVADORA DE TANQUES ', 3, NULL, NULL, NULL),
(18, 'RF-A016', 'BOMBA CALIBRAÇAO ', 3, NULL, NULL, NULL),
(19, 'RF-A018', 'BOMBA PRESSAO CALIBRAÇAO', 3, NULL, NULL, NULL),
(20, 'RF-A020', 'PRENSA MSL 160T-C', 1, NULL, NULL, NULL),
(21, 'RF-A021', 'LASER CFFP30150 3000W', 1, NULL, NULL, NULL),
(22, 'RF-B001', 'DOBRADEIRA DE TUBOS ZA102R3CLPI', 7, NULL, NULL, NULL),
(23, 'RF-B002', 'GUILHOTINA 3Q10', 1, NULL, NULL, NULL),
(24, 'RF-B003', 'DOBRADEIRA PSH 17530', 1, NULL, NULL, NULL),
(25, 'RF-B004', 'BORDEADEIRA BTL3002', 1, NULL, NULL, NULL),
(26, 'RF-B005', 'BANCO DE SOLDA PSLR4005', 7, NULL, NULL, NULL),
(27, 'RF-B006', 'BANCO DE SOLDA S/P', 7, NULL, NULL, NULL),
(28, 'RF-B007', 'CALANDRA CIE 3006', 7, NULL, NULL, NULL),
(29, 'RF-B008', 'PRENSA HIDRAULICA 20T', 1, NULL, NULL, NULL),
(30, 'RF-B009', 'CALANDRA MM MAQUINAS', 1, NULL, NULL, NULL),
(31, 'RF-B010', 'TALHA ELETRICA GL12PDL', 1, NULL, NULL, NULL),
(32, 'RF-B011', 'LIXADEIRA DE FUNDOS QUADRADOS LCR5025', 1, NULL, NULL, NULL),
(34, 'RF-B012', 'BOMBA DE REFRIGERAÇAO DAS PONTEADEIRAS ', 12, NULL, NULL, NULL),
(35, 'RF-B013', 'BOMBA DE REFRIGERAÇAO DAS PONTEADEIRAS RESERVA', 13, NULL, NULL, NULL),
(36, 'RF-B014', 'BOMBA DE REFRIGERAÇAO DAS PONTEADEIRAS INTERNA', 1, NULL, NULL, NULL),
(37, 'RF-B015', 'POLETRIZ A', 1, NULL, NULL, NULL),
(38, 'RF-B016', 'POLETRIZ B', 1, NULL, NULL, NULL),
(39, 'RF-B017', 'EXAUSTOR POLETRIZ A', 1, NULL, NULL, NULL),
(40, 'RF-B018', 'EXAUSTOR POLETRIZ B', 1, NULL, NULL, NULL),
(41, 'RF-B019', 'CABINE DE PINTURA ARPI', 1, NULL, NULL, NULL),
(42, 'RF-B020', 'CALANDRA GMTR CPR1503', 4, NULL, NULL, NULL),
(43, 'RF-B021', 'SERRA TUBO CH-350HA', 7, NULL, NULL, NULL),
(44, 'RF-B022', 'CALIBRAÇAO THF', 7, NULL, NULL, NULL),
(45, 'RF-C002', 'POSICINADOR DE CHAPAS NFER2500', 7, NULL, NULL, NULL),
(48, 'RF-C004', 'PONTE ROLANTE B 10TN', 7, NULL, NULL, NULL),
(47, 'RF-C003', 'PONTE ROLANTE A 10TN', 7, NULL, NULL, NULL),
(49, 'RF-C005', 'TALHA ELETRICA  SOLDAS', 2, NULL, NULL, NULL),
(50, 'RF-C006', 'PRENSA HIDRAULICA  FUNDO DE TANQUES', 2, NULL, NULL, NULL),
(51, 'RF-C007', 'TALHA ELETRICA  5 TN AMARELO THF', 7, NULL, NULL, NULL),
(52, 'RF-C008', 'TALHA ELETRICA  3 TN VERMELHO THC', 2, NULL, NULL, NULL),
(53, 'RF-C009', 'VIRADOR DE TANQUES SOLDA THF', 7, NULL, NULL, NULL),
(54, 'RF-C010', 'FRESADORA CONE ', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `preventiva`
--

CREATE TABLE IF NOT EXISTS `preventiva` (
`idpreventiva` int(11) NOT NULL,
  `maquina` int(10) NOT NULL,
  `componente` int(10) NOT NULL,
  `data` date NOT NULL,
  `obs` longtext
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `preventiva`
--

INSERT INTO `preventiva` (`idpreventiva`, `maquina`, `componente`, `data`, `obs`) VALUES
(2, 18, 0, '2021-04-15', 'trincamento '),
(3, 18, 2, '2022-04-15', 'TESTADO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_bi`
--

CREATE TABLE IF NOT EXISTS `users_bi` (
`id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users_bi`
--

INSERT INTO `users_bi` (`id`, `nome`, `login`, `senha`) VALUES
(14, 'CLAUDINEI HOSS', 'CLAUDINEI', 'e3cdf70a99c1d6890c54ad56bd4a5de1'),
(16, 'HUGO', 'HUGO', '3a69c66ddf6678281ed75d825a712e76'),
(17, 'MANUTENCAO ', 'MANUTENCAO', '33701996cdff62bb8efae4ca844b7e13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklistitens`
--
ALTER TABLE `checklistitens`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `componente`
--
ALTER TABLE `componente`
 ADD PRIMARY KEY (`idcomponente`);

--
-- Indexes for table `corretiva`
--
ALTER TABLE `corretiva`
 ADD PRIMARY KEY (`idcorretiva`);

--
-- Indexes for table `itens`
--
ALTER TABLE `itens`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `local`
--
ALTER TABLE `local`
 ADD PRIMARY KEY (`idlocal`);

--
-- Indexes for table `maquina`
--
ALTER TABLE `maquina`
 ADD PRIMARY KEY (`idmaquina`);

--
-- Indexes for table `preventiva`
--
ALTER TABLE `preventiva`
 ADD PRIMARY KEY (`idpreventiva`);

--
-- Indexes for table `users_bi`
--
ALTER TABLE `users_bi`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `checklistitens`
--
ALTER TABLE `checklistitens`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `componente`
--
ALTER TABLE `componente`
MODIFY `idcomponente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `corretiva`
--
ALTER TABLE `corretiva`
MODIFY `idcorretiva` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `itens`
--
ALTER TABLE `itens`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `local`
--
ALTER TABLE `local`
MODIFY `idlocal` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `maquina`
--
ALTER TABLE `maquina`
MODIFY `idmaquina` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `preventiva`
--
ALTER TABLE `preventiva`
MODIFY `idpreventiva` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_bi`
--
ALTER TABLE `users_bi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
