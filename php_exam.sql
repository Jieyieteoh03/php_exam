-- Adminer 4.8.0 MySQL 5.5.5-10.5.17-MariaDB-1:10.5.17+maria~ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `questions` (`id`, `question`, `answer`) VALUES
(1,	'Question 1',	'A'),
(2,	'Question 2',	'B'),
(3,	'Question 3',	'D'),
(4,	'Question 4',	'D'),
(6,	'12345678',	'C');

DROP TABLE IF EXISTS `results`;
CREATE TABLE `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `results_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `results_ibfk_4` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `results` (`id`, `user_id`, `question_id`, `answer`) VALUES
(1,	3,	1,	'C'),
(2,	3,	2,	'C'),
(3,	3,	3,	'C'),
(4,	3,	4,	'C'),
(5,	2,	1,	'C'),
(6,	2,	2,	'C'),
(7,	2,	3,	'C'),
(8,	2,	4,	'C'),
(9,	7,	1,	'B'),
(10,	7,	2,	'B'),
(11,	7,	3,	'C'),
(12,	7,	4,	'C'),
(13,	7,	6,	'B'),
(14,	3,	6,	'C');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1,	'John',	'john@gmail.com',	'$2y$10$93IMWJGeCPR.KDh7bJIbGOsIa5NUr1llrWGCsdhJqKlJuYgTu3dja',	'user',	'2023-06-08 09:40:26'),
(2,	'Jane',	'jane@gmail.com',	'$2y$10$thgHB81jD.crXeFANytoQ.EfD2XB3ZPZ1OqVMrDH32GERkPsmNYPG',	'user',	'2023-05-21 05:55:24'),
(3,	'Jack',	'jack@gmail.com',	'$2y$10$eTI4Z6DsUaMbIvsG/rPL0ePbuJSR.6vDvoqkWxvESr15NXG.F.nAK',	'admin',	'2023-06-27 02:11:07'),
(6,	'Teoh Jie Yie',	'pugcuteness13@gmail.com',	'$2y$10$GyxCd8xY2hRpkabY98uxRePDsebX7Ve88LWjEsXfKizkMTo7WX3KG',	'user',	'2023-06-27 02:50:40'),
(7,	'contact_form',	'jieyie23t@forwardschool.edu.my',	'$2y$10$Zd8P3t6lK2q4bm0cg1FJlOulxZbpr87P3pzN3dndqgbbILB/1OINy',	'user',	'2023-06-27 03:36:04');

-- 2023-06-27 04:01:44
