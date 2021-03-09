
plugin.tx_csnd_postlist {
  view {
    templateRootPaths.0 = EXT:csnd/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_csnd_postlist.view.templateRootPath}
    partialRootPaths.0 = EXT:csnd/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_csnd_postlist.view.partialRootPath}
    layoutRootPaths.0 = EXT:csnd/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_csnd_postlist.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_csnd_postlist.persistence.storagePid}
    recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_csnd_userlist {
  view {
    templateRootPaths.0 = EXT:csnd/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_csnd_userlist.view.templateRootPath}
    partialRootPaths.0 = EXT:csnd/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_csnd_userlist.view.partialRootPath}
    layoutRootPaths.0 = EXT:csnd/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_csnd_userlist.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_csnd_userlist.persistence.storagePid}
    recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

<<<<<<< HEAD


=======
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
plugin.tx_csnd._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-csnd table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-csnd table th {
        font-weight:bold;
    }

    .tx-csnd table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)

<<<<<<< HEAD


# Module configuration
module.tx_csnd_web_csndcsnadmin {
  persistence {
    storagePid = {$module.tx_csnd_csnadmin.persistence.storagePid}
  }
  view {
    templateRootPaths.0 = EXT:csnd/Resources/Private/Backend/Templates/
    templateRootPaths.1 = {$module.tx_csnd_csnadmin.view.templateRootPath}
    partialRootPaths.0 = EXT:csnd/Resources/Private/Backend/Partials/
    partialRootPaths.1 = {$module.tx_csnd_csnadmin.view.partialRootPath}
    layoutRootPaths.0 = EXT:csnd/Resources/Private/Backend/Layouts/
    layoutRootPaths.1 = {$module.tx_csnd_csnadmin.view.layoutRootPath}
=======
# Module configuration
module.tx_csnd_web_csndcnsadmin {
  persistence {
    storagePid = {$module.tx_csnd_cnsadmin.persistence.storagePid}
  }
  view {
    templateRootPaths.0 = EXT:csnd/Resources/Private/Backend/Templates/
    templateRootPaths.1 = {$module.tx_csnd_cnsadmin.view.templateRootPath}
    partialRootPaths.0 = EXT:csnd/Resources/Private/Backend/Partials/
    partialRootPaths.1 = {$module.tx_csnd_cnsadmin.view.partialRootPath}
    layoutRootPaths.0 = EXT:csnd/Resources/Private/Backend/Layouts/
    layoutRootPaths.1 = {$module.tx_csnd_cnsadmin.view.layoutRootPath}
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
  }
}
