@ECHO OFF


echo "rimozione file temp typo3"


rmdir C:\wamp64\www\full-stack-typo3\company-social-network\htdocs\typo3temp /s /q


echo "cancellazione cache typo3"


"C:\wamp64\bin\php\php7.0.33\php.exe" C:\wamp64\www\full-stack-typo3\company-social-network\htdocs\typo3\cli_dispatch.phpsh extbase :clearcache

