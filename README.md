# composer-translation-tool

> Composer package - Internalization tool by Colourbox for PHP

[packagist.org](https://packagist.org/packages/colourbox-account/i18n)

## Install newest version

```bash
composer require colourbox-account/i18n
```

## Update to newest version

```bash
composer update colourbox-account/i18n
```

## Usage

```php
CBX\i18n::setAPIURL("https://test-tb.cbx.xyz");
CBX\i18n::setLanguage('en_GB');
CBX\i18n::setDomain('i18n-develop-test');
echo CBX\i18n::_('companyAddress');
```

# Documentation

## TODO

# Requirement

PHP: ^5.3.0 || ^7.0
PHP Curl extension

> This package requires no other composer packages

