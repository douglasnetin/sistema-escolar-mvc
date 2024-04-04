-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/04/2024 às 06:29
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `id` int(11) NOT NULL,
  `data_agendamento` date DEFAULT NULL,
  `hora_agendamento` time DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `status` enum('Confirmado','Pendente','Cancelado') DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `plano` varchar(100) DEFAULT NULL,
  `tipo_pagamento` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `horario`
--

CREATE TABLE `horario` (
  `id` int(11) NOT NULL,
  `cod_horario` int(11) NOT NULL,
  `dt_horario` date NOT NULL,
  `hr_horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `horario`
--

INSERT INTO `horario` (`id`, `cod_horario`, `dt_horario`, `hr_horario`) VALUES
(4, 1, '2024-04-05', '09:00:00'),
(5, 2, '2024-04-06', '10:00:00'),
(6, 3, '2024-04-06', '11:00:00'),
(7, 4, '2024-04-05', '12:00:00'),
(8, 5, '2024-04-06', '13:00:00'),
(9, 6, '2024-04-06', '14:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `plano`
--

CREATE TABLE `plano` (
  `cod_plano` int(11) NOT NULL,
  `nome_plano` varchar(100) DEFAULT NULL,
  `txt_label` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `preco_plano` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `plano`
--

INSERT INTO `plano` (`cod_plano`, `nome_plano`, `txt_label`, `descricao`, `preco_plano`) VALUES
(1, 'plano 1', 'aadaf', 'Aproveite nosso desconto especial de verão!', 50.00),
(2, 'plano 2', 'ffsfdg', 'reeyy', 55.00),
(3, 'plano 3', 'bronzeada ', 'melhor escolha ', 100.00),
(4, 'plano 4', 'ultima edição', 'ultima chance', 70.00),
(5, 'plano 5', 'o melhor ', 'o melhor', 120.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `promocao`
--

CREATE TABLE `promocao` (
  `idpromocao` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `desconto` float DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `promocao`
--

INSERT INTO `promocao` (`idpromocao`, `titulo`, `descricao`, `data_inicio`, `data_fim`, `desconto`, `label`) VALUES
(9, 'Plano 2', 'Aproveite nosso desconto especial de inverno! Oferta limitada!', '2024-12-01', '2024-12-31', 15, 'pacote 2'),
(10, 'Plano 3', 'Economize ainda mais com nossos preços reduzidos de primavera!', '2024-09-01', '2024-09-30', 20, 'pacote 3'),
(11, 'Plano 4', 'Desconto de outono exclusivo! Aproveite enquanto dura!', '2024-10-01', '2024-10-31', 12, 'pacote 4'),
(12, 'Plano 5', 'Oferta de verão: grandes descontos em todos os produtos!', '2024-07-01', '2024-07-31', 18, 'pacote 5'),
(13, 'Plano 6', 'Promoção de inverno: economize até 25% em nossos serviços!', '2024-01-01', '2024-02-29', 25, 'pacote 6');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `tema` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `usuario`, `senha`, `nivel`, `tema`) VALUES
(1, '111', '111', '111', '$2y$10$FDTyRaqgoqslWjoKak.T/OyZLCL6mYAEBrkbNorzaOF69tO5s5XrG', NULL, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `plano`
--
ALTER TABLE `plano`
  ADD PRIMARY KEY (`cod_plano`);

--
-- Índices de tabela `promocao`
--
ALTER TABLE `promocao`
  ADD PRIMARY KEY (`idpromocao`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `plano`
--
ALTER TABLE `plano`
  MODIFY `cod_plano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `promocao`
--
ALTER TABLE `promocao`
  MODIFY `idpromocao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
