<?php
namespace Models\Base;

class Remedy_data extends \Models\Base
{
    protected $fieldConf = [
        'field' => [
            'belongs-to-one' => '\Models\Base\Fields'
        ],
        'remedy' => [
            'belongs-to-one' => '\Models\Base\Remedies'
        ],
        'symptoms' => [
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
        ]
    ],
    $table = 'remedy_data';

}