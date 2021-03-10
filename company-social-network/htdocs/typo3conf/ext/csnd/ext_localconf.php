<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function ($extKey) {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wind.Csnd',
            'Userplugin',
            [
                'User' => 'register, subscription, login, doLogin',

            ],
            // non-cacheable actions
            [
                'User' => 'subcription, doLogin',
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					Userplugin {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_userplugin.svg
						title = LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_userplugin
						description = LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_userplugin.description
						tt_content_defValues {
							CType = list
							list_type = csnd_userplugin
						}
					}
				}
				show = *
			}
	   }'
        );
    },
    $_EXTKEY
);
