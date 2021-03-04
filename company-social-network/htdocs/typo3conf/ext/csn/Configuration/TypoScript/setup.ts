
plugin.tx_csn_feplugin {
  view {
    templateRootPaths.0 = EXT:csn/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_csn_feplugin.view.templateRootPath}
    partialRootPaths.0 = EXT:csn/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_csn_feplugin.view.partialRootPath}
    layoutRootPaths.0 = EXT:csn/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_csn_feplugin.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_csn_feplugin.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_csn._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-csn table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-csn table th {
        font-weight:bold;
    }

    .tx-csn table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)

# Module configuration
module.tx_csn_web_csncnsweb {
  persistence {
    storagePid = {$module.tx_csn_cnsweb.persistence.storagePid}
  }
  view {
    templateRootPaths.0 = EXT:csn/Resources/Private/Backend/Templates/
    templateRootPaths.1 = {$module.tx_csn_cnsweb.view.templateRootPath}
    partialRootPaths.0 = EXT:csn/Resources/Private/Backend/Partials/
    partialRootPaths.1 = {$module.tx_csn_cnsweb.view.partialRootPath}
    layoutRootPaths.0 = EXT:csn/Resources/Private/Backend/Layouts/
    layoutRootPaths.1 = {$module.tx_csn_cnsweb.view.layoutRootPath}
  }
}
