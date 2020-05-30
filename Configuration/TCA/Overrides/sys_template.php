<?php
/**
 * This file is part of the "awesomeicons" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'awesomeicons',
    'Configuration/TypoScript',
    'Awesome Icons'
);
