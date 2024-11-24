-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema videogamestore
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema videogamestore
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `videogamestore` DEFAULT CHARACTER SET utf8 ;
USE `videogamestore` ;

-- -----------------------------------------------------
-- Table `videogamestore`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `videogamestore`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` CHAR(60) NOT NULL,
  `admin` TINYINT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `videogamestore`.`generos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `videogamestore`.`generos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `videogamestore`.`juegos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `videogamestore`.`juegos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `imagen` VARCHAR(200) NOT NULL,
  `plataforma` VARCHAR(45) NOT NULL,
  `disponible` TINYINT NOT NULL,
  `generos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_juegos_generos_idx` (`generos_id` ASC) VISIBLE,
  CONSTRAINT `fk_juegos_generos`
    FOREIGN KEY (`generos_id`)
    REFERENCES `videogamestore`.`generos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `videogamestore`.`alquileres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `videogamestore`.`alquileres` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `f_alquiler` DATE NOT NULL,
  `f_devolucion` DATE NOT NULL,
  `usuarios_id` INT NOT NULL,
  `juegos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_alquileres_usuarios1_idx` (`usuarios_id` ASC) VISIBLE,
  INDEX `fk_alquileres_juegos1_idx` (`juegos_id` ASC) VISIBLE,
  CONSTRAINT `fk_alquileres_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `videogamestore`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_alquileres_juegos1`
    FOREIGN KEY (`juegos_id`)
    REFERENCES `videogamestore`.`juegos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `videogamestore`.`generos`
-- -----------------------------------------------------
START TRANSACTION;
USE `videogamestore`;
INSERT INTO `videogamestore`.`generos` (`id`, `nombre`) VALUES (1, 'Aventura');
INSERT INTO `videogamestore`.`generos` (`id`, `nombre`) VALUES (2, 'Accion');
INSERT INTO `videogamestore`.`generos` (`id`, `nombre`) VALUES (3, 'Terror');
INSERT INTO `videogamestore`.`generos` (`id`, `nombre`) VALUES (4, 'Battle Royale');

COMMIT;

