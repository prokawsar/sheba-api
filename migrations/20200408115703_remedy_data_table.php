<?php

use Phpmig\Migration\Migration;

class RemedyDataTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        CREATE TABLE `remedy_data` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `field` INT NULL,
            `remedy` INT NULL,
            `symptoms` TEXT NULL,
            `deleted` TINYINT(1) NULL DEFAULT 0,
            `created` DATETIME NULL,
            `modified` DATETIME NULL,
            PRIMARY KEY (`id`),
            INDEX `remedy_field_idx` (`field` ASC),
            INDEX `remedy_remedies_idx` (`remedy` ASC),
            CONSTRAINT `remedy_field_fk`
              FOREIGN KEY (`field`)
              REFERENCES `fields` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `remedy_remedies_fk`
              FOREIGN KEY (`remedy`)
              REFERENCES `remedies` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION);
            ";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        /*
        $sql = "

            ";
        $container = $this->getContainer();
        $container['db']->query($sql);
        //*/
    }
}
