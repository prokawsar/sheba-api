<?php

use Phpmig\Migration\Migration;

class RemediesFieldCorrection3 extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `remedies`
        ADD COLUMN `peculiar_rare_symptoms` TEXT NULL AFTER `breathing`,
        ADD COLUMN `skull_cranium` TEXT NULL AFTER `head`,
        ADD COLUMN `brain_and_nerves` TEXT NULL AFTER `skull_cranium`,
        ADD COLUMN `vertigo` TEXT NULL AFTER `brain_and_nerves`,
        ADD COLUMN `headache` TEXT NULL AFTER `vertigo`,
        ADD COLUMN `organs` TEXT NULL AFTER `eyes`,
        ADD COLUMN `sight` TEXT NULL AFTER `organs`,
        ADD COLUMN `smell` TEXT NULL AFTER `nose`,
        ADD COLUMN `septum` TEXT NULL AFTER `smell`,
        ADD COLUMN `m_m` TEXT NULL AFTER `gums`,
        ADD COLUMN `lips` TEXT NULL AFTER `m_m`,
        ADD COLUMN `saliva` TEXT NULL AFTER `lips`,
        ADD COLUMN `uvula` TEXT NULL AFTER `tonsills`,
        ADD COLUMN `external` TEXT NULL AFTER `uvula`,
        ADD COLUMN `internal` TEXT NULL AFTER `external`,
        ADD COLUMN `epigastrium` TEXT NULL AFTER `abdomen`,
        ADD COLUMN `hpyochondrium` TEXT NULL AFTER `epigastrium`,
        ADD COLUMN `umbilical_region` TEXT NULL AFTER `hpyochondrium`,
        ADD COLUMN `lumbar_region` TEXT NULL AFTER `umbilical_region`,
        ADD COLUMN `hypogastrium` TEXT NULL AFTER `spleen`,
        ADD COLUMN `iliac_region` TEXT NULL AFTER `hypogastrium`,
        ADD COLUMN `inguinal_region` TEXT NULL AFTER `iliac_region`,
        CHANGE COLUMN `head` `head` TEXT NULL DEFAULT NULL AFTER `peculiar_rare_symptoms`,
        CHANGE COLUMN `hair` `hair` TEXT NULL DEFAULT NULL AFTER `headache`,
        CHANGE COLUMN `eyes` `eyes` TEXT NULL DEFAULT NULL AFTER `face_and_jaws`,
        CHANGE COLUMN `ears` `ears` TEXT NULL DEFAULT NULL AFTER `sight`,
        CHANGE COLUMN `tongue` `tongue` TEXT NULL DEFAULT NULL AFTER `mouth`,
        CHANGE COLUMN `taste` `taste` TEXT NULL DEFAULT NULL AFTER `tongue`,
        CHANGE COLUMN `thirst` `thirst` TEXT NULL DEFAULT NULL AFTER `internal`,
        CHANGE COLUMN `hunger` `hunger` TEXT NULL DEFAULT NULL AFTER `thirst`,
        CHANGE COLUMN `appetite` `appetite` TEXT NULL DEFAULT NULL AFTER `hunger`,
        CHANGE COLUMN `anus_and_rectum` `anus_and_rectum` TEXT NULL DEFAULT NULL AFTER `intestine`,
        CHANGE COLUMN `stools` `stools` TEXT NULL DEFAULT NULL AFTER `anus_and_rectum`,
        CHANGE COLUMN `skin` `skin` TEXT NULL DEFAULT NULL AFTER `stools`,
        CHANGE COLUMN `intolerable` `intolerable` TEXT NULL DEFAULT NULL AFTER `skin`,
        CHANGE COLUMN `ameliarable` `ameliarable` TEXT NULL DEFAULT NULL AFTER `intolerable`,
        CHANGE COLUMN `vission` `vission` TEXT NULL DEFAULT NULL AFTER `ameliarable`,
        CHANGE COLUMN `smelling` `smelling` TEXT NULL DEFAULT NULL AFTER `vission`,
        CHANGE COLUMN `sleep` `sleep` TEXT NULL DEFAULT NULL AFTER `smelling`,
        CHANGE COLUMN `dreams` `dreams` TEXT NULL DEFAULT NULL AFTER `sleep`,
        CHANGE COLUMN `perspiration` `perspiration` TEXT NULL DEFAULT NULL AFTER `dreams`,
        CHANGE COLUMN `neck_and_back` `neck_and_back` TEXT NULL DEFAULT NULL AFTER `perspiration`,
        CHANGE COLUMN `extrimities` `extrimities` TEXT NULL DEFAULT NULL AFTER `neck_and_back`,
        CHANGE COLUMN `bones` `bones` TEXT NULL DEFAULT NULL AFTER `extrimities`,
        CHANGE COLUMN `blood_pressure` `urinary_system` TEXT NULL DEFAULT NULL AFTER `lungs`,
        CHANGE COLUMN `face` `face_and_jaws` TEXT NULL DEFAULT NULL ;

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
