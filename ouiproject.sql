-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 24 Octobre 2017 à 17:39
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

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `comment`, `id_project`, `active`) VALUES
(1, 2, 'je suis très content de mon don, je trouve ça super', 1, 1);

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

--
-- Contenu de la table `financement`
--

INSERT INTO `financement` (`id`, `id_user`, `date`, `amount`, `id_pledge`, `id_project`) VALUES
(1, 2, '2017-10-16 17:03:57', 20, 1, 1),
(2, 3, '2017-10-19 17:14:48', 30, 1, 2),
(3, 7, '2017-10-19 17:15:05', 90, 1, 2),
(4, 7, '2017-10-19 17:15:37', 55, 3, 1),
(5, 7, '2017-10-24 17:16:35', 300, 1, 3),
(6, 9, '2017-10-24 17:16:35', 40, 2, 4),
(7, 4, '2017-10-24 17:17:09', 44, 3, 3),
(8, 3, '2017-10-24 17:17:09', 400, 4, 3),
(9, 9, '2017-10-24 17:18:13', 50, 3, 5),
(10, 4, '2017-10-24 17:18:13', 70, 4, 5),
(11, 4, '2017-10-24 17:18:51', 1000, 3, 1),
(12, 7, '2017-10-24 17:18:51', 4000, 2, 5),
(13, 6, '2017-10-24 17:29:10', 2000, 1, 2),
(14, 11, '2017-10-24 17:29:42', 1000, 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `link_tag_project`
--

CREATE TABLE `link_tag_project` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
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

--
-- Contenu de la table `pledge`
--

INSERT INTO `pledge` (`id`, `id_project`, `amount`, `description`, `qty_max`, `picture`) VALUES
(1, 1, 200000, 'lingot d\'or', 2, '/assets/img/pledge_default.png'),
(2, 5, 30, 'Un grand MERCI + un accessoire artisanal Huichol au choix: marque-page ou bracelet ou porte-clé. ', 50, '/assets/img/pledge_default.png'),
(3, 5, 139, 'A big THANK YOU + one pair of Women boots "Mazamitla" (regular price after the campaign : 229€). 4 colours : beige, burgundy, brown, black. Sizes from 36 to 41. We will contact you by email for the size and the colour. Shipping cost included for France ! 5€ for the European Union 10€ for the rest of the world', 20, '/assets/img/pledge_default.png'),
(4, 5, 10, 'Un grand MERCI + un agenda. ', 100, '/assets/img/pledge_default.png'),
(5, 5, 150, 'Un grand merci + une invitation à l inauguration', 10, '/assets/img/pledge_default.png');

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
  `dead_line` datetime DEFAULT NULL,
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

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`id`, `id_project_holder`, `date`, `title`, `short_description`, `description`, `picture1`, `picture2`, `picture3`, `sponsors`, `amount`, `little_picture`, `dead_line`, `launch_date`, `website`, `facebook`, `twitter`, `instagram`, `linkedin`, `nb_jobs`, `end_funding_date`, `step_form`, `general_interest`, `active`) VALUES
(1, 1, '2017-10-16 17:02:40', 'braquer une banque', 'ben voila je voudrais braquer une banque', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1),
(2, 3, '2017-10-16 17:26:04', 'plateforme de crowdfunding', 'Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis edives Caesaribus tamquam liberis suis regenda patrimonii iura permisit.', NULL, NULL, NULL, NULL, NULL, 3000, 'assets/img/project2.jpeg', '2017-12-14 00:00:00', '2017-10-19', NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, 0, 1),
(3, 5, '2017-10-19 12:07:09', 'Brasserie Bistronomie', 'Création d\'un restaurant à thème sur le modèle des bistro-gastro', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin imperdiet tortor sed odio pharetra, at convallis justo ornare. Suspendisse potenti. Vivamus semper pellentesque massa a efficitur. Suspendisse porttitor non leo non varius. Praesent quam dolor, finibus non rutrum quis, egestas vitae metus. Donec fermentum, tortor at elementum ultricies, mi ante pretium orci, eu facilisis enim est eu turpis. Vivamus ornare lorem ut quam luctus, et rhoncus massa scelerisque. Pellentesque maximus, diam nec porttitor cursus, mauris lorem euismod mauris, in venenatis ex nulla non purus. Fusce ultrices maximus aliquam. Sed laoreet ipsum sem, tincidunt fermentum erat faucibus ultrices. Nulla euismod quam ut velit pellentesque, et elementum metus eleifend. Cras ut mi vel est tincidunt pellentesque. Vivamus feugiat scelerisque orci, sit amet hendrerit turpis dignissim sit amet. Nulla aliquet ipsum vel enim posuere, sit amet lobortis sapien ultrices. Suspendisse mollis rhoncus sem, vel aliquam erat iaculis lacinia. Proin feugiat lorem et bibendum ornare. ', 'assets/img/pic1.jpg', 'assets/img/pic2.jpg', 'assets/img/pic3.jpg', 'Crédit apporté par le departement : 10000 €', 1500, 'assets/img/littlepic.jpg', '2017-11-10 00:00:00', '2017-10-28', 'https://www.guillaumeharari.com/', 'https://www.facebook.com/guillaume.harari', 'https://www.twitter.com/veillefiscale', 'https://www.instagram.com/gh/', 'https:/linkedin.fr/guillaume.harari', 2, NULL, 0, 0, 1),
(4, 2, '2017-10-16 17:29:43', 'ouvrir antenne a la loupe', 'Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis edives Caesaribus tamquam liberis suis regenda patrimonii iura permisit.', NULL, NULL, NULL, NULL, NULL, 4000, 'assets/img/project1.jpeg', '2017-11-25 00:00:00', '2017-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, 1),
(5, 4, '2017-10-17 17:56:44', 'Bottines chics et solidaires', 'Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis edives Caesaribus tamquam liberis suis regenda patrimonii iura permisit.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin imperdiet tortor sed odio pharetra, at convallis justo ornare. Suspendisse potenti. Vivamus semper pellentesque massa a efficitur. Suspendisse porttitor non leo non varius. Praesent quam dolor, finibus non rutrum quis, egestas vitae metus. Donec fermentum, tortor at elementum ultricies, mi ante pretium orci, eu facilisis enim est eu turpis. Vivamus ornare lorem ut quam luctus, et rhoncus massa scelerisque. Pellentesque maximus, diam nec porttitor cursus, mauris lorem euismod mauris, in venenatis ex nulla non purus. Fusce ultrices maximus aliquam. Sed laoreet ipsum sem, tincidunt fermentum erat faucibus ultrices. Nulla euismod quam ut velit pellentesque, et elementum metus eleifend. Cras ut mi vel est tincidunt pellentesque. Vivamus feugiat scelerisque orci, sit amet hendrerit turpis dignissim sit amet. Nulla aliquet ipsum vel enim posuere, sit amet lobortis sapien ultrices. Suspendisse mollis rhoncus sem, vel aliquam erat iaculis lacinia. Proin feugiat lorem et bibendum ornare. ', 'assets/img/pic1.jpg', 'assets/img/pic2.jpg', 'assets/img/pic3.jpg', 'Crédit apporté par le conseil régional : 6000 €', 9000, '/assets/img/project3.jpeg', '2017-11-15 00:00:00', '2017-10-31', 'https://www.tapatia.co/', 'https://www.facebook.com/tapatia.co', 'https://www.twitter.com/tapatia', 'https://www.instagram.com/tapatiabrand/', 'https:/linkedin.fr/tapiata', 2, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `project_holder`
--

CREATE TABLE `project_holder` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `structure_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
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

--
-- Contenu de la table `project_holder`
--

INSERT INTO `project_holder` (`id`, `id_user`, `date`, `structure_name`, `name`, `first_name`, `avatar`, `iban`, `siret`, `kbis`, `phone`, `status`, `ident_card`, `active`) VALUES
(1, 1, '2017-10-16 17:01:55', NULL, 'dalton', 'jo', '/assets/img/default.png', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 3, '2017-10-16 17:20:05', NULL, 'sad', 'hill', '/assets/img/projectholder.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 4, '2017-10-16 17:22:35', NULL, 'rak', 'goldo', '/assets/img/projectholder2.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 8, '2017-10-17 17:56:44', NULL, 'bar', 'foo', '/assets/img/projectholder3.jpg', 'FR7630004017900000056897248', '51136363200049', '/uploaded/kbisndi.pdf', '0698810574', 'Entreprise', '/uploaded/cnindi.pdf', 1),
(5, 9, '2017-10-19 12:04:52', NULL, 'HARARI', 'Guillaume', '/assets/img/projectholder3.jpg', 'FR7630004089700000054577248', '51136583200049', '/uploaded/kbisndigh.pdf', '0698817574', 'Association', '/uploaded/cnindigh.pdf', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `tag_name`) VALUES
(1, 'culture'),
(2, 'santé');

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
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `pseudo`, `date`, `password`, `mail_valid`) VALUES
(1, 'jo@dalton.us', 'jo', '2017-10-16 17:01:25', 'madalton', 1),
(2, 'lucky@luke.us', 'lucky', '2017-10-16 17:03:37', 'rantanplan', 1),
(3, 'averell@dalton.com', 'averell', '2017-10-16 17:17:11', 'madalton', 0),
(4, 'jack@dalton.com', 'jack', '2017-10-16 17:17:11', 'daltonma', 1),
(5, 'johnny@cash.com', 'johnny', '2017-10-16 17:17:45', 'iwalktheline', 1),
(6, 'clint@eastwood.us', 'clint', '2017-10-16 17:18:39', 'vivaamerica', 0),
(7, 'pop@eye.com', 'popeye', '2017-10-16 17:19:11', 'jaimelefer', 1),
(8, 'perlimpimpin@elysee.fr', 'manumacron', '2017-10-17 17:56:44', 'mypassword', 0),
(9, 'guillaumeharari@hotmail.com', 'guillaumebdx', '2017-10-19 12:04:52', '123456', 0),
(10, 'guillaumeharari@hotmail.com', 'guillaumebdx', '2017-10-19 12:05:30', '123456', 0),
(11, 'guillaumeharari@hotmail.com', 'guillaumebdx', '2017-10-19 12:07:09', '123456', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_project`),
  ADD KEY `id_project` (`id_project`);

--
-- Index pour la table `financement`
--
ALTER TABLE `financement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pledge` (`id_pledge`,`id_project`),
  ADD KEY `id_project` (`id_project`);

--
-- Index pour la table `link_tag_project`
--
ALTER TABLE `link_tag_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_project` (`id_project`,`id_tag`),
  ADD KEY `id_tag` (`id_tag`);

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
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `financement`
--
ALTER TABLE `financement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `link_tag_project`
--
ALTER TABLE `link_tag_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pledge`
--
ALTER TABLE `pledge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `project_holder`
--
ALTER TABLE `project_holder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `financement`
--
ALTER TABLE `financement`
  ADD CONSTRAINT `financement_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `financement_ibfk_2` FOREIGN KEY (`id_pledge`) REFERENCES `pledge` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `financement_ibfk_3` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `link_tag_project`
--
ALTER TABLE `link_tag_project`
  ADD CONSTRAINT `link_tag_project_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_tag_project_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `pledge`
--
ALTER TABLE `pledge`
  ADD CONSTRAINT `pledge_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`id_project_holder`) REFERENCES `project_holder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `project_holder`
--
ALTER TABLE `project_holder`
  ADD CONSTRAINT `project_holder_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
