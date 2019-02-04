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

### Create instance

```php
$api = new CBX\API("https://test-tb.cbx.xyz");
$config = new CBX\Config("en_GB", "i18n-develop-test");
$collections = new CBX\Collections($config);
$i18n = new i18nClass($collections);
```

### Create instance with factory

```php
$i18n = CBX\i18n::create("en_GB", "i18n-develop-test", "https://test-tb.cbx.xyz");
```

### Getting simple translation

```php
// 'contact/phone' -> '+45 55 55 45'
echo $i18n->_('contact/phone');
// output: +45 55 55 45
```

### Getting simple translation with placeholders

```php
// 'global/newPrice' -> 'New price: $price$'
echo $i18n->_('newPrice', [ 'price' => '10€' ]);
// output: New price: 10€
```

### Use in HTML

```html
<!-- 'global/helloWorld' -> 'Hello World!!!' -->
<p><?=$i18n->_htmlEscaped('helloWorld');?></p>
<!-- output: <p>Hello World!!!</p> -->
```

### Missing translation

> If the requested translation not found in the translation api the index is returned.

# Test

Offline test

```
test/online-test.sh
```

Online test

```
test/offline-test.sh
```


# Requirement

PHP: ^5.3.0 || ^7.0

PHP Curl extension

PHP Memcache extension

> This package requires no other composer packages

