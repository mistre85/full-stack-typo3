#!/usr/bin/env bash
echo "rimozione file temp typo3"
rm -rf typo3temp
echo "cancellazione cache typo3"
/Applications/MAMP/bin/php/php7.1.32/bin/php /Applications/MAMP/htdocs/company_social_network/company-social-network/htdocs/typo3/cli_dispatch.phpsh extbase csnd:clearcache

#Genera la lista dei comandi disponibili
#/Applications/MAMP/bin/php/php7.1.32/bin/php /Applications/MAMP/htdocs/company_social_network/company-social-network/htdocs/typo3/cli_dispatch.phpsh extbase help