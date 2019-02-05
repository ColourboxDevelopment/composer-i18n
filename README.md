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
// With Memcached
$cache = new CBX\Cache("127.0.0.1", 11211);

/*
With Redis
$cache = new \Predis\Client([
            'scheme' => "tcp",
            'host'   => "127.0.0.1",
            'port'   => 6379,
        ]);
*/

$api = new CBX\API("https://test-tb.cbx.xyz", $cache);
$config = new CBX\Config("en_GB", "i18n-develop-test", $api);
$collections = new CBX\Collections($config);
$i18n = new CBX\I18nClass($collections);
```

### Create instance with factory

```php
// With Memcached
$i18n = CBX\I18nFactory::createMemcached("en_GB", "i18n-develop-test", "https://test-tb.cbx.xyz", "127.0.0.1", 11211);
```

```php
// With Redis
$cache = new \Predis\Client([
            'scheme' => "tcp",
            'host'   => "127.0.0.1",
            'port'   => 6379,
        ]);
$i18n = CBX\I18nFactory::createRedis("en_GB", "i18n-develop-test", "https://test-tb.cbx.xyz", $cache);
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

Offline tests

```
test/online-memcached-test.sh
test/online-redis-test.sh
```

Online tests

```
test/offline-memcached-test.sh
test/offline-redis-test.sh
```


# Requirement

PHP: ^5.3.0 || ^7.0

PHP Curl extension

PHP Memcached extension

> This package requires no other composer packages

