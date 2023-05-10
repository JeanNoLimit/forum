-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum_jn
CREATE DATABASE IF NOT EXISTS `forum_jn` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_jn`;

-- Listage de la structure de table forum_jn. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_jn.category : ~4 rows (environ)
INSERT INTO `category` (`id_category`, `categoryName`) VALUES
	(12, 'Catégorie1'),
	(13, 'sport'),
	(14, 'cuisine'),
	(15, 'Cinéma');

-- Listage de la structure de table forum_jn. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text NOT NULL,
  `user_id` int NOT NULL,
  `topic_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`user_id`) USING BTREE,
  KEY `id_topic` (`topic_id`) USING BTREE,
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_jn.post : ~13 rows (environ)
INSERT INTO `post` (`id_post`, `creationDate`, `text`, `user_id`, `topic_id`) VALUES
	(62, '2023-05-10 17:30:15', 'post1', 18, 20),
	(63, '2023-05-10 17:33:51', 'Ceci est juste un test', 18, 21),
	(64, '2023-05-10 17:37:43', '-film1&#13;&#10;-film2&#13;&#10;-film3&#13;&#10;-Etc...&#13;&#10;', 19, 22),
	(65, '2023-05-10 17:38:42', 'Mouai...', 19, 23),
	(66, '2023-05-10 17:39:31', 'et mon premier post!', 21, 24),
	(67, '2023-05-10 17:39:52', 'classe!', 21, 23),
	(68, '2023-05-10 17:40:12', 'classe!', 21, 21),
	(69, '2023-05-10 17:40:59', 'https://www.allocine.fr/film/fichefilm_gen_cfilm=111200.html', 21, 25),
	(70, '2023-05-10 17:41:48', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet justo porta, sodales ligula at, imperdiet tellus. Aenean vitae porta arcu. Ut faucibus, augue ac vulputate aliquam, turpis nisl semper ante, at dignissim odio justo a augue. Phasellus sed erat rutrum, ultricies ligula ut, efficitur tortor. In non elementum risus, lacinia placerat ex. Donec elementum, massa ut euismod tristique, est dolor mollis lectus, id eleifend ante tortor sit amet nibh. Nullam tempor, ligula eget varius tempor, ante ante ornare nunc, in blandit odio nisi sagittis enim. Donec consequat nunc eu tellus fringilla bibendum. Etiam vel metus sed elit ornare pharetra. Quisque viverra in libero at efficitur. Quisque in risus in dolor bibendum sodales. Vestibulum vitae imperdiet tellus, a ultricies sapien. Etiam rutrum velit vel lectus elementum, quis viverra leo mollis. Fusce tellus leo, ultricies et gravida vel, vestibulum a ligula. Duis nunc erat, lacinia sed eleifend sed, varius commodo elit.&#13;&#10;&#13;&#10;Etiam arcu est, faucibus id nunc nec, venenatis tempus ipsum. Integer posuere libero dolor, ac interdum purus aliquam consequat. Vestibulum in risus egestas, elementum erat id, sollicitudin quam. Vivamus a aliquam augue, vitae consectetur magna. Morbi faucibus dolor ac erat sodales egestas. Nam sagittis posuere euismod. Proin et euismod augue. Aenean eu tortor et nisl aliquet cursus ut ac mi. Quisque in felis pharetra turpis ornare pellentesque eget egestas augue. Nulla nec quam ut nisl viverra ornare eu in nunc.&#13;&#10;&#13;&#10;Etiam sem ex, commodo id mollis id, iaculis vitae diam. Vestibulum rutrum mollis elit, nec feugiat lacus placerat vel. Nulla nec massa eu magna lacinia tincidunt. Aliquam et vestibulum quam, eu efficitur orci. Nulla volutpat, massa eu commodo porttitor, augue ante fringilla elit, ultrices fermentum mauris turpis id arcu. In hac habitasse platea dictumst. Curabitur quis ante pulvinar, gravida sapien vel, semper leo. Aliquam a leo faucibus nisi ultrices consectetur. Curabitur lobortis dapibus iaculis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;&#13;&#10;&#13;&#10;Aliquam egestas nunc nec felis porttitor commodo. Nunc vehicula sem elit, ac dictum velit tempus eget. Aenean sodales vel sem vitae lacinia. Fusce diam est, molestie non mattis sed, elementum in dolor. Integer et tellus dignissim, dignissim ante placerat, pellentesque tortor. Curabitur turpis odio, tincidunt ut volutpat congue, venenatis vel est. Nulla id felis tincidunt, ornare justo non, imperdiet massa. Sed ut neque ut magna viverra posuere id ac diam. Vivamus tincidunt ipsum nec pulvinar pellentesque. Nullam nec efficitur purus. Suspendisse eu hendrerit nisl. Integer id laoreet mauris. Donec quis eleifend dolor, sed bibendum nulla. ', 21, 25),
	(71, '2023-05-10 17:44:53', 'Les pâtes au beurre :&#13;&#10;1 - Faire cuire des pâtes&#13;&#10;2 - Rajouter du beurre', 21, 26),
	(72, '2023-05-10 17:45:34', 'vous avez oublié le sel...', 20, 26),
	(73, '2023-05-10 17:47:32', ' Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec eu sagittis ante, eget ornare dolor. Curabitur non lorem eleifend risus tincidunt facilisis in id nulla. Vestibulum at sagittis ligula, quis imperdiet tortor. Nulla facilisi. Mauris semper consequat mauris at auctor. Nulla et pellentesque leo. Morbi tincidunt viverra vulputate. Nullam dolor lacus, mollis at consectetur bibendum, tincidunt ac eros. Quisque semper porttitor ex. Vestibulum mi tortor, euismod et quam et, accumsan feugiat dolor. Vivamus sit amet venenatis ipsum. Ut non nisl venenatis, pellentesque augue et, commodo eros.&#13;&#10;&#13;&#10;Nulla vehicula, ante quis tempus rutrum, quam ligula aliquet ligula, pellentesque porta tortor neque eu tortor. Quisque enim risus, euismod iaculis ullamcorper et, posuere at purus. Donec elementum sem nibh, vel tempor tortor viverra sed. Praesent sit amet orci congue, egestas arcu dapibus, posuere diam. Donec aliquam dictum ex bibendum consectetur. In consequat eros eu blandit viverra. Vestibulum condimentum enim libero, ac ultrices enim vestibulum in. Ut in augue maximus, congue eros non, suscipit velit. Aliquam consectetur libero sed libero venenatis, et blandit turpis consectetur. Vivamus ut nunc quis odio ullamcorper dapibus id sit amet ex. Sed vehicula tellus non nisi sodales, a fermentum est fringilla. Sed porttitor purus ligula, in vehicula ante ullamcorper at. ', 20, 25),
	(74, '2023-05-10 17:47:51', 'cool!', 20, 24),
	(75, '2023-05-10 17:47:55', 'cool!', 20, 24),
	(76, '2023-05-10 17:47:59', 'cool!', 20, 24),
	(77, '2023-05-10 17:48:05', 'cool!', 20, 24);

-- Listage de la structure de table forum_jn. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed` tinyint NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `id_user` (`user_id`) USING BTREE,
  KEY `id_category` (`category_id`) USING BTREE,
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_jn.topic : ~4 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `closed`, `user_id`, `category_id`) VALUES
	(20, 'Sujet1', '2023-05-10 17:30:15', 0, 18, 12),
	(21, 'Basket', '2023-05-10 17:33:51', 0, 18, 13),
	(22, 'Top 10', '2023-05-10 17:37:43', 0, 19, 15),
	(23, 'foot', '2023-05-10 17:38:42', 0, 19, 13),
	(24, 'C&#39;est mon premier topic!', '2023-05-10 17:39:31', 0, 21, 12),
	(25, 'Le film le plus classe du monde!', '2023-05-10 17:40:59', 0, 21, 15),
	(26, 'Idées recettes', '2023-05-10 17:44:53', 0, 21, 14);

-- Listage de la structure de table forum_jn. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `inscriptionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_jn.user : ~4 rows (environ)
INSERT INTO `user` (`id_user`, `email`, `pseudo`, `password`, `inscriptionDate`, `role`) VALUES
	(18, 'admin@gmail.com', 'admin', '$2y$10$sM2d.XdqrTERPZovsbd8DuEQEOoMA/EKZN1uOgs/HpRxYINUYtU3G', '2023-05-10 17:18:54', 'ROLE_ADMIN'),
	(19, 'moderateur@gmail.com', 'moderateur', '$2y$10$dUlMMzd37nsCYWZkVVP8LOVRfAt3fUpSOu/NohJJ/MuVujIlgOaJi', '2023-05-10 17:20:04', 'MODERATOR'),
	(20, 'jean@gmail.com', 'jean', '$2y$10$zvYcASb0wyS5BRfgP9SEQuOsSac0LXwRJxovkQq9ZR4EHso71OemK', '2023-05-10 17:21:03', 'USER'),
	(21, 'abidbol@gmail.com', 'George Abidbol', '$2y$10$U0NXkQngm0HN0g0lvrCioOgfAOJsbuZz.Bg7784oO2ZWARYV8xWN6', '2023-05-10 17:27:38', 'USER');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
