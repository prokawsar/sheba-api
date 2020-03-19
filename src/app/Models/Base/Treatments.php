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
            'belongs-to-one' => '\Models\Base\Remedies'
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