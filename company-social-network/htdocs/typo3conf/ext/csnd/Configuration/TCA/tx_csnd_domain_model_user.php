<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_user',
        'label' => 'username',
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
        'searchFields' => 'username,email,password,nome,cognome,post_list',
        'iconfile' => 'EXT:csnd/Resources/Public/Icons/tx_csnd_domain_model_user.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, username, email, password, nome, cognome, post_list',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, username, email, password, nome, cognome, post_list, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_csnd_domain_model_user',
                'foreign_table_where' => 'AND tx_csnd_domain_model_user.pid=###CURRENT_PID### AND tx_csnd_domain_model_user.sys_language_uid IN (-1,0)',
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
        'username' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_user.username',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	    ],
	    'email' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_user.email',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	    ],
	    'password' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_user.password',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'nospace,password,required'
			]
	    ],
	    'nome' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_user.nome',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	    ],
	    'cognome' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_user.cognome',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	    ],
	    'post_list' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_user.post_list',
	        'config' => [
			    'type' => 'inline',
			    'foreign_table' => 'tx_csnd_domain_model_post',
			    'foreign_field' => 'user',
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
    ],
];
