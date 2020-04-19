<?php

use Phpmig\Migration\Migration;

class RearrangeRemediesField extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "

        ALTER TABLE `remedies`
        CHANGE COLUMN `face_and_jaws` `face_and_jaws` TEXT NULL DEFAULT NULL AFTER `hair`,
        CHANGE COLUMN `eyes` `eyes` TEXT NULL DEFAULT NULL AFTER `face_and_jaws`,
        CHANGE COLUMN `hearing` `hearing` TEXT NULL DEFAULT NULL AFTER `ears`;
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
