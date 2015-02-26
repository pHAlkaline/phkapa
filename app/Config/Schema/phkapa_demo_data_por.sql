-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2014 at 12:12 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phkapa`
--


--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(28, 2, 'User', 8, 'Controlo de Gestão e Negócio', 14, 15),
(27, 2, 'User', 7, 'Gestão e Suporte ao Cliente', 12, 13),
(26, 2, 'User', 13, 'Recursos Humanos', 10, 11),
(25, 2, 'User', 12, 'Departamento Comercial', 8, 9),
(24, 2, 'User', 16, 'Administração e Finanças', 6, 7),
(29, 2, 'User', 5, 'Plataforma de Operações', 16, 17),
(30, 2, 'User', 17, 'PHKAPA', 18, 19),
(31, 2, 'User', 2, 'Gestão da Qualidade', 20, 21),
(32, 2, 'User', 10, 'Recepção', 22, 23);

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_allow`) VALUES
(76, 28, 7, '1'),
(75, 28, 22, '1'),
(72, 27, 7, '1'),
(71, 27, 22, '1'),
(69, 26, 8, '1'),
(56, 24, 2, '-1'),
(68, 26, 7, '1'),
(67, 26, 22, '1'),
(66, 26, 2, '-1'),
(63, 25, 7, '1'),
(62, 25, 22, '1'),
(74, 28, 2, '-1'),
(73, 27, 8, '1'),
(70, 27, 2, '-1'),
(65, 25, 8, '1'),
(64, 25, 23, '-1'),
(61, 25, 2, '-1'),
(60, 24, 8, '1'),
(59, 24, 23, '-1'),
(58, 24, 7, '1'),
(57, 24, 22, '1'),
(77, 28, 8, '1'),
(78, 29, 1, '-1'),
(79, 29, 22, '1'),
(80, 29, 7, '1'),
(81, 29, 8, '1'),
(82, 31, 2, '-1'),
(83, 31, 22, '1'),
(84, 31, 7, '1'),
(85, 31, 8, '1'),
(86, 32, 1, '-1'),
(87, 32, 22, '1'),
(88, 32, 7, '1'),
(89, 32, 8, '1'),
(90, 31, 23, '1'),
(91, 31, 9, '1');



--
-- Dumping data for table `phkapa_activities`
--

INSERT INTO `phkapa_activities` (`id`, `name`, `active`, `created`, `modified`) VALUES
(2, 'Recepção', 1, '2014-08-21 08:10:39', '2014-08-21 08:10:39'),
(4, 'Suporte ao cliente', 0, '2014-08-21 08:10:39', '2014-08-21 08:10:39'),
(5, 'Backoffice', 1, '2014-08-21 08:10:39', '2014-01-17 13:18:18'),
(6, 'Gestão de clientes', 1, '2014-08-21 08:10:39', '2014-08-21 12:02:40'),
(8, 'Inflow', 1, '2014-08-21 08:10:39', '2014-08-21 12:12:26'),
(10, 'Outflow', 1, '2014-08-21 08:10:39', '2014-08-21 12:12:19'),
(12, 'Devoluções', 1, '2014-08-21 08:10:39', '2014-08-21 08:10:39'),
(14, 'Rotas e entregas', 1, '2014-08-21 08:10:39', '2014-08-21 08:10:39'),
(15, 'Gestão de Frotas', 1, '2014-08-21 08:10:39', '2014-08-21 12:08:42'),
(22, 'Transporte de mercadorias', 1, '2014-08-21 08:10:39', '2014-08-21 12:06:22'),
(23, 'Planeamento de rotas de entrega', 1, '2014-08-21 08:10:39', '2014-08-21 12:05:16'),
(24, 'Trasporte de devoluções', 1, '2014-08-21 08:10:39', '2014-08-21 12:06:48'),
(27, 'Workshop de Gestão', 1, '2014-08-21 08:10:39', '2014-08-21 12:26:03'),
(28, 'Fluxo de retorno', 1, '2014-08-21 12:12:43', '2014-08-21 12:12:43'),
(29, 'Plaejamento e controle', 1, '2014-08-21 12:13:23', '2014-08-21 12:14:26'),
(31, 'PNC / PB', 1, '2014-08-21 12:15:07', '2014-08-21 12:15:07'),
(32, 'Gestão de reclamações', 1, '2014-08-21 12:16:05', '2014-08-21 12:16:05'),
(33, 'Gestão da Qualidade', 1, '2014-08-21 12:18:09', '2014-08-21 12:18:09'),
(35, 'Sistema de refrigeração', 1, '2014-08-21 12:19:16', '2014-08-21 12:19:16'),
(36, 'Elétrico', 1, '2014-08-21 12:19:44', '2014-08-21 12:19:44'),
(37, 'Gestão de Redes', 1, '2014-08-21 12:20:02', '2014-08-21 12:20:02'),
(38, 'Apoio ao cliente', 1, '2014-08-21 12:20:54', '2014-08-21 12:20:54'),
(39, 'Recursos Humanos', 1, '2014-08-21 12:21:17', '2014-08-21 12:21:17'),
(40, 'Contabilidade e Financeira', 1, '2014-08-21 12:21:45', '2014-08-21 12:22:24'),
(41, 'Saude e segurança no trabalho', 1, '2014-08-21 12:22:54', '2014-08-21 12:22:54'),
(42, 'Comunicação e marketing', 1, '2014-08-21 12:23:26', '2014-08-21 12:23:26'),
(43, 'Sistemas de comunicação', 1, '2014-08-21 12:23:50', '2014-08-21 12:23:50'),
(44, 'Geral', 1, '2014-08-24 05:43:10', '2014-09-03 00:23:08'),
(45, 'Manutenção e limpeza', 1, '2014-08-24 06:24:14', '2014-08-24 06:24:14');

--
-- Dumping data for table `phkapa_activities_processes`
--

INSERT INTO `phkapa_activities_processes` (`activity_id`, `process_id`) VALUES
(6, 1),
(10, 3),
(8, 3),
(28, 3),
(29, 6),
(31, 3),
(32, 1),
(33, 7),
(35, 7),
(36, 7),
(37, 6),
(38, 6),
(39, 10),
(40, 10),
(41, 10),
(42, 1),
(43, 6),
(45, 3),
(44, 1),
(44, 3),
(44, 6),
(44, 10),
(44, 7),
(5, 1),
(44, 2),
(27, 2),
(15, 2),
(45, 2),
(23, 2),
(22, 2);

--
-- Dumping data for table `phkapa_categories`
--

INSERT INTO `phkapa_categories` (`id`, `name`, `active`, `created`, `modified`) VALUES
(21, 'Instalações / Locais', 1, '2014-08-21 08:11:00', '2014-08-22 04:35:33'),
(43, 'Eficiência / Performance', 1, '2014-08-21 08:11:00', '2014-01-17 13:18:27'),
(49, 'Fabricante / Fornecedor', 1, '2014-08-21 08:11:00', '2014-08-22 04:34:46'),
(58, 'Material / Equipamento', 1, '2014-08-21 08:11:00', '2014-08-22 04:35:52'),
(62, 'Segurança Alimentar', 1, '2014-08-22 04:59:57', '2014-09-02 02:30:37'),
(64, 'Rastreio', 1, '2014-08-22 05:00:55', '2014-08-22 05:00:55');

--
-- Dumping data for table `phkapa_categories_causes`
--

INSERT INTO `phkapa_categories_causes` (`category_id`, `cause_id`) VALUES
(21, 2),
(58, 2),
(49, 5),
(21, 5),
(58, 5),
(49, 6),
(21, 6),
(58, 6),
(21, 3),
(58, 3),
(21, 4),
(58, 4),
(49, 7),
(49, 8),
(64, 3),
(64, 4),
(64, 5),
(64, 6),
(64, 7),
(64, 8),
(49, 9),
(64, 9),
(49, 10),
(21, 10),
(58, 10),
(64, 10),
(62, 2),
(62, 3),
(62, 4),
(62, 6),
(62, 7),
(62, 8),
(62, 9),
(62, 10),
(43, 5),
(43, 6),
(43, 7),
(43, 8),
(43, 9),
(21, 1),
(58, 1),
(62, 1);

--
-- Dumping data for table `phkapa_categories_processes`
--

INSERT INTO `phkapa_categories_processes` (`category_id`, `process_id`) VALUES
(49, 1),
(49, 3),
(49, 6),
(49, 10),
(49, 7),
(21, 1),
(21, 3),
(21, 6),
(21, 10),
(21, 7),
(58, 1),
(58, 3),
(58, 6),
(58, 10),
(58, 7),
(64, 3),
(64, 6),
(62, 3),
(62, 7),
(43, 1),
(43, 3),
(43, 6),
(43, 10),
(43, 7),
(43, 2),
(49, 2),
(21, 2),
(58, 2),
(64, 2),
(62, 2);

--
-- Dumping data for table `phkapa_causes`
--

INSERT INTO `phkapa_causes` (`id`, `name`, `active`, `created`, `modified`) VALUES
(1, 'Falta de manutenção', 1, '2014-08-22 04:44:25', '2014-01-17 13:18:47'),
(2, 'Falta de limpeza / arrumação', 1, '2014-08-22 04:45:29', '2014-08-22 04:45:29'),
(3, 'Falta de recursos', 1, '2014-08-22 04:45:55', '2014-08-22 04:53:21'),
(4, 'Recursos inadequados', 1, '2014-08-22 04:46:40', '2014-08-22 04:53:49'),
(5, 'Inaplicável', 1, '2014-08-22 04:48:06', '2014-08-22 04:48:06'),
(6, 'Falha de comunicação', 1, '2014-08-22 04:49:19', '2014-08-22 04:49:19'),
(7, 'Falta de regras / procedimentos', 1, '2014-08-22 04:53:08', '2014-08-22 04:54:43'),
(8, 'Violação das regras', 1, '2014-08-22 04:55:41', '2014-08-22 04:55:41'),
(9, 'Fraco desempenho', 1, '2014-08-22 05:03:09', '2014-08-22 05:03:09'),
(10, 'Ignorância', 1, '2014-08-24 06:12:24', '2014-08-24 06:12:24');

--
-- Dumping data for table `phkapa_origins`
--

INSERT INTO `phkapa_origins` (`id`, `name`, `active`, `created`, `modified`) VALUES
(1, 'Auditoria externa', 1, '2014-08-21 08:11:36', '2014-08-21 09:08:31'),
(3, 'Auditoria interna', 1, '2014-08-21 08:11:36', '2014-08-21 08:11:36'),
(5, 'Retirada voluntário de produto', 1, '2014-08-21 08:11:36', '2014-08-21 08:11:36'),
(6, 'Retirada obrigatória de produto', 1, '2014-08-21 08:11:36', '2014-08-21 08:11:36'),
(7, 'Qualificações de fabricação do produto', 1, '2014-08-21 08:11:36', '2014-08-21 08:11:36'),
(8, 'Qualificações de operações de processo', 1, '2014-08-21 08:11:36', '2014-01-17 13:18:54'),
(13, 'Queixa do Cliente', 1, '2014-08-21 08:11:36', '2014-08-21 09:15:45'),
(14, 'Revisão of NCMRS', 1, '2014-02-01 14:34:12', '2014-02-01 14:34:12'),
(15, 'Relatório de Dispositivos Médicos', 1, '2014-02-01 14:34:12', '2014-02-01 14:34:12'),
(16, 'Dispositivos Médicos Sistema de Vigilância (MDVS)', 1, '2014-02-01 14:34:12', '2014-02-01 14:34:12'),
(17, 'Produto, processo ou sistema não conformidades', 1, '2014-02-01 14:36:18', '2014-02-01 14:36:18'),
(18, 'Outros', 1, '2014-02-01 14:36:18', '2014-02-01 14:36:18');

--
-- Dumping data for table `phkapa_processes`
--

INSERT INTO `phkapa_processes` (`id`, `name`, `active`, `created`, `modified`) VALUES
(1, 'Gestão e Suporte ao Cliente', 1, '2014-08-21 08:11:52', '2014-08-21 08:11:52'),
(2, 'Operações de Distribuição', 1, '2014-08-21 08:11:52', '2014-01-17 13:19:00'),
(3, 'Operações de Plataforma', 1, '2014-08-21 08:11:52', '2014-08-21 08:11:52'),
(6, 'Sistemas de Informação', 1, '2014-08-21 08:11:52', '2014-08-21 11:48:14'),
(7, 'Apoio Operacional', 1, '2014-08-21 08:11:52', '2014-08-21 11:47:54'),
(10, 'Apoio Administrativo', 1, '2014-08-21 08:11:52', '2014-08-21 11:46:40');

--
-- Dumping data for table `phkapa_processes_users`
--

INSERT INTO `phkapa_processes_users` (`process_id`, `user_id`) VALUES
(1, 2),
(3, 2),
(1, 7),
(10, 16),
(10, 2),
(7, 2),
(6, 8),
(6, 2),
(1, 1),
(3, 1),
(6, 1),
(10, 1),
(7, 1),
(2, 1),
(2, 2),
(3, 12),
(10, 13);

--
-- Dumping data for table `phkapa_suppliers`
--

INSERT INTO `phkapa_suppliers` (`id`, `name`, `active`, `created`, `modified`) VALUES
(3, 'ISS FACILITY SERVICES, Lda', 1, '2014-08-21 08:12:10', '2014-08-21 08:12:10'),
(7, 'RentoKil, SA', 1, '2014-08-21 08:12:10', '2014-08-21 11:56:50'),
(9, 'SGS International Certification Services', 1, '2014-08-21 08:12:10', '2014-08-21 08:12:10'),
(12, 'Watercare-Tratamento de Água, Lda', 1, '2014-08-21 08:12:10', '2014-08-21 11:56:24'),
(14, 'Linde Material Handling Ibérica,S.A', 0, '2014-08-21 08:12:10', '2014-08-21 08:12:10'),
(18, 'Paralte SA', 1, '2014-08-21 08:12:10', '2014-08-21 11:54:27'),
(28, 'SAI GLOBAL ASSURANCE SERVICES, LTD', 1, '2014-08-21 08:12:10', '2014-08-21 08:12:10'),
(32, 'TecMic - Sistemas GPS', 1, '2014-08-21 08:12:10', '2014-08-21 11:55:08'),
(36, 'Kyocera portugal', 1, '2014-08-21 08:12:10', '2014-01-17 13:19:06'),
(38, 'CompuWorks', 1, '2014-08-21 08:12:10', '2014-08-21 11:56:03'),
(44, 'Toyota Caetano Portugal, S.A.', 1, '2014-08-21 08:12:10', '2014-08-21 08:12:10'),
(46, 'ZeroQuatro, Lda', 1, '2014-08-21 08:12:10', '2014-08-21 11:55:33');


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `active`, `modified`, `created`) VALUES
(2, 'Quality Dep Manager', 'quality', '956a5341e2866143875974fe505c6e1015e8cade', 1, '2014-02-01 00:13:43', '2014-08-21 08:12:50'),
(5, 'Operations Platform', 'op', 'a6a32d45cc556fb207296c19dd2535195999a2cb', 1, '2014-02-01 00:13:29', '2014-08-21 08:12:50'),
(7, 'Managment and Client Support', 'macs', 'f25d69055f8f6b04902a4a600924f4b322331e5c', 1, '2014-02-01 00:13:11', '2014-08-21 08:12:50'),
(8, 'Managment Control and Businees', 'mcb', 'c68d6262c3c505db043c9cf5aa8d412c3f61500a', 1, '2014-02-01 00:13:19', '2014-08-21 08:12:50'),
(10, 'Reception', 'rec', '724edb893a9635719d6e5b9ac8f541ae5e08b47c', 1, '2014-02-01 00:13:50', '2014-08-21 08:12:50'),
(12, 'Comercial Department', 'cd', '1838778552448119e8b08f4e6b4fc0197b1cef51', 1, '2014-02-01 23:30:34', '2014-08-21 08:12:50'),
(13, 'Human Recources', 'hr', '55ffba6ae3cabb6702efe405ef073262b10ce3fb', 1, '2014-02-01 00:12:59', '2014-08-21 08:12:50'),
(16, 'Administrative and Finance', 'aaf', 'c4ac340a9d6cef16ccca5753f9a829831cc38ed4', 1, '2014-02-01 00:12:41', '2014-08-21 08:12:50'),
(17, 'pHKAPA', 'phkapa', 'f186e7079a2a3cd60f20db45f381be55a3d39879', 1, '2014-02-01 00:14:21', '2014-12-26 20:09:26');
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
