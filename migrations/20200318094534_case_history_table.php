<?php

use Phpmig\Migration\Migration;

class CaseHistoryTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        CREATE TABLE `case_histories` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `patient` INT NULL,
            `mind` TEXT NULL,
            `deleted` TINYINT(1) NULL DEFAULT 0,
            `created` DATETIME NULL,
            `modified` DATETIME NULL,
            PRIMARY KEY (`id`),
            INDEX `case_histories_patient_idx` (`patient` ASC),
            CONSTRAINT `case_histories_patients_fk`
              FOREIGN KEY (`patient`)
              REFERENCES `patients` (`id`)
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
