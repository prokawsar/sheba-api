<?php

use Phpmig\Migration\Migration;

class AddCaseHistories extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        CREATE TABLE `case_histories` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `patient` INT NULL,

           `built` TEXT NULL,
           `constitution` TEXT NULL,
           `diathesis` TEXT NULL,
           `miasm` TEXT NULL,
           `temperament` TEXT NULL,
           `temperature_and_weather` TEXT NULL,
           `thermal_sensitivity` TEXT NULL,
           `sensation` TEXT NULL,
           `tendency_take_cold` TEXT NULL,
           `desires` TEXT NULL,
           `aversions` TEXT NULL,
           `birth_history_milestones` TEXT NULL,
           `tissues` TEXT NULL,
           `stages_and_states` TEXT NULL,
           `attacks_and_side` TEXT NULL,
           `ailments_from` TEXT NULL,
           `affections` TEXT NULL,
           `clinical` TEXT NULL,
           `modalities` TEXT NULL,
           `mental_state_and_disorders` TEXT NULL,
           `appearance_and_behavior` TEXT NULL,
           `attention_and_concentration` TEXT NULL,
           `expression` TEXT NULL,
           `consciousness` TEXT NULL,
           `mood_and_affect` TEXT NULL,
           `memory` TEXT NULL,
           `speech` TEXT NULL,
           `thoughts_and_ideas` TEXT NULL,
           `perception` TEXT NULL,
           `intelligence` TEXT NULL,
           `judgment` TEXT NULL,
           `fear_and_live_alone` TEXT NULL,
           `boring` TEXT NULL,
           `peaceful` TEXT NULL,
           `anger` TEXT NULL,
           `hobby` TEXT NULL,
           `habit` TEXT NULL,
           `addiction` TEXT NULL,
           `nutrition` TEXT NULL,
           `anaemia` TEXT NULL,
           `cyanosis` TEXT NULL,
           `dehydration` TEXT NULL,
           `jaundice` TEXT NULL,
           `pulse` TEXT NULL,
           `breathing` TEXT NULL,
           `peculiar_rare_symptoms` TEXT NULL,
           `head` TEXT NULL,
           `face_and_jaws` TEXT NULL,
           `eyes` TEXT NULL,
           `hearing` TEXT NULL,
           `skull_cranium` TEXT NULL,
           `brain_and_nerves` TEXT NULL,
           `vertigo` TEXT NULL,
           `headache` TEXT NULL,
           `hair` TEXT NULL,
           `organs` TEXT NULL,
           `sight` TEXT NULL,
           `ears` TEXT NULL,
           `nose` TEXT NULL,
           `smell` TEXT NULL,
           `septum` TEXT NULL,
           `mouth` TEXT NULL,
           `tongue` TEXT NULL,
           `taste` TEXT NULL,
           `teeth` TEXT NULL,
           `gums` TEXT NULL,
           `m_m` TEXT NULL,
           `lips` TEXT NULL,
           `saliva` TEXT NULL,
           `throat` TEXT NULL,
           `tonsills` TEXT NULL,
           `uvula` TEXT NULL,
           `external` TEXT NULL,
           `internal` TEXT NULL,
           `thirst` TEXT NULL,
           `hunger` TEXT NULL,
           `appetite` TEXT NULL,
           `oesophagus` TEXT NULL,
           `stomach` TEXT NULL,
           `abdomen` TEXT NULL,
           `epigastrium` TEXT NULL,
           `hpyochondrium` TEXT NULL,
           `umbilical_region` TEXT NULL,
           `lumbar_region` TEXT NULL,
           `liver` TEXT NULL,
           `gallbladder` TEXT NULL,
           `pancreas` TEXT NULL,
           `spleen` TEXT NULL,
           `hypogastrium` TEXT NULL,
           `iliac_region` TEXT NULL,
           `inguinal_region` TEXT NULL,
           `intestine` TEXT NULL,
           `anus_and_rectum` TEXT NULL,
           `stools` TEXT NULL,
           `urinary_system` TEXT NULL,
           `quantity` TEXT NULL,
           `color` TEXT NULL,
           `sediment` TEXT NULL,
           `befor` TEXT NULL,
           `during` TEXT NULL,
           `after` TEXT NULL,
           `kidneys` TEXT NULL,
           `ureters` TEXT NULL,
           `bladder` TEXT NULL,
           `urethra` TEXT NULL,
           `male_genital` TEXT NULL,
           `mgo_desires` TEXT NULL,
           `powers` TEXT NULL,
           `emission` TEXT NULL,
           `female_genital` TEXT NULL,
           `fgo_organs` TEXT NULL,
           `mensruation` TEXT NULL,
           `leucorrhoea` TEXT NULL,
           `pregnancy` TEXT NULL,
           `respiratory_system` TEXT NULL,
           `respi_organs` TEXT NULL,
           `respi_breathing` TEXT NULL,
           `lymphatic_system` TEXT NULL,
           `endocrine_disorders` TEXT NULL,
           `hormones` TEXT NULL,
           `chest` TEXT NULL,
           `sternum` TEXT NULL,
           `ribs` TEXT NULL,
           `circulatory_system` TEXT NULL,
           `hearts_movements` TEXT NULL,
           `sacrum_back_spine` TEXT NULL,
           `vertibra` TEXT NULL,
           `nape` TEXT NULL,
           `scapula` TEXT NULL,
           `shoulders` TEXT NULL,
           `axilla` TEXT NULL,
           `extrimities` TEXT NULL,
           `hips` TEXT NULL,
           `pelvis` TEXT NULL,
           `buttocks` TEXT NULL,
           `all_over_the_body` TEXT NULL,
           `bones` TEXT NULL,
           `joints` TEXT NULL,
           `muscles` TEXT NULL,
           `skin` TEXT NULL,
           `sleep` TEXT NULL,
           `dreams` TEXT NULL,
           `fever_chill_heat_sweat` TEXT NULL,
           `intolerable` TEXT NULL,
           `ameliarable` TEXT NULL,
           `vission` TEXT NULL,
           `smelling` TEXT NULL,
           `neck_and_back` TEXT NULL,
           `digestion` TEXT NULL,
           `heart` TEXT NULL,
           `lungs` TEXT NULL,
           `relationship` TEXT NULL,

            `deleted` TINYINT(1) NULL DEFAULT 0,
            `created` DATETIME NULL,
            `modified` DATETIME NULL,
            PRIMARY KEY (`id`),
            INDEX `case_histories_patient_idx` (`patient` ASC),
            CONSTRAINT `case_histories_patients_fk`
              FOREIGN KEY (`patient`)
              REFERENCES `patients` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION);
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
