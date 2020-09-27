<?php

use Phpmig\Migration\Migration;

class FixTreatmentTableField extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "ALTER TABLE `treatments` 
        DROP FOREIGN KEY `treatments_remedies_fk`;
        
        ALTER TABLE `treatments` 
        ADD COLUMN `power` VARCHAR(128) NULL AFTER `remedy`,
        ADD COLUMN `taking_rule` VARCHAR(256) NULL AFTER `power`,
        CHANGE COLUMN `remedy` `remedy` VARCHAR(256) NULL DEFAULT NULL ,
        DROP INDEX `treatments_remedies_idx` ;
        
        

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
