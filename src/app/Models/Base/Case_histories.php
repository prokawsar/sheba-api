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
        'face' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'built' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hair' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'tongue' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'pulse' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'breathing' => [
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
        'skin' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'sensation' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'temperature_and_weather' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'thermals' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'susceptibility' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'bathing' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'vision' => [
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
        'thirst' => [
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
        'ameliorable' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'indigestion' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'eructation' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'nausia' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'vomiting' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'sweating_perspiration' => [
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
        'discharges' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'stool' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'urine' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'menstruation' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'leucorrhoea' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'habit' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hobby' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'addicted' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'birth_history' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'milestones' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'mood_and_affect' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'speech' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'thought' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'attention_and_concentration' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'consciousness' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'appearance_and_behavior' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'memory' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'intelligency' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'judgement' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'insight' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'temperament' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'alone_and_darkness' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'frightness' => [
            'type' => 'TEXT',
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
        'ailments_from' => [
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
        'past_medical_history' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'family_medical_history' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'rare_peculiar_symptoms' => [
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