-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 04 fév. 2025 à 07:04
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionnaire-de-menus`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Entrée'),
(2, 'Plat principal'),
(3, 'Dessert');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `nom_menu` varchar(200) NOT NULL,
  `id_plat_1` int NOT NULL,
  `id_plat_2` int NOT NULL,
  `id_plat_3` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `description_menu` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prix_menu` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_creation_menu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id_menu`, `nom_menu`, `id_plat_1`, `id_plat_2`, `id_plat_3`, `id_utilisateur`, `description_menu`, `prix_menu`, `date_creation_menu`) VALUES
(2, 'Second menu', 13, 14, 15, 0, 'Miam', '48', '2025-01-31 17:58:03'),
(3, 'Mon menu', 15, 15, 15, 3, 'test', '69', '2025-01-31 18:29:19');

-- --------------------------------------------------------

--
-- Structure de la table `plats`
--

DROP TABLE IF EXISTS `plats`;
CREATE TABLE IF NOT EXISTS `plats` (
  `id_plat` int NOT NULL AUTO_INCREMENT,
  `nom_plat` varchar(128) NOT NULL,
  `id_categorie` int NOT NULL,
  `prix_plat` varchar(10) NOT NULL,
  `image_plat` varchar(128) NOT NULL COMMENT 'Nom du fichier image pour compléter le lien',
  `ingredient_1` varchar(128) NOT NULL,
  `ingredient_2` varchar(128) NOT NULL,
  `ingredient_3` varchar(128) NOT NULL,
  PRIMARY KEY (`id_plat`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`id_plat`, `nom_plat`, `id_categorie`, `prix_plat`, `image_plat`, `ingredient_1`, `ingredient_2`, `ingredient_3`) VALUES
(13, 'Première entrée', 1, '5', 'placeholder.jpg', 'Tomates', 'Oeuf', ''),
(14, 'Plat principal 2', 2, '8', 'placeholder.jpg', 'Pommes de terre', 'Crème fraiche', 'Champignons'),
(15, 'Banana split', 1, '4', 'placeholder.jpg', 'Crème glacée à la vanille', 'Banane', 'Nappage chocolat');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(24) NOT NULL,
  `mot_de_passe` varchar(128) NOT NULL,
  `droits_utilisateur` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `mot_de_passe`, `droits_utilisateur`) VALUES
(2, 'Phaeryl', '$2y$10$O8QcD92TViFUcBCfMSyFjuVrdYkp9sc0c1hybe9WZJz3EQrGpYfSC', 1),
(3, 'Phaeryl98', '$2y$10$jvH2wMLatm6hJs1jw6P4weUqZ7h0QDUt9XRmq4..OUudwcvJ5iWou', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
