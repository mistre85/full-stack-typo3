
plugin.tx_csnd_userplugin {
  view {
    # cat=plugin.tx_csnd_userplugin/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:csnd/Resources/Private/Templates/
    # cat=plugin.tx_csnd_userplugin/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:csnd/Resources/Private/Partials/
    # cat=plugin.tx_csnd_userplugin/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:csnd/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_csnd_userplugin//a; type=string; label=Default storage PID
    storagePid =
  }
}


plugin.tx_csnd_postplugin {
  view {
    # cat=plugin.tx_csnd_postplugin/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:csnd/Resources/Private/Templates/
    # cat=plugin.tx_csnd_postplugin/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:csnd/Resources/Private/Partials/
    # cat=plugin.tx_csnd_postplugin/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:csnd/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_csnd_postplugin//a; type=string; label=Default storage PID
    storagePid =
  }
}


module.tx_csnd_cnsadmin {
  view {
    # cat=module.tx_csnd_cnsadmin/file; type=string; label=Path to template root (BE)
    templateRootPath = EXT:csnd/Resources/Private/Backend/Templates/
    # cat=module.tx_csnd_cnsadmin/file; type=string; label=Path to template partials (BE)
    partialRootPath = EXT:csnd/Resources/Private/Backend/Partials/
    # cat=module.tx_csnd_cnsadmin/file; type=string; label=Path to template layouts (BE)
    layoutRootPath = EXT:csnd/Resources/Private/Backend/Layouts/
  }
  persistence {
    # cat=module.tx_csnd_cnsadmin//a; type=string; label=Default storage PID
    storagePid =
  }
}
