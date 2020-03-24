<?php

use Phpmig\Migration\Migration;

class AddModalitiesField extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `remedies`
        ADD COLUMN `modalities` TEXT NULL AFTER `anus_and_rectum`,
        ADD COLUMN `clinical` TEXT NULL AFTER `modalities`,
        CHANGE COLUMN `stomache` `stomach` TEXT NULL DEFAULT NULL ;

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
