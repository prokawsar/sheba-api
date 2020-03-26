<?php

use Phpmig\Migration\Migration;

class FixFiledName extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `case_histories`
        CHANGE COLUMN `stool` `stools` TEXT NULL DEFAULT NULL ;

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
