<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wind.Csnd',
            'Postlist',
            [
<<<<<<< HEAD

=======
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
                'Post' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'Post' => 'create, update, delete'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Wind.Csnd',
            'Userlist',
            [
<<<<<<< HEAD
                'User' => 'list, show, new, create, edit, update, delete',               
            ],
            // non-cacheable actions
            [
                'User' => 'create, update, delete',               
            ]
        );


=======
                'User' => 'list, show, new, create, edit, update, delete'
            ],
            // non-cacheable actions
            [
                'User' => 'create, update, delete'
            ]
        );

>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					postlist {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_postlist.svg
						title = LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_postlist
						description = LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_postlist.description
						tt_content_defValues {
							CType = list
							list_type = csnd_postlist
						}
					}
					userlist {
						icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_userlist.svg
						title = LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_userlist
						description = LLL:EXT:csnd/Resources/Private/Language/locallang_db.xlf:tx_csnd_domain_model_userlist.description
						tt_content_defValues {
							CType = list
							list_type = csnd_userlist
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
