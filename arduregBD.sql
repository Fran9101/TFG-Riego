-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ardureg
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ardureg
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ardureg` DEFAULT CHARACTER SET utf8 ;
USE `ardureg` ;

-- -----------------------------------------------------
-- Table `ardureg`.`Arduino`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ardureg`.`Arduino` (
  `IDArduino` VARCHAR(1) NOT NULL,
  `Zona` VARCHAR(30) NULL,
  PRIMARY KEY (`IDArduino`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ardureg`.`Programacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ardureg`.`Programacion` (
  `IDProg` INT NOT NULL,
  `Hora_ini` VARCHAR(8) NOT NULL,
  `Hora_fin` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`IDProg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ardureg`.`Arduino_Programacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ardureg`.`Arduino_Programacion` (
  `Arduino_IDArduino` VARCHAR(1) NOT NULL,
  `Programacion_IDProg` INT NOT NULL,
  PRIMARY KEY (`Arduino_IDArduino`, `Programacion_IDProg`),
  INDEX `fk_Arduino_has_Programacion_Programacion1_idx` (`Programacion_IDProg` ASC),
  INDEX `fk_Arduino_has_Programacion_Arduino_idx` (`Arduino_IDArduino` ASC),
  CONSTRAINT `fk_Arduino_has_Programacion_Arduino`
    FOREIGN KEY (`Arduino_IDArduino`)
    REFERENCES `ardureg`.`Arduino` (`IDArduino`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Arduino_has_Programacion_Programacion1`
    FOREIGN KEY (`Programacion_IDProg`)
    REFERENCES `ardureg`.`Programacion` (`IDProg`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ardureg`.`Estadisticas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ardureg`.`Estadisticas` (
  `IDEstadistica` INT NOT NULL AUTO_INCREMENT,
  `Fecha` DATETIME NOT NULL,
  `Temperatura` FLOAT NOT NULL,
  `Hum_Aire` FLOAT NOT NULL,
  `Litros` FLOAT NOT NULL,
  `Arduino_IDArduino` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`IDEstadistica`, `Arduino_IDArduino`),
  INDEX `fk_Estadisticas_Arduino1_idx` (`Arduino_IDArduino` ASC),
  CONSTRAINT `fk_Estadisticas_Arduino1`
    FOREIGN KEY (`Arduino_IDArduino`)
    REFERENCES `ardureg`.`Arduino` (`IDArduino`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ardureg`.`Lluvia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ardureg`.`Lluvia` (
  `IDLluvia` INT NOT NULL AUTO_INCREMENT,
  `Fecha` DATE NOT NULL,
  `Arduino_IDArduino` VARCHAR(1) NOT NULL,
  PRIMARY KEY (`IDLluvia`, `Arduino_IDArduino`),
  INDEX `fk_Lluvia_Arduino1_idx` (`Arduino_IDArduino` ASC),
  CONSTRAINT `fk_Lluvia_Arduino1`
    FOREIGN KEY (`Arduino_IDArduino`)
    REFERENCES `ardureg`.`Arduino` (`IDArduino`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
