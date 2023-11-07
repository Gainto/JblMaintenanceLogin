# Maintenance Log-In for Shopware 6.5
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/jbl/maintenance-login-shopware6.svg?style=flat&include_prereleases)](https://packagist.org/packages/jbl/maintenance-login-shopware6)
[![PHP Version](https://img.shields.io/badge/php-%5E8.0-8892BF.svg?style=flat)](http://www.php.net)
[![Shopware Version](https://img.shields.io/badge/shopware-%5E6.5.0-8892BF.svg?style=flat)](http://www.shopware.com)

Define a password in the plug-in config.  
When maintenance mode is enabled, you can log-in with the password from within the maintenance page.  
Technically it simply adds the client's ip to the whitelist of the current sales-channel when the password matches.

## Install

### Install via composer:
```bash
composer require jbl/maintenance-login-shopware6
```

### Install via GIT
- Clone this repository into custom/plugins of your Shopware 6 installation

### Download & install the latest release
- Download the latest release and install it via the plug-in manager

## Screenshots

![Maintenance page](https://shopware.jeffblock.de/plugins/JblMaintenanceLogin/images/1.png)
![Plug-Ij config](https://shopware.jeffblock.de/plugins/JblMaintenanceLogin/images/2.png)
