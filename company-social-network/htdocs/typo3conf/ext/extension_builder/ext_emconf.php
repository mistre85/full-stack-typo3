<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "extension_builder".
 *
 * Auto generated 22-02-2021 23:33
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Extension Builder',
  'description' => 'The Extension Builder helps you build and manage your Extbase based TYPO3 extensions. Consider using the latest version from https://github.com/FriendsOfTYPO3/extension_builder',
  'category' => 'module',
  'author' => 'Nico de Haen',
  'author_email' => 'mail@ndh-websolutions.de',
  'state' => 'beta',
  'uploadfolder' => true,
  'createDirs' => 'uploads/tx_extensionbuilder/backups',
  'version' => '7.10.0',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '7.6.0-7.6.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  'clearcacheonload' => false,
  'author_company' => NULL,
);

