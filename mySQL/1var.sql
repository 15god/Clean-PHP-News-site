-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema DB
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DB` DEFAULT CHARACTER SET utf8 ;
USE `DB` ;

-- -----------------------------------------------------
-- Table `DB`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB`.`roles` (
  `id_role` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_role`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB`.`users` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `id_role` INT NOT NULL,
  `reg_date` DATETIME NOT NULL,
  `last_auth_date` DATETIME NULL,
  PRIMARY KEY (`id_user`),
  INDEX `role_link_idx` (`id_role` ASC) VISIBLE,
  CONSTRAINT `role_link`
    FOREIGN KEY (`id_role`)
    REFERENCES `DB`.`roles` (`id_role`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB`.`categories` (
  `id_catergory` INT NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(45) NULL,
  PRIMARY KEY (`id_catergory`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB`.`news` (
  `id_news` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `publication_date` DATETIME NOT NULL,
  `content` LONGTEXT NOT NULL,
  `id_category` INT NOT NULL,
  `is_draft` TINYINT NOT NULL,
  `id_tag` INT NULL,
  `img` VARCHAR(45) NULL,
  `author` VARCHAR(45) NULL,
  PRIMARY KEY (`id_news`),
  INDEX `category_link_idx` (`id_category` ASC) VISIBLE,
  CONSTRAINT `category_link`
    FOREIGN KEY (`id_category`)
    REFERENCES `DB`.`categories` (`id_catergory`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB`.`tags` (
  `id_tag` INT NOT NULL AUTO_INCREMENT,
  `tag` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tag`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DB`.`news_tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB`.`news_tags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_news` INT NULL,
  `id_tag` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `tag_link_idx` (`id_tag` ASC) VISIBLE,
  INDEX `news_link_idx` (`id_news` ASC) VISIBLE,
  CONSTRAINT `tag_link`
    FOREIGN KEY (`id_tag`)
    REFERENCES `DB`.`tags` (`id_tag`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `news_link`
    FOREIGN KEY (`id_news`)
    REFERENCES `DB`.`news` (`id_news`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
