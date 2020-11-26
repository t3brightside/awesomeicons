<?php
/**
 * This file is part of the "awesomeicons" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

/** @noinspection PhpFullyQualifiedNameUsageInspection */
defined('TYPO3_MODE') or die();

$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
  \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
);
$awesomeiconsConiguration = $extensionConfiguration->get('awesomeicons');

$GLOBALS['TCA']['sys_category']['columns']['tx_awesomeicons_icon'] = [
    'exclude' => 1,
    'label' => 'Icon code',
    'config' => [
        'type' => 'input',
        'size' => 15,
    ],
];

$GLOBALS['TCA']['sys_category']['columns']['tx_awesomeicons_search'] = [
    'label' => 'Keyword search',
    'config' => [
        'type' => 'none',
        'renderType' => 'brightsideAwesomeicons',
        'size' => 15,
    ],
];

$GLOBALS['TCA']['sys_category']['palettes']['awesomeicons'] = [
    'label' => 'LLL:EXT:awesomeicons/Resources/Private/Language/Tca.xlf:tt_content.awesomeicons_awesomeicons.icon',
    'showitem' => '
        tx_awesomeicons_icon,
        --linebreak--,
        tx_awesomeicons_search;Keyword search'
];

if ($awesomeiconsConiguration['awesomeiconsEnableCategory'] == 1){
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'sys_category',
        '--div--;Icon,
            --palette--;;awesomeicons,
        ',$awesomeiconsConiguration['awesomeiconsContentTypes'], 'after:items'
    );
}
