<?php

use Phpmig\Migration\Migration;

class RemediesFieldCorrection2 extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `remedies`
        ADD COLUMN `affections` TEXT NULL AFTER `ailments_from`,
        ADD COLUMN `preculiar_rare_symptoms` TEXT NULL AFTER `modalities`,
        ADD COLUMN `relationship` TEXT NULL AFTER `preculiar_rare_symptoms`,
        ADD COLUMN `appearance_and_behavior` TEXT NULL AFTER `mental_state_and_disorders`,
        ADD COLUMN `attention_and_concentration` TEXT NULL AFTER `appearance_and_behavior`,
        ADD COLUMN `expression` TEXT NULL AFTER `attention_and_concentration`,
        ADD COLUMN `consciousness` TEXT NULL AFTER `expression`,
        ADD COLUMN `mood_and_affect` TEXT NULL AFTER `consciousness`,
        ADD COLUMN `memory` TEXT NULL AFTER `mood_and_affect`,
        ADD COLUMN `speech` TEXT NULL AFTER `memory`,
        ADD COLUMN `thoughts_and_ideas` TEXT NULL AFTER `speech`,
        ADD COLUMN `perception` TEXT NULL AFTER `thoughts_and_ideas`,
        ADD COLUMN `intelligence` TEXT NULL AFTER `perception`,
        ADD COLUMN `judgment` TEXT NULL AFTER `intelligence`,
        ADD COLUMN `fear_and_live_alone` TEXT NULL AFTER `judgment`,
        ADD COLUMN `boring` TEXT NULL AFTER `fear_and_live_alone`,
        ADD COLUMN `peaceful` TEXT NULL AFTER `boring`,
        ADD COLUMN `anger` TEXT NULL AFTER `peaceful`,
        ADD COLUMN `hobby` TEXT NULL AFTER `anger`,
        ADD COLUMN `habit` TEXT NULL AFTER `hobby`,
        ADD COLUMN `addiction` TEXT NULL AFTER `habit`,
        CHANGE COLUMN `side` `stages_and_states` TEXT NULL DEFAULT NULL AFTER `tissues`,
        CHANGE COLUMN `clinical` `clinical` TEXT NULL DEFAULT NULL AFTER `affections`,
        CHANGE COLUMN `modalities` `modalities` TEXT NULL DEFAULT NULL AFTER `clinical`,
        CHANGE COLUMN `nutrition` `nutrition` TEXT NULL DEFAULT NULL AFTER `addiction`,
        CHANGE COLUMN `anaemia` `anaemia` TEXT NULL DEFAULT NULL AFTER `nutrition`,
        CHANGE COLUMN `cyanosis` `cyanosis` TEXT NULL DEFAULT NULL AFTER `anaemia`,
        CHANGE COLUMN `dehydration` `dehydration` TEXT NULL DEFAULT NULL AFTER `cyanosis`,
        CHANGE COLUMN `jaundice` `jaundice` TEXT NULL DEFAULT NULL AFTER `dehydration`,
        CHANGE COLUMN `urine` `blood_pressure` TEXT NULL DEFAULT NULL AFTER `jaundice`,
        CHANGE COLUMN `pulse` `pulse` TEXT NULL DEFAULT NULL AFTER `blood_pressure`,
        CHANGE COLUMN `breathing` `breathing` TEXT NULL DEFAULT NULL AFTER `pulse`,
        CHANGE COLUMN `attacks_and_time` `attacks_and_side` TEXT NULL DEFAULT NULL ,
        CHANGE COLUMN `mind` `mental_state_and_disorders` TEXT NULL DEFAULT NULL ;


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
