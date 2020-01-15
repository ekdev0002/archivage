-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 15 Janvier 2020 à 00:01
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `archivage`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

CREATE TABLE `acteur` (
  `id` bigint(20) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `matricule` text,
  `fonction` text,
  `nationalite` text,
  `situationmatri` text,
  `datenaissance` text,
  `telephone` text,
  `login` text,
  `password` text,
  `id_profil` bigint(20) DEFAULT NULL
) ;

--
-- Contenu de la table `acteur`
--

INSERT INTO `acteur` (`id`, `nom`, `prenom`, `sexe`, `photo`, `matricule`, `fonction`, `nationalite`, `situationmatri`, `datenaissance`, `telephone`, `login`, `password`, `id_profil`) VALUES
(1, 'ZONGO', 'Mathieu', NULL, 'defaut.jpg', 'MAT0001', 'JOURNALISTE', 'BURKINABE', NULL, '10/08/1988', '05863245', 'zongo', '81dc9bdb52d04dc20036dbd8313ed055', 2),
(2, 'MBA', 'Elvis', NULL, 'defaut.jpg', 'MAT002', 'JOURNALISTE', 'GABONAIS', NULL, '01/01/1999', '05454649', 'mba', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(3, 'KONFE', 'Balira', NULL, 'defaut.jpg', 'MAT0022', 'JOURNALISTE', 'BURKINABE', NULL, NULL, '0286325', 'konfe', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(4, 'NAMBILA', 'Serge', NULL, 'defaut.jpg', 'MAT0021', 'JOURNALISTE', 'CONGOLAIS', NULL, NULL, '01756321', 'nambila', '81dc9bdb52d04dc20036dbd8313ed055', 1);

-- --------------------------------------------------------

--
-- Structure de la table `archive`
--

CREATE TABLE `archive` (
  `id` bigint(20) NOT NULL,
  `fichier` text,
  `titre` text,
  `motcle` text,
  `nomfichier` text,
  `nomfichierrel` text,
  `date_publication` text,
  `id_categorie` bigint(20) DEFAULT NULL,
  `id_acteur` bigint(20) DEFAULT NULL
) ;

--
-- Contenu de la table `archive`
--

INSERT INTO `archive` (`id`, `fichier`, `titre`, `motcle`, `nomfichier`, `nomfichierrel`, `date_publication`, `id_categorie`, `id_acteur`) VALUES
(16, 'BD-NoSQL-Part11.pdf', 'nosql1', 'DB', 'BD_NoSQL_Part1.pdf', NULL, '14-01-2020', 1, 1),
(17, 'BD-NoSQL-Part217.pdf', 'nosql2', 'DB', 'BD_NoSQL_Part2.pdf', NULL, '14-01-2020', NULL, 4),
(19, 'Alexandrie7-plaquette18.pdf', 'plaquette', 'plan', 'Alexandrie7-plaquette.pdf', NULL, '14-01-2020', NULL, 1),
(20, 'EDT-M2P-ISI---Semaine-14---du-13-au-18-janvier-20220.pdf', 'EDIT', 'ESMT', 'EDT_M2P-ISI - Semaine 14 - du 13 au 18 janvier 202.pdf', NULL, '14-01-2020', NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` bigint(20) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(1, 'Racine'),
(2, 'Factures'),
(3, 'Contrats'),
(4, 'Manuel'),
(5, 'Document Secret');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `id` bigint(20) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `acteur`
--
ALTER TABLE `acteur`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
