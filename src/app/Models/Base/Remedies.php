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
        'ailments_trom' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'sensations' => [
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
        'treatments' => [
            'has-many' => ['\Models\Base\Treatments', 'remedy']
        ]
    ],
    $table = 'remedies';

}