
plugin.tx_csnd_postlist {
  view {
    # cat=plugin.tx_csnd_postlist/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:csnd/Resources/Private/Templates/
    # cat=plugin.tx_csnd_postlist/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:csnd/Resources/Private/Partials/
    # cat=plugin.tx_csnd_postlist/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:csnd/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_csnd_postlist//a; type=string; label=Default storage PID
    storagePid = 1
  }
}

plugin.tx_csnd_userlist {
  view {
    # cat=plugin.tx_csnd_userlist/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:csnd/Resources/Private/Templates/
    # cat=plugin.tx_csnd_userlist/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:csnd/Resources/Private/Partials/
    # cat=plugin.tx_csnd_userlist/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:csnd/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_csnd_userlist//a; type=string; label=Default storage PID
    storagePid = 1
  }
}


module.tx_csnd_csnadmin {
  view {
    # cat=module.tx_csnd_csnadmin/file; type=string; label=Path to template root (BE)
    templateRootPath = EXT:csnd/Resources/Private/Backend/Templates/
    # cat=module.tx_csnd_csnadmin/file; type=string; label=Path to template partials (BE)
    partialRootPath = EXT:csnd/Resources/Private/Backend/Partials/
    # cat=module.tx_csnd_csnadmin/file; type=string; label=Path to template layouts (BE)
    layoutRootPath = EXT:csnd/Resources/Private/Backend/Layouts/
  }
  persistence {
    # cat=module.tx_csnd_csnadmin//a; type=string; label=Default storage PID
    storagePid = 1
  }
}
