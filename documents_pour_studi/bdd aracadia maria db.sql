-- --------------------------------------------------------
-- Hôte:                         f80b6byii2vwv8cx.chr7pe7iynqr.eu-west-1.rds.amazonaws.com
-- Version du serveur:           10.4.32-MariaDB-log - Source distribution
-- SE du serveur:                Linux
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour arcadia
CREATE DATABASE IF NOT EXISTS `arcadia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `arcadia`;

-- Listage de la structure de la table arcadia. animal
CREATE TABLE IF NOT EXISTS `animal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(32) NOT NULL,
  `race` varchar(32) NOT NULL,
  `image` varchar(255) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `habitat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6AAB231FAFFE2D26` (`habitat_id`),
  CONSTRAINT `FK_6AAB231FAFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table arcadia.animal : ~9 rows (environ)
REPLACE INTO `animal` (`id`, `first_name`, `race`, `image`, `uuid`, `habitat_id`) VALUES
	(1, 'Simba', 'lion', 'pfkmpyujinsfolfxpejz', '663ef9320dac30.21653825', 1),
	(2, 'Lana', 'lion', 'b9zlperbdqheqagpittv', '663ef9d91335a3.45312540', 1),
	(3, 'Claude', 'hyène', 'ywoyn6wbelqokjvjfuea', '663efa013d3d74.01575144', 1),
	(4, 'Roger', 'éléphant', 'ijfpv8xhn9unm2apn2ui', '663efb194106c9.20884668', 1),
	(13, 'Léon', 'tigre', 'pcygc70mzvys2kctkl61', '663efeda7f6038.95647728', 3),
	(15, 'Lucie', 'flament rose', 'x2ikcbobmdlx8epumkfn', '663f0bd2875224.92416536', 2),
	(16, 'Marguerite', 'oie sauvage', 'won8xbdpb7lkqdvieou5', '663f0c16bfbb05.97553541', 2),
	(31, 'Julie', 'girafe', 'aisz5dpw5f1iijcp4d3j', '66434a30720415.28500410', 1);

-- Listage de la structure de la table arcadia. comment_habitat
CREATE TABLE IF NOT EXISTS `comment_habitat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passing_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `habitat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `habitat_id` (`habitat_id`),
  CONSTRAINT `FK_comment_habitat_habitat` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comment_veterinary_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table arcadia.comment_habitat : ~4 rows (environ)
REPLACE INTO `comment_habitat` (`id`, `content`, `passing_date`, `user_id`, `habitat_id`) VALUES
	(9, 'L\'habitat savane manque d\'ombre il faudrait ajouter un peu d\'arbres.', '2024-05-10', 39, 1),
	(10, 'Parfait les lions peuvent se reposer sous les arbres plantés.', '2024-05-11', 39, 1),
	(11, 'L\'habitat est super.', '2024-05-11', 39, 2),
	(12, 'L\'habitat est super.', '2024-05-11', 39, 2);

-- Listage de la structure de la table arcadia. food_consumption
CREATE TABLE IF NOT EXISTS `food_consumption` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `food_given` varchar(50) NOT NULL,
  `food_quantity` int(11) NOT NULL,
  `give_at` datetime NOT NULL,
  `animal_uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `animal_uuid` (`animal_uuid`) USING BTREE,
  CONSTRAINT `food_consumption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table arcadia.food_consumption : ~4 rows (environ)
REPLACE INTO `food_consumption` (`id`, `food_given`, `food_quantity`, `give_at`, `animal_uuid`, `user_id`) VALUES
	(40, 'viande', 500, '2024-05-09 07:30:00', '663ef9320dac30.21653825', 38),
	(41, 'viande', 1000, '2024-05-10 07:32:00', '663ef9320dac30.21653825', 38),
	(42, 'viande', 1500, '2024-05-11 07:35:00', '663ef9320dac30.21653825', 38),
	(43, 'fruits', 3000, '2024-05-11 07:50:00', '663efb194106c9.20884668', 38);

-- Listage de la structure de la table arcadia. habitat
CREATE TABLE IF NOT EXISTS `habitat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table arcadia.habitat : ~3 rows (environ)
REPLACE INTO `habitat` (`id`, `name`, `description`, `image`) VALUES
	(1, 'savane', 'Partez en safari au milieu de la savane sur le territoires les lions et faites la rencontre de notre couple de girafes, des zèbres et autres espèces.', 'fhqv8priq0axeksnxc3n'),
	(2, 'marais', 'Baladez vous au coeur du marais, venez découvrir nos flamants roses et les divers espèces d\'oiseaux.', 'kp9wmdrqc0euyoexvuic'),
	(3, 'jungle', 'Aventurez vous dans la jungle, venez découvrir nos félins, tigres, pumas et jaguar.', 'laj3mpgwkpibgxflowed');

-- Listage de la structure de la table arcadia. review
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_validated` tinyint(1) DEFAULT 0,
  `on_home_page` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table arcadia.review : ~6 rows (environ)
REPLACE INTO `review` (`id`, `user_name`, `content`, `created_at`, `is_validated`, `on_home_page`) VALUES
	(2, 'Dupont', 'Un zoo magnifique, des animaux en pleine forme, un personnel très accueillant.', '2024-04-05 00:00:00', 1, 1),
	(70, 'mauricedu52', 'Agréable journée passé en famille, le personnel du zoo est très gentil', '2024-04-12 13:41:36', 1, 1),
	(71, 'Laurentdu94', 'Un super zoo, magnifique, j\'ai adoré la visite guidée.', '2024-04-12 13:42:23', 1, 1),
	(84, 'lulu66', 'Super zoo, la visite guidée est super', '2024-05-11 07:36:11', 1, 0),
	(85, 'momo54', 'Génial!!!', '2024-05-11 07:36:38', 1, 0),
	(86, 'Gregdu54', 'Le meilleur zoo de France!', '2024-05-11 07:37:11', 1, 0);

-- Listage de la structure de la table arcadia. review_veterinary
CREATE TABLE IF NOT EXISTS `review_veterinary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `health_status` varchar(50) NOT NULL,
  `food` varchar(50) NOT NULL,
  `food_quantity` int(11) NOT NULL,
  `passing_date` date NOT NULL,
  `health_status_details` longtext DEFAULT NULL,
  `animal_uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `animal_uuid` (`animal_uuid`) USING BTREE,
  CONSTRAINT `FK_review_veterinary_sf_arcadia.user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Listage des données de la table arcadia.review_veterinary : ~4 rows (environ)
REPLACE INTO `review_veterinary` (`id`, `health_status`, `food`, `food_quantity`, `passing_date`, `health_status_details`, `animal_uuid`, `user_id`) VALUES
	(48, 'Moyen', 'vainde', 1000, '2024-05-07', 'Simba est blessé à la pate, il faut surveiller...', '663ef9320dac30.21653825', 39),
	(49, 'Bon', 'viande', 500, '2024-05-11', 'Simba se porte beaucoup mieux.', '663ef9320dac30.21653825', 39),
	(50, 'Bon', 'fruits', 3000, '2024-05-11', 'Roger se porte très bien.', '663efb194106c9.20884668', 39),
	(51, 'Bon', 'viande', 500, '2024-05-11', '', '663ef9320dac30.21653825', 39);

-- Listage de la structure de la table arcadia. service
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table arcadia.service : ~3 rows (environ)
REPLACE INTO `service` (`id`, `title`, `description`, `user_id`) VALUES
	(6, 'Restauration', 'Vous pourrez déguster dans notre restaurant: burgers, salades et pizzas. Des tables de pique-nique sont également mis à disposition.', 36),
	(7, 'Visite guidée gratuite', 'Vous visiterez les différents habitats avec nos guides passionnés. Vous deviendrez incollables sur vos animaux préférés.', 36),
	(9, 'Petit-train', 'Embarquez à bord de notre petit train, pour une visite sans effort. Vous explorerez le parc d’une autre façon.', 38);

-- Listage de la structure de la table arcadia. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table arcadia.user : ~3 rows (environ)
REPLACE INTO `user` (`id`, `email`, `password`, `first_name`, `last_name`, `role`) VALUES
	(36, 'jose@mail.com', '$2y$10$tEh7n0WKfqp3chZDi3qCeu5YA.EeWF0SFQSq636CoR001qTB4hiy.', 'Dupont', 'José', 'admin'),
	(38, 'jean@mail.com', '$2y$10$GAvQ0WfkWVPYqYrnIWvBc.YyzBNLByCeGw1H4L57Mk/.z8Lt3Vu2G', 'Dupont', 'Jean', 'employee'),
	(39, 'john@mail.com', '$2y$10$/k70YROsjZF0j65X9aPlwu1QNrmnD8oP9Nks/kuBa6jnOTru0RO.u', 'Doe', 'John', 'veterinary');

-- Listage de la structure de la table arcadia. zoo
CREATE TABLE IF NOT EXISTS `zoo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedules` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table arcadia.zoo : ~0 rows (environ)
REPLACE INTO `zoo` (`id`, `schedules`) VALUES
	(1, 'Ouvert du Mardi au Dimanche de 9h à 19h');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
