<?php
$EM_CONF[$_EXTKEY] = array (
  'title' => 'Awesome Icons',
  'description' => 'Adds Font Awesome icon tab for pages and content elements.',
  'category' => 'plugin',
  'constraints' =>
  array (
    'depends' =>
    array (
      'typo3' => '9.5.0-10.4.99',
    ),
  ),
  'autoload' =>
  array (
    'psr-4' =>
    array (
      'Brightside\\Awesomeicons\\' => 'Classes',
    ),
  ),
  'state' => 'beta',
  'uploadfolder' => false,
  'author' => 'Tanel Põld',
  'author_email' => 'info@t3brightside.com',
  'author_company' => 'Brightside OÜ / t3brightside.com',
  'version' => '0.0.2',
  'clearcacheonload' => false,
);
