-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24-Ago-2014 às 22:22
-- Versão do servidor: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hackathon`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alternativa`
--

CREATE TABLE IF NOT EXISTS `alternativa` (
  `idAlternativa` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `correta` tinyint(3) NOT NULL DEFAULT '0',
  `idQuestao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAlternativa`),
  KEY `idQuestao` (`idQuestao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `alternativa`
--

INSERT INTO `alternativa` (`idAlternativa`, `titulo`, `correta`, `idQuestao`) VALUES
(1, 'Pedro Alvares Cabral', 1, 1),
(2, 'Henrique craveiro', 0, 1),
(3, 'Tiago Henrique', 0, 1),
(4, 'Africa', 0, 2),
(5, 'America', 1, 2),
(6, 'Asia', 0, 2),
(9, 'Alternativa 01', 0, 16),
(10, 'Alternativa 06', 0, 16),
(11, 'Alternativa 03', 1, 16),
(12, 'Alternativa 01', 0, 17),
(13, 'Alternativa 02', 1, 17),
(14, 'Alternativa 03', 0, 17),
(15, 'Alternativa 04', 1, 18),
(16, 'Alternativa 05', 0, 18),
(17, 'Alternativa 06', 0, 18);

-- --------------------------------------------------------

--
-- Estrutura da tabela `alternativaquiz`
--

CREATE TABLE IF NOT EXISTS `alternativaquiz` (
  `idAlternativaquiz` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `correta` tinyint(3) NOT NULL DEFAULT '0',
  `idQuestaoquiz` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAlternativaquiz`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `alternativaquiz`
--

INSERT INTO `alternativaquiz` (`idAlternativaquiz`, `titulo`, `correta`, `idQuestaoquiz`) VALUES
(1, 'Alternativa 1 ', 1, 1),
(2, 'Alternativa 2', 0, 1),
(3, 'Alternativa 3', 0, 1),
(4, 'Alternativa teste 01', 0, 2),
(5, 'Alternativa teste 02', 0, 2),
(6, 'Alternativa teste 03', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `idAluno` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `senha` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idAluno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idAluno`, `nome`, `senha`, `email`, `status`) VALUES
(1, 'Cristopher', '123', 'cristopher.yusuke@gmail.com', 1),
(2, 'Tiago', '123', 'tiago@gmail.com', 1),
(3, 'Henrique Craveiro', '123456', 'henrique.cne@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aula`
--

CREATE TABLE IF NOT EXISTS `aula` (
  `idAula` int(11) NOT NULL AUTO_INCREMENT,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titulo` varchar(255) NOT NULL DEFAULT '',
  `idProfessor` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAula`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `aula`
--

INSERT INTO `aula` (`idAula`, `data`, `titulo`, `idProfessor`) VALUES
(21, '2014-08-17 00:00:00', 'Testando Aulas', 1),
(22, '2014-08-22 00:00:00', 'Aula teste 22-08', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulamaterial`
--

CREATE TABLE IF NOT EXISTS `aulamaterial` (
  `idAula` int(11) NOT NULL AUTO_INCREMENT,
  `idMaterial` int(11) NOT NULL DEFAULT '0',
  `tipo` tinyint(3) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAula`,`idMaterial`,`tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `aulamaterial`
--

INSERT INTO `aulamaterial` (`idAula`, `idMaterial`, `tipo`, `status`) VALUES
(21, 1, 1, 0),
(21, 1, 2, 0),
(21, 6, 3, 0),
(22, 1, 1, 0),
(22, 1, 2, 0),
(22, 1, 4, 1),
(22, 2, 1, 0),
(22, 6, 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `idGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `idProfessor` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idGrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `titulo`, `idProfessor`) VALUES
(1, 'Grupo Teste 01', 1),
(2, 'Tranca Rua', 2),
(3, 'Grupo 666', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupoaluno`
--

CREATE TABLE IF NOT EXISTS `grupoaluno` (
  `idGrupo` int(11) NOT NULL DEFAULT '0',
  `idAluno` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idGrupo`,`idAluno`),
  KEY `idAluno` (`idAluno`),
  KEY `idGrupo` (`idGrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupoaluno`
--

INSERT INTO `grupoaluno` (`idGrupo`, `idAluno`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(1, 3),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupoaula`
--

CREATE TABLE IF NOT EXISTS `grupoaula` (
  `idGrupo` int(11) NOT NULL DEFAULT '0',
  `idAula` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idGrupo`,`idAula`),
  KEY `idAula` (`idAula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupoaula`
--

INSERT INTO `grupoaula` (`idGrupo`, `idAula`, `status`) VALUES
(1, 21, 1),
(1, 22, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `idProfessor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `senha` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`idProfessor`, `nome`, `email`, `senha`, `status`) VALUES
(1, 'Professor Teste', 'email@gmail.com', '4297f44b13955235245b2497399d7a93', 1),
(2, 'Roni Shigueta', 'roni@unipar.br', '123456', 1),
(3, 'Sueli Borba', 'sueli@unipar.br', '123456', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE IF NOT EXISTS `questao` (
  `idQuestao` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `idQuestionario` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idQuestao`),
  KEY `idQuestionario` (`idQuestionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `questao`
--

INSERT INTO `questao` (`idQuestao`, `titulo`, `idQuestionario`) VALUES
(1, 'Quem descobriu o Brasil', 1),
(2, 'O Brasil fica em qual continente?', 1),
(16, 'Questao', 2),
(17, 'QuestÃ£o teste', 1),
(18, 'QuestÃ£o teste 01', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questaoquiz`
--

CREATE TABLE IF NOT EXISTS `questaoquiz` (
  `idQuestaoquiz` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `idQuiz` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idQuestaoquiz`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `questaoquiz`
--

INSERT INTO `questaoquiz` (`idQuestaoquiz`, `titulo`, `idQuiz`) VALUES
(1, 'questao de teste', 1),
(2, 'Testando', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionario`
--

CREATE TABLE IF NOT EXISTS `questionario` (
  `idQuestionario` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `idProfessor` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idQuestionario`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `questionario`
--

INSERT INTO `questionario` (`idQuestionario`, `titulo`, `status`, `idProfessor`) VALUES
(1, 'Questionario Teste 08', 0, 1),
(2, 'Teste de Questionario', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `idQuiz` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `tipo` tinyint(3) NOT NULL,
  `tempo` int(100) DEFAULT NULL,
  `idProfessor` int(11) NOT NULL,
  PRIMARY KEY (`idQuiz`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `quiz`
--

INSERT INTO `quiz` (`idQuiz`, `titulo`, `tipo`, `tempo`, `idProfessor`) VALUES
(1, 'Quiz teste', 1, 60, 1),
(4, 'Testando', 3, 190, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

CREATE TABLE IF NOT EXISTS `resposta` (
  `idAluno` int(11) NOT NULL DEFAULT '0',
  `idAlternativa` int(11) NOT NULL DEFAULT '0',
  `idGrupo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idAluno`,`idAlternativa`,`idGrupo`),
  KEY `idGrupo` (`idGrupo`),
  KEY `idAluno` (`idAluno`),
  KEY `idAlternativa` (`idAlternativa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resposta`
--

INSERT INTO `resposta` (`idAluno`, `idAlternativa`, `idGrupo`) VALUES
(2, 3, 1),
(2, 4, 1),
(3, 1, 1),
(3, 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `respostaquiz`
--

CREATE TABLE IF NOT EXISTS `respostaquiz` (
  `idAluno` int(11) NOT NULL DEFAULT '0',
  `idAlternativaquiz` int(11) NOT NULL DEFAULT '0',
  `idGrupo` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `idSlide` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL DEFAULT '0',
  `idProfessor` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idSlide`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `slide`
--

INSERT INTO `slide` (`idSlide`, `titulo`, `idProfessor`) VALUES
(1, 'Slide Teste 01', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `slideimg`
--

CREATE TABLE IF NOT EXISTS `slideimg` (
  `idImg` int(11) NOT NULL AUTO_INCREMENT,
  `ordem` int(11) NOT NULL DEFAULT '0',
  `idSlide` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idImg`),
  KEY `idSlide` (`idSlide`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `slideimg`
--

INSERT INTO `slideimg` (`idImg`, `ordem`, `idSlide`, `url`) VALUES
(1, 1, 1, 'http://static.knowyourmobile.com/sites/knowyourmobilecom/files/styles/gallery_wide/public/9/56/115580.png?itok=xsYcCs3n'),
(2, 2, 1, 'http://www.computerworld.ch/fileadmin/images/leadbilder/HTML5Teaser.jpg'),
(6, 0, 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPed4LKMb7X6O2Q7oYjSXQPr86tT9TBFMnqAhz9Id1IbggFN-R');

-- --------------------------------------------------------

--
-- Estrutura da tabela `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `idVideo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `idProfessor` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idVideo`),
  KEY `idProfessor` (`idProfessor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `video`
--

INSERT INTO `video` (`idVideo`, `titulo`, `url`, `idProfessor`) VALUES
(6, 'Teste de vÃ­deo', '8ozyXwLzFYs', 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alternativa`
--
ALTER TABLE `alternativa`
  ADD CONSTRAINT `alternativa_ibfk_1` FOREIGN KEY (`idQuestao`) REFERENCES `questao` (`idQuestao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `aula_ibfk_1` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `aulamaterial`
--
ALTER TABLE `aulamaterial`
  ADD CONSTRAINT `aulamaterial_ibfk_1` FOREIGN KEY (`idAula`) REFERENCES `aula` (`idAula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `grupoaluno`
--
ALTER TABLE `grupoaluno`
  ADD CONSTRAINT `grupoaluno_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupoaluno_ibfk_2` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `grupoaula`
--
ALTER TABLE `grupoaula`
  ADD CONSTRAINT `grupoaula_ibfk_1` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupoaula_ibfk_2` FOREIGN KEY (`idAula`) REFERENCES `aula` (`idAula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `questao`
--
ALTER TABLE `questao`
  ADD CONSTRAINT `questao_ibfk_1` FOREIGN KEY (`idQuestionario`) REFERENCES `questionario` (`idQuestionario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `questionario`
--
ALTER TABLE `questionario`
  ADD CONSTRAINT `questionario_ibfk_1` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resposta_ibfk_2` FOREIGN KEY (`idAlternativa`) REFERENCES `alternativa` (`idAlternativa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resposta_ibfk_3` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `slide`
--
ALTER TABLE `slide`
  ADD CONSTRAINT `slide_ibfk_1` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `slideimg`
--
ALTER TABLE `slideimg`
  ADD CONSTRAINT `slideimg_ibfk_1` FOREIGN KEY (`idSlide`) REFERENCES `slide` (`idSlide`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
