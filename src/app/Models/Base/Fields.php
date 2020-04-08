<?php
namespace Models\Base;

class Fields extends \Models\Base
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
        'remedy_data' => [
            'has-many' => ['\Models\Base\Remedy_data', 'field']
        ]
    ],
    $table = 'fields';

}