<?php
/**
 * This file is part of the "awesomeicons" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

/** @noinspection PhpFullyQualifiedNameUsageInspection */
defined('TYPO3_MODE') or die();

/**
 * Get extensions configuration
 */
$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
  \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
);
$awesomeiconsConiguration = $extensionConfiguration->get('awesomeicons');

$GLOBALS['TCA']['pages']['columns']['tx_awesomeicons_icon'] = [
    'exclude' => 1,
    'label' => 'Icon code',
    'config' => [
        'type' => 'input',
        'size' => 15,
    ],
];

$GLOBALS['TCA']['pages']['columns']['tx_awesomeicons_search'] = [
    'exclude' => 1,
    'label' => 'Keyword search',
    'config' => [
        'type' => 'none',
        'renderType' => 'brightsideAwesomeicons',
        'size' => 15,
    ],
];

// $GLOBALS['TCA']['pages']['columns']['pi_flexform']['config']['ds'][',*'] = 'FILE:EXT:awesomeicons/Configuration/FlexForm/Awesomeicons.xml';

/**
 * Palettes
 */
$GLOBALS['TCA']['pages']['palettes']['awesomeicons'] = [
    'label' => 'LLL:EXT:awesomeicons/Resources/Private/Language/Tca.xlf:tt_content.awesomeicons_awesomeicons.icon',
    'showitem' => '
        tx_awesomeicons_icon,
        --linebreak--,
        tx_awesomeicons_search;Keyword search'
];

/**
 * CType awesomeicons_awesomeicons
 */
if ($awesomeiconsConiguration['awesomeiconsEnablePages'] == 1){
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'pages',
        '--div--;Icon,
            --palette--;;awesomeicons
        ','','after:twitter_card'
    );
}
