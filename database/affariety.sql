-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
<<<<<<< Updated upstream
-- Généré le : jeu. 04 avr. 2024 à 02:06
=======
-- Généré le : mer. 17 avr. 2024 à 18:01
>>>>>>> Stashed changes
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `affariety`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `nom`, `categorie`, `prix`) VALUES
(1, 'vase', 'meuble', 12),
(2, 'vase', 'meuble', 14),
(3, 'vase', 'meuble', 15);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_c` int(11) NOT NULL,
  `nom_c` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_c`, `nom_c`) VALUES
(52, 'Canapés'),
(54, 'Literie'),
(55, 'Cuisine');

-- --------------------------------------------------------

--
-- Structure de la table `categoriecodepromo`
--

CREATE TABLE `categoriecodepromo` (
  `idCcp` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `valeur` int(11) NOT NULL,
  `limite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `codepromo`
--

CREATE TABLE `codepromo` (
  `idCode` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `idCategorieCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `cmd_client` int(11) NOT NULL,
  `cmd_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `etat`, `cmd_client`, `cmd_date`) VALUES
(96, 'confirme', 76, '2024-02-29 05:11:35'),
(97, 'en cours', 45, '2024-02-29 08:48:47'),
(98, 'en cours', 12, '2024-02-29 16:21:51'),
(99, 'en cours', 54, '2024-03-01 20:44:34'),
(100, 'nullllls', 12, '2024-03-07 08:14:56');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_com` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `contenu` varchar(5000) NOT NULL,
  `date_com` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `id_pub`, `id_client`, `contenu`, `date_com`) VALUES
(13, 95, 109, 'hello from inde', '2024-03-07 14:30:57');

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

CREATE TABLE `depot` (
  `iddepot` int(11) NOT NULL,
  `nomdepot` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`iddepot`, `nomdepot`, `adresse`) VALUES
<<<<<<< Updated upstream
(1, 'aaaaaaa', 'Mestir');
=======
(1, 'aaaaaaa', 'Mestir'),
(3, 'Avignon', 'Tunis'),
(4, 'Avignon', 'Tunis');
>>>>>>> Stashed changes

-- --------------------------------------------------------

--
-- Structure de la table `detailscommande`
--

CREATE TABLE `detailscommande` (
  `id` int(11) NOT NULL,
  `id_com` int(11) NOT NULL,
  `num_article` int(11) NOT NULL,
  `nom_article` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` float NOT NULL,
  `sous_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `detailscommande`
--

INSERT INTO `detailscommande` (`id`, `id_com`, `num_article`, `nom_article`, `quantite`, `prix_unitaire`, `sous_total`) VALUES
(13, 96, 11, 'canape', 4, 200, 800),
(14, 97, 8, 'vase', 3, 120, 360);

-- --------------------------------------------------------

--
-- Structure de la table `discount`
--

CREATE TABLE `discount` (
  `idD` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `codePromoId` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240403004953', '2024-04-03 02:53:27', 3),
('DoctrineMigrations\\Version20240403015040', '2024-04-03 03:52:40', 5);

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

CREATE TABLE `enchere` (
  `enchere_id` int(11) NOT NULL,
  `idclcreree` varchar(255) NOT NULL,
  `date_debut` varchar(255) DEFAULT NULL,
  `heured` varchar(5) NOT NULL,
  `date_fin` varchar(255) DEFAULT NULL,
  `heuref` varchar(5) NOT NULL,
  `montant_initial` varchar(255) DEFAULT NULL,
  `nom_enchere` varchar(255) NOT NULL,
  `montant_final` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `idclenchere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`enchere_id`, `idclcreree`, `date_debut`, `heured`, `date_fin`, `heuref`, `montant_initial`, `nom_enchere`, `montant_final`, `image`, `idclenchere`) VALUES
(963, '', '2024-02-24', '0', '2024-02-24', '', '2000', 'tablau', NULL, 'file:/C:/Users/takwa/Downloads/téléchargé.jpg', 0),
(964, '', '2024-02-25', '0', '2024-02-26', '', '45000', 'table', NULL, 'file:/C:/Users/takwa/Downloads/104bff52225d12c56b269a515aaae6a10fed0de9.jpg', 0),
(965, '111', '2024-02-28', '12:05', '2024-02-28', '12:30', '1400', 'serbise', NULL, 'file:/C:/Users/takwa/Downloads/serbise.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `grosmots`
--

CREATE TABLE `grosmots` (
  `id_GM` int(11) NOT NULL,
  `GrosMots` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int(30) NOT NULL,
<<<<<<< Updated upstream
  `iddepott` int(60) DEFAULT NULL,
  `idclient` int(11) DEFAULT NULL,
=======
  `iddepot` int(60) DEFAULT NULL,
>>>>>>> Stashed changes
  `adresselivraison` varchar(255) NOT NULL,
  `datecommande` datetime NOT NULL DEFAULT current_timestamp(),
  `datelivraison` datetime NOT NULL,
  `statuslivraison` varchar(255) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livraison`
--

<<<<<<< Updated upstream
INSERT INTO `livraison` (`id`, `iddepott`, `idclient`, `adresselivraison`, `datecommande`, `datelivraison`, `statuslivraison`, `latitude`, `longitude`) VALUES
(283, NULL, 111, 'Tounes', '2028-10-01 00:00:00', '2027-07-01 00:00:00', 'qQq', 77, 777),
(286, 1, 114, 'Mestir', '2024-04-03 02:08:17', '2028-01-01 07:07:00', 'asba', 77, 444),
(288, 1, 118, 'Tounes', '2024-04-03 03:36:36', '2024-05-01 00:00:00', 'ARRET', 888, 999),
(289, 1, 109, 'Tounes', '2024-04-03 03:40:50', '2019-01-01 00:00:00', 'aaaa', 33, 33);
=======
INSERT INTO `livraison` (`id`, `iddepot`, `adresselivraison`, `datecommande`, `datelivraison`, `statuslivraison`, `latitude`, `longitude`) VALUES
(300, 1, 'sousse', '2024-04-11 17:17:08', '2024-04-13 17:17:08', 'encours', 777778000000, 78532),
(301, 1, 'sousse', '2024-04-11 17:17:08', '2024-04-13 17:17:08', 'encours', 777778000000, 78532);
>>>>>>> Stashed changes

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `nom_article` varchar(255) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `nom_article`, `prix`) VALUES
(23, 'Canape en velour', 120),
(24, 'Table', 250);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_p` int(11) NOT NULL,
  `id_c` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `nom_p` varchar(300) NOT NULL,
  `description_p` varchar(300) NOT NULL,
  `prix_p` float NOT NULL,
  `image_p` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_p`, `id_c`, `id_client`, `nom_p`, `description_p`, `prix_p`, `image_p`) VALUES
(81, 52, 113, 'Canape en velour', 'Canapé en velour luxueux', 120, 'tn.esprit.affariety.image/1709393165371_salon.jpg'),
(82, 55, 113, 'Table', 'Table ronde 4 places', 250, 'tn.esprit.affariety.image/1709397611362_Table.jpg'),
(83, 54, 111, 'Lit 2 places', 'Lit 2 places en cuir ', 400, 'tn.esprit.affariety.image/1709397799068_Lit.jpg'),
(84, 52, 109, 'Canapé 2 places', 'Canapé comfortable 2 places', 240, 'tn.esprit.affariety.image/1709397974934_Canapé.jpg'),
(85, 52, 113, 'Etagères', 'Etagères en fer noir ', 199.99, 'tn.esprit.affariety.image/1709402749775_étagères.jpg'),
(86, 52, 113, 'Miroir ronde ', 'Miroir ronde bordure ', 330, 'tn.esprit.affariety.image/1709403110437_mirour.jpg'),
(87, 52, 111, 'Salon beige', 'Salon 6 places couleur beige', 1500, 'tn.esprit.affariety.image/1709727368346_salon.jpg'),
(88, 52, 113, 'salon', 'fcfgvhjkl', 300, 'tn.esprit.affariety.image/1709782120034_0F1A0231.jpg'),
(89, 52, 117, 'salon', 'salon comfortable', 240.99, 'tn.esprit.affariety.image/1709821030454_salon.jpg'),
(90, 52, 118, 'Salon velour ', 'Salon violet ', 13000, 'tn.esprit.affariety.image/1710092465167_salon.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id_pub` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `contenu` varchar(1000) NOT NULL,
  `nb_likes` int(11) NOT NULL,
  `nb_dislike` int(11) NOT NULL,
  `date_pub` datetime NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`id_pub`, `id_client`, `contenu`, `nb_likes`, `nb_dislike`, `date_pub`, `photo`) VALUES
(95, 109, 'vggyhj', 0, 0, '2024-03-07 14:22:15', 'C:\\Users\\Lenovo\\IdeaProjects\\Affariety\\src\\main\\resources\\tn\\esprit\\affariety\\click.png'),
(96, 117, 'Bonjour tout le modne', 0, 0, '2024-03-07 15:35:42', 'C:\\Users\\Lenovo\\IdeaProjects\\Affariety\\src\\main\\resources\\tn\\esprit\\affariety\\82250-removebg-preview.png');

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rating`
--

INSERT INTO `rating` (`rating_id`, `user_id`, `product_id`, `rating_value`) VALUES
(7, 117, 81, 5),
(8, 114, 81, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `verificationCode` varchar(300) NOT NULL,
  `role` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_c`);

--
-- Index pour la table `categoriecodepromo`
--
ALTER TABLE `categoriecodepromo`
  ADD PRIMARY KEY (`idCcp`);

--
-- Index pour la table `codepromo`
--
ALTER TABLE `codepromo`
  ADD PRIMARY KEY (`idCode`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `fk_commentaire_id_pub` (`id_pub`),
  ADD KEY `fk_commentaire_user` (`id_client`);

--
-- Index pour la table `depot`
--
ALTER TABLE `depot`
  ADD PRIMARY KEY (`iddepot`);

--
-- Index pour la table `detailscommande`
--
ALTER TABLE `detailscommande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_com` (`id_com`);

--
-- Index pour la table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`idD`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD PRIMARY KEY (`enchere_id`);

--
-- Index pour la table `grosmots`
--
ALTER TABLE `grosmots`
  ADD PRIMARY KEY (`id_GM`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`idclient`),
  ADD KEY `fk_depot` (`iddepott`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `id_c` (`id_c`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id_pub`),
  ADD KEY `fk_publication_user` (`id_client`);

--
-- Index pour la table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_c` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `categoriecodepromo`
--
ALTER TABLE `categoriecodepromo`
  MODIFY `idCcp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `codepromo`
--
ALTER TABLE `codepromo`
  MODIFY `idCode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `depot`
--
ALTER TABLE `depot`
<<<<<<< Updated upstream
  MODIFY `iddepot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
=======
  MODIFY `iddepot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
>>>>>>> Stashed changes

--
-- AUTO_INCREMENT pour la table `detailscommande`
--
ALTER TABLE `detailscommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `discount`
--
ALTER TABLE `discount`
  MODIFY `idD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enchere`
--
ALTER TABLE `enchere`
  MODIFY `enchere_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=966;

--
-- AUTO_INCREMENT pour la table `grosmots`
--
ALTER TABLE `grosmots`
  MODIFY `id_GM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
<<<<<<< Updated upstream
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;
=======
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;
>>>>>>> Stashed changes

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id_pub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
<<<<<<< Updated upstream
  ADD CONSTRAINT `fk_depot` FOREIGN KEY (`iddepott`) REFERENCES `depot` (`iddepot`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`idclient`) REFERENCES `user` (`id`);
=======
  ADD CONSTRAINT `fk_depot` FOREIGN KEY (`iddepot`) REFERENCES `depot` (`iddepot`);
>>>>>>> Stashed changes
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
