-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 22 mars 2025 à 14:29
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
-- Base de données : `gsb`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `auteur` int NOT NULL,
  `date_publication` date NOT NULL,
  PRIMARY KEY (`id_article`),
  KEY `auteur` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `titre`, `contenu`, `image`, `auteur`, `date_publication`) VALUES
(1, 'Les risques liés aux médicaments périmés : ce que vous devez savoir', 'Les médicaments périmés, souvent oubliés au fond des armoires, peuvent sembler inoffensifs. Pourtant, leur utilisation présente des risques pour la santé. En tant que pharmacien, je tiens à vous sensibiliser sur ce sujet important.\r\n\r\nPourquoi la date de péremption est-elle essentielle ?\r\nLa date de péremption inscrite sur l’emballage d’un médicament est le garant de son efficacité et de sa sécurité. Elle correspond à la période durant laquelle le fabricant certifie que le produit conserve ses propriétés thérapeutiques dans des conditions de conservation optimales. Une fois cette date dépassée, plusieurs phénomènes peuvent survenir :\r\n\r\nPerte d’efficacité : les principes actifs peuvent se dégrader, rendant le médicament moins performant, voire inefficace.\r\nToxicité potentielle : certains composants peuvent se transformer en substances nocives pour l’organisme. Par exemple, des médicaments comme les antibiotiques ou les collyres présentent des risques accrus après leur péremption.\r\nAltération des excipients : ces substances non actives, nécessaires à la stabilité ou au goût du médicament, peuvent également se détériorer.\r\nFaut-il toujours jeter un médicament périmé ?\r\nIl est fortement déconseillé de consommer un médicament dont la date de péremption est dépassée. Cependant, ne jetez pas vos médicaments à la poubelle ou dans les toilettes, car cela peut contaminer l’environnement. La meilleure démarche consiste à les rapporter en pharmacie, où ils seront collectés et détruits de manière sécurisée grâce à des filières spécialisées, comme Cyclamed en France.\r\n\r\nComment éviter l’accumulation de médicaments périmés ?\r\nVoici quelques conseils simples pour gérer votre armoire à pharmacie :\r\n\r\nFaites un tri régulier de vos médicaments, idéalement tous les six mois.\r\nRangez-les dans un endroit sec, à l’abri de la lumière et hors de portée des enfants.\r\nNe conservez que les médicaments nécessaires, en évitant de stocker des traitements inutilisés.\r\nEn résumé, les médicaments périmés ne doivent jamais être pris à la légère. Prenez l’habitude de vérifier les dates et de rapporter les produits obsolètes à votre pharmacien. Cette vigilance contribue non seulement à préserver votre santé, mais aussi à protéger l’environnement.', 'index.php?action=view_image&file=image_674e029d93c1f2.62977237.jpg', 1, '2024-12-02'),
(2, 'Les antibiotiques : usage raisonné pour limiter les résistances', 'Les antibiotiques sont des alliés précieux contre les infections bactériennes, mais leur surconsommation favorise l\'émergence de résistances. Dans cet article, découvrez comment les utiliser efficacement, les erreurs à éviter, et l’importance de suivre les prescriptions médicales à la lettre.', 'index.php?action=view_image&file=image_674e1ddcd29e14.77134873.jpg', 21, '2024-12-02'),
(3, 'Comment bien conserver ses médicaments ?', 'La conservation des médicaments joue un rôle clé dans leur efficacité. Température, humidité, lumière : chaque facteur peut altérer leur qualité. Nous vous expliquons comment les stocker dans des conditions optimales pour préserver leurs propriétés.', 'index.php?action=view_image&file=image_674e1e27601ae0.14488436.jpg', 2, '2024-12-02'),
(4, 'La gestion des ordonnances : conseils pratiques pour les patients', 'Garder une trace de ses ordonnances est essentiel pour éviter les erreurs médicamenteuses. Ce guide propose des astuces pour organiser vos documents médicaux, renouveler vos prescriptions à temps, et simplifier vos interactions avec les pharmacies.', 'index.php?action=view_image&file=image_674e1e832254c1.40964985.jpg', 23, '2024-12-02'),
(6, 'Comprendre les notices de médicaments : décryptage et conseils', 'Les notices de médicaments regorgent d’informations, mais elles peuvent sembler complexes. Cet article vous guide pour comprendre les rubriques principales, identifier les effets secondaires, et savoir quand demander l’avis de votre pharmacien.', 'index.php?action=view_image&file=image_674e1f2dc7e300.56217449.png', 1, '2024-12-02'),
(7, 'Vaccination en pharmacie : un service de proximité', 'De plus en plus de pharmacies proposent des vaccinations, simplifiant l’accès à ce soin préventif. Découvrez comment ce service fonctionne, ses avantages pour les patients, et les vaccins concernés par cette initiative.', 'index.php?action=view_image&file=image_674e1fd6995e72.38628308.jpg', 21, '2024-12-02'),
(8, 'La pharmacie et l’écologie : réduire son empreinte médicamenteuse', 'Que faire des médicaments non utilisés ou périmés ? Cet article explore les initiatives écologiques en pharmacie, comme le recyclage via Cyclamed, et vous donne des conseils pour minimiser l’impact environnemental de vos traitements.', 'index.php?action=view_image&file=image_674e2012207bf8.23313437.jpg', 2, '2024-12-02'),
(9, 'Automédication : quand et comment s\'y fier ?', 'L’automédication peut être pratique pour des maux courants, mais elle comporte des limites et des risques. Découvrez les bonnes pratiques pour traiter les symptômes bénins en toute sécurité, sans nuire à votre santé.', 'index.php?action=view_image&file=image_674e204b19f911.54511557.jpg', 23, '2024-12-02'),
(15, 'L’industrie pharmaceutique', 'L’industrie pharmaceutique est un secteur qui englobe la recherche, la fabrication et la commercialisation de médicaments pour la médecine humaine et vétérinaire. Elle est essentielle pour améliorer la santé et la qualité de vie des individus. Les laboratoires pharmaceutiques et les sociétés de biotechnologie sont les principaux acteurs de ce domaine.\r\n\r\nParmi les acteurs majeurs, on trouve par exemple Hoffmann-La Roche, un laboratoire suisse qui, en 2013, a investi 5,258 milliards de dollars dans la recherche et le développement et a réalisé un chiffre d’affaires de 7,318 milliards de dollars. En 2020, Janssen Cilag, basé à Issy-les-Moulineaux, a enregistré un chiffre d’affaires de 1,126 milliard de dollars.\r\n\r\nLe Journal de Pharmacie Clinique est une revue qui traite de divers sujets liés à la pharmacie clinique, y compris la pharmacotechnie, la production, la logistique, les soins pharmaceutiques, l’enseignement, la formation, la gestion, le management et l’organisation, ainsi que la recherche. Cette revue propose des articles de synthèse, des articles originaux et des retours de congrès.\r\n\r\nLa Revue Pharma, quant à elle, couvre des sujets variés tels que le marché du sevrage tabagique, la livraison de médicaments, le traitement de l’obésité, et les derniers développements en matière de soins pharmaceutiques. Par exemple, elle a récemment couvert le sujet de la pseudoéphédrine qui passe sur ordonnance à partir du 11 décembre.\r\n\r\nEnfin, le site Pharmaceutiques offre des offres d’emploi pour les laboratoires pharmaceutiques, ainsi que des analyses de l’actualité du secteur de la santé et du médicament. Parmi les sujets abordés récemment, on trouve l’intelligence artificielle dans le secteur de la santé, qui est devenue un “game changer” absolu, et l’augmentation des coûts des médicaments en Suisse.', 'index.php?action=view_image&file=image_67861945966315.22492598.jpg', 23, '2025-01-14');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id_document` int NOT NULL AUTO_INCREMENT,
  `nom_document` varchar(250) NOT NULL,
  `auteur` int NOT NULL,
  `date_creation` date NOT NULL,
  `document_pdf` varchar(255) NOT NULL,
  PRIMARY KEY (`id_document`),
  KEY `auteur` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`id_document`, `nom_document`, `auteur`, `date_creation`, `document_pdf`) VALUES
(1, 'Test premier protocole', 1, '2024-11-26', 'index.php?action=view_file&file=document_les_protocoles_de_soins_validite_et_conditions_d_application.pdf'),
(2, 'Test protocole 2', 21, '2024-11-28', 'index.php?action=view_file&file=document_guideline-170-fr.pdf'),
(3, 'Formation jeune', 21, '2024-11-29', 'index.php?action=view_file&file=document_6749c60434d953.43889300.pdf'),
(10, 'Protocole Soin intensif', 1, '2024-12-01', 'index.php?action=view_file&file=document_674c3df6a664b3.42717634.pdf'),
(14, 'Accueil pharmaceutique des patients sans ordonnance', 21, '2025-01-14', 'index.php?action=view_file&file=document_678613bac61d09.53261031.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id_event` int NOT NULL AUTO_INCREMENT,
  `titre_event` varchar(255) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `description` text NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_event`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id_event`, `titre_event`, `date_start`, `date_end`, `description`, `lieu`, `user_id`) VALUES
(1, 'Séance de Vaccination Gratuite contre la Grippe', '2024-12-15 09:00:00', '2024-12-15 23:59:30', 'Rejoignez-nous pour une séance de vaccination gratuite contre la grippe. La vaccination est disponible pour tous les adultes et enfants âgés de 6 mois et plus. Ne manquez pas cette occasion de protéger votre santé et celle de vos proches pendant la saison hivernale.', 'Paris', 1),
(5, 'Congrès International de Pharmacie Clinique', '2025-05-16 09:00:00', '2025-05-18 17:00:00', 'Ce congrès annuel regroupe des pharmaciens, chercheurs et experts de la santé pour discuter des avancées en pharmacie clinique, des thérapies innovantes et de la gestion des soins aux patients. Des ateliers interactifs et des conférences sont prévus.', 'Centre de Congrès, Lyon, France', 2),
(6, 'Salon de l\'Innovation en Pharmacie', '2025-06-11 09:00:00', '2025-06-11 18:00:00', 'Un salon professionnel mettant en avant les dernières innovations technologiques et logistiques dans le domaine pharmaceutique. Une occasion unique d\'explorer des solutions numériques et d&#039;échanger avec des fournisseurs.', 'Parc des Expositions, Paris, France', 21),
(8, 'Séminaire sur la Gestion des Déchets Médicaux', '2024-12-29 09:30:00', '2024-12-29 18:00:00', 'Une session de sensibilisation et d\'information sur les bonnes pratiques pour la gestion des déchets médicaux, en partenariat avec des associations de santé publique.', 'Université de Pharmacie, Lyon, France', 1),
(9, 'Les nouvelles maladies due au changement climatique', '2025-01-18 14:00:00', '2025-01-18 18:30:00', 'Découvrez les nouvelles maladies dues au changement climatique lors d\'une conférence de Mélanie Octova.', 'Lyon', 2),
(12, 'Salon pharmaceutique et cosmétique', '2025-04-12 09:00:00', '2025-01-19 17:30:00', 'Venez découvrir le monde pharmaceutique et ses cosmétique.', 'Vienne', 21),
(15, 'Atelier de Préparation Magistrale Avancée', '2025-04-26 09:30:00', '2025-04-26 18:30:00', 'Une formation pratique d\'une journée sur les techniques avancées de préparation magistrale et les réglementations en vigueur. Idéal pour les pharmaciens souhaitant perfectionner leurs compétences.', 'Institut de Formation Pharmaceutique, Bordeaux, France', 21);

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id_forum` int NOT NULL AUTO_INCREMENT,
  `titre_forum` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_forum`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`id_forum`, `titre_forum`, `user_id`, `date_creation`) VALUES
(4, 'All', 21, '2024-12-08'),
(5, 'Discussion juste Victor', 21, '2024-12-08'),
(11, 'Test', 23, '2024-12-17');

-- --------------------------------------------------------

--
-- Structure de la table `forum_permission`
--

DROP TABLE IF EXISTS `forum_permission`;
CREATE TABLE IF NOT EXISTS `forum_permission` (
  `id_forumpermission` int NOT NULL AUTO_INCREMENT,
  `forum_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  PRIMARY KEY (`id_forumpermission`),
  KEY `forum_id` (`forum_id`,`user_id`,`role_id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `forum_permission`
--

INSERT INTO `forum_permission` (`id_forumpermission`, `forum_id`, `user_id`, `role_id`) VALUES
(1, 4, NULL, 1),
(2, 4, NULL, 2),
(3, 4, NULL, 3),
(13, 11, 22, NULL),
(14, 11, 23, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset`
--

DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE IF NOT EXISTS `password_reset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post_forum`
--

DROP TABLE IF EXISTS `post_forum`;
CREATE TABLE IF NOT EXISTS `post_forum` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `forum_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `forum_id` (`forum_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `post_forum`
--

INSERT INTO `post_forum` (`id_post`, `content`, `forum_id`, `user_id`, `date_creation`) VALUES
(19, 'Bien le bonjour a toi Victor.', 4, 21, '2024-12-08 15:06:58'),
(20, 'Comment allez vous aujourd\'hui la team ?', 4, 21, '2024-12-14 16:00:45'),
(27, 'ça va merci.', 4, 21, '2024-12-17 09:55:43'),
(28, 'Bonjour, je suis le stagiaire', 4, 22, '2024-12-17 10:54:13'),
(30, 'merci', 4, 22, '2024-12-17 11:10:26'),
(31, 'Bienvenue dans l&#039;équipe si tu as des question hésite pas !', 4, 21, '2024-12-17 11:15:53'),
(34, 'Hello la team !', 11, 23, '2024-12-17 11:30:54'),
(35, 'Bine le bonjour jeune', 11, 22, '2024-12-17 11:31:16'),
(36, 'Bien*', 11, 22, '2024-12-17 11:50:29'),
(39, '44', 11, 23, '2024-12-18 11:49:41'),
(40, '\'{}', 4, 21, '2024-12-18 15:14:33'),
(41, '\"<<<<>', 4, 21, '2024-12-18 15:14:41'),
(42, '<script>alert(\"bonjour\")</script>', 4, 21, '2024-12-18 15:15:14'),
(45, 'Ok', 4, 22, '2024-12-19 16:30:41'),
(46, 'Hola', 4, 3, '2025-01-25 12:43:39'),
(47, 'hefuzdhzid', 4, 3, '2025-03-19 10:29:28');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `role` varchar(25) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `password_hash` varchar(256) NOT NULL,
  `role_id` int NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'active',
  `login_attempts` int NOT NULL DEFAULT '0',
  `blocked_until` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `email`, `prenom`, `nom`, `password_hash`, `role_id`, `status`, `login_attempts`, `blocked_until`) VALUES
(1, 'admin@gsb.com', 'admin', 'admin', '$2y$10$gfce0TTd4UyA2o4Yt/w9T.9yy7dMgKQMrYviFEj9/2MdJqKSuRqO2', 1, 'active', 0, NULL),
(2, 'manager@gsb.com', 'Manager', 'GSB', '$2y$10$Jmxj8Ko1ksFXEctoQhaTgejwqzyyJW3XGwSORH8kyJOqd3.7HQvti', 2, 'active', 0, NULL),
(3, 'user@gsb.com', 'User', 'GSB', '$2y$10$n3tGB2XKc/SdXhfEwms02.ZmXqzBoN7N.FWGcAuGLIBw0nEBFZ0zK', 3, 'active', 0, NULL),
(21, 'kenjiogier@gmail.com', 'Kenji', 'Ogier', '$2y$10$sCEM5/Jh2W9O7eaz4mS56ON1p8NgPmkuXN.UtF50O4Ykd6fO.exSS', 1, 'active', 0, NULL),
(22, 'lixeg54497@lofiey.com', 'Jean', 'Gralo', '$2y$10$tRDrboO0gWH792UgKU1YD.Fg4.J4GoGMKlgWDQRobjScqemF7RnQC', 3, 'active', 0, NULL),
(23, 'ogier.kenji@gmail.com', 'Victor', 'Tolap', '$2y$10$j.jl9SbKrITFm7xpqrySf.y4IWf9hjweko3nCJhWYEzIaW7Nh5vDq', 2, 'active', 0, NULL),
(30, 'kenji.ogier@afip-formations.com', 'Kenji test', 'Demo', '$2y$10$ysdhyostyZfdlzL1vRvGg.MjXzOwYeB2WiADQw62VOrrP8fwaeGZq', 3, 'active', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_token`
--

DROP TABLE IF EXISTS `user_token`;
CREATE TABLE IF NOT EXISTS `user_token` (
  `id_token` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expire_at` datetime NOT NULL,
  PRIMARY KEY (`id_token`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`auteur`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`auteur`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `forum_permission`
--
ALTER TABLE `forum_permission`
  ADD CONSTRAINT `forum_permission_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id_forum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_permission_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_permission_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post_forum`
--
ALTER TABLE `post_forum`
  ADD CONSTRAINT `post_forum_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id_forum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_forum_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_token`
--
ALTER TABLE `user_token`
  ADD CONSTRAINT `user_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
