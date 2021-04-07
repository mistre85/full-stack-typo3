<?php
defined('TYPO3_MODE') || die('Access denied.');

//configurazioni di frontend

call_user_func(
    function ($extKey) {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wind.Csnd',
            'Userplugin',
            [
                'User' => 'register, subscription, login, doLogin, logout, status, toggleStatus, edit',
            ],
            // non-cacheable actions
            [
                'User' => 'register, subscription, login, doLogin, logout, status, toggleStatus, edit',
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wind.Csnd',
            'Postplugin',
            [
                'Post' => 'post, publicPost, like, list',
                'Comment' => 'create'
            ],
            // non-cacheable actions
            [
                'Post' => 'publicPost, like, list',
                'Comment' => 'create'
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
					postplugin {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_postplugin.svg
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

        //https://docs.typo3.org/m/typo3/book-extbasefluid/8.7/en-us/10-Outlook/3-Command-controllers.html
        if (TYPO3_MODE === 'BE') {
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers']["Csnd-CsndCommandController"] =
                \Wind\Csnd\Command\CsndCommandController::class;
        }

        //if (TYPO3_MODE === 'BE') {
        //    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers']['ExtensionName-MeaningFullName'] =
        //        \Vendor\ExtKey\Command\SimpleCommandController::class;
        //}

    },
    $_EXTKEY
);
