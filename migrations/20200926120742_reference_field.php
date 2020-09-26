<?php

use Phpmig\Migration\Migration;

class ReferenceField extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "ALTER TABLE `remedies` 
        ADD COLUMN `book_references` VARCHAR(256) NULL AFTER `relationship`;
        

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
