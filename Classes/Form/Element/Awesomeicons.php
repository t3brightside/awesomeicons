<?php
/**
 * This file is part of the "awesomeicons" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);
namespace Brightside\Awesomeicons\Form\Element;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Backend\Form\NodeFactory;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class AwesomeiconsElement
 *
 * @package Brightside\Awesomeicons\Form\Element
 */
class Awesomeicons extends AbstractFormElement
{

    /**
     * List of all icons by json-configuration
     *
     * @var array
     */
    protected $iconList = [];

    /**
     * Container objects give $nodeFactory down to other containers.
     *
     * @param NodeFactory $nodeFactory
     * @param array $data
     */
    public function __construct(NodeFactory $nodeFactory, array $data)
    {
        $value = $data['databaseRow']['tx_awesomeicons_icon'];
        $this->setValue($value);
        $this->loadAssets();
        $this->initializeIconList();
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * Renders the icon field
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Renders the icon selector
     *
     * @return array
     */
    public function render(): array
    {
        $result = $this->initializeResultArray();
        $result['html'] = $this->getSelector();
        return $result;
    }

    /**
     * Loads the icon list from the json configuration file
     */
    protected function initializeIconList(): void
    {
        $iconList = ExtensionManagementUtility::extPath('awesomeicons', 'Configuration/Json/FontAwesomeIcons.json');
        $iconListContent = GeneralUtility::getUrl($iconList);
        $iconList = json_decode($iconListContent, true);
        foreach ($iconList as $icon) {
            $this->iconList[substr($icon, 0, 3)][] = $icon;
        }
    }

    /**
     * Loads the backend css and javascript
     */
    protected function loadAssets(): void
    {
        $extPath = ExtensionManagementUtility::extPath('awesomeicons', 'Resources/Public');
        $extRelPath = str_replace(Environment::getPublicPath() . '/', '../', $extPath);

        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addCssFile($extRelPath . '/Libraries/fontawesome-free-5.13.0/css/all.min.css');
        $pageRenderer->addCssFile($extRelPath . '/Css/Backend.min.css');
        $pageRenderer->loadRequireJsModule('TYPO3/CMS/Awesomeicons/Awesomeicons');
    }
    /**
     * Return the icon selector
     *
     * @return string
     */
    protected function getSelector(): string
    {
        $name = $this->data['parameterArray']['itemFormElName'];
        $id = $this->data['parameterArray']['itemFormElID'];
        $value = $this->getValue();

        $out = '<div class="form-control-clearable" style="max-width: 240px">';
        $out .= '<input type="text" name="icon-filter" value="" class="form-control" placeholder="' . LocalizationUtility::translate('LLL:EXT:awesomeicons/Resources/Private/Language/Tca.xlf:tt_content.awesomeicons_awesomeicons.icon.search') . '">';
        $out .= '<button type="button" class="close reset-icon-filter" tabindex="-1" aria-hidden="true">' . $this->getCloseIcon() . '</button>';
        $out .= '</div>';
        $out .= '<div id="ext-awesomeicons-selected" style="background: #fff; padding: 2em; border: 1px solid #ccc; position: absolute; top: 0; right: 15px; width: auto; margin-top: -40px;"><i class="' . $value . ' fa-fw fa-4x"></i></div>';
        foreach ($this->iconList as $iconGroup => $icons) {
            $out .= '<div class="icon-list">';
            $out .= '<h5>' . LocalizationUtility::translate('LLL:EXT:awesomeicons/Resources/Private/Language/Tca.xlf:tt_content.awesomeicons_awesomeicons.icon.group.' . $iconGroup) . '</h5>';
            $out .= '<div class="row">';
            foreach ($icons as $icon) {
                $out .= $this->getIconSelector($icon, $icon === $value ? ' active' : '');
            }
            $out .= '<div class="empty hidden"><i>' . LocalizationUtility::translate('LLL:EXT:awesomeicons/Resources/Private/Language/Tca.xlf:tt_content.awesomeicons_awesomeicons.icon.search.empty') . '</i></div>';
            $out .= '</div></div>';
        }
        $out .= '<input type="hidden" name="' . $name . '" value="' . $value . '" id="' . $id . '" />';
        return '<div class="ext-awesomeicons">' . $out . '</div>';
    }

    /**
     * Returns the icon selector tag
     *
     * @param string $icon
     * @param string $active
     * @return string
     */
    protected function getIconSelector(string $icon, string $active = ''): string
    {
        $keywords = str_replace(
            ['fas ', 'far ', 'fab ', 'fa-', '-'],
            ['solid ', 'regular ', 'brand ', '', ' '],
            $icon
        );
        return '<div class="item' . $active . '" data-value="' . $icon . '" data-keywords="' . $keywords . '" title="' . $icon . '"><i class="' . $icon . ' fa-fw fa-2x"></i></div>';
    }

    /**
     * Returns the close icon by IconFactory
     *
     * @return string
     */
    protected function getCloseIcon(): string
    {
        $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
        return $iconFactory->getIcon('actions-close', Icon::SIZE_SMALL)->render();
    }
}
