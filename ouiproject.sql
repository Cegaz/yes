-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 16 Octobre 2017 à 15:51
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ouiproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `id_project` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `financement`
--

CREATE TABLE `financement` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(30) NOT NULL,
  `id_pledge` int(11) NOT NULL,
  `id_project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `pledge`
--

CREATE TABLE `pledge` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `qty_max` int(10) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '/assets/img/pledge_default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `id_project_holder` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `short_description` text COLLATE utf8_bin,
  `description` text COLLATE utf8_bin,
  `picture1` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `picture2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `picture3` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `sponsors` text COLLATE utf8_bin,
  `amount` int(30) DEFAULT NULL,
  `little_picture` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `dead_line` date DEFAULT NULL,
  `launch_date` date DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `nb_jobs` int(11) DEFAULT NULL,
  `end_funding_date` date DEFAULT NULL,
  `step_form` tinyint(4) NOT NULL DEFAULT '0',
  `general_interest` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `project_holder`
--

CREATE TABLE `project_holder` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `avatar` varchar(255) COLLATE utf8_bin DEFAULT '/assets/img/default.png',
  `iban` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `siret` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `kbis` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `ident_card` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `pseudo` varchar(30) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `mail_valid` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_project`);

--
-- Index pour la table `financement`
--
ALTER TABLE `financement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pledge` (`id_pledge`,`id_project`);

--
-- Index pour la table `pledge`
--
ALTER TABLE `pledge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_project` (`id_project`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_project_holder` (`id_project_holder`);

--
-- Index pour la table `project_holder`
--
ALTER TABLE `project_holder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `financement`
--
ALTER TABLE `financement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pledge`
--
ALTER TABLE `pledge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `project_holder`
--
ALTER TABLE `project_holder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
