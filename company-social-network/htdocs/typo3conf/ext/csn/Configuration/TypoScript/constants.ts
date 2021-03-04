
plugin.tx_csn_feplugin {
  view {
    # cat=plugin.tx_csn_feplugin/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:csn/Resources/Private/Templates/
    # cat=plugin.tx_csn_feplugin/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:csn/Resources/Private/Partials/
    # cat=plugin.tx_csn_feplugin/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:csn/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_csn_feplugin//a; type=string; label=Default storage PID
    storagePid =
  }
}

module.tx_csn_cnsweb {
  view {
    # cat=module.tx_csn_cnsweb/file; type=string; label=Path to template root (BE)
    templateRootPath = EXT:csn/Resources/Private/Backend/Templates/
    # cat=module.tx_csn_cnsweb/file; type=string; label=Path to template partials (BE)
    partialRootPath = EXT:csn/Resources/Private/Backend/Partials/
    # cat=module.tx_csn_cnsweb/file; type=string; label=Path to template layouts (BE)
    layoutRootPath = EXT:csn/Resources/Private/Backend/Layouts/
  }
  persistence {
    # cat=module.tx_csn_cnsweb//a; type=string; label=Default storage PID
    storagePid =
  }
}
