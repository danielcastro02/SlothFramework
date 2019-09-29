-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Set-2019 às 22:46
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `markey-admin`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aplicativo`
--

CREATE TABLE `aplicativo` (
  `id_aplicativo` int(11) NOT NULL,
  `cliente` varchar(100) DEFAULT NULL,
  `nome_pacote` varchar(150) DEFAULT NULL,
  `chave` varchar(200) DEFAULT NULL,
  `dominio` varchar(150) DEFAULT NULL,
  `arquivo_firebase` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aplicativo`
--

INSERT INTO `aplicativo` (`id_aplicativo`, `cliente`, `nome_pacote`, `chave`, `dominio`, `arquivo_firebase`) VALUES
(3, 'BetaMarkeyVip', 'vip.markey', 'Img/Chaves/BetaMarkeyVip/chaveMarkeyvipBeta.jks', 'beta.markeyvip.com', 'Img/Chaves/BetaMarkeyVip/google-services.json');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `usuario`, `senha`) VALUES
(1, 'Daniel Anesi', 'danesi', 'b7af6315a02ddd6c0b52511522db6d79'),
(2, 'Daniel Castro', 'dcastro', '3c2031ac53dea3dacb733041d55e322d'),
(3, 'Victor Xavier', 'xavier', 'ec44780d3477dd0f65f3d296aab6443c'),
(4, 'Lucas de Lima Silva', 'lima', 'e26645e2e89703afe810db50a0915389');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aplicativo`
--
ALTER TABLE `aplicativo`
  ADD PRIMARY KEY (`id_aplicativo`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aplicativo`
--
ALTER TABLE `aplicativo`
  MODIFY `id_aplicativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
