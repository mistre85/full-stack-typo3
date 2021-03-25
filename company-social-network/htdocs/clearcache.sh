#!/usr/bin/env bash
echo "rimozione file temp typo3"
rm -rf var/www/typo3/htdocs/typo3temp/*
echo "cancellazione cache typo3"
/Applications/MAMP/bin/php/php7.1.32/bin/php var/www/typo3/htdocs/typo3/cli_dispatch.phpsh extbase :clearcache
