-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 07 Juin 2017 à 10:19
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
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `mail`, `motdepasse`, `nom`, `prenom`, `date`, `genre`, `avatar`) VALUES
(1, 'antoine.benard@uha.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'BÃ©nard', 'Antoine', '0000-00-00', '', '1.jpg'),
(2, 'robert@uha.fr', '12e9293ec6b30c7fa8a0926af42807e929c1684f', '', '0', '0000-00-00', '', ''),
(3, 'jean@uha.fr', '51f8b1fa9b424745378826727452997ee2a7c3d7', '', '0', '0000-00-00', '', ''),
(4, 'chloe@uha.fr', '7785db84585b09fc9bc5e7e763fca1095488c446', '', '0', '0000-00-00', '', ''),
(6, 'olivier@uha.fr', '77cccf0d7a72ee0036f6f1a239d5c47ee8799014', '', '0', '0000-00-00', '', ''),
(8, 'olivier.tinh@uha.fr', '77cccf0d7a72ee0036f6f1a239d5c47ee8799014', 'Tinh', 'Olivier', '2017-06-01', 'homme', ''),
(9, 'baptiste.refalo@uha.fr', '1cfd48a9a65a966defdcd720f66cd790094000c4', 'Refalo', 'Baptiste', '2017-04-06', 'homme', ''),
(10, 'michel@uha.fr', '2c7f9fd20fbeb41ce8894ec4653d66fa7f3b6e1a', 'Gros', 'Michel', '2017-02-07', 'homme', 'default.jpg'),
(12, 'nicolas@uha.fr', '418d940643b1975d62234ee01246ad4b58904184', 'Greiner', 'Nicolas', '2017-06-01', 'homme', 'default.jpg');

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
(2, 3, 1, 'Yo c\'est Jean !', 1),
(3, 1, 4, 'Coucou tooi :D!', 1),
(4, 4, 1, 't\'as quoi', 1),
(5, 6, 1, 'grosse merde', 1);

-- --------------------------------------------------------

--
-- Structure de la table `online`
--

CREATE TABLE `online` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `user_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `online`
--

INSERT INTO `online` (`id`, `time`, `user_ip`) VALUES
(52, 1496514307, '127.0.0.1');

--
-- Index pour les tables exportées
--

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
-- Index pour la table `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `online`
--
ALTER TABLE `online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
