<?php

use Phpmig\Migration\Migration;

class DropCaseHistories extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `treatments`
        DROP FOREIGN KEY `treatments_case_histories_fk`;

        ALTER TABLE `treatments`
        DROP INDEX `treatments_case_histories_idx` ;

        DROP TABLE `case_histories`;
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
