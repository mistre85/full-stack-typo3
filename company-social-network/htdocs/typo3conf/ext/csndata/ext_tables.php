<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Wind3.Csndata',
            'Csnplugin',
            'CSN plugin'
        );




        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Wind3.Csndata',
                'web', // Make module a submodule of 'web'
                'csnmodule', // Submodule key
                '', // Position
                [
                    
                ],
                [
                    'access' => 'user,group',
					'icon'   => 'EXT:' . $extKey . '/Resources/Public/Icons/user_mod_csnmodule.svg',
                    'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_csnmodule.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Company Social Network Data');




    },
    $_EXTKEY
);
