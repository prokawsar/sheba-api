<?php
namespace Models\Base;

class Patients extends \Models\Base
{
    protected $fieldConf = [
        'name' => [
            'type' => 'VARCHAR128',
            'nullable' => true
        ],
        'age' => [
            'type' => 'VARCHAR128',
            'nullable' => true
        ],
        'phone' => [
            'type' => 'VARCHAR128',
            'nullable' => true
        ],
        'gender' => [
            'type' => 'VARCHAR128',
            'nullable' => true
        ],
        'address' => [
            'type' => 'VARCHAR256',
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
        ]
    ],
    $table = 'patients';

}