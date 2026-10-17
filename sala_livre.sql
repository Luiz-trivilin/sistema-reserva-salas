-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30-Abr-2025 às 22:43
-- Versão do servidor: 8.0.39
-- versão do PHP: 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sala_livre`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario_escola`
--

CREATE TABLE `horario_escola` (
  `id_horario` int NOT NULL,
  `horario_inicio` time DEFAULT NULL,
  `horario_fim` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `horario_escola`
--

INSERT INTO `horario_escola` (`id_horario`, `horario_inicio`, `horario_fim`) VALUES
(1, '08:15:00', '09:00:00'),
(2, '09:00:00', '09:45:00'),
(3, '10:00:00', '10:45:00'),
(4, '10:45:00', '11:30:00'),
(5, '11:40:00', '12:25:00'),
(6, '14:10:00', '14:55:00'),
(7, '15:10:00', '15:55:00'),
(8, '15:55:00', '16:40:00'),
(9, '16:45:00', '17:30:00'),
(10, '17:30:00', '18:15:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcacao`
--

CREATE TABLE `marcacao` (
  `id` int NOT NULL,
  `id_sala` int NOT NULL,
  `id_horario` int NOT NULL,
  `data_marcada` date NOT NULL,
  `id_utilizador` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `meses`
--

CREATE TABLE `meses` (
  `id_meses` int NOT NULL,
  `meses` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `meses`
--

INSERT INTO `meses` (`id_meses`, `meses`) VALUES
(1, 'Janeiro'),
(2, 'Fevereiro'),
(3, 'Março'),
(4, 'Abril'),
(5, 'Maio'),
(6, 'Junho'),
(7, 'Julho'),
(8, 'Agosto'),
(9, 'Setembro'),
(10, 'Outubro'),
(11, 'Novembro'),
(12, 'dezembro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `salas`
--

CREATE TABLE `salas` (
  `id_sala` int NOT NULL,
  `nomesala` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `salas`
--

INSERT INTO `salas` (`id_sala`, `nomesala`) VALUES
(1, 'Tic 1'),
(2, 'Tic 2'),
(3, 'Tic 3'),
(4, 'Tic 4'),
(5, 'Tic 5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `numfuncionario` int NOT NULL,
  `nomecompleto` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tipo` int DEFAULT NULL,
  `valido` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `horario_escola`
--
ALTER TABLE `horario_escola`
  ADD PRIMARY KEY (`id_horario`);

--
-- Índices para tabela `marcacao`
--
ALTER TABLE `marcacao`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_reserva_sala_horario_data` (`id_sala`,`id_horario`,`data_marcada`),
  ADD KEY `id_utilizador` (`id_utilizador`);

--
-- Índices para tabela `meses`
--
ALTER TABLE `meses`
  ADD PRIMARY KEY (`id_meses`);

--
-- Índices para tabela `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id_sala`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`numfuncionario`),
  ADD UNIQUE KEY `nomecompleto` (`nomecompleto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `horario_escola`
--
ALTER TABLE `horario_escola`
  MODIFY `id_horario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `marcacao`
--
ALTER TABLE `marcacao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `meses`
--
ALTER TABLE `meses`
  MODIFY `id_meses` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `salas`
--
ALTER TABLE `salas`
  MODIFY `id_sala` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `numfuncionario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1016;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `marcacao`
--
ALTER TABLE `marcacao`
  ADD CONSTRAINT `marcacao_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`numfuncionario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
