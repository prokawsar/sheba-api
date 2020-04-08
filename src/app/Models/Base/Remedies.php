<?php
namespace Models\Base;

class Remedies extends \Models\Base
{
    protected $fieldConf = [
        'name' => [
            'type' => 'VARCHAR128',
            'nullable' => true
        ],
        'constitution' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'diathesis' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'miasm' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'temperament' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'thermals' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'attacks_and_time' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'side' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'temperature_and_weather' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'ailments_from' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'sensation' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'mind' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'face' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hair' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'skin' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'built' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'appetite' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hunger' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'desires' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'aversions' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'intolerable' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'ameliarable' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'vission' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hearing' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'smelling' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'taste' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'tongue' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'thirst' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'sleep' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'dreams' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'stools' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'urine' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'perspiration' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'nutrition' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'anaemia' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'cyanosis' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'dehydration' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'jaundice' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'breathing' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'pulse' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'head' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'eyes' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'nose' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'ears' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'mouth' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'teeth' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'gums' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'throat' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'tonsills' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'neck_and_back' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'extrimities' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'bones' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'oesophagus' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'stomach' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'abdomen' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'liver' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'gallbladder' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'pancreas' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'spleen' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'intestine' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'duodenum' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'digestion' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'chest' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'heart' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'lungs' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'mso_mgo' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'fso_mgo' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'anus_and_rectum' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'modalities' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'clinical' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'deleted' => [
            'type' => 'INT1',
            'nullable' => true
        ],
        'created' => [
            'type' => 'DATETIME',
            'nullable' => true
        ],
        'modified' => [
            'type' => 'DATETIME',
            'nullable' => true
        ],
        'remedy_data' => [
            'has-many' => ['\Models\Base\Remedy_data', 'remedy']
        ],
        'treatments' => [
            'has-many' => ['\Models\Base\Treatments', 'remedy']
        ]
    ],
    $table = 'remedies';

}