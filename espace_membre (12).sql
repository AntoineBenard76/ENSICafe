-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 09 Juin 2017 à 14:34
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `nomExp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenomExp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenuMes` text COLLATE utf8_unicode_ci NOT NULL,
  `dateMes` datetime NOT NULL,
  `avatarMes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attributExp` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`id`, `nomExp`, `prenomExp`, `contenuMes`, `dateMes`, `avatarMes`, `attributExp`) VALUES
(24, 'Weber', 'Jonathan', 'ergerzgrg', '2017-06-09 14:32:35', '14.png', 'Professeur');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `motdepasse` text COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `specialite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attribut` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `mail`, `motdepasse`, `nom`, `prenom`, `date`, `genre`, `avatar`, `specialite`, `attribut`) VALUES
(14, 'jonathan.weber@uha.fr', '3692bfa45759a67d83aedf0045f6cb635a966abf', 'Weber', 'Jonathan', '2017-04-07', 'Homme', '14.png', 'Autre', 'Professeur'),
(15, 'francois@uha.fr', '5187da0b934cc25eb2201a3ec9206c24b13cb23b', 'Straebler', 'FranÃ§ois', '2017-06-01', 'Homme', 'default.jpg', 'Informatique &amp; RÃ©seaux', 'Etudiant'),
(16, 'jacky@uha.fr', '64366715a186eea098dd2391f69c1afda4507574', 'Tuning', 'Jacky', '2017-06-02', 'Homme', 'default.jpg', 'Automatiques et SystÃ¨mes embarquÃ©s', 'Etudiant');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `lu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `id_expediteur`, `id_destinataire`, `message`, `lu`) VALUES
(3, 1, 4, 'Coucou tooi :D!', 1),
(4, 4, 1, 't\'as quoi', 1),
(5, 6, 1, 'grosse merde', 1),
(7, 1, 6, 'cocuou olivier', 0),
(9, 1, 1, 'prout', 0),
(10, 14, 1, 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `recuperation`
--

CREATE TABLE `recuperation` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `confirme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `recuperation`
--

INSERT INTO `recuperation` (`id`, `mail`, `code`, `confirme`) VALUES
(1, 'antoine.benard@uha.fr', 42866752, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recuperation`
--
ALTER TABLE `recuperation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `recuperation`
--
ALTER TABLE `recuperation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
