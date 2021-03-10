<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Wind.Csnd',
            'Postlist',
            'Post List'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Wind.Csnd',
            'Userlist',
            'User List'
        );

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Wind.Csnd',
                'web', // Make module a submodule of 'web'
                'cnsadmin', // Submodule key
                '', // Position
                [
                    'User' => 'list, show, new, create, edit, update, delete','Post' => 'list, show, new, create, edit, update, delete',
                ],
                [
                    'access' => 'user,group',
					'icon'   => 'EXT:' . $extKey . '/Resources/Public/Icons/user_mod_cnsadmin.svg',
                    'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_cnsadmin.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Company Social Network Data');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_csnd_domain_model_user', 'EXT:csnd/Resources/Private/Language/locallang_csh_tx_csnd_domain_model_user.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_csnd_domain_model_user');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_csnd_domain_model_post', 'EXT:csnd/Resources/Private/Language/locallang_csh_tx_csnd_domain_model_post.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_csnd_domain_model_post');

    },
    $_EXTKEY
);
