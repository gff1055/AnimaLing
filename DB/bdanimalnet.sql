-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Set-2017 às 22:11
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdanimalnet`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

CREATE TABLE `animal` (
  `codigo` int(11) NOT NULL,
  `codigoUsuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `especie` varchar(255) NOT NULL,
  `sexo` varchar(3) NOT NULL,
  `nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `animal`
--

INSERT INTO `animal` (`codigo`, `codigoUsuario`, `nome`, `especie`, `sexo`, `nascimento`) VALUES
(1, 8, 'Fido', 'Gato', 'M', '2016-01-08'),
(3, 16, 'Bustica', 'Rato', 'M', '2015-12-07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dono`
--

CREATE TABLE `dono` (
  `codigo` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `nascimento` date NOT NULL,
  `sexo` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dono`
--

INSERT INTO `dono` (`codigo`, `usuario`, `senha`, `nome`, `sobrenome`, `nascimento`, `sexo`, `email`) VALUES
(2, 'b', 'b', 'b', 'b', '2017-05-02', NULL, 'b@b.com'),
(3, 'c', 'c', 'c', 'c', '2017-05-03', NULL, 'c@c.com.br'),
(4, 'henri2', 'henrisenha', 'henrique2', 'dourado2', '2017-07-17', 'M', 'henriquedourado2@hotmal.com'),
(6, 'bia', 'bia', 'Maria', 'beatriz', '2017-06-13', NULL, 'bia@gmail.com'),
(7, 'Cambia', 'camilabeatriz', 'Camila', 'Beatriz', '2017-09-21', 'F', 'camilabeatriz@gmail.com'),
(8, 'Brube', 'brunobernardo', 'Bruno', 'Bernardo', '2016-09-21', 'M', 'brunobernardo@gmail.com'),
(10, 'user28', 'password27', 'firstName27', 'lastName27', '2017-07-27', 'M', 'email26@email26.com'),
(11, 'user271', 'password27', 'firstName27', 'lastName27', '2017-07-27', 'M', 'email271@email271.com'),
(12, 'user271', 'password27', 'firstName27', 'lastName27', '2017-07-27', 'M', 'email271@email271.com'),
(13, 'user271', 'password27', 'firstName27', 'lastName27', '2017-07-27', 'M', 'email271@email271.com'),
(14, 'user271', 'password27', 'firstName27', 'lastName27', '2017-07-27', 'M', 'email271@email271.com'),
(15, 'user03', 'password27', 'firstName27', 'lastName27', '2017-07-27', 'M', 'email03@email.com'),
(16, 'MigMath', 'miguelmatheus', 'Miguel', 'Matheus', '2017-09-20', 'M', 'miguelmatheus@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `codigoDono` int(11) DEFAULT NULL,
  `codigoAnimal` int(11) DEFAULT NULL,
  `conteudo` varchar(255) DEFAULT NULL,
  `dataStatus` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `dono_id_fk` (`codigoUsuario`);

--
-- Indexes for table `dono`
--
ALTER TABLE `dono`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dono`
--
ALTER TABLE `dono`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `dono_id_fk` FOREIGN KEY (`codigoUsuario`) REFERENCES `dono` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
