<?php

use Phpmig\Migration\Migration;

class PatientsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        CREATE TABLE `patients` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(128) NULL,
            `age` VARCHAR(128) NULL,
            `phone` VARCHAR(128) NULL,
            `gender` VARCHAR(128) NULL,
            `address` VARCHAR(256) NULL,
            `deleted` TINYINT(1) NULL,
            `created` DATETIME NULL,
            `modified` DATETIME NULL,
            PRIMARY KEY (`id`));

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
