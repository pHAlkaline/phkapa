SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

ALTER TABLE `default_schema`.`phkapa_actions` 
DROP FOREIGN KEY `phkapa_actions_ibfk_4`;

ALTER TABLE `default_schema`.`phkapa_tickets` 
DROP FOREIGN KEY `phkapa_tickets_ibfk_17`;

CREATE TABLE IF NOT EXISTS `default_schema`.`phkapa_customers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL DEFAULT '',
  `active` TINYINT(1) NOT NULL DEFAULT '1',
  `created` DATETIME NULL DEFAULT NULL,
  `modified` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

ALTER TABLE `default_schema`.`phkapa_tickets` 
ADD COLUMN `customer_id` INT(11) NULL DEFAULT NULL AFTER `supplier_id`,
ADD COLUMN `product` VARCHAR(100) NULL DEFAULT NULL AFTER `customer_id`,
ADD INDEX `CustomerIdKey` (`customer_id` ASC);

ALTER TABLE `default_schema`.`phkapa_tickets_revision` 
ADD COLUMN `customer_id` INT(11) NULL DEFAULT NULL AFTER `supplier_id`,
ADD COLUMN `product` VARCHAR(100) NULL DEFAULT NULL AFTER `customer_id`,
ADD INDEX `CustomerIdKey` (`customer_id` ASC),
ADD INDEX `SafetyIdKey` (`safety_id` ASC);

ALTER TABLE `default_schema`.`phkapa_actions` 
ADD CONSTRAINT `phkapa_actions_ibfk_4`
  FOREIGN KEY (`action_effectiveness_id`)
  REFERENCES `default_schema`.`phkapa_action_effectivenesses` (`id`)
  ON UPDATE CASCADE;

ALTER TABLE `default_schema`.`phkapa_tickets` 
ADD CONSTRAINT `phkapa_tickets_ibfk_17`
  FOREIGN KEY (`customer_id`)
  REFERENCES `default_schema`.`phkapa_customers` (`id`)
  ON UPDATE CASCADE,
ADD CONSTRAINT `phkapa_tickets_ibfk_18`
  FOREIGN KEY (`safety_id`)
  REFERENCES `default_schema`.`phkapa_safeties` (`id`)
  ON UPDATE CASCADE;

ALTER TABLE `default_schema`.`phkapa_tickets_revision` 
ADD CONSTRAINT `phkapa_tickets_revision_ibfk_16`
  FOREIGN KEY (`customer_id`)
  REFERENCES `default_schema`.`phkapa_customers` (`id`)
  ON UPDATE CASCADE,
ADD CONSTRAINT `phkapa_tickets_revision_ibfk_17`
  FOREIGN KEY (`safety_id`)
  REFERENCES `default_schema`.`phkapa_safeties` (`id`)
  ON UPDATE CASCADE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
