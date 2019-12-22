-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 22-Dez-2019 às 15:19
-- Versão do servidor: 5.7.28-cll-lve
-- versão do PHP: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistemainterno`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aplicativo`
--

CREATE TABLE `aplicativo` (
  `id_aplicativo` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_versao` int(11) DEFAULT NULL,
  `id_site` int(11) DEFAULT NULL,
  `nome_pacote` varchar(100) DEFAULT NULL,
  `chave_atualizacao` varchar(500) DEFAULT NULL,
  `arquivo_firebase` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(100) DEFAULT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `descricao_cliente` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `id_projeto` int(11) NOT NULL,
  `nome_projeto` varchar(150) DEFAULT NULL,
  `descricao` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `site`
--

CREATE TABLE `site` (
  `id_site` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_versao` int(11) DEFAULT NULL,
  `dominio` varchar(150) DEFAULT NULL,
  `parametros` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `versao`
--

CREATE TABLE `versao` (
  `id_versao` int(11) NOT NULL,
  `id_projeto` int(11) DEFAULT NULL,
  `nome_versao` varchar(100) DEFAULT NULL,
  `descricao_versao` varchar(1000) DEFAULT NULL,
  `nivel` varchar(100) DEFAULT NULL,
  `zip_file` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aplicativo`
--
ALTER TABLE `aplicativo`
  ADD PRIMARY KEY (`id_aplicativo`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_versao` (`id_versao`),
  ADD KEY `id_site` (`id_site`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices para tabela `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`id_projeto`);

--
-- Índices para tabela `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id_site`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_versao` (`id_versao`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices para tabela `versao`
--
ALTER TABLE `versao`
  ADD PRIMARY KEY (`id_versao`),
  ADD KEY `id_projeto` (`id_projeto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aplicativo`
--
ALTER TABLE `aplicativo`
  MODIFY `id_aplicativo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `site`
--
ALTER TABLE `site`
  MODIFY `id_site` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `versao`
--
ALTER TABLE `versao`
  MODIFY `id_versao` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aplicativo`
--
ALTER TABLE `aplicativo`
  ADD CONSTRAINT `aplicativo_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `aplicativo_ibfk_3` FOREIGN KEY (`id_versao`) REFERENCES `versao` (`id_versao`),
  ADD CONSTRAINT `aplicativo_ibfk_4` FOREIGN KEY (`id_site`) REFERENCES `site` (`id_site`);

--
-- Limitadores para a tabela `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `site_ibfk_3` FOREIGN KEY (`id_versao`) REFERENCES `versao` (`id_versao`);

--
-- Limitadores para a tabela `versao`
--
ALTER TABLE `versao`
  ADD CONSTRAINT `versao_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projeto` (`id_projeto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
