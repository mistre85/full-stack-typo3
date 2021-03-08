<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function ($extKey) {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wind.Csndata',
            'Csnplugin',
            [
                'Post' => 'list, show, new, create, edit, update, delete',
                'User' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'Post' => 'create, update, delete',
                'User' => 'create, update, delete'
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					csnplugin {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_csnplugin.svg
						title = LLL:EXT:csndata/Resources/Private/Language/locallang_db.xlf:tx_csndata_domain_model_csnplugin
						description = LLL:EXT:csndata/Resources/Private/Language/locallang_db.xlf:tx_csndata_domain_model_csnplugin.description
						tt_content_defValues {
							CType = list
							list_type = csndata_csnplugin
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
