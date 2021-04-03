-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Dim 04 avr. 2021 à 01:23
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `h`
--

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_article`
--

CREATE TABLE `tbl_article` (
  `id_article` int(11) NOT NULL,
  `ref_article` int(20) DEFAULT NULL,
  `design_article` varchar(100) DEFAULT NULL,
  `prix_article` decimal(20,0) NOT NULL,
  `id_famille` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tbl_article`
--

INSERT INTO `tbl_article` (`id_article`, `ref_article`, `design_article`, `prix_article`, `id_famille`) VALUES
(1, NULL, 'Pompe à rivet', '20000', 1),
(2, NULL, 'PEINTURE INT', '1500', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(255) NOT NULL,
  `adresse_client` varchar(255) NOT NULL,
  `stat_client` varchar(60) NOT NULL,
  `nif_client` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tbl_client`
--

INSERT INTO `tbl_client` (`id_client`, `nom_client`, `adresse_client`, `stat_client`, `nif_client`) VALUES
(1, 'CLINIQUE SAINT LUC Mr RAKOTOMAVO NOEL', 'Lot IVH Mgrhgeb  ghrghebrb heghreg', '45454 45454 fdfdf', '6000649772'),
(2, 'ENTREPRISE VITASOA Mr MOISE HOUSSEN', 'Lot cg 963 Tanambao Morafeno Tuléar', 'fhjhjd 56654 44564', '4001792815');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_detail_facture`
--

CREATE TABLE `tbl_detail_facture` (
  `id_detail_facture` int(11) NOT NULL,
  `id_facture` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `qte_article` int(60) NOT NULL,
  `creation_detail` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tbl_detail_facture`
--

INSERT INTO `tbl_detail_facture` (`id_detail_facture`, `id_facture`, `id_article`, `qte_article`, `creation_detail`) VALUES
(2, 10, 1, 12, '2021-04-03 15:10:06'),
(3, 10, 2, 18, '2021-04-03 15:10:06'),
(4, 12, 1, 20, '2021-04-03 15:24:55'),
(5, 12, 2, 50, '2021-04-03 15:24:55'),
(6, 13, 2, 20, '2021-04-03 16:54:11'),
(7, 13, 1, 12, '2021-04-03 16:54:11'),
(8, 14, 1, 10, '2021-04-03 17:00:06'),
(10, 15, 1, 12, '2021-04-03 17:04:55'),
(12, 16, 1, 20, '2021-04-03 17:31:56');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_facture`
--

CREATE TABLE `tbl_facture` (
  `id_facture` int(11) NOT NULL,
  `numero_facture` varchar(100) DEFAULT NULL,
  `date_facture` date NOT NULL,
  `id_client` int(11) NOT NULL,
  `creation_facture` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tbl_facture`
--

INSERT INTO `tbl_facture` (`id_facture`, `numero_facture`, `date_facture`, `id_client`, `creation_facture`) VALUES
(1, NULL, '2021-03-12', 2, '2021-04-03 13:34:17'),
(2, NULL, '2021-03-15', 2, '2021-04-03 14:50:29'),
(3, NULL, '2021-03-15', 2, '2021-04-03 14:51:44'),
(4, NULL, '2021-03-15', 2, '2021-04-03 14:54:29'),
(5, NULL, '2021-03-14', 2, '2021-04-03 14:58:33'),
(6, NULL, '2021-03-14', 2, '2021-04-03 14:59:20'),
(7, NULL, '2021-03-14', 2, '2021-04-03 14:59:46'),
(8, NULL, '2021-03-14', 2, '2021-04-03 15:00:50'),
(9, NULL, '2021-03-14', 1, '2021-04-03 15:09:47'),
(10, NULL, '2021-03-14', 1, '2021-04-03 15:10:06'),
(11, NULL, '2021-03-14', 1, '2021-04-03 15:23:22'),
(12, '03042021-12', '2021-03-14', 1, '2021-04-03 15:24:55'),
(13, '03042021-13', '2021-03-14', 2, '2021-04-03 16:54:10'),
(14, '03042021-14', '2021-03-14', 1, '2021-04-03 17:00:06'),
(15, '03042021-15', '2021-03-14', 2, '2021-04-03 17:04:55'),
(16, '03042021-16', '2021-03-12', 2, '2021-04-03 17:31:56');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_famille`
--

CREATE TABLE `tbl_famille` (
  `id_famille` int(11) NOT NULL,
  `code_famille` int(4) NOT NULL,
  `nom_famille` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tbl_famille`
--

INSERT INTO `tbl_famille` (`id_famille`, `code_famille`, `nom_famille`) VALUES
(1, 101, ''),
(2, 102, ''),
(3, 103, ''),
(4, 104, '');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(1, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 88.0.4324.182', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36', 'Linux', '2021-04-02 22:27:14'),
(2, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 88.0.4324.182', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36', 'Linux', '2021-04-03 08:11:43'),
(3, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 88.0.4324.182', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36', 'Linux', '2021-04-03 10:17:04');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` bigint(20) NOT NULL DEFAULT 1,
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Manager'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@example.com', '$2y$10$6NOKhXKiR2SAgpFF2WpCkuRgYKlSqFJaqM0NgIM3PT1gKHEM5/SM6', 'System Administrator', '9890098900', 1, 0, 0, '2015-07-01 18:56:49', 1, '2018-01-05 05:56:34'),
(2, 'manager@example.com', '$2y$10$quODe6vkNma30rcxbAHbYuKYAZQqUaflBgc4YpV9/90ywd.5Koklm', 'Manager', '9890098900', 2, 0, 1, '2016-12-09 17:49:56', 1, '2018-01-12 07:22:11'),
(3, 'employee@example.com', '$2y$10$UYsH1G7MkDg1cutOdgl2Q.ZbXjyX.CSjsdgQKvGzAgl60RXZxpB5u', 'Employee', '9890098900', 3, 0, 1, '2016-12-09 17:50:22', 3, '2018-01-04 07:58:28');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Index pour la table `tbl_article`
--
ALTER TABLE `tbl_article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `id_famille` (`id_famille`);

--
-- Index pour la table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `tbl_detail_facture`
--
ALTER TABLE `tbl_detail_facture`
  ADD PRIMARY KEY (`id_detail_facture`),
  ADD KEY `id_facture` (`id_facture`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `tbl_facture`
--
ALTER TABLE `tbl_facture`
  ADD PRIMARY KEY (`id_facture`),
  ADD KEY `id_facture` (`id_facture`,`id_client`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `tbl_famille`
--
ALTER TABLE `tbl_famille`
  ADD PRIMARY KEY (`id_famille`);

--
-- Index pour la table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Index pour la table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tbl_article`
--
ALTER TABLE `tbl_article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tbl_detail_facture`
--
ALTER TABLE `tbl_detail_facture`
  MODIFY `id_detail_facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `tbl_facture`
--
ALTER TABLE `tbl_facture`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `tbl_famille`
--
ALTER TABLE `tbl_famille`
  MODIFY `id_famille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tbl_article`
--
ALTER TABLE `tbl_article`
  ADD CONSTRAINT `tbl_article_ibfk_1` FOREIGN KEY (`id_famille`) REFERENCES `tbl_famille` (`id_famille`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tbl_detail_facture`
--
ALTER TABLE `tbl_detail_facture`
  ADD CONSTRAINT `tbl_detail_facture_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `tbl_article` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_facture_ibfk_2` FOREIGN KEY (`id_facture`) REFERENCES `tbl_facture` (`id_facture`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tbl_facture`
--
ALTER TABLE `tbl_facture`
  ADD CONSTRAINT `tbl_facture_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `tbl_client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
