<?php

use Phpmig\Migration\Migration;

class FieldsForCaseHistory extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `case_histories`
        ADD COLUMN `face` TEXT NULL AFTER `mind`,
        ADD COLUMN `built` TEXT NULL AFTER `face`,
        ADD COLUMN `hair` TEXT NULL AFTER `built`,
        ADD COLUMN `tongue` TEXT NULL AFTER `hair`,
        ADD COLUMN `pulse` TEXT NULL AFTER `tongue`,
        ADD COLUMN `breathing` TEXT NULL AFTER `pulse`,
        ADD COLUMN `anaemia` TEXT NULL AFTER `breathing`,
        ADD COLUMN `cyanosis` TEXT NULL AFTER `anaemia`,
        ADD COLUMN `dehydration` TEXT NULL AFTER `cyanosis`,
        ADD COLUMN `jaundice` TEXT NULL AFTER `dehydration`,
        ADD COLUMN `skin` TEXT NULL AFTER `jaundice`,
        ADD COLUMN `sensation` TEXT NULL AFTER `skin`,
        ADD COLUMN `temperature_and_weather` TEXT NULL AFTER `sensation`,
        ADD COLUMN `thermals` TEXT NULL AFTER `temperature_and_weather`,
        ADD COLUMN `susceptibility` TEXT NULL AFTER `thermals`,
        ADD COLUMN `bathing` TEXT NULL AFTER `susceptibility`,
        ADD COLUMN `vision` TEXT NULL AFTER `bathing`,
        ADD COLUMN `hearing` TEXT NULL AFTER `vision`,
        ADD COLUMN `smelling` TEXT NULL AFTER `hearing`,
        ADD COLUMN `taste` TEXT NULL AFTER `smelling`,
        ADD COLUMN `thirst` TEXT NULL AFTER `taste`,
        ADD COLUMN `appetite` TEXT NULL AFTER `thirst`,
        ADD COLUMN `hunger` TEXT NULL AFTER `appetite`,
        ADD COLUMN `desires` TEXT NULL AFTER `hunger`,
        ADD COLUMN `aversions` TEXT NULL AFTER `desires`,
        ADD COLUMN `intolerable` TEXT NULL AFTER `aversions`,
        ADD COLUMN `ameliorable` TEXT NULL AFTER `intolerable`,
        ADD COLUMN `indigestion` TEXT NULL AFTER `ameliorable`,
        ADD COLUMN `eructation` TEXT NULL AFTER `indigestion`,
        ADD COLUMN `nausia` TEXT NULL AFTER `eructation`,
        ADD COLUMN `vomiting` TEXT NULL AFTER `nausia`,
        ADD COLUMN `sweating_perspiration` TEXT NULL AFTER `vomiting`,
        ADD COLUMN `sleep` TEXT NULL AFTER `sweating_perspiration`,
        ADD COLUMN `dreams` TEXT NULL AFTER `sleep`,
        ADD COLUMN `discharges` TEXT NULL AFTER `dreams`,
        ADD COLUMN `stool` TEXT NULL AFTER `discharges`,
        ADD COLUMN `urine` TEXT NULL AFTER `stool`,
        ADD COLUMN `menstruation` TEXT NULL AFTER `urine`,
        ADD COLUMN `leucorrhoea` TEXT NULL AFTER `menstruation`,
        ADD COLUMN `habit` TEXT NULL AFTER `leucorrhoea`,
        ADD COLUMN `hobby` TEXT NULL AFTER `habit`,
        ADD COLUMN `addicted` TEXT NULL AFTER `hobby`,
        ADD COLUMN `birth_history` TEXT NULL AFTER `addicted`,
        ADD COLUMN `milestones` TEXT NULL AFTER `birth_history`,
        ADD COLUMN `mood_and_affect` TEXT NULL AFTER `milestones`,
        ADD COLUMN `speech` TEXT NULL AFTER `mood_and_affect`,
        ADD COLUMN `thought` TEXT NULL AFTER `speech`,
        ADD COLUMN `attention_and_concentration` TEXT NULL AFTER `thought`,
        ADD COLUMN `consciousness` TEXT NULL AFTER `attention_and_concentration`,
        ADD COLUMN `appearance_and_behavior` TEXT NULL AFTER `consciousness`,
        ADD COLUMN `memory` TEXT NULL AFTER `appearance_and_behavior`,
        ADD COLUMN `intelligency` TEXT NULL AFTER `memory`,
        ADD COLUMN `judgement` TEXT NULL AFTER `intelligency`,
        ADD COLUMN `insight` TEXT NULL AFTER `judgement`,
        ADD COLUMN `temperament` TEXT NULL AFTER `insight`,
        ADD COLUMN `alone_and_darkness` TEXT NULL AFTER `temperament`,
        ADD COLUMN `frightness` TEXT NULL AFTER `alone_and_darkness`,
        ADD COLUMN `constitution` TEXT NULL AFTER `frightness`,
        ADD COLUMN `diathesis` TEXT NULL AFTER `constitution`,
        ADD COLUMN `miasm` TEXT NULL AFTER `diathesis`,
        ADD COLUMN `ailments_from` TEXT NULL AFTER `miasm`,
        ADD COLUMN `attacks_and_time` TEXT NULL AFTER `ailments_from`,
        ADD COLUMN `side` TEXT NULL AFTER `attacks_and_time`,
        ADD COLUMN `past_medical_history` TEXT NULL AFTER `side`,
        ADD COLUMN `family_medical_history` TEXT NULL AFTER `past_medical_history`,
        ADD COLUMN `rare_peculiar_symptoms` TEXT NULL AFTER `family_medical_history`;

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
