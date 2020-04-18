<?php

use Phpmig\Migration\Migration;

class RemediesFieldCorrection4 extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `remedies`
        ADD COLUMN `quantity` TEXT NULL AFTER `urinary_system`,
        ADD COLUMN `color` TEXT NULL AFTER `quantity`,
        ADD COLUMN `sediment` TEXT NULL AFTER `color`,
        ADD COLUMN `befor` TEXT NULL AFTER `sediment`,
        ADD COLUMN `during` TEXT NULL AFTER `befor`,
        ADD COLUMN `after` TEXT NULL AFTER `during`,
        ADD COLUMN `kidneys` TEXT NULL AFTER `after`,
        ADD COLUMN `ureters` TEXT NULL AFTER `kidneys`,
        ADD COLUMN `bladder` TEXT NULL AFTER `ureters`,
        ADD COLUMN `urethra` TEXT NULL AFTER `bladder`,
        ADD COLUMN `mgo_desires` TEXT NULL AFTER `male_genital`,
        ADD COLUMN `powers` TEXT NULL AFTER `mgo_desires`,
        ADD COLUMN `emission` TEXT NULL AFTER `powers`,
        ADD COLUMN `fgo_organs` TEXT NULL AFTER `female_genital`,
        ADD COLUMN `mensruation` TEXT NULL AFTER `fgo_organs`,
        ADD COLUMN `leucorrhoea` TEXT NULL AFTER `mensruation`,
        ADD COLUMN `pregnancy` TEXT NULL AFTER `leucorrhoea`,
        ADD COLUMN `respiratory_system` TEXT NULL AFTER `pregnancy`,
        ADD COLUMN `respi_organs` TEXT NULL AFTER `respiratory_system`,
        ADD COLUMN `respi_breathing` TEXT NULL AFTER `respi_organs`,
        ADD COLUMN `lymphatic_system` TEXT NULL AFTER `respi_breathing`,
        ADD COLUMN `endocrine_disorders` TEXT NULL AFTER `lymphatic_system`,
        ADD COLUMN `hormones` TEXT NULL AFTER `endocrine_disorders`,
        ADD COLUMN `sternum` TEXT NULL AFTER `chest`,
        ADD COLUMN `ribs` TEXT NULL AFTER `sternum`,
        ADD COLUMN `circulatory_system` TEXT NULL AFTER `ribs`,
        ADD COLUMN `hearts_movements` TEXT NULL AFTER `circulatory_system`,
        ADD COLUMN `sacrum_back_spine` TEXT NULL AFTER `hearts_movements`,
        ADD COLUMN `vertibra` TEXT NULL AFTER `sacrum_back_spine`,
        ADD COLUMN `nape` TEXT NULL AFTER `vertibra`,
        ADD COLUMN `scapula` TEXT NULL AFTER `nape`,
        ADD COLUMN `shoulders` TEXT NULL AFTER `scapula`,
        ADD COLUMN `axilla` TEXT NULL AFTER `shoulders`,
        ADD COLUMN `hips` TEXT NULL AFTER `extrimities`,
        ADD COLUMN `pelvis` TEXT NULL AFTER `hips`,
        ADD COLUMN `buttocks` TEXT NULL AFTER `pelvis`,
        ADD COLUMN `all_over_the_body` TEXT NULL AFTER `buttocks`,
        ADD COLUMN `joints` TEXT NULL AFTER `bones`,
        ADD COLUMN `muscles` TEXT NULL AFTER `joints`,
        ADD COLUMN `fever_chill_heat_sweat` TEXT NULL AFTER `dreams`,

        CHANGE COLUMN `mso_mgo` `male_genital` TEXT NULL DEFAULT NULL AFTER `urethra`,
        CHANGE COLUMN `fso_mgo` `female_genital` TEXT NULL DEFAULT NULL AFTER `emission`,
        CHANGE COLUMN `chest` `chest` TEXT NULL DEFAULT NULL AFTER `hormones`,
        CHANGE COLUMN `extrimities` `extrimities` TEXT NULL DEFAULT NULL AFTER `axilla`,
        CHANGE COLUMN `bones` `bones` TEXT NULL DEFAULT NULL AFTER `all_over_the_body`,
        CHANGE COLUMN `skin` `skin` TEXT NULL DEFAULT NULL AFTER `muscles`,
        CHANGE COLUMN `sleep` `sleep` TEXT NULL DEFAULT NULL AFTER `skin`,
        CHANGE COLUMN `dreams` `dreams` TEXT NULL DEFAULT NULL AFTER `sleep`,
        CHANGE COLUMN `intolerable` `intolerable` TEXT NULL DEFAULT NULL AFTER `fever_chill_heat_sweat`,
        CHANGE COLUMN `ameliarable` `ameliarable` TEXT NULL DEFAULT NULL AFTER `intolerable`,
        CHANGE COLUMN `vission` `vission` TEXT NULL DEFAULT NULL AFTER `ameliarable`,
        CHANGE COLUMN `smelling` `smelling` TEXT NULL DEFAULT NULL AFTER `vission`,
        CHANGE COLUMN `perspiration` `perspiration` TEXT NULL DEFAULT NULL AFTER `smelling`,
        CHANGE COLUMN `neck_and_back` `neck_and_back` TEXT NULL DEFAULT NULL AFTER `perspiration`;

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
