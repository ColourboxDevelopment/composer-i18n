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

### Initialize

```php
CBX\i18n::setAPIURL("https://test-tb.cbx.xyz");
CBX\i18n::setLanguage('en_GB');
CBX\i18n::setDomain('i18n-develop-test');
```

### Getting simple translation

```php
// 'contact/phone' -> '+45 55 55 45'
echo CBX\i18n::_('contact/phone');
// output: +45 55 55 45
```

### Getting simple translation with placeholders

```php
// 'global/newPrice' -> 'New price: $price$'
echo CBX\i18n::_('newPrice', [ 'price' => '10€' ]);
// output: New price: 10€
```

### Use in HTML

```html
<!-- 'global/helloWorld' -> 'Hello World!!!' -->
<p><?=CBX\i18n::_htmlEscaped('helloWorld');?></p>
<!-- output: <p>Hello World!!!</p> -->
```

### Missing translation

> If the requested translation not found in the translation api the index is returned.

# Test

Run

```
test/test.sh
```


# Requirement

PHP: ^5.3.0 || ^7.0

PHP Curl extension

> This package requires no other composer packages

