<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wind.Csn',
            'Feplugin',
            [
                'User' => 'list, show, new, create, edit, update, delete',
                'Post' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'User' => 'create, update, delete',
                'Post' => 'create, update, delete'
            ]
        );

	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					feplugin {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_feplugin.svg
						title = LLL:EXT:csn/Resources/Private/Language/locallang_db.xlf:tx_csn_domain_model_feplugin
						description = LLL:EXT:csn/Resources/Private/Language/locallang_db.xlf:tx_csn_domain_model_feplugin.description
						tt_content_defValues {
							CType = list
							list_type = csn_feplugin
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
