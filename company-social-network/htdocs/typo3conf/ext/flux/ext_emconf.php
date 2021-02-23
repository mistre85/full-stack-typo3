<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "flux".
 *
 * Auto generated 22-02-2021 23:28
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Flux: Fluid FlexForms',
  'description' => 'Backend form and frontend content rendering assistance API with focus on productivity.',
  'category' => 'misc',
  'version' => '8.2.1',
  'state' => 'stable',
  'uploadfolder' => true,
  'createDirs' => '',
  'clearcacheonload' => true,
  'author' => 'FluidTYPO3 Team',
  'author_email' => 'claus@namelesscoder.net',
  'author_company' => '',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '7.6.13-8.7.99',
      'php' => '7.0.0-7.1.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  '_md5_values_when_last_written' => '',
  'autoload' => 
  array (
    'psr-4' => 
    array (
      'FluidTYPO3\\Flux\\' => 'Classes/',
    ),
  ),
  'autoload-dev' => 
  array (
    'psr-4' => 
    array (
      'FluidTYPO3\\Flux\\Tests\\' => 'Tests/',
    ),
  ),
);

