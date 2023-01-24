CREATE DATABASE `db`;
USE `db`;
CREATE TABLE `articles` (
    `Id` INT(11) NOT NULL AUTO_INCREMENT,
    `Title` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    `Text` VARCHAR(500) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    `Cover_image` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    `Autor` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    `Create_time` TIMESTAMP NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`Id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=16
;