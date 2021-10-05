-- MySQL Script generated by MySQL Workbench
-- Fri Oct  1 19:29:24 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bdsistsport
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bdsistsport
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bdsistsport` DEFAULT CHARACTER SET utf8 ;
USE `bdsistsport` ;

-- -----------------------------------------------------
-- Table `bdsistsport`.`Categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Categorias` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `condicion` TINYINT NOT NULL,
  PRIMARY KEY (`idCategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistsport`.`Prendas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Prendas` (
  `idPrenda` INT NOT NULL AUTO_INCREMENT,
  `idCategoria` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `talle` VARCHAR(45) NOT NULL,
  `marca` VARCHAR(45) NOT NULL,
  `color` VARCHAR(45) NULL,
  `estado` TINYINT NOT NULL,
  PRIMARY KEY (`idPrenda`),
  
  CONSTRAINT `fk_Prendas_Categorias`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `bdsistsport`.`Categorias` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistsport`.`Personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Personas` (
  `idPersona` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NULL,
  `dni` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPersona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistsport`.`Ingresos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Ingresos` (
  `idIngreso` INT NOT NULL AUTO_INCREMENT,
  `idProveedores` INT NOT NULL,
  `num_comprobante` INT NOT NULL,
  `fecha` DATETIME NOT NULL,
  `estado` TINYINT NOT NULL,
  `idPersona` INT NOT NULL,
  PRIMARY KEY (`idIngreso`),
  
  CONSTRAINT `fk_Ingreso_Personas1`
    FOREIGN KEY (`idPersona`)
    REFERENCES `bdsistsport`.`Personas` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistsport`.`Estados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Estados` (
  `idEstado` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEstado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistsport`.`Metodo_Pagos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Metodo_Pagos` (
  `idMetodo_Pago` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`idMetodo_Pago`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistsport`.`Transacciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Transacciones` (
  `idTransaccion` INT NOT NULL AUTO_INCREMENT,
  `idMetodo_Pago` INT NOT NULL,
  `importe` INT NOT NULL,
  PRIMARY KEY (`idTransaccion`),
 
  CONSTRAINT `fk_Transaccion_Metodo_Pagos1`
    FOREIGN KEY (`idMetodo_Pago`)
    REFERENCES `bdsistsport`.`Metodo_Pagos` (`idMetodo_Pago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistsport`.`Egresos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Egresos` (
  `idEgreso` INT NOT NULL AUTO_INCREMENT,
  `idEstado` INT NOT NULL,
  `idTransaccion` INT NOT NULL,
  `num_comprobante` INT NOT NULL,
  `fecha` DATETIME NULL,
  `total` INT NOT NULL,
  PRIMARY KEY (`idEgreso`),

  CONSTRAINT `fk_Egreso_Estados1`
    FOREIGN KEY (`idEstado`)
    REFERENCES `bdsistsport`.`Estados` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Egreso_Transaccion1`
    FOREIGN KEY (`idTransaccion`)
    REFERENCES `bdsistsport`.`Transacciones` (`idTransaccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistsport`.`Detalle_Ingresos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Detalle_Ingresos` (
  `idDetalle_Ingreso` INT NOT NULL AUTO_INCREMENT,
  `idPrenda` INT NOT NULL,
  `idIngreso` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `precio` DECIMAL(11,2) NOT NULL,
  PRIMARY KEY (`idDetalle_Ingreso`),

  CONSTRAINT `fk_Detalle_Ingresos_Prendas1`
    FOREIGN KEY (`idPrenda`)
    REFERENCES `bdsistsport`.`Prendas` (`idPrenda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Detalle_Ingresos_Ingreso1`
    FOREIGN KEY (`idIngreso`)
    REFERENCES `bdsistsport`.`Ingresos` (`idIngreso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistsport`.`Detalle_Egresos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Detalle_Egresos` (
  `idDetalle_Egreso` INT NOT NULL AUTO_INCREMENT,
  `Egreso_idEgreso` INT NOT NULL,
  `idprenda` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `precio` DECIMAL(11,2) NOT NULL,
  `descuento` DECIMAL(11,2) NOT NULL,
  PRIMARY KEY (`idDetalle_Egreso`),
 
  CONSTRAINT `fk_Detalle_Egreso_Egreso1`
    FOREIGN KEY (`Egreso_idEgreso`)
    REFERENCES `bdsistsport`.`Egresos` (`idEgreso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Detalle_Egreso_Prendas1`
    FOREIGN KEY (`idprenda`)
    REFERENCES `bdsistsport`.`Prendas` (`idPrenda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdsistsport`.`Detalle_Pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdsistsport`.`Detalle_Pedidos` (
  `idDetalle_Pedidos` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idDetalle_Pedidos`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
