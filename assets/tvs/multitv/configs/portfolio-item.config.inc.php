<?php

$settings['display'] = 'vertical';
$settings['fields'] = [
    'title' => [
        'caption' => 'Название объекта',
        'type' => 'text',
    ],
    'image' => [
        'caption' => 'Фотография',
        'type' => 'image',
    ],
    'type' => [
        'caption' => 'Тип',
        'type' => 'listbox',
        'elements' => 'Жилые комплексы==residential||Коммерческие==commercial||Частные==private',
        'default' => 'residential',
    ],
];
