<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Wind.Csn',
            'Feplugin',
            'Frontend plugin'
        );

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Wind.Csn',
                'web', // Make module a submodule of 'web'
                'cnsweb', // Submodule key
                '', // Position
                [
                    'User' => 'list, show, new, create, edit, update, delete','Post' => 'list, show, new, create, edit, update, delete',
                ],
                [
                    'access' => 'user,group',
					'icon'   => 'EXT:' . $extKey . '/Resources/Public/Icons/user_mod_cnsweb.svg',
                    'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_cnsweb.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Company Social Network (extbase)');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_csn_domain_model_user', 'EXT:csn/Resources/Private/Language/locallang_csh_tx_csn_domain_model_user.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_csn_domain_model_user');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_csn_domain_model_post', 'EXT:csn/Resources/Private/Language/locallang_csh_tx_csn_domain_model_post.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_csn_domain_model_post');

    },
    $_EXTKEY
);
