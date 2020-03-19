<?php

use Phpmig\Migration\Migration;

class RemediesFieldsAll extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `remedies`
        ADD COLUMN `constitution` TEXT NULL AFTER `name`,
        ADD COLUMN `diathesis` TEXT NULL AFTER `constitution`,
        ADD COLUMN `miasm` TEXT NULL AFTER `diathesis`,
        ADD COLUMN `temperament` TEXT NULL AFTER `miasm`,
        ADD COLUMN `thermals` TEXT NULL AFTER `temperament`,
        ADD COLUMN `attacks_and_time` TEXT NULL AFTER `thermals`,
        ADD COLUMN `side` TEXT NULL AFTER `attacks_and_time`,
        ADD COLUMN `temperature_and_weather` TEXT NULL AFTER `side`,
        ADD COLUMN `ailments_trom` TEXT NULL AFTER `temperature_and_weather`,
        ADD COLUMN `sensations` TEXT NULL AFTER `ailments_trom`,
        ADD COLUMN `mind` TEXT NULL AFTER `sensations`,
        ADD COLUMN `face` TEXT NULL AFTER `mind`,
        ADD COLUMN `hair` TEXT NULL AFTER `face`,
        ADD COLUMN `skin` TEXT NULL AFTER `hair`,
        ADD COLUMN `built` TEXT NULL AFTER `skin`,
        ADD COLUMN `appetite` TEXT NULL AFTER `built`,
        ADD COLUMN `hunger` TEXT NULL AFTER `appetite`,
        ADD COLUMN `desires` TEXT NULL AFTER `hunger`,
        ADD COLUMN `aversions` TEXT NULL AFTER `desires`,
        ADD COLUMN `intolerable` TEXT NULL AFTER `aversions`,
        ADD COLUMN `ameliarable` TEXT NULL AFTER `intolerable`,
        ADD COLUMN `vission` TEXT NULL AFTER `ameliarable`,
        ADD COLUMN `hearing` TEXT NULL AFTER `vission`,
        ADD COLUMN `smelling` TEXT NULL AFTER `hearing`,
        ADD COLUMN `taste` TEXT NULL AFTER `smelling`,

        ADD COLUMN `tongue` TEXT NULL AFTER `taste`,
        ADD COLUMN `thirst` TEXT NULL AFTER `tongue`,
        ADD COLUMN `sleep` TEXT NULL AFTER `thirst`,
        ADD COLUMN `dreams` TEXT NULL AFTER `sleep`,
        ADD COLUMN `stools` TEXT NULL AFTER `dreams`,
        ADD COLUMN `urine` TEXT NULL AFTER `stools`,
        ADD COLUMN `perspiration` TEXT NULL AFTER `urine`,
        ADD COLUMN `nutrition` TEXT NULL AFTER `perspiration`,
        ADD COLUMN `anaemia` TEXT NULL AFTER `nutrition`,
        ADD COLUMN `cyanosis` TEXT NULL AFTER `anaemia`,
        ADD COLUMN `dehydration` TEXT NULL AFTER `cyanosis`,
        ADD COLUMN `jaundice` TEXT NULL AFTER `dehydration`,
        ADD COLUMN `breathing` TEXT NULL AFTER `jaundice`,
        ADD COLUMN `pulse` TEXT NULL AFTER `breathing`;
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
