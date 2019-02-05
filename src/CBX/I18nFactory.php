<?php

namespace CBX;

class I18nFactory
{
    public static function createMemcached($language, $domain, $apiUrl, $cacheHost, $cachePort) {
        return new I18nClass(new Collections(new Config($language, $domain, new API($apiUrl, new Cache($cacheHost, $cachePort)))));
    }

    public static function createOfflineMemcached($language, $domain, $jsonDir, $cacheHost, $cachePort) {
        return new I18nClass(new Collections(new Config($language, $domain, new APIOffline($jsonDir, new Cache($cacheHost, $cachePort)))));
    }

    public static function createRedis($language, $domain, $apiUrl, $cache) {
        return new I18nClass(new Collections(new Config($language, $domain, new API($apiUrl, $cache))));
    }

    public static function createOfflineRedis($language, $domain, $jsonDir, $cache) {
        return new I18nClass(new Collections(new Config($language, $domain, new APIOffline($jsonDir, $cache))));
    }
}
