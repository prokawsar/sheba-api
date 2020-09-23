<?php

use Phpmig\Migration\Migration;

class HistoryFkTreatments extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "ALTER TABLE `treatments` 
        ADD INDEX `treatments_history_idx` (`case_history` ASC);
        
        ALTER TABLE `treatments` 
        ADD CONSTRAINT `treatments_history_fk`
          FOREIGN KEY (`case_history`)
          REFERENCES `case_histories` (`id`)
          ON DELETE NO ACTION
          ON UPDATE NO ACTION;
        

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
