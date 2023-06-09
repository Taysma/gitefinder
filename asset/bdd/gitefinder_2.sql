-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 08 juin 2023 à 13:39
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gitefinder`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id_chat` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_rental` int NOT NULL,
  `content` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `send_at` datetime NOT NULL,
  PRIMARY KEY (`id_chat`),
  KEY `USER` (`id_user`) USING BTREE,
  KEY `RENTAL` (`id_rental`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id_newsletter` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_newsletter`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id_newsletter`, `mail`) VALUES
(1, 'orikham@hotmail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `id_picture` int NOT NULL AUTO_INCREMENT,
  `id_rental` int NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_picture`),
  KEY `RENTAL` (`id_rental`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id_picture`, `id_rental`, `title`) VALUES
(7, 1, 'villawalesca.png'),
(8, 2, 'boatkarim.png'),
(9, 3, 'grotte.png');

-- --------------------------------------------------------

--
-- Structure de la table `rental`
--

DROP TABLE IF EXISTS `rental`;
CREATE TABLE IF NOT EXISTS `rental` (
  `id_rental` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `capacity` int NOT NULL,
  `surface_area` int NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_rental`),
  KEY `USER` (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rental`
--

INSERT INTO `rental` (`id_rental`, `id_user`, `title`, `content`, `capacity`, `surface_area`, `city`, `address`) VALUES
(1, 1, 'villa walesca', 'Découvrez la Villa Walesca, une vieille demeure de 100 ans en bord de mer. Son architecture d\'époque vous transporte dans un autre temps, tandis que les vues panoramiques et les jardins paisibles créent une atmosphère enchanteresse. Profitez de l\'élégance intemporelle, de l\'authenticité préservée et d\'une expérience inoubliable dans ce havre de charme et de tranquillité', 15, 300, '99001 palavasse les flots', '3 rue du coquillage'),
(2, 2, 'boat karim', 'Offrez-vous une expérience unique en mer avec la location du BoatKarim ! Profitez de nuits magiques, bercé par les vagues, dans un cadre tranquille et magnifique. Réveillez-vous chaque matin avec une vue imprenable sur l\'horizon marin. Réservez dès maintenant et embarquez pour des souvenirs mémorables en mer.', 22, 500, 'Kuala lumpur', '2 rue duché kuala'),
(3, 3, 'les grottes sombre', 'Dormez au cœur de la nature dans notre gîte unique en grotte. Vivez une expérience insolite et magique. Réservez dès maintenant pour des vacances inoubliables loin de tout.......absolument tout', 16, 130, 'sables d\'olonne', '666 impasse du non retour');

-- --------------------------------------------------------

--
-- Structure de la table `rental_category`
--

DROP TABLE IF EXISTS `rental_category`;
CREATE TABLE IF NOT EXISTS `rental_category` (
  `id` int NOT NULL,
  `id_category` int NOT NULL,
  `id_rental` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CATEGORY` (`id_category`) USING BTREE,
  KEY `RENTAL` (`id_rental`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_rental` int NOT NULL,
  `available` tinyint(1) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `validation` date NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `USER` (`id_user`) USING BTREE,
  KEY `RENTAL` (`id_rental`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id_review` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_rental` int NOT NULL,
  `content` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id_review`),
  KEY `USER` (`id_user`) USING BTREE,
  KEY `RENTAL` (`id_rental`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `roles` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `firstname`, `lastname`, `mail`, `birthdate`, `password`, `content`, `roles`) VALUES
(1, 'waleska', '', 'walesca@gintefinder.fr', '1900-01-01', 'cheffe', 'c\'est la cheffe donc elle fait la cheffe quand elle fait la cheffe', 'cheffe'),
(2, 'karim', '', 'karim@gintefinder.fr', '1900-02-01', 'frontend', 'il developpa ses faculté d\'observation a un niveau si élever qu\'uon appella cette technique le karim des rois ', 'middle boss'),
(3, 'dimitri', '', 'dimitri@gintefinder.fr', '1900-03-01', '123456789', 'travailleur de lombre il veille au bon grain sous la direction de LA cheffe parce que tout le monde aime la cheffe', 'roublard');

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id_wishlist` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_rental` int NOT NULL,
  PRIMARY KEY (`id_wishlist`),
  KEY `USER` (`id_user`) USING BTREE,
  KEY `RENTAL` (`id_rental`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`id_rental`) REFERENCES `rental` (`id_rental`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`id_rental`) REFERENCES `rental` (`id_rental`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rental_category`
--
ALTER TABLE `rental_category`
  ADD CONSTRAINT `rental_category_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rental_category_ibfk_3` FOREIGN KEY (`id_rental`) REFERENCES `rental` (`id_rental`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_rental`) REFERENCES `rental` (`id_rental`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_rental`) REFERENCES `rental` (`id_rental`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_rental`) REFERENCES `rental` (`id_rental`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
