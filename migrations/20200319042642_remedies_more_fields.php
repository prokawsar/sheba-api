<?php

use Phpmig\Migration\Migration;

class RemediesMoreFields extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql = "
        ALTER TABLE `remedies`
        ADD COLUMN `head` TEXT NULL AFTER `pulse`,
        ADD COLUMN `eyes` TEXT NULL AFTER `head`,
        ADD COLUMN `nose` TEXT NULL AFTER `eyes`,
        ADD COLUMN `ears` TEXT NULL AFTER `nose`,
        ADD COLUMN `mouth` TEXT NULL AFTER `ears`,
        ADD COLUMN `teeth` TEXT NULL AFTER `mouth`,
        ADD COLUMN `gums` TEXT NULL AFTER `teeth`,
        ADD COLUMN `throat` TEXT NULL AFTER `gums`,
        ADD COLUMN `tonsills` TEXT NULL AFTER `throat`,
        ADD COLUMN `neck_and_back` TEXT NULL AFTER `tonsills`,
        ADD COLUMN `extrimities` TEXT NULL AFTER `neck_and_back`,
        ADD COLUMN `bones` TEXT NULL AFTER `extrimities`,


        ADD COLUMN `oesophagus` TEXT NULL AFTER `bones`,
        ADD COLUMN `stomache` TEXT NULL AFTER `oesophagus`,
        ADD COLUMN `abdomen` TEXT NULL AFTER `stomache`,
        ADD COLUMN `liver` TEXT NULL AFTER `abdomen`,
        ADD COLUMN `gallbladder` TEXT NULL AFTER `liver`,
        ADD COLUMN `pancreas` TEXT NULL AFTER `gallbladder`,
        ADD COLUMN `spleen` TEXT NULL AFTER `pancreas`,
        ADD COLUMN `intestine` TEXT NULL AFTER `spleen`,
        ADD COLUMN `duodenum` TEXT NULL AFTER `intestine`,
        ADD COLUMN `digestion` TEXT NULL AFTER `duodenum`,
        ADD COLUMN `chest` TEXT NULL AFTER `digestion`,
        ADD COLUMN `heart` TEXT NULL AFTER `chest`,
        ADD COLUMN `lungs` TEXT NULL AFTER `heart`,
        ADD COLUMN `mso_mgo` TEXT NULL AFTER `lungs`,
        ADD COLUMN `fso_mgo` TEXT NULL AFTER `mso_mgo`,
        ADD COLUMN `anus_and_rectum` TEXT NULL AFTER `fso_mgo`;


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
