<?php
namespace Models\Base;

class Treatments extends \Models\Base
{
    protected $fieldConf = [
        'case_history' => [
            'belongs-to-one' => '\Models\Base\Case_histories'
        ],
        'patient' => [
            'belongs-to-one' => '\Models\Base\Patients'
        ],
        'remedy' => [
            'type' => 'VARCHAR256',
            'nullable' => true
        ],
        'power' => [
            'type' => 'VARCHAR128',
            'nullable' => true
        ],
        'taking_rule' => [
            'type' => 'VARCHAR256',
            'nullable' => true
        ],
        'notes' => [
            'type' => 'VARCHAR256',
            'nullable' => true
        ],
        'created' => [
            'type' => 'DATETIME',
            'nullable' => true
        ],
        'modified' => [
            'type' => 'DATETIME',
            'nullable' => true
        ]
    ],
    $table = 'treatments';

}