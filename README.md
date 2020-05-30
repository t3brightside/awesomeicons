# Awesome Icons
[![Packagist](https://img.shields.io/packagist/v/t3brightside/awesomeicons.svg?style=flat)](https://packagist.org/packages/t3brightside/awesomeicons)
[![Software License](https://img.shields.io/badge/license-GPLv3-brightgreen.svg?style=flat)](LICENSE)
[![Brightside](https://img.shields.io/badge/by-t3brightside.com-orange.svg?style=flat)](https://t3brightside.com)

**TYPO3 CMS extension for Font Awesome icons**
Adds Icon tabs for content elements and pages.

## System requirements

- TYPO3 9.5 – 10.4 LTS

## Features

- Icon tab for pages and content elements
- Icon search by keyword
- Show active icon
- Manually write icon code

## Installation

 - From TER: **awesomeicons**, or composer: **t3brightside/awesomeicons**
 - Include static template if Font Awesome is not loaded in your system.
 - Change template constant to include CSS from local source. CDN version is used by default.
 - Check extension configuration for disabling icon tabs or enabling only for certain content types.

## Usage

NOTE! No front end rendering included. This you have to do in your own templates.
Use tx_awesomeicons_icon field from tt_content and pages tables in your templates.


## Sources

-  [GitHub][a47ab545]
-  [Packagist][40819ab1]
-  [TER][15e0f507]

  [a47ab545]: https://github.com/t3brightside/awesomeicons "GitHub"
  [40819ab1]: https://packagist.org/packages/t3brightside/awesomeicons "Packagist"
  [15e0f507]: https://extensions.typo3.org/extension/awesomeicons/ "Typo3 Extension Repository"

Development and maintenance
---------------------------
[Brightside OÜ – TYPO3 development and hosting specialised web agency][ab26eed2]

  [ab26eed2]: https://t3brightside.com/ "TYPO3 development and hosting specialised web agency"
  
This extension uses quite a bit of code from [Icon Content](https://gitlab.com/lavitto/typo3-icon-content) by [Philipp Müller](https://www.lavitto.ch/). Thank you Mr. Müller!
