CREATE DATABASE IF NOT EXISTS baianitos ;
USE baianitos;

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(22) DEFAULT NULL,
  `post` varchar(4096) DEFAULT NULL,
  PRIMARY KEY (`id`)
)