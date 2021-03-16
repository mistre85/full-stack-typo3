<?php
if (!defined'TYPO3_MODE'()){
    die ('Access denied');
}


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', array(
    'csn_loggedpage' => array(
        'label' => 'Logged page',
        /*
            Se impostato, a tutti gli utenti di backend viene impedito di modificare
            il campo a meno che non siano membri di un gruppo di utenti di backend
            con questo campo aggiunto come "Campo di esclusione consentito" (o utente "amministratore")
        */
        'exclude' => 1,
        'config' => array(
            'type' => 'check',
            'default' => '0'
        ),
    ),
));

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'csn_loggedpage', '1,3,4,6,7', 'after:doktype');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'csn_loggedpage','254','after:doktype');