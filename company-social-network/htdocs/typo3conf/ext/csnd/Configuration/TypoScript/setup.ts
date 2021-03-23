
plugin.tx_csnd_userplugin {
  view {
    templateRootPaths.0 = EXT:csnd/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_csnd_userplugin.view.templateRootPath}
    partialRootPaths.0 = EXT:csnd/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_csnd_userplugin.view.partialRootPath}
    layoutRootPaths.0 = EXT:csnd/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_csnd_userplugin.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_csnd_userplugin.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_csnd_postplugin {
  view {
    templateRootPaths.0 = EXT:csnd/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_csnd_postplugin.view.templateRootPath}
    partialRootPaths.0 = EXT:csnd/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_csnd_postplugin.view.partialRootPath}
    layoutRootPaths.0 = EXT:csnd/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_csnd_postplugin.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_csnd_postplugin.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

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

    .typo3-messages{
        list-style:none;
    }
)

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
  }
}



#configurazione API
plugin.tx_rest.settings {
    paths {
        wind-csdn {
            path = wind-csnd-*
            read = allow
            write = deny
        }

        cundd-custom_rest {
            path = cundd-custom_rest-*
            read = allow
            write = deny
            handlerClass = Wind\Csnd\Rest\Handler
        }




    }

    aliases {
        post = wind-csnd-post
        user = wind-csnd-user
        comment = wind-csnd-comment
    }

    aliases {
        post = wind-csnd-post
        user = wind-csnd-user
        comment = wind-csnd-comment
    }

    plugin.tx_rest.settings.virtualObjects {
        user {
            mapping {
                tableName = tx_csnd_domain_model_user
                identifier = uid
                skipUnknownProperties = true
                properties {
                    nomeutente {
                        type = string
                        column = usertname
                    }
                }
            }
        }
    }

}
