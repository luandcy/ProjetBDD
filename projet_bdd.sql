-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 07 jan. 2023 à 01:11
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `artistes`
--

CREATE TABLE `artistes` (
  `IdArtiste` int(11) NOT NULL,
  `NomArtiste` varchar(50) NOT NULL,
  `TexteArtiste` text NOT NULL,
  `NoteArtiste` int(11) NOT NULL,
  `DatePublicationArtiste` date NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdGenre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artistes`
--

INSERT INTO `artistes` (`IdArtiste`, `NomArtiste`, `TexteArtiste`, `NoteArtiste`, `DatePublicationArtiste`, `IdUser`, `IdGenre`) VALUES
(1, 'Michael Jackson', 'Reconnu comme l’artiste le plus titré de tous les temps, il est une figure principale de l\'histoire de l\'industrie du spectacle et l\'une des icônes culturelles occidentales majeures du xxe siècle.', 4, '2019-01-16', 23, 1),
(2, 'Travis Scott', 'Un rappeur, chanteur, producteur, musicien, acteur, mannequin et réalisateur américain. Il a aussi collaboré avec beaucoup de grandes marques. ', 3, '2020-12-02', 22, 5),
(3, 'Bob Marley', 'Il rencontre de son vivant un succès mondial, et reste à ce jour le musicien le plus connu du reggae, tout en étant considéré comme celui qui a permis à la musique jamaïcaine et au mouvement rastafari de connaître une audience planétaire.', 3, '2016-12-15', 21, 6),
(4, 'Rihanna', 'Rihanna est l\'artiste qui compte le plus grand nombre de certifications de singles. Elle est aussi la première artiste au monde à franchir le cap de 100 millions de ventes numériques aux États-Unis2.', 4, '2010-12-14', 24, 2);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `IdAvis` int(11) NOT NULL,
  `TexteAvis` text NOT NULL,
  `DateAvis` date NOT NULL,
  `NoteAvis` int(11) NOT NULL,
  `IdUtilisateur` int(11) NOT NULL,
  `IdArtiste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`IdAvis`, `TexteAvis`, `DateAvis`, `NoteAvis`, `IdUtilisateur`, `IdArtiste`) VALUES
(1, 'Certe pour les fans c’est dur d’accepter que son idole soit parti .. j’aimerais y croire aussi mais malheureusement ce n’est pas le cas il est bien parti. ', '2023-01-03', 2, 22, 1),
(2, 'Her music always makes me feel good! ', '2021-12-15', 4, 23, 4),
(3, 'Kendrick’s verse is mad underrated !!! ', '2017-12-14', 3, 21, 2);

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `IdGenre` int(11) NOT NULL,
  `NomGenre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`IdGenre`, `NomGenre`) VALUES
(1, 'POP'),
(2, 'R and B'),
(3, 'ROCK and ROLL'),
(4, 'JAZZ'),
(5, 'RAP'),
(6, 'REGGAE');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `IdImage` int(11) NOT NULL,
  `NomImage` varchar(60) NOT NULL,
  `IdArtiste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`IdImage`, `NomImage`, `IdArtiste`) VALUES
(1, 'BobMarley.jpg', 3),
(2, 'MichaelJackson.jpg', 1),
(3, 'Rihanna.png', 4),
(4, 'TravisScott.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `IdUser` int(11) NOT NULL,
  `Pseudo` varchar(50) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `Avatar` varchar(50) NOT NULL,
  `Administrateur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`IdUser`, `Pseudo`, `Password`, `Mail`, `Avatar`, `Administrateur`) VALUES
(21, 'RNath', 'Toto_mdp', 'RN@gmail.fr', '', 0),
(22, 'HU', 'Baap', 'HU.R@gmail.fr', '', 0),
(23, 'Nathanael', 'mdp_nth', 'nath.Ra@gmail.fr', '', 1),
(24, 'Luan', 'mdp_luan', 'luan.De@gmail.fr', '', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artistes`
--
ALTER TABLE `artistes`
  ADD PRIMARY KEY (`IdArtiste`),
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdGenre` (`IdGenre`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`IdAvis`),
  ADD KEY `IdUtilisateur` (`IdUtilisateur`),
  ADD KEY `IdArtiste` (`IdArtiste`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`IdGenre`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`IdImage`),
  ADD KEY `IdArtiste` (`IdArtiste`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artistes`
--
ALTER TABLE `artistes`
  MODIFY `IdArtiste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `IdAvis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `IdGenre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `IdImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `artistes`
--
ALTER TABLE `artistes`
  ADD CONSTRAINT `artistes_ibfk_1` FOREIGN KEY (`IdGenre`) REFERENCES `genres` (`IdGenre`),
  ADD CONSTRAINT `artistes_ibfk_2` FOREIGN KEY (`IdUser`) REFERENCES `utilisateurs` (`IdUser`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`IdArtiste`) REFERENCES `artistes` (`IdArtiste`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`IdArtiste`) REFERENCES `artistes` (`IdArtiste`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
