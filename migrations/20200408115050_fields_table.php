<?php

use Phpmig\Migration\Migration;

class FieldsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        CREATE TABLE `fields` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(128) NULL,
            `deleted` TINYINT(1) NULL DEFAULT 0,
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
