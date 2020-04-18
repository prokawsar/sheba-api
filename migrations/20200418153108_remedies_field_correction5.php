<?php

use Phpmig\Migration\Migration;

class RemediesFieldCorrection5 extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `remedies`
        CHANGE COLUMN `sternum` `sternum` TEXT NULL DEFAULT NULL AFTER `chest`,
        CHANGE COLUMN `ribs` `ribs` TEXT NULL DEFAULT NULL AFTER `sternum`,
        CHANGE COLUMN `circulatory_system` `circulatory_system` TEXT NULL DEFAULT NULL AFTER `ribs`,
        CHANGE COLUMN `hearts_movements` `hearts_movements` TEXT NULL DEFAULT NULL AFTER `circulatory_system`,
        CHANGE COLUMN `sacrum_back_spine` `sacrum_back_spine` TEXT NULL DEFAULT NULL AFTER `hearts_movements`,
        CHANGE COLUMN `vertibra` `vertibra` TEXT NULL DEFAULT NULL AFTER `sacrum_back_spine`,
        CHANGE COLUMN `nape` `nape` TEXT NULL DEFAULT NULL AFTER `vertibra`,
        CHANGE COLUMN `scapula` `scapula` TEXT NULL DEFAULT NULL AFTER `nape`,
        CHANGE COLUMN `shoulders` `shoulders` TEXT NULL DEFAULT NULL AFTER `scapula`,
        CHANGE COLUMN `axilla` `axilla` TEXT NULL DEFAULT NULL AFTER `shoulders`,
        CHANGE COLUMN `extrimities` `extrimities` TEXT NULL DEFAULT NULL AFTER `axilla`,
        CHANGE COLUMN `hips` `hips` TEXT NULL DEFAULT NULL AFTER `extrimities`,
        CHANGE COLUMN `pelvis` `pelvis` TEXT NULL DEFAULT NULL AFTER `hips`,
        CHANGE COLUMN `buttocks` `buttocks` TEXT NULL DEFAULT NULL AFTER `pelvis`,
        CHANGE COLUMN `all_over_the_body` `all_over_the_body` TEXT NULL DEFAULT NULL AFTER `buttocks`,
        CHANGE COLUMN `bones` `bones` TEXT NULL DEFAULT NULL AFTER `all_over_the_body`,
        CHANGE COLUMN `joints` `joints` TEXT NULL DEFAULT NULL AFTER `bones`,
        CHANGE COLUMN `muscles` `muscles` TEXT NULL DEFAULT NULL AFTER `joints`,
        CHANGE COLUMN `skin` `skin` TEXT NULL DEFAULT NULL AFTER `muscles`,
        CHANGE COLUMN `sleep` `sleep` TEXT NULL DEFAULT NULL AFTER `skin`,
        CHANGE COLUMN `dreams` `dreams` TEXT NULL DEFAULT NULL AFTER `sleep`,
        CHANGE COLUMN `fever_chill_heat_sweat` `fever_chill_heat_sweat` TEXT NULL DEFAULT NULL AFTER `dreams`,
        CHANGE COLUMN `intolerable` `intolerable` TEXT NULL DEFAULT NULL AFTER `fever_chill_heat_sweat`,
        CHANGE COLUMN `ameliarable` `ameliarable` TEXT NULL DEFAULT NULL AFTER `intolerable`,
        CHANGE COLUMN `vission` `vission` TEXT NULL DEFAULT NULL AFTER `ameliarable`,
        CHANGE COLUMN `smelling` `smelling` TEXT NULL DEFAULT NULL AFTER `vission`,
        CHANGE COLUMN `perspiration` `perspiration` TEXT NULL DEFAULT NULL AFTER `smelling`,
        CHANGE COLUMN `neck_and_back` `neck_and_back` TEXT NULL DEFAULT NULL AFTER `perspiration`,
        CHANGE COLUMN `duodenum` `duodenum` TEXT NULL DEFAULT NULL AFTER `neck_and_back`,
        CHANGE COLUMN `digestion` `digestion` TEXT NULL DEFAULT NULL AFTER `duodenum`,
        CHANGE COLUMN `heart` `heart` TEXT NULL DEFAULT NULL AFTER `digestion`,
        CHANGE COLUMN `lungs` `lungs` TEXT NULL DEFAULT NULL AFTER `heart`;

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
