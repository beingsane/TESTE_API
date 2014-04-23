-- --------------------------------------------------------
-- Host:                         mysql03.servicos-web.net
-- Server version:               5.1.54-rel12.6-log - Locaweb MySQL Server (GPL), 12.6, Percona Revision
-- Server OS:                    unknown-linux-gnu
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2014-04-23 15:21:07
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for servicos_web2
CREATE DATABASE IF NOT EXISTS `servicos_web2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `servicos_web2`;


-- Dumping structure for table servicos_web2.car
CREATE TABLE IF NOT EXISTS `car` (
  `id_car` int(10) NOT NULL AUTO_INCREMENT,
  `id_marca_rel` int(10) DEFAULT '0',
  `img` varchar(255) DEFAULT '0',
  `value_car` double(10,2) DEFAULT '0.00',
  `parc_number` int(11) DEFAULT '0',
  `year` int(11) DEFAULT NULL,
  `value_Total_interest` double(10,2) DEFAULT NULL,
  `date_cad` datetime DEFAULT NULL,
  `name_car` varchar(255) NOT NULL,
  `id_user_rel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_car`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table servicos_web2.car: 1 rows
DELETE FROM `car`;
/*!40000 ALTER TABLE `car` DISABLE KEYS */;
INSERT INTO `car` (`id_car`, `id_marca_rel`, `img`, `value_car`, `parc_number`, `year`, `value_Total_interest`, `date_cad`, `name_car`, `id_user_rel`) VALUES
	(2, 6, '9419ce7796281cfa894083541771a960.jpg', 20000.00, 12, 2013, 21680.00, '2014-04-23 01:27:00', 'GOL', 1);
/*!40000 ALTER TABLE `car` ENABLE KEYS */;


-- Dumping structure for table servicos_web2.marcas
CREATE TABLE IF NOT EXISTS `marcas` (
  `id_marca` int(10) NOT NULL AUTO_INCREMENT,
  `date_cad` datetime NOT NULL,
  `id_user_cad` int(11) DEFAULT '0',
  `name_marca` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table servicos_web2.marcas: 1 rows
DELETE FROM `marcas`;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` (`id_marca`, `date_cad`, `id_user_cad`, `name_marca`) VALUES
	(6, '2014-04-23 11:02:00', 1, 'FIAT');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;


-- Dumping structure for table servicos_web2.sys_log
CREATE TABLE IF NOT EXISTS `sys_log` (
  `idSysLog` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idUserSysLog` int(11) NOT NULL,
  `userDescSysLog` varchar(150) NOT NULL,
  `moduleSysLog` varchar(255) NOT NULL DEFAULT '0',
  `dateTimeSysLog` datetime NOT NULL,
  `infoSysLog` text NOT NULL,
  `type_log` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idSysLog`)
) ENGINE=InnoDB AUTO_INCREMENT=319 DEFAULT CHARSET=latin1;

-- Dumping data for table servicos_web2.sys_log: ~105 rows (approximately)
DELETE FROM `sys_log`;
/*!40000 ALTER TABLE `sys_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_log` ENABLE KEYS */;


-- Dumping structure for table servicos_web2.sys_mens_user
CREATE TABLE IF NOT EXISTS `sys_mens_user` (
  `idMensUser` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contentMensUser` varchar(400) NOT NULL,
  `idUserSend` int(11) NOT NULL,
  `idUserReceived` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = Não lida 1 = Lida',
  PRIMARY KEY (`idMensUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table servicos_web2.sys_mens_user: ~0 rows (approximately)
DELETE FROM `sys_mens_user`;
/*!40000 ALTER TABLE `sys_mens_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_mens_user` ENABLE KEYS */;


-- Dumping structure for table servicos_web2.sys_metodos
CREATE TABLE IF NOT EXISTS `sys_metodos` (
  `idSysMetodos` int(11) NOT NULL AUTO_INCREMENT,
  `classeSysMetodos` varchar(64) NOT NULL,
  `metodoSysMetodos` varchar(64) NOT NULL,
  `apelidoSysMetodos` varchar(255) NOT NULL,
  `privadoSysMetodos` tinyint(4) DEFAULT NULL,
  `abaSysMetodos` varchar(64) DEFAULT NULL,
  `moduloSysMetodos` varchar(255) NOT NULL,
  `descSysMetodos` varchar(255) DEFAULT NULL,
  `menuLat` tinyint(4) NOT NULL DEFAULT '0',
  `linkMenu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idSysMetodos`),
  UNIQUE KEY `apelidoSysMetodos` (`apelidoSysMetodos`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=latin1;

-- Dumping data for table servicos_web2.sys_metodos: ~41 rows (approximately)
DELETE FROM `sys_metodos`;
/*!40000 ALTER TABLE `sys_metodos` DISABLE KEYS */;
INSERT INTO `sys_metodos` (`idSysMetodos`, `classeSysMetodos`, `metodoSysMetodos`, `apelidoSysMetodos`, `privadoSysMetodos`, `abaSysMetodos`, `moduloSysMetodos`, `descSysMetodos`, `menuLat`, `linkMenu`) VALUES
	(83, 'Perfil_mig', 'index', 'backend/perfil_mig/index', 1, 'Sistema', 'PERFIL', 'Formulário para edição dos dados pessoais', 1, 'Dados pessoais'),
	(84, 'Default_page_mig', 'index', 'backend/default_page_mig/index', 1, '', '', '', 0, ''),
	(85, 'Deslog_mig', 'index', 'backend/deslog_mig/index', 0, '', '', '', 0, ''),
	(86, 'Error_mig', 'permition', 'backend/error_mig/permition', 1, '', '', '', 0, ''),
	(87, 'Info_mig', 'index', 'backend/info_mig/index', 1, 'Sistema', 'INFO', 'Exibe as informações sobre o MIG', 1, 'Info'),
	(88, 'Login_mig', 'index', 'backend/login_mig/index', -1, '', '', '', 0, ''),
	(89, 'Login_mig', 'exec_login', 'backend/login_mig/exec_login', -1, '', '', '', 0, ''),
	(90, 'Logs_mig', 'index', 'backend/logs_mig/index', 2, 'Sistema', 'LOGS', 'Exibe os logs do sistema MIG', 1, 'Logs'),
	(91, 'Perfis_mig', 'index', 'backend/perfis_mig/index', 2, 'Sistema', 'PERFIS', 'Lista os perfis de acesso cadastrados', 1, 'Perfis'),
	(92, 'Perfis_mig', 'add', 'backend/perfis_mig/add', 2, 'Sistema', 'PERFIS', 'Formulário para adição de perfis', 0, ''),
	(93, 'Perfis_mig', 'add_commit', 'backend/perfis_mig/add_commit', 2, 'Sistema', 'PERFIS', 'Executa o cadastro de perfis', 0, ''),
	(94, 'Perfis_mig', 'edit', 'backend/perfis_mig/edit', 2, 'Sistema', 'PERFIS', 'Formulário de edição de perfis', 0, ''),
	(95, 'Perfis_mig', 'edit_commit', 'backend/perfis_mig/edit_commit', 2, 'Sistema', 'PERFIS', 'Executa o edição de perfis', 0, ''),
	(96, 'Perfis_mig', 'block', 'backend/perfis_mig/block', 2, 'Sistema', 'PERFIS', 'Executa o bloqueio de perfis', 0, ''),
	(97, 'Perfis_mig', 'un_block', 'backend/perfis_mig/un_block', 2, 'Sistema', 'PERFIS', 'Executa o desbloqueio de perfis', 0, ''),
	(98, 'User_mig', 'index', 'backend/user_mig/index', 2, 'Sistema', 'USUÁRIOS MIG', 'Lista os usuários MIG cadastrados', 1, 'Usuários'),
	(99, 'User_mig', 'add', 'backend/user_mig/add', 2, 'Sistema', 'USUÁRIOS MIG', 'Formulário de cadastro de usuários MIG', 0, ''),
	(100, 'User_mig', 'add_commit', 'backend/user_mig/add_commit', 2, '', 'USUÁRIOS MIG', 'Executa o cadastro de usuários MIG', 0, ''),
	(101, 'User_mig', 'edit', 'backend/user_mig/edit', 2, '', 'USUÁRIOS MIG', 'Formulário de edição de usuários MIG', 0, ''),
	(102, 'User_mig', 'edit_commit', 'backend/user_mig/edit_commit', 2, '', 'USUÁRIOS MIG', 'Executa a edição de usuários MIG', 0, ''),
	(103, 'User_mig', 'block', 'backend/user_mig/block', 2, '', 'USUÁRIOS MIG', 'Boqueia usuários MIG', 0, ''),
	(104, 'User_mig', 'un_block', 'backend/user_mig/un_block', 2, '', 'USUÁRIOS MIG', 'Desbloqueia usuário MIG', 0, ''),
	(105, 'Roles_mig', 'index', 'backend/roles_mig/index', 2, 'Sistema', 'ROLES', 'Lista os módulos e tarefas da pasta BACKEND ', 1, 'Regras de acesso'),
	(107, 'Roles_mig_json', 'remove', 'backend/roles_mig_json/remove', 4, 'Sistema', 'ROLES', 'Remove um Módulo tarefa que não existe mais na pasta BACKEND', 0, ''),
	(108, 'Roles_mig_json', 'edit', 'backend/roles_mig_json/edit', 4, 'Sistema', 'ROLES', 'Edita os módulos e tarefas da pasta BACKEND ', 0, ''),
	(109, 'Perfil_mig', 'edit', 'backend/perfil_mig/edit', 1, 'Sistema', 'PERFIL', 'Edita os dados pessoais', 0, ''),
	(110, 'List_icon_mig', 'index', 'backend/list_icon_mig/index', 1, 'Sistema', 'ICONES', 'Exibe todos os ícones disponiveis', 1, 'Lista de ícones '),
	(111, 'Carros', 'index', 'backend/carros/index', 2, 'Teste API', 'CARROS', 'Exibe a lista de carros cadastradas', 1, 'Carros'),
	(112, 'Carros', 'add_form', 'backend/carros/add_form', 2, 'Teste API', 'CARROS', 'Formulário de cadastro de carros', 0, ''),
	(113, 'Carros', 'add_commit', 'backend/carros/add_commit', 2, 'Teste API', 'CARROS', 'Cadastra os dados do veículo', 0, ''),
	(114, 'Carros', 'edit_form', 'backend/carros/edit_form', 2, 'Teste API', 'CARROS', 'Formulário para edição de  carros sem o valor', 0, ''),
	(115, 'Carros', 'edit_commit', 'backend/carros/edit_commit', 2, 'Teste API', 'CARROS', 'Executa a edição de um carro', 0, ''),
	(116, 'Marcas', 'index', 'backend/marcas/index', 2, 'Teste API', 'MARCAS', 'Exibe as marcas cadastradas', 1, 'Marcas'),
	(117, 'Marcas', 'add_form', 'backend/marcas/add_form', 2, 'Teste API', 'MARCAS', 'Formulário de cadastro de marcas', 0, ''),
	(118, 'Marcas', 'add_commit', 'backend/marcas/add_commit', 2, 'Teste API', 'MARCAS', 'Executa o cadastro de uma marca', 0, ''),
	(119, 'Marcas', 'edit_form', 'backend/marcas/edit_form', 2, 'Teste API', 'MARCAS', 'Formulário de edição de marcas', 0, ''),
	(120, 'Marcas', 'edit_commit', 'backend/marcas/edit_commit', 2, 'Teste API', 'MARCAS', 'Executa a edição de uma marca', 0, ''),
	(121, 'Upload_mig_file_json', 'index', 'backend/upload_mig_file_json/index', 4, '', '', '', 0, ''),
	(161, 'Carros', 'edit_form_full', 'backend/carros/edit_form_full', 2, 'Teste API', 'CARROS', 'Formulário para eddição de carros de todos os dados ', 0, ''),
	(162, 'Carros', 'remove_commit', 'backend/carros/remove_commit', 2, 'Teste API', 'CARROS', 'Remove os carros selecionados', 0, ''),
	(163, 'Marcas', 'remove_commit', 'backend/marcas/remove_commit', 2, 'Teste API', 'MARCAS', 'Remove as marcas selecionadas', 0, '');
/*!40000 ALTER TABLE `sys_metodos` ENABLE KEYS */;


-- Dumping structure for table servicos_web2.sys_pass_lost
CREATE TABLE IF NOT EXISTS `sys_pass_lost` (
  `id_pass_lost` int(10) NOT NULL AUTO_INCREMENT,
  `pass_generated` varchar(50) DEFAULT '0',
  `email_user` varchar(255) DEFAULT '0',
  `code_link` varchar(255) DEFAULT '0',
  `date_cad` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_pass_lost`),
  UNIQUE KEY `Index 2` (`email_user`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table servicos_web2.sys_pass_lost: 1 rows
DELETE FROM `sys_pass_lost`;
/*!40000 ALTER TABLE `sys_pass_lost` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_pass_lost` ENABLE KEYS */;


-- Dumping structure for table servicos_web2.sys_perfil
CREATE TABLE IF NOT EXISTS `sys_perfil` (
  `idSysPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `nameSysPerfil` varchar(255) NOT NULL,
  `descSysPerfil` varchar(255) DEFAULT NULL,
  `attributesSysPerfil` varchar(255) DEFAULT NULL,
  `ativoSysPerfil` tinyint(4) NOT NULL,
  PRIMARY KEY (`idSysPerfil`),
  UNIQUE KEY `nameSysPerfil` (`nameSysPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table servicos_web2.sys_perfil: ~3 rows (approximately)
DELETE FROM `sys_perfil`;
/*!40000 ALTER TABLE `sys_perfil` DISABLE KEYS */;
INSERT INTO `sys_perfil` (`idSysPerfil`, `nameSysPerfil`, `descSysPerfil`, `attributesSysPerfil`, `ativoSysPerfil`) VALUES
	(1, 'Admin', 'Perfil de super administrador.', 'Perfil de super administrador.', 1),
	(2, 'Funcionário', 'Perfil de funciorário', 'Perfil de funciorário', 1),
	(6, 'Teste alterado', 'Descrição', 'Descrição', 0);
/*!40000 ALTER TABLE `sys_perfil` ENABLE KEYS */;


-- Dumping structure for table servicos_web2.sys_perfiluser
CREATE TABLE IF NOT EXISTS `sys_perfiluser` (
  `idUserSysPerfil` int(11) NOT NULL COMMENT 'Id do usuário',
  `idPerfilSysPerfilUser` int(11) NOT NULL COMMENT 'Id do perfil'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table servicos_web2.sys_perfiluser: ~4 rows (approximately)
DELETE FROM `sys_perfiluser`;
/*!40000 ALTER TABLE `sys_perfiluser` DISABLE KEYS */;
INSERT INTO `sys_perfiluser` (`idUserSysPerfil`, `idPerfilSysPerfilUser`) VALUES
	(1, 1),
	(1, 2),
	(1, 6),
	(2, 2);
/*!40000 ALTER TABLE `sys_perfiluser` ENABLE KEYS */;


-- Dumping structure for table servicos_web2.sys_permissoes
CREATE TABLE IF NOT EXISTS `sys_permissoes` (
  `idSysPermissoes` bigint(20) NOT NULL AUTO_INCREMENT,
  `idMetodoSysPermissoes` int(11) NOT NULL,
  `idPerfilSysPermissoes` int(11) NOT NULL,
  `classe_methodo` varchar(255) NOT NULL,
  PRIMARY KEY (`idSysPermissoes`)
) ENGINE=InnoDB AUTO_INCREMENT=852 DEFAULT CHARSET=latin1;

-- Dumping data for table servicos_web2.sys_permissoes: ~48 rows (approximately)
DELETE FROM `sys_permissoes`;
/*!40000 ALTER TABLE `sys_permissoes` DISABLE KEYS */;
INSERT INTO `sys_permissoes` (`idSysPermissoes`, `idMetodoSysPermissoes`, `idPerfilSysPermissoes`, `classe_methodo`) VALUES
	(804, 113, 1, 'carros/add_commit'),
	(805, 112, 1, 'carros/add_form'),
	(806, 115, 1, 'carros/edit_commit'),
	(807, 114, 1, 'carros/edit_form'),
	(808, 161, 1, 'carros/edit_form_full'),
	(809, 111, 1, 'carros/index'),
	(810, 162, 1, 'carros/remove_commit'),
	(811, 87, 1, 'info_mig/index'),
	(812, 110, 1, 'list_icon_mig/index'),
	(813, 90, 1, 'logs_mig/index'),
	(814, 118, 1, 'marcas/add_commit'),
	(815, 117, 1, 'marcas/add_form'),
	(816, 120, 1, 'marcas/edit_commit'),
	(817, 119, 1, 'marcas/edit_form'),
	(818, 116, 1, 'marcas/index'),
	(819, 163, 1, 'marcas/remove_commit'),
	(820, 109, 1, 'perfil_mig/edit'),
	(821, 83, 1, 'perfil_mig/index'),
	(822, 92, 1, 'perfis_mig/add'),
	(823, 93, 1, 'perfis_mig/add_commit'),
	(824, 96, 1, 'perfis_mig/block'),
	(825, 94, 1, 'perfis_mig/edit'),
	(826, 95, 1, 'perfis_mig/edit_commit'),
	(827, 91, 1, 'perfis_mig/index'),
	(828, 97, 1, 'perfis_mig/un_block'),
	(829, 105, 1, 'roles_mig/index'),
	(830, 108, 1, 'roles_mig_json/edit'),
	(831, 107, 1, 'roles_mig_json/remove'),
	(832, 99, 1, 'user_mig/add'),
	(833, 100, 1, 'user_mig/add_commit'),
	(834, 103, 1, 'user_mig/block'),
	(835, 101, 1, 'user_mig/edit'),
	(836, 102, 1, 'user_mig/edit_commit'),
	(837, 98, 1, 'user_mig/index'),
	(838, 104, 1, 'user_mig/un_block'),
	(839, 113, 2, 'carros/add_commit'),
	(840, 112, 2, 'carros/add_form'),
	(841, 115, 2, 'carros/edit_commit'),
	(842, 114, 2, 'carros/edit_form'),
	(843, 111, 2, 'carros/index'),
	(844, 87, 2, 'info_mig/index'),
	(845, 118, 2, 'marcas/add_commit'),
	(846, 117, 2, 'marcas/add_form'),
	(847, 120, 2, 'marcas/edit_commit'),
	(848, 119, 2, 'marcas/edit_form'),
	(849, 116, 2, 'marcas/index'),
	(850, 109, 2, 'perfil_mig/edit'),
	(851, 83, 2, 'perfil_mig/index');
/*!40000 ALTER TABLE `sys_permissoes` ENABLE KEYS */;


-- Dumping structure for table servicos_web2.sys_usuarios
CREATE TABLE IF NOT EXISTS `sys_usuarios` (
  `idSysUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `userNameSysUsuarios` varchar(255) NOT NULL,
  `nomeSysUsuarios` varchar(255) NOT NULL,
  `emailSysUsuarios` varchar(255) NOT NULL,
  `ativoSysUsuarios` tinyint(4) NOT NULL DEFAULT '0',
  `ultimoAcessoSysUsuarios` datetime DEFAULT NULL,
  `passwordSysUsuarios` varchar(32) NOT NULL,
  `metodoPadraoSysUsuarios` varchar(255) NOT NULL,
  PRIMARY KEY (`idSysUsuarios`),
  UNIQUE KEY `emailSysUsuarios` (`emailSysUsuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table servicos_web2.sys_usuarios: ~2 rows (approximately)
DELETE FROM `sys_usuarios`;
/*!40000 ALTER TABLE `sys_usuarios` DISABLE KEYS */;
INSERT INTO `sys_usuarios` (`idSysUsuarios`, `userNameSysUsuarios`, `nomeSysUsuarios`, `emailSysUsuarios`, `ativoSysUsuarios`, `ultimoAcessoSysUsuarios`, `passwordSysUsuarios`, `metodoPadraoSysUsuarios`) VALUES
	(1, 'admin', 'Admin', 'admin@teste.com.br', 1, '2014-04-23 15:18:07', '698dc19d489c4e4db73e28a713eab07b', '0'),
	(2, 'funcionario', 'Funcionário', 'diego-neumann@hotmail.com', 1, '2014-04-23 15:18:39', '698dc19d489c4e4db73e28a713eab07b', '0');
/*!40000 ALTER TABLE `sys_usuarios` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
