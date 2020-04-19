<?php
namespace Models\Base;

class Case_histories extends \Models\Base
{
    protected $fieldConf = [
        'patient' => [
            'belongs-to-one' => '\Models\Base\Patients'
        ],
        'built' => [
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
        'temperament' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'temperature_and_weather' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'thermal_sensitivity' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'sensation' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'tendency_take_cold' => [
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
        'birth_history_milestones' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'tissues' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'stages_and_states' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'attacks_and_side' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'ailments_from' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'affections' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'clinical' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'modalities' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'mental_state_and_disorders' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'appearance_and_behavior' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'attention_and_concentration' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'expression' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'consciousness' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'mood_and_affect' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'memory' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'speech' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'thoughts_and_ideas' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'perception' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'intelligence' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'judgment' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'fear_and_live_alone' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'boring' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'peaceful' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'anger' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hobby' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'habit' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'addiction' => [
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
        'pulse' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'breathing' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'peculiar_rare_symptoms' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'head' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'face_and_jaws' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'eyes' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hearing' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'skull_cranium' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'brain_and_nerves' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'vertigo' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'headache' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hair' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'organs' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'sight' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'ears' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'nose' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'smell' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'septum' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'mouth' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'tongue' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'taste' => [
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
        'm_m' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'lips' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'saliva' => [
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
        'uvula' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'external' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'internal' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'thirst' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hunger' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'appetite' => [
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
        'epigastrium' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hpyochondrium' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'umbilical_region' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'lumbar_region' => [
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
        'hypogastrium' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'iliac_region' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'inguinal_region' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'intestine' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'anus_and_rectum' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'stools' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'urinary_system' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'quantity' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'color' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'sediment' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'befor' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'during' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'after' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'kidneys' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'ureters' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'bladder' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'urethra' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'male_genital' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'mgo_desires' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'powers' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'emission' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'female_genital' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'fgo_organs' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'mensruation' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'leucorrhoea' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'pregnancy' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'respiratory_system' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'respi_organs' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'respi_breathing' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'lymphatic_system' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'endocrine_disorders' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hormones' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'chest' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'sternum' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'ribs' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'circulatory_system' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hearts_movements' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'sacrum_back_spine' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'vertibra' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'nape' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'scapula' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'shoulders' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'axilla' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'extrimities' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'hips' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'pelvis' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'buttocks' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'all_over_the_body' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'bones' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'joints' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'muscles' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'skin' => [
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
        'fever_chill_heat_sweat' => [
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
        'smelling' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'neck_and_back' => [
            'type' => 'TEXT',
            'nullable' => true
        ],
        'digestion' => [
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
        'relationship' => [
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
    $table = 'case_histories';

}