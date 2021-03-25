<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Windtre.Csnd',
            'Userplugin',
            [
                'User' => 'register, subscription, login, doLogin, logout, status, showHide'
            ],
            // non-cacheable actions
            [
                'User' => 'subscription, doLogin, logout, status, showHide'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Windtre.Csnd',
            'Postplugin',
            [
                'Post' => 'post, savepost, like',
                'Commenti' => 'savecomment'
            ],
            // non-cacheable actions
            [
                'Post' => 'savepost, like',
                'Commenti' => 'savecomment'
            ]
        );


	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					userplugin {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_userplugin.svg
						title = LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_userplugin
						description = LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_userplugin.description
						tt_content_defValues {
							CType = list
							list_type = csnd_userplugin
						}
					}
					Postplugin {
                        icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/post_plugin_postplugin.svg
                        title = LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_postplugin
                        description = LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_postplugin.description
                        tt_content_defValues {
                            CType = list
                            list_type = csnd_postplugin
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
