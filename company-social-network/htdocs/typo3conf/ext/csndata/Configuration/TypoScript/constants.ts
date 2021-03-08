
plugin.tx_csndata_csnplugin {
  view {
    # cat=plugin.tx_csndata_csnplugin/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:csndata/Resources/Private/Templates/
    # cat=plugin.tx_csndata_csnplugin/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:csndata/Resources/Private/Partials/
    # cat=plugin.tx_csndata_csnplugin/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:csndata/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_csndata_csnplugin//a; type=string; label=Default storage PID
    storagePid =
  }
}


module.tx_csndata_csnmodule {
  view {
    # cat=module.tx_csndata_csnmodule/file; type=string; label=Path to template root (BE)
    templateRootPath = EXT:csndata/Resources/Private/Backend/Templates/
    # cat=module.tx_csndata_csnmodule/file; type=string; label=Path to template partials (BE)
    partialRootPath = EXT:csndata/Resources/Private/Backend/Partials/
    # cat=module.tx_csndata_csnmodule/file; type=string; label=Path to template layouts (BE)
    layoutRootPath = EXT:csndata/Resources/Private/Backend/Layouts/
  }
  persistence {
    # cat=module.tx_csndata_csnmodule//a; type=string; label=Default storage PID
    storagePid =
  }
}
