<?php

use Phpmig\Migration\Migration;

class FixFiledSensation extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `remedies`
        CHANGE COLUMN `sensations` `sensation` TEXT NULL DEFAULT NULL ;

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
