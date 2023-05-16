-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Maio-2023 às 22:11
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trabalhopw`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `compartilhar_docs`
--

CREATE TABLE `compartilhar_docs` (
  `iddocumento` int(11) NOT NULL,
  `idcompartilhar_docs` int(11) NOT NULL,
  `permissao` tinyint(4) NOT NULL,
  `usuarios_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `compartilhar_docs`
--

INSERT INTO `compartilhar_docs` (`iddocumento`, `idcompartilhar_docs`, `permissao`, `usuarios_idusuario`) VALUES
(1, 1, 1, 2),
(4, 3, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `iddocumento` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `usuarios_idusuario` int(11) NOT NULL,
  `data_upload` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`iddocumento`, `nome`, `usuarios_idusuario`, `data_upload`) VALUES
(1, 'Trabalhofreiosecontrapesos.pdf', 1, '2023-05-16'),
(3, 'OrganizaoSecretaCapI.docx', 2, '2023-05-16'),
(4, 'sol.jpg', 1, '2023-05-16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nome`, `email`, `senha`) VALUES
(1, 'bia', 'biancavn06@gmail.com', '$2y$10$MMFi1jG5Ck05TTymhB09NuA4/.WXOuTRSNeR4ylVvhZk6jIU/NTEG'),
(2, 'bianca', 'bia@gmail.com', '$2y$10$wwuCQEM2Wm9iyrxcZmn9eef1jCWRg8aSsJIKA1n0c9JMi3j/9x4rm');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `compartilhar_docs`
--
ALTER TABLE `compartilhar_docs`
  ADD PRIMARY KEY (`idcompartilhar_docs`),
  ADD KEY `usuarios_idusuario` (`usuarios_idusuario`),
  ADD KEY `fk_id_documento` (`iddocumento`);

--
-- Índices para tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`iddocumento`),
  ADD KEY `usuarios_idusuario` (`usuarios_idusuario`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `compartilhar_docs`
--
ALTER TABLE `compartilhar_docs`
  MODIFY `idcompartilhar_docs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `iddocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `compartilhar_docs`
--
ALTER TABLE `compartilhar_docs`
  ADD CONSTRAINT `compartilhar_docs_ibfk_1` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_documento` FOREIGN KEY (`iddocumento`) REFERENCES `documentos` (`iddocumento`);

--
-- Limitadores para a tabela `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
