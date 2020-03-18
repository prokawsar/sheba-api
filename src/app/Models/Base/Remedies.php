<?php
namespace Models\Base;

class Remedies extends \Models\Base
{
    protected $fieldConf = [
        'name' => [
            'type' => 'VARCHAR128',
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