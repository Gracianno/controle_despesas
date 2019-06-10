-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Jun-2019 às 13:23
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `controle_financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_despesa`
--

CREATE TABLE IF NOT EXISTS `categoria_despesa` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria_despesa`
--

INSERT INTO `categoria_despesa` (`id`, `nome`) VALUES
(1, 'Alimentação'),
(2, 'Transporte'),
(3, 'Equipamentos'),
(4, 'Emergencias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesa`
--

CREATE TABLE IF NOT EXISTS `despesa` (
`id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descricao` varchar(350) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `despesa`
--

INSERT INTO `despesa` (`id`, `titulo`, `descricao`, `status`, `id_usuario`, `id_categoria`, `data`, `valor`) VALUES
(1, 'Notebook', 'Compra de Notebook', 2, 9, 3, '2019-06-10 13:13:05', '1200');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `perfil` int(11) DEFAULT '1',
  `senha` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `perfil`, `senha`, `email`) VALUES
(6, 'Graciano de jesus alves souza', 1, '25d55ad283aa400af464c76d713c07ad', 'teste@teste.com.br'),
(7, 'João Roberto', 2, 'e10adc3949ba59abbe56e057f20f883e', 'gracianozzhow@hotmail.com'),
(8, 'GRACIANO DE JESUS ALVES SOUZA', 1, 'e10adc3949ba59abbe56e057f20f883e', 'vasconcelosthiago@outlook.com'),
(9, 'GRACIANO DE JESUS ALVES SOUZA', 1, '25d55ad283aa400af464c76d713c07ad', 'graciano.a.souza@outlook.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria_despesa`
--
ALTER TABLE `categoria_despesa`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `despesa`
--
ALTER TABLE `despesa`
 ADD PRIMARY KEY (`id`), ADD KEY `id_fk_usuario` (`id_usuario`), ADD KEY `id_fk_categoria` (`id_categoria`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `usuario` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria_despesa`
--
ALTER TABLE `categoria_despesa`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `despesa`
--
ALTER TABLE `despesa`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `despesa`
--
ALTER TABLE `despesa`
ADD CONSTRAINT `id_fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_despesa` (`id`),
ADD CONSTRAINT `id_fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
