<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "fluidpages".
 *
 * Auto generated 22-02-2021 23:28
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Fluid Pages Engine',
  'description' => 'Fluid Page Template engine - integrates compact and highly dynamic page templates with all the benefits of Fluid.',
  'category' => 'misc',
  'author' => 'FluidTYPO3 Team',
  'author_email' => 'claus@namelesscoder.net',
  'author_company' => '',
  'state' => 'stable',
  'uploadfolder' => true,
  'createDirs' => '',
  'clearcacheonload' => true,
  'version' => '4.1.0',
  'constraints' => 
  array (
    'depends' => 
    array (
      'php' => '7.0.0-7.1.99',
      'typo3' => '7.6.0-8.6.99',
      'flux' => '7.3.0-8.99.99',
    ),
    'conflicts' => 
    array (
      'templavoila' => '',
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
      'FluidTYPO3\\Fluidpages\\' => 'Classes/',
    ),
  ),
  'autoload-dev' => 
  array (
    'psr-4' => 
    array (
      'FluidTYPO3\\Fluidpages\\Tests\\' => 'Tests/',
    ),
  ),
);

