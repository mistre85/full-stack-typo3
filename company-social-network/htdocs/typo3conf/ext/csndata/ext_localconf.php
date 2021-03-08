<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wind.Csndata',
            'Frontendplugin',
            [
                
            ],
            // non-cacheable actions
            [
                
            ]
        );


	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					frontendplugin {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_frontendplugin.svg
						title = LLL:EXT:csndata/Resources/Private/Language/locallang_db.xlf:tx_csndata_domain_model_frontendplugin
						description = LLL:EXT:csndata/Resources/Private/Language/locallang_db.xlf:tx_csndata_domain_model_frontendplugin.description
						tt_content_defValues {
							CType = list
							list_type = csndata_frontendplugin
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
