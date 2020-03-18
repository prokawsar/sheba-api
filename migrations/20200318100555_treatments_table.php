<?php

use Phpmig\Migration\Migration;

class TreatmentsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        CREATE TABLE `treatments` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `case_history` INT NULL,
            `patient` INT NULL,
            `remedy` INT NULL,
            `notes` VARCHAR(256) NULL,
            `created` DATETIME NULL,
            `modified` DATETIME NULL,
            PRIMARY KEY (`id`),
            INDEX `treatments_case_histories_idx` (`case_history` ASC),
            INDEX `treatments_patients_idx` (`patient` ASC),
            INDEX `treatments_remedies_idx` (`remedy` ASC),
            CONSTRAINT `treatments_case_histories_fk`
              FOREIGN KEY (`case_history`)
              REFERENCES `case_histories` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `treatments_patients_fk`
              FOREIGN KEY (`patient`)
              REFERENCES `patients` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `treatments_remedies_fk`
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
