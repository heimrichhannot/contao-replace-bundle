<?php

$dca = &$GLOBALS['TL_DCA']['tl_settings'];

/**
 * Palettes
 */
$dca['palettes']['default'] = str_replace('{chmod_legend', '{replace_legend},replace;{chmod_legend', $dca['palettes']['default']);

/**
 * Fields
 */
$arrFields = [
    'replace' => [
        'label'     => &$GLOBALS['TL_LANG']['tl_settings']['replace'],
        'inputType' => 'multiColumnEditor',
        'exclude'   => true,
        'eval'      => [
            'multiColumnEditor' => [
                'fields' => [
                    'search'  => [
                        'label'     => &$GLOBALS['TL_LANG']['tl_settings']['replace']['search'],
                        'exclude'   => true,
                        'inputType' => 'text',
                        'eval'      => ['groupStyle' => 'width:40%', 'allowHtml' => true, 'preserveTags' => true]
                    ],
                    'replace' => [
                        'label'     => &$GLOBALS['TL_LANG']['tl_settings']['replace']['replace'],
                        'exclude'   => true,
                        'inputType' => 'text',
                        'eval'      => ['groupStyle' => 'width:40%', 'allowHtml' => true, 'preserveTags' => false]
                    ],
                    'tags'    => [
                        'label'     => &$GLOBALS['TL_LANG']['tl_settings']['replace']['tags'],
                        'exclude'   => true,
                        'inputType' => 'checkbox',
                        'eval'      => ['groupStyle' => 'width:10%']
                    ],
                ]
            ]
        ],
    ]
];

$dc['fields'] = array_merge($dca['fields'], $arrFields);