-- MySQL Script generated by MySQL Workbench
-- 12/18/14 12:25:02
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema rcv_db
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `rcv_db` ;

-- -----------------------------------------------------
-- Schema rcv_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rcv_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `rcv_db` ;

-- -----------------------------------------------------
-- Table `rcv_db`.`claseVehiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`claseVehiculo` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`claseVehiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `claseVehiculo` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`tipoVehiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`tipoVehiculo` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`tipoVehiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipoVehiculo` VARCHAR(60) NOT NULL,
  `claseVehiculo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tipoVehiculo_claseVehiculo_idx` (`claseVehiculo_id` ASC),
  CONSTRAINT `fk_tipoVehiculo_claseVehiculo`
    FOREIGN KEY (`claseVehiculo_id`)
    REFERENCES `rcv_db`.`claseVehiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`numPuesto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`numPuesto` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`numPuesto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numPuesto` VARCHAR(20) NOT NULL,
  `tipoVehiculo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_numPuesto_tipoVehiculo1_idx` (`tipoVehiculo_id` ASC),
  CONSTRAINT `fk_numPuesto_tipoVehiculo1`
    FOREIGN KEY (`tipoVehiculo_id`)
    REFERENCES `rcv_db`.`tipoVehiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`statusCobert`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`statusCobert` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`statusCobert` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `statusCobert` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`cobertura`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`cobertura` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`cobertura` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cobertura` DECIMAL(9,2) NOT NULL,
  `claseVehiculo_id` INT NOT NULL,
  `statusCobert_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cobertura_claseVehiculo1_idx` (`claseVehiculo_id` ASC),
  INDEX `fk_cobertura_statusCobert1_idx` (`statusCobert_id` ASC),
  CONSTRAINT `fk_cobertura_claseVehiculo1`
    FOREIGN KEY (`claseVehiculo_id`)
    REFERENCES `rcv_db`.`claseVehiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cobertura_statusCobert1`
    FOREIGN KEY (`statusCobert_id`)
    REFERENCES `rcv_db`.`statusCobert` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`precio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`precio` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`precio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `precio` INT NOT NULL,
  `numPuesto_id` INT NOT NULL,
  `cobertura_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_precio_numPuesto1_idx` (`numPuesto_id` ASC),
  INDEX `fk_precio_cobertura1_idx` (`cobertura_id` ASC),
  CONSTRAINT `fk_precio_numPuesto1`
    FOREIGN KEY (`numPuesto_id`)
    REFERENCES `rcv_db`.`numPuesto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_precio_cobertura1`
    FOREIGN KEY (`cobertura_id`)
    REFERENCES `rcv_db`.`cobertura` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`tipoTrans`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`tipoTrans` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`tipoTrans` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipoTrans` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`usoVehiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`usoVehiculo` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`usoVehiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usoVehiculo` VARCHAR(45) NOT NULL,
  `claseVehiculo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usoVehiculo_claseVehiculo1_idx` (`claseVehiculo_id` ASC),
  CONSTRAINT `fk_usoVehiculo_claseVehiculo1`
    FOREIGN KEY (`claseVehiculo_id`)
    REFERENCES `rcv_db`.`claseVehiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`statusCont`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`statusCont` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`statusCont` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `statusCont` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`tipoPersona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`tipoPersona` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`tipoPersona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipoPersona` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`estado` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`estado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estado` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`municipio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`municipio` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`municipio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `municipio` VARCHAR(80) NOT NULL,
  `estado_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_municipio_estado1_idx` (`estado_id` ASC),
  CONSTRAINT `fk_municipio_estado1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `rcv_db`.`estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`parroquia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`parroquia` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`parroquia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `parroquia` VARCHAR(80) NOT NULL,
  `municipio_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_parroquia_municipio1_idx` (`municipio_id` ASC),
  CONSTRAINT `fk_parroquia_municipio1`
    FOREIGN KEY (`municipio_id`)
    REFERENCES `rcv_db`.`municipio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`titulares`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`titulares` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`titulares` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dni` VARCHAR(45) NOT NULL,
  `nombres` VARCHAR(60) NOT NULL,
  `apellidos` VARCHAR(60) NOT NULL,
  `direccion` LONGTEXT NOT NULL,
  `tipoPersona_id` INT NOT NULL,
  `parroquia_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_titulares_tipoPersona1_idx` (`tipoPersona_id` ASC),
  INDEX `fk_titulares_parroquia1_idx` (`parroquia_id` ASC),
  CONSTRAINT `fk_titulares_tipoPersona1`
    FOREIGN KEY (`tipoPersona_id`)
    REFERENCES `rcv_db`.`tipoPersona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_titulares_parroquia1`
    FOREIGN KEY (`parroquia_id`)
    REFERENCES `rcv_db`.`parroquia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`agencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`agencias` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`agencias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_ag` VARCHAR(60) NOT NULL,
  `identificador` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`statusFormat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`statusFormat` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`statusFormat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `statusFormat` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`planillas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`planillas` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`planillas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(45) NOT NULL,
  `fecha_reg` DATE NOT NULL,
  `agencias_id` INT NOT NULL,
  `statusFormat_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_planillas_agencias1_idx` (`agencias_id` ASC),
  INDEX `fk_planillas_statusFormat1_idx` (`statusFormat_id` ASC),
  CONSTRAINT `fk_planillas_agencias1`
    FOREIGN KEY (`agencias_id`)
    REFERENCES `rcv_db`.`agencias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_planillas_statusFormat1`
    FOREIGN KEY (`statusFormat_id`)
    REFERENCES `rcv_db`.`statusFormat` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`marca`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`marca` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`marca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `marca` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`modelo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`modelo` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`modelo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `modelo` VARCHAR(100) NOT NULL,
  `marca_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_modelo_marca1_idx` (`marca_id` ASC),
  CONSTRAINT `fk_modelo_marca1`
    FOREIGN KEY (`marca_id`)
    REFERENCES `rcv_db`.`marca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`porcentajes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`porcentajes` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`porcentajes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `porcentaje` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`contratos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`contratos` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`contratos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `placa` VARCHAR(45) NOT NULL,
  `anio` YEAR NOT NULL,
  `color` VARCHAR(45) NOT NULL,
  `serial_c` VARCHAR(45) NOT NULL,
  `serial_m` VARCHAR(45) NOT NULL,
  `peso` VARCHAR(45) NOT NULL,
  `fecha_exp` DATE NOT NULL,
  `hora_ven` VARCHAR(45) NOT NULL,
  `fecha_ven` DATE NOT NULL,
  `hora_exp` VARCHAR(45) NOT NULL,
  `tipoTrans_id` INT NOT NULL,
  `usoVehiculo_id` INT NOT NULL,
  `precio_id` INT NOT NULL,
  `statusCont_id` INT NOT NULL,
  `titulares_id` INT NOT NULL,
  `planillas_id` INT NOT NULL,
  `modelo_id` INT NOT NULL,
  `porcentajes_id` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `fk_contratos_tipoTrans1_idx` (`tipoTrans_id` ASC),
  INDEX `fk_contratos_usoVehiculo1_idx` (`usoVehiculo_id` ASC),
  INDEX `fk_contratos_precio1_idx` (`precio_id` ASC),
  INDEX `fk_contratos_statusCont1_idx` (`statusCont_id` ASC),
  INDEX `fk_contratos_titulares1_idx` (`titulares_id` ASC),
  INDEX `fk_contratos_planillas1_idx` (`planillas_id` ASC),
  INDEX `fk_contratos_modelo1_idx` (`modelo_id` ASC),
  INDEX `fk_contratos_porcentajes1_idx` (`porcentajes_id` ASC),
  CONSTRAINT `fk_contratos_tipoTrans1`
    FOREIGN KEY (`tipoTrans_id`)
    REFERENCES `rcv_db`.`tipoTrans` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_usoVehiculo1`
    FOREIGN KEY (`usoVehiculo_id`)
    REFERENCES `rcv_db`.`usoVehiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_precio1`
    FOREIGN KEY (`precio_id`)
    REFERENCES `rcv_db`.`precio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_statusCont1`
    FOREIGN KEY (`statusCont_id`)
    REFERENCES `rcv_db`.`statusCont` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_titulares1`
    FOREIGN KEY (`titulares_id`)
    REFERENCES `rcv_db`.`titulares` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_planillas1`
    FOREIGN KEY (`planillas_id`)
    REFERENCES `rcv_db`.`planillas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_modelo1`
    FOREIGN KEY (`modelo_id`)
    REFERENCES `rcv_db`.`modelo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_porcentajes1`
    FOREIGN KEY (`porcentajes_id`)
    REFERENCES `rcv_db`.`porcentajes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`tipoTelf`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`tipoTelf` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`tipoTelf` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipoTelf` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`telefonos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`telefonos` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`telefonos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numTelf` VARCHAR(45) NOT NULL,
  `titulares_id` INT NOT NULL,
  `tipoTelf_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_telefonos_titulares1_idx` (`titulares_id` ASC),
  INDEX `fk_telefonos_tipoTelf1_idx` (`tipoTelf_id` ASC),
  CONSTRAINT `fk_telefonos_titulares1`
    FOREIGN KEY (`titulares_id`)
    REFERENCES `rcv_db`.`titulares` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_telefonos_tipoTelf1`
    FOREIGN KEY (`tipoTelf_id`)
    REFERENCES `rcv_db`.`tipoTelf` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`correos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`correos` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`correos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `correo` VARCHAR(120) NOT NULL,
  `titulares_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_correos_titulares1_idx` (`titulares_id` ASC),
  CONSTRAINT `fk_correos_titulares1`
    FOREIGN KEY (`titulares_id`)
    REFERENCES `rcv_db`.`titulares` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`perfilUsuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`perfilUsuario` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`perfilUsuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `perfilUsuario` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`pregunta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`pregunta` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`pregunta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pregunta` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`statusUsuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`statusUsuarios` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`statusUsuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `statusUsuarios` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `nick` VARCHAR(45) NOT NULL,
  `clave` VARCHAR(100) NOT NULL,
  `respuesta` VARCHAR(45) NOT NULL,
  `agencias_id` INT NOT NULL,
  `perfilUsuario_id` INT NOT NULL,
  `pregunta_id` INT NOT NULL,
  `statusUsuarios_id` INT NOT NULL,
  `porcentajes_id` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `fk_usuarios_agencias1_idx` (`agencias_id` ASC),
  INDEX `fk_usuarios_perfilUsuario1_idx` (`perfilUsuario_id` ASC),
  INDEX `fk_usuarios_pregunta1_idx` (`pregunta_id` ASC),
  INDEX `fk_usuarios_statusUsuarios1_idx` (`statusUsuarios_id` ASC),
  INDEX `fk_usuarios_porcentajes1_idx` (`porcentajes_id` ASC),
  CONSTRAINT `fk_usuarios_agencias1`
    FOREIGN KEY (`agencias_id`)
    REFERENCES `rcv_db`.`agencias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_perfilUsuario1`
    FOREIGN KEY (`perfilUsuario_id`)
    REFERENCES `rcv_db`.`perfilUsuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_pregunta1`
    FOREIGN KEY (`pregunta_id`)
    REFERENCES `rcv_db`.`pregunta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_statusUsuarios1`
    FOREIGN KEY (`statusUsuarios_id`)
    REFERENCES `rcv_db`.`statusUsuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_porcentajes1`
    FOREIGN KEY (`porcentajes_id`)
    REFERENCES `rcv_db`.`porcentajes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`tipoPago`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`tipoPago` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`tipoPago` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipoPago` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`facturas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`facturas` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`facturas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(60) NOT NULL,
  `fecha_reg` DATE NOT NULL,
  `statusFormat_id` INT NOT NULL,
  `agencias_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_facturas_statusFormat1_idx` (`statusFormat_id` ASC),
  INDEX `fk_facturas_agencias1_idx` (`agencias_id` ASC),
  CONSTRAINT `fk_facturas_statusFormat1`
    FOREIGN KEY (`statusFormat_id`)
    REFERENCES `rcv_db`.`statusFormat` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_facturas_agencias1`
    FOREIGN KEY (`agencias_id`)
    REFERENCES `rcv_db`.`agencias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`factEmitidas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`factEmitidas` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`factEmitidas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecah_em` DATE NOT NULL,
  `facturas_id` INT NOT NULL,
  `contratos_id` INT NOT NULL,
  `tipoPago_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_factEmitidas_facturas1_idx` (`facturas_id` ASC),
  INDEX `fk_factEmitidas_contratos1_idx` (`contratos_id` ASC),
  INDEX `fk_factEmitidas_tipoPago1_idx` (`tipoPago_id` ASC),
  CONSTRAINT `fk_factEmitidas_facturas1`
    FOREIGN KEY (`facturas_id`)
    REFERENCES `rcv_db`.`facturas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_factEmitidas_contratos1`
    FOREIGN KEY (`contratos_id`)
    REFERENCES `rcv_db`.`contratos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_factEmitidas_tipoPago1`
    FOREIGN KEY (`tipoPago_id`)
    REFERENCES `rcv_db`.`tipoPago` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rcv_db`.`concepto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rcv_db`.`concepto` ;

CREATE TABLE IF NOT EXISTS `rcv_db`.`concepto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cobertura_id` INT NOT NULL,
  `gastosMedicos1` DECIMAL(9,2) NOT NULL,
  `invalidez1` DECIMAL(9,2) NOT NULL,
  `muerte1` DECIMAL(9,2) NOT NULL,
  `gastosMedicos2` DECIMAL(9,2) NOT NULL,
  `invalidez2` DECIMAL(9,2) NOT NULL,
  `muerte2` DECIMAL(9,2) NOT NULL,
  `daniosPropiedad` DECIMAL(9,2) NOT NULL,
  `grua` DECIMAL(9,2) NOT NULL,
  `estacionamiento` DECIMAL(9,2) NOT NULL,
  `indemnizacionSem` DECIMAL(9,2) NOT NULL,
  `asistenciaLegal` DECIMAL(9,2) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_consepto_cobertura1_idx` (`cobertura_id` ASC),
  CONSTRAINT `fk_consepto_cobertura1`
    FOREIGN KEY (`cobertura_id`)
    REFERENCES `rcv_db`.`cobertura` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
