<?php
namespace Models\Base;

class Case_histories extends \Models\Base
{
    protected $fieldConf = [
        'patient' => [
            'belongs-to-one' => '\Models\Base\Patients'
        ],
        'mind' => [
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
            'has-many' => ['\Models\Base\Treatments', 'case_history']
        ]
    ],
    $table = 'case_histories';

}