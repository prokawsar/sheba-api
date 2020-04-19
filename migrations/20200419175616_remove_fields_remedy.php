<?php

use Phpmig\Migration\Migration;

class RemoveFieldsRemedy extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `remedies`
        DROP COLUMN `preculiar_rare_symptoms`,
        DROP COLUMN `duodenum`,
        DROP COLUMN `perspiration`;

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
