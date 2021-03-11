<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_post',
        'label' => 'text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'text,likes,user,comments',
        'iconfile' => 'EXT:csnd/Resources/Public/Icons/tx_csnd_domain_model_post.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, text, likes, user, comments,crdate',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, text, likes, user, comments, crdate, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_csnd_domain_model_post',
                'foreign_table_where' => 'AND tx_csnd_domain_model_post.pid=###CURRENT_PID### AND tx_csnd_domain_model_post.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
        ],
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_post.text',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim,required'
            ]
        ],
        'likes' => [
            'exclude' => true,
            'label' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_post.likes',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'user' => [
            'exclude' => true,
            'label' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_post.user',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_csnd_domain_model_user',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        'comments' => [
            'exclude' => true,
            'label' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_post.comments',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_csnd_domain_model_comment',
                'foreign_field' => 'post',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        'user' => [
            'exclude' => true,
            'label' => "User",
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_csnd_domain_model_user'
            ],
        ],
        'crdate' => [
            'exclude' => true,
            'label' => "Crdate",
            'config' => [
                'type' => 'input',
                'size' => '13',
                'max' => '20',
                'eval' => 'datetime',
                'default' => '0'
            ],
        ],
    ],
];
