<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wind3.Csndata',
            'Csnplugin',
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
