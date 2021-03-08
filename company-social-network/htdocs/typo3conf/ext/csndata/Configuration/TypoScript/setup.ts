
plugin.tx_csndata_csnplugin {
  view {
    templateRootPaths.0 = EXT:csndata/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_csndata_csnplugin.view.templateRootPath}
    partialRootPaths.0 = EXT:csndata/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_csndata_csnplugin.view.partialRootPath}
    layoutRootPaths.0 = EXT:csndata/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_csndata_csnplugin.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_csndata_csnplugin.persistence.storagePid}
    recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_csndata._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-csndata table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-csndata table th {
        font-weight:bold;
    }

    .tx-csndata table td {
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
module.tx_csndata_web_csndatacnsmodule {
  persistence {
    storagePid = {$module.tx_csndata_cnsmodule.persistence.storagePid}
  }
  view {
    templateRootPaths.0 = EXT:csndata/Resources/Private/Backend/Templates/
    templateRootPaths.1 = {$module.tx_csndata_cnsmodule.view.templateRootPath}
    partialRootPaths.0 = EXT:csndata/Resources/Private/Backend/Partials/
    partialRootPaths.1 = {$module.tx_csndata_cnsmodule.view.partialRootPath}
    layoutRootPaths.0 = EXT:csndata/Resources/Private/Backend/Layouts/
    layoutRootPaths.1 = {$module.tx_csndata_cnsmodule.view.layoutRootPath}
  }
}
