<?php

use Phpmig\Migration\Migration;

class RemediesFieldCorrection extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `remedies`
        CHANGE COLUMN `built` `built` TEXT NULL DEFAULT NULL AFTER `name`,
        CHANGE COLUMN `temperature_and_weather` `temperature_and_weather` TEXT NULL DEFAULT NULL AFTER `temperament`,
        CHANGE COLUMN `sensation` `sensation` TEXT NULL DEFAULT NULL AFTER `thermal_sensitivity`,
        ADD COLUMN `tendency_take_cold` TEXT NULL AFTER `sensation`,
        CHANGE COLUMN `desires` `desires` TEXT NULL DEFAULT NULL AFTER `tendency_take_cold`,
        CHANGE COLUMN `aversions` `aversions` TEXT NULL DEFAULT NULL AFTER `desires`,
        ADD COLUMN `birth_history_milestones` TEXT NULL AFTER `aversions`,
        ADD COLUMN `tissues` TEXT NULL AFTER `birth_history_milestones`,

        CHANGE COLUMN `thermals` `thermal_sensitivity` TEXT NULL DEFAULT NULL ;

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
