-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 août 2023 à 01:55
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
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `tag`, `name`, `slug`) VALUES
(1, 'Campagne', 'campagne', 'campagne'),
(3, 'Chambres', 'chambres', 'chambres'),
(5, 'Bord-de-mer', 'bord de mer', 'borddemer'),
(7, 'Nouveautés', 'nouveautés', 'nouveautes'),
(9, 'Piscines', 'piscines', 'piscines'),
(11, 'Avec-vue', 'avec vue', 'avecvue'),
(13, 'Cabanes-perchées', 'cabanes perchées', 'cabanesperchees'),
(15, 'Bateaux', 'bateaux', 'bateaux'),
(17, 'Luxe', 'luxe', 'luxe'),
(19, 'Tendance', 'tendance', 'tendance'),
(21, 'Dômes', 'dômes', 'domes'),
(23, 'Tiny-houses', 'tiny houses', 'tinyhouse'),
(25, 'Cabanes', 'cabane', 'cabane'),
(27, 'Châteaux', 'châteaux', 'chateaux'),
(29, 'Bord-de-lac', 'bord de lac', 'borddelac'),
(31, 'Grandes-demeures', 'grandes demeures', 'grandesdemeure'),
(33, 'Fermes', 'fermes', 'fermes'),
(35, 'Parcs-nationaux', 'parcs nationaux', 'parcsnationaux'),
(37, 'Lacs', 'lacs', 'lacs'),
(39, 'Camping', 'camping', 'camping'),
(41, 'Sur-l\'eau', 'sur l\'eau', 'surleau'),
(43, 'Villes-emblématiques', 'villes emblématiques', 'villesemblematiques'),
(45, 'Sous-les-tropiques', 'sous les tropiques', 'souslestropiques'),
(47, 'Vignobles', 'vignoble', 'vignoble'),
(49, 'Au-pied-des-pistes', 'Au pied des pistes', 'aupieddespistes'),
(51, 'Îles', 'îles', 'iles'),
(53, 'Patrimoine', 'patrimoine', 'patrimpoine'),
(55, 'Surf', 'surf', 'surf'),
(57, 'Yourtes', 'Yourtes', 'yourtes'),
(58, 'Espaces-de-jeu', 'Espaces de jeu', 'espacesdejeu'),
(59, 'Wow', 'Wow', 'wow'),
(60, 'Design', 'Design', 'design'),
(61, 'Ski', 'Ski', 'ski'),
(62, 'Maisons-troglodytes', 'Maisons troglodytes', 'maisonstroglodytes'),
(63, 'Séjours-déconnectés', 'Séjours déconnectés', 'sejoursdeconnectes'),
(64, 'Chambres-d\'hôtes', 'Chambres d\'hôtes', 'chambresdhotes'),
(65, 'Maisons-organiques', 'Maisons organiques', 'maisonsorganiques'),
(66, 'Granges', 'Granges', 'granges'),
(67, 'Riads', 'Riads', 'riads'),
(68, 'Chalets-tipi', 'Chalets tipi', 'chaletstipi'),
(69, 'Cabanes-de-berger', 'Cabanes de berger', 'cabanesdeberger'),
(70, 'Art-et-créativité', 'Art et créativité', 'artetcreativite'),
(71, 'Maisons-cycladiques', 'maisons cycladiques', 'maisonscycladiques'),
(72, 'Toit-du-monde', 'Toit du monde', 'toitdumonde'),
(73, 'Arctique', 'Arctique', 'arctique'),
(74, 'Logements-adaptés', 'Logements adaptés', 'logementsadaptes'),
(75, 'Caravanes', 'Caravanes', 'caravanes'),
(76, 'Plages', 'Plages', 'plages');

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id_chat` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_rental` int NOT NULL,
  `content` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `send_at` datetime NOT NULL,
  PRIMARY KEY (`id_chat`),
  KEY `USER` (`id_user`) USING BTREE,
  KEY `RENTAL` (`id_rental`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`id_chat`, `id_user`, `id_rental`, `content`, `send_at`) VALUES
(1, 5, 2, 'bonjour je souhaiterais savoir si le bateaux est a réaction et si il va dans l\'espace\r\n\r\nmerci au revoir', '2023-06-06 00:00:00'),
(2, 5, 3, 'bonjour devons nous prévoir les lampes torches ou bien immôler mon petit frère suffira pour éclairer la grotte intégralement ?', '2023-06-06 00:00:00'),
(4, 6, 1, 'bonjour si on accroche tout plein de ballons a la villa elle va s\'envoler comme dans le film la haut ?', '2023-06-06 00:00:00'),
(5, 6, 3, 'bonjour votre grotte est elle assez profonde pour trouver du pétrole si par malheur on y donnais un malencontreux coup de pioche ?', '2023-06-06 00:00:00'),
(6, 4, 1, 'bonjour peut on utiliser les meubles si nous manquons de charbon ou de bûche ?', '2023-06-06 00:00:00'),
(7, 4, 2, 'bonjour quel est la profondeur en mer du lieu ou nous irons ? c\'est pas pour moi c\'est pour un ami', '2023-06-06 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id_newsletter` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_newsletter`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id_newsletter`, `mail`) VALUES
(1, 'orikham@hotmail.fr'),
(2, 'milou@lycos.fr'),
(3, 'bernard@gmail.com'),
(4, 'bernard@gmail.com'),
(5, 'pouah@pouah.fr'),
(6, 'pouah@pouah.fr'),
(7, 'dayz@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

DROP TABLE IF EXISTS `picture`;
CREATE TABLE IF NOT EXISTS `picture` (
  `id_picture` int NOT NULL AUTO_INCREMENT,
  `id_rental` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_picture`),
  KEY `RENTAL` (`id_rental`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cover` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `capacity` int NOT NULL,
  `surface_area` int NOT NULL,
  `address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `latitude` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `longitude` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_rental`),
  KEY `USER` (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rental`
--

INSERT INTO `rental` (`id_rental`, `id_user`, `title`, `content`, `cover`, `capacity`, `surface_area`, `address`, `price`, `latitude`, `longitude`) VALUES
(1, 5, 'villa walesca', 'Découvrez la Villa Walesca, une vieille demeure de 100 ans en bord de mer. Son architecture d\'époque vous transporte dans un autre temps, tandis que les vues panoramiques et les jardins paisibles créent une atmosphère enchanteresse. Profitez de l\'élégance intemporelle, de l\'authenticité préservée et d\'une expérience inoubliable dans ce havre de charme et de tranquillité', 'villawalesca.png', 15, 300, '3 rue du coquillage,\r\n99001 palavasse les flots,\r\nFrance', 300, '', ''),
(2, 6, 'boat karim', 'Offrez-vous une expérience unique en mer avec la location du BoatKarim ! Profitez de nuits magiques, bercé par les vagues, dans un cadre tranquille et magnifique. Réveillez-vous chaque matin avec une vue imprenable sur l\'horizon marin. Réservez dès maintenant et embarquez pour des souvenirs mémorables en mer.', 'boatkarim.png', 22, 500, '2 rue duché kuala,\r\nKuala lumpur,\r\nFrance', 5000, '', ''),
(3, 4, 'les grottes sombre', 'Dormez au cœur de la nature dans notre gîte unique en grotte. Vivez une expérience insolite et magique. Réservez dès maintenant pour des vacances inoubliables loin de tout.......absolument tout', 'grotte.png', 16, 130, '666 impasse du non retour,\r\nsables d\'olonne,\r\nFrance', 666, '', ''),
(4, 9, 'cabane perché', 'Découvrez notre cabane perchée, l\'endroit idéal pour échapper au quotidien ! Perdez vos enfants en toute tranquillité ou amusez-vous à les traquer à vue avec notre fameuse phrase : \"Ha bah c\'était pas un sanglier\". Profitez de la nature, du calme et de l\'aventure dans notre cabane unique en son genre. Réservez dès maintenant pour des moments inoubliables en famille !', 'cabanearbre.jpg', 500, 2000, 'lieu dit: la malchance 00000,\r\nNoWayCity,\r\nNerverland', 999, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `rental_category`
--

DROP TABLE IF EXISTS `rental_category`;
CREATE TABLE IF NOT EXISTS `rental_category` (
  `id_category` int NOT NULL,
  `id_rental` int NOT NULL,
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
  `status` tinyint(1) DEFAULT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `num_guest` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_reservation`),
  KEY `USER` (`id_user`) USING BTREE,
  KEY `RENTAL` (`id_rental`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_user`, `id_rental`, `status`, `checkin_date`, `checkout_date`, `num_guest`, `total_price`, `created_at`) VALUES
(1, 5, 3, NULL, '2023-08-09', '2023-08-20', '1', 7692, '2023-08-10 16:13:15'),
(2, 5, 4, NULL, '2023-08-21', '2023-08-27', '1', 6293, '2023-08-10 16:15:04');

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id_review` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_rental` int NOT NULL,
  `content` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id_review`),
  KEY `USER` (`id_user`) USING BTREE,
  KEY `RENTAL` (`id_rental`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`id_review`, `id_user`, `id_rental`, `content`, `rating`, `created_at`) VALUES
(1, 5, 2, 'le bateaux etais super le paysage magnifique mis a part l\'attaque de pirates qui nous ont honteusement dépouiller le voyage fut agréable.', 3, '2023-06-06'),
(2, 5, 3, 'la bière etait bonne les nains sont sympas mais je sais toujours pas combien il faut de nain pour creuser un tunnel de 28m dans du granit en 2 jours', 3, '2023-06-06'),
(3, 6, 1, 'chouette villa on a pu jouer a chache-cache avec belle maman prevenez nous si vous la retrouvez', 3, '2023-06-06'),
(4, 6, 3, 'plus jamais je reviens !!! je suis tombé sur un troll tres farceur qui voulais me farcir avec des pommes je compte faire une réclamation', 1, '2023-06-06'),
(5, 4, 1, 'séjour tres étrange nous avons entendues des bruits dans la cave sur toute la durée l\'endroit est peux etre hantée faite attention ', 3, '2023-06-06'),
(6, 4, 2, 'le circuit des îles était genial on a pas trouver le one piece mais l\'aventure etait au RDV', 3, '2023-06-06');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `roles` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `firstname`, `lastname`, `mail`, `birthdate`, `password`, `phone`, `content`, `roles`, `avatar`) VALUES
(4, 'dimitri', 'johan', 'orikham@hotmail.fr', '1989-10-21', '$2y$10$kIp0OMWUouEPfpJ.fXStMeeJra.Hj0kvoV6Cb3f6BwNEfHLlNCM5i', '0766683113', 'travailleur de lombre il veille au bon grain sous la direction de LA cheffe parce que tout le monde aime la cheffe', 'roublard', 'profilDimitri.png'),
(5, 'walesca', 'commanderinchief', 'walesca@hotmail.fr', '2023-06-01', '$2y$10$N3.CsYSoJdXjZ/hhLRUo4.3M76kzSP.tL5GkMS2zWOHPhFuLcdYmG', '606060606', 'c\'est la cheffe donc elle fait la cheffe quand elle fait la cheffe', 'cheffe', '87735d9c58c44ceb6763fac9bb909c78.jpg'),
(6, 'Karim', 'desrois', 'toto@toto.fr', '2023-06-29', '$2y$10$UOhZf/0/OOw4UGNfBwPkVutE3MmJ9jM6vwQX9JnGv.7VtISGdIy2C', '606060606', 'il developpa ses faculté d\'observation a un niveau si élever qu\'on appella cette technique le karim des rois technique qui devins sont surnom', 'middle boss', 'profilKarim'),
(9, 'pierre', 'pierre', 'test@test.fr', '1989-10-21', '$2y$10$jQIuAttgMsu8DZsdjQskyeiEl5jbE7J5.S1ndKj1f3ZGc8r2QQtfi', '123456789', NULL, NULL, '167858be706244ec77469989a6a11a28.jpg'),
(27, 'Angeline', 'Gillot', 'angie@hotmail.fr', '2023-02-23', '$2y$10$Wh4UVlNOqznwqOh9zhqUoeolKPkopaAr.Jyctq.uAYQhRdp0hR.za', '', NULL, NULL, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`id_wishlist`, `id_user`, `id_rental`) VALUES
(3, 6, 1),
(4, 6, 3),
(5, 4, 1),
(6, 4, 2),
(18, 5, 3),
(19, 5, 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

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
