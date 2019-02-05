<?php

namespace CBX;

class I18nFactory
{
    public static function create($language, $domain, $apiUrl, $cacheHost, $cachePort) {
        return new I18nClass(new Collections(new Config($language, $domain, new API($apiUrl, new Cache($cacheHost, $cachePort)))));
    }

    public static function createOffline($language, $domain, $jsonDir, $cacheHost, $cachePort) {
        return new I18nClass(new Collections(new Config($language, $domain, new APIOffline($jsonDir, new Cache($cacheHost, $cachePort)))));
    }
}
